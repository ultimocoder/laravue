<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('index');
    }
    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
    
        $product_name = $request->product_name;
        $plan_type = $request->subcription_plan;
        $user_name = $request->name;
        $user_email = $request->email;
        $subcription_date = $request->date;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $paypalToken = $provider->getAccessToken();
                
                    if($plan_type =="Daily")
                        {
                            $response = $provider->addProduct($product_name, $product_name, 'SERVICE', 'SOFTWARE')
                            ->addPlanTrialPricing('DAY', 7)
                            ->addDailyPlan('Daily Plan', 'Daily Plan', 1.15)
                             ->setReturnAndCancelUrl('http://127.0.0.1:8000/success-transaction', 'http://127.0.0.1:8000/cancel-transaction')
                    ->setupSubscription($user_name, $user_email, $subcription_date);
                        }elseif($plan_type =="Weekly")
                        {
                              $response = $provider->addProduct($product_name, $product_name,'SERVICE', 'SOFTWARE')
                                        ->addPlanTrialPricing('DAY', 7)
                                        ->addWeeklyPlan('Weekly Plan', 'Weekly Plan', 6.56)
                                        ->setReturnAndCancelUrl('http://127.0.0.1:8000/success-transaction', 'http://127.0.0.1:8000/cancel-transaction')
                    ->setupSubscription($user_name, $user_email, $subcription_date);
                        }else{
                              $response = $provider->addProduct($product_name, $product_name,'SERVICE', 'SOFTWARE')
                    ->addPlanTrialPricing('DAY', 7)
                            ->addMonthlyPlan('Monthly Plan', 'Monthly Plan', 30)
                             ->setReturnAndCancelUrl('http://127.0.0.1:8000/success-transaction', 'http://127.0.0.1:8000/cancel-transaction')
                    ->setupSubscription($user_name, $user_email, $subcription_date);
                        }
                  
                   
        /*$response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1000.00"
                    ]
                ]
            ]
        ]);*/
       
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        
        $response = $provider->capturePaymentOrder($request['token']);
        print_r($response);
        die();
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('createTransaction')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
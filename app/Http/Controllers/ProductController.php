<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Product;
use Str;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('product.index');
    }
    public function pro_category_edit(Request $request){
        $sub_cat = Subcategory::where('cat_id', $request->id)->get();
        return response()->json($sub_cat);
        // return view('product.index');
    }
    public function product_save(Request $request){
        $request->validate([
            'file1' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        $imageName = time().'.'.$request->file1->extension();
        $request->file1->move(public_path('images'), $imageName);
        $product = new Product([
            'pro_name' => $request->input('pro_name'),
            'pro_des' => $request->input('pro_des'),
            'pro_cat' => $request->input('pro_cat_id'),
            'pro_sub_cat' => $request->input('pro_sub_cat'),
            'pro_fe_image' => $imageName,
            'pro_slug' => Str::slug($request->input('pro_name')),
        ]);
        $product->save();
        $success = "Product created Successfully";
        return response()->json($success);
    }

}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link href="{{ asset('assets/css/pricing-plan.css') }}" rel="stylesheet">
</head>
<body>
  <main>
    <div class="container">
      @if(\Session::has('error'))
<div class="alert alert-danger">{{ \Session::get('error') }}</div>
{{ \Session::forget('error') }}
@endif
@if(\Session::has('success'))
<div class="alert alert-success">{{ \Session::get('success') }}</div>
{{ \Session::forget('success') }}
@endif
      <h5 class="text-center pricing-table-subtitle">Subcription plan</h5>
    
      <div class="row">
       <div class="mx-auto col-10 col-md-8 col-lg-6">
          <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{route('processTransaction')}}">
             @csrf
              <div class="form-group">
                <label for="exampleFormControlInput1">Name</label>
                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" name="email"class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
              </div>
               <div class="form-group">
                <label for="exampleFormControlSelect1">Subcription date</label>
                <input name="date" type="date" class="form-control" id="exampleFormControlInput1" placeholder="Name">
              </div>
               <div class="form-group">
                <label for="exampleFormControlSelect1">Products</label>
                <select name="product_name" class="form-control" id="exampleFormControlSelect1">
                  <option vlaue="ebook">Ebook</option>
                  <option vlaue="ebook pro">Ebook pro</option>
                  <option value="ebook plus">Ebook plus</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Subcription type</label>
                <select name="subcription_plan" class="form-control" id="exampleFormControlSelect1">
                  <option vlaue="daily">Daily</option>
                  <option vlaue="week">Weekly</option>
                  <option value="month">Monthly</option>
                </select>
              </div>
               <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $('.pricing-plan-purchase-btn').on('click',function(e){

    e.preventDefault();
    var product_name = "demo123";
    $.ajax({
        method: 'post',
        url: "{{ route('processTransaction') }}",
        data: { product_name: product_name, _token:@json(csrf_token()) },
        success: function(result){
            console.log(result);
        },
        error: function(result){
            console.log(result);
        }
       });
});

  </script>
</body>
</html>

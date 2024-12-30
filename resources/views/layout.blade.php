<!DOCTYPE html>
<html>
<head>
    <title>Add to cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
    <style type="text/css">
        .dropdown{
            float:right;
            padding-right: 30px;
        }
        .dropdown .dropdown-menu{
            padding:20px;
            top:30px !important;
            width:350px !important;
            left:0px !important;
            box-shadow:0px 5px 30px black;
        }
        .dropdown-menu:before{
            content: " ";
            position:absolute;
            top:-20px;
            right:50px;
            border:10px solid transparent;
            border-bottom-color:#fff;
        }
        .fs-8{
            font-size: 13px;
        }
    </style>
</head>
<body>
 <div class="row">
    <div class="col-md-10">
    </div>
    <div class="col-md-1">
    <a href="/allproduct" class="btn btn-danger">Admin</a>
    </div>
    </div>
    
  
<div class="container">
    <div class="row navbar-light bg-light pt-2 pb-2">
    
    
        <div class="col-lg-10">
            <h3 class="mt-6" style="text-center;">Product Add to Cart</h3>
        </div>
        <div class="col-md-2 text-right main-section">
            <div class="dropdown">
                <button type="button" class="btn btn-info dropdown-toggle mt-1" data-bs-toggle="dropdown">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                </button>
                <div class="dropdown-menu">
                    <div class="row total-header-section">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                        </div>
                        @php $total = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                        @endforeach
                        <div class="col-md-6 text-end">
                            <p><strong>Total: <span class="text-info">&#8377;{{ $total }}</span></strong></p>
                        </div>
                    </div>
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            <div class="row cart-detail pb-3 pt-2">
                                <div class="col-lg-4 col-sm-4 col-4">
                                    <img src="/cover/{{ $details['cover'] }}" class="img-fluid" />
                                </div>
                                
                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                    <p class="mb-0">{{ $details['name'] }}</p>
                                    <span class="fs-8 text-info"> Price: ${{ $details['price'] }}</span> <br/>
                                    <span class="fs-8 fw-lighter"> Quantity: {{ $details['quantity'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="text-center">
                        <a href="{{ route('cart') }}" class="btn btn-info">View all</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-10 offset-md-1"> 
            @if(session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div> 
            @endif
          
            @yield('content')
        </div>
    </div>
</div>
  
@yield('scripts')
     
</body>


</html>
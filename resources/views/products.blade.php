@extends('layout')
   
@section('content') 
<div class="row mt-4">
    @foreach($products as $product)
        <div class="col-md-3">
            <div class="card text-center" style="height:100%">
                <img src="/cover/{{ $product->cover }}" alt="" class="card-img-top">
                    
               <div>
               </div>
               {{-- @foreach ($product->images as $img)
                <img src="/images/{{ $img->image }}" alt="" class="card-img-top">
                
                @endforeach --}}
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    </ol>
    <div class="carousel-inner">
       
        @foreach ($product->images as $key=> $img)
        <div class="carousel-item {{$key == 0 ? 'active' : '' }}" style="height:100px;">
            <img src="/images/{{ $img->image }}" class="d-block w-100"  alt="..."> 
             {{-- <img src="/images/{{ $img->image }}" alt="" class="card-img-top"> --}}
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
                

                <div class="caption card-body">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <p><strong>Price: </strong> &#8377; {{ $product->price }}</p>
                    <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
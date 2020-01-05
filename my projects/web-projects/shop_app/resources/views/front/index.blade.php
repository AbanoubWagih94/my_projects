@extends('front.layouts.master')

@section('content')
    <header class="jumbotron my-4">
        <h5 class="display-3"><strong>Welcome,</strong></h5>
        <p class="display-4"><strong>SALE UPTO 50%</strong></p>
        <p class="display-4">&nbsp;</p>
        <a href="#" class="btn btn-warning btn-lg float-right">SHOP NOW!</a>
    </header>
    @if(session()->has('msg'))
        <div class="alert alert-success">{{ session()->get('msg') }}</div>
    @endif
    <div class="row text-center mb-4">
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ url('/uploads/'.$product->image_url) }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                    <div class="card-footer">
                        <Strong>${{ $product->price }}</Strong>
                        <form action="{{ route('cart.store') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <button type="submit" class="btn btn-primary btn-outline-dark">
                                <i class="fa fa-cart-plus"></i>Add To Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
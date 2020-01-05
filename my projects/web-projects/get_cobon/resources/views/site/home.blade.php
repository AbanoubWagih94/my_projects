@extends('site.layouts.app')
@section('title', 'Home')

@section('extra_links')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')

<div class="container content-item" style="text-align:center;">
    <h3 style="text-align:left;">Offers of the day</h3>
    <div class="container-fluid items">
    @foreach ($newOffers as $newOffer)
        <div class="col-sm-6" style="padding:20px; padding-top:50px;">
            <div class="offer" style="width:85%;">
                <a href="{{route('offer', ['id'=>$newOffer->id])}}">
                    <img src="{{asset($newOffer->images[0]->path)}}" class='coupon-image'>
                </a>
                <div class ="content-item_footer row">
                    <h4 style="color:white; padding:0; margin:0; padding-left:5;"> 
                        <a style="color:white; text-decoration:none;" href=""> {{$newOffer->title}} </a> 
                    </h4>
                    <div class="content-item_left" >
                        <h4>{{$newOffer->buying_count}} Times</h4>
                        <div class="row">
                            <div class="col-sm-6">Rate:</div>
                            <div class="col-sm-6">{{$newOffer->vote_sum/($newOffer->voters?$newOffer->voters:1)}}</div>
                        </div>
                    </div>
                    <div class="content-item_right">
                        <h4 style="text-align:center;text-decoration:line-through;">{{$newOffer->main_price}}LE</h4>
                        <h4 style="text-align:center;">{{$newOffer->offer_price}}LE</h4>
                    </div>
                </div>            
            </div>
        </div>
    @endforeach
    </div>
    <br><hr>
    <h3 style="text-align:left;">Top Sales</h3>
    <div class="container-fluid items">
    @foreach($hotOffers as $hotOffer)
        <div class="col-sm-4" style="padding:20px; padding-top:50px;">
            <div class="offer" style="width:85%;">
                <a href="{{route('offer', ['id'=>$hotOffer->id])}}">    
                    <img src="{{asset($hotOffer->images[0]->path)}}" class='coupon-image' alt="Norway">
                </a>
                <div class ="content-item_footer row">
                    <h4 style="color:white; padding:0; margin:0; padding-left:5;"> 
                        <a style="color:white; text-decoration:none;" href=""> {{$hotOffer->title}} </a> 
                    </h4>
                    <div class="content-item_left">
                        <h4>{{$hotOffer->buying_count}}</h4>
                        <div class="row">
                            <div class="col-sm-6">Rate</div>
                            <div class="col-sm-6">{{$hotOffer->vote_sum/($hotOffer->voters?$hotOffer->voters:1)}}</div>
                        </div>
                    </div>
                    <div class="content-item_right">
                        <h4 style="text-align:center;text-decoration:line-through;">{{$hotOffer->main_price}}LE</h4>
                        <h4 style="text-align:center;">{{$hotOffer->offer_price}}LE</h4>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection
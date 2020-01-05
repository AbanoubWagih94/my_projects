@extends('site.layouts.app')
@section('title', 'Offers')

@section('extra_links')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <form class="form-group" role="search" style="width:100%;">
        <div class="input-group" style="width:90%; margin:auto auto; display:block;">
                <input type="text" data-toggle="modal" data-target="#myModal" class="form-control" placeholder="Filter" name="filter-term" id="filter-term">
                <button class="btn btn-default" id="filter-action">
                    <i class="glyphicon glyphicon-filter"></i>
                </button>
        </div>
    </form>
</div>

<div class="container content-item" style="text-align:center;">

    <h3 style="text-align:left;">Top Offers</h3>
    <div class="container-fluid items">
    @foreach($offers as $offer)
        <div class="col-sm-4" style="padding:20px; padding-top:50px;">
            <div class="offer" style="width:95%;">
                <a href="{{route('offer', ['id'=>$offer->id])}}">    
                    <img src="{{asset($offer->images[0]->path)}}" class='coupon-image' alt="Norway">
                </a>
                <div class ="content-item_footer row">
                    <h4 style="color:white; padding:0; margin:0; padding-left:5;"> 
                        <a style="color:white; text-decoration:none;" href=""> {{$offer->title}} </a> 
                    </h4>
                    <div class="content-item_left">
                        <h4>{{$offer->buying_rate}} Times</h4>
                        <div class="row">
                            <div class="col-sm-6">Rate</div>
                            <div class="col-sm-6">{{$offer->vote_sum/($offer->voters?$offer->voters:1)}}</div>
                        </div>
                    </div>
                    <div class="content-item_right">
                        <h4 style="text-align:center;text-decoration:line-through;">{{$offer->main_price}}LE</h4>
                        <h4 style="text-align:center;">{{$offer->offer_price}}LE</h4>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
<?php echo $offers->render(); ?>
@endsection


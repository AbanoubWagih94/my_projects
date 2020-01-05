@php
    $rate = round($offer->vote_sum / ($offer->voters?$offer->voters:1), 1);
@endphp

@extends('site.layouts.app')
@section('title', 'offer')

@section('extra_links')
    <link rel="stylesheet" href="{{asset('css/offer.css')}}">
    <script>
        $(document).ready(function() {
            var offerId = {{$offer->id}};
            var cartItems = JSON.parse(localStorage.getItem('cartItems'));
            if(cartItems){
                var found = false;
                for(var i = 0; i < cartItems.length; i++){
                    if(cartItems[i].id == offerId){
                        $('#add-to-cart').attr('disabled', true);
                        $('#add-to-cart').html('In Cart');
                    }
                }
                return false;
            } else {
                return false;
            }
        });
    </script>
@endsection

@section('content')
<div class="container" id="coupon_details">
        <h2 style="text-align:center;">{{$offer->title}}</h2> 
        <hr style="width:200px;">
    <div class="row">
        <div class="col-sm-8" style="text-align:left;">
            <img src="{{asset($offer->images[0]->path)}}" style="width:100%;"> 
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-3">
            <br>
            <fieldset class="rating" style="padding-left:15px;">
                        <input type="radio" onclick="rate(5, {{$offer->id}}, 'offer')" id="star5" name="rating" value="5" {{$rate == 5?'checked':''}} /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" onclick="rate(4.5, {{$offer->id}}, 'offer')" id="star4half" name="rating" value="4.5" {{$rate == 4.5?'checked':''}} /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                        <input type="radio" onclick="rate(4, {{$offer->id}}, 'offer')" id="star4" name="rating" value="4" {{$rate == 4?'checked':''}}/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" onclick="rate(3.5, {{$offer->id}}, 'offer')" id="star3half" name="rating" value="3.5" {{$rate == 3.5?'checked':''}}/><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                        <input type="radio" onclick="rate(3, {{$offer->id}}, 'offer')" id="star3" name="rating" value="3" {{$rate == 3?'checked':''}}/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" onclick="rate(2.5, {{$offer->id}}, 'offer')" id="star2half" name="rating" value="2.5" {{$rate == 2.5?'checked':''}}/><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                        <input type="radio" onclick="rate(2, {{$offer->id}}, 'offer')" id="star2" name="rating" value="2" {{$rate == 2?'checked':''}}/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" onclick="rate(1.5, {{$offer->id}}, 'offer')" id="star1half" name="rating" value="1.5" {{$rate == 1.5?'checked':''}}/><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                        <input type="radio" onclick="rate(1, {{$offer->id}}, 'offer')" id="star1" name="rating" value="1" {{$rate == 1?'checked':''}}/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <input type="radio" onclick="rate(0.5, {{$offer->id}}, 'offer')" id="starhalf" name="rating" value="0.5" {{$rate == 0.5?'checked':''}}/><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
            </fieldset>
            <br>
            <table>
                <tr>
                    <td class="glyphicon glyphicon-ok-circle" title="buying times"></td>
                    <td> {{$offer->buying_count}} Times</td>
                </tr>
                <tr>
                    <td class="glyphicon glyphicon-time" title="ends at"></td>
                    <td>{{$offer->end_date}}</td>
                </tr>
            </table>
            <br>
            <div class="container-fluid">
                @if(Auth::user())
                    <button class="btn btn-danger btn-lg" id="add-to-cart" onclick="addToCart({{$offer}})"> Add to Cart </button>
                @endif
                @if(!Auth::user())
                    <a class="btn btn-danger btn-lg" style="background-color: #c0272c;" id="add-to-cart" href="{{route('login')}}"> Add to Cart </a>
                @endif
            </div>

            <div>
                <div class="col-xs-6 col-md-6 col-sm-7"><h3 style="text-decoration: line-through">{{$offer->main_price}}LE</h3></div>
                <div class="col-xs-6 col-md-6 col-sm-6"><h3 style="font-weight:bold; color:#c0272c;">{{$offer->offer_price}}LE</h3></div>
            </div>
            <div class="container-fluid">
                <h3 style="font-weight:bold; color:#c0272c; font-size:35px;">{{round((($offer->offer_price-$offer->main_price)/$offer->main_price)*100, 0).'%'}}</h3>
            </div>
        </div>
    </div>
    <hr><hr>
    <div class="container-fluid">
        <h3 style="color:#c0272c;font-weight:bold;">Another info</h3>
        <p style="font-size:18">
            {{$offer->description}}
        </p>
    </div>
    <hr>
    <div class="container-fluid">
        <h3 style="color:#c0272c;font-weight:bold;">Photos</h3>
        <div class="row">
            <div class="row">
                <div class="col-md-12">
                <div class="carousel slide multi-item-carousel" id="theCarousel">
                    <div class="carousel-inner">
                    @foreach($offer->images as $index=>$img)
                    <div class="item {{$index == 0? 'active':''}}">
                        <div class="col-xs-12 col-sm-6 col-md-4"><a href="#1"><img src="{{asset($img->path)}}" style="wdith:100%;padding:10px;" class="img-responsive"></a></div>
                    </div>
                    @endforeach
                    <!-- add  more items here -->                                 
                    </div>
                    <a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#theCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/crous.js')}}"></script>
<script>
    var cartItems = JSON.parse(localStorage.getItem('cartItems'));
    function addToCart(offer) {
        if(cartItems){
            cartItems.push(offer);
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
        }else{
            localStorage.setItem('cartItems', JSON.stringify([offer]));
        }
        $('#add-to-cart').attr('disabled', true);
        $('#add-to-cart').html('In Cart');
    }

</script>
@endsection
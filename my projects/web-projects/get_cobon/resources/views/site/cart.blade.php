@extends('site.layouts.app')
@section('title', 'Offers')

@section('extra_links')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <script>
        $(document).ready(function (){
            var cartItems = JSON.parse(localStorage.getItem('cartItems'));
            if(cartItems) {
               var template = '';
                for(var i = 0; i < cartItems.length; i++) {
                   template += '<div class="col-sm-4" style="padding:20px; padding-top:50px;">'+
                   '<a href="/offer/'+cartItems[i].id+'">'+  
                        '<img src="'+cartItems[i].images[0].path+'" class="coupon-image" alt="Norway">'+
                    '</a>'+
                    '<div class ="content-item_footer">'+
                        '<h4 style="color:white; padding:0; margin:0; padding-left:5;">'+ 
                            '<a style="color:white; text-decoration:none;" href="">'+cartItems[i].title+'</a>'+
                        '</h4>'+
                        '<div class="content-item_left">'+
                            '<h4>'+cartItems[i].buying_count+' Times</h4>'+
                            '<div class="row">'+
                                '<div class="col-sm-6">Ends At:</div>'+
                                '<div class="col-sm-6">'+cartItems[i].end_date+'</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="content-item_right">'+
                            '<h4 style="text-align:center;text-decoration:line-through;">'+cartItems[i].main_price+'LE</h4>'+
                            '<h4 style="text-align:center;">'+cartItems[i].offer_price+'LE</h4>'+
                        '</div>'+
                    '</div>'+
                '</div>'
                }
                $('#cart').html(template);
            }
        });
    </script>
@endsection

@section('content')

<div class="container content-item" style="text-align:center;">

    <h3 style="text-align:left;">My cart</h3>
    <div class="container-fluid items" id="cart" onload="getCartItems">

    </div>
</div>
@endsection


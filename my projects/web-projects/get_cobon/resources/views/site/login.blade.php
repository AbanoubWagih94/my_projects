@extends('site.layouts.app')
@section('title', 'Login')

@section('extra_links')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')
<div class="container-fluid" style="text-align:center">
    <img src="{{asset('images/full_logo_red.png')}}" style="width:300px;"> 
</div>
<br>
<div class="container-fluid">
    <div class="col-md-3 col-sm-2"></div>
    <div class="col-md-6 col-sm-8 logging">
        <div class="row text-center">
            <div class="col-xs-6 log_div" id="l1"><h2 style="padding: 8px;font-weight: bold;">Log in</h2></div>
            <div class="col-xs-6 log_div" id="l2"><h2 style="padding: 8px;font-weight: bold;">Sign up</h2></div>        
        </div>
        <div class="row" style="padding-top:15px; padding-bottom:15px;">
            <div class="col-xs-2"></div>
            <div class="col-xs-8">
                <form id="fl1"  method="POST" action="{{route('login')}}">             <!-- Login form-->
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger pull-right pull-top">Log in</button>
                        <!-- <a href="">forgot your password?</a> <br> -->
                    </div>
                </form>
                <form id="fl2" method="POST" action="{{route('register')}}">             <!-- Sign up form-->
                {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="fname">First name:</label>
                            <input type="text" class="form-control" id="fname" placeholder="ex: john" name="first_name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lname">Last name:</label>
                            <input type="text" class="form-control" id="lname" placeholder="ex: wick" name="last_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email_s">Email:</label>
                        <input type="email" class="form-control" id="email_s" placeholder="ex: abcd@gmail.com" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password_s">Password:</label>
                        <input type="password" class="form-control" id="password_s" placeholder="use strong password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_s_r">Confirm password:</label>
                        <input type="password" class="form-control" id="password_s_r" placeholder="re-type password" name="password_r" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger pull-right">Sign up</button>
                    </div>
                </form>
            </div>
            <div class="col-xs-2"></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-2"></div>
</div>
<script >
    jQuery(document).ready(function(){
    show_div('#fl1','#fl2','#l1','#l2')                             //set login to default start page
    jQuery('#l1').click(function() {
        show_div('#fl1','#fl2','#l1','#l2');
    });
    jQuery('#l2').click(function(){
        show_div('#fl2','#fl1','#l2','#l1');
    });
   function show_div(to_show, to_hide, is_clicked, not_clicked){    //toggle forms
        $(is_clicked).addClass('selected');                         //mark selected div identicator
        $(not_clicked).removeClass('selected');                     //unmark unselected div identicator
        $(to_show).css('display', 'block');                         //show selected div
        $(to_hide).css('display', 'none');                          //hide selected div
   }
});
</script>
@endsection
<!DOCTYPE html>
<html lang="en" >
    <head>
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon-->
        <link rel="shortcut icon" href="{{ asset('assets/img/fav.png') }}">
        <!-- Author Meta -->
        <meta name="author" content="Abanoub WAgih">
        <!-- Meta Description -->
        <meta name="description" content="Chef Profile">
        <!-- Meta Keyword -->
        <meta name="keywords" content="Chef">
        <!-- meta character set -->
        <meta charset="UTF-8">
        <!-- Site Title -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Sudqi Naddaf</title>

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700,900" rel="stylesheet">

        <!--
			CSS
			============================================= -->
        <link rel="stylesheet" href="{{ asset('assets/css/linearicons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    </head>
    <body>
    <div class="preloader-area">
    <div class="loader-box">
        <div class="loader"></div>
    </div>
    </div>

        @yield('header')
        @yield('content')
        @include('website.layouts.footer')
        @include('website.layouts.scripts')
        @yield('footerScripts')
    </body>
</html>
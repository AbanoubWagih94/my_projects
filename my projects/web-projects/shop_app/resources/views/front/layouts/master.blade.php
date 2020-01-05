<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Home</title>
        <link rel="icon" type="image/ico" href="{{ url('favicon.ico') }}" sizes="96*96" />
        <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}" />
        <!--<link rel="stylesheet" href="{{ url('assets/css/heroic-features.css') }}" />-->

        <link rel="stylesheet" href="{{ url('assets/css/main.css') }}" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
              integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
        @yield('style')
    </head>
    <body>
        <div class="wrapper">
            @extends('front.layouts.navbar')

            <div class="container">
                <div class="content">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript -->
        <script src="{{ url('assets/bootstrap/js/jquery-3.3.1.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        @yield('script')
    </body>
</html>
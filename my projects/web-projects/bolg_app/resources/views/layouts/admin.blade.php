<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="X-UA-Compatible" content="IE=edge, chrome=1" />
        <meta name="viewport" content="width= device-width, initial-scale=1.0" />
        <meta name="author" content="abanoub wagih" />
        <meta name="description" content="Blog" />

        <title>Admin</title>
        <link rel="icon" type="image/ico" href="{{ url('blog.png') }}"  sizes="160*160"/>
        <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('css/main.css') }}">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
              integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
        @yield('styles')
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <div class="navbar-brand">
                    <img src="{{ url('blog.png') }}" height="40px" >
                    <a class="text-white" href="#">Blog</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                 </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link  text-white" href="/"><i class="fa fa-home"></i> Home</a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="nav-item ">
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-gear"></i> Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="admin-wrapper">
            <div id="sidebar">
                @include('layouts.sideBar')
            </div>
            <div  id="main-panel">
                <div class="container">
                    <hr>
                    @yield('content')
                </div>
            </div>
        </div>

        <script src="{{ url('bootstrap/js/jquery-3.3.1.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>
        @yield('footer')

    </body>
</html>
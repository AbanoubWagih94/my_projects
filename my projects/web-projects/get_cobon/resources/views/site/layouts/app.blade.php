<html>
    <head>
        <title>Get Coupon - @yield('title')</title>
        <link rel="shortcut icon" href="{{asset('images/logo_red.png')}}">    
        <link rel="icon" href="{{asset('images/logo_red.png')}}">    
        <meta name="viewport" content="width=device-width,initial-scale=1" charset="UTF-8">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/base.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <script src="https://use.fontawesome.com/a6ec7a9d7d.js"></script>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>

        @yield('extra_links')
        
    </head>
    <body>
        <nav class="navbar navbar-default" style="position:sticky;top:0; width:100%; z-index:2000;">
            <div class="container-fluid" id="nav_st">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @if(!Auth::user())
                    <button class="dropdown navbar-toggle" style="border:0; padding-top:7px;">
                        <a id="flls" href="{{route('login')}}" class="{{Request::path() == 'login'?'active':''}}">Login</a>
                    </button>
                    @endif
                    @if(Auth::user())
                    <button class="dropdown navbar-toggle" style="border:0; padding:0;">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">
                        <i class="fa fa-user-circle"  id="user_mini" style="font-size:35;" aria-hidden="true"></i> 
                        </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Settings</a></li>
                            <li><a href="{{route('cart')}}">Cart</a></li>
                            <li class="{{route('logout')}}"></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                        </button>
                    @endif
                    <a class="navbar-brand" href="{{route('home')}}"> 
                        <img src="{{asset('images/full_logo_red.png')}}" style="height:50px; margin-top:-15px;">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="{{route('home')}}" class="{{Request::path() == '/'?'active':''}}">Home</a></li>
                        <li><a href="{{route('offers')}}" class="{{Request::path() == 'offers'?'active':''}}">Offers</a></li>
                        <li><a href="{{route('vendors')}}" class="{{Request::path() == 'vendors'?'active':''}}">Vendors</a></li>
                    </ul>
                    <div class="col-sm-4 col-md-5 pull-right" style="padding-top:7px;">
                    <div class="dropdown pull-right"  id="user_big" style="border:0; padding:0;">
                        @if(Auth::user())
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">
                        <i class="fa fa-user-circle"  id="user_mini" style="font-size:35;" aria-hidden="true"></i> 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">Cart</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                        @endif
                        @if(!Auth::user())
                        <div style="padding-top:5px;">
                            <a id = "fll" href="{{route('login')}}" class="{{Request::path() == 'login'?'active':''}}">Login</a>
                        </div>
                        @endif
                    </div>
                    <form class="navbar-search col-md-7 col-sm-8 pull-right" role="search">
                        <div class="input-group pull-left">
                            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" style="height:35px">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit" style="height:35px;"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </nav>
        @if ($errors->any())
            {!! implode('', $errors->all('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>:message</div>')) !!}
        @endif

        @if(session('error'))
        <div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{session('error')}}</div>
        @endif

        @if(session('success'))
        <div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{session('success')}}</div>
        @endif

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <form name="form" method="GET">
        @if(Request::path() != 'vendors')
            <select name="city">
                <option value="" disabled selected>Select a city</option>
                @foreach(session('cities') as $city)
                    <option value="{{$city['id']}}">{{$city['name']}}</option>
                @endforeach
            </select>
        @endif
            <select name="category">
                <option value="" disabled selected>Select a category</option>
                @foreach(session('categories') as $category)
                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                @endforeach
            </select>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" >Submit</button>
      </div>
    </div>
    </form>
  </div>
</div>

        <div id="content" class="container-fluid">
            @yield('content')
        </div>
        <br>
        <footer class="container-fluid footer text-center">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-2">
                    <img src="{{asset('images/logo_white.png')}}" style="width:90px;">
                </div>
                <div class="col-sm-2" style="">
                        <h4 style="font-weight:bold">2017 GET YOUR COUPON</h4>
                        <p>All rights reserved to copoun company.</p>
                </div>
                <div class="col-sm-2">
                        <h4 style="font-weight:bold">Company</h4>
                            <a href="">Free jobs</a> <br>
                            <a href="">About us</a> <br>
                            <a href="">Contact us</a>
                </div>
                <div class="col-sm-3"></div>
        </footer>
        
        <script type="text/javascript">
            function rate(rate, id, route_name) {
                $.ajax(
                    {
                        url: '/api/'+route_name+'/'+id+'/rate/'+rate, 
                        type: 'PUT', 
                        success: function(result) {
                            console.log(result);
                        }
                    }
                );
            }
        </script>
    </body>
</html>
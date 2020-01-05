<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">Home Shop</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive" aria-expanded="true" aria-controls="navbarResponsive" aria-label="Toggle navigation">
            <i class="navbar-toggler-icon"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i> Cart
                        @if(Cart::instance('default')->count() > 0)
                            <strong>({{ Cart::instance('default')->count() }})</strong>
                        @endif
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> {{ auth()->check()? auth()->user()->name : 'Account' }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                        @if(!auth()->check())
                            <a class="dropdown-item " href="{{ url('/user/login') }}">Sign In</a>
                            <a class="dropdown-item" href="{{ url('/user/register') }}">Sign Up</a>
                        @else
                            <a class="dropdown-item" href="{{ url('/user/profile') }}">Profile</a>
                            <a class="dropdown-item" href="{{ url('/user/logout') }}">Logout</a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
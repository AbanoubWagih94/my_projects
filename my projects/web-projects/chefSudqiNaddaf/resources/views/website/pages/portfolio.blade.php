@extends('website.layouts.app')

@section('header')
    <header id="header" class="dark">
        <div class="container main-menu">
            <div class="row align-items-center d-flex">
                <div id="logo">
                    <a href="index.html"><img src="{{ asset('assets/img/logo2.png') }}" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container" class="ml-auto">
                    <ul class="nav-menu white">
                        <li class=""><a href="{{ url('/') }}">Home</a></li>
                        <li><a  href="{{ url('/about') }}">About</a></li>
                        <li><a class="active" href="{{ url('/portfolio') }}">Portfolio</a></li>
                        <li>
                            <a href="{{ url('/contact') }}">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <!-- start banner Area -->
    <section class="banner-area relative">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Portfolio
                    </h1>
                    <p class="link-nav">
						<span class="box">
							<a href="{{ url('/') }}">Home </a>
                            <a href="{{ url('/portfolio') }}">Portfolio</a>
                        </span></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start Work Area Area -->
    <section class="work-area section-gap-top section-gap-bottom-90" id="work">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-end mb-80">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h2>Latest Works</h2>
                        <!--<p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see
                            some for as low as $.17 each.</p>-->
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="filters">
                        <ul>
                            <li class="active" data-filter=".all">All Categories</li>
                            <li data-filter=".branding">Branding</li>
                            <li data-filter=".creative">Creative Work</li>
                            <li data-filter=".web-design">Clean Food</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="filters-content">
                <div class="row grid">
                    <div class="single-work col-lg-4 col-md-6 col-sm-12 all creative wow fadeInUp" data-wow-duration="2s">
                        <div class="relative">
                            <div class="thumb">
                                <div class="overlay overlay-bg"></div>
                                <img class="image img-fluid" src="{{ asset('assets/img/work/w1.png') }}" alt="">
                            </div>
                            <div class="middle">
                                <h4>Octopus in Style with red Cabbage </h4>
                                <div class="cat">Food Photo</div>
                            </div>
                            <a class="overlay" href="portfolio-details.html"></a>
                        </div>
                    </div>
                    <div class="single-work col-lg-4 col-md-6 col-sm-12 all web-design branding wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                        <div class="relative">
                            <div class="thumb">
                                <div class="overlay overlay-bg"></div>
                                <img class="image img-fluid" src="{{ asset('assets/img/work/w2.png') }}" alt="">
                            </div>
                            <div class="middle">
                                <h4>Colorful Heirloom Tomato Salad</h4>
                                <div class="cat">Food Photo</div>
                            </div>
                            <a class="overlay" href="portfolio-details.html"></a>
                        </div>
                    </div>
                    <div class="single-work col-lg-4 col-md-6 col-sm-12 all branding web-design wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
                        <div class="relative">
                            <div class="thumb">
                                <div class="overlay overlay-bg"></div>
                                <img class="image img-fluid" src="{{ asset('assets/img/work/w3.png') }}" alt="">
                            </div>
                            <div class="middle">
                                <h4>Lamb Chops with beetroots and sour Cherry</h4>
                                <div class="cat">Food Photo</div>
                            </div>
                            <a class="overlay" href="portfolio-details.html"></a>
                        </div>
                    </div>
                    <div class="single-work col-lg-4 col-md-6 col-sm-12 all web-design wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.6s">
                        <div class="relative">
                            <div class="thumb">
                                <div class="overlay overlay-bg"></div>
                                <img class="image img-fluid" src="{{ asset('assets/img/work/w6.png') }}" alt="">
                            </div>
                            <div class="middle">
                                <h4>Cauliflower and Romanesco tajin with Tahina</h4>
                                <div class="cat">Food Photo</div>
                            </div>
                            <a class="overlay" href="portfolio-details.html"></a>
                        </div>
                    </div>
                    <div class="single-work col-lg-4 col-md-6 col-sm-12 all creative wow fadeInUp" data-wow-duration="2s">
                        <div class="relative">
                            <div class="thumb">
                                <div class="overlay overlay-bg"></div>
                                <img class="image img-fluid" src="{{ asset('assets/img/work/w4.png') }}" alt="">
                            </div>
                            <div class="middle">
                                <h4>Shanklish with Yellow Zucchini and Pumpkin fluid </h4>
                                <div class="cat">Food Photo</div>
                            </div>
                            <a class="overlay" href="portfolio-details.html"></a>
                        </div>
                    </div>
                    <div class="single-work col-lg-4 col-md-6 col-sm-12 all branding wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                        <div class="relative">
                            <div class="thumb">
                                <div class="overlay overlay-bg"></div>
                                <img class="image img-fluid" src="{{ asset('assets/img/work/w5.png') }}" alt="">
                            </div>
                            <div class="middle">
                                <h4>Arabic Tartare in the Cloud</h4>
                                <div class="cat">Food Photo</div>
                            </div>
                            <a class="overlay" href="portfolio-details.html"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Work Area Area -->


    @include('website.layouts.contact')
@endsection
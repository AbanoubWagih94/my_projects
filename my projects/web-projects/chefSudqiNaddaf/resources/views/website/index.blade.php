@extends('website.layouts.app')

@section('header')
    <header id="header">
        <div class="container main-menu">
            <div class="row align-items-center d-flex">
                <div id="logo">
                    <a href="index.html"><img src="{{ asset('assets/img/logo.png') }}" alt="Can't load image" title=""/></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class=""><a class="active" href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/about') }}">About</a></li>
                        <li><a href="{{ url('/portfolio') }}">Portfolio</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <!-- start banner Area -->
    <section class="home-banner-area">
        <div class="container">
            <div class="row fullscreen d-flex align-items-center">
                <div class="banner-content col-lg-6 col-md-12 justify-content-center ">
                    <div class="me wow fadeInDown" data-wow-duration="1s" data-wow-delay="1.2s">It's me</div>
                    <h1 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.7s" style="font-size: 3em;">Sudqi Naddaf | صدقي نداف</h1>
                    <div class="designation mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.1s">
                        Menu
                        <span class="designer">Development</span>
                        and Food
                        <span class="developer">creative</span>
                    </div>
                </div>
                <div class="banner-img col-lg-6 col-md-6 align-self-end">
                    <img class="img-fluid" src="{{ asset('assets/img/bk.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start About Area -->
    <section class="about-area section-gap">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 about-left">
                    <img class="img-fluid" src="{{ asset('assets/img/about.png') }}" alt="">
                </div>
                <div class="col-lg-5 col-md-12 about-right">
                    <div class="section-title">
                        <h2>about myself</h2>
                    </div>
                    <div class="mb-50 wow fadeIn" data-wow-duration=".8s">
                        <p>
                            I'm Jordanian, live in UAE, Chef At Kempinski Hotel and 4 Times Chef of the year Middle East
                        </p>

                    </div>
                    <a href="#" class="primary-btn white" data-text="More Info">
                        <span>M</span>
                        <span>o</span>
                        <span>r</span>
                        <span>e</span>
                        <span> </span>
                        <span>I</span>
                        <span>n</span>
                        <span>f</span>
                        <span>o</span>
                    </a>
                    <a href="#" class="primary-btn" data-text="Resume">
                        <span>R</span>
                        <span>e</span>
                        <span>s</span>
                        <span>u</span>
                        <span>m</span>
                        <span>e</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->
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
                            <a class="overlay" ></a>
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
                            <a class="overlay" ></a>
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
                            <a class="overlay" ></a>
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
                            <a class="overlay" ></a>
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
                            <a class="overlay" ></a>
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
                            <a class="overlay" ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Work Area Area -->

    <!-- Start Job History Area Area -->
    <section class="job-area section-gap-top section-gap-bottom-90">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Job History</h2>
                        <!--<p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see
                            some for as low as $.17 each.</p>-->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="single-job">
                        <div class="top-sec d-flex justify-content-between">
                            <div class="top-left">
                                <h4>Executive Chef</h4>
                                <p> Kempinski Hotel, Mall Of The Emirates</p>
                            </div>
                            <div class="top-right">
                                <a href="#" class="primary-btn" data-text="Jul '15 to Present">
                                    <span>J</span><span>u</span><span>l</span>
                                    <span>'</span><span>1</span><span>5</span>
                                    <span>t</span><span>o</span>
                                    <span>P</span><span>r</span><span>e</span><span>s</span><span>e</span><span>n</span><span>t</span>
                                </a>
                            </div>
                        </div>
                        <div class="bottom-sec wow fadeIn" data-wow-duration="2s">
                            All users on MySpace will know that there are millions of people out there. Every day besides. All users on My will know
                            that there are millions of people out of the field there.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="single-job">
                        <div class="top-sec d-flex justify-content-between">
                            <div class="top-left">
                                <h4>Executive Chef</h4>
                                <p> Kempinski Hotel, Mall Of The Emirates</p>
                            </div>
                            <div class="top-right">
                                <a href="#" class="primary-btn" data-text="Jul '15 to Present">
                                    <span>J</span><span>u</span><span>l</span>
                                    <span>'</span><span>1</span><span>5</span>
                                    <span>t</span><span>o</span>
                                    <span>P</span><span>r</span><span>e</span><span>s</span><span>e</span><span>n</span><span>t</span>
                                </a>
                            </div>
                        </div>
                        <div class="bottom-sec wow fadeIn" data-wow-duration="2s" data-wow-delay="0.2s">
                            All users on MySpace will know that there are millions of people out there. Every day besides. All users on My will know
                            that there are millions of people out of the field there.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="single-job">
                        <div class="top-sec d-flex justify-content-between">
                            <div class="top-left">
                                <h4>Executive Chef</h4>
                                <p> Kempinski Hotel, Mall Of The Emirates</p>
                            </div>
                            <div class="top-right">
                                <a href="#" class="primary-btn" data-text="Jul '15 to Present">
                                    <span>J</span><span>u</span><span>l</span>
                                    <span>'</span><span>1</span><span>5</span>
                                    <span>t</span><span>o</span>
                                    <span>P</span><span>r</span><span>e</span><span>s</span><span>e</span><span>n</span><span>t</span>
                                </a>
                            </div>
                        </div>
                        <div class="bottom-sec wow fadeIn" data-wow-duration="2s" data-wow-delay="0.4s">
                            All users on MySpace will know that there are millions of people out there. Every day besides. All users on My will know
                            that there are millions of people out of the field there.
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="single-job">
                        <div class="top-sec d-flex justify-content-between">
                            <div class="top-left">
                                <h4>Executive Chef</h4>
                                <p> Kempinski Hotel, Mall Of The Emirates</p>
                            </div>
                            <div class="top-right">
                                <a href="#" class="primary-btn" data-text="Jul '15 to Present">
                                    <span>J</span><span>u</span><span>l</span>
                                    <span>'</span><span>1</span><span>5</span>
                                    <span>t</span><span>o</span>
                                    <span>P</span><span>r</span><span>e</span><span>s</span><span>e</span><span>n</span><span>t</span>
                                </a>
                            </div>
                        </div>
                        <div class="bottom-sec wow fadeIn" data-wow-duration="2s" data-wow-delay="0.6s">
                            All users on MySpace will know that there are millions of people out there. Every day besides. All users on My will know
                            that there are millions of people out of the field there.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Job Historyt Area Area -->
    @include('website.layouts.contact')
@endsection

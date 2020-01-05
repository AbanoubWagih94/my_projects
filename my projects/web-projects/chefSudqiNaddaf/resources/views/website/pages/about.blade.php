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
                        <li><a class="active" href="{{ url('/about') }}">About</a></li>
                        <li><a href="{{ url('/portfolio') }}">Portfolio</a></li>
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
                        About Us
                    </h1>
                    <p class="link-nav">
						<span class="box">
							<a href="{{ url('/') }}">Home </a>
                            <a href="{{ url('/about') }}">About</a>
                        </span></p>
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
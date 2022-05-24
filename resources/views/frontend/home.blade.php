@extends('layouts.pages.app')

@section('title', ucwords(isset($page->title) ? $page->title : 'Home'))

@section('header')
@php
    $settings = getSettings()->toArray();
@endphp
<header id="home" class="hero-area2">
    <div class="overlay-light"></div>
    <div class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{ route('homepage') }}">
                            <img src="{{ getLogo() }}" class="logo-image" alt="Landing Page">{{--env(ADMIN_URL)--}}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="page-scroll" href="{{ route('homepage')}}#home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{ route('homepage')}}#light-featured">About</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="page-scroll" href="#features2">Services</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#screenshots">Templates</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{ route('homepage')}}#pricing2">Pricing</a>
                                </li>
                                @if(count($testimonials))
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{ route('homepage')}}#client-talk">Testimonials</a>
                                </li>
                                @endif
                                {{-- <li class="nav-item">
                                    <a class="page-scroll" href="#team2">Team</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#blog2">Blog</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{ route('homepage')}}#contact2">Contact</a>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="btn btn-light-singin dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Get Started
                                      </button>
                                      <div class="dropdown-menu ml-5">
                                        <a class="dropdown-item text-dark" href="{{ route('register') }}">Register</a>
                                        <div class="dropdown-divider text-dark"></div>
                                        <a class="dropdown-item text-dark" href="{{route('login')}}">Login</a>
                                      </div>
                                    {{-- <a class="btn btn-light-singin" href="{{route('login')}}">Get Started</a> --}}
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="home">
        <div class="container">
            <div class="row space-100 align-items-center">
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="contents">
                        <h2 class="head-title">Create beautiful landing pages, easily.  </h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab dolores ea fugiat nesciunt
                            quisquam.</p>
                        {{-- <form class="subsribe-input">
                            <div class="form-group form-subsribe">
                                <input type="email" class="form-control" name="email"
                                    placeholder="Enter Your Email">
                                <button type="submit" class="btn btn-light-bg btn-subsribe">Free Trial</button>
                            </div>
                        </form>
                        <p class="para">*No Credit Card Required</p> --}}
                        <a class="btn btn-light-singin ml-0 mt-4" href="{{route('register')}}">Get Started</a>

                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-xs-12 p-0">
                    <div class="intro-img">
                        <img src="{{asset('frontend/img/landing-page-animate.svg')}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection
@section('content')

<section id="" class="section  pb-0 mb-0">    

    <section id="light-featured">
        <div class="container">

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 pr-0 text-center">
                    <div class="right-feature-info">
                        <h3>Our Solutions</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore
                            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut
                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                            esse
                            cillum dolore eu fugiat nulla pariatur. <br> <br>Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                        <a href="{{route('login')}}" class="btn btn-light-bg">Get Started</a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section id="pricing2" class="section">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="pricing-text section-header text-center">
                        <div>
                            <h2 class="section-title">Our Plans</h2>
                            <div class="desc-text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do <br
                                        class="d-none d-md-block"> eiusmod tempor incididunt ut labore et dolore.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row pricing-tables justify-content-center justify-content-md-start">
                    @foreach($plans as $name => $plan)
                <div class="col-lg-4 col-md-4 col-sm-10 col-xs-12">
                    <div class="pricing-table text-center">
                        <div class="pricing-details">
                            <h3>{{$name}}</h3>
                            <h1><span>€</span>{{$plan['instance']['amount_decimal'] > 0 ? $plan['instance']['amount_decimal']/100 : $plan['instance']['amount_decimal']}}</h1>
                            <ul>
                                {{-- <li>{{$plan['features']}}</li> --}}
                                <li>{{$plan['allowed_landing']}}</li>
                                <li>{{$plan['allowed_time']}}</li>
                                <li>{{$plan['templates_available'] ?? ''}}</li>
                                <li>{{$plan['personlized_templates'] ?? ''}}</li>
                                
                            </ul>
                        </div>
                        <div class="plan-button">
                            <a href="{{route('register')}}" class="btn btn-border">Get Started</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </section>

@if(count($testimonials))
    <section id="client-talk" class="section">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="team-text section-header text-center">
                        <div>
                            <h2 class="section-title">What Our Client Says</h2>
                            <div class="desc-text">

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do <br
                                        class="d-none d-md-block"> eiusmod tempor incididunt ut labore et dolore.</p>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>


            <div class="row">
                @foreach($testimonials as $testimonial)
                    <div class="col-lg-4 col-md-6 col-xs-12  mx-auto">
                        <div class="client-words">
                            <p>{!! str_replace("&nbsp;"," ", $testimonial->description);  !!}</p>
                            <h5>
                            @if(!is_null($testimonial->name)) 
                                {{$testimonial->name}} 
    
                            @else
                                {{$testimonial->user ? $testimonial->user->first_name : ' ' }}
                            @endif 
                                    <br><span>-{{ $testimonial->designation}}</span></h5>
                            <span class="qoute-icon"><i class="lni lni-quotation"></i></span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endif

    {{-- <section id="team2" class="section">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="team-text section-header text-center">
                        <div>
                            <h2 class="section-title">Team Members</h2>
                            <div class="desc-text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do <br
                                        class="d-none d-md-block"> eiusmod tempor incididunt ut labore et dolore.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-md-start justify-content-center">

                <div class="col-lg-3 col-md-6 col-sm-10 col-xs-12">
                    <div class="single-team">
                        <div class="team-thumb">
                            <img src="{{asset('frontend/img/team/01.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="team-details">
                            <div class="team-social-icons">
                                <ul class="social-list">
                                    <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                    <li><a href="#"><i class="lni lni-google"></i></a></li>
                                </ul>
                            </div>
                            <div class="team-inner text-center">
                                <h5 class="team-title">Patric Green</h5>
                                <p>Lead Designer</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-10 col-xs-12">
                    <div class="single-team">
                        <div class="team-thumb">
                            <img src="{{asset('frontend/img/team/02.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="team-details">
                            <div class="team-social-icons">
                                <ul class="social-list">
                                    <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                    <li><a href="#"><i class="lni lni-google"></i></a></li>
                                </ul>
                            </div>
                            <div class="team-inner text-center">
                                <h5 class="team-title">Celina D Cruze</h5>
                                <p>Front-end Developer</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-10 col-xs-12">
                    <div class="single-team">
                        <div class="team-thumb">
                            <img src="{{asset('frontend/img/team/03.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="team-details">
                            <div class="team-social-icons">
                                <ul class="social-list">
                                    <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                    <li><a href="#"><i class="lni lni-google"></i></a></li>
                                </ul>
                            </div>
                            <div class="team-inner text-center">
                                <h5 class="team-title">Daryl Dixon</h5>
                                <p>Content Writer</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-10 col-xs-12">
                    <div class="single-team">
                        <div class="team-thumb">
                            <img src="{{asset('frontend/img/team/04.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="team-details">
                            <div class="team-social-icons">
                                <ul class="social-list">
                                    <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                    <li><a href="#"><i class="lni lni-google"></i></a></li>
                                </ul>
                            </div>
                            <div class="team-inner text-center">
                                <h5 class="team-title">Mark Parker</h5>
                                <p>Support Engineer</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section> --}}


    {{-- <section id="blog2" class="section">

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-text section-header text-center">
                        <div>
                            <h2 class="section-title">Latest Blog Posts</h2>
                            <div class="desc-text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do <br
                                        class="d-none d-md-block"> eiusmod tempor incididunt ut labore et dolore.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center justify-content-md-start">

                <div class="col-lg-4 col-md-6 col-sm-10 col-xs-12 blog-item">

                    <div class="blog-item-wrapper">
                        <div class="blog-item-img">
                            <a href="single-post.html">
                                <img src="{{asset('frontend/img/blog/01.jpg')}}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="blog-item-text">
                            <h3><a href="single-post.html">How Slick Will Transform <br class="d-none d-lg-block">Your
                                    Business</a></h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the
                                industry.</p>
                            <a href="#" class="read-more">5 Min read</a>
                        </div>
                        <div class="author">
                            <span class="name"><i class="lni lni-user"></i><a href="#">Posted by
                                    Admin</a></span>
                            <span class="date float-right"><i class="lni lni-calendar"></i><a href="#">10 April,
                                    2020</a></span>
                        </div>
                    </div>

                </div>


                <div class="col-lg-4 col-md-6 col-sm-10 col-xs-12 blog-item">

                    <div class="blog-item-wrapper">
                        <div class="blog-item-img">
                            <a href="single-post.html">
                                <img src="{{asset('frontend/img/blog/02.jpg')}}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="blog-item-text">
                            <h3><a href="single-post.html">Growth Techniques for <br class="d-none d-lg-block">New
                                    Startups</a></h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the
                                industry.</p>
                            <a href="#" class="read-more">5 Min read</a>
                        </div>
                        <div class="author">
                            <span class="name"><i class="lni lni-user"></i><a href="#">Posted by
                                    Admin</a></span>
                            <span class="date float-right"><i class="lni lni-calendar"></i><a href="#">10 April,
                                    2020</a></span>
                        </div>
                    </div>

                </div>


                <div class="col-lg-4 col-md-6 col-sm-10 col-xs-12 blog-item">

                    <div class="blog-item-wrapper">
                        <div class="blog-item-img">
                            <a href="single-post.html">
                                <img src="{{asset('frontend/img/blog/03.jpg')}}" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div class="blog-item-text">
                            <h3><a href="single-post.html">Writing Professional <br class="d-none d-lg-none">Emails to
                                    Customers</a></h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the
                                industry.</p>
                            <a href="#" class="read-more">5 Min read</a>
                        </div>
                        <div class="author">
                            <span class="name"><i class="lni lni-user"></i><a href="#">Posted by
                                    Admin</a></span>
                            <span class="date float-right"><i class="lni lni-calendar"></i><a href="#">10 April,
                                    2020</a></span>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section> --}}


    <section id="contact2" class="section ">

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-text section-header text-center mb-0">
                        <div>
                            <h2 class="section-title">Get In Touch</h2>
                            <div class="desc-text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do <br
                                        class="d-none d-md-block"> eiusmod tempor incididunt ut labore et dolore.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row align-items-end" >

                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div id="msgSubmit" class="h5 mb-3 hidden"></div>
                    <form id="contactForm" {{route('contact.submit')}}>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                        required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" placeholder="Subject" id="msg_subject" class="form-control"
                                        name="subject" required data-error="Please enter your subject">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Email" required data-error="Please enter your Email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" placeholder="Phone" id="phone" class="form-control"
                                        name="phone" required data-error="Please enter your phone">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="message" name="message"
                                        placeholder="Write Message" rows="4" data-error="Write your message"
                                        required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="submit-button">
                                    <button class="btn btn-common" id="submit" type="submit">
                                        <span class="submitting spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Submit</button>
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-lg-1">
                </div>


                <div class="col-lg-5 col-md-12 col-xs-12">
                    <div class="contact-img">
                        <img src="{{asset('frontend/img/contact-us-animate.svg')}}" class="img-fluid" alt="">
                    </div>
                </div>


            </div>

        </div>
    </section>
</section>

 @endsection
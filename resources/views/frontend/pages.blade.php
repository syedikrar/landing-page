@extends('layouts.pages.app')

@section('title', ucwords($page->title))

@section('styles')
<style>
.navbar-area-pages{
    
    background: linear-gradient(to right , #3023ae 40%, #c86dd7 100% ); 
}
#footer-Content2 {
    clear: both;
    position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   text-align: center;
}

</style>
@endsection
@section('header')
@php
    $settings = getSettings()->toArray();
@endphp
<header id="home" class="hero-area2">
    <div class="overlay-light"></div>
    <div class="navbar-area navbar-area-pages">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="#">
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
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{ route('homepage')}}#client-talk">Testimonials</a>
                                </li>
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
   
</header>
@endsection

@section('content')
<section id="" class="section mb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ ucwords($page->heading) }}</h2>
            </div>
            <div class="col-lg-12">
                <p>{!! str_replace('&nbsp;', ' ', ucwords($page->description)) !!}</p>
            </div>
        </div>
    </div>
</section>
@endsection
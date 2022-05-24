@extends('layouts.pages.app')

@section('title', 'Signin')

@section('styles')
<style>
.navbar-area-pages{
    
    background: linear-gradient(to right , #3023ae 40%, #c86dd7 100% ); 
}
</style>

@endsection
@section('header')
<header id="home" class="hero-area2">
    <div class="overlay-light"></div>
    <div class="navbar-area navbar-area-pages">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="/">
                            <img src="{{ getLogo() }}" class="logo-image p-0" alt="Logo">{{--env(ADMIN_URL)--}}
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
<section  class="section px-0 mx-0">

    <div class="container pt-5">

        <div class="row">
            <div class="col-lg-12">
                <div class="contact-text section-header text-center mb-0">
                    <div>
                        

                        <h2 class="section-title">Login</h2>
                        <div class="desc-text">
                            <p>Enter your email address and password to access the dashboard</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row align-items-center" >
            <div class="col-md-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
            <div class="col-lg-6 col-md-8 col-xs-8 offset-lg-3 offset-2">
              {{-- data-redirect="{{route('beezers.index')}}" --}}
                <form id="SigninForm" action="{{route('sign-in')}}" method="post" data-redirect="{{ route('client.home') }}" data-form="ajax-form" >
                    @csrf
                    <div class="row  pt-4">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <input type="text" class="form-control p-4 col-12" id="email" name="email" placeholder="Email"
                                    required >
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="password" placeholder="Password" id="password" class="form-control p-4 col-12" name="password" required >
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link text-dark pl-0" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                            @endif
                            <div class="submit-button float-right">
                                <button class="btn btn-light-singin" id="submitBtn" type="submit">
                                    <span class="submitting spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Login</button>
                                <div id="msgSubmit" class="h3 hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <div class="col-lg-1">
            </div>
        </div>

    </div>
</section>
@endsection
{{-- @push('scripts') --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" defer></script> --}}

{{-- @endpush --}}

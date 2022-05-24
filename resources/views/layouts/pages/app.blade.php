<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Apps">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{asset('frontend/img/1.png')}}" type="image/png">

    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap-4.5.0.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/LineIcons.2.0.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.2.3.4.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/nivo-lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />

</head>

<style>
    body{
        margin:0;padding: 0px;
        /* overflow: scroll; */
    }
    .submitting {
        display: none 
    }
    .pages-nav{
        background:#3c1f6e;
    }
    .logo-image{
        /* max-width: 105px !important; */
        max-height: 80px;
    }
</style>
@yield('styles')
<body>
    @php
    $settings = getSettings()->toArray();
    @endphp
    

    @yield('header')



   
        @yield('content')



    <footer class="bottom pt-0" style="position: relative;bottom:0px;" >

        <section id="footer-Content2" class="bottom pt-0">
            {{-- <div class="container">

                <div class="row">

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <div class="footer-logo">
                         <img src="{{asset('frontend/img/logo-footer.png')}}" alt=""> 
                            <h4 class="text-white" style="font-size:26px">TheLandying</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, a et. In veniam, architecto
                                nam debitis
                                sunt.</p>
                            <ul class="footer-social-list">
                                <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="#"><i class="lni lni-instagram-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                            </ul>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <div class="widget">
                            <h3 class="block-title">Product</h3>
                            <ul class="menu">
                                <li><a href="#"> - Customer Service</a></li>
                                <li><a href="#">- Enterprise</a></li>
                                <li><a href="#">- Price</a></li>
                                <li><a href="#">- Scurity</a></li>
                                <li><a href="#">- Why SLICK?</a></li>
                            </ul>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <div class="widget">
                            <h3 class="block-title">Download App</h3>
                            <ul class="menu">
                                <li><a href="#"> - Android App</a></li>
                                <li><a href="#">- IOS App</a></li>
                                <li><a href="#">- Windows App</a></li>
                                <li><a href="#">- Play Store</a></li>
                                <li><a href="#">- IOS Store</a></li>
                            </ul>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <div class="widget">
                            <h3 class="block-title">Contact</h3>
                            <ul class="footer-address-info">
                                <li><i class="lni lni-map-marker"></i>105 Mdison Avenue - Third Floor New York, NY10016
                                </li>
                                <li><i class="lni lni-mobile"></i>P:088123456789</li>
                                <li><i class="lni lni-envelope"></i>E:contact@alyendigital.com</li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div> --}}

            <div class="copyright mt-0">
                <div class="container">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="site-info text-left">
                                <p> 
                                        @foreach (getpages() as $page)
                                            <a href="{{ route('pages', $page->slug) }}" rel="nofollow" class="mr-2">{{ ucwords($page->title) }}</a>
                                        @endforeach
                            
                                   </p>
                            </div>
                        </div>
                   
                        <div class="col-md-6">
                            <div class="site-info text-right">
                                <ul class="footer-social-list ">
                                   
                                    <li class="d-inline-block"><a target="_blank" href="{{ getSocialLinks($settings['facebook_link']) }}"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li class="d-inline-block ml-2"><a target="_blank" href="{{ getSocialLinks($settings['twitter_link']) }}"><i class="lni lni-twitter-original"></i></a></li>
                                    <li class="d-inline-block ml-2"><a target="_blank" href="{{ getSocialLinks($settings['instagram_link'] )}}"><i class="lni lni-instagram-filled"></i></a></li>
                                    <li class="d-inline-block ml-2"><a target="_blank" href="{{ getSocialLinks($settings['linkedin_link']) }}"><i class="lni lni-linkedin-original"></i></a></li>
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>

    </footer>


    {{-- <a href="#" class="home2-scroll back-to-top">
        <i class="lni lni-chevron-up"></i>
    </a> --}}

    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>


    <script src="{{asset('frontend/js/modernizr-3.7.1.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery-3.5.1-min.js')}}"></script>
    <script src="{{asset('frontend/js/popper.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap-4.5.0.min.js')}}"></script>
    <script src="{{asset('frontend/js/owl.carousel.2.3.4.min.js')}}"></script>
    <script src="{{asset('frontend/js/nivo-lightbox.js')}}"></script>
    {{-- <script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script> --}}
    <script src="{{asset('frontend/js/form-validator.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" defer></script> --}}
    <script src="{{asset('js/common.js')}}"></script>
    {{-- <script src="{{asset('frontend/js/contact-form-script.js')}}"></script> --}}
    <script src="{{asset('frontend/js/main.js')}}"></script>

    @yield('scripts')
    <script>
        $("#contactForm").submit(function(e) {
            $("#button").prop('disabled', true);
            $('.submitting').css('display','inline-block');
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = "{{route('contact.submit')}}";

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    formSuccess();
                    $('.submitting').css('display', 'none');
                    $("#button").prop('disabled', false);

                }
                });


            });
    


function formSuccess(){$("#contactForm")[0].reset();submitMSG(true,"Thank you for contacting us, we will get in touch shortly.")}
function formError(){$("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){$(this).removeClass();});}
function submitMSG(valid,msg){if(valid){var msgClasses="h5 mb-3 text-center tada animated text-success";}else{var msgClasses="h5 mb-3 text-center text-danger";}
$("#msgSubmit").removeClass().addClass(msgClasses).text(msg);}
    </script>
</body>

</html>

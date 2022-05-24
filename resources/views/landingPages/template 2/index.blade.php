<!DOCTYPE html>
<html lang="en">

<head>
    <title>Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="/templates/template2/assets/css/style.css">

    @if ($landing->google_analytics)
        {!! $landing->google_analytics !!}
    @endif
    <style>
        .edit-btn {
            position: fixed;
            bottom: 15px;
            right: 5px;
            text-decoration: none;
            background: linear-gradient(to right, #827af3 0%, #b47af3 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#827af3", endColorstr="#b47af3", GradientType=1);
            padding: 8px 30px;
            border-radius: 0;
            font-family: 'Roboto';
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            font-weight: 500;
            color: #fff;
            border: none;
            border-radius: 45px;
            box-shadow: 0px 5px 15px rgb(0 0 0 / 33%);
            transition: all 0.3s ease 0s;
        }

        .edit-btn:hover {
            text-decoration: none;
            box-shadow: 0px 9px 14px rgb(165 122 243 / 42%);
            color: #fff;
            transform: translateY(-3px);
        }

        .form-title {
            margin-bottom: 1.5rem !important;
            font-weight: 700 !important;
            color: #ffffff !important;
        }
        .fixed-bottom-right {
            position: fixed;

            bottom: 0;
            left: 0;
            z-index: 1030;
        }

    </style>
</head>

<body>
    @if ($landingTemplate)
        <style>
            {!! $landingTemplate->css_data !!}

        </style>
        {!! $landingTemplate->html_data !!}

    @else
        <header>
            <nav class="nav">
                <div class="container">
                    <div class="logo">
                        <a href="#"><img src="/templates/template2/assets/images/logo.png" alt=""></a>
                    </div>
                    <div id="mainListDiv" class="main_list">
                        <ul class="navlinks">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#">Panel</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Login</a></li>
                            <li><a href="#">Contact</a></li>

                        </ul>
                    </div>
                    <span class="navTrigger">
                        <i></i>
                        <i></i>
                        <i></i>
                    </span>
                </div>
            </nav>
        </header>

        <section class="home">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-5 col-md-4 mb-5 mb-md-0 text-center text-md-start pe-md-3">

                    </div>

                    <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-8 mt-5 mt-md-0">
                        <div class="form-container text-center">
                            <div id="form_container">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="cta clipper bg-primary text-center text-white py-5">
            <div class="container pb-5">
                <h2>Create Your Own Genuine Web Masterpiece</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
            </div>

        </section>
        <section></section>
        <!-- Services -->
        <section class="services text-center ">
            <div class="clipper">
                <div class="services-heading-bg">
                    <div class="services-heading clipper">
                        <div class="container ">
                            <h1 class="color-primary">SERVICES</h1>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                                tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                                quis. </p>
                        </div>
                    </div>
                </div>

                <div class="services-container-bg">
                    <div class="services-container mb-5 mb-md-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <div class="service-img">
                                        <img class="mx-auto" src="/templates/template2/assets/images/camera.png"
                                            alt="">
                                    </div>
                                    <div class="service-heading">
                                        <h3>LOREM IPSUM</h3>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipisc,</p>
                                </div>
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <div class="service-img">
                                        <img class=" mx-auto" src="/templates/template2/assets/images/camera.png"
                                            alt="">
                                    </div>
                                    <div class="service-heading">
                                        <h3>LOREM IPSUM</h3>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipisc,</p>
                                </div>
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <div class="service-img">
                                        <img class=" mx-auto" src="/templates/template2/assets/images/camera.png"
                                            alt="">
                                    </div>
                                    <div class="service-heading">
                                        <h3>LOREM IPSUM</h3>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipisc,</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </section>
        <!-- Ideas -->
        <section class="ideas text-center">

            <div class="ideas-container-bg">
                <div class="ideas-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="ideas-img">
                                    <img class="mx-auto" src="/templates/template2/assets/images/idea.png"
                                        alt="">
                                </div>
                                <div class="ideas-heading">
                                    <h3>Ideas</h3>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. </p>
                            </div>
                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="ideas-img">
                                    <img class="mx-auto" src="/templates/template2/assets/images/research.png"
                                        alt="">

                                </div>
                                <div class="ideas-heading">
                                    <h3>Make research</h3>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. </p>
                            </div>
                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="ideas-img">
                                    <img class="mx-auto" src="/templates/template2/assets/images/work.png"
                                        alt="">

                                </div>
                                <div class="ideas-heading">
                                    <h3>Do the work</h3>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>


        <!-- Footer Section -->
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 pe-md-5">
                        <h4>ABOUT US</h4>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus alias hic commodi similique
                            cum illum quo, consectetur adipisci, modi labore nesciunt mollitia, dolores molestiae
                            distinctio ullam blanditiis itaque repudiandae fugiat.</p>
                    </div>
                    <div class="col-md-3 links pe-md-5">
                        <h4 class="mb-4">QUICK LINKS</h4>
                        <ul>
                            <li><i class="fas fa-chevron-right color-primary me-1"></i> LOREM IPSUM</li>
                            <li><i class="fas fa-chevron-right color-primary me-1"></i> LOREM IPSUM</li>
                            <li><i class="fas fa-chevron-right color-primary me-1"></i> LOREM IPSUM</li>
                            <li><i class="fas fa-chevron-right color-primary me-1"></i> LOREM IPSUM</li>
                            <li><i class="fas fa-chevron-right color-primary me-1"></i> LOREM IPSUM</li>

                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h4 class="mb-4">GET IN TOUCH</h4>
                        <ul>
                            <li><i class="fas fa-home color-primary me-1"></i> Lorem ipsum dolor sit amet</li>
                            <li><i class="fas fa-phone-square-alt color-primary me-1"></i> + ooo ooo ooo</li>
                            <li><i class="fas fa-envelope color-primary me-1"></i> lorem@ipsumdolorsitamet</li>

                        </ul>
                    </div>
                </div>
            </div>


        </footer>
        <div class="fixed-bottom-right p-4 cookie-main">
            <div class="toast bg-dark text-white w-100 mw-100" role="alert" data-autohide="false">
                <div class="p-4 d-flex flex-column">

                    <div class="row">
                        <div class="col-11">
                            <h5>Cookie Warning</h5>
                        </div>

                        <div class="col-1 w-1  ml-0 pl-0 float-right">
                            <h5 class="close text-light cookie-close" onclick="hideCookie()" aria-label="Close">
                                &times;
                            </h5>
                        </div>
                    </div>
                    <p>
                        This website stores data such as cookies to enable site functionality including analytics and
                        personalization. By using this website, you automatically accept that we use cookies.
                    </p>
                    <div class="ml-auto">

                        <button type="button" class="btn btn-light cookies-btn">
                            <a href="#" class="text-dark">Read More</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @auth
        @if (Auth::user()->id == $landing->campaign->user_id)
            <a class="edit-btn" href="{{ route('client.landing.edit_template', $landing->id) }}" target="_blank"><i
                    class="fas fa-pencil-alt"></i> Edit</a>
        @endif
    @endauth

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/8b6502498a.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('.navTrigger').click(function() {
            $(this).toggleClass('active');
            $("#mainListDiv").toggleClass("show_list");
            $("#mainListDiv").fadeIn();

        });
    </script>
    <script>
        fetchForm();
        increaseViewCount();

        function fetchForm() {
            $('#home_data').html(`<div class="spinner-border float-right" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
                </div>`);
            pageurl = "{{ route('get_landing_form', $landing->uuid) }}"
            var _token = $("input[name=_token]").val();

            $.ajax({

                url: pageurl,
                method: "GET",
                data: {
                    _token: _token,
                    queryParams: @json($queryParams)
                },
                success: function(data) {
                    $('#form_container').html(data);
                }
            });
        }

        function increaseViewCount() {

            pageurl = "{{ route('increase_view_count', $landing->uuid) }}"
            var _token = "{{ csrf_token() }}";
            $.ajax({

                url: pageurl,
                method: "POST",
                data: {
                    _token: _token
                },
                success: function(data) {
                    // console.log(data);
                    // $('input[name=click_id]').val(data);

                }
            });
        }
    </script>

    <script>
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function eraseCookie(name) {
            document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }

        function cookieConsent() {
            if (!getCookie('allowCookies')) {
                var cookie_toast = document.getElementsByClassName('toast');
                new bootstrap.Toast(cookie_toast[0], {
                    animation: true,
                    autohide: false,
                    delay: 0
                }).show();
            }
        }

        $('#btnDeny').click(() => {
            eraseCookie('allowCookies')
            hideCookie();
        })

        $('#btnAccept').click(() => {
            setCookie('allowCookies', '1', 7)
            hideCookie();
        })

        function hideCookie() {
            var cookie_toast = document.getElementsByClassName('toast');
            new bootstrap.Toast(cookie_toast[0], {
                animation: true,
                autohide: false,
                delay: 0
            }).hide();
        }

        // load
        cookieConsent()

        // for demo / testing only
        $('#btnReset').click(() => {
            // clear cookie to show toast after acceptance
            eraseCookie('allowCookies')
            $('.toast').toast('show')
        })
    </script>

</body>

</html>

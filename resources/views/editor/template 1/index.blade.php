<!DOCTYPE html>
<html lang="en">

<head>
    <title>Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/templates/template1/assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">

    <script src="https://unpkg.com/grapesjs"></script>

</head>
<style>
    /* Let's highlight canvas boundaries */
    #gjs {
        border: 3px solid #444;
    }

    /* Reset some default styling */
    .gjs-cv-canvas {
        top: 0;
        width: 100%;
        height: 100%;
    }

    .gjs-block {
        width: auto;
        height: auto;
        min-height: auto;
    }

    .panel__top {
        padding: 0;
        width: 100%;
        display: flex;
        position: initial;
        justify-content: center;
        justify-content: space-between;
    }

    .panel__basic-actions {
        position: initial;
    }

    .editor-row {
        display: flex;
        justify-content: flex-start;
        align-items: stretch;
        flex-wrap: nowrap;
        height: 300px;
    }

    .editor-canvas {
        flex-grow: 1;
    }

    .panel__right {
        flex-basis: 230px;
        position: relative;
        overflow-y: auto;
    }

    .panel__switcher {
        position: initial;
    }

    .gjs-cv-canvas {
        background-color: rgba(0, 0, 0, .15);
        box-sizing: border-box;
        width: 85%;
        height: calc(100% - 40px);
        bottom: 0;
        overflow: hidden;
        z-index: 1;
        position: absolute;
        left: 0;
        top: 40px;
    }

    .gjs-pn-buttons {
        justify-content: flex-end;
    }

    /* Paste this css to your style sheet file or under head tag */
    /* This only works with JavaScript, 
    if it's not present, don't show loader */
    .no-js #loader {
        display: none;
    }

    .js #loader {
        display: block;
        position: absolute;
        left: 100px;
        top: 0;
    }

    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url("{{ asset('templates/Settings.gif') }}") center no-repeat #fff;
    }

</style>

<body>
    <div class="panel__top">
        <div class="panel__basic-actions"></div>
    </div>

    <div id="gjs">
        @if ($landingTemplate)
            {!! $landingTemplate->html_data !!}
        @else
            <header>
                <nav class="nav">
                    <div class="container">
                        <div class="logo">
                            <a href="#"><img src="/templates/template1/assets/images/logo.png" alt=""></a>
                        </div>
                        <div id="mainListDiv" class="main_list">
                            <ul class="navlinks">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Panel</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Login</a></li>

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
                        <div class="col-md-5 mb-5 mb-md-0 text-center text-md-start pe-md-3">

                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                                diam nonummy nibh euismod tincidunt ut laoreet dolore
                                magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                                quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut.</p>

                            <a class="btn btn-primary">MORE INFO</a>
                        </div>

                        <div class="col-md-4 mt-5 mt-md-0">
                            <div class="form-container text-center">

                                <div class="form-wrapper" id="form_container" data-gjs-editable="false"
                                    data-gjs-selectable="false" data-gjs-removable="false" data-gjs-draggable="false">
                                    <h4 class="text-dark" data-gjs-editable="false" data-gjs-selectable="false"
                                        data-gjs-removable="false" data-gjs-draggable="false">"Form will be shown here"
                                    </h4>
                                </div>
                                <!--//form-wrapper-->

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Services -->
            <section class="services text-center ">
                <div class="container ">
                    <div class="services-heading">
                        <h1 class="color-primary">SERVICES</h1>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis.
                        </p>
                    </div>
                </div>
                <div class="services-container-bg">
                    <div class="services-container">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <img class="rounded-circle mx-auto"
                                        src="/templates/template1/assets/images/camera.png" alt="">
                                    <h3>LOREM IPSUM</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipisc,</p>
                                </div>
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <img class="rounded-circle mx-auto"
                                        src="/templates/template1/assets/images/camera.png" alt="">
                                    <h3>LOREM IPSUM</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipisc,</p>
                                </div>
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <img class="rounded-circle mx-auto"
                                        src="/templates/template1/assets/images/camera.png" alt="">
                                    <h3>LOREM IPSUM</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipisc,</p>
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
                        <div class="col-md-5 pe-md-5">
                            <div class="footer-logo">
                                <a href="#"><img src="/templates/template1/assets/images/dark-logo.png" alt=""></a>
                            </div>
                            <hr>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus alias hic commodi
                                similique cum illum quo, consectetur adipisci, modi labore nesciunt mollitia, dolores
                                molestiae distinctio ullam blanditiis itaque repudiandae fugiat.</p>
                        </div>
                        <div class="col-md-3">
                            <h3 class="mb-4">LOREM IPSUM</h3>
                            <ul>
                                <li>Lorem ipsum</li>
                                <li>Dolor sit amet</li>
                                <li>Consectetur</li>
                                <li>Adipisicing elit</li>
                                <li>Sed diam nonummy</li>
                                <li>Nibh euismod</li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h3 class="mb-4">LOREM IPSUM</h3>
                            <ul>
                                <li>Lorem ipsum</li>
                                <li>Dolor sit amet</li>
                                <li>Consectetur</li>
                                <li>Adipisicing elit</li>
                                <li>Sed diam nonummy</li>
                                <li>Nibh euismod</li>
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
                            This website stores data such as cookies to enable site functionality including analytics
                            and personalization. By using this website, you automatically accept that we use cookies.
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

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            $(document).ready(function() {

                var editor = grapesjs.init({

                    canvas: {
                        styles: [
                            'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css',
                            '/templates/template1/assets/css/style.css',
                        ],
                        scripts: ['https://code.jquery.com/jquery-3.6.0.min.js',
                            'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js',
                            '/templates/cookies.js'
                        ]
                    },
                    fromElement: true,
                    width: 'auto',
                    height: '100vh',
                    fromElement: 1,
                    clearOnRender: true,
                    container: '#gjs',
                    forceClass: false,
                    selectorManager: {
                        componentFirst: true
                    },
                    storageManager: {
                        autosave: false,
                        setStepsBeforeSave: 1,
                        type: 'remote',
                        params: {
                            landing_id: "{{ $landing->id }}"
                        },
                        urlStore: "{{ route('client.landing.save_template_data') }}",
                        urlLoad: "",
                        contentTypeJson: true,
                    },

                });
                //Undo button
                editor.Panels.addButton('options',
                    [{
                        id: 'undo',
                        className: 'fa fa-undo',
                        command: 'undo',
                        attributes: {
                            title: 'Undo'
                        }
                    }]
                );
                //Save button
                editor.Panels.addButton('options',
                    [{
                        id: 'save-db',
                        className: 'fa fa-floppy-o',
                        command: 'save-db',
                        attributes: {
                            title: 'Save'
                        }
                    }]
                );

                //   Exit button
                editor.Panels.addButton('views',
                    [{
                        id: 'exit',
                        className: 'fa fa-window-close',
                        command: 'exit-editor',
                        attributes: {
                            title: 'Exit Editor'
                        }
                    }]
                );



                // Add save command
                editor.Commands.add('save-db', {
                    run: function(editor, sender) {
                        sender && sender.set('active');
                        editor.store(swal("Saved!", "Landing page has been updated!", "success"));
                    }
                });
                // Add exit command
                editor.Commands.add('exit-editor', {
                    run: function(editor, sender) {
                        window.location.href = "{{ route('client.landing.index') }}"
                        editor.store(swal("Saved!", "Landing page has been updated!", "success"));
                    }
                });

                // Add undo command
                editor.Commands.add('undo', {
                    run: function(editor, sender) {
                        editor.UndoManager.undo();
                    }
                });
                // remove the buttons

                // editor.Panels.removeButton("views", "open-layers");
                editor.Panels.removeButton("views", "open-blocks");
                // editor.Panels.removeButton("views", "open-sm");
                editor.Panels.removeButton("options", "sw-visibility");
                editor.Panels.removeButton("options", "export-template");

                editor.Commands.add('tlb-asset-manager', {
                    run: function(editor, sender, opts) {
                        editor.AssetManager.open({
                            select(asset, complete) {
                                const selected = editor.getSelected();
                                if (selected && selected.is('image')) {
                                    selected.set('src', asset.getSrc());
                                    complete && editor.AssetManager.close();
                                }
                            }
                        });
                    }
                });

                editor.on('component:selected', () => {
                    const selectedComponent = editor.getSelected();
                    const newToolbar = [{
                            attributes: {
                                class: 'fa fa-arrows'
                            },
                            command: 'tlb-move'
                        },
                        {
                            attributes: {
                                class: 'fa fa-clone'
                            },
                            command: 'tlb-clone'
                        },
                        {
                            attributes: {
                                class: 'fa fa-trash'
                            },
                            command: 'tlb-delete'
                        }
                    ]

                    selectedComponent.set({
                        toolbar: newToolbar
                    });

                    if (selectedComponent.is('image')) {
                        selectedComponent.set({
                            toolbar: [{
                                    attributes: {
                                        class: 'fa fa-upload'
                                    },
                                    command: 'tlb-asset-manager'
                                },
                                ...newToolbar
                            ]
                        });
                    }
                });

                editor.setStyle(JSON.parse(@json($landingTemplate ? $landingTemplate->styles_data : ['1'])));



            });
        </script>

        <script>
            //paste this code under the head tag or in a separate js file.
            // Wait for window load
            $(window).on('load', function() {
                $(".se-pre-con").fadeOut("slow");

            });
        </script>



        <script>
            $('.navTrigger').click(function() {
                $(this).toggleClass('active');
                $("#mainListDiv").toggleClass("show_list");
                $("#mainListDiv").fadeIn();

            });
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

        <!-- Function used to shrink nav bar removing paddings and adding black background -->
        <script>
            $(window).scroll(function() {
                if ($(document).scrollTop() > 50) {
                    $('.nav').addClass('affix');
                } else {
                    $('.nav').removeClass('affix');
                }
            });
        </script>
</body>
<div class="se-pre-con"></div>

</html>

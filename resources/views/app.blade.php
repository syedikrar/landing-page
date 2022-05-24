<!DOCTYPE html>
<html lang="en" dir="ltr" mode="light">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TheLandying</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <!-- Styles -->
    {{--<link rel="stylesheet" href="{{ asset(mix('css/main.css')) }}">--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    {{-- <script src="{{ mix('/js/app.js') }}" defer></script> --}}
</head>
<body>
    @routes
    <noscript>
        <strong>
            We're sorry but {{ env('APP_DESCRIPTION') }} doesn't work properly without JavaScript enabled.
            Please enable it to continue.
        </strong>
    </noscript>
    @inertia
    {{-- <div id="app">
        @inertia
    </div> --}}

    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>

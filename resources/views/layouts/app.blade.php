<!doctype html>
<html lang="Ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Elnajat Eductaion') }}</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

    @include('layouts.includes.styles')
    @livewireStyles
    @stack('css')
    <style>


        :root {
            --primary: #8bdb65 !important;
            --primary-hover: #8bdb65 !important;
        }
        *{
            font-size: 16px;
            /* font-family: 'shamelBook' !important; */
        }

        li a{
            font-size: 14px !important;

        }
        @media only screen and (max-width: 767px) {
            .nav-header {
                width: 7rem;
            }
        }

        .nav-label.first {
            font-size: 16px !important;
        }

        .page-titles {
            background-image: url("{{ asset('assets/images/data/4.png') }}");
            background-size:cover;
            height: 300px;
        }
        .page-titles > .col-sm-12{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer p{
            font-size: 18px !important;
            font-weight: bold
        }
        .copyright p{
            font-size: 18px;
            color: white !important
        }

        .content-body {
            min-height: calc(100vh - 6.7rem) !important;
        }

        thead, tbody, tfoot, tr, td, th {
            padding: 5px;
        }


        [data-headerbg="color_2"][data-theme-version="dark"], [data-headerbg="color_2"] {
            --headerbg: #044c71;
        }

        [data-sidebarbg="color_2"][data-theme-version="dark"], [data-sidebarbg="color_2"] {
            --sidebar-bg: #044c71;
        }

        [data-sidebarbg="color_2"][data-theme-version="dark"] .menu-toggle .dlabnav .metismenu li > ul, [data-sidebarbg="color_2"] .menu-toggle .dlabnav .metismenu li > ul {
            background: #044c71 !important
        }

        .dropdown-menu {
            background: #044c71 !important;
            color: white
        }

        .dropdown-menu a *{
            color: white !important
        }

        .dropdown-menu .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.15); !important;
            color: white

        }

        .dlabnav li a:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .overlay-box:after {
            background: #709bb0 !important;
        }



        .btn-primary:active, .btn-primary:focus, .btn-primary:hover {
            border-color: var(--primary-hover);
            background-color: #004d71c7 !important;
        }

        .page-titles h4, .page-titles .h4 {
            color: #044c71 !important;
        }

    </style>
</head>

<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">
        @include('layouts.includes.header')
        @include('layouts.includes.sidebar')
        <div style="padding-top: 2rem">
            @yield('content')
        </div>
        @include('layouts.includes.footer')
    </div>
    @include('layouts.includes.js')
    @livewireScripts
    @stack('js')
</body>
</html>

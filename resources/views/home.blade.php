<!DOCTYPE html>
<html lang="en" dir="rtl" class="rtl">

<head>
    <!-- Title -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Elnajat Eductaion') }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

    @include('layouts.includes.styles')
    @livewireStyles
    @stack('css')

    <style>
        :root {
            --primary: #004d71 !important;
            --primary-hover: #0586c3 !important;
        }

        *{
            font-size: 18px !important
        }
        body {
            background-image: url("{{ asset('assets/images/data/background.jpg') }}");
            background-position: center;
            background-size: cover
        }
        .card-body {
            box-shadow: 0px 0px 25px #226127;
            border-radius: 20px;
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

    <div class="fix-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <div class="card mb-0 h-auto">
                        <div class="card-body">
                            <div class="text-center mb-2">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('assets/images/data/logo1.svg') }}" alt="logo" style="height: 100px;width:200px">
                                </a>
                            </div>
                            <h4 class="text-center mb-4">تسجيل الدخول</h4>
                            @livewire('user.login')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.includes.js')
    @livewireScripts
    @stack('js')
</body>

</html>

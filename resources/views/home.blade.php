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
            --primary: #044c71 !important;
            --primary-hover: #044d71b4 !important;
        }

        *{
            font-family: 'shamelBook' !important;
            color: #044c71 !important;
            font-size: 18px !important;
            font-weight: 500 !important;
        }

        .form-control{
            font-size: 18px !important
        }

        body{
            background: url("{{ asset('assets/images/data/home.jpg') }}");
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 768px) {
            .card-body img {
                width:150px !important;
                height: 150px !important;
            }
        }



        label{
            font-weight: bold !important
        }

        .form-label{
            margin-top:15px
        }

        .card{
            border-radius: 20px;
        }

        .card-body {
            /* box-shadow: 0px 0px 25px #8adb657e; */
            border-radius: 20px;
        }

        .btn.btn-success, .btn.btn-secondary, .btn.btn-warning, .btn.btn-primary, .btn.btn-danger, .btn.btn-info {
            color: #fff !important;
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
                <div class="col-lg-6 col-md-6">
                    <div class="card mb-0 h-auto">
                        <div class="card-body">
                            <div>
                                <div class="text-center mb-4" style="display: flex;justify-content:space-evenly">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('assets/images/data/logo-1.png') }}" alt="logo" style="height: 200px;width:200px">
                                    </a>
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('assets/images/data/logo-2.png') }}" alt="logo" style="height: 200px;width:200px">
                                    </a>
                                </div>
                                {{-- <h4 class="text-center mb-4 mt-4">تسجيل الدخول</h4> --}}
                                @livewire('user.login')
                            </div>
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

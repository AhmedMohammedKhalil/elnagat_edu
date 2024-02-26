<!doctype html>
<html lang="Ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Clothes Recomendation') }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
    <meta name="format-detection" content="telephone=no">



    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/rtl.css')}}">
    @livewireStyles
    @stack('css')
</head>

<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>




    <footer id="pt-footer" class="pt-offset-10">

        <div class="pt-footer-custom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- copyright -->
                        <div class="pt-box-copyright" dir="ltr">
                            &copy; 2023 Clothes Recomendation. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <a href="#" id="js-back-to-top" class="pt-back-to-top">
        <span class="pt-icon">
            <svg version="1.1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;"
                xml:space="preserve">
                <g>
                    <polygon fill="currentColor" points="20.9,17.1 12.5,8.6 4.1,17.1 2.9,15.9 12.5,6.4 22.1,15.9 	">
                    </polygon>
                </g>
            </svg>
        </span>
        <span class="pt-text">BACK TO TOP</span>
    </a>

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="external/jquery/jquery.min.js"><\/script>')
    </script>
    <script async src="js/bundle.js"></script>

    @include('layouts.svg')
    @livewireScripts
    @stack('js')
</body>

</html>

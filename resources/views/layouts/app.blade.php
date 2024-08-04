<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <title>WISATA KURIMA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Wisata jepara">
        <meta name="keywords" content="Informasi wisata jepara, jepara, wisata, tours jepara, wisata jepara makarno">
        <meta name="theme-color" content="#F0F2F5">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/costum.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css' rel='stylesheet' />
        <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">
        <link rel="manifest" href="/manifest.webmanifest">
        <link rel="apple-touch-icon" href="/icons/icon-512x512.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
        <meta name="msapplication-TileColor" content="#F0F2F5">
        <link rel="shortcut icon" href="/icons/icon-256x256.png" type="image/x-icon">
        <meta name="msapplication-TileImage" content="/icons/icon-512x512.png">
        @stack('style')
        @laravelPWA
    </head>

    <body style="background: white">
        <nav id="navbar" class="navbar navbar-expand-md bg-light navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    KURIMA
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-dark" href="{{ url('/') }}">Beranda<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('list.wisata') }}">Semua Wisata</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ url('/') }}">Tentang</a>
                        </li>
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login Admin') }}</a>
                        </li>
                        @endif
                        {{-- @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif --}}
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Admin {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">Kelola Wisata</a>
                                <a class="dropdown-item" href="{{ route('kelola.kategori') }}">Kelola Kategori</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Keluar') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="vh-100%">
            @yield('content')
            <div class="">
                {{ isset($slot) ? $slot : null }}
            </div>
        </main>
        <script src="{{ asset('js/sweetalert211.js') }}"></script>
        <script src="{{ asset('js/mapbox-gl.js') }}"></script>
        <script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/mapbox-gl-directions.js') }}"></script>
        <script src="{{ asset('js/costum.js') }} "></script>
        @stack('script')

        <script type="text/javascript">
            // Initialize the service worker
        console.log("service worker");
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js', {
                scope: '.'
            }).then(function(registration) {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }, function(err) {
                console.log('ServiceWorker registration failed: ', err);
            });
        }
        </script>
    </body>

</html>

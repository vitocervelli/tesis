<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="layout navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar col-sm-12">

                    <!-- Branding Image -->
                    <div class="logo-left col-sm-6">
                        <a href="{{ url('/') }}">
                            <img src="/images/facyt.png" alt="Facyt"></a>
                    </div>
                    <div class="logout col-sm-6">
                        <a href="{{ route('logout') }}">
                            Cerrar sesion

                        </a>
                       <p> {{ Auth::user()->rol }}:{{ Auth::user()->name }}
                           <br/><span><a href="../../home#buzon">Ver buzón</a></span>
                       </p>
                    </div>

                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

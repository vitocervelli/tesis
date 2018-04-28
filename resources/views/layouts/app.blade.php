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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body class="login">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Branding Image -->
                    <div class="logo-left col-xs-4">
                        <a  href="{{ url('/') }}">
                            <img src="/images/uc.jpg" alt="Facyt"></a>
                    </div>
                    <div class="col-xs-4">
                        <h1>Registro y seguimiento del Trabajo Especial de Grado</h1>
                    </div>
                    <div class="logo-right col-xs-4">
                        <a href="{{ url('/') }}">
                            <img src="/images/facyt.png" alt="Facyt"></a>
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

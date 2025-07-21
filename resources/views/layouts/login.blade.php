<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{url('images/logo.png')}}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body, html{
            height: 100%;
            margin: 0;
            font-size: 8pt;
        }
        .bg{
            background-image: url('{{url('images/login-page-bg.jpg')}}');
            background-position: center;
            background-size: cover;
            background-color: #CCC;
            background-repeat: no-repeat;
            height: 100%;
        }
        .panel-bg{
            background-image: url('{{url('images/loging-panel-bg.png')}}');
            background-position: center;
            background-size: cover;
            background-color: #CCC;
            background-repeat: no-repeat;
            height: 100%;
        }
        .panel{
            color: #FFF;
        }
        .panel{
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right:0;
            width: 350px;
            height: 350px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div id="app" class="bg">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

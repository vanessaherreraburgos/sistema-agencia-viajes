<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/images/logo-kuravaina.ico')}}"/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <style type="text/css">
        .login-block{
            background: #DE6262;  /* fallback for old browsers */
        /*  background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  Chrome 10-25, Safari 5.1-6 */
        /* background: linear-gradient(to bottom, #FFB88C, #DE6262);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: -webkit-linear-gradient(to bottom, #D7C050, #2F1B7C);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to bottom, #D7C050, #2F1B7C); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        float:left;
        width:100%;
        padding : 50px 0;
        }
        .banner-sec{background:url(https://static.pexels.com/photos/33972/pexels-photo.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
        .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
        .carousel-inner{border-radius:0 10px 10px 0;}
        .carousel-caption{text-align:left; left:5%;}
        .login-sec{padding: 50px 30px; position:relative;}
        .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
        .login-sec .copy-text i{color:#FEB58A;}
        .login-sec .copy-text a{color:#E36262;}
        .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #2F1B7C;}
        .login-sec h2:after{content:" "; width:100px; height:5px; background:#D7C050; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
        /*.login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}*/
        .btn-login{background: #DE6262; color:#fff; font-weight:600;}
        .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
        .banner-text h2{color:#fff; font-weight:600;}
        .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
        .banner-text p{color:#fff;}

    </style>
</head>
<body>
    <!-- <div id="app"> -->

        <!-- <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    !-- Collapsed Hamburger -- 
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    !-- Branding Image -- 
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    !-- Left Side Of Navbar -- 
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    !-- Right Side Of Navbar -- 
                    <ul class="nav navbar-nav navbar-right">
                        !-- Authentication Links -- 
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav> -->

        @yield('content')
    <!-- </div> -->

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
</body>
</html>

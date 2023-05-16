<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#04026e">
    <meta name="theme-color" content="#04026e">

    <meta name="description" content="A website design and development company.">
    <meta name="author" content="Zizix6 Technologies">
    <!-- Title -->
    <title>Zizix6 tech</title>

    

    <link rel="icon" href="{{env('APP_STORAGE')}}img/core-img/favicon.ico" type="image/x-icon">
    {{-- <link rel="icon" href="{{env('APP_STORAGE')}}img/core-img/favicon.png"> --}}

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    
    <!-- Favicon -->
    

    <link href="{{ asset('assets/css/themify-icons.css') }}" rel="stylesheet">

    <!-- Core Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">

    <!-- Jquery-2.2.4 JS -->
    <script src="{{env('APP_URL')}}/assets/js/jquery-2.2.4.min.js"></script>

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div class="colorlib-load"></div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header_area animated" style="background:#07089a;">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Menu Area Start -->
                <div class="col-12 col-lg-10">
                    <div class="menu_area">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <!-- Logo -->
                            <a class="navbar-brand" href="#">
                                <img class="logo_img" src="{{env('APP_STORAGE')}}images/logo.png" alt="zizix6 logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ca-navbar" aria-controls="ca-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                            <!-- Menu Area -->
                            <div class="collapse navbar-collapse" id="ca-navbar">
                                <ul class="navbar-nav ml-auto" id="nav">
                                    <li><a class="nav-link" href="{{env('APP_URL')}}">Home</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Signup btn -->
                <div class="col-12 col-lg-2">
                @guest('client')
                    <div class="sing-up-button d-none d-lg-block">
                        <a href="{{env('APP_URL')}}client/login">Client Login</a>
                    </div>
                @else
                     <p style="color: #FFF">
                        Welcome <b>{{Auth::user()->name}}</b> | <a href="{{env('APP_URL')}}client">Client Page</a>
                    </p>
                @endif
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

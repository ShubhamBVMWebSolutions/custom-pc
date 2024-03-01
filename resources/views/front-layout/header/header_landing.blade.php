<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="minimum-scale=1.0, maximum-scale=1.0,width=device-width, user-scalable=no" />
<meta name="robots" content="INDEX,FOLLOW"/>

<title>@yield('title') - {{ SiteSettingByName('site_name') }}</title>
<meta name="keywords" content="@yield('meta_keywords')">
 <meta name="description" content="@yield('meta_description')">

<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">
<!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slick.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slick-theme.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/aos.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}" type="text/css">

    <!--pdf-->
    <link rel="stylesheet" href="{{asset('css/black-book-view.css')}}" type="text/css">
    <!-- toastr js-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--google map-->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
 <script type="text/javascript">
            var SITE_URL = {!! json_encode(url('/')) !!}
        </script>
   <meta name="_token" content="{{ csrf_token() }}">
    <style>
        #map {
  height: 100%;
}

    </style>
</head>
@if (Route::current()->getName() == 'continue.build')
<body class="overflowhide">
@else
<body>
@endif


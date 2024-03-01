     <!doctype html>
    <html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>BNM Web Solutions - @yield('title')</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">


        <link rel="icon" href="{{asset('admin-panel/favicon.png')}}" type="image/x-icon" />
        <!--<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/icon-kit/dist/css/iconkit.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/ionicons/dist/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/dist/css/theme.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/dist/css/adminlte.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/style_admin.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/fontawesome.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/daterangepicker/daterangepicker.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/summernote/dist/summernote-bs4.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/jqvmap/jqvmap.min.css')}}">

       @php   $currRouteName  = Route::currentRouteName(); @endphp




      <link rel="stylesheet" href="{{asset('admin-panel/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">



 		@if($currRouteName=='admin.dashboard')
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/jvectormap/jquery-jvectormap.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/weather-icons/css/weather-icons.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/c3/c3.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/owl.carousel/dist/assets/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/owl.carousel/dist/assets/owl.theme.default.min.css')}}">
        @endif

        @if($currRouteName=='admin.coupon.add')
          <link rel="stylesheet" href="{{asset('datetime_picker/css/bootstrap-datetimepicker.min.css')}}">
         @endif

       @if($currRouteName=='admin.course.discount.add.update')
          <link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}">
        @endif




        <script src="{{asset('admin-panel/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('admin-panel/src/js/vendor/modernizr-2.8.3.min.js')}}"></script>

         <script type="text/javascript">
            var SITE_URL = {!! json_encode(url('/')) !!}
            var SITE_URL_ADMIN = {!! json_encode(url('/web-admin')) !!}
         </script>

    </head>

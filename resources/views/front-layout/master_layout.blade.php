 @include('front-layout.header.header_landing')
 @include('front-layout.header.header')


      @yield('content')

@php $route_name = Route::currentRouteName(); @endphp


@include('front-layout.footer.footer')


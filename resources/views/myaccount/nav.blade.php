@php 
$route_name = Route::currentRouteName();
@endphp
<div class="tab"> 
<ul>
    <li><a href="{{route('user.dashboard')}}" class="tablinks @if($route_name == 'user.dashboard') active @endif">Dashboard <i class="fa fa-dashboard" aria-hidden="true"></i></a></li>
    <li><a href="{{route('user.dashboard.orders')}}" class="tablinks @if($route_name == 'user.dashboard.orders') active @endif" >Orders <i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>
    <li><a href="{{route('user.dashboard.address')}}" class="tablinks @if($route_name == 'user.dashboard.address') active @endif">Billing Address <i class="fa fa-home" aria-hidden="true"></i></a></li>
    <li><a href="{{route('user.dashboard.profile')}}" class="tablinks @if($route_name == 'user.dashboard.profile') active @endif" >Account Details <i class="fa fa-user"></i></a></li>
    <li><a href="{{route('user.dashboard.wishlist')}}" class="tablinks @if($route_name == 'user.dashboard.wishlist') active @endif" >Wishlist <i class="fa fa-heart" aria-hidden="true"></i></a></li>
    <li><a href="{{route('logout')}}" class="tablinks" >Logout <i class="fa fa-power-off"></i></a></li>
</ul>
</div>
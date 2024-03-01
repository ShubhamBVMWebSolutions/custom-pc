@php
echo $route_name = Route::currentRouteName();


$dashboard = ['admin.dashboard'];
$sitesetting = ['admin.site.setting'];
$homeslider = ['admin.add.update.home.slider','admin.home.slider.view'];
$homelogo = ['admin.add.update.home.logo','admin.home.logo.view'];
$testimonial = ['admin.add.update.testimonial','admin.testimonial.view'];
$getting = ['admin.add.update.getting','admin.getting.view'];
$pages = ['admin.update.about','admin.update.contact','admin.update.home'];
$products = ['admin.product.view','admin.add.product','admin.update.product','admin.product.category.view','admin.add.update.product.category',
'admin.color.attribute.view','admin.add.update.color.attr','admin.brand.attribute.view','admin.add.update.brand.attr','admin.graphic.attribute.view',
'admin.add.update.graphic.attr','admin.drive.attribute.view','admin.add.update.drive.attr','admin.screen.attribute.view','admin.add.update.screen.attr',
'admin.ssd.attribute.view','admin.add.update.ssd.attr','admin.type.attribute.view','admin.add.update.type.attr','admin.processor.attribute.view',
'admin.add.update.processor.attr','admin.ram.attribute.view','admin.add.update.ram.attr'];

$user = ['admin.user.view','admin.add.user','admin.update.user'];
$coupon = ['admin.coupon.view','admin.add.update.coupon'];
$method = ['admin.payment.methods','admin.update.esewa','admin.add.update.bank.account'];

$pcbuilder = ['admin.chipset','admin.chipset.subcat','admin.update.chipset','admin.add.update.chipset.subcat'];

$order = ['admin.orders','admin.update.order'];

$gift_card = ['admin.giftcard.view','admin.giftcard.list'];

$seo = ['admin.site.seo.tags'];

$contact_request = ['admin.contact.requests','admin.view.contact.request'];

$import_view = ['admin.import-view'];

@endphp

 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{url('public/admin-panel/dist/img/star_fav.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><strong>SOI</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{AdminsProfileImageById(Auth::guard('admin')->user()->id)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('admin.profile')}}" class="d-block">{{AdminsNameById(Auth::guard('admin')->user()->id)}}</a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
     
          @if(in_array($route_name, $dashboard))
            <?php $class = 'active' ?>
          @else
            <?php $class = '' ?>
          @endif  
          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{$class}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                <b>Dashboard</b>
              </p>
            </a>
          </li>
             @if(in_array($route_name, $sitesetting))
            <?php $class = 'active' ?>
          @else
            <?php $class = '' ?>
          @endif  
          <li class="nav-item">
            <a href="{{route('admin.site.setting')}}" class="nav-link {{$class}}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                <b>Site Settings</b>
              </p>
            </a>
          </li>
          
          @if(in_array($route_name, $import_view))
            <?php $class = 'active' ?>
          @else
            <?php $class = '' ?>
          @endif 
          
          <li class="nav-item">
            <a href="{{route('admin.import-view')}}" class="nav-link {{$class}}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                <b>Import Products</b>
              </p>
            </a>
          </li>
          
          @if(in_array($route_name, $seo))
            <?php $class = 'active' ?>
          @else
            <?php $class = '' ?>
          @endif  
          <li class="nav-item">
            <a href="{{route('admin.site.seo.tags')}}" class="nav-link {{$class}}">
              <i class="nav-icon fas fa-ad"></i>
              <p>
                <b>SEO Tags</b>
              </p>
            </a>
          </li>
          
          @if(in_array($route_name, $contact_request))
            <?php $class = 'active' ?>
          @else
            <?php $class = '' ?>
          @endif  
          <li class="nav-item">
            <a href="{{route('admin.contact.requests')}}" class="nav-link {{$class}}">
              <i class="nav-icon far fa-address-card"></i>
              <p>
                <b>Contact Requests</b>
              </p>
            </a>
          </li>
          
          @if(in_array($route_name, $homeslider))
            <?php $class = 'active'; 
                 $menu_open = 'menu-open'; ?>
            @else
            <?php $class = ''; 
            $menu_open = ''; ?>
          @endif
        <li class="nav-item {{$menu_open}}">
            <a href="#" class="nav-link {{$class}}">
             <i class="nav-icon fas fa-sliders-h" aria-hidden="true"></i>
              <p>
                 <b>Home Slider</b>
                 <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="{{route('admin.home.slider.view')}}" class="nav-link @if($route_name == 'admin.home.slider.view') active @endif">
                  <p><b>All Slides</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.add.update.home.slider')}}" class="nav-link @if($route_name == 'admin.add.update.home.slider') active @endif">
                  <p><b>Add Slide</b></p>
                </a>
              </li>
              </ul>
            </li>
            
            
             @if(in_array($route_name, $homelogo))
            <?php $class = 'active'; 
                 $menu_open = 'menu-open'; ?>
            @else
            <?php $class = ''; 
            $menu_open = ''; ?>
          @endif
        <li class="nav-item {{$menu_open}}">
            <a href="#" class="nav-link {{$class}}">
             <i class="nav-icon fas fa-images" aria-hidden="true"></i>
              <p>
                 <b>Home Logos</b>
                 <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="{{route('admin.home.logo.view')}}" class="nav-link @if($route_name == 'admin.home.logo.view') active @endif">
                  <p><b>All Logos</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.add.update.home.logo')}}" class="nav-link @if($route_name == 'admin.add.update.home.logo') active @endif">
                  <p><b>Add Logo</b></p>
                </a>
              </li>
              </ul>
            </li>
            
            @if(in_array($route_name, $testimonial))
            <?php $class = 'active'; 
                 $menu_open = 'menu-open'; ?>
            @else
            <?php $class = ''; 
            $menu_open = ''; ?>
          @endif
        <li class="nav-item {{$menu_open}}">
            <a href="#" class="nav-link {{$class}}">
             <i class="nav-icon fas fa-quote-left" aria-hidden="true"></i>
              <p>
                 <b>Testimonial</b>
                 <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="{{route('admin.testimonial.view')}}" class="nav-link @if($route_name == 'admin.testimonial.view') active @endif">
                  <p><b>All Testimonials</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.add.update.testimonial')}}" class="nav-link @if($route_name == 'admin.add.update.testimonial') active @endif">
                  <p><b>Add Testimonial</b></p>
                </a>
              </li>
              </ul>
            </li>
          
          @if(in_array($route_name, $getting))
            <?php $class = 'active' ?>
          @else
            <?php $class = '' ?>
          @endif  
          <li class="nav-item">
            <a href="{{route('admin.getting.view')}}" class="nav-link {{$class}}">
              <i class="nav-icon fas fa-thumbtack"></i>
              <p>
                <b>Home Getting Started</b>
              </p>
            </a>
          </li>
          
          @if(in_array($route_name, $pages))
            <?php $class = 'active'; 
                 $menu_open = 'menu-open'; ?>
            @else
            <?php $class = ''; 
            $menu_open = ''; ?>
          @endif
           <li class="nav-item {{$menu_open}}">
            <a href="#" class="nav-link {{$class}}">
             <i class="nav-icon far fa-newspaper" aria-hidden="true"></i>
              <p>
                 <b>Manage Pages</b>
                 <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="{{route('admin.update.home')}}" class="nav-link @if($route_name == 'admin.update.home') active @endif">
                     <i class="nav-icon fas fa-home" aria-hidden="true"></i>
                  <p><b>Home</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.update.about')}}" class="nav-link @if($route_name == 'admin.update.about') active @endif">
                    <i class="nav-icon fas fa-info" aria-hidden="true"></i>
                  <p><b>About</b></p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="{{route('admin.update.contact')}}" class="nav-link @if($route_name == 'admin.update.contact') active @endif">
                    <i class="nav-icon fas fa-user-alt" aria-hidden="true"></i>
                  <p><b>Contact</b></p>
                </a>
              </li>
              </ul>
            </li>
            
            @if(in_array($route_name, $products))
            <?php $class = 'active'; 
                 $menu_open = 'menu-open'; ?>
            @else
            <?php $class = ''; 
            $menu_open = ''; ?>
          @endif
            <li class="nav-item {{$menu_open}}">
            <a href="#" class="nav-link {{$class}}">
             <i class="nav-icon fab fa-product-hunt" aria-hidden="true"></i>
              <p>
                 <b>Products</b>
                 <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.product.view')}}" class="nav-link @if($route_name == 'admin.product.view') active @endif">
                  <p><b>All Products</b></p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="{{route('admin.add.product')}}" class="nav-link @if($route_name == 'admin.add.product' || $route_name == 'admin.update.product') active @endif">
                  <p><b>Add New</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.product.category.view')}}" class="nav-link @if($route_name == 'admin.product.category.view' || $route_name == 'admin.add.update.product.category') active @endif">
                  <p><b>Product Categories</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.color.attribute.view')}}" class="nav-link @if($route_name == 'admin.color.attribute.view' || $route_name == 'admin.add.update.color.attr') active @endif">
                  <p><b>Color Attributes</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.brand.attribute.view')}}" class="nav-link @if($route_name == 'admin.brand.attribute.view' || $route_name == 'admin.add.update.brand.attr') active @endif">
                  <p><b>Brand Attributes</b></p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="{{route('admin.graphic.attribute.view')}}" class="nav-link @if($route_name == 'admin.graphic.attribute.view' || $route_name == 'admin.add.update.graphic.attr') active @endif">
                  <p><b>GraphicCard Attribute</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.drive.attribute.view')}}" class="nav-link @if($route_name == 'admin.drive.attribute.view' || $route_name == 'admin.add.update.drive.attr') active @endif">
                  <p><b>HardDrive Attribute</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.screen.attribute.view')}}" class="nav-link @if($route_name == 'admin.screen.attribute.view' || $route_name == 'admin.add.update.screen.attr') active @endif">
                  <p><b>ScreenSize Attribute</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.ssd.attribute.view')}}" class="nav-link @if($route_name == 'admin.ssd.attribute.view' || $route_name == 'admin.add.update.ssd.attr') active @endif">
                  <p><b>SSD Attribute</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.type.attribute.view')}}" class="nav-link @if($route_name == 'admin.type.attribute.view' || $route_name == 'admin.add.update.type.attr') active @endif">
                  <p><b>Type Attribute</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.processor.attribute.view')}}" class="nav-link @if($route_name == 'admin.processor.attribute.view' || $route_name == 'admin.add.update.processor.attr') active @endif">
                  <p><b>Processor Attribute</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.ram.attribute.view')}}" class="nav-link @if($route_name == 'admin.ram.attribute.view' || $route_name == 'admin.add.update.ram.attr') active @endif">
                  <p><b>RAM Attribute</b></p>
                </a>
              </li>
              </ul>
            </li>
            
            @if(in_array($route_name, $gift_card))
            <?php $class = 'active'; 
                 $menu_open = 'menu-open'; ?>
            @else
            <?php $class = ''; 
            $menu_open = ''; ?>
          @endif

          <li class="nav-item {{$menu_open}}">
            <a href="#" class="nav-link {{$class}}">
             <i class="nav-icon fas fa-gift" aria-hidden="true"></i>
              <p>
                 <b>Gift Card</b>
                 <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('admin.giftcard.list')}}" class="nav-link @if($route_name == 'admin.giftcard.list') active @endif ">
                 <p><b>Gift Card Content</b></p> 
                </a>
                <a href="{{route('admin.giftcard.view')}}" class="nav-link @if($route_name == 'admin.giftcard.view') active @endif ">
                 <p><b>Gift Card Details</b></p>
                </a>
              </li>
              </ul>
            </li>
            
            @if(in_array($route_name, $coupon))
            <?php $class = 'active'; 
                 $menu_open = 'menu-open'; ?>
            @else
            <?php $class = ''; 
            $menu_open = ''; ?>
          @endif
            
            <li class="nav-item {{$menu_open}}">
            <a href="#" class="nav-link {{$class}}">
             <i class="nav-icon fas fa-gift" aria-hidden="true"></i>
              <p>
                 <b>Coupons</b>
                 <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="{{route('admin.coupon.view')}}" class="nav-link @if($route_name == 'admin.coupon.view') active @endif ">
                  <p><b>All Coupons</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.add.update.coupon')}}" class="nav-link @if($route_name == 'admin.add.update.coupon') active @endif ">
                  <p><b>Add Coupon</b></p>
                </a>
              </li>
              </ul>
            </li>
          
          @if(in_array($route_name, $user))
            <?php $class = 'active'; 
                 $menu_open = 'menu-open'; ?>
            @else
            <?php $class = ''; 
            $menu_open = ''; ?>
          @endif
        <li class="nav-item {{$menu_open}}">
            <a href="#" class="nav-link {{$class}}">
             <i class="nav-icon fas fa-user" aria-hidden="true"></i>
              <p>
                 <b>Users</b>
                 <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="{{route('admin.user.view')}}" class="nav-link @if($route_name == 'admin.user.view') active @endif">
                  <p><b>All Users</b></p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.add.user')}}" class="nav-link @if($route_name == 'admin.add.user') active @endif">
                  <p><b>Add User</b></p>
                </a>
              </li>
              </ul>
            </li>
            
            @if(in_array($route_name, $method))
            <?php $class = 'active'; ?>
            @else
            <?php $class = ''; ?>
            @endif
            <li class="nav-item">
            <a href="{{route('admin.payment.methods')}}" class="nav-link {{$class}}">
              <i class="nav-icon far fa-credit-card"></i>
              <p>
                <b>Payment Methods</b>
              </p>
            </a>
          </li>
          
          @if(in_array($route_name, $order))
            <?php $class = 'active' ?>
          @else
            <?php $class = '' ?>
          @endif  
          <li class="nav-item">
            <a href="{{route('admin.orders')}}" class="nav-link {{$class}}">
              <i class="nav-icon fas fa-shopping-basket"></i>
              <p>
                <b>Orders</b>
              </p>
            </a>
          </li>
          
          @if(in_array($route_name, $pcbuilder))
            <?php $class = 'active'; 
                 $menu_open = 'menu-open'; ?>
            @else
            <?php $class = ''; 
            $menu_open = ''; ?>
          @endif
          
          <li class="nav-item {{$menu_open}}">
            <a href="#" class="nav-link {{$class}}">
             <i class="nav-icon fas fa-desktop" aria-hidden="true"></i>
              <p>
                 <b>PC Builder Blocks</b>
                 <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="{{route('admin.chipset')}}" class="nav-link @if($route_name == 'admin.chipset' || $route_name == 'admin.update.chipset') active @endif">
                  <p><b>Chipset</b></p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="{{route('admin.chipset.subcat')}}" class="nav-link @if($route_name == 'admin.chipset.subcat' || $route_name == 'admin.add.update.chipset.subcat') active @endif">
                  <p><b>Chipset Subcategory</b></p>
                </a>
              </li>
              
              
              </ul>
            </li>
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
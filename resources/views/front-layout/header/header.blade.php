@php
$route_name = Route::currentRouteName();
$user_id = auth()->user()->id ?? '';

@endphp
<!-- Header Section Begin -->
    <header id="main_header" class="header @if($route_name !== 'home') single_product_page @endif">
<!--         <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Build your dream PC around your budget <a href="{{route('pcbuilder')}}">Start Build<i class="arrow_carrot-right"></i></a></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <a href="#"> Call Us: +{{SiteSettingByName('call_number')}}</a>
                                 @if(empty($user_id))
                                <a class="nav-link" href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                                @else
                                <a class="nav-link " href="{{route('user.dashboard')}}" >
                                 <i class="fa fa-user" aria-hidden="true"></i> My Account
                                </a>
                              @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_menu">
            <div class="container">
               <div class="row">
                    <div class="col-lg-3 col-md-4 mobile_half">
                        <div class="header__logo">
                            <a href="{{route('home')}}"><img src="{{url(Config::get('constants.SITE_IMAGE_PATHS').SiteSettingByName('site_logo'))}}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 mobile_half">
                        <nav class="navbar navbar-expand-lg main_nav_bar">
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>

                          <div class="collapse navbar-collapse" id="main_menu">
                            <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Products
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach(getallCategories() as $cat)
                                    @if($cat->id !=21 || $cat->title != 'Gift Cards')
                                    <a class="dropdown-item" href="{{route('view.product.category',['productcategorySlug' => $cat->slug])}}">
                                        @if(!empty($cat->small_icon))
                                        <img class="cat_small_icon" src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$cat->small_icon )}}">
                                        @else
                                        <img class="cat_small_icon" src="{{asset('img/soi_icon.png')}}">
                                        @endif
                                        {{$cat->title}}</a>
                                    @endif
                                        @endforeach
                                </div>
                              </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Brands
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach(getallBrands() as $brand)
                                    <a class="dropdown-item" href="{{route('view.product.brand',['productbrandSlug' => $brand->slug])}}">{{$brand->name}}</a>
                                    @endforeach
                                </div>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{route('about')}}">About</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{route('contact')}}">Contact</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{route('pcbuilder')}}">PC Builder</a>
                              </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Gift CardsSiteSettingByNamedropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('view.giftcard',['giftcardSlug' => 'gift-card'])}}">
                                      <img class="cat_small_icon" src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').'1669030051.png' )}}">
                                      <?php echo "Gift Card" ?>
                                    </a>
                                      <a class="dropdown-item" href="{{route('view.giftcardform')}}">
                                      <img class="cat_small_icon" src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').'1669030051.png' )}}">
                                      <?php echo "Check your balance" ?>
                                    </a>

                                    </div>

                              </li>
                            </ul>
                          </div>
                        </nav>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="header__nav__option">
                            <input type="text" class="search-switch-input" id="search-switch" placeholder="Search Products....">
                            <?php $total_qty = 0;
                            if(empty($user_id)){
                            $cart = session()->get('cart');
                            if(!empty($cart)){
                            foreach($cart as $item){
                                $total_qty+=$item['quantity'];
                            } }
                            }
                            else{
                                $cart = userCart($user_id);
                                foreach($cart as $item){
                                    $total_qty+=$item->quantity;
                                }
                            }
                            $pc_qty = 0;

                            if(session()->has('pc_cart')){
                               $pc_qty = 1;
                            }
                            ?>
                            <a href="{{route('view.cart')}}"><img src="{{asset('img/icon/cart.png')}}" alt=""> <span>{{$total_qty+$pc_qty}}</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="header_top_new">
            <div class="chat_link_div">
                        <center>
                            <!--Ask our team for a BNM Web Solutions Deal.-->
                            Seen It Cheaper any where ask us for the SOI Deal.
                            @php
                            if(session()->has('chat_session')){
                                $chat_session = session()->get('chat_session');
                            }else{
                                session()->put('chat_session',time());
                                $chat_session = session()->get('chat_session');
                            }

                            @endphp
                            <a href="{{ route('messages.index',[base64_encode(1),base64_encode($chat_session)]) }}" onclick="window.open('{{ route('messages.index',[base64_encode(1),base64_encode($chat_session)]) }}',
                         '_blank',
                         'left=0,top=0,width=350,height=600,toolbar=no,location=no,status=no,menubar=no,resizable=no');
              return false;"> Live chat with us</a> or call 9802055573
                        </center>
                </div>
            <div class="container-fluid">
                <div class="mheader_only">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="top_right_options">
                                <ul>
                                <li>
                                     @if(empty($user_id))
                                        <a class="nav-link" href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                                        @else
                                        <a class="nav-link " href="{{route('user.dashboard')}}" >
                                         <i class="fa fa-user-o" aria-hidden="true"></i> Account
                                        </a>

                                      @endif
                                </li>
                                <li>
                                    <?php $total_qty = 0;
                                    if(empty($user_id)){
                                    $cart = session()->get('cart');
                                    if(!empty($cart)){
                                    foreach($cart as $item){
                                        $total_qty+=$item['quantity'];
                                    } }
                                    }
                                    else{
                                        $cart = userCart($user_id);
                                        foreach($cart as $item){
                                            $total_qty+=$item->quantity;
                                        }
                                    }
                                    $pc_qty = 0;

                                    if(session()->has('pc_cart')){
                                       $pc_qty = 1;
                                    }
                                    ?>
                            <a href="{{route('view.cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>{{$total_qty+$pc_qty}}</span> Cart</a>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="logo_n_search">
                            <div class="header__logo">
                                <a href="{{route('home')}}"><span>BVM Web Solutions</span></a>
                                {{-- <a href="{{route('home')}}"><img src="{{asset('img/1675944415.png')}}" alt=""></a> --}}
                                {{-- <a href="{{route('home')}}"><img src="{{url(Config::get('constants.SITE_IMAGE_PATHS').SiteSettingByName('site_logo'))}}" alt=""></a> --}}
                            </div>
                            <div class="header_search">
                                <input type="text" class="search-switch-input" id="search-switch" placeholder="Search products, Brands and more…">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="top_right_options">
                            <ul>
                                <li>
                                     @if(empty($user_id))
                                        <a class="nav-link" href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                                        @else
                                        <a class="nav-link " href="{{route('user.dashboard')}}" >
                                         <i class="fa fa-user-o" aria-hidden="true"></i> Account
                                        </a>

                                      @endif
                                </li>
                                <li>
                                    <?php $total_qty = 0;
                                    if(empty($user_id)){
                                    $cart = session()->get('cart');
                                    if(!empty($cart)){
                                    foreach($cart as $item){
                                        $total_qty+=$item['quantity'];
                                    } }
                                    }
                                    else{
                                        $cart = userCart($user_id);
                                        foreach($cart as $item){
                                            $total_qty+=$item->quantity;
                                        }
                                    }
                                    $pc_qty = 0;

                                    if(session()->has('pc_cart')){
                                       $pc_qty = 1;
                                    }
                                    ?>
                            <a href="{{route('view.cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>{{$total_qty+$pc_qty}}</span> Cart</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_menu_wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg main_nav_bar">
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="main_menu">
                            <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Products
                                </a>
                                <div class="submenus">
                                    <div class="submenus_scroll">
                                        <ul class="dropdown-menu sub-menu-dropdown" aria-labelledby="navbarDropdown">
                                            <li class="dropdown-item">
                                                <a class="nav-link" href="{{route('view.new-at-soi')}}" ><img class="cat_small_icon" src="{{asset('img/soi_icon.png')}}"> New At SOI
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a class="nav-link" href="{{route('view.products')}}" ><img class="cat_small_icon" src="{{asset('img/soi_icon.png')}}"> All products
                                                </a>
                                            </li>
                                            @php
                                            $productCollectionMenu = \App\Models\ProductCollection::where('parent_id',null)->where('list_in_product_menu','Yes')->where('status','Active')->orderBy('order_number','ASC')->get();
                                            $result = treeMenuFromProductCollection($productCollectionMenu);
                                            print_r($result);
                                            @endphp
                                            <!--@foreach(getallCategories() as $cat)-->
                                            <!--@if($cat->id !=21 || $cat->title != 'Gift Cards')-->
                                            <!--<li><a class="dropdown-item" href="{{route('view.products',['category_ids' => $cat->id])}}">-->
                                            <!--    @if(!empty($cat->small_icon))-->
                                            <!--    <img class="cat_small_icon" src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$cat->small_icon )}}">-->
                                            <!--    @else-->
                                            <!--    <img class="cat_small_icon" src="{{asset('img/soi_icon.png')}}">-->
                                            <!--    @endif-->
                                            <!--    {{$cat->title}}</a></li>-->
                                            <!--@endif-->
                                            <!--    @endforeach-->
                                        </ul>
                                    </div>
                                </div>
                              </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Brands
                                </a>
                                <div class="dropdown-menu brand_dropdown_menu" aria-labelledby="navbarDropdown">
                                    @foreach(getallBrands() as $brand)
                                    <a class="dropdown-item" href="{{route('view.products',['brand_ids' => $brand->id])}}">{{$brand->name}}</a>
                                    @endforeach
                                </div>
                              </li>
                                @php
                                    $collections = \App\Models\ProductCollection::where("status","Active")->where("list_in_product_menu","No")->orderBy('order_number','ASC')->get();
                                @endphp
                                @if($collections->count() > 0)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Deals
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                @foreach($collections as $collection)
                                                    <a class="dropdown-item" href="{{route('view.product-collection',[$collection->slug])}}">{{$collection->title}}</a>
                                                @endforeach
                                                <hr>
                                                <a class="dropdown-item" href="{{route('catalogues.index')}}">Catalogues</a>
                                        </div>
                                      </li>
                                @endif

                              <li class="nav-item">
                                <a class="nav-link" href="{{route('about')}}">About</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{route('contact')}}">Contact Us</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="{{route('pcbuilder')}}">PC Builder</a>
                              </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Gift Cards
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('view.giftcard',['giftcardSlug' => 'gift-card'])}}">
                                      <img class="cat_small_icon" src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').'1669030051.png' )}}">
                                      <?php echo "Gift Card" ?>
                                    </a>
                                      <a class="dropdown-item" href="{{route('view.giftcardform')}}">
                                      <img class="cat_small_icon" src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').'1669030051.png' )}}">
                                      <?php echo "Check your balance" ?>
                                    </a>

                                    </div>
                              </li>
                              <!-- <li class="nav-item">
                                <a class="nav-link" href="{{route('stores.index')}}">Stores</a>
                              </li> -->
                              <li class="nav-item">
                                <a class="nav-link" href="{{route('blog.index')}}">STACK</a>
                              </li>
                            </ul>
                          </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

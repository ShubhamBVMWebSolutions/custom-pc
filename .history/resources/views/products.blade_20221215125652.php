@extends('front-layout.master_layout')
@section('title',$metaDetails->name??'')
@section('meta_keywords',$metaDetails->meta_keywords ?? '')
@section('meta_description',$metaDetails->meta_description ?? '')
@section('content')

<?php
$graphicCards = get_all_graphiccards();
$hardDrives = getallHradDrive();
$processors = getallProcessors();
$rams = getallRams();
$screenSizes = getallScreenSizes();
$ssds = getallSSD();
$types = getalltypes();

    

?>
<style>
    input[type=checkbox].css-checkbox { position: absolute;  overflow: hidden;  clip: rect(0 0 0 0);  height:1px;  width:1px;  margin:-1px;  padding:0; border:0; } 
    input[type=checkbox].css-checkbox + label.css-label { padding-left:20px; height:15px;  display:inline-block; line-height:15px; background-repeat:no-repeat; background-position: 0 0; font-size:15px; vertical-align:middle; cursor:pointer; } 
    input[type=checkbox].css-checkbox:checked + label.css-label { background-position: 0 -15px; } input[type=checkbox].css-checkbox:hover + label.css-label { background-position: 0 -15px; }  .css-label{ background-image:url(http://csscheckbox.com/checkboxes/lite-x-red.png); }
</style>
<!-- Intro Section -->
<section class="intro_part">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="category_page_bar text-center">
                    <h2>@if(!empty($metaDetails)){{$metaDetails->name}} @endif</h2>
                    @if(!empty($metaDetails)){{$metaDetails->description}} @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!--  Intro Section End-->

<!-- Main Heightligh Parts -->
<section class="heightlight_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__product__option">
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible  mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Success!</strong> {{ session()->get('success') }} <a class="primary-btn"
                            href="{{route('view.cart')}}">View Cart</a>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Showing {{$perPage }} of {{$products_count}} results</p>
                                <p>Sort by:</p>
                                
                                    <select style="display: none;" name="sort_by"  form="filterForm" onchange="this.form.submit()">
                                        <option value="price_asc" @if($sortby=='price_asc' ) selected @endif>Price: Low
                                            - High</option>
                                        <option value="price_desc" @if($sortby=='price_desc' ) selected @endif>Price:
                                            High - Low</option>
                                        <option value="new_old" @if($sortby=='new_old' ) selected @endif>New - Old
                                        </option>
                                        <option value="old_new" @if($sortby=='old_new' ) selected @endif>Old - New
                                        </option>
                                        <option value="title_asc" @if($sortby=='title_asc' ) selected @endif>Title: A -
                                            Z</option>
                                        <option value="title_desc" @if($sortby=='title_desc' ) selected @endif>Title: Z
                                            - A</option>
                                        <option value="popular" @if($sortby=='popular' ) selected @endif>Popularity
                                        </option>
                                    </select>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">

                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">CATEGORIES</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                @foreach(getallCategories() as $cat)
                                                <li>
                                                <input id="cat_option_{{$cat->id}}" name="catgoryIds" value="{{$cat->id}}" class="css-checkbox" type="checkbox" onchange="this.form.submit()" @if(!empty($categoriesArray)) @if(in_array($cat->id,$categoriesArray)) checked @endif @endif/>
                                                <label for="cat_option_{{$cat->id}}" class="css-label" onclick="storeAndSubmit('catgoryIds','category_ids')">{{$cat->title}}</label>
                                                <!-- <a
                                                        href="{{route('view.product.category',['productcategorySlug' => $cat->slug])}}">{{$cat->title}}</a> -->
                                                </li>
                                                @endforeach

                                            </ul>
                                            <input type="hidden" name="category_ids" value="@if(isset($_GET['category_ids'])){{$_GET['category_ids']}}@endif">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">BRAND</a>
                                </div>
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                @foreach(getallBrands() as $brand)
                                                <li
                                                    class="@if(!empty($brandArray)) @if(in_array($brand->id,$brandArray)) active @endif @endif">
                                                    <a
                                                        href="{{route('view.product.brand',['productbrandSlug' => $brand->slug])}}">{{$brand->name}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapsethree">GRAPHICS CARD</a>
                                </div>
                                <div id="collapsethree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php $hard_drive_url = $processor_url = $ram_url = $screen_url = $ssd_url = $type_url = '';
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['processor'])){
                                $processor_url = '&processor='.$_GET['processor'];
                            }
                            if(isset($_GET['ram'])){
                               $ram_url = '&ram='.$_GET['ram']; 
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                                                @foreach($graphicCards as $graphic)
                                                <li><a
                                                        href="?graphic={{$graphic->id}}{{$hard_drive_url}}{{$processor_url}}{{$ram_url}}{{$screen_url}}{{$ssd_url}}{{$type_url}}">{{$graphic->title}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">HARD DRIVE</a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php $graphic_url = $processor_url = $ram_url = $screen_url = $ssd_url = $type_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['processor'])){
                                $processor_url = '&processor='.$_GET['processor'];
                            }
                            if(isset($_GET['ram'])){
                               $ram_url = '&ram='.$_GET['ram']; 
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                                                @foreach($hardDrives as $drive)
                                                <li><a
                                                        href="?hard_drive={{$drive->id}}{{$graphic_url}}{{$processor_url}}{{$ram_url}}{{$screen_url}}{{$ssd_url}}{{$type_url}}">{{$drive->title}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFive">Filter Price</a>
                                </div>
                                <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <div class="price-range-slider">
                                                <?php $price_val = $_GET['price'] ?? '';
      $min_price=getminprice();
      $max_price=getmaxprice();
      $new_min_price='';
      $new_max_price='';
      if(!empty($price_val)){
          $price_arr = explode('-',$price_val);
          $new_min_price = $price_arr[0];
          $new_max_price = $price_arr[1];
      }
      ?>



                                                <p class="range-value min_val_box">
                                                    <span>NPR</span>
                                                    <input type="text" id="min_amount" value="" class="price_minimum">
                                                    <span class="price-filter-separator"> - </span> <span>&nbsp;
                                                        NPR</span>
                                                    <input type="text" id="max_amount" value="" class="price_maximum">
                                                </p>

                                                <div id="slider-range" class="range-bar"></div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseSix">PROCESSOR</a>
                                </div>
                                <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php $graphic_url = $hard_drive_url = $ram_url = $screen_url = $ssd_url = $type_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['ram'])){
                               $ram_url = '&ram='.$_GET['ram']; 
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                                                @foreach($processors as $prcsr)
                                                <li><a
                                                        href="?processor={{$prcsr->id}}{{$graphic_url}}{{$hard_drive_url}}{{$ram_url}}{{$screen_url}}{{$ssd_url}}{{$type_url}}">{{$prcsr->title}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseSeven">RAM</a>
                                </div>
                                <div id="collapseSeven" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php $graphic_url = $hard_drive_url = $processor_url = $screen_url = $ssd_url = $type_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['processor'])){
                               $processor_url = '&processor='.$_GET['processor']; 
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                                                @foreach($rams as $ram)
                                                <li><a
                                                        href="?ram={{$ram->id}}{{$graphic_url}}{{$hard_drive_url}}{{$processor_url}}{{$screen_url}}{{$ssd_url}}{{$type_url}}">{{$ram->title}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseEight">SCREEN SIZE</a>
                                </div>
                                <div id="collapseEight" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php $graphic_url = $hard_drive_url = $processor_url = $ram_url = $ssd_url = $type_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['processor'])){
                               $processor_url = '&processor='.$_GET['processor']; 
                            }
                            if(isset($_GET['ram'])){
                                $ram_url = '&ram='.$_GET['ram'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                                                @foreach($screenSizes as $size)
                                                <li><a
                                                        href="?screen_size={{$size->id}}{{$graphic_url}}{{$hard_drive_url}}{{$processor_url}}{{$ram_url}}{{$ssd_url}}{{$type_url}}">{{$size->title}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseNine">SSD</a>
                                </div>
                                <div id="collapseNine" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php $graphic_url = $hard_drive_url = $processor_url = $ram_url = $screen_url = $type_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['processor'])){
                               $processor_url = '&processor='.$_GET['processor']; 
                            }
                            if(isset($_GET['ram'])){
                                $ram_url = '&ram='.$_GET['ram'];
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                                                @foreach($ssds as $ssd)
                                                <li><a
                                                        href="?ssd={{$ssd->id}}{{$graphic_url}}{{$hard_drive_url}}{{$processor_url}}{{$ram_url}}{{$screen_url}}{{$type_url}}">{{$ssd->title}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTen">TYPE</a>
                                </div>
                                <div id="collapseTen" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php $graphic_url = $hard_drive_url = $processor_url = $ram_url = $screen_url = $ssd_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['processor'])){
                               $processor_url = '&processor='.$_GET['processor']; 
                            }
                            if(isset($_GET['ram'])){
                                $ram_url = '&ram='.$_GET['ram'];
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            ?>
                                                @foreach($types as $type)
                                                <li><a
                                                        href="?type={{$type->id}}{{$graphic_url}}{{$hard_drive_url}}{{$processor_url}}{{$ram_url}}{{$screen_url}}{{$ssd_url}}">{{$type->title}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseEleven">Colors</a>
                                </div>
                                <div id="collapseEleven" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                @foreach(getallColors() as $color)
                                                <li><a href="?color={{$color->id}}">{{$color->color_name}}</a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-lg-9">
                    <div class="row">
                        @if($products->count() > 0)
                        @foreach($products as $prod_detail)
                        <div class="col-lg-4">
                            <div class="product__item" data-aos="fade-up" data-aos-duration="1000">
                                <a href="{{route('view.product',['productSlug'=>$prod_detail->slug])}}">
                                    <div class="product__item__pic set-bg"
                                        data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image )}}">
                                    </div>
                                </a>
                                <div class="product__item__text">
                                    <a href="{{route('view.product',['productSlug'=>$prod_detail->slug])}}">
                                        <h6>{{$prod_detail->title}}</h6>
                                    </a>
                                    @if(empty($prod_detail->stock_qty))
                                    <p class="out_stock"><b>Out Of Stock</b></p>
                                    @else
                                    <a href="{{route('add.cart',['id'=>$prod_detail->id])}}" class="add-cart">+ Add To
                                        Cart</a>
                                    @endif
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="g-sys-spec">
                                        <?php //echo Str::limit($prod_detail->features, 140, '');?>
                                    </div>
                                    @if(!empty($prod_detail->sale_price))
                                    <h5>NPR {{number_format($prod_detail->sale_price,2)}} <small>(ind. GST)</small></h5>
                                    <h5 class="striked_price"><strike>NPR
                                            {{number_format($prod_detail->price,2)}}</strike>
                                    </h5>
                                    @else
                                    <h5>NPR {{number_format($prod_detail->price,2)}} <small>(ind. GST)</small></h5>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @endforeach
                        @else
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h5 class="alert alert-danger">No Products Found!</h5>
                        </div>
                        <div class="col-md-2"></div>
                        @endif


                    </div>
                    <div class="row d-flex justify-content-center pagination">
                        {{$products->links('vendor.pagination.bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
    <form method="GET" id="filterForm">
    </form>
</section>

<!-- Main Heightligh End -->
@push('custom-scripts')
<script>
    // A $( document ).ready() block.
    $( document ).ready(function() {
        console.log( "ready!" );
        function storeAndSubmit(from,to){
            var arr = [];
            $.each($("input[name='language']:checked"), function(){
                  arr.push($(this).val());
            });
            console.log( "arr!" , arr);
        }
    });
</script>
@endpush

@endsection
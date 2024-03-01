@extends('front-layout.master_layout')
@section('title',$metaDetails->name??'Products')
@section('meta_keywords',$metaDetails->meta_keywords ?? 'Products')
@section('meta_description',$metaDetails->meta_description ?? 'All the big brand gaming desktops such as Alienware,
ASUS, and HP, mean a heap of power, the latest graphics, and designs that make it easier for you to play longer.
JB&rsquo;s gaming PCs also include big storage models, brand new OS, and accessories to help take your game play to the
next level.')
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
input[type=checkbox].css-checkbox {
    position: absolute;
    overflow: hidden;
    clip: rect(0 0 0 0);
    height: 1px;
    width: 1px;
    margin: -1px;
    padding: 0;
    border: 0;
}

input[type=checkbox].css-checkbox+label.css-label {
    padding-left: 20px;
    height: 15px;
    display: inline-block;
    line-height: 15px;
    background-repeat: no-repeat;
    background-position: 0 0;
    font-size: 15px;
    vertical-align: middle;
    cursor: pointer;
}

input[type=checkbox].css-checkbox:checked+label.css-label {
    background-position: 0 -15px;
}

input[type=checkbox].css-checkbox:hover+label.css-label {
    background-position: 0 -15px;
}

.css-label {
    background-image: url(http://csscheckbox.com/checkboxes/lite-x-red.png);
}
</style>
<!-- Intro Section -->
<section class="intro_part">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="category_page_bar text-center">
                    <h2>@if(!empty($metaDetails)){{$metaDetails->title}}{{$metaDetails->name}} @else Products @endif
                    </h2>
                    @if(!empty($metaDetails)){!! $metaDetails->description !!} @else All the big brand gaming desktops
                    such as Alienware, ASUS, and HP, mean a heap of power, the latest graphics, and designs that make it
                    easier for you to play longer. JB&rsquo;s gaming PCs also include big storage models, brand new OS,
                    and accessories to help take your game play to the next level. @endif
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
                                @php
                                    $productCountFrom = 1;
                                    $productCountTo = $products_count;
                                    if(isset($_GET['page'])){
                                        $page = $_GET['page'];
                                    }else{
                                        $page = 1;
                                    }  
                                    if($products_count > $perPage){ 
                                        $productCountFrom = $perPage*$page-$perPage+1;
                                        if(($perPage*$page) < $products_count){
                                            $productCountTo = $perPage*$page;
                                        }
                                        
                                    }

                                @endphp
                                <p>Showing {{$productCountFrom}} - {{$productCountTo}} of {{ $products_count }} results</p>
                                <p>Sort by:</p>

                                <select style="display: none;" name="sort_by" form="filterForm"
                                    onchange="this.form.submit()">
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
                    <div>
                        <a href="{{route('view.products')}}">Clear Filter</a>
                    </div>
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
                                                <li
                                                    class="@if(!empty($categoriesArray))@if(in_array($cat->id,$categoriesArray))active @endif @endif">
                                                    <input id="cat_option_{{$cat->id}}" name="catgoryIds"
                                                        value="{{$cat->id}}" class="css-checkbox" type="checkbox"
                                                        onchange="storeAndSubmit('catgoryIds','category_ids')"
                                                        @if(!empty($categoriesArray))
                                                        @if(in_array($cat->id,$categoriesArray)) checked @endif @endif
                                                    />
                                                    <label for="cat_option_{{$cat->id}}"
                                                        class="css-label">{{$cat->title}}</label>
                                                    <!-- <a
                                                        href="{{route('view.product.category',['productcategorySlug' => $cat->slug])}}">{{$cat->title}}</a> -->
                                                </li>
                                                @endforeach

                                            </ul>
                                            <input type="hidden" name="category_ids" form="filterForm"
                                                value="@if(isset($_GET['category_ids'])){{$_GET['category_ids']}}@endif">
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
                                                    class="@if(!empty($brandArray))@if(in_array($brand->id,$brandArray))active @endif @endif">
                                                    <input id="brand_option_{{$brand->id}}" name="brandIds"
                                                        value="{{$brand->id}}" class="css-checkbox" type="checkbox"
                                                        onchange="storeAndSubmit('brandIds','brand_ids')"
                                                        @if(!empty($brandArray)) @if(in_array($brand->id,$brandArray))
                                                    checked @endif @endif />
                                                    <label for="brand_option_{{$brand->id}}"
                                                        class="css-label">{{$brand->name}}</label>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="brand_ids" form="filterForm"
                                                value="@if(isset($_GET['brand_ids'])){{$_GET['brand_ids']}}@endif">
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
                                                @foreach($graphicCards as $graphic)
                                                <li
                                                    class="@if(!empty($graphicCardArray))@if(in_array($graphic->id,$graphicCardArray))active @endif @endif">
                                                    <input id="graphic_option_{{$graphic->id}}" name="graphicCardIds"
                                                        value="{{$graphic->id}}" class="css-checkbox" type="checkbox"
                                                        onchange="storeAndSubmit('graphicCardIds','graphic_card_ids')"
                                                        @if(!empty($graphicCardArray))
                                                        @if(in_array($graphic->id,$graphicCardArray)) checked @endif
                                                    @endif />
                                                    <label for="graphic_option_{{$graphic->id}}"
                                                        class="css-label">{{$graphic->title}}</label>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="graphic_card_ids" form="filterForm"
                                                value="@if(isset($_GET['graphic_card_ids'])){{$_GET['graphic_card_ids']}}@endif">
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
                                                @foreach($hardDrives as $drive)
                                                <li
                                                    class="@if(!empty($hardDriveIdsArray))@if(in_array($drive->id,$hardDriveIdsArray))active @endif @endif">
                                                    <input id="drive_option_{{$drive->id}}" name="driveCardIds"
                                                        value="{{$drive->id}}" class="css-checkbox" type="checkbox"
                                                        onchange="storeAndSubmit('driveCardIds','hard_drive_ids')"
                                                        @if(!empty($hardDriveIdsArray))
                                                        @if(in_array($drive->id,$hardDriveIdsArray)) checked @endif
                                                    @endif />
                                                    <label for="drive_option_{{$drive->id}}"
                                                        class="css-label">{{$drive->title}}</label>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="hard_drive_ids" form="filterForm"
                                                value="@if(isset($_GET['hard_drive_ids'])){{$_GET['hard_drive_ids']}}@endif">
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
                                                <?php
                                                    $min_price=getminprice();
                                                    $max_price=getmaxprice();
                                                    
                                                    if(!empty($priceMin) && !empty($priceMax)){
                                                        $min_price_new = $priceMin;
                                                        $max_price_new = $priceMax;
                                                    }
                                                ?>



                                                <p class="range-value min_val_box">
                                                    <span>NPR</span>
                                                    <input type="text" id="min_amount" name="price_min" form="filterForm" value="" class="price_minimum">
                                                    <span class="price-filter-separator"> - </span> <span>&nbsp;
                                                        NPR</span>
                                                    <input type="text" id="max_amount" name="price_max" form="filterForm" value="" class="price_maximum">
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
                                                @foreach($processors as $prcsr)
                                                <li
                                                    class="@if(!empty($processorIdsArray))@if(in_array($prcsr->id,$processorIdsArray))active @endif @endif">
                                                    <input id="prcsr_option_{{$prcsr->id}}" name="prcsrCardIds"
                                                        value="{{$prcsr->id}}" class="css-checkbox" type="checkbox"
                                                        onchange="storeAndSubmit('prcsrCardIds','processor_ids')"
                                                        @if(!empty($processorIdsArray))
                                                        @if(in_array($prcsr->id,$processorIdsArray)) checked @endif
                                                    @endif />
                                                    <label for="prcsr_option_{{$prcsr->id}}"
                                                        class="css-label">{{$prcsr->title}}</label>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="processor_ids" form="filterForm"
                                                value="@if(isset($_GET['processor_ids'])){{$_GET['processor_ids']}}@endif">
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
                                                @foreach($rams as $ram)
                                                <li
                                                    class="@if(!empty($ramIdsArray))@if(in_array($ram->id,$ramIdsArray))active @endif @endif">
                                                    <input id="ram_option_{{$ram->id}}" name="ramCardIds"
                                                        value="{{$ram->id}}" class="css-checkbox" type="checkbox"
                                                        onchange="storeAndSubmit('ramCardIds','ram_ids')"
                                                        @if(!empty($ramIdsArray))
                                                        @if(in_array($ram->id,$ramIdsArray)) checked @endif
                                                    @endif />
                                                    <label for="ram_option_{{$ram->id}}"
                                                        class="css-label">{{$ram->title}}</label>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="ram_ids" form="filterForm"
                                                value="@if(isset($_GET['ram_ids'])){{$_GET['ram_ids']}}@endif">
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
                                                @foreach($screenSizes as $size)
                                                <li
                                                    class="@if(!empty($screenSizeIdsArray))@if(in_array($size->id,$screenSizeIdsArray))active @endif @endif">
                                                    <input id="size_option_{{$size->id}}" name="sizeCardIds"
                                                        value="{{$size->id}}" class="css-checkbox" type="checkbox"
                                                        onchange="storeAndSubmit('sizeCardIds','screen_size_ids')"
                                                        @if(!empty($screenSizeIdsArray))
                                                        @if(in_array($size->id,$screenSizeIdsArray)) checked @endif
                                                    @endif />
                                                    <label for="size_option_{{$size->id}}"
                                                        class="css-label">{{$size->title}}</label>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="screen_size_ids" form="filterForm"
                                                value="@if(isset($_GET['screen_size_ids'])){{$_GET['screen_size_ids']}}@endif">
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
                                                @foreach($ssds as $ssd)
                                                <li
                                                    class="@if(!empty($ssdIdsArray))@if(in_array($ssd->id,$ssdIdsArray))active @endif @endif">
                                                    <input id="ssd_option_{{$ssd->id}}" name="ssdCardIds"
                                                        value="{{$ssd->id}}" class="css-checkbox" type="checkbox"
                                                        onchange="storeAndSubmit('ssdCardIds','ssd_ids')"
                                                        @if(!empty($ssdIdsArray))
                                                        @if(in_array($ssd->id,$ssdIdsArray)) checked @endif
                                                    @endif />
                                                    <label for="ssd_option_{{$ssd->id}}"
                                                        class="css-label">{{$ssd->title}}</label>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="ssd_ids" form="filterForm"
                                                value="@if(isset($_GET['ssd_ids'])){{$_GET['ssd_ids']}}@endif">
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
                                                @foreach($types as $type)
                                                <li
                                                    class="@if(!empty($typeIdsArray))@if(in_array($type->id,$typeIdsArray))active @endif @endif">
                                                    <input id="type_option_{{$type->id}}" name="typeCardIds"
                                                        value="{{$type->id}}" class="css-checkbox" type="checkbox"
                                                        onchange="storeAndSubmit('typeCardIds','type_ids')"
                                                        @if(!empty($typeIdsArray))
                                                        @if(in_array($type->id,$typeIdsArray)) checked @endif
                                                    @endif />
                                                    <label for="type_option_{{$type->id}}"
                                                        class="css-label">{{$type->title}}</label>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="type_ids" form="filterForm"
                                                value="@if(isset($_GET['type_ids'])){{$_GET['type_ids']}}@endif">
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
                                                <li
                                                    class="@if(!empty($colorIdsArray))@if(in_array($color->id,$colorIdsArray))active @endif @endif">
                                                    <input id="color_option_{{$color->id}}" name="colorCardIds"
                                                        value="{{$color->id}}" class="css-checkbox" type="checkbox"
                                                        onchange="storeAndSubmit('colorCardIds','color_ids')"
                                                        @if(!empty($colorIdsArray))
                                                        @if(in_array($color->id,$colorIdsArray)) checked @endif
                                                    @endif />
                                                    <label for="color_option_{{$color->id}}"
                                                        class="css-label">{{$color->color_name}}</label>
                                                </li>
                                                @endforeach
                                                <input type="hidden" name="color_ids" form="filterForm"
                                                value="@if(isset($_GET['color_ids'])){{$_GET['color_ids']}}@endif">
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
function storeAndSubmit(from, to) {
    var arr = [];
    $.each($("input[name='" + from + "']:checked"), function() {
        arr.push($(this).val());
    });
    console.log("arr!", arr.toString());
    $("input[name='" + to + "']").val(arr.toString());
    $("#filterForm").submit();
}
</script>

<script>
$(document).ready(function(){
    
    $("#min_amount").keypress(function(){
        var min_amount = $(this).val();
        var max_amount = $("#max_amount").val();
        
    })
    
    $("#slider-range").slider({
	  range: true,
	  min: {{$min_price}},
	  max: {{$max_price}},
	  values: [ {{$min_price_new ?? $min_price}}, {{$max_price_new ?? $max_price}} ],
	  slide: function( event, ui ) {
		//$( "#amount" ).val( "NPR " + ui.values[ 0 ] + " - NPR " + ui.values[ 1 ] );
		$("#min_amount").val(ui.values[ 0 ]);
		$("#max_amount").val(ui.values[ 1 ]);

        setTimeout(function(){$("#filterForm").submit();}, 1000);
        
	  }
	});
    	
	$("#min_amount").val({{$min_price_new ?? $min_price}});
	$("#max_amount").val({{$max_price_new ?? $max_price}});
})
   
</script>
@endpush

@endsection
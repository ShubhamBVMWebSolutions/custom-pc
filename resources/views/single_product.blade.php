@extends('front-layout.master_layout')
@section('title', $productinfo[0]->title)
@section('meta_keywords',$productinfo[0]->meta_keywords ?? '')
@section('meta_description',$productinfo[0]->meta_description ?? '')
@section('content')

<?php $galleries = array();
$galleries = $productGallery;
$brand_id = $productinfo[0]->brand ?? '';
$brand_name = branddetailById($brand_id)->name ?? '';
$categories = array();
if (!empty($productinfo[0]->product_categories)) {
    $categories = explode(',', $productinfo[0]->product_categories);
}
$catname_arr = array();
foreach ($categories as $catid) {
    $catname_arr[] = getcatdetailByID($catid)[0]->title;
}
$prod_id = $productinfo[0]->id;

?>

<style type="text/css">
    #container_img {
        height: 100%;
        width: 100%;
        overflow: hidden;
    }

    #container_img img {
        transform-origin: center center;
        object-fit: cover;
        height: 100%;
        width: 100%;
    }
</style>

<!-- Single Product Detail Begin -->
<input type="hidden" id="product_id" value="{{$prod_id}}">
<section class="product_detail product_{{$productinfo[0]->id}}">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible  mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Success!</strong> {{ session()->get('success') }} <a class="primary-btn" href="{{route('view.cart')}}">View Cart</a>
                </div>
                @endif
                <div class="breadcrumps">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        @if(!empty($categories))
                        <li><a href="{{route('view.products',['category_ids'=>getcatdetailByID($categories[0])[0]->id])}}">{{getcatdetailByID($categories[0])[0]->title}}</a></li>
                        @endif
                        <li>{{$productinfo[0]->title}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="ajax_loader" style="display: none;"><img src="{{url('public/img/rolling-icon.svg')}}"></div>
                    <div class="row" id="product_gallery_row">
                        @if($variations->count() == 0)
                        <div class="col-lg-3 col-md-3">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" onclick="magnifyImage();" role="tab">
                                        @if(!empty($productinfo[0]->image))
                                        <div class="product__thumb__pic set-bg" data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$productinfo[0]->image )}}">
                                        </div>
                                        @else
                                        <div class="product__thumb__pic set-bg" data-setbg="{{url('public/img/default_pic.png')}}">
                                        </div>
                                        @endif
                                    </a>
                                </li>
                                @php $i=2; @endphp
                                @foreach($galleries as $galimg)
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-{{$i}}" onclick="magnifyImage();" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="{{url(Config::get('constants.PRODUCT_IMAGE_PATH').$galimg->image)}}">
                                        </div>
                                    </a>
                                </li>
                                @php $i++; @endphp
                                @endforeach


                            </ul>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="tab-content" id="container_img">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        @if(!empty($productinfo[0]->image))
                                        <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$productinfo[0]->image )}}" alt="">
                                        @else
                                        <img src="{{url('public/img/default_pic.png')}}" alt="">
                                        @endif
                                    </div>
                                </div>
                                @php $ii=2; @endphp
                                @if($galleries->count() > 0)
                                @foreach($galleries as $galimg)
                                <div class="tab-pane" id="tabs-{{$ii}}" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="{{url(Config::get('constants.PRODUCT_IMAGE_PATH').$galimg->image)}}" alt="">
                                    </div>
                                </div>
                                @php $ii++; @endphp
                                @endforeach
                                @endif
                            </div>
                        </div>
                        @endif
                        @if($variations->count() > 0)
                        <?php $variation_id = $variations[0]->id;
                        $variation_images = getVariationImageById($variation_id); ?>
                        <div class="col-lg-3 col-md-3">
                            <ul class="nav nav-tabs" role="tablist">
                                @php $i=1; @endphp
                                @foreach($variation_images as $varimgs)
                                <li class="nav-item">
                                    <a class="nav-link @if($i == 1) active @endif" data-toggle="tab" href="#tabs-{{$i}}" onclick="magnifyImage();" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$varimgs->variation_image)}}">
                                        </div>
                                    </a>
                                </li>
                                @php $i++; @endphp
                                @endforeach


                            </ul>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="tab-content" id="container_img">
                                @php $ii=1; @endphp
                                @foreach($variation_images as $varimgs)
                                <div class="tab-pane @if($ii == 1) active @endif" id="tabs-{{$ii}}" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$varimgs->variation_image)}}" alt="">
                                    </div>
                                </div>
                                @php $ii++; @endphp
                                @endforeach

                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <span class="new_product">New</span>
                    <h4>{{$productinfo[0]->title}}</h4>
                    <div class="product_rating">
                        @php
                        $product_rating = 0;
                        $product_rating = $productinfo[0]->product_rating($productinfo[0]->id);
                        @endphp
                        <div class="rating">
                            <i class="fa @if($product_rating == 1 || $product_rating == 2 || $product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 2 || $product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 5) fa-star @else fa-star-o @endif"></i>
                        </div>
                    </div>
                    <div class="single_prd_wishlist">

                        @if($productinfo[0]->wishlist_status($productinfo[0]->id) == 1)
                        <i class="fa fa-heart" onclick="toggleWishlistItem('{{$productinfo[0]->id}}')" id="wishlist_icon_{{$productinfo[0]->id}}"></i>
                        @else
                        <i class="fa fa-heart-o" onclick="toggleWishlistItem('{{$productinfo[0]->id}}')" id="wishlist_icon_{{$productinfo[0]->id}}"></i>
                        @endif

                    </div>
                    <div class="sku_text">
                        MODEL: {{$productinfo[0]->model}} SKU: <span id="skuSpan">{{$productinfo[0]->sku}}</span>
                    </div>
                    @if(!empty($productinfo[0]->sale_price))
                        @if($variations->count() > 0)
                            @if(!empty($variations[0]->price))
                            <h3 class="priceTag">NPR {{number_format($variations[0]->price,2)}}</h3>
                            @else
                            <h3 class="priceTag">NPR {{number_format($productinfo[0]->sale_price,2)}}</h3>
                            @endif
                        @else
                            <h3 class="priceTag">NPR {{number_format($productinfo[0]->sale_price,2)}}</h3>
                        @endif

                    <h3 class="strike_price"><strike>NPR {{number_format($productinfo[0]->price,2)}}</strike></h3>
                    @else
                        @if($variations->count() > 0)
                            @if(!empty($variations[0]->price))
                            <h3 class="priceTag">NPR {{number_format($variations[0]->price,2)}}</h3>
                            @else
                            <h3 class="priceTag">NPR {{number_format($productinfo[0]->price,2)}}</h3>
                            @endif
                        @else
                        <h3 class="priceTag">NPR {{number_format($productinfo[0]->price,2)}}</h3>
                        @endif

                    @endif
                    <?= $productinfo[0]->short_description ?>

                    @if(empty($productinfo[0]->stock_qty))
                    <p class="out_stock"><b>Out Of Stock</b></p>
                    @else
                    <p class="in_stock"><b>In Stock</b> <span style="color: red">{{$productinfo[0]->stock_qty}} Left</span></p>
                    @endif
                    <form action="{{route('add.cart',['id'=>$productinfo[0]->id])}}">
                        @csrf
                        @if($variations->count() > 0)
                        @php $k = 1; @endphp
                        <div class="product__details__option__color">
                            <span>Variations:</span>
                            <div class="variant_block_div">
                            @foreach($variations as $clrvar)

                            @php
                            if(empty($clrvar->color_details)){
                                $color_name = "None";
                                $color_code = "#fff";
                                $colorr = $color_code ?? $color_name;
                            }else{
                                $color_name = $clrvar->color_details->color_name;
                                $color_code = $clrvar->color_details->color_code;
                                $colorr = $color_code ?? $color_name;
                            }
                            $variant_price = (!empty($clrvar->price))?$clrvar->price:$productinfo[0]->price;
                            $variant_sku = (!empty($clrvar->sku))?$clrvar->sku:$productinfo[0]->sku;
                            @endphp

                                <label class="color_label @if($k == 1) active @endif" for="" style="background: {{$colorr}};" title="<?= $color_name ?>">
                                    <input type="radio" id="color_variation" data-price="{{number_format($variant_price,2)}}" data-sku="{{$variant_sku}}" name="color_variation" value="{{$clrvar->id}}" @if($k==1) checked @endif>
                                    <div style="mix-blend-mode: difference;color: #9c8989;">
                                        @if(!empty($clrvar->ssd_id))
                                            SSD:- {{$clrvar->ssd_details->title}} <br>
                                        @endif
                                        @if(!empty($clrvar->screen_size_id))
                                            Screen Size:- {{$clrvar->screen_size_details->title}} <br>
                                        @endif
                                        @if(!empty($clrvar->ram_id))
                                            Ram:- {{$clrvar->ram_details->title}} <br>
                                        @endif
                                    </div>
                                </label>



                            @php $k++; @endphp

                            @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="product__details__last__option">
                            <ul>
                                @if(!empty($brand_name))
                                <li><span>Brand:</span> {{$brand_name}}</li>
                                @endif
                                @if(!empty($catname_arr))
                                <li><span>Categories:</span> <?php echo join(', ', $catname_arr); ?></li>
                                @endif
                            </ul>
                        </div>
                        @if(!empty($productinfo[0]->stock_qty))

                        <div class="product__details__cart__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="quantity" max="<?= $productinfo[0]->stock_qty ?>" value="1">
                                </div>
                            </div>
                            <input type="hidden" name="price" value="{{$productinfo[0]->sale_price ?? $productinfo[0]->price}}">
                            <button type="submit" class="primary-btn">Add to cart</button>
                        </div>

                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#overview" role="tab">Product Overview</a>
                        </li>
                        <!-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#details" role="tab">Details</a>
                            </li> -->
                        @if(!empty($productinfo[0]->features))
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tech_specs" role="tab">Tech Specs</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel">
                            <div class="product__details__tab__content">
                                <div class="product__details__tab__content__item">
                                    <h5>Products Overview</h5>
                                    <?= $productinfo[0]->product_overview ?>
                                </div>
                                <div class="product__details__tab__content__item">
                                    <h5>
                                        <!--Material used-->
                                        What's in the box
                                    </h5>
                                    <?= $productinfo[0]->material ?>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane" id="details" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Details</h5>
                                        <?= $productinfo[0]->details ?>
                                    </div>
                                </div>
                            </div> -->

                        <div class="tab-pane" id="tech_specs" role="tabpanel">
                            <div class="product__details__tab__content">
                                <div class="product__details__tab__content__item">
                                    <h5>Product Tech Features</h5>
                                    <div class="tech_info_ul">
                                        <?= $productinfo[0]->features ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="reviews" role="tabpanel">
                            <div class="product__details__tab__content">
                                <div class="product__details__tab__content__item">
                                    @if($product_reviews->count() > 0)
                                    @foreach($product_reviews as $row)
                                    <div class="review__section">
                                        <div class="top__row">
                                            <div class="rating" style="color:rgb(255, 199, 0);">
                                                <i class="fa @if($row->rating == 1 || $row->rating == 2 || $row->rating == 3 || $row->rating == 4 || $row->rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->rating == 2 || $row->rating == 3 || $row->rating == 4 || $row->rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->rating == 3 || $row->rating == 4 || $row->rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->rating == 4 || $row->rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->rating == 5) fa-star @else fa-star-o @endif"></i>
                                            </div>
                                            <p><strong>{{$row->user->name}}</strong></p>
                                            <p>{{time_elapsed_string($row->created_at)}}</p>
                                        </div>
                                        <div class="middle__row">
                                            <h4>{{$row->review_title}}</h4>
                                            <p>{{$row->review_content}}</p>
                                        </div>
                                        <div class="bottom__row">
                                            <p><strong> Quality :</strong></p>
                                            <div class="list_bar_rating">
                                                <ul>
                                                    @for($i = 1; $i <= $row->quality_rating;$i++)
                                                        <li></li>
                                                        @endfor
                                                </ul>
                                            </div>
                                            <p><strong> Value of Product :</strong></p>
                                            <div class="list_bar_rating">
                                                <ul>
                                                    @for($j = 1; $j <= $row->value_for_money_rating;$j++)
                                                        <li></li>
                                                        @endfor
                                                </ul>
                                            </div>
                                            <p><strong> Recommends this product : @if($row->recommend_product == 'Yes') <i class="fa fa-check text-success" aria-hidden="true"></i> @endif @if($row->recommend_product == 'No') <i class="fa fa-times text-red" aria-hidden="true"></i> @endif {{$row->recommend_product}} </strong></p>
                                        </div>
                                    </div>

                                    @endforeach


                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Single Product Detail End -->


<?php $related_prods = '';
if (!empty($productinfo[0]->related_products)) {
    $related_prods = explode(',', $productinfo[0]->related_products);
} ?>
<!-- Related Section Begin -->
@if(!empty($related_prods))
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title text-left">Related Product</h3>
            </div>
        </div>

        <div class="owl-carousel related_prod_slider owl-theme">
            @foreach($related_prods as $relprodid)
            <?php $prodDetail = productDetailById($relprodid); ?>
            <div class=" item">
                <div class="product__item">
                    <a href="{{route('view.product',['productSlug'=>$prodDetail->slug])}}">
                        <div class="product__item__pic set-bg" data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$prodDetail->image )}}">

                        </div>
                    </a>
                    <div class="product__item__text">
                        <h6>{{$prodDetail->title}}</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <div class="g-sys-spec">
                            <?= $prodDetail->features ?>
                        </div>

                        <h5>NPR {{number_format($prodDetail->price,2)}} <small>(Incl. VAT)</small></h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- Related Section End -->



@endsection

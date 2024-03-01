@extends('front-layout.master_layout')
@section('title', 'Home')
@section('meta_keywords',metaTagsByKeyPage('home','meta_keywords'))
@section('meta_description',metaTagsByKeyPage('home','meta_description'))
@section('content')

<!--     Intro Section -->
@if($homesection[0]->status=='1')
<section class="intro_part_home">
    <div class="container-fluid2">
        <div class="row2 justify-content-center2">
             <div class="col-lg-122">
                         <div class="hero__slider owl-carousel owl-theme">

                             @foreach($homeslider as $key=>$slider)
                            <div class="hero__items set-bg" data-setbg="{{url(Config::get('constants.HOME_SLIDER_IMAGE_PATHS').$slider->background_image) ?? ''}}">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="intro_content">
                                                    <h1><span>{{$slider->text1}} </span> {{$slider->text2}}</h1>
                                                    <p><?=$slider->content?></p>
                                                    <a class="primary-btn" href="{{$slider->button_link ?? route('pcbuilder')}}"> {{ $slider->button_text ?? 'Start Your Build' }} <span class="arrow_right"></span></a>
                                              </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="jump_image">
                                               <img src="{{url(Config::get('constants.HOME_SLIDER_IMAGE_PATHS').$slider->image) ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                  </div>
             </div>
        </div>

    </div>
</section>
@endif
<!--     Intro Section End-->
@if($homesection[1]->status=='1')
<!-- Featured image Begin -->
    <section class="featured_images">
        <div class="container">
                <div class="row justify-content-center trusted_box_area">
                      <div class="col-lg-10">
                            <div class="trusted_box text-center">
                                <h3 data-aos="fade-up">Trusted by users at leading companies around the world</h3>
                            </div>
                            <div class="customer-logos slider" data-aos="fade-up">
                                @foreach($homelogos as $key=>$logo)
                              <div class="slide"><img src="{{url(Config::get('constants.HOME_LOGOS_IMAGE_PATHS').$logo->image)}}" alt=""></div>
                              @endforeach

                            </div>
                      </div>
                </div>
            <div class="row">
                <div class="col-lg-12 section__title_gap">
                    <div class="section-title">
                        <h2 class="white_text_heading" data-aos="fade-up">Getting started with BVM Web Solutions</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($gettingsdata as $key=>$getting)
                <div class="col-lg-4 col-md-4">
                    <div class="custom_favorite_box" data-aos="fade-up" data-aos-duration="1000">
                        <div class="favorite_img">
                            <img src="{{url(Config::get('constants.SITE_IMAGE_PATHS').$getting->image)}}">
                        </div>
                        <div class="favorite_content">
                            <h2 class="process_title">0{{$key+1}}.</h2>
                            <h3>{{$getting->title}}</h3>
                            <p>{{$getting->text}}</p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Featured image end -->
  @endif
    <!-- Main Heightligh Parts -->

@if(session()->has('success'))
    <script>window.location = "{{ route('view.cart') }}";</script>
@endif

@if($homesection[2]->status=='1')
<section class="heightlight_part home_black_part">
    <div class="container">
            <div class="row align-items-center title_blog_b_space">
                 <div class="col-lg-6">
                    <div class="section-title text-left section_white" data-aos="fade-up">
                        <span>Our Brands </span>
                        <h2>Top Selling Products</h2>
                    </div>
                 </div>
                 <div class="col-lg-6 text-right" data-aos="fade-up">
                    <!--<a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>-->
                 </div>
            </div>
            <div class="row">
                <?php $no = 1;

                foreach($selling_products as $topselling_prod){
                $prod_id = $topselling_prod->product_id ?? '';
                $prod_detail = productDetailById($prod_id);
                if(!empty($prod_detail) && $prod_detail->product_type == 'product' && $prod_detail->status == 1){
                ?>
                 <div class="col-lg-4 col-md-6">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="1000">
                        <div class="wishlist_product">

                            @if($prod_detail->wishlist_status($prod_detail->id) == 1)
                                <i class="fa fa-heart" onclick="toggleWishlistItem('{{$prod_detail->id}}')" id="wishlist_icon_{{$prod_detail->id}}"></i>
                            @else
                                <i class="fa fa-heart-o" onclick="toggleWishlistItem('{{$prod_detail->id}}')" id="wishlist_icon_{{$prod_detail->id}}"></i>
                            @endif

                        </div>
                        <a href="{{route('view.product',['productSlug'=>$prod_detail->slug ?? ''])}}">
                        <div class="product__item__pic set-bg" data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image ?? '' )}}">

                        </div>
                        </a>
                        <div class="product__item__text">
                            <a href="{{route('view.product',['productSlug'=>$prod_detail->slug ?? ''])}}"><h6>{{$prod_detail->title ?? ''}}</h6></a>
                            <a href="{{route('add.cart',['id'=>$prod_id])}}" class="add-cart">+ Add To Cart</a>
                            @php
                            $product_rating = 0;
                            $product_rating = $prod_detail->product_rating($prod_detail->id);
                            @endphp
                            <div class="rating">
                            <i class="fa @if($product_rating == 1 || $product_rating == 2 || $product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 2 || $product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            </div>

                            <div class="g-sys-spec">
                            <?php //echo Str::limit($prod_detail->features, 110, '');?>
                            </div>
                            @if(!empty($prod_detail->sale_price))
                            <h5>NPR {{number_format($prod_detail->sale_price,2)}} <small>(Incl. VAT)</small></h5>
                            <h5><strike>NPR {{number_format($prod_detail->price,2)}}</strike></h5>
                            @else
                            <h5>NPR {{number_format($prod_detail->price,2)}} <small>(Incl. VAT)</small></h5>
                            @endif

                        </div>
                    </div>
                 </div>
                 <?php $no++;
                 if($no == 7){
                     break;
                 }
                 }
                 } ?>

            </div>

        </div>
</section>
@endif
<!-- Main Heightligh End -->
@if($homesection[3]->status=='1')
<!--  Featured products -->
    <section class="Products_blocks">
        <div class="container">
            <div class="row align-items-center title_blog_b_space">
                 <div class="col-lg-6">
                    <div class="section-title text-left section_white" data-aos="fade-up">
                        <span>Latest Releases</span>
                        <h2>Featured Products</h2>
                    </div>
                 </div>
                 <div class="col-lg-6 text-right" data-aos="fade-up">
                    <!--<a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>-->
                 </div>

            </div>
            @if($featured_products->count() > 0)
            <div class="row">
                @foreach($featured_products as $featured)
                @if($featured->product_type == 'product')
                @php
                    $prod_id = $featured->id ?? '';
                    $prod_detail = productDetailById($prod_id);
                @endphp
                 <div class="col-lg-4 col-md-6">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="1000">
                        <div class="wishlist_product">
                            @if(!empty($prod_detail))
                                @if($featured->wishlist_status($prod_detail->id) == 1)
                                    <i class="fa fa-heart" onclick="toggleWishlistItem('{{$featured->id}}')" id="wishlist_icon_{{$featured->id}}"></i>
                                @else
                                    <i class="fa fa-heart-o" onclick="toggleWishlistItem('{{$featured->id}}')" id="wishlist_icon_{{$featured->id}}"></i>
                                @endif
                            @else
                                <i class="fa fa-heart-o" onclick="toggleWishlistItem('{{$featured->id}}')" id="wishlist_icon_{{$featured->id}}"></i>
                            @endif


                        </div>
                        <a href="{{route('view.product',['productSlug'=>$featured->slug])}}">
                        <div class="product__item__pic set-bg" data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$featured->image )}}">

                        </div>
                        </a>
                        <div class="product__item__text">
                           <a href="{{route('view.product',['productSlug'=>$featured->slug])}}"> <h6>{{$featured->title}}</h6> </a>
                            <a href="{{route('add.cart',['id'=>$featured->id])}}" class="add-cart">+ Add To Cart</a>
                            @php
                            $product_rating = 0;
                            if(!empty($prod_detail)){
                                $product_rating = $prod_detail->product_rating($prod_detail->id);
                            }

                            @endphp
                            <div class="rating">
                            <i class="fa @if($product_rating == 1 || $product_rating == 2 || $product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 2 || $product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if($product_rating == 5) fa-star @else fa-star-o @endif"></i>
                            </div>

                            <div class="g-sys-spec">
                            <?php //echo Str::limit($featured->features, 140, ''); ?>
                            </div>
                            @if(!empty($featured->sale_price))
                            <h5>NPR {{number_format($featured->sale_price,2)}} <small>(Incl. VAT)</small></h5>
                            <h5><strike>NPR {{number_format($featured->price,2)}}</strike></h5>
                            @else
                            <h5>NPR {{number_format($featured->price,2)}} <small>(Incl. VAT)</small></h5>
                            @endif

                        </div>
                    </div>
                 </div>
                 @endif
                @endforeach
            </div>
            @endif
        </div>
    </section>
<!-- Featured products end -->
@endif


<!-- Testimonials -->
@if($homesection[4]->status=='1')
<section class="testimonials_block">
    <div class="container">
            <div class="row title_blog_b_space">
                 <div class="col-lg-12">
                    <div class="section-title text-center" data-aos="fade-up">
                        <span>People talk</span>
                        <h2>What our customers say</h2>
                    </div>
                 </div>

            </div>
            <div class="row">
                @foreach($testimonials as $key=>$testi)
                  <div class="col-lg-4">
                      <div class="testi_widget_block" data-aos="fade-up" data-aos-duration="1000">
                            <div class="author_img_block">
                                    <img src="{{url(Config::get('constants.TESTIMONIAL_IMAGE_PATHS').$testi->image)}}">
                            </div>
                            <div class="author_content">
                                <h3>{{$testi->name}}</h3>
                                <h6>{{$testi->company}}</h6>
                                <p>"<?=$testi->content?>"</p>
                            </div>
                      </div>
                  </div>
                  @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12 text-center mb-top_space" data-aos="fade-up">
                    <a href="{{route('testimonial')}}" class="primary-btn">View All <span class="arrow_right"></span></a>
                    <button type="button" class="give_feedback_btn primary-btn" data-toggle="modal" data-target="#feedbackModalCenter">Give a Feedback <span class="arrow_right"></span></button>
                </div>
            </div>
    </div>
    @endif
    <!-- Modal -->
<div class="modal fade" id="feedbackModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Leave a Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="review_form">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company_name" class="form-control">
            </div>

            <div class="form-group">
                <label>Reveiw</label>
                <textarea name="review" cols="10" rows="5" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label>Upload Image</label><br>
                <input type="file" name="image">
            </div>
            <hr>
            <div class="form-group text-center review_submit_div">
            <button type="submit" class="btn btn-primary" name="leave_feedback">Submit</button>
            <div class="gif_ajax_loadr" style="display: none;"><img src="{{asset('img\Reload-1s-200px.gif')}}" height="50" width="50"></div>
            </div>
            <div class="testi_msg text-center"></div>
        </form>
      </div>
    </div>
  </div>
</div>
</section>

<!-- Testimonials end -->

@endsection

@extends('front-layout.master_layout')
@section('title', 'Home')
@section('content')

<!--     Intro Section -->

<section class="intro_part">
    <div class="container-fluid">
        <div class="row justify-content-center">
             <div class="col-lg-12">
                         <div class="hero__slider owl-carousel">

                             @foreach($homeslider as $key=>$slider)
                            <div class="hero__items">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12 col-lg-12 col-md-12">
                                            <div class="intro_content">
                                                    <h1><span>{{$slider->text1}} </span> {{$slider->text2}}</h1>
                                                    <p><?=$slider->content?></p>
                                                    <a class="primary-btn" href="#"> Start Your Build <span class="arrow_right"></span></a>
                                              </div>
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
        <div class="row justify-content-center">
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
    </div>
</section>

<!--     Intro Section End-->

<!-- Featured image Begin -->
    <section class="featured_images">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 section__title_gap">
                    <div class="section-title">
                        <h2 class="white_text_heading" data-aos="fade-up">Getting started with BVM Web Solutions</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($gettingsdata as $key=>$getting)
                <div class="col-lg-4">
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

    <!-- Main Heightligh Parts -->

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
                 <div class="col-lg-4">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="1000">
                        <div class="product__item__pic set-bg" data-setbg="{{url('public/img/product/product-1.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{url('public/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>ASUS PRIME Z690-P WIFI D4 LGA1700 ATX Motherboard</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <ul class="g-sys-spec">
                                <li> Windows 10 Home (64-bit Edition)</li>
                                <li> 15.6" - FHD (1920x1080) - 144Hz</li>
                                <li> Intel® Core™ i7-11800H CPU</li>
                                <li> 16GB DDR4 Memory</li>
                                <li> NVIDIA® GeForce RTX™ 3080 8GB Video Card</li>
                                <li> 1TB NVMe PCIe Gen3x4 Solid State Drive</li>
                            </ul>
                            <h5>NPR 67.24 <small>(ind. GST)</small></h5>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-4">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="1500">
                        <div class="product__item__pic set-bg" data-setbg="{{url('public/img/product/product-2.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{url('public/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>ASUS PRIME Z690-P WIFI D4 LGA1700 ATX Motherboard</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <ul class="g-sys-spec">
                                <li> Windows 10 Home (64-bit Edition)</li>
                                <li> 15.6" - FHD (1920x1080) - 144Hz</li>
                                <li> Intel® Core™ i7-11800H CPU</li>
                                <li> 16GB DDR4 Memory</li>
                                <li> NVIDIA® GeForce RTX™ 3080 8GB Video Card</li>
                                <li> 1TB NVMe PCIe Gen3x4 Solid State Drive</li>
                            </ul>
                            <h5>NPR 67.24 <small>(ind. GST)</small></h5>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-4">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="2000">
                        <div class="product__item__pic set-bg" data-setbg="{{url('public/img/product/product-5.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{url('public/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>ASUS PRIME Z690-P WIFI D4 LGA1700 ATX Motherboard</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <ul class="g-sys-spec">
                                <li> Windows 10 Home (64-bit Edition)</li>
                                <li> 15.6" - FHD (1920x1080) - 144Hz</li>
                                <li> Intel® Core™ i7-11800H CPU</li>
                                <li> 16GB DDR4 Memory</li>
                                <li> NVIDIA® GeForce RTX™ 3080 8GB Video Card</li>
                                <li> 1TB NVMe PCIe Gen3x4 Solid State Drive</li>
                            </ul>
                            <h5>NPR 67.24 <small>(ind. GST)</small></h5>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="row">
                 <div class="col-lg-4">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="2500">
                        <div class="product__item__pic set-bg" data-setbg="{{url('public/img/product/product-1.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{url('public/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>ASUS PRIME Z690-P WIFI D4 LGA1700 ATX Motherboard</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <ul class="g-sys-spec">
                                <li> Windows 10 Home (64-bit Edition)</li>
                                <li> 15.6" - FHD (1920x1080) - 144Hz</li>
                                <li> Intel® Core™ i7-11800H CPU</li>
                                <li> 16GB DDR4 Memory</li>
                                <li> NVIDIA® GeForce RTX™ 3080 8GB Video Card</li>
                                <li> 1TB NVMe PCIe Gen3x4 Solid State Drive</li>
                            </ul>
                            <h5>NPR 67.24 <small>(ind. GST)</small></h5>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-4">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="3000">
                        <div class="product__item__pic set-bg" data-setbg="{{url('public/img/product/product-2.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{url('public/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>ASUS PRIME Z690-P WIFI D4 LGA1700 ATX Motherboard</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <ul class="g-sys-spec">
                                <li> Windows 10 Home (64-bit Edition)</li>
                                <li> 15.6" - FHD (1920x1080) - 144Hz</li>
                                <li> Intel® Core™ i7-11800H CPU</li>
                                <li> 16GB DDR4 Memory</li>
                                <li> NVIDIA® GeForce RTX™ 3080 8GB Video Card</li>
                                <li> 1TB NVMe PCIe Gen3x4 Solid State Drive</li>
                            </ul>
                            <h5>NPR 67.24 <small>(ind. GST)</small></h5>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-4">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="3000">
                        <div class="product__item__pic set-bg" data-setbg="{{url('public/img/product/product-5.jpg')}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{url('public/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{url('public/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>ASUS PRIME Z690-P WIFI D4 LGA1700 ATX Motherboard</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <ul class="g-sys-spec">
                                <li> Windows 10 Home (64-bit Edition)</li>
                                <li> 15.6" - FHD (1920x1080) - 144Hz</li>
                                <li> Intel® Core™ i7-11800H CPU</li>
                                <li> 16GB DDR4 Memory</li>
                                <li> NVIDIA® GeForce RTX™ 3080 8GB Video Card</li>
                                <li> 1TB NVMe PCIe Gen3x4 Solid State Drive</li>
                            </ul>
                            <h5>NPR 67.24 <small>(ind. GST)</small></h5>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
</section>

<!-- Main Heightligh End -->

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
                 @if(session()->has('success'))
                 <script>window.location = "{{ route('view.cart') }}";</script>
    <!--             <div class="col-lg-6" data-aos="fade-up">-->
    <!--             <div class="alert alert-success alert-dismissible  mb-2" role="alert">-->
    <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
    <!--<span aria-hidden="true">×</span>-->
    <!--</button>-->
    <!--<strong>Success!</strong> {{ session()->get('success') }}-->
    <!--</div>-->
    <!--</div>-->
                 @endif
            </div>
            @if($featured_products->count() > 0)
            <div class="row">
                @foreach($featured_products as $featured)
                 <div class="col-lg-4">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="1000">
                        <div class="product__item__pic set-bg" data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$featured->image )}}">

                        </div>
                        <div class="product__item__text">
                            <h6>{{$featured->title}}</h6>
                            <a href="{{route('add.cart',['id'=>$featured->id])}}" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="g-sys-spec">
                            <?=$featured->features?>
                            </div>
                            @if(!empty($featured->sale_price))
                            <h5>NPR {{number_format($featured->sale_price,2)}} <small>(ind. GST)</small></h5>
                            <h5><strike>NPR {{number_format($featured->price,2)}}</strike></h5>
                            @else
                            <h5>NPR {{number_format($featured->price,2)}} <small>(ind. GST)</small></h5>
                            @endif
                        </div>
                    </div>
                 </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
<!-- Featured products end -->

<section class="brands_part">
            <div class="container-fluid">
                     <div class="row">
                            <div class="col-lg-6">
                                <div class="brand_left_block" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="section-title text-left">
                                                <span>Start Now</span>
                                                <h2>{{homepagesectionById(1)->section_title}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom_brands_content" data-aos="fade-up">
                                        <div class="img-block-brands">
                                            <img src="{{url(Config::get('constants.HOME_IMAGES_PATH').homepagesectionById(1)->image )}}">
                                        </div>
                                        <p><?=homepagesectionById(1)->content?></p>
                                        <a href="{{homepagesectionById(1)->section_link}}" class="primary-btn">Customize PC <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="brand_right_block white_text" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="section-title text-left white_text">
                                                <span>Start Now</span>
                                                <h2>{{homepagesectionById(2)->section_title}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom_brands_content" data-aos="fade-up">
                                        <div class="img-block-brands">
                                            <img src="{{url(Config::get('constants.HOME_IMAGES_PATH').homepagesectionById(2)->image )}}">
                                        </div>
                                        <p><?=homepagesectionById(2)->content?></p>
                                        <a href="{{homepagesectionById(2)->section_link}}" class="primary-btn">Customize PC <span class="arrow_right"></span></a>
                                    </div>

                                </div>
                            </div>
                 </div>
            </div>
    </section>

    <!-- Promo Box -->
<section class="promo_box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="promo_content" data-aos="fade-up" data-aos-duration="1000">
                        <div class="promo_c_left">
                            <h2>{{homepagesectionById(3)->section_title}}</h2>
                            <p><?=homepagesectionById(3)->content?></p>
                            <a href="{{homepagesectionById(3)->section_link}}" class="primary-btn site_btn">Customize PC <span class="arrow_right"></span></a>
                        </div>
                        <div class="promo_c_right">
                            <img src="{{url(Config::get('constants.HOME_IMAGES_PATH').homepagesectionById(3)->image )}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
<!-- Promo Box End-->

<!-- Testimonials -->

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
                <input type="text" name="name" class="form-control">
            </div>

            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company_name" class="form-control">
            </div>

            <div class="form-group">
                <label>Reveiw</label>
                <textarea name="review" cols="10" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Upload Image</label><br>
                <input type="file" name="image">
            </div>
            <hr>
            <div class="form-group text-center review_submit_div">
            <button type="submit" class="btn btn-primary" name="leave_feedback">Submit</button>
            <div class="gif_ajax_loadr" style="display: none;"><img src="{{url('public\img\Reload-1s-200px.gif')}}" height="50" width="50"></div>
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

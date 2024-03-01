@extends('front-layout.master_layout')
@section('title', 'Home')
@section('meta_keywords',metaTagsByKeyPage('home','meta_keywords'))
@section('meta_description',metaTagsByKeyPage('home','meta_description'))
@section('content')

<!--     Intro Section -->

<section class="intro_part_home">
    <div class="container-fluid">
        <div class="row justify-content-center">
             <div class="col-lg-12">
                         <div class="hero__slider owl-carousel">
                             
                             @foreach($homeslider as $key=>$slider)
                            <div class="hero__items">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="intro_content">
                                                    <h1><span>{{$slider->text1}} </span> {{$slider->text2}}</h1>
                                                    <p><?=$slider->content?></p>
                                                    <a class="primary-btn" href="{{route('pcbuilder')}}"> Start Your Build <span class="arrow_right"></span></a>
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

<!--     Intro Section End-->

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
                        <h2 class="white_text_heading" data-aos="fade-up">Getting started with Star Office Internatonal</h2>
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
    
    <!-- Main Heightligh Parts -->
    
@if(session()->has('success'))
    <script>window.location = "{{ route('view.cart') }}";</script>
@endif

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
                if(!empty($prod_detail) && $prod_detail->product_type == 'product'){
                ?>
                 <div class="col-lg-4 col-md-6">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="1000">
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
                            <h5>NPR {{number_format($prod_detail->sale_price,2)}} <small>(ind. GST)</small></h5>
                            <h5><strike>NPR {{number_format($prod_detail->price,2)}}</strike></h5>
                            @else
                            <h5>NPR {{number_format($prod_detail->price,2)}} <small>(ind. GST)</small></h5>
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
                 
            </div>
            @if($featured_products->count() > 0)
            <div class="row">
                @foreach($featured_products as $featured)
                @if($featured->product_type == 'product')
                 <div class="col-lg-4 col-md-6">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="1000">
                        <a href="{{route('view.product',['productSlug'=>$featured->slug])}}">
                        <div class="product__item__pic set-bg" data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$featured->image )}}">
                            
                        </div>
                        </a>
                        <div class="product__item__text">
                           <a href="{{route('view.product',['productSlug'=>$featured->slug])}}"> <h6>{{$featured->title}}</h6> </a>
                            <a href="{{route('add.cart',['id'=>$featured->id])}}" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            
                            <div class="g-sys-spec">
                            <?php //echo Str::limit($featured->features, 140, ''); ?>
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
                 @endif
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
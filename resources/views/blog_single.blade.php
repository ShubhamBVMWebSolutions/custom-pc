@extends('front-layout.master_layout')
@section('title', 'Blogs')
@section('content')
<!-- blog  -->
    <section class="catalogues">  
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                      <div class="single_blog_img">
                          <?php if(!empty($blog->image)){$image = url('public/uploads/blogs/'.$blog->image);}else{$image = url('public/img/default_pic.png');} ?>
                          <img src="{{$image}}">
                      </div>
                      <div class="single_blog_content">
                        <div class="cate_blog">{{ $blog->blog_category->title}}</div>
                          <div class="blog_date">{{ (!empty($blog->published_at)) ? date('d M Y',strtotime($blog->published_at)):"" }}</div>
                          <h1>{{ $blog->title }}</h1>
                          {!! $blog->content !!}
                      </div> 
                </div>    
            </div>
            <div class="row">
                <div class="col-lg-12">
                        <div class="single_product_slider owl-carousel blog_product_slider">
                            @if(isset($products))
                                @if($products->count() > 0)
                                    @foreach($products as $product)
                                            <div class="slider_product">
                                                <div class="product_box">
                                                    <div class="product_img"> 
                                                        <?php if(!empty($product->image)){$image = url(Config::get('constants.SITE_PRODUCT_IMAGE').$product->image );}else{$image = url('public/img/default_pic.png');} ?>
                                                        <a href="{{route('view.product',['productSlug'=>$product->slug])}}"><img src="{{$image}}"></a>
                                                    </div>
                                                    <div class="product_content">  
                                                        <div class="text_conent">
                                                            <h5><a href="{{route('view.product',['productSlug'=>$product->slug])}}">{{$product->title}}</a></h5>
                                                        </div> 
                                                    </div> 
                                                </div>    
                                            </div>
                                    @endforeach
                                @endif
                            @endif
                    </div>
                </div>    
            </div>    
        </div>    
    </section>
    <!-- blog end -->
@endsection
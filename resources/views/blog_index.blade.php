@extends('front-layout.master_layout')
@section('title', 'Blogs')
@section('content')
    <!-- Blog Intro -->
    <section class="blog_inro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog_intro_top_head text-center">
                        <h2>STACK</h2>
                        <p>The latest in tech and entertainment</p>
                    </div> 
                </div>    
            </div>
            <div class="row">
                <div class="col-lg-8">
                    @if($blogs->count() > 0)
                        <div class="left_top_blog">
                            <a href="{{route('blog.single',[$blogs[0]->blog_category->slug,$blogs[0]->type,$blogs[0]->slug])}}" class="blog_post">
                                    <div class="img_blog">
                                        <?php if(!empty($blogs[0]->image)){$image = url('public/uploads/blogs/'.$blogs[0]->image);}else{$image = url('public/img/default_pic.png');} ?>
                                        <img src="{{$image}}">
                                    </div>
                                    <div class="blog_content">
                                     <div class="cate_blog">{{ $blogs[0]->blog_category->title }}</div>   
                                     <h4>{{ $blogs[0]->title }}</h4>   
                                     <p>{!! limit_text($blogs[0]->content,150) !!}</p>
                                     <!--<p class="cate_list">{{ $blogs[0]->blog_category->title }} {{ $blogs[0]->type }}</p>-->
                                    </div>    
                            </a>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    
                    <div class="right_top_blog">
                        @if($blogs->count() > 1)
                        <a href="{{route('blog.single',[$blogs[1]->blog_category->slug,$blogs[1]->type,$blogs[1]->slug])}}" class="blog_post">
                                <div class="img_blog">
                                    <?php if(!empty($blogs[1]->image)){$image = url('public/uploads/blogs/'.$blogs[1]->image);}else{$image = url('public/img/default_pic.png');} ?>
                                    <img src="{{$image}}">
                                </div>
                                <div class="blog_content">
                                 <div class="cate_blog">{{ $blogs[1]->blog_category->title }}</div>      
                                 <h4>{{ $blogs[1]->title }}</h4>   
                                </div>    
                        </a>
                        @endif
                        @if($blogs->count() > 2)
                        <a href="{{route('blog.single',[$blogs[2]->blog_category->slug,$blogs[2]->type,$blogs[2]->slug])}}" class="blog_post">
                                <div class="img_blog">
                                    <?php if(!empty($blogs[2]->image)){$image = url('public/uploads/blogs/'.$blogs[2]->image);}else{$image = url('public/img/default_pic.png');} ?>
                                    <img src="{{$image}}">
                                </div>
                                <div class="blog_content">
                                 <div class="cate_blog">{{ $blogs[2]->blog_category->title }}</div>      
                                 <h4>{{ $blogs[2]->title }}</h4>   
                                </div>    
                        </a>
                        @endif
                    </div>    
                </div>    
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="top_cate_list">
                        <ul>
                            @if($blog_categories_selected->count() > 0) 
                                @foreach($blog_categories as $category_s)
                                    <li><a href="{{ route('blog.category',[$category_s->slug ])}}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> {{ $category_s->title }}</a></li>
                                @endforeach
                            @endif
                        </ul>   
                    </div>
                </div>    
            </div>   
        </div>    
    </section>
    <!-- Blog Intro end-->
    <!-- blog  -->
    <section class="catalogues">
        <div class="container">
            @if($blog_categories->count() > 0)
                @foreach($blog_categories as $category)
            <div class="row">
                <div class="col-lg-12">
                    <div class="title_cate"> 
                        <a href="{{ route('blog.category',[$category->slug ])}}"><h2>{{ $category->title }} <i class="fa fa-angle-right" aria-hidden="true"></i></h2></a>
                    </div>    
                </div>    
            </div>
            @if($category->blogs->count() > 0)
                    <div class="list_catalogues">
                        <div class="row">
                            @foreach($category->blogs as $cat_blog)
                            <div class="col-lg-4">
                               <a href="{{route('blog.single',[$cat_blog->blog_category->slug,$cat_blog->type,$cat_blog->slug])}}" class="blog_post">
                                    <div class="img_blog">
                                        <?php if(!empty($cat_blog->image)){$image = url('public/uploads/blogs/'.$cat_blog->image);}else{$image = url('public/img/default_pic.png');} ?>
                                        <img src="{{$image}}">
                                    </div>
                                    <div class="blog_content">
                                     <h4>{{ $cat_blog->title }}</h4>   
                                     <p>{!! limit_text($cat_blog->content,100) !!}</p>
                                     <p class="cate_list">{{ $category->title }} {{ $cat_blog->type }}</p>
                                    </div>    
                               </a>   
                            </div>
                        @endforeach
                        </div>    
                    </div>
            @endif
            

            <!--<div class="row">-->
            <!--    <div class="col-lg-12">-->
            <!--        <div class="title_cate"> -->
            <!--            <a href="#"><h2>Upcoming Movies & TV Show Releases <i class="fa fa-angle-right" aria-hidden="true"></i></h2></a>-->
            <!--        </div>    -->
            <!--    </div>    -->
            <!--</div>-->
            @if(!empty($category->product_category_id))
                <?php  $products = $category->product_category->products()->with('product')->limit(10)->get();?>
                @if($products->count() > 0)
                <div class="category_list owl-carousel blog_product_slider">
                    @foreach($products as $prod_detail)
                            @if(!empty($prod_detail->product))
                                <?php  $product = $prod_detail->product;?>
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
                            @endif
                    @endforeach
                </div>
                @endif
            @endif
                
                @endforeach
            @endif
        </div>    
    </section>

    <!-- blog end -->
@endsection
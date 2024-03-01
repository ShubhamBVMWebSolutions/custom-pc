@extends('front-layout.master_layout')
@section('title', 'Blogs')
@section('content')
    <!-- Blog Intro -->
    <section class="blog_inro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <center><h1>{{ $category->title }}</h1></center> 
                </div>
            </div>
        </div>    
    </section>
    <!-- Blog Intro end-->
    <!-- blog  -->
    <section class="catalogues">
        <div class="container">
            @if(!empty($types))
                @foreach($types as $key => $type)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="title_cate"> 
                                <a href="#"><h2>{{ $category->title }} {{ $key }} <i class="fa fa-angle-right" aria-hidden="true"></i></h2></a>
                            </div>    
                        </div>    
                    </div>
                    @php // print_r($type['blogs']); @endphp
                    @if($type['blogs']->count() > 0)
                     <div class="list_catalogues">
                        <div class="row"> 
                        
                            @foreach($type['blogs'] as $blog)
                                <div class="col-lg-4">
                                   <a href="{{route('blog.single',[$blog->blog_category->slug,$blog->type,$blog->slug])}}" class="blog_post">
                                        <div class="img_blog">
                                            <?php if(!empty($blog->image)){$image = url('public/uploads/blogs/'.$blog->image);}else{$image = url('public/img/default_pic.png');} ?>
                                            <img src="{{ $image }}">
                                        </div>
                                        <div class="blog_content">
                                         <h4>{{ $blog->title }}</h4>   
                                         <p>{!! limit_text($blog->content,100) !!}</p>
                                         <p class="cate_list">{{ $category->title }} {{ $blog->type }}</p>
                                        </div>    
                                   </a>   
                                </div>
                            @endforeach
                        </div>
                    </div>    
                    @endif
                @endforeach
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
                                            <a href="{{route('view.product',['productSlug'=>$product->slug])}}"><img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$product->image )}}"></a>
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
        </div>    
    </section>

    <!-- blog end -->
@endsection
@extends('front-layout.master_layout')
@section('title', 'About')
@section('meta_keywords',metaTagsByKeyPage('about','meta_keywords'))
@section('meta_description',metaTagsByKeyPage('about','meta_description'))
@section('content')

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="cart_title" data-aos="fade-up">{{$about->title}}</h2>
            </div>    
        </div>    
        <div class="row">
            <div class="col-lg-12">
                <div class="content_cms" data-aos="fade-up">
                    <?=$about->content?>
                </div>                
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

@endsection
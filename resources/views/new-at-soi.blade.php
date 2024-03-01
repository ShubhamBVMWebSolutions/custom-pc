@extends('front-layout.master_layout')
@section('title', 'New At SOI')
@section('content')
<section class="shopping-cart spad">
    <div class="container">
    <div class="row">
            <div class="col-lg-12">
                <h2 class="cart_title aos-init aos-animate" data-aos="fade-up">New At BVM Web Solutions</h2>
            </div>
    </div>

@if($new_product_blogs->count())
    @foreach($new_product_blogs as $row)
    <div class="row repeat_row_new">
        <div class="col-lg-4">
            <div class="img_block_at">
                @if($row->media_type == 'image')
                    <img src="{{ asset('public/uploads/product_blogs/'.$row->media_content) }}"  width="320" height="180" alt=""/>
                @else
                    <iframe width="320" height="180" src="{{$row->media_content }}" title="{{$row->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                @endif
            </div>
        </div>
        <div class="col-lg-8">
            <div class="new_at_content_block">
                <h3>
                    {{$row->title }}
                </h3>
                <p>
                     {!! $row->description !!}
                </p>
            </div>
        </div>
        <div class="col-lg-12">
            <a class="primary-btn new_at" href="{{$row->button_link}}">{{$row->button_text}}</a>
            <div class="divider"></div>
        </div>
    </div>
     @endforeach
@endif
  </div>
</section>


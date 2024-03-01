@extends('front-layout.master_layout')
@section('title', 'Testimonial')
@section('content')

<section class="testimonial_page spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="cart_title aos-init aos-animate">Testimonial</h2>
            </div>
        </div>
        <div class="row">
           @foreach($testimonial as $key=>$testi)
           <div class="col-lg-4">
                      <div class="testi_widget_block aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
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
            <div class="d-flex justify-content-center pagination">
                {{$testimonial->links('vendor.pagination.bootstrap-4')}}
            </div>
    </div>
</section>

@endsection
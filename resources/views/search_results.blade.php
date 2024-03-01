@extends('front-layout.master_layout')
@section('title', 'Search Results')
@section('content')

<section class="search_result_main">
    <div class="container">
        <div class="row">
            <h2>Search Results</h2>
        </div>
        <?php if($search_results->count() > 0){ ?>
        <div class="row">
            <?php 
            foreach($search_results as $results){
            ?>
            <div class="col-lg-3">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="1000">
                        <a href="{{route('view.product',['productSlug'=>$results->slug])}}">
                        <div class="product__item__pic set-bg" data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$results->image )}}">
                            
                        </div>
                        </a>
                        <div class="product__item__text">
                            <h6>{{$results->title}}</h6>
                            <a href="{{route('add.cart',['id'=>$results->id])}}" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            
                            <div class="g-sys-spec">
                            <?php //$results->features?>
                            </div>
                            @if(!empty($results->sale_price))
                            <h5>NPR {{number_format($results->sale_price,2)}} <small>(ind. GST)</small></h5>
                            <h5><strike>NPR {{number_format($results->price,2)}}</strike></h5>
                            @else
                            <h5>NPR {{number_format($results->price,2)}} <small>(ind. GST)</small></h5>
                            @endif
                            
                        </div>
                    </div>
                 </div>
            <?php } ?>
        </div>
        <div class="row d-flex justify-content-center pagination">
                {{$search_results->links('vendor.pagination.bootstrap-4')}}
            </div>
        <?php } else{ ?>
            <div class="row">
                <div class="col-md-12 alert alert-danger">
                    <h4>No Results Found!</h4>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

@endsection
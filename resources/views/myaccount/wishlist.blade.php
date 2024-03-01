@extends('front-layout.master_layout')
@section('title', 'Wishlist')
@section('content')

<?php $user_id = auth()->id(); 
if(empty($user_id)){ ?>
<script>window.location = "{{route('login')}}";</script>
<?php die; }?>

<!-- dashboard Section Begin --> 
<section class="checkout spad">   
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-12"> 
                    <h2 class="cart_title">Wishlist</h2>  
                </div>    
            </div>
            
<div class="row">
    <div class="col-lg-12"> 
    @include('myaccount.nav')
            
            <div id="fifthTab" class="tabcontent">   
                
                <div class="shopping__cart__table">
                        <div class="row">
                                <div class="col-lg-12">
                                    <h3>Wishlist</h3>
                                </div>
                        </div>
                        <div class="row">
                            @forelse($wishlist as $row)
                            @php $prod_detail = $row->product @endphp
                                @if(!empty($prod_detail))
                                    @if($prod_detail->status == 1)
                                    <div class="col-lg-4" id="product_{{$prod_detail->id}}">
                                        <div class="product__item" data-aos="fade-up" data-aos-duration="1000">
                                            <div class="wishlist_product">
                                                
                                                @if($prod_detail->wishlist_status($prod_detail->id) == 1)
                                                    <i class="fa fa-heart" onclick="removeWishlistItem('{{$prod_detail->id}}')" id="wishlist_icon_{{$prod_detail->id}}"></i>
                                                @else
                                                    <i class="fa fa-heart-o" onclick="removeWishlistItem('{{$prod_detail->id}}')" id="wishlist_icon_{{$prod_detail->id}}"></i>
                                                @endif
                                                
                                            </div>
                                            <a href="{{route('view.product',['productSlug'=>$prod_detail->slug])}}">
                                                <div class="product__item__pic set-bg"
                                                    data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image )}}">
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <a href="{{route('view.product',['productSlug'=>$prod_detail->slug])}}">
                                                    <h6>{{$prod_detail->title}}</h6>
                                                </a>
                                                @if(empty($prod_detail->stock_qty))
                                                <p class="out_stock"><b>Out Of Stock</b></p>
                                                @else
                                                <a href="{{route('add.cart',['id'=>$prod_detail->id])}}" class="add-cart">+ Add To
                                                    Cart</a>
                                                @endif
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
                              best lock screen wallpaper for desktop                      
                                                    
                                                <div class="g-sys-spec">
                                                    <?php //echo Str::limit($prod_detail->features, 140, '');?>
                                                </div>
                                                @if(!empty($prod_detail->sale_price))
                                                <h5>NPR {{number_format($prod_detail->sale_price,2)}} <small>(ind. GST)</small></h5>
                                                <h5 class="striked_price"><strike>NPR
                                                        {{number_format($prod_detail->price,2)}}</strike>
                                                </h5>
                                                @else
                                                <h5>NPR {{number_format($prod_detail->price,2)}} <small>(ind. GST)</small></h5>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                            @empty
                                <div class="col-lg-12">
                                    <h5 class="alert alert-danger">No Product Found!</h5>
                                </div>
                            @endforelse
                            </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{route('home')}}">Continue Shopping <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        </div>
                        @if($wishlist->count() > 0)
                            <div class="clear_wishlist__btn">
                                <a href="{{route('request.clear-wishlist')}}">Clear Wishlist <i class="fa fa-times" aria-hidden="true"></i></a>
                            </div>
                        @endif
                        
                    </div>
                    
                </div>
            </div>
            </div>
    </div>
    </div>
                       
             
        </div>
    </div>
</section>
<!-- dashboard Section End -->

<script>
    
    function removeWishlistItem(product_id){
                
                $.post("{{ route('ajax.toggle-wishlist-product') }}",
                {
                    product_id: product_id,
                    _token: "{{ csrf_token() }}",
                },
                function(data, status){
                    if(data.response == true){
                            $("#product_"+product_id).hide();   
                        toastr.success(data.message);    
                    }else{
                        toastr.error(data.message);
                    }
                    
                });
                
                
    
    }
</script>
@endsection
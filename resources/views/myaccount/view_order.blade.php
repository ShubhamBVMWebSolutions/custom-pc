@extends('front-layout.master_layout')
@section('title', 'View Order')
@section('content')
{{-- @dd(orderStausByKey($orderDetail->order_status)) --}}
<?php $user_id = auth()->id();
$subtotal = 0;
if(empty($orderDetail)){ ?>
<script>window.location = "{{route('user.dashboard.orders')}}";</script>
<?php die;  }
if(empty($user_id)){ ?>
<script>window.location = "{{route('login')}}";</script>
<?php die; }

if($orderDetail->user_id != $user_id){?>
<script>window.location = "{{route('home')}}";</script>
<?php die; }
?>


<!-- dashboard Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="cart_title">View Order</h2>
                </div>
            </div>

<div class="row">
    <div class="col-lg-12">
    @include('myaccount.nav')

            <div id="fourthTab" class="tabcontent">

                  <div class="shopping__cart__table my_account_page">
                  <span>Order #{{$orderId}} was placed on {{date('F j,Y',strtotime($orderDetail->created_at))}} and is currently {{orderStausByKey($orderDetail->order_status)}}.</span>
                <h3>Order Details</h3>
                <div class="items_table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderItems as $item)
                            <?php
                            $checked5 = '';
                            $checked4 = '';
                            $checked3 = '';
                            $checked2 = '';
                            $checked1 = '';
                            $prod_id = $item->product_id;
                            $prod_detail = productDetailById($prod_id);
                            $product_rating = productRatingGivenByUser($prod_id);
                            $variation_id = $item->variation_id ?? '';
                            $variation_details = getVariationdetailById($variation_id);
                            $color_name = '';
                            if(!empty($variation_details)){
                            $color_id = $variation_details->color_id;
                            $color_detail = clorDetailById($color_id);
                            $color_name =  $color_detail[0]->color_name;
                            }
                            $subtotal+=$item->price*$item->quantity;
                            if(!empty($prod_detail)){
                            ?>
                            <tr>
                                <td><a href="{{route('view.product',['productSlug' => $prod_detail->slug])}}">{{$prod_detail->title}}</a> X <strong>{{$item->quantity}}</strong>
                                @if(!empty($color_name))
                                <div><h6><b>Color:</b> {{$color_name}}</h6></div>
                                @endif
                                </td>
                                <td>NPR {{number_format($item->price*$item->quantity,2)}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="rating" style="color:rgb(255, 199, 0);">
                                        <i class="fa @if($product_rating == 1 || $product_rating == 2 || $product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                                        <i class="fa @if($product_rating == 2 || $product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                                        <i class="fa @if($product_rating == 3 || $product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                                        <i class="fa @if($product_rating == 4 || $product_rating == 5) fa-star @else fa-star-o @endif"></i>
                                        <i class="fa @if($product_rating == 5) fa-star @else fa-star-o @endif"></i>
                                    </div>

                                @php $productReviewStatus = productReviewStatusOfUser($prod_detail->id); @endphp
                                @if($productReviewStatus == '')
                                @if (orderStausByKey($orderDetail->order_status) == 'Completed')
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reviewModal{{$prod_detail->id}}">
                                        Review
                                    </button>
                                @endif

                                    <!-- Modal -->
                                        <div class="modal fade review_model" id="reviewModal{{$prod_detail->id}}" tabindex="-1" role="dialog" aria-labelledby="reviewModal{{$prod_detail->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="reviewModal{{$prod_detail->id}}Label">{{$prod_detail->title}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="prd_box">
                                                            <img src="{{asset('public/uploads/product-media/'.$prod_detail->image)}}" />
                                                            <h4 class="review_title_left">{{$prod_detail->title}}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="review_form">
                                                            <form action="{{ route('submit.product-review') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{$prod_detail->id}}" required>
                                                            <label>Overall Rating <span class="red_color">*</span></label>
                                                            <div class="rate">
                                                                    <input type="radio" id="star5_0_oa_{{$prod_detail->id}}" name="rating" class="rating_0" value="5"  >
                                                                    <label for="star5_0_oa_{{$prod_detail->id}}" title="5">5 stars</label>
                                                                    <input type="radio" id="star4_0_oa_{{$prod_detail->id}}" name="rating" class="rating_0" value="4" >
                                                                    <label for="star4_0_oa_{{$prod_detail->id}}" title="4">4 stars</label>
                                                                    <input type="radio" id="star3_0_oa_{{$prod_detail->id}}" name="rating" class="rating_0" value="3" >
                                                                    <label for="star3_0_oa_{{$prod_detail->id}}" title="3">3 stars</label>
                                                                    <input type="radio" id="star2_0_oa_{{$prod_detail->id}}" name="rating" class="rating_0" value="2" >
                                                                    <label for="star2_0_oa_{{$prod_detail->id}}" title="2">2  stars</label>
                                                                    <input type="radio" id="star1_0_oa_{{$prod_detail->id}}" name="rating" class="rating_0" value="1" checked>
                                                                    <label for="star1_0_oa_{{$prod_detail->id}}" title="1">1 star</label>
                                                            </div>
                                                            <div class="clear">
                                                            <label>Review Title <span class="red_color">*</span></label>
                                                            <input type="text" name="review_title" placeholder="Enter Title" required>
                                                            <label>Review <span class="red_color">*</span></label>
                                                            <textarea class="text_area" name="review_content" placeholder="Enter Review" required></textarea>
                                                            <label>
                                                                Would you recommend this product?
                                                            </label>
                                                            <input type="radio" name="recommend_product" value="Yes" checked> Yes</input>
                                                            <input type="radio" name="recommend_product" value="No"> No</input>
                                                            <div class="clear">
                                                            <label>Quality <span class="red_color">*</span></label>
                                                                <div class="rate">
                                                                        <input type="radio" id="star5_0_qa_{{$prod_detail->id}}" name="quality_rating" class="rating_0" value="5" >
                                                                        <label for="star5_0_qa_{{$prod_detail->id}}" title="5">5 stars</label>
                                                                        <input type="radio" id="star4_0_qa_{{$prod_detail->id}}" name="quality_rating" class="rating_0" value="4" >
                                                                        <label for="star4_0_qa_{{$prod_detail->id}}" title="4">4 stars</label>
                                                                        <input type="radio" id="star3_0_qa_{{$prod_detail->id}}" name="quality_rating" class="rating_0" value="3" >
                                                                        <label for="star3_0_qa_{{$prod_detail->id}}" title="3">3 stars</label>
                                                                        <input type="radio" id="star2_0_qa_{{$prod_detail->id}}" name="quality_rating" class="rating_0" value="2" >
                                                                        <label for="star2_0_qa_{{$prod_detail->id}}" title="2">2 stars</label>
                                                                        <input type="radio" id="star1_0_qa_{{$prod_detail->id}}" name="quality_rating" class="rating_0" value="1" checked>
                                                                        <label for="star1_0_qa_{{$prod_detail->id}}" title="1">1 star</label>
                                                                </div>
                                                            </div>
                                                            <div class="clear">
                                                            <label>Value for money <span class="red_color">*</span></label>
                                                                <div class="rate">
                                                                        <input type="radio" id="star5_0_vfm_{{$prod_detail->id}}" name="value_for_money_rating" class="rating_0" value="5" >
                                                                        <label for="star5_0_vfm_{{$prod_detail->id}}" title="5">5 stars</label>
                                                                        <input type="radio" id="star4_0_vfm_{{$prod_detail->id}}" name="value_for_money_rating" class="rating_0" value="4" >
                                                                        <label for="star4_0_vfm_{{$prod_detail->id}}" title="4">4 stars</label>
                                                                        <input type="radio" id="star3_0_vfm_{{$prod_detail->id}}" name="value_for_money_rating" class="rating_0" value="3" >
                                                                        <label for="star3_0_vfm_{{$prod_detail->id}}" title="3">3 stars</label>
                                                                        <input type="radio" id="star2_0_vfm_{{$prod_detail->id}}" name="value_for_money_rating" class="rating_0" value="2" >
                                                                        <label for="star2_0_vfm_{{$prod_detail->id}}" title="2">2 stars</label>
                                                                        <input type="radio" id="star1_0_vfm_{{$prod_detail->id}}" name="value_for_money_rating" class="rating_0" value="1" checked>
                                                                        <label for="star1_0_vfm_{{$prod_detail->id}}" title="1">1 star</label>
                                                                </div>
                                                            </div>
                                                                <div class="clear">
                                                                    <button class="submit_reivew_btn">Submit Review</button>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    @elseif($productReviewStatus == 'Pending')
                                        <p class="text-danger">Your review under moderation.</p>
                                    @elseif($productReviewStatus == 'Approved')
                                        <p class="text-success">Your review approved and now visible on product.</p>
                                @endif

                                </td>
                                <!-- Modal end-->
                            </tr>
                        <?php } if($prod_id == 0){?>
                            <tr>
                                <td>Gift Card X <strong>{{$item->quantity}}</strong>
                                </td>
                                <td>NPR {{number_format($item->price*$item->quantity,2)}}</td>
                            </tr>
                        <?php } ?>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Subtotal:</th>
                                <td>NPR {{number_format($subtotal,2)}}</td>
                            </tr>
                            @if(!empty($orderDetail->coupon_code))
                            <tr>
                                <th>Coupon: {{$orderDetail->coupon_code}}</th>
                                <td>- NPR {{number_format($orderDetail->discount_amount,2)}}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Total:</th>
                                <td>NPR {{number_format($orderDetail->total_amount,2)}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <h3>Billing Details</h3>
                <div class="billing_detail_box">
                    <address>
                        {{$billing_address->first_name}} {{$billing_address->last_name}} <br>
                        {{$billing_address->email}}<br>
                        Phone Number: {{$billing_address->phone}}<br>
                        {{$billing_address->city}}, {{$billing_address->state}} {{$billing_address->country}}<br>
                        PIN: {{$billing_address->zipcode}}
                    </address>
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



@endsection

@push('custom-scripts')
  <script>
    // function updateRating(star,product_id){
    //     $.ajaxSetup({
    //           headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //                 }
    //              });

    //     $.ajax({
    //         url: SITE_URL+'/ajax/star_rating',
    //         type: 'POST',
    //         data : {star:star, product_id:product_id
    //         },
    //         success : function(data) {
    //             location.reload(true);
    //             },

    //     });
    // }

  </script>
  @endpush

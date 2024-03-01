@extends('front-layout.master_layout')
@section('title', 'View Order')
@section('content')

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
                                    <?php 
                                    // echo $product_rating;
                                    if($product_rating == 5){
                                        $checked5 = 'checked';
                                    }
                                    if($product_rating == 4){
                                        $checked4 = 'checked';
                                    }
                                    if($product_rating == 3){
                                        $checked3 = 'checked';
                                    }
                                    if($product_rating == 2){
                                        $checked2 = 'checked';
                                    }
                                    if($product_rating == 1){
                                        $checked1 = 'checked';
                                    } ?>
                                     <div class="rate">
    <input type="radio" id="star5_<?=$loop->index?>" class="rating_<?=$loop->index?>"   value="5" <?= $checked5;?> onchange="updateRating(5,<?=$prod_id?>)"/>
    <label for="star5_<?=$loop->index?>" title="5">5 stars</label>
    <input type="radio" id="star4_<?=$loop->index?>" class="rating_<?=$loop->index?>"   value="4" <?= $checked4;?> onchange="updateRating(4,<?=$prod_id?>)"/>
    <label for="star4_<?=$loop->index?>" title="4">4 stars</label>
    <input type="radio" id="star3_<?=$loop->index?>" class="rating_<?=$loop->index?>"   value="3" <?= $checked3;?> onchange="updateRating(3,<?=$prod_id?>)"/>
    <label for="star3_<?=$loop->index?>" title="3">3 stars</label>
    <input type="radio" id="star2_<?=$loop->index?>" class="rating_<?=$loop->index?>"   value="2" <?= $checked2;?> onchange="updateRating(2,<?=$prod_id?>)"/>
    <label for="star2_<?=$loop->index?>" title="2">2 stars</label>
    <input type="radio" id="star1_<?=$loop->index?>" class="rating_<?=$loop->index?>"   value="1" <?= $checked1;?> onchange="updateRating(1,<?=$prod_id?>)"/>
    <label for="star1_<?=$loop->index?>" title="1">1 star</label>
  </div>

                                </td>
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
    function updateRating(star,product_id){
        $.ajaxSetup({
              headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                 });

        $.ajax({
            url: SITE_URL+'/ajax/star_rating',
            type: 'POST',
            data : {star:star, product_id:product_id
            },
            success : function(data) {
                location.reload(true);
                },
            
        });
    }
  </script>
  @endpush
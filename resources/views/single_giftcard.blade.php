@extends('front-layout.master_layout')
@section('title', $productinfo[0]->title)
@section('meta_keywords',metaTagsByKeyPage('gift_card','meta_keywords'))
@section('meta_description',metaTagsByKeyPage('gift_card','meta_description'))
@section('content')

<?php 
//  session()->forget('giftcard');
$galleries = array();
$galleries = $productGallery; 
$brand_id = $productinfo[0]->brand ?? '';
$brand_name = branddetailById($brand_id)->name ?? ''; 
$categories = array();
if(!empty($productinfo[0]->product_categories)){
$categories = explode(',',$productinfo[0]->product_categories);
}
$catname_arr = array();
foreach($categories as $catid){
   $catname_arr[] = getcatdetailByID($catid)[0]->title; 
} 
$prod_id = $productinfo[0]->id;
?>
                                                           

 <form   id="cardform" >
<!-- Single Product Detail Begin -->
<input type="hidden" id="product_id" value="{{$prod_id}}">
<section class="product_detail product_{{$productinfo[0]->id}}">
     
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible  mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
    <strong>Success!</strong> {{ session()->get('success') }} <a  class="primary-btn " href="{{route('view.cart')}}">View Cart</a>
    </div>
 @endif
                <div class="breadcrumps">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li>{{$productinfo[0]->title}}</li>
                    </ul> 
                </div>                    
            </div>    
        </div>    
 
         
 
                <div class="row">
                    <div class="col-lg-6">    
                            <div class="giftcardproduct__details__pic">
                             
                            <div class="ajax_loader" style="display: none;"><img src="{{url('public/img/rolling-icon.svg')}}"></div>    
                                <div class="product__details__pic__item">
                                                    <!-- <img src="{{url(Config::get('constants.GIFT_CARD_IMAGE').$productinfo[0]->image )}}" alt=""> -->
                                                @if(!empty($giftcardcategory[0]['giftcards_img']) && $giftcardcategory[0]['giftcards_img']!='')
                                                <img src="{{asset('/uploads/product_gallery_images/'.$giftcardcategory[0]['giftcards_img'])}}">
                                               @else
                                                    <img src="{{url(Config::get('constants.GIFT_CARD_IMAGE').'giftcard.png' )}}" alt="">
                                               @endif
                                                 
                                                </div>
                            </div>    
                    </div>
                    <div class="col-lg-6">
                            <div class="product__details__text single_gift_card">
                                <!-- <span class="new_product">New</span> -->
                              <!--   <h4>{{$productinfo[0]->title}}</h4> -->
                               <h4>{{$giftcardcategory[0]['title']}}</h4>
                                <!-- <div class="sku_text">
                                    MODEL: {{$productinfo[0]->model}} SKU: {{$productinfo[0]->sku}}
                                </div> -->
                                <!-- <p>The Gift Card that never expires</p> -->
                                <p>{{$giftcardcategory[0]['sub_title']}}</p>
                                <h5>Select Gift Card Value</h5>
                                <ul class="radios-list single_gift_card_list">
                                @foreach($giftcard_product as  $giftproduct)
                                <li>
                                    <div class="radio__input">
                                    <input type="radio"  class="input-radio simple_form giftcard_price"   data-id="{{$giftproduct->id}}" name="product_id" @if( $loop->first) checked @endif giftcardprice="{{base64_encode($giftproduct->id)}}" value1="{{number_format($giftproduct->price,2)}}"  value="{{base64_encode($giftproduct->id)}}">
                                    </div
                                    <label class="radio__label">   <h5>NPR {{number_format($giftproduct->price,2)}} </h5></label>
                                </li>

                                @endforeach
                                               <!--    <div class="unset_flex">
                                                    <div style="list-style: none;">
                                                            <div class="radio__input">
                                                                <input type="radio" data-price="0.00" id="custom-amount" giftcardprice="{{base64_encode(0)}}"  class="input-radio jq_custome_amount_chk giftcard_price" name="product_id" value="{{base64_encode(0)}}">
                                                            </div>
                                                            <label for="custom-amount" class="radio__label"><p class="label_name">Nominate value (between NPR10 and NPR500)</p></label>
                                                    </div>
                                                </div> 
                                    <-- ///////////////////////////////////////// --
                                    <div id="custom-amount-input-wrap jq_custome_amount" style="list-style: none;">
                                        <div class="jb-input--group">
                                            <div class="jb-input jb-input--has-prefix ">
                                                <div class="prefix-wrapper custom-amount-inputchk">
                                                    <div class="prefix " style="color: #ccc;">NPR</div>
                                                    <div class="prefixed ">
                                                        <input id="custom-amount-input" class="has-value custom-amount-inputchk" name="custom_price" type="number" step="1" min="10" max="500" minlength="2" maxlength="3" pattern="\d+" required="" value="15">
                                                        <label for="custom-amount-input" style="color: #ccc;">Value</label><div class="prefixed-frame custom-amount-inputchk">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="custom-errors">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    -- ///////////////////////////////////////// -->  
                                </ul>



   <div class="unset_flex">
                                                    <div style="list-style: none;">
                                                            <div class="radio__input">
                                                                <input type="radio" data-price="0.00" id="custom-amount" giftcardprice="{{base64_encode(0)}}"  class="input-radio jq_custome_amount_chk giftcard_price" name="product_id" value="{{base64_encode(0)}}">
                                                            </div>
                                                            <label for="custom-amount" class="radio__label"><p class="label_name">Nominate value (between NPR10 and NPR500)</p></label>
                                                    </div>
                                                </div> 
                                    <!-- ///////////////////////////////////////// -->
                                    <div id="custom-amount-input-wrap jq_custome_amount" style="list-style: none;">
                                        <div class="jb-input--group">
                                            <div class="jb-input jb-input--has-prefix ">
                                                <div class="prefix-wrapper custom-amount-inputchk">
                                                    <div class="prefix " style="color: #ccc;">NPR</div>
                                                    <div class="prefixed ">
                                                        <input id="custom-amount-input" class="has-value custom-amount-inputchk" name="custom_price" type="number" step="1" min="10" max="500" minlength="2" maxlength="3" pattern="\d+" required="" value="15">
                                                        <label for="custom-amount-input" style="color: #ccc;">Value</label><div class="prefixed-frame custom-amount-inputchk">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="custom-errors">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ///////////////////////////////////////// -->




                                
                                <p> 
                                    <!-- <=$productinfo[0]->short_description?>  -->
 {{$giftcardcategory[0]['description']}}
                            </p>
                                

                                <!-- ////////////////////// -->



                                <b style="color:#000; font-size:18px;">Gift Card Delivery Option</b>
                                    <ul class="radios-list send_by_email_checkbox" style="display: flex;">
                            
                                             <li style="list-style: none;display:inline-block;width:40%">
                                                <div class="radio__input " style="display: table-cell;display:inline-block">
                                                <input checked="" type="radio"   class="input-radio send_by_email sendby" name="sendby" value="sendbyemail"></div>
                                                    <label for="29078485696610" class="radio__label">   <h5 style="color: #f44336;">Send by email</h5></label>
                                            </li>

                                            <li style="list-style: none;display:inline-block;">
                                                <div class="radio__input " style="display: table-cell;display:inline-block">
                                                <input type="radio"   class="input-radio send_by_post sendby" name="sendby" value="sendbypost"></div>
                                                    <label for="29078485696610" class="radio__label">   <h5 style="color: #f44336;">Send by post</h5></label>
                                            </li>
                                    
                                </ul>





                                <!-- /The Gift Card that never expires////////////////////////// -->


                                <!-- @if(empty($productinfo[0]->stock_qty))
                                <p class="out_stock"><b>Out Of Stock</b></p>
                                @else
                                <p class="in_stock"><b>In Stock</b></p>
                                @endif -->
                                @csrf
                            



                                <div class="row form-group checkout__input" >
                                            <div class="col">
                                            <input type="text" class="form-control first_name sender_full_name" name="sender_full_name" placeholder="Sender's Full Name">
                                        <span class="sender_full_name_err" style="color: #f44336;"></span>   
                                        </div>
                                            <div class="col">
                                            <input type="email" class="form-control last_name sender_email"  name="sender_email" placeholder="Sender's email">
                                            <span class="sender_email_err" style="color: #f44336;"></span>     
                                        </div>
                                </div>

                                <div class="row form-group checkout__input" >
                                    
                                            <div class="col">
                                            <input type="text" class="form-control first_name" name="first_name" placeholder="Recipient's First Name">
                                            <span class="first_name_err" style="color: #f44336;"></span>         
                                        </div>
                                            <div class="col">
                                            <input type="text" class="form-control last_name"  name="last_name" placeholder="Recipient's Last Name">
                                            <span class="last_name_err" style="color: #f44336;"></span>         
                                        </div>
                                            
                                        </div>


                                        <div class="form-group checkout__input">
                                            
                                            <input type="hidden" value="" class="form-control sender_fullname" name="sender_name" id="formGroupExampleInput" placeholder="example@domain.com">
                                       
                                        </div>

                                <div class="send_by_email_card_holder">
                                                 
                                            
                                                <div class="product__details__last__option">
                                                    <ul>
                                                        @if(!empty($brand_name))
                                                        <li><span>Brand:</span> {{$brand_name}}</li>
                                                        @endif
                                                        @if(!empty($catname_arr))
                                                        <li><span>Categories:</span> <?php echo join(', ',$catname_arr); ?></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            <!-- //////// -->
                                            <!-- <form> -->
                                        <!-- <div class="row form-group" >
                                            <div class="col">
                                            <input type="text" class="form-control first_name" name="first_name" placeholder="Recipient's First Name">
                                            </div>
                                            <div class="col">
                                            <input type="text" class="form-control last_name"  name="last_name" placeholder="Recipient's Last Name">
                                            </div>
                                            
                                        </div> -->
                                         <div class="form-group checkout__input">
                                            
                                                <input type="email" class="form-control email_id_email" name="recipient_emailid" id="formGroupExampleInput" placeholder="example@domain.com">
                                                <span class="recipient_emailid_err" style="color: #f44336;"></span>      
                                            </div>
                                      <!--      <div class="form-group">
                                            
                                                <input type="text" class="form-control full_name_email" name="full_name_email" id="formGroupExampleInput2" placeholder="Full Name">
                                            </div>

                                            <div class="mb-3">
                                        
                                            <textarea class="form-control personal_message_emali" name="personal_message_email"  id="exampleFormControlTextarea1" rows="3" placeholder="Personal message"></textarea>
                                            </div>
                                        </div> -->
                                
                                </div>

                                <div class="send_by_post_card_holder">
                                        
                                           
                                        <!-- <div class="row form-group" >
                                            <div class="col">
                                            <input type="text" class="form-control first_name_post" name="first_name_post" placeholder="Recipient's First Name">
                                            </div>
                                            <div class="col">
                                            <input type="text" class="form-control last_name_post" name="last_name_post" placeholder="Recipient's Last Name">
                                            </div>
                                            
                                        </div> -->
                                        

                                        <div class="form-group checkout__input">
                                                <input type="text" class="form-control start_typing_your_address_post" name="start_typing_your_address_post" id="formGroupExampleInput" placeholder="Start typing your address">
                                                <span class="start_typing_your_address_post_err start_typing_your_address_post" style="color: #f44336;"></span> 
                                            </div>

                                          
                                           
                                            <span class="manual_address_group" >


                                            <div class="form-group checkout__input">
                                                    <input type="text" class="form-control address_post"  name="address_post" id="formGroupExampleInput2" placeholder="Address">
                                                    <span class="address_post_err" style="color: #f44336;"></span> 
                                                </div>

                                                <div class="form-group checkout__input">
                                                    <input type="text" class="form-control address2_post"  name="address2_post"  id="formGroupExampleInput2" placeholder="Address line 2">
                                                    <span class="address2_post_err" style="color: #f44336;"></span> 
                                                </div>

                                                <div class="form-group checkout__input">
                                                    <input type="text" class="form-control city_post"  name="city"  id="formGroupExampleInput2" placeholder="City">
                                                    <span class="city_err" style="color: #f44336;"></span> 
                                                </div>

                                            <div class="row form-group checkout__input" >
                                                <div class="col">
                                                <input type="text" class="form-control state_post"  name="state" placeholder="State or territory">
                                                <span class="state_err" style="color: #f44336;"></span>    
                                            </div>
                                                <div class="col">
                                                <input type="text" class="form-control postcode_post"  name="postcode"  placeholder="Postcode">
                                                <span class="postcode_err" style="color: #f44336;"></span>     
                                            </div>
                                            </div>
                                                
                                            </span>
                                        <div class="form-group manual_address_group_button"  >
                                          
                                            <div class="form-group or_show_hide" style="color:#ccc"> or </div>

                                            <div style="color:#f00;cursor:pointer"><u id="manual_address_text_change">Manual address</u>
                                                <input type="hidden" class="address_text" name="manual_address_text_change" value="manualaddress" />
                                            </div>
                                            </div>

                                            <div class="form-group">
                                                <input type="checkbox" class="full_name_post address_type" name="address_type" id="formGroupExampleInput2">
                                                <span class="address_type_err" style="color: #f44336;"></span>    

                                                <span style="color:#ccc"> Is this a business address?</span>
                                            </div> 

                                         
                                          



                                        </div>
                                   
<!-- ////////////////////////////////// -->
                                            <div class="form-group checkout__input">
                                                <input type="text" class="form-control company_name"  name="company_name" id="formGroupExampleInput2" placeholder="Company Name">
                                                <span class="company_name_err" style="color: #f44336;"></span>   
                                            </div> 
                                    <div class="form-group checkout__input">
                                                <input type="text" class="form-control full_name" name="full_name" id="formGroupExampleInput2" placeholder="Full Name">
                                                <span class="full_name_err" style="color: #f44336;"></span>   
                                            </div>

                                            <div class="mb-3 checkout__input">
                                            <textarea class="form-control personal_message" name="personal_message" id="exampleFormControlTextarea1" rows="3" placeholder="Personal message"></textarea>
                                            <span class="personal_message_err" style="color: #f44336;"></span>       
                                        </div>
<!-- ///////////////////////////// -->
                                </div>
                            <!-- /////////////// -->
                                
                                <div class="product__details__cart__option">
                                    <!-- <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" name="quantity" value="1">
                                        </div>
                                    </div> -->
                                    <input type="hidden" name="pricess"  value="{{$productinfo[0]->sale_price ?? $productinfo[0]->price}}">
                                    <button type="submit" class="primary-btn add_to_cart_button">Add to cart</button>
                                </div> 
                                <!-- @if(!empty($productinfo[0]->stock_qty)) -->
                                <!-- @endif -->
                                <!-- </form> -->
                            </div>

                    </div>
                            
                                                </div>  
    </div>    
</section>


<!-- </form> -->

<!-- Single Product Detail End -->


<?php $related_prods = '';
if(!empty($productinfo[0]->related_products)){
$related_prods = explode(',',$productinfo[0]->related_products);
}?>
 <!-- Related Section Begin -->
 @if(!empty($related_prods))
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title text-left">Related Product</h3>
                </div>
            </div>
            
            <div class="owl-carousel related_prod_slider owl-theme">
                @foreach($related_prods as $relprodid)
                <?php $prodDetail = productDetailById($relprodid); ?>
                 <div class=" item">
                    <div class="product__item">
                        <a href="{{route('view.product',['productSlug'=>$prodDetail->slug])}}">
                        <div class="product__item__pic set-bg" data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$prodDetail->image )}}">
                            
                        </div>
                        </a>
                        <div class="product__item__text">
                            <h6>{{$prodDetail->title}}</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="g-sys-spec">
                            <?=$prodDetail->features?>
                            </div>
                            
                            <h5>NPR {{number_format($prodDetail->price,2)}} <small>(ind. GST)</small></h5>
                        </div>
                    </div>
                 </div>
                 @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- Related Section End -->
    
</form>

@endsection

@push('custom-scripts')
<script>
 $(".custom-amount-inputchk").hide();
 $('.company_name').hide();
$(".custom-amount-inputchk").keyup(function(){
 if($(".has-value").val()>500){
        $('#custom-amount-input').val(500);
    }else if($(".has-value").val()<10){
        $('#custom-amount-input').val(10);
    }
});

$(".jq_custome_amount_chk,.input-radio").click(function(){
   
                if ($('.jq_custome_amount_chk').prop('checked')==true){ 
                    $(".custom-amount-inputchk").show();
                }else{
                    $(".custom-amount-inputchk").hide();
                   
                  
                }
});
$(".send_by_post_card_holder").hide();
$(".send_by_email,.send_by_post").click(function(){
  
   if ($('.send_by_email').prop('checked')==true){ 
       $(".send_by_email_card_holder").show();
         $(".send_by_post_card_holder").hide();
    //    alert('aa');
   }else{
    // alert('ddd');
       $(".send_by_email_card_holder").hide();
       $(".send_by_post_card_holder").show();
      
     
   }
});



$(".manual_address_group").hide();
$(".manual_address_group_button").click(function(){
  
    
    $(".manual_address_group").toggle();
  


    var x = document.getElementById("manual_address_text_change");

    // alert(x.innerHTML);
  if (x.innerHTML === "Manual address") {
    x.innerHTML = "Go back to address lookup";
    $(".start_typing_your_address").hide();
    $(".or_show_hide").hide();
    $(".start_typing_your_address_post").hide();
       $('.address_text').val('lookbackaddress');
       
  } else {
    $(".start_typing_your_address").show();
    $(".start_typing_your_address_post").show();
    $(".or_show_hide").show();
    x.innerHTML = "Manual address";
    $('.address_text').val('manualaddress');
  }



//    if ($('.manual_address_group').prop('checked')==true){ 
//        $(". ").show();
//          $(". ").hide();
//     //    alert('aa');
//    }else{
//     // alert('ddd');
//        $(". ").hide();
//        $(". ").show();
      
     
//    }
});

        var sendby ='';
        $(".sendby").click(function(){

            address_type = $('.address_type:checked').val();

        sendby = $('.sendby:checked').val();
                if(sendby == 'sendbyemail'  ){
                            $('.company_name').hide();
                }else if(address_type == 'on'){
                    $('.company_name').show();
                }
        });

$(".address_type").click(function(){
  var address_types = '';
 

     address_type = $('.address_type:checked').val();
            if(address_type == 'on'  ){
             address_types = 'business_address';
      
             $('.company_name').show();
            }else{
             address_types ='home_address';
             $('.company_name').hide();
            }

            // alert(address_types);
        });

  



// $(".send_by_email,.send_by_post").click(function(){
  
//   if ($('.send_by_post').prop('checked')==true){ 
//       $(".send_by_post_card_holder").show();
//    //    alert('aa');
//   }else{
//    // alert('ddd');
//       $(".send_by_post_card_holder").hide();
     
    
//   }
// });

// 
// select[name='SLATerm']

//  ///////////////
// select[name='SLATerm']
$("input[type='text'],input[type='email'],textarea").keyup(function () {


   
var key = $(this).attr('name');
 var value = '';
// alert(key);
if(key=='sender_full_name'){
   $('.sender_full_name_err').text(value);    
}
if(key=='sender_email'){
   $('.sender_email_err').text(value);    
}


if(key=='first_name'){
   $('.first_name_err').text(value);    
}

if(key=='last_name'){
   $('.last_name_err').text(value);    
}

if(key=='recipient_emailid'){
   $('.recipient_emailid_err').text(value);    
}

if(key=='full_name'){
   $('.full_name_err').text(value);    
}

if(key=='start_typing_your_address_post'){
   $('.start_typing_your_address_post_err').text(value);    
}

if(key=='address_post'){
   $('.address_post_err').text(value);    
}

if(key=='city'){
   $('.city_err').text(value);    
}

if(key=='state'){
   $('.state_err').text(value);    
}


if(key=='postcode'){
   $('.postcode_err').text(value);    
}

if(key=='personal_message'){
   $('.personal_message_err').text(value);    
}

if(key=='company_name'){
   $('.company_name_err').text(value);    
} 



    //////////
    
                // $(".first_name").prop('required',true);
                // $(".last_name").prop('required',true);
                // $(".sender_full_name").prop('required',true);
                // $(".sender_email").prop('required',true);
                // $(".email_id_email").prop('required',true);
                // $(".full_name").prop('required',true);
});
 /////////////// /////////////// ///////////////


$(document).ready(function() {



    

            
 $("#cardform").submit(function (e) {
                e.preventDefault();


                
                // var first_name = $('.first_name').attr();
                // $(".first_name").attr("requried","500");
                

                
                // alert(first_name);

// var product_id = $('.giftcard_price:checked').attr('giftcardprice');
// var sendby = $('.sendby:checked').val();

// var jq_custome_amount_chk = $('.jq_custome_amount_chk:checked').val();
// if(jq_custome_amount_chk == 'custom-amount'){
//     var custom_price = $('.has-value').val();
//     var custom_price_text = 'custom_price';
// }else{
//     var custom_price ='';
//     var custom_price_text = '';
// }

// var first_name_email =$('.first_name_email').val();
// var last_name_email =$('.last_name_email').val();
// var email_id_email =$('.email_id_email').val();
// var full_name_email =$('.full_name_email').val();
// var personal_message_emali =$('.personal_message_emali').val();


// var personal_message_emali =$('.personal_message_emali').val();
// var first_name_post =$('.first_name_post').val();
// var last_name_post =$('.last_name_post').val();
// var start_typing_your_address_post =$('.start_typing_your_address_post').val();
// var address_post =$('.address_post').val();
// var address2_post =$('.address2_post').val();
// var city_post =$('.city_post').val();
// var state_post =$('.state_post').val();
// var postcode_post =$('.postcode_post').val();
// var full_name_post =$('.full_name_post').val();
// var personal_message_post =$('.personal_message_post').val();

// var address_type = $('.address_type:checked').val();
// var address_types = '';
// if(address_type == 'on'){
//    var address_types = 'business_address';
// }else{
//   var  address_types ='home_address';
// }
// var sender_full_name = $('.sender_full_name').val(); 
                    // if(sender_full_name!=""){
                        
                        $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            $.ajax({
                        method:'post',
                        url:'{{route("add.giftcart")}}',
                        data:  $('#cardform').serialize(),
                        success: function(result) {
                    //    alert(result.success);
                    //    alert(result.status);
                       if(result.status==200){
                                
                                window.location.reload();
                                }
                                if(result.status==404){
                                $.each(result.error, function(key, value){
                                    if(key=='sender_full_name'){
                                        $('.sender_full_name_err').text(value);    
                                    }
                                    if(key=='sender_email'){
                                        $('.sender_email_err').text(value);    
                                    }


                                    if(key=='first_name'){
                                        $('.first_name_err').text(value);    
                                    }

                                    if(key=='last_name'){
                                        $('.last_name_err').text(value);    
                                    }

                                    if(key=='recipient_emailid'){
                                        $('.recipient_emailid_err').text(value);    
                                    }

                                    if(key=='full_name'){
                                        $('.full_name_err').text(value);    
                                    }

                                    if(key=='start_typing_your_address_post'){
                                        $('.start_typing_your_address_post_err').text(value);    
                                    }

                                    if(key=='address_post'){
                                        $('.address_post_err').text(value);    
                                    }

                                    if(key=='city'){
                                        $('.city_err').text(value);    
                                    }

                                    if(key=='state'){
                                        $('.state_err').text(value);    
                                    }


                                    if(key=='postcode'){
                                        $('.postcode_err').text(value);    
                                    }

                                    if(key=='personal_message'){
                                        $('.personal_message_err').text(value);    
                                    }

                                    if(key=='company_name'){
                                        $('.company_name_err').text(value);    
                                    }
                                    

                                });
                                            
                            }
                        }
                });
            // }else{
                // $('.all_value_err').html('Please fill all values.');
            //    alert('Please fill value');
            // }
                
            });
        });
 

</script>
@endpush
<!-- jq_custome_amount_chk -->
@extends('front-layout.master_layout')
@section('title', 'Contact Us')
@section('content')

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="cart_title" data-aos="fade-up">Check Gift Card Balance</h2>
            </div>    
        </div>    
        <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="contact__form"> 
                        <form action="{{route('view.checkgiftcardbalance')}}" method="post" id="checkcardbalance">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                <div class="balance_details">
                                    <span class="success" class="color:Green"></span>
                                    <span class="viewbalance"></span>
                                </div>
                                </div>
                                </div>
                                <div class="row">
                             
                                <div class="col-lg-6">
                                    <input type="text" class="giftcardnumber" placeholder="Gift Card Number" name="giftcard_number" required >
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" class="giftcardnpin"  placeholder="PIN" name="giftcard_pin" required  >
                                    <button type="submit" class="primary-btn">Check Balance</button>
                                </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    
</section>
<!-- Shopping Cart Section End -->

@endsection


@push('custom-scripts')
<script> 



$(document).ready(function() {
 
                $("#checkcardbalance").submit(function (e) {
                e.preventDefault();  
                // var giftcard_number =$('.giftcard_number').val();
                // var last_name_post =$('.last_name_post').val(); 


                        $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            $.ajax({

                        method:'post',
                        url:'{{route("view.checkgiftcardbalance")}}',
                        data:  $('#checkcardbalance').serialize(), 
                         
                        success: function(result) {
                            
                            if(result.success){
                                // console.log('aa');
                                $('.viewbalance').html(result.total);
                                $('.success').html(result.success);
                                
                            }else{
                                // console.log('ss');
                                $('.viewbalance').html(result.error);

                                $('.success').html('');
                                $('.giftcardnpin').val('');
                                $('.giftcardnumber').val('');
                            }
                          
                            // console.log(result.success);
                    //    alert(result.total);
                             },
                });
 
                
            });
        });
 

</script>
@endpush
@extends('front-layout.master_layout')
@section('title','E-Sewa Payment Failed')
@section('content')
<?php $order_id = $_GET['order_id']; ?>

<section class="checkout spad esewa_failure_div">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="failure_msg">
                <h2>Your Order has been Failed!</h2>
                <h4>please try again to pay with this link</h4>
                <a class="btn btn-primary" href="{{url('/checkout/payment/esewa?order_id='.$order_id)}}">Pay Again</a>
                </div>
                
            </div>
        </div>
</div>
</section>

@endsection
@extends('front-layout.master_layout')
@section('title','E-Sewa')
@section('content')

<?php $order_id = $_GET['order_id'] ?? '';
$order_details = getOrderById($order_id);
$total_amount = $order_details->total_amount; 

$esewa_mode = SiteSettingByName('esewa_mode');
if($esewa_mode == 'test'){
$action = 'https://uat.esewa.com.np/epay/main';
}
if($esewa_mode == 'live'){
    $action = 'https://esewa.com.np/epay/main';
}
?>
<form id="paymentForm" action="{{$action}}" method="POST">
    <input value="{{$total_amount}}" name="tAmt" type="hidden">
    <input value="{{$total_amount}}" name="amt" type="hidden">
    <input value="0" name="txAmt" type="hidden">
    <input value="0" name="psc" type="hidden">
    <input value="0" name="pdc" type="hidden">
    <input value="{{SiteSettingByName('esewa_merchant_code')}}" name="scd" type="hidden">
    <input value="{{$order_id}}" name="pid" type="hidden">
    <input value="{{route('esewa.success')}}?q=su&order_id={{$order_id}}" type="hidden" name="su">
    <input value="{{route('esewa.failure')}}?q=fu&order_id={{$order_id}}" type="hidden" name="fu">
</form>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('paymentForm').submit();
    });
</script>

@endsection
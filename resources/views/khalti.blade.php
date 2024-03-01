@extends('front-layout.master_layout')
@section('title','Pay with Khalti')
@section('content')

<button id="payment-button">Pay with Khalti</button>
<script>
var config = {
"publicKey": "test_public_key_fbd4dd4a65764f7bb25a2094d788fb08",
"productIdentity": "1234567890",
"productName": "test product",
"productUrl": "your product url",
"paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
"eventHandler": {
onSuccess (payload) {
$.ajax({
url:"{{url('/payment/verification')}}",
type: 'GET',
data:{
amount : payload.amount,
trans_token : payload.token
},
success: function(res)
{
console.log("transaction succeed"); 
},
error: function(error)
{
console.log("transaction failed");
}
})
},
onError (error) {
console.log(error);
},
onClose () {
console.log('widget is closing');
}
}
};
var checkout = new KhaltiCheckout(config);
var btn = document.getElementById("payment-button");
window.onload = function(){
    checkout.show({amount: 20000});
}
/*btn.onclick = function () {
checkout.show({amount: 20000});
}*/
</script>




@endsection
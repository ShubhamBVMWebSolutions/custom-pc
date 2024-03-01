<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartSession;
use App\Models\BillingAddress;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\GiftcardDetail;
use App\Models\Coupon;
use Auth;
use Session;
use Config;
use PDF;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Mail;

class Checkout extends Controller
{
    function checkout(){
        $user_id = auth()->id();
        $CartSession = '';
        $payment_methods = '';
        $billingaddress = '';
        if(!empty($user_id)){
        $CartSession = CartSession::where('session_key',$user_id)->orderBy('id','DESC')->get();
        $billingaddress = BillingAddress::where('user_id',$user_id)->first();
        }
        $payment_methods = PaymentMethod::where('status','1')->get();
        $data = compact('CartSession','payment_methods','billingaddress');
        return view('checkout',$data);
    }


    function createOrder(Request $request){
        $order = new Order;
        if($request->isMethod('POST')){
            $user_id = auth()->id();
            $biiling_address_id = $request->biiling_address_id;
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $phone = $request->phone;
            $email = $request->email;
            $country = $request->country;
            $address1 = $request->address1;
            $address2 = $request->address2;
            $city = $request->city;
            $state = $request->state;
            $zipcode = $request->zipcode;

            $product_id = $request->product_id;
            $quantity = $request->quantity;
            // dd($quantity);
            $price = $request->price;
            $variation_id = $request->variation_id;

            $coupon_code = $request->coupon_code;
            $total_amount = 0;
            $pc_cart_total = 0;

            $payment_method = $request->payment_method;

            $new_biiling_address_id = '';

            $total = 0;

            if(!empty($price)){

                for($ii=0; $ii<count($price); $ii++){
                    $total+=($price[$ii]*$quantity[$ii]);
                }
                $total_amount = $total;
            }


            if(session()->has('pc_cart')){
                $pc_cart = session()->get('pc_cart');
                $pc_cart_total = $pc_cart['case']['price']+$pc_cart['cpu']['price']+$pc_cart['gpu']['price']+$pc_cart['motherboard']['price']+
                ($pc_cart['ram']['price']*$pc_cart['ram']['quantity'])+($pc_cart['storage']['price']*$pc_cart['storage']['quantity'])+$pc_cart['cooling']['price']+$pc_cart['supply']['price']+$pc_cart['software']['price']+
                $pc_cart['service']['price']+$pc_cart['rgb']['price']+($pc_cart['monitor']['price']*$pc_cart['monitor']['quantity'])+$pc_cart['peripheral']['price']+
                $pc_cart['extra']['price'];

                $total_amount = $pc_cart_total+$total_amount;
            }



            /////Gift card/////
            // print_R(session()->get('applied_coupon'));
            // die();
            if(session()->has('applied_coupon')){

                $coupondata = session()->get('applied_coupon');
                $coupon_detail = Coupon::where('coupon_code',$coupondata['coupon_code'])->first();
                if($coupon_detail['use_limit'] >= $coupon_detail['used']){
                    if($coupon_detail['discount_type'] == 'amount'){
                        $total_amount =    $total_amount - $coupon_detail['coupon_amount'];
                    }elseif($coupon_detail['discount_type'] == 'percent'){
                        $total_amount = ($total_amount*$coupon_detail->coupon_amount)/100;
                    }
                }
            }



            $giftUse = '';
            if(isset($request->giftcardCode) && isset($request->giftPin)){
                $giftcardDetails = GiftcardDetail::where('giftcard_number',$request->giftcardCode)->where('giftcard_pin',$request->giftPin)->where('status',"1")->first();
                //    echo '<pre>';
                // die( $total_amount);
                if($giftcardDetails){


                    if($total_amount >= $giftcardDetails->balance_amount){
                        // echo 'a';
                        $total_amount = $total_amount - $giftcardDetails->balance_amount;
                        $usedAmount = $giftcardDetails->balance_amount;
                        $giftCode = $giftcardDetails->giftcard_number;
                        $order->giftcard_code =  $giftCode;
                        $order->giftcard_amount =  $usedAmount;
                        $giftUse = 'yes';
                    }elseif($total_amount=='0'){
                        // echo 'b';
                        $total_amount = $total;
                    }else{
                        // echo 'c';
                        // $usedAmount = $total_amount - $giftcardDetails->balance_amount;
                        // $total_amount = 0.00;
                        $usedAmount = $total_amount;
                        $giftCode = $giftcardDetails->giftcard_number;
                        $order->giftcard_code =  $giftCode;
                        $order->giftcard_amount =   $total_amount;
                        $total_amount = 0.00;
                        $giftUse = 'yes';
                    }
                }
            }
            // print_R($order);
            // die();

            // Apply Gift card end



            if(!empty($user_id)){
                if(!empty($biiling_address_id)){
                    $billingAddress = BillingAddress::find($biiling_address_id);
                }
                else{
                    $billingAddress = new BillingAddress;
                }

                $billingAddress->user_id = $user_id;
                $billingAddress->first_name = $first_name;
                $billingAddress->last_name = $last_name;
                $billingAddress->phone = $phone;
                $billingAddress->email = $email;
                $billingAddress->country = $country;
                $billingAddress->address1 = $address1;
                $billingAddress->address2 = $address2;
                $billingAddress->city = $city;
                $billingAddress->state = $state;
                $billingAddress->zipcode = $zipcode;
                $billingAddress->save();


            }

            else{
                $billingAddress = new BillingAddress;



                if(empty($request->create_account)){


                $billingAddress->first_name = $first_name;
                $billingAddress->last_name = $last_name;
                $billingAddress->phone = $phone;
                $billingAddress->email = $email;
                $billingAddress->country = $country;
                $billingAddress->address1 = $address1;
                $billingAddress->address2 = $address2;
                $billingAddress->city = $city;
                $billingAddress->state = $state;
                $billingAddress->zipcode = $zipcode;
                $billingAddress->save();

                $new_biiling_address_id = $billingAddress->id;
                }
                if(!empty($request->create_account)){
                    $user = new User();
                    $email_exists = User::where('email',$email)->get();

                    if($email_exists->count() > 0){
                     return redirect()->back()->with('alert-error','This email is already exists');
                    }
                    else{
                    $user->name  = $request->username;
                    $user->email      = $email;
                    $user->password   = bcrypt($request->password);
                    $user->remember_token = sha1(time());
                    $user->first_name  = $first_name;
                    $user->last_name   = $last_name;
                    $user->last_session = '';
                    $user->verified = '1';
                    $SavedResponse  = $user->save();
                    $user_id  =   $user->id;

                    $billingAddress->user_id = $user_id;
                    $billingAddress->first_name = $first_name;
                    $billingAddress->last_name = $last_name;
                    $billingAddress->phone = $phone;
                    $billingAddress->email = $email;
                    $billingAddress->country = $country;
                    $billingAddress->address1 = $address1;
                    $billingAddress->address2 = $address2;
                    $billingAddress->city = $city;
                    $billingAddress->state = $state;
                    $billingAddress->zipcode = $zipcode;
                    $billingAddress->save();

                    $biiling_address_id = $billingAddress->id;
                    }
                }
            }

            ////////////

            $order->user_id = $user_id;
            $order->total_amount = $total_amount;
            $order->coupon_code = $coupon_code ?? '';
            $order->discount_amount = $request->discount_amount;
            $order->payment_method = $payment_method;
            //$order->payment_status = 'pending';
            $order->order_status = 'pending_payment';
            $issave =  $order->save();

            $order_id = $order->id;
            $product_id = $request->product_id;
            $quantity = $request->quantity;

            BillingAddress::where('id',$new_biiling_address_id)->update(['order_id' => $order_id]);



            // Update Giftcard Details start
            if($issave && $giftUse == 'yes'){
                $baleanceAmount = $giftcardDetails->balance_amount - $usedAmount;

                if($baleanceAmount == 0){
                    GiftcardDetail::where('giftcard_number', $giftcardDetails->giftcard_number )->update(['status' => '0', 'balance_amount' => $baleanceAmount]);

                }else{
                    GiftcardDetail::where('giftcard_number', $giftcardDetails->giftcard_number )->update(['balance_amount' => $baleanceAmount]);
                }
            }
            // Update Giftcard Details start

            if(session()->has('pc_cart')){
                $pc_cart = session()->get('pc_cart');
                //case data
                $case_prod_id = $pc_cart['case']['product_id'];
                $case_qty = $pc_cart['case']['quantity'];
                $case_price = $pc_cart['case']['price'];
                $case_variation_id = $pc_cart['case']['variation_id'] ? $pc_cart['case']['variation_id'] : null;

                //cpu data
                $cpu_prod_id = $pc_cart['cpu']['product_id'];
                $cpu_qty = $pc_cart['cpu']['quantity'];
                $cpu_price = $pc_cart['cpu']['price'];
                $cpu_variation_id = $pc_cart['cpu']['variation_id'] ? $pc_cart['cpu']['variation_id'] : null;

                //gpu data
                $gpu_prod_id = $pc_cart['gpu']['product_id'];
                $gpu_qty = $pc_cart['gpu']['quantity'];
                $gpu_price = $pc_cart['gpu']['price'];
                $gpu_variation_id = $pc_cart['gpu']['variation_id'] ? $pc_cart['gpu']['variation_id'] : null;

                //mothrboard data
                $motherboard_prod_id = $pc_cart['motherboard']['product_id'];
                $motherboard_qty = $pc_cart['motherboard']['quantity'];
                $motherboard_price = $pc_cart['motherboard']['price'];
                $motherboard_variation_id = $pc_cart['motherboard']['variation_id'] ? $pc_cart['motherboard']['variation_id'] : null;

                //ram data
                $ram_prod_id = $pc_cart['ram']['product_id'];
                $ram_qty = $pc_cart['ram']['quantity'];
                $ram_price = $pc_cart['ram']['price'];
                $ram_capacity = $pc_cart['ram']['capacity'] ? $pc_cart['ram']['capacity'] : null;

                //storage data
                $storage_prod_id = $pc_cart['storage']['product_id'];
                $storage_qty = $pc_cart['storage']['quantity'];
                $storage_price = $pc_cart['storage']['price'];
                $storage_capacity = $pc_cart['storage']['capacity'] ? $pc_cart['storage']['capacity'] : null;

                //cooling data
                $cooling_prod_id = $pc_cart['cooling']['product_id'];
                $cooling_qty = $pc_cart['cooling']['quantity'];
                $cooling_price = $pc_cart['cooling']['price'];
                $cooling_variation_id = $pc_cart['cooling']['variation_id'] ? $pc_cart['cooling']['variation_id'] : null;

                //supply data
                $supply_prod_id = $pc_cart['supply']['product_id'];
                $supply_qty = $pc_cart['supply']['quantity'];
                $supply_price = $pc_cart['supply']['price'];
                $supply_variation_id = $pc_cart['supply']['variation_id'] ? $pc_cart['supply']['variation_id'] : null;

                //software data
                $software_prod_id = $pc_cart['software']['product_id'];
                $software_qty = $pc_cart['software']['quantity'];
                $software_price = $pc_cart['software']['price'];
                $software_variation_id = $pc_cart['software']['variation_id'] ? $pc_cart['software']['variation_id'] : null;

                //service data
                $service_prod_id = $pc_cart['service']['product_id'];
                $service_qty = $pc_cart['service']['quantity'];
                $service_price = $pc_cart['service']['price'];
                $service_variation_id = $pc_cart['service']['variation_id'] ? $pc_cart['service']['variation_id'] : null;

                //rgb data
                $rgb_prod_id = $pc_cart['rgb']['product_id'];
                $rgb_qty = $pc_cart['rgb']['quantity'];
                $rgb_price = $pc_cart['rgb']['price'];
                $rgb_variation_id = $pc_cart['rgb']['variation_id'] ? $pc_cart['rgb']['variation_id'] : null;

                //monitor data
                $monitor_prod_id = $pc_cart['monitor']['product_id'];
                $monitor_qty = $pc_cart['monitor']['quantity'];
                $monitor_price = $pc_cart['monitor']['price'];
                $monitor_variation_id = $pc_cart['monitor']['variation_id'] ? $pc_cart['monitor']['variation_id'] : null;

                //peripheral data
                $peripheral_prod_id = $pc_cart['peripheral']['product_id'];
                $peripheral_qty = $pc_cart['peripheral']['quantity'];
                $peripheral_price = $pc_cart['peripheral']['price'];
                $peripheral_variation_id = $pc_cart['peripheral']['variation_id'] ? $pc_cart['peripheral']['variation_id'] : null;

                //extra data
                $extra_prod_id = $pc_cart['extra']['product_id'];
                $extra_qty = $pc_cart['extra']['quantity'];
                $extra_price = $pc_cart['extra']['price'];
                $extra_variation_id = $pc_cart['extra']['variation_id'] ? $pc_cart['extra']['variation_id'] : null;


                //case insert
                $case_ordrItems = new OrderItems;
                $case_ordrItems->order_id = $order_id;
                $case_ordrItems->product_id = $case_prod_id;
                $case_ordrItems->price = $case_price;
                $case_ordrItems->quantity = $case_qty;
                $case_ordrItems->variation_id = $case_variation_id;
                $case_ordrItems->type = 'case';
                $case_ordrItems->save();

                //cpu insert
                $cpu_ordrItems = new OrderItems;
                $cpu_ordrItems->order_id = $order_id;
                $cpu_ordrItems->product_id = $cpu_prod_id;
                $cpu_ordrItems->price = $cpu_price;
                $cpu_ordrItems->quantity = $cpu_qty;
                $cpu_ordrItems->variation_id = $cpu_variation_id;
                $cpu_ordrItems->type = 'cpu';
                $cpu_ordrItems->save();

                //gpu insert
                $gpu_ordrItems = new OrderItems;
                $gpu_ordrItems->order_id = $order_id;
                $gpu_ordrItems->product_id = $gpu_prod_id;
                $gpu_ordrItems->price = $gpu_price;
                $gpu_ordrItems->quantity = $gpu_qty;
                $gpu_ordrItems->variation_id = $gpu_variation_id;
                $gpu_ordrItems->type = 'gpu';
                $gpu_ordrItems->save();


                //motheboard insert
                $mtherboard_ordrItems = new OrderItems;
                $mtherboard_ordrItems->order_id = $order_id;
                $mtherboard_ordrItems->product_id = $motherboard_prod_id;
                $mtherboard_ordrItems->price = $motherboard_price;
                $mtherboard_ordrItems->quantity = $motherboard_qty;
                $mtherboard_ordrItems->variation_id = $motherboard_variation_id;
                $mtherboard_ordrItems->type = 'motherboard';
                $mtherboard_ordrItems->save();

                //ram insert
                $ram_ordrItems = new OrderItems;
                $ram_ordrItems->order_id = $order_id;
                $ram_ordrItems->product_id = $ram_prod_id;
                $ram_ordrItems->price = $ram_price;
                $ram_ordrItems->quantity = $ram_qty;
                $ram_ordrItems->capacity = $ram_capacity;
                $ram_ordrItems->type = 'ram';
                $ram_ordrItems->save();

                //ssd insert
                $ssd_ordrItems = new OrderItems;
                $ssd_ordrItems->order_id = $order_id;
                $ssd_ordrItems->product_id = $storage_prod_id;
                $ssd_ordrItems->price = $storage_price;
                $ssd_ordrItems->quantity = $storage_qty;
                $ssd_ordrItems->capacity = $storage_capacity;
                $ssd_ordrItems->type = 'ssd';
                $ssd_ordrItems->save();

                //cooling insert
                $cooling_ordrItems = new OrderItems;
                $cooling_ordrItems->order_id = $order_id;
                $cooling_ordrItems->product_id = $cooling_prod_id;
                $cooling_ordrItems->price = $cooling_price;
                $cooling_ordrItems->quantity = $cooling_qty;
                $cooling_ordrItems->variation_id = $cooling_variation_id;
                $cooling_ordrItems->type = 'cooling';
                $cooling_ordrItems->save();

                //supply insert
                $supply_ordrItems = new OrderItems;
                $supply_ordrItems->order_id = $order_id;
                $supply_ordrItems->product_id = $supply_prod_id;
                $supply_ordrItems->price = $supply_price;
                $supply_ordrItems->quantity = $supply_qty;
                $supply_ordrItems->variation_id = $supply_variation_id;
                $supply_ordrItems->type = 'power supply';
                $supply_ordrItems->save();

                //software insert
                if(!empty($software_prod_id)){
                    $software_ordrItems = new OrderItems;
                    $software_ordrItems->order_id = $order_id;
                    $software_ordrItems->product_id = $software_prod_id;
                    $software_ordrItems->price = $software_price;
                    $software_ordrItems->quantity = $software_qty;
                    $software_ordrItems->variation_id = $software_variation_id;
                    $software_ordrItems->type = 'software';
                    $software_ordrItems->save();
                }



                //service insert
                if(!empty($service_prod_id)){
                    $service_ordrItems = new OrderItems;
                    $service_ordrItems->order_id = $order_id;
                    $service_ordrItems->product_id = $service_prod_id;
                    $service_ordrItems->price = $service_price;
                    $service_ordrItems->quantity = $service_qty;
                    $service_ordrItems->variation_id = $service_variation_id;
                    $service_ordrItems->type = 'service';
                    $service_ordrItems->save();
                }

                //rgb insert
                if(!empty($rgb_prod_id)){
                $rgb_ordrItems = new OrderItems;
                $rgb_ordrItems->order_id = $order_id;
                $rgb_ordrItems->product_id = $rgb_prod_id;
                $rgb_ordrItems->price = $rgb_price;
                $rgb_ordrItems->quantity = $rgb_qty;
                $rgb_ordrItems->variation_id = $rgb_variation_id;
                $rgb_ordrItems->type = 'rgb';
                $rgb_ordrItems->save();
                }

                //monitor insert
                if(!empty($monitor_prod_id)){
                    $monitor_ordrItems = new OrderItems;
                    $monitor_ordrItems->order_id = $order_id;
                    $monitor_ordrItems->product_id = $monitor_prod_id;
                    $monitor_ordrItems->price = $monitor_price;
                    $monitor_ordrItems->quantity = $monitor_qty;
                    $monitor_ordrItems->variation_id = $monitor_variation_id;
                    $monitor_ordrItems->type = 'monitor';
                    $monitor_ordrItems->save();
                }

                //peripheral insert
                if(!empty($peripheral_prod_id)){
                    $peripheral_ordrItems = new OrderItems;
                    $peripheral_ordrItems->order_id = $order_id;
                    $peripheral_ordrItems->product_id = $peripheral_prod_id;
                    $peripheral_ordrItems->price = $peripheral_price;
                    $peripheral_ordrItems->quantity = $peripheral_qty;
                    $peripheral_ordrItems->variation_id = $peripheral_variation_id;
                    $peripheral_ordrItems->type = 'peripheral';
                    $peripheral_ordrItems->save();
                }

                //extra insert
                if(!empty($extra_prod_id)){
                    $extra_ordrItems = new OrderItems;
                    $extra_ordrItems->order_id = $order_id;
                    $extra_ordrItems->product_id = $extra_prod_id;
                    $extra_ordrItems->price = $extra_price;
                    $extra_ordrItems->quantity = $extra_qty;
                    $extra_ordrItems->variation_id = $extra_variation_id;
                    $extra_ordrItems->type = 'extra';
                    $extra_ordrItems->save();
                }

            }

            if(!empty($product_id)){
            for($i=0; $i<count($product_id); $i++){
                $ordrItems = new OrderItems;

                $ordrItems->order_id = $order_id;
                $ordrItems->product_id = $product_id[$i];
                $ordrItems->price = $price[$i];
                $ordrItems->quantity = $quantity[$i];
                $ordrItems->variation_id = $variation_id[$i] ?? null;

                $ordrItems->save();
            }
        }

        ////////////////////giftcard/////////
        if(session()->has('giftcard')){
            ///Create gift Card
            $this->CreateGiftcard(session()->get('giftcard'),$order_id);
        }
        /////////////////////////////

    }


        if($payment_method == 'esewa'){
            return redirect()->to('/checkout/payment/esewa?order_id='.$order_id);
        }
        elseif($payment_method == 'cod' || $payment_method == 'bank_transfer'){
            $Mailcontroller = new SetMailController();
            $MailToAdmin =  SiteSettingByName('site_email');
            $Maildata1 = array(
                            'mailTo'=>$MailToAdmin,
                            'Name'=> $first_name.' '.$last_name,
                            'email' => $email,
                            'order_id' => $order_id,
                            'address1' => $address1,
                            'address2' => $address2,
                            'city' => $city,
                            'state' => $state,
                            'country' => $country,
                            'zipcode' => $zipcode,
                            'phone' => $phone,
                            'message'=>'You have received a new order.',
                            );
             $MailToUser = $email;
            $Maildata2 = array(
                            'mailTo'=>$MailToUser,
                            'Name'=> $first_name.' '.$last_name,
                            'email' => $email,
                            'order_id' => $order_id,
                            'address1' => $address1,
                            'address2' => $address2,
                            'city' => $city,
                            'state' => $state,
                            'country' => $country,
                            'zipcode' => $zipcode,
                            'phone' => $phone,
                            'message'=>'Your Order has been placed successfully.',
                            );
            $Mailcontroller->AdminNewOrderEmail($Maildata1);
            $Mailcontroller->UserNewOrderEmail($Maildata2);
        return redirect()->to('checkout/order-placed?order_id='.$order_id);
        }
        elseif($payment_method == 'khalti'){

            return redirect()->to('checkout/?khalti=pay&order_id='.$order_id);
        }
        elseif($payment_method == 'paypal'){

            return redirect()->to('/checkout/payment/paypal?order_id=' . $order_id);
        }
        elseif($payment_method == 'stripe'){

            return redirect()->to('/checkout/payment/stripe?order_id=' . $order_id);
        }
    }
    function thankuPage(){








            $order_id = '';
            $content = '';
            $order_id = $_GET['order_id'] ?? '';


   ////////////
   $order_details = getOrderById($order_id);
   $pdf = PDF::loadView('thanku2pdf', compact('order_id'));
   $content = $pdf->download()->getOriginalContent();
    $datetimepath = date("dmYhis").'_invoice.pdf';
    $pdf->save('public/uploads/pdf_invoice2/'.$datetimepath);

    if(!empty($content)){
    Order::where('id', $order_id)
       ->update([
           'invoicepdf_name' => $datetimepath
        ]);
    }

        //  ///Create gift Card///
                        if(session()->has('giftcard_pin')){
                            foreach(session()->get('giftcard_pin') as $keys=>$giftcards_pindata){
                                // print_r($giftcards_pindata['sendby']);
                            // GiftcardDetail::where('giftcard_productkey',$keys)->update(['status' =>'1']);

                            if($order_details->payment_method == 'cod'){
                                GiftcardDetail::where('giftcard_productkey',$keys)
                                ->where('giftcard_pin',$giftcards_pindata['giftcard_pin'])
                                ->where('giftcard_number',$giftcards_pindata['giftcard_number'])
                                ->update(['status' =>'0']);
                            }else{
                                GiftcardDetail::where('giftcard_productkey',$keys)
                                ->where('giftcard_pin',$giftcards_pindata['giftcard_pin'])
                                ->where('giftcard_number',$giftcards_pindata['giftcard_number'])
                                ->update(['status' =>'1']);
                            }


                            if($giftcards_pindata['sendby'] == 'sendbyemail'){
                             //mail localhost commented///
                                  $Mailcontroller = new SetMailController();
                                   $res = $Mailcontroller->sendGiftCardPinCode($giftcards_pindata);
                             //mail localhost commented///
                            }

                            session()->forget('giftcard_pin');
                            session()->forget('giftcard');
                            //  ///End gift Card///
                        }
                    }

        return view('thanku');
    }


    public function createInvoice(){

    $order_id = $_GET['order_id'] ?? '';
     $datetimepath = date("dmYhis").'_invoice.pdf';
            $pdf = PDF::loadView('thanku2pdf', compact('order_id'));


      return  $pdf->download( $datetimepath);
    }


    //  ///Create gift Card function
    public function CreateGiftcard($giftcarddata,$order_id){
  // var d = new Date("2013/01/01");
  $current_date = date('Y-m-d');
  $effectivedate = date('Y-m-d 00:00:00', strtotime("+3 months", strtotime($current_date)));
 //    date('Y-m-d', strtotime($effectivedate));

        $sender_email = '';
        $sender_full_name ='';
        foreach(session()->get('giftcard') as $keys=>$giftcards){
            // print_r(session()->get('giftcard'));
            // die();
            // $giftcard_number =   rand(0, 999999999999999999);
          $length = 18;
$giftcard_number = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
            $giftcard_pin =  rand(1000, 9999);
            $giftcard = new GiftcardDetail();
            $giftcard->total_amount = $giftcards['price'];
            $giftcard->order_id = $order_id;
            if($giftcard->order_id!=''){
                $giftcard->balance_amount = $giftcards['price'];
            }else{
                $giftcard->balance_amount = $giftcards['price'];
            }
            $giftcard->giftcard_productkey = $keys;
            $giftcard->giftcard_number = $giftcard_number;
            $giftcard->giftcard_pin = $giftcard_pin;
            $giftcard->first_name = $giftcards['first_name'];
            $giftcard->last_name = $giftcards['last_name'];
            $giftcard->full_name = $giftcards['full_name'];
            $giftcard->personal_message = $giftcards['personal_message'];
            $giftcard->sendby = $giftcards['sendby'];
            // $giftcard->giftcard_address = $giftcards['giftcard_address'];
            $giftcard->company_name = $giftcards['company_name'];
            $giftcard->city = $giftcards['city'];
            $giftcard->state = $giftcards['state'];
            $giftcard->postcode = $giftcards['postcode'];
            $giftcard->start_typing_your_address_post = $giftcards['start_typing_your_address_post'];
            $giftcard->address_post= $giftcards['address_post'];
            $giftcard->address2_post =  $giftcards['address2_post'];
            $giftcard->address_type =  $giftcards['address_type'];
            $giftcard->recipient_emailid =  $giftcards['recipient_emailid'];
            $giftcard->giftcard_expirydate =  $effectivedate;
            if(!empty($giftcards['sender_full_name'])){
             $sender_full_name =    $giftcard->sender_full_name =  $giftcards['sender_full_name']!=""?$giftcards['sender_full_name']:"";
             $sender_email =   $giftcard->sender_email =  $giftcards['sender_email']!=""?$giftcards['sender_email']:"";
            }
// print_r($giftcard);
// die();
            $giftcard->save();

            $giftcard_pins[$keys]=[
                    "giftcard_number" => $giftcard_number,
                    "giftcard_pin"=>$giftcard_pin,
                    "sendby"=>$giftcards['sendby'],
                    "recipient_emailid"=>$giftcards['recipient_emailid'],
                //    'sender_name' =>  $giftcards['sender_name']!=''? $giftcards['sender_name']:'',
                   'personal_message' =>  $giftcards['personal_message']!=''? $giftcards['personal_message']:'',
                   'first_name' => $giftcards['first_name'],
                   'last_name' => $giftcards['last_name'],
                   'full_name' => $giftcards['full_name'],
                   'sender_full_name' =>  $sender_full_name,
                   'sender_email' =>  $sender_email,
                   'balance_amount'=> $giftcards['price'],
                   'giftcard_expirydate' =>  $effectivedate
                    ];
            session()->put('giftcard_pin', $giftcard_pins);
        }
            return true;
    }


}

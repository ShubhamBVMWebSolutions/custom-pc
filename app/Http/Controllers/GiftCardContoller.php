<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallary;
use App\Models\ProductVariation;
use App\Models\VariationImage;
use App\Models\ProductCategoryRelationship;
use App\Models\GiftCard;
use App\Models\GiftcardCategory;
use App\Models\GiftcardsGallery;
use App\Models\GiftcardPrice;
use App\Models\GiftcardDetail;
use App\Models\CartSession;
use App\Models\Coupon;
use Config;
use Session;
use Auth;

class GiftCardContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewGiftCard($productSlug=null)
    {
        $productGallery=array();
        $variations = '';
        if(!empty($productSlug))
        {
            $giftcard_product = Product::where('product_type','giftcard')->where('status',1)->get();
            $productinfo = GiftCard::where('slug','=',$productSlug)->get();
            $giftcardprices = GiftcardPrice::where('gift_card_autoid','=',$productinfo[0]->id)->get();
            $productGallery = GiftcardsGallery::where('giftcard_autoid','=',$productinfo[0]->id)->get();
            $variations = ProductVariation::where('product_id','=',$productinfo[0]->id)->get();
             $giftcardcategory = GiftcardCategory::get();
            $view_count = $productinfo[0]->views;
            if($productinfo[0]->views == ''){
                $view_count = 0;
                GiftCard::where('id','=',$productinfo[0]->id)->update([
                    'views' => $view_count
                    ]);
            }
            else{
                $view_count++;
                GiftCard::where('id','=',$productinfo[0]->id)->update([
                    'views' => $view_count
                    ]);
            }
        }

       
        $data = compact('giftcardcategory','giftcard_product','productinfo','productGallery','variations','giftcardprices');
        return view('single_giftcard',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function applyGiftcard(Request $request){

   
        // $current_date = date('Y-m-d');
        $current_datetime = date('Y-m-d 00:00:00');
        // $effectivedate = date('Y-m-d 00:00:00', strtotime("+3 months", strtotime($current_date)));


        $giftCode = $request->giftCode;
        $giftPin = $request->giftPin;
        $giftcardDetails = GiftcardDetail::where('giftcard_number',$giftCode)->where('giftcard_pin',$giftPin)->where('status','1')->first();
        if($giftcardDetails){

            if(strtotime($giftcardDetails->giftcard_expirydate) >= strtotime($current_datetime)){

                    $subtottal = 0;

                    if(auth()->id()){
                        $cart = CartSession::where('session_key',auth()->id())->orderBy('id','DESC')->get();
                        foreach($cart as $id => $item){
                            $item_price = $item['price']*$item['quantity']; 
                            $subtottal+=$item_price; 
                        }

                                if(session()->has('pc_cart')){
                                $pc_cart = session()->get('pc_cart');
                                $pc_cart_total = $pc_cart['case']['price']+$pc_cart['cpu']['price']+$pc_cart['gpu']['price']+$pc_cart['motherboard']['price']+
                                ($pc_cart['ram']['price']*$pc_cart['ram']['quantity'])+($pc_cart['storage']['price']*$pc_cart['storage']['quantity'])+$pc_cart['cooling']['price']+$pc_cart['supply']['price']+$pc_cart['software']['price']+
                                $pc_cart['service']['price']+$pc_cart['rgb']['price']+($pc_cart['monitor']['price']*$pc_cart['monitor']['quantity'])+$pc_cart['peripheral']['price']+
                                $pc_cart['extra']['price'];
                                
                                $subtottal = $pc_cart_total+$subtottal;
                            }
                    }else{
              

                             if(session()->has('cart')){
                                    $cart = session()->get('cart');
                                    foreach($cart as $id => $item){
                                        $item_price = $item['price']*$item['quantity']; 
                                        $subtottal+=$item_price; 
                                    }
                             }


                        if(session()->has('pc_cart')){
                                $pc_cart = session()->get('pc_cart');
                                $pc_cart_total = $pc_cart['case']['price']+$pc_cart['cpu']['price']+$pc_cart['gpu']['price']+$pc_cart['motherboard']['price']+
                                ($pc_cart['ram']['price']*$pc_cart['ram']['quantity'])+($pc_cart['storage']['price']*$pc_cart['storage']['quantity'])+$pc_cart['cooling']['price']+$pc_cart['supply']['price']+$pc_cart['software']['price']+
                                $pc_cart['service']['price']+$pc_cart['rgb']['price']+($pc_cart['monitor']['price']*$pc_cart['monitor']['quantity'])+$pc_cart['peripheral']['price']+
                                $pc_cart['extra']['price'];
                                
                                $subtottal = $pc_cart_total+$subtottal;
                            }


                           
                            // print_r($subtottal );

                            //             die();

                    }
                 ////////////////////////////Gift card/////////////////////////
 //     print_r('11');
 // die();
  // print_r( $pc_cart_total);
  //                            die();

                         
                    if(session()->has('applied_coupon')){
                        $coupondata = session()->get('applied_coupon');
                        $coupon_detail = Coupon::where('coupon_code',$coupondata['coupon_code'])->first();
                                    if($coupon_detail['use_limit']>=$coupon_detail['used']){
                                            if($coupon_detail['discount_type'] == 'amount'){
                                                    $subtottal =    $subtottal - $coupon_detail['coupon_amount'];
                                            }elseif($coupon_detail['discount_type'] == 'percent'){
                                                    $subtottal = ($subtottal*$coupon_detail->coupon_amount)/100;
                                                }
                                    }
                    }
                    /////////////////////Gift card/////////////////////////////
                    if($subtottal >= $giftcardDetails->balance_amount){
                        $total = $subtottal - $giftcardDetails->balance_amount;
                        $usedAmount = $giftcardDetails->balance_amount;
                    }elseif($subtottal=='0'){
                        return response()->json(['error'=>"Amount is zero, gift card will not apply."]);
                    }else{
                        $total = 0.00;
                        $usedAmount = $subtottal;
                    } 
              return response()->json(['success'=>"Applied Giftcard",'total'=>number_format($total,2),'usedAmount'=>number_format($usedAmount,2)]);


            }else{
            //     GiftcardDetail::where('giftcard_number', $giftCode)
            // ->where('giftcard_pin', $giftPin)->update(['status' => '0']);
                return response()->json(['error'=>"Your card has been expired, please try another card."]);
            }
          
        }else{
            return response()->json(['error'=>"Invalid Giftcard"]);
        }
        // echo "helloo";
        // die;
    }
    



    public function viewGiftCardForm(Request $request){

            return view('giftcard_balance');

       
    }


    public function viewGiftCardBalance(Request $request){

       

        $giftcardDetails = GiftcardDetail::where('giftcard_number',$request->giftcard_number)->where('giftcard_pin',$request->giftcard_pin)->where('status','1')->first();
        
        // print_R(date('Y-m-d 00:00:00'));
        // die();
        if($giftcardDetails){
            if(strtotime($giftcardDetails->giftcard_expirydate) >= strtotime(date('Y-m-d 00:00:00'))){
          
             return response()->json(['success'=>'<h6 style="color:green">'."Applied Giftcard!!".'</h6>','total'=>'<h5 style="color:red">'.'Your Balance is  <b>NPR '.number_format($giftcardDetails->balance_amount,2).'</b></h5><br/>']);
         }else{

            GiftcardDetail::where('giftcard_number', $request->giftcard_number)
            ->where('giftcard_pin', $request->giftcard_pin)->update(['status' => '0']);

            return response()->json(['error'=>'<h6 style="color:red">'."Your Card Has Been Expired, Please Try Another Card.".'</h6><br/>']);
       }
            }else{
                return response()->json(['error'=>'<h6 style="color:red">'."Invalid Giftcard, Please Check Pin Code and Giftcard Number.".'</h6><br/>']);
      
              
            }
        
       
    }
    
    
}

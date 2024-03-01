<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartSession;
use App\Models\Coupon;
use App\Models\GiftCard;
use App\Models\GiftcardsGallery;
use Auth;
use Session;
use Config;
use Validator;

class Cart extends Controller
{
    function addToCart(Request $request, $id){
        
       $user_id = auth()->id();
       $product = Product::find($id);
       $product_price = $product->sale_price ?? $product->price ?? ''; 
       $price = $request->price ?? $product_price ?? '';
       $qty = $request->quantity ?? '1';
       $variation_id = $request->color_variation ?? '';
       $stock_qty = $product->stock_qty ?? '';
       
       if($request->page_type == 'pc_builder'){
           
           $pc_cart = session()->get('pc_cart');
           
           //case data
           $case_id = $request->case_id;
           $case_prod_id = $request->case_prod_id;
           $case_price = $request->case_price;
           $case_prod_variation_id = $request->case_prod_variation_id;
           $case_variation_color_id = $request->case_variation_color_id;

           //cpu data
           $cpu_id = $request->cpu_id;
           $cpu_prod_id = $request->cpu_prod_id;
           $cpu_price = $request->cpu_price;
           $cpu_variation_id = $request->cpu_variation_id;
           $cpu_variation_color_id = $request->cpu_variation_color_id;
           
           //gpu data 
           $gpu_id = $request->gpu_id;
           $gpu_prod_id = $request->gpu_prod_id;
           $gpu_price = $request->gpu_price;
           $gpu_prod_variation_id = $request->gpu_prod_variation_id;
           $gpu_variation_color_id = $request->gpu_variation_color_id;
           
           //motherboard data
           $mtherboard_id = $request->mtherboard_id;
           $mtherboard_product_id = $request->mtherboard_product_id;
           $mothrboard_price = $request->mothrboard_price;
           $mtherboard_prod_variation_id = $request->mtherboard_prod_variation_id;
           $mtherboard_variation_color_id = $request->mtherboard_variation_color_id;
           
           //RAM data
           $ram_id = $request->ram_id;
           $ram_product_id = $request->ram_product_id;
           $ram_price = $request->ram_price;
           $ram_qty = $request->ram_qty;
           $ram_capacity = $request->ram_capacity;
           
           //storage data
           $storage_id = $request->storage_id;
           $storage_product_id = $request->storage_product_id;
           $storage_price = $request->storage_price;
           $ssd_qty = $request->ssd_qty;
           $ssd_capacity = $request->ssd_capacity;
           
           //cooling data
           $cooling_id = $request->cooling_id;
           $cooling_product_id = $request->cooling_product_id;
           $cooling_price = $request->cooling_price;
           $cooling_prod_variation_id = $request->cooling_prod_variation_id;
           $cooling_variation_color_id = $request->cooling_variation_color_id;
           
           //supply data
           $supply_id = $request->supply_id;
           $supply_product_id = $request->supply_product_id;
           $pwrsupply_price = $request->pwrsupply_price;
           $supply_variation_id = $request->supply_variation_id;
           $supply_variation_color_id = $request->supply_variation_color_id;
           
           //software data
           $software_id = $request->software_id;
           $software_product_id = $request->software_product_id;
           $software_price = $request->software_price;
           
           //service data 
           $service_id = $request->service_id;
           $service_product_id = $request->service_product_id;
           $service_price = $request->service_price;
           
           //rgb data
           $rgb_id = $request->rgb_id;
           $rgb_product_id = $request->rgb_product_id;
           $rgb_price = $request->rgb_price;
           
           //monitor data
           $monitor_id = $request->monitor_id;
           $monitor_product_id = $request->monitor_product_id;
           $monitor_price = $request->monitor_price;
           
           //peripheral data
           $peripheral_id = $request->peripheral_id;
           $peripheral_product_id = $request->peripheral_product_id;
           $peripheral_price = $request->peripheral_price;
           
           //extra data
           $extra_id = $request->extra_id;
           $extra_product_id = $request->extra_product_id;
           $extra_price = $request->extra_price;
           $pc_cart = [
               'type' => 'pc_cart',
               'case' => [
                   "cat_id" => $case_id,
                   "product_id" => $case_prod_id,
                   "quantity" => 1,
                   "price" => $case_price,
                   "image" => "",
                   "variation_id" => $case_prod_variation_id,
                   "color_id" => $case_variation_color_id,
                   ],
                   
                'cpu' => [
                   "cat_id" => $cpu_id,
                   "product_id" => $cpu_prod_id,
                   "quantity" => 1,
                   "price" => $cpu_price,
                   "image" => "",
                   "variation_id" => $cpu_variation_id,
                   "color_id" => $cpu_variation_color_id,
                   ],
                   
                'gpu' => [
                   "cat_id" => $gpu_id,
                   "product_id" => $gpu_prod_id,
                   "quantity" => 1,
                   "price" => $gpu_price,
                   "image" => "",
                   "variation_id" => $gpu_prod_variation_id,
                   "color_id" => $gpu_variation_color_id,
                   ],
                   
                'motherboard' => [
                   "cat_id" => $mtherboard_id,
                   "product_id" => $mtherboard_product_id,
                   "quantity" => 1,
                   "price" => $mothrboard_price,
                   "image" => "",
                   "variation_id" => $mtherboard_prod_variation_id,
                   "color_id" => $mtherboard_variation_color_id,
                   ],
                   
                'ram' => [
                   "cat_id" => $ram_id,
                   "product_id" => $ram_product_id,
                   "quantity" => $ram_qty,
                   "price" => $ram_price,
                   "image" => "",
                   "capacity" => $ram_capacity,
                   ],
                   
                'storage' => [
                   "cat_id" => $storage_id,
                   "product_id" => $storage_product_id,
                   "quantity" => $ssd_qty,
                   "price" => $storage_price,
                   "image" => "",
                   "capacity" => $ssd_capacity,
                   ],
                   
                'cooling' => [
                   "cat_id" => $cooling_id,
                   "product_id" => $cooling_product_id,
                   "quantity" => 1,
                   "price" => $cooling_price,
                   "image" => "",
                   "variation_id" => $cooling_prod_variation_id,
                   "color_id" => $cooling_variation_color_id,
                   ],
                   
                'supply' => [
                   "cat_id" => $supply_id,
                   "product_id" => $supply_product_id,
                   "quantity" => 1,
                   "price" => $pwrsupply_price,
                   "image" => "",
                   "variation_id" => $supply_variation_id,
                   "color_id" => $supply_variation_color_id,
                   ],
                   
                'software' => [
                   "cat_id" => $software_id,
                   "product_id" => $software_product_id,
                   "quantity" => 1,
                   "price" => $software_price,
                   "image" => "",
                   "variation_id" => "",
                   "color_id" => '',
                   ],
                   
                'service' => [
                   "cat_id" => $service_id,
                   "product_id" => $service_product_id,
                   "quantity" => 1,
                   "price" => $service_price,
                   "image" => "",
                   "variation_id" => "",
                   "color_id" => '',
                   ],
                   
                'rgb' => [
                   "cat_id" => $rgb_id,
                   "product_id" => $rgb_product_id,
                   "quantity" => 1,
                   "price" => $rgb_price,
                   "image" => "",
                   "variation_id" => "",
                   "color_id" => '',
                   ],
                   
                'monitor' => [
                   "cat_id" => $monitor_id,
                   "product_id" => $monitor_product_id,
                   "quantity" => $request->monitor_qty,
                   "price" => $monitor_price,
                   "image" => "",
                   "variation_id" => "",
                   "color_id" => '',
                   ],
                   
                   
                'peripheral' => [
                   "cat_id" => $peripheral_id,
                   "product_id" => $peripheral_product_id,
                   "quantity" => 1,
                   "price" => $peripheral_price,
                   "image" => "",
                   "variation_id" => "",
                   "color_id" => '',
                   ],
                   
                'extra' => [
                   "cat_id" => $extra_id,
                   "product_id" => $extra_product_id,
                   "quantity" => 1,
                   "price" => $extra_price,
                   "image" => "",
                   "variation_id" => "",
                   "color_id" => '',
                   ],
               ];
               
               session()->put('pc_cart', $pc_cart);
               
               $pc_cart = session()->get('pc_cart');
               
               return redirect()->route('view.cart');
       }
       
       if(!$product) {
            abort(404);
        }
        
    if(empty($user_id)){
        $cart = session()->get('cart');
  
        if(!$cart) {
            
            $cart = [
                    $id => [
                        "name" => $product->title,
                        "quantity" => $qty,
                        "price" => $price,
                        "image" => $product->image,
                        "variation_id" => $variation_id,
                        "product_type"=>"product"
                    ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Item Added to Cart');
        }
        
        if(isset($cart[$id])) {
            
        $old_qty = $cart[$id]['quantity'] ?? 0;
            
            if(($qty+$old_qty) <= $stock_qty){
                $cart[$id]['quantity'] = $qty+$old_qty;
            }
            else{
                $cart[$id]['quantity'] = $old_qty;
            }

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Item Added to Cart');

        }
       if(!isset($cart[$id])) { 
        $cart[$id] = [
            "name" => $product->title,
            "quantity" => $qty,
            "price" => $price,
            "image" => $product->image,
            "variation_id" => $variation_id,
            "product_type"=>"product"
        ];

        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Item Added to Cart');
       }
        
    }
    
    if(!empty($user_id)){
        
        $sessionData =  CartSession::where([
            ['session_key', $user_id],
            ['product_id',$id]
            ])->get();
            $oldQty = $sessionData[0]->quantity ?? 0;
        if($sessionData->count() > 0){
            if(($qty+$oldQty) <= $stock_qty){
                $new_qty = $qty+$oldQty;
            }
            else{
                $new_qty = $oldQty;
            }

            CartSession::where([
                ['session_key', $user_id],
                ['product_id',$id]
                ])->update([
                'session_key' => $user_id,
                'product_id' => $id,
                'quantity' => $new_qty,
                'price' => $price,
                'variation_id' => $variation_id,
                "product_type"=>"product"
                ]);
        }
        else{
          $sessionSave = new CartSession;
          $sessionSave->session_key = $user_id;
          $sessionSave->product_id = $id;
          $sessionSave->quantity = $qty;
          $sessionSave->price = $price;
          $sessionSave->product_type="product";
          $sessionSave->variation_id = $variation_id ?? null;
          $sessionSave->save();
        }
        
        return redirect()->back()->with('success', 'Item Added to Cart');
        
    }
    
    }

    /////////////

 /////////////


 function addToGiftCart(Request $request){
     
 
// print_r($request->all());
// die();
    //     if($request->sendby == 'sendbyemail'){
    //     }elseif($request->sendby == 'sendbypost'){
    //     }

    //    if($request->manual_address_text_change == 'manualaddress'){
    //    }elseif($request->manual_address_text_change == 'lookbackaddress'){
    //    }

       ////////////
////////

if($request->sendby == 'sendbyemail'){

                $validator = Validator::make($request->all(), [
                    'sender_full_name' => 'required',
                    'sender_email' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'recipient_emailid' => 'required',
                    'full_name' => 'required', 
                    'personal_message' => 'required'
                ]);
                $address_type =   'personal';

}elseif($request->sendby == 'sendbypost'){

    if($request->manual_address_text_change == 'manualaddress'){ 

        if($request->address_type=="on"){
            $validator = Validator::make($request->all(), [
                'sender_full_name' => 'required',
                'sender_email' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'start_typing_your_address_post' => 'required', 
                'company_name' => 'required',
                'full_name' => 'required', 
                'personal_message' => 'required',
                
            ]);
            $address_type =   'business';
        }else{
            $validator = Validator::make($request->all(), [
                'sender_full_name' => 'required',
                'sender_email' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'start_typing_your_address_post' => 'required', 
                'full_name' => 'required', 
                'personal_message' => 'required',
                
            ]);
            $address_type =   'personal';

        }
        
        

    }elseif($request->manual_address_text_change == 'lookbackaddress'){ 
        if($request->address_type=="on"){
                    $validator = Validator::make($request->all(), [
                        'sender_full_name' => 'required',
                        'sender_email' => 'required',
                        'first_name' => 'required',
                        'last_name' => 'required',

                        'address_post'=>'required',
                        'city' =>'required',
                        'state' =>'required',
                        'postcode' =>'required',
                        
                        'company_name' => 'required',
                        'full_name' => 'required', 
                        'personal_message' => 'required',
                        
                    ]);
                    $address_type =   'business';
            }else{
                    $validator = Validator::make($request->all(), [
                        'sender_full_name' => 'required',
                        'sender_email' => 'required',
                        'first_name' => 'required',
                        'last_name' => 'required', 
                        'address_post'=>'required',
                        'city' =>'required',
                        'state' =>'required',
                        'postcode' =>'required',
                        'full_name' => 'required', 
                        'personal_message' => 'required',
                        
                    ]);
                    $address_type =   'personal';
         }
    }

}

/////////////






///////////////////////


        if ($validator->fails()) {
            return response()->json([
                'status' => 404,
                'error' => $validator->errors()
            ]);
        }



        // $request->session()->forget('giftcard');
//  print_r($request->all());
//  die();
        $pid = base64_decode($request->product_id);
        $user_id = auth()->id(); 

        

        if($pid==0){
            $product = 1;
            $price = $request->custom_price;
        }else{
            $product = Product::find($pid);
            $product_price = $product->sale_price ?? $product->price; 
            $price = $request->price ?? $product_price;
        }
      
        $qty = $request->quantity ?? '1';
        $variation_id = $request->color_variation ?? '';
   


        if(!$product) {
             abort(404);
         }
         
     if(empty($user_id)){
         $cart = session()->get('cart');
         $giftcard = session()->get('giftcard');
 
         if(!$cart) {
            $id =  uniqid();
            if(isset($pid) && $pid!=0 && $pid!=null){
                $cart[$id] =[
                      'product_id' => $product->id,
                         "name" => $product->title,
                         "quantity" => $qty,
                         "price" => $price,
                         "image" => $product->image,
                         "variation_id" => $variation_id,
                         "product_type"=>"giftcard"
                     
             ];
                    $giftcard[$id] =[
                        'product_id' => $product->id,
                        "name" => $product->title,
                        "quantity" => $qty,
                        "price" => $price,
                        "image" => $product->image,
                        "variation_id" => $variation_id,
                        "product_type"=>"giftcard",
                        "first_name" => $request->first_name!=""?$request->first_name:$request->first_name,
                        "last_name" => $request->last_name!=""?$request->last_name:$request->last_name,
                        "sender_full_name" => $request->sender_full_name!=""?$request->sender_full_name:"",
                        "sender_email" => $request->sender_email!=""?$request->sender_email:"",
                        "full_name" => $request->full_name!=""?$request->full_name:"",
                        "personal_message" => $request->personal_message!=""?$request->personal_message:"",
                        "sendby" => $request->sendby!=""?$request->sendby:"",
                         "start_typing_your_address_post"=> $request->start_typing_your_address_post!=""?$request->start_typing_your_address_post:"",
                         "address_post"=>$request->address_post!=""?$request->address_post:"",
                        "address2_post"=>$request->address2_post!=""?$request->address2_post:"",
                        "address_type" =>  $address_type,
                        "company_name" => $request->company_name!=""?$request->company_name:"",
                        "city" => $request->city!=""?$request->city:"",
                        "state" => $request->state!=""?$request->state:"",
                        "postcode" => $request->postcode!=""?$request->postcode:"",
                        "recipient_emailid" => $request->recipient_emailid!=""?$request->recipient_emailid:"",
                    
                  ];

            }else{
                $cart[$id]=[
                    'product_id' => 0,
                        "name" => 'Gift Card',
                        "quantity" => 1,
                        "price" => $price,
                        "image" => '1668674838.png',
                        "variation_id" => $variation_id,
                        "product_type"=>"giftcard",

                        
                    
            ];

                    $giftcard[$id]=[
                        'product_id' => 0,
                            "name" => 'Gift Card',
                            "quantity" => 1,
                            "price" => $price,
                            "image" => '1668674838.png',
                            "variation_id" => $variation_id,
                            "product_type"=>"giftcard",
                            "first_name" => $request->first_name!=""?$request->first_name:$request->first_name,
                            "last_name" => $request->last_name!=""?$request->last_name:$request->last_name,
                            "sender_full_name" => $request->sender_full_name!=""?$request->sender_full_name:"",
                            "sender_email" => $request->sender_email!=""?$request->sender_email:"",
                            "full_name" => $request->full_name!=""?$request->full_name:"",
                            "personal_message" => $request->personal_message!=""?$request->personal_message:"",
                            "sendby" => $request->sendby!=""?$request->sendby:"",
                             "start_typing_your_address_post"=> $request->start_typing_your_address_post!=""?$request->start_typing_your_address_post:"",
                           "address_post"=>$request->address_post!=""?$request->address_post:"",
                           "address2_post"=>$request->address2_post!=""?$request->address2_post:"",
                           "address_type" =>  $address_type,
                            "company_name" => $request->company_name!=""?$request->company_name:"",
                            "city" => $request->city!=""?$request->city:"",
                            "state" => $request->state!=""?$request->state:"",
                            "postcode" => $request->postcode!=""?$request->postcode:"",
                            "recipient_emailid" => $request->recipient_emailid!=""?$request->recipient_emailid:"",
                          
                ];
            }
 
             session()->put('cart', $cart);
             session()->put('giftcard', $giftcard);
 
            //  return redirect()->back()->with('success', 'Item Added to Cart');
         }else{
            $id =  uniqid();

            if(isset($pid) &&  $pid!=0 && $pid!=null){
                $cart[$id]=[ 
                    'product_id' => $product->id,
                    "name"=> $product->title,
                            "quantity" => $qty,
                            "price" => $price,
                            "image" => $product->image,
                            "variation_id" => $variation_id,
                            "product_type"=>"giftcard"
                        
                ];

                $giftcard[$id]=[ 
                    'product_id' => $product->id,
                    "name"=> $product->title,
                            "quantity" => $qty,
                            "price" => $price,
                            "image" => $product->image,
                            "variation_id" => $variation_id,
                            "product_type"=>"giftcard",
                            "first_name" => $request->first_name!=""?$request->first_name:$request->first_name,
                            "last_name" => $request->last_name!=""?$request->last_name:$request->last_name,
                            "sender_full_name" => $request->sender_full_name!=""?$request->sender_full_name:"",
                            "sender_email" => $request->sender_email!=""?$request->sender_email:"",
                        "full_name" => $request->full_name!=""?$request->full_name:"",
                            "personal_message" => $request->personal_message!=""?$request->personal_message:"",
                            "sendby" => $request->sendby!=""?$request->sendby:"",
                             "start_typing_your_address_post"=> $request->start_typing_your_address_post!=""?$request->start_typing_your_address_post:"",
                           "address_post"=>$request->address_post!=""?$request->address_post:"",
                           "address2_post"=>$request->address2_post!=""?$request->address2_post:"",
                           "address_type" =>  $address_type,
                            "company_name" => $request->company_name!=""?$request->company_name:"",
                            "city" => $request->city!=""?$request->city:"",
                            "state" => $request->state!=""?$request->state:"",
                            "postcode" => $request->postcode!=""?$request->postcode:"",
                            "recipient_emailid" => $request->recipient_emailid!=""?$request->recipient_emailid:"",
                            
                ];


               }else{
                $cart[$id]=[
                          'product_id' => 0,
                           "name" => 'Gift Card',
                           "quantity" => 1,
                           "price" => $price,
                           "image" => '1668674838.png',
                           "variation_id" => $variation_id,
                           "product_type"=>"giftcard",


                           
                       
               ];


               $giftcard[$id]=[
                'product_id' => 0,
                 "name" => 'Gift Card',
                 "quantity" => 1,
                 "price" => $price,
                 "image" => '1668674838.png',
                 "variation_id" => $variation_id,
                 "product_type"=>"giftcard",
                 "first_name" => $request->first_name!=""?$request->first_name:$request->first_name,
                 "last_name" => $request->last_name!=""?$request->last_name:$request->last_name,
                 "sender_full_name" => $request->sender_full_name!=""?$request->sender_full_name:"",
                 "sender_email" => $request->sender_email!=""?$request->sender_email:"",
                 "full_name" => $request->full_name!=""?$request->full_name:"",
                 "personal_message" => $request->personal_message!=""?$request->personal_message:"",
                 "sendby" => $request->sendby!=""?$request->sendby:"",
                 "address_type" =>  $address_type,
                 "company_name" => $request->company_name!=""?$request->company_name:"",
                 "start_typing_your_address_post"=> $request->start_typing_your_address_post!=""?$request->start_typing_your_address_post:"",
                 "address_post"=>$request->address_post!=""?$request->address_post:"",
                 "address2_post"=>$request->address2_post!=""?$request->address2_post:"",
                 "city" => $request->city!=""?$request->city:"",
                 "state" => $request->state!=""?$request->state:"",
                 "postcode" => $request->postcode!=""?$request->postcode:"",
                 "recipient_emailid" => $request->recipient_emailid!=""?$request->recipient_emailid:"",
             ];

               }
    
               session()->put('cart', $cart);
               session()->put('giftcard', $giftcard);

         } 
         session()->flash('success', 'Item Added to Cart successfully');
         return response()->json([
            'status' => 200,
            'success' => 'Item Added to Cart'
        ]);
                // return redirect()->back()->with('success', 'Item Added to Cart');
         
          
         
     }
     
     if(!empty($user_id)){
       
        if($request->address_type=="on"){ 
            $address_type =   'business';
          } else{
              $address_type =   'personal';
          }
        
         


           
            $id =  uniqid();
        //     $sessionData =  CartSession::where([
        //         ['session_key', $user_id],
        //         ['product_id', $pid],
        //         ['product_type', "giftcard"]
        //         ])->get();
        //         // $oldQty = $sessionData[0]->quantity ?? 0;


        //  if($sessionData->count() > 0){
        //     $giftcard = session()->get('giftcard');
        //     echo 'a';

        //     //  CartSession::where([
        //     //      ['session_key', $user_id],
        //     //      ['product_id',$pid],
        //     //      ])->update([
        //     //      'session_key' => $user_id,
        //     //      'product_id' => $pid,
        //     //      'quantity' => 1,
        //     //      'price' => $price,
        //     //      'variation_id' => $variation_id,
        //     //      "product_type"=>"giftcard"
        //     //      ]);
           


        //          $giftcard[$id]=[
        //             'product_id' => 0,
        //              "name" => 'Gift Card',
        //              "quantity" => 1,
        //              "price" => $price,
        //              "image" => '1668674838.png',
        //              "variation_id" => $variation_id,
        //              "product_type"=>"giftcard",
        //              "first_name" => $request->first_name!=""?$request->first_name:$request->first_name,
        //              "last_name" => $request->last_name!=""?$request->last_name:$request->last_name,
        //              "sender_full_name" => $request->sender_full_name!=""?$request->sender_full_name:"",
        //              "sender_email" => $request->sender_email!=""?$request->sender_email:"",
        //              "full_name" => $request->full_name!=""?$request->full_name:"",
        //              "personal_message" => $request->personal_message!=""?$request->personal_message:"",
        //              "sendby" => $request->sendby!=""?$request->sendby:"",
        //             "address_type" =>  $address_type,
        //              "company_name" => $request->company_name!=""?$request->company_name:"",
        //              "start_typing_your_address_post"=> $request->start_typing_your_address_post!=""?$request->start_typing_your_address_post:"",
        //              "address_post"=>$request->address_post!=""?$request->address_post:"",
        //              "address2_post"=>$request->address2_post!=""?$request->address2_post:"",
        //              "city" => $request->city!=""?$request->city:"",
        //              "state" => $request->state!=""?$request->state:"",
        //              "postcode" => $request->postcode!=""?$request->postcode:"",
        //              "recipient_emailid" => $request->recipient_emailid!=""?$request->recipient_emailid:"",
        //  ];

        //  $sessionSave = new CartSession;
        //  $sessionSave->session_key = $user_id;
        //  $sessionSave->product_id = $pid;
        //  $sessionSave->quantity = $qty;
        //  $sessionSave->price = $price;
        //  $sessionSave->product_type = "giftcard";
        //  $sessionSave->variation_id = $variation_id ?? null;
        //  $sessionSave->save();
        //  session()->put('giftcard', $giftcard);
        //  }
        //  else{
            $giftcard = session()->get('giftcard');
   //dd($request->all());
//    echo 'b';
            
            $giftcard[$id]=[
                'product_id' => 0,
                "name" => 'Gift Card',
                "quantity" => 1,
                "price" => $price,
                "image" => '1668674838.png',
                "variation_id" => $variation_id,
                "product_type"=>"giftcard",
                "first_name" => $request->first_name!=""?$request->first_name:$request->first_name,
                "last_name" => $request->last_name!=""?$request->last_name:$request->last_name,
                "sender_full_name" => $request->sender_full_name!=""?$request->sender_full_name:"",
                "sender_email" => $request->sender_email!=""?$request->sender_email:"",
                "full_name" => $request->full_name!=""?$request->full_name:"",
                "personal_message" => $request->personal_message!=""?$request->personal_message:"",
                "sendby" => $request->sendby!=""?$request->sendby:"",
                "address_type" =>  $address_type,
                "company_name" => $request->company_name!=""?$request->company_name:"",
                "start_typing_your_address_post"=> $request->start_typing_your_address_post!=""?$request->start_typing_your_address_post:"",
                "address_post"=>$request->address_post!=""?$request->address_post:"",
                "address2_post"=>$request->address2_post!=""?$request->address2_post:"",
                "city" => $request->city!=""?$request->city:"",
                "state" => $request->state!=""?$request->state:"",
                "postcode" => $request->postcode!=""?$request->postcode:"",
                "recipient_emailid" => $request->recipient_emailid!=""?$request->recipient_emailid:"",
            ];
           $sessionSave = new CartSession;
           $sessionSave->session_key = $user_id;
           $sessionSave->product_id = ($pid == 0)? null:$pid;
           $sessionSave->quantity = $qty;
           $sessionSave->price = $price;
           $sessionSave->product_type = "giftcard";
           $sessionSave->variation_id = $variation_id ?? null;
           $sessionSave->save();

           session()->put('giftcard', $giftcard);
        //  }
         

        //  print_r($giftcard);
        //  $request->session()->forget('giftcard');

  session()->flash('success', 'Item Added to Cart successfully');
         return response()->json([
            'status' => 200,
            'success' => 'Item Added to Cart'
        ]);

         return redirect()->back()->with('success', 'Item Added to Cart');
        //  
     }
     
     }
////////////delete giftcart////////////



// function deleteGiftCard(Request $request){
//     $user_id = auth()->id();
//     $cart = session()->get('giftcard');
//     if($request->ajax()){
//     if(empty($user_id)){
//         if($cart){
            
//             $cart = session()->get('giftcard');

//         if(isset($cart[$request->id])) {

//             unset($cart[$request->id]);

//             session()->put('giftcard', $cart);
//         }

//         session()->flash('success', 'item deleted successfully');
//         }
//     }
    
//     if(!empty($user_id)){
//         CartSession::where([
//             ['product_id',$request->id],
//             ['session_key',$user_id]
//             ])->delete();
//         session()->flash('success', 'item deleted successfully');
//     }
//     }
// }

///////////////////delete gift cart//////////////


    //////////////////////////////////////////////

////////////////////////////////////////////////


    function deleteCart(Request $request){
        $user_id = auth()->id();
        $giftcard = session()->get('giftcard');
        $cart = session()->get('cart');
        if($request->ajax()){
        if(empty($user_id)){
            if($cart){
                
                $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'item deleted successfully');
            }

///////
            if($giftcard){
                
                $giftcard = session()->get('giftcard');

            if(isset($giftcard[$request->id])) {

                unset($giftcard[$request->id]);

                session()->put('giftcard', $giftcard);
            }

            session()->flash('success', 'item deleted successfully');
            }

            ////
        }
        
        if(!empty($user_id)){
            CartSession::where([
                ['product_id',$request->id],
                ['session_key',$user_id],
                ['product_type','product']
                ])->delete();
/////gift card by auto id delete from cart ////
                CartSession::where([
                    ['id',$request->id],
                    ['session_key',$user_id],
                    ['product_type','giftcard']
                    ])->delete();
/////gift card by auto id delete from cart end ////

            session()->flash('success', 'item deleted successfully');
        }
        }
    }
    
    function updateCart(Request $request){
        if($request->ajax()){
            $user_id = auth()->id();
            $id = $request->id;
            $quantity = $request->quantity;
            
            if(empty($user_id)){
               $cart = session()->get('cart');
            $cart[$id]["quantity"] = $quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'item updated'); 
            }
            
            if(!empty($user_id)){
                CartSession::where([
                ['product_id',$id],
                ['session_key',$user_id]
                ])->update([
                    'quantity' => $quantity
                    ]);
            }
        }
    }
    
    function viewCart(){

        $user_id = auth()->id();
        $CartSession = '';
        if(!empty($user_id)){
            
        $CartSession = CartSession::where('session_key',$user_id)->orderBy('id','DESC')->get();
        }
        
        if(!empty($CartSession) && $CartSession->count() > 0){
            $data = compact('CartSession');
        }
        else{
            $CartSession = ''; 
        $data = compact('CartSession');
        }
      return view('cart',$data);

    }
    
    
    
    function applyCoupon(Request $request){
        if($request->ajax()){
            $collectArray = array();
            
            if(empty($request->coupon_code)){
                if(session()->has('applied_coupon')){
                session()->forget('applied_coupon');
                }
                
            }
           
            $amount = $request->amount;
            $coupon_code = trim($request->coupon_code);
            if(!empty($request->coupon_code)){
                $coupon_detail = Coupon::where('coupon_code',$coupon_code)->first();
                $coupon_id = $coupon_detail->id;
                $discount_type = $coupon_detail->discount_type;
                $coupon_type = $coupon_detail->coupon_type;
                $coupon_amount = $coupon_detail->coupon_amount;
                $use_limit = $coupon_detail->use_limit;
                $expiry_time = $coupon_detail->expiry_time;
                $today_date = date('Y-m-d');
                $used = $coupon_detail->used;
            
                if($use_limit > $used){
                        if($today_date <= $expiry_time ){
                        if($used == $use_limit){
                            $collectArray = array(
                                       'status'=>'error', 'message'=>'This coupon has reached the limit!'
                                     );
                        }
                        else{
                          $collectArray = array(
                                       'status'=>'success'
                                     ); 
                                     
                        $coupon = [
                                    "coupon_code" => $coupon_code,
                                ];
                        session()->put('applied_coupon', $coupon); 
                        }
                        $collectArray = array(
                                   'status'=>'success'
                                 );
                    }
                    else{
                        $collectArray = array(
                                       'status'=>'error', 'message'=>'This coupon has been expired!'
                                     );
                    }
                }else{
                    $collectArray = array(
                                       'status'=>'error', 'message'=>'This coupon usage limit has been reached!'
                    );
                }
            
                
            
            }else{
                $collectArray = array(
                                   'status'=>'error', 'message'=>'Coupon code required!'
                                 );
            }
        }
        
        return json_encode($collectArray);
        die(0);
    }
    
    function deletePCCart(Request $request){
        if($request->ajax()){
            session()->forget('pc_cart');
            session()->forget('case_cart');
            session()->forget('cooling_cart');
            session()->forget('motherboard_cart');
            session()->forget('gpu_cart');
            session()->forget('cpu_cart');
            session()->forget('pwrsupply_cart');
            session()->forget('ram_cart');
            session()->forget('storage_cart');
            session()->forget('monitor_cart');
            session()->forget('peripheral_cart');
            session()->forget('rgb_cart');
            session()->forget('extra_cart');
            session()->forget('software_cart');
            session()->forget('service_cart');
            session()->forget('service_cart');
            echo 'delete pc cart';
        }
    }
}

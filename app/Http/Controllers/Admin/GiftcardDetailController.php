<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiftcardDetail;
use App\Models\GiftcardCategory;
use Session; 
class GiftcardDetailController extends Controller
{
    //

   public function viewGiftcard(){
        $giftcarddetail = array();
        $giftcarddetail = GiftcardDetail::orderBy('id','ASC')->get();
        $data = compact('giftcarddetail');
        return view('admin.manage-giftcard.all_giftcards',$data);
    }

    public function updateExpiryDate(Request $request){
        // echo $request->formattedToday.' 00:00:00';
    // echo "hello";
    // die();
        // $giftcarddetail = array();
     
        $UserUpdateArr = array(
            'giftcard_expirydate' => $request->formattedToday.' 00:00:00',
            );

            echo    $IsUpdate =   GiftcardDetail::where('id','=',$request->giftcard_id)->update($UserUpdateArr);

       
    }




    public function contentGiftCard(Request $request){
         
        $UserUpdateArr = array(
            'giftcard_expirydate' => $request->formattedToday.' 00:00:00',
            );

        $IsUpdate =   GiftcardDetail::where('id','=',$request->giftcard_id)->update($UserUpdateArr);

       
    }



    public function listGiftCard(Request $request){
        $giftcardcategory = array();
        $giftcardcategory = GiftcardCategory::orderBy('id','ASC')->get();
        $data = compact('giftcardcategory');
        return view('admin.manage-giftcard.list_giftcards',$data);

        // echo 
        // $UserUpdateArr = array(
        //     'giftcard_expirydate' => $request->formattedToday.' 00:00:00',
        //     );

        // $IsUpdate =   GiftcardDetail::where('id','=',$request->giftcard_id)->update($UserUpdateArr);

       
    }


    public function viewGiftCardForm(Request $request,$id){
 
        if($request->isMethod('post')){
                $getClientOriginalName_giftcardimage='';
                if($request->hasFile('giftcard_image')){ 
                    $file = $request->file('giftcard_image');
                    $destinationPath = 'uploads/product_gallery_images';
                    $getClientOriginalName_giftcardimage = date('mdYHis')."_".$file->getClientOriginalName();
                    $file->move($destinationPath,$getClientOriginalName_giftcardimage);
                }
                if(!empty($getClientOriginalName_giftcardimage)){
                    GiftcardCategory::where('id', $id)->update([
                        'title' => $request->title,
                        'sub_title' => $request->sub_title,
                        'description' => $request->description,
                        'giftcards_img'=>$getClientOriginalName_giftcardimage
                     ]);
                }else{
                    GiftcardCategory::where('id', $id)->update([
                        'title' => $request->title,
                        'sub_title' => $request->sub_title,
                        'description' => $request->description,
                     ]);
                }
            Session::flash('alert-success', 'Successfully done!');     

        }
        $giftcard_details = array();$giftcard_details = GiftcardCategory::find($id);
       
        
        $data = compact('giftcard_details');
        return view('admin.manage-giftcard.add_update_giftcard',$data);
 
       
    }



    // public function viewGiftCardForm(Request $request,$id){

    //     // $giftcardcategory = array();

    //     // $coupon_id = '';
    //     // if(!empty($enGiftCardid)){
    //     //    $coupon_id = $enGiftCardid;
    //     // }
        
    //     // if($request->isMethod('POST')){
    //     //     if(!empty($coupon_id)){
    //     //         $coupon = GiftcardCategory::find($coupon_id);
    //     //     }else{
    //     //         // $coupon = new GiftcardCategory;
    //     //     }
            
    //         // $coupon->coupon_code = $request->coupon_code;
    //         // $coupon->discount_type = $request->discount_type;
    //         // $coupon->coupon_type = $request->coupon_type;
    //         // $coupon->coupon_amount = $request->coupon_amount;
    //         // $coupon->use_limit = $request->use_limit;
    //         // $coupon->expiry_time = $request->expiry_time;
            
    //         // $isSaved = $coupon->save();
            
    //         // if($isSaved){
    //             // return redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
    //         // }
    //         // else{
    //             // return redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
    //         // }
    //     // }
      
        
    //     $giftcard_details = array();
    //     if(!empty($id)){
    //         GiftcardCategory::where('id', $id)
    //         ->update([
    //             'title' => $request->title,
    //             'sub_title' => $request->sub_title,
    //             'description' => $request->description
    //          ]);



    //        $giftcard_details = GiftcardCategory::find($id);
    //     }
    //     Session::flash('alert-success', 'Successfully done!'); 
    //     $data = compact('giftcard_details');
    //     // session()->flash('success', 'Item Added to Cart successfully');
    //     return view('admin.manage-giftcard.add_update_giftcard',$data);
 
       
    // }


    public function addUpdateGiftCard(Request $request,$id){


        // print_r($request->all());
        // die();
        // $giftcardcategory = array();

        // $coupon_id = '';
        // if(!empty($enGiftCardid)){
        //    $coupon_id = $enGiftCardid;
        // }
        
        // if($request->isMethod('POST')){
        //     if(!empty($coupon_id)){
        //         $coupon = GiftcardCategory::find($coupon_id);
        //     }else{
        //         // $coupon = new GiftcardCategory;
        //     }
            
            // $coupon->coupon_code = $request->coupon_code;
            // $coupon->discount_type = $request->discount_type;
            // $coupon->coupon_type = $request->coupon_type;
            // $coupon->coupon_amount = $request->coupon_amount;
            // $coupon->use_limit = $request->use_limit;
            // $coupon->expiry_time = $request->expiry_time;
            
            // $isSaved = $coupon->save();
            
            // if($isSaved){
                // return redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
            // }
            // else{
                // return redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
            // }
        // }
        
        $giftcard_details = array();
        if(!empty($id)){
           $giftcard_details = GiftcardCategory::find($id);
        }

        // print_r($giftcard_details);
        // die();
        $data = compact('giftcard_details');

        return view('admin.manage-giftcard.add_update_giftcard',$data);

        // $giftcardcategory = array();
        // $giftcardcategory = GiftcardCategory::orderBy('id','ASC')->get();
        // $data = compact('giftcardcategory');
        // return view('admin.manage-giftcard.list_giftcards',$data);

        // echo 
        // $UserUpdateArr = array(
        //     'giftcard_expirydate' => $request->formattedToday.' 00:00:00',
        //     );

        // $IsUpdate =   GiftcardDetail::where('id','=',$request->giftcard_id)->update($UserUpdateArr);

       
    }
}

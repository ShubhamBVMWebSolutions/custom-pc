<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\BankAccount;
use App\Models\AdminModels\SiteSetting;
use Config;
use Session;

class PaymentMethodController extends Controller
{
    function allMethods(){
       $paymentMethods =  PaymentMethod::orderBy('id','DESC')->get();
       $data = compact('paymentMethods');
       return view('admin.manage-payment-method.all_methods',$data);
    }
    
    function ChangeStatus(Request $request){
        $ResponseStatus = 0;
    	if($request->ajax())
    	{
    	    $statusFor = trim($request->statusFor);
    		$idFor     = trim($request->idFor);
    		$statusNew = trim($request->statusNew);
    		if(!empty($statusFor) && !empty($idFor) && !empty($statusNew))
    		{
    		    $isExistsInfo  = PaymentMethod::find($idFor);
                    
                    if($isExistsInfo)
                    {
                         $currentStatus = $isExistsInfo->status;
                         if(isset($currentStatus) && $currentStatus==0)
                         {
                             $NewStatus = 1;
                         }else{
                             $NewStatus = 0;
                         }
                         $isExistsInfo->status = $NewStatus;
                         $ResponseStatus = $isExistsInfo->save();
                    } 
    		}
    		else{

    			$ResponseStatus = 0;
    		}
    	}
    	$collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
        
    }
    
    function addupdateBankAccount(Request $request){
        if($request->isMethod('POST')){
            $bank_name = $request->bank_name;
            $account_name = $request->account_name;
            $account_number = $request->account_number;
            $iban = $request->iban;
           for($i=0; $i<count($bank_name); $i++){
               if(!empty($request->account_id[$i])){
                   $bankAccount = BankAccount::find($request->account_id[$i]);
               }
               else{
               $bankAccount = new BankAccount;
               }
               $bankAccount->bank_name = $bank_name[$i];
               $bankAccount->account_name = $account_name[$i];
               $bankAccount->account_number = $account_number[$i];
               $bankAccount->iban = $iban[$i];
               $bankAccount->save();
           }
           
           if($bankAccount->id){
               return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
           }
           else{
               return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
           }
        }
        
        $all_accounts = array();
        $all_accounts = BankAccount::orderBy('id','DESC')->get();
        $data = compact('all_accounts');
        return view('admin.manage-payment-method.add_bank_account',$data);
    }
    
    function updateEsewaCredential(Request $request){
        if($request->isMethod('POST'))
          {
              $settingIndicator = $request->setting_name;
              $settingVal =  $request->setting_val;
              
              if(!empty($settingIndicator))
                {
             
                    $updatearr = array(
                             'setting_val'=>$settingVal
                            );
                }  
                
            $update = SiteSetting::where('setting_name','=',$settingIndicator)->update($updatearr);
            if($update)
           {
             return  redirect()->back()->with('alert-success','successfully done!');
           }else{
               return  redirect()->back()->with('alert-error','Not added please try again');
           }
          }
        
        return view('admin.manage-payment-method.esewa');
    }
}

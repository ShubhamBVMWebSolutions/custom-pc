<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeLogosSlider;
use Validator;
use Config;
use Session;
use Auth;
use Str;

class HomeLogosSliderController extends Controller
{
    public function viewlogo(){
        $homelogos = HomeLogosSlider::get();
    	$logocount = $homelogos->count();
    	$data = compact('homelogos','logocount');
       
       return view ('admin.manage-home-logos.view_logo',$data);
   }
    public function addUpdatelogo(Request $request, $enclogoId=null){
           $homelogoid='';
    	if(!empty($enclogoId))
    	{
    		$homelogoid = $enclogoId;
    	}
    
        	if($request->isMethod('POST'))	{

    	       	 $image='';
    	      if(!empty($homelogoid))
    		     {
    		          $validator = Validator::make($request->all(), [
                      'title'      => 'required',
                      
                  ]);
                  
                    $homelogo = HomeLogosSlider::find($homelogoid);
       		  	   $image = $request->old_post_image;
    		  	    $homelogo->status =  $request->status;
    		     }else{
    		         
    		           $validator = Validator::make($request->all(), [
                      'title'      => 'required',
                      'image'   => 'required',
                  ]); 
                      $homelogo  = new HomeLogosSlider;
                      $homelogo->status =  1;
    		     }
 
    	       
                   if ($validator->fails())
		        {
		            return redirect()->back()->withErrors($validator)->withInput();
		        }
		        
    		     if($request->hasFile('image'))
		             {
		              $dir = Config::get('constants.HOME_LOGOS_IMAGE_PATHS');
		              //->delete old image 
		              if(file_exists(base_path($dir.$image)))
                     {
                         \File::delete(base_path($dir.$image));
                     }

		            $image = time().'.'.$request->image->getClientOriginalExtension();
		            $uploadImg = $request->file('image')->move($dir , $image);
		             }
		             
		  
		      $homelogo->title      =  $request->title;
		      $homelogo->image       =     $image;
              $IsSaved = $homelogo->save();
              if($IsSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
    	}   
    	    $homelogodelatis=array();
            if(!empty($homelogoid))
    	    {
    	 	$homelogodelatis = HomeLogosSlider::find($homelogoid);
    	   }
    	    $alllogos = HomeLogosSlider::get();
           $data = compact('homelogodelatis','alllogos');
            return view ('admin.manage-home-logos.add_edit_logo',$data);
   }
   
   
   public function DyanmicDelete(Request $request){
         $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = HomeLogosSlider::find($idFor);
           
                $ResponseStatus =  $IsExists_info->delete();        
           
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
   }
   
   public function changestuts(Request $request){
       $ResponseStatus = 0;
    	if($request->ajax())
    	{
    	    $statusFor = trim($request->statusFor);
    		$idFor     = trim($request->idFor);
    		$statusNew = trim($request->statusNew);
    		if(!empty($statusFor) && !empty($idFor) && !empty($statusNew))
    		{
    		    $isExistsInfo  = HomeLogosSlider::find($idFor);
                    
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
}

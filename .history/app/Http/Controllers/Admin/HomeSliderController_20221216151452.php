<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Validator;
use Config;
use Session;
use Auth;
use Str;

class HomeSliderController extends Controller
{
    public function viewslider(){
        $homeslider = HomeSlider::get();
    	$slidercount = $homeslider->count();
    	$data = compact('homeslider','slidercount');
       
       return view ('admin.manage-home-slider.view_all_slider',$data);
   }
    public function addUpdateslider(Request $request, $encsliderId=null){
           $homesliderid='';
    	if(!empty($encsliderId))
    	{
    		$homesliderid = $encsliderId;
    	}
    
        	if($request->isMethod('POST'))	{

    	       	 $image='';
    	      if(!empty($homesliderid))
    		     {
    		          $validator = Validator::make($request->all(), [
                      'title'      => 'required',
                      
                  ]);
                  
                    $homeslider = HomeSlider::find($homesliderid);
       		  	   $image = $request->old_post_image;
    		  	    $homeslider->status =  $request->status;
    		     }else{
    		         
    		           $validator = Validator::make($request->all(), [
                      'title'      => 'required',
                      'image'   => 'required',
                  ]); 
                      $homeslider  = new HomeSlider;
    		     }
 
    	       
                   if ($validator->fails())
		        {
		            return redirect()->back()->withErrors($validator)->withInput();
		        }
		        
    		     if($request->hasFile('image'))
		             {
		              $dir = public_path('/').Config::get('constants.HOME_SLIDER_IMAGE_PATHS');
		              //->delete old image 
		              if(file_exists(base_path($dir.$image)))
                     {
                         \File::delete(base_path($dir.$image));
                     }

		            $image = time().'.'.$request->image->getClientOriginalExtension();
		            $uploadImg = $request->file('image')->move($dir , $image);
		             }
		             
		  
		      $homeslider->title      =  $request->title;
		      $homeslider->text1      =  $request->text1;
		       $homeslider->text2      =  $request->text2;
		      $homeslider->content      =  $request->content;
		      $homeslider->image       =     $image;
              $IsSaved = $homeslider->save();
              if($IsSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
    	}   
    	    $homesliderdelatis=array();
            if(!empty($homesliderid))
    	    {
    	 	$homesliderdelatis = HomeSlider::find($homesliderid);
    	   }
    	    $allslider = HomeSlider::get();
           $data = compact('homesliderdelatis','allslider');
            return view ('admin.manage-home-slider.add_update_slider',$data);
   }
   
   
   public function DyanmicDelete(Request $request){
         $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = HomeSlider::find($idFor);
           
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
    		    $isExistsInfo  = HomeSlider::find($idFor);
                    
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

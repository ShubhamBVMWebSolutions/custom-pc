<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GettingStarted;
use Config;
use Session;
use Auth;
use Str;
use Validator;

class GettingStartedController extends Controller
{
    public function viewgettingstarted(){
        $gettingdata = GettingStarted::get();
    	$gettingcount = $gettingdata->count();
    	$data = compact('gettingdata','gettingcount');
       
       return view ('admin.manage-getting-started.all_gettings',$data);
   }
    public function addUpdategetting(Request $request, $encgettingId=null){
           $gettingid='';
    	if(!empty($encgettingId))
    	{
    		$gettingid = $encgettingId;
    	}
    
        	if($request->isMethod('POST'))	{

    	       	 $image='';
    	      if(!empty($gettingid))
    		     {
    		          $validator = Validator::make($request->all(), [
                      'title'      => 'required',
                      
                  ]);
                  
                    $gettingstarted = GettingStarted::find($gettingid);
       		  	   $image = $request->old_post_image;
    		  	    $gettingstarted->status =  $request->status;
    		     }else{
    		         
    		           $validator = Validator::make($request->all(), [
                      'title'      => 'required',
                  ]); 
                      $gettingstarted  = new GettingStarted;
                      $gettingstarted->status =  1;
    		     }
 
    	       
                   if ($validator->fails())
		        {
		            return redirect()->back()->withErrors($validator)->withInput();
		        }
		        
    		     if($request->hasFile('image'))
		             {
		              $dir = Config::get('constants.SITE_IMAGE_PATHS');
		              //->delete old image 
		              if(file_exists(base_path($dir.$image)))
                     {
                         \File::delete(base_path($dir.$image));
                     }

		            $image = time().'.'.$request->image->getClientOriginalExtension();
		            $uploadImg = $request->file('image')->move($dir , $image);
		             }
		             
		  
		      $gettingstarted->title      =  $request->title;
		      $gettingstarted->text      =  $request->text;
		      $gettingstarted->image       =     $image;
              $IsSaved = $gettingstarted->save();
              if($IsSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
    	}   
    	    $gettingdetails=array();
            if(!empty($gettingid))
    	    {
    	 	$gettingdetails = GettingStarted::find($gettingid);
    	   }
           $data = compact('gettingdetails');
            return view ('admin.manage-getting-started.add_update',$data);
   }
   
   
   public function DyanmicDelete(Request $request){
         $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = Testimonials::find($idFor);
           
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
    		    $isExistsInfo  = Testimonials::find($idFor);
                    
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

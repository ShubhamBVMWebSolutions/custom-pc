<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use Config;
use Session;
use Auth;
use Str;
use Validator;

class TestimonialController extends Controller
{
    public function viewtestimonial(){
        $testimonial = Testimonials::get();
    	$testicount = $testimonial->count();
    	$data = compact('testimonial','testicount');
       
       return view ('admin.manage-testimonial.all_testimonials',$data);
   }
    public function addUpdatetestimonial(Request $request, $enctestimonialId=null){
           $testimonialid='';
    	if(!empty($enctestimonialId))
    	{
    		$testimonialid = $enctestimonialId;
    	}
    
        	if($request->isMethod('POST'))	{

    	       	 $image='';
    	      if(!empty($testimonialid))
    		     {
    		          $validator = Validator::make($request->all(), [
                      'name'      => 'required',
                      
                  ]);
                  
                    $testimonial = Testimonials::find($testimonialid);
       		  	   $image = $request->old_post_image;
    		  	    $testimonial->status =  $request->status;
    		     }else{
    		         
    		           $validator = Validator::make($request->all(), [
                      'name'      => 'required',
                      'image'   => 'required',
                      'content' => 'required',
                  ]); 
                      $testimonial  = new Testimonials;
                      $testimonial->status =  1;
    		     }
 
    	       
                   if ($validator->fails())
		        {
		            return redirect()->back()->withErrors($validator)->withInput();
		        }
		        
    		     if($request->hasFile('image'))
		             {
		              $dir = public_path('/').Config::get('constants.TESTIMONIAL_IMAGE_PATHS');
		              //->delete old image 
		              if(file_exists(base_path($dir.$image)))
                     {
                         \File::delete(base_path($dir.$image));
                     }

		            $image = time().'.'.$request->image->getClientOriginalExtension();
		            $uploadImg = $request->file('image')->move($dir , $image);
		             }
		             
		  
		      $testimonial->name      =  $request->name;
		      $testimonial->company      =  $request->company;
		      $testimonial->content      =  $request->content;
		      $testimonial->image       =     $image;
              $IsSaved = $testimonial->save();
              if($IsSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
    	}   
    	    $testimonialdetails=array();
            if(!empty($testimonialid))
    	    {
    	 	$testimonialdetails = Testimonials::find($testimonialid);
    	   }
    	    $alltestimonials = Testimonials::get();
           $data = compact('testimonialdetails','alltestimonials');
            return view ('admin.manage-testimonial.add_update_testimonial',$data);
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

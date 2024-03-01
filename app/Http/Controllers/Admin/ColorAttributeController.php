<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ColorAttribute;
use Illuminate\Http\Request;
use Config;
use Session;
use Validator;

class ColorAttributeController extends Controller
{
    public function viewcolorattributes(){
        $colorattrs = ColorAttribute::orderBy('id','DESC')->get();
    	$attrscount = $colorattrs->count();
    	$data = compact('colorattrs','attrscount');
       
       return view ('admin.manage_color_attribute.all_attributes',$data);
   }
    public function addupdateColorAttr(Request $request, $encColorAttrId=null){
           $colorId='';
    	if(!empty($encColorAttrId))
    	{
    		$colorId = $encColorAttrId;
    	}
    
        	if($request->isMethod('POST'))	{

    	       	 
    	      if(!empty($colorId))
    		     {
    		          $validator = Validator::make($request->all(), [
                      'color_name'      => 'required',
                      'color_code'      => 'required',
                      
                  ]);
                  
                    $colorAttr = ColorAttribute::find($colorId);
       		  	  
    		     }else{
    		         
    		           $validator = Validator::make($request->all(), [
                      'color_name'      => 'required',
                      'color_code'      => 'required',
                  ]); 
                      $colorAttr  = new ColorAttribute;
    		     }
 
    	       
                   if ($validator->fails())
		        {
		            return redirect()->back()->withErrors($validator)->withInput();
		        }
		        
		      $colorAttr->color_name      =  $request->color_name;
		      $colorAttr->color_code      =  $request->color_code;
              $IsSaved = $colorAttr->save();
              if($IsSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
    	}   
    	    $colorattrdetails=array();
            if(!empty($colorId))
    	    {
    	 	$colorattrdetails = ColorAttribute::find($colorId);
    	   }
    	    
           $data = compact('colorattrdetails');
            return view ('admin.manage_color_attribute.add_update',$data);
   }
   
   
   public function DyanamicDelete(Request $request){
         $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = ColorAttribute::find($idFor);
           
                $ResponseStatus =  $IsExists_info->delete();        
           
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
   }
   

}

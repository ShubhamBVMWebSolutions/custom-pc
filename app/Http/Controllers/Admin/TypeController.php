<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Config;
use Session;

class TypeController extends Controller
{
    function viewTypeattribute(){
        $all_types = '';
        $all_types = Type::orderBy('id','DESC')->get();
        $data = compact('all_types');
        return view('admin.manage-types.all_types',$data);
    }
    
    function addupdateTypeAttr(Request $request, $encTypeAttrId=null){
        $type_id = '';
        if(!empty($encTypeAttrId)){
            $type_id = $encTypeAttrId;
        }
        
        if($request->isMethod('POST')){
            if(!empty($type_id)){
    	       $type = Type::find($type_id);
    	   } 
    	   else{
    	       $type = new Type;
    	   }
    	   
    	   $type->title = $request->title;
    	   $type->slug = slugify($request->title);
    	   $isSaved = $type->save();
    	   if($isSaved){
    	       return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
    	   }
    	   else{
    	       return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
    	   }
            
        }
        
        $typeDetail = '';
        if(!empty($type_id)){
            $typeDetail = Type::find($type_id);
        }
        $data = compact('typeDetail');
        return view('admin.manage-types.add_update',$data);
    }
    
    public function DyanamicDelete(Request $request){
         $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = Type::find($idFor);
           
                $ResponseStatus =  $IsExists_info->delete();        
           
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
   }
}

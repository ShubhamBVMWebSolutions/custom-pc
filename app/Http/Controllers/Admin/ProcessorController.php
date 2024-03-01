<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Processor;
use Config;
use Session;

class ProcessorController extends Controller
{
    function viewProcessorattribute(){
        $all_processor = '';
        $all_processor = Processor::orderBy('id','DESC')->get();
        $data = compact('all_processor');
        return view('admin.manage-processors.all_processors',$data);
    }
    
    function addupdateProcessorAttr(Request $request, $encProcessorAttrId=null){
        $processor_id = '';
        if(!empty($encProcessorAttrId)){
            $processor_id = $encProcessorAttrId;
        }
        
        if($request->isMethod('POST')){
            if(!empty($processor_id)){
    	       $processor = Processor::find($processor_id);
    	   } 
    	   else{
    	       $processor = new Processor;
    	   }
    	   
    	    $processor->title = $request->title;
    	   $processor->slug = slugify($request->title);
    	   $isSaved = $processor->save();
    	   if($isSaved){
    	       return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
    	   }
    	   else{
    	       return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
    	   }
        }
        
        $processorDetail = '';
        if(!empty($processor_id)){
            $processorDetail = Processor::find($processor_id);
        }
        $data = compact('processorDetail');
        return view('admin.manage-processors.add_update',$data);
    }
    
    public function DyanamicDelete(Request $request){
         $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = Processor::find($idFor);
           
                $ResponseStatus =  $IsExists_info->delete();        
           
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
   }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GraphicsCard;
use Config;
use Session;

class GraphicCardController extends Controller
{
    function viewgraphicattribute(){
        $all_graphics = '';
        $all_graphics = GraphicsCard::orderBy('id','DESC')->get();
        $data = compact('all_graphics');
        return view('admin.manage-graphiccard.all_graphiccards',$data);
    }
    function addupdateGraphicAttr(Request $request, $encGraphicAttrId=null){
        $graphic_id = '';
        if(!empty($encGraphicAttrId))
    	{
    		$graphic_id = $encGraphicAttrId;
    	}
    	
    	if($request->isMethod('POST'))
    	{  
    	   if(!empty($graphic_id)){
    	       $garphiccard = GraphicsCard::find($graphic_id);
    	   } 
    	   else{
    	       $garphiccard = new GraphicsCard;
    	   }
    	   
    	   $garphiccard->title = $request->title;
    	   $garphiccard->slug = slugify($request->title);
    	   $isSaved = $garphiccard->save();
    	   if($isSaved){
    	       return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
    	   }
    	   else{
    	       return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
    	   }
    	}
        $graphicDetail = '';
        if(!empty($graphic_id)){
            $graphicDetail = GraphicsCard::find($graphic_id);
        }
        $data = compact('graphicDetail');
        return view('admin.manage-graphiccard.add_update',$data);
    }
    
    function DyanamicDelete(Request $request){
        $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = GraphicsCard::find($idFor);
            
            $ResponseStatus =  $IsExists_info->delete();
        }
        
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
    }
}

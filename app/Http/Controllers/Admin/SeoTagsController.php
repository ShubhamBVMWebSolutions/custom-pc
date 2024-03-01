<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeoTags;

class SeoTagsController extends Controller
{
    function updateSeoTags(Request $request){
        if($request->isMethod('POST'))
      {

         $page = $request->page_name;
         $meta_title =  $request->meta_title;
         $meta_keywords =  $request->meta_keywords;
         $meta_description =  $request->meta_description;


         if(!empty($page))
         {
            $updatearr = array(
                             'meta_title'=>$meta_title,
                             'meta_keywords'=>$meta_keywords,
                             'meta_description'=>$meta_description
                            );
            $update = SeoTags::where('page','=',$page)->update($updatearr);

           if($update)
           {
             return  redirect()->back()->with('alert-success','successfully done!');
           }else{
               return  redirect()->back()->with('alert-error','Not added please try again');
           }

            //return view('admin.site-settings.site_settings');

         }
     }
         return view('admin.manage_seo_tags.manage_seo_tags');
    }
}

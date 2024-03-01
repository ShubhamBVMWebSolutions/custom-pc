<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Contact;
use App\Models\HomePage;
use App\Models\HomeSection;
use Validator;
use Config;

class PagesController extends Controller
{
    function updateabout(Request $request){
    	if($request->isMethod('POST'))	{
    		$validator = Validator::make($request->all(), [
                      'title'    => 'required',
                      'content'  => 'required',
                  ]);

    		if ($validator->fails())
		        {
		            return redirect()->back()->withErrors($validator)->withInput();
		        }

		    $about = About::find(1);

		    $about->title      =  $request->title;
		    $about->content    =  $request->content;
		      
              $IsSaved = $about->save();
              if($IsSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
    	}
    	$aboutdata = About::find(1);
    	$data = compact('aboutdata');
    	return view('admin.manage-pages.update_about',$data);
    }
    
    function update_privacy_policy(Request $request){
    	if($request->isMethod('POST'))	{
    		$validator = Validator::make($request->all(), [
                      'title'    => 'required',
                      'content'  => 'required',
                  ]);

    		if ($validator->fails())
		        {
		            return redirect()->back()->withErrors($validator)->withInput();
		        }

		    $about = About::find(2);

		    $about->title      =  $request->title;
		    $about->content    =  $request->content;
		      
              $IsSaved = $about->save();
              if($IsSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
    	}
    	$aboutdata = About::find(2);
    	$data = compact('aboutdata');
    	return view('admin.manage-pages.update_about',$data);
    }
    
    function update_terms_and_conditions(Request $request){
    	if($request->isMethod('POST'))	{
    		$validator = Validator::make($request->all(), [
                      'title'    => 'required',
                      'content'  => 'required',
                  ]);

    		if ($validator->fails())
		        {
		            return redirect()->back()->withErrors($validator)->withInput();
		        }

		    $about = About::find(3);

		    $about->title      =  $request->title;
		    $about->content    =  $request->content;
		      
              $IsSaved = $about->save();
              if($IsSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
    	}
    	$aboutdata = About::find(3);
    	$data = compact('aboutdata');
    	return view('admin.manage-pages.update_about',$data);
    }
    
    function updatecontact(Request $request){
    	if($request->isMethod('POST'))	{
    		$validator = Validator::make($request->all(), [
                      'title'    => 'required',
                  ]);

    		if ($validator->fails())
		        {
		            return redirect()->back()->withErrors($validator)->withInput();
		        }

		    $contact = Contact::find(1);

		    $contact->title      =  $request->title;
		    $contact->information    =  $request->information;
		    $contact->address    =  $request->address;
		      
              $IsSaved = $contact->save();
              if($IsSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
    	}
    	$contactdata = Contact::find(1);
    	$data = compact('contactdata');
    	return view('admin.manage-pages.update_contact',$data);
    }
    
    function updateHome(Request $request){
        
        if($request->isMethod('POST')){
            if($request->section_id == 1){
                $image = $request->old_section_img;
                if($request->hasFile('section_image1'))
		             {
		              $dir = public_path('/').Config::get('constants.HOME_IMAGES_PATH');
		              #->delete old image 
		              if(file_exists(base_path($dir.$image)))
                     {
                         \File::delete(base_path($dir.$image));
                     }

		            $image = time().'.'.$request->section_image1->getClientOriginalExtension();
		            $uploadImg = $request->file('section_image1')->move($dir , $image);
		             }
            $homesection = HomePage::find(1);
            $homesection->section_title = $request->title1;
            $homesection->content = $request->content1;
            $homesection->section_link = $request->link1;
            $homesection->image = $image;
            $isSaved = $homesection->save();
            
             if($isSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
            }
            
            if($request->section_id2 == 2){
                $image = $request->old_section_img2;
                if($request->hasFile('section_image2'))
		             {
		              $dir = public_path('/').Config::get('constants.HOME_IMAGES_PATH');
		              #->delete old image 
		              if(file_exists(base_path($dir.$image)))
                     {
                         \File::delete(base_path($dir.$image));
                     }

		            $image = time().'.'.$request->section_image2->getClientOriginalExtension();
		            $uploadImg = $request->file('section_image2')->move($dir , $image);
		             }
            $homesection = HomePage::find(2);
            $homesection->section_title = $request->title2;
            $homesection->content = $request->content2;
            $homesection->section_link = $request->link2;
            $homesection->image = $image;
            $isSaved = $homesection->save();
            
             if($isSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
            }
            
            if($request->section_id3 == 3){
                $image = $request->old_section_img3;
                if($request->hasFile('section_image3'))
		             {
		              $dir = public_path('/').Config::get('constants.HOME_IMAGES_PATH');
		              #->delete old image 
		              if(file_exists(base_path($dir.$image)))
                     {
                         \File::delete(base_path($dir.$image));
                     }

		            $image = time().'.'.$request->section_image3->getClientOriginalExtension();
		            $uploadImg = $request->file('section_image3')->move($dir , $image);
		             }
            $homesection = HomePage::find(3);
            $homesection->section_title = $request->title3;
            $homesection->content = $request->content3;
            $homesection->section_link = $request->link3;
            $homesection->image = $image;
            $isSaved = $homesection->save();
            
             if($isSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
            }
        }
        $homeSection=HomeSection::get();
        //dd($homeSection);
        return view('admin.manage-pages.update_home',compact('homeSection'));
    }
    Public function HomeSectionChangeStatus(Request $request){
        $section = HomeSection::find($request->section_id);
        $section->status = $request->status;
        $section->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}

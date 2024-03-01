<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;


class AdvertisementController extends Controller
{
   public function index(){
    $advertisement = Advertisement::first();
    return view('admin/advertisement/manage_advertisement', ['advertisement' => $advertisement]);
   }

   public function update(Request $request){
    $advertisement = Advertisement::first();
    if(!$advertisement){
        $advertisement = new Advertisement();
    }
    $advertisement->link1 = $request->input('link1');
    $advertisement->link2 = $request->input('link2');
    $advertisement->link3 = $request->input('link3');


    // Handle icon upload
    if ($request->hasFile('image1')) {
        $image = $request->file('image1');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->move('public/images', $filename);
        $advertisement->image1 = $filename;
    }

    if ($request->hasFile('image2')) {
        $image = $request->file('image2');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->move('public/images', $filename);
        $advertisement->image2 = $filename;
    }

    if ($request->hasFile('image3')) {
        $image = $request->file('image3');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->move('public/images', $filename);
        $advertisement->image3 = $filename;
    }

    $advertisement->save();
    return redirect()->route('admin.advertisement.index')->with('message', 'Content updated successfully.');
   }

}
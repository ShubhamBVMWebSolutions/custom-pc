<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::orderBy('title','ASC')->get();
    	$data = compact('store');
        return view('admin.stores.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $prodCat = ProductCategory::orderBy('title','ASC')->get();
        $data = compact('prodCat');
        return view('admin.stores.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:stores',
            'address_line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'phone' => 'required',
            'google_map_link' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'status' => 'required',
        ]);
        $store = new Store();
        $store->title = $request->title;
        $store->slug = Str::slug($request->title,'-');
        $store->address_line_1 = $request->address_line_1;
        $store->address_line_2 = $request->address_line_2;
        $store->city = $request->city;
        $store->state = $request->state;
        $store->country = $request->country;
        $store->pincode = $request->pincode;
        $store->phone = $request->phone;
        $store->tel = $request->tel;
        $store->google_map_link = $request->google_map_link;
        $store->latitude = $request->latitude;
        $store->longitude = $request->longitude;
        
        $opening_hours=[];
        for($i=0;$i<7;$i++){
            $day_name_var = 'day_'.($i+1).'_name';
            $day_opening_var = 'day_'.($i+1).'_opening';
            $day_closing_var = 'day_'.($i+1).'_closing';
            $day_closed_status_var = 'day_'.($i+1).'_closed_status';
            $opening_hours[$i]['day'] = $i+1;
            $opening_hours[$i]['day_name'] = $request->$day_name_var;
            $opening_hours[$i]['day_opening'] = $request->$day_opening_var;
            $opening_hours[$i]['day_closing'] = $request->$day_closing_var;
            $opening_hours[$i]['day_closed_status'] = $request->$day_closed_status_var;
        }
        
        $store->opening_hours =  json_encode($opening_hours);
        $store->status = $request->status;
        if(!empty($request->product_range)){
            $store->product_range = json_encode($request->product_range);
        }
        $store->save();

        session()->flash("alert-success","Store added successfully.");
        return redirect()->route("admin.stores.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $store = Store::find($id);
        if(empty($store)){
            return redirect()->back();
        }
        $prodCat = ProductCategory::orderBy('title','ASC')->get();
        // dd($store);
    	$data = compact('prodCat','store');
        return view('admin.stores.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = base64_decode($id);
        $validated = $request->validate([
            'title' => 'required|unique:stores,id,'.$id,
            'address_line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'phone' => 'required',
            'google_map_link' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'status' => 'required',
        ]);
        $store = Store::find($id);
        $store->title = $request->title;
        $store->slug = Str::slug($request->title,'-');
        $store->address_line_1 = $request->address_line_1;
        $store->address_line_2 = $request->address_line_2;
        $store->city = $request->city;
        $store->state = $request->state;
        $store->country = $request->country;
        $store->pincode = $request->pincode;
        $store->phone = $request->phone;
        $store->tel = $request->tel;
        $store->google_map_link = $request->google_map_link;
        $store->latitude = $request->latitude;
        $store->longitude = $request->longitude;
        
        $opening_hours=[];
        for($i=0;$i<7;$i++){
            $day_name_var = 'day_'.($i+1).'_name';
            $day_opening_var = 'day_'.($i+1).'_opening';
            $day_closing_var = 'day_'.($i+1).'_closing';
            $day_closed_status_var = 'day_'.($i+1).'_closed_status';
            $opening_hours[$i]['day'] = $i+1;
            $opening_hours[$i]['day_name'] = $request->$day_name_var;
            $opening_hours[$i]['day_opening'] = $request->$day_opening_var;
            $opening_hours[$i]['day_closing'] = $request->$day_closing_var;
            $opening_hours[$i]['day_closed_status'] = $request->$day_closed_status_var;
        }
        
        $store->opening_hours =  json_encode($opening_hours);
        $store->status = $request->status;
        if(!empty($request->product_range)){
            $store->product_range = json_encode($request->product_range);
        }
        $store->save();

        session()->flash("alert-success","Store updated successfully.");
        return redirect()->route("admin.stores.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = Store::find($idFor);
            $ResponseStatus =  $IsExists_info->delete();
        }
        $collectArray = array('status'=>$ResponseStatus);
        return json_encode($collectArray);
    }
}

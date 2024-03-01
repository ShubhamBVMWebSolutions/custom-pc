<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Product;
use App\Models\ProductCollection;
use Illuminate\Support\Str;
use Config;

class ProductCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_collections = ProductCollection::orderBy('order_number','ASC')->get();
        // $productCollectionMenu = ProductCollection::where('parent_id',null)->where('list_in_product_menu','Yes')->get();
        // $result = treeMenuFromProductCollection($productCollectionMenu);
        // print_r($result);die;
    	$data = compact('product_collections');
        return view('admin.product-collections.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where("status",1)->where('product_type','product')->orderBy('title','ASC')->get();
        $parent_collections = ProductCollection::orderBy('title','ASC')->where('status','Active')->where('list_in_product_menu','Yes')->get();
    	$data = compact('products','parent_collections');
        return view('admin.product-collections.create',$data);
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
            'title' => 'required|unique:product_collections',
            'description' => 'required',
            'product_ids' => 'required',
            'status' => 'required',
            'list_in_product_menu' => 'required',
        ],[
            'product_ids.required'=>'Related products are required.'
        ]);
        $product_collection = new ProductCollection();
        $product_collection->title = $request->title;
        if(!empty($request->parent_id)){
            $product_collection->parent_id = $request->parent_id;    
        }
        if(!empty($request->order_number)){
            $product_collection->order_number = $request->order_number;    
        }
        
        if($request->hasFile('small_icon'))
        {
              
            $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
             
            $image = time().'.'.$request->small_icon->getClientOriginalExtension();
            $uploadImg = $request->file('small_icon')->move($dir , $image);
            $product_collection->small_icon = $image;
        }
        
        
        if($request->hasFile('banner'))
        {
              
            $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
             
            $banner = time().'.'.$request->banner->getClientOriginalExtension();
            $uploadBanner = $request->file('banner')->move($dir , $banner);
            $product_collection->banner = $banner;
        }
        
        
        $product_collection->description = $request->description;
        $product_collection->slug = Str::slug($request->title,'-');
        $product_collection->status = $request->status;
        $product_collection->list_in_product_menu = $request->list_in_product_menu;
        if(!empty($request->product_ids)){
            $product_collection->product_ids = json_encode($request->product_ids);
        }
        $product_collection->save();

        session()->flash("alert-success","Product collection added successfully.");
        return redirect()->route("admin.product-collections.index");
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
        $product_collection = ProductCollection::find($id);
        if(empty($product_collection)){
            return redirect()->back();
        }
        $products = Product::where("status",1)->where('product_type','product')->orderBy('title','ASC')->get();
        $parent_collections = ProductCollection::orderBy('title','ASC')->where('status','Active')->where('id','!=','Active')->where('list_in_product_menu','Yes')->get();
    	$data = compact('products','product_collection','parent_collections');
        return view('admin.product-collections.edit',$data);
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
            'title' => 'required|unique:product_collections,id,'.$id,
            'description' => 'required',
            'product_ids' => 'required',
            'status' => 'required',
            'list_in_product_menu' => 'required',
        ],[
            'product_ids.required'=>'Related products are required.'
        ]);
        $product_collection = ProductCollection::find($id);
        $product_collection->title = $request->title;
        
        if(!empty($request->parent_id)){
            $product_collection->parent_id = $request->parent_id;    
        }  
        
        if(!empty($request->order_number)){
            $product_collection->order_number = $request->order_number;    
        }
        
        
        if($request->hasFile('small_icon'))
        {
              
            $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
             
            $image = time().'.'.$request->small_icon->getClientOriginalExtension();
            $uploadImg = $request->file('small_icon')->move($dir , $image);
            $product_collection->small_icon = $image;
        }

        if($request->hasFile('banner'))
        {
              
            $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
             
            $banner = time().'.'.$request->banner->getClientOriginalExtension();
            $uploadBanner = $request->file('banner')->move($dir , $banner);
            $product_collection->banner = $banner;
        }
        
        $product_collection->description = $request->description;
        $product_collection->slug = Str::slug($request->title,'-');
        $product_collection->status = $request->status;
        $product_collection->list_in_product_menu = $request->list_in_product_menu;
        if(!empty($request->product_ids)){
            $product_collection->product_ids = json_encode($request->product_ids);
        }
        $product_collection->save();

        session()->flash("alert-success","Product collection updated successfully.");
        return redirect()->route("admin.product-collections.index");
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
            $product_collection = ProductCollection::find($idFor);
            $ResponseStatus =  $product_collection->delete();
        }
        $collectArray = array('status'=>$ResponseStatus);
        return json_encode($collectArray);
    }
}

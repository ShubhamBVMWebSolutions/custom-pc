<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewProductBlog;
use Illuminate\Validation\Rule;

class NewProductBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new_product_blogs = NewProductBlog::orderBy('title','ASC')->get();
    	$data = compact('new_product_blogs');
        return view('admin.new-product-blogs.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.new-product-blogs.create');
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
            'title' => 'required|unique:new_product_blogs',
            'description' => 'required',
            'media_type' => 'required',
            'media_content' => 'required',
            'button_text' => 'required',
            'button_link' => 'required',
            'status' => 'required',
        ]);
        $new_product_blog = new NewProductBlog();
        $new_product_blog->title = $request->title;
        $new_product_blog->description = $request->description;
        $new_product_blog->status = $request->status;
        $new_product_blog->button_text = $request->button_text;
        $new_product_blog->button_link = $request->button_link;
        $new_product_blog->media_type = $request->media_type;
        if($request->media_type == 'image'){
                $dir = public_path('/')."uploads/product_blogs/";
                $image = time().'.'.$request->media_content->getClientOriginalExtension();
                $uploadImg = $request->file('media_content')->move($dir , $image);
                $new_product_blog->media_content = $image;
        }else{
            $new_product_blog->media_content = $request->media_content;
        }
        $new_product_blog->save();

        session()->flash("alert-success","New At SOI added successfully.");
        return redirect()->route("admin.new-product-blogs.index");
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
        $new_product_blog = NewProductBlog::find($id);
        if(empty($new_product_blog)){
            return redirect()->back();
        }
    	$data = compact('new_product_blog');
        return view('admin.new-product-blogs.edit',$data);
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
            'title' => 'required|unique:blogs,id,'.$id,
            'description' => 'required',
            'media_type' => 'required',
            'media_content' => Rule::requiredIf($request->media_type == 'youtube'),
            'button_text' => 'required',
            'button_link' => 'required',
            'status' => 'required',
        ]);
        $new_product_blog = NewProductBlog::find($id);
        $new_product_blog->title = $request->title;
        $new_product_blog->description = $request->description;
        $new_product_blog->status = $request->status;
        $new_product_blog->button_text = $request->button_text;
        $new_product_blog->button_link = $request->button_link;
        $new_product_blog->media_type = $request->media_type;
        
        if($request->media_type == 'image'){
                if($request->hasFile('media_content'))
                {
                    $dir = public_path('/')."uploads/product_blogs/";
                    $oldImage =  $new_product_blog->media_content;
        
                    if (!empty($oldImage)) {
                        if (file_exists($dir . $oldImage)) {
                         \File::delete($dir . $oldImage);
                        }
                   }
        
                    $image = time().'.'.$request->media_content->getClientOriginalExtension();
                    $uploadImg = $request->file('media_content')->move($dir , $image);
                    $new_product_blog->media_content = $image;
                }
        }else{
            $new_product_blog->media_content = $request->media_content;
        }
        $new_product_blog->save();

        session()->flash("alert-success","New At SOI updated successfully.");
        return redirect()->route("admin.new-product-blogs.index");
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
            $IsExists_info = NewProductBlog::find($idFor);
            if($IsExists_info->media_type == 'image'){
                $oldImage =  $IsExists_info->media_content;
                if (!empty($oldImage)) {
                    $dir = public_path('/')."uploads/product_blogs/";
                    if (file_exists($dir . $oldImage)) {
                    \File::delete($dir . $oldImage);
                    }
                }
            }
            $ResponseStatus =  $IsExists_info->delete();
        }
        $collectArray = array('status'=>$ResponseStatus);
        return json_encode($collectArray);
    }
}

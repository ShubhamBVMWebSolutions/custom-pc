<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Product;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('title','ASC')->get();
    	$data = compact('blogs');
        return view('admin.blogs.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogCat = BlogCategory::orderBy('title','ASC')->get();
        $products = Product::where("status",1)->orderBy('title','ASC')->get();
    	$data = compact('blogCat','products');
        return view('admin.blogs.create',$data);
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
            'blog_category_id' => 'required',
            'title' => 'required|unique:blogs',
            'content' => 'required',
            'type' => 'required',
            'published' => 'required',
        ]);
        $blog = new Blog();
        if($request->hasFile('image'))
        {
            $dir = public_path('/')."uploads/blogs/";
            

            $image = time().'.'.$request->image->getClientOriginalExtension();
            $uploadImg = $request->file('image')->move($dir , $image);
            $blog->image = $image;
        }

       
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->slug = Str::slug($request->title,'-');
        $blog->blog_category_id = $request->blog_category_id;
        $blog->type = $request->type;
        $blog->published = $request->published;
        if($request->published == 'Publish'){
            $blog->published_at = date("Y-m-d H:i:s");
        }
        if(!empty($request->product_ids)){
            $blog->product_ids = json_encode($request->product_ids);
        }
        $blog->save();

        session()->flash("alert-success","Blog added successfully.");
        return redirect()->route("admin.blogs.index");
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
        $blog = Blog::find($id);
        if(empty($blog)){
            return redirect()->back();
        }
        $blogCat = BlogCategory::orderBy('title','ASC')->get();
        $products = Product::where("status",1)->orderBy('title','ASC')->get();
    	$data = compact('blogCat','products','blog');
        return view('admin.blogs.edit',$data);
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
        $validated = $request->validate([
            'blog_category_id' => 'required',
            'title' => 'required|unique:blogs',
            'content' => 'required',
            'type' => 'required',
            'published' => 'required',
        ]);
        $blog = new Blog();
        if($request->hasFile('image'))
        {
            $dir = public_path('/')."uploads/blogs/";
            

            $image = time().'.'.$request->image->getClientOriginalExtension();
            $uploadImg = $request->file('image')->move($dir , $image);
            $blog->image = $image;
        }

       
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->slug = Str::slug($request->title,'-');
        $blog->blog_category_id = $request->blog_category_id;
        $blog->type = $request->type;
        $blog->published = $request->published;
        if($request->published == 'Publish'){
            $blog->published_at = date("Y-m-d H:i:s");
        }
        if(!empty($request->product_ids)){
            $blog->product_ids = json_encode($request->product_ids);
        }
        $blog->save();

        session()->flash("alert-success","Blog updated successfully.");
        return redirect()->route("admin.blogs.index");
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
            $IsExists_info = blog::find($idFor);
                $ResponseStatus =  $IsExists_info->delete();
        }
        $collectArray = array('status'=>$ResponseStatus);
        return json_encode($collectArray);
    }
}

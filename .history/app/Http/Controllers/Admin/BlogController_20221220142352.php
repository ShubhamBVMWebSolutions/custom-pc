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
        ]);

        if($request->hasFile('image'))
        {
            $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
            

            $image = time().'.'.$request->product_image->getClientOriginalExtension();
            $uploadImg = $request->file('product_image')->move($dir , $image);
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->slug = Str::slug($request->title,'-');
        $blog->blog_category_id = $request->blog_category_id;
        $blog->type = $request->type;
        $blog->product_ids = $request->product_ids;
        dd($request->product_ids);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

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

        $category = new BlogCategory();
        $category->title = $request->title;
        $category->content = $request->content;
        $category->slug = Str::slug($request->title,'-');
        $category->product_category_id = $request->product_category_id;
        $category->save();

        session()->flash("alert-success","Newsletter send successfully.");
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
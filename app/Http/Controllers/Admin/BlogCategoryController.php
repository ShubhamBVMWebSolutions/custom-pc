<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\ProductCategory;
use Illuminate\Support\Str;


class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogCat = BlogCategory::orderBy('title','ASC')->get();
    	$data = compact('blogCat');
        return view('admin.blog-categories.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ProductCat = ProductCategory::orderBy('title','ASC')->get();
    	$data = compact('ProductCat');
        return view('admin.blog-categories.create',$data);
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
            'title' => 'required|unique:blog_categories',
            'content' => 'required',
        ]);

        $category = new BlogCategory();
        $category->title = $request->title;
        $category->content = $request->content;
        $category->slug = Str::slug($request->title,'-');
        $category->product_category_id = $request->product_category_id;
        $category->save();

        session()->flash("alert-success","category added successfully.");
        return redirect()->route("admin.blog-categories.index");
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
        $category = BlogCategory::find($id);
        if(empty($category)){
            return redirect()->back();
        }
        $ProductCat = ProductCategory::orderBy('title','ASC')->get();
    	$data = compact('ProductCat','category');
        return view('admin.blog-categories.edit',$data);
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
            'title' => 'required|unique:blog_categories,id,'.$id,
            'content' => 'required',
        ]);

        $category = BlogCategory::find($id);
        $category->title = $request->title;
        $category->content = $request->content;
        $category->slug = Str::slug($request->title,'-');
        $category->product_category_id = $request->product_category_id;
        $category->save();

        session()->flash("alert-success","category updated successfully.");
        return redirect()->route("admin.blog-categories.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = BlogCategory::find($idFor);
                $ResponseStatus =  $IsExists_info->delete();
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
    }
}

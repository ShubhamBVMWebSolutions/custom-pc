<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Product;

class BlogController extends Controller
{
    public function blog_index(){
        $data=[];
        $data['blogs'] = Blog::where("Published","Publish")->limit(3)->latest()->get();
        $data['blog_categories'] = BlogCategory::where("status","Active")->get();
        $data['blog_categories_selected'] = BlogCategory::where("status","Active")->latest()->limit(4)->get();
        return view('blog_index',$data);
    }
    
    public function blog_single($category_slug,$type,$slug){
        $data=[];
        $data['category'] = BlogCategory::where("slug",$category_slug)->first();
        if(empty($data['category'])){
            return abort(404);
        }
        $data['blog'] = Blog::where("Published","Publish")->where("type",$type)->where("slug",$slug)->first();
        if(empty($data['blog'])){
            return abort(404);
        }else{
            if(!empty($data['blog']->product_ids)){
                $produstIdArray = json_decode($data['blog']->product_ids,true);
                $data['products'] = Product::whereIn("id",$produstIdArray)->where("status",1)->get();
            }
             
        }
        return view('blog_single',$data);
    }
    
    public function blog_category($category_slug){
        $data=[];
        $data['types'] = [];
        $data['category'] = BlogCategory::where("slug",$category_slug)->first();
        if(empty($data['category'])){
            return abort(404);
        }
        $typeCollection = Blog::select("type")->where("Published","Publish")->where("blog_category_id",$data['category']->id)->distinct()->get();
        if($typeCollection->count() > 0){
            $types = $typeCollection->pluck("type");
        }
        if(!empty($types)){
            foreach($types as $type){
                $data['types'][$type]['blogs'] = Blog::where("Published","Publish")->where("blog_category_id",$data['category']->id)->where("type",$type)->get();
            }
        }
        return view('blog_category',$data);
    }
}
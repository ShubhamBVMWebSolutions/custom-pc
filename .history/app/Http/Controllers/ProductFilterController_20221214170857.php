<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallary;
use App\Models\ProductVariation;
use App\Models\BrandAttribute;
use App\Models\TermRelation;
use App\Models\ProductCategoryRelationship;
use Str;

class ProductFilterController extends Controller
{
    public function index(){
        $data =[];
        $sortby = "price_asc";
        $perPage = 20;
        $categoryIds = "";
        if(isset($_GET['sort_by'])){
            $sortby = $_GET['sort_by'];
        }

        if(isset($_GET['per_page'])){
            $perPage = $_GET['per_page'];
        }

        if(isset($_GET['category_ids'])){
            $categoryIds = $_GET['category_ids'];
        }

        //sort products
        if($sortby == 'price_asc'){
            $query = Product::orderBy('products.price',"ASC");
        }
        if($sortby == 'price_desc'){
            $query = Product::orderBy('products.price',"DESC");
        }
        if($sortby == 'new_old'){
            $query = Product::orderBy('products.id',"DESC");
        }
        if($sortby == 'old_new'){
            $query = Product::orderBy('products.id',"ASC");
        }
        if($sortby == 'title_asc'){
            $query = Product::orderBy('products.title',"ASC");
        }
        if($sortby == 'title_asc'){
            $query = Product::orderBy('products.title',"ASC");
        }
        if($sortby == 'popular'){
            $query = Product::orderBy('products.views',"DESC");
        }


        $products=$query->paginate($perPage)->withQueryString();
        echo "<pre>";
        print_r($products);die;
        
        die;
        return view('products',$data);
    }
}

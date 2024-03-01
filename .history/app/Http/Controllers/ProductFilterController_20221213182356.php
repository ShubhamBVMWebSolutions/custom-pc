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
        if(isset($_GET['sort_by'])){
            $sortby = $_GET['sort_by'];
        }

        //sort products
        if($sortby == 'price_asc'){
            $query = Product::orderBy('price',"ASC");
        }
        if($sortby == 'price_desc'){
            $query = Product::orderBy('price',"DESC");
        }
        if($sortby == 'new_old'){
            $query = Product::orderBy('id',"DESC");
        }
        if($sortby == 'old_new'){
            $query = Product::orderBy('id',"ASC");
        }
        if($sortby == 'title_asc'){
            $query = Product::orderBy('title',"ASC");
        }
        if($sortby == 'title_asc'){
            $query = Product::orderBy('title',"ASC");
        }

        
        $products=$query->paginate(20)->withQueryString();
        print_r($products);die;
        
        die;
        return view('products',$data);
    }
}

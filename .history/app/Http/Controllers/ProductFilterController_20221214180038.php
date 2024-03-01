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

        $perPage = 20;

        if(isset($_GET['per_page'])){
            $perPage = $_GET['per_page'];
        }

        

        //sort products
        $sortby = "price_asc";

        if(isset($_GET['sort_by'])){
            $sortby = $_GET['sort_by'];
        }

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

        // category filter

        $categoryIds = "";
        
        if(isset($_GET['category_ids'])){
            $categoryIds = $_GET['category_ids'];
        }

        if(!empty($categoryIds)){
            $categoriesArray = explode(",",$categoryIds);
            $query->join('product_category_relations', 'product_category_relations.product_id', '=', 'products.id');
            $query->whereIn("product_category_relations.category_id",$categoriesArray);
        }

        // brand filter
        $brandIds = '';
        
        if(isset($_GET['brand_ids'])){
            $brandIds = $_GET['brand_ids'];
        }

        if(!empty($brandIds)){
            $brandArray = explode(",",$brandIds);
            $query->whereIn("products.brand",$brandArray);
        }

        // graphic card filter
        $graphicCardIds = "";

        if(isset($_GET['graphic_card_ids'])){
            $graphicCardIds = $_GET['graphic_card_ids'];
        }

        if(!empty($graphicCardIds)){
            $graphicCardArray = explode(",",$graphicCardIds);
            $query->join('term_relations', 'term_relations.product_id', '=', 'products.id');
            $query->whereIn("term_relations.term_id",$graphicCardArray);
            $query->where("term_relations.term_type","graphic");
        }

        // hard drive filter
        $hardDriveIds = "";

        if(isset($_GET['hard_drive_ids'])){
            $hardDriveIds = $_GET['hard_drive_ids'];
        }

        if(!empty($hardDriveIds)){
            $hardDriveIdsArray = explode(",",$hardDriveIds);
            $query->join('term_relations', 'term_relations.product_id', '=', 'products.id');
            $query->whereIn("term_relations.term_id",$hardDriveIdsArray);
            $query->where("term_relations.term_type","hard_drive");
        }

        // price filter
        $priceMin = "";
        $priceMax = "";

        if(isset($_GET['price_min']) && isset($_GET['price_max'])){
            $priceMin = $_GET['price_min'];
            $priceMax = $_GET['price_max'];
        }

        if(!empty($priceMin) && !empty($priceMax)){
            $query->whereBetween('price', [$priceMin, $priceMax]);
        }



        $products=$query->paginate($perPage)->withQueryString();
        echo "<pre>";
        print_r($products);die;
        
        die;
        return view('products',$data);
    }
}

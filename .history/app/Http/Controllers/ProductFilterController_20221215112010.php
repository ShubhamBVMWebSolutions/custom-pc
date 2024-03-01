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
        $metaDetails =[];
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
            $query = Product::where("status",1)->orderBy('products.price',"ASC");
        }
        if($sortby == 'price_desc'){
            $query = Product::where("status",1)->orderBy('products.price',"DESC");
        }
        if($sortby == 'new_old'){
            $query = Product::where("status",1)->orderBy('products.id',"DESC");
        }
        if($sortby == 'old_new'){
            $query = Product::where("status",1)->orderBy('products.id',"ASC");
        }
        if($sortby == 'title_asc'){
            $query = Product::where("status",1)->orderBy('products.title',"ASC");
        }
        if($sortby == 'title_desc'){
            $query = Product::where("status",1)->orderBy('products.title',"DESC");
        }
        if($sortby == 'popular'){
            $query = Product::where("status",1)->orderBy('products.views',"DESC");
        }

        // category filter

        $categoryIds = "";
        $categoriesArray= [];

        if(isset($_GET['category_ids'])){
            $categoryIds = $_GET['category_ids'];
        }

        if(!empty($categoryIds)){
            $categoriesArray = explode(",",$categoryIds);
            if(count($categoriesArray) == 1){
                $metaDetails = ProductCategory::find($categoryIds);
            }
            $query->join('product_category_relations', 'product_category_relations.product_id', '=', 'products.id');
            $query->whereIn("product_category_relations.category_id",$categoriesArray);
        }

        // brand filter
        $brandIds = '';
        $brandArray= [];

        if(isset($_GET['brand_ids'])){
            $brandIds = $_GET['brand_ids'];
        }

        if(!empty($brandIds)){
            $brandArray = explode(",",$brandIds);
            $query->whereIn("products.brand",$brandArray);
        }

        // graphic card filter
        $graphicCardIds = "";
        $graphicCardArray = [];
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
        $hardDriveIdsArray = [];
        if(isset($_GET['hard_drive_ids'])){
            $hardDriveIds = $_GET['hard_drive_ids'];
        }

        if(!empty($hardDriveIds)){
            $hardDriveIdsArray = explode(",",$hardDriveIds);
            $query->join('term_relations', 'term_relations.product_id', '=', 'products.id');
            $query->whereIn("term_relations.term_id",$hardDriveIdsArray);
            $query->where("term_relations.term_type","hard_drive");
        }

        // processor filter
        $processorIds = "";
        $processorIdsArray = [];
        if(isset($_GET['processor_ids'])){
            $processorIds = $_GET['processor_ids'];
        }

        if(!empty($processorIds)){
            $processorIdsArray = explode(",",$processorIds);
            $query->join('term_relations', 'term_relations.product_id', '=', 'products.id');
            $query->whereIn("term_relations.term_id",$processorIdsArray);
            $query->where("term_relations.term_type","processor");
        }

        // ram filter
        $ramIds = "";
        $ramIdsArray = [];

        if(isset($_GET['ram_ids'])){
            $ramIds = $_GET['ram_ids'];
        }

        if(!empty($ramIds)){
            $ramIdsArray = explode(",",$ramIds);
            $query->join('term_relations', 'term_relations.product_id', '=', 'products.id');
            $query->whereIn("term_relations.term_id",$ramIdsArray);
            $query->where("term_relations.term_type","ram");
        }

        // screen size filter
        $screenSizeIds = "";
        $screenSizeIdsArray = [];

        if(isset($_GET['screen_size_ids'])){
            $screenSizeIds = $_GET['screen_size_ids'];
        }

        if(!empty($screenSizeIds)){
            $screenSizeIdsArray = explode(",",$screenSizeIds);
            $query->join('term_relations', 'term_relations.product_id', '=', 'products.id');
            $query->whereIn("term_relations.term_id",$screenSizeIdsArray);
            $query->where("term_relations.term_type","screen_size");
        }

        // ssd filter
        $ssdIds = "";
        $ssdIdsArray=[];

        if(isset($_GET['ssd_ids'])){
            $ssdIds = $_GET['ssd_ids'];
        }

        if(!empty($ssdIds)){
            $ssdIdsArray = explode(",",$ssdIds);
            $query->join('term_relations', 'term_relations.product_id', '=', 'products.id');
            $query->whereIn("term_relations.term_id",$ssdIdsArray);
            $query->where("term_relations.term_type","ssd");
        }

        // type filter
        $typeIds = "";
        $typeIdsArray = [];

        if(isset($_GET['type_ids'])){
            $typeIds = $_GET['type_ids'];
        }

        if(!empty($typeIds)){
            $typeIdsArray = explode(",",$typeIds);
            $query->join('term_relations', 'term_relations.product_id', '=', 'products.id');
            $query->whereIn("term_relations.term_id",$typeIdsArray);
            $query->where("term_relations.term_type","type");
        }

        // color filter
        $colorIds = "";
        $colorIdsArray = [];

        if(isset($_GET['color_ids'])){
            $colorIds = $_GET['color_ids'];
        }

        if(!empty($colorIds)){
            $colorIdsArray = explode(",",$colorIds);
            $query->join('product_variations', 'product_variations.product_id', '=', 'products.id');
            $query->whereIn("product_variations.color_id",$colorIdsArray);
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


        $products_count = $query->count();
        $products=$query->paginate($perPage)->withQueryString();
        
        // echo "<pre>";
        // print_r($products);die;
        $data = compact('metaDetails','products','products_count', 'perPage', 'sortby', 'categoriesArray','brandArray','graphicCardArray', 'hardDriveIdsArray', 'processorIdsArray', 'ramIdsArray', 'screenSizeIdsArray', 'ssdIdsArray', 'typeIdsArray', 'colorIdsArray','priceMin','priceMax');
        return view('products',$data);
    }
}

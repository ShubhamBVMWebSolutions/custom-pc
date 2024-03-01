<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallary;
use App\Models\ProductVariation;
use App\Models\BrandAttribute;
use App\Models\TermRelation;
use App\Models\NewProductBlog;
use App\Models\Tag;
use App\Models\TagRelation;
use App\Models\ProductCategoryRelationship;
use Str;

class ProductFilterController extends Controller
{
    public function index(Request $request){
        try {
            // dd($request->all());
            $data =[];
            $metaDetails =[];
            $perPage = 18;

            if(isset($_GET['per_page'])){
                $perPage = $_GET['per_page'];
            }
            $query = Product::where("status", 1)->where('product_type', 'product');


            // search
            if(isset($_GET['search'])){
                $search_keyword = $_GET['search'];
                $keywordsArray = explode(" ", $search_keyword);
                $tagQuery = Tag::select("tag_name as title");
                // dd($tagQuery);
                foreach($keywordsArray as $key => $keyword){
                    if($key == 0){
                        $tagQuery->where('tag_name','LIKE', $keyword. '%');
                    }else{
                        $tagQuery->orWhere('tag_name','LIKE', $keyword. '%');
                    }
                }

                $all_keywords_array =  $tagQuery->get();
                $tagIDs = array();
                $productIDs = array();
                if(!empty($all_keywords_array)){
                    $i = 0;
                    foreach($all_keywords_array as $currentItem)
                    {
                        $tagDetails = Tag::where('tag_name', $currentItem->title)->first();
                        $tagIDs[] = $tagDetails->id;
                        $i++;
                    }
                }

                if(!empty($tagIDs)){
                    $productTagRelations = \DB::table('tag_relations')->distinct()->whereIn('tag_id',$tagIDs)->get();
                    if($productTagRelations->count()){
                        $productIDs = $productTagRelations->pluck('product_id');
                    }
                }

                $query->whereIn('id',$productIDs)->where('status', 1)->where('product_type', 'product');
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

                $query = Product::query();//BY Shubham
                $query->select('products.*');
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
                if(count($brandArray) == 1 && empty($categoryIds)){
                    $metaDetails = BrandAttribute::find($brandIds);
                }

                // dd($metaDetails);
                $query->whereIn("products.brand",$brandArray);
            }

              //sort products
              $sortby = "price_desc";

              if(isset($_GET['sort_by'])){
                  $sortby = $_GET['sort_by'];
              }

              if($sortby == 'price_asc'){

                  $query->orderBy('products.sale_price',"ASC");
              }
              if($sortby == 'price_desc'){
                  $query ->orderBy('products.sale_price',"DESC");
              }
              if($sortby == 'new_old'){
                  $query ->orderBy('products.id',"DESC");
              }
              if($sortby == 'old_new'){
                  $query ->orderBy('products.id',"ASC");
              }
              if($sortby == 'title_asc'){
                  $query ->orderBy('products.title',"ASC");
              }
              if($sortby == 'title_desc'){
                  $query ->orderBy('products.title',"DESC");
              }
              if($sortby == 'popular'){
                  $query ->orderBy('products.views',"DESC");
              }

            // graphic card filter
            $graphicCardIds = "";
            $graphicCardArray = [];
            if(isset($_GET['graphic_card_ids'])){
                $graphicCardIds = $_GET['graphic_card_ids'];
            }

            if(!empty($graphicCardIds)){
                $graphicCardArray = explode(",",$graphicCardIds);
                $query = Product::query();
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
                $query = Product::query();
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
                $query = Product::query();
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
                $query = Product::query();
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
                $query = Product::query();
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
                $query = Product::query();
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
                $query = Product::query();
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
                // dd($colorIdsArray);
                $query = Product::query();
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
                // $query = Product::query();
                $query->whereBetween('price', [$priceMin, $priceMax]);
            }


            $products_count = $query->count();
            $products=$query->paginate($perPage)->withQueryString();
            // dd($metaDetails);
            // echo "<pre>";
            // dd($products);die;
            // dd($categoriesArray);
            $data = compact('metaDetails','products','products_count', 'perPage', 'sortby', 'categoriesArray','brandArray','graphicCardArray', 'hardDriveIdsArray', 'processorIdsArray', 'ramIdsArray', 'screenSizeIdsArray', 'ssdIdsArray', 'typeIdsArray', 'colorIdsArray','priceMin','priceMax');
            // dd($data['products']);
            return view('products',$data);

        } catch (\Exception $e) {
            dd([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]);
            // return $e->getMessage();
            return redirect()->route("view.products");
        }
    }


    public function new_at_soi(){
        $new_product_blogs = NewProductBlog::where('status','Active')->orderBy('title','ASC')->get();
        $data = compact('new_product_blogs');
        return view('new-at-soi',$data);
    }
}

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

class ProductCategoryBrandController extends Controller
{
    public function viewProductCategory($productcategorySlug=null){
        $productCategoryDetail = '';
        $cat_products = '';
        $cat_products_count = '';
        $sortby = $_GET['sort'] ?? '';
        $term_products = array();
        if(!empty($productcategorySlug)){
            $productCategoryDetail = ProductCategory::where('slug','=',$productcategorySlug)->get();
            if($sortby == 'price_desc'){
                $cat_products = ProductCategoryRelationship::where('category_id',$productCategoryDetail[0]->id)
            ->join('products', 'product_category_relations.product_id', '=', 'products.id')->where('products.status','=',1)->orderBy('products.price','DESC')->paginate(9);
            }
            elseif($sortby == 'price_asc'){
            $cat_products = ProductCategoryRelationship::where('category_id',$productCategoryDetail[0]->id)
            ->join('products', 'product_category_relations.product_id', '=', 'products.id')->where('products.status','=',1)->orderBy('products.price','ASC')->paginate(9);
            }
            elseif($sortby == 'new_old'){
            $cat_products = ProductCategoryRelationship::where('category_id',$productCategoryDetail[0]->id)
            ->join('products', 'product_category_relations.product_id', '=', 'products.id')->where('products.status','=',1)->orderBy('products.id','DESC')->paginate(9);
            }
            elseif($sortby == 'old_new'){
            $cat_products = ProductCategoryRelationship::where('category_id',$productCategoryDetail[0]->id)
            ->join('products', 'product_category_relations.product_id', '=', 'products.id')->where('products.status','=',1)->orderBy('products.id','ASC')->paginate(9);
            }
            elseif($sortby == 'title_asc'){
            $cat_products = ProductCategoryRelationship::where('category_id',$productCategoryDetail[0]->id)
            ->join('products', 'product_category_relations.product_id', '=', 'products.id')->where('products.status','=',1)->orderBy('products.title','ASC')->paginate(9);
            }
            elseif($sortby == 'title_desc'){
            $cat_products = ProductCategoryRelationship::where('category_id',$productCategoryDetail[0]->id)
            ->join('products', 'product_category_relations.product_id', '=', 'products.id')->where('products.status','=',1)->orderBy('products.title','DESC')->paginate(9);
            }
            elseif($sortby == 'popular'){
            $cat_products = ProductCategoryRelationship::where('category_id',$productCategoryDetail[0]->id)
            ->join('products', 'product_category_relations.product_id', '=', 'products.id')->where('products.status','=',1)->orderBy('products.views','DESC')->paginate(9);
            }
            else{

                 $all_cat_products = ProductCategoryRelationship::where('category_id',$productCategoryDetail[0]->id)
            ->join('products', 'product_category_relations.product_id', '=', 'products.id')->where('products.status','=',1)->orderBy('products.id','DESC')->paginate(9);
                if(isset($_GET['graphic']) || isset($_GET['hard_drive']) || isset($_GET['processor']) || isset($_GET['ram']) || isset($_GET['screen_size']) || isset($_GET['ssd']) || isset($_GET['type'])){
                    $graphic_id = $_GET['graphic'] ?? '';
                    $drive_id = $_GET['hard_drive'] ?? '';
                    $processor_id = $_GET['processor'] ?? '';
                    $ram_id = $_GET['ram'] ?? '';
                    $screen_sizeid = $_GET['screen_size'] ?? '';
                    $ssd_id = $_GET['ssd'] ?? '';
                    $type_id = $_GET['type'] ?? '';


                    $term_graphic = '';
                    $term_drive = '';
                    $term_processor = '';
                    $term_ram = '';
                    $term_screen = '';
                    $term_ssd = '';
                    $term_type = '';

                 if(!empty($graphic_id)){
                     $term_graphic = 'graphic';
                 }

                 if(!empty($drive_id)){
                     $term_drive = 'hard_drive';
                 }

                 if(!empty($processor_id)){
                     $term_processor = 'processor';
                 }

                 if(!empty($ram_id)){
                     $term_ram = 'ram';
                 }

                 if(!empty($screen_sizeid)){
                     $term_screen = 'screen_size';
                 }

                 if(!empty($ssd_id)){
                     $term_ssd = 'ssd';
                 }

                 if(!empty($type_id)){
                     $term_type = 'type';
                 }


            $prodid_arr = array();
            foreach($all_cat_products as $prod){
                $prodid_arr[] = $prod->product_id;
            }

            /*$term_products = TermRelation::whereIn('term_id',array($graphic_id,$drive_id,$processor_id,$ram_id,$screen_sizeid,$ssd_id,$type_id),'AND')
            ->whereIn('term_type',array('graphic','hard_drive','screen_size','processor','ram','ssd','type'),'AND')
            ->whereIn('product_id',$prodid_arr)->get(); */

            $cat_products = TermRelation::whereIn('term_id',array($graphic_id,$drive_id,$processor_id,$ram_id,$screen_sizeid,$ssd_id,$type_id),'AND')
            ->whereIn('term_type',array($term_graphic,$term_drive,$term_processor,$term_ram,$term_screen,$term_ssd,$term_type),'AND')
            ->whereIn('product_id',$prodid_arr)->get();

            //print_r($term_products);

                }

            elseif(isset($_GET['color'])){
                $prodid_arr = array();
            foreach($all_cat_products as $prod){
                $prodid_arr[] = $prod->product_id;
            }
            $cat_products = ProductVariation::where('color_id',$_GET['color'])
            ->whereIn('product_id',$prodid_arr)->get();

            }


            elseif(isset($_GET['price'])){
                $price_arr = explode('-',$_GET['price']);
                $min_price = $price_arr[0];
                $max_price = $price_arr[1];
                $range = [$min_price ?: 0, $max_price ?: 0];

                $prodid_arr = array();
            foreach($all_cat_products as $prod){
                $prodid_arr[] = $prod->product_id;
            }

            $cat_products = ProductCategoryRelationship::where('category_id',$productCategoryDetail[0]->id)
            ->join('products', 'product_category_relations.product_id', '=', 'products.id')
            ->where('products.status','=',1)->whereBetween('products.price', $range)
            ->orderBy('products.price','ASC')->paginate(9);
            }
              else{

                $cat_products = ProductCategoryRelationship::where('category_id',$productCategoryDetail[0]->id)
            ->join('products', 'product_category_relations.product_id', '=', 'products.id')->where('products.status','=',1)->orderBy('products.id','DESC')->paginate(9);

              }
            }


            $cat_products_count = $cat_products->count();
        }
        $data = compact('productCategoryDetail','cat_products','cat_products_count','term_products');
       
        return view('product_category',$data);
    }

    public function viewProductBrand($productbrandslug=null){
        $productbranddetails  = '';
        $brand_products = '';
        $brand_products_count = '';
        $sortby = $_GET['sort'] ?? '';
        $term_products = array();
        if(!empty($productbrandslug)){
            $productbranddetails = BrandAttribute::where('slug', '=', $productbrandslug)->get();



        if($sortby == 'price_desc'){
                $brand_products = Product::where([
                ['brand','=',$productbranddetails[0]->id],
                ['status','=',1]
                ])->orderBy('price','DESC')->paginate(9);
            }
            elseif($sortby == 'price_asc'){
            $brand_products = Product::where([
                ['brand','=',$productbranddetails[0]->id],
                ['status','=',1]
                ])->orderBy('price','ASC')->paginate(9);
            }
            elseif($sortby == 'new_old'){
                $brand_products = Product::where([
                ['brand','=',$productbranddetails[0]->id],
                ['status','=',1]
                ])->orderBy('id','DESC')->paginate(9);

            }
            elseif($sortby == 'old_new'){
                $brand_products = Product::where([
                ['brand','=',$productbranddetails[0]->id],
                ['status','=',1]
                ])->orderBy('id','ASC')->paginate(9);

            }
            elseif($sortby == 'title_asc'){
                $brand_products = Product::where([
                ['brand','=',$productbranddetails[0]->id],
                ['status','=',1]
                ])->orderBy('title','ASC')->paginate(9);

            }
            elseif($sortby == 'title_desc'){
                $brand_products = Product::where([
                ['brand','=',$productbranddetails[0]->id],
                ['status','=',1]
                ])->orderBy('title','DESC')->paginate(9);
            }
            elseif($sortby == 'popular'){
                $brand_products = Product::where([
                ['brand','=',$productbranddetails[0]->id],
                ['status','=',1]
                ])->orderBy('views','DESC')->paginate(9);

            }
            else{

                $brand_all_products = Product::where([
                ['brand','=',$productbranddetails[0]->id],
                ['status','=',1]
                ])->orderBy('id','DESC')->get();

                 if(isset($_GET['graphic']) || isset($_GET['hard_drive']) || isset($_GET['processor']) || isset($_GET['ram']) || isset($_GET['screen_size']) || isset($_GET['ssd']) || isset($_GET['type'])){

                    $graphic_id = $_GET['graphic'] ?? '';
                    $drive_id = $_GET['hard_drive'] ?? '';
                    $processor_id = $_GET['processor'] ?? '';
                    $ram_id = $_GET['ram'] ?? '';
                    $screen_sizeid = $_GET['screen_size'] ?? '';
                    $ssd_id = $_GET['ssd'] ?? '';
                    $type_id = $_GET['type'] ?? '';

                    $prodid_arr = array();
                    foreach($brand_all_products as $prod){
                        $prodid_arr[] = $prod->id;
                    }

                    $term_products = TermRelation::whereIn('term_id',array($graphic_id,$processor_id,$ram_id,$ssd_id,$type_id),'AND')
            ->whereIn('term_type',array('graphic','processor','ram','ssd','type'),'AND')
            ->whereIn('product_id',$prodid_arr)->get();


                 }

                 if(isset($_GET['color'])){
                $prodid_arr = array();
                    foreach($brand_all_products as $prod){
                        $prodid_arr[] = $prod->id;
                    }
            $term_products = ProductVariation::where('color_id',$_GET['color'])
            ->whereIn('product_id',$prodid_arr)->get();

            }

            if(isset($_GET['price'])){
                $price_arr = explode('-',$_GET['price']);
                $min_price = $price_arr[0];
                $max_price = $price_arr[1];
                $range = [$min_price ?: 0, $max_price ?: 0];

                $prodid_arr = array();
            foreach($brand_all_products as $prod){
                $prodid_arr[] = $prod->product_id;
            }

            $brand_products = Product::where([
                ['brand','=',$productbranddetails[0]->id],
                ['status','=',1]
                ])->whereBetween('price', $range)->orderBy('price','ASC')->paginate(9);

            }
            else{
              $brand_products = Product::where([
                ['brand','=',$productbranddetails[0]->id],
                ['status','=',1]
                ])->orderBy('id','DESC')->paginate(9);

            }
            }


            $brand_products_all = Product::where([
                ['brand','=',$productbranddetails[0]->id],
                ['status','=',1]
                ])->get();
            $brand_products_count = $brand_products_all->count();
        }

        $data = compact('productbranddetails','brand_products','brand_products_count','term_products');
        return view('product_brand',$data);
    }
}

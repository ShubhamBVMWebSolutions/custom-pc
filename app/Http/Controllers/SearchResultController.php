<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use App\Models\TagRelation;
use Config;

class SearchResultController extends Controller
{
    function searchResults(Request $request){
        $search_results = Product::where('status',1)->orderBy('id','DESC')->paginate(12);
        if(isset($_GET['s'])){
            $search_results = Product::where([
                ['title', 'like', '%' . $_GET['s'] . '%'],
                ['status',1],
            ])->orderBy('id','DESC')->paginate(12);
        }
        //print_r($search_results);
        $data = compact('search_results');
        return view('search_results',$data);
    }
    
    public function searchSuggestions(Request $request){
            $keywords = $request->keyword;
        if(!empty($keywords)){
            $keywordsArray = explode(" ", $keywords);
            $tagQuery = Tag::select("tag_name as title");
            foreach($keywordsArray as $key => $keyword){
                if($key == 0){
                    $tagQuery->where('tag_name','LIKE', $keyword. '%');
                }else{
                    $tagQuery->orWhere('tag_name','LIKE', $keyword. '%');
                }
            }
            
            $all_keywords_array =  $tagQuery->get();
            $suggested_keywords = [];      
            $suggested_keywords_html = '';      
            $tagIDs = array();
            $productIDs = array();
            if(!empty($all_keywords_array)){
                $i = 0;
                foreach($all_keywords_array as $currentItem)
                {
                        $suggested_keywords[$i]['title'] = $currentItem->title;
                        $tagDetails = Tag::where('tag_name', $currentItem->title)->first();
                        $tagIDs[] = $tagDetails->id;
                        $product_count = TagRelation::where('tag_id',$tagDetails->id)->get()->count();
                        $suggested_keywords[$i]['count'] = $product_count;
                        if($product_count > 0){
                            $suggested_keywords_html .= '<li><a href="'.route('view.products',['search'=>$currentItem->title]).'">'.$currentItem->title.'<span>'.$product_count.'</span></a></li>';
                        }
                $i++;
                }
            }
            $categories_keywords_html = '';
            $categoryQuery = \DB::table('product_category');
            foreach($keywordsArray as $key => $keyword){
                if($key == 0){
                    $categoryQuery->where('title','LIKE',''.$keyword.'%');
                }else{
                    $categoryQuery->orWhere('title','LIKE',''.$keyword.'%');
                }
                
            }
            
            $categories_keywords = $categoryQuery->get();
            
            foreach($categories_keywords as $catword){
                $categories_keywords_html .= '<li><a href="'.route('view.products',['category_ids'=>$catword->id]).'">'.$catword->title.'</a></li>';
            }
            
            $suggested_products = [];
            $suggested_products_html = ''; 
            if(!empty($tagIDs)){
                $productTagRelations = \DB::table('tag_relations')->distinct()->whereIn('tag_id',$tagIDs)->get();
                if($productTagRelations->count()){
                    $productIDs = $productTagRelations->pluck('product_id');
                }
            }
            
            $products = Product::whereIn('id',$productIDs)->where('status', 1)->where('product_type', 'product')->orderBy('price','ASC')->limit(4)->get();
            $products_amount = Product::selectRaw("MAX(price) as max_price")->whereIn('id',$productIDs)->where('status', 1)->where('product_type', 'product')->first();
            $max_price_amount = 0;
            if(!empty($products_amount)){
                            $max_price_amount = $products_amount->max_price;
            }
            
            if($products->count() > 0){
                foreach($products as $prod_detail){
                        $suggested_products[] =$prod_detail;
                        $image_url = url('public/img/default_pic.png');
                        if(!empty($prod_detail->image)){
                            $image_root_path = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image;
                            // dd($image_root_path);
                            if(file_exists($image_root_path)){
                                $image_url = url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image);
                            }
                        }
                        
                        
                        $suggested_products_html .= '<a href="'.route('view.product',['productSlug'=>$prod_detail->slug]).'" class="recent_p_list">
                                <div class="r_img">
                                    <img src="'.$image_url.'">
                                </div>
                                <div class="r_content">
                                    <h5>'.$prod_detail->title.'</h5>';
                        if(!empty($prod_detail->sale_price)){
                            $suggested_products_html .='<div class="r_p_price">
                                        NPR '.number_format($prod_detail->sale_price,2).' <small>(incl. GST)</small>
                                    </div>';
                        }else{
                            $suggested_products_html .='<div class="r_p_price">
                                        NPR '.number_format($prod_detail->price,2).' <small>(incl. GST)</small>
                                    </div>';
                        }            
                                          
                        $suggested_products_html .= '</div>    
                            </a>';
                            
                }
                
            }
            
            
            return response()->json([
                    'response' => true,
                    'suggested_keywords' => $suggested_keywords,
                    'suggested_keywords_html'=>$suggested_keywords_html,
                    'category_keywords' => $categories_keywords,
                    'categories_keywords_html' => $categories_keywords_html,
                    'suggested_products' => $suggested_products,
                    'suggested_products_html' => $suggested_products_html,
                    'max_price_amount' => $max_price_amount,
                    'message' => "Data Available"
            ]);
        }
    }
    
    public function searchProductSuggestions(Request $request){
        $keyword = $request->keyword;
        $all_keywords_array = \DB::select("SELECT tag_name as title FROM tags WHERE tag_name LIKE '".$keyword."%'");    
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

        $price_min_value = (int)$request->price_min_value;
        $price_max_value = (int)$request->price_max_value;
        // echo $price_max_value; die;
        $suggested_products = [];
        $suggested_products_html = ''; 
        if(!empty($tagIDs)){
            $productTagRelations = \DB::table('tag_relations')->distinct()->whereIn('tag_id',$tagIDs)->get();
            if($productTagRelations->count()){
                $productIDs = $productTagRelations->pluck('product_id');
            }
        }
        $products = Product::whereIn('id',$productIDs)->where('status', 1)->where('product_type', 'product')->whereBetween('price', [$price_min_value, $price_max_value])->limit(4)->get();
        if($products->count() > 0){
            foreach($products as $prod_detail){
                    $suggested_products[] =$prod_detail;
                    $image_url = url('public/img/default_pic.png');
                    if(!empty($prod_detail->image)){
                        $image_root_path = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image;
                        // dd($image_root_path);
                        if(file_exists($image_root_path)){
                            $image_url = url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image);
                        }
                    }
                    
                    
                    $suggested_products_html .= '<a href="'.route('view.product',['productSlug'=>$prod_detail->slug]).'" class="recent_p_list">
                            <div class="r_img">
                                <img src="'.$image_url.'">
                            </div>
                            <div class="r_content">
                                <h5>'.$prod_detail->title.'</h5>';
                    if(!empty($prod_detail->sale_price)){
                        $suggested_products_html .='<div class="r_p_price">
                                    NPR '.number_format($prod_detail->sale_price,2).' <small>(incl. GST)</small>
                                </div>';
                    }else{
                        $suggested_products_html .='<div class="r_p_price">
                                    NPR '.number_format($prod_detail->price,2).' <small>(incl. GST)</small>
                                </div>';
                    }            
                                      
                    $suggested_products_html .= '</div>    
                        </a>';
            }
            
        }
        
        return response()->json([
                'response' => true,
                'suggested_products' => $suggested_products,
                'suggested_products_html' => $suggested_products_html,
                'message' => "Data Available"
        ]);
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallary;
use App\Models\ProductVariation;
use App\Models\VariationImage;
use App\Models\ProductCategoryRelationship;
use App\Models\ProductRating;
use Config;
use Session;

class ProductController extends Controller
{
    public function viewProduct($productSlug=null){

        $productGallery=array();
        $variations = '';

        if(!empty($productSlug))
        {
            $productinfo = Product::where('slug','=',$productSlug)->get();
            $productGallery = ProductGallary::where('product_id','=',$productinfo[0]->id)->get();
            $variations = ProductVariation::with(["color_details","ssd_details","screen_size_details","ram_details"])->where('product_id','=',$productinfo[0]->id)->get();
            $product_reviews = ProductRating::where('product_id','=',$productinfo[0]->id)->where("status","Approved")->get();

            $view_count = $productinfo[0]->views;
            if($productinfo[0]->views == ''){
                $view_count = 0;
                Product::where('id','=',$productinfo[0]->id)->update([
                    'views' => $view_count
                    ]);
                }
                else{
                    $view_count++;
                    Product::where('id','=',$productinfo[0]->id)->update([
                        'views' => $view_count
                    ]);
                }
            }
        else{
            return redirect()->to(route('home'));
        }
        $data = compact('productinfo','productGallery','variations','product_reviews');
        // dd($data);
        return view('single_product',$data);
    }

    function changeColor(Request $request){
        if($request->ajax()){
            $variation_id = $request->variation_id;
            $product_id = $request->product_id;

            $variation_imgs = VariationImage::where('variation_id',$variation_id)->get();

            $res = '';
            $i = 1;
            $j = 1;
            $res .= '<div class="col-lg-3 col-md-3">
                                <ul class="nav nav-tabs" role="tablist">';

                                    foreach($variation_imgs as $varimgs){
                                        if($i == 1){
                                            $active = 'active';
                                        }
                                        else{
                                           $active = '';
                                        }

                                    $res .= '<li class="nav-item">
                                        <a class="nav-link '.$active.'" data-toggle="tab" href="#tabs-'.$i.'" role="tab">
                                            <div class="product__thumb__pic set-bg" data-setbg="'.url(Config::get('constants.SITE_PRODUCT_IMAGE').$varimgs->variation_image).'">
                                            </div>
                                        </a>
                                    </li>';
                                    $i++;
                                    }


                                $res .= '</ul>
                            </div>';


                $res .= '<div class="col-lg-9 col-md-9">
                                <div class="tab-content" id="container_img">';

                                    foreach($variation_imgs as $varimgs){
                                        if($j == 1){
                                            $active = 'active';
                                        }
                                        else{
                                           $active = '';
                                        }
                                    $res .= '<div class="tab-pane '.$active.'" id="tabs-'.$j.'" role="tabpanel">
                                        <div class="product__details__pic__item">
                                            <img src="'.url(Config::get('constants.SITE_PRODUCT_IMAGE').$varimgs->variation_image).'" alt="">
                                        </div>
                                    </div>';
                                    $j++;
                                    }

                                $res .= '</div>
                            </div>';

            $res .= '<script>
                        $("div .set-bg").each(function () {
                    var bg = $(this).data("setbg");
                    $(this).css("background-image", "url(" + bg + ")");
                });
            </script>';

            echo $res;
            die(0);

        }
    }
}

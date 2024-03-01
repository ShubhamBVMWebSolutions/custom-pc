<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ImportProduct;
use App\Exports\ExportProduct;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallary;
use App\Models\ProductVariation;
use App\Models\VariationImage;
use App\Models\ProductCategoryRelationship;
use App\Models\TermRelation;
use App\Models\GraphicsCard;
use App\Models\HardDrive;
use App\Models\Processor;
use App\Models\RAM;
use App\Models\ScreenSize;
use App\Models\SSD;
use App\Models\Type;
use App\Models\ProductChipsetCatRelation;
use Illuminate\Http\Request;
use Config;
use Session;
use Validator;
use Str;
use File;


class ProductController extends Controller
{
    public function importView(Request $request){
        return view('admin.importFile');
    }
    
    public function import(Request $request){
        Excel::import(new ImportProduct, $request->file('file')->store('files'));
        return redirect()->back()-with('alert-success','Products import successfully');
    }
    public function exportProducts(Request $request){
        return Excel::download(new ExportProduct, 'products.xlsx');
    }
    
    
    public function viewproducts(Request $request){
            $products = Product::orderBy('id','DESC')->get();
         	$productsCount = $products->count();
        	$data = compact('products','productsCount');
    	return view('admin.manage-product.all_products',$data);
     }
    
    public function addproduct(Request $request){
        if($request->isMethod('POST'))
    	{  
    	    $image='';
    	    $gallery=[];
    	    
    	    $validator = Validator::make($request->all(), [
                      'title'             => 'required',
                      //'product_overview'       => 'required',
                      //'product_detail'       => 'required',
                      //'short_description'       => 'required',
                      //'material'             => 'required',
                      'price'                => 'required|nullable|numeric',
                  ]);
                  
            if ($validator->fails())
		        {
		          return redirect()->back()->withErrors($validator)->withInput();
		       }
                 
		          
		          $forProduct  = new Product;
		          
		          if($request->hasFile('product_image'))
		          {
		            $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
				 

		            $image = time().'.'.$request->product_image->getClientOriginalExtension();
		            $uploadImg = $request->file('product_image')->move($dir , $image);
		        }
				
		        if(!empty($request->product_category)){
		            $cats = implode(',', $request->product_category);
		        } else{
		            $cats = '';
		        }
		        
		        if(!empty($request->related_products)){
		            $related_products = implode(',', $request->related_products);
		        } else{
		            $related_products = '';
		        }
		        
		        if($request->sale_price > $request->price){
		            return  redirect()->back()->with('alert-error','Sale price can\'t be greater than regular price');
		        }
		        
		        
		          $forProduct->title = $request->title;
		          $forProduct->product_overview = $request->product_overview;
		          $forProduct->material = $request->material;
		          $forProduct->details = $request->product_detail;
		          $forProduct->short_description = $request->short_description;
		          $forProduct->features = $request->features;
		          $forProduct->product_categories = $cats;
		          $forProduct->price = $request->price;
		          $forProduct->sale_price = $request->sale_price;
		          $forProduct->brand = $request->brand;
		          $forProduct->model = $request->model;
		          $forProduct->sku = $request->sku;
		          $forProduct->stock_qty = $request->stock_qty;
		          $forProduct->slug  = slugify($request->title);
		          $forProduct->image  = $image;
		          $forProduct->featured  = $request->featured;
		          $forProduct->related_products  = $related_products;
					    $forProduct->product_type  = $request->product_type;
					    $forProduct->meta_keywords  = $request->meta_keywords;
		          $forProduct->meta_description  = $request->meta_description;
		          $SavedResponse = $forProduct->save();
		          
		          $CreatedProductId  =   $forProduct->id;
		          
		          if(!empty($request->graphic_card)){
		              
		              foreach($request->graphic_card as $card){
		                 $cardterm_rel = new TermRelation;
		                      $cardterm_rel->product_id = $forProduct->id;
		                      $cardterm_rel->term_id = $card;
		                      $cardterm_rel->term_type = 'graphic';
		                      $cardterm_rel->save();
 
		              }
		              
		          }
		         
		          if(!empty($request->hard_drive)){
		              
		              foreach($request->hard_drive as $drive){
		                  
		                  $driveterm_rel = new TermRelation;
		                      $driveterm_rel->product_id = $forProduct->id;
		                      $driveterm_rel->term_id = $drive;
		                      $driveterm_rel->term_type = 'hard_drive';
		                      $driveterm_rel->save();
		              }
		              
		          }
		          
		          if(!empty($request->screen_size)){
		             
		              foreach($request->screen_size as $screen){
		                 
                            $driveterm_rel = new TermRelation;
		                      $driveterm_rel->product_id = $forProduct->id;
		                      $driveterm_rel->term_id = $screen;
		                      $driveterm_rel->term_type = 'screen_size';
		                      $driveterm_rel->save();
		              }
		              
		          }
		          
		          if(!empty($request->ssd)){
		            
		              foreach($request->ssd as $ssd){
                        $ssdterm_rel = new TermRelation;
		                      $ssdterm_rel->product_id = $forProduct->id;
		                      $ssdterm_rel->term_id = $ssd;
		                      $ssdterm_rel->term_type = 'ssd';
		                      $ssdterm_rel->save();
		              }
		              
		          }
		          
		          if(!empty($request->type)){
		             
		              foreach($request->type as $type){
		                  
		                $typeterm_rel = new TermRelation;
		                      $typeterm_rel->product_id = $forProduct->id;
		                      $typeterm_rel->term_id = $type;
		                      $typeterm_rel->term_type = 'type';
		                      $typeterm_rel->save();
		              }
		              
		          }
		          
		          if(!empty($request->processor)){
		             
		              foreach($request->processor as $processor){
		                 
                        $processorterm_rel = new TermRelation;
		                      $processorterm_rel->product_id = $forProduct->id;
		                      $processorterm_rel->term_id = $processor;
		                      $processorterm_rel->term_type = 'processor';
		                      $processorterm_rel->save();
		              }
		              
		          }
		          
		          if(!empty($request->ram)){
		             
		              foreach($request->ram as $ram){
		                 
                            $ramterm_rel = new TermRelation;
		                      $ramterm_rel->product_id = $forProduct->id;
		                      $ramterm_rel->term_id = $ram;
		                      $ramterm_rel->term_type = 'ram';
		                      $ramterm_rel->save();
		              }
		              
		          }
		     
		        
		         if($CreatedProductId)
              {
                  //chip cat relation
                  if(!empty($request->amd_sub_cat)){
                      foreach($request->amd_sub_cat as $amd_cat){
                          $prod_chip_cat = new ProductChipsetCatRelation;
                          $prod_chip_cat->product_id = $CreatedProductId;
                          $prod_chip_cat->chip_cat_id = $amd_cat;
                          $prod_chip_cat->chipset = 1;
                          $prod_chip_cat->save();
                      }
                  }
                  
                  //intel cat relation
                  if(!empty($request->intel_sub_cat)){
                      foreach($request->intel_sub_cat as $intel_cat){
                          $prod_chip_cat = new ProductChipsetCatRelation;
                          $prod_chip_cat->product_id = $CreatedProductId;
                          $prod_chip_cat->chip_cat_id = $intel_cat;
                          $prod_chip_cat->chipset = 2;
                          $prod_chip_cat->save();
                      }
                  }
                  
                  
                  //prod cat relation update
                  if(!empty($request->product_category)){
                      foreach($request->product_category as $catid){
                  $prodCatRelation = new ProductCategoryRelationship;
                  $prodCatRelation->product_id = $CreatedProductId;
                  $prodCatRelation->category_id = $catid;
                  $prodCatRelation->save();
                      }
                  }

                //color variation
				if(@$request->product_type =="product"){
					   
						$pa_colors = $request->pa_color_new;
						
		        
						$ct=0;
					if(!empty($pa_colors[0])){
						for($x=0; $x < count($pa_colors); $x++){
							echo $pa_colors[$x];   
								$colorVariation = new ProductVariation;
								
								$colorVariation->product_id = $CreatedProductId;
								$colorVariation->color_id = $pa_colors[$x];
								$colorVariation->save();
								
								if($colorVariation->id){
								
								if(isset($request->file('color_img')['img_id'])){
								foreach($request->file('color_img')['img_id'] as $varImg){
									$dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
									$color_img = time().$varImg->getClientOriginalName();
									$uploadImg = $varImg->move($dir , $color_img);
									$VariationImage  = new VariationImage;
									$VariationImage->variation_id = $colorVariation->id;
									$VariationImage->variation_image = $color_img;
									$VariationImage->save();
									//echo '<pre>'; print_r(time().$varImg->getClientOriginalName()); echo '</pre>';
								}
							}
								}
							}
					}   

				}
		      
                  
                  if($request->hasFile('gallery'))
		        {
		          $dir = public_path('/').Config::get('constants.PRODUCT_IMAGE_PATH');
		            foreach($request->file('gallery') as $file)
                    {
                        $productGallery = new ProductGallary;
                        $name = time().rand(1,100).'.'.$file->getClientOriginalExtension();
                        $file->move($dir, $name);  
                        $gallery[] = $name;  
                        $productGallery->product_id = $CreatedProductId;
                        $productGallery->image = $name;
                        $productGallery->save();
                    }
		            
		        }
		        
		        if(!empty($gallery)){
		            $galleryImgs = implode(',',$gallery);
		        }
		        else{
		            $galleryImgs='';
		        }
		        
		        
              }
		        
		           if($forProduct)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                    else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		       }
         	}
        
        return view('admin.manage-product.add_update');
    }
    
     function updateProduct(Request $request, $encproductId=null){
          $product_id='';
    	  if(!empty($encproductId))
    	  {
    		$product_id = $encproductId;
      	}
    	
    	if($request->isMethod('POST'))
    	{
    	    
    	    $image='';
    	    $gallery=array();
    	    
    	    if(!empty($product_id))
    		     {
    		  	  
    		  	  $validator = Validator::make($request->all(), [
    		  	       'title'             => 'required',
                      //'product_overview'       => 'required',
                      //'product_detail'       => 'required',
                      //'short_description'       => 'required',
                      //'material'       => 'required',
                      'price'                => 'nullable|numeric',
                  ]);
                  
            if ($validator->fails())
		        {
		          return redirect()->back()->withErrors($validator)->withInput();
		       }

    		  	  $forProduct  = Product::find($product_id);
    		  	  $image = $request->old_post_image;
    		  	  $galleryImgs = $request->old_gallery_image;
    		  	  $forProduct->status =  $request->status;
    		  	  
    		  }
    		  
    		  
		         if($request->hasFile('product_image'))
		             {
		              $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
		              #->delete old image 
		              if(file_exists(base_path($dir.$image)))
                     {
                         \File::delete(base_path($dir.$image));
                     }

		            $image = time().'.'.$request->product_image->getClientOriginalExtension();
		            $uploadImg = $request->file('product_image')->move($dir , $image);
		             }
		        
		      
		       if(!empty($request->product_category)){
		            $cats = implode(',', $request->product_category);
		        } else{
		            $cats = '';
		        }
		        
		        if(!empty($request->related_products)){
		            $related_products = implode(',', $request->related_products);
		        } else{
		            $related_products = '';
		        }
		        
		        if($request->sale_price > $request->price){
		            return  redirect()->back()->with('alert-error','Sale price can\'t be greater than regular price');
		        }
		        
		        
		        //main table fields
		          $forProduct->title = $request->title;
		          $forProduct->product_overview = $request->product_overview;
		          $forProduct->material = $request->material;
		          $forProduct->details = $request->product_detail;
		          $forProduct->short_description = $request->short_description;
		          $forProduct->features = $request->features;
		          $forProduct->product_categories = $cats;
		          $forProduct->price = $request->price;
		          $forProduct->sale_price = $request->sale_price;
		          $forProduct->brand = $request->brand;
		          $forProduct->model = $request->model;
		          $forProduct->sku = $request->sku;
		          $forProduct->stock_qty = $request->stock_qty;
		          $forProduct->slug  = slugify($request->title);
		          $forProduct->image  = $image;
		          $forProduct->featured  = $request->featured;
		          $forProduct->related_products  = $related_products;
		          $forProduct->meta_keywords  = $request->meta_keywords;
		          $forProduct->meta_description  = $request->meta_description;
		          $forProduct->save();
		                      
		          if(!empty($request->amd_sub_cat)){
		              ProductChipsetCatRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['chipset',1]
		                      ])->delete();
		              foreach($request->amd_sub_cat as $amd){
		                  $chipset_cat_prod = new ProductChipsetCatRelation;
		                  $chipset_cat_prod->product_id = $forProduct->id;
		                  $chipset_cat_prod->chip_cat_id = $amd;
		                  $chipset_cat_prod->chipset = 1;
		                  $chipset_cat_prod->save();
		              }
		          }
		          if(!empty($request->intel_sub_cat)){
		              ProductChipsetCatRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['chipset',2]
		                      ])->delete();
		              foreach($request->intel_sub_cat as $intel){
		                  $chipset_cat_prod = new ProductChipsetCatRelation;
		                  $chipset_cat_prod->product_id = $forProduct->id;
		                  $chipset_cat_prod->chip_cat_id = $intel;
		                  $chipset_cat_prod->chipset = 2;
		                  $chipset_cat_prod->save();
		              }
		          }
		                      
		          if(!empty($request->graphic_card)){
		              TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_type','graphic']
		                      ])->delete();
		              foreach($request->graphic_card as $card){
		                  $iscard = TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$card],
		                      ['term_type','graphic']
		                      ])->get();
		                      
		                    
		                  if($iscard->count() > 0){
		                      
		                     TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$card],
		                      ['term_type','graphic']
		                      ])->update([
		                          'term_id' => $card
		                          ]); 
		                  }
		                  else{
		                      $cardterm_rel = new TermRelation;
		                      $cardterm_rel->product_id = $forProduct->id;
		                      $cardterm_rel->term_id = $card;
		                      $cardterm_rel->term_type = 'graphic';
		                      $cardterm_rel->save();
		                  }
		              }
		              
		          }
		         
		          if(!empty($request->hard_drive)){
		              TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_type','hard_drive']
		                      ])->delete();
		              foreach($request->hard_drive as $drive){
		                  $isdrive = TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$drive],
		                      ['term_type','hard_drive']
		                      ])->get();
		                      
		                  if($isdrive->count() > 0){
		                     TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$drive],
		                      ['term_type','hard_drive']
		                      ])->update([
		                          'term_id' => $drive
		                          ]); 
		                  }
		                  else{
		                      $driveterm_rel = new TermRelation;
		                      $driveterm_rel->product_id = $forProduct->id;
		                      $driveterm_rel->term_id = $drive;
		                      $driveterm_rel->term_type = 'hard_drive';
		                      $driveterm_rel->save();
		                  }
		              }
		              
		          }
		          
		          if(!empty($request->screen_size)){
		              TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_type','screen_size']
		                      ])->delete();
		              foreach($request->screen_size as $screen){
		                  $isdrive = TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$screen],
		                      ['term_type','screen_size']
		                      ])->get();
		                      
		                  if($isdrive->count() > 0){
		                     TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$screen],
		                      ['term_type','screen_size']
		                      ])->update([
		                          'term_id' => $screen
		                          ]); 
		                  }
		                  else{
		                      $driveterm_rel = new TermRelation;
		                      $driveterm_rel->product_id = $forProduct->id;
		                      $driveterm_rel->term_id = $screen;
		                      $driveterm_rel->term_type = 'screen_size';
		                      $driveterm_rel->save();
		                  }
		              }
		              
		          }
		          
		          if(!empty($request->ssd)){
		              TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_type','ssd']
		                      ])->delete();
		              foreach($request->ssd as $ssd){
		                  $isSSD = TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$ssd],
		                      ['term_type','ssd']
		                      ])->get();
		                      
		                  if($isSSD->count() > 0){
		                     TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$ssd],
		                      ['term_type','ssd']
		                      ])->update([
		                          'term_id' => $ssd
		                          ]); 
		                  }
		                  else{
		                      $ssdterm_rel = new TermRelation;
		                      $ssdterm_rel->product_id = $forProduct->id;
		                      $ssdterm_rel->term_id = $ssd;
		                      $ssdterm_rel->term_type = 'ssd';
		                      $ssdterm_rel->save();
		                  }
		              }
		              
		          }
		          
		          if(!empty($request->type)){
		              TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_type','type']
		                      ])->delete();
		              foreach($request->type as $type){
		                  $isType = TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$type],
		                      ['term_type','type']
		                      ])->get();
		                      
		                  if($isType->count() > 0){
		                     TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$type],
		                      ['term_type','type']
		                      ])->update([
		                          'term_id' => $type
		                          ]); 
		                  }
		                  else{
		                      $ssdterm_rel = new TermRelation;
		                      $ssdterm_rel->product_id = $forProduct->id;
		                      $ssdterm_rel->term_id = $type;
		                      $ssdterm_rel->term_type = 'type';
		                      $ssdterm_rel->save();
		                  }
		              }
		              
		          }
		          
		          if(!empty($request->processor)){
		              TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_type','processor']
		                      ])->delete();
		              foreach($request->processor as $processor){
		                  $isProcessor = TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$processor],
		                      ['term_type','processor']
		                      ])->get();
		                      
		                  if($isProcessor->count() > 0){
		                     TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$processor],
		                      ['term_type','processor']
		                      ])->update([
		                          'term_id' => $processor
		                          ]); 
		                  }
		                  else{
		                      $processorterm_rel = new TermRelation;
		                      $processorterm_rel->product_id = $forProduct->id;
		                      $processorterm_rel->term_id = $processor;
		                      $processorterm_rel->term_type = 'processor';
		                      $processorterm_rel->save();
		                  }
		              }
		              
		          }
		          
		          if(!empty($request->ram)){
		              TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_type','ram']
		                      ])->delete();
		              foreach($request->ram as $ram){
		                  $isRam = TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$ram],
		                      ['term_type','ram']
		                      ])->get();
		                      
		                  if($isRam->count() > 0){
		                     TermRelation::where([
		                      ['product_id',$forProduct->id],
		                      ['term_id',$ram],
		                      ['term_type','ram']
		                      ])->update([
		                          'term_id' => $ram
		                          ]); 
		                  }
		                  else{
		                      $ramterm_rel = new TermRelation;
		                      $ramterm_rel->product_id = $forProduct->id;
		                      $ramterm_rel->term_id = $ram;
		                      $ramterm_rel->term_type = 'ram';
		                      $ramterm_rel->save();
		                  }
		              }
		              
		          }
		          
		          //prod cat relation update
                  if(!empty($request->product_category)){
                      foreach($request->product_category as $catid){
                  $getprodcat = ProductCategoryRelationship::where([
                      ['product_id', '=', $forProduct->id],
                      ['category_id', '=', $catid]
                      ])->get();
                      if($getprodcat->count() > 0){
                         ProductCategoryRelationship::where([
                      ['product_id', '=', $forProduct->id],
                      ['category_id', '=', $catid]
                      ])->update([
                          'product_id' => $forProduct->id,
                          'category_id' => $catid
                          ]);
                      }
                      else{
                          $prodCatRelation = new ProductCategoryRelationship;
                          $prodCatRelation->product_id = $forProduct->id;
                          $prodCatRelation->category_id = $catid;
                          $prodCatRelation->save();
                      }
                  
                      }
                  }
		          
		          //color variation
		           $pa_colors = $request->pa_color;
		           
		        
		        
		      if(!empty($request->variation_id)){
		        for($y=0; $y<count($request->variation_id); $y++){
		                
		                $variation_id = $request->variation_id[$y];
		                $color_id = $request->pa_color[$y];
		                //echo '<pre>'; print_r($request->file('color_img')[$variation_id]); echo '</pre>';
		                
		                $colorVariation = ProductVariation::find($variation_id);
		                if($colorVariation){
		                //echo '<pre>'; print_r($colorVariation); echo '</pre>';
		                $colorVariation->product_id = $product_id;
		                $colorVariation->color_id = $color_id;
		                $colorVariation->save();
		                }
		                
		                if($colorVariation->id && isset($request->file('color_img')[$variation_id])){
		                  foreach($request->file('color_img')[$variation_id] as $varImage){
		                      $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
		                       $color_img = time().$varImage->getClientOriginalName();
		                       $varimgid = 'var_image_id_'.$variation_id;
		                     
		                      if(!empty($request->$varimgid)){
		                      foreach($request->$varimgid as $clr_img_id){
		                          
		                          $IsVariationImage = VariationImage::where([
		                              ['id',$clr_img_id],
		                              ['variation_id',$variation_id]
		                              ])->get();
		                      if($IsVariationImage->count() > 0){
		                          $uploadImg = $varImage->move($dir, $color_img);
		                          VariationImage::where([
		                              ['id',$clr_img_id],
		                              ['variation_id',$variation_id]
		                              ])->update([
		                                  'variation_image' => $color_img
		                                  ]);
		                              }
		                      else{
		                         $uploadImg = $varImage->move($dir , $color_img); 
		                      $VariationImage = new VariationImage;
		                      
		                      $VariationImage->variation_id = $colorVariation->id;
		                      $VariationImage->variation_image = $color_img;
		                      $VariationImage->save();
		                      }
		                      }
		                      }
		                      if(empty($request->$varimgid)){
		                      $uploadImg = $varImage->move($dir , $color_img); 
		                      $VariationImage = new VariationImage;
		                      
		                      $VariationImage->variation_id = $colorVariation->id;
		                      $VariationImage->variation_image = $color_img;
		                      $VariationImage->save();
		                      }
		                  }  
		                }
		                
		          }
		          
		            }
		           //print_r($request->pa_color_new);
		            
		          if(!empty($request->pa_color_new[0])){
		              
		             for($x=0; $x < count($request->pa_color_new); $x++){
		                 
		                 $colorVariation = new ProductVariation;
		                 
		                 $colorVariation->product_id = $product_id;
		                 $colorVariation->color_id = $request->pa_color_new[$x];
		                 $colorVariation->save();
		                 
		                 if($colorVariation->id){
		                 
		                 if(!empty($request->file('color_img'))){
		                 foreach($request->file('color_img')['img_id'] as $varImg){
		                     $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
		                     $color_img = time().$varImg->getClientOriginalName();
		                     $uploadImg = $varImg->move($dir , $color_img);
		                     $VariationImage  = new VariationImage;
		                     $VariationImage->variation_id = $colorVariation->id;
		                     $VariationImage->variation_image = $color_img;
		                     $VariationImage->save();
		                     //echo '<pre>'; print_r(time().$varImg->getClientOriginalName()); echo '</pre>';
		                 }
		                 }
		                 }
		             } 
		          }
		        
		       
		           //gallery img update 
		           
		             if($request->hasFile('gallery'))
		             {
		           
		            $dir = public_path('/').Config::get('constants.PRODUCT_IMAGE_PATH');
		            foreach($request->file('gallery') as $file)
                    {
                        $productGallery = new ProductGallary;
                        $name = time().rand(1,100).'.'.$file->getClientOriginalExtension();
                        $file->move($dir, $name);  
                        $gallery[] = $name;  
                        
                        $productGallery->product_id = $forProduct->id;
                        $productGallery->image = $name;
                        $productGallery->save();
                    }
		            
		        }
		        
		        if($forProduct)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }

        }
                  
            $ProductDetail=array();
            $productGalleryImg = array();
            $colorvariationss = array();
            $garphic_terms = array();
            $chip_term_relation = array();
            
            if(!empty($product_id)){
            $ProductDetail = Product::find($product_id);
            $productGalleryImg = ProductGallary::where('product_id', '=', $product_id)->get();
            $colorvariationss = ProductVariation::where('product_id', '=', $product_id)->get();
            $garphic_terms = TermRelation::where([
                ['product_id', '=', $product_id],
                ['term_type','graphic']
                ])->get();
                
            $hard_drive_terms = TermRelation::where([
                ['product_id', '=', $product_id],
                ['term_type','hard_drive']
                ])->get();
                
            $screen_size_terms = TermRelation::where([
                ['product_id', '=', $product_id],
                ['term_type','screen_size']
                ])->get();
                
            $processor_terms = TermRelation::where([
                ['product_id', '=', $product_id],
                ['term_type','processor']
                ])->get();
                
            $ram_terms = TermRelation::where([
                ['product_id', '=', $product_id],
                ['term_type','ram']
                ])->get();
                
            $ssd_terms = TermRelation::where([
                ['product_id', '=', $product_id],
                ['term_type','ssd']
                ])->get();
                
            $type_terms = TermRelation::where([
                ['product_id', '=', $product_id],
                ['term_type','type']
                ])->get();
             }
             
             $chip_term_relation = ProductChipsetCatRelation::where('product_id',$product_id)->get();
             
             
            $data = compact('ProductDetail','productGalleryImg','colorvariationss','garphic_terms','hard_drive_terms',
            'screen_size_terms','processor_terms','ram_terms','ssd_terms','type_terms','chip_term_relation');
            
            return view('admin.manage-product.add_update', $data);
    }
    
    
    function DyanamicDelete(Request $request)
    {
        $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = Product::find($idFor);
            if($IsExists_info)
            {
                if(!empty($IsExists_info->image))
                        {
                            $image = $IsExists_info->image;
                            $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
                               #->delete old image 
                               if(file_exists(base_path($dir.$image)))
                               {
                                       \File::delete(base_path($dir.$image));
                               }
                        }
            $variations = ProductVariation::where('product_id', $idFor)->get();
            foreach($variations as $varaton){
                VariationImage::where('variation_id',$varaton->id)->delete();
            }
                ProductGallary::where('product_id', $idFor)->delete();
                ProductVariation::where('product_id', $idFor)->delete();
                ProductCategoryRelationship::where('product_id', $idFor)->delete();
                TermRelation::where('product_id', $idFor)->delete();
                $ResponseStatus =  $IsExists_info->delete();        
            }
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
    }
    //update stuts product
    
    function updaetDyanamicStatus(Request $request)
    {
        $ResponseStatus = 0;
    	if($request->ajax())
    	{
    	    $statusFor = trim($request->statusFor);
    		$idFor     = trim($request->idFor);
    		$statusNew = trim($request->statusNew);
    		if(!empty($statusFor) && !empty($idFor) && !empty($statusNew))
    		{
    		    $isExistsInfo  = Product::find($idFor);
                    
                    if($isExistsInfo)
                    {
                         $currentStatus = $isExistsInfo->status;
                         if(isset($currentStatus) && $currentStatus==0)
                         {
                             $NewStatus = 1;
                         }else{
                             $NewStatus = 0;
                         }
                         $isExistsInfo->status = $NewStatus;
                         $ResponseStatus = $isExistsInfo->save();
                    } 
    		}
    		else{

    			$ResponseStatus = 0;
    		}
    	}
    	$collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
    }
    
    function ChangeGalleryimg(Request $request){
         if($request->ajax())
    	{ 
    	    $image='';
            $prod_id = $request->prod_id;
           $idFor = $request->idFor;
      
            $img = $request->img;
            
    
    	    $fileName= $_FILES['gallery_img']['name'];
    	    
    	    
    	    if($request->hasFile('gallery_img'))
                {
                    
                    $dir = public_path('/').Config::get('constants.PRODUCT_IMAGE_PATH');
                    if(file_exists(base_path($dir.$img)))
                     {
                         \File::delete(base_path($dir.$img));
                     }
                     
                   $image = time().rand(1,100).'.'.$request->gallery_img->getClientOriginalExtension();
                     
                     $uploadImg = $request->file('gallery_img')->move($dir, $image);

                }
                
           $productGalleryUpdate = ProductGallary::where([
                ['product_id', '=', $prod_id],
                ['image', '=', $img],
                ])->update(['image' => $image]);
            
            if($productGalleryUpdate){
                echo "file updated";
            }    
    	}
    	
    	die(0);
    }
    
    
    //delete gallery img
     function DeleteGalleryimg(Request $request)
    {
        $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = ProductGallary::find($idFor);
            if($IsExists_info)
            {
                if(!empty($IsExists_info->image))
                        {
                            $image = $IsExists_info->image;
                            $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
                               #->delete old image 
                               if(file_exists(base_path($dir.$image)))
                               {
                                       \File::delete(base_path($dir.$image));
                               }
                        }
                $ResponseStatus =  $IsExists_info->delete();        
            }
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
    }
    
    
    function DyanamicDeleteVariation(Request $request){
        $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = ProductVariation::find($idFor);
            if($IsExists_info)
            {
                if(!empty($IsExists_info->color_image))
                        {
                            $image = $IsExists_info->color_image;
                            $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
                               #->delete old image 
                               if(file_exists(base_path($dir.$image)))
                               {
                                       \File::delete(base_path($dir.$image));
                               }
                        }
                        
                VariationImage::where('variation_id',$idFor)->delete();
                $ResponseStatus =  $IsExists_info->delete();        
            }
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
    }
    
    
    
}

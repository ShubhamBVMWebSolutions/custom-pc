@extends('admin.admins-layout.admin_master')
@section('title', 'Add Update Product')
@section('content')

<?php $categories = getallCategories(); 
$brands = getallBrands();
$colors = getallColors();
$graphicCards = get_all_graphiccards();
$hardDrives = getallHradDrive();
$processors = getallProcessors();
$rams = getallRams();
$screenSizes = getallScreenSizes();
$ssds = getallSSD();
$types = getalltypes();?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
    <section class="content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
               <div class="col-lg-8">
                  <div class="page-header-title">
                    @if(isset($ProductDetail))
                     <a href="{{route('view.product',['productSlug'=>$ProductDetail->slug])}}"><i class="far fa-eye bg-blue"></i> View Product</a>
                    @endif
                     <div class="d-inline">
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.PRODUCT')}}</h5>
                        <span>Add/Update Product</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.add.product')}}">Add</a> / Update</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
         <div class="row">
             
             <div class="col-md-12">
                 
                  @if ($errors->any())
               <div class="alert alert-danger alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <ul class="list-unstyled m-0">
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               @if(session()->has('alert-success'))
               <div class="alert alert-success alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <strong>Success!</strong> {{ session()->get('alert-success') }} 
               </div>
               @endif
               @if(session()->has('alert-error'))
               <div class="alert alert-danger alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <strong>Failed!</strong> {{ session()->get('alert-error') }} 
               </div>
               @endif
             </div>
             </div>
           @if(isset($ProductDetail) && !empty($ProductDetail->id))
                     <form class="forms-sample" action="{{route('admin.update.product',['encproductId'=>$ProductDetail->id])}}" method="post" enctype="multipart/form-data">
                        @else
             <form class="forms-sample" action="{{route('admin.add.product')}}" method="post" enctype="multipart/form-data">
                   @endif
                     @csrf    
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                   <div class="card-body">
                         <input type="hidden" value="{{$ProductDetail->id ?? ''}}" id="product_id">
 
                         <div class="form-group">
                           <label>Product Type</label>
                           <select name="product_type" class="form-control">
                               <option value="product" <?php echo @$ProductDetail->product_type=="product"?'selected':'' ?> >Product</option>
                               <option value="giftcard" <?php echo @$ProductDetail->product_type=="giftcard"?'selected':''?> >Giftcard</option>
                               <option value="pcbuilder" <?php echo @$ProductDetail->product_type=="pcbuilder"?'selected':''?> >PC Builder</option>
                           </select>
                           </div> 

                         <div class="form-group">
                           <label for="exampleInputUsername1">Product Title</label>
                           <input type="text" name="title" class="form-control" placeholder="Product Title" value="{{$ProductDetail->title ?? old('title')}}">
                        </div>
                        
                        <div class="form-group">
                           <label>Meta Keywords(add seperate by comma) (SEO)</label>
                           <input type="text" name="meta_keywords" class="form-control" placeholder="Meta Keywords" value="{{$ProductDetail->meta_keywords ?? old('meta_keywords')}}">
                        </div>

                        <div class="form-group">
                           <label>Search tags(add seperate by comma)</label>
                           <input type="text" name="search_tags" class="form-control" placeholder="Search tags" value="{{$searchTags ?? old('search_tags')}}">
                        </div>
                        
                        <div class="form-group">
                           <label>Meta Description(SEO)</label>
                           <input type="text" name="meta_description" class="form-control" placeholder="Meta Description" value="{{$ProductDetail->meta_description ?? old('meta_description')}}">
                        </div>
                        
                        <div class="form-group">
                           <label>Product Overview</label>
                           <textarea id="overview" rows="5" class="form-control" name="product_overview" placeholder="Product Overview">{{$ProductDetail->product_overview ?? old('product_overview')}}</textarea>
                        </div>
                        
                        <div class="form-group">
                           <label>
                               <!--Material Used-->
                               What's in the box
                            </label>
                           <textarea id="material" rows="5" class="form-control" name="material" placeholder="Product Material">{{$ProductDetail->material ?? old('material')}}</textarea>
                        </div>

                        <div class="form-group">
                           <label>Details</label>
                           <textarea id="detail" rows="5" class="form-control" name="product_detail" placeholder="Product detail">{{$ProductDetail->details ?? old('details')}}</textarea>
                        </div>

                        <div class="form-group">
                           <label>Short Description</label>
                           <textarea id="short_description" rows="5" class="form-control" name="short_description" placeholder="Product Short Description">{{$ProductDetail->short_description ?? old('short_description')}}</textarea>
                        </div>
                        
                        <div class="form-group">
                           <label>Product Features</label>
                           <textarea id="features" rows="5" class="form-control" name="features" placeholder="Product Features">{{$ProductDetail->features ?? old('features')}}</textarea>
                        </div>
                        <?php $related_products = array();
                        if(isset($ProductDetail)){
                            $related_products = explode(',',$ProductDetail->related_products);
                        }
                        ?>
                       <div class="form-group">
                           <label>Related Products</label>
                           <select name="related_products[]" class="form-control border-primary js-example-basic-multiple" multiple>
                               <option>Select Product</option>
                               @foreach(getallproducts() as $relprod)
                               <option value="{{$relprod->id}}" @if(in_array($relprod->id,$related_products)) selected @endif >{{$relprod->title}}</option>
                               @endforeach
                           </select>
                           </div> 
                        
                  </div>
               </div>
               
               <div class="row">
             <div class="col-md-12">
                 <div class="card">
                   <div class="card-body">
                       <h4>Variations</h4>
                       @if(isset($colorvariationss) && $colorvariationss->count() > 0) 
                       <div id="accordion" class="variation_accr">
                           @foreach($colorvariationss as $variaton)
                           <div class="card">
    <div class="card-header" id="heading{{$variaton->id}}">
      <h5 class="mb-0">
        <a href="javascript:;" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$variaton->id}}" aria-expanded="true" aria-controls="collapse{{$variaton->id}}">
          Variation {{$variaton->id}}<i class="fa fa-chevron-down"></i>

        </a>
      </h5>
    </div>

    <div id="collapse{{$variaton->id}}" class="collapse" aria-labelledby="heading{{$variaton->id}}" data-parent="#accordion">
      <div class="card-body">
            
                <div class="row clr_variation" id="variation_{{$variaton->id}}">
                    <input type="hidden" name="variation_id[]" value="{{$variaton->id}}">
                            <div class="col-md-1">
                                <label>#ID</label>
                                <p><b>{{$variaton->id}}</b></p>
                            </div>
                            <div class="col-md-2">
                               <div class="form-group">
                                   <label>Color</label>
                                   <select name="pa_color[]" id="pa_color" class="form-control">
                                       <option value="">Select Color</option>
                                       @foreach($colors as $color)
                                       <option value="{{$color->id}}" @if($variaton->color_id == $color->id) selected @endif >{{$color->color_name}}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>
                           
                           <div class="col-md-2">
                               <div class="form-group">
                                   <label>SSD</label>
                                   <select name="pa_ssd[]" id="pa_ssd" class="form-control">
                                       <option value="">Select SSD</option>
                                       @foreach($ssds as $ssd)
                                       <option value="{{$ssd->id}}" @if($variaton->ssd_id == $ssd->id) selected @endif >{{$ssd->title}}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>
                           
                           <div class="col-md-2">
                               <div class="form-group">
                                   <label>RAM</label>
                                   <select name="pa_ram[]" id="pa_ram" class="form-control">
                                       <option value="">Select RAM</option>
                                       @foreach($rams as $ram)
                                       <option value="{{$ram->id}}" @if($variaton->ram_id == $ram->id) selected @endif >{{$ram->title}}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>
                           
                           <div class="col-md-2">
                               <div class="form-group">
                                   <label>Screen Sizes</label>
                                   <select name="pa_screen[]" id="pa_screen" class="form-control">
                                       <option value="">Select screen size</option>
                                       @foreach($screenSizes as $screen_size)
                                       <option value="{{$screen_size->id}}" @if($variaton->screen_size_id == $screen_size->id) selected @endif >{{$screen_size->title}}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>
                           
                           <div class="col-md-2">
                               <div class="form-group">
                                   <label>SKU</label>
                                   <input name="pa_sku[]" id="pa_sku" class="form-control" value="{{$variaton->sku}}"/>
                               </div>
                           </div>
                           
                           <div class="col-md-1">
                               <div class="form-group">
                                   <label>Price</label>
                                   <input name="pa_price[]" id="pa_price" class="form-control" value="{{$variaton->price}}"/>
                               </div>
                           </div>
                           <div class="col-md-1">
                           </div>
                           
                           <div class="col-md-2">
                               <div class="form-group">
                                   <label>Image</label>
                                   
                               <input type="file" class="form-control" id="color_img" name="color_img[{{$variaton->id}}][]" multiple >
                               </div>
                           </div>

                           <div class="col-md-2">
                           </div>
                           <div class="col-md-2">
                           </div>
                           <div class="col-md-2">
                           </div>
                           <div class="col-md-2">
                           </div>
                           
                           <div class="col-md-1">
                               <button type="button" class="btn btn-danger btn-lg remove" id="delete_variation" value="{{$variaton->id}}">Remove</button>
                               
                            </div>
                       </div>
                       <div class="row">
                           <div class="col-md-12">
                               @if(isset($variaton->id))
                               <ul class="variation_gall_ul">
                               @foreach(getVariationImageById($variaton->id) as $varImage)
                               <li>
                           <img class="backpanel_member_img" src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$varImage->variation_image )}}"  height="90" width="90">
                           <input type="hidden" name="old_color_image[{{$variaton->id}}][$varImage->id]" value="{{$varImage->variation_image ?? ''}}">
                           <input type="hidden" name="var_image_id_{{$variaton->id}}[]" value="{{$varImage->id}}">
                           </li>
                           @endforeach
                           </ul>
                           @else
                           <img class="backpanel_member_img" src="{{url('public\img\placeholder (1).png')}}"  height="90" width="90">
                           @endif
                           </div>
                       </div>
            
            
      </div>
    </div>
  </div>
  @endforeach
                           </div>
                           @endif
               <div class="row clr_variation">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-2">
                                       <div class="form-group">
                                           <label>Color</label>
                                           <select name="pa_color_new[]" class="form-control">
                                               <option value="">Select Color</option>
                                               @foreach($colors as $color)
                                               <option value="{{$color->id}}">{{$color->color_name}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-md-2">
                                       <div class="form-group">
                                           <label>SSD</label>
                                           <select name="pa_ssd_new[]" class="form-control">
                                               <option value="">Select SSD</option>
                                               @foreach($ssds as $ssd)
                                               <option value="{{$ssd->id}}"  >{{$ssd->title}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-md-2">
                                       <div class="form-group">
                                           <label>RAM</label>
                                           <select name="pa_ram_new[]" class="form-control">
                                               <option value="">Select RAM</option>
                                               @foreach($rams as $ram)
                                               <option value="{{$ram->id}}"  >{{$ram->title}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   
                                   <div class="col-md-2">
                                       <div class="form-group">
                                           <label>Screen Size</label>
                                           <select name="pa_screen_new[]" class="form-control">
                                               <option value="">Select screen size</option>
                                               @foreach($screenSizes as $screen_size)
                                               <option value="{{$screen_size->id}}" >{{$screen_size->title}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-md-2">
                                       <div class="form-group">
                                           <label>SKU</label>
                                           <input name="pa_sku_new[]" class="form-control" value=""/>
                                       </div>
                                   </div>
                                   <div class="col-md-2">
                                       <div class="form-group">
                                           <label>Price</label>
                                            <input type="text" name="pa_price_new[]" class="form-control" value=""/>
                                       </div>
                                   </div>
                                   <div class="col-md-2">
                                       <div class="form-group">
                                           <label>Image</label>
                                            <input type="file" class="form-control" name="color_img_new[]" onchange="updateCount(this);" multiple accept="image/*">
                                            <input type="hidden" class="form-control" name="pa_image_count_new[]" value="0">
                                       </div>
                                   </div>
                                </div>
                            </div>
                           <div class="col-md-2">
                               <button type="button" class="btn btn-success btn-lg add" type="button" >Add</button>
                        </div>
                       </div>
                       
                    </div>
                </div>
             </div>
         </div>  
               
                
            </div>
            <div class="col-md-4">
               <div class="card">
                  <div class="card-body">
                   <div class="form-group">
                   <label for="exampleInputName1">Product Categories</label><br>
                   <div class="prod_cat_ul">
                   <ul>
                       <?php $catgories = array();
                       if(isset($ProductDetail)){
                       $catgories = explode(',',$ProductDetail->product_categories);
                       }?>
                   @foreach($categories as $cat)
                   <li><input type="checkbox" name="product_category[]" value="{{$cat->id}}" <?php if(in_array($cat->id,$catgories)) echo 'checked'; ?> > <span>{{$cat->title}}</span></li>
                   @endforeach
                   </ul>
                   </div>
                   </div>
                   
                   <div class="form-group">
                   <label for="exampleInputName1">Graphic Card</label><br>
                   <div class="prod_cat_ul">
                   <ul>
                       <?php $card_term_arr = array();
                      if(isset($ProductDetail)){ 
                       foreach($garphic_terms as $termcard){
                           $card_term_arr[] = $termcard->term_id;
                       }
                      }
                       ?>
                   @foreach($graphicCards as $card)
                   <li><input type="checkbox" name="graphic_card[]" value="{{$card->id}}" <?php if(in_array($card->id,$card_term_arr)) echo 'checked';?> > <span>{{$card->title}}</span></li>
                   @endforeach
                   </ul>
                   </div>
                   </div>
                   
                   <div class="form-group">
                   <label for="exampleInputName1">Hard Drive</label><br>
                   <div class="prod_cat_ul">
                   <ul>
                       <?php $hard_arr = array();
                        if(isset($ProductDetail)){ 
                       foreach($hard_drive_terms as $drive){
                           $hard_arr[] = $drive->term_id;
                       }
                        }
                       ?>
                   @foreach($hardDrives as $drive)
                   <li><input type="checkbox" name="hard_drive[]" value="{{$drive->id}}" <?php if(in_array($drive->id,$hard_arr)) echo 'checked';?> > <span>{{$drive->title}}</span></li>
                   @endforeach
                   </ul>
                   </div>
                   </div>
                   
                   <div class="form-group">
                   <label for="exampleInputName1">Screen Size</label><br>
                   <div class="prod_cat_ul">
                   <ul>
                       <?php $screen_arr = array();
                        if(isset($ProductDetail)){ 
                       foreach($screen_size_terms as $screen){
                           $screen_arr[] = $screen->term_id;
                       }
                        }
                       ?>
                   @foreach($screenSizes as $size)
                   <li><input type="checkbox" name="screen_size[]" value="{{$size->id}}" <?php if(in_array($size->id,$screen_arr)) echo 'checked';?> > <span>{{$size->title}}</span></li>
                   @endforeach
                   </ul>
                   </div>
                   </div>
                   
                   <div class="form-group">
                   <label for="exampleInputName1">SSD</label><br>
                   <div class="prod_cat_ul">
                   <ul>
                       <?php $ssd_arr = array();
                        if(isset($ProductDetail)){ 
                       foreach($ssd_terms as $ssdd){
                           $ssd_arr[] = $ssdd->term_id;
                       }
                        }
                       ?>
                   @foreach($ssds as $ssd)
                   <li><input type="checkbox" name="ssd[]" value="{{$ssd->id}}" <?php if(in_array($ssd->id,$ssd_arr)) echo 'checked';?> > <span>{{$ssd->title}}</span></li>
                   @endforeach
                   </ul>
                   </div>
                   </div>
                   
                   <div class="form-group">
                   <label for="exampleInputName1">Type</label><br>
                   <div class="prod_cat_ul">
                   <ul>
                       <?php $type_arr = array();
                        if(isset($ProductDetail)){ 
                       foreach($type_terms as $typee){
                           $type_arr[] = $typee->term_id;
                       }
                        }
                       ?>
                   @foreach($types as $type)
                   <li><input type="checkbox" name="type[]" value="{{$type->id}}" <?php if(in_array($type->id,$type_arr)) echo 'checked';?> > <span>{{$type->title}}</span></li>
                   @endforeach
                   </ul>
                   </div>
                   </div>
                   
                   <div class="form-group">
                   <label for="exampleInputName1">Processor</label><br>
                   <div class="prod_cat_ul">
                   <ul>
                       <?php $procssr_arr = array();
                        if(isset($ProductDetail)){ 
                       foreach($processor_terms as $procsr){
                           $procssr_arr[] = $procsr->term_id;
                       }
                        }
                       ?>
                   @foreach($processors as $processor)
                   <li><input type="checkbox" name="processor[]" value="{{$processor->id}}" <?php if(in_array($processor->id,$procssr_arr)) echo 'checked';?> > <span>{{$processor->title}}</span></li>
                   @endforeach
                   </ul>
                   </div>
                   </div>
                   
                   <div class="form-group">
                   <label for="exampleInputName1">RAM</label><br>
                   <div class="prod_cat_ul">
                   <ul>
                       <?php $ram_arr = array();
                        if(isset($ProductDetail)){ 
                       foreach($ram_terms as $ramm){
                           $ram_arr[] = $ramm->term_id;
                       }
                        }
                       ?>
                   @foreach($rams as $ram)
                   <li><input type="checkbox" name="ram[]" value="{{$ram->id}}" <?php if(in_array($ram->id,$ram_arr)) echo 'checked';?> > <span>{{$ram->title}}</span></li>
                   @endforeach
                   </ul>
                   </div>
                   </div>
                   
                   <?php $chip_cat_arr = array();
                  if(!empty($chip_term_relation)){ 
                   foreach($chip_term_relation as $chip_trm){
                       $chip_cat_arr[] = $chip_trm->chip_cat_id;
                   } } ?>
                   <div class="">
                       <h5><b>Chipset Sub Categories</b></h5>
                       <div class="form-group">
                           <label>AMD Categories</label>
                           <div class="prod_cat_ul">
                               <ul>
                                   @foreach(getChipsetSubCatbyChipId(1) as $amd)
                                   <li>
                                       <input type="checkbox" name="amd_sub_cat[]" value="{{$amd->id}}" @if(!empty($chip_term_relation) && in_array($amd->id,$chip_cat_arr)) checked @endif> {{$amd->subcat_title}}
                                   
                                    </li>
                                   @endforeach
                               </ul>
                            </div>
                       </div>
                       
                       <div class="form-group">
                           <label>Intel Categories</label>
                           <div class="prod_cat_ul">
                               <ul>
                                   @foreach(getChipsetSubCatbyChipId(2) as $intel)
                                   <li><input type="checkbox" name="intel_sub_cat[]" value="{{$intel->id}}" @if(!empty($chip_term_relation) && in_array($intel->id,$chip_cat_arr)) checked @endif > {{$intel->subcat_title}}</li>
                                   @endforeach
                               </ul>
                            </div>
                       </div>
                   </div>
                   
                   <div class="form-group">
                    <label>Product Brand</label>
                    <select name="brand" class="form-control">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}" @if(isset($ProductDetail->brand) && $ProductDetail->brand == $brand->id) selected @endif >{{$brand->name}}</option>
                        @endforeach
                    </select>
                   </div>
                      
                   <div class="form-group">
                    <label>Regular Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Enter Price" value="{{$ProductDetail->price ?? old('price')}}">
                   </div>
                   
                   <div class="form-group">
                    <label>Sale Price (Discounted Price)</label>
                    <input type="text" class="form-control" name="sale_price" placeholder="Enter Sale Price" value="{{$ProductDetail->sale_price ?? old('sale_price')}}">
                   </div>
                   
                   <div class="form-group">
                    <label>Model</label>
                    <input type="text" class="form-control" name="model" placeholder="Enter Model" value="{{$ProductDetail->model ?? old('model')}}">
                   </div>
                   
                   <div class="form-group">
                    <label>SKU</label>
                    <input type="text" class="form-control" name="sku" placeholder="Enter SKU" value="{{$ProductDetail->sku ?? old('sku')}}">
                   </div>
                   
                   <div class="form-group">
                       <h5>Manage Stock</h5>
                    <label>Quantity in Stock</label>
                    <input type="number" class="form-control" name="stock_qty" placeholder="Enter Stock Qty" value="{{$ProductDetail->stock_qty ?? old('stock_qty')}}">
                   </div>
                              <div class="form-group">
                           <label>Product Image</label>
                           <br>
                           @if(isset($ProductDetail->image ) && !empty($ProductDetail->image ))
                           <div class="text-center">
                           <img class="backpanel_member_img" src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$ProductDetail->image )}}"  height="300" width="300">
                           <input type="hidden" name="old_post_image" value="{{$ProductDetail->image}}">
                           </div>
                           @endif
                           <input type="file" name="product_image" class="file-upload-default" accept=".png, .jpg, .jpeg">
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                              <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>
                        </div> 
                                          <div class="form-group">
                      <label>Product Gallery</label>
                      @if(isset($productGalleryImg) && $productGalleryImg->count() > 0)
                      <br>
                        <div class="gal_img_secout01">
                          @foreach($productGalleryImg as $gall)
                            
                          <div class="gal_img_sec" id="galRecord_edit_gal_img{{$gall->id}}">
                         <button type="button" id="edit_img" title="Edit Image" data-toggle="modal" data-target="#gallery{{$gall->id}}"><i class="fas fa-edit"></i></button>
                         <button type="button" id="delete_img" data-id="{{$gall->id}}" title="Delete Image" value="{{$gall->image}}"><i class="fa fa-times" aria-hidden="true"></i></button>
                         <img src="{{url(Config::get('constants.PRODUCT_IMAGE_PATH').$gall->image)}}" width="50" height="50">
                          </div>
                      <div class="modal fade gallery_modal" id="gallery{{$gall->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                   <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Gallery Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                       </button>
                         </div>
                       <div class="modal-body">
                      
                       <img class="modal_galImg" src="{{url(Config::get('constants.PRODUCT_IMAGE_PATH').$gall->image)}}" >
                       <input type="file" class="file_select gallery_{{$gall->id}}" name="gallery{{$gall->id}}" id="gallery{{$gall->id}}" accept="image/*">
                     <button class="btn btn-primary mr-2" type="button" value="{{$gall->image}}" data-id="{{$gall->id}}" id="edit_gal_img">Update Image</button>
                    <div id="succ_img"></div>
                      </div>
                         </div>
                       </div>
                   </div>
                      @endforeach
                      </div>
                      </br><br>
                
                      @endif
                      <input type="file" name="gallery[]" class="form-control" multiple>
                      </div>
                      
                      <div class="form-group">
                        <input type="checkbox" name="featured" value="yes" {{isset($ProductDetail->featured) && $ProductDetail->featured=='yes' ? 'checked' : ''}} > <label for="featured">Set As Featured</label>
                        </div>
                      
                       @if(isset($ProductDetail) && !empty($ProductDetail->id))
                        <div class="form-group">
                           <label>Status</label>
                           <div class="input-group">
                              <label class="display-inline-block custom-control custom-radio ml-1">
                              <input type="radio" name="status" class="custom-control-input" value="1" {{ isset($ProductDetail->status) && $ProductDetail->status==1 ? 'checked' : ''}}>
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-label">Active</span>
                              </label>
                              <label class="display-inline-block custom-control custom-radio ml-3">
                              <input type="radio" name="status" class="custom-control-input" value="0" {{isset($ProductDetail->status) && $ProductDetail->status==0 ? 'checked' : ''}}>
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-label">Inactive</span>
                              </label>
                           </div>
                        </div>
                        @endif   
                          
                        
                     @if(isset($ProductDetail) && !empty($ProductDetail->id))
                     <div class="form-group-full01 text-right">
                     <button type="submit" class="btn btn-primary mr-2">Update</button>
                     </div>
                     @else
                     <div class="form-group-full01 text-right">
                    <button type="submit" class="btn btn-primary ml-2">Publish</button>  
                    </div>
                     @endif
                
               </div>
            </div>
            </div>
        </div>
         
         
         
        </form>
         
      </div>
   </div>
</div>



      
      
      
      
        </div>
      
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'overview' );
   CKEDITOR.replace( 'material' );
   CKEDITOR.replace( 'detail' );
   CKEDITOR.replace( 'short_description' );
   CKEDITOR.replace( 'features' );
</script> 


<script>
var tableString = '<div class="row clr_variation"><div class="col-md-10"><div class="row"><div class="col-md-2"><div class="form-group"><label>Color</label><select name="pa_color_new[]" class="form-control"><option value="">Select Color</option>@foreach($colors as $color)<option value="{{$color->id}}">{{$color->color_name}}</option>@endforeach</select></div></div><div class="col-md-2"><div class="form-group"><label>SSD</label><select name="pa_ssd_new[]" class="form-control"><option value="">Select SSD</option>@foreach($ssds as $ssd)<option value="{{$ssd->id}}"  >{{$ssd->title}}</option>@endforeach</select></div></div><div class="col-md-2"><div class="form-group"><label>RAM</label><select name="pa_ram_new[]" class="form-control"><option value="">Select RAM</option>@foreach($rams as $ram)<option value="{{$ram->id}}"  >{{$ram->title}}</option>@endforeach</select></div></div><div class="col-md-2"><div class="form-group"><label>Screen Sizes</label><select name="pa_screen_new[]" class="form-control"><option value="">Select screen size</option>@foreach($screenSizes as $screen_size)<option value="{{$screen_size->id}}" >{{$screen_size->title}}</option>@endforeach</select></div></div><div class="col-md-2"><div class="form-group"><label>SKU</label><input name="pa_sku_new[]" class="form-control" value=""/></div></div><div class="col-md-2"><div class="form-group"><label>Price</label><input type="text" name="pa_price_new[]" class="form-control" value=""/></div></div><div class="col-md-2"><div class="form-group"><label>Image</label><input type="file" class="form-control" name="color_img_new[]" onchange="updateCount(this);" multiple accept="image/*"><input type="hidden" class="form-control" name="pa_image_count_new[]" value="0"></div></div></div></div><div class="col-md-2"><button type="button" class="btn btn-success btn-lg add" type="button" >Add</button><button type="button" class="btn btn-danger btn-lg remove">Remove</button></div></div>';
      
      function setupHandlers() {
      $('.add').unbind();
      $('.remove').unbind();
    $('.add').click(function() {
       $(".clr_variation").last().after(tableString);
        setupHandlers();
    });

  $('.remove').click(function() {
    if($(".clr_variation").length > 1)
     {
        $(this).closest('.clr_variation').remove();
     }
  else
     {
        alert("You cannot delete first row");
     }
      });
      }
 $(document).ready(function(){
      setupHandlers();
  });
</script>


<script>
    $(document).ready(function() {
        $(".js-example-basic-multiple").select2();
    });

//update image count
function updateCount(e) {
    var numFiles = e.files.length;
    alert(numFiles);
    console.log($(e).closest("div").find("input[name='pa_image_count_new[]']").val(numFiles));
};
</script>



          
@endsection
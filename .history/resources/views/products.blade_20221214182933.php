@extends('front-layout.master_layout')
@section('title',$metaDetails[0]->name)
@section('meta_keywords',$metaDetails[0]->meta_keywords ?? '')
@section('meta_description',$metaDetails[0]->meta_description ?? '')
@section('content')

<?php 
$brand_id = $metaDetails[0]->id; 
$sort_val = $_GET['sort'] ?? ''; 

$graphicCards = get_all_graphiccards();
$hardDrives = getallHradDrive();
$processors = getallProcessors();
$rams = getallRams();
$screenSizes = getallScreenSizes();
$ssds = getallSSD();
$types = getalltypes();

?>

<!-- Intro Section -->
<section class="intro_part">
    <div class="container">
        <div class="row">
             <div class="col-lg-12">
                 <div class="category_page_bar text-center">
                     <h2>{{$metaDetails[0]->name}}</h2>
                     <?php echo $metaDetails[0]->description ?? ''; ?>
                 </div>   
             </div>   
        </div> 
    </div>    
</section>
<!--  Intro Section End-->

<!-- Main Heightligh Parts -->
<section class="heightlight_part">
    <div class="container">
            <div class="row">
                 <div class="col-lg-12">
                     <div class="shop__product__option">
                         @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible  mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
    <strong>Success!</strong> {{ session()->get('success') }} <a class="primary-btn" href="{{route('view.cart')}}">View Cart</a>
    </div>
 @endif
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <?php $count = 1;
                                    $count_arr = array();
                                    for($count = 1; $count<=$brand_products->count(); $count++){
                                        $count_arr[] = $count;
                                    }
                                    
                                    ?>
                                <div class="shop__product__option__right">
                                    <p>Showing {{$count_arr[0] ?? '0'}}–{{end($count_arr)}} of {{$brand_products_count}} results</p>
                                    <p>Sort by:</p>
                                    <form method="GET">
                                    <select style="display: none;" name="sort" onchange="this.form.submit()">
                                        <option value="price_asc" @if($sort_val == 'price_asc') selected @endif >Price: Low - High</option>
                                        <option value="price_desc" @if($sort_val == 'price_desc') selected @endif >Price: High - Low</option>
                                        <option value="new_old" @if($sort_val == 'new_old') selected @endif >New - Old</option>
                                        <option value="old_new" @if($sort_val == 'old_new') selected @endif >Old - New</option>
                                        <option value="title_asc" @if($sort_val == 'title_asc') selected @endif >Title: A - Z</option>
                                        <option value="title_desc" @if($sort_val == 'title_desc') selected @endif >Title: Z - A</option>
                                        <option value="popular" @if($sort_val == 'popular') selected @endif >Popularity</option>
                                    </select>
                                   </form>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>   
            </div>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                <div class="shop__sidebar__accordion">
    <div class="accordion" id="accordionExample">
       
        <div class="card">
            <div class="card-heading">
                <a data-toggle="collapse" data-target="#collapseOne">CATEGORIES</a>
            </div>
            <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="shop__sidebar__categories">
                        <ul class="nice-scroll">
                            @foreach(getallCategories() as $cat)
                            <li><a href="{{route('view.product.category',['productcategorySlug' => $cat->slug])}}">{{$cat->title}}</a></li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-heading">
                <a data-toggle="collapse" data-target="#collapseTwo">BRAND</a>
            </div>
            <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="shop__sidebar__brand">
                        <ul>
                            @foreach(getallBrands() as $brand)
                            <li class="<?php if($brand_id == $brand->id) echo 'active'; ?>"><a href="{{route('view.product.brand',['productbrandSlug' => $brand->slug])}}">{{$brand->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
         <div class="card">
            <div class="card-heading">
                <a data-toggle="collapse" data-target="#collapsethree">GRAPHICS CARD</a>
            </div>
            <div id="collapsethree" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="shop__sidebar__brand">
                        <ul>
                            <?php $hard_drive_url = $processor_url = $ram_url = $screen_url = $ssd_url = $type_url = '';
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['processor'])){
                                $processor_url = '&processor='.$_GET['processor'];
                            }
                            if(isset($_GET['ram'])){
                               $ram_url = '&ram='.$_GET['ram']; 
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                            @foreach($graphicCards as $graphic)
                            <li><a href="?graphic={{$graphic->id}}{{$hard_drive_url}}{{$processor_url}}{{$ram_url}}{{$screen_url}}{{$ssd_url}}{{$type_url}}">{{$graphic->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-heading">
                <a data-toggle="collapse" data-target="#collapseFour">HARD DRIVE</a>
            </div>
            <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="shop__sidebar__brand">
                        <ul>
                            <?php $graphic_url = $processor_url = $ram_url = $screen_url = $ssd_url = $type_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['processor'])){
                                $processor_url = '&processor='.$_GET['processor'];
                            }
                            if(isset($_GET['ram'])){
                               $ram_url = '&ram='.$_GET['ram']; 
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                            @foreach($hardDrives as $drive)
                            <li><a href="?hard_drive={{$drive->id}}{{$graphic_url}}{{$processor_url}}{{$ram_url}}{{$screen_url}}{{$ssd_url}}{{$type_url}}">{{$drive->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-heading">
                <a data-toggle="collapse" data-target="#collapseFive">Filter Price</a>
            </div>
            <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="shop__sidebar__price">
                        <div class="price-range-slider">
                             <?php $price_val = $_GET['price'] ?? '';
      $min_price=getminprice();
      $max_price=getmaxprice();
      $new_min_price='';
      $new_max_price='';
      if(!empty($price_val)){
          $price_arr = explode('-',$price_val);
          $new_min_price = $price_arr[0];
          $new_max_price = $price_arr[1];
      }
      ?>
      
             
  
  <p class="range-value min_val_box">
      <span>NPR</span>
    <input type="text" id="min_amount" value="" class="price_minimum">
    <span class="price-filter-separator"> - </span> <span>&nbsp; NPR</span>
    <input type="text" id="max_amount" value="" class="price_maximum">
  </p>
  
  <div id="slider-range" class="range-bar"></div>
  
</div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-heading">
                <a data-toggle="collapse" data-target="#collapseSix">PROCESSOR</a>
            </div>
            <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="shop__sidebar__brand">
                        <ul>
                            <?php $graphic_url = $hard_drive_url = $ram_url = $screen_url = $ssd_url = $type_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['ram'])){
                               $ram_url = '&ram='.$_GET['ram']; 
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                            @foreach($processors as $prcsr)
                            <li><a href="?processor={{$prcsr->id}}{{$graphic_url}}{{$hard_drive_url}}{{$ram_url}}{{$screen_url}}{{$ssd_url}}{{$type_url}}">{{$prcsr->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
          <div class="card">
            <div class="card-heading">
                <a data-toggle="collapse" data-target="#collapseSeven">RAM</a>
            </div>
            <div id="collapseSeven" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="shop__sidebar__brand">
                        <ul>
                            <?php $graphic_url = $hard_drive_url = $processor_url = $screen_url = $ssd_url = $type_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['processor'])){
                               $processor_url = '&processor='.$_GET['processor']; 
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                            @foreach($rams as $ram)
                            <li><a href="?ram={{$ram->id}}{{$graphic_url}}{{$hard_drive_url}}{{$processor_url}}{{$screen_url}}{{$ssd_url}}{{$type_url}}">{{$ram->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-heading">
                <a data-toggle="collapse" data-target="#collapseEight">SCREEN SIZE</a>
            </div>
            <div id="collapseEight" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="shop__sidebar__brand">
                        <ul>
                            <?php $graphic_url = $hard_drive_url = $processor_url = $ram_url = $ssd_url = $type_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['processor'])){
                               $processor_url = '&processor='.$_GET['processor']; 
                            }
                            if(isset($_GET['ram'])){
                                $ram_url = '&ram='.$_GET['ram'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                            @foreach($screenSizes as $size)
                            <li><a href="?screen_size={{$size->id}}{{$graphic_url}}{{$hard_drive_url}}{{$processor_url}}{{$ram_url}}{{$ssd_url}}{{$type_url}}">{{$size->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-heading">
                <a data-toggle="collapse" data-target="#collapseNine">SSD</a>
            </div>
            <div id="collapseNine" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="shop__sidebar__brand">
                        <ul>
                            <?php $graphic_url = $hard_drive_url = $processor_url = $ram_url = $screen_url = $type_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['processor'])){
                               $processor_url = '&processor='.$_GET['processor']; 
                            }
                            if(isset($_GET['ram'])){
                                $ram_url = '&ram='.$_GET['ram'];
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['type'])){
                                $type_url = '&type='.$_GET['type'];
                            }
                            ?>
                            @foreach($ssds as $ssd)
                            <li><a href="?ssd={{$ssd->id}}{{$graphic_url}}{{$hard_drive_url}}{{$processor_url}}{{$ram_url}}{{$screen_url}}{{$type_url}}">{{$ssd->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
         <div class="card">
            <div class="card-heading">
                <a data-toggle="collapse" data-target="#collapseTen">TYPE</a>
            </div>
            <div id="collapseTen" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="shop__sidebar__brand">
                        <ul>
                            <?php $graphic_url = $hard_drive_url = $processor_url = $ram_url = $screen_url = $ssd_url = '';
                            if(isset($_GET['graphic'])){
                                $graphic_url = '&graphic='.$_GET['graphic'];
                            }
                            if(isset($_GET['hard_drive'])){
                                $hard_drive_url = '&hard_drive='.$_GET['hard_drive'];
                            }
                            if(isset($_GET['processor'])){
                               $processor_url = '&processor='.$_GET['processor']; 
                            }
                            if(isset($_GET['ram'])){
                                $ram_url = '&ram='.$_GET['ram'];
                            }
                            if(isset($_GET['screen_size'])){
                                $screen_url = '&screen_size='.$_GET['screen_size'];
                            }
                            if(isset($_GET['ssd'])){
                                $ssd_url = '&ssd='.$_GET['ssd'];
                            }
                            ?>
                            @foreach($types as $type)
                            <li><a href="?type={{$type->id}}{{$graphic_url}}{{$hard_drive_url}}{{$processor_url}}{{$ram_url}}{{$screen_url}}{{$ssd_url}}">{{$type->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-heading">
                <a data-toggle="collapse" data-target="#collapseEleven">Colors</a>
            </div>
            <div id="collapseEleven" class="collapse show" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="shop__sidebar__brand">
                        <ul>
                            @foreach(getallColors() as $color)
                            <li><a href="?color={{$color->id}}">{{$color->color_name}}</a></li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                
                
            </div>
                    <div class="col-md-9">
                        <?php $term_prod_ids = array();
            
            foreach($term_products as $trmprod){
                $term_prod_ids[] = $trmprod->product_id;
            }
            
            if(isset($_GET['graphic']) || isset($_GET['hard_drive']) || isset($_GET['processor']) || isset($_GET['ram']) || isset($_GET['screen_size']) || isset($_GET['ssd']) || isset($_GET['type'])){
             
             if(empty($term_prod_ids)){ ?>
                <div class="col-md-12">
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <h5>Products Not Found!</h5>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                 </div>
            <?php  } else{
             foreach($term_products as $term_product){
                 $prod_id = $term_product->product_id;
                 $prod_detail = productDetailById($term_product->product_id);
             
             ?>
             <div class="col-lg-4">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="1000">
                        <a href="{{route('view.product',['productSlug'=>$prod_detail->slug])}}">
                        <div class="product__item__pic set-bg" data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image )}}">
                        </div>
                        </a>
                        <div class="product__item__text">
                            <a href="{{route('view.product',['productSlug'=>$prod_detail->slug])}}"><h6>{{$prod_detail->title}}</h6></a>
                            @if(empty($prod_detail->stock_qty))
                            <p class="out_stock"><b>Out Of Stock</b></p>
                            @else
                            <a href="{{route('add.cart',['id'=>$prod_detail->id])}}" class="add-cart">+ Add To Cart</a>
                            @endif
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="g-sys-spec">
                                <?php //echo Str::limit($prod_detail->features, 140, '');?>
                            </div>
                            @if(!empty($prod_detail->sale_price))
                            <h5>NPR {{number_format($prod_detail->sale_price,2)}} <small>(ind. GST)</small></h5>
                            <h5 class="striked_price"><strike>NPR {{number_format($prod_detail->price,2)}}</strike> </h5>
                            @else
                            <h5>NPR {{number_format($prod_detail->price,2)}} <small>(ind. GST)</small></h5>
                            @endif
                        </div>
                    </div>
                 </div>
             
             <?php } } } else{ ?>
                        <div class="row">
                @if($brand_products->count() > 0)
                @foreach($brand_products as $brandprod)
                <?php $prod_id = $brandprod->id;
                $prod_detail = productDetailById($prod_id); 
                 
                 ?>
                 <div class="col-lg-4">
                    <div class="product__item" data-aos="fade-up" data-aos-duration="1000">
                        <a href="{{route('view.product',['productSlug'=>$prod_detail->slug])}}">
                        <div class="product__item__pic set-bg" data-setbg="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image )}}">
                        </div>
                        </a>
                        <div class="product__item__text">
                            <a href="{{route('view.product',['productSlug'=>$prod_detail->slug])}}"><h6>{{$prod_detail->title}}</h6></a>
                            @if(empty($prod_detail->stock_qty))
                            <p class="out_stock"><b>Out Of Stock</b></p>
                            @else
                            <a href="{{route('add.cart',['id'=>$prod_detail->id])}}" class="add-cart">+ Add To Cart</a>
                            @endif
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="g-sys-spec">
                                <?php //echo Str::limit($prod_detail->features, 140, '');?>
                            </div>
                            @if(!empty($prod_detail->sale_price))
                            <h5>NPR {{number_format($prod_detail->sale_price,2)}} <small>(ind. GST)</small></h5>
                            <h5 class="striked_price"><strike>NPR {{number_format($prod_detail->price,2)}}</strike> </h5>
                            @else
                            <h5>NPR {{number_format($prod_detail->price,2)}} <small>(ind. GST)</small></h5>
                            @endif
                        </div>
                    </div>
                 </div>
                 
                 @endforeach
                 @else
                 <div class="col-md-2"></div>
                 <div class="col-md-8">
                     <h5 class="alert alert-danger">No Products Found!</h5>
                 </div>
                 <div class="col-md-2"></div>
                 @endif
                 
                               
            </div>
            <div class="row d-flex justify-content-center pagination">
                {{$brand_products->links('vendor.pagination.bootstrap-4')}}
            </div>
            <?php } ?>
                    </div>
                </div>
            </div>
            
            
        </div>     
</section>

<!-- Main Heightligh End --> 

@endsection
@extends('front-layout.master_layout')
@section('title', 'PC Builder')
@section('content')

<?php use App\Models\ProductCategory;
$builder_data = '';
$chipset_id = '';
$performance = '';
$budget = '';
$error_return_url = route('pcbuilder');
$error_return_message = "Some components are missing now for the selected combination.Try after some time or select the next combination.";
$budgets = \App\Models\PcBudget::get();
if(session()->has('builder_data')){
    $builder_data = session()->get('builder_data');
    $chipset_id = $builder_data['chipset_id'];
    $performance = $builder_data['performance'];
    $budget = $builder_data['budget'];
}
else{
    header("Location: ".route('pcbuilder'));
    die;
}

$chiSubCat = getChipsetSubCatbyChipId($chipset_id);
$chipsubcat_selectedid = $chiSubCat[0]->id;
$chip_cat_id = $chiSubCat[0]->id ?? '';
$chipsubcat_title = chipsetSubCatDetailById($chip_cat_id)->subcat_title;
$chip_cat_products = chipSubcatproductsById($chip_cat_id);


//get first product
if($budget == $budgets[0]->amount){
    $added_prod_id = $chiSubCat[0]->product_id1;
}
elseif($budget == $budgets[1]->amount){
    $added_prod_id = $chiSubCat[0]->product_id2;
}
elseif($budget == $budgets[2]->amount){
    $added_prod_id = $chiSubCat[0]->product_id3;
}
elseif($budget == $budgets[3]->amount){
    $added_prod_id = $chiSubCat[0]->product_id4;
}

//return if empty case

if(empty($added_prod_id)){
    // session()->flash('error_message','Products are missing.Try some time later');
    echo "<script>alert('".$error_return_message."');</script>";
    echo "<script>window.location.replace('".$error_return_url."');</script>";
    // header("Location: ".route('pcbuilder'));
    die;
}


//set first product and variant
$default_prod_id = $added_prod_id;
$added_prod_variation = getProdvariationById($added_prod_id);

if($added_prod_variation->count() > 0){
   $added_prod_varId = $added_prod_variation[0]->id; 
   $added_prod_gallery = getVariationImageById($added_prod_varId);
}else{
    $added_prod_gallery = prodGalleryimagesById($added_prod_id);
}



$added_prod_detail = productDetailById($added_prod_id);

//case summary detail
if($chipset_id == 1){
$case_id = 1;
} elseif($chipset_id == 2){ 
$case_id = 9;
}



//cpu summary detail
if($chipset_id == 1){
$cpu_id = 5;
} elseif($chipset_id == 2){ 
$cpu_id = 13;
}
$cpu_product = chipsetSubCatDetailById($cpu_id);
if($budget == $budgets[0]->amount){
$cpu_product_id = $cpu_product->product_id1;
}
elseif($budget == $budgets[1]->amount){
$cpu_product_id = $cpu_product->product_id2;
}
elseif($budget == $budgets[2]->amount){
$cpu_product_id = $cpu_product->product_id3;
}
elseif($budget == $budgets[3]->amount){
$cpu_product_id = $cpu_product->product_id4;
}

//return if empty cpu

if(empty($cpu_product_id)){
    // session()->flash('error_message','Products are missing.Try some time later');
    echo "<script>alert('".$error_return_message."');</script>";
    echo "<script>window.location.replace('".$error_return_url."');</script>";
    // header("Location: ".route('pcbuilder'));
    die;
}


$cpu_prod_variations = getProdvariationById($cpu_product_id);
$cpu_variation_id = (!empty($cpu_prod_variations[0])) ? $cpu_prod_variations[0]->id : '';
$cpu_color_id = (!empty($cpu_prod_variations[0])) ? $cpu_prod_variations[0]->color_id : '';

//gpu summary detail
if($chipset_id == 1){
$gpu_id = 4;
} elseif ($chipset_id == 2){ 
 $gpu_id = 12;
}
$gpu_product = chipsetSubCatDetailById($gpu_id);
                                
if($budget == $budgets[0]->amount){
$gpu_product_id = $gpu_product->product_id1;
}
elseif($budget == $budgets[1]->amount){
$gpu_product_id = $gpu_product->product_id2;
}
elseif($budget == $budgets[2]->amount){
$gpu_product_id = $gpu_product->product_id3;
 }
elseif($budget == $budgets[3]->amount){
$gpu_product_id = $gpu_product->product_id4;
}

//return if empty gpu

if(empty($gpu_product_id)){
    // session()->flash('error_message','Products are missing.Try some time later');
    echo "<script>alert('".$error_return_message."');</script>";
    echo "<script>window.location.replace('".$error_return_url."');</script>";
    // header("Location: ".route('pcbuilder'));
    die;
}

$gpu_prod_variations = getProdvariationById($gpu_product_id);
$gpu_variation_id = (!empty($gpu_prod_variations[0])) ? $gpu_prod_variations[0]->id : '';
$gpu_color_id = (!empty($gpu_prod_variations[0])) ? $gpu_prod_variations[0]->color_id : '';

//motherboard summary detail
if($chipset_id == 1){
$mthrboard_id = 3;
} elseif($chipset_id == 2){ 
$mthrboard_id = 11;
}
$mtherboard_product = chipsetSubCatDetailById($mthrboard_id);
                                
if($budget == $budgets[0]->amount){
$mtherboard_product_id = $mtherboard_product->product_id1;
}
elseif($budget == $budgets[1]->amount){
$mtherboard_product_id = $mtherboard_product->product_id2;
}
 elseif($budget == $budgets[2]->amount){
$mtherboard_product_id = $mtherboard_product->product_id3;
}
elseif($budget == $budgets[3]->amount){
$mtherboard_product_id = $mtherboard_product->product_id4;
}

//return if empty motherboard

if(empty($mtherboard_product_id)){
    // session()->flash('error_message','Products are missing.Try some time later');
    echo "<script>alert('".$error_return_message."');</script>";
    echo "<script>window.location.replace('".$error_return_url."');</script>";
    // header("Location: ".route('pcbuilder'));
    die;
}

$mtherboard_prod_variations = getProdvariationById($mtherboard_product_id);
$mtherboard_variation_id = (!empty($mtherboard_prod_variations[0])) ? $mtherboard_prod_variations[0]->id : '';
$mtherboard_color_id = (!empty($mtherboard_prod_variations[0])) ? $mtherboard_prod_variations[0]->color_id : '';

//ram summary detail
if($chipset_id == 1){
$ram_id = 7;
} elseif($chipset_id == 2){ 
$ram_id = 15;
} 
$ram_product = chipsetSubCatDetailById($ram_id);
                                
if($budget == $budgets[0]->amount){
$ram_product_id = $ram_product->product_id1;
}
elseif($budget == $budgets[1]->amount){
$ram_product_id = $ram_product->product_id2;
}
elseif($budget == $budgets[2]->amount){
$ram_product_id = $ram_product->product_id3;
}
elseif($budget == $budgets[3]->amount){
$ram_product_id = $ram_product->product_id4;
}

//return if empty ram

if(empty($ram_product_id)){
    // session()->flash('error_message','Products are missing.Try some time later');
    echo "<script>alert('".$error_return_message."');</script>";
    echo "<script>window.location.replace('".$error_return_url."');</script>";
    // header("Location: ".route('pcbuilder'));
    die;
}

//storage summary detail
if($chipset_id == 1){
$storage_id = 8;
} elseif($chipset_id == 2){ 
$storage_id = 16;
} 
$storage_product = chipsetSubCatDetailById($storage_id);
                                
if($budget == $budgets[0]->amount){
$storage_product_id = $storage_product->product_id1;
}
elseif($budget == $budgets[1]->amount){
$storage_product_id = $storage_product->product_id2;
}
elseif($budget == $budgets[2]->amount){
$storage_product_id = $storage_product->product_id3;
}
elseif($budget == $budgets[3]->amount){
$storage_product_id = $storage_product->product_id4;
}

//return if empty storage

if(empty($storage_product_id)){
    // session()->flash('error_message','Products are missing.Try some time later');
    echo "<script>alert('".$error_return_message."');</script>";
    echo "<script>window.location.replace('".$error_return_url."');</script>";
    // header("Location: ".route('pcbuilder'));
    die;
}

//cooling summary detail
if($chipset_id == 1){
$cooling_id = 2;
} elseif($chipset_id == 2){ 
$cooling_id = 10;
} 
 $cooling_product = chipsetSubCatDetailById($cooling_id);
                                
 if($budget == $budgets[0]->amount){
 $cooling_product_id = $cooling_product->product_id1;
  }
 elseif($budget == $budgets[1]->amount){
  $cooling_product_id = $cooling_product->product_id2;
  }
 elseif($budget == $budgets[2]->amount){
   $cooling_product_id = $cooling_product->product_id3;
  }
  elseif($budget == $budgets[3]->amount){
    $cooling_product_id = $cooling_product->product_id4;
  }
  
//return if empty cooling

if(empty($cooling_product_id)){
    // session()->flash('error_message','Products are missing.Try some time later');
    echo "<script>alert('".$error_return_message."');</script>";
    echo "<script>window.location.replace('".$error_return_url."');</script>";
    // header("Location: ".route('pcbuilder'));
    die;
}  
  
$cooling_prod_variations = getProdvariationById($cooling_product_id);
$cooling_variation_id = (!empty($cooling_prod_variations[0])) ? $cooling_prod_variations[0]->id : '';
$cooling_color_id = (!empty($cooling_prod_variations[0])) ? $cooling_prod_variations[0]->color_id : '';

  
  if($chipset_id == 1){
  $pwrsupply_id = 6;
} elseif($chipset_id == 2){ 
   $pwrsupply_id = 14;
  } 
 $supply_product = chipsetSubCatDetailById($pwrsupply_id);
                                
  if($budget == $budgets[0]->amount){
   $supply_product_id = $supply_product->product_id1;
 }
elseif($budget == $budgets[1]->amount){
  $supply_product_id = $supply_product->product_id2;
  }
 elseif($budget == $budgets[2]->amount){
  $supply_product_id = $supply_product->product_id3;
   }
 elseif($budget == $budgets[3]->amount){
   $supply_product_id = $supply_product->product_id4;
   }

//return if empty power supply

if(empty($supply_product_id)){
    // session()->flash('error_message','Products are missing.Try some time later');
    echo "<script>alert('".$error_return_message."');</script>";
    echo "<script>window.location.replace('".$error_return_url."');</script>";
    // header("Location: ".route('pcbuilder'));
    die;
}
   
$supply_prod_variations = getProdvariationById($supply_product_id);
$supply_variation_id = (!empty($supply_prod_variations[0])) ? $supply_prod_variations[0]->id : '';
$supply_color_id = (!empty($supply_prod_variations[0])) ? $supply_prod_variations[0]->color_id : '';
   
 $monitor_product_id = '';
 $software_product_id = '';
 $peripehral_product_id = '';
 $rgb_product_id = '';
 $extras_product_id = '';
 $services_product_id = '';
   
   $ram_qty = 1;
   $ssd_qty = 1;
   
   $categories = ProductCategory::findMany([14,16,17,18,19,20]);
   
   $first_cat_id = $categories[0]->id; 
                            
   $catgory_products = getProductsByCatId($first_cat_id);
   
   
   $addon_selected_product = '';
   
   $tab_type = 'Case';
   $addon_sub_cat = 'Monitor';
   
   $case_cart = '';
   $cooling_cart = '';
   $motherboard_cart = '';
   $gpu_cart = '';
   $cpu_cart = '';
   $pwrsupply_cart = '';
   $ram_cart = '';
   $storage_cart = '';
   $monitor_cart = '';
   $peripheral_cart = '';
   $rgb_cart = '';
   $extra_cart = '';
   $software_cart = '';
   $service_cart= '';
?>
<div class="pc_builder_preloader" style="display: none;" id="loader">
    <img src="<?=url('public/img/rolling-icon.svg')?>" >
    <input type="hidden" id="default_prod_id" value="<?=$default_prod_id?>">
</div>
    
<section class="checkout spad pc_buider_custom_area" id="pcbuild_main_div">
 <form method="" action="<?=route('add.cart',['id'=>rand()])?>">   
 @csrf
<?php include(resource_path().'/views/pc_builder_customize.blade.php'); ?>
</form>
</section>

@endsection
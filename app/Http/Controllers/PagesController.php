<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Contact;
use App\Models\Testimonials;
use App\Models\Chipset;
use App\Models\ChipsetGallery;
use App\Models\ChipsetSubCategory;
use App\Models\ProductCategory;
use App\Models\ProductCategoryRelationship;
use App\Models\ContactRequest;
use App\Models\PcBudget;
use App\Models\Store;
use Email;
use Validator;
use Session;
use Config;

class PagesController extends Controller
{
    public function about(){
        $about = About::find(1);
        $data = compact('about');
        return view('about',$data);
    }
    
    public function privacy_policy(){
        $about = About::find(2);
        $data = compact('about');
        return view('about',$data);
    }
    
    public function terms_and_conditions(){
        $about = About::find(3);
        $data = compact('about');
        return view('about',$data);
    }
    
    public function contact(Request $request){
        if($request->isMethod('POST'))	{
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            $message = $request->message;
            
            $validator = Validator::make($request->all(), [
                      'phone'   => 'numeric ',
                  ]);
                  
            if ($validator->fails())
		             {
		                return redirect()->back()->withErrors($validator)->withInput();
		              }

              $contact_request = new ContactRequest;
              $contact_request->name = $name;
              $contact_request->email = $email;
              $contact_request->phone = $phone;
              $contact_request->message = $message;
              $contact_request->save();
            
            //$MailToAdmin =  SiteSettingByName('site_email');
            $MailToAdmin = 'preeti.bvmsolution@gmail.com';
            $Maildata = array(
                            'mailTo'=>$MailToAdmin,
                            'name'=>$name,
                            'email' => $email,
                            'phone' => $phone,
                            'message'=>$message,
                            );
            $Mailcontroller = new SetMailController();
            /////////////////////////////////////////
            $Mailcontroller->ContactRequestEmail($Maildata);
            //////////////////////////////////////////
            return  redirect()->back()->with('alert-success','Thankyou your message has been sent.');
            
        }
        
        $contact = Contact::find(1);
        $data['contact'] = $contact;
        $data['states'] = Store::select("state")->where("status","Publish")->distinct()->pluck("state");
        $data['stores'] = Store::where("status","Publish")->get();
        return view('contact',$data);
    }
    
    public function testimonial(){
        $testimonial = Testimonials::where('status','=',1)->orderBy('id','DESC')->paginate(6);
        $data = compact('testimonial');
        return view('testimonial',$data);
    }
    
    public function pcbuilder(){
        $chipset = array();
        $chipset = Chipset::get();
        $budgets = PcBudget::get();
        $data = compact('chipset','budgets');
        return view('pc_builder',$data);
    }
    
    function changeChipPerformance(Request $request){
        if($request->ajax()){
            $chipset_id = $request->chipset_id;
            $performance_val = $request->performance_val;
            $chipset_fps1 = '';
            $chipset_fps2 = '';
            $response = array();
            
            if(!empty($request->new_budget) && $request->new_budget == 1500){
                $chipset_fps1500 = Chipset::where('id',$chipset_id)->select('fps9','fps10','fps11','fps12')->first(); 
            }
            
            if(!empty($request->new_budget) && $request->new_budget == 2000){
                $chipset_fps2000 = Chipset::where('id',$chipset_id)->select('fps13','fps14','fps15','fps16')->first(); 
            }
            
            if(!empty($request->new_budget) && $request->new_budget == 2500){
                $chipset_fps2500 = Chipset::where('id',$chipset_id)->select('fps17','fps18','fps19','fps20')->first(); 
            }
            
            if(!empty($request->new_budget) && $request->new_budget == 3000){
                $chipset_fps3000 = Chipset::where('id',$chipset_id)->select('fps21','fps22','fps23','fps24')->first(); 
            }
            
            if($performance_val == 1080){
               $chipset_fps1 = Chipset::where([
                ['id',$chipset_id],
                ['performance1',1080]
                ])->select('fps1','fps2','fps3','fps4')->first(); 
            }
            
            if($performance_val == 1440){
               
               $chipset_fps2 = Chipset::where([
                ['id',$chipset_id],
                ['performance2',1440]
                ])->select('fps5','fps6','fps7','fps8')->first(); 
            }
            
            if(!empty($chipset_fps1)){
               $response = array(
                   'fps1' => $chipset_fps1->fps1,
                   'fps2' => $chipset_fps1->fps2,
                   'fps3' => $chipset_fps1->fps3,
                   'fps4' => $chipset_fps1->fps4,
                   ) ;
            }
            
            if(!empty($chipset_fps2)){
               $response = array(
                   'fps1' => $chipset_fps2->fps5,
                   'fps2' => $chipset_fps2->fps6,
                   'fps3' => $chipset_fps2->fps7,
                   'fps4' => $chipset_fps2->fps8,
                   ) ;
            }
            
            if(!empty($chipset_fps1500)){
               $response = array(
                   'fps1' => $chipset_fps1500->fps9,
                   'fps2' => $chipset_fps1500->fps10,
                   'fps3' => $chipset_fps1500->fps11,
                   'fps4' => $chipset_fps1500->fps12,
                   ) ;
            }
            
            if(!empty($chipset_fps2000)){
               $response = array(
                   'fps1' => $chipset_fps2000->fps13,
                   'fps2' => $chipset_fps2000->fps14,
                   'fps3' => $chipset_fps2000->fps15,
                   'fps4' => $chipset_fps2000->fps16,
                   ) ;
            }
            
            if(!empty($chipset_fps2500)){
               $response = array(
                   'fps1' => $chipset_fps2500->fps17,
                   'fps2' => $chipset_fps2500->fps18,
                   'fps3' => $chipset_fps2500->fps19,
                   'fps4' => $chipset_fps2500->fps20,
                   ) ;
            }
            
            if(!empty($chipset_fps3000)){
               $response = array(
                   'fps1' => $chipset_fps3000->fps21,
                   'fps2' => $chipset_fps3000->fps22,
                   'fps3' => $chipset_fps3000->fps23,
                   'fps4' => $chipset_fps3000->fps24,
                   ) ;
            }
            
            //print_r($response);
            return json_encode($response);
        }
    }
    
    function continueBuild(Request $request, $randomNumber=null){
        if($request->isMethod('POST')){
            // dd($request->all());
            $res = array();
            $res = array(
                'budget' => $request->budget_val,
                'chipset_id' => $request->chipset,
                'performance' => $request->performance
                );
                
            session()->put('builder_data',$res);
            session()->forget('cooling_cart');
            session()->forget('motherboard_cart');
            session()->forget('gpu_cart');
            session()->forget('cpu_cart');
            session()->forget('pwrsupply_cart');
            session()->forget('ram_cart');
            session()->forget('storage_cart');
            session()->forget('monitor_cart');
            session()->forget('peripheral_cart');
            session()->forget('rgb_cart');
            session()->forget('extra_cart');
            session()->forget('software_cart');
            session()->forget('service_cart');
            
        }
        return view('build_pc') ;
    }
    
    function pcbuildTabChange(Request $request){
       $categories = ProductCategory::findMany([14,16,17,18,19,20]);
       $string = '';
       $add_on = $request->add_on;
       if($add_on == 'add_on'){
       foreach($categories as $cats){
       $string .= '<a class="select_cate " href="javascript:;">
                                   <div class="pc_img">
                                        <img src="'.url(Config::get('constants.SITE_PRODUCT_IMAGE').$cats->small_icon).'"/>
                                   </div>
                                   <div class="pc_conent">
                                        <h5>'.$cats->title.'</h5>
                                        <p></p>
                                   </div>
                                </a>';
       }
       }
       echo $string;
       //print_r($categories);
    }
    
    
    function pcbuildColorChange(Request $request){
       if($request->ajax()){
           $variation_id = $request->variation_id;
           $product_id = $request->product_id;
           $color_id = $request->color_id;
           $color_detail = clorDetailById($color_id);
           $single_image = '';
           $slider_html = '';
           
           $variation_images = getVariationImageById($variation_id);
           $single_image = '<img src="'.url(Config::get('constants.SITE_PRODUCT_IMAGE').$variation_images[0]->variation_image).'">';
           
           $slider_html .= '<div id="prod_galleryuyt'.$product_id.'" class="carousel slide pcs_custom">
                  <!-- Indicators -->
                <ul class="carousel-indicators">';
                $prod_gal_no = 0; 
                $active = '';
                foreach($variation_images as $varimages){ 
                    
                if($prod_gal_no == 0){
                $active = 'active';    
                }
                else{
                  $active = '';  
                }
                
                $slider_html .= '<li data-target="#prod_galleryuyt'.$product_id.'" data-slide-to="'.$prod_gal_no.'" class="'.$active.'"></li>';
              $prod_gal_no++; }
                  
               $slider_html .= '</ul> 
                
                <!-- The slideshow -->
                                  <div class="carousel-inner">';
                                      $prod_gal_noo = 0;
                                      $active_class = '';
                                     
                                    foreach($variation_images as $varimages){ 
                                        if($prod_gal_noo == 0){
                                            $active_class = 'active';
                                        }
                                        else{
                                            $active_class = '';
                                        }
                                $slider_html .= '<div class="carousel-item '.$active_class.'">
                                      <img src="'.url(Config::get('constants.SITE_PRODUCT_IMAGE').$varimages->variation_image).'" alt="">
                                    </div>';
                                    $prod_gal_noo++; 
                                    } 
    
                                $slider_html .= '</div>
                                  
                  </div>';
           
           $collectArray = array(
                               'status'=>'single_image', 
                               'single_img_html' => $single_image,
                               'slider_html' => $slider_html,
                               'color_name' => $color_detail[0]->color_name,
                             );
            return json_encode($collectArray);
       } 
    }
    
    function pcbuildAddonColorChange(Request $request){
       if($request->ajax()){
           $variation_id = $request->variation_id;
           $product_id = $request->product_id;
           $color_id = $request->color_id;
           $color_detail = clorDetailById($color_id);
           $single_image = '';
           $slider_html = '';
           
           $variation_images = getVariationImageById($variation_id);
           $single_image = '<img src="'.url(Config::get('constants.SITE_PRODUCT_IMAGE').$variation_images[0]->variation_image).'">';
           
           $slider_html .= '<div id="addon_prod_gallery'.$product_id.'" class="carousel slide pcs_custom">
                  <!-- Indicators -->
                <ul class="carousel-indicators">';
                $prod_gal_no = 0; 
                $active = '';
                foreach($variation_images as $varimages){ 
                    
                if($prod_gal_no == 0){
                $active = 'active';    
                }
                else{
                  $active = '';  
                }
                
                $slider_html .= '<li data-target="#addon_prod_gallery'.$product_id.'" data-slide-to="'.$prod_gal_no.'" class="'.$active.'"></li>';
              $prod_gal_no++; }
                  
               $slider_html .= '</ul> 
                
                <!-- The slideshow -->
                                  <div class="carousel-inner">';
                                      $prod_gal_noo = 0;
                                      $active_class = '';
                                     
                                    foreach($variation_images as $varimages){ 
                                        if($prod_gal_noo == 0){
                                            $active_class = 'active';
                                        }
                                        else{
                                            $active_class = '';
                                        }
                                $slider_html .= '<div class="carousel-item '.$active_class.'">
                                      <img src="'.url(Config::get('constants.SITE_PRODUCT_IMAGE').$varimages->variation_image).'" alt="">
                                    </div>';
                                    $prod_gal_noo++; 
                                    } 
    
                                $slider_html .= '</div>
                                  
                  </div>';
           
           $collectArray = array(
                               'status'=>'single_image', 
                               'single_img_html' => $single_image,
                               'slider_html' => $slider_html,
                               'color_name' => $color_detail[0]->color_name,
                             );
            return json_encode($collectArray);
       } 
    }
    
    
    
function pcbuildCapacityChange(Request $request){
    if($request->ajax()){
        $term_name = '';
        $term_id = $request->term_id;
        $product_id = $request->product_id;
        $type = $request->type;
        
        if($type == 'ram'){
            $term_name = termRamNameById($term_id)->title;
        }
        elseif($type = 'ssd'){
          $term_name = termSSDNameById($term_id)->title;  
        }
        return $term_name;
    }
}
    
    
function pcbuildAddonCatChange(Request $request){
    if($request->ajax()){
        $cat_id = $request->cat_id;
        $cat_detail = getcatdetailByID($cat_id);
        $cat_name = $request->name;
        
        $cat_products = ProductCategoryRelationship::where('category_id',$cat_id)->get();
        $addon_selected_product = '';
        
        if($cat_name == 'Monitor'){
            if(session()->has('monitor_cart')){
            $addon_cart = session()->get('monitor_cart');
            $addon_selected_product = $addon_cart[$cat_id]['product_id'];
            }
        }
        if($cat_name == 'Peripherals'){
            if(session()->has('peripheral_cart')){
            $addon_cart = session()->get('peripheral_cart');
            $addon_selected_product = $addon_cart[$cat_id]['product_id'];
            }
        }
        if($cat_name == 'RGB Lighting'){
            if(session()->has('rgb_cart')){
            $addon_cart = session()->get('rgb_cart');
            $addon_selected_product = $addon_cart[$cat_id]['product_id'];
            }
        }
        if($cat_name == 'Extras'){
            if(session()->has('extra_cart')){
            $addon_cart = session()->get('extra_cart');
            $addon_selected_product = $addon_cart[$cat_id]['product_id'];
            }
        }
        if($cat_name == 'Software'){
            if(session()->has('software_cart')){
            $addon_cart = session()->get('software_cart');
            $addon_selected_product = $addon_cart[$cat_id]['product_id'];
            }
        }
        if($cat_name == 'Services'){
            if(session()->has('service_cart')){
            $addon_cart = session()->get('service_cart');
            $addon_selected_product = $addon_cart[$cat_id]['product_id'];
            }
        }
        
        if($cat_products->count() > 0){
        foreach($cat_products as $prod){ 
            $prodID = $prod->product_id;
            $cat_prod_detail = productDetailById($prodID);
            $cat_prod_variations = getProdvariationById($prodID);
            $variation_imagess = getVariationImageById($cat_prod_variations[0]->id ?? '');
            if(!empty($cat_prod_detail)){
                if($cat_prod_detail->product_type=='pcbuilder'){

                
        ?>
        
        <div class="product_box <?php if($addon_selected_product == $prodID) echo 'added_product_box'; ?>">
                                
            <div class="whole_product_box">
                <div class="img_title_block">
                <div class="img_title" id="addon_prod_single_img<?=$prodID?>">
                    <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$cat_prod_detail->image ?? '')?>">
                </div>
                                        <div class="title_p">
                                            <h6><?=$cat_prod_detail->title?></h6>
                                            <!--<p>Mid-Tower</p>-->
                                        </div>    
                                    </div>
                                    <?php if($cat_prod_variations->count() > 0){
                                     $color_idd = $cat_prod_variations[0]->color_id; 
                                    $clr_no = 0;?>
                                    <div class="product_color_box">
                                        <strong>Color: </strong> <span id="addon_selected_color_name<?=$prodID?>"><?=clorDetailById($color_idd)[0]->color_name?></span>
                                        <div class="product__details__option__color">
                                            <?php foreach($cat_prod_variations as $clr_var){
                                             $colorr_detail = clorDetailById($clr_var->color_id); ?>
                                           <label class="color_label <?php if($clr_no == 0) echo 'active'; ?>" for="" style="background: <?=$colorr_detail[0]->color_code?>;" title="<?=$colorr_detail[0]->color_name?>">
                                            <input type="radio" id="addon_change_color" name="addon_color_variation" value="<?=$clr_var->id?>" data-color="<?=$clr_var->color_id?>" data-product_id="<?=$prodID?>" <?php if($clr_no == 0) echo 'checked' ; ?> >
                                           </label>
                                           <?php $clr_no++; 
                                           } ?>
                                           
                                                                                    
                                        </div>
                                    </div>
                                    <?php } 
                                    if($cat_name == 'Monitor'){ ?>
                                    <div class="product_qty_box form-group">
                                        <label>QTY:</label>
                                        <select name="qty" id="qty<?=$prodID?>" class="form-control">
                                            <?php for($qty = 1; $qty<=3; $qty++){ ?>
                                            <option value="<?=$qty?>"><?=$qty?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php } ?>
                                    <div class="pc_product_with_strike">
                                        <?php if(!empty($cat_prod_detail->sale_price)){ ?>
                                        <div class="strike_price">NPR <?=number_format($cat_prod_detail->price)?></div>
                                        <div class="regular_price">NPR <?=number_format($cat_prod_detail->sale_price,2)?></div>
                                        <?php } else{ ?>
                                        <div class="regular_price">NPR <?=number_format($cat_prod_detail->price,2)?></div>
                                        <?php } ?>
                                    </div>
                                    <div class="info_added_box">
                                        <a class="buttons_info" href="javascript:;" data-toggle="modal" data-target="#addon_info_model<?=$prodID?>">Info</a>
                                        <?php if($addon_selected_product == $prodID){ 
                                        if($cat_name == 'Monitor' || $cat_name == 'Peripherals' || $cat_name == 'RGB Lighting' || $cat_name == 'Extras'){?>
                                        <!--<button type="button" class="btn btn-danger pc_builder_delete buttons_info" id="delete_pc_product" data-type="<?=$cat_name?>">-->
                                        <!--<i class="fa fa-trash" aria-hidden="true"></i></button>-->
                                        <?php } ?>
                                        <span class="added_product_p" id="case_added_p" data-added_product="<?=$prodID?>">Added</span>
                                        <?php } else{ ?>
                                        <button class="buttons_info" type="button" id="add_product_addon" data-product="<?=$prodID?>" data-cat_id="<?=$cat_id?>" data-cat_type="<?=$cat_name?>">Add</button>
                                        <?php } ?>
                                    </div>    
                                </div>    
                            </div>
                            
<!--Model Area-->
<div class="modal black_popup" id="addon_info_model<?=$prodID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
          <div class="prod_slider_area" id="addon_prod_slider_area<?=$prodID?>">
              <div id="addon_prod_gallery<?=$prodID?>" class="carousel slide pcs_custom">
                  <!-- Indicators -->
                <ul class="carousel-indicators">
                <?php $prod_gal_noo = 0; 
                $addon_prod_gallery = prodGalleryimagesById($prodID);
                if($cat_prod_variations->count() > 0){ 
                foreach($variation_imagess as $varimagess){ ?>
                
                <li data-target="#adon_prod_gallery<?=$prodID?>" data-slide-to="<?=$prod_gal_noo?>" class=" <?php if($prod_gal_noo == 0) echo 'active'; ?>"></li>
                <?php $prod_gal_noo++; 
                } } elseif($addon_prod_gallery->count() > 0){ 
                foreach(prodGalleryimagesById($prodID) as $galleryy){
                ?>
                <li data-target="#adon_prod_gallery<?=$prodID?>" data-slide-to="<?=$prod_gal_noo?>" class=" <?php if($prod_gal_noo == 0) echo 'active'; ?>"></li>
                <?php } } else{ ?>
                <li data-target="#adon_prod_gallery<?=$prodID?>" data-slide-to="0" class="active"></li>
                <?php } ?>
                  
                </ul> 
                
                <!-- The slideshow -->
                                  <div class="carousel-inner">
                                      
                                    <?php $prod_gal_noo2 = 0;
                                    if($cat_prod_variations->count() > 0){ 
                                    foreach($variation_imagess as $varimagess){ ?>
                                    <div class="carousel-item <?php if($prod_gal_noo2 == 0) echo 'active'; ?>">
                                      <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$varimagess->variation_image)?>" alt="">
                                    </div>
                                    <?php $prod_gal_noo2++; 
                                    } }
                                    elseif($addon_prod_gallery->count() > 0){
                                        foreach(prodGalleryimagesById($prodID) as $galleryy){
                                    ?>
                                    <div class="carousel-item <?php if($prod_gal_noo2 == 0) echo 'active'; ?>">
                                      <img src="<?=url(Config::get('constants.PRODUCT_IMAGE_PATH').$galleryy->image)?>" alt="">
                                    </div>
                                    <?php } } else{ ?>
                                    <div class="carousel-item active">
                                      <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$cat_prod_detail->image)?>" alt="">
                                    </div>
                                    <?php } ?>
                                  </div>
                                  
                
                  </div>
          </div>        
        <div class="prod_content_area">
            <h2><?=$cat_prod_detail->title ?? ''?></h2>
            <div class="prod_short_description">
                <?=$cat_prod_detail->short_description ?? ''?>
            </div>
            <div class="prod_features_ul">
                <?=$cat_prod_detail->features ?? ''?>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
            
        <?php } }
            }?>
<script>
$(document).ready(function(){
$("select").niceSelect();
$('.carousel').carousel()

$("div #add_product_addon").click(function(){
    var product_id = $(this).data('product');
    var cat_id = $(this).data('cat_id');
    var cat_type = $(this).data('cat_type');
    var variation_id = $("#addon_change_color").val();
    var qty = $("#qty"+product_id).val();
    $(this).attr('disabled','disabled')
    $(this).addClass('added_product_p').text('Added')
    
    var case_price = $("#case_price").val();
    var cpu_price = $("#cpu_price").val();
    var gpu_price = $("#gpu_price").val();
    var mothrboard_price = $("#mothrboard_price").val()
    var ram_price = $("#ram_price").val()
    var storage_price = $("#storage_price").val()
    var cooling_price = $("#cooling_price").val()
    var pwrsupply_price = $("#pwrsupply_price").val()
    var software_price = $("#software_price").val()
    var service_price = $("#service_price").val()
    var monitor_price = $("#monitor_price").val()
    var peripheral_price = $("#peripheral_price").val()
    var rgb_price = $("#rgb_price").val()
    var extra_price = $("#extra_price").val()
    
    $('.product_box').removeClass('added_product_box')
    $(this).parents('.product_box').addClass('added_product_box')
    
     $("#loader").show();
    $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
           		 
    $.ajax({
			url: SITE_URL+'/ajax/pc_addon_product_add',
			type: 'POST',
            dataType:'json',
			data : {product_id:product_id, cat_id:cat_id, cat_type:cat_type, variation_id:variation_id, qty:qty,
			    case_price:case_price, cpu_price:cpu_price, gpu_price:gpu_price, mothrboard_price:mothrboard_price, 
			    ram_price:ram_price, storage_price:storage_price, cooling_price:cooling_price, pwrsupply_price:pwrsupply_price, 
			    software_price:software_price, service_price:service_price, monitor_price:monitor_price, peripheral_price:peripheral_price, 
			    rgb_price:rgb_price, extra_price:extra_price
			},
			success : function(data) {
			    $("#loader").hide();
			   console.log(data.summary_html);
			 if(cat_type=='Monitor'){
			     $(".moniter_summary_box").html(data.summary_html)
			 }
			 if(cat_type=='Peripherals'){
			     $(".peripheral_summary_box").html(data.summary_html)
			 }
			 if(cat_type=='RGB Lighting'){
			     $(".rgb_summary_box").html(data.summary_html)
			 }
			 if(cat_type=='Extras'){
			     $(".extra_summary_box").html(data.summary_html)
			 }
			 if(cat_type=='Software'){
			     $(".software_summary_box").html(data.summary_html)
			 }
			 if(cat_type=='Services'){
			     $(".service_summary_box").html(data.summary_html)
			 }
			 
			 $(".total_amount").text(data.total_amount.toLocaleString())
			  
				},
			
		});
});

$("div #addon_change_color").click(function(){
        
        var variation_id = $(this).val();
        var color_id = $(this).data('color');
        var product_id = $(this).data('product_id');
        
        $('.color_label').removeClass('active');
        $(this).parent().addClass('active')
        $("#loader").show();
        
        $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
           		 
        $.ajax({
			url: SITE_URL+'/ajax/pc_addon_color_change',
			type: 'POST',
            dataType:'json',
			data : {variation_id:variation_id, color_id:color_id, product_id:product_id},
			success : function(data) {
			    $("#loader").hide();
			   //console.log(data);
			  if(data.status == 'single_image'){
			      $("#addon_prod_single_img"+product_id).html(data.single_img_html)
			      $("#addon_prod_slider_area"+product_id).html(data.slider_html)
			      $("#addon_selected_color_name"+product_id).text(data.color_name);
			  }
				},
			
		});
    });
    
})
</script>
        <?php }
        else{ ?>
            <h4 style="color: #e53637;">No Items Found!</h4>
        <?php }
    }
}

function pcbuildAddonProductAdd(Request $request){
    if($request->ajax()){
        $product_id = $request->product_id;
        $cat_id = $request->cat_id;
        $cat_type = $request->cat_type;
        $variation_id = $request->variation_id;
        $qty = $request->qty;
        
        $product_detail = productDetailById($product_id);
        $summary_html = '';
        //print_r($product_detail);
        
        $monitor_price = 0;
$peripheral_price = 0;
$rgb_price = 0;
$extra_price = 0;
$software_price = 0;
$service_price = 0;
        
        if($cat_type == 'Monitor'){
            $monitor_cart = session()->get('monitor_cart');
            
            if(!empty($product_id)){
                $monitor_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => $qty,
                        "price" => $product_detail->sale_price ? $product_detail->sale_price*$qty : $product_detail->price*$qty,
                        "image" => $product_detail->image,
                        "variation_id" => $variation_id,
                        "color_id" => '',
                    ]
            ];
            
            session()->put('monitor_cart', $monitor_cart); 
             $price = $product_detail->sale_price ? $product_detail->sale_price : $product_detail->price;
                            $summary_html .= '<input type="hidden" name="monitor_id" id="monitor_id" value="'.$cat_id.'">
                            <input type="hidden" name="monitor_product_id" id="monitor_product_id" value="'.$product_id.'">
                            <input type="hidden" name="monitor_qty" id="monitor_qty" value="'.$qty.'">
                            <div class="col-lg-7">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">'.$qty.'</span>
                                </div>
                                <div class="col-lg-3">';
                                 if(!empty($product_detail->sale_price)){
                                    //$price = $product_detail->sale_price*$qty; 
                                    $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price*$qty,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price*$qty,2).'</span>';
                                     } else{ 
                                    //$price = $product_detail->price*$qty; 
                                    $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price*$qty,2).'</span>';
                                     } 
                                $summary_html .= ' <input type="hidden" name="monitor_price" id="monitor_price" value="'.$price.'">
                                </div>';
                                
                $monitor_price = $price;
                            
            }
          
        }
        
        if($cat_type == 'Peripherals'){
            $peripheral_cart = session()->get('peripheral_cart');
            
            if(!empty($product_id)){
                $peripheral_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => $qty,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $variation_id,
                        "color_id" => '',
                    ]
            ];
            
            session()->put('peripheral_cart', $peripheral_cart); 
            
            $summary_html .= '<input type="hidden" name="peripheral_id" id="peripheral_id" value="'.$cat_id.'">
                            <input type="hidden" name="peripheral_product_id" id="peripheral_product_id" value="'.$product_id.'">
            <div class="col-lg-7">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">';
                                 if(!empty($product_detail->sale_price)){
                                    $price = $product_detail->sale_price; 
                                    $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price,2).'</span>';
                                     } else{ 
                                    $price = $product_detail->price; 
                                    $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price,2).'</span>';
                                     } 
                                $summary_html .= '<input type="hidden" name="peripheral_price" id="peripheral_price" value="'.$price.'">
                                </div>';
            
            $peripheral_price = $price;
            
            
             }
        }
        
        if($cat_type == 'RGB Lighting'){
            $rgb_cart = session()->get('rgb_cart');
            
            if(!empty($product_id)){
                $rgb_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => $qty,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $variation_id,
                        "color_id" => '',
                    ]
            ];
            
            session()->put('rgb_cart', $rgb_cart); 
            
            $summary_html .= '<input type="hidden" name="rgb_id" id="rgb_id" value="'.$cat_id.'">
                            <input type="hidden" name="rgb_product_id" id="rgb_product_id" value="'.$product_id.'">
            <div class="col-lg-7">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">';
                                 if(!empty($product_detail->sale_price)){
                                    $price = $product_detail->sale_price; 
                                    $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price,2).'</span>';
                                     } else{ 
                                    $price = $product_detail->price; 
                                    $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price,2).'</span>';
                                     } 
                                $summary_html .= '<input type="hidden" name="rgb_price" id="rgb_price" value="'.$price.'">
                                </div>';
                                $rgb_price = $price;
             }
        }
        
        if($cat_type == 'Extras'){
            $extra_cart = session()->get('extra_cart');
            
            if(!empty($product_id)){
                $extra_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => $qty,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $variation_id,
                        "color_id" => '',
                    ]
            ];
            
            session()->put('extra_cart', $extra_cart); 
            
            $summary_html .= '<input type="hidden" name="extra_id" id="extra_id" value="'.$cat_id.'">
                            <input type="hidden" name="extra_product_id" id="extra_product_id" value="'.$product_id.'">
            <div class="col-lg-7">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">';
                                 if(!empty($product_detail->sale_price)){
                                    $price = $product_detail->sale_price; 
                                    $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price,2).'</span>';
                                     } else{ 
                                    $price = $product_detail->price; 
                                    $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price,2).'</span>';
                                     } 
                                $summary_html .= '<input type="hidden" name="extra_price" id="extra_price" value="'.$price.'">
                                </div>';
                        $extra_price = $price;
             }
        }
        
        if($cat_type == 'Software'){
            $software_cart = session()->get('software_cart');
            
            if(!empty($product_id)){
                $software_cart = [
                    $cat_id => [ 
                        "product_id" => $product_id,
                        "quantity" => $qty,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $variation_id,
                        "color_id" => '',
                    ]
            ];
            
            session()->put('software_cart', $software_cart); 
            
            $summary_html .= '<input type="hidden" name="software_id" id="software_id" value="'.$cat_id.'">
                            <input type="hidden" name="software_product_id" id="software_product_id" value="'.$product_id.'">
            <div class="col-lg-7">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">';
                                 if(!empty($product_detail->sale_price)){
                                    $price = $product_detail->sale_price; 
                                    $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price,2).'</span>';
                                     } else{ 
                                    $price = $product_detail->price; 
                                    $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price,2).'</span>';
                                     } 
                                $summary_html .= '<input type="hidden" name="software_price" id="software_price" value="'.$price.'">
                                </div>';
                                
                    $software_price = $price;
            }
        }
        
        if($cat_type == 'Services'){
            $service_cart = session()->get('service_cart');
            
            
            if(!empty($product_id)){
                $service_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => $qty,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $variation_id,
                        "color_id" => '',
                    ]
            ];
            
            session()->put('service_cart', $service_cart); 
            
            $summary_html .= '<input type="hidden" name="service_id" id="service_id" value="'.$cat_id.'">
                            <input type="hidden" name="service_product_id" id="service_product_id" value="'.$product_id.'">
            <div class="col-lg-7">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">';
                                 if(!empty($product_detail->sale_price)){
                                    $price = $product_detail->sale_price; 
                                    $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price,2).'</span>';
                                     } else{ 
                                    $price = $product_detail->price; 
                                    $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price,2).'</span>';
                                     } 
                                $summary_html .= '<input type="hidden" name="service_price" id="service_price" value="'.$price.'">
                                </div>';
                                
                    $service_price = $price;
             }
        }
        
        $monitor_price = (!empty($request->monitor_price)) ? $request->monitor_price : $monitor_price;
$peripheral_price = (!empty($request->peripheral_price)) ? $request->peripheral_price : $peripheral_price;
$rgb_price = (!empty($request->rgb_price)) ? $request->rgb_price : $rgb_price;
$extra_price = (!empty($request->extra_price)) ? $request->extra_price : $extra_price;
$software_price = (!empty($request->software_price)) ? $request->software_price : $software_price;
$service_price = (!empty($request->service_price)) ? $request->service_price : $service_price;
        
        $total_amount = $request->case_price+$request->cpu_price+$request->gpu_price+$request->mothrboard_price+$request->ram_price+
        $request->storage_price+$request->cooling_price+$request->pwrsupply_price+$software_price+$service_price+
        $monitor_price+$peripheral_price+$rgb_price+$extra_price;
        
        $collectarray = array('summary_html' => $summary_html, 'total_amount' => $total_amount);
        return json_encode($collectarray);
        
    }
}

function pcbuildChipCatChange(Request $request){
   if($request->ajax()){
       $chip_cat_id = $request->cat_id;
       $added_prod_id = $request->added_prod_id;
       $default_prod_id= $request->default_prod_id;
       $type = $request->type;
       
       $chip_cat_products = chipSubcatproductsById($chip_cat_id);
       
       if($type == 'Case'){
       if(session()->has('case_cart')){
           $case_cart = session()->get('case_cart');
    $added_prod_id = $case_cart[$chip_cat_id]['product_id'];
       }
       }
       elseif($type == 'Cooling'){
       if(session()->has('cooling_cart')){
           $cooling_cart = session()->get('cooling_cart');
    $added_prod_id = $cooling_cart[$chip_cat_id]['product_id'];
       }
       }
       elseif($type == 'Motherboards'){
       if(session()->has('motherboard_cart')){
           $mthrboard_cart = session()->get('motherboard_cart');
    $added_prod_id = $mthrboard_cart[$chip_cat_id]['product_id'];
       }
       }
       elseif($type == 'GPU'){
       if(session()->has('gpu_cart')){
           $gpu_cart = session()->get('gpu_cart');
    $added_prod_id = $gpu_cart[$chip_cat_id]['product_id'];
       }
       }
      elseif($type == 'CPU'){
       if(session()->has('cpu_cart')){
           $cpu_cart = session()->get('cpu_cart');
    $added_prod_id = $cpu_cart[$chip_cat_id]['product_id'];
       }
       }
       elseif($type == 'Power Supplies'){
       if(session()->has('pwrsupply_cart')){
           $pwr_cart = session()->get('pwrsupply_cart');
    $added_prod_id = $pwr_cart[$chip_cat_id]['product_id'];
       }
       }
       elseif($type == 'RAM'){
       if(session()->has('ram_cart')){
           $ram_cart = session()->get('ram_cart');
    $added_prod_id = $ram_cart[$chip_cat_id]['product_id'];
       }
       }
      elseif($type == 'Storage'){
           if(session()->has('storage_cart')){
               $storage_cart = session()->get('storage_cart');
                $added_prod_id = $storage_cart[$chip_cat_id]['product_id'];
           }
       }
    //   echo '<pre>'.print_r($chip_cat_products);
       foreach($chip_cat_products as $chipcatprod){
            $prod_id = $chipcatprod->product_id;
            $prod_detail = productDetailById($prod_id); 
            $prod_variations = getProdvariationById($prod_id);
            $prod_image = $prod_detail->image ?? ''; 

            if(!empty($prod_detail)){ 
                if($prod_detail->product_type == 'pcbuilder'){
            ?>
            
            <div class="product_box tret <?php if($added_prod_id == $prod_id) echo 'added_product_box'; ?>">
                                <!--<div class="main_tag_product">Sale</div>-->
                                <div class="whole_product_box">
                                    <div class="img_title_block">
                                        <div class="img_title" id="prod_single_img<?=$prod_id?>">
                                        <?php if($prod_variations->count() > 0){
                                            $variation_images = getVariationImageById($prod_variations[0]->id);
                                            $var_first_img = (!empty($variation_images[0])) ? $variation_images[0]->variation_image : ''; 
                                            if(!empty($var_first_img)){
                                        ?>
                                            <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$var_first_img)?>">
                                        <?php } } else{ ?>
                                        <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_image ?? '')?>">
                                        <?php } ?>
                                        </div>
                                        <div class="title_p">
                                            <h6><?=$prod_detail->title ?? ''?></h6>
                                            <!--<p>Mid-Tower</p>-->
                                        </div>    
                                    </div>
                                    <?php if($prod_variations->count() > 0){
                                            $color_id = $prod_variations[0]->color_id;
                                            //$color_detail = clorDetailById($color_id);
                                            $var_no = 0;
                                        ?>
                                    <div class="product_color_box">
                                        <strong>Color: </strong> <span id="selected_color_name<?=$prod_id?>"><?=(!empty(clorDetailById($color_id)[0])) ? clorDetailById($color_id)[0]->color_name : ''?></span>
                                        <div class="product__details__option__color">
                                            
                                            <?php foreach($prod_variations as $prodvariation){
                                            $color_detail = clorDetailById($prodvariation->color_id); ?>
                                           <label class="color_label <?php if($var_no == 0) echo 'active'; ?>"  style="background: <?=(!empty($color_detail[0])) ? $color_detail[0]->color_code : ''?>;" title="<?=(!empty($color_detail[0])) ? $color_detail[0]->color_name : ''?>">
                                            <input type="radio" id="change_color" name="change_color<?=$prod_id?>" value="<?=$prodvariation->id?>" data-color="<?=$prodvariation->color_id?>" data-product_id="<?=$prod_id?>" <?php if($var_no == 0) echo 'checked'; ?> >
                                           </label>
                                           <?php $var_no++; 
                                           }?>
                                           
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="pc_product_with_strike">
                                        <?php if(!empty($prod_detail->sale_price)){ ?>
                                        <div class="strike_price">NPR <?=number_format($prod_detail->price)?></div>
                                        <div class="regular_price">NPR <?=number_format($prod_detail->sale_price)?></div>
                                        <?php } ?>
                                        
                                        <?php if(empty($prod_detail->sale_price)){ ?>
                                        <div class="regular_price">NPR <?=number_format($prod_detail->price ?? '0')?></div>
                                        <?php } ?>
                                    </div>
                                    <div class="info_added_box"> 
                                    <?php if($type != 'RAM' && $type != 'Storage' ){ ?>
                                    <div class="info_btn_div">
                                        <a class="buttons_info" href="javascript:;" data-toggle="modal" data-target="#info_model<?=$prod_id?>">Info</a>
                                    </div>
                                    
                                        
                                <?php if($added_prod_id == $prod_id){ ?>
                                 
                                        <button class="buttons_info prod_add_btn added_product_p add_product<?=$prod_id?>" id="add_product" data-cat_id="<?=$chip_cat_id?>" data-product="<?=$prod_id?>" data-cat_type="<?=$type?>" type="button" disabled>Added</button>
                                        
                                        <?php } else{ ?>
                                        <button class="buttons_info prod_add_btn add_product<?=$prod_id?>" id="add_product" data-cat_id="<?=$chip_cat_id?>" data-product="<?=$prod_id?>" data-cat_type="<?=$type?>" type="button">Add</button>
                                        <?php } 
                                        }
                                        if($type == 'RAM' || $type == 'Storage'){ 
                                        if($added_prod_id == $prod_id){?>
                                        <a class="buttons_info options_info_btn edit_pc_btn" href="javascript:;" data-toggle="modal" data-target="#info_model<?=$prod_id?>">Edit</a>
                                        <?php } else{ ?>
                                        <a class="buttons_info options_info_btn" href="javascript:;" data-toggle="modal" data-target="#info_model<?=$prod_id?>">Options & Info</a>
                                        <?php } }?>
                                        
                                    </div>    
                                </div>    
                            </div>
                            
        <!-- Info Popup -->
<div class="modal black_popup" id="info_model<?=$prod_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
          <div class="prod_slider_area" id="prod_slider_area<?=$prod_id?>">
              <?php if($type != 'RAM' && $type != 'Storage'){ ?>
              <div id="prod_gallery<?=$prod_id?>" class="carousel slide pcs_custom">
                  <!-- Indicators -->
                <ul class="carousel-indicators">
               
                <?php $prod_gal_no = 0;
                if($prod_variations->count() > 0){ 
                foreach($variation_images as $varimages){ ?>
                
                <li data-target="#prod_gallery<?=$prod_id?>" data-slide-to="<?=$prod_gal_no?>" class=" <?php if($prod_gal_no == 0) echo 'active'; ?>"></li>
                <?php $prod_gal_no++; 
                } } else{ 
                foreach(prodGalleryimagesById($prod_id) as $gallery){
                ?>
                <li data-target="#prod_gallery<?=$prod_id?>" data-slide-to="<?=$prod_gal_no?>" class=" <?php if($prod_gal_no == 0) echo 'active'; ?>"></li>
                <?php } }?>
                  
                </ul> 
                
                <!-- The slideshow -->
                                  <div class="carousel-inner">
                                      
                                    <?php $prod_gal_noo = 0;
                                    if($prod_variations->count() > 0){ 
                                    foreach($variation_images as $varimages){ ?>
                                    <div class="carousel-item <?php if($prod_gal_noo == 0) echo 'active'; ?>">
                                      <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$varimages->variation_image)?>" alt="Los Angeles">
                                    </div>
                                    <?php $prod_gal_noo++; 
                                    } }
                                    else{
                                        foreach(prodGalleryimagesById($prod_id) as $gallery){
                                    ?>
                                    <div class="carousel-item <?php if($prod_gal_noo == 0) echo 'active'; ?>">
                                      <img src="<?=url(Config::get('constants.PRODUCT_IMAGE_PATH').$gallery->image)?>" alt="">
                                    </div>
                                    <?php } } ?>
                                  </div>
                                  
                
                  </div>
                  <?php } if($type == 'RAM'){ 
                  $terms = getTermsByTypeandProductId($prod_id,'ram');
              $first_term = $terms[0]->term_id ?? ''; ?>
              <div class="row">
                  <div class="col-md-5">
                      <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image ?? '')?>">
                  </div>
                  <div class="col-md-7">
                      <div class="prod_content_area">
                      <h2><?=$prod_detail->title ?? ''?></h2>
                      </div>
                      <div class="capacity_box">
                          <div class="">
                              <span><b>Capacity:</b> <span id="selected_capacity_name<?=$prod_id?>"><?=termRamNameById($first_term)->title ?? ''?></span></span>
                              </div>
                         <?php if($terms->count() > 0){ ?>
                         <ul>
                             <?php $capacity_no = 0;
                             foreach($terms as $term){ 
                             $term_id = $term->term_id; 
                             $term_detail = termRamNameById($term_id); ?>
                             <li>
                                 <button type="button" data-type="ram" class="btn btn-primary capacity_btn <?php if($capacity_no == 0) echo 'active'; ?>" value="<?=$term_id?>" id="capacity" data-product=<?=$prod_id?> ><?=$term_detail->title?></button></li>
                             <?php $capacity_no++; } ?>
                         </ul>
                         <input type="hidden" name="ram_capacity_val" id="ram_capacity_val" value="<?=$first_term?>">
                         <?php } ?>
                      </div>
                      <div class="pcbuild_qty_box">
                          <span>QTY</span>
                          <select name="qty" id="qty<?=$prod_id?>" class="form-control">
                              <?php for($qty=1; $qty <= 3; $qty++){ ?>
                              <option value="<?=$qty?>"><?=$qty?></option>
                              <?php } ?>
                          </select>
                      </div>
                      <button type="button" class="btn btn-primary btn-lg" id="add_product" data-product="<?=$prod_id?>" data-cat_id="<?=$chip_cat_id?>" data-cat_type="<?=$type?>">Add</button>
                  </div>
              </div>
              <?php } 
              if($type == 'Storage'){ 
              $terms = getTermsByTypeandProductId($prod_id,'ssd');
              
              $first_term = $terms[0]->term_id ?? '';  ?>
              <div class="row">
                  <div class="col-md-5">
                      <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image ?? '')?>">
                  </div>
                  <div class="col-md-7">
                      <div class="prod_content_area">
                      <h2><?=$prod_detail->title ?? ''?></h2>
                      </div>
                      <div class="capacity_box">
                          <div class="">
                          <span><b>Capacity:</b> <span id="selected_capacity_name<?=$prod_id?>"><?=termSSDNameById($first_term)->title ?? ''?></span></span>
                         </div>
                         <?php if($terms->count() > 0){ ?>
                         <ul>
                             <?php $capacity_no = 0;
                             foreach($terms as $term){ 
                             $term_id = $term->term_id; 
                             $term_detail = termSSDNameById($term_id); ?>
                            <li>
                                <button type="button" data-type="ssd" class="btn btn-primary capacity_btn <?php if($capacity_no == 0) echo 'active'; ?>" value="<?=$term_id?>" id="capacity" data-product=<?=$prod_id?> ><?=$term_detail->title?></button>
                            </li>
                             <?php $capacity_no++; } ?>
                         </ul>
                         <input type="hidden" name="ssd_capacity_val" id="ssd_capacity_val" value="<?=termSSDNameById($first_term)->title ?? ''?>">
                         <?php } ?>
                      </div>
                      <div class="pcbuild_qty_box">
                          <span>QTY</span>
                          <select name="qty" id="qty<?=$prod_id?>" class="form-control">
                              <?php for($qty=1; $qty <= 3; $qty++){ ?>
                              <option value="<?=$qty?>"><?=$qty?></option>
                              <?php } ?>
                          </select>
                      </div>
                       <button type="button" class="btn btn-primary btn-lg" id="add_product" data-product="<?=$prod_id?>" data-cat_id="<?=$chip_cat_id?>" data-cat_type="<?=$type?>">Add</button>
                  </div>
              </div>
              <?php } ?>
          </div>        
        <div class="prod_content_area">
            <?php if($type !== 'RAM' && $type != 'Storage'){ ?>
            <h2><?=$prod_detail->title ?? ''?></h2>
            <div class="prod_short_description">
                <?=$prod_detail->short_description ?? ''?>
            </div>
            <?php } ?>
            <div class="prod_features_ul">
                <?=$prod_detail->features ?? ''?>
            </div>
        </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
       <?php } } }?>
<script>
$(document).ready(function(){
    $("div #capacity").click(function(){
       var type = $(this).data('type') 
       var capacity_id = $(this).val()
       var product_id = $(this).data('product')
       
       $(".capacity_btn").removeClass('active')
       $(this).addClass('active')
       
       if(type == 'ram'){
          $("#ram_capacity_val").val(capacity_id); 
       }
       if(type == 'ssd'){
           $("#ssd_capacity_val").val(capacity_id)
       }
    });
    
    $("div #add_product").click(function(){
      
        var product_id = $(this).data('product');
        
        var added_prod_id = product_id;
        var type = $(this).data('cat_type');
        var var_id = $("input[name=change_color"+product_id+"]:checked").val();
        var color_id = $("input[name=change_color"+product_id+"]:checked").data('color');
        var cat_id = $(this).data('cat_id');
        var case_id = $("#case_id").val();
        var default_prod_id = $("#default_prod_id").val();
        
        var ram_capacity_val = $("#ram_capacity_val").val();
        var ssd_capacity_val = $("#ssd_capacity_val").val();
        //prices
        var case_price = $("#case_price").val()
        var cpu_price = $("#cpu_price").val()
        var gpu_price = $("#gpu_price").val()
        var mothrboard_price = $("#mothrboard_price").val()
        var ram_price = $("#ram_price").val()
        var storage_price = $("#storage_price").val()
        var cooling_price = $("#cooling_price").val()
        var pwrsupply_price = $("#pwrsupply_price").val()
        var software_price = $("#software_price").val()
        var service_price = $("#service_price").val()
        var rgb_price = $("#service_price").val()
        var monitor_price = $("#monitor_price").val()
        var peripheral_price = $("#peripheral_price").val()
        var extra_price = $("#extra_price").val()
        
        var qty = $("#qty"+product_id).val();
        
        if(type == 'Case'){
           $("#default_prod_id").val(product_id); 
        }
        
        if(type == 'RAM' || type == "Storage"){
            $('#info_model'+product_id).modal('hide');
        }
        
        if(type !== 'RAM' && type !== "Storage"){
            $(".prod_add_btn").removeClass('added_product_p').text('Add').removeAttr('disabled','disabled');
            $(this).addClass('added_product_p').text('Added');
            $(this).attr('disabled','disabled');
        }
        $('.tret').removeClass('added_product_box')
        $(this).parents('.tret').addClass('added_product_box')
        
        
        $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
           		 
        $.ajax({
			url: SITE_URL+'/ajax/add_pc_product',
			type: 'POST',
            dataType:'json',
			data : {product_id:product_id, type:type, var_id:var_id, color_id:color_id, cat_id:cat_id, default_prod_id:default_prod_id, case_price:case_price,
			cpu_price:cpu_price, gpu_price:gpu_price, mothrboard_price:mothrboard_price, ram_price:ram_price, storage_price:storage_price, cooling_price:cooling_price,
			pwrsupply_price:pwrsupply_price, software_price:software_price, service_price:service_price, rgb_price:rgb_price, monitor_price:monitor_price,
			peripheral_price:peripheral_price, extra_price:extra_price, qty:qty, added_prod_id:added_prod_id, ram_capacity_val:ram_capacity_val, ssd_capacity_val:ssd_capacity_val 
			},
			beforeSend : function(){   
			    $("#loader").show();			
			},
			success : function(data) {
			    console.log(data.html)
			    $("#loader").hide();

                var buttonHtml = '';
             if(data.product_details){
                if(type=='Case'){
                    $('.cart_title').html(data.product_details.title+' Build');
                    $('#caseImageCol').html('<img src="http://starhifi.com/uploads/product-media/'+data.product_details.image+'" alt="">');
                }
                var buttonHtml = '<div class="pc_img"><img src="http://starhifi.com/uploads/product-media/'+data.product_details.image+'"></div><div class="pc_conent"><h5>'+type+'</h5><p>'+data.product_details.title+'</p></div>';
             }  
			   //$("#pcbuild_main_div").html(data)
			  if(type == 'Case'){
			      $(".case_summary_box").html(data.summary_html);
			  }
			  if(type == 'CPU'){
			      $(".cpu_summary_box").html(data.summary_html);
			  }
			  if(type == 'GPU'){
			      $(".gpu_summary_box").html(data.summary_html);
			  }
			  if(type == 'Motherboards'){
			      $(".motherboard_summary_box").html(data.summary_html);
			  }
			  if(type == 'RAM'){
			      $(".ram_summary_box").html(data.summary_html);
			  }
			  if(type == 'Storage'){
			      $(".storage_summary_box").html(data.summary_html);
			  }
			  if(type == 'Cooling'){
			      $(".cooling_summary_box").html(data.summary_html);
			  }
			  if(type == 'Power Supplies'){
			      $(".power_summary_box").html(data.summary_html);
			  }

              var ButtonObject = $('[data-name="'+type+'"]');
                console.log('ButtonObject',ButtonObject);
                ButtonObject.html(buttonHtml);
			 
			 $(".total_amount").text(data.total_amount.toLocaleString())
			 
				},
			
		});
    });
}) ;         
</script>
   <?php }
}

function AddpcbuildProduct(Request $request){
    if($request->ajax()){
        $product_id = (!empty($request->product_id)) ? $request->product_id : $request->default_prod_id;
        $type = $request->type;
        $var_id = $request->var_id;
        $color_id = $request->color_id;
        $cat_id = $request->cat_id;
        $html_res = '';
        $case_product_id = $request->case_prod_id;
        $default_prod_id = trim($request->default_prod_id) ?? '';
        $added_prod_id = $request->added_prod_id ?? '';
        $cooling_product_id = $request->cooling_product_id;
        $cpu_product_id = $request->cpu_prod_id;
        $gpu_product_id = $request->gpu_prod_id;
        $mtherboard_product_id = $request->mtherboard_product_id;
        $ram_product_id = $request->ram_product_id;
        $storage_product_id = $request->storage_product_id;
        $supply_product_id = $request->supply_product_id;
        $tab_type = $type;
        $addon_sub_cat = $type;
        
        $chip_cat_id = '';
        $chipsubcat_selectedid = '';
        $ram_qty = 1;
        $ssd_qty = 1;
        
        $product_detail = productDetailById($product_id);
        
        $summary_html = '';
        
        //prices
        $case_price= $request->case_price;
        $cpu_price = $request->cpu_price;
        $gpu_price = $request->gpu_price;
        $mothrboard_price = $request->mothrboard_price;
        $ram_price = $request->ram_price;
        $storage_price = $request->storage_price;
        $cooling_price = $request->cooling_price;
        $pwrsupply_price = $request->pwrsupply_price;
        $software_price = $request->software_price;
        $service_price = $request->service_price;
        $rgb_price = $request->rgb_price;
        $monitor_price = $request->monitor_price;
        $peripheral_price = $request->peripheral_price;
        $extra_price= $request->extra_price;
        
        if($type == 'Case'){
           
            $case_cart = session()->get('case_cart');
            $chipsubcat_selectedid = $cat_id;
            $chip_cat_id = $cat_id;
            
            $case_prod_variations = '';
            $case_variation_id = $var_id;
            $case_color_id = $color_id;
           
           if(!empty($product_id)){
                $case_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => 1,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $var_id,
                        "color_id" => $color_id,
                    ]
            ];

            session()->put('case_cart', $case_cart);
            
            $summary_html .= ' <div class="col-lg-7">
                                    <input type="hidden" name="case_id" id="case_id" value="'.$cat_id.'">
                                    <input type="hidden" name="case_prod_id" id="case_prod_id" value="'.$product_id.'">
                                    <input type="hidden" name="case_prod_variation_id" id="case_prod_variation_id" value="'.$var_id.'">
                                    <input type="hidden" name="case_variation_color_id" id="case_variation_color_id" value="'.$color_id.'">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">';
                                    if(!empty($product_detail->sale_price)){
                                    $case_price = $product_detail->sale_price; 
                                $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price,2).'</span>';
                                    }
                                    else{
                                       $case_price = $product_detail->price;  
                                      $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price,2).'</span>';
                                    }
                                
                                    
                        $summary_html .= '<input type="hidden" name="case_price" id="case_price" value="'.$case_price.'"></div>';
           }
        }
        elseif($type == 'Cooling'){
            
            $default_prod_id = $request->default_prod_id;
            $added_prod_id = (!empty($request->added_prod_id)) ? $request->added_prod_id : $request->default_prod_id;
            $cooling_product_id = (!empty($product_id)) ? $product_id : $request->cooling_product_id;
            $cooling_cart = session()->get('cooling_cart');
            $chipsubcat_selectedid = $cat_id;
            $chip_cat_id = $cat_id;
           
           if(!empty($product_id)){
                $cooling_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => 1,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $var_id,
                        "color_id" => $color_id,
                    ]
            ];
            
            session()->put('cooling_cart', $cooling_cart);
            
            $summary_html .= ' <div class="col-lg-7">
                                    <input type="hidden" name="cooling_id" id="cooling_id" value="'.$cat_id.'">
                                    <input type="hidden" name="cooling_product_id" id="cooling_product_id" value="'.$product_id.'">
                                    <input type="hidden" name="cooling_prod_variation_id" id="cooling_prod_variation_id" value="'.$var_id.'">
                                    <input type="hidden" name="cooling_variation_color_id" id="cooling_variation_color_id" value="'.$color_id.'">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">';
                                    if(!empty($product_detail->sale_price)){
                                    $cooling_price = $product_detail->sale_price; 
                                $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price,2).'</span>';
                                    }
                                    else{
                                       $cooling_price = $product_detail->price;  
                                      $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price,2).'</span>';
                                    }
                                
                                    
                        $summary_html .= '<input type="hidden" name="cooling_price" id="cooling_price" value="'.$cooling_price.'"></div>';
           }
        }
        elseif($type == 'Motherboards'){
            $added_prod_id = (!empty($request->added_prod_id)) ? $request->added_prod_id : $request->default_prod_id;
            $mtherboard_product_id = $product_id;
            $motherboard_cart = session()->get('motherboard_cart');
            $chipsubcat_selectedid = $cat_id;
            $chip_cat_id = $cat_id;
           
           if(!empty($product_id)){
                $motherboard_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => 1,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $var_id,
                        "color_id" => $color_id,
                    ]
            ];
            
            session()->put('motherboard_cart', $motherboard_cart);
            
            $summary_html .= ' <div class="col-lg-7">
                                    <input type="hidden" name="mtherboard_id" id="mtherboard_id" value="'.$cat_id.'">
                                    <input type="hidden" name="mtherboard_product_id" id="mtherboard_product_id" value="'.$product_id.'">
                                    <input type="hidden" name="mtherboard_prod_variation_id" id="mtherboard_prod_variation_id" value="'.$var_id.'">
                                    <input type="hidden" name="mtherboard_variation_color_id" id="mtherboard_variation_color_id" value="'.$color_id.'">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">';
                                    if(!empty($product_detail->sale_price)){
                                    $mothrboard_price = $product_detail->sale_price; 
                                $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price,2).'</span>';
                                    }
                                    else{
                                       $mothrboard_price = $product_detail->price;  
                                      $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price,2).'</span>';
                                    }
                                
                                    
                        $summary_html .= '<input type="hidden" name="mothrboard_price" id="mothrboard_price" value="'.$mothrboard_price.'"></div>';
           }
        }
        elseif($type == 'GPU'){
            $added_prod_id = (!empty($request->added_prod_id)) ? $request->added_prod_id : $request->default_prod_id;
            $gpu_product_id = $product_id;
            $gpu_cart = session()->get('gpu_cart');
            $chipsubcat_selectedid = $cat_id;
            $chip_cat_id = $cat_id;
           
           if(!empty($product_id)){
                $gpu_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => 1,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $var_id,
                        "color_id" => $color_id,
                    ]
            ];
            
            session()->put('gpu_cart', $gpu_cart);
            
            $summary_html .= ' <div class="col-lg-7">
                                    <input type="hidden" name="gpu_id" id="gpu_id" value="'.$cat_id.'">
                                    <input type="hidden" name="gpu_prod_id" id="gpu_prod_id" value="'.$product_id.'">
                                    <input type="hidden" name="gpu_prod_variation_id" id="gpu_prod_variation_id" value="'.$var_id.'">
                                    <input type="hidden" name="gpu_variation_color_id" id="gpu_variation_color_id" value="'.$color_id.'">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">';
                                    if(!empty($product_detail->sale_price)){
                                    $gpu_price = $product_detail->sale_price; 
                                $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price,2).'</span>';
                                    }
                                    else{
                                       $gpu_price = $product_detail->price;  
                                      $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price,2).'</span>';
                                    }
                                
                                    
                        $summary_html .= '<input type="hidden" name="gpu_price" id="gpu_price" value="'.$gpu_price.'"></div>';
           }
        }
        elseif($type == 'CPU'){
            $added_prod_id = (!empty($request->added_prod_id)) ? $request->added_prod_id : $request->default_prod_id;
            $cpu_product_id = $product_id;
            $cpu_cart = session()->get('cpu_cart');
            $chipsubcat_selectedid = $cat_id;
            $chip_cat_id = $cat_id;
            
            $cpu_variation_id= '';
            $cpu_color_id = '';
           
           if(!empty($product_id)){
                $cpu_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => 1,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $var_id,
                        "color_id" => $color_id,
                    ]
            ];
            
            session()->put('cpu_cart', $cpu_cart);
            
            $summary_html .= ' <div class="col-lg-7">
                                    <input type="hidden" name="cpu_id" id="cpu_id" value="'.$cat_id.'">
                                    <input type="hidden" name="cpu_prod_id" id="cpu_prod_id" value="'.$product_id.'">
                                    <input type="hidden" name="cpu_variation_id" id="cpu_variation_id" value="'.$var_id.'">
                                    <input type="hidden" name="cpu_variation_color_id" id="cpu_variation_color_id" value="'.$color_id.'">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">';
                                    if(!empty($product_detail->sale_price)){
                                    $cpu_price = $product_detail->sale_price; 
                                $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price,2).'</span>';
                                    }
                                    else{
                                       $cpu_price = $product_detail->price;  
                                      $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price,2).'</span>';
                                    }
                                
                                    
                        $summary_html .= '<input type="hidden" name="cpu_price" id="cpu_price" value="'.$cpu_price.'"></div>';
           }
        }
         elseif($type == 'Power Supplies'){
            $added_prod_id = (!empty($request->added_prod_id)) ? $request->added_prod_id : $request->default_prod_id;
            $supply_product_id = $product_id;
            $pwrsupply_cart = session()->get('pwrsupply_cart');
            $chipsubcat_selectedid = $cat_id;
            $chip_cat_id = $cat_id;
           
           if(!empty($product_id)){
                $pwrsupply_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => 1,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $var_id,
                        "color_id" => $color_id,
                    ]
            ];
            
            session()->put('pwrsupply_cart', $pwrsupply_cart);
            
            $summary_html .= ' <div class="col-lg-7">
                                    <input type="hidden" name="supply_id" id="supply_id" value="'.$cat_id.'">
                                    <input type="hidden" name="supply_product_id" id="supply_product_id" value="'.$product_id.'">
                                    <input type="hidden" name="supply_variation_id" id="supply_variation_id" value="'.$var_id.'">
                                    <input type="hidden" name="supply_variation_color_id" id="supply_variation_color_id" value="'.$color_id.'">
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">';
                                    if(!empty($product_detail->sale_price)){
                                    $pwrsupply_price = $product_detail->sale_price; 
                                $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price,2).'</span>';
                                    }
                                    else{
                                       $pwrsupply_price = $product_detail->price;  
                                      $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price,2).'</span>';
                                    }
                                
                                    
                        $summary_html .= '<input type="hidden" name="pwrsupply_price" id="pwrsupply_price" value="'.$pwrsupply_price.'"></div>';
           }
        }
        elseif($type == 'RAM'){
            
            $added_prod_id = (!empty($request->added_prod_id)) ? $request->added_prod_id : $request->default_prod_id;
            $ram_product_id = $product_id;
            $ram_cart = session()->get('ram_cart');
            $chipsubcat_selectedid = $cat_id;
            $chip_cat_id = $cat_id;
            
            $ram_capacity_val = $request->ram_capacity_val;
            
            $ram_qty = (!empty($request->qty)) ? $request->qty : 1;
           if(!empty($product_id)){
                $ram_cart = [
                    'ram' => [
                        "product_id" => $product_id,
                        "quantity" => $ram_qty,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $var_id,
                        "color_id" => $color_id,
                    ]
            ];
            
            session()->put('ram_cart', $ram_cart);
            
        $summary_html .= ' <div class="col-lg-7">
                                    <input type="hidden" name="ram_id" id="ram_id" value="'.$cat_id.'">
                                    <input type="hidden" name="ram_product_id" id="ram_product_id" value="'.$product_id.'">
                                    <input type="hidden" name="ram_qty" id="ram_qty" value="'.$ram_qty.'">
                                    <input type="hidden" name="ram_capacity" id="ram_capacity" value="'.$ram_capacity_val.'">
                            
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">'.$ram_qty.'</span>
                                </div>
                                <div class="col-lg-3">';
                                    if(!empty($product_detail->sale_price)){
                                    $ram_price = $product_detail->sale_price; 
                                $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price*$ram_qty,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price*$ram_qty,2).'</span>';
                                    }
                                    else{
                                       $ram_price = $product_detail->price;  
                                      $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price*$ram_qty,2).'</span>';
                                    }
                                
                                    
                        $summary_html .= '<input type="hidden" name="ram_price" id="ram_price" value="'.$ram_price.'"></div>';
           }
        }
        elseif($type == 'Storage'){
           $added_prod_id = (!empty($request->added_prod_id)) ? $request->added_prod_id : $request->default_prod_id;
            $storage_product_id = $product_id;
            $storage_cart = session()->get('storage_cart');
            $chipsubcat_selectedid = $cat_id;
            $chip_cat_id = $cat_id;
            $ssd_qty = (!empty($request->qty)) ? $request->qty : 1;
            
            $ssd_capacity_val = $request->ssd_capacity_val;
           
           if(!empty($product_id)){
                $storage_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => $ssd_qty,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $var_id,
                        "color_id" => $color_id,
                    ]
            ];
            
            session()->put('storage_cart', $storage_cart);
            
            $summary_html .= ' <div class="col-lg-7">
                                    <input type="hidden" name="storage_id" id="storage_id" value="'.$cat_id.'">
                                    <input type="hidden" name="storage_product_id" id="storage_product_id" value="'.$product_id.'">
                                    <input type="hidden" name="ssd_qty" id="ssd_qty" value="'.$ssd_qty.'">
                                    <input type="hidden" name="ssd_capacity" id="ssd_capacity" value="'.$ssd_capacity_val.'">
                            
                                    <span class="list_info_prd_details">'.$product_detail->title.'</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">'.$ssd_qty.'</span>
                                </div>
                                <div class="col-lg-3">';
                                    if(!empty($product_detail->sale_price)){
                                    $storage_price = $product_detail->sale_price; 
                                $summary_html .= '<span class="strike_price">NPR '.number_format($product_detail->price*$ssd_qty,2).'</span>
                                    <span class="list_info_prd_details">NPR '.number_format($product_detail->sale_price*$ssd_qty,2).'</span>';
                                    }
                                    else{
                                       $storage_price = $product_detail->price;  
                                      $summary_html .= '<span class="list_info_prd_details">NPR '.number_format($product_detail->price*$ssd_qty,2).'</span>';
                                    }
                                
                                    
                        $summary_html .= '<input type="hidden" name="storage_price" id="storage_price" value="'.$storage_price.'"></div>';
           }
        }
        /*elseif($type == 'Monitor'){
            $added_prod_id = (!empty($request->added_prod_id)) ? $request->added_prod_id : $request->default_prod_id;
            $monitor_product_id = $product_id;
            $monitor_cart = session()->get('monitor_cart');
            $chipsubcat_selectedid = $cat_id;
            $chip_cat_id = $cat_id;
            $monitor_qty = (!empty($request->qty)) ? $request->qty : 1;
            
            $addon_selected_product = $product_id;
            
            $monitor_price = $product_detail->sale_price ? $product_detail->sale_price : $product_detail->price;
           
           if(!empty($product_id)){
                $monitor_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => $monitor_qty,
                        "price" => $product_detail->sale_price ? $product_detail->sale_price : $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $var_id,
                        "color_id" => $color_id,
                    ]
            ];
            
            session()->put('monitor_cart', $monitor_cart);
           }
        }
        
        elseif($type == 'Peripherals'){
            $added_prod_id = (!empty($request->added_prod_id)) ? $request->added_prod_id : $request->default_prod_id;
            $peripehral_product_id = $product_id;
            $peripheral_cart = session()->get('peripheral_cart');
            $chipsubcat_selectedid = $cat_id;
            $chip_cat_id = $cat_id;
            
            
            $categories = ProductCategory::findMany([14,16,17,18,19,20]);
            
            $addon_selected_product = $product_id;
           
           if(!empty($product_id)){
                $peripheral_cart = [
                    $cat_id => [
                        "product_id" => $product_id,
                        "quantity" => 1,
                        "price" => $product_detail->sale_price ?? $product_detail->price,
                        "image" => $product_detail->image,
                        "variation_id" => $var_id,
                        "color_id" => $color_id,
                    ]
            ];
            
            session()->put('peripheral_cart', $peripheral_cart);
           }
        }
        else{
          
           $added_prod_id = $default_prod_id; 
        }*/
        
        $total_amount = $case_price+$cpu_price+$gpu_price+$mothrboard_price+$ram_price+$storage_price+$cooling_price+
                        $pwrsupply_price+$software_price+$service_price+$rgb_price+$monitor_price+$peripheral_price+$extra_price;
        if(isset($product_detail) && !empty($product_detail)){
            $response_array = array('summary_html' => $summary_html, 'total_amount' => $total_amount,'product_details'=>$product_detail);
        }else{
            $response_array = array('summary_html' => $summary_html, 'total_amount' => $total_amount,'product_details'=>array());
        }
        
        return json_encode($response_array);
        
       /*$chip_cat_products = chipSubcatproductsById($chip_cat_id);
       $chipsubcat_title = chipsetSubCatDetailById($chip_cat_id)->subcat_title ?? '';
       // echo $html_res;
       $builder_data = '';
$budget = '';
$chipset_id = '';
$chiSubCat = '';
//$added_prod_id = '';
$added_prod_varId = '';
$added_prod_gallery = '';
//$added_prod_id = $product_id;

if(session()->has('builder_data')){
$builder_data = session()->get('builder_data');
$chipset_id = $builder_data['chipset_id'];
$performance = $builder_data['performance'];
$budget = $builder_data['budget'];
}

$chiSubCat = getChipsetSubCatbyChipId($chipset_id); 

$added_prod_id;
$added_prod_variation = getProdvariationById($request->default_prod_id);

if($added_prod_variation->count() > 0){
   $added_prod_varId = $added_prod_variation[0]->id; 
   $added_prod_gallery = getVariationImageById($added_prod_varId);
}
else{
    $added_prod_gallery = prodGalleryimagesById($request->default_prod_id);
}


$added_prod_detail = productDetailById($request->default_prod_id);


$case_productDetail = productDetailById($added_prod_id);
$cooling_productDetail = productDetailById($cooling_product_id);
$pwrsupply_productDetail = productDetailById($supply_product_id);
$gpu_productDetail = productDetailById($gpu_product_id);
$mtherboard_productDetail = productDetailById($mtherboard_product_id);
$ram_productDetail = productDetailById($ram_product_id);
$storage_productDetail = productDetailById($storage_product_id);
$cpu_productDetail = productDetailById($cpu_product_id);

$chiSubCat = getChipsetSubCatbyChipId($chipset_id); 
$chip_cat_products = chipSubcatproductsById($cat_id);

$categories = ProductCategory::findMany([14,16,17,18,19,20]);
$first_cat_id = $cat_id;
$catgory_products = getProductsByCatId($first_cat_id);
//print_r($catgory_products);
$addon_selected_product = '';*/


/*if($chipset_id == 1){
$case_id = 1;
$cpu_id = 5;
$gpu_id = 4;
$mthrboard_id = 3;
$ram_id = 7;
$storage_id = 8;
$cooling_id = 2;
$pwrsupply_id = 6;
} elseif($chipset_id == 2){ 
$case_id = 9;
$cpu_id = 13;
$gpu_id = 12;
$mthrboard_id = 11;
$ram_id = 15;
$storage_id = 16;
$cooling_id = 10;
$pwrsupply_id = 14;
}*/

        /*ob_start();
        include(resource_path().'/views/pc_builder_customize.blade.php');
       $content = ob_get_contents();
			 
          ob_clean();
		  ob_end_flush();
		  
        return $content;*/
		  
    }
}




}

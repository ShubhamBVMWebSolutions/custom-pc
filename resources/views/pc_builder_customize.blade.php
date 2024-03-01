<?php 
 

    
/*$api_url = 'https://parewa.technorio.net.np/sms/api?action=send-sms&api_key=c3Rhcm9mZmljZWludGVybmF0aW9uYWw6eHFjVlR5R01qdQ==&to=+919166320152&from=infosms&sms=hello';

    # Make the call using API.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    

    // Response
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);*/
    //print_r($response);

?>
<!-- Checkout Section Begin -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout__form">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2 class="cart_title"><?=$added_prod_detail->title?> Build</h2>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="save_data">
                                <!--<div class="data_field">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-nzxt-volt-200 mb-1 h-6 w-6 lg:hidden xl:block"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        Save
                                    </button>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-nzxt-volt-200 mb-1 h-6 w-6 lg:hidden xl:block"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg>
                                        Load
                                    </button>
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-nzxt-volt-200 mb-1 h-6 w-6 lg:hidden xl:block"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                        Restart
                                    </button>
                                    <button>
                                        <svg width="1em" height="1em" fill="currentColor" viewBox="0 0 24 24" class="text-nzxt-volt-200 mb-1 h-6 w-6 lg:hidden xl:block"><path d="M9.538 3.91a.75.75 0 01.102 1.492l-.102.007H3.439c-.878 0-1.608.684-1.683 1.545l-.006.145v13.416c0 .884.679 1.61 1.544 1.683l.145.007h13.417a1.69 1.69 0 001.683-1.544l.007-.146v-6.098a.75.75 0 011.493-.102l.007.102v6.098a3.19 3.19 0 01-3.009 3.185l-.18.005H3.438a3.19 3.19 0 01-3.184-3.009l-.005-.18V7.098a3.197 3.197 0 013.009-3.185l.18-.005h6.099zM22.955.25a.75.75 0 01.743.648l.007.102v7.318a.75.75 0 01-1.493.102l-.007-.102-.001-5.507-12.136 12.136a.75.75 0 01-1.133-.976l.073-.085L21.143 1.75h-5.507a.75.75 0 01-.743-.648L14.886 1a.75.75 0 01.649-.743l.101-.007h7.319z"></path></svg>
                                        Share
                                    </button>
                                </div> -->   
                            </div>    
                        </div>    
                    </div>
                    <div class="row middle_content_center" >
                        <div class="col-lg-6 text-center" id="caseImageCol">
                            <?php
                            if($added_prod_gallery->count()){
                                // print_r($added_prod_gallery);
                            ?>
                                    <div id="demo" class="carousel slide pcs_custom">
                                  <!-- Indicators -->
                                  <ul class="carousel-indicators">
                                      <?php $t = 0; 
                                      
                                      foreach($added_prod_gallery as $galimgs){ ?>
                                        <li data-target="#demo" data-slide-to="<?=$t?>" class=" <?php if($t == 0) echo 'active'; ?>"></li>
                                        <?php $t++; 
                                       }
                                    ?>
                                    
                                  </ul>                                  
                                  <!-- The slideshow -->
                                  <div class="carousel-inner">
                                      <?php $tt = 0; 
                                     
                                     foreach($added_prod_gallery as $galimgs){?>
                                    <div class="carousel-item <?php if($tt == 0) echo 'active'; ?>">
                                      <img src="<?=url(Config::get('constants.PRODUCT_IMAGE_PATH').$galimgs->image)?>" alt="test-case">
                                    </div>
                                    <?php $tt++; 
                                     }
                                     
                                    ?>
                                    
                                  </div>
                                  <!-- Left and right controls -->
                                  <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                  </a>
                                  <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                  </a>
                                </div>
                            <?php
                            }else{
                            ?>
                                <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$added_prod_detail->image)?>" alt="">
                            <?php
                            }
                            ?>
                            
                        </div> 
                        
                        <?php 
                         $chipset_detail = getchipsetById($chipset_id);
                        $cat_no = 0;?>
                        <div class="col-lg-6">
                
                            <div class="base_section_items">  
                            <button type="button" class="select_cate chipset_selection_btn" id="select_chipset">
                                   <div class="pc_img">
                                        <img src="<?=url('public/img/chipset.svg')?>" height="50" width="50">
                                   </div>
                                   <div class="pc_conent">
                                        <h5>Chipset</h5>
                                        <p><?=$chipset_detail->title ?? ''?></p>
                                   </div>
                                </button>
                            <div class="pc_build_category_list" id="chip_sub_cat_list">
                                
                                
                                <?php foreach($chiSubCat as $subcat){
                                if($budget == $budgets[0]->amount){
                                        $addedprod_id = $subcat->product_id1 ?? '';
                                    }
                                    elseif($budget == $budgets[1]->amount){
                                        $addedprod_id = $subcat->product_id2 ?? '';
                                    }
                                    elseif($budget == $budgets[2]->amount){
                                        $addedprod_id = $subcat->product_id3 ?? '';
                                    }
                                    elseif($budget == $budgets[3]->amount){
                                        $addedprod_id = $subcat->product_id4 ?? '';
                                    }
                                $prod_detail = productDetailById($addedprod_id);
                                $prod_img = $prod_detail->image ?? '';
                                $selected_prod_variations = getProdvariationById($addedprod_id); 
                                if($chipsubcat_selectedid == $subcat->id){
                                    $active_cat = 'active_cat';
                                } 
                                else{
                                    $active_cat = '';
                                }
                                ?>
                                <button type="button" data-name="<?=$subcat->subcat_title?>" class="select_cate chip_sub_cat <?=$active_cat?>" id="chip_sub_cat" value="<?=$subcat->id?>" data-added_product="<?=$addedprod_id?>">
                                   <div class="pc_img">
                                       <?php if($selected_prod_variations->count() > 0){
                                        $selected_prod_variation_images = getVariationImageById($selected_prod_variations[0]->id);
                                       $first_variation_img = $selected_prod_variation_images[0]->variation_image ?? ''; ?>
                                        <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$first_variation_img ?? '')?>"/>
                                       <?php } else{ ?>
                                       <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_img ?? '')?>"/>
                                       <?php } ?>
                                   </div>
                                   <div class="pc_conent">
                                        <h5><?=$subcat->subcat_title?></h5>
                                        <p><?=$prod_detail->title ?? ''?></p>
                                   </div>
                                </button>
                                <?php $cat_no++; 
                                }?>
                                
                            </div>
                            </div>
                            <div class="addon_section_items pc_build_category_list" style="display:none;">
                                <?php 
                                $cat_no = 0;
                                foreach($categories as $cats){ ?>
                                <button type="button" id="pcbuild_add_cat" data-name="<?=$cats->title?>" value="<?=$cats->id?>" class="select_cate pcbuild_add_cat <?php if($cat_no == 0) echo 'active_cat'; ?>">
                                   <div class="pc_img" id="addon_cat_<?=$cats->id?>">
                                        <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$cats->small_icon)?>"/>
                                   </div>
                                   <div class="pc_conent">
                                        <h5><?=$cats->title?></h5>
                                        <p id="addon_selected_product<?=$cats->id?>"></p>
                                   </div>
                                </button>
                                <?php $cat_no++; } ?>
                            </div>
                        </div>    
                    </div>

                </div>
            </div>
            <?php $base_active = '';
            $add_summary_active = '';
            if($tab_type == 'Case' || $tab_type == 'Cooling' || $tab_type == 'Motherboards' || $tab_type == 'GPU' || 
            $tab_type == 'CPU' || $tab_type == 'Power Supplies' || $tab_type == 'RAM' || $tab_type == 'Storage'){
                $base_active = 'active';
            }
            if($tab_type == 'Monitor' || $tab_type == 'Peripherals' || $tab_type == 'RGB Lighting' || $tab_type == 'Extras'
            || $tab_type == 'Software' || $tab_type == 'Services'){
                $add_summary_active =  'active';
            }
            ?>
            <div class="col-lg-4">
               <div class="tab_style_content">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link <?=$base_active?>" id="base_tab" data-toggle="pill" href="#base">01 Base</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link <?=$add_summary_active?>" id="add_on_tab" data-toggle="pill" href="#addons">02 Add-ons</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="summary_tab" data-toggle="pill" href="#summary">03 Summary</a>
                    </li>
                </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div id="base" class="container tab-pane <?=$base_active?>">                     
                        <div class="tabs_navigation_top">
                            <div class="left_nav">
                                <a href="#"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1em" height="1em" class="h-6 stroke-current h-6 stroke-current text-white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>Chipset</a>
                            </div>
                            <div class="right_nav">
                                <a href="#"> Cooling <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1em" height="1em" class="h-6 stroke-current h-6 stroke-current text-white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                            </div>
                        </div>
                        <div class="headings_with_option">  
                            <div class="heading_left">
                                <h3 class="current_chipset_cat"><?=$tab_type?></h3> 
                                <a href="#" data-toggle="modal" data-target="#info_model">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1em" height="1em" class="h-5 w-5 text-white" aria-label="Info"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </a>
                            </div>
                            <!--<div class="heading_right">-->
                            <!--    <select class="black_select_option">-->
                            <!--        <option>All</option>-->
                            <!--        <option>H7</option>-->
                            <!--        <option>H5</option>-->
                            <!--    </select>-->
                            <!--</div>    -->
                        </div>
                        <div class="chipseselection_bx" style="display:none;">
                            <div class="performance_btn chipset_btns">
                                <button type="button" id="chipset" class="<?php if($chipset_id == 1) echo 'active_btn'; ?>" value="1" data-toggle="modal" data-target="#AMDselectModal" <?php if($chipset_id == 1) echo 'disabled'; ?>>AMD</button>
                                <button type="button" id="chipset" class="<?php if($chipset_id == 2) echo 'active_btn'; ?>" value="2" data-toggle="modal" data-target="#IntelselectModal" <?php if($chipset_id == 2) echo 'disabled'; ?>>Intel</button>
                               <input type="hidden" name="chipset" id="chipset_val" value="<?=$chipset_id?>">
                            </div>
                            
                            <!-- Modal -->
<div class="modal fade amd_selection_popup" id="AMDselectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Warning: Build Reset</h4>
        <p>Your build will be reset with the following chipset: AMD</p>
      </div>
      <div class="modal-footer">
          <form></form>
          <form method="post" action="<?=route('continue.build',['randomNumber' => csrf_token()])?>">
             <input type="hidden" name="_token" value="<?=csrf_token()?>">
            <input type="hidden" name="budget_val" value="<?=$budget?>">
            <input type="hidden" name="chipset" value="1">
            <input type="hidden" name="performance" value="<?=$performance?>">
         <button type="submit" class="btn btn-primary">Continue to Build</button>
        
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade intel_selection_popup" id="IntelselectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Warning: Build Reset</h4>
        <p>Your build will be reset with the following chipset: Intel</p>
      </div>
      <div class="modal-footer">
         <form method="post" action="<?=route('continue.build',['randomNumber' => csrf_token()])?>">
             <input type="hidden" name="_token" value="<?=csrf_token()?>">
            <input type="hidden" name="budget_val" value="<?=$budget?>">
            <input type="hidden" name="chipset" value="2">
            <input type="hidden" name="performance" value="<?=$performance?>">
         <button type="submit" class="btn btn-primary">Continue to Build</button>
        
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

                        </div>
                        
                        
                        <div class="pc_build_product_list" id="base_product_list">
                            
                            <?php foreach($chip_cat_products as $chipcatprod){
                               
                            $prod_id = $chipcatprod->product_id;
                            $prod_detail = productDetailById($prod_id);
                            if($prod_detail->product_type == 'pcbuilder'){

                            $prod_variations = getProdvariationById($prod_id);
                            $prod_image = $prod_detail->image ?? '';
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
                                    <div class="info_added_box"> <?php $chipsubcat_title ?>
                                    <?php if($chipsubcat_title != 'RAM' && $chipsubcat_title != 'Storage' ){ ?>
                                        <a class="buttons_info" href="javascript:;" data-toggle="modal" data-target="#info_model<?=$prod_id?>">Info</a>
                                        
                                <?php if($added_prod_id == $prod_id){ ?>
                                        
                                        <button class="buttons_info prod_add_btn added_product_p add_product<?=$prod_id?>" id="add_product" data-cat_id="<?=$chip_cat_id?>" data-product="<?=$prod_id?>" data-cat_type="<?=$chipsubcat_title?>" type="button" disabled>Added</button>
                                        <?php } else{ ?>
                                        <button class="buttons_info prod_add_btn add_product<?=$prod_id?>" id="add_product" data-cat_id="<?=$chip_cat_id?>" data-product="<?=$prod_id?>" data-cat_type="<?=$chipsubcat_title?>" type="button">Add</button>
                                        <?php } 
                                        }
                                        if($chipsubcat_title == 'RAM' || $chipsubcat_title == 'Storage'){ 
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
                                        <?php if($chipsubcat_title != 'RAM' && $chipsubcat_title != 'Storage'){ ?>
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
                                                                } 
                                                            }else{
                                                                    foreach(prodGalleryimagesById($prod_id) as $gallery){
                                                                ?>
                                                                <div class="carousel-item <?php if($prod_gal_noo == 0) echo 'active'; ?>">
                                                                <img src="<?=url(Config::get('constants.PRODUCT_IMAGE_PATH').$gallery->image)?>" alt="">
                                                                </div>
                                                                <?php } } ?>
                                                            </div>
                                                            
                                            
                                            </div>
                                            <?php } if($chipsubcat_title == 'RAM'){ 
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
                                                            <button type="button" data-type="ram" class="btn btn-primary <?php if($capacity_no == 0) echo 'active'; ?>" value="<?=$term_id?>" id="capacity" data-product=<?=$prod_id?> ><?=$term_detail->title?></button></li>
                                                        <?php $capacity_no++; } ?>
                                                    </ul>
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
                                                <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal" id="add_product" data-product="<?=$prod_id?>" data-cat_id="<?=$chip_cat_id?>" data-cat_type="<?=$chipsubcat_title?>">Add</button>
                                            </div>
                                        </div>
                                        <?php } 
                                        if($chipsubcat_title == 'Storage'){ 
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
                                                            <button type="button" data-type="ssd" class="btn btn-primary <?php if($capacity_no == 0) echo 'active'; ?>" value="<?=$term_id?>" id="capacity" data-product=<?=$prod_id?> ><?=$term_detail->title?></button>
                                                        </li>
                                                        <?php $capacity_no++; } ?>
                                                    </ul>
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
                                                <button type="button" class="btn btn-primary btn-lg" id="add_product" data-product="<?=$prod_id?>" data-cat_id="<?=$chip_cat_id?>" data-cat_type="<?=$chipsubcat_title?>">Add</button>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>        
                                    <div class="prod_content_area">
                                        <?php if($chipsubcat_title !== 'RAM' && $chipsubcat_title != 'Storage'){ ?>
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

                        <?php 
                            } 
                        }
                        ?>
                         
                        </div>    
 
                    </div>
                    <div id="addons" class="container tab-pane <?=$add_summary_active?>">
                      <div class="tabs_navigation_top">
                            <div class="left_nav">
                                <a href="#"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1em" height="1em" class="h-6 stroke-current h-6 stroke-current text-white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>Chipset</a>
                            </div>
                            <div class="right_nav">
                                <a href="#"> Cooling <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1em" height="1em" class="h-6 stroke-current h-6 stroke-current text-white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                            </div>
                        </div>
                        <div class="headings_with_option">  
                            <div class="heading_left">
                                <h3 class="current_chipset_cat"><?=$addon_sub_cat?></h3> 
                                <a href="#" data-toggle="modal" data-target="#info_model">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1em" height="1em" class="h-5 w-5 text-white" aria-label="Info"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </a>
                            </div>
                            <!--<div class="heading_right">-->
                            <!--    <select class="black_select_option">-->
                            <!--        <option>All</option>-->
                            <!--        <option>H7</option>-->
                            <!--        <option>H5</option>-->
                            <!--    </select>-->
                            <!--</div>    -->
                        </div>
                        
                        <div >
                        <img src="<?=url('public/img/rolling-icon.svg')?>" style="display: none;" id="loader_addon">
                        </div>

                        <div class="pc_build_product_list" id="add_on_prod_list">
                            <?php if(session()->has('monitor_cart')){
                            $addon_cart = session()->get('monitor_cart');
                            $addon_selected_product = $addon_cart[$first_cat_id]['product_id'];
                            }
                            foreach($catgory_products as $cat_prod){
                                $prodID = $cat_prod->product_id;
                                $cat_prod_detail = productDetailById($prodID);
                                $cat_prod_variations = getProdvariationById($prodID);
                                $variation_imagess = getVariationImageById($cat_prod_variations[0]->id ?? '');
                                if(!empty($cat_prod_detail)){
                                    if($cat_prod_detail->product_type=='pcbuilder'){

                                    
                            ?>
                            <div class="product_box <?php if($addon_selected_product == $prodID) echo 'added_product_box'; ?>">
                                
                                <div class="whole_product_box">
                                    <div class="img_title_block">
                                        <div class="img_title" id="prod_single_img<?=$prodID?>">
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
                                        <strong>Color: </strong> <span id="selected_color_name<?=$prodID?>"><?=(!empty(clorDetailById($color_idd)[0])) ? clorDetailById($color_idd)[0]->color_name : ''?></span>
                                        <div class="product__details__option__color">
                                            
                                            <?php foreach($cat_prod_variations as $clr_var){
                                            $colorr_detail = clorDetailById($clr_var->color_id); ?>
                                           <label class="color_label  <?php if($clr_no == 0) echo 'active'; ?>" for="" style="background: <?=(!empty($colorr_detail[0])) ? $colorr_detail[0]->color_code : ''?>;" title="<?=(!empty($colorr_detail[0])) ? $colorr_detail[0]->color_name : ''?>">
                                            <input type="radio" id="addon_change_color" name="addon_color_variation" value="<?=$clr_var->id?>" data-color="<?=$clr_var->color_id?>" data-product_id="<?=$prodID?>" <?php if($clr_no == 0) echo 'checked'; ?> >
                                           </label>
                                           <?php $clr_no++; ?>
                                           <?php } ?>
                                                                                    
                                        </div>
                                    </div>
                                    <?php } 
                                    if($categories[0]->title == 'Monitor'){ ?>
                                    <div class="product_qty_box form-group">
                                        <label>QTY:</label>
                                        <select name="qty" class="form-control">
                                            <?php for($qty = 1; $qty<=3; $qty++){ ?>
                                            <option value="<?=$qty?>"><?=$qty?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php } ?>
                                    <div class="pc_product_with_strike">
                                        <?php if(!empty($cat_prod_detail->sale_price)){ ?>
                                        <div class="strike_price">NPR <?=number_format($cat_prod_detail->price)?></div>
                                        <div class="regular_price">NPR <?= number_format($cat_prod_detail->sale_price,2)?></div>
                                        <?php } else{ ?>
                                        <div class="regular_price">NPR <?=number_format($cat_prod_detail->price,2)?></div>
                                        <?php } ?>
                                    </div>
                                    <div class="info_added_box">
                                        <div class="info_btn_div">
                                        <a class="buttons_info" href="javascript:;" data-toggle="modal" data-target="#addon_info_model<?=$prodID?>" >Info</a>
                                        </div>
                                        <?php if($addon_selected_product == $prodID){ ?>
                                        <div class="added_delete_btns_bx">
                                        <!--<button type="button" class="btn btn-danger pc_builder_delete buttons_info" id="delete_pc_product" data-product="<?=$prodID?>" data-type="<?=$categories[0]->title?>">-->
                                        <!--<i class="fa fa-trash" aria-hidden="true"></i></button>-->
                                        <span class="added_product_p" id="case_added_p" data-added_product="<?=$prodID?>">Added</span>
                                        </div>
                                        <?php } else{ ?>
                                        <button class="buttons_info" type="button" id="add_product_addon" data-product="<?=$prodID?>" data-cat_id="<?=$first_cat_id?>" data-cat_type="<?=$categories[0]->title?>">Add</button>
                                        <?php } ?>
                                    </div>    
                                </div>    
                            </div>
                            
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
                                    <div class="carousel-item @if($prod_gal_noo2 == 0) active @endif">
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
      <!-- Modal footer -->
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
                            <?php } }

}?>
                            
                        </div>
                    </div>
                    <div id="summary" class="container tab-pane fade">                     
                        <div class="shipping_details">
                            <p><strong>Estimated Shipping:</strong> <?=date('d/m/Y',strtotime('+4 day'));?></p>
                        </div>
                        <div class="includes_box"> 
                            <h5>Includes</h5>
                            <ul class="includes_list">
                                <li>
                                    <svg width="1.6em" height="1.6em" fill="currentColor" viewBox="0 0 25 24" class="w-10 h-6 fill-current"><title>VR Ready</title><path d="M21.249 10.64a3.75 3.75 0 013.745 3.55l.005.2v4.518a3.75 3.75 0 01-3.551 3.745l-.2.005H13v-1.5h8.249a2.25 2.25 0 002.245-2.096l.005-.154v-4.519a2.25 2.25 0 00-2.096-2.244l-.154-.005H13v-1.5h8.249z"></path><path d="M18.596 4.701c1.818-.162 3.209.321 3.877 1.742.066.14.134.29.202.447l.208.495.214.542.11.29.222.613.23.663.234.71.241.758.248.806.253.855.26.903-1.443.41-.254-.883-.247-.834-.241-.786-.235-.738-.227-.69-.112-.326-.217-.617a34.564 34.564 0 00-.107-.29l-.207-.543c-.17-.433-.333-.815-.49-1.147-.341-.726-1.125-.998-2.386-.886a10 10 0 00-1.431.25l-.612.159-2.305.67c-.517.143-.888.218-1.234.235L13 7.512v-1.5c.139 0 .303-.021.522-.069l.29-.07.446-.126 2.18-.63.158-.042c.732-.191 1.374-.318 2-.374z"></path><path d="M12.99.752c4.187-.057 6.525 1.437 6.631 4.452l.004.218h-1.5c0-2.11-1.48-3.158-4.816-3.172l-.299.001-.02-1.5zM4.741 10.64a3.75 3.75 0 00-3.745 3.55l-.005.2v4.518a3.75 3.75 0 003.55 3.745l.2.005h8.345v-1.5H4.74a2.25 2.25 0 01-2.245-2.096l-.005-.154v-4.519a2.25 2.25 0 012.096-2.244l.154-.005h8.27l.075-1.5H4.74z"></path><path d="M7.394 4.701c-1.818-.162-3.209.321-3.877 1.742-.067.14-.134.29-.202.447l-.208.495-.214.542a33.6 33.6 0 00-.11.29l-.222.613-.23.663-.234.71-.242.758-.247.806-.253.855-.26.903 1.443.41.254-.883.247-.834.241-.786.234-.738.228-.69.111-.326.218-.617.106-.29.208-.543c.17-.433.333-.815.49-1.147.34-.726 1.125-.998 2.386-.886a10 10 0 011.431.25l.612.159 2.305.67c.516.143.888.218 1.234.235l.167.003-.01-1.5c-.139 0-.314-.021-.532-.069l-.29-.07-.446-.126-2.181-.63-.157-.042c-.732-.191-1.374-.318-2-.374z"></path><path d="M13 .752C8.813.695 6.475 2.189 6.369 5.204l-.004.218h1.5c0-2.11 1.48-3.158 4.816-3.172l.33.001L13 .751zm-1.602 18.203a.254.254 0 00.165-.051.228.228 0 00.08-.13l1.219-3.84a.223.223 0 00.006-.053.125.125 0 00-.036-.087.117.117 0 00-.09-.04h-.786a.22.22 0 00-.222.163l-.822 2.712-.816-2.712a.244.244 0 00-.075-.111.212.212 0 00-.147-.051h-.786a.127.127 0 00-.093.039.12.12 0 00-.04.087l.013.054 1.212 3.84a.261.261 0 00.087.129.254.254 0 00.165.05h.966zm2.988 0a.157.157 0 00.11-.042.141.141 0 00.046-.108V17.49h.576l.66 1.302a.25.25 0 00.246.162h.846a.117.117 0 00.09-.04.125.125 0 00.036-.086.15.15 0 00-.018-.066l-.81-1.464c.228-.108.407-.26.537-.456.13-.196.195-.434.195-.714 0-.436-.15-.774-.447-1.014-.298-.24-.711-.36-1.24-.36h-1.65a.141.141 0 00-.107.045.157.157 0 00-.042.11v3.895c0 .04.015.075.045.105s.065.045.105.045h.822zm.822-2.346h-.666v-.99h.666c.172 0 .303.046.393.138a.5.5 0 01.135.366.47.47 0 01-.135.357c-.09.086-.221.129-.393.129z"></path></svg>
                                    <span>VR Ready</span>
                                </li>
                                <li>
                                    <svg width="1.6em" height="1.6em" fill="currentColor" viewBox="0 0 24 24" class="w-10 h-6 fill-current"><title>Stream Ready</title><path d="M20 6.25H4A2.75 2.75 0 001.25 9v11A2.75 2.75 0 004 22.75h16A2.75 2.75 0 0022.75 20V9A2.75 2.75 0 0020 6.25zM4 7.75h16c.69 0 1.25.56 1.25 1.25v11c0 .69-.56 1.25-1.25 1.25H4c-.69 0-1.25-.56-1.25-1.25V9c0-.69.56-1.25 1.25-1.25z"></path><path d="M6.47 1.47a.75.75 0 01.976-.073l.084.073L12 5.939l4.47-4.47a.75.75 0 01.976-.072l.084.073a.75.75 0 01.073.976l-.073.084-5 5a.75.75 0 01-.976.073l-.084-.073-5-5a.75.75 0 010-1.06z"></path></svg>
                                    <span>Stream Ready</span>
                                </li>
                                <li class="not_in_list">
                                    <svg width="1.6em" height="1.6em" fill="currentColor" viewBox="0 0 24 24" class="w-10 h-6 fill-current"><title>RGB Lighting Not Included</title><path d="M12 6.25a5.75 5.75 0 100 11.5 5.75 5.75 0 000-11.5zm0 1.5a4.25 4.25 0 110 8.5 4.25 4.25 0 010-8.5zm0 12.5a.75.75 0 01.743.648l.007.102v2a.75.75 0 01-1.493.102L11.25 23v-2a.75.75 0 01.75-.75zm6.846-2.453l.084.073 1.4 1.4a.75.75 0 01-.976 1.133l-.084-.073-1.4-1.4a.75.75 0 01.976-1.133zM6.13 17.87a.75.75 0 01.073.976l-.073.084-1.4 1.4a.75.75 0 01-1.133-.976l.073-.084 1.4-1.4a.75.75 0 011.06 0zM3 11.25a.75.75 0 01.102 1.493L3 12.75H1a.75.75 0 01-.102-1.493L1 11.25h2zm20 0a.75.75 0 01.102 1.493L23 12.75h-2a.75.75 0 01-.102-1.493L21 11.25h2zM4.646 3.597l.084.073 1.4 1.4a.75.75 0 01-.976 1.133L5.07 6.13l-1.4-1.4a.75.75 0 01.874-1.197l.102.064zm15.684.073a.75.75 0 01.073.976l-.073.084-1.4 1.4a.75.75 0 01-1.133-.976l.073-.084 1.4-1.4a.75.75 0 011.06 0zM12 .25a.75.75 0 01.743.648L12.75 1v2a.75.75 0 01-1.493.102L11.25 3V1A.75.75 0 0112 .25z"></path></svg>
                                    <span>Lighting</span>
                                </li>
                                <li><svg width="1.6em" height="1.6em" fill="currentColor" viewBox="0 0 24 24" class="w-10 h-6 fill-current"><title>Has WiFi</title><path d="M4.52 11.474a11.75 11.75 0 0115.04 0 .75.75 0 11-.96 1.152 10.25 10.25 0 00-13.12 0 .75.75 0 01-.96-1.152z"></path><path d="M.924 7.937c6.33-5.58 15.822-5.58 22.152 0a.75.75 0 01-.992 1.126 15.25 15.25 0 00-20.168 0 .75.75 0 11-.992-1.126zm7.172 7.062a6.75 6.75 0 017.819 0 .75.75 0 01-.87 1.222 5.25 5.25 0 00-6.08 0A.75.75 0 018.094 15zm3.914 3.751a.75.75 0 01.102 1.493L12 20.25a.75.75 0 01-.102-1.493l.112-.007z"></path></svg>
                                    <span>WiFi</span>
                                </li>
                                <li><svg fill="currentColor" viewBox="0 0 24 24" width="1.6em" height="1.6em" class="w-10 h-6 fill-current"><title>Has Bluetooth</title><path d="M11.25 1a.75.75 0 011.203-.598l.077.068 5.5 5.5a.75.75 0 01.073.976l-.073.084L13.061 12l4.97 4.97a.75.75 0 01.072.976l-.073.084-5.5 5.5a.75.75 0 01-1.273-.427L11.25 23v-9.19l-4.22 4.22a.75.75 0 01-.976.073l-.084-.073a.75.75 0 01-.073-.976l.073-.084L10.939 12l-4.97-4.97a.75.75 0 01-.072-.976l.073-.084a.75.75 0 01.976-.073l.084.073 4.22 4.219V1zm1.5 12.811v7.377l3.689-3.688-3.689-3.689zm0-11v7.377L16.439 6.5 12.75 2.811z"></path></svg>
                                    <span>Bluetooth</span>
                                </li>
                                <li><svg fill="currentColor" viewBox="0 0 24 24" width="1.6em" height="1.6em" class="w-10 h-6 fill-current"><title>has USB-C</title><path fill-rule="evenodd" d="M5.5 8h13a4 4 0 010 8h-13a4 4 0 010-8zM0 12a5.5 5.5 0 015.5-5.5h13a5.5 5.5 0 110 11h-13A5.5 5.5 0 010 12zm4 0a1.5 1.5 0 011.5-1.5h13a1.5 1.5 0 010 3h-13A1.5 1.5 0 014 12z" clip-rule="evenodd"></path></svg>
                                    <span>USB-C</span>
                                </li>
                            </ul>    
                        </div>
                        <div class="buy_product_detail">
                            <div class="summary_box">
                            <div class="row">
                                <div class="col-lg-7">
                                    <strong>Case</strong>
                                </div>
                                <div class="col-lg-2">
                                    <strong>Qty</strong>
                                </div>
                                 <div class="col-lg-3">
                                    <strong>Price</strong>
                                </div>
                            </div>
                            <div class="row case_summary_box">
                                <?php 
                                    $case_productDetail = productDetailById($added_prod_id); 
                                    $case_prod_variations = getProdvariationById($added_prod_id);
                                    $case_variation_id = (!empty($case_prod_variations[0])) ? $case_prod_variations[0]->id : '';
                                    $case_color_id = (!empty($case_prod_variations[0])) ? $case_prod_variations[0]->color_id : ''; 
                                ?>
                                <div class="col-lg-7">
                                    <input type="hidden" name="case_id" id="case_id" value="<?=$case_id?>">
                                    <input type="hidden" name="case_prod_id" id="case_prod_id" value="<?=$added_prod_id?>">
                                    <input type="hidden" name="case_prod_variation_id" id="case_prod_variation_id" value="<?=$case_variation_id?>">
                                    <input type="hidden" name="case_variation_color_id" id="case_variation_color_id" value="<?=$case_color_id?>">
                                    <span class="list_info_prd_details"><?=$case_productDetail->title ?? ''?></span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">
                                    
                                    <?php if(!empty($case_productDetail->sale_price)){
                                    $case_price = $case_productDetail->sale_price; ?>
                                    <span class="strike_price">NPR <?=number_format($case_productDetail->price,2)?></span>
                                    <span class="list_info_prd_details">NPR <?=number_format($case_productDetail->sale_price,2)?></span>
                                    <input type="hidden" name="case_price" id="case_price" value="<?=$case_productDetail->sale_price?>">
                                    <?php } else{
                                    $case_price = $case_productDetail->price; ?>
                                    <span class="list_info_prd_details">NPR <?=number_format($case_productDetail->price,2)?></span>
                                    <input type="hidden" name="case_price" id="case_price" value="<?=$case_productDetail->price?>">
                                    <?php } ?>
                                </div>    
                            </div>
                            </div>
                            <div class="summary_box">
                                <div class="row">
                                <div class="col-lg-7">
                                    <strong>CPU</strong>
                                </div>
                                <div class="col-lg-2">
                                    <strong>Qty</strong>
                                </div>
                                 <div class="col-lg-3">
                                    <strong>Price</strong>
                                </div>
                            </div>
                            <div class="row cpu_summary_box">
                                <?php 
                                    
                                    $cpu_productDetail = productDetailById($cpu_product_id);
                                    //$cpu_prod_variations = getProdvariationById($cpu_product_id);
//$cpu_variation_id = (!empty($cpu_prod_variations[0])) ? $cpu_prod_variations[0]->id : '';
//$cpu_color_id = (!empty($cpu_prod_variations[0])) ? $cpu_prod_variations[0]->color_id : '';
                                ?>
                                <div class="col-lg-7">
                                    <input type="hidden" name="cpu_id" id="cpu_id" value="<?=$cpu_id?>">
                                    <input type="hidden" name="cpu_prod_id" id="cpu_prod_id" value="<?=$cpu_product_id?>">
                                    <input type="hidden" name="cpu_variation_id" value="<?=$cpu_variation_id?>">
                                    <input type="hidden" name="cpu_variation_color_id" value="<?=$cpu_color_id?>">
                                    <span class="list_info_prd_details"><?=$cpu_productDetail->title ?? ''?></span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">
                                    
                                    <?php if(!empty($cpu_productDetail->sale_price)){
                                    $cpu_price = $cpu_productDetail->sale_price; ?>
                                    <span class="strike_price">NPR <?=number_format($cpu_productDetail->price,2)?></span>
                                    <span class="list_info_prd_details">NPR <?=number_format($cpu_productDetail->sale_price,2)?></span>
                                    <input type="hidden" name="cpu_price" id="cpu_price" value="<?=$cpu_productDetail->sale_price?>">
                                    <?php } else{
                                    $cpu_price = $cpu_productDetail->price; ?>
                                    <span class="list_info_prd_details">NPR <?=number_format($cpu_productDetail->price,2)?></span>
                                    <input type="hidden" name="cpu_price" id="cpu_price" value="<?=$cpu_productDetail->price?>">
                                    <?php } ?>
                                </div>    
                            </div>
                            </div>
                            <div class="summary_box">
                                <div class="row">
                                <div class="col-lg-7">
                                    <strong>GPU</strong>
                                </div>
                                <div class="col-lg-2">
                                    <strong>Qty</strong>
                                </div>
                                 <div class="col-lg-3">
                                    <strong>Price</strong>
                                </div>
                            </div>
                            <div class="row gpu_summary_box">
                                <?php 
                                    
                                    $gpu_productDetail = productDetailById($gpu_product_id);
                                ?>
                                <div class="col-lg-7">
                                    <input type="hidden" name="gpu_id" id="gpu_id" value="<?=$gpu_id?>">
                                    <input type="hidden" name="gpu_prod_id" id="gpu_prod_id" value="<?=$gpu_product_id?>">
                                    <input type="hidden" name="gpu_prod_variation_id" id="gpu_prod_variation_id" value="<?=$gpu_variation_id?>">
                                    <input type="hidden" name="gpu_variation_color_id" id="gpu_variation_color_id" value="<?=$gpu_color_id?>">
                                    <span class="list_info_prd_details"><?=$gpu_productDetail->title ?? ''?></span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">
                                    
                                    <?php if(!empty($gpu_productDetail->sale_price)){
                                    $gpu_price = $gpu_productDetail->sale_price; ?>
                                    <span class="strike_price">NPR <?=number_format($gpu_productDetail->price,2)?></span>
                                    <span class="list_info_prd_details">NPR <?=number_format($gpu_productDetail->sale_price,2)?></span>
                                    <input type="hidden" name="gpu_price" id="gpu_price" value="<?=$gpu_productDetail->sale_price?>">
                                    <?php } else{
                                    $gpu_price = $gpu_productDetail->price; ?>
                                    <span class="list_info_prd_details">NPR <?=number_format($gpu_productDetail->price,2)?></span>
                                    <input type="hidden" name="gpu_price" id="gpu_price" value="<?=$gpu_productDetail->price?>">
                                   <?php } ?>
                                </div>    
                            </div>
                            </div>
                            <div class="summary_box">
                                <div class="row">
                                <div class="col-lg-7">
                                    <strong>Motherboards</strong>
                                </div>
                                <div class="col-lg-2">
                                    <strong>Qty</strong>
                                </div>
                                 <div class="col-lg-3">
                                    <strong>Price</strong>
                                </div>
                            </div>
                            <div class="row motherboard_summary_box">
                                <?php 
                                    
                                    $mtherboard_productDetail = productDetailById($mtherboard_product_id);
                                ?>
                                <div class="col-lg-7">
                                    <input type="hidden" name="mtherboard_id" id="mtherboard_id" value="<?=$mthrboard_id?>">
                                     <input type="hidden" name="mtherboard_product_id" id="mtherboard_product_id" value="<?=$mtherboard_product_id?>">
                                     <input type="hidden" name="mtherboard_prod_variation_id" id="mtherboard_prod_variation_id" value="<?=$mtherboard_variation_id?>">
                                    <input type="hidden" name="mtherboard_variation_color_id" id="mtherboard_variation_color_id" value="<?=$mtherboard_color_id?>">
                                    <span class="list_info_prd_details"><?=$mtherboard_productDetail->title ?? ''?></span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">
                                    
                                    <?php if(!empty($mtherboard_productDetail->sale_price)){ 
                                    $mtherboard_price = $mtherboard_productDetail->sale_price; ?>
                                    <span class="strike_price">NPR <?=number_format($mtherboard_productDetail->price,2)?></span>
                                    <span class="list_info_prd_details">NPR <?=number_format($mtherboard_productDetail->sale_price,2)?></span>
                                    <input type="hidden" name="mothrboard_price" id="mothrboard_price" value="<?=$mtherboard_productDetail->sale_price?>">
                                    <?php } else{
                                    $mtherboard_price = $mtherboard_productDetail->price; ?>
                                    <span class="list_info_prd_details">NPR <?=number_format($mtherboard_productDetail->price,2)?></span>
                                    <input type="hidden" name="mothrboard_price" id="mothrboard_price" value="<?=$mtherboard_productDetail->price?>">
                                    <?php } ?>
                                </div>    
                            </div>  
                            </div>
                        </div>
                        <div class="buy_product_detail">
                            <div class="summary_box">
                                 <div class="row">
                                <div class="col-lg-7">
                                    <strong>RAM</strong>
                                </div>
                                <div class="col-lg-2">
                                    <strong>Qty</strong>
                                </div>
                                 <div class="col-lg-3">
                                    <strong>Price</strong>
                                </div>
                            </div>
                            <div class="row ram_summary_box">
                                <?php 
                                    $ram_productDetail = productDetailById($ram_product_id);
                                    $terms = getTermsByTypeandProductId($prod_id,'ram');
                                    $ram_capacity = $terms[0]->term_id ?? '';
                                    
                                ?>
                                <div class="col-lg-7">
                                    <input type="hidden" name="ram_id" id="ram_id" value="<?=$ram_id?>">
                                    <input type="hidden" name="ram_product_id" id="ram_product_id" value="<?=$ram_product_id?>">
                                    <input type="hidden" name="ram_qty" id="ram_qty" value="<?=$ram_qty?>">
                                    <input type="hidden" name="ram_capacity" id="ram_capacity" value="<?=termRamNameById($ram_capacity)->title ?? ''?>">
                                    <span class="list_info_prd_details"><?=$ram_productDetail->title ?? ''?></span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details"><?=$ram_qty?></span>
                                </div>
                                <div class="col-lg-3">
                                    
                                    <?php if(!empty($ram_productDetail->sale_price)){
                                    $ram_price = $ram_productDetail->sale_price*$ram_qty; ?>
                                    <span class="strike_price">NPR <?=number_format($ram_productDetail->price*$ram_qty,2)?></span>
                                    <span class="list_info_prd_details">NPR <?=number_format($ram_productDetail->sale_price*$ram_qty,2)?></span>
                                    <input type="hidden" name="ram_price" id="ram_price" value="<?=$ram_productDetail->sale_price*$ram_qty?>">
                                    <?php } else{ ?>
                                    <?php $ram_price = $ram_productDetail->price*$ram_qty; ?>
                                    <span class="list_info_prd_details">NPR <?=number_format($ram_productDetail->price*$ram_qty,2)?></span>
                                    <input type="hidden" name="ram_price" id="ram_price" value="<?=$ram_productDetail->price*$ram_qty?>">
                                    <?php } ?>
                                </div>    
                            </div>
                            </div>
                            <div class="summary_box">
                                <div class="row">
                                <div class="col-lg-7">
                                    <strong>Storage</strong>
                                </div>
                                <div class="col-lg-2">
                                    <strong>Qty</strong>
                                </div>
                                 <div class="col-lg-3">
                                    <strong>Price</strong>
                                </div>
                            </div>
                            <div class="row storage_summary_box">
                                <?php 
                                    $storage_productDetail = productDetailById($storage_product_id);
                                    $terms_ssd = getTermsByTypeandProductId($storage_product_id,'ssd');
                                    $ssd_capacity = $terms_ssd[0]->term_id ?? '';
                                ?>
                                <div class="col-lg-7">
                                    <input type="hidden" name="storage_id" id="storage_id" value="<?=$storage_id?>">
                                    <input type="hidden" name="storage_product_id" id="storage_product_id" value="<?=$storage_product_id?>">
                                    <input type="hidden" name="ssd_qty" id="ssd_qty" value="<?=$ssd_qty?>">
                                    <input type="hidden" name="ssd_capacity" id="ssd_capacity" value="<?=termSSDNameById($ssd_capacity)->title ?? ''?>">
                                    <span class="list_info_prd_details"><?=$storage_productDetail->title ?? ''?></span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details"><?=$ssd_qty?></span>
                                </div>
                                <div class="col-lg-3">
                                    
                                    <?php if(!empty($storage_productDetail->sale_price)){
                                    $storage_price = $storage_productDetail->sale_price*$ssd_qty; ?>
                                    <span class="strike_price">NPR <?=number_format($storage_productDetail->price*$ssd_qty,2)?></span>
                                    <span class="list_info_prd_details">NPR <?=number_format($storage_productDetail->sale_price*$ssd_qty,2)?></span>
                                    <input type="hidden" name="storage_price" id="storage_price" value="<?=$storage_productDetail->sale_price*$ssd_qty?>">
                                    <?php } else{
                                    $storage_price = $storage_productDetail->price*$ssd_qty; ?>
                                    <span class="list_info_prd_details">NPR <?=number_format($storage_productDetail->price*$ssd_qty,2)?></span>
                                    <input type="hidden" name="storage_price" id="storage_price" value="<?=$storage_productDetail->price*$ssd_qty?>">
                                    <?php } ?>
                                </div>    
                            </div>
                            </div>
                            <div class="summary_box">
                                <div class="row">
                                <div class="col-lg-7">
                                    <strong>Cooling</strong>
                                </div>
                                <div class="col-lg-2">
                                    <strong>Qty</strong>
                                </div>
                                 <div class="col-lg-3">
                                    <strong>Price</strong>
                                </div>
                            </div>
                            <div class="row cooling_summary_box">
                                <?php 
                                    
                                    $cooling_productDetail = productDetailById($cooling_product_id);
                                ?>
                                <div class="col-lg-7">
                                    <input type="hidden" name="cooling_id" id="cooling_id" value="<?=$cooling_id?>">
                                    <input type="hidden" name="cooling_product_id" id="cooling_product_id" value="<?=$cooling_product_id?>">
                                    <input type="hidden" name="cooling_prod_variation_id" id="cooling_prod_variation_id" value="<?=$cooling_variation_id?>">
                                    <input type="hidden" name="cooling_variation_color_id" id="cooling_variation_color_id" value="<?=$cooling_color_id?>">
                                    <span class="list_info_prd_details"><?=$cooling_productDetail->title ?? ''?></span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">
                                    
                                    <?php if(!empty($cooling_productDetail->sale_price)){
                                    $cooling_price = $cooling_productDetail->sale_price; ?>
                                    <span class="strike_price">NPR <?=number_format($cooling_productDetail->price,2)?></span>
                                    <span class="list_info_prd_details">NPR <?=number_format($cooling_productDetail->sale_price,2)?></span>
                                    <input type="hidden" name="cooling_price" id="cooling_price" value="<?=$cooling_productDetail->sale_price?>">
                                    <?php } else{
                                    $cooling_price = $cooling_productDetail->price; ?>
                                    <span class="list_info_prd_details">NPR <?=number_format($cooling_productDetail->price,2)?></span>
                                    <input type="hidden" name="cooling_price" id="cooling_price" value="<?=$cooling_productDetail->price?>">
                                    <?php } ?>
                                </div>    
                            </div>
                            </div>
                            <div cclass="summary_box">
                                <div class="row">
                                <div class="col-lg-7">
                                    <strong>Power Supplies</strong>
                                </div>
                                <div class="col-lg-2">
                                    <strong>Qty</strong>
                                </div>
                                 <div class="col-lg-3">
                                    <strong>Price</strong>
                                </div>
                            </div>
                            <div class="row power_summary_box">
                                <?php 
                                    
                                    $pwrsupply_productDetail = productDetailById($supply_product_id);
                                ?>
                                <div class="col-lg-7">
                                    <input type="hidden" name="supply_id" id="supply_id" value="<?=$pwrsupply_id?>">
                                    <input type="hidden" name="supply_product_id" id="supply_product_id" value="<?=$supply_product_id?>">
                                    <input type="hidden" name="supply_variation_id" id="supply_variation_id" value="<?=$supply_variation_id?>">
                                    <input type="hidden" name="supply_variation_color_id" id="supply_variation_color_id" value="<?=$supply_color_id?>">
                                    <span class="list_info_prd_details"><?=$pwrsupply_productDetail->title ?? ''?></span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">1</span>
                                </div>
                                <div class="col-lg-3">
                                    
                                    <?php if(!empty($pwrsupply_productDetail->sale_price)){
                                    $supply_price = $pwrsupply_productDetail->sale_price; ?>
                                    <span class="strike_price">NPR <?=number_format($pwrsupply_productDetail->price,2)?></span>
                                    <span class="list_info_prd_details">NPR <?=number_format($pwrsupply_productDetail->sale_price,2)?></span>
                                    <input type="hidden" name="pwrsupply_price" id="pwrsupply_price" value="<?=$pwrsupply_productDetail->sale_price?>">
                                    <?php } else{ 
                                    $supply_price = $pwrsupply_productDetail->price; ?>
                                    <span class="list_info_prd_details">NPR <?=number_format($pwrsupply_productDetail->price,2)?></span>
                                    <input type="hidden" name="pwrsupply_price" id="pwrsupply_price" value="<?=$pwrsupply_productDetail->price?>">
                                    <?php } ?>
                                </div>    
                            </div>
                            </div>  
                        </div>
                        <div class="buy_product_detail">
                            
                            <!--software start-->
                                <div class="summary_box">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <strong>Software</strong>
                                        </div>
                                        <div class="col-lg-2">
                                            <strong>Qty</strong>
                                        </div>
                                         <div class="col-lg-3">
                                            <strong>Price</strong>
                                        </div>    
                                    </div>
                                    
                                    <?php  $software_price = 0;
                                    if(!empty($software_product_id)){ 
                                    $software_prod_detail = productDetailById($software_product_id);
                                    $software_qty = 1;?>
                                    <div class="row software_summary_box">
                                        <div class="col-lg-7">
                                            <input type="hidden" name="software_id" id="software_id" value="<?=$software_prod_detail->product_categories;?>">
                                            <input type="hidden" name="software_product_id" id="software_product_id" value="<?=$software_product_id;?>">
                                            <span class="list_info_prd_details"><?=$software_prod_detail->title ?? ''?></span>
                                        </div>
                                        <div class="col-lg-2">
                                            <span class="list_info_prd_details"><?=$software_qty?></span>
                                        </div>
                                        <div class="col-lg-3">
                                         <?php if(!empty($software_prod_detail->sale_price)){
                                            $software_price = $software_prod_detail->sale_price*$software_qty; ?>
                                            <span class="strike_price">NPR <?=number_format($software_prod_detail->price*$software_qty,2)?></span>
                                            <span class="list_info_prd_details">NPR <?=number_format($software_prod_detail->sale_price*$software_qty,2)?></span>
                                          
                                            <?php } else{ 
                                            $software_price = $software_prod_detail->price*$software_qty; ?>
                                            <span class="list_info_prd_details">NPR <?=number_format($software_prod_detail->price*$software_qty,2)?></span>
                                            <?php } ?>
                                            <input type="hidden" name="software_price" id="software_price" value="<?=$software_price?>">
                                        </div>
                                    </div>
                                    <?php }else{
                                    ?>
                                    <div class="row software_summary_box">
                                    <div class="col-lg-7">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-3">
                                    <span class="list_info_prd_details">NPR 0.00</span>
                                </div>
                                    </div>
                                    <?php
                                    } ?>
                                </div>
                            
                            <!--software end-->
                            
                            <!--service start-->
                                <div class="summary_box">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <strong>Services</strong>
                                        </div>
                                        <div class="col-lg-2">
                                            <strong>Qty</strong>
                                        </div>
                                         <div class="col-lg-3">
                                            <strong>Price</strong>
                                        </div>    
                                    </div>
                                    
                                    <?php  $service_price = 0;
                                    if(!empty($services_product_id)){ 
                                    $service_prod_detail = productDetailById($services_product_id);
                                    $service_qty = 1;?>
                                    <div class="row service_summary_box">
                                        <div class="col-lg-7">
                                            <input type="hidden" name="service_id" id="service_id" value="<?=$service_prod_detail->product_categories?>">
                                            <input type="hidden" name="service_product_id" id="service_product_id" value="<?=$services_product_id?>">
                                            <span class="list_info_prd_details"><?=$service_prod_detail->title ?? ''?></span>
                                        </div>
                                        <div class="col-lg-2">
                                            <span class="list_info_prd_details"><?=$service_qty?></span>
                                        </div>
                                        <div class="col-lg-3">
                                         <?php if(!empty($service_prod_detail->sale_price)){
                                            $service_price = $service_prod_detail->sale_price*$service_qty; ?>
                                            <span class="strike_price">NPR <?=number_format($service_prod_detail->price*$service_qty,2)?></span>
                                            <span class="list_info_prd_details">NPR <?=number_format($service_prod_detail->sale_price*$service_qty,2)?></span>
                                          
                                            <?php } else{ 
                                            $service_price = $service_prod_detail->price*$service_qty; ?>
                                            <span class="list_info_prd_details">NPR <?=number_format($service_prod_detail->price*$service_qty,2)?></span>
                                            <?php } ?>
                                            <input type="hidden" name="service_price" id="service_price" value="<?=$service_price?>">
                                        </div>
                                    </div>
                                    <?php }else{
                                    ?>
                                    <div class="row service_summary_box">
                                    <div class="col-lg-7">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-3">
                                    <span class="list_info_prd_details">NPR 0.00</span>
                                </div>
                                    </div>
                                    <?php
                                    } ?>
                                </div>
                            
                            <!--service end-->

                            <div class="summary_box">
                                <div class="row">
                                <div class="col-lg-7">
                                    <strong>RGB Lighting</strong>
                                </div>
                                <div class="col-lg-2">
                                    <strong>Qty</strong>
                                </div>
                                 <div class="col-lg-3">
                                    <strong>Price</strong>
                                </div>
                            </div>
                            <div class="row rgb_summary_box">
                            <div class="col-lg-7">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-3">
                                    <span class="list_info_prd_details">NPR 0.00</span>
                                </div>
                            </div>
                            </div>
                            <div class="summary_box">
                            <div class="row">
                                <div class="col-lg-7">
                                    <strong>Monitors</strong>
                                    
                                </div>
                                <div class="col-lg-2">
                                    <strong>QTY</strong>
                                    
                                </div>
                                <div class="col-lg-3">
                                    <strong>Price</strong>
                                    
                                </div>    
                            </div>
                            
                            <?php  $monitor_price = 0;
                            if(!empty($monitor_product_id)){ 
                            $monitor_productDetail = productDetailById($monitor_product_id);
                            $monitor_qty = 1;?>
                            <div class="row moniter_summary_box">
                                <div class="col-lg-7">
                                    <input type="hidden" name="monitor_id" id="monitor_id" value="<?=$monitor_productDetail->product_categories;?>">
                                    <input type="hidden" name="monitor_product_id" id="monitor_product_id" value="<?=$monitor_product_id;?>">
                                    <span class="list_info_prd_details"><?=$monitor_productDetail->title ?? ''?></span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details"><?=$monitor_qty?></span>
                                </div>
                                <div class="col-lg-3">
                                 <?php if(!empty($monitor_productDetail->sale_price)){
                                    $monitor_price = $monitor_productDetail->sale_price*$monitor_qty; ?>
                                    <span class="strike_price">NPR <?=number_format($monitor_productDetail->price*$monitor_qty,2)?></span>
                                    <span class="list_info_prd_details">NPR <?=number_format($monitor_productDetail->sale_price*$monitor_qty,2)?></span>
                                  
                                    <?php } else{ 
                                    $monitor_price = $monitor_productDetail->price*$monitor_qty; ?>
                                    <span class="list_info_prd_details">NPR <?=number_format($monitor_productDetail->price*$monitor_qty,2)?></span>
                                    <?php } ?>
                                    <input type="hidden" name="monitor_price" id="monitor_price" value="<?=$monitor_price?>">
                                </div>
                            </div>
                            <?php }else{
                            ?>
                            <div class="row moniter_summary_box">
                                <div class="col-lg-7">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-3">
                                    <span class="list_info_prd_details">NPR 0.00</span>
                                </div>
                            </div>
                            <?php
                            } ?>
                            </div>
                            <div class="summary_box">
                            <div class="row">
                                <div class="col-lg-7">
                                    <strong>Peripherals</strong>
                                    
                                </div>
                                <div class="col-lg-2">
                                    <strong>QTY</strong>
                                    
                                </div>
                                <div class="col-lg-3">
                                    <strong>Price</strong>
                                    
                                </div>    
                            </div>
                            <div class="row peripheral_summary_box">
                            <div class="col-lg-7">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-3">
                                    <span class="list_info_prd_details">NPR 0.00</span>
                                </div>
                            </div>
                            </div>
                            <div class="summary_box">
                             <div class="row">
                                <div class="col-lg-7">
                                    <strong>Extras</strong>
                                </div>
                                <div class="col-lg-2">
                                    <strong>QTY</strong>
                                </div>
                                <div class="col-lg-3">
                                    <strong>Price</strong>
                                </div>    
                            </div>
                            <div class="row extra_summary_box">
                                <div class="col-lg-7">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="list_info_prd_details">N/A</span>
                                </div>
                                <div class="col-lg-3">
                                    <span class="list_info_prd_details">NPR 0.00</span>
                                </div>
                            </div>
                            </div>
                        </div>      
                    </div>
                  </div>
                  <div class="next_btn_big"> 
                  <input type="hidden" name="page_type" value="pc_builder">
                        <button class="primary-btn" type="submit"> Add to Cart <span class="arrow_right"></span></button>
                  </div>  
                 </div>
            </div>
        </div> 
        
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="total_count_ship"> 
                <?php $total_amount = $case_price+$cpu_price+$gpu_price+$mtherboard_price+$ram_price+$storage_price+$cooling_price+$supply_price+$software_price+$service_price+$monitor_price; ?>
                    <strong>Estimated Shipping: </strong><?=date('d/m/Y',strtotime('+4 day'));?> | <strong>Subtotal: NPR <span class="total_amount"><?=number_format($total_amount,2)?></span></strong>
                </div> 
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

<!-- Checkout Section End -->
<script src="<?=url('/public/js/jquery.nice-select.min.js')?>"></script>
<script src="<?=url('/public/js/main.js')?>"></script>
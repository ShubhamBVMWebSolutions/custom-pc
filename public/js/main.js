'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.filter__controls li').on('click', function () {
            $('.filter__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.product__filter').length > 0) {
            var containerEl = document.querySelector('.product__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        //console.log(encodeURI(bg))
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Search Switch
    $('#search-switch').on('click', function () {
        $('.search-model').fadeIn(400, function(){
            $("#search-input").focus();
        });
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('');
        });
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });


    //Canvas Menu
    $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    /*-----------------------
        Hero Slider
    ------------------------*/
    $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        nav: true,
        navText: ["<span class='arrow_left'><span/>", "<span class='arrow_right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 2500,
        autoHeight: false,
        autoplay: true
    });

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*-------------------
		Radio Btn
	--------------------- */
    $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").on('click', function () {
        $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------
		Scroll
	--------------------- */
    $(".nice-scroll").niceScroll({
        cursorcolor: "#0d0d0d",
        cursorwidth: "5px",
        background: "#e5e5e5",
        cursorborder: "",
        autohidemode: true,
        horizrailenabled: false
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview start
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end


    // Uncomment below and use your date //

    /* var timerdate = "2020/12/30" */

    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"));
    });

    /*------------------
		Magnific
	--------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend ('<span class="fa fa-angle-up inc qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-down dec qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        var maxValue = $button.parent().find('input').attr('max');

        if ($button.hasClass('inc')) {
            console.log(parseInt(oldValue))
            //var newVal = parseFloat(oldValue) + 1;
            if(parseInt(oldValue) < parseInt(maxValue)){
                var newVal = parseFloat(oldValue) + 1;
            }
            else{
              var newVal =   parseFloat(oldValue)
            }
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find('input').val(newVal);
    });

    var proQty = $('.pro-qty-2');
    proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        var maxValue = $button.parent().find('input').attr('max');
        if ($button.hasClass('inc')) {
            //var newVal = parseFloat(oldValue) + 1;
            if(parseInt(oldValue) < parseInt(maxValue)){
                var newVal = parseFloat(oldValue) + 1;
            }
            else{
              var newVal =   parseFloat(oldValue)
            }
            var id = $button.parent().find('input').data('id');

             $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });

            $.ajax({
          url: SITE_URL+'/update-cart',
          method: "patch",
          data: {id: id, quantity: newVal},
          success: function (response) {
              window.location.reload();
          }
       });
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }

              var id = $button.parent().find('input').data('id');

             $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });

            $.ajax({
          url: SITE_URL+'/update-cart',
          method: "patch",
          data: {id: id, quantity: newVal},
          success: function (response) {
              window.location.reload();
          }
       });
        }
        $button.parent().find('input').val(newVal);
    });

    /*------------------
        Achieve Counter
    --------------------*/
    $('.cn_num').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
    /*------------------
        Sticky Header
    --------------------*/
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("main_header");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }


    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        infinite: true,
        dots: false,
        prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
            nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
        pauseOnHover: false,
        pauseOnFocus: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });

    $("#review_form").submit(function(e){
        e.preventDefault();

        var form_data = new FormData(this);
        $(".gif_ajax_loadr").show();

        $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });

        $.ajax({
			url: SITE_URL+'/ajax/submit-review',
			type: 'POST',
			cache       : false,
            contentType : false,
            processData : false,
            dataType:'json',
			data : form_data,
			success : function(data) {

			    if(data != ''){
			        $(".gif_ajax_loadr").hide();
					console.log(data.status);
					if(data.status == 'success'){
					    $("#review_form")[0].reset();
					    $(".testi_msg").html('<p style="color: green;">Your Feedback is submitted successfully</p>');
					}
					else{
					    $(".gif_ajax_loadr").hide();
					    $("#review_form")[0].reset();

					  $(".testi_msg").html('<p style="color: red;">Your Feedback is failed</p>');
					}
			    }
				},
			error: function(error){
                console.log("Error:");
                console.log(error);
                 }
		});
    });

    $("#resend_link").click(function(){
        var email = $("#user_email").val();

        $.ajaxSetup({
            headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });

        $.ajax({
            url: SITE_URL+'/ajax/resend_link',
			type: 'POST',
            dataType:'json',
			data : {email:email},
			success : function(data) {
                console.log(data);
                if (data.ststus == 1) {
                    $(".succ_send_msg").html('<p class="alert alert-success">'+data.message+'</p>');
                    setTimeout(function(){
                        location.reload();
                        },3000)
                }else{

                    $(".danger_send_msg").html('<p class="alert alert-danger">'+data.message+'</p>');

                }
            },
			error: function(data){
                alert('ok');
                console.log("Error:");
                console.log(data);
                $(".danger_send_msg").html('<p class="alert alert-danger">'+error+'</p>');
            }
		});
    });

    //change color ajax
    $("div #color_variation").on('change',function(){
        var variation_id = $(this).val();
        var variation_price = $(this).attr("data-price");
        var variation_sku = $(this).attr("data-sku");
        var product_id = $("#product_id").val();
        $("#product_gallery_row").empty();
        $(".color_label").removeClass('active');
        $(this).parent('label').addClass('active');
        $(".ajax_loader").show();
        $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });

        $.ajax({
			url: SITE_URL+'/ajax/change_color',
			type: 'POST',
            //dataType:'json',
			data : {variation_id:variation_id, product_id:product_id},
			success : function(data) {
			    $(".ajax_loader").hide();
			   console.log(data);
			   $('.priceTag').text('NPR '+ variation_price);
			   $('.sku_text #skuSpan').text(variation_sku);
			    $("#product_gallery_row").html(data);
			    setTimeout( magnifyImage, 1000);
				},

		});
    });


    $("#apply_code").click(function(){
        var coupon_code = $("#coupon_code").val();
        var amount = $(this).val();

        $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });

        $.ajax({
			url: SITE_URL+'/ajax/apply_coupon',
			type: 'POST',
            dataType:'json',
			data : {coupon_code:coupon_code, amount:amount},
			success : function(data) {
			    //$(".ajax_loader").hide();
			   console.log(data.status);
			   if(data.status == 'error'){
			       $("#cop_err").html('<b>'+data.message+'</b>');
			   }
			   if(data.status == 'success'){
			       toastr.success("Coupon Applied Successfully.");
			       setInterval(function(){location.reload()}, 2000);


			   }

				},

		});
    });


    $("div #change_color").click(function(){

        var variation_id = $(this).val();
        var color_id = $(this).data('color');
        var product_id = $(this).data('product_id');

        $('.color_label').removeClass('active');
        $(this).parent().addClass('active')

        $("div #change_color").removeAttr('checked','checked');
        $(this).attr('checked','checked')
        $("#loader").show();

        $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });

        $.ajax({
			url: SITE_URL+'/ajax/pc_color_change',
			type: 'POST',
            dataType:'json',
			data : {variation_id:variation_id, color_id:color_id, product_id:product_id},
			success : function(data) {
			    $("#loader").hide();
			   //console.log(data);
			  if(data.status == 'single_image'){
			      $("#prod_single_img"+product_id).html(data.single_img_html)
			      $("#prod_slider_area"+product_id).html(data.slider_html)
			      $("#selected_color_name"+product_id).text(data.color_name);
			  }

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
			      $("#prod_single_img"+product_id).html(data.single_img_html)
			      $("#addon_prod_slider_area"+product_id).html(data.slider_html)
			      $("#selected_color_name"+product_id).text(data.color_name);
			  }

				},

		});
    });

    $("div #chip_sub_cat").click(function(){
       var cat_id = $(this).val()
       var added_prod_id = $(this).data('added_product');
       var default_prod_id = $("#default_prod_id").val();
       var type = $(this).data('name');
       /*var case_prod_id = $("#case_prod_id").val();
        var cooling_product_id = $("#cooling_product_id").val();
        var cpu_prod_id = $("#cpu_prod_id").val();
        var gpu_prod_id = $("#gpu_prod_id").val();
        var mtherboard_product_id = $("#mtherboard_product_id").val();
        var ram_product_id = $("#ram_product_id").val();
        var storage_product_id = $("#storage_product_id").val();
        var supply_product_id = $("#supply_product_id").val();*/
       $(".chip_sub_cat").removeClass('active_cat')
       $(this).addClass('active_cat')

       $(".current_chipset_cat").text(type)

       $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });

        $.ajax({
			url: SITE_URL+'/ajax/pc_chipcat_change',
			//url: SITE_URL+'/ajax/add_pc_product',
			type: 'POST',
            dataType:'html',
			data : {cat_id:cat_id,added_prod_id:added_prod_id, default_prod_id:default_prod_id, type:type
			},
			beforeSend : function(){
			$("#loader").show();
			},
			success : function(data) {
			    $("#loader").hide();
			   //console.log(data);
			  $(".chipseselection_bx").hide();
			  //$("#base_product_list").show().html(data)
			  $("#base_product_list").html(data)
				},

		});
    });

    $("#select_chipset").click(function(){
        $(".chipseselection_bx").show();
        $("#base_product_list").hide();
    });

    $("div #pcbuild_add_cat").click(function(){
       var cat_id = $(this).val();
       var default_prod_id = $("#default_prod_id").val();
       var case_prod_id = $("#case_prod_id").val();
        var cooling_product_id = $("#cooling_product_id").val();
        var cpu_prod_id = $("#cpu_prod_id").val();
        var gpu_prod_id = $("#gpu_prod_id").val();
        var mtherboard_product_id = $("#mtherboard_product_id").val();
        var ram_product_id = $("#ram_product_id").val();
        var storage_product_id = $("#storage_product_id").val();
        var supply_product_id = $("#supply_product_id").val();

       $("div #pcbuild_add_cat").removeClass('active_cat')
       $(this).addClass('active_cat');

       var name = $(this).data('name');
       var type = name;
       $(".current_chipset_cat").text(name)

       $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });

        /*$.ajax({
            url: SITE_URL+'/ajax/add_pc_product',
            type: 'POST',
            dataType:'html',
            data : {type:type, cat_id:cat_id, default_prod_id:default_prod_id, case_prod_id:case_prod_id,
                cooling_product_id:cooling_product_id, cpu_prod_id:cpu_prod_id, gpu_prod_id:gpu_prod_id, mtherboard_product_id:mtherboard_product_id, ram_product_id:ram_product_id,
                storage_product_id:storage_product_id, supply_product_id:supply_product_id
            },
            beforeSend : function(){
                $("#loader").show();
            },
            success : function(data) {
                console.log(data.html)
                $("#loader").hide();
               $("#pcbuild_main_div").html(data)

                },
        });*/

         $.ajax({
			url: SITE_URL+'/ajax/pc_addon_cat_change',
			type: 'POST',
            //dataType:'html',
			data : {cat_id:cat_id, name:name},
			beforeSend : function(){
			    $("#loader").show();
			$("#add_on_prod_list").empty();
			},
			success : function(data) {
			    $("#loader").hide();
			   //console.log(data);
			  //$(".chipseselection_bx").hide();
			  $("#add_on_prod_list").show().html(data)
				},

		});
    });

     $("div #add_product").click(function(){

        var product_id = $(this).data('product');
        //$("#case_prod_id").val(product_id);
        var added_prod_id = product_id;
        var type = $(this).data('cat_type');
        var var_id = $("input[name=change_color"+product_id+"]:checked").val();
        var color_id = $("input[name=change_color"+product_id+"]:checked").data('color');
        var cat_id = $(this).data('cat_id');
        var case_id = $("#case_id").val();
        var default_prod_id = $("#default_prod_id").val();
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

        $(".prod_add_btn").removeClass('added_product_p').text('Add').removeAttr('disabled','disabled');
        $(this).addClass('added_product_p').text('Added');
        $(this).attr('disabled','disabled');

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
			peripheral_price:peripheral_price, extra_price:extra_price, qty:qty, added_prod_id:added_prod_id
			},
			beforeSend : function(){
			    $("#loader").show();
			},
			success : function(data) {
			    console.log('data', data)
			    $("#loader").hide();
			   //$("#pcbuild_main_div").html(data)
             var buttonHtml = '';
             if(data.product_details){
                if(type=='Case'){
                    $('.cart_title').html(data.product_details.title+' Build');
                    $('#caseImageCol').html('<img src="http://starhifi.com/uploads/product-media/'+data.product_details.image+'" alt="">');
                }
                var buttonHtml = '<div class="pc_img"><img src="http://starhifi.com/uploads/product-media/'+data.product_details.image+'"></div><div class="pc_conent"><h5>'+type+'</h5><p>'+data.product_details.title+'</p></div>';
             }


			  if(type == 'Case'){
                // console.log('summary_html', data);
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



     $("div #add_on_tab").click(function(){
        $(".addon_section_items").show();
        $(".base_section_items").hide();

    });

    $("div #summary_tab").click(function(){
        $(".addon_section_items").show();
        $(".base_section_items").hide();

    });

  $("div #base_tab").click(function(){
        $(".addon_section_items").hide();
        $(".base_section_items").show();

  });



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

			 $(".total_amount").text((data.total_amount.toLocaleString()).toFixed())

				},

		});
});


  var owl = $('.category_list');
    owl.owlCarousel({
        loop:true,
        nav:true,
        margin:15,
        dot:true,
        navText: ["<span class='arrow_left'><span/>", "<span class='arrow_right'><span/>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            960:{
                items:4
            },
            1200:{
                items:6
            }
        }
    });


var owl = $('.single_product_slider');
    owl.owlCarousel({
        loop:true,
        nav:true,
        margin:15,
        dot:true,
        navText: ["<span class='arrow_left'><span/>", "<span class='arrow_right'><span/>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            960:{
                items:4
            },
            1200:{
                items:5
            }
        }
});


// function toggleDropdown(e) {
//   const $dropdown = $(e.currentTarget),
//         $dropdownMenu = $dropdown.find('.dropdown-menu');

//   const $parentDropdown = $dropdown.closest('.dropdown').parent().closest('.dropdown');
//   if ($parentDropdown.length) {
//     $parentDropdown.removeClass('show').find('.dropdown-menu').removeClass('show');
//   }

//   $dropdown.siblings().removeClass('show').find('.dropdown-menu').removeClass('show');

//   setTimeout(function() {
//     const shouldOpen = e.type !== 'click' && $dropdown.is(':hover');
//     $dropdownMenu.toggleClass('show', shouldOpen);
//     $dropdown.toggleClass('show', shouldOpen);
//     $('[data-toggle="dropdown"]', $dropdown).attr('aria-expanded', shouldOpen);
//   }, e.type === 'mouseleave' ? 300 : 0);
// }


// $('body')
//   .on('mouseenter mouseleave','.dropdown',toggleDropdown)
//   .on('click', '.dropdown-menu a', toggleDropdown);



})(jQuery);

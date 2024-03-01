@php $route_name = Route::currentRouteName(); @endphp

@if($route_name !== 'continue.build')

<!-- Newsletter -->
    <!-- <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newsletter_text text-center" data-aos="fade-up">
                        <h4>🔥 {{SiteSettingByName('subscribe_title')}} 🔥</h4>
                        <p><?=SiteSettingByName('subscribe_subtitle')?></p>
                        <a class="primary-btn" href="{{SiteSettingByName('subscribe_btn_link')}}"> {{SiteSettingByName('subscribe_btn')}} <span class="arrow_right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<!-- Newsletter End -->


<!-- Newsletter box -->
<div class="newsletter_block"> 
        <div class="container">
             <div class="row">
                  <div class="newsletter_wrpa">
                        <h3 class="footer-newsletter">Get instant deals and exclusive offers!</h3>
                        <div class="newsletter_form">
                            <div class="news_inputs">
                                <div class="input_groups">
                                    <form action="{{ route('news-letter-submit') }}" method="post">
                                        <input class="" type="email" value="" name="email" id="email" placeholder="Enter your email">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </form>
                                </div>
                                <button>
                                    Subscribe
                                </button>    
                            </div>    
                            <div class="letter_message">
                                <p>By providing your email you agree that your personal information will be handled in accordance with our <a href="#">privacy policy</a>.</p>
                            </div>    
                        </div>    
                  </div>  
             </div>   
        </div>        
    </div> 
    <!-- Newsletter box end-->

<!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="{{url(Config::get('constants.SITE_IMAGE_PATHS').SiteSettingByName('site_footer_logo'))}}" alt=""></a>
                        </div>
                        <p>{{SiteSettingByName('footer_text')}}</p>                       
                    </div>

                </div>
                <div class="col-lg-3 footer_categories col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Categories</h6>
                        <ul>
                             @foreach(getallCategoriesFooter() as $cat)
                            <li><a href="{{route('view.product.category',['productcategorySlug' => $cat->slug])}}">{{$cat->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>About Us</h6>
                        <ul>
                            <li><a href="{{route('contact')}}">Contact Us</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Delivary</a></li>
                            <li><a href="#">Return & Exchanges</a></li>
                            <li><a href="#">Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Follow us on</h6>
                        <ul class="social_icons">
                            <li><a href="{{SiteSettingByName('facebook_url')}}"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                            <li><a href="{{SiteSettingByName('twitter_url')}}"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                            <li><a href="{{SiteSettingByName('insta_url')}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="{{SiteSettingByName('youtube_url')}}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                            <li><a href="{{SiteSettingByName('twitch_url')}}"><i class="fa fa-twitch" aria-hidden="true"></i></a></li> 
                            <li><a href="{{SiteSettingByName('reddit_url')}}"><i class="fa fa-reddit-square" aria-hidden="true"></i></a></li>    
                        </ul>    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 footer_border_t">
                    <div class="footer__copyright__text">
                        <p>© {{SiteSettingByName('site_name')}}. 2022 All Rights Reserved </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
@endif   
    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">X</div>
            <form class="search-model-form" action="{{route('search.result')}}" method="get">
                <input type="text" name="s" id="search-input" placeholder="Search here.....">
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
            </form>
        </div>
    </div>
    <!-- Search End -->
    
<!-- Loader -->
<div id="preloader" class="pre_loader_loading" style="display: none;">
    <div class="spinner"></div>
  </div>
<!-- Loader --> 

<!-- Js Plugins -->
    <script src="{{url('public/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{url('public/js/bootstrap.min.js')}}"></script>
    <script src="{{url('public/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{url('public/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{url('public/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{url('public/js/jquery.countdown.min.js')}}"></script>
    <script src="{{url('public/js/jquery.slicknav.js')}}"></script>
    <script src="{{url('public/js/mixitup.min.js')}}"></script>
    <script src="{{url('public/js/owl.carousel.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script src="{{url('public/js/aos.js')}}"></script>
    <script src="{{url('public/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script>
      AOS.init({
       once: true
    })
    </script>
    
    
     <script>
$(document).ready(function(){
var owl = $(".related_prod_slider");
  owl.owlCarousel({
    items: 3,
    margin: 10,
    loop: true,
    nav: true,
    dots: true,
    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
  });
});      
        
</script>

<script type="text/javascript">
$(document).ready(function(){
    $(".remove-from-cart").click(function (e) {
       e.preventDefault();
   
       var ele = $(this);
         
       //if(confirm("Are you sure? you want to delete?")) {
           $.ajax({
               url: '{{ url('/ajax/delete_cart') }}',
               method: "DELETE",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
               success: function (response) {
                   window.location.reload();
               }
           });
       //}
   }); 
   
   $(".cart_qty_div .inc").click(function(){
       var qty = $("#quantity").val();
       //alert(qty)
   });
});
   
</script>

<script type="text/javascript">
        $(document).ready(function(){
           $(".selected_btn").click(function(){
            $(".custom_pc_build_popup").hide();            
          });
          $(".selected_btn").click(function(){
            $(".cpu_processor").show();  
            $(".modal-backdrop").hide();
            $("body").addClass('hide_popup_overlay');                 
          }); 
          
          $("#create_account").click(function(){
             if($(this).is(":checked")){
                 $("#soi_password_box").show();
                 $("#username").attr('required','required')
                 $("#password").attr('required','required')
             } 
             else{
                 $("#soi_password_box").hide();
                 $("#username").removeAttr('required','required')
                 $("#password").removeAttr('required','required')
             }
          });
        });
    </script>
    


@if($route_name == 'pcbuilder')
<script>
    jQuery(document).ready(function(){
        
        $('#pc_build_pop_open').modal('show');
    });
</script>
@endif

<script>
$(document).ready(function(){
    $("div #chipset").click(function(){
       /*$("div #chipset").removeClass('active_btn');
       $(this).addClass('active_btn')*/
       
       var chipset_id = $(this).val();
       var performance_val = '';
       if($("div .performance_1080").hasClass('active_btn')){
           var performance_val = $("div .performance_1080").val();
       }
       else if($("div .performance_1440").hasClass('active_btn')){
           var performance_val = $("div .performance_1440").val();
       }
       
       $("#performance_val").val(performance_val);
       $("#chipset_val").val(chipset_id);
       
       $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
       
       $.ajax({
			url: SITE_URL+'/ajax/change_chip_performance',
			type: 'POST',
            dataType:'json',
			data : {chipset_id:chipset_id, performance_val:performance_val},
			success : function(data) {
			    
			   console.log(data);
			   $("#fps1").text(data.fps1)
			   $("#fps2").text(data.fps2)
			   $("#fps3").text(data.fps3)
			   $("#fps4").text(data.fps4)
				},
			
		});
    });
    
    
    $("div #performance").click(function(){
        $("div #performance").removeClass('active_btn');
       $(this).addClass('active_btn')
       var performance_val = $(this).val();
       
       if($("div #chipset").hasClass('active_btn')){
           var chipset_id = $(".chipset_btns .active_btn").val();
       }
       
       $("#performance_val").val(performance_val);
       $("#chipset_val").val(chipset_id);
       
       $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
       
       $.ajax({
			url: SITE_URL+'/ajax/change_chip_performance',
			type: 'POST',
            dataType:'json',
			data : {chipset_id:chipset_id, performance_val:performance_val},
			success : function(data) {
			    
			   //console.log(data);
			   $("#fps1").text(data.fps1)
			   $("#fps2").text(data.fps2)
			   $("#fps3").text(data.fps3)
			   $("#fps4").text(data.fps4)
				},
			
		});
    });
    
    $("#budget_plus").click(function(){
        var budget_val = $("#budget_val").val();
        var new_budget = parseInt(budget_val) + parseInt(500);
        
        if(new_budget >= 3000){
            new_budget = 3000
        }
        
        $("#budget").text('NPR'+new_budget.toLocaleString());
        $("#budget_val").val(new_budget)
        
        $(".performance_1080").addClass('active_btn');
        $(".performance_1440").removeClass('active_btn');
        $("#performance_val").val('1080')
        
        var chipset_id = $("#chipset_val").val();
        var performance_val = $("#performance_val").val();
       
        
        $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
        $.ajax({
			url: SITE_URL+'/ajax/change_chip_performance',
			type: 'POST',
            dataType:'json',
			data : {chipset_id:chipset_id, new_budget:new_budget},
			success : function(data) {
			    
			   //console.log(data);
			   $("#fps1").text(data.fps1)
			   $("#fps2").text(data.fps2)
			   $("#fps3").text(data.fps3)
			   $("#fps4").text(data.fps4)
				},
			
		});
    });
    
    $("#budget_minus").click(function(){
        var budget_val = $("#budget_val").val();
        var new_budget = parseInt(budget_val) - parseInt(500);
        
        if(new_budget <= 1500){
            new_budget = 1500
        }
        
        $("#budget").text('NPR'+new_budget.toLocaleString());
        $("#budget_val").val(new_budget)
        
        $(".performance_1080").addClass('active_btn');
        $(".performance_1440").removeClass('active_btn');
        $("#performance_val").val('1080')
        
        var chipset_id = $("#chipset_val").val();
        var performance_val = $("#performance_val").val();
       
        
        $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
        $.ajax({
			url: SITE_URL+'/ajax/change_chip_performance',
			type: 'POST',
            dataType:'json',
			data : {chipset_id:chipset_id, new_budget:new_budget},
			success : function(data) {
			    
			   //console.log(data);
			   $("#fps1").text(data.fps1)
			   $("#fps2").text(data.fps2)
			   $("#fps3").text(data.fps3)
			   $("#fps4").text(data.fps4)
				},
			
		});
    });
    
   
  
$("#remove_pc_cart").click(function(){
    $.ajaxSetup({
		      headers: {
		                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		            }
           		 });
     $.ajax({
			url: SITE_URL+'/ajax/delete_pc_cart',
			type: 'POST',
			data : {},
			success : function(data) {
			    location.reload()
			   //console.log(data);
			   
				},
			
		});
    
})
  
  $('#feedbackModalCenter2').modal('show');
  
 
    
})
</script>
@stack('custom-scripts')

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/63889e20b0d6371309d21e40/1gj6qjcf9';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>
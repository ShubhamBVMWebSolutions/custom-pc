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
<div class="newsletter_block" id="newsletterBlock">
    <div class="container">
        <div class="row">
            <div class="newsletter_wrpa">
                <h3 class="footer-newsletter">Get instant deals and exclusive offers!</h3>
                <div class="newsletter_form">
                    <div class="news_inputs">
                        <div class="input_groups">
                            <input class="" type="email" value="" name="newsletter_email" id="email" placeholder="Enter your email"
                                form="newsletterForm">
                        </div>
                        <button type="submit" form="newsletterForm">
                            Subscribe
                        </button>
                    </div>
                    @error('newsletter_email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="letter_message">
                        <p>By providing your email you agree that your personal information will be handled in
                            accordance with our <a href="{{route('privacy-policy')}}">privacy policy</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('newsletter.submit') }}" id="newsletterForm" method="post">
    @csrf
</form>
<!-- Newsletter box end-->

<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        {{-- <a href="#"><img src="{{url(Config::get('constants.SITE_IMAGE_PATHS').SiteSettingByName('site_footer_logo'))}}" alt=""></a> --}}
                        <a href="{{route('home')}}"><span>BVM Web Solutions</span></a>
                        {{-- <a href="#"><img src="{{asset('img/1675332765.png')}}" alt=""></a> --}}
                    </div>
                    <p>{{SiteSettingByName('footer_text')}}</p>
                </div>

            </div>
            <div class="col-lg-3 footer_categories col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Categories</h6>
                    <ul>
                        @foreach(getallCategoriesFooter() as $cat)
                        <li><a
                                href="{{route('view.product.category',['productcategorySlug' => $cat->slug])}}">{{$cat->title}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>About Us</h6>
                    <ul>
                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                        <!--<li><a href="#">Payment Methods</a></li>-->
                        <!--<li><a href="#">Delivary</a></li>-->
                        <!--<li><a href="#">Return & Exchanges</a></li>-->
                        <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                        <li><a href="{{route('terms-and-conditions')}}">Terms and Conditions</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3  col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>Follow us on</h6>
                    <ul class="social_icons">
                        <li><a href="{{SiteSettingByName('facebook_url')}}"><i class="fa fa-facebook-official"
                                    aria-hidden="true"></i></a></li>
                        <li><a href="{{SiteSettingByName('twitter_url')}}"><i class="fa fa-twitter-square"
                                    aria-hidden="true"></i></a></li>
                        <li><a href="{{SiteSettingByName('insta_url')}}"><i class="fa fa-instagram"
                                    aria-hidden="true"></i></a></li>
                        <li><a href="{{SiteSettingByName('youtube_url')}}"><i class="fa fa-youtube-play"
                                    aria-hidden="true"></i></a></li>
                        <li><a href="{{SiteSettingByName('twitch_url')}}"><i class="fa fa-twitch"
                                    aria-hidden="true"></i></a></li>
                        <li><a href="{{SiteSettingByName('reddit_url')}}"><i class="fa fa-reddit-square"
                                    aria-hidden="true"></i></a></li>
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
        <div class="search_m_content">
            <div class="d-flex">
                <div class="search-close-switch">X</div>
                <form class="search-model-form" action="{{route('view.products')}}" method="get" id="searchForm">
                    <div class="search_group">
                        <input type="text" name="search" id="search-input" placeholder="Search here....." oninput="displaySearchSuggestion()" autocomplete="off" required>
                        <div class="after_click_search">
                            <span class="close_icon" id="textEraseButton" style="display:none;" onclick="clearSearchText();">X</span>
                            <div class="price_dropdown" id="searchPriceDrop" style="display:none;">
                                <div class="dropdown_price">Select Price Range <i class="fa fa-angle-down" aria-hidden="true"></i></div>
                                <div class="dropdown-box-price">
                                        <div class="price_range_block">
                                                <div id="slider-range-search" class="range-bar"></div>
                                                <div class="price_value_box">
                                                    <div class="min_value">
                                                        <span>Minimum NPR</span>
                                                        <input type="text" id="min_amount_search" name="price_min" value="0" class="price_minimum" readonly>
                                                    </div>
                                                    <div class="max_value">
                                                        <span class="price-filter-separator"> </span> <span>&nbsp;
                                                            Maximum NPR</span>
                                                        <input type="text" id="max_amount_search" name="price_max" value="" class="price_maximum" readonly>
                                                    </div>
                                                </div>

                                                <button type="button" onclick="$('#searchForm').submit()"> <i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>
                </form>
            </div>
            <!-- <div class="search_content_recent_view">
                <h4>RECENTLY VIEWED</h4>
                <div class="recent_view_block">
                    <a href="#" class="recent_p_list">
                        <div class="r_img">
                            <img src="https://bvmprojects.org/custom_pc/uploads/product-media/1668496019.webp">
                        </div>
                        <div class="r_content">
                            <h5>Pok�mon Violet</h5>
                            <div class="r_p_price">
                                NPR 67.24
                            </div>
                        </div>
                    </a>
                    <a href="#" class="recent_p_list">
                        <div class="r_img">
                            <img src="https://bvmprojects.org/custom_pc/uploads/product-media/1668496019.webp">
                        </div>
                        <div class="r_content">
                            <h5>Pok�mon Violet</h5>
                            <div class="r_p_price">
                                NPR 67.24
                            </div>
                        </div>
                    </a>
                    <a href="#" class="recent_p_list">
                        <div class="r_img">
                            <img src="https://bvmprojects.org/custom_pc/uploads/product-media/1668496019.webp">
                        </div>
                        <div class="r_content">
                            <h5>Pok�mon Violet</h5>
                            <div class="r_p_price">
                                NPR 67.24
                            </div>
                        </div>
                    </a>
                    <a href="#" class="recent_p_list">
                        <div class="r_img">
                            <img src="https://bvmprojects.org/custom_pc/uploads/product-media/1668496019.webp">
                        </div>
                        <div class="r_content">
                            <h5>Pok�mon Violet</h5>
                            <div class="r_p_price">
                                NPR 67.24
                            </div>
                        </div>
                    </a>
                </div>
            </div> -->
            <div class="search_suggestion">
                <div class="search_sugg_left">
                    <div class="suggestion_keyword_div" id="suggestionKeywordDiv" style="display:none;">
                            <h5 class="search_title">SUGGESTED KEYWORDS</h5>
                            <ul class="suggestion_keyword" id="suggestionKeywordUl">

                            </ul>
                    </div>
                    <div class="suggestion_keyword_cate_div" id="suggestionKeywordCateDiv" style="display:none;">
                            <h5 class="search_title space_top_space">SUGGESTED CATEGORIES</h5>
                            <ul class="suggestion_keyword_cate" id="suggestionKeywordCateUl">
                            </ul>
                    </div>

                </div>
                <div class="search_sugg_left" id="suggestionProductDiv" style="display:none;">
                    <h5 class="search_title">PRODUCT SUGGESTIONS</h5>
                    <div class="recent_view_block" id="suggestionProductBlock">
                    </div>
                    <div class="viw_btn">
                        <a class="view_all_prd" href="javascript:void(0)" onclick="$('#searchForm').submit()">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Search End -->

<!-- Loader -->
<div id="preloader" class="pre_loader_loading" style="display: none;">
    <div class="spinner"></div>
</div>
<!-- Loader -->

<!-- Js Plugins -->
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('js/jquery.slicknav.js')}}"></script>
<script src="{{asset('js/mixitup.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script src="{{asset('js/aos.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>

<!--pdf-->
<script src="{{asset('js/three.min.js')}}"></script>
<script src="{{asset('js/pdf.min.js')}}"></script>
<script src="{{asset('js/3dflipbook.min.js')}}"></script>
<script src="{{asset('js/html2canvas.min.js')}}"></script>
<script src="{{asset('js/default-book-view.js')}}"></script>

<!--toastr-->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
AOS.init({
    once: true
})
</script>


<script>
$(document).ready(function() {
    var owl = $(".related_prod_slider");
    owl.owlCarousel({
        items: 3,
        margin: 10,
        loop: true,
        nav: true,
        dots: true,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"]
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $(".remove-from-cart").click(function(e) {
        e.preventDefault();

        var ele = $(this);

        //if(confirm("Are you sure? you want to delete?")) {
        $.ajax({
            url: '{{ url('/ajax/delete_cart') }}',
            method: "DELETE",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.attr("data-id")
            },
            success: function(response) {
                window.location.reload();
            }
        });
        //}
    });

    $(".cart_qty_div .inc").click(function() {
        var qty = $("#quantity").val();
        //alert(qty)
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $(".selected_btn").click(function() {
        $(".custom_pc_build_popup").hide();
    });
    $(".selected_btn").click(function() {
        $(".cpu_processor").show();
        $(".modal-backdrop").hide();
        $("body").addClass('hide_popup_overlay');
    });

    $("#create_account").click(function() {
        if ($(this).is(":checked")) {
            $("#soi_password_box").show();
            $("#username").attr('required', 'required')
            $("#password").attr('required', 'required')
        } else {
            $("#soi_password_box").hide();
            $("#username").removeAttr('required', 'required')
            $("#password").removeAttr('required', 'required')
        }
    });
});
</script>



@if($route_name == 'pcbuilder')
<script>
jQuery(document).ready(function() {

    $('#pc_build_pop_open').modal('show');
});
</script>
@endif

<script>
$(document).ready(function() {

    $("#remove_pc_cart").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: SITE_URL + '/ajax/delete_pc_cart',
            type: 'POST',
            data: {},
            success: function(data) {
                location.reload()
                //console.log(data);

            },

        });
    })

    $('#feedbackModalCenter2').modal('show');



})


</script>
<script>
toastr.options = {
  "closeButton": true
}

@if(session('success_message'))
toastr.success('{{ session("success_message") }}');
@endif
@if(session('error_message'))
toastr.error('{{ session("error_message") }}');
@endif
@if(session('warning_message'))
toastr.warning('{{ session("warning_message") }}');
@endif
@if(session('info_message'))
toastr.info('{{ session("info_message") }}');
@endif

@if($errors-> any())
@foreach($errors-> all() as $error)
toastr.error('{{ $error }}');
@endforeach
@endif
</script>



<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API = Tawk_API || {},
    Tawk_LoadStart = new Date();
(function() {
    var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/63889e20b0d6371309d21e40/1gj6qjcf9';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
})();
</script>
<!--End of Tawk.to Script-->

<!--wishlist -->
@if(auth()->check())
    <script>
    function toggleWishlistItem(product_id){

                $.post("{{ route('ajax.toggle-wishlist-product') }}",
                {
                    product_id: product_id,
                    _token: "{{ csrf_token() }}",
                },
                function(data, status){
                    if(data.response == true){
                            if(data.status == 1){
                                    $("#wishlist_icon_"+product_id).removeClass("fa fa-heart-o");
                                    $("#wishlist_icon_"+product_id).addClass("fa fa-heart");
                            }else{
                                $("#wishlist_icon_"+product_id).removeClass("fa fa-heart");
                                $("#wishlist_icon_"+product_id).addClass("fa fa-heart-o");
                            }
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }

                });



    }
    </script>

@else
    <script>
    function toggleWishlistItem(product_id){
            toastr.error("You are not logged in. Logged in First.");
            // window.location.replace("{{route('login')}}");
    }
    </script>
@endif
<!--search box-->
<script type="text/javascript">
        $(document).ready(function() {
          $('.dropdown_price').click(function() {
            $('.dropdown-box-price').slideToggle("fast");
          });
        });

        function displaySearchSuggestion(){
            var keyword = $("#search-input").val();
            if(keyword != ''){
                    $("#textEraseButton").show();
                    $.post("{{ route('search.suggestions')}}",
                    {
                        keyword: keyword,
                        _token: "{{ csrf_token() }}",
                    },
                    function(data, status){
                        console.log('search_data',data);
                        var suggestedKeywordsHtml = data.suggested_keywords_html;
                        if(suggestedKeywordsHtml != ''){
                            $("#suggestionKeywordDiv").show();
                        }else{
                            $("#suggestionKeywordDiv").hide();
                        }
                        $("#suggestionKeywordUl").html(suggestedKeywordsHtml);

                        var suggestedKeywordsCatsHtml = data.categories_keywords_html;
                        if(suggestedKeywordsCatsHtml != ''){
                            $("#suggestionKeywordCateDiv").show();
                        }else{
                            $("#suggestionKeywordCateDiv").hide();
                        }
                        $("#suggestionKeywordCateUl").html(suggestedKeywordsCatsHtml);

                        var suggestedProductsHtml = data.suggested_products_html;
                        if(suggestedProductsHtml != ''){
                            $("#suggestionProductDiv").show();
                            $("#searchPriceDrop").show();
                            $("#max_amount_search").val(data.max_price_amount);
                            setSlider(0,data.max_price_amount);
                        }else{
                            $("#suggestionProductDiv").hide();
                            $("#searchPriceDrop").hide();
                        }
                        $("#suggestionProductBlock").html(suggestedProductsHtml);

                        // console.log(data);
                    });
            }else{
                $("#suggestionKeywordDiv").hide();
                $("#suggestionKeywordCateDiv").hide();
                $("#textEraseButton").hide();
                $("#suggestionProductDiv").hide();
                $("#searchPriceDrop").hide();
            }

        }

        //for price range only
        function displaySearchProductSuggestion(){
            var keyword = $("#search-input").val();
            var priceMinValue = $("#min_amount_search").val();
            var priceMaxValue = $("#max_amount_search").val();
            $.post("{{ route('search.product.suggestions')}}",
            {
                keyword: keyword,
                price_min_value: priceMinValue,
                price_max_value: priceMaxValue,
                _token: "{{ csrf_token() }}",
            },
            function(data, status){
                // console.log(data);
                var suggestedProductsHtml = data.suggested_products_html;
                // console.log(suggestedProductsHtml);
                if(suggestedProductsHtml != ''){
                    $("#suggestionProductBlock").html(suggestedProductsHtml);
                }else{
                    $("#suggestionProductDiv").hide();
                    $("#searchPriceDrop").hide();
                }

            });
        }


        function clearSearchText(){
            $("#search-input").val('');
            displaySearchSuggestion();
            $("#textEraseButton").hide();
            $("#suggestionProductDiv").hide();
            $("#searchPriceDrop").hide();
        }

        function setSlider(minSet,maxSet){
            $("#slider-range-search").slider({
        	  range: true,
        	  min: minSet,
        	  max: maxSet,
        	  values: [ minSet, maxSet ],
        	  slide: function( event, ui ) {
        		//$( "#amount" ).val( "NPR " + ui.values[ 0 ] + " - NPR " + ui.values[ 1 ] );
        		$("#min_amount_search").val(ui.values[ 0 ]);
        		$("#max_amount_search").val(ui.values[ 1 ]);

                setTimeout(displaySearchProductSuggestion, 1000);

        	  }
        	});
        }
</script>
    <script>
        (function($){
        $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
          if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
          }
          var $subMenu = $(this).next(".dropdown-menu");
          $subMenu.toggleClass('show');

          $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
          });

          return false;
        });
        })
        (jQuery)
    </script>
@stack('custom-scripts')
<script src="{{asset('js/script.js')}}"></script>

<script>
    $(document).bind("contextmenu",function(e){
  return false;
    });
</script>
</body>

</html>

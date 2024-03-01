@extends('front-layout.master_layout')
@section('title', 'PC Builder')
@section('meta_keywords',metaTagsByKeyPage('pc_builder','meta_keywords'))
@section('meta_description',metaTagsByKeyPage('pc_builder','meta_description'))
@section('content')

<section class="brands_part">
            <div class="container-fluid">
                     <div class="row">
                            <div class="col-lg-6">                            
                                <div class="brand_left_block" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="row"> 
                                        <div class="col-lg-12">
                                            <div class="section-title text-left">
                                                <span>Start Now</span>
                                                <h2>{{homepagesectionById(1)->section_title}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom_brands_content" data-aos="fade-up">
                                        <div class="img-block-brands">
                                            <img src="{{url(Config::get('constants.HOME_IMAGES_PATH').homepagesectionById(1)->image )}}">
                                        </div>
                                        <p><?=homepagesectionById(1)->content?></p>
                                        <a href="{{homepagesectionById(1)->section_link}}" class="primary-btn">Customize PC <span class="arrow_right"></span></a>
                                    </div>    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="brand_right_block white_text" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="row"> 
                                        <div class="col-lg-12">
                                            <div class="section-title text-left white_text">
                                                <span>Start Now</span>
                                                <h2>{{homepagesectionById(2)->section_title}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom_brands_content" data-aos="fade-up">
                                        <div class="img-block-brands">
                                            <img src="{{url(Config::get('constants.HOME_IMAGES_PATH').homepagesectionById(2)->image )}}">
                                        </div>
                                        <p><?=homepagesectionById(2)->content?></p>
                                        <a href="{{homepagesectionById(2)->section_link}}" class="primary-btn">Customize PC <span class="arrow_right"></span></a>
                                    </div> 

                                </div>                                    
                            </div>                        
                 </div>   
            </div>    
    </section>
    
    <!-- Promo Box -->
<section class="promo_box">
        <div class="container">
            <div class="row">                 
                <div class="col-lg-12">
                    <div class="promo_content" data-aos="fade-up" data-aos-duration="1000">
                        <div class="promo_c_left">
                            <h2>{{homepagesectionById(3)->section_title}}</h2>
                            <p><?=homepagesectionById(3)->content?></p>
                            <a href="{{homepagesectionById(3)->section_link}}" class="primary-btn site_btn">Customize PC <span class="arrow_right"></span></a>
                        </div>
                        <div class="promo_c_right">
                            <img src="{{url(Config::get('constants.HOME_IMAGES_PATH').homepagesectionById(3)->image )}}" alt="">
                        </div>
                    </div>    
                </div>
            </div>    
    </div>    
</section>
<!-- Promo Box End-->



<!-- Pop Up Area -->
<div class="modal fade pc_build_box_area" id="pc_build_pop_open" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h2>Build your PC</h2>
        <p>Select your chipset and budget</p>
        <form method="post" action="{{route('continue.build',['randomNumber' => csrf_token()])}}" autocomplete="off">
            @csrf
        <div class="row space_top_popup">
            <div class="col-lg-6">
                <div class="performace">
                    <h2>Performance</h2>
                    <div class="performace_images">
                        <div class="img_p_block">
                            
                            <img src="{{url('public/img/1620400903-modern-warfare-alt.avif')}}" />
                            <div class="p_text"><span id="fps1"></span> FPS</div>
                        </div>
                        <div class="img_p_block">
                            <img src="{{url('public/img/1620400487-fortnite-1.avif')}}" />
                            <div class="p_text"><span id="fps2"></span> FPS</div>
                        </div>
                        <div class="img_p_block">
                            <img src="{{url('public/img/1620400899-minecraft-logo.avif')}}" />
                            <div class="p_text"><span id="fps3"></span> FPS</div>
                        </div>
                        <div class="img_p_block">
                            <img src="{{url('public/img/1620400892-gta.avif')}}" />
                            <div class="p_text"><span id="fps4"></span> FPS</div>
                        </div>    
                    </div>
                    <p class="performance_small">Performance</p>
                    <div class="performance_btn" id="performance_btns">
                        <button type="button" class="performance active_btn" value="1080">1080</button>
                        <button type="button" class="performance" value="1440">1440</button>
                        <input type="hidden" name="performance" id="performance_val" value="1080">
                    </div>    
                </div>    
            </div>
            <div class="col-lg-6"> 
               <div class="popup_right_block">
                    <h2>CHIPSET</h2>
                    <div class="performance_btn chipset_btns">
                        <?php $no = 1; ?>
                        @foreach($chipset as $chip)
                        <button type="button" class="chipset-btn @if($no == 1)active_btn @endif" value="{{$chip->id}}">{{$chip->title}}</button>
                        <?php $no++; ?>
                        @endforeach
                        <input type="hidden" name="chipset" id="chipset_val" value="{{$chipset[0]->id}}">
                    </div>
                    <h2>BUDGET</h2>
                    <div class="budget_btns">
                        <button type="button" id="budget_minus">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1em" height="1em" class="h-6 stroke-current h-6 stroke-current text-white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <span id="budget">NPR{{number_format($budgets[1]->amount)}}</span>
                        <input type="hidden" name="budget_val" id="budget_val" value="{{$budgets[1]->amount}}">
                        <input type="hidden" name="budget_id" id="budget_key_id" value="{{$budgets[1]->id}}">
                        <button type="button" id="budget_plus">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1em" height="1em" class="h-6 stroke-current h-6 stroke-current text-white"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>    
                    <button type="submit" class="primary-btn" id="continue_build"> Continue to Build <span class="arrow_right"></span></button>
               </div> 
                
            </div>
        </div>    
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>



@endsection

@push('custom-scripts')
<script>
var budgetArray = @json($budgets);
        // console.log('budgetArray',budgetArray);
    $("div .chipset-btn").click(function() {
        $(".chipset-btn").removeClass('active_btn');
        $(this).addClass('active_btn');
        var chipset_id = $(this).val();
        $("#chipset_val").val(chipset_id);
        getPerformances()
    });


    $("div .performance").click(function() {
        $("div .performance").removeClass('active_btn');
        $(this).addClass('active_btn')
        var performance_val = $(this).val();
        $("#performance_val").val(performance_val);
        getPerformances()
    });

    $("#budget_plus").click(function() {
        let budget_val = $("#budget_val").val();
        let new_budget;
        for(var i=0; i < budgetArray.length; i++){
            console.log(budget_val, budgetArray[i].amount);
            if(budget_val == budgetArray[i].amount){
                if(budgetArray.length > i+1){
                    new_budget = budgetArray[i+1].amount;
                    $("#budget").text('NPR' + new_budget.toLocaleString());
                    $("#budget_val").val(new_budget)
                    $("#budget_key_id").val(budgetArray[i+1].id)
                }
                
            }
        }
        getPerformances()

    });

    $("#budget_minus").click(function() {
        var budget_val = $("#budget_val").val();
        for(var i=0; i < budgetArray.length; i++){
            console.log(budget_val, budgetArray[i].amount);
            if(budget_val == budgetArray[i].amount){
                if(0 <= i-1){
                    new_budget = budgetArray[i-1].amount;
                    $("#budget").text('NPR' + new_budget.toLocaleString());
                    $("#budget_val").val(new_budget)
                    $("#budget_key_id").val(budgetArray[i-1].id)
                }
                
            }
        }
        getPerformances()
    });
    
    function getPerformances(){
        let budgetSelect = $("#budget_key_id").val();
        let chipsetSelect = $("#chipset_val").val();
        let pixelSelect = $("#performance_val").val();
        console.log(budgetSelect,chipsetSelect,pixelSelect);
        $.post("{{route('api.get-pc-performances')}}",
        {
            pc_budget_id: budgetSelect,
            chipset_id: chipsetSelect,
            pixel: pixelSelect,
        },
        function(data, status){
            console.log(data);
            if(data.response){
                $("#fps1").text(data.data.cod_fps);
                $("#fps2").text(data.data.fortnite_fps);
                $("#fps3").text(data.data.minecraft_fps);
                $("#fps4").text(data.data.gta_fps);
            }else{
                $("#fps1").text('');
                $("#fps2").text('');
                $("#fps3").text('');
                $("#fps4").text('');
            }    
        });
    }
    
    
    $(document).ready(function() {
        getPerformances()
    });
</script>
@endpush



@extends('front-layout.master_layout')
@section('title', 'My Account')
@section('content')

<?php $user_id = auth()->user()->id;
if(empty($user_id)){ ?>
<script>window.location = "{{route('login')}}";</script>
<?php die; }?>

<!-- dashboard Section Begin --> 
<section class="checkout spad">   
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-12"> 
                    <h2 class="cart_title">My Account</h2>  
                </div>    
            </div>
            
<div class="row">
    <div class="col-lg-12"> 
    @include('myaccount.nav')
            
    <div id="firstTab" class="tabcontent">
              <h4>Hello, <strong>{{$user_details->name}}</strong></h4>                        
              <div class="author_details">
                  @if(!empty($user_details->image))
                   <div class="author_img">
                        <img alt="" src="{{url(Config::get('constants.PROFILE_IMAGE_PATH').$user_details->image )}}">
                   </div>
                   @endif
                   <div class="myaccount_smtext">
                   <h6>From your account dashboard you can view your <a href="{{route('user.dashboard.orders')}}">orders,</a> manage your <a href="{{route('user.dashboard.address')}}">billing address,</a>
                   and <a href="{{route('user.dashboard.profile')}}">edit your password and account details.</a></h6>
                   <br>
                   
                   </div>
              </div>
            </div>
            
           
            </div>
    </div>
    </div>
                       
             
        </div>
    </div>
</section>
<!-- dashboard Section End -->

<script type="text/javascript">
        function openTab(evt, cityName) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(cityName).style.display = "block";
          evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();        
    </script>

@endsection
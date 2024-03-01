@extends('front-layout.master_layout')
@section('title', 'Contact Us')
@section('meta_keywords',metaTagsByKeyPage('contact','meta_keywords'))
@section('meta_description',metaTagsByKeyPage('contact','meta_description'))
@section('content')

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="cart_title" data-aos="fade-up">{{$contact->title}}</h2>
            </div>    
        </div>    
        <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <p><?=$contact->information?></p>
                        </div>
                        <ul>
                            <li>
                                <?=$contact->address?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="{{route('contact')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name" name="name" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" placeholder="Email" name="email" required>
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" placeholder="Phone" name="phone" required>
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message" name="message" required></textarea>
                                    <button type="submit" class="primary-btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                        
                      <div class="error_div">
                     @foreach ($errors->all() as $error)
                     <div class="alert alert-danger alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                   {{ $error }}
               </div>
                     @endforeach
                  
                        
                        @if(session()->has('alert-success'))
               <div class="alert alert-success alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                   {{ session()->get('alert-success') }} 
               </div>
               @endif
               @if(session()->has('alert-error'))
               <div class="alert alert-danger alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                {{ session()->get('alert-error') }} 
               </div>
               @endif
               </div>
                    </div>
                </div>
            </div>
    </div>
</section>
<!-- Shopping Cart Section End -->


<!-- catalogues  -->
    <section class="catalogues">  
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="store_finder_title">
                        <h2>Store Finder</h2>
                    </div>    
                </div>
                <div class="col-lg-5">
                    <!--<div class="enter_location"> -->
                    <!--    <div class="enter_postcode">-->
                    <!--        <input type="text" class="postcode" placeholder="Enter postcode or suburb">-->
                    <!--    </div>-->
                    <!--    <div class="or_divider">-->
                    <!--        or-->
                    <!--    </div>    -->
                    <!--    <div class="use_current_location">-->
                    <!--        <button><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Use current location</button>                            -->
                    <!--    </div>    -->
                    <!--</div>    -->
                </div>    
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="map_google">
                        <div id="map" style="width:100%;height:500px;"></div>
                        <div class="text_google">Showing stores state wise</div>
                    </div>
                    <div class="accordin_list">
                        <div class="accordion" id="faq">
                            @php $locations=[];  @endphp
                            @if($states->count() > 0)
                                @foreach($states as $key => $state)
                                        <div class="card">
                                            <div class="card-header" id="faqhead{{$key}}">
                                                <a href="#" class="btn-header-link collapsed" data-toggle="collapse" data-target="#faq{{$key}}"
                                                aria-expanded="true" aria-controls="faq{{$key}}">{{$state}}</a>
                                            </div>
                                            
                                            <div id="faq{{$key}}" class="collapse" aria-labelledby="faqhead{{$key}}" data-parent="#faq">
                                                <div class="card-body">
                                                    <div class="store_location_list">
                                                            @if($stores->count() > 0)
                                                            <ul>
                                                                @foreach($stores as $store)
                                                                    @if($store->state == $state)
                                                                            <li>
                                                                                <a href="{{route('stores.single',[$store->slug])}}"><i class="fa fa-building" aria-hidden="true"></i> {{$store->title}}</a>
                                                                            </li>
                                                                        <?php
                                                                        $label = '
                                                                                <div class="marker__label__div">
                                                                                    <h3>'.$store->title.'</h3>
                                                                                    <br>
                                                                                        <div class="marker__label__store_address">   
                                                                                            <p>'.$store->address_line_1.'<br>
                                                                                            '.$store->address_line_2 .'<br>
                                                                                            '.$store->city .', '. $store->state .', '. $store->country .', '. $store->pincode .'
                                                                                            </p>
                                                                                            <div class="marker__label__working_hours"> 
                                                                                                <h4>Opening Hours</h4>
                                                                                                <table>
                                                                                                   <tbody>';
                                                                                                      if(!empty($store->opening_hours)){
                                                                                                      $opening_hours = json_decode($store->opening_hours);
                                                                                                        foreach($opening_hours as $hour){
                                                                                                            if(date("l") == $hour->day_name || date('l', strtotime(' +1 day')) == $hour->day_name){
                                                                                                                $label .= '<tr>
                                                                                                                    <td>'.$hour->day_name.'</td>
                                                                                                                    <td>';
                                                                                                                            if($hour->day_closed_status == "No"){
                                                                                                                                if(!empty($hour->day_opening)){ $label .= date("h:i A",strtotime($hour->day_opening)); } $label .='-'; if(!empty($hour->day_closing)){ $label .= date("h:i A",strtotime($hour->day_closing));} 
                                                                                                                            }else{
                                                                                                                                $label .= 'Closed';  
                                                                                                                            }
                                                                                                                        
                                                                                                                $label .= '    </td>
                                                                                                                </tr>';        
                                                                                                            }
                                                                                                                
                                                                                                        }
                                                                                                      }
                                                                                $label .=                   '</tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                            
                                                                                        </div> 
                                                                                    <a href="'.route('stores.single',[$store->slug]).'" class="btn btn-primary">More Info</a>
                                                                                </div>
                                                                                ';
                                                                        $locations[] = ['lat'=>$store->latitude,'lng'=>$store->longitude,'label'=>str_replace(array("\r", "\n"), '', $label)] 
                                                                        
                                                                        ?>   
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                            @endif
                                                                
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            @endif
                            
                    
                </div>
                    </div>    
                </div>    
            </div>    
        </div>    
    </section>
<!-- catalogues end -->

@endsection

@push('custom-scripts')
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

<script
      src="https://maps.googleapis.com/maps/api/js?callback=initMap"
      defer
    ></script>
    
    <script>
        function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 3,
    center: { lat: 28.3949, lng: 84.1240 },
  });
  const infoWindow = new google.maps.InfoWindow({
    content: "",
    disableAutoPan: false,
  });
  // Create an array of alphabetical characters used to label the markers.
  const labels = [
        @if($locations)
            @foreach($locations as $location)
                 '<?php echo $location['label']; ?>',
            @endforeach
        @endif
];
  // Add some markers to the map.
  const markers = locations.map((position, i) => {
    const label = labels[i % labels.length];
    const store_num = i+1;
    const marker = new google.maps.Marker({
      position,
      store_num,
    });

    // markers can only be keyboard focusable when they have click listeners
    // open info window when marker is clicked
    marker.addListener("click", () => {
      infoWindow.setContent(label);
      infoWindow.open(map, marker);
    });
    return marker;
  });

  // Add a marker clusterer to manage the markers.
  const markerCluster = new markerClusterer.MarkerClusterer({ map, markers });
}

const locations = [
@if($locations)
    @foreach($locations as $location)
        { lat: {{(float)$location['lat']}}, lng: {{(float)$location['lng']}} },
    @endforeach
@endif
];

window.initMap = initMap;
    </script>
@endpush
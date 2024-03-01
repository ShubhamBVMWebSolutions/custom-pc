@extends('front-layout.master_layout')
@section('title', 'Store')
@section('content')
<!-- catalogues  -->
    <section class="catalogues">   
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <a class="back_to" href="{{route('stores.index')}}"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to all stores</a>
                    <div class="store_finder_title"> 
                        <h2>Star Office Internatonal {{ $store->title }}</h2>
                    </div>    
                </div>
            </div>
            <div class="row"> 
                <div class="col-lg-4">
                    <div class="store_address">   
                        <p>{{ $store->address_line_1 }}<br>
                        {{ $store->address_line_2 }}<br>
                        {{ $store->city }}, {{ $store->state }}, {{ $store->country }}, {{ $store->pincode }}
                        </p> 
                        <p><strong>Phone: </strong> <a href="tel: {{ $store->phone }}">{{ $store->phone }}</a></p>
                        <p><strong>Sales line: </strong> <a href="tel: {{ $store->tel }}">{{ $store->tel }}</a></p>
                        <a class="direction_btn" href="{{ $store->google_map_link }}" target="_blank">Get directions</a>
                    </div> 
                    <div class="working_hours"> 
                        <h2>Opening Hours</h2>
                        <table>
                           <tbody>
                              @if(!empty($store->opening_hours))
                              @php $opening_hours = json_decode($store->opening_hours); @endphp
                                @foreach($opening_hours as $hour)
                                    <tr 
                                    @if(date("l") == $hour->day_name)
                                        style="font-weight:600;"        
                                    @endif
                                    >
                                        <td>{{ $hour->day_name }}</td>
                                        <!--<td>16 Dec</td>-->
                                        <td>
                                                @if($hour->day_closed_status == 'No') 
                                                    @if(!empty($hour->day_opening)) {{ date('h:i A',strtotime($hour->day_opening)) }} @endif - @if(!empty($hour->day_closing)) {{ date('h:i A',strtotime($hour->day_closing)) }} @endif 
                                                @else 
                                                    Closed  
                                                @endif
                                            
                                        </td>
                                    </tr>    
                                @endforeach
                              @endif
                           </tbody>
                        </table>
                    </div> 
                    <div class="product_range">
                        <h2>Product Range</h2>
                        @if(!empty($store->product_range))
                            <ul>
                            @php $categories = json_decode($store->product_range); @endphp
                                @foreach($categories as $key => $cat_id)
                                    @if($product_categories->count() > 0)
                                        @foreach($product_categories as $category)
                                            @if($category->id == $cat_id)
                                                <li>{{ $category->title }}</li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </ul>    
                        @endif
                    </div>
                </div>    
                <div class="col-lg-8">
                    <div class="map_google">
                        <div id="map" style="width:100%;height:500px;"></div>
                    </div>
                </div>    
            </div>    
        </div>    
    </section>
    <!-- catalogues end -->
@endsection

@push('custom-scripts')
<script
      src="https://maps.googleapis.com/maps/api/js?callback=initMap"
      defer
    ></script>
    
<script>
    // Initialize and add the map
function initMap() {
  // The location of Uluru
  const uluru = { lat: {{ (float)$store->latitude }}, lng: {{ (float)$store->longitude }} };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: uluru,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
}

window.initMap = initMap;
</script>    
@endpush



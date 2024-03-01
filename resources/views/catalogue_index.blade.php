@extends('front-layout.master_layout')
@section('title', 'Blogs')
@section('content')
<!-- catalogues  -->

    <section class="catalogues">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title_cate">
                        <h2>CURRENT CATALOGUES</h2>
                    </div>    
                </div>    
            </div>
            <div class="list_catalogues">
                <div class="row">
                    @if($catalogues->count() > 0)
                        @foreach($catalogues as $catalogue)
                                <div class="col-lg-6">
                                    <div class="catalogues_img">
                                        <a href="{{ route('catalogues.single',[base64_encode($catalogue->id)]) }}"><img src="{{ asset('public/uploads/catalogues/'.$catalogue->banner)}}" target="_blank">
                                        </a>    
                                        <h5>{{ $catalogue->title }}</h5>
                                    </div>    
                                </div>
                        @endforeach
                    @endif
                    
                </div>    
            </div>    
        </div>    
    </section>

    <!-- catalogues end -->
@endsection
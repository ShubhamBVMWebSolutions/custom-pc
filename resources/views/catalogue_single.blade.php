@extends('front-layout.master_layout')
@section('title', 'Blogs')
@section('content')
    <!-- catalogues  --> 
    <section class="catalogues"> 
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="name_catalogues">
                        {{ $catalogue->title }}
                    </div>
                    <iframe src="{{ asset('public/uploads/catalogues/'.$catalogue->pdf) }}" class="pdf__iframe" width="100%" height="700" frameborder="0">
                        
                    </iframe>
                    <!--<div class="pdf_filp_view flip-book-container" src="{{ asset('public/uploads/catalogues/'.$catalogue->pdf) }}"></div>-->
                </div>    
            </div>
        </div>    
    </section>
    <!-- catalogues end -->
@endsection
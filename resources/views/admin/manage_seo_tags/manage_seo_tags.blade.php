@extends('admin.admins-layout.admin_master')
@section('title', 'Manage SEO Tags')
@section('content')
<div class="page-wrap">
   <div class="">
      <div class="container-fluid">
          <div class="page-header">
            <div class="row align-items-end">
               <div class="col-lg-8">
                  <div class="page-header-title">
                     <i class="ik ik-edit bg-blue"></i>
                     <div class="d-inline">
                        <h5>Update Pages SEO Tags</h5>
                        <span>Manage SEO Tags</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12 tracker-form">
               <div class="card">
                  @if(isset($successMsg) && !empty($successMsg))
                  <div class="alert alert-success" role="alert">
                     {{$successMsg}}
                  </div>
                  @endif
                  @if(isset($errorMsg) && !empty($errorMsg))
                  <div class="alert alert-danger" role="alert">
                     {{$errorMsg}}
                  </div>
                  @endif

                    @if(session()->has('alert-success'))
                                        <div class="alert alert-success alert-dismissible  mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>Success!</strong> {{ session()->get('alert-success') }} 
                                        </div>
                                      @endif

                                        @if(session()->has('alert-error'))
                                        <div class="alert alert-danger alert-dismissible  mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>Failed!</strong> {{ session()->get('alert-error') }} 
                                        </div>
                                      @endif
                 
                     <div class="card-body">
                        <div class="border-bottom ">
                           <h3 class="">Manage SEO Tags</h3>
                        </div>
                        <br>
                              <h4>1. Home Page</h4>
                               <form class="form" method="POST" action="{{route('admin.site.seo.tags')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta tile</label>
                                  <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{metaTagsByKeyPage('home','meta_title')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta Keyword</label>
                                  <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{metaTagsByKeyPage('home','meta_keywords')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlTextarea1">Meta Description</label>
                                  <textarea class="form-control" name="meta_description" id="exampleFormControlTextarea1" rows="3">{{metaTagsByKeyPage('home','meta_description')}}</textarea>
                                  <input type="hidden" name="page_name" value="home">
                                </div>
                                  <button class="btn btn-primary" type="submit">Update</button>
                              </form>
                              <br>
                              <hr>

                              <h4>2. About page</h4>
                               <form class="form" method="POST" action="{{route('admin.site.seo.tags')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta tile</label>
                                  <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{metaTagsByKeyPage('about','meta_title')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta Keyword</label>
                                  <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{metaTagsByKeyPage('about','meta_keywords')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlTextarea1">Meta Description</label>
                                  <textarea class="form-control" name="meta_description" id="exampleFormControlTextarea1" rows="3">{{metaTagsByKeyPage('about','meta_description')}}</textarea>
                                  <input type="hidden" name="page_name" value="about">
                                </div>
                                  <button class="btn btn-primary" type="submit">Update</button>
                              </form>

                                <br>
                              <hr>

                              <h4>3. Contact page</h4>
                               <form class="form" method="POST" action="{{route('admin.site.seo.tags')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta tile</label>
                                  <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{metaTagsByKeyPage('contact','meta_title')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta Keyword</label>
                                  <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{metaTagsByKeyPage('contact','meta_keywords')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlTextarea1">Meta Description</label>
                                  <textarea class="form-control" name="meta_description" id="exampleFormControlTextarea1" rows="3">{{metaTagsByKeyPage('contact','meta_description')}}</textarea>
                                  <input type="hidden" name="page_name" value="contact">
                                </div>
                                  <button class="btn btn-primary" type="submit">Update</button>
                              </form>


                                <br>
                              <hr>

                              <h4>4. PC Builder page</h4>
                               <form class="form" method="POST" action="{{route('admin.site.seo.tags')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta tile</label>
                                  <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{metaTagsByKeyPage('pc_builder','meta_title')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta Keyword</label>
                                  <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{metaTagsByKeyPage('pc_builder','meta_keywords')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlTextarea1">Meta Description</label>
                                  <textarea class="form-control" name="meta_description" id="exampleFormControlTextarea1" rows="3">{{metaTagsByKeyPage('pc_builder','meta_description')}}</textarea>
                                  <input type="hidden" name="page_name" value="pc_builder">
                                </div>
                                  <button class="btn btn-primary" type="submit">Update</button>
                              </form>

                              <br>
                              <hr>

                                <h4>5. Gift Card page</h4>
                               <form class="form" method="POST" action="{{route('admin.site.seo.tags')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta tile</label>
                                  <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{metaTagsByKeyPage('gift_card','meta_title')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta Keyword</label>
                                  <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{metaTagsByKeyPage('gift_card','meta_keywords')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlTextarea1">Meta Description</label>
                                  <textarea class="form-control" name="meta_description" id="exampleFormControlTextarea1" rows="3">{{metaTagsByKeyPage('gift_card','meta_description')}}</textarea>
                                  <input type="hidden" name="page_name" value="gift_card">
                                </div>
                                  <button class="btn btn-primary" type="submit">Update</button>
                              </form>

                              <br>
                              <hr>
                              
                              
                              <h4>6. Tetimonial page</h4>
                               <form class="form" method="POST" action="{{route('admin.site.seo.tags')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta tile</label>
                                  <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{metaTagsByKeyPage('testimonial','meta_title')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta Keyword</label>
                                  <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{metaTagsByKeyPage('testimonial','meta_keywords')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlTextarea1">Meta Description</label>
                                  <textarea class="form-control" name="meta_description" id="exampleFormControlTextarea1" rows="3">{{metaTagsByKeyPage('testimonial','meta_description')}}</textarea>
                                  <input type="hidden" name="page_name" value="testimonial">
                                </div>
                                  <button class="btn btn-primary" type="submit">Update</button>
                              </form>

                              <br>
                              <hr>
                              
                              <h4>7. Login page</h4>
                               <form class="form" method="POST" action="{{route('admin.site.seo.tags')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta tile</label>
                                  <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{metaTagsByKeyPage('login','meta_title')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlInput1">Meta Keyword</label>
                                  <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{metaTagsByKeyPage('login','meta_keywords')}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleFormControlTextarea1">Meta Description</label>
                                  <textarea class="form-control" name="meta_description" id="exampleFormControlTextarea1" rows="3">{{metaTagsByKeyPage('login','meta_description')}}</textarea>
                                  <input type="hidden" name="page_name" value="login">
                                </div>
                                  <button class="btn btn-primary" type="submit">Update</button>
                              </form>

                              <br>
                              <hr>

                     </div>


@endsection


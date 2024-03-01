@extends('admin.admins-layout.admin_master')
@section('title', 'Edit New At SOI')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <h5><a href="{{route('admin.new-product-blogs.index')}}"><i class="ik ik-edit bg-blue"></i> View
                                All</a></h5>
                        <div class="d-inline">
                            <h5>Edit New At SOI</h5>
                            <span>Edit</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible  mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <ul class="list-unstyled m-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
            </div>
        </div>
        <div class="card">
            <div class="card-body">

                <form class="forms-sample" action="{{route('admin.new-product-blogs.update',[base64_encode($new_product_blog->id)])}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Enter Title" value="{{ $new_product_blog->title }}">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="description" rows="5" class="form-control" name="description"
                                            placeholder="Description">{!! $new_product_blog->description !!}</textarea>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="form-check">
                                            <input type="radio" name="status" class="form-check-input" value="Active"
                                                id="radioDraft" @if($new_product_blog->status == 'Active') checked @endif>
                                            <label class="form-check-label" for="radioDraft">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="status" class="form-check-input"
                                                value="Inactive" id="radioPuiblish" @if($new_product_blog->status == 'Inactive') checked @endif>
                                            <label class="form-check-label" for="radioPuiblish">
                                                Inactive
                                            </label>
                                        </div>
                                        @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Media Type</label>
                                        
                                        <div class="form-check">
                                            <input type="radio" name="media_type" class="form-check-input" value="youtube"
                                                id="radioyoutube" @if($new_product_blog->media_type == 'youtube') checked @endif>
                                            <label class="form-check-label" for="radioyoutube">
                                                YouTube
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="media_type" class="form-check-input"
                                                value=image id="radioNo" @if($new_product_blog->media_type == 'image') checked @endif>
                                            <label class="form-check-label" for="radioimage">
                                                Image
                                            </label>
                                        </div>
                                        
                                        @error('media_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Media Content</label>
                                        <input type="text" name="media_content" class="form-control"
                                            placeholder="Enter Media Content" value="{{ $new_product_blog->media_content }}">
                                        @error('media_content')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Button Text</label>
                                        <input type="text" name="button_text" class="form-control"
                                            placeholder="Enter Button Text" value="{{ $new_product_blog->button_text }}">
                                        @error('button_text')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Button Link</label>
                                        <input type="text" name="button_link" class="form-control"
                                            placeholder="Enter Button Link" value="{{ $new_product_blog->button_link }}">
                                        @error('button_link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group-full01">
                                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-1"></div>

                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    <script>
    $(document).ready(function() {
        $(".js-example-basic-multiple").select2();
        displayMediaContentField();
    });
    
    function displayMediaContentField(){
        //display media content according the selected radio
        var checkedValue = $('input[name="media_type"]:checked').val();
        if(checkedValue == 'youtube'){
            $('input[name="media_content"]').attr("type","text");
        }else{
            $('input[name="media_content"]').attr("type","file");
        }
    }
    
    $('input[type=radio][name=media_type]').on('change', displayMediaContentField);
    </script>
    @endsection
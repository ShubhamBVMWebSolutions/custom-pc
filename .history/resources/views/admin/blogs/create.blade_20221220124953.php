@extends('admin.admins-layout.admin_master')
@section('title', 'Add Blog')
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
                        <h5><a href="{{route('admin.blogs.index')}}"><i class="ik ik-edit bg-blue"></i> View
                                All</a></h5>
                        <div class="d-inline">
                            <h5>Add Blog</h5>
                            <span>Add</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
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

                <form class="forms-sample" action="{{route('admin.blogs.store')}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Blog Category</label>
                                        <select name="product_category_id" class="form-control">
                                            <option value="">Select Blog Category</option>
                                            @if($blogCat->count()>0)
                                            @foreach($blogCat as $bcat)
                                            <option value="{{$bcat->id}}">{{$bcat->title}}</option>
                                            @endforeach

                                            @endif
                                        </select>
                                        @error('product_category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputenglish">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Enter Category Title" value="">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea id="content" rows="5" class="form-control" name="content"
                                            placeholder="Category Description"></textarea>
                                        @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Blog Type</label>
                                        <select name="type" class="form-control" required>
                                            <option value="">Select Blog Type</option>
                                            <option value="News">News</option>
                                            <option value="Reviews">Reviews</option>
                                            <option value="Interviews">Interviews</option>
                                            <option value="Competitions">Competitions</option>
                                        </select>
                                        @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Related Products</label>
                                        <select name="product_ids" class="form-control border-primary js-example-basic-multiple" multiple>
                                            <option value="">Select Products</option>
                                            @if($products->count()>0)
                                            @foreach($products as $prod_detail)
                                            <option value="{{$prod_detail->id}}">{{$prod_detail->title}}</option>
                                            @endforeach

                                            @endif
                                        </select>
                                        @error('product_category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group-full01">
                                        <button type="submit" class="btn btn-primary mr-2">Save</button>
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
    CKEDITOR.replace('content');
    </script>

    @endsection
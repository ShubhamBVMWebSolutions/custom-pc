@extends('admin.admins-layout.admin_master')
@section('title', 'Add Product Collection')
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
                        <h5><a href="{{route('admin.product-collections.index')}}"><i class="ik ik-edit bg-blue"></i> View
                                All</a></h5>
                        <div class="d-inline">
                            <h5>Add Product Collection</h5>
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

                <form class="forms-sample" action="{{route('admin.product-collections.store')}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            @if($parent_collections->count()>0)
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Parent Collection</label>
                                            <select name="parent_id"
                                                class="form-control">
                                                <option value="" >Select Option</option>
                                                @foreach($parent_collections as $parent_collection)
                                                <option value="{{$parent_collection->id}}">{{$parent_collection->title}}</option>
                                                @endforeach
    
                                                
                                            </select>
                                        @error('parent_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputenglish">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Enter Title" value="">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                       <div class="form-group col-md-4">
                           <label>Icon Image</label>
                           <br>
                        <input type="file" name="small_icon" class="file-upload-default" accept=".png, .jpg, .jpeg">
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                              <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>
                        </div>
                        </div>
                        
                        <div class="row">
                       <div class="form-group col-md-4">
                           <label>Banner</label>
                           <br>
                        <input type="file" name="banner" class="file-upload-default" accept=".png, .jpg, .jpeg">
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                              <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>
                        </div>
                        </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="description" rows="5" class="form-control" name="description"
                                            placeholder="Description"></textarea>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Related Products</label>
                                        <select name="product_ids[]"
                                            class="form-control border-primary js-example-basic-multiple" multiple>
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
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="form-check">
                                            <input type="radio" name="status" class="form-check-input" value="Active"
                                                id="radioDraft" checked>
                                            <label class="form-check-label" for="radioDraft">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="status" class="form-check-input"
                                                value="Inactive" id="radioPuiblish">
                                            <label class="form-check-label" for="radioPuiblish">
                                                Inactive
                                            </label>
                                        </div>
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Add In Product Menu</label>
                                        <div class="form-check">
                                            <input type="radio" name="list_in_product_menu" class="form-check-input"
                                                value="No" id="radioNo" checked>
                                            <label class="form-check-label" for="radioNo">
                                                No
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="list_in_product_menu" class="form-check-input" value="Yes"
                                                id="radioYes" >
                                            <label class="form-check-label" for="radioYes">
                                                Yes
                                            </label>
                                        </div>
                                        
                                        @error('list_in_product_menu')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Order</label>
                                        <input type="number" min="0" name="order_number" class="form-control"
                                            placeholder="Enter Order Number" value="">
                                        @error('order_number')
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
    <script>
    $(document).ready(function() {
        $(".js-example-basic-multiple").select2();
    });
    </script>
    @endsection
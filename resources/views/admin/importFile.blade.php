@extends('admin.admins-layout.admin_master')
@section('title', 'Import and Export Products')
@section('content')

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Import & Export Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Import & Export</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
                Import and Export Excel data
            </div>
            
            @if(session()->has('alert-success'))
               <div class="alert alert-success alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <strong>Success!</strong> {{ session()->get('alert-success') }} 
               </div>
             @endif
          <div class="card-body">
                <form action="{{route('admin.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control" required>
                    <br>
                   
                    <button class="btn btn-success import_export_btn">
                          Import Product Data
                    </button>
                   
                    <a class="btn btn-warning import_export_btn"
                       href="{{ route('admin.export-products') }}">
                              Export Product Data
                    </a>
                    <br>
                    <br>
                    <a href="{{asset('/public/admin-panel/sample_import_products.xlsx')}}" download>Download import sample file</a>

                </form>
            </div>
        </div>
    </div>

@endsection
@extends('admin.admins-layout.admin_master')
@section('title', 'Update Contact Page')
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
                     <i class="ik ik-edit bg-blue"></i>
                     <div class="d-inline">
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_CONTACT')}}</h5>
                        <span>Update Getting Data</span>
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
             <?php //print_r($aboutdata); ?>
                     <form class="forms-sample" action="{{route('admin.update.contact')}}" method="post" enctype="multipart/form-data">
                        
                        @csrf 
                         <div class="row">
                             <div class="col-md-1"></div>
                        <div class="col-md-10">
                        
                        <div class="row">
                            <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Page Title</label>
                           <input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{$contactdata->title ?? old('title')}}">
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Information Text</label>
                           <textarea rows="10" cols="100" class="form-control" name="information" placeholder="Page content">{{$contactdata->information ?? old('information')}}</textarea>
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Address</label>
                           <textarea id="content" rows="10" cols="100" class="form-control" name="address" placeholder="Page content">{{$contactdata->address ?? old('address')}}</textarea>
                        </div>
                        </div>
                        
                        
                        </div>
                        
                        <div class="form-group-full01">
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
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
   CKEDITOR.replace( 'content' );
</script> 
         
         
@endsection
@extends('admin.admins-layout.admin_master')
@section('title', 'Add Update Attribute')
@section('content')


<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
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
                    
                     <div class="d-inline">
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_COLOR_ATTR')}}</h5>
                        <span>Add/Update Color Attribute</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.add.update.color.attr')}}">Add</a> / Update</li>
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
           @if(isset($colorattrdetails) && !empty($colorattrdetails->id))
                     <form class="forms-sample" action="{{route('admin.add.update.color.attr',['encColorAttrId'=>$colorattrdetails->id])}}" method="post" enctype="multipart/form-data">
                        @else
             <form class="forms-sample" action="{{route('admin.add.update.color.attr')}}" method="post" enctype="multipart/form-data">
                   @endif
                     @csrf    
            <div class="row">
                <div class="col-md-2"></div>
              <div class="col-md-8">
                <div class="card">
                   <div class="card-body">
                         
                         <div class="form-group">
                           <label for="exampleInputUsername1">Color Name</label>
                           <input type="text" name="color_name" class="form-control" value="{{$colorattrdetails->color_name ?? old('color_name')}}">
                        </div>
                        
                        <div class="form-group">
                           <label for="exampleInputUsername1">Color Code</label>
                           <input type="text" name="color_code" class="form-control" placeholder="Ex- #000" value="{{$colorattrdetails->color_code ?? old('color_code')}}">
                        </div>
                        
                        @if(isset($colorattrdetails) && !empty($colorattrdetails->id))
                     <div class="form-group-full01">
                     <button type="submit" class="btn btn-primary mr-2">Update</button>
                     </div>
                     @else
                     <div class="form-group-full01">
                    <button type="submit" class="btn btn-primary ml-2">Publish</button>  
                    </div>
                     @endif
                        
                  </div>
               </div>
            </div>
            <div class="col-md-2"></div>
        </div>
         
         
         
        </form>
         
      </div>
   </div>
</div>



      
      
      
      
        </div>
      
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'overview' );
   CKEDITOR.replace( 'material' );
   CKEDITOR.replace( 'detail' );
   CKEDITOR.replace( 'short_description' );
   CKEDITOR.replace( 'features' );
</script>      
         
          
@endsection
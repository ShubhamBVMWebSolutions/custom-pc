@extends('admin.admins-layout.admin_master')
@section('title', 'Add/Update SSD')
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
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.ADD_UPDATE_SSD')}}</h5>
                        <span>Add/Update</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add / Update</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
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
                  <strong>Success!</strong> {{ session()->get('alert-error') }} 
               </div>
               @endif
               <div class="card">
                  
                  <div class="card-body">
                     @if(isset($screenDetail) && !empty($screenDetail->id))
                     <form class="forms-sample" action="{{route('admin.add.update.ssd.attr',['encSsdAttrId'=>$screenDetail->id])}}" method="post" enctype="multipart/form-data">
                        @else
                     <form class="forms-sample" action="{{route('admin.add.update.ssd.attr')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                        <div class="form-group">
                           <label for="exampleInputUsername1">Attribute Title</label>
                           <input type="text" name="title" class="form-control" value="{{$screenDetail->title ?? old('title')}}" required>
                        </div>
                        
                        <div class="form-group">
                           <label for="exampleInputUsername1">Slug</label>
                           <input type="text" class="form-control" value="{{$screenDetail->slug ?? ''}}" readonly>
                        </div>
                        
                        @if(isset($screenDetail) && !empty($screenDetail->id))
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        @else
                        <button type="submit" class="btn btn-primary mr-2">Add</button>
                        @endif
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-md-2"></div>
         </div>
      </div>
   </div>
</div>

@endsection
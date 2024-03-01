@extends('admin.admins-layout.admin_master')
@section('title', 'Update Chipset')
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
                        <h5>Update Chipset</h5>
                        
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
                     
                     <form class="forms-sample" action="{{route('admin.update.chipset',['encChipsetId'=>$chipset_detail->id])}}" method="post" enctype="multipart/form-data">
                        
                        @csrf
                        <div class="form-group">
                           <label for="exampleInputUsername1">Title</label>
                           <input type="text" name="title" class="form-control" value="{{$chipset_detail->title ?? old('title')}}" readonly required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h4>FPS for 1080</h4>
                                </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>FPS1</label>
                                   <input type="number" name="fps1" value="{{$chipset_detail->fps1}}" class="form-control">
                                   </div> 
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>FPS2</label>
                                   <input type="number" name="fps2" value="{{$chipset_detail->fps2}}" class="form-control">
                                   </div> 
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>FPS3</label>
                                   <input type="number" name="fps3" value="{{$chipset_detail->fps3}}" class="form-control">
                                   </div> 
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>FPS4</label>
                                   <input type="number" name="fps4" value="{{$chipset_detail->fps4}}" class="form-control">
                                   </div> 
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h4>FPS for 1440</h4>
                                </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>FPS5</label>
                                   <input type="number" name="fps5" value="{{$chipset_detail->fps5}}" class="form-control">
                                   </div> 
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>FPS6</label>
                                   <input type="number" name="fps6" value="{{$chipset_detail->fps6}}" class="form-control">
                                   </div> 
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>FPS7</label>
                                   <input type="number" name="fps7" value="{{$chipset_detail->fps7}}" class="form-control">
                                   </div> 
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                   <label>FPS8</label>
                                   <input type="number" name="fps8" value="{{$chipset_detail->fps8}}" class="form-control">
                                   </div> 
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
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
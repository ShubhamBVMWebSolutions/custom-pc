@extends('admin.admins-layout.admin_master')
@section('title', 'E-sewa Setting')
@section('content')

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">E-sewa Setting</h1>
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
                        <h5>Update E-sewa Settings</h5>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Direct Bank Transfer</li>
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
                
                 
                       <?php $mode_val = SiteSettingByName('esewa_mode');
                       $merchant_code = SiteSettingByName('esewa_merchant_code');?> 
                        <div class="row">
                            
                            <div class="col-sm-6">
                                <form class="forms-sample" action="{{route('admin.update.esewa')}}" method="post" enctype="multipart/form-data">
                
                                @csrf
                            <div class="form-group">
                                <label>Select Mode</label>
                                <br>
                                <input type="hidden" name="setting_name" value="esewa_mode">
                                <div><input type="radio" name="setting_val" value="test" @if($mode_val == 'test') checked @endif > Test Mode</div>
                                <div><input type="radio" name="setting_val" value="live" @if($mode_val == 'live') checked @endif > Live Mode</div>
                            </div>   
                               
                          <div class="form-group ">
                        <button type="submit" class="btn btn-primary btn-md mr-2">Update</button>
                        </div>      
                        </form>
                               
                            </div>
                            
                     <div class="col-sm-6">
                         <form class="forms-sample" action="{{route('admin.update.esewa')}}" method="post" enctype="multipart/form-data">
                
                                @csrf
                            <div class="form-group">
                                <label>E-Sewa Merchant Code</label>
                                <br>
                                <input type="hidden" name="setting_name" value="esewa_merchant_code">
                                <input type="text" class="form-control" name="setting_val" value="{{$merchant_code ?? ''}}" > 
                                
                            </div>   
                               
                        <div class="form-group ">
                        <button type="submit" class="btn btn-primary btn-md mr-2">Update</button>
                        </div> 
                        </form>    
                           
                        </div> 
                       
                    </div>
  </div>
  </div>
  </div>

          
@endsection
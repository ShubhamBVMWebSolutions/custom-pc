@extends('admin.admins-layout.admin_master')
@section('title', 'Update Giftcard')
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
                        <h5>Update Giftcard</h5>
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
                @if(isset($giftcard_details) && !empty($giftcard_details->id))
                <form class="forms-sample" action="{{route('admin.manage-giftcard.add_update',[$giftcard_details->id])}}" method="post" enctype="multipart/form-data">
                @else
                <!-- <form class="forms-sample" action="{{route('admin.add.update.coupon')}}" method="post" enctype="multipart/form-data"> -->
                @endif
                    @csrf 
                        
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                               <div class="card">
                                    <div class="card-body">
                                            <div class="row">
                                            <div class="col-md-12">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="title" value="{{$giftcard_details->title ?? old($giftcard_details->title )}}" required>
                                                
                                            </div>
                                        </div>
                                            
                                            <!-- <div class="form-group">
                                                <label>Discount Type</label>
                                                <select class="form-control selected_discount_type" name="discount_type" required="">
             	                                    <option value="">--Select--</option> 
                                                    <option value="amount"  >Fix amount</option> 
                                                    <option value="percent"  >Percent(%)</option>
                                                   
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-form-label">Coupon Type:</label>
                                                 <select class="form-control selected_coupan_type" name="coupon_type" required>
                                                    <option value="fix-time"  >Fix time</option> 
                                                    <option value="life-time" >Life time</option> 
                                                 </select>
                                            </div> -->
                           
                                            <div class="form-group">
                                                <label>Sub Title</label>
                                                <input type="text" class="form-control" name="sub_title" value="{{$giftcard_details->sub_title ?? old($giftcard_details->sub_title )}}" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" name="description" value="{{$giftcard_details->description ?? old($giftcard_details->description )}}" required>
                                            </div>
                                                
                                            <!-- <div class="form-group" id="exp_time">
                                                <label class="col-form-label">Expiry time:</label>
                                                <input type="date" class="form-control form_datetime" value="{{$coupon_details->expiry_time ?? ''}}" name="expiry_time">
                                            </div> -->
                                             
                                            <div class="form-group">
                                                <label>Image</label>
                                             
                                              <?php  if($giftcard_details->giftcards_img !=''){ ?>
                                                <div>
                                                <input type="file" class="form-control" name="giftcard_image" value="" >
                                                </div>
                                                
                                                <div style="margin-top: 15px;">
                                                <img src="{{asset('/uploads/product_gallery_images/'.$giftcard_details->giftcards_img)}}"
                                                   width="200px">
                                              </div>
                                                <?php  }else{ ?>
                                                <input type="file" class="form-control" name="giftcard_image" value="" required>
                                               <?php } ?>
                                                
                                            </div>
                                                
                                            
                                            @if(isset($giftcard_details))
                                            <div class="form-group-full01 ">
                                            <button type="submit" class="btn btn-primary mr-2">Update Giftcard</button>
                                            </div>
                                            @else
                                            <!-- <div class="form-group-full01 ">
                                            <button type="submit" class="btn btn-primary mr-2">Add Coupon</button>
                                            </div> -->
                                            @endif
                                    </div>
                                </div>
                            </div>
                           <div class="col-sm-2"></div> 
                        </div> 
        
        </form> 
  </div>
  </div>
  </div>

         
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

         
         
         
          
@endsection
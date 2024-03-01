@extends('admin.admins-layout.admin_master')
@section('title', 'View Contact Request')
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
                        <h5>View Request</h5>
                        
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View Request</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
         <div class="row">
           
            <div class="col-md-12">
               
               
               <div class="card">
                  
                  <div class="card-body">
                     
                        <div class="form-group">
                           <label >Name</label>
                           <input type="text" class="form-control" value="{{$request_detail->name ?? ''}}" readonly>
                        </div>
                        
                        <div class="form-group">
                           <label>Email</label>
                           <input type="email" class="form-control" value="{{$request_detail->email ?? ''}}" readonly>
                        </div>
                        
                        <div class="form-group">
                           <label>Phone</label>
                           <input type="text" class="form-control" value="{{$request_detail->phone ?? ''}}" readonly>
                        </div>
                        
                        <div class="form-group">
                           <label>Message</label>
                           <textarea class="form-control" rows="10" readonly>{{$request_detail->message ?? ''}}</textarea>
                        </div>
                     
                  </div>
               </div>
            </div>
            
         </div>
      </div>
   </div>
</div>

@endsection
@extends('admin.admins-layout.admin_master')
@section('title', 'Manage Getting Data')
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
                                             <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.ALL_GETTINGS')}}</h5>
                                            <span>All Getting Data</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{Config::get('constants.ADMIN_PAGE_TITLE.ALL_GETTINGS')}}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-sm-12">
                               <div class="card">
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable"
                                                   class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Title</th>
                                                     <th>Image</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if($gettingcount>0)
                                                   @foreach($gettingdata as $key=>$getting)
                                                     <tr id="tbl_record_{{$getting->id}}">
                                                        <td>{{$getting->id}}</td>
                                                        <td>{{$getting->title ?? ''}}</td>
                                                         <td> @if(!empty($getting->image))
                                                            <img src="{{url(Config::get('constants.SITE_IMAGE_PATHS').$getting->image) ?? ''}}" class="table-user-thumb" alt="">
                                                            @endif
                                                        </td>
                                                        
                                                        <td>{{$getting->created_at ?? ''}}</td>
                                                        <td>
                                                          <center>
                                                         <span id="span_status_{{$getting->id}}">
                                                 @if($getting->status==1)
                                                          <a href="javascript:void(0)" class="getting_change_status" id="testi_{{$getting->id}}_inactive">
                                                             <i class=" fas fa-check-circle fa-2x" style="color:green"  data-toggle="tooltip" data-original-title="Location current status is active. Click here if you want to make Inactive"></i>
                                                          </a>
                                                          @else
                                                            <a href="javascript:void(0)" class="getting_change_status" id="testi_{{$getting->id}}_active"><i class=" fas fa-times-circle fa-2x" style="color:red" data-toggle="tooltip" data-original-title="Location current status is Inactive. Click here if you want to make Active"></i>
                                                             </a>
                                                          @endif
                                                        </span>
                                                          </center>

                                                        </td>
                                                        <td>
                                                            <center>
                                                          <a href="{{route('admin.add.update.getting',['encgettingId'=>$getting->id])}}" title="Edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                        </center>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Title</th>
                                                     <th>Image</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                   
         
         
         
         
         </div>
         @endsection
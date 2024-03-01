@extends('admin.admins-layout.admin_master')
@section('title', 'Manage Logos')
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
                                             <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.ALL_LOGOS')}}</h5>
                                            <span>All Logos</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{Config::get('constants.ADMIN_PAGE_TITLE.ALL_LOGOS')}}</li>
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
                                                    <th>#</th>
                                                    <th>Title</th>
                                                     <th>Image</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if($logocount>0)
                                                   @foreach($homelogos as $key=>$logo)
                                                     <tr id="tbl_record_{{$logo->id}}">
                                                        <td>{{$logo->id}}</td>
                                                        <td>{{$logo->title ?? ''}}</td>
                                                         <td> @if(!empty($logo->image))
                                                            <img src="{{url(Config::get('constants.HOME_LOGOS_IMAGE_PATHS').$logo->image) ?? ''}}" class="table-user-thumb" alt="">
                                                            @endif
                                                        </td>
                                                        
                                                        <td>{{$logo->created_at ?? ''}}</td>
                                                        <td>
                                                          <center>
                                                         <span id="span_status_{{$logo->id}}">
                                                 @if($logo->status==1)
                                                          <a href="javascript:void(0)" class="logo_change_status" id="logo_{{$logo->id}}_inactive">
                                                             <i class=" fas fa-check-circle fa-2x" style="color:green"  data-toggle="tooltip" data-original-title="Location current status is active. Click here if you want to make Inactive"></i>
                                                          </a>
                                                          @else
                                                            <a href="javascript:void(0)" class="logo_change_status" id="logo_{{$logo->id}}_active"><i class=" fas fa-times-circle fa-2x" style="color:red" data-toggle="tooltip" data-original-title="Location current status is Inactive. Click here if you want to make Active"></i>
                                                             </a>
                                                          @endif
                                                        </span>
                                                          </center>

                                                        </td>
                                                        <td>
                                                          <a href="{{route('admin.add.update.home.logo',['enclogoId'=>$logo->id])}}" title="Edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                          <a href="javascript:void(0)" class="ajax_delete_logo" id="logo_{{$logo->id}}"><i class="ik ik-trash-2 f-16 text-red" data-toggle="tooltip" data-original-title="Click here for delete it"></i></a>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
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
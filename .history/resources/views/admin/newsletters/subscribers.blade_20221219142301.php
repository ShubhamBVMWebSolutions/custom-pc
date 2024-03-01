@extends('admin.admins-layout.admin_master')
@section('title', 'Newsletter Subscribers');
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
                                        <div class="d-inline">
                                             <h5>Newsletter Subscribers</h5>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{Config::get('constants.ADMIN_PAGE_TITLE.subscribers')}}</li>
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
                                                    <th>Email</th>
                                                    <th>Verifies Status</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if($subscribers->count()>0)
                                                   @foreach($subscribers as $key=>$user)
                                                     <tr id="tbl_record_{{$user->id}}">
                                                        <td>{{$loop->index + 1}}</td>
                                                        <td>{{$user->email}}</td>
                                                        
                                                        <td>
                                                         <span id="span_status_{{$user->id}}">
                                                        @if($user->is_verified=='Yes')
                                                          <a href="javascript:void(0)" class="user_change_status" id="user_{{$user->id}}_0" style="color: green;" title="Click herre to make Unverified">Verified</a>
                                                          @else
                                                            <a href="javascript:void(0)" class="user_change_status" id="user_{{$user->id}}_1" style="color: red;" title="Click here to make Verified">Unverified</a>
                                                          @endif
                                                        </span>

                                                        </td>
                                                        <td>{{$user->created_at ?? ''}}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                   
         
         
         
         
         </div>
         @endsection
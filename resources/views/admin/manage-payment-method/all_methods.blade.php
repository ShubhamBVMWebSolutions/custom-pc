@extends('admin.admins-layout.admin_master')
@section('title', 'Manage Payment Methods')
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
                                             <h5>Manage Payment Methods</h5>
                                            <span>All Methods</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Manage Payment Methods</li>
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
                                                    <th>Payment Method</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if($paymentMethods->count() > 0)
                                                   @foreach($paymentMethods as $key=>$method)
                                                     <tr id="tbl_record_{{$method->id}}">
                                                        <td>{{$method->id}}</td>
                                                        <td>{{$method->title ?? ''}}</td>
                                                        <td>
                                                           <center>
                                                         <span id="span_status_{{$method->id}}">
                                                         @if($method->status==1)
                                                           <a href="javascript:void(0)" class="method_change_status" id="method_{{$method->id}}_inactive">
                                                             <i class=" fas fa-check-circle fa-2x" style="color:green"  data-toggle="tooltip" data-original-title="Click here to make it Disable"></i>
                                                          </a>
                                                          @else
                                                            <a href="javascript:void(0)" class="method_change_status" id="method_{{$method->id}}_active">
                                                                <i class=" fas fa-times-circle fa-2x" style="color:red" data-toggle="tooltip" data-original-title="Click here to make it Enable"></i>
                                                             </a>
                                                          @endif
                                                        </span>
                                                          </center>

                                                        </td>
                                                        <td>{{$method->created_at ?? ''}}</td>
                                                        <td>
                                                            @if($method->value == 'bank_transfer')
                                                          <a href="{{route('admin.add.update.bank.account')}}" title="Edit"><i class="ik ik-edit f-16 text-green"></i> Edit</a>
                                                         @endif 
                                                         
                                                        @if($method->value == 'esewa')
                                                          <a href="{{route('admin.update.esewa')}}" title="Edit"><i class="ik ik-edit f-16 text-green"></i> Edit</a>
                                                         @endif  
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Payment Method</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
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
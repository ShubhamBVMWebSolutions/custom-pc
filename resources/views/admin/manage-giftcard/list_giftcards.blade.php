@extends('admin.admins-layout.admin_master')
@section('title', 'Manage Giftcards category')
@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">Manage Gift Card category
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
                                        <!-- <h5><a href="{{route('admin.add.update.coupon')}}"><i class="ik ik-plus bg-blue"></i> Add New</a></h5> -->
                                        <div class="d-inline">
                                             <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_GIFTCARD')}}</h5>
                                            <span>All Gift Card Category</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_GIFTCARD')}}</li>
                                        </ol>
                                    </nav>
                                </div> 
                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-sm-12">
                               <div class="card">
                                    <div class  ="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable"
                                                   class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Title</th>
                                                    <th>Sub Title</th>
                                                    <th>Description</th>
                                                    <!-- <th>Form Title</th>  -->
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if($giftcardcategory->count() > 0)
                                                   @foreach($giftcardcategory as $key=>$giftcardcategory_data)
                                                     <tr id="tbl_record_{{$giftcardcategory_data->id}}">
                                                        <td>{{$giftcardcategory_data->id}}</td>
                                                        <td>{{$giftcardcategory_data->title ?? ''}}</td>
                                                        <td>{{$giftcardcategory_data->sub_title ?? ''}}</td>
                                                        <td>{{$giftcardcategory_data->description ?? ''}}</td>
                                                        <td>
                                                          <a href="{{route('admin.add.update.giftcard',['enGiftCardid'=>$giftcardcategory_data->id])}}" title="Edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                          <!-- <a href="javascript:void(0)" class="ajax_delete_coupon" id="coupon_{{$giftcardcategory_data->id}}"><i class="ik ik-trash-2 f-16 text-red" data-toggle="tooltip" data-original-title="Click here for delete it"></i></a> -->
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Title</th>
                                                    <th>Sub Title</th>
                                                    <th>Description</th>
                                               
                                                    <!-- <th>Form Title</th>  -->
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
@extends('admin.admins-layout.admin_master')
@section('title', 'Manage Chipset Sub Category')
@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Chipset Sub Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Chipset Subcategory</li>
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
                                        <h5><a href="{{route('admin.add.update.chipset.subcat')}}"><i class="ik ik-plus bg-blue"></i> Add New</a></h5>
                                        <div class="d-inline">
                                             <h5>Manage Chipset Subcategory</h5>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Manage Chipset Subcategory</li>
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
                                                    <th>Chipset</th>
                                                    <th>Products For Budget(NPR {{$budgets[0]->amount}})</th>
                                                    <th>Products For Budget(NPR {{$budgets[1]->amount}})</th>
                                                    <th>Products For Budget(NPR {{$budgets[2]->amount}})</th>
                                                    <th>Products For Budget(NPR {{$budgets[3]->amount}})</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if($allsubcat->count() > 0)
                                                   @foreach($allsubcat as $key=>$chipset_cat)
                                                     <tr id="tbl_record_{{$chipset_cat->id}}">
                                                        <td>{{$chipset_cat->id}}</td>
                                                        <td>{{$chipset_cat->subcat_title ?? ''}}</td>
                                                        <td>@if(!empty(getchipsetById($chipset_cat->chipset_id))) {{getchipsetById($chipset_cat->chipset_id)->title}} @endif</td>
                                                        <td>
                                                            @if(!empty($chipset_cat->product1_details))

                                                                <div>
                                                                    @if(!empty($chipset_cat->product1_details->image))
                                                                        <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$chipset_cat->product1_details->image)}}" class="table-user-thumb" alt="">
                                                                    @else
                                                                        <img src="{{asset('public/img/default_pic.png')}}" class="table-user-thumb" alt="">
                                                                    @endif
                                                                <b>{{$chipset_cat->product1_details->title}}</b>
                                                                <br>
                                                                NPR <b>{{$chipset_cat->product1_details->price}}</b>
                                                                
                                                                </div>    
                                                            @endif
                                                            
                                                        </td>
                                                        <td>
                                                            @if(!empty($chipset_cat->product2_details))
                                                                <div>
                                                                    @if(!empty($chipset_cat->product2_details->image))
                                                                        <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$chipset_cat->product2_details->image)}}" class="table-user-thumb" alt="">
                                                                    @else
                                                                        <img src="{{asset('public/img/default_pic.png')}}" class="table-user-thumb" alt="">
                                                                    @endif
                                                                <b>{{$chipset_cat->product2_details->title}}</b>
                                                                <br>
                                                                NPR <b>{{$chipset_cat->product2_details->price}}</b>
                                                                
                                                                </div>    
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($chipset_cat->product3_details))
                                                                <div>
                                                                    @if(!empty($chipset_cat->product3_details->image))
                                                                        <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$chipset_cat->product3_details->image)}}" class="table-user-thumb" alt="">
                                                                    @else
                                                                        <img src="{{asset('public/img/default_pic.png')}}" class="table-user-thumb" alt="">
                                                                    @endif
                                                                <b>{{$chipset_cat->product3_details->title}}</b>
                                                                <br>
                                                                NPR <b>{{$chipset_cat->product3_details->price}}</b>
                                                                
                                                                </div>    
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($chipset_cat->product4_details))
                                                                <div>
                                                                    @if(!empty($chipset_cat->product4_details->image))
                                                                        <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$chipset_cat->product4_details->image)}}" class="table-user-thumb" alt="">
                                                                    @else
                                                                        <img src="{{asset('public/img/default_pic.png')}}" class="table-user-thumb" alt="">
                                                                    @endif
                                                                <b>{{$chipset_cat->product4_details->title}}</b>
                                                                <br>
                                                                NPR <b>{{$chipset_cat->product4_details->price}}</b>
                                                                
                                                                </div>    
                                                            @endif
                                                        </td>
                                                        <td>{{$chipset_cat->created_at ?? ''}}</td>
                                                        <td>
                                                          <a href="{{route('admin.add.update.chipset.subcat',['encChipsetSubcatId'=>$chipset_cat->id])}}" title="Edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Title</th>
                                                    <th>Chipset</th>
                                                    <th>Products For Budget(NPR {{$budgets[0]->amount}})</th>
                                                    <th>Products For Budget(NPR {{$budgets[1]->amount}})</th>
                                                    <th>Products For Budget(NPR {{$budgets[2]->amount}})</th>
                                                    <th>Products For Budget(NPR {{$budgets[3]->amount}})</th>
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
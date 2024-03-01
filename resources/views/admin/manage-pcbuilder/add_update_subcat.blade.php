@extends('admin.admins-layout.admin_master')
@section('title', 'Add Update Chipset Sub Category')
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
                        <h5>Add Update Chipset Sub Category</h5>
                        <span>Add/Update</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add / Update</li>
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
                     @if(isset($subcat_detail) && !empty($subcat_detail->id))
                     <form class="forms-sample" action="{{route('admin.add.update.chipset.subcat',['encChipsetSubcatId'=>$subcat_detail->id])}}" method="post" enctype="multipart/form-data">
                        @else
                     <form class="forms-sample" action="{{route('admin.add.update.chipset.subcat')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                        <div class="form-group">
                           <label for="exampleInputUsername1">Sub Category Title</label>
                           <input type="text" name="subcat_title" class="form-control" value="{{$subcat_detail->subcat_title ?? old('subcat_title')}}" readonly required>
                        </div>
                        
                        <div class="form-group">
                            <label>Select Chipset</label>
                            <select name="chipset" class="form-control" required>
                                <option value="">Select</option>
                                @foreach($all_chipset as $chipset)
                                <option value="{{$chipset->id}}" @if(!empty($subcat_detail->chipset_id) && $subcat_detail->chipset_id == $chipset->id) selected @else disabled @endif >{{$chipset->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Select Product (Budget Price: NPR {{$budgets[0]->amount}} @if($product1_sum):: Total Added Product Price: NPR <span class="@if($budgets[0]->amount > $product1_sum) text-success @else text-red @endif">{{$product1_sum}}</span>  @endif) </label>
                            <select name="product_id1" class="form-control" required>
                                <option value="">Select Product</option>
                                @foreach($all_products as $prod)
                                <option value="{{$prod->id}}" @if(isset($subcat_detail->product_id1) && $subcat_detail->product_id1 == $prod->id) selected @endif >{{$prod->title}}; Price: NPR {{$prod->price}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                         <div class="form-group">
                            <label>Select Product (Budget Price: NPR {{$budgets[1]->amount}} @if($product2_sum):: Total Added Product Price: NPR <span class="@if($budgets[1]->amount > $product2_sum) text-success @else text-red @endif">{{$product2_sum}}</span>  @endif)</label>
                            <select name="product_id2" class="form-control" required>
                                <option value="">Select Product</option>
                                @foreach($all_products as $prod)
                                <option value="{{$prod->id}}" @if(isset($subcat_detail->product_id2) && $subcat_detail->product_id2 == $prod->id) selected @endif >{{$prod->title}} ; Price: NPR {{$prod->price}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                         <div class="form-group">
                            <label>Select Product (Budget Price: NPR {{$budgets[2]->amount}} @if($product3_sum):: Total Added Product Price: NPR <span class="@if($budgets[2]->amount > $product3_sum) text-success @else text-red @endif">{{$product3_sum}}</span>  @endif)</label>
                            <select name="product_id3" class="form-control" required>
                                <option value="">Select Product</option>
                                @foreach($all_products as $prod)
                                <option value="{{$prod->id}}" @if(isset($subcat_detail->product_id3) && $subcat_detail->product_id3 == $prod->id) selected @endif >{{$prod->title}} ; Price: NPR {{$prod->price}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                         <div class="form-group">
                            <label>Select Product (Budget Price: NPR {{$budgets[3]->amount}} @if($product4_sum):: Total Added Product Price: NPR <span class="@if($budgets[3]->amount > $product4_sum) text-success @else text-red @endif">{{$product4_sum}}</span>  @endif)</label>
                            <select name="product_id4" class="form-control" required>
                                <option value="">Select Product</option>
                                @foreach($all_products as $prod)
                                <option value="{{$prod->id}}" @if(isset($subcat_detail->product_id4) && $subcat_detail->product_id4 == $prod->id) selected @endif >{{$prod->title}} ; Price: NPR {{$prod->price}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        
                        @if(isset($subcat_detail) && !empty($subcat_detail->id))
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        @else
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        @endif
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
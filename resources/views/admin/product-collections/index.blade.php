@extends('admin.admins-layout.admin_master')
@section('title', 'Product Collections')
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
                        <h5><a href="{{route('admin.product-collections.create')}}"><i class="ik ik-plus bg-blue"></i> Add New</a>
                        </h5>
                        <div class="d-inline">
                            <h5>Product Collections</h5>
                            <span>All Product Collections</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Product Collections</li>
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
                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Parent Collection</th>
                                        <th>Icon</th>
                                        <th>Banner</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Order Number</th>
                                        <th>Added In Product List Menu</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($product_collections->count() > 0)
                                    @foreach($product_collections as $key=>$row)
                                    <tr id="tbl_record_{{$row->id}}">
                                        <td>{{$loop->index + 1 }}</td>
                                        <td>{{$row->title ?? ''}}</td>
                                        <td>@if($row->parent_id) {{$row->parent_collection->title}} @endif</td>
                                        @php if(!empty($row->small_icon)){$smallIcon = url(Config::get('constants.SITE_PRODUCT_IMAGE').$row->small_icon );  }else{ $smallIcon = asset('public/img/soi_icon.png'); } @endphp
                                        <td><img class="backpanel_member_img" src="{{$smallIcon}}"  width="50" height="50"></td>
                                        @php if(!empty($row->banner)){$bannerImg = url(Config::get('constants.SITE_PRODUCT_IMAGE').$row->banner );  }else{ $bannerImg = asset('public/img/pc-697642_960_720.jpg'); } @endphp
                                        <td><img class="backpanel_member_img" src="{{$bannerImg}}"  width="160" height="90"></td>
                                        <td>{{$row->description ?? ''}}</td>
                                        <td>{{$row->status ?? ''}}</td>
                                        <td>{{$row->order_number ?? ''}}</td>
                                        <td>{{$row->list_in_product_menu ?? ''}}</td>
                                        <td>
                                            @php $id = $row->id; @endphp
                                            <a href="{{ route('admin.product-collections.edit',[base64_encode($id)]) }}"
                                                title="Edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                            <a href="javascript:void(0)" class="ajax_delete_product_collection"
                                                id="collection_{{$row->id}}"><i class="ik ik-trash-2 f-16 text-red"
                                                    data-toggle="tooltip"
                                                    data-original-title="Click here for delete it"></i></a>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Parent Collection</th>
                                        <th>Icon</th>
                                        <th>Banner</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Order Number</th>
                                        <th>Added In Product List Menu</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('custom_scripts')
<script>
//delete product-collection ajax
$(document).on('click', '.ajax_delete_product_collection', function(e) {
    var mixbtnId = $(this).attr('id');
    var explode_btnid = mixbtnId.split('_');
    var statusFor = explode_btnid[0];
    var idFor = explode_btnid[1];

    statusTex = 'Do you want to delete it?';

    if (idFor != '') {
        swal({
                title: "Are you sure!",
                text: statusTex,
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                showCancelButton: true,
                // dangerMode: true,
                //confirmButtonColor: '#dc3545',
            },
            function() {
                $("#preloader").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{route('admin.product-collections.destroy',['" + idFor + "'])}}",
                    data: {
                        idFor: idFor
                    },
                    type: "DELETE",
                    dataType: 'json',
                    success: function(res) {
                        $("#preloader").hide();
                        GetResponse = res.status;
                        if (GetResponse == 1) {
                            swal("Success!", "Record deleted successfully!", "success");
                            $("#tbl_record_" + idFor).hide();
                        } else {
                            SomethingWentWrongTryagain();
                        }
                    },
                    error: function(error) {
                        console.log("Error:");
                        console.log(error);
                    }
                });

            });
    }
});

//product-collection delete

$(document).on('click', '.product_collection_change_status', function(e) {
    var mixbtnId = $(this).attr('id');
    var explode_btnid = mixbtnId.split('_');
    var statusFor = explode_btnid[0];
    var idFor = explode_btnid[1];
    var statusNew = explode_btnid[2];

    if (statusNew == 'inactive') {
        var statusTex = 'Do you want update status as inactive?';
    }

    if (statusNew == 'active') {
        var statusTex = 'Do you want to update status as active?';
    }

    if (idFor != '') {
        swal({
                title: "Are you sure!",
                text: statusTex,
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                showCancelButton: true,
                // dangerMode: true,
                //confirmButtonColor: '#dc3545',
            },
            function() {
                $("#preloader").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: SITE_URL_ADMIN + "/ajax/update-status-product-collection",
                    data: {
                        statusFor: statusFor,
                        idFor: idFor,
                        statusNew: statusNew
                    },
                    type: "POST",
                    dataType: 'json',
                    success: function(res) {
                        $("#preloader").hide();
                        GetResponse = res.status;
                        if (GetResponse == 1) {
                            swal("Success!", "Status updated successfully!", "success");


                            if (statusNew == 'inactive') {
                                $("#span_status_" + idFor).html('');
                                $("#span_status_" + idFor).html(
                                    '<a href="javascript:void(0)" class="product_collection_change_status" id="' +
                                    statusFor + '_' + idFor +
                                    '_active"><i class=" fas fa-times-circle fa-2x" style="color:red"></i></a>'
                                    );
                            } else {
                                $("#span_status_" + idFor).html('');
                                $("#span_status_" + idFor).html(
                                    '<a href="javascript:void(0)" class="product_collection_change_status" id="' +
                                    statusFor + '_' + idFor +
                                    '_inactive"> <i class=" fas fa-check-circle fa-2x" style="color:green"></i></a>'
                                    );
                            }

                        }
                    },
                    error: function(error) {
                        console.log("Error:");
                        console.log(error);
                    }
                });

            });
    }
});
</script>
@endpush
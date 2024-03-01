@extends('admin.admins-layout.admin_master')
@section('title', 'Blog Categories')
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
                        <h5><a href="{{route('admin.blogs.create')}}"><i class="ik ik-plus bg-blue"></i> Add New</a>
                        </h5>
                        <div class="d-inline">
                            <h5>Blog Categories</h5>
                            <span>All Blog Categories</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Categories</li>
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
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Published Date/Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($blogs->count() > 0)
                                    @foreach($blogs as $key=>$row)
                                    <tr id="tbl_record_{{$row->id}}">
                                        <td>{{$loop->index }}</td>
                                        <td>@if(!empty($row->image)) <img src="{{ url('public/'.$row->image)}}" alt=""> @endif</td>
                                        <td>{{$row->title ?? ''}}</td>
                                        <td>{{ $row->published ?? '' }}</td>
                                        <td>{{ $row->published_at ?? '' }}</td>
                                        <td>
                                            @php $id = $row->id; @endphp
                                            <a href="{{ route('admin.blogs.edit',[base64_encode($id)]) }}"
                                                title="Edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                            <a href="javascript:void(0)" class="ajax_delete_blog"
                                                id="blog_{{$row->id}}"><i class="ik ik-trash-2 f-16 text-red"
                                                    data-toggle="tooltip"
                                                    data-original-title="Click here for delete it"></i></a>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Published Date/Time</th>
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
//delete blog ajax
$(document).on('click', '.ajax_delete_blog', function(e) {
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
                    url: "{{route('admin.blogs.destroy',['" + idFor + "'])}}",
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

//blog delete
$(document).on('click', '.blog_change_status', function(e) {
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
                    url: SITE_URL_ADMIN + "/ajax/update-status-blog",
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
                                    '<a href="javascript:void(0)" class="blog_change_status" id="' +
                                    statusFor + '_' + idFor +
                                    '_active"><i class=" fas fa-times-circle fa-2x" style="color:red"></i></a>'
                                    );
                            } else {
                                $("#span_status_" + idFor).html('');
                                $("#span_status_" + idFor).html(
                                    '<a href="javascript:void(0)" class="blog_change_status" id="' +
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
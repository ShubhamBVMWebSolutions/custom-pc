@extends('admin.admins-layout.admin_master')
@section('title', 'Reviews')
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
                        </h5>
                        <div class="d-inline">
                            <h5>Reviews</h5>
                            <span>All Reviews</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Reviews</li>
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
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Review Title</th>
                                        <th>Review Content</th>
                                        <th>Recommend Product</th>
                                        <th>Over All Rating</th>
                                        <th>Quality Rating</th>
                                        <th>Value For Money Rating</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($reviews->count() > 0)
                                    @foreach($reviews as $key=>$row)
                                    <tr id="tbl_record_{{$row->id}}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->product->title }}</td>
                                        <td>{{ $row->review_title }}</td>
                                        <td>{{ $row->review_content }}</td>
                                        <td>{{ $row->recommend_product }}</td>
                                        <td>
                                            <div class="rating" style="color:rgb(255, 199, 0);">
                                                <i class="fa @if($row->rating == 1 || $row->rating == 2 || $row->rating == 3 || $row->rating == 4 || $row->rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->rating == 2 || $row->rating == 3 || $row->rating == 4 || $row->rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->rating == 3 || $row->rating == 4 || $row->rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->rating == 4 || $row->rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->rating == 5) fa-star @else fa-star-o @endif"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rating" style="color:rgb(255, 199, 0);">
                                                <i class="fa @if($row->quality_rating == 1 || $row->quality_rating == 2 || $row->quality_rating == 3 || $row->quality_rating == 4 || $row->quality_rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->quality_rating == 2 || $row->quality_rating == 3 || $row->quality_rating == 4 || $row->quality_rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->quality_rating == 3 || $row->quality_rating == 4 || $row->quality_rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->quality_rating == 4 || $row->quality_rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->quality_rating == 5) fa-star @else fa-star-o @endif"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rating" style="color:rgb(255, 199, 0);">
                                                <i class="fa @if($row->value_for_money_rating == 1 || $row->value_for_money_rating == 2 || $row->value_for_money_rating == 3 || $row->value_for_money_rating == 4 || $row->value_for_money_rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->value_for_money_rating == 2 || $row->value_for_money_rating == 3 || $row->value_for_money_rating == 4 || $row->value_for_money_rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->value_for_money_rating == 3 || $row->value_for_money_rating == 4 || $row->value_for_money_rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->value_for_money_rating == 4 || $row->value_for_money_rating == 5) fa-star @else fa-star-o @endif"></i>
                                                <i class="fa @if($row->value_for_money_rating == 5) fa-star @else fa-star-o @endif"></i>
                                            </div>
                                        </td>
                                        <td>{{ $row->status }}</td>
                                        <td>
                                            @php $id = $row->id; @endphp
                                            @if($row->status == 'Pending')
                                                    <a href="{{ route('admin.reviews.update-status',[$row->id,'Approved'])}}" title="Approved"><i class="ik ik-check f-16 mr-15 text-green"></i></a>
                                                    <a href="{{ route('admin.reviews.update-status',[$row->id,'Rejected'])}}" title="Rejected"><i class="ik ik-x f-16 mr-15 text-red"></i></a>
                                            @endif        
                                            <a href="javascript:void(0)" class="ajax_delete_review"
                                                id="review_{{$row->id}}" title="Delete"><i class="ik ik-trash-2 f-16 text-red"
                                                    data-toggle="tooltip"
                                                    data-original-title="Click here for delete it"></i></a>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Review Title</th>
                                        <th>Review Content</th>
                                        <th>Recommend Product</th>
                                        <th>Over All Rating</th>
                                        <th>Quality Rating</th>
                                        <th>Value For Money Rating</th>
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
    </div>
</section>
@endsection

@push('custom_scripts')
<script>
//delete blog ajax
$(document).on('click', '.ajax_delete_review', function(e) {
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
                    url: "{{route('admin.reviews.destroy')}}",
                    data: {
                        idFor: idFor
                    },
                    type: "POST",
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

</script>
@endpush
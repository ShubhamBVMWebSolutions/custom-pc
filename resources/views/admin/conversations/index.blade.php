@extends('admin.admins-layout.admin_master')
@section('title', 'Chats')
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
                            <h5>Chats</h5>
                            <span>All Chats</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Chats</li>
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
                                        <th>Conversation</th>
                                        <th>Participant</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($conversations->count() > 0)
                                    @foreach($conversations as $key=>$row)
                                        <tr id="tbl_record_{{$row->id}}">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ strtotime($row->created_at) }}</td>
                                            <td>@if(empty($row->second_person)) Guest @else {{ $row->second_person->name }} @endif </td>
                                            <td>
                                                @if(getConversationStatusForAdmin($row->id, auth('admin')->user()->id) == true) <span class ="text-danger">&#128308;</span> @endif
                                                <a href="{{ route('messages.index',[base64_encode(auth('admin')->user()->id),base64_encode($row->second_person_id)]) }}" onclick="window.open('{{ route('messages.index',[base64_encode(auth('admin')->user()->id),base64_encode($row->second_person_id)]) }}', 
                         '_blank', 
                         'left=0,top=0,width=350,height=600,toolbar=no,location=no,status=no,menubar=no,resizable=no'); 
              return false;">Chat Now</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Conversation</th>
                                        <th>Participant</th>
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
                    url: "{{route('admin.conversations.destroy',['" + idFor + "'])}}",
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

</script>
@endpush
@extends('admin.admins-layout.admin_master')
@section('title', 'Catalogues')
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
                                        <h5><a href="{{route('admin.catalogues.create')}}"><i class="ik ik-plus bg-blue"></i> Add New</a></h5>
                                        <div class="d-inline">
                                             <h5>Catalogues</h5>
                                            <span>All Catalogues</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Catalogues</li>
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
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Banner Image</th>
                                                    <th>PDF</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if($catalogues->count() > 0)
                                                   @foreach($catalogues as $key=>$row)
                                                     <tr id="tbl_record_{{$row->id}}">
                                                        <td>{{ $row->id }}</td>
                                                        <td>{{ $row->title }}</td>
                                                        <td>{{ date('d M Y', strtotime($row->start_date)) }}</td>
                                                        <td>{{ date('d M Y', strtotime($row->end_date)) }}</td>
                                                        <td>@if(!empty($row->banner)) <img src="{{ asset('/public/uploads/catalogues/'.$row->banner) }}" alt="{{ $row->title }}" style="width:160px;height:90px"> @endif</td>
                                                        <td>@if(!empty($row->pdf)) <a href="{{ asset('/public/uploads/catalogues/'.$row->pdf) }}" target="_blank">View</a> @endif</td>
                                                        <td>{{ $row->status }}</td>
                                                        <td>
                                                          @php $id = $row->id; @endphp
                                                          <a href="{{ route('admin.catalogues.edit',[base64_encode($id)]) }}" title="Edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                          <a href="javascript:void(0)" class="ajax_delete_catalogue" id="catalogue_{{$row->id}}"><i class="ik ik-trash-2 f-16 text-red" data-toggle="tooltip" data-original-title="Click here for delete it"></i></a>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Banner Image</th>
                                                    <th>PDF</th>
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

@push('custom_scripts')
<script>
  //delete blog category ajax
$(document).on('click', '.ajax_delete_catalogue', function (e) {
      var mixbtnId = $(this).attr('id');
      var explode_btnid = mixbtnId.split('_');
      var statusFor    = explode_btnid[0];
      var idFor        = explode_btnid[1];

      statusTex = 'Do you want to delete it?';

      if(idFor!='')
      {
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
           function() 
           {
                $("#preloader").show();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
               });
                
            $.ajax({
                url:"{{route('admin.catalogues.destroy',['"+idFor+"'])}}",
                data:{idFor:idFor},
                type:"DELETE",
                dataType:'json',
                success:function(res)
                {
                  $("#preloader").hide();
                  GetResponse = res.status;
                  if(GetResponse==1)
                  {
                   swal("Success!", "Record deleted successfully!", "success");
                    $("#tbl_record_"+idFor).hide();
                  }else{
                      SomethingWentWrongTryagain();
                  }
                },
                error: function(error){
                console.log("Error:");
                console.log(error);
                 }
            });

        });
      }
});
</script>
@endpush
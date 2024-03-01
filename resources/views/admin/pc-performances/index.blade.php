@extends('admin.admins-layout.admin_master')
@section('title', 'Performances')
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
                            <h5>Performances</h5>
                            <span>All Performances</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Performances</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
            <div class="col-md-12">
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
                    <strong>Failed!</strong> {{ session()->get('alert-error') }}
                </div>
                @endif
            </div>
        </div>
                <div class="card">
                    <div class="card-body">
                        
                        <div class="row">
                                <div class="col-lg-12">
                                        <form action="{{route('admin.pc-performances.update-or-insert')}}" method="post"> 
                                        @csrf
                                            <div class="row">
                                                    <div class="col-lg-4">
                                                            <div class="form-group">
                                                                    <label>Budget</label>
                                                                    <select class="form-control" name="pc_budget_id" onchange="getPerformances();">
                                                                        <option value="">
                                                                            Select Budget
                                                                        </option>
                                                                        @if($budgets->count())
                                                                            @foreach($budgets as $budget)
                                                                                <option value="{{$budget->id}}">
                                                                                    {{$budget->amount}}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                            </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                            <div class="form-group">
                                                                    <label>Chipset</label>
                                                                    <select class="form-control" name="chipset_id" onchange="getPerformances();">
                                                                        <option value="">
                                                                            Select Chipset
                                                                        </option>
                                                                        @if($chipsets->count())
                                                                            @foreach($chipsets as $chipset)
                                                                                <option value="{{$chipset->id}}">
                                                                                    {{$chipset->title}}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                            </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                            <div class="form-group">
                                                                    <label>Pixels</label>
                                                                    <select class="form-control" name="pixel" onchange="getPerformances();">
                                                                        <option value="">
                                                                            Select Pixels
                                                                        </option>
                                                                        <option value="1080">
                                                                            1080
                                                                        </option>
                                                                        <option value="1440">
                                                                            1440
                                                                        </option>
                                                                    </select>
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-12">
                                                            <label>
                                                                Performances
                                                            </label>
                                                            <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <label>Call OF Duty FPS</label>
                                                                        <input type="number" min="0" class="form-control" name="cod_fps">
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <label>Fortnite FPS</label>
                                                                        <input type="number" min="0" class="form-control" name="fortnite_fps">
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <label>Minecraft FPS</label>
                                                                        <input type="number" min="0" class="form-control" name="minecraft_fps">
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <label>Grand Theft Auto FPS</label>
                                                                        <input type="number" min="0" class="form-control" name="gta_fps">
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mt-2">
                                                    <div class="form-group-full01">
                                                        <button type="submit" class="btn btn-primary mr-2" id="submitButton">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                </div>
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
function displaySubmitButton(){
    let budgetSelect = $("select[name='pc_budget_id']").val();
    let chipsetSelect = $("select[name='chipset_id']").val();
    let pixelSelect = $("select[name='pixel']").val();
    if(budgetSelect && chipsetSelect && pixelSelect){
        $("#submitButton").show();
        return true;
    }else{
        $("#submitButton").hide();
        return false;
    }
}

function getPerformances(){
    let displayFlag = displaySubmitButton();
    if(displayFlag){
        let budgetSelect = $("select[name='pc_budget_id']").val();
        let chipsetSelect = $("select[name='chipset_id']").val();
        let pixelSelect = $("select[name='pixel']").val();
        $.post("{{route('api.get-pc-performances')}}",
        {
            pc_budget_id: budgetSelect,
            chipset_id: chipsetSelect,
            pixel: pixelSelect,
        },
        function(data, status){
            
            if(data.response){
                $("input[name='cod_fps']").val(data.data.cod_fps);
                $("input[name='fortnite_fps']").val(data.data.fortnite_fps);
                $("input[name='minecraft_fps']").val(data.data.minecraft_fps);
                $("input[name='gta_fps']").val(data.data.gta_fps);
            }else{
                $("input[name='cod_fps']").val('');
                $("input[name='fortnite_fps']").val('');
                $("input[name='minecraft_fps']").val('');
                $("input[name='gta_fps']").val('');
            }    
        });
    }
}

getPerformances();

</script>
@endpush
@extends('admin.admins-layout.admin_master')
@section('title', 'Add Store')
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
                        <h5><a href="{{route('admin.stores.index')}}"><i class="ik ik-edit bg-blue"></i> View
                                All</a></h5>
                        <div class="d-inline">
                            <h5>Add Store</h5>
                            <span>Add</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

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

                <form class="forms-sample" action="{{route('admin.stores.store')}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label >Title</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Enter Title" value="" required>
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Address Line 1</label>
                                        <input type="text" name="address_line_1" class="form-control"
                                            placeholder="Enter Address Address Line 1" value="" required>
                                        @error('address_line_1')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Address Line 2</label>
                                        <input type="text" name="address_line_2" class="form-control"
                                            placeholder="Enter Address Address Line 2" value="">
                                        @error('address_line_2')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label >City</label>
                                        <input type="text" name="city" class="form-control"
                                            placeholder="Enter City" value="" required>
                                        @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label >State</label>
                                        <input type="text" name="state" class="form-control"
                                            placeholder="Enter State" value="" required>
                                        @error('state')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label >Country</label>
                                        <input type="text" name="country" class="form-control"
                                            placeholder="Enter Country" value="" required>
                                        @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label >Pincode</label>
                                        <input type="text" name="pincode" class="form-control"
                                            placeholder="Enter Pincode" value="" required>
                                        @error('pincode')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Enter Phone" value="" required>
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Telephone</label>
                                        <input type="text" name="tel" class="form-control"
                                            placeholder="Enter Telephone" value="">
                                        @error('tel')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label >Google Map Link</label>
                                        <input type="text" name="google_map_link" class="form-control"
                                            placeholder="Enter Google Map Link" value="" required>
                                        @error('google_map_link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Latitude</label>
                                        <input type="text" name="latitude" class="form-control"
                                            placeholder="Enter Latitude" value="" required>
                                        @error('latitude')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Longitude</label>
                                        <input type="text" name="longitude" class="form-control"
                                            placeholder="Enter Longitude" value="" required>
                                        @error('longitude')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Opening Houres</label>
                                        <table class="table table-striped" style="width:100%;">
                                            <tr>
                                                <td>Day</td>
                                                <td>Opening Time</td>
                                                <td>Closing Time</td>
                                                <td>Closed</td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" class="form-control" name="day_1_name"  value="Sunday">Sunday</td>
                                                <td><input type="time" class="form-control" name="day_1_opening" value=""></td>
                                                <td><input type="time" class="form-control" name="day_1_closing" value=""></td>
                                                <td>
                                                    <input type="radio" class="form-check-input" name="day_1_closed_status" value="No" checked>No 
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" class="form-check-input" name="day_1_closed_status" value="Yes">Yes
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" class="form-control" name="day_2_name"  value="Monday">Monday</td>
                                                <td><input type="time" class="form-control" name="day_2_opening" value=""></td>
                                                <td><input type="time" class="form-control" name="day_2_closing" value=""></td>
                                                <td>
                                                    <input type="radio" class="form-check-input" name="day_2_closed_status" value="No" checked>No 
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" class="form-check-input" name="day_2_closed_status" value="Yes">Yes
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" class="form-control" name="day_3_name"  value="Tuesday">Tuesday</td>
                                                <td><input type="time" class="form-control" name="day_3_opening" value=""></td>
                                                <td><input type="time" class="form-control" name="day_3_closing" value=""></td>
                                                <td>
                                                    <input type="radio" class="form-check-input" name="day_3_closed_status" value="No" checked>No 
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" class="form-check-input" name="day_3_closed_status" value="Yes">Yes
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" class="form-control" name="day_4_name"  value="Wednesday">Wednesday</td>
                                                <td><input type="time" class="form-control" name="day_4_opening" value=""></td>
                                                <td><input type="time" class="form-control" name="day_4_closing" value=""></td>
                                                <td>
                                                    <input type="radio" class="form-check-input" name="day_4_closed_status" value="No" checked>No 
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" class="form-check-input" name="day_4_closed_status" value="Yes">Yes
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" class="form-control" name="day_5_name"  value="Thursday">Thursday</td>
                                                <td><input type="time" class="form-control" name="day_5_opening" value=""></td>
                                                <td><input type="time" class="form-control" name="day_5_closing" value=""></td>
                                                <td>
                                                    <input type="radio" class="form-check-input" name="day_5_closed_status" value="No" checked>No 
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" class="form-check-input" name="day_5_closed_status" value="Yes">Yes
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" class="form-control" name="day_6_name"  value="Friday">Friday</td>
                                                <td><input type="time" class="form-control" name="day_6_opening" value=""></td>
                                                <td><input type="time" class="form-control" name="day_6_closing" value=""></td>
                                                <td>
                                                    <input type="radio" class="form-check-input" name="day_6_closed_status" value="No" checked>No 
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" class="form-check-input" name="day_6_closed_status" value="Yes">Yes
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" class="form-control" name="day_7_name"  value="Saturday">Saturday</td>
                                                <td><input type="time" class="form-control" name="day_7_opening" value=""></td>
                                                <td><input type="time" class="form-control" name="day_7_closing" value=""></td>
                                                <td>
                                                    <input type="radio" class="form-check-input" name="day_7_closed_status" value="No" checked>No 
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" class="form-check-input" name="day_7_closed_status" value="Yes">Yes
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Products Range</label>
                                        <select name="product_range[]"
                                            class="form-control border-primary js-example-basic-multiple" multiple>
                                            @if($prodCat->count()>0)
                                            @foreach($prodCat as $cat)
                                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                                            @endforeach

                                            @endif
                                        </select>
                                        @error('product_range')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="form-check">
                                            <input type="radio" name="status" class="form-check-input" value="Draft"
                                                id="radioDraft" checked>
                                            <label class="form-check-label" for="radioDraft">
                                                Draft
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="status" class="form-check-input"
                                                value="Publish" id="radioPuiblish">
                                            <label class="form-check-label" for="radioPuiblish">
                                                Publish
                                            </label>
                                        </div>
                                        @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group-full01">
                                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-1"></div>

                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
    <script>
    $(document).ready(function() {
        $(".js-example-basic-multiple").select2();
    });
    </script>
    @endsection
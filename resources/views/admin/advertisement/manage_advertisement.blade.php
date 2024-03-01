@extends('admin.admins-layout.admin_master')
@section('title', 'Manage Setting')
@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
           <div class="col-sm-6">
            <h1 class="m-0">Manage Advertisements</h1>
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
                     <i class="ik ik-edit bg-blue"></i>
                     <div class="d-inline">
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.ADVERTISEMENTS')}}</h5>
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
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
             @if(session()->has('message'))
              <div class="alert alert-success">
                  {{ session()->get('message') }}
              </div>
             @endif
         <div class="card">
            <div class="card-body">
               <form class="form" method="POST" action="{{route('admin.advertisement.update')}}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="heading">Right Advertisement</label>
                           <label for="title">Image</label>
                           <input type="file" name="image1" class="form-control">
                           @if ($advertisement->image1)
                            <img src="{{ asset('public/images/' . $advertisement->image1) }}" alt="" class="img-fluid" width="70" height="50">
                           @endif
                        </div>
                     </div>

                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="lname">Link</label>
                           <input class="form-control form-control" name="link1" type="url" value="{{ $advertisement->link1 }}">
                        </div>
                     </div>

                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="heading">Left Advertisement</label>
                           <label for="title">Image</label>
                           <input type="file" name="image2" class="form-control">
                           @if ($advertisement->image2)
                            <img src="{{ asset('public/images/' . $advertisement->image2) }}" alt="" class="img-fluid" width="70" height="50">
                           @endif
                        </div>
                     </div>

                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="lname">Link</label>
                           <input class="form-control form-control" name="link2" type="url" value="{{ $advertisement->link2 }}">
                        </div>
                     </div>

                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="heading">Bottom Advertisement</label>
                           <label for="title">Image</label>
                           <input type="file" name="image3" class="form-control">
                           @if ($advertisement->image3)
                            <img src="{{ asset('public/images/' . $advertisement->image3) }}" alt="" class="img-fluid" width="350" height="350">
                           @endif
                        </div>
                     </div>

                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="lname">Link</label>
                           <input class="form-control form-control" name="link3" type="url" value="{{ $advertisement->link3 }}">
                        </div>
                     </div>
                    <div class="col-sm-12">
                    <button class="btn btn-primary addr_btn" type="submit">Update</button>
                   </div>
                  <div>
               </form>
            </div>
         </div>
                                        
         


@endsection
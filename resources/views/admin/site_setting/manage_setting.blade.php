@extends('admin.admins-layout.admin_master')
@section('title', 'Manage Setting')
@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Site Settings</h1>
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
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.SITE_SETTINGS')}}</h5>
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
                 <div class="form-group row">
                         <div class="col-sm-12">
                              <div class="row admin02">
                                 <div class="col-sm-12 border-bottom mb-4">
                              <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                   
                                    <div class="form-group form-group-item01">
                                        <label for="title">Site Header Logo</label>
                                @if(!empty(SiteSettingByName('site_logo')))
                               <img class="site_setting_logo" src="{{url(Config::get('constants.SITE_IMAGE_PATHS').SiteSettingByName('site_logo'))}}" height="50">
                               @endif
                                        <input type="file" name="site_logo" >
                                        <input type="hidden" name="setting_name" value="site_logo" >
                                        <input type="hidden" name="old_site_logo" value="{{SiteSettingByName('site_logo')}}" >
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </form> 
                                 </div>
                                 
                                         
                                 <div class="col-sm-6">
                                   <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                    <label for="lname" class=" control-label col-form-label">Site Name </label>
                                     <div class="d-flex admin_input_btn">
                                     <input class="form-control form-control" name="setting_val" type="text"   value="{{SiteSettingByName('site_name')}}">
                                        <input type="hidden" name="setting_name" value="site_name">
                                     <button class="btn btn-primary" type="submit">Update</button>
                                   </div>
                                  </form>
                                 </div>
                                 <div class="col-sm-6">
                                    <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                    <label for="lname" class=" control-label col-form-label">Site E-mail </label>
                                    <div class="d-flex admin_input_btn">
                                     <input class="form-control form-control" name="setting_val" type="email"   value="{{SiteSettingByName('site_email')}}">
                                        <input type="hidden" name="setting_name" value="site_email">
                                     <button class="btn btn-primary" type="submit">Update</button>
                                   </div>
                                  </form>
                                 </div>

                                 <div class="col-sm-12 mt-15">
                                    <h5>Header Top Title</h5>
                                 </div>
                                 <div class="col-md-6">
                                    <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                    <label for="lname" class=" control-label col-form-label">Header Title </label>
                                    <div class="d-flex2 admin_input_btn2">
                                     <textarea rows="5" class="form-control" id="header_content" name="setting_val">
                                         <?=SiteSettingByName('top_header_title')?>
                                     </textarea>
                                        <input type="hidden" name="setting_name" value="top_header_title">
                                     <button class="btn btn-primary" type="submit">Update</button>
                                   </div>
                                  </form>
                                 </div>
                                 
                                           <div class="col-sm-12 mt-15">
                                         <h5>Site Socials links</h5>
                                  </div>
             
                            

                                 <div class="col-sm-6">
                                   <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                    <label for="lname" class=" control-label col-form-label">Facebook </label>
                                    <div class="d-flex admin_input_btn">
                                     <input class="form-control form-control" name="setting_val" type="url" value="{{SiteSettingByName('facebook_url')}}">
                                        <input type="hidden" name="setting_name" value="facebook_url">
                                     <button class="btn btn-primary" type="submit">Update</button>
                                   </div>
                                  </form>
                                 </div>
                                 <div class="col-sm-6">
                                     <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                    <label for="lname" class=" control-label col-form-label">Twitter </label>
                                    <div class="d-flex admin_input_btn">
                                     <input class="form-control form-control" name="setting_val" type="url" value="{{SiteSettingByName('twitter_url')}}">
                                        <input type="hidden" name="setting_name" value="twitter_url">
                                     <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                  </form>
                                 </div>
                                 
                                           <div class="col-sm-6">
                                     <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                    <label for="lname" class=" control-label col-form-label">Instagram</label>
                                    <div class="d-flex admin_input_btn">
                                     <input class="form-control form-control" name="setting_val" type="url" value="{{SiteSettingByName('insta_url')}}">
                                        <input type="hidden" name="setting_name" value="insta_url">
                                     <button class="btn btn-primary" type="submit">Update</button>
                                   </div>
                                  </form>
                                 </div>
                                 
                                  <div class="col-sm-6">
                                     <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                    <label for="lname" class=" control-label col-form-label">Youtube</label>
                                    <div class="d-flex admin_input_btn">
                                     <input class="form-control form-control" name="setting_val" type="url" value="{{SiteSettingByName('youtube_url')}}">
                                        <input type="hidden" name="setting_name" value="youtube_url">
                                     <button class="btn btn-primary" type="submit">Update</button>
                                   </div>
                                  </form>
                                 </div>
                                 
                                 <div class="col-sm-6">
                                     <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                    <label for="lname" class=" control-label col-form-label">Twitch</label>
                                    <div class="d-flex admin_input_btn">
                                     <input class="form-control form-control" name="setting_val" type="url" value="{{SiteSettingByName('twitch_url')}}">
                                        <input type="hidden" name="setting_name" value="twitch_url">
                                     <button class="btn btn-primary" type="submit">Update</button>
                                   </div>
                                  </form>
                                 </div>
                                 
                                 <div class="col-sm-6">
                                     <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                    <label for="lname" class=" control-label col-form-label">Reddit</label>
                                    <div class="d-flex admin_input_btn">
                                     <input class="form-control form-control" name="setting_val" type="url" value="{{SiteSettingByName('reddit_url')}}">
                                        <input type="hidden" name="setting_name" value="reddit_url">
                                     <button class="btn btn-primary" type="submit">Update</button>
                                   </div>
                                  </form>
                                 </div>
                                 <div class="col-sm-12 mt-15 border-bottom mb-4">
                                     Footer Settings
                                 </div>
                                 
                                  <div class="col-sm-6">
                              <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                   
                                    <div class="form-group">
                                        <label for="title">Site Footer Logo</label>
                                        <div class="form-group-item01">
                                @if(!empty(SiteSettingByName('site_footer_logo')))
                               <img class="site_setting_logo" src="{{url(Config::get('constants.SITE_IMAGE_PATHS').SiteSettingByName('site_footer_logo'))}}" height="80">
                               @endif
                                        
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="site_footer_logo" class="form-control">
                                        <input type="hidden" name="setting_name" value="site_footer_logo" >
                                        <input type="hidden" name="old_site_logo" value="{{SiteSettingByName('site_footer_logo')}}" >
                                        </div>
                                    <div class="form-group">
                                              <button class="btn btn-primary addr_btn" type="submit">Update</button>
                                        </div>
                                </form> 
                                 </div>
                                 
                                 <div class="col-sm-6">
                                    <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                  
                                        <div class="form-group">
                                        <label for="title">Footer Text</label>
                                        <div class="form-group-item01">
                                          <textarea id="footer_text" rows="5" class="form-control" name="setting_val" placeholder="Add footer text">{{SiteSettingByName('footer_text')}}</textarea><br>
                                            <input type="hidden" name="setting_name" value="footer_text" >
                                            <input type="hidden" name="old_footer_text" value="" >
                                            
                                        </div>
                                        </div>
                                        <div class="form-group">
                                              <button class="btn btn-primary addr_btn" type="submit">Update</button>
                                        </div>
                                    </form> 
                                     </div>
                                 
                                <div class="col-sm-12 mt-15 border-bottom mb-4">
                                    <h5>Footer Subscribe Section</h5>
                                </div>
                                
                                <div class="col-sm-6">
                                    <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                  
                                        <div class="form-group">
                                        <label for="title">Subscribe Title</label>
                                        <div class="form-group-item01">
                                          <input type="text" name="setting_val" class="form-control" value="{{SiteSettingByName('subscribe_title')}}" required>
                                          <br>
                                            <input type="hidden" name="setting_name" value="subscribe_title" >
                                            
                                        </div>
                                        </div>
                                        <div class="form-group">
                                              <button class="btn btn-primary addr_btn" type="submit">Update</button>
                                        </div>
                                    </form> 
                                     </div>
                                     
                                <div class="col-sm-6">
                                    <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                  
                                        <div class="form-group">
                                        <label for="title">Subscribe Sub Title</label>
                                        <div class="form-group-item01">
                                          <input type="text" name="setting_val" class="form-control" value="{{SiteSettingByName('subscribe_subtitle')}}" required>
                                          <br>
                                            <input type="hidden" name="setting_name" value="subscribe_subtitle" >
                                            
                                        </div>
                                        </div>
                                        <div class="form-group">
                                              <button class="btn btn-primary addr_btn" type="submit">Update</button>
                                        </div>
                                    </form> 
                                     </div>
                                     
                                <div class="col-sm-6">
                                    <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                  
                                        <div class="form-group">
                                        <label for="title">Subscribe Button Text</label>
                                        <div class="form-group-item01">
                                          <input type="text" name="setting_val" class="form-control" value="{{SiteSettingByName('subscribe_btn')}}" required>
                                          <br>
                                            <input type="hidden" name="setting_name" value="subscribe_btn" >
                                            
                                        </div>
                                        </div>
                                        <div class="form-group">
                                              <button class="btn btn-primary addr_btn" type="submit">Update</button>
                                        </div>
                                    </form> 
                                </div>
                                
                                <div class="col-sm-6">
                                    <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                  
                                        <div class="form-group">
                                        <label for="title">Subscribe Button Link</label>
                                        <div class="form-group-item01">
                                          <input type="text" name="setting_val" class="form-control" value="{{SiteSettingByName('subscribe_btn_link')}}" required>
                                          <br>
                                            <input type="hidden" name="setting_name" value="subscribe_btn_link" >
                                            
                                        </div>
                                        </div>
                                        <div class="form-group">
                                              <button class="btn btn-primary addr_btn" type="submit">Update</button>
                                        </div>
                                    </form> 
                                </div>
                                             
                                <div class="col-sm-12 mt-15 border-bottom mb-4">
                                    <h5>Contact Page Details</h5>
                                </div>
                                
                                  <div class="col-sm-6">
                                    <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                  
                                        <div class="form-group">
                                        <label for="title">Location</label>
                                        <div class="form-group-item01">
                                          <textarea id="address" rows="5" class="form-control" name="setting_val" placeholder="Add contact Address">{{SiteSettingByName('location')}}</textarea><br>
                                            <input type="hidden" name="setting_name" value="location" >
                                            <input type="hidden" name="old_contact_address" value="" >
                                            
                                        </div>
                                        </div>
                                        <div class="form-group">
                                              <button class="btn btn-primary addr_btn" type="submit">Update</button>
                                        </div>
                                    </form> 
                                     </div>
                                      
                                 
                                    <div class="col-sm-6">
                                    <form class="form" method="POST" action="{{route('admin.site.setting')}}" enctype="multipart/form-data">
                                     @csrf
                                  
                                    <div class="form-group">
                                        <label for="title">Phone Number</label>
                                        <div class="form-group-item01">
                                           <input type="text" class="form-control form-control" name="setting_val" value="{{SiteSettingByName('call_number')}}" >
                                            <input type="hidden" name="setting_name" value="call_number" >
                                            <input type="hidden" name="old_contact_email" value="" >
                                            <button class="btn btn-primary addr_btn" type="submit">Update</button>
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

         
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
       
<script>
   CKEDITOR.replace( 'header_content' );
</script>        
         
         
         
          
@endsection








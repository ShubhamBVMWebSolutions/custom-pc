@extends('admin.admins-layout.admin_master')
@section('title', 'Add Bank Account')
@section('content')

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Direct Bank Transfer</h1>
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
                        <h5>Add Bank Accounts</h5>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Direct Bank Transfer</li>
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
                
                <form class="forms-sample" action="{{route('admin.add.update.bank.account')}}" method="post" enctype="multipart/form-data">
                
                    @csrf 
                        
                        <div class="row">
                            
                            <div class="col-sm-12">
                               <table class="table bank_account_tbl">
                                   <thead>
                                       <tr>
                                           <th>Bank Name</th>
                                           <th>Account Name</th>
                                           <th>Account Number</th>
                                           <th>IBAN</th>
                                           <th></th>
                                       </tr>
                                   </thead>
                                   <tbody id="tbl">
                                       @if($all_accounts->count() > 0)
                                       @foreach($all_accounts as $account)
                                       <tr>
                                           <input type="hidden" name="account_id[]" value="{{$account->id}}">
                                           <td><input type="text" name="bank_name[]" class="form-control" value="{{$account->bank_name ?? ''}}"></td>
                                           <td><input type="text" name="account_name[]" class="form-control" value="{{$account->account_name ?? ''}}"></td>
                                           <td><input type="number" name="account_number[]" class="form-control" value="{{$account->account_number ?? ''}}"></td>
                                           <td><input type="text" name="iban[]" class="form-control" value="{{$account->iban ?? ''}}"></td>
                                           <td></td>
                                       </tr>
                                       @endforeach
                                       @else
                                       <tr>
                                           <td><input type="text" name="bank_name[]" class="form-control"></td>
                                           <td><input type="text" name="account_name[]" class="form-control"></td>
                                           <td><input type="number" name="account_number[]" class="form-control"></td>
                                           <td><input type="text" name="iban[]" class="form-control"></td>
                                           <td></td>
                                       </tr>
                                       @endif
                                   </tbody>
                               </table>
                               
                               <div><button type="button" class="btn btn-primary btn-lg" id="addBtn" >+ Add Account</button></div>
                               
                               
                            </div>
                           
                        </div> 
                        
                         <div class="row">
                            
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg mr-2">Save Accounts</button>
                        </div>
                                </div>
                                </div>
        
        </form> 
  </div>
  </div>
  </div>

         
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

         
         
         
          
@endsection
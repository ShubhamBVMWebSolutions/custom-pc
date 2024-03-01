@extends('front-layout.master_layout')
@section('title', 'Billing Address')
@section('content')

<?php $user_id = auth()->id();
if(empty($user_id)){ ?>
<script>window.location = "{{route('login')}}";</script>
<?php die; }?>

<!-- dashboard Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="cart_title">Billing Address</h2>
                </div>
            </div>

<div class="row">
    <div class="col-lg-12">
    @include('myaccount.nav')

            <div id="thirdTab" class="tabcontent">
              <h3>Edit Address</h3>
                  <div class="edit_profile_tabs">
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
                  <strong>Success!</strong> {{ session()->get('alert-error') }}
               </div>
               @endif
                      <form method="post" action="{{route('user.dashboard.address')}}" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="billing_address_id" value="{{$billingAddress->id ?? ''}}">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                     <span class="ec-register-wrap">
                            <label>Phone Number</label>
                            <input type="tel" class="form-control"  name="phone" value="{{$billingAddress->phone ?? ''}}" placeholder="123-456-7890" required="">
                        </span>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="form-group">
                                     <span class="ec-register-wrap">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country" value="{{$billingAddress->country ?? ''}}" required="">
                        </span>
                                  </div>
                              </div>
                          </div>
                        <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                     <span class="ec-register-wrap">
                            <label>Address1</label>
                            <input type="text" class="form-control" name="address1" value="{{$billingAddress->address1 ?? ''}}" required="">
                        </span>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="form-group">
                                     <span class="ec-register-wrap">
                            <label>Address2</label>
                            <input type="text" class="form-control" name="address2" value="{{$billingAddress->address2 ?? ''}}">
                        </span>
                                  </div>
                              </div>
                          </div>

                           <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                     <span class="ec-register-wrap">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" value="{{$billingAddress->city ?? ''}}" required="">
                        </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="form-group">
                                     <span class="ec-register-wrap">
                            <label>State</label>
                            <input type="text" class="form-control" name="state" value="{{$billingAddress->state ?? ''}}">
                        </span>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="form-group">
                                     <span class="ec-register-wrap">
                            <label>Zipcode</label>
                            <input type="text" class="form-control" name="zipcode" value="{{$billingAddress->zipcode ?? ''}}">
                        </span>
                                  </div>
                              </div>
                          </div>
                        <span class="ec-register-wrap">
                            <input class="btn btn-primary" type="submit" value="Save Changes">
                        </span>
                      </form>
                  </div>
            </div>
            </div>
    </div>
    </div>


        </div>
    </div>
</section>
<!-- dashboard Section End -->


@endsection

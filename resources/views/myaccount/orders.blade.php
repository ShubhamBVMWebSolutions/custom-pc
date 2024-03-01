@extends('front-layout.master_layout')
@section('title', 'My Orders')
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
                    <h2 class="cart_title">My Orders</h2>
                </div>
            </div>

<div class="row">
    <div class="col-lg-12">
    @include('myaccount.nav')

            <div id="fourthTab" class="tabcontent">

                  <div class="shopping__cart__table my_account_page">
                    <table>
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($orders->count() > 0)
                            @foreach($orders as $ordr)
                            <tr>
                                <td>#{{$ordr->id}}</td>
                                <td>{{date('F j, Y',strtotime($ordr->created_at))}}</td>
                                <td>{{ orderStausByKey($ordr->order_status) == 'Completed' ? 'Delivered' : orderStausByKey($ordr->order_status) }}</td>
                                <td>NPR {{number_format($ordr->total_amount,2)}}</td>
                                <td>
                                    <a href="{{route('user.dashboard.view.order',['orderId' => $ordr->id])}}">View</a>
                                    @if($ordr->order_status !== 'cancelled' && $ordr->order_status !== 'completed' )
                                    {{-- @dd($ordr->order_status == 'completed') --}}
                                    <a href="?action=cancel&order_id=<?=$ordr->id?>">Cancel</a>
                                    @endif

                                   <a href="{{route('order.createInvoice',['order_id'=>$ordr->id])}}" >Download Invoice</a>
                                </td>

                            </tr>

                            @endforeach
                            @else
                            <tr>
                                <td colspan="5"><span class="no_ordr_found">No order Found!</span></td>
                            </tr>
                            @endif
                          </tbody>
                    </table>

                    @if($orders->count() > 0)
                    <div class="row d-flex justify-content-center pagination my_orders_pagination">
                    {{$orders->links('vendor.pagination.bootstrap-4')}}
                    </div>
                    @endif
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

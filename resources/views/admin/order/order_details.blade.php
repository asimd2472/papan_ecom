@extends('layouts.admin')
@section('content')
<div class="bedcrumb-wrap row justify-content-between align-items-center">
    <div class="col-auto">
        <div class="page-name">Order</div>
    </div>
    <div class="col-auto">
        <div class="bedcrumb-list">
            <ul class="d-flex">
                <li><a href="{{url('admin/dashboard')}}">Order #{{$order_details->order_no}}</a></li>
                <li>Order List</li>
            </ul>
        </div>
    </div>
  </div>

<div class="content-wraper mt-3">
    <div class="row">
        <div class="col-md-6">
            <h4>Billing Address</h4>

                <div class="user-dtls-wrap">
                    <div class="user-dtls-wrap-rgt">
                        <div class="user-dtls-name">{{$order_details->UserBillingAddress->name}}</div>
                        <div class="user-dtls-name">{{$order_details->UserBillingAddress->address}}, {{$order_details->UserBillingAddress->city}}, {{$order_details->UserBillingAddress->state}}, {{$order_details->UserBillingAddress->zipcode}}, {{$order_details->UserBillingAddress->Countries->name}}</div>
                    </div>
                </div>
        </div>
        <div class="col-md-6">
            <h4>Shipping Address</h4>

                <div class="user-dtls-wrap">
                    <div class="user-dtls-wrap-rgt">
                        <div class="user-dtls-name">{{$order_details->UserShippingAddress->name}}</div>
                        <div class="user-dtls-name">{{$order_details->UserShippingAddress->address}}, {{$order_details->UserShippingAddress->city}}, {{$order_details->UserShippingAddress->state}}, {{$order_details->UserShippingAddress->zipcode}}, {{$order_details->UserShippingAddress->Countries->name}}</div>
                    </div>
                </div>
        </div>
        <div class="col-md-12 mt-3">
            <h4>Product Details</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product image</th>
                    <th scope="col">Product name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Total Price</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $total_sub_total = 0;
                    @endphp
                    @foreach ($order_details->OrderDetails as $key=>$item)


                    <tr>
                        <th scope="row">{{($key+1)}}</th>
                        <td><img width="50" src="{{asset("upload/product/images/".$item->product_image)}}" alt=""></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>${{$item->price}}</td>
                        <td class="text-end">${{($item->price*$item->quantity)}}</td>

                    </tr>
                    @php
                        $total_sub_total += ($item->price*$item->quantity);
                    @endphp

                @endforeach

                </tbody>
                <tfoot class="b-border-none">
                    <tr>
                        <td rowspan="6" colspan="4" style="border: none;"></td>
                        <td class="text-end"><strong>Sub-Total :</strong></td>
                        <td class="text-end"><strong>${{$total_sub_total}}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-end">Coupon Discount :</td>
                        <td class="text-end">${{number_format($order_details->discount, 2)}}</td>
                    </tr>
                    <tr>
                        <td class="text-end">Flat Shipping Rate :</td>
                        <td class="text-end">
                            @php
                                if ($order_details->shipping_charges=='' || $order_details->shipping_charges==0) {
                                    $shipping_charges = 0;
                                }else{
                                    $shipping_charges = $order_details->shipping_charges;
                                }
                            @endphp
                            ${{number_format($shipping_charges, 2)}}
                        </td>
                    </tr>
                    @if($order_details->tax_amount!=0 && $order_details->tax_amount!='')
                        <tr>
                            <td class="text-end">Tax :</td>
                            <td class="text-end">${{$order_details->tax_amount}}</td>
                        </tr>
                    @endif


                    <tr>
                        <td class="text-end"><strong>Total Pay Amount :</strong></td>
                        <td class="text-end"><strong>${{$order_details->total_pay}}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-12 mt-3">
            <h4>Shipping Details</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Status</th>
                    <th scope="col">Tracking Number</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                    @foreach ($upsShipment as $key=>$items)
                    <tr>
                        <td>{{$items->current_status}}</td>
                        <td>{{$items->trackingNumber}}</td>
                        <td><a target="_blank" href="https://www.ups.com/track?tracknum={{$items->trackingNumber}}&loc=en_US&requester=ST/trackdetails">Track order</a></td>


                    </tr>



                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

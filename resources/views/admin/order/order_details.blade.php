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
        <div class="col-md-12">
            <h4>Shipping Address</h4>

                <div class="user-dtls-wrap">
                    <div class="user-dtls-wrap-rgt">
                        <div class="user-dtls-name"><b>Name:</b> {{$order_details->name}}</div>
                        <div class="user-dtls-name"><b>Contact No:</b> {{$order_details->phone}}</div>
                        <div class="user-dtls-name"><b>Delivery Locations:</b> {{@$order_details->UserShippingAddress->location}}</div>
                        <div class="user-dtls-name"><b>Address:</b> {{$order_details->address}}</div>
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
                    <th scope="col">Color</th>
                    <th scope="col">Size</th>
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
                        <td>
                            <div style="background-color: {{@$item->productVariationDetails->color}}; height: 30px; width: 30px; border-radius: 50%;"></div>
                        </td>
                        <td>{{@$item->productVariationDetails->size}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>₹{{$item->price}}</td>
                        <td class="text-end">₹{{($item->price*$item->quantity)}}</td>

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
                        <td class="text-end"><strong>₹{{$total_sub_total}}</strong></td>
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
                            ₹{{number_format($shipping_charges, 2)}}
                        </td>
                    </tr>
                    @if($order_details->tax_amount!=0 && $order_details->tax_amount!='')
                        <tr>
                            <td class="text-end">Tax :</td>
                            <td class="text-end">₹{{$order_details->tax_amount}}</td>
                        </tr>
                    @endif


                    <tr>
                        <td class="text-end"><strong>Total Pay Amount :</strong></td>
                        <td class="text-end"><strong>₹{{$order_details->total_pay}}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

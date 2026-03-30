@extends('layouts.app')
@section('content')


<section class="p-v-40 relative cart-section">
    <div class="container">
        <div class="row cartlist">
            
            <div class="col-12">
                <form action="" method="POST" id="step1">
                    <div class="step1">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="user-info-head">
                                            <h4>Shipping Information</h4>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-wrap">
                                            <label class="ldl-style">Name <sup class="star-mark">*</sup></label>
                                            <input type="text" name="name" placeholder="Enter Name" onkeyup="getName(this)" class="form-control input-style" required/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-wrap">
                                            <label class="ldl-style">Address <sup class="star-mark">*</sup></label>
                                            <input type="text" name="address" placeholder="Enter Street Address" onkeyup="getaddress(this)" class="form-control input-style" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="input-wrap">
                                            <label class="ldl-style">Pin Code <sup class="star-mark">*</sup></label>
                                            <input type="text" name="zipcode" placeholder="Enter Zip Code" onkeyup="getzipcode(this)" class="form-control input-style isnumber" required/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="user-info-head mt-3">
                                            <h4>Contact Information</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-sm-12 col-12">
                                        <div class="input-wrap">
                                            <label class="ldl-style">Email Address <sup class="star-mark">*</sup></label>
                                            @if(empty(Session::get('user_session')))
                                                <input type="email" name="email" placeholder="Enter Email Address" class="form-control input-style" required/>
                                            @else
                                                <input type="email" name="email" placeholder="Enter Email Address" class="form-control input-style" value="{{Session::get('user_session')->email}}"/>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-sm-12 col-12">
                                        <div class="input-wrap">
                                            <label class="ldl-style">Phone Number <sup class="star-mark">*</sup></label>
                                            <input type="text" name="phone" placeholder="Enter Phone Number" class="form-control input-style isnumber" minlength="10" maxlength="12" required/>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="user-info-head">
                                            <h4>Payment Details</h4>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="cart-summary-box p-3 mb-3" style="background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.06);">
                                            <div class="table-responsive">
                                                <table class="table table-borderless cart-summary-table mb-0">
                                                    <thead>
                                                        <tr style="background:#f8f9fa;">
                                                            <th>Product</th>
                                                            <th class="text-center">Qty</th>
                                                            <th class="text-end">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $order_total = 0; @endphp
                                                        @foreach($cart_item as $item)
                                                            @php $item_total = $item->price * $item->quantity; $order_total += $item_total; @endphp
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <img src="{{asset('upload/product/images/'.$item->attributes->product_image)}}" alt="{{$item->name}}" style="width:38px;height:38px;object-fit:cover;border-radius:6px;">
                                                                        <span>{{$item->name}}</span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">{{$item->quantity}}</td>
                                                                <td class="text-end">₹{{number_format($item_total,2)}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="2" class="text-end">Shipping Charge</td>
                                                            <td class="text-end">₹100.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="text-end fw-bold">Total</td>
                                                            <td class="text-end fw-bold">₹{{number_format($order_total + 100,2)}}</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-end mt-3">
                            <div class="col-auto">
                                <button type="submit" class="mainBtn">Next</button>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>

    </div>
</section>


@endsection

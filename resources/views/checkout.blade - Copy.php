@extends('layouts.app')
@section('content')

<section class="productListBanner" style="background: url({{ Vite::asset('resources/front/images/pro-single-banner.jpg')}}) center center no-repeat">
    <!-- <div class="banSlogan">
    <div class="banSloganInner wow fadeInUp delay1">
        <h2>Lorem Ipsum</h4>
            <h4>is simply dummy text of the printing.</h4>
            <a href="#">Became a Dealer</a>
    </div>
</div> -->
    <svg
        class="waves"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28"
        preserveAspectRatio="none"
        shape-rendering="auto"
    >
        <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="parallax">
            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
            <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
        </g>
    </svg>
</section>

<section class="p-v-40 relative cart-section">
    <div class="container">
        <form action="" id="paymentForm">
            @csrf
            <div class="row g-4">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="row g-3">

                        <div class="col-12">
                            <div class="user-info-head">
                                <h4>Customer Info</h4>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="user-info-head">
                                <h4>Billing Address</h4>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-wrap">
                                <label class="ldl-style">Name <sup class="star-mark">*</sup></label>
                                <input type="text" name="name" placeholder="Enter Name" class="form-control input-style" required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-wrap">
                                <label class="ldl-style">Street Address <sup class="star-mark">*</sup></label>
                                <input type="text" name="address" placeholder="Enter Street Address" class="form-control input-style" required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-wrap">
                                <label class="ldl-style">City <sup class="star-mark">*</sup></label>
                                <input type="text" name="city" placeholder="Enter City" class="form-control input-style" required/>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-wrap">
                                <label class="ldl-style">State <sup class="star-mark">*</sup></label>
                                <input type="text" name="state" placeholder="Enter State" class="form-control input-style" required/>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-wrap">
                                <label class="ldl-style">Zip Code <sup class="star-mark">*</sup></label>
                                <input type="text" name="zipcode" placeholder="Enter Zip Code" class="form-control input-style isnumber" required/>
                            </div>
                        </div>
                        <input type="hidden" name="country" value="233">



                        <div class="col-12">
                            <div class="user-info-head">
                                <h4>Shipping Information</h4>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="sameAddress" id="sameAddress" checked>
                                <label class="form-check-label" for="sameAddress">
                                    Same As Billing Information
                                </label>
                            </div>
                        </div>

                        <div class="shippingAddr row" style="display: none;">
                            <div class="col-12">
                                <div class="input-wrap">
                                    <label class="ldl-style">Name</label>
                                    <input type="text" name="s_name" placeholder="Enter Name" class="form-control input-style"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-wrap">
                                    <label class="ldl-style">Street Address</label>
                                    <input type="text" name="s_address" placeholder="Enter Street Address" class="form-control input-style"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-wrap">
                                    <label class="ldl-style">City</label>
                                    <input type="text" name="s_city" placeholder="Enter City" class="form-control input-style"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-wrap">
                                    <label class="ldl-style">State</label>
                                    <input type="text" name="s_state" placeholder="Enter State" class="form-control input-style"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-wrap">
                                    <label class="ldl-style">Zip Code</label>
                                    <input type="text" name="s_zipcode" placeholder="Enter Zip Code" class="form-control input-style isnumber" />
                                </div>
                            </div>
                            <input type="hidden" name="s_country" value="233">

                        </div>


                        <div class="col-12">
                            <div class="user-info-head">
                                <h4>Contact Information</h4>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-wrap">
                                <label class="ldl-style">Email Address <sup class="star-mark">*</sup></label>
                                @if(empty(Session::get('user_session')))
                                    <input type="email" name="email" placeholder="Enter Email Address" class="form-control input-style" required/>
                                @else
                                    <input type="email" name="email" placeholder="Enter Email Address" class="form-control input-style" value="{{Session::get('user_session')->email}}"/>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-wrap">
                                <label class="ldl-style">Phone Number <sup class="star-mark">*</sup></label>
                                <input type="text" name="phone" placeholder="Enter Phone Number" class="form-control input-style isnumber" minlength="10" maxlength="12" required/>
                            </div>
                        </div>

                        @if(empty(Session::get('user_session')))
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="createAccount" id="createAccount">
                                    <label class="form-check-label" for="createAccount">
                                        Create An Account
                                    </label>
                                </div>
                            </div>
                            <div class="PasswordSec" style="display: none;">
                                <div class="col-12">
                                    <p>Password saved. You may enter a different password until your order is submitted.</p>
                                </div>
                                <div class="col-12">
                                    <div class="input-wrap">
                                        <label class="ldl-style">Password</label>
                                        <input type="password" name="password" placeholder="Enter Password" class="form-control input-style"/>
                                    </div>
                                </div>
                            </div>
                        @endif



                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="sticky-wrap">
                        <div class="cart-table mobile-table-design">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>image</th>
                                        <th>product name</th>
                                        <th class="text-center">quantity</th>
                                        <th class="text-end">unit price</th>
                                        <th class="text-end">total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total =0;  @endphp
                                    @foreach ($cart_item as $key=> $item)
                                        @php



                                            $total +=($item->price*$item->quantity);
                                        @endphp
                                        <tr>
                                            <td data-label="image :">
                                                <div class="crt-product-img">
                                                    <a class="d-block" href="#"> <img class="img-block" src="{{asset("upload/product/images/".$item->attributes->product_image)}}"> </a>
                                                </div>
                                            </td>
                                            <td data-label="product name :">
                                                <div class="crt-product-name"> <a href="#">{{$item->name}}</a> </div>
                                            </td>
                                            <td data-label="quantity :" class="text-center">{{$item->quantity}}</td>
                                            <td data-label="unit price :" class="text-end">${{($item->price)}}</td>
                                            <td data-label="total :" class="text-end">${{($item->price*$item->quantity)}}</td>
                                        </tr>
                                    @endforeach
                                    <input type="hidden" name="total_amount" id="total_amount" value="{{$total}}">

                                </tbody>
                                <tfoot class="text-nowrap">
                                    <tr>
                                    <td class="text-end" colspan="4"><strong>Total :</strong></td>
                                    <td class="text-end"><strong><span class="d-block">$ {{$total}}</span></strong></td>
                                    </tr>

                                    <tr class="hide_discount" style="display: none;">
                                        <td class="text-end" colspan="4"><strong>Discount :</strong></td>
                                        <td class="text-end"><strong><span class="d-block discount_amount"></span></strong></td>
                                    </tr>
                                    <tr class="hide_discount" style="display: none;">
                                        <td class="text-end" colspan="4"><strong>Sub Total :</strong></td>
                                        <td class="text-end"><strong><span class="d-block final_amount"></span></strong></td>
                                    </tr>
                                    <input type="hidden" name="discount_amount" id="discount_amount" value="0">
                                </tfoot>
                            </table>
                        </div>

                        <div class="row g-3 mt-3">
                            <div class="col-12">
                                <div class="user-info-head">
                                    <h4>Apply promo code </h4>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-wrap d-flex promoCode">
                                    <input type="text" placeholder="Enter promo code" id="promocode" name="promocode" class="form-control input-style"/>
                                    <button class="mainBtn promocodeBtn" type="button" onclick="checkCoupon()">Apply</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="user-info-head">
                                    <h4>Payment Details</h4>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-wrap">
                                    <label class="ldl-style">Name on Card <sup class="star-mark">*</sup></label>
                                    <input type="text" placeholder="Enter Name" id="owner" name="owner" class="form-control input-style"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-wrap">
                                    <label class="ldl-style">Card Number <sup class="star-mark">*</sup></label>
                                    <input type="text" placeholder="XXXX XXXX XXXX XXXX" id="cardNumber" name="cardNumber" class="isnumber form-control input-style" minlength="16" maxlength="16"/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="input-wrap">
                                    <label class="ldl-style">CVC <sup class="star-mark">*</sup></label>
                                    <input type="text" placeholder="Ex. 123" id="cvv" name="cvv" class="form-control input-style isnumber" minlength="3"/>
                                </div>
                            </div>
                            @php
                                $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
                            @endphp
                            <div class="form-group col-md-6" id="expiration-date">
                                <label>Expiration Date <sup class="star-mark">*</sup></label><br/>
                                <div class="select-wrap">
                                    <select class="form-select select-style" id="expiration-month" name="expiration-month" style="float: left; width: 100px; margin-right: 10px;">
                                        @foreach($months as $k=>$v)
                                            <option value="{{ $k }}" {{ old('expiration-month') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="select-wrap">
                                    <select class="form-select select-style" id="expiration-year" name="expiration-year"  style="float: left; width: 100px;">

                                        @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between mt-5">
                            <div class="col-auto">
                                <a href="{{url('/cart')}}" class="mainBtn-2"><i class="fas fa-reply"></i> Back</a>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="mainBtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


@endsection

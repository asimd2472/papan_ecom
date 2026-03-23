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

<section class="p-v-40 relative">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="cartMsg d-flex w-100 justify-content-between align-items-center">
                    <h4>Product has been added to your cart.</h4>
                    <a href="#">Continue shopping</a>
                </div>
            </div>
            @php
                // dd($cart_item);
            @endphp
            @if(count($cart_item)>0)
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="cartpage w-100">

                        <table class="cart-items clean">
                            <thead>
                                <tr>
                                    <th class="first" colspan="2">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="last">Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $total =0; @endphp
                                @foreach ($cart_item as $key=> $item)
                                    @php
                                        $total +=($item->price*$item->quantity);
                                    @endphp
                                    <tr class="cart-item first">
                                        <td class="cart-item-product first">
                                            <div class="d-flex align-items-center">
                                                <a class="cart-image" href="#"><img src="{{asset("upload/product/images/".$item->attributes->product_image)}}" class="lazy" /></a>
                                                <div class="cart-item-product-wrap">
                                                    <span class="cart-title">
                                                        <p>{{$item->name}}</p>
                                                    </span>
                                                    {{-- <span class="cart-vendor vendor">Elize</span>
                                                    <span class="cart-variant">10 Regular</span> --}}
                                                    <a class="cart-item-remove"  href="javascript:void(0)" onclick="remove_cart()">Remove</a>
                                                    <form action="{{url('/remove_cart')}}" method="POST" id="remove_cart_frm">
                                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart-item-price"><span class="money">${{$item->price}}</span></td>
                                        <td class="cart-item-quantity">
                                            <!--                <input class="cart__qty-input" type="number" name="updates[]" id="updates_45628695053:87a04b3d2b5cb6ce4f2d05481c140567" value="1" min="0" pattern="[0-9]*"> -->
                                            <input type="hidden" name="totalCartItem" id="totalCartItem_{{$item->id}}" value="{{$item->quantity}}">
                                            <div class="priceControl d-flex justify-content-center">
                                                <button class="controls2" type="button" value="-">-</button>
                                                <input type="number" class="qtyInput2" value="{{$item->quantity}}" data-max-lim="20" data-cart-id="{{$item->id}}" data-cart-amount="{{$item->price}}" data-cart-item="{{$item->quantity}}"/>
                                                <button class="controls2" type="button" value="+">+</button>
                                            </div>
                                        </td>
                                        <td class="cart-item-total last"><span class="money totalamount_{{$item->id}}">${{($item->price*$item->quantity)}}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="w-100">
                            <span class="giftcardMsg">Gift Cards are pre-paid and do not come with Cash on Delivery payment.</span>
                            <span class="expected-days" style="width: 100%; float: left">5-7 days can take up to 10 days during holidays</span>
                        </div>

                        <div class="cart-tools d-flex flex-wrap w-100">
                            <div class="cart-instructions">
                                {{-- <p>Special instructions</p>
                                <textarea rows="6" name="" placeholder="Add a note"></textarea> --}}
                            </div>
                            <div class="cart-totals">
                                <p class="c-order-total">Order Total</p>
                                <p class="cart-price"><span class="money finaltotalprice">${{$total}}</span></p>
                                {{-- <p class="cart-message meta">Free shipping on orders above INR 400</p> --}}
                                {{-- <button class="mainBtn waterEffect mt-3" type="submit">Checkout</button> --}}
                                @if(!empty(Session::get('user_session')))
                                    <a href="{{url('/checkout')}}" class="mainBtn waterEffect mt-3">Checkout</a>
                                @else
                                    <a href="javascript:void(0)" onclick="loginPopup('checkout')" class="mainBtn waterEffect mt-3">Checkout</a>
                                @endif
                            </div>
                        </div>

                </div>
            </div>
            @endif
        </div>
    </div>
</section>


@endsection

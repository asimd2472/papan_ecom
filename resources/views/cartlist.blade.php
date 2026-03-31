@extends('layouts.app')
@section('content')



<section class="p-v-40 relative" style="background: #f4f6fb; min-height: 80vh;">
    <div class="container-fluid px-2 px-md-4">
        <div class="row cartlist justify-content-center">
            {{-- <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="cartMsg d-flex w-100 justify-content-between align-items-center">
                    <h4>Product has been added to your cart.</h4>
                    <a href="#">Continue shopping</a>
                </div>
            </div> --}}
            @php
                // dd($cart_item);
            @endphp

            @if(count($cart_item)>0)
            <div class="col-lg-10 col-md-12 col-12">
                <div class="cartpage w-100 mx-auto">


                        <div class="table-responsive">
                            <table class="cart-items clean w-100">
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
                                                <div class="d-flex align-items-center flex-wrap flex-md-nowrap">
                                                    <a class="cart-image" href="#"><img src="{{asset("upload/product/images/".$item->attributes->product_image)}}" class="lazy" alt="{{$item->name}}" /></a>
                                                    <div class="cart-item-product-wrap ms-2">
                                                        <span class="cart-title">
                                                            <p>{{$item->name}}</p>
                                                        </span>
                                                        <a class="cart-item-remove"  href="javascript:void(0)" onclick="remove_cart()">Remove</a>
                                                        <form action="{{url('/remove_cart')}}" method="POST" id="remove_cart_frm">
                                                            <input type="hidden" value="{{ $item->id }}" name="id">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart-item-price"><span class="money">₹{{$item->price}}</span></td>
                                            <td class="cart-item-quantity">
                                                <input type="hidden" name="totalCartItem" id="totalCartItem_{{$item->id}}" value="{{$item->quantity}}">
                                                <div class="priceControl d-flex justify-content-center align-items-center">
                                                    <button class="controls2" type="button" value="-">-</button>
                                                    <input type="number" class="qtyInput2" value="{{$item->quantity}}" data-max-lim="20" data-cart-id="{{$item->id}}" data-cart-amount="{{$item->price}}" data-cart-item="{{$item->quantity}}"/>
                                                    <button class="controls2" type="button" value="+">+</button>
                                                </div>
                                            </td>
                                            <td class="cart-item-total last"><span class="money totalamount_{{$item->id}}">₹{{($item->price*$item->quantity)}}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div class="cart-tools d-flex flex-wrap justify-content-between align-items-start">
                            <div class="cart-totals ms-auto">
                                <p class="c-order-total">Order Total</p>
                                <p class="cart-price"><span class="money finaltotalprice">₹{{$total}}</span></p>
                                <a href="{{url('/checkout')}}" class="mainBtn waterEffect mt-3 w-100">Checkout</a>
                                {{-- @if(!empty(Session::get('user_session')))
                                    <a href="{{url('/checkout')}}" class="mainBtn waterEffect mt-3 w-100">Checkout</a>
                                @else
                                    <a href="javascript:void(0)" onclick="loginPopup('checkout')" class="mainBtn waterEffect mt-3 w-100">Checkout</a>
                                @endif --}}
                            </div>
                        </div>

                </div>
            </div>
            @else
                <div class="col-lg-8 col-md-10 col-12 mx-auto">
                    <div class="cartpage w-100 text-center">
                        <h3 class="mb-4">Your cart is currently empty.</h3>
                        <a href="{{url('/')}}" class="mainBtn waterEffect mt-3">Continue shopping</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>


@endsection

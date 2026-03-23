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
        <div class="row g-4">
            <div class="customer-dashboard-lft">
                <div class="user-menu-list sticky-bar mobile-menu">
                    <div class="sidebar-menu">
                        <button class="sidebar-menu-btn sidebar_menu_btn" type="button">menu</button>
                    </div>
                    @include('user.user_leftmenu')
                </div>
            </div>
            <div class="customer-dashboard-rgt">
                <div class="user-wrap-head">
                    <h4>Order history</h4>
                </div>
                <div class="user-rgt-wrap">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order No.</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_details as $key=>$item)
                                <tr>
                                    <th scope="row">{{($key+1)}}</th>
                                    <td>{{$item->order_no}}</td>
                                    <td>{{$item->total_pay}}</td>
                                    <td>{{date('M d, Y', strtotime(str_replace('.', '/', $item->created_at)))}}</td>
                                    <td>{{$item->current_status}}</td>
                                    <td><a href="{{url('order-details/'.$item->id)}}" title="Order details"><i class="fas fa-clipboard-list"></a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

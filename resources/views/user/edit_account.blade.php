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
                    <div class="mobile-sidebar mobile_sidebar">
                        <ul>
                            <li class="active"><a href="#"><i class="far fa-user"></i>My Account</a></li>
                            <li><a href="#"><i class="fas fa-user-edit"></i>Edit Account</a></li>
                            <li><a href="#"><i class="fas fa-user-lock"></i>Password</a></li>
                            <li><a href="#"><i class="fas fa-clipboard-list"></i>Order History</a></li>
                            <li><a href="#"><i class="far fa-address-book"></i>shipping address</a></li>
                            <li><a href="#"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="customer-dashboard-rgt">
                <div class="user-wrap-head">
                    <h4>Edit Account</h4>
                </div>
                <div class="user-rgt-wrap">
                    <span class="user-pic">
                        <img src="images/avatar.jpg" class="img-block">
                    </span>
                    <div class="row g-3 mt-0">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="white-box-input">
                                <label class="front-lbl-design">First Name</label>
                                <input type="text" class="form-control white-input" placeholder="First name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="white-box-input">
                                <label class="front-lbl-design">Last Name</label>
                                <input type="text" class="form-control white-input" placeholder="Last name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="white-box-input">
                                <label class="front-lbl-design">Phone number</label>
                                <input type="number" class="form-control white-input" placeholder="Phone Number">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="user-save-btn-wrap">
                                <button type="button" class="save-btn">save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

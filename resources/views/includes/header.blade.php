<!-- <a class="scrollup" href="javascript:void(0);"><i class="fas fa-chevron-up"></i></a> -->
<div class="mouse-cursor cursor-outer"></div>
<div class="mouse-cursor cursor-inner"></div>
<div class="progress-wrap cursor-pointer">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<header>
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto d-flex align-items-center">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{ Vite::asset('resources/front/images/logo.png')}}" alt="" /></a>
                </div>
                <nav id="res_nav" class="navigation">
                    <button id="menu_res" class="menu-responsive">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <ul class="d-flex align-items-center">
                        @foreach ($productCategory as $productcategoryitem)
                            @if ($productcategoryitem->slug!='holiday')
                                <li><a href="{{ route('product_categoty', $productcategoryitem->slug)}}">{{$productcategoryitem->title}}</a></li>
                            @endif

                        @endforeach

                        {{-- <li class="holiday-sale">
                            <a href="{{route('holiday_sale')}}">Holiday Sale</a>
                        </li> --}}
                    </ul>
                </nav>
            </div>
            <div class="col-auto">
                <div class="loginReg">
                    <ul class="d-flex align-items-center">
                        <li class="my-account-wrap">
                            @if(empty(Session::get('user_session')))
                                <a href="javascript:void(0)" onclick="loginPopup('login')"><i class="fas fa-user-alt"></i></a>
                            @else
                                <a href="javascript:;" class="dropDown" onclick="my_account()"><i class="fas fa-user-alt"></i></a>
                                <ul class="after-login menu-list" style="display: none;">
                                    <li><a href="{{url('/user-dashboard')}}"><i class="fas fa-user-tie"></i>my account</a></li>
                                    <li><a href="{{url('user_logout')}}"><i class="fas fa-sign-out-alt"></i>logout</a></li>
                                </ul>
                            @endif
                        </li>
                        <li>
                            <a href="{{ route('cart')}}" class="cartIcon"><i class="fas fa-shopping-bag"></i><span class="totalcart_item">{{\Cart::getTotalQuantity()}}</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Modal -->
<div class="modal fade loginmodal" id="logInModal" tabindex="-1" aria-labelledby="logInModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logInModalLabel">Account Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="loginForm">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <div class="input-wrap">
                        <label class="ldl-style">User Name</label>
                        <input type="text" placeholder="Enter User name" name="email" class="form-control input-style" required/>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-wrap">
                        <label class="ldl-style">Password</label>
                        <div class="add-icon add_eye">
                            <input type="password" name="password" placeholder="Enter password" class="form-control input-style pass_input" required/>
                            <span class="icon-rt pass_eye"><i class="far fa-eye-slash"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="forgot-wrap">
                        <ul>
                            {{-- <li class="checkbox">
                                <input type="checkbox" id="remember"/>
                                <label for="remember">Remember Me</label>
                            </li> --}}
                            <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#forgotpasswordModal">Forgot Password?</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="signin-wrap">
                        <button type="submit" class="signin">Sign in</button>
                    </div>
                </div>
                <div class="col-12">
                    <div class="not-account" style="display:none;">
                        <p>Don't have an account? No problem, you can checkout as guest. You'll have the option to create an account during the checkout process. <a href="{{url('/checkout')}}" class="signin d-block">Guest Checkout</a></p>
                        {{-- <button type="submit" class="signin">Guest Checkout</button> --}}
                    </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
</div>

<div class="modal fade loginmodal" id="forgotpasswordModal" tabindex="-1" aria-labelledby="logInModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logInModalLabel">Forgot Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="forgotpasswordForm">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <div class="input-wrap">
                        <label class="ldl-style">Email</label>
                        <input type="email" placeholder="Enter User name" name="user_email" class="form-control input-style" required/>
                    </div>
                </div>
                <div class="col-12">
                    <div class="signin-wrap">
                        <button type="submit" class="signin" id="reset_btn">Reset</button>
                    </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
</div>
<div class="page-loader">
    <ul class="loader">
        <li class="center"></li>
        <li class="item item-1"></li>
        <li class="item item-2"></li>
        <li class="item item-3"></li>
        <li class="item item-4"></li>
        <li class="item item-5"></li>
        <li class="item item-6"></li>
        <li class="item item-7"></li>
        <li class="item item-8"></li>
      </ul>
</div>

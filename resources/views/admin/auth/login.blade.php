<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:: Login ::</title>

    <!-- Font Css -->
    {{-- <link href="./font/stylesheet.css" media="all" rel="stylesheet"> --}}
    <!-- Style Css -->
    @vite(['resources/admin/scss/app.scss', 'resources/admin/js/app.js'])
</head>
<body>
    <section class="login-reg-sec blk-overly d-flex align-items-center" style="background: url({{ Vite::asset('resources/admin/images/banner-login.png')}}) no-repeat center center;">
    {{-- <section class="login-reg-sec blk-overly d-flex align-items-center"> --}}
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    {{-- <div class="loginbg-lft">
                        <span class="lft-logo">
                            <img class="img-block" src="{{ Vite::asset('resources/front/images/logo-round.png')}}" alt="">
                        </span>
                        <h3>welcome back !</h3>
                       
                    </div> --}}
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="loginwrap-rgt">
                        <div class="logreg-head">
                            <h4>Sign In</h4>
                            <p>Hey, Enter your details to get sign in to your account</p>
                        </div>

                        {{-- @include('flashmessage.flash-message') --}}
                        @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Alert!</strong> {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{route('admin.dologin')}}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="input-wrap-log">
                                <div class="position-relative add-icon-lft">
                                    <span class="icon-lft"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control input-style-log" placeholder="Email" value="{{old('email')}}" required>
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-wrap-log">
                                <div class="position-relative add-icon-lft add-icon-rgt add_eye">
                                    <span class="icon-lft"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control input-style-log pass_input" placeholder="Password" required>
                                    <span class="icon-rgt pass_eye"><i class="fa-solid fa-eye-slash"></i></span>
                                </div>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    <div class="checkbox ps-2 login-checkbox">
                                        <input type="checkbox" id="sign-in">
                                        <label for="sign-in">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="forget-pass-wrap">
                                        <a href="#" class="forget-pass-btn">Forgot Password?</a>
                                    </div>
                                </div>
                            </div> -->
                            <div class="log-reg-submit-wrap">
                                <button type="submit" class="log-reg-submit-btn">LOG In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            //$(document).ready(function(){
                //alert('dsgfdg')
            //});
        </script>

    </section>
</body>
</html>

<footer>
    <div class="topFooter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-auto">
                    {{-- <div class="fLogo wow fadeInUpSort delay1">
                        <a href="{{url('/')}}"><img src="{{ Vite::asset('resources/front/images/logo.png')}}" alt="" /></a>
                    </div> --}}
                </div>
                <div class="col">
                    <div class="fNav">
                        <ul class="d-flex">
                            @foreach ($productCategory as $productcategoryitem)
                                @if ($productcategoryitem->slug!='holiday')
                                <li>
                                    <a href="{{ route('product_categoty', $productcategoryitem->slug)}}">{{$productcategoryitem->title}}</a>
                                </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                    <div class="contAddress">
                        <ul class="d-flex flex-column flex-md-row">
                            <li>
                                <a href="#"><i class="fas fa-phone-alt"></i> +91 7439658868</a>
                            </li>

                            <li>
                                <a href="https://wa.me/917439658868" target="_blank">
                                    <i class="fab fa-whatsapp"></i> +91 7439658868
                                </a>
                            </li>

                            <li>
                                <a href="mailto:sarkarpapun77@gmail.com">
                                    <i class="fas fa-envelope"></i> sarkarpapun77@gmail.com
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="followUs">
                        <ul class="d-flex align-items-center">
                            <li>Follow us:</li>
                            <li><a href="https://www.facebook.com/share/18ZzhMwxxG/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            {{-- <li><a href="#"><i class="fab fa-twitter"></i></a></li> --}}
                            <li><a href="https://www.instagram.com/salesbaaz_com?igsh=cWxpcjBkaWo0dGU2" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="col-lg-4">
                    <div class="newslater">
                        <h6>Stay Connected with us</h6>
                        <form id="newslater_footer_frm" accept="" method="post">
                            <div class="d-flex position-relative">
                                <input type="email" name="newslater_email" id="newslater_email" placeholder="Email@email.com" class="newslaterInput" required>
                                <button class="signUp" id="footer_sign_up">Sign up</button>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="btmFooter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex flex-wrap align-items-center justify-content-between">
                    <div class="btmFooterInner">
                        <p>© Copyright {{date('Y')}}, All Rights Reserved.</p>
                    </div>
                    <div class="privacyPolicyLink">
                        <ul class="d-flex flex-wrap">
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms and Condition</a></li>
                            <li><a href="#">Shipping & Return Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



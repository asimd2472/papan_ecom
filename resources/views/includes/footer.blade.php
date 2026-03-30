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
                                    <a href="#">{{$productcategoryitem->title}}</a>
                                </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                    <div class="contAddress">
                        <ul class="d-flex">
                            {{-- <li><i class="fas fa-map-marker-alt"></i> 76 Quirk RoadMilford, CT 06460</li>
                            <li><a href="#"><i class="fas fa-phone-alt"></i> 800-243-2680</a></li> --}}
                            <li><a href="mailto:sarkarpapun77@gmail.com"><i class="fas fa-envelope"></i> sarkarpapun77@gmail.com</a></li>
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


<div class="modal fade signupReceive" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">SIGN UP TO RECEIVE OUR EMAILS</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="popupBody">
            <h3>Unlock 10% Off</h3>
            <div class="YourOrder">
                {{-- <h5>Your Order</h5> --}}
                <form id="newslater_popup_frm" accept="" method="post">
                    <div class="position-relative mb-4">
                        <input type="email" name="newslater_email" id="newslater_emails" placeholder="Enter email address" class="enteremail form-control">
                    </div>
                    <button class="signMeUp" id="sign_me_up">SIGN ME UP!</button>
                </form>
                {{-- <h6><a href="#">No thanks, I'll pay full price.</a></h6> --}}
                <h6></h6>
                <p>$100 Order Minimum, Exclusions May Apply
                    By submitting your information, you agree to receive emails from Drago Custom Rods featuring updates, exclusive offers, promotions, and content personalized to your preferences.</p>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>


<div class="modal fade signupReceive" id="customRodPopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Custom Rods Requirement</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="popupBody">
                <div class="YourOrder">
                    <form action="" id="customRoadForm" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="Enter Name *" class="enteremail form-control">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="email" placeholder="Enter email address *" class="enteremail form-control">
                            </div>
                            <div class="col-md-12">
                                <textarea name="requirement" cols="" rows="" class="form-control" placeholder="Requirement *"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button class="signMeUp" id="check_avb_btm">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

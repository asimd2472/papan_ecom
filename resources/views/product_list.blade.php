@extends('layouts.app') @section('content')

{{-- <section
    class="productListBanner"
    style="background: url({{ Vite::asset('resources/front/images/pro-single-banner.jpg')}}) center center no-repeat"
>
    <svg
        class="waves"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28"
        preserveAspectRatio="none"
        shape-rendering="auto"
    >
        <defs>
            <path
                id="gentle-wave"
                d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"
            />
        </defs>
        <g class="parallax">
            <use
                xlink:href="#gentle-wave"
                x="48"
                y="0"
                fill="rgba(255,255,255,0.7"
            />
            <use
                xlink:href="#gentle-wave"
                x="48"
                y="3"
                fill="rgba(255,255,255,0.5)"
            />
            <use
                xlink:href="#gentle-wave"
                x="48"
                y="5"
                fill="rgba(255,255,255,0.3)"
            />
            <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
        </g>
    </svg>
</section>  --}}

<section class="productList">
    <div class="container-fluid">
        <div class="row">
            <div class="listLeft">
                <button type="button" class="listToggleBtn">
                    Product List
                </button>
                <button type="button" class="listToggleBtn">
                    Product List
                </button>
                <div class="listLeftInner">
                    <ul>
                        @include('categoryleftpanel')
                    </ul>
                </div>
            </div>
            <div class="listRight">
                <div class="listRightInner">
                    <div class="listRightInnerTop text-center">
                        <h3>{{$singleCategory->title}}</h3>
                    </div>

                    <div class="shopReelsType"> 
                        <div class="row justify-content-center g-3">
                            @foreach ($products as $productsItem)
                            <div
                                class="col-lg-4 col-md-4 col-sm-6 col-6 wow fadeInUpSort delay1"
                            >
                                <a
                                    href="{{ route('product_details', ['product_slug' => $productsItem->product_slug])}}"
                                    class="shopBox"
                                >
                                    @if($productsItem->main_image_name!='') 
                                    <img src="{{asset("upload/product/images/".rawurlencode($productsItem->main_image_name))}}" alt="{{$productsItem->product_title}}"/> 
                                    @else
                                    <img
                                        src="{{ Vite::asset('resources/front/images/no-image-available.jpg')}}"
                                        alt="no-image-available.jpg"
                                    />
                                    @endif
                                    <div class="shopBoxBtm text-start">
                                        


                                        <h5>
                                            {{$productsItem->product_title}}
                                        </h5>

                                        {{-- <p>{{$productsItem->product_price}}</p>
                                        @if ($productsItem->is_variation==0)
                                            <p>₹{{$productsItem->product_offerprice}}</p>
                                        @else 
                                            ₹{{ $product->variations->min('price') }}
                                        @endif  --}}
                                        <p class="product-price">
                                            <span class="original">₹{{$productsItem->product_price}}</span>
                                            @if ($productsItem->is_variation==0)
                                                <span class="offer">₹{{$productsItem->product_offerprice}}</span>
                                                @else 
                                                <span class="offer">₹{{ number_format($productsItem->variations->min('price'), 0) }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endforeach {{--
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay2"
                            >
                                <a href="single-product.html" class="shopBox">
                                    <img src="images/wheel/2.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            --}}
                        </div>
                    </div>
                    {{--
                    <div class="shopReelsType">
                        <h3>Best Selling Casting Reels</h3>
                        <div class="row justify-content-center g-3">
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay1"
                            >
                                <a href="single-product.html" class="shopBox">
                                    <img src="images/wheel/1.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay2"
                            >
                                <a href="single-product.html" class="shopBox">
                                    <img src="images/wheel/2.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay3"
                            >
                                <a href="single-product.html" class="shopBox">
                                    <img src="images/wheel/3.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay4"
                            >
                                <a href="single-product.html" class="shopBox">
                                    <img src="images/wheel/3.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay5"
                            >
                                <a href="single-product.html" class="shopBox">
                                    <img src="images/wheel/2.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay6"
                            >
                                <a href="single-product.html" class="shopBox">
                                    <img src="images/wheel/1.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay7"
                            >
                                <a href="single-product.html" class="shopBox">
                                    <img src="images/wheel/3.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay8"
                            >
                                <a href="single-product.html" class="shopBox">
                                    <img src="images/wheel/3.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="shopReelsType">
                        <h3>Clearance Casting Reels</h3>
                        <div class="row justify-content-center g-3">
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay1"
                            >
                                <a href="#" class="shopBox">
                                    <img src="images/wheel/1.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay2"
                            >
                                <a href="#" class="shopBox">
                                    <img src="images/wheel/2.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay3"
                            >
                                <a href="#" class="shopBox">
                                    <img src="images/wheel/3.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay4"
                            >
                                <a href="#" class="shopBox">
                                    <img src="images/wheel/3.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay5"
                            >
                                <a href="#" class="shopBox">
                                    <img src="images/wheel/2.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay6"
                            >
                                <a href="#" class="shopBox">
                                    <img src="images/wheel/1.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay7"
                            >
                                <a href="#" class="shopBox">
                                    <img src="images/wheel/3.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                            <div
                                class="col-lg-3 col-md-3 col-sm-6 col-6 wow fadeInUpSort delay8"
                            >
                                <a href="#" class="shopBox">
                                    <img src="images/wheel/3.jpg" alt="" />
                                    <div class="shopBoxBtm text-start">
                                        <h6>New</h6>
                                        <h5>PROFISHIENCY P4-13 Casting Reel</h5>
                                        <p>$79.99</p>
                                        <ul class="d-flex">
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    --}}
                </div>
            </div>
        </div>
    </div>
</section>

{{--
<section class="shopReeAccessories">
    <div class="container">
        <div class="row g-3">
            <div class="col-12">
                <div class="text-center">
                    <h2>Shop Reel Accessories</h2>
                </div>
            </div>
            <div
                class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay1"
            >
                <a href="single-product.html" class="accessoriesBox">
                    <img src="images/wheel/7.jpg" alt="" />
                    <span>Fishing Reel Oil, Lube, Grease & Cleaning</span>
                </a>
            </div>
            <div
                class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay2"
            >
                <a href="single-product.html" class="accessoriesBox">
                    <img src="images/wheel/8.jpg" alt="" />
                    <span>Fishing Reel Covers</span>
                </a>
            </div>
            <div
                class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay3"
            >
                <a href="single-product.html" class="accessoriesBox">
                    <img src="images/wheel/9.jpg" alt="" />
                    <span>Fishing Reel Parts & Components</span>
                </a>
            </div>
            <div
                class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay4"
            >
                <a href="single-product.html" class="accessoriesBox">
                    <img src="images/wheel/10.jpg" alt="" />
                    <span>Fishing Reel Storage</span>
                </a>
            </div>
            <div
                class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay5"
            >
                <a href="single-product.html" class="accessoriesBox">
                    <img src="images/wheel/2.jpg" alt="" />
                    <span>Casting Reels</span>
                </a>
            </div>
            <div
                class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay6"
            >
                <a href="single-product.html" class="accessoriesBox">
                    <img src="images/wheel/1.jpg" alt="" />
                    <span>Spincast Reels</span>
                </a>
            </div>
        </div>
    </div>
</section>
--}} @endsection @push('scripts')

<script type="module">
    $(document).ready(function () {
        var owl = $(".partnerSlider");
        owl.owlCarousel({
            // items: 5,
            loop: true,
            margin: 40,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsiveClass: true,
            // autoWidth: true,
            stagePadding: 70,
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 6,
                },
            },
        });
    });
    $(document).ready(function (e) {
        $(".accordionBtn").on("click", function (e) {
            if ($(this).siblings(".sub-menu").length > 0) {
                e.preventDefault();
                $(this)
                    .closest(".menu-item")
                    .siblings(".menu-item")
                    .find(".sub-menu")
                    .slideUp();
                var x = $(this)
                    .closest(".menu-item")
                    .siblings()
                    .find(".sub-menu");
                //console.log(x);
                $(this).siblings(".sub-menu").slideToggle();

                // Remove the 'active' class from all 'menu-item' elements
                $(".menu-item").removeClass("active");

                // Add the 'active' class to the parent 'menu-item'
                $(this).closest(".menu-item").addClass("active");

                // alert("X1");
            } else {
                // alert("X2");
            }
        });
    });
</script>

@endpush

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

<section class="productList">
    <div class="container-fluid">
        <div class="row">
            <div class="listLeft">
            <button type="button" class="listToggleBtn">Product List</button>
                <div class="listLeftInner">
                    <ul>
                        @include('categoryleftpanel')

                    </ul>
                </div>
            </div>
            <div class="listRight">
                <div class="listRightInner">
                    @if(!empty($singleProducttype))
                        <div class="listRightInnerTop text-center">
                            <h3>{{$singleProducttype->typename}}</h3>
                            <p>
                                {{$singleProducttype->typedesc}}
                            </p>
                        </div>
                    @else
                        <div class="listRightInnerTop text-center">
                            <h3>{{$singleCategory->title}}</h3>
                            <p>
                                {{$singleCategory->categorydesc}}
                            </p>
                        </div>
                    @endif

                    <div class="shopReelsType">
                        @if(!empty($singleProducttype))
                            <h3>Featured {{$singleProducttype->typename}} Brands</h3>
                        @else
                            <h3>Featured {{$singleCategory->title}} Brands</h3>
                        @endif
                        <div class="row justify-content-center g-3">
                            @foreach ($brand_list as $brand_listitem)
                                <div class="col-lg-4 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay1">
                                    @if(!empty($singleProducttype))
                                        <a href="{{ route('product_listing_bybrand', ['category_slug' => $singleCategory->slug, 'type_id' => base64_encode($singleProducttype->id), 'brand_id' => $brand_listitem['id']])}}" class="shopBox">
                                            <img src="{{asset('storage/images/'.$brand_listitem['brandimage'])}}" alt="{{$brand_listitem['brandname']}}" />
                                            <span>{{$brand_listitem['brandname']}}</span>
                                        </a>
                                    @else
                                        <a href="{{ route('product_listing_bybrand', ['category_slug' => $singleCategory->slug, 'type_id' => ' ', 'brand_id' => $brand_listitem['id']])}}" class="shopBox">
                                            <img src="{{asset('storage/images/'.$brand_listitem['brandimage'])}}" alt="{{$brand_listitem['brandname']}}" />
                                            <span>{{$brand_listitem['brandname']}}</span>
                                        </a>
                                    @endif

                                </div>
                            @endforeach



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="weCarry">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="text-center secTitle">
                    <h2>WE CARRY</h2>
                </div>
            </div>
            <div class="col-12">
                <div class="owl-carousel partnerSlider">
                    @foreach ($brand as $branditem)
                        <div class="item">
                            <div class="partnerSliderBox">
                                <img src="{{asset('storage/images/'.$branditem->brandimage)}}" alt="">
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section class="shopReeAccessories">
    <div class="container">
        <div class="row g-3">
            <div class="col-12">
                <div class="text-center">
                    <h2>Shop Reel Accessories</h2>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay1">
                <a href="product-list.html" class="accessoriesBox">
                    <img src="images/wheel/7.jpg" alt="" />
                    <span>Fishing Reel Oil, Lube, Grease & Cleaning</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay2">
                <a href="product-list.html" class="accessoriesBox">
                    <img src="images/wheel/8.jpg" alt="" />
                    <span>Fishing Reel Covers</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay3">
                <a href="product-list.html" class="accessoriesBox">
                    <img src="images/wheel/9.jpg" alt="" />
                    <span>Fishing Reel Parts & Components</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay4">
                <a href="product-list.html" class="accessoriesBox">
                    <img src="images/wheel/10.jpg" alt="" />
                    <span>Fishing Reel Storage</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay5">
                <a href="product-list.html" class="accessoriesBox">
                    <img src="images/wheel/2.jpg" alt="" />
                    <span>Casting Reels</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 wow fadeInUpSort delay6">
                <a href="product-list.html" class="accessoriesBox">
                    <img src="images/wheel/1.jpg" alt="" />
                    <span>Spincast Reels</span>
                </a>
            </div>
        </div>
    </div>
</section> --}}

@endsection

@push('scripts')

<script type="module">
    $(document).ready(function () {
        var owl = $('.partnerSlider');
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
                }
            }
        });

    })
    $(document).ready(function (e) {
        $(".accordionBtn").on("click", function (e) {
            if ($(this).siblings(".sub-menu").length > 0) {
                e.preventDefault();
                $(this).closest(".menu-item").siblings(".menu-item").find(".sub-menu").slideUp();
                var x = $(this).closest(".menu-item").siblings().find(".sub-menu");
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

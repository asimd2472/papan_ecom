@extends('layouts.app') @section('content')

<section
    class="productListBanner"
    style="background: url({{ Vite::asset('resources/front/images/pro-single-banner.jpg')}}) center center no-repeat"
>
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
</section>

<section class="productList">
    <div class="container-fluid">
        <div class="row">
            <div class="listLeft">
                <button type="button" class="listToggleBtn">Product List</button>
                <div class="listLeftInner">
                    <ul>
                        @foreach ($categoryandType as $items)
                        <li
                            class="@if($singleCategory->id==$items->id) active @endif menu-item"
                        >
                            @if(count($items->producttype)>0)
                            <a href="javascript:void(0)" class="accordionBtn"
                                >{{$items->title}}
                                <i class="fas fa-angle-down cdRight"></i
                            ></a>
                            @else
                            <a
                                href="{{ route('product_categoty', $items->slug)}}"
                                class="accordionBtn"
                                >{{$items->title}}</a
                            >
                            @endif @if(count($items->producttype)>0)
                            <ul class="sub-menu">
                                <li>
                                    <a
                                        href="{{ route('product_categoty', $items->slug)}}"
                                        >Shop All</a
                                    >
                                </li>
                                @foreach ($items->producttype as $itemtype)
                                <li>
                                    <a
                                        href="{{ route('product_listing_bytype', ['category_slug' => $items->slug, 'type_id' => base64_encode($itemtype->id)])}}"
                                        >{{$itemtype->typename}}</a
                                    >
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="listRight">
                <div class="listRightInner position-relative">
                    <div class="gridTopBtn">
                        <a href="javascript:void(0)" class="mainBtn2" data-bs-toggle="modal" data-bs-target="#customRodPopup">Custom Rods Requirement</a>
                    </div>
                    <div class="gridContainer">
                        @foreach ($customrods as $customrodsitem)
                            <div class="item">
                                <a href="{{asset("upload/product/images/".$customrodsitem->image_name)}}" data-fancybox="images" data-caption="On them Indiana Nights">
                                    <img src="{{asset("upload/product/images/".$customrodsitem->image_name)}}" />
                                </a>
                            </div>
                        @endforeach
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
                            <img
                                src="{{asset('storage/images/'.$branditem->brandimage)}}"
                                alt=""
                            />
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" type="text/css" media="screen" />


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

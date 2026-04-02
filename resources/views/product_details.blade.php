@extends('layouts.app')
@section('content')

<section class="singleProductBanner" style="background: url({{ Vite::asset('resources/front/images/pro-single-banner.png')}}) center center no-repeat">
    {{-- <div class="banSlogan">
        <div class="banSloganInner wow fadeInUp delay1">
            <h2>Lorem Ipsum</h4>
                <h4>is simply dummy text of the printing.</h4>
                <a href="#">Became a Dealer</a>
        </div>
    </div> --}}
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
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

<section class="singleProduct">
    <div class="container-fluid">
        <div class="singleProductInner">
            <div class="imgCont">
                <div class="row g-lg-5 g-md-3 g-sm-3 g-5">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <!-- <div class="imgContainer">
                            <img src="images/reels.jpg" alt="">
                        </div> -->
                        <div class="outer">
                            <div id="big" class="owl-carousel owl-theme">
                                {{-- <div class="item">
                                    <div class="singleProductImage"><img src="{{asset("upload/product/images/".rawurlencode($productDetails->main_image_name))}}" alt=""></div>

                                </div> --}}

                                @if(count($productDetails->productImage)>0)
                                    @foreach ($productDetails->productImage as $itemimages)
                                        <div class="item">
                                            <div class="singleProductImage"><img src="{{asset("upload/product/images/".$itemimages->product_img)}}" alt=""></div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="item">
                                        <div class="singleProductImage"><img src="{{asset("upload/product/images/".rawurlencode($productDetails->main_image_name))}}" alt=""></div>
                                    </div>
                                @endif


                            </div>
                            <div id="thumbs" class="owl-carousel owl-theme">
                                {{-- <div class="item">
                                    <img src="{{asset("upload/product/images/".rawurlencode($productDetails->main_image_name))}}" alt="">
                                </div> --}}

                                @if(count($productDetails->productImage)>0)
                                    @foreach ($productDetails->productImage as $itemimages)
                                        <div class="item">
                                            <img src="{{asset("upload/product/images/".$itemimages->product_img)}}" alt="">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="item">
                                        <img src="{{asset("upload/product/images/".rawurlencode($productDetails->main_image_name))}}" alt="">
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="singleProductRight">
                            <div class="sprTop">
                                <h2 class="productName">{{$productDetails->product_title}}</h2>

                            </div>

                            <div class="sprTop">
                               
                                <p class="product-price">
                                    <span class="original">₹{{$productDetails->product_price}}</span>
                                    @if ($productDetails->is_variation==0)
                                        <span class="offer">₹{{$productDetails->product_offerprice}}</span>
                                        @else 
                                        <span class="offer" id="product-price">₹{{ number_format($productDetails->variations->min('price'), 0) }}</span>
                                    @endif
                                </p>

                            </div>
                            @if ($productDetails->is_variation==1)

                                <div class="color-wrapper mb-10">
                                    <p class="mb-2">Select Color</p>
                                    @php
                                        $colors = $productDetails->variations->pluck('color')->unique();
                                    @endphp

                                    @foreach($colors as $color)
                                        <div class="color-circle"
                                            data-color="{{ $color }}"
                                            style="background: {{ $color }}">
                                        </div>
                                    @endforeach
                                </div>

                                <div>
                                    <p class="mb-2">Select Size (UNI)</p>
                                    <div id="size-container" class="size-wrapper"></div>
                                </div>

                                <div class="mt-3">
                                    <p class="avalableStock">Available stock: <span id="available-stock">-</span></p>
                                </div>
                                
                                {{-- <h4 id="product-price"></h4> --}}

                                <div class="sprTop">

                                    <input type="hidden" name="hidden_attribute_items_id" id="hidden_attribute_items_id" value="">
                                    <input type="hidden" name="color_attribute" id="color_attribute" value="0">
                                    <input type="hidden" name="size_attribute" id="size_attribute" value="">


                                </div>
                            @else

                                <div class="mt-3 mb-3">
                                    <p class="avalableStock">Available stock: {{$productDetails->product_stock=='' ? 0 :$productDetails->product_stock}}</p>
                                </div>

                            @endif

                            <div class="alert alert-danger alertMsg" style="display: none;"></div>

                            <div class="sprTop d-flex flex-wrap">
                                <div class="number-input inpCartWist">
                                    <button
                                        onclick="addremove('decrease')"></button>
                                    <input class="quantity" name="quantity" id="quantity" value="1" type="number">
                                    <input type="hidden" id="totalqty" value="1">
                                    <button onclick="addremove('increase')"
                                        class="plus"></button>
                                </div>

                                <div class="inpCartWist">
                                    @if ($productDetails->is_variation==0)
                                        @if ($productDetails->product_stock > 0)
                                            <a href="javascript:void(0)" onclick="addtoCart('{{$productDetails->id}}', '{{$productDetails->is_variation}}', 'cart')" class="addToCartBtn">Add To Cart</a>
                                            <a href="javascript:void(0)" onclick="addtoCart('{{$productDetails->id}}', '{{$productDetails->is_variation}}', 'buy')" class="buyNowBtn">Buy Now</a>
                                        @endif
                                    @else
                                        <a href="javascript:void(0)" onclick="addtoCart('{{$productDetails->id}}', '{{$productDetails->is_variation}}', 'cart')" class="addToCartBtn disable" id="addToCartBtnVar">Add To Cart</a>
                                        <a href="javascript:void(0)" onclick="addtoCart('{{$productDetails->id}}', '{{$productDetails->is_variation}}', 'buy')" class="buyNowBtn" id="buyNowBtnVar">Buy Now</a>
                                    @endif
                                @if ($productDetails->is_variation==1)
                                <script type="module">
                                    function toggleVariationButtons(stock) {
                                        if (typeof stock === 'undefined' || stock === null || stock < 1) {
                                            $('#addToCartBtnVar').hide();
                                            $('#buyNowBtnVar').hide();
                                        } else {
                                            $('#addToCartBtnVar').show();
                                            $('#buyNowBtnVar').show();
                                        }
                                    }

                                    // Hook into updateAvailableStock
                                    const origUpdateAvailableStock = window.updateAvailableStock;
                                    window.updateAvailableStock = function(stock) {
                                        origUpdateAvailableStock(stock);
                                        toggleVariationButtons(stock);
                                    };

                                    // On page load, hide buttons if no variation selected or stock is 0
                                    $(document).ready(function() {
                                        let initialStock = $('#available-stock').text();
                                        if (initialStock === '-' || parseInt(initialStock) < 1) {
                                            $('#addToCartBtnVar').hide();
                                            $('#buyNowBtnVar').hide();
                                        }
                                    });
                                </script>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overviewArea">
                <div class="row">
                    <div class="col-12">

                        {{-- <div class="navHeader">
                            <ul class="nav nav-tabs " role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#overview" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Overview
                                    </a>
                                </li>

                            </ul>
                        </div> --}}
                        <div class="tab-content pt-4 pb-4" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="overview" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="overviewBox">
                                    <h3>Overview</h3>
                                    <div class="appendOverview">
                                        {!! $productDetails->product_desc !!}
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



@endsection

@push('scripts')

<script type="module">

let variations = @json($productDetails->variations);

let selectedColor = null;
let selectedVariationId = null;

/* =========================
   INIT (AUTO SELECT LOWEST PRICE)
========================= */

if (variations.length > 0) {

    let lowestVariation = variations.reduce((min, v) => 
        v.price < min.price ? v : min
    );

    selectedColor = lowestVariation.color;

    selectColor(selectedColor);
    highlightColor(selectedColor);
}

/* =========================
   COLOR CLICK
========================= */

$(document).on('click', '.color-circle', function () {

    let color = $(this).data('color');

    selectColor(color);
    highlightColor(color);
});

/* =========================
   SELECT COLOR → SHOW SIZES
========================= */

function selectColor(color) {

    selectedColor = color;

    let filtered = variations.filter(v => v.color === color);

    let html = '';

    filtered.forEach(v => {

        let disabledClass = (v.stock !== undefined && v.stock == 0) ? 'disabled' : '';

        html += `
            <div class="size-btn ${disabledClass}" 
                 data-id="${v.id}" 
                 data-price="${v.price}">
                ${v.size}
            </div>
        `;
    });

    $('#size-container').html(html);

    /* AUTO SELECT FIRST AVAILABLE SIZE */
    let firstAvailable = filtered.find(v => !v.stock || v.stock > 0);

    if (firstAvailable) {
        updatePrice(firstAvailable.price);
        highlightSize(firstAvailable.id);

        selectedVariationId = firstAvailable.id;
        $('#hidden_attribute_items_id').val(firstAvailable.id);
        updateAvailableStock(firstAvailable.stock);
        if (firstAvailable.stock !== undefined && firstAvailable.stock < 1) {
            showStockAlert();
        } else {
            hideStockAlert();
        }
    } else {
        // no stock case
        $('#product-price').text('Out of stock');
        selectedVariationId = null;
        $('#hidden_attribute_items_id').val('');
        updateAvailableStock(0);
        showStockAlert();
    }
}

/* =========================
   SIZE CLICK
========================= */

$(document).on('click', '.size-btn', function () {

    if ($(this).hasClass('disabled')) return;

    let price = $(this).data('price');
    let id = $(this).data('id');

    updatePrice(price);
    highlightSize(id);

    selectedVariationId = id;
    $('#hidden_attribute_items_id').val(id);

    // Find the selected variation to get its stock
    let selectedVar = variations.find(v => v.id == id);
    if (selectedVar) {
        updateAvailableStock(selectedVar.stock);
        if (selectedVar.stock !== undefined && selectedVar.stock < 1) {
            showStockAlert();
        } else {
            hideStockAlert();
        }
    }
});

/* =========================
   UPDATE PRICE
========================= */

function updatePrice(price) {
    $('#product-price').text('₹' + Math.round(price));
}

function updateAvailableStock(stock) {
    if (typeof stock === 'undefined' || stock === null) {
        $('#available-stock').text('-');
    } else {
        $('#available-stock').text(stock);
    }
}

function showStockAlert() {
    $('.alertMsg').text('Selected variant is out of stock!').show();
}

function hideStockAlert() {
    $('.alertMsg').hide();
}

/* =========================
   ACTIVE STATES
========================= */

function highlightColor(color) {
    $('.color-circle').removeClass('active');
    $(`.color-circle[data-color="${color}"]`).addClass('active');
}

function highlightSize(id) {
    $('.size-btn').removeClass('active');
    $(`.size-btn[data-id="${id}"]`).addClass('active');
}



</script>

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

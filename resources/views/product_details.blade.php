@extends('layouts.app')
@section('content')

<section class="singleProductBanner" style="background: url({{ Vite::asset('resources/front/images/pro-single-banner.jpg')}}) center center no-repeat">
    <!-- <div class="banSlogan">
        <div class="banSloganInner wow fadeInUp delay1">
            <h2>Lorem Ipsum</h4>
                <h4>is simply dummy text of the printing.</h4>
                <a href="#">Became a Dealer</a>
        </div>
    </div> -->
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
                                @if ($productDetails->is_variation==0)
                                    @if($productDetails->productCategory->title=='holiday')
                                        <h5><span><del>${{$productDetails->product_price}}</del></span> ${{$productDetails->product_offerprice}}</h5>
                                    @else

                                        @if($productDetails->product_offerprice!='')
                                            <h5>${{$productDetails->product_offerprice}}</h5>
                                        @else
                                            <h5>${{$productDetails->product_price}}</h5>
                                        @endif
                                    @endif

                                @else
                                    @php
                                        $productAttributeItems = $productDetails->ProductAttributeItem;
                                        $prices = collect($productAttributeItems)->pluck('price')->map(function ($price) {
                                            return floatval($price);
                                        });
                                    @endphp
                                    @if ($prices->max()==$prices->min())
                                        <h5 class="productPrice">${{$prices->min()}}</h5>
                                    @else
                                        <h5 class="productPrice">${{$prices->min()}} - ${{$prices->max()}}</h5>
                                    @endif
                                @endif

                            </div>
                            @if ($productDetails->is_variation==1)
                                <div class="sprTop">
                                    @if (count($productDetails->ProductAttribute)>0)
                                        @foreach ($productDetails->ProductAttribute as $itemProductAttribute)
                                            <h6>{{$itemProductAttribute->name}}:</h6>
                                            <ul class="row g-2">
                                                @if (count($itemProductAttribute->ProductAttributeItem)>0)
                                                    @foreach ($itemProductAttribute->ProductAttributeItem as $items)
                                                        <li class="col-auto"><button class="btn btn-outline-dark" onclick="attributeBtn('{{$items->id}}')" type="button">{{$items->name}}</button></li>
                                                    @endforeach
                                                @endif

                                            </ul>
                                        @endforeach

                                        <div class="size_append">

                                        </div>

                                    @endif
                                        <input type="hidden" name="hidden_attribute_items_id" id="hidden_attribute_items_id" value="">
                                        <input type="hidden" name="size_attribute" id="size_attribute" value="0">
                                        <input type="hidden" name="size_attribute_name" id="size_attribute_name" value="">


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
                                        @if ($productDetails->product_stock==0)
                                            <h4>Coming Soon</h4>
                                        @else
                                            <a href="javascript:void(0)" onclick="addtoCart('{{$productDetails->id}}', '{{$productDetails->is_variation}}')" class="addToCartBtn">Add To Cart</a>
                                        @endif
                                    @else
                                        <a href="javascript:void(0)" onclick="addtoCart('{{$productDetails->id}}', '{{$productDetails->is_variation}}')" class="addToCartBtn disable">Add To Cart</a>
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

                        <div class="navHeader">
                            <ul class="nav nav-tabs " role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#overview" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Overview
                                    </a>
                                </li>

                            </ul>
                        </div>
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

<section class="about">
    <div class="container">
        <div class="row align-items-center g-lg-5">
            <div class="col">
                <div class="aboutContent text-center wow fadeInUpSort delay1">
                    <p>
                        At Drago Custom Rods, we build unique one of a kind custom rods based on our client's need
                        and type of fishing that they do. We start with proven
                        industry blanks from various manufactures and work from there. Our Clients get to choose
                        from a vast inventory of components to suit their personal
                        style, from some of the largest component manufacturers in the industry.
                    </p>
                    <h5>- By fisherman for fishermen</h5>
                </div>
            </div>
            <div class="col-auto">
                <div class="aboutImg wow fadeInUpSort delay3">
                    <img src="{{ Vite::asset('resources/front/images/about.jpg')}}" alt="" />
                </div>
            </div>
        </div>
    </div>
</section>


  <!-- Modal -->
  <div class="modal fade" id="specificationsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Specifications</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4 class="specificationtitle"></h4>
            <div class="table-responsive">
                <table class="table">
                    <tbody class="appendTable">

                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>


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

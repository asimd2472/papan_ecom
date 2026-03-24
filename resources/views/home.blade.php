@extends('layouts.app')
@section('content')

    <section class="homeBanner d-flex justify-content-center align-items-center"
    style="background: url({{asset('storage/images/'.@$homepageData->banner_image)}}) center center no-repeat">
    <div class="banSlogan">
        <div class="banSloganInner wow fadeInUp delay1">
            {{-- <h2>Lorem Ipsum</h4>
                <h4>is simply dummy text of the printing.</h4> --}}
                {{-- <a href="#">Became a Dealer</a> --}}
        </div>
    </div>
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

    <section class="weCarry">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="text-center secTitle">
                    <h2>CATEGORY</h2>
                </div>
            </div>
            <div class="shopReelsType">
                {{-- <h3>Shop {{$singleCategory->title}} by Type</h3> --}}
                <div class="row justify-content-center g-3">

                    @foreach ($categoryes as $productTypeitem)
                        <div class="col-lg-2 col-md-2 col-sm-6 col-6 wow fadeInUpSort delay1">
                            {{-- @if($productTypeitem->typename=='Custom Rods')
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#customRodPopup" class="shopBox">
                                    <img src="{{asset('storage/images/'.$productTypeitem->typeimage)}}" alt="{{$productTypeitem->typename}}" />
                                    <span>{{$productTypeitem->typename}}</span>
                                </a>
                            @else --}}
                                <a href="{{ route('product_categoty', $productTypeitem->slug) }}" class="shopBox">
                                    <img src="{{asset('storage/images/'.$productTypeitem->categoryimage)}}" alt="{{$productTypeitem->title}}" />
                                    <span>{{$productTypeitem->title}}</span>
                                </a>
                            {{-- @endif --}}
                        </div>
                    @endforeach



                </div>
            </div>
        </div>
    </div>
    </section>

    {{-- @php
        dd($categoryes);
    @endphp --}}

    {{-- <section class="gallery">
    <div class="container-fluid">
        <div class="row g-lg-3 g-md-3 g-sm-3 g-3">

            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                @if(!empty($categoryes))
                    @if(!empty($categoryes[0]))
                        <div class="galleryBox gbMid wow fadeInUpSort delay3">
                            <a href="{{ route('product_categoty', $categoryes[0]->slug)}}" style="background: url({{asset('storage/images/'.$categoryes[0]->categoryimage)}}) center center no-repeat;">
                                <span>{{$categoryes[0]->title}}</span>
                            </a>
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-lg-8 col-md-8 col-sm-4 col-12">
                <div class="row g-lg-3 g-md-3 g-sm-3 g-3">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        @if(!empty($categoryes))
                            @if(!empty($categoryes[1]))
                                <div class="galleryBox wow fadeInUpSort delay1">
                                    <a href="{{ route('product_categoty', $categoryes[1]->slug)}}" style="background: url({{asset('storage/images/'.$categoryes[1]->categoryimage)}}) center center no-repeat;">
                                        <span>{{$categoryes[1]->title}}</span>
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        @if(!empty($categoryes))
                            @if(!empty($categoryes[4]))
                                <div class="galleryBox wow fadeInUpSort delay2">
                                    <a href="{{ route('product_categoty', $categoryes[4]->slug)}}" style="background: url({{asset('storage/images/'.$categoryes[4]->categoryimage)}}) center center no-repeat;">
                                        <span>{{$categoryes[4]->title}}</span>
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        @if(!empty($categoryes))
                            @if(!empty($categoryes[6]))
                                <div class="galleryBox wow fadeInUpSort delay2">
                                    <a href="{{ route('product_categoty', $categoryes[6]->slug)}}" style="background: url({{asset('storage/images/'.rawurlencode($categoryes[6]->categoryimage))}}) center center no-repeat;">
                                        <span>{{$categoryes[6]->title}}</span>
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        @if(!empty($categoryes))
                            @if(!empty($categoryes[2]))
                                <div class="galleryBox wow fadeInUpSort delay4">
                                    <a href="{{ route('product_categoty', $categoryes[2]->slug)}}" style="background: url({{asset('storage/images/'.$categoryes[2]->categoryimage)}}) center center no-repeat;">
                                        <span>{{$categoryes[2]->title}}</span>
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        @if(!empty($categoryes))
                            @if(!empty($categoryes[3]))
                                <div class="galleryBox wow fadeInUpSort delay5">
                                    <a href="{{ route('product_categoty', $categoryes[3]->slug)}}" style="background: url({{asset('storage/images/'.$categoryes[3]->categoryimage)}}) center center no-repeat;">
                                        <span>{{$categoryes[3]->title}}</span>
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                        @if(!empty($categoryes))
                            @if(!empty($categoryes[5]))
                                <div class="galleryBox wow fadeInUpSort delay5">
                                    <a href="{{ route('product_categoty', $categoryes[5]->slug)}}" style="background: url({{asset('storage/images/'.$categoryes[5]->categoryimage)}}) center center no-repeat;">
                                        <span>{{$categoryes[5]->title}}</span>
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    </section> --}}

    <section class="about">
    <div class="container-fluid">
        <div class="row align-items-center g-lg-5">
            <div class="col">
                <div class="aboutContent text-center wow fadeInUpSort delay1">
                    <p>{{@$homepageData->about}}</p>
                        <h5>- {{@$homepageData->about_title}}</h5>
                </div>
            </div>
            <div class="col-lg-auto col-md-auto col-sm-auto col-12">
                <div class="aboutImg wow fadeInUpSort delay3">
                    <img src="{{asset('storage/images/'.@$homepageData->about_image)}}" alt="">
                </div>
            </div>
        </div>
    </div>
    </section>

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
    </script>

{{-- <script type="module">
    $(document).ready(function() {
        setTimeout(function() {
          showmodal();
        }, 1000);

    });
</script> --}}

    @endpush



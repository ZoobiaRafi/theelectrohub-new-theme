@extends ('frontend.layout.master')

@section('title')
{{setting('site.title')}}
@endsection

@section('meta')
<meta name="description" content="{{setting('site.description')}}">
<meta name="keywords" content="{{setting('site.keywords')}}">
<meta property="og:title" content="{{setting('site.title')}}">
<meta property="og:description" content="{{setting('site.description')}}">
<meta property="og:url" content="{{env('APP_URL')}}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{setting('site.title')}}">
<meta name="twitter:description" content="{{setting('site.description')}}">
<meta name="twitter:domain" content="{{env('APP_URL')}}">
@endsection

@section('css')
<style>
    .homebanner .u-slick__pagination:not(.u-slick__pagination--block) {
        padding-bottom: 3.5rem 
    }
    .product-item__outer .product-item__inner .product-item__body div a img{
        transform: scale(1);
        height: 124px;
    }

    .h-300 {
        height: 300px;
    }

    .h-256 {
        height: 300px;
    }

    .h-280 {
        height: 280px;
    }

    .ticker {
        transition: all ease 1s;
        background: #f9f9f9;
        position: relative;
        /* height: 70px; */
    }

    .ticker .ticker-item {
        margin-top: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 17vw;
    }

    .u-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .text-info-new {
        align-items: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .fw-800{
        font-weight: 800;
    }

    @media only screen and (max-width: 600px) {

        .h-300,
        .h-256,
        .h-280 {
            height: auto;
        }

        .ticker .ticker-item {
            width: 44vw;
            border: 1px solid #cccccc;
            border-radius: 5px;
            margin-right: 5px;
        }

        .margin-bottom {
            margin-bottom: 1rem !important;

        }

        .ticker .ticker-item:last-child {
            /* border-right: none;  */
            width: 90vw;
        }

        .u-avatar i.font-size-46,
        .u-avatar i.font-size-56 {
            font-size: 2rem;
        }

        .text-info-new .feature-tag {
            font-size: 0.75rem;
        }

        .homebanner .u-slick__pagination:not(.u-slick__pagination--block) {
            padding-bottom: 1.5rem !important;
        }

    }

    @media only screen and (max-width: 375px) {
        .start-buying {
            padding: 10px !important;
            margin-bottom: 1rem !important;
        }

        .margin-bottom {
            margin-bottom: 0.25rem !important;
        }
        .homebanner .u-slick__pagination:not(.u-slick__pagination--block) {
            padding-bottom: 3.5rem !important;
        }
    }
</style>
@endsection

@section('content')
<main id="content" role="main">
    <!-- Slider Section -->
    <div class="homebanner d-none d-md-block">
        <div class="js-slick-carousel u-slick" data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-center mb-0 pb-4 pb-xl-14">
            <div class="js-slide bg-img-hero-center">
                <div class="bg-img-hero pt-xl-18 pt-10 banner-1" style="background-image: url(/frontend/background/banner-weatherproof.webp);">
                    <div class="container">
                        <div class="row py-7 py-md-0 mt-md-8 mb-md-18 pb-xl-4 d-inline-flex w-100">
                            <div class="col-md-6" style="margin-top:100px;">
                                <h1 class="font-size-58-sm text-white text-lh-57 mb-3 font-weight-bold" data-scs-animation-in="fadeInUp">
                                    Weatherproof <br> Series
                                    <!-- <span class="d-block font-size-50">SOLAR PANELS</span> -->
                                </h1>
                                <div class="mb-6" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                    <span class="font-size-15  text-white">
                                        <!-- LAST CALL <br class="d-block d-md-none"> FOR UP TO</span>
                                    <span class="font-size-55 font-weight-bold text-lh-45 text-gray-90">
                                        <sup class="font-size-36 ">&pound;</sup>350<sub class="font-size-16">OFF!</sub> -->
                                        Explore The Electro Hub's Weatherproof Series your complete solution for durable outdoor wiring accessories, including switches, sockets, RCD units, and more.
                                    </span>
                                </div>
                                <a href="{{url('/wiring-accessories/weatherproof/knightsbrigde-1')}}" class="start-buying btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    Start Buying
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="js-slide bg-img-hero-center">
                <div class="bg-img-hero pt-xl-18 pt-10 banner-3" style="background-image: url(/frontend/background/banner-decklights-1.webp);">
                    <div class="container">
                        <div class="row py-7 py-md-0 mt-md-8 mb-md-18 pb-xl-4 d-inline-flex w-100">
                            <div class="col-md-6" style="margin-top:100px;">
                                <h1 class="font-size-58-sm text-white text-lh-57 mb-3 font-weight-bold" data-scs-animation-in="fadeInUp">
                                    Deck Light <br> Solutions
                                    <!-- <span class="d-block font-size-50">SOLAR PANELS</span> -->
                                </h1>
                                <div class="mb-6" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                    <span class="font-size-15  text-white">
                                        <!-- LAST CALL <br class="d-block d-md-none"> FOR UP TO</span>
                                    <span class="font-size-55 font-weight-bold text-lh-45 text-gray-90">
                                        <sup class="font-size-36 ">&pound;</sup>350<sub class="font-size-16">OFF!</sub> -->
                                        The Electro Hub's energy-efficient deck lights are designed to enhance your outdoor ambiance and illuminate your garden beautifully. </span>
                                </div>
                                <a href="{{url('/lighting/outdoor-lighting/led-ground-and-deck-lights')}}" class="start-buying btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    Start Buying
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="js-slide bg-img-hero-center">
                <div class="bg-img-hero pt-xl-18 pt-10 banner-4" style="background-image: url(/frontend/background/banner-fs-led-1.webp);">
                    <div class="container">
                        <div class="row py-7 py-md-0 mt-md-8 mb-md-18 pb-xl-4 d-inline-flex w-100">
                            <div class="col-md-6" style="margin-top:100px;">
                                <h1 class="font-size-58-sm text-white text-lh-57 mb-3 font-weight-bold" data-scs-animation-in="fadeInUp">
                                    Flash Sale
                                    <br>Starting at just &pound;14.99 
                                    <!-- <span class="d-block font-size-50">SOLAR PANELS</span> -->
                                </h1>
                                <div class="mb-6" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                    <span class="font-size-15  text-white">
                                        Light up your Space with BT Series LED Luminaire.
                                    <br>Just starting from &pound;14.99 </span>
                                </div>
                                <a href="{{url('/lighting')}}" class="start-buying btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    Start Buying
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="js-slide bg-img-hero-center">
                <div class="bg-img-hero pt-xl-18 pt-10 banner-2" style="background-image: url(/frontend/background/banner-smarthome-1.webp);">
                    <div class="container">
                        <div class="row py-7 py-md-0 mt-md-8 mb-md-18 pb-xl-4 d-inline-flex w-100">
                            <div class="col-md-6" style="margin-top:100px;">
                                <h1 class="font-size-58-sm text-white text-lh-57 mb-3 font-weight-bold" data-scs-animation-in="fadeInUp">
                                    Smart Home Magic
                                    <span class="d-block font-size-50">Click, Tap, & Done!</span>
                                </h1>
                                <div class="mb-6" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                    <span class="font-size-15  text-white">
                                        <!-- LAST CALL <br class="d-block d-md-none"> FOR UP TO</span>
                                    <span class="font-size-55 font-weight-bold text-lh-45 text-gray-90">
                                        <sup class="font-size-36 ">&pound;</sup>350<sub class="font-size-16">OFF!</sub> -->
                                        Recognize our range of smart home products from Starter Kits to Smart Heating and Luxury Finishes. Everything you need for a modern, convenient home is here. </span>
                                </div>
                                <a href="{{url('/search/smart')}}" class="start-buying btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    Start Buying
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="js-slide bg-img-hero-center">
                <div class="bg-img-hero pt-xl-18 pt-10 banner-5" style="background-image: url(/frontend/background/banner-fs-tubes-1.webp);">
                    <div class="container">
                        <div class="row py-7 py-md-0 mt-md-8 mb-md-18 pb-xl-4 d-inline-flex w-100">
                            <div class="col-md-6" style="margin-top:100px;">
                                <h1 class="font-size-58-sm text-white text-lh-57 mb-3 font-weight-bold" data-scs-animation-in="fadeInUp">
                                Light Up <br>Your Summer 
                                    <!-- Exclusive Sale on LED Battens. -->
                                    <!-- <br><sup class="font-size-36 ">Starting at just </sup>&pound;14.99  -->
                                    <!-- <span class="d-block font-size-50">SOLAR PANELS</span> -->
                                </h1>
                                <div class="mb-6" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                    <span class="font-size-15  text-white">
                                    Exclusive Sale on LED Battens.
                                    <br>Just starting from &pound;14.99 </span>
                                </div>
                                <a href="{{url('/lighting/retail-and-commercial-lighting/batten-fittings/')}}" class="start-buying btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    Start Buying
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="homebanner d-block d-md-none">
        <div class="js-slick-carousel u-slick" data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-center mb-0 pb-4 pb-xl-14">
            <div class="js-slide bg-img-hero-center">
                <div class="bg-img-hero pt-xl-18 pt-10 banner-1" style="background-image: url(/frontend/background/weather-res-banner.webp);">
                    <div class="container">
                        <div class="row py-7 py-md-0 mt-md-8 mb-md-18 pb-xl-4 d-inline-flex w-100">
                            <div class="col-md-6">
                                <h1 class="font-size-58-sm text-white text-lh-57 mb-3 font-weight-bold"  style="padding-top:25px;padding-bottom:30px;" data-scs-animation-in="fadeInUp">
                                    Weatherproof <br> Series
                                    <!-- <span class="d-block font-size-50">SOLAR PANELS</span> -->
                                </h1>
                                <!-- <div class="margin-bottom" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                    <span class="font-size-15 font-weight-bold text-gray-90">LAST CALL <br class="d-block d-md-none"> FOR UP TO</span>
                                    <span class="font-size-55 font-weight-bold text-lh-45 text-gray-90">
                                        <sup class="font-size-36 ">&pound;</sup>350<sub class="font-size-16">OFF!</sub>
                                    </span>
                                </div> -->
                                <a href="{{url('/wiring-accessories/weatherproof/knightsbrigde-1')}}" class="start-buying btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    Start Buying
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="js-slide bg-img-hero-center">
                <div class="bg-img-hero pt-xl-18 pt-10 banner-2" style="background-image: url(/frontend/background/deck-res-banner-1.webp);">
                    <div class="container">
                        <div class="row py-7 py-md-0 mt-md-8 mb-md-18 pb-xl-4 d-inline-flex w-100">
                        <div class="col-md-6">
                                <h1 class="font-size-58-sm text-white text-lh-57 mb-3 font-weight-bold"  style="padding-top:25px;padding-bottom:30px;" data-scs-animation-in="fadeInUp">
                                Deck Light <br> Solutions                                    <!-- <span class="d-block font-size-50">SOLAR PANELS</span> -->
                                </h1>
                                <!-- <div class="margin-bottom" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                    <span class="font-size-15 font-weight-bold text-gray-90">LAST CALL <br class="d-block d-md-none"> FOR UP TO</span>
                                    <span class="font-size-55 font-weight-bold text-lh-45 text-gray-90">
                                        <sup class="font-size-36 ">&pound;</sup>350<sub class="font-size-16">OFF!</sub>
                                    </span>
                                </div> -->
                                <a href="{{url('/lighting/outdoor-lighting/led-ground-and-deck-lights')}}" class="start-buying btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    Start Buying
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="js-slide bg-img-hero-center">
                <div class="bg-img-hero pt-xl-18 pt-10 res-banner-3" style="background-image: url(/frontend/background/fs-led-res-banner-1.webp);">
                    <div class="container">
                        <div class="row py-7 py-md-0 mt-md-8 mb-md-18 pb-xl-4 d-inline-flex w-100">
                            <div class="col-md-6">
                                <h1 class="font-size-58-sm text-white text-lh-57 mb-3 font-weight-bold"  style="padding-top:25px;padding-bottom:5px;" data-scs-animation-in="fadeInUp">
                                Flash Sale
                                    <br>Starting at
                                    <br> just <span class="text-primary fw-800 ">&pound;14.99</span>
                                    <!-- <span class="d-block font-size-50">SOLAR PANELS</span> -->
                                </h1>
                                <!-- <div class="margin-bottom" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                    <span class="font-size-15 font-weight-bold text-gray-90">LAST CALL <br class="d-block d-md-none"> FOR UP TO</span>
                                    <span class="font-size-55 font-weight-bold text-lh-45 text-gray-90">
                                        <sup class="font-size-36 ">&pound;</sup>350<sub class="font-size-16">OFF!</sub>
                                    </span>
                                </div> -->
                                <a href="{{url('/lighting')}}" class="start-buying btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    Start Buying
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="js-slide bg-img-hero-center">
                <div class="bg-img-hero pt-xl-18 pt-10 res-banner-4" style="background-image: url(/frontend/background/smart-res-banner.webp);">
                    <div class="container">
                        <div class="row py-7 py-md-0 mt-md-8 mb-md-18 pb-xl-4 d-inline-flex w-100">
                            <div class="col-md-6">
                                <h1 class="font-size-58-sm text-white text-lh-57 mb-3 font-weight-bold"  style="padding-top:25px;padding-bottom:30px;" data-scs-animation-in="fadeInUp">
                                Smart Home <br> Magic
                                    <!-- <span class="d-block font-size-50">Click, Tap, & Done!</span> 
                                    <span class="d-block font-size-50">SOLAR PANELS</span> -->
                                </h1>
                                <!-- <div class="margin-bottom" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                    <span class="font-size-15 font-weight-bold text-gray-90">LAST CALL <br class="d-block d-md-none"> FOR UP TO</span>
                                    <span class="font-size-55 font-weight-bold text-lh-45 text-gray-90">
                                        <sup class="font-size-36 ">&pound;</sup>350<sub class="font-size-16">OFF!</sub>
                                    </span>
                                </div> -->
                                <a href="{{url('/lighting')}}" class="start-buying btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    Start Buying
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="js-slide bg-img-hero-center">
                <div class="bg-img-hero pt-xl-18 pt-10 res-banner-3" style="background-image: url(/frontend/background/fs-tube-res-banner.webp);">
                    <div class="container">
                        <div class="row py-7 py-md-0 mt-md-8 mb-md-18 pb-xl-4 d-inline-flex w-100">
                        <div class="col-md-6">
                                <h1 class="font-size-58-sm text-white text-lh-57 mb-3 font-weight-bold"  style="padding-top:25px;padding-bottom:5px;" data-scs-animation-in="fadeInUp">
                                    LED Battens Sale
                                    <br>Starting from <br><span class="text-primary fw-800">&pound;14.99</span>
                                    <!-- <span class="d-block font-size-50">SOLAR PANELS</span> -->
                                </h1>
                                <!-- <div class="margin-bottom" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                    <span class="font-size-15 font-weight-bold text-gray-90">LAST CALL <br class="d-block d-md-none"> FOR UP TO</span>
                                    <span class="font-size-55 font-weight-bold text-lh-45 text-gray-90">
                                        <sup class="font-size-36 ">&pound;</sup>350<sub class="font-size-16">OFF!</sub>
                                    </span>
                                </div> -->
                                <a href="{{url('/lighting/retail-and-commercial-lighting/batten-fittings/')}}" class="start-buying btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    Start Buying
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ticker : Start -->
    <div class="ticker p-3">
        <div class="container-fluid d-flex align-items-center justify-content-center">
            <div class="row d-flex">
                <div class="ticker-item py-3">
                    <div class="row">
                        <div class="u-avatar mr-2">
                            <i class="text-primary ec ec-transport font-size-46"></i>
                        </div>
                        <div class="media-body text-center text-info-new">
                            <span class="d-block font-weight-bold text-dark feature-tag">Free Delivery</span>
                            <div class=" text-secondary feature-tag">On Orders &pound;150 <br>And Above</div>
                        </div>
                    </div>
                </div>
                <div class="ticker-item py-3">
                    <div class="row">
                        <div class="u-avatar mr-2">
                            <i class="text-primary ec ec-customers font-size-56"></i>
                        </div>
                        <div class="media-body text-center text-info-new">
                            <span class="d-block font-weight-bold text-dark feature-tag">99% Customer</span>
                            <div class=" text-secondary feature-tag">Feedbacks</div>
                        </div>
                    </div>
                </div>
                <div class="ticker-item py-3">
                    <div class="row">
                        <div class="u-avatar mr-2">
                            <i class="text-primary ec ec-returning font-size-46"></i>
                        </div>
                        <div class="media-body text-center text-info-new">
                            <span class="d-block font-weight-bold text-dark feature-tag">365 Days</span>
                            <div class=" text-secondary feature-tag">For Free Return</div>
                        </div>
                    </div>
                </div>
                <div class="ticker-item py-3">
                    <div class="row">
                        <div class="u-avatar mr-2">
                            <i class="text-primary ec ec-payment font-size-46"></i>
                        </div>
                        <div class="media-body text-center text-info-new">
                            <span class="d-block font-weight-bold text-dark feature-tag">Payment</span>
                            <div class=" text-secondary feature-tag">Secure System</div>
                        </div>
                    </div>
                </div>
                <div class="ticker-item py-3 d-none d-md-flex">
                    <div class="row">
                        <div class="u-avatar mr-2">
                            <i class="text-primary ec ec-tag font-size-46"></i>
                        </div>
                        <div class="media-body text-center text-info-new">
                            <span class="d-block font-weight-bold text-dark feature-tag">Only Best</span>
                            <div class=" text-second feature-tagary">Brands</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ticker : end -->

    <!-- End Slider Section -->
    <div class="container">
        <!-- categories :desktop -->
        <div class="row mb-6 mt-3 d-none d-md-flex flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
            @foreach($home_categories as $home_catecory)
            <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1">
                <a href="{{url($home_catecory->slug)}}" class="min-height-146 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                    <div class="col-6 col-xl-7 col-wd-6 pr-0">
                        <img class="img-fluid" src="{{$home_catecory->image}}" alt="Image Description">
                    </div>
                    <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                        <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                            CATCH BIG DEALS <strong>{{$home_catecory->title}}</strong>
                        </div>
                        <div class="link text-gray-90 font-weight-bold font-size-15" href="{{url($home_catecory->slug)}}">
                            Shop now
                            <span class="link__icon ml-1">
                                <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            <!-- End categories:desktop -->
        </div>
        <!-- categories:phone -->
        <div class="row d-md-none d-block">
            <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1" data-pagi-classes="text-center d-xl-none right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-1 pt-1" data-arrows-classes="d-none d-xl-inline-block u-slick__arrow-normal u-slick__arrow-centered--y font-size-25" data-arrow-left-classes="fas fa-chevron-left left-n16 u-slick__arrow-classic-inner--left z-index-9" data-arrow-right-classes="fas fa-chevron-right right-n16 u-slick__arrow-classic-inner--right" data-slides-show="5" data-slides-scroll="1" data-responsive='[{
                                          "breakpoint": 1400,
                                          "settings": {
                                            "slidesToShow":4
                                          }
                                        }, {
                                            "breakpoint": 1200,
                                            "settings": {
                                              "slidesToShow":4
                                            }
                                        }, {
                                          "breakpoint": 992,
                                          "settings": {
                                            "slidesToShow": 4
                                          }
                                        }, {
                                          "breakpoint": 768,
                                          "settings": {
                                            "slidesToShow": 1
                                          }
                                        }, {
                                          "breakpoint": 554,
                                          "settings": {
                                            "slidesToShow": 1
                                          }
                                        }]'>
                @foreach($home_categories as $home_catecory)
                <div class="col-md-6 mb-4 mb-xl-0 col-xl-4 col-wd-3 flex-shrink-0 flex-xl-shrink-1">
                    <a href="{{url($home_catecory->slug)}}" class="min-height-146 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                        <div class="col-6 col-xl-7 col-wd-6 pr-0">
                            <img class="img-fluid" src="{{$home_catecory->image}}" alt="Image Description">
                        </div>
                        <div class="col-6 col-xl-5 col-wd-6 pr-xl-4 pr-wd-3">
                            <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                CATCH BIG DEALS <strong>{{$home_catecory->title}}</strong>
                            </div>
                            <div class="link text-gray-90 font-weight-bold font-size-15" href="{{url($home_catecory->slug)}}">
                                Shop now
                                <span class="link__icon ml-1">
                                    <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
        </div>
        <!-- End categories:phone -->

        <!-- Tab Prodcut Section -->
        <div class="mb-6">
            <!-- Nav Classic -->
            <div class="position-relative bg-white text-center z-index-2">
                <ul class="nav nav-classic nav-tab justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active js-animation-link" id="featured-tab" data-toggle="pill" href="#featured-products" role="tab" aria-controls="featured-products" aria-selected="true" data-target="#featured-products" data-link-group="groups" data-animation-in="slideInUp">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Featured
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-animation-link" id="on-sale-tab" data-toggle="pill" href="#on-sale-products" role="tab" aria-controls="on-sale-products" aria-selected="false" data-target="#on-sale-products" data-link-group="groups" data-animation-in="slideInUp">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                On Sale
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-animation-link" id="top-rated-tab" data-toggle="pill" href="#top-rated-products" role="tab" aria-controls="top-rated-products" aria-selected="false" data-target="#top-rated-products" data-link-group="groups" data-animation-in="slideInUp">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                Top Rated
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Nav Classic -->
            <!-- Tab Content -->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade pt-2 show active" id="featured-products" role="tabpanel" aria-labelledby="featured-tab" data-target-group="groups">
                    <ul class="row list-unstyled products-group no-gutters h-256">
                        @foreach ($featuredProducts as $product)
                        @php
                            $routeParameters = [];
                            $slugs = [
                                $product->product_to_category->first()->category_detail->parent_info->grand_parent_info->slug ?? null,
                                $product->product_to_category->first()->category_detail->parent_info->slug ?? null,
                                $product->product_to_category->first()->category_detail->slug ?? null,
                                $product->slug
                            ];

                            foreach ($slugs as $slug) {
                                if ($slug !== null) {
                                    $routeParameters[] = $slug;
                                }
                            }
                        @endphp
                        <li class="col-md-3 col-sm-6">
                            @include('frontend.inc.product-card')
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade pt-2" id="on-sale-products" role="tabpanel" aria-labelledby="on-sale-tab" data-target-group="groups">
                    <ul class="row list-unstyled products-group no-gutters h-256">
                        @foreach ($saleProducts as $product)
                        @php
                            $routeParameters = [];
                            $slugs = [
                                $product->product_to_category->first()->category_detail->parent_info->grand_parent_info->slug ?? null,
                                $product->product_to_category->first()->category_detail->parent_info->slug ?? null,
                                $product->product_to_category->first()->category_detail->slug ?? null,
                                $product->slug
                            ];

                            foreach ($slugs as $slug) {
                                if ($slug !== null) {
                                    $routeParameters[] = $slug;
                                }
                            }
                        @endphp
                        <li class="col-md-3 col-sm-6">
                            @include('frontend.inc.product-card')
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade pt-2" id="top-rated-products" role="tabpanel" aria-labelledby="top-rated-tab" data-target-group="groups">
                    <ul class="row list-unstyled products-group no-gutters h-256">
                        @foreach ($topProducts as $product)
                        @php
                            $routeParameters = [];
                            $slugs = [
                                $product->product_to_category->first()->category_detail->parent_info->grand_parent_info->slug ?? null,
                                $product->product_to_category->first()->category_detail->parent_info->slug ?? null,
                                $product->product_to_category->first()->category_detail->slug ?? null,
                                $product->slug
                            ];

                            foreach ($slugs as $slug) {
                                if ($slug !== null) {
                                    $routeParameters[] = $slug;
                                }
                            }
                        @endphp
                        <li class="col-md-3 col-sm-6 ">
                            @include('frontend.inc.product-card')
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- End Tab Content -->
        </div>
        <!-- End Tab Prodcut Section -->
    </div>

    <!-- Banner -->
    <div class="container mb-6">
        <div class="row">
            <div class="col-md-6 mb-4 mb-xl-0">
                <a href="#" class="d-block">
                    <img class="img-fluid" src="/frontend/background/free-delivery-1.png" alt="offer-1">
                </a>
            </div>
            <div class="col-md-6 mb-4 mb-xl-0">
                <a href="{{url('/wiring-accessories/decorative-sockets-and-switches')}}" class="d-block">
                    <img class="img-fluid" src="/frontend/background/lights-and-circuits-1.png" alt="offer-2">
                </a>
            </div>
        </div>
    </div>
    <!-- End Banner -->

    <!-- Week Deals limited -->
    <div class="bg-gray-7 mb-6 py-7 pt-xl-15 pb-xl-7" style="background-image: url(/frontend/background/clearence-bg.webp);background-position: bottom;background-repeat: no-repeat;
			background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 col-lg-3 mb-6 mb-md-0">
                    <h1 class="font-size-42 text-lh-38 mb-3 font-weight-light" data-scs-animation-in="fadeInUp">
                        <span class="font-size-42">Flash Sale Starting From</span>
                    </h1>
                    <div class="mb-6" data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                        <!-- <span class="font-size-15 font-weight-bold">STARTING FROM</span> -->
                        <span class="font-size-55 font-weight-bold text-lh-45 text-gray-90">&pound;14.99</span>
                        <!-- <span class="font-size-15 font-weight-bold">OFF!</span> -->
                        <!-- <span class="font-size-sl-48 font-weight-bold text-lh-45">
                            70<sup class="font-size-36">%</sup><sub class="font-size-16">OFF!</sub>
                        </span> -->
                    </div>
                    <a href="{{url('/lighting')}}" class="btn btn-primary text-white transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                        Start Buying
                    </a>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="h-300">
                        <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1" data-pagi-classes="text-center d-xl-none right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 pt-1" data-arrows-classes="d-none d-xl-inline-block u-slick__arrow-normal u-slick__arrow-centered--y font-size-25" data-arrow-left-classes="fas fa-chevron-left left-n16 u-slick__arrow-classic-inner--left z-index-9" data-arrow-right-classes="fas fa-chevron-right right-n16 u-slick__arrow-classic-inner--right" data-slides-show="4" data-slides-scroll="1" data-responsive='[{
                                      "breakpoint": 1400,
                                      "settings": {
                                        "slidesToShow": 4
                                      }
                                    }, {
                                        "breakpoint": 1200,
                                        "settings": {
                                          "slidesToShow": 3
                                        }
                                    }, {
                                      "breakpoint": 992,
                                      "settings": {
                                        "slidesToShow": 2
                                      }
                                    }, {
                                      "breakpoint": 768,
                                      "settings": {
                                        "slidesToShow": 2
                                      }
                                    }, {
                                      "breakpoint": 554,
                                      "settings": {
                                        "slidesToShow": 2
                                      }
                                    }]'>
                            @foreach ($flashSale as $product)
                            @php
                            $routeParameters = [];
                            $slugs = [
                            $product->product_to_category->first()->category_detail->parent_info->grand_parent_info->slug ?? null,
                            $product->product_to_category->first()->category_detail->parent_info->slug ?? null,
                            $product->product_to_category->first()->category_detail->slug ?? null,
                            $product->slug
                            ];

                            foreach ($slugs as $slug) {
                            if ($slug !== null) {
                            $routeParameters[] = $slug;
                            }
                            }
                            @endphp
                            <div class="js-slide products-group">
                                @include('frontend.inc.product-card')
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Week Deals limited -->

    <!-- Deals of The Day -->
    <div class="container mb-6">
        <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-sm-top-0 border-sm-bottom-0">
            <h3 class="section-title mb-2 mb-md-0 pb-2 font-size-22">Most Popular This Week</h3>
            <!-- <a class="d-block text-gray-16" href="#">Go to Price Deals Products <i class="ec ec-arrow-right-categproes"></i></a> -->
        </div>
        <div class="js-slick-carousel u-slick overflow-hidden u-slick-overflow-visble pt-3 px-1 " data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-6" data-slides-show="4" data-slides-scroll="1" data-responsive='[
                    {
                      "breakpoint": 1500,
                      "settings": {
                        "slidesToShow": 4
                      }
                    }, {
                        "breakpoint": 1200,
                        "settings": {
                          "slidesToShow": 3
                        }
                    }, {
                      "breakpoint": 992,
                      "settings": {
                        "slidesToShow": 3
                      }
                    }, {
                      "breakpoint": 768,
                      "settings": {
                        "slidesToShow": 2
                      }
                    }, {
                      "breakpoint": 554,
                      "settings": {
                        "slidesToShow": 2
                      }
                    }]'>
            @foreach ($popularProducts as $product)
            @php
            $routeParameters = [];
            $slugs = [
            $product->product_to_category->first()->category_detail->parent_info->grand_parent_info->slug ?? null,
            $product->product_to_category->first()->category_detail->parent_info->slug ?? null,
            $product->product_to_category->first()->category_detail->slug ?? null,
            $product->slug
            ];

            foreach ($slugs as $slug) {
                if ($slug !== null) {
                    $routeParameters[] = $slug;
                }
            }
            @endphp
            <div class="js-slide products-group">
                @include('frontend.inc.product-card')
            </div>
            @endforeach
        </div>
    </div>
    <!-- End Deals of The Day -->

    <!-- Laptops & Computers -->
    <div class="container mb-6 position-relative d-none">
        <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-sm-top-0 border-sm-bottom-0">
            <h3 class="section-title mb-2 mb-md-0 pb-2 font-size-22">New Products</h3>
            <!-- <a class="d-block text-gray-16" href="#">Go to Daily Deals Section <i class="ec ec-arrow-right-categproes"></i></a> -->
        </div>
        <div class="js-slick-carousel position-static u-slick overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1 " data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-6" data-arrows-classes="d-none d-xl-inline-block u-slick__arrow-normal u-slick__arrow-centered--y font-size-25" data-arrow-left-classes="fas fa-chevron-left left-n16 u-slick__arrow-classic-inner--left z-index-9" data-arrow-right-classes="fas fa-chevron-right right-n16 u-slick__arrow-classic-inner--right" data-slides-show="6" data-slides-scroll="1" data-responsive='[{
                      "breakpoint": 1500,
                      "settings": {
                        "slidesToShow": 4
                      }
                    }, {
                        "breakpoint": 1200,
                        "settings": {
                          "slidesToShow": 3
                        }
                    }, {
                      "breakpoint": 992,
                      "settings": {
                        "slidesToShow": 3
                      }
                    }, {
                      "breakpoint": 768,
                      "settings": {
                        "slidesToShow": 2
                      }
                    }, {
                      "breakpoint": 554,
                      "settings": {
                        "slidesToShow": 2
                      }
                    }]'>
            @foreach ($flashSale as $product)
            @php
            $routeParameters = [];
            $slugs = [
            $product->product_to_category->first()->category_detail->parent_info->grand_parent_info->slug ?? null,
            $product->product_to_category->first()->category_detail->parent_info->slug ?? null,
            $product->product_to_category->first()->category_detail->slug ?? null,
            $product->slug
            ];

            foreach ($slugs as $slug) {
            if ($slug !== null) {
            $routeParameters[] = $slug;
            }
            }
            @endphp
            <div class="js-slide products-group ">
                @include('frontend.inc.product-card')

            </div>
            @endforeach
        </div>
    </div>
    <!-- End Laptops & Computers -->
</main>
@endsection

@section('js')
<script>
</script>
@endsection
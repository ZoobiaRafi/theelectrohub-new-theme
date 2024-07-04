@extends ('frontend.layout.master')

@section('title')
{{$product->title}}
@endsection

@section('meta')
@endsection

@section('css')
<style>
    .u-slick__arrow-classic:hover {
        color: var(--white) !important;
    }

    .u-slick__arrow-classic-inner:before {
        color: var(--primary);
    }

    .h-256 {
        height: 256px;
    }

    #sliderSyncingNav {
        height: 500px;
        object-fit: contain;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #sliderSyncingNav .js-slide img {
        height: 300px;
        width: 100%;
        object-fit: contain;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #sliderSyncingThumb .slick-slide.js-slide img {
        height: 60px;
    }
    #sliderSyncingThumb .slick-slide.js-slide {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #sliderSyncingNav {
        height: 500px;
        object-fit: contain;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #sliderSyncingNav .js-slide img {
        height: 300px;
        width: 100%;
        object-fit: contain;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    #sliderSyncingThumb .slick-slide.js-slide img {
        height: 60px;
    }

    #sliderSyncingThumb .slick-slide.js-slide {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #sliderSyncingNav .slick-list .slick-track{
        width: 2830px;

    }
    #sliderSyncingNav .slick-list .slick-track .js-slide{
        width: 566px;

    }


    .description-img img {
        height: 350px;
    }

    .pdf a {
        text-decoration: none;
        padding: 10px 15px;
        background-color: #ff660038;
        display: flex;
        border-radius: 5px;
        margin-left: 5px;
        margin-right: 5px;
    }
    #note a:hover{
        color: var(--white)!important;
    }
    #note a:focus{
        color: var(--white)!important;
    }
    .download-section{
        display: flex;
        align-items:center ;
        justify-content: center;
    }
    .product-title a{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }
    
    @media only screen and (max-width: 600px) {
        .h-256 {
            height: auto;
        }

        .download-section{
            flex-direction: column;
        }
        .download-section .pdf{
            margin-top: 0.25rem;
            margin-bottom: 0.25rem;
        }
        #sliderSyncingNav .slick-list .slick-track{
            width: 2000px !important;

        }
        #sliderSyncingNav .slick-list .slick-track .js-slide{
            width: 400px !important;

        }

    }

    @media (min-width: 768px) {
        .u-header--white-nav-links-md:not(.bg-white):not(.js-header-fix-moment) .u-header__nav-link {
            color: #333e48 !important;
        }
    }
</style>
@endsection

@section('content')
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent pt-20">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('homePage')}}">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page"><a href="{{ url('/' .$main_cat->slug )}}">{{$main_cat->title}}</a></li>
                        @if($parentCat != " ")
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page"><a href="{{ url('/' .$main_cat->slug .'/' .$parent->slug )}}">{{$parent->title}}</a></li>
                        @endif
                        @if($childCat != " ")
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page"><a href="{{ url('/' .$main_cat->slug .'/' .$parent->slug .'/' .$child->slug )}}">{{$child->title}}</a></li>
                        @endif
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 product-title" aria-current="page"><a href="#" title="{{$product->title}}">{{$product->title}}</a></li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->
    <div class="container">
        <!-- Single Product Body -->
        <div class="mb-xl-14 mb-6">
            <div class="row">
                <div class="col-md-5 mb-4 mb-md-0">
                    @if(isset($product->uploader_image))
                        <div id="sliderSyncingNav" class="js-slick-carousel h-150 u-slick mb-2 uploader-img-slider" data-infinite="true" data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle" data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4" data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4" data-nav-for="#sliderSyncingThumb">

                        @php
                            $images = [];
                            if (isset($product->uploader_image)) {
                                $images = json_decode($product->uploader_image, true);
                                if (json_last_error() !== JSON_ERROR_NONE) {
                                    $images = explode(',', $product->uploader_image);
                                }
                            }
                        @endphp
                        
                        @if($images)
                            @foreach ($images as $image)
                                @php
                                    $multiimage = $image;
                                    $isValid = true;
                                    $extension = "";
                                    if (strpos($multiimage, 'https://') === 0) {
                                        $pathInfo = pathinfo($multiimage);
                                        $extension = strtolower($pathInfo['extension'] ?? '');
                                        if($extension != ""){
                                            if (in_array($extension, ['pdf', 'zip', 'rar'])) {
                                                $isValid = false;
                                            }
                                        }
                                        else{
                                            continue;
                                        }
                                    } 
                                    else {
                                        if (!file_exists(public_path($multiimage))) {
                                            $multiimage = '/public' . $multiimage;
                                        }
                                        else{
                                            $multiimage = '/' . $multiimage;
                                        }
                                    }
                                @endphp
                                
                                @if ($isValid)
                                    <div class="js-slide">
                                        <img class="img-fluid" src="{{$multiimage}}" alt="{{$product->title}}">
                                    </div>
                                @endif
                            @endforeach
                        @endif


                    </div>

                    <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off" data-infinite="true" data-slides-show="5" data-is-thumbs="true" data-nav-for="#sliderSyncingNav">
                        @if($images)
                            @foreach ($images as $image)
                                @php
                                    $multiimage = $image;
                                    $isValid = true;
                                    $extension = "";
                                    if (strpos($multiimage, 'https://') === 0) {
                                        $pathInfo = pathinfo($multiimage);
                                        $extension = strtolower($pathInfo['extension'] ?? '');
                                        if($extension != ""){
                                            if (in_array($extension, ['pdf', 'zip', 'rar'])) {
                                                $isValid = false;
                                            }
                                        }
                                        else{
                                            continue;
                                        }
                                    } 
                                    else {
                                        if (!file_exists(public_path($multiimage))) {
                                            $multiimage = '/public' . $multiimage;
                                        }
                                        else{
                                            $multiimage = '/' . $multiimage;
                                        }
                                    }
                                @endphp
                                
                                @if ($isValid)
                                    <div class="js-slide">
                                        <img class="img-fluid" src="{{$multiimage}}" alt="{{$product->title}}">
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    @elseif(isset($product->image))
                        @php
                            $imageUrl = $product->image;
                            if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                                if (!file_exists(public_path($imageUrl))) {
                                    $imageUrl = '/public' . $imageUrl;
                                }
                                else{
                                    $imageUrl = '/' . $imageUrl;
                                }
                            }
                        @endphp
                        <div id="sliderSyncingNav" class="js-slick-carousel h-150 u-slick mb-2 one-img-slider" data-infinite="true" data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle" data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4" data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4" data-nav-for="#sliderSyncingThumb">
                            <div class="js-slide">
                                <img class="img-fluid" src="{{$imageUrl}}" alt="{{$product->title}}">
                            </div>
                        </div>
                    @else
                        <div id="sliderSyncingNav" class="js-slick-carousel h-150 u-slick mb-2 noimage-slider" data-infinite="true" data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle" data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4" data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4" data-nav-for="#sliderSyncingThumb">
                            <div class="js-slide">
                                <img class="img-fluid" src="{{url('/frontend/background/no-image-teh.png')}}" alt="{{$product->title}}">
                            </div>
                        </div>
                    @endif
                    <div class="mt-2" id="note" style="display: none;">
                        <a class="font-size-12 font-weight-bold left-0 top-0 bg-primary-50 rounded text-white text-lh-21 px-2 mt-n4 py-2" href="javascript:void(0);">
                            <i class="fa fa-eye" aria-hidden="true"></i> {{ rand(1, 20); }} people viewed this
                        </a>
                    </div>
                </div>
                <div class="col-md-7 mb-md-6 mb-lg-0">
                    <div class="mb-2">
                        <div class="border-bottom mb-3 pb-md-1 pb-3">
                            <!-- <a href="#" class="font-size-12 text-gray-5 mb-2 d-inline-block">Headphones</a> -->
                            <h2 class="font-size-25 text-lh-1dot2">{{$product->title}}</h2>
                            <div class="mb-2">
                                <!-- <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                    <div class="text-warning mr-2">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="far fa-star text-muted"></small>
                                    </div>
                                    <span class="text-secondary font-size-13">(0 customer reviews)</span>
                                </a> -->
                            </div>
                            <div class="d-md-flex align-items-center">
                                <!-- <a href="#" class="max-width-150 ml-n2 mb-2 mb-md-0 d-block"><img class="img-fluid" src="../../frontend/assets/img/200X60/img1.png" alt="Image Description"></a> -->
                                <!-- <div class="ml-md-3 text-gray-9 font-size-14">Availability: <span class="text-green font-weight-bold">26 in stock</span></div> -->
                            </div>
                        </div>
                        @php
                        $wishlistFlag = 0;
                        foreach($wishlistitems as $items){
                        if($items->product_id == $product->id){
                        $wishlistFlag = 1;
                        }
                        }
                        @endphp

                        <div class="flex-horizontal-center flex-wrap mb-4">
                            <a data-id="{{$product->id}}" @if($wishlistFlag==1) style="pointer-events: none;color: var(--primary);" @endif href="javascript:void(0);" class="text-gray-6 font-size-13 add-to-wishlist btn-add-to-wishlist-{{$product->id}}">
                                @if($wishlistFlag == 1)
                                <i class="yith-wcwl-icon fa fa-heart"></i> Added
                                @else
                                <i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist
                                @endif
                            </a>
                            <a href="#" class="d-none text-gray-6 font-size-13 ml-2"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                        </div>
                        <div class="mb-2">
                            <ul class="font-size-14 pl-3 ml-1 text-gray-110">
                                @if(isset($product->product_code))
                                    <li><strong>Product code</strong> : {{$product->product_code}}</li>
                                @endif
                                @foreach($specificationcat as $specification)
                                    @php
                                    $specificationsForProduct = $specification->specifications->where('pro_id' , $product->id);
                                    @endphp

                                    @php $flag=0; @endphp
                                    @foreach($specificationsForProduct as $details)
                                        @if(isset($details->description) && !empty($details->description))
                                            @php $flag++; @endphp
                                            <li>{{ucwords(str_replace('_' , ' ' , $details->title))}} : {{$details->description}}</li>
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>

                        <!-- <div class="row">
                            <ul class="details">
                               
                                </ul>
                            <hr class="hr-light-gray">
                        </div> -->
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p> -->
                        {{-- <p><strong>SKU</strong>: FW511948218</p> --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-baseline">
                                <ins class="font-size-36 text-decoration-none">&pound;@if($product->price != null){{number_format($product->price_including_vat,2)}}@else 0.00 @endif <span class="font-size-12"> inc. V.A.T </span></ins>
                                <!-- <ins class="font-size-36 text-decoration-none">&pound;{{$product->vendor_price}}</ins> -->
                            </div>
                            <div>
                                <span class="font-size-14">ex. V.A.T : &pound;{{number_format($product->price ,2)}}</span>
                            </div>
                        </div>
                        <div class="border-top border-bottom py-3 mb-4 d-none">
                            <div class="d-flex align-items-center">
                                <h6 class="font-size-14 mb-0">Color</h6>
                                <!-- Select -->
                                <select class="js-select selectpicker dropdown-select ml-3" data-style="btn-sm bg-white font-weight-normal py-2 border">
                                    <option value="one" selected>White with Gold</option>
                                    <option value="two">Red</option>
                                    <option value="three">Green</option>
                                    <option value="four">Blue</option>
                                </select>
                                <!-- End Select -->
                            </div>
                        </div>
                        <div class="d-md-flex align-items-end mb-3">
                            <div class="max-width-150 mb-4 mb-md-0">
                                <h6 class="font-size-14">Quantity</h6>
                                <!-- Quantity -->
                                @php
                                    $temp = 0;
                                    $productid = $product->id;
                                    $qty = 0;
                                    $tempcartid = 0;
                                    $price = 0;
                                    
                                    if(count($cart_items) > 0){
                                        foreach($cart_items as $ci){
                                            if($ci->product_id == $product->id){
                                                $temp = 1;
                                                $qty = $ci->quantity;
                                                $tempcartid = $ci->id;
                                                $price = $ci->product_detail ? number_format($ci->product_detail->price , 2) : '';
                                            }
                                        }
                                    }
                                @endphp
                                <div class="border rounded-pill py-2 px-3 border-color-1">
                                    @if($product->id == $productid && $temp == 1)
                                    <div class="js-quantity row align-items-center">
                                        <div class="col">
                                        <input data-tempcartid="{{$tempcartid}}" data-unitprice="{{ $price }}" class="js-result cart-qty form-control h-auto border-0 rounded p-0 shadow-none cartpro-qty-{{$tempcartid}}" type="text" max="99" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2)" value="{{$qty}}">
                                        </div>
                                        <div class="col-auto pr-1">
                                            <button type="button" data-cartcheck='added' data-tempcartid="{{$tempcartid}}" class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0 btn-minus-cart btn-minus-cart-{{$tempcartid}}" href="javascript:void(0);">
                                                <small class="fas fa-minus btn-icon__inner"></small>
                                            </button>
                                            <button type="button" data-cartcheck='added' data-tempcartid="{{$tempcartid}}" class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0 btn-plus-cart" href="javascript:void(0);">
                                                <small class="fas fa-plus btn-icon__inner"></small>
                                            </button>
                                        </div>
                                    </div>
                                    @elseif($temp == 0)
                                    <div class="js-quantity row align-items-center">
                                        <div class="col">
                                            <input class="js-result cart-qty form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="1">
                                        </div>
                                        <div class="col-auto pr-1">
                                            <button type="button" data-cartcheck='notadded' class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0 btn-minus-cart" href="javascript:void(0);">
                                                <small class="fas fa-minus btn-icon__inner"></small>
                                            </button>
                                            <button type="button" data-cartcheck='notadded' class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0 btn-plus-cart" href="javascript:void(0);">
                                                <small class="fas fa-plus btn-icon__inner"></small>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <!-- End Quantity -->
                            </div>

                            <div class="ml-md-3">
                                @php
                                $hasProductInCart = false;

                                foreach($cart_items as $ci) {
                                    if($ci->product_id == $product->id) {
                                        $hasProductInCart = true;
                                        break;
                                    }
                                }
                                @endphp
                                @if($hasProductInCart)
                                <button href="javascript:void(0);" data-tempcartid="{{$tempcartid}}" data-unitprice="{{ $price }}" data-qty="1" data-id="{{ $product->id }}" class="btn-update-cart btn px-5 btn-primary-dark transition-3d-hover btn-add-cart-{{$product->id}}"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Update Cart</button>
                                @else
                                <a href="javascript:void(0);" data-qty="1" data-id="{{ $product->id }}" class="btn-add-cart cart-btn-add btn w-100 px-5 btn-primary-dark transition-3d-hover btn-add-cart-{{$product->id}}"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart</a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- End Single Product Body -->
        <!-- Single Product Tab -->
        <div class="mb-8">
            <div class="position-relative position-md-static px-md-6">
                <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                    <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link active" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">Description</a>
                    </li>
                    <!-- <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">Specification</a>
                    </li> -->
                    @php $flag = 1; @endphp
                    {{-- @if($product->pdf || $product->product_datasheet || $product->datasheet_url || $product->specific_download || $product->declaration_of_conformity_ukca
                        || $product->declaration_of_conformity_ce )
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">Download</a>
                        </li>
                    @endif --}}
                    @if($product->pdf || $product->product_datasheet || $product->datasheet_url || $product->specific_download || $product->declaration_of_conformity_ukca || $product->declaration_of_conformity_ce)
                    <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link" id="download-tab" data-toggle="pill" href="#download" role="tab" aria-controls="download" aria-selected="true">Download</a>
                    </li>
                    @endif
                    <!-- <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false">Reviews</a>
                    </li> -->
                </ul>
            </div>
            <!-- Tab Content -->
            <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                <div class="tab-content" id="Jpills-tabContent">
                    <div class="tab-pane fade active show" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                    <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                        <h3 class="section-title mb-0 pb-2 font-size-22">Product Description</h3>
                    </div>
                        <p>
                            {{$product->long_description}}
                        </p>
                        <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                            <h3 class="section-title mb-0 pb-2 font-size-22">Product Specifications</h3>
                        </div>
                        <div class="mx-md-5 pt-1">
                            @foreach($specificationcat as $specification)
                                @php
                                    $specificationsForProduct = $specification->specifications->where('pro_id', $product->id);
                                    $hasValidSpecifications = $specificationsForProduct->contains(
                                        function($details) {
                                            return isset($details->description) && !empty($details->description);
                                        });
                                @endphp

                                @if($hasValidSpecifications)
                                    <h3 class="font-size-18 mb-2 fw-600">{{ str_replace(' ', '', $specification->title) }}</h3>
                                    <div class="container mb-2">
                                        <table class="table table-striped">
                                            @foreach($specificationsForProduct as $details)
                                                @if(isset($details->description) && !empty($details->description))
                                                    <tr class="row">
                                                        <td class="col-4">{{ ucwords(str_replace('_', ' ', $details->title)) }}</td>
                                                        <td class="col-8">{{ $details->description }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </table>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>


                    <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                        <div class="mx-md-5 pt-1">
                            @foreach($specificationcat as $specification)
                                @php
                                    $specificationsForProduct = $specification->specifications->where('pro_id', $product->id);
                                @endphp
                            <h3 class="font-size-18 mb-4">{{ str_replace(' ', '', $specification->title) }}</h3>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        @php
                                            $flag=0;
                                        @endphp

                                        @foreach($specificationsForProduct as $details)
                                            @if(isset($details->description) && !empty($details->description))
                                                @php
                                                    $flag++; 
                                                @endphp
                                                <tr>
                                                    <th class="px-4 px-xl-5 border-top-0">{{ucwords(str_replace('_' , ' ' , $details->title))}}</th>
                                                    <td class="border-top-0">{{$details->description}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @if($flag == 0)
                    <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                        <div class="mx-md-5 pt-1">
                            <div class="table-responsive mb-4">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th class="px-4 px-xl-5 border-top-0">No Specification</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                        <div class="row mb-8">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h3 class="font-size-18 mb-6">Based on 3 reviews</h3>
                                    <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0">4.3</h2>
                                    <div class="text-lh-1">overall</div>
                                </div>

                                <!-- Ratings -->
                                <ul class="list-unstyled">
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">205</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 53%;" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">55</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">23</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-muted">0</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 1%;" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">4</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <!-- End Ratings -->
                            </div>
                            <div class="col-md-6">
                                <h3 class="font-size-18 mb-5">Add a review</h3>
                                <!-- Form -->
                                <form class="js-validate">
                                    <div class="row align-items-center mb-4">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="rating" class="form-label mb-0">Your Review</label>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <a href="#" class="d-block">
                                                <div class="text-warning text-ls-n2 font-size-16">
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="js-form-message form-group mb-3 row">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="descriptionTextarea" class="form-label">Your Review</label>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" rows="3" id="descriptionTextarea" data-msg="Please enter your message." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                                        </div>
                                    </div>
                                    <div class="js-form-message form-group mb-3 row">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="inputName" class="form-label">Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" name="name" id="inputName" aria-label="Alex Hecker" required data-msg="Please enter your name." data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <div class="js-form-message form-group mb-3 row">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="emailAddress" class="form-label">Email <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="email" class="form-control" name="emailAddress" id="emailAddress" aria-label="alexhecker@pixeel.com" required data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="offset-md-4 offset-lg-3 col-auto">
                                            <button type="submit" class="btn btn-primary-dark btn-wide transition-3d-hover">Add Review</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                        <!-- Review -->
                        <div class="border-bottom border-color-1 pb-4 mb-4">
                            <!-- Review Rating -->
                            <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="far fa-star text-muted"></small>
                                    <small class="far fa-star text-muted"></small>
                                </div>
                            </div>
                            <!-- End Review Rating -->

                            <p class="text-gray-90">Fusce vitae nibh mi. Integer posuere, libero et ullamcorper facilisis, enim eros tincidunt orci, eget vestibulum sapien nisi ut leo. Cras finibus vel est ut mollis. Donec luctus condimentum ante et euismod.</p>

                            <!-- Reviewer -->
                            <div class="mb-2">
                                <strong>John Doe</strong>
                                <span class="font-size-13 text-gray-23">- April 3, 2019</span>
                            </div>
                            <!-- End Reviewer -->
                        </div>
                        <!-- End Review -->
                        <!-- Review -->
                        <div class="border-bottom border-color-1 pb-4 mb-4">
                            <!-- Review Rating -->
                            <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                </div>
                            </div>
                            <!-- End Review Rating -->

                            <p class="text-gray-90">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse eget facilisis odio. Duis sodales augue eu tincidunt faucibus. Etiam justo ligula, placerat ac augue id, volutpat porta dui.</p>

                            <!-- Reviewer -->
                            <div class="mb-2">
                                <strong>Anna Kowalsky</strong>
                                <span class="font-size-13 text-gray-23">- April 3, 2019</span>
                            </div>
                            <!-- End Reviewer -->
                        </div>
                        <!-- End Review -->
                        <!-- Review -->
                        <div class="pb-4">
                            <!-- Review Rating -->
                            <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="fas fa-star"></small>
                                    <small class="far fa-star text-muted"></small>
                                </div>
                            </div>
                            <!-- End Review Rating -->

                            <p class="text-gray-90">Sed id tincidunt sapien. Pellentesque cursus accumsan tellus, nec ultricies nulla sollicitudin eget. Donec feugiat orci vestibulum porttitor sagittis.</p>

                            <!-- Reviewer -->
                            <div class="mb-2">
                                <strong>Peter Wargner</strong>
                                <span class="font-size-13 text-gray-23">- April 3, 2019</span>
                            </div>
                            <!-- End Reviewer -->
                        </div>
                        <!-- End Review -->
                    </div>
                    <div class="tab-pane fade" id="download" role="tabpanel" aria-labelledby="download-tab">
                        <div class="mx-md-5 pt-1">
                            <div class="table-responsive mb-4">
                                <div class="download-section">
                                    @if(isset($product->pdf) && $product->pdf != '')
                                    <div class="pdf">
                                        <a href="/{{ $product->pdf }}" target="_blank" style="text-decoration: none;">PDF</a>
                                    </div>
                                    @endif
                                    {{-- @if(isset($product->product_datasheet) && $product->product_datasheet != '')
                                    <div class="pdf">
                                        <a href="{{ $product->product_datasheet }}" target="_blank" style="text-decoration: none;">Product Datasheet</a>
                                </div>
                                @endif --}}
                                @if(isset($product->datasheet_url) && $product->datasheet_url != '')
                                <div class="pdf">
                                    <a href="/{{ $product->datasheet_url }}" target="_blank" style="text-decoration: none;">Datasheet URL</a>
                                </div>
                                @endif
                                @if(isset($product->specific_download) && $product->specific_download != '')
                                <div class="pdf">
                                    <a href="/{{ $product->specific_download }}" target="_blank" style="text-decoration: none;">Specific Download</a>
                                </div>
                                @endif
                                @if(isset($product->declaration_of_conformity_ukca) && $product->declaration_of_conformity_ukca != '')
                                <div class="pdf">
                                    <a href="/{{ $product->declaration_of_conformity_ukca }}" target="_blank" style="text-decoration: none;">Declaration of Conformity UKCA</a>
                                </div>
                                @endif
                                @if(isset($product->declaration_of_conformity_ce) && $product->declaration_of_conformity_ce != '')
                                <div class="pdf">
                                    <a href="{{ $product->declaration_of_conformity_ce }}" target="_blank" style="text-decoration: none;">Declaration of Conformity CE</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tab Content -->
    </div>
    <!-- End Single Product Tab -->
    <!-- Related products -->
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
            <h3 class="section-title mb-0 pb-2 font-size-22">Related products</h3>
        </div>
        <div class="js-slick-carousel position-static u-slick overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1 h-350" data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-6 pt-1" data-arrows-classes="d-none u-slick__arrow-normal u-slick__arrow-centered--y font-size-25" data-arrow-left-classes="fas fa-chevron-left left-n16 u-slick__arrow-classic-inner--left z-index-9" data-arrow-right-classes="fas fa-chevron-right right-n16 u-slick__arrow-classic-inner--right" data-slides-show="6" data-slides-scroll="1" data-responsive='[{
                "breakpoint": 1500,
                "settings": {
                    "slidesToShow": 6
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
            @foreach ($randomProducts as $product)
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
    <!-- End Related products -->

    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.btn-plus-cart').click(function() {
            var cartcheck = $(this).data('cartcheck');
            var tempcartid = $(this).data('tempcartid');
            if (cartcheck == "added") {
                var qty = $(".cartpro-qty-" + tempcartid).val();
                $(".btn-minus-cart-" + tempcartid).removeAttr('disabled');
                var unitprice = $(".cartpro-qty-" + tempcartid).data('unitprice');
                qty = parseInt(qty) + 1;
                $(".cartpro-qty-" + tempcartid).val(qty);
                var subtotal = parseFloat($("#pro-cart-total-" + tempcartid).val());
                subtotal = unitprice * qty;
                $("#pro-cart-total-" + tempcartid).val(parseFloat(subtotal).toFixed(2));
                $(".pro-cart-total-" + tempcartid).html("&pound;" + parseFloat(subtotal).toFixed(2));

                // $.ajax({
                //     url: '/product/update-cart-qtty',
                //     type: 'POST',
                //     data: {
                //         tempcartid: tempcartid,
                //         qtty: qty,
                //         unitprice: unitprice
                //     },
                //     success: function(response) {
                //         setTimeout(() => {
                //             var link = '/get-cart/list';
                //             $.get(link, function(res) {
                //                 if (res['status'] == 'success') {
                //                     $(".total-qty").html(res['data'].length);
                //                     $(".total-cart-price").html('&pound;' + res['totalCartPrice']);
                //                     $('.subtotal-amount').html('&pound;' + res['totalCartPrice']);
                //                     $('.total-amount').html('&pound;' + res['totalCartPrice']);
                //                 }
                //             });
                //         }, 100);
                //     }
                // });
            } 
            else {
                // console.log('Else condition');
                var qty = $(".cart-qty").val();
                qty = parseInt(qty) + 1;
                $(".cart-qty").val(qty);
                $(".btn-add-cart").attr('data-qty', qty);
                $(".btn-minus-cart").removeAttr('disabled');
            }

        });

        $('.btn-minus-cart').click(function() {
            var cartcheck = $(this).data('cartcheck');
            var tempcartid = $(this).data('tempcartid');
            if (cartcheck == "added") {
                var qty = $(".cartpro-qty-" + tempcartid).val();
                var unitprice = $(".cartpro-qty-" + tempcartid).data('unitprice');
                if (qty > 1) {
                    qty = parseInt(qty) - 1;
                    $(".cartpro-qty-" + tempcartid).val(qty);
                    var subtotal = parseFloat($("#pro-cart-total-" + tempcartid).val());
                    subtotal = unitprice * qty;
                    $("#pro-cart-total-" + tempcartid).val(parseFloat(subtotal).toFixed(2));
                    $(".pro-cart-total-" + tempcartid).html("&pound;" + parseFloat(subtotal).toFixed(2));

                    // $.ajax({
                    //     url: '/product/update-cart-qtty',
                    //     type: 'POST',
                    //     data: {
                    //         tempcartid: tempcartid,
                    //         qtty: qty,
                    //         unitprice: unitprice
                    //     },
                    //     success: function(response) {
                    //         setTimeout(() => {
                    //             var link = '/get-cart/list';
                    //             $.get(link, function(res) {
                    //                 if (res['status'] == 'success') {
                    //                     $(".total-qty").html(res['data'].length);
                    //                     $(".total-cart-price").html('&pound;' + res['totalCartPrice']);
                    //                     $('.subtotal-amount').html('&pound;' + res['totalCartPrice']);
                    //                     $('.total-amount').html('&pound;' + res['totalCartPrice']);
                    //                 }
                    //             });
                    //         }, 100);
                    //     }
                    // });
                } else {
                    $('.btn-minus-cart').attr('disabled', 'disabled');
                }
            } else {
                var qty = $(".cart-qty").val();
                if (qty > 1) {
                    qty = parseInt(qty) - 1;
                    $(".cart-qty").val(qty);
                    $(".btn-add-cart").attr('data-qty', qty);
                } else {
                    $('.btn-minus-cart').attr('disabled', 'disabled');
                }
            }
        });

        // $(".cart-qty").on('blur', function() {
        //     var tempcartid = $(this).data('tempcartid');
        //     var unitprice = $(".cartpro-qty-" + tempcartid).data('unitprice');
        //     var qty = $(this).val();
        //     $.ajax({
        //         url: '/product/update-cart-qtty',
        //         type: 'POST',
        //         data: {
        //             tempcartid: tempcartid,
        //             qtty: qty,
        //             unitprice: unitprice
        //         },
        //         success: function(response) {
        //             setTimeout(() => {
        //                 var link = '/get-cart/list';
        //                 $.get(link, function(res) {
        //                     if (res['status'] == 'success') {
        //                         $(".total-qty").html(res['data'].length);
        //                         $(".total-cart-price").html('&pound;' + res['totalCartPrice']);
        //                         $('.subtotal-amount').html('&pound;' + res['totalCartPrice']);
        //                         $('.total-amount').html('&pound;' + res['totalCartPrice']);
        //                     }
        //                 });
        //             }, 100);
        //         }
        //     });
        // });

        $(".cart-btn-add").click(function() {
            setTimeout(function() {
                location.reload();
            }, 3000);
        });

        setTimeout(() => {
            $("#note").removeAttr('style');

        },3000);
        
        const Toast = Swal.mixin({
            toast: true,
            position: "bottom",
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        $('.btn-update-cart').click(function () { 
            var tempcartid = $(this).data('tempcartid');
            var unitprice = $(".cartpro-qty-" + tempcartid).data('unitprice');
            var qty = $('.cart-qty').val();
            $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
            $(this).attr("disabled", "disabled");
            $.ajax({
                url: '/product/update-cart-qtty',
                type: 'POST',
                data: {
                    tempcartid: tempcartid,
                    qtty: qty,
                    unitprice: unitprice
                },
                success: function(response) {
                    setTimeout(() => {
                        Toast.fire({
                            icon: "success",
                            title: response.message
                        });
                        $(".btn-update-cart").html("<i class='ec ec-add-to-cart'> </i> Update Cart ");
                        $(".btn-update-cart").attr('data-qty', response.qty);
                        $(".total-qty").html(response.cartcount);
                        var link = '/get-cart/list';
                        $.get(link, function(res) {
                            if (res['status'] == 'success') {
                                
                                $(".total-qty").html(res['data'].length);
                                $(".total-cart-price").html('&pound;' + res['totalCartPrice']);
                                $('.subtotal-amount').html('&pound;' + res['totalCartPrice']);
                                $('.total-amount').html('&pound;' + res['totalCartPrice']);
                            }

                        });
                    }, 100);
                    $(".btn-update-cart").removeAttr("disabled");

                }
            });
        });
    });
</script>
@endsection
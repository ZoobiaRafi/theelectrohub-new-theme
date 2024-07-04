@extends ('frontend.layout.master')
@section('title')
Payment Successful | The Electrohub
@endsection

@section('meta')
@endsection

@section('css')
<link as="style" rel="stylesheet preload prefetch preconnect" type="text/css" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css" onload="this.onload=null;this.rel='stylesheet'">
<style>
    .u-slick__arrow-classic-inner:before {
        color: var(--primary);
    }

    @media (min-width: 768px) {
        .recipt {
            padding-bottom: 30px;
            padding-top: 250px;
        }

        .u-header--white-nav-links-md:not(.bg-white):not(.js-header-fix-moment) .u-header__nav-link {
            color: #333e48 !important;
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

    }

    @media (max-width: 600px) {
        .recipt {
            padding-bottom: 30px;
            padding-top: 80px !important;
        }

        .product_name {
            font-size: 0.875rem;
        }
    }

    .description-img img {
        height: 300px;
    }

    .order_details {
        background: white;
        border-radius: 10px;
        padding:15px;
    }

    .recipt_col {
        background: #333e4812;
        padding:15px;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .fa-circle-check {
        font-size: 50px;
    }

    .product_name {
        color: var(--primary);
        text-transform: uppercase;
        font-size: 0.8rem !important;
    }

    .col-5 {
        text-align: right;
    }

    hr {
        /* border: 1px solid #3838384d; */
    }
</style>
@endsection

@section('content')
<main id="content" role="main">
    <div class="container">
        <div class="recipt">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                        <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-3"></div> -->
                        <div class="recipt_col" style="/* margin-bottom: 2%; margin-top: 2%; */">
                            <div class="order_details">
                                <div class="logo d-flex flex-column justify-content-center align-items-center">
                                    <i class="fa-solid fa-circle-check" style="color:green;"></i>
                                    <hr class="w-100">
                                    <h5>Thank you for your order</h5>
                                    <hr class="w-100">
                                </div>
                                <div class="summary">
                                    <div class="row">
                                        <div class="col-7">
                                            <p class="pb-0 mb-0"><b>Date</b></p>
                                            <p class="pb-0 mb-0"><b>Order ID</b></p>
                                        </div>
                                        <div class="col-5">
                                            <p class="pb-0 mb-0">{{date('d-m-Y')}}</p>
                                            <p class="pb-0 mb-0">{{$order->order_no}}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr class="w-100">
                                <div class="summary">
                                    <div class="row">
                                        <div class="col">
                                            <p class="pb-0 mb-0"><b>Product Summary</b></p>
                                            @php
                                            $price = 0;
                                            $subtotal = 0;
                                            @endphp
                                            @foreach($orderProducts as $orderproduct)
                                            <div class="row pb-2">
                                                <div class="col-7">
                                                    <p class="pb-0 mb-0 product_name">
                                                        {{$orderproduct->product_detail->title}}
                                                        <span style="color:green; font-size:12px;"> x {{$orderproduct->quantity}} </span>
                                                    </p>
                                                </div>
                                                <div class="col-5">
                                                    <p class="pb-0 mb-0" style="color: #000000;text-transform: uppercase; font-size:1rem !important;">
                                                    @php
                                                        $price = $orderproduct->price * $orderproduct->quantity;
                                                        $subtotal += $orderproduct->price * $orderproduct->quantity;
                                                    @endphp    
                                                    £{{number_format($price , 2)}}
                                                    </p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <hr class="w-100">
                                <div class="summary">
                                    <div class="row">
                                        <div class="col-7">
                                            <h6> <b>Sub Total</b></h6>
                                        </div>
                                        <div class="col-5">
                                            <h6> <b>£{{ number_format($subtotal , 2) }}</b></h6>
                                        </div>
                                    </div>
                                    <!-- <hr class="w-100" style="margin-top: 5%;"> -->
                                </div>

                                @if( $order->order_discount > 0)
                                    <div class="summary">
                                        <div class="row">
                                            <div class="col-7">
                                                <h6 class="text-primary"> <b>Discount</b></h6>
                                            </div>
                                            <div class="col-5">
                                                <h6 class="text-primary"> <b>-£{{number_format($order->order_discount , 2)}}</b></h6>
                                            </div>
                                        </div>
                                        <!-- <hr class="w-100" style="margin-top: 5%;"> -->
                                    </div>
                                @endif
                                {{--@if($subtotal <= setting('site.vat'))
                                    @php 
                                        $vattotal = 0;
                                        $vattotal = ($subtotal + floatval($order->order_discount)) * 0.2;
                                    @endphp
                                    <div class="summary">
                                        <div class="row">
                                            <div class="col-7">
                                                <h6> <b>VAT</b></h6>
                                            </div>
                                            <div class="col-5">
                                                <h6> <b>£{{number_format($vattotal , 2)}}</b></h6>
                                            </div>
                                        </div>
                                        <!-- <hr class="w-100" style="margin-top: 5%;"> -->
                                    </div>
                                @endif--}}

                                

                                <div class="summary">
                                    <div class="row">
                                        @if( $order->shipping_total <= 0)
                                            <div class="col-7">
                                                <h6> <b>Delivery Charges</b></h6>
                                            </div>
                                            <div class="col-5">
                                                <h6 class="text-primary"> <b>Free</b></h6>
                                            </div>
                                        @else
                                            <div class="col-7">
                                                <h6> <b>Delivery Charges</b></h6>
                                            </div>
                                            <div class="col-5">
                                                <h6> <b>£{{number_format($order->shipping_total , 2)}}</b></h6>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- <hr class="w-100" style="margin-top: 5%;"> -->
                                </div>

                                <div class="summary">
                                    <div class="row">
                                        <div class="col-7">
                                            <h6> <b>Total</b></h6>
                                        </div>
                                        <div class="col-5">
                                            <h6> <b>£{{number_format($order->order_total , 2)}}</b></h6>
                                        </div>
                                    </div>
                                    <!-- <hr class="w-100" style="margin-top: 5%;"> -->
                                </div>
                                <div class="customer_info">
                                    <div class="row">
                                        <div class="col">
                                            <!-- <h6><u>Customer Details</u></h6>
                                            <p class="pb-0 mb-0">{{$order->name}}</p>
                                            <a>{{$order->email}}</a><br>
                                            <p class="pb-0 mb-0">Payment Method: {{$order->payment_gateway}}</p> -->
                                            <small><b>Note: Copy of reciept has been sent to your registered email
                                                    address.</b></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-3"></div> -->
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2462.4696520671127!2d-0.4410210850017963!3d51.8888927905599!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487649e3c9e87c25%3A0x99c4b5d131965ad7!2sOPTIMIZED%20BODY%20%26%20MIND!5e0!3m2!1sen!2s!4v1680256247343!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
@endsection
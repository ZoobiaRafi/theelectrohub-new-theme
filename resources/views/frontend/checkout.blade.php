@extends ('frontend.layout.master')
@section('title')
Checkout | The Electrohub
@endsection

@section('meta')
@endsection

@section('css')
<script src="https://js.stripe.com/v3/"></script>
<style>
    .u-slick__arrow-classic-inner:before {
        color: var(--primary);
    }

    .custom-tbody-scroll {
        width: calc(100% + 65px);
        display: block;
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 20px;
    }

    .custom-tbody-scroll::-webkit-scrollbar {
        width: 5px;
    }

    .custom-tbody-scroll::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.31)
    }

    .custom-tbody-scroll::-webkit-scrollbar-track {
        background-color: rgba(0, 0, 0, 0.114)
    }

    @media (min-width: 768px) {
        .u-header--white-nav-links-md:not(.bg-white):not(.js-header-fix-moment) .u-header__nav-link {
            color: #333e48 !important;
        }
    }

    .description-img img {
        height: 300px;
    }

    .t-and-C {
        text-transform: none;
        font-weight: 500;
    }
    .t-and-C .fw-800{
        font-weight: 800;
    }

    #shopCartHeadingOne {
        color: #fff;
    }

    #shopCartHeadingOne a {
        color: #fff;
    }
    .icons .icon i{
        overflow: hidden;
        object-fit: contain;
    }
    .icons .icon i img{
        height: 55px;
        width: 65px;
        object-fit: contain;
    }
    @media (max-width: 600px) {
        .order-2 {
            order: 1 !important;
        }

        .order-1 {
            order: 2 !important;
        }
    }
</style>
@endsection

@section('content')
<main id="content" role="main" class="cart-page">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent pt-20">
        {{-- <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('homePage')}}">Home</a></li>
        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Cart</li>
        </ol>
        </nav>
    </div>
    <!-- End breadcrumb -->
    </div> --}}
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">Checkout</h1>
        </div>

        <div class="alert alert-warning alert-dismissible fade show" style="display: none;" role="alert">
            <span class="alert-text-warning"><strong>Holy guacamole!</strong> You should check in on some of those fields below.</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @if(!Auth::check())
        <!-- Accordion -->
        <div id="shopCartAccordion" class="accordion rounded mb-5">
            <!-- Card -->
            <div class="card border-0">
                <div id="shopCartHeadingOne" class="alert alert-primary mb-0" role="alert">
                    Returning customer? <a href="#" class="alert-link" data-toggle="collapse" data-target="#shopCartOne" aria-expanded="false" aria-controls="shopCartOne">Click here to login</a>
                </div>
                <br>

                <div class="alert alert-success alert-dismissible fade show" style="display: none;" role="alert">
                    <span class="alert-text-success"><strong>Holy guacamole!</strong> You should check in on some of those fields below.</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="shopCartOne" class="collapse border border-top-0" aria-labelledby="shopCartHeadingOne" data-parent="#shopCartAccordion">
                    <!-- Form -->
                    <form class="js-validate p-5">
                        <!-- Title -->
                        <div class="mb-5">
                            <p class="text-gray-90 mb-2">Welcome back! Sign in to your account.</p>
                            <p class="text-gray-90">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing & Shipping section.</p>
                        </div>
                        <!-- End Title -->

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="form-label" for="signinSrEmailExample3">Email address</label>
                                    <input type="email" id="login-email" class="form-control" name="email" id="signinSrEmailExample3" placeholder="Email address" aria-label="Email address" required data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Form Group -->
                            </div>
                            <div class="col-lg-6">
                                <!-- Form Group -->
                                <div class="js-form-message form-group">
                                    <label class="form-label" for="signinSrPasswordExample2">Password</label>
                                    <input type="password" id="login-password" class="form-control" name="password" id="signinSrPasswordExample2" placeholder="********" aria-label="********" required data-msg="Your password is invalid. Please try again." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Form Group -->
                            </div>
                        </div>

                        <!-- Checkbox -->
                        <div class="js-form-message mb-3">
                            <div class="custom-control custom-checkbox d-flex align-items-center">
                                <input type="checkbox" class="custom-control-input" id="rememberCheckbox" name="rememberCheckbox" required data-error-class="u-has-error" data-success-class="u-has-success">
                                <label class="custom-control-label form-label" for="rememberCheckbox">
                                    Remember me
                                </label>
                            </div>
                        </div>
                        <!-- End Checkbox -->

                        <!-- Button -->
                        <div class="mb-1">
                            <div class="mb-3">
                                <button type="button" class="btn text-white btn-primary-dark-w px-5 btn-login-checkout">Login</button>
                            </div>
                            <div class="mb-2">
                                <a class="text-blue" href="#">Lost your password?</a>
                            </div>
                        </div>
                        <!-- End Button -->
                    </form>
                    <!-- End Form -->
                </div>
            </div>
            <!-- End Card -->
        </div>
        @endif
        <!-- End Accordion -->

        <form class="js-validate" novalidate="novalidate">
            <div class="row">
                <div class="col-lg-5 order-1 mb-7 mb-lg-0">
                    <div class="pl-lg-3 ">
                        <div class="bg-gray-1 rounded-lg">
                            <!-- Order Summary -->
                            <div class="p-4 mb-4 checkout-table">
                                <!-- Title -->
                                <div class="border-bottom border-color-1 mb-5">
                                    <h3 class="section-title mb-0 pb-2 font-size-25">Your order</h3>
                                </div>
                                <!-- End Title -->

                                <!-- Product Content -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody @if($cart_items->count() >= 5 )class="custom-tbody-scroll" @endif >
                                        @php
                                            $subtotal = 0;
                                        @endphp
                                        @foreach($cart_items as $ci)
                                            <tr class="cart_item">
                                                <td class="">{{ $ci->product_detail ? ucwords($ci->product_detail->title) : '' }}&nbsp;<strong class="product-quantity">×{{ $ci->quantity }}</strong></td>
                                                <td class="text-right">&pound;{{ $ci->product_detail ? number_format($ci->product_detail->price_including_vat * $ci->quantity, 2) : '' }}</td>
                                            </tr>
                                            @php
                                                $subtotal += $ci->price_including_vat * $ci->quantity;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td class="text-right" id="order-subtotal">&pound;{{ number_format($cartTotal , 2) }}</td>
                                        </tr>
                                        <tr id="code-discount" style="display:none;">
                                            <th class="text-primary">Coupon Discount</th>
                                            <td class="text-right text-primary" style="white-space: nowrap;" id="discount-applied"></td>
                                            <input type="hidden" id="discount-value" value="0">
                                            <input type="hidden" id="cart-subtotal" value="{{number_format($cartTotal , 2)}}">
                                        </tr>
                                        <!-- <tr>
                                            <th>VAT</th>
                                            <td id="order-vat" class="text-right">&pound;{{ number_format($vat , 2) }}</td>
                                        </tr> -->
                                        @if($shippingCharges > 0)
                                        <tr>
                                            <th>Delivery Charges</th>
                                            <td class="text-right">&pound;{{ number_format(setting('site.delivery-charges') , 2) }}</td>
                                            <input type="hidden" id="shipping-charges" value="{{ number_format(setting('site.delivery-charges') , 2) }}">
                                        </tr>
                                        @else
                                        <tr>
                                            <th class="text-primary">Delivery Charges</th>
                                            <td class="text-right text-primary">Free</td>
                                            <input type="hidden" id="shipping-charges" value="0.00">
                                        </tr>
                                        @endif
                                        
                                        
                                        
                                        <tr>
                                            <th>Total</th>
                                            <td class="text-right" id="order-grand-total"><strong>&pound;{{ number_format($grandTotal , 2) }}</strong></td>
                                            <input type="hidden" id="grand-total" value="{{ number_format($grandTotal , 2) }}">
                                        </tr>
                                    </tfoot>
                                </table>

                                <!-- coupon code -->
                                <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                    <div class="border-bottom border-color-1 mb-2">
                                        <h3 class="section-title mb-0 pb-2 font-size-25">Coupon Code</h3>
                                    </div>
                                    <div class="media-body text-left text-info-new pb-2">
                                        <div class=" text-secondary feature-tag "><span class="text-danger">*</span>Got a coupon code, get ready for some serious discounts. Drop your code and turn up the savings! </div>
                                    </div>
                                    <!-- Apply coupon Form -->
                                    <form class="js-focus-state">
                                        <label class="sr-only" for="coupon-input">Coupon code</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="text" id="coupon-input" placeholder="Coupon code" aria-label="Coupon code" aria-describedby="btn-add-coupon" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-block btn-dark px-4" type="button" id="btn-add-coupon">
                                                    <i class="fas fa-tags d-md-none"></i><span class="d-none d-md-inline">Apply coupon</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- End Apply coupon Form -->
                                </div>
                                <!-- coupon code -->

                                <!-- payment-div -->
                                <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                    <div class="border-bottom border-color-1 mb-2">
                                        <h3 class="section-title mb-0 pb-2 font-size-25">Online Payment</h3>
                                    </div>
                                    <div class="icons d-flex align-items-center justify-content-center">
                                        <div class="icon">
                                            <i><img src="{{url('frontend/assets/img/mastercard-1.svg')}}" alt="mastercard"></i>
                                        </div>
                                        <div class="icon">
                                            <i><img src="{{url('frontend/assets/img/visa-1.svg')}}" alt="visa"></i>
                                        </div>
                                        <div class="icon">
                                            <i><img src="{{url('frontend/assets/img/google-pay-1.svg')}}" alt="g-pay"></i>
                                        </div>
                                        <div class="icon">
                                            <i><img src="{{url('frontend/assets/img/apple-pay-1.svg')}}" alt="apple-pay"></i>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <!-- Form Group -->
                                                <div class="js-form-message form-group">
                                                    <label class="form-label" for="signinSrEmailExample3">Card Number</label>
                                                    <input type="text" id="card-number" class="form-control" name="email" id="signinSrEmailExample3" placeholder="4444-4444-4444-4444" aria-label="Card Number" required data-msg="Please enter a valid card number." data-error-class="u-has-error" data-success-class="u-has-success">
                                                </div>
                                                <!-- End Form Group -->
                                            </div>
                                            <div class="col-lg-6">
                                                <!-- Form Group -->
                                                <div class="js-form-message form-group">
                                                    <label class="form-label" for="signinSrEmailExample3">Expiry Date</label>
                                                    <input type="text" id="expiry-date" class="form-control" name="email" id="signinSrEmailExample3" placeholder="MM/YY" aria-label="Expiry Date" required data-msg="Please enter a valid expiry date." data-error-class="u-has-error" data-success-class="u-has-success">
                                                </div>
                                                <!-- End Form Group -->
                                            </div>

                                            <div class="col-lg-6">
                                                <!-- Form Group -->
                                                <div class="js-form-message form-group">
                                                    <label class="form-label" for="signinSrEmailExample3">CVV</label>
                                                    <input type="text" id="cvv" class="form-control" name="email" id="signinSrEmailExample3" placeholder="000" aria-label="Enter CVV" required data-msg="Please enter a valid cvv code." data-error-class="u-has-error" data-success-class="u-has-success">
                                                </div>
                                                <!-- End Form Group -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- payment-div -->

                                <!-- End Product Content -->

                                <div class="form-group d-flex align-items-center justify-content-between px-3 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="terms-and-conditions" required data-msg="Please agree terms and conditions." data-error-class="u-has-error" data-success-class="u-has-success">
                                        <label class="form-check-label t-and-C form-label" for="defaultCheck10">
                                            I have read and agree to the website <a href="{{route('content',['slug' => 'terms-and-conditions'])}}" class="text-blue fw-800">terms and conditions </a>
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary-dark-w text-white btn-block btn-pill font-size-20 mb-3 py-3 btn-order-submit">Place Order</button>
                            </div>
                            <!-- End Order Summary -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 order-2">
                    <div class="pb-1 mb-1">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-2">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Billing details</h3>
                        </div>
                        <!-- End Title -->

                        <div class="box bb-n50dash mb-2 quick-pay-box">
                            <div id="express-checkout-element"></div>
                            <div id="error-message"></div>
                        </div>

                        <!-- Billing Form -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Full Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input @if(Auth::check()) disabled value="{{ Auth::user()->name }}" @endif type="text" id="fullname" class="form-control" name="firstName" placeholder="Full name" aria-label="Full name" required="" data-msg="Please enter your full name." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Email address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input @if(Auth::check()) disabled value="{{ Auth::user()->email }}" @endif id="emailaddress" type="email" class="form-control" id="emailaddress" name="emailAddress" placeholder="Email address" aria-label="Email address" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Phone
                                        <span class="text-danger">*</span>
                                    </label>
                                    @if(Auth::check())
                                        @if(Auth::user()->contact_no != null)
                                            <input  disabled value="{{ Auth::user()->contact_no }}" id="phone" type="text" class="form-control" placeholder="Phone number" aria-label="Phone number" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success" required>
                                        @else
                                            <input   id="phone" type="text" class="form-control" placeholder="Phone number" aria-label="Phone number" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success" required>
                                        @endif
                                    @else
                                    <input  id="phone" type="text" class="form-control" placeholder="Phone number" aria-label="Phone number" data-msg="Please enter your last name." data-error-class="u-has-error" data-success-class="u-has-success" required>
                                    @endif
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Street address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input @if(Auth::check()) value="{{ Auth::user()->address }}" @endif type="text" class="form-control" id="streetaddress" name="streetAddress" placeholder="Street address" aria-label="Street address" required="" data-msg="Please enter a valid address." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="w-100"></div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        City
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input @if(Auth::check()) value="{{ Auth::user()->city }}" @endif type="text" class="form-control" id="city" name="cityAddress" placeholder="City" aria-label="City" required="" data-msg="Please enter a valid address." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Postcode
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input @if(Auth::check()) value="{{ Auth::user()->postcode }}" @endif type="text" class="form-control" id="postcode" name="postcode" placeholder="Post code" aria-label="Post code" required="" data-msg="Please enter a postcode or zip code." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="w-100"></div>

                            <div class="col-md-12 d-none">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        State
                                        <span class="text-danger">*</span>
                                    </label>
                                    @if(Auth::check())
                                        <input @if(Auth::user()->state) value="{{ Auth::user()->state }}" @else value="UK" @endif type="hidden" class="form-control" id="state" name="state" placeholder="State" aria-label="State" required="" data-msg="Please enter a state." data-error-class="u-has-error" data-success-class="u-has-success">
                                    @else
                                        <input value="UK" type="hidden" class="form-control" id="state" name="state" placeholder="State" aria-label="State" required="" data-msg="Please enter a state." data-error-class="u-has-error" data-success-class="u-has-success">
                                    @endif
                                </div>
                                <!-- End Input -->
                            </div>
                            

                            <div class="w-100"></div>
                        </div>
                        <!-- End Billing Form -->

                        <!-- Accordion -->
                        <div id="shopCartAccordion2" class="accordion rounded mb-6">
                            <!-- Card -->
                            <div class="card border-0">
                                @if(!Auth::check())
                                <div id="shopCartHeadingThree" class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="createAnaccount" name="createAnaccount">
                                    <label class="custom-control-label form-label" for="createAnaccount" data-toggle="collapse" data-target="#shopCartThree" aria-expanded="false" aria-controls="shopCartThree">
                                        Create an account?
                                    </label>
                                </div>
                                @endif
                                <div id="shopCartThree" class="collapse" aria-labelledby="shopCartHeadingThree" data-parent="#shopCartAccordion2">
                                    <!-- Form Group -->
                                    <div class="js-form-message form-group py-3">
                                        <label class="form-label" for="#password">
                                            Create account password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6  py-3">
                                                <input type="password" class="form-control" name="password" id="signup-password" placeholder="Enter Password" aria-label="Enter Password" required data-msg="Enter password." data-error-class="u-has-error" data-success-class="u-has-success">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-lg-6  py-3">
                                                <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm Password" aria-label="Confirm Password" required data-msg="Confifrm password." data-error-class="u-has-error" data-success-class="u-has-success">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Accordion -->
                        <!-- Title -->

                        <!-- End Title -->
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Order notes (optional)
                            </label>

                            <div class="input-group">
                                <textarea id="order-notes" class="form-control p-5" rows="4" name="text" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                        <input type="hidden" id="oid">
                        <!-- End Input -->
                    </div>
                </div>
            </div>
            <div class="note border-1">
                <div class="ticker-item py-3 px-5 mb-5">
                    <div class="row">
                        <!-- <div class="u-avatar">
                            <i class="text-primary ec ec-transport font-size-30"></i>
                        </div> -->
                        <div class="media-body text-left text-info-new">
                            <div class=" text-secondary feature-tag"><span class="text-danger">*</span>Subject to availability, Place your order before 3pm to receive it the next day!</div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script type="text/javascript">
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    function createquickpay(){
        var stripeKey = "<?php echo (setting('stripe.status') == '1') ? setting('stripe.publishablelivekey') : setting('stripe.publishabletestkey') ?>";
        const stripe = Stripe(stripeKey);
        var amount = $('#grand-total').val().replace(',', '');
        var amountInPence = Math.round(parseFloat(amount) * 100);
        const options = {
            mode: 'payment',
            amount: amountInPence,
            currency: 'gbp',
        };
        
        const elements = stripe.elements(options);
        const expressCheckoutElement = elements.create('expressCheckout');
        expressCheckoutElement.mount('#express-checkout-element');

        expressCheckoutElement.on('click', function(event) {
            var name = $("#fullname").val();
            var email = $("#emailaddress").val();
            var phone = $("#phone").val();
            var discount = $("#discount-value").val();


            if(name === "" || email === "" || phone === "") {
                if(name === "") {
                    $(".alert-text-warning").html("Please enter a name to continue");
                } else if(email === "") {
                    $(".alert-text-warning").html("Please enter an email address to continue");
                } else if(phone === "") {
                    $(".alert-text-warning").html("Please enter a phone number to continue");
                }
                $(".alert-success").slideUp();
                $(".alert-warning").slideDown();
                $(".alert-warning").focus();
                return;
            }

            if(!isValidEmail(email)) {
                $(".alert-text-warning").html("Please enter a valid email address to continue");
                $(".alert-success").slideUp();
                $(".alert-warning").slideDown();
                $(".alert-warning").focus();
                return;
            }
            $(".alert-warning").slideUp();
            event.resolve();
        });


        const handleError = (error) => {
            const messageContainer = document.querySelector('#error-message');
            messageContainer.textContent = error.message;
        }

        expressCheckoutElement.on('confirm', async (event) => {
            const { error: submitError } = await elements.submit();
            if (submitError) {
                handleError(submitError);
                return;
            }

            var name = $("#fullname").val();
            var email = $("#emailaddress").val();
            var phone = $("#phone").val();
            var discount = $("#discount-value").val();
            const res = await fetch('/create-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    phone: phone,
                    discount: discount,
                    amount : amountInPence
                })
            });

            const { client_secret: clientSecret} = await res.json();

            const queryString = new URLSearchParams({ name, email, phone , discount }).toString();
            const returnUrl = `{{ route('success_quick_payment') }}?${queryString}`;
            localStorage.removeItem('couponapplied');
            localStorage.removeItem('couponcode');
            const { error } = await stripe.confirmPayment({
                elements,
                clientSecret,
                confirmParams: {
                    return_url: returnUrl,
                },
            });

            if (error) {
                handleError(error);
            } else {
            }
        });
    }

    createquickpay();

</script>
<script>
    $(document).ready(function() {
        var couponcheck = localStorage.getItem("couponapplied");
        if(couponcheck == "true"){
            $("#coupon-input").val(localStorage.getItem("couponcode"));
            setTimeout(function(){
                $("#btn-add-coupon").trigger('click');
            },500);
        }
        $("#card-number").mask('9999 9999 9999 9999');
        $("#phone").mask('99999999999');
        $("#expiry-date").mask('99/99', {
            onChange: function(value, e) {
                var month = value.split('/')[0];
                if (parseInt(month) > 12) {
                    $("#expiry-date").val('12/' + value.substring(3));
                }

            }
        });
        $("#cvv").mask('999');
        
        function numberWithCommas(x) {
            x = x.toString();
            var pattern = /(-?\d+)(\d{3})/;
            while (pattern.test(x))
                x = x.replace(pattern, "$1,$2");
            return x;
        }

        $("#btn-add-coupon").on("click", function(){
            var coupon = $("#coupon-input").val();
            if(coupon != ""){
                $("#btn-add-coupon").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading...");
                $("#btn-add-coupon").attr('disabled', 'disabled');
                var link = '/discount-code/verify?code=' + coupon;
                $.get(link , function(res){
                    if(res['status'] == "success"){
                        $("#express-checkout-element").remove();
                        $("#error-message").remove();
                
                        localStorage.setItem("couponapplied", true);
                        localStorage.setItem("couponcode", coupon);
                        // $("#order-subtotal").html(res['subtotal']);
                        // var subtotal = res['subtotalwithoutpound'];
                        var subtotal = res['subtotalwithoutpound'].replace(/,/g, ''); // Remove commas

                        $("#code-discount").slideDown();
                        $("#discount-applied").html("<span> - " + res['totalDiscount'] + "</span>");
                        $("#discount-value").val(res['totalDiscount']);
                        
                        var shippingCharges = $('#shipping-charges').val();
                        var grandTotal = parseFloat(subtotal) + parseFloat(shippingCharges);
                        $("#order-grand-total").html("<strong>&pound;" + numberWithCommas(grandTotal.toFixed(2)) + "</strong>");
                        $("#grand-total").val(grandTotal);
                        $("<div id='express-checkout-element'></div>").appendTo(".quick-pay-box");
                        $("<div id='error-message'></div>").appendTo(".quick-pay-box");
                        createquickpay();

                        // $.get('/calculate-vat?subtotal='+subtotal , function(response){
                        //     // $("#order-vat").html(response['vat']);
                        //     // var vat = response['withoutpound'].replace(/,/g, ''); // Remove commas;
                        // });
                        $("#btn-add-coupon").html('<i class="fas fa-tags d-md-none"></i><span class="d-none d-md-inline">Apply coupon</span>');
                        $("#btn-add-coupon").removeAttr('disabled');
                        

                    }
                    if(res['status'] == "error"){
                        $(".alert-text-warning").html(res['message']);
                        $(".alert-success").slideUp();
                        $(".alert-warning").slideDown();
                        $(".alert-warning")[0].scrollIntoView();
                        $("#btn-add-coupon").html('<i class="fas fa-tags d-md-none"></i><span class="d-none d-md-inline">Apply coupon</span>');
                        $("#btn-add-coupon").removeAttr('disabled');
                        localStorage.removeItem('couponapplied');
                        localStorage.removeItem('couponcode');
                        setTimeout(function(){
                            location.reload();
                        },2500);
                    }
                });
            }
        });


        $(".btn-order-submit").click(function() {
            var name = $("#fullname").val();
            var streetaddress = $("#streetaddress").val();
            var city = $("#city").val();
            var postcode = $("#postcode").val();
            var state = $("#state").val();
            var emailaddress = $("#emailaddress").val();
            var phone = $("#phone").val();
            var cardnumber = $("#card-number").val();
            var expirydate = $("#expiry-date").val();
            var cvv = $("#cvv").val();
            var grandTotal = $("#grand-total").val();
            var orderid = $("#oid").val();
            var ordernotes = $("#order-notes").val();
            var shippingFee = $("#shipping-charges").val();
            var discount = $("#discount-value").val();
            var createAnaccount = 0;
            var password = "";

            if ($("#createAnaccount").prop("checked")) {
                var createAnaccount = 1;
            }
            if (createAnaccount == 1) {
                console.log(createAnaccount);
                password = $("#signup-password").val();
                var cpassword = $("#confirm-password").val();

                if (password != "") {
                    if (cpassword != "") {
                        if (password != cpassword) {
                            $("#signup-password").focus();
                            $(".alert-text-warning").html('Password and Confirm Password doesnot match');
                            $(".alert-success").slideUp();
                            $(".alert-warning").slideDown();
                            $(".alert-warning")[0].scrollIntoView();
                            return;
                        }
                    } else {
                        $("#confirm-password").focus();
                        $(".alert-text-warning").html('Please enter confirm password');
                        $(".alert-success").slideUp();
                        $(".alert-warning").slideDown();
                        $(".alert-warning")[0].scrollIntoView();
                        return;
                    }
                } else {
                    $("#signup-password").focus();
                    $(".alert-text-warning").html('Please enter password');
                    $(".alert-success").slideUp();
                    $(".alert-warning").slideDown();
                    $(".alert-warning")[0].scrollIntoView();
                    return;
                }
            }

            if ($("#terms-and-conditions").prop('checked')) {
                $(".alert-success").slideUp();
                $(".alert-warning").slideUp();

                if (name != "") {
                    if (streetaddress != "") {
                        if (city != "") {
                            if (postcode != "") {
                                if (state != "") {
                                    if (emailaddress != "") {
                                        if(isValidEmail(emailaddress)) {
                                            if (phone != "") {
                                                if (cardnumber != "") {
                                                    if (expirydate != "") {
                                                        if (cvv != "") {
                                                            $(this).html("Processing your order <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                                                            $(this).attr('disabled', 'disabled');
                                                            $.ajax({
                                                                url: '/payment-success',
                                                                type: 'POST',
                                                                data: {
                                                                    "_token": "{{ csrf_token() }}",
                                                                    name: name,
                                                                    address: streetaddress,
                                                                    city: city,
                                                                    postcode: postcode,
                                                                    state: state,
                                                                    email: emailaddress,
                                                                    phone: phone,
                                                                    cardnumber: cardnumber,
                                                                    expirydate: expirydate,
                                                                    cvv: cvv,
                                                                    grandTotal: grandTotal,
                                                                    createAnaccount: createAnaccount,
                                                                    oid: orderid,
                                                                    ordernotes: ordernotes,
                                                                    password: password,
                                                                    shippingFee: shippingFee,
                                                                    discount: discount
                                                                },
                                                                success: function(response) {
                                                                    if (response['status'] == 'success') {
                                                                        $(".alert-text-success").html('<strong>' + name + '!</strong> Thank you for your order.');
                                                                        $(".alert-success").slideDown();
                                                                        $(".alert-warning").slideUp();
                                                                        $(".alert-success")[0].scrollIntoView();
                                                                        setTimeout(function() {
                                                                            window.location.href = response['redirect'];
                                                                        }, 2000);
                                                                        localStorage.removeItem('couponapplied');
                                                                        localStorage.removeItem('couponcode');
                                                                    } else {
                                                                        $(".btn-order-submit").html("Place order");
                                                                        $(".btn-order-submit").removeAttr('disabled', 'disabled');
                                                                        $(".alert-text-warning").html(response['message']);
                                                                        $(".alert-success").slideUp();
                                                                        $(".alert-warning").slideDown();
                                                                        $(".alert-warning")[0].scrollIntoView();
                                                                    }
                                                                }
                                                            });
                                                        } else {
                                                            $("#cvv").focus();
                                                            $(".alert-text-warning").html('Please Enter cvv');
                                                            $(".alert-success").slideUp();
                                                            $(".alert-warning").slideDown();
                                                            $(".alert-warning")[0].scrollIntoView();
                                                        }
                                                    } else {
                                                        $("#expiry-date").focus();
                                                        $(".alert-text-warning").html('Please Enter expiry date');
                                                        $(".alert-success").slideUp();
                                                        $(".alert-warning").slideDown();
                                                        $(".alert-warning")[0].scrollIntoView();
                                                    }
                                                } else {
                                                    $("#card-number").focus();
                                                    $(".alert-text-warning").html('Please Enter Card Number');
                                                    $(".alert-success").slideUp();
                                                    $(".alert-warning").slideDown();
                                                    $(".alert-warning")[0].scrollIntoView();
                                                }
                                            } else {
                                                $("#phone").focus();
                                                $(".alert-text-warning").html('Please Enter Phone Number');
                                                $(".alert-success").slideUp();
                                                $(".alert-warning").slideDown();
                                                $(".alert-warning")[0].scrollIntoView();
                                            }
                                        }
                                        else{
                                            $("#emailaddress").focus();
                                            $(".alert-text-warning").html('Please Enter a Valid Email Address');
                                            $(".alert-success").slideUp();
                                            $(".alert-warning").slideDown();
                                            $(".alert-warning")[0].scrollIntoView();
                                        }
                                    } else {
                                        $("#emailaddress").focus();
                                        $(".alert-text-warning").html('Please Enter Email Address');
                                        $(".alert-success").slideUp();
                                        $(".alert-warning").slideDown();
                                        $(".alert-warning")[0].scrollIntoView();
                                    }
                                } else {
                                    $("#state").focus();
                                    $(".alert-text-warning").html('Please Enter State');
                                    $(".alert-success").slideUp();
                                    $(".alert-warning").slideDown();
                                    $(".alert-warning")[0].scrollIntoView();
                                }
                            } else {
                                $("#postcode").focus();
                                $(".alert-text-warning").html('Please Enter Postal code');
                                $(".alert-success").slideUp();
                                $(".alert-warning").slideDown();
                                $(".alert-warning")[0].scrollIntoView();
                            }
                        } else {
                            $("#city").focus();
                            $(".alert-text-warning").html('Please Enter City');
                            $(".alert-success").slideUp();
                            $(".alert-warning").slideDown();
                            $(".alert-warning")[0].scrollIntoView();
                        }
                    } else {
                        $("#streetaddress").focus();
                        $(".alert-text-warning").html('Please Enter Street Address');
                        $(".alert-success").slideUp();
                        $(".alert-warning").slideDown();
                        $(".alert-warning")[0].scrollIntoView();
                    }
                } else {
                    $("#fullname").focus();
                    $(".alert-text-warning").html('Please Enter Full Name');
                    $(".alert-success").slideUp();
                    $(".alert-warning").slideDown();
                    $(".alert-warning")[0].scrollIntoView();
                }
            } else {
                $(".alert-text-warning").html('Please accept Terms & Conditions');
                $(".alert-success").slideUp();
                $(".alert-warning").slideDown();
                $(".alert-warning")[0].scrollIntoView();
            }
        });

        $(".btn-login-checkout").click(function() {
            var email = $("#login-email").val();
            var password = $("#login-password").val();

            if (email && password) {
                $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                $(this).attr('disabled', 'disabled');
                $.ajax({
                    url: '/sign-in-submit',
                    type: 'POST',
                    data: {
                        email: email,
                        password: password,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                        else {
                                $(".btn-login-checkout").html("Login");
                                $(".btn-login-checkout").removeAttr('disabled', 'disabled');
                                $(".alert-text-warning").html(response.message);
                                $(".alert-success").slideUp();
                                $(".alert-warning").slideDown();
                                $(".alert-warning")[0].scrollIntoView();
                            }
                    },
                });
            }
        });
    });
</script>
@endsection
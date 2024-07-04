@extends ('frontend.layout.master')
@section('title')
Your Shopping Cart | Electronics Hub London
@endsection

@section('meta')
<meta name="description" content="Review your selected electronics and accessories in your cart at Hub. Ensure you have everything you need before checkout.">
<meta name="keywords" content="shopping cart, electronics store london, best electronics store uk, checkout process, online shopping">
<meta property="og:title" content="Your Shopping Cart | Electronics Hub London">
<meta property="og:description" content="Review your selected electronics and accessories in your cart at Hub. Ensure you have everything you need before checkout.">
<meta property="og:url" content="{{env('APP_URL')}}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Your Shopping Cart | Electronics Hub London">
<meta name="twitter:description" content="Review your selected electronics and accessories in your cart at Hub. Ensure you have everything you need before checkout.">
<meta name="twitter:domain" content="{{env('APP_URL')}}">
@endsection

@section('css')
<style>
    .u-slick__arrow-classic-inner:before {
        color: var(--primary);
    }

    @media (min-width: 768px) {
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
    .description-img img{
        height: 300px;
    }
    
    .table thead th{
        border-top: none;
    }
    .space-2, .space-top-2{
        padding-top: 0!important;
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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">My Cart</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div> --}}
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mb-4">
            <h1 class="text-center">My Cart</h1>
        </div>
        <div class="">
            <form class="" action="#" method="post">
                <div class="table-responsive">
                    <table class="table cart-table" cellspacing="0">
                        <thead class="border-0">
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumbnail d-none d-md-table-cell">&nbsp;</th>
                                <th class="product-name" >Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity w-lg-15">Quantity</th>
                                <th class="product-subtotal">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart_items as $ci)
                                <tr class="" id="cartdiv-{{$ci->id}}">
                                    <td class="text-center">
                                        <a data-id="{{$ci->id}}" href="javascript:void(0);" class="text-gray-32 font-size-26 remove">×</a>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <a href="#"><img class="img-fluid max-width-100 p-1 border border-color-1 cart-img-dropdown" src="{{$ci->product_detail ? $ci->product_detail->image : ''}}" alt="{{ $ci->product_detail ? ucwords($ci->product_detail->title) : '' }}"></a>
                                    </td>
    
                                    <td data-title="Product">
                                        <a href="#" class="text-gray-90" >{{ $ci->product_detail ? ucwords($ci->product_detail->title) : '' }}</a>
                                    </td>
                                    
                                    @php 
                                        $prototal = 0;
                                        $discount = 0;
                                        if(isset($ci->product_detail)){
                                            if($ci->product_detail->vendor_id == 4){
                                                if($ci->quantity >= setting('vendor.mlabundleqty')){
                                                    $discount = $ci->product_detail->price_including_vat - setting('vendor.mlabundlediscount');
                                                }
                                            }
                                            $prototal += $ci->quantity * (($discount <= 0) ? $ci->product_detail->price_including_vat : $discount);
                                        }
                                    @endphp
                                    <td data-title="Price">
                                        <span class="">&pound;{{ $ci->product_detail ? number_format((($discount <= 0) ? $ci->product_detail->price_including_vat : $discount) , 2) : ''  }}</span>
                                    </td>
    
                                    <td data-title="Quantity">
                                        <span class="sr-only">Quantity</span>
                                        <!-- Quantity -->
                                        <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                            <div class="js-quantity row align-items-center">
                                                <div class="col">
                                                    <input data-tempcartid="{{$ci->id}}" data-unitprice="{{ $ci->product_detail ? number_format($ci->product_detail->price_including_vat , 2) : '' }}" class="js-result cart-qty form-control h-auto border-0 rounded p-0 shadow-none cartpro-qty-{{$ci->id}}" type="text" value="{{$ci->quantity}}" type="text" max="99" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2)">
                                                </div>
                                                <div class="col-auto pr-1">
                                                    <button type="button" @if($ci->quantity <= 1) disabled @endif data-tempcartid="{{$ci->id}}" class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0 btn-minus-cart btn-minus-cart-{{$ci->id}}" href="javascript:void(0);">
                                                        <small class="fas fa-minus btn-icon__inner"></small>
                                                    </button>
                                                    <button type="button" data-tempcartid="{{$ci->id}}"t class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0 btn-plus-cart" href="javascript:void(0);">
                                                        <small class="fas fa-plus btn-icon__inner"></small>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Quantity -->
                                    </td>
    
                                    <td data-title="Total">
                                        <span class="pro-cart-total-{{$ci->id}}">&pound;{{ number_format($ci->product_detail ? number_format((($discount <= 0) ? $ci->product_detail->price_including_vat : $discount) ,2) * $ci->quantity : '', 2)  }}</span>
                                        <input type="hidden" id="pro-cart-total-{{$ci->id}}" value="{{ $cartTotal  }}">
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        <div class="mb-8 cart-total">
            <div class="row">
                <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                    <div class="border-bottom border-color-1 mb-3">
                        <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Cart Total</h3>
                    </div>
                    <table class="table mb-3 mb-md-0">
                        <tbody>
                            <!-- <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td data-title="Subtotal"><span class="amount subtotal-amount">&pound;{{ number_format($cartTotal , 2) }}</span></td>
                            </tr> -->
                            <tr class="order-total">
                                <th>Total</th>
                                <td data-title="Total"><strong><span class="amount total-amount">&pound;{{ number_format($cartTotal , 2) }}</span></strong></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td  class="border-top space-top-2 justify-content-center">
                                    <div class="pt-md-3">
                                        <div class="d-block d-md-flex flex-center-between">
                                            <div class="d-md-flex">
                                                <a href="{{route('homePage')}}" class="btn btn-primary-dark-w text-white ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block">Continue Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td  class="border-top space-top-2 justify-content-center">
                                    <div class="pt-md-3">
                                        <div class="d-block d-md-flex flex-center-between">
                                            <div class="d-md-flex">
                                                <a href="{{route('checkout')}}" class="btn btn-primary-dark-w text-white ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block">Proceed to checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <a href="{{route('checkout')}}" class="btn btn-primary-dark-w text-white ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-md-none">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('.btn-plus-cart').click(function(){
            var tempcartid = $(this).data('tempcartid');
            var qty = $(".cartpro-qty-" + tempcartid).val();
            $(".btn-minus-cart-" + tempcartid).removeAttr('disabled');
            var unitprice = $(".cartpro-qty-" + tempcartid).data('unitprice');
            qty = parseInt(qty) + 1;
            $(".cartpro-qty-" + tempcartid).val(qty);
            var subtotal = parseFloat($("#pro-cart-total-" + tempcartid).val());
            subtotal = unitprice * qty;
            $("#pro-cart-total-" + tempcartid).val(parseFloat(subtotal).toFixed(2));
            $(".pro-cart-total-" + tempcartid).html("&pound;" + parseFloat(subtotal).toFixed(2));

            $.ajax({
                url : '/product/update-cart-qtty',
                type : 'POST',
                data : {
                    tempcartid : tempcartid,
                    qtty : qty,
                    unitprice : unitprice
                },
                success : function(response){
                    setTimeout(() => {
                        var link = '/get-cart/list';
                        $.get(link , function(res){
                            if(res['status'] == 'success'){
                                $(".total-qty").html(res['data'].length);
                                $(".total-cart-price").html('&pound;' + res['totalCartPrice']);
                                $('.subtotal-amount').html('&pound;' + res['totalCartPrice']);
                                $('.total-amount').html('&pound;' + res['totalCartPrice']);
                            }
                        });
                    }, 100);
                }
            });
        });

        $('.btn-minus-cart').click(function(){
            var tempcartid = $(this).data('tempcartid');
            var qty = $(".cartpro-qty-" + tempcartid).val();
            var unitprice = $(".cartpro-qty-" + tempcartid).data('unitprice');
            if(qty > 1){
                qty = parseInt(qty) - 1;
                $(".cartpro-qty-" + tempcartid).val(qty);
                var subtotal = parseFloat($("#pro-cart-total-" + tempcartid).val());
                subtotal = unitprice * qty;
                $("#pro-cart-total-" + tempcartid).val(parseFloat(subtotal).toFixed(2));
                $(".pro-cart-total-" + tempcartid).html("&pound;" + parseFloat(subtotal).toFixed(2));
    
                $.ajax({
                    url : '/product/update-cart-qtty',
                    type : 'POST',
                    data : {
                        tempcartid : tempcartid,
                        qtty : qty,
                        unitprice : unitprice
                    },
                    success : function(response){
                        setTimeout(() => {
                            var link = '/get-cart/list';
                            $.get(link , function(res){
                                if(res['status'] == 'success'){
                                    $(".total-qty").html(res['data'].length);
                                    $(".total-cart-price").html('&pound;' + res['totalCartPrice']);
                                    $('.subtotal-amount').html('&pound;' + res['totalCartPrice']);
                                    $('.total-amount').html('&pound;' + res['totalCartPrice']);
                                }
                            });
                        }, 100);
                    }
                });
            }
            else{
                $(this).attr('disabled', 'disabled');
            }
        });

        $(".cart-qty").on('blur' , function(){
            var tempcartid = $(this).data('tempcartid');
            var unitprice = $(".cartpro-qty-" + tempcartid).data('unitprice');
            var qty = $(this).val();

            var subtotal = parseFloat($("#pro-cart-total-" + tempcartid).val());
            subtotal = unitprice * qty;
            $("#pro-cart-total-" + tempcartid).val(parseFloat(subtotal).toFixed(2));
            $(".pro-cart-total-" + tempcartid).html("&pound;" + parseFloat(subtotal).toFixed(2));
            
            $.ajax({
                url : '/product/update-cart-qtty',
                type : 'POST',
                data : {
                    tempcartid : tempcartid,
                    qtty : qty,
                    unitprice : unitprice
                },
                success : function(response){
                    setTimeout(() => {
                        var link = '/get-cart/list';
                        $.get(link , function(res){
                            if(res['status'] == 'success'){
                                $(".total-qty").html(res['data'].length);
                                $(".total-cart-price").html('&pound;' + res['totalCartPrice']);
                                $('.subtotal-amount').html('&pound;' + res['totalCartPrice']);
                                $('.total-amount').html('&pound;' + res['totalCartPrice']);
                            }
                        });
                    }, 100);
                }
            });
        });
    });
</script>
@endsection
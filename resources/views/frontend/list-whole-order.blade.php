@extends ('frontend.layout.master')
@section('title')
Re Order | The Electrohub
@endsection

@section('meta')
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
            <h1 class="text-center">Re Order</h1>
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
                                <th class="product-subtotal">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderpro as $ci)
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
    
                                    <td data-title="Price">
                                        <span class="">&pound;{{ $ci->product_detail ? number_format($ci->product_detail->price , 2) : '' }}</span>
                                    </td>
    
                                    <td data-title="Quantity">
                                        <span class="sr-only">Quantity</span>
                                        <!-- Quantity -->
                                        <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                            <div class="js-quantity row align-items-center">
                                                <div class="col">
                                                    <input data-tempcartid="{{$ci->id}}" data-unitprice="{{ $ci->product_detail ? number_format($ci->product_detail->price , 2) : '' }}" class="js-result cart-qty form-control h-auto border-0 rounded p-0 shadow-none cartpro-qty-{{$ci->id}}" type="text" value="{{$ci->quantity}}">
                                                </div>
                                                <div class="col-auto pr-1">
                                                    <button type="button" @if($ci->quantity <= 1) disabled @endif data-tempcartid="{{$ci->id}}" data-orderproid = "{{ $ci->product_id }}" class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0 btn-minus-cart btn-minus-cart-{{$ci->id}}" href="javascript:void(0);">
                                                        <small class="fas fa-minus btn-icon__inner"></small>
                                                    </button>
                                                    <button type="button" data-tempcartid="{{$ci->id}}" data-orderproid = "{{ $ci->product_id }}" class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0 btn-plus-cart" href="javascript:void(0);">
                                                        <small class="fas fa-plus btn-icon__inner"></small>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Quantity -->
                                    </td>
    
                                    <td data-title="Total">
                                        <span class="pro-cart-total-{{$ci->id}}">&pound;{{ $ci->product_detail ? number_format($ci->product_detail->price , 2) * $ci->quantity : ''  }}</span>
                                        <input type="hidden" id="pro-cart-total-{{$ci->id}}" value="{{ $ci->product_detail ? number_format($ci->product_detail->price , 2) * $ci->quantity : ''  }}">
                                    </td>

                                    <td>
                                        @php
                                            $hasProductInCart = false;

                                            foreach($cart_items as $cartitem) {
                                                if($ci->product_id == $cartitem->product_id) {
                                                    $hasProductInCart = true;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        @if($hasProductInCart)
                                            <button type="button" data-qty="{{ $ci->quantity }}" data-orderproid = "{{ $ci->id }}" data-id="{{ $ci->product_id }}" class="btn-add-cart btn px-5 btn-primary-dark transition-3d-hover btn-add-cart-{{$ci->product_id}}"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Update Cart</button>
                                        @else
                                            <a href="javascript:void(0);" data-qty="{{ $ci->quantity }}" data-orderproid = "{{ $ci->id }}" data-id="{{ $ci->product_id }}" class="btn-add-cart cart-btn-add btn w-100 px-5 btn-primary-dark transition-3d-hover btn-add-cart-{{$ci->product_id}}"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </form>
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
            var orderproid = $(this).data('orderproid');
            $(".btn-add-cart-" + orderproid).attr('data-qty', qty);
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
                var orderproid = $(this).data('orderproid');
                $(".btn-add-cart-" + orderproid).attr('data-qty', qty);
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

            var orderproid = $(this).data('orderproid');
            $(".btn-add-cart-" + orderproid).attr('data-qty', qty);
        
        });
    });
</script>
@endsection
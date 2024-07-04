@extends ('frontend.layout.master')
@section('title')
Payment Successful | The Electrohub
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
        <div class="mb-4">
            <h3 class="text-center">Payment Success</h3>
            <p class="text-center">Thank You! for your order. Your order no is <strong>#{{$order->order_no}}</strong></p>
        </div>
        <div class="mb-10 cart-table">
            <form class="mb-4" action="#" method="post">
                <table class="table" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity w-lg-15">Quantity</th>
                            <th class="product-subtotal">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->order_products as $op)
                            <tr style="border-bottom: 1px solid rgba(0, 0, 0, 0.1);" class="">
                                <td class="d-none d-md-table-cell">
                                    <a href="#"><img class="img-fluid max-width-100 p-1 border border-color-1 cart-img-dropdown" src="{{$op->product_detail ? $op->product_detail->image : ''}}" alt="{{ $op->product_detail ? ucwords($op->product_detail->title) : '' }}"></a>
                                </td>

                                <td data-title="Product">
                                    <a href="#" class="text-gray-90">{{ $op->product_detail ? ucwords($op->product_detail->title) : '' }}</a>
                                </td>

                                <td data-title="Price">
                                    <span class="">&pound;{{ $op->product_detail ? number_format($op->product_detail->price , 2) : '' }}</span>
                                </td>

                                <td data-title="Quantity">
                                    <span class="">x{{ $op->quantity }}</span>
                                </td>
                                <!-- End Quantity -->

                                <td data-title="Total">
                                    <span>&pound;{{ $op->product_detail ? number_format($op->product_detail->price , 2) * $op->quantity : ''  }}</span>
                                </td>
                            </tr>

                            
                        @endforeach
                        <tr>
                            <td colspan="6" class="border-top space-top-2 justify-content-center">
                                <div class="pt-md-3">
                                    <div class="d-block d-md-flex flex-center-between">
                                        <div class="mb-3 mb-md-0 w-xl-40">
                                            <!-- Apply coupon Form -->
                                            
                                            <!-- End Apply coupon Form -->
                                        </div>
                                        <div class="d-md-flex">
                                            <h4><strong>Total: <span>&pound;{{ number_format($order->order_total , 2)  }}</span></strong><h4>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</main>
@endsection

@section('js')
@endsection
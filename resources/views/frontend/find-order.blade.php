@extends ('frontend.layout.master')
@section('title')
Track Order | The Electrohub
@endsection

@section('meta')
@endsection

@section('css')
<style>
    .u-slick__arrow-classic-inner:before {
        color: var(--primary);
    }

    mark{
        font-weight: 600;
    }

    table thead th {
        text-wrap: nowrap;
    }
    .amount{
        text-align: right;
    }
    .f-w-amount{
        font-weight: 700;
    }

    @media (min-width: 768px) {
        .u-header--white-nav-links-md:not(.bg-white):not(.js-header-fix-moment) .u-header__nav-link {
            color: #333e48 !important;
        }
        .order_details {
            overflow-x: auto;
            white-space: nowrap;
        }
        table thead th {
        text-wrap: nowrap;
    }
    }

    @media (max-width: 768px) {
        .sm-table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
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
        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Track your Order</li>
        </ol>
        </nav>
    </div>
    <!-- End breadcrumb -->
    </div> --}}
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mx-xl-10">
            <div class="mb-6 text-center">
                <h1 class="mb-6">Track your Order</h1>
                <!-- <p class="text-gray-90 px-xl-10">To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p> -->
            </div>
            <div class="my-4 my-xl-8">
                <div class="track-order">
                    <p class="order-info">
                        Order #<mark class="order-number">{{$thisorder->order_no}}</mark> was placed on <mark class="order-date">{{$thisorder->created_at->format('d-m-y')}}</mark>.
                         <br>
                         Order Status : <mark class="order-date">Pending</mark>
                    </p>
                    <section class=" order-details">
                        <h2 class=" order-details__title">Billing details</h2>
                        <table class=" table sm-table-responsive table--order-details shop_table order_details">
                            <thead>
                                <tr>
                                    <th class=" table__product-name product-name">Name</th>
                                    <th class=" table__product-table product-total">Address</th>
                                    <th class=" table__product-name product-name">City</th>
                                    <th class=" table__product-table product-total">Postal Code</th>
                                    <th class=" table__product-name product-name">State</th>
                                    <th class=" table__product-table product-total">Email Address</th>
                                    <th class=" table__product-table product-total">Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr class=" table__line-item order_item">
                                    
                                    <td class=" table__product-total product-total">{{$thisorder->name}}</td>
                                    <td class=" table__product-total product-total">{{$thisorder->address}}</td>
                                    <td class=" table__product-total product-total">{{$thisorder->city}}</td>
                                    <td class=" table__product-total product-total">{{$thisorder->postal_code}}</td>
                                    <td class=" table__product-total product-total">{{$thisorder->state}}</td>
                                    <td class=" table__product-total product-total">{{$thisorder->email}}</td>
                                    <td class=" table__product-total product-total">{{$thisorder->contact_no}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <section class=" customer-details">
                        <h2 class=" order-details__title">Order details</h2>
                        <table class=" table  table--order-details shop_table order_details">
                            <thead>
                                <tr>
                                    <th class=" table__product-name product-name">Product</th>
                                    <th class=" table__product-table product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $subtotal = 0;
                                $total = 0;
                                @endphp
                                @foreach($orderProducts as $orderproduct)
                                <tr class=" table__line-item order_item">
                                    <td class=" table__product-name product-name">
                                        <a href="javascript:void(0);">{{$orderproduct->product_detail->title}}</a> <strong class="product-quantity">×&nbsp;{{$orderproduct->quantity}}</strong>
                                    </td>
                                    @php 
                                    $subtotal += (($orderproduct->price) * ($orderproduct->quantity));
                                    @endphp
                                    <td class=" table__product-total product-total">
                                        <span class=" Price-amount amount">
                                            <bdi><span class=" Price-currencySymbol">&pound;</span>{{number_format( (($orderproduct->price) * ($orderproduct->quantity)),2)}}</bdi></span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="row">Subtotal:</th>
                                    <td><span class=" Price-amount amount f-w-amount"><span class=" Price-currencySymbol">&pound;</span>{{number_format($subtotal,2)}}</span></td>
                                </tr>
                                @if($thisorder->order_discount > 0)
                                <tr>
                                    <th scope="row text-primary">Discount:</th>
                                    <td><span class=" Price-amount amount f-w-amount text-primary"><span class=" Price-currencySymbol">-&pound;</span>{{number_format($thisorder->order_discount,2)}}</span>&nbsp;</td>
                                </tr>
                                @endif
                                @php
                                $vat = 0;
                                $vat = ($subtotal  - $thisorder->order_discount)* 0.2;
                                @endphp
                                <!-- <tr>
                                    <th scope="row">VAT:</th>
                                    <td><span class=" Price-amount amount  f-w-amount"><span class=" Price-currencySymbol">&pound;</span>{{number_format($vat,2)}}</span>&nbsp;</td>
                                </tr> -->
                                <tr>
                                    <th scope="row">Payment method:</th>
                                    <td class=" f-w-amount">{{$thisorder->payment_gateway}}</td>
                                </tr>
                                <tr>
                                    @if($thisorder->shipping_total > 0)
                                    <th scope="row">Delivery Charges:</th>
                                    <td class=" f-w-amount">&pound;{{$thisorder->shipping_total}}</td>
                                    @else
                                    <th scope="row text-primary">Delivery Charges:</th>
                                    <td class=" f-w-amount text-primary">Free</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th scope="row">Total:</th>
                                    <td><span class=" Price-amount amount f-w-amount"><span class=" Price-currencySymbol">&pound;</span>{{number_format($thisorder->order_total,2)}}</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>
    $(document).ready(function() {

    });
</script>
@endsection
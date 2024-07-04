@extends ('frontend.layout.master')
@section('title')
Your Wishlist at Hub | Customized Electronics Choices
@endsection

@section('meta')
<meta name="description" content="Keep track of your favorite electronics with Hub's wishlist feature. Create a personalized list for a tailored shopping experience in London.">
<meta name="keywords" content="wishlist feature, personalized electronics, best electronics store london, customized shopping, favorite gadgets">
<meta property="og:title" content="Your Wishlist at Hub | Customized Electronics Choices">
<meta property="og:description" content="Keep track of your favorite electronics with Hub's wishlist feature. Create a personalized list for a tailored shopping experience in London.">
<meta property="og:url" content="{{env('APP_URL')}}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Your Wishlist at Hub | Customized Electronics Choices">
<meta name="twitter:description" content="Keep track of your favorite electronics with Hub's wishlist feature. Create a personalized list for a tailored shopping experience in London.">
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
    .cart-table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div> --}}
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="my-6">
            <h1 class="text-center">My Wishlist </h1>
        </div>
        <div class="">
            <form class="" action="#" method="post">
                <div class="table-responsive">
                    <table class="table wishlist-table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-name">Image</th>
                                <th class="product-name">Title</th>
                                <th class="product-price">Unit Price</th>
                                <th class="product-subtotal min-width-200-md-lg">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wishlistitems as $items)
                                <tr id="cartdiv-{{$items->id}}">
                                    <td class="text-center">
                                        <a data-id="{{$items->id}}" href="javascript:void(0);" class="text-gray-32 font-size-26 removeWish">×</a>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <a href="#"><img class="img-fluid max-width-100 p-1 border border-color-1 cart-img-dropdown" src="{{$items->product_detail ? $items->product_detail->image : ''}}" alt="{{ $items->product_detail ? ucwords($items->product_detail->title) : '' }}"></a>
                                    </td>
                                    <td data-title="Product">
                                        <a href="#" class="text-gray-90">{{ $items->product_detail ? ucwords($items->product_detail->title) : '' }}</a>
                                    </td>
    
                                    <td data-title="Price">
                                        <span class="">&pound;{{ $items->product_detail ? number_format($items->product_detail->price_including_vat , 2) : '' }}</span>
                                    </td>

                                    <td>
                                        <button type="button" data-qty="1" data-id="{{$items->product_detail->id}}" class="btn-add-cart btn btn-primary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto btn-add-cart-{{$items->id}}"><i class="ec ec-add-to-cart"></i></button>
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
@endsection
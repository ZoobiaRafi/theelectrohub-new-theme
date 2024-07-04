@extends ('frontend.layout.master')
@section('title')
FAQ's | The Electrohub
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

    <div class="mb-12 text-center">
        <h1>Frequently Asked Questions</h1>
        <!-- <p class="text-gray-44">This Agreement was last modified on 18th february 2019</p> -->
    </div>
    <!-- <div class="border-bottom border-color-1 mb-8 rounded-0">
        <h3 class="section-title mb-0 pb-2 font-size-25">Shipping Information</h3>
    </div> -->
    <div class="container">
        <div class="row mb-8">
            @foreach($faqs as $faq)
            <div class="col-lg-6 mb-5 mb-lg-8">
                <h3 class="font-size-18 font-weight-semi-bold text-gray-39 mb-4">{{$faq->question}}</h3>
                <p class="text-gray-90"> {{$faq->answer}} </p>
            </div>
            @endforeach
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
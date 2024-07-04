@extends ('frontend.layout.master')
@section('title')
{{$page->title}} | The Electrohub
@endsection

@section('meta')
@endsection

@section('css')
<style>
    .u-slick__arrow-classic-inner:before {
        color: var(--primary);
    }
    p{
        color: #000;
    }

    @media (min-width: 768px) {
        .u-header--white-nav-links-md:not(.bg-white):not(.js-header-fix-moment) .u-header__nav-link {
            color: #333e48 !important;
        }
    }
    @media (max-width: 600px) {
        .padding-3{
            padding-right: 1rem !important;
            padding-left: 1rem !important;
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

    <div class="mt-3 mb-6 text-center">
        <h1>{{$page->title}}</h1>
        <!-- <p class="text-gray-44">This Agreement was last modified on {{$page->created_at->format('Y-m-d')}}</p> -->
    </div>
    <!-- <div class="border-bottom border-color-1 mb-8 rounded-0">
        <h3 class="section-title mb-0 pb-2 font-size-25">Shipping Information</h3>
    </div> -->
    <div class="container">
        <div class="row mb-8 padding-3 d-block text-dark">
            {!! $page->text !!}
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
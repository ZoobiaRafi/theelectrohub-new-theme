@extends ('frontend.layout.master')

@section('title')
{{$maincategory->title}} 
@if($parentcategory != null)
| {{$parentcategory->title}} 
@endif
@endsection

@section('meta')
@endsection

@section('css')
<style>
    .u-slick__arrow-classic-inner:before {
        color: var(--primary);
    }
    .h-300 {
        height: 300px;
    }

    .h-256 {
        height: 256px;
    }

    .h-280 {
        height: 280px;
    }
    .category .product-item__outer .product-item__inner .product-item__body div a img{
        transform: scaleX(1); 
        height: 200px;
    }

    @media only screen and (max-width: 600px) {
        .h-300,
        .h-256,
        .h-280 {
            height: auto;
        }
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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page"><a href="{{route('homePage')}}">Home</a></li>

                        <!-- <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('homePage')}}">Home</a></li> -->
                        @if($parentcategory == null)
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page"><a href="{{ url('/' .$maincategory->slug )}}">{{$maincategory->title}}</a></li>
                        @else
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page"><a href="{{ url('/' .$maincategory->slug )}}">{{$maincategory->title}}</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page"><a href="{{ url('/' .$maincategory->slug .'/' .$parentcategory->slug )}}">{{$parentcategory->title}}</a></li>
                        @endif
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="row">
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                <div class="mb-8 border border-width-2 border-color-3 borders-radius-6">
                    <!-- List -->
                    <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar">
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse dropdown-title" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav1Collapse" data-target="#sidebarNav1Collapse">
                                Show All Categories
                            </a>

                            <div id="sidebarNav1Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav1" class="list-unstyled dropdown-list">
                                    @foreach ($menu_categories as $main_categories)
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item  text-ellipsis " href="{{url($main_categories->slug)}}">{{$main_categories->title}}
                                        <!-- <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span> -->
                                    </a></li>
                                    @endforeach
                                    @foreach ($nav_more_categories as $cat)
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item  text-ellipsis " href="{{url($cat->slug)}}">{{$cat->title}}
                                        <!-- <span class="text-gray-25 font-size-12 font-weight-normal">(56)</span> -->
                                    </a></li>
                                    @endforeach
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-current active" href="{{ url('/' .$maincategory->slug )}}">{{$maincategory->title}}</a>
                            <ul class="list-unstyled dropdown-list">
                            @foreach ($maincategory->sub_categories as $thisParent)
                                @php
                                    $child_category_ids = $thisParent->sub_categories->pluck('id')->toArray();
                                    $category_ids = array_merge([$thisParent->id], $child_category_ids);
                                    $getcategoryproducts = App\ProductToCategory::whereIn('cat_id', $category_ids)->get();
                                    $temp = $getcategoryproducts->count() > 0;
                                @endphp

                                @if($temp)
                                    <li>
                                        <a class="dropdown-item text-ellipsis" href="{{url('/'.$maincategory->slug.'/'.$thisParent->slug)}}">{{$thisParent->title}}</a>
                                    </li>
                                @endif
                            @endforeach

                                {{--@foreach (($maincategory->sub_categories) as $thisParent)
                                    <li>
                                        <a class="dropdown-item  text-ellipsis " href="{{url('/'.$maincategory->slug.'/'.$thisParent->slug)}}">{{$thisParent->title}}</a>
                                    </li>
                                @endforeach--}}
                            </ul>
                        </li>
                    </ul>
                    <!-- End List -->
                </div>

            </div>
            <div class="col-xl-9 col-wd-9gdot5">
            @if($parentcategory == null)
                <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                    <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{$maincategory->title}}</h3>
                </div>
                @if(($maincategory->children)->count() <= 0)
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 mb-4 mt-4">
                                <div class="alert alert-primary text-white mb-0" role="alert">
                                    No sub-category in this category.
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <ul class="row list-unstyled products-group no-gutters mb-6">
                        @foreach ($maincategory->sub_categories as $category)
                            @php
                                $child_category_ids = $category->sub_categories->pluck('id')->toArray();
                                $category_ids = array_merge([$category->id], $child_category_ids);
                                $getcategoryproducts = App\ProductToCategory::whereIn('cat_id', $category_ids)->get();
                                $temp = $getcategoryproducts->count() > 0;
                            @endphp

                            @if($temp)
                                <li class="col-6 col-md-3 product-item category">
                                    <div class="product-item__outer h-100 w-100">
                                        <div class="product-item__inner px-xl-4 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2">
                                                    <a href="{{url('/'.$maincategory->slug.'/'.$category->slug)}}" class="d-block text-center"><img class="img-fluid" src="{{$category->image}}" alt="{{$category->slug}}"></a>
                                                </div>
                                                <h5 class="text-center mb-1 product-item__title"><a href="{{url('/'.$maincategory->slug.'/'.$category->slug)}}" class="font-size-15 text-gray-90">{{$category->title}}</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                           
                    </ul>
                @endif

                
                @if(($maincategory->products)->count() > 0)
                    <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                        <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Products</h3>
                    </div>
                    <div class="product-listing col-12">
                        <div class="row">
                            @foreach ($maincategory->products as $product)
                                @php
                                    $routeParameters = [];
                                    $slugs=[
                                        $maincategory->slug ?? null,
                                        $product->product_detail->slug
                                    ];

                                    foreach ($slugs as $slug) {
                                        if ($slug !== null) {
                                            $routeParameters[] = $slug;
                                        }
                                    }
                                @endphp

                                <div class="col-md-2 col-sm-6">
                                    @include('frontend.inc.product-card-2')
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            @else
                <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                    <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{$parentcategory->title}}</h3>
                </div>
                @if(($parentcategory->children)->count() <= 0)
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 mb-4 mt-4">
                                <div class="alert alert-primary text-white mb-0" role="alert">
                                    No sub-category in this category.
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <ul class="row list-unstyled products-group no-gutters mb-6">

                        @foreach (($parentcategory->children) as $category)
                            @php 
                                $flag = 0;
                                $getcategoryproducts = App\ProductToCategory::where('cat_id' , $category->id)->get();
                                if(count($getcategoryproducts) > 0){
                                    $flag = 1;    
                                }
                            @endphp
                            @if($flag == 1)
                                <li class="col-6 col-md-3 product-item category">
                                    <div class="product-item__outer h-100 w-100">
                                        <div class="product-item__inner px-xl-4 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2">
                                                    <a href="{{url('/'.$maincategory->slug.'/'.$parentcategory->slug.'/'.$category->slug)}}" class="d-block text-center"><img class="img-fluid" src="/{{$category->image}}" alt="{{$category->slug}}"></a>
                                                </div>
                                                <h5 class="text-center mb-1 product-item__title"><a href="{{url('/'.$maincategory->slug.'/'.$parentcategory->slug.'/'.$category->slug)}}" class="font-size-15 text-gray-90">{{$category->title}}</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif

                @if(($parentcategory->products)->count() > 0)
                    <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                        <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Products</h3>
                    </div>
                    <div class="product-listing col-12 mb-5">
                        <div class="row">
                            @foreach ($parentcategory->products as $product)
                                @php
                                    $routeParameters = [];
                                    $slugs=[
                                        $maincategory->slug ?? null,
                                        $parentcategory->slug ?? null,
                                        $product->product_detail->slug
                                    ];

                                    foreach ($slugs as $slug) {
                                        if ($slug !== null) {
                                            $routeParameters[] = $slug;
                                        }
                                    }
                                @endphp

                                <div class="col-md-3 col-sm-6">
                                    @include('frontend.inc.product-card-2')
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            @endif
            </div>
        </div>
        
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
@endsection

@section('js')
@endsection
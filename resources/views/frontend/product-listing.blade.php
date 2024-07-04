@extends ('frontend.layout.master')

@section('title')

{{$main_cat->title}} | {{$parent->title}} | {{$child->title}}
@endsection

@section('meta')
@endsection

@section('css')
<style>
    .u-slick__arrow-classic-inner:before {
        color: var(--primary);
    }
    .pagination {
        justify-content: center !important;
    }
    .product-item__outer .product-item__inner .product-item__body div a img{
        transform: scale(1);
        height: 124px;
    }

    .pagination .page-item .page-link {
        color: #001f3f;
    }

    .pagination .page-item .page-link {
        color: #001f3f;
    }

    .pagination .page-item.active .page-link {
        background-color: #001f3f;
        color: #fff;
        border: 1px solid #001f3f;
    }

    .h-300 {
        height: 300px;
    }

    .h-256 {
        height: 300px;
    }

    .h-280 {
        height: 280px;
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

    @media only screen and (max-width: 600px) {

        .h-300,
        .h-256,
        .h-280 {
            height: auto;
        }

        .dropdown-menu.show{
            left: auto!important;
            right: auto!important;
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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('homePage')}}">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/' .$main_cat->slug )}}">{{$main_cat->title}}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/' .$main_cat->slug. '/' .$parent->slug )}}">{{$parent->title}}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page"><a href="#">{{$child->title}}</a></li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="row mb-8">
            <div class="d-none col-xl-3 col-wd-2gdot5">

                <div class="mb-6">
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Filters</h3>
                    </div>
                    <div class="border-bottom pb-4 mb-4">
                        <h4 class="font-size-14 mb-3 font-weight-bold">Brands</h4>

                        <!-- Checkboxes -->
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="brandAdidas">
                                <label class="custom-control-label" for="brandAdidas">Adidas
                                    <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="brandNewBalance">
                                <label class="custom-control-label" for="brandNewBalance">New Balance
                                    <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="brandNike">
                                <label class="custom-control-label" for="brandNike">Nike
                                    <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="brandFredPerry">
                                <label class="custom-control-label" for="brandFredPerry">Fred Perry
                                    <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="brandTnf">
                                <label class="custom-control-label" for="brandTnf">The North Face
                                    <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                </label>
                            </div>
                        </div>
                        <!-- End Checkboxes -->

                        <!-- View More - Collapse -->
                        <div class="collapse" id="collapseBrand">
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandGucci">
                                    <label class="custom-control-label" for="brandGucci">Gucci
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="brandMango">
                                    <label class="custom-control-label" for="brandMango">Mango
                                        <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- End View More - Collapse -->

                        <!-- Link -->
                        <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2" data-toggle="collapse" href="#collapseBrand" role="button" aria-expanded="false" aria-controls="collapseBrand">
                            <span class="link__icon text-gray-27 bg-white">
                                <span class="link__icon-inner">+</span>
                            </span>
                            <span class="link-collapse__default">Show more</span>
                            <span class="link-collapse__active">Show less</span>
                        </a>
                        <!-- End Link -->
                    </div>
                    <div class="border-bottom pb-4 mb-4">
                        <h4 class="font-size-14 mb-3 font-weight-bold">Color</h4>

                        <!-- Checkboxes -->
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="categoryTshirt">
                                <label class="custom-control-label" for="categoryTshirt">Black <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="categoryShoes">
                                <label class="custom-control-label" for="categoryShoes">Black Leather <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="categoryAccessories">
                                <label class="custom-control-label" for="categoryAccessories">Black with Red <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="categoryTops">
                                <label class="custom-control-label" for="categoryTops">Gold <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="categoryBottom">
                                <label class="custom-control-label" for="categoryBottom">Spacegrey <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                            </div>
                        </div>
                        <!-- End Checkboxes -->

                        <!-- View More - Collapse -->
                        <div class="collapse" id="collapseColor">
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="categoryShorts">
                                    <label class="custom-control-label" for="categoryShorts">Turquoise <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="categoryHats">
                                    <label class="custom-control-label" for="categoryHats">White <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="categorySocks">
                                    <label class="custom-control-label" for="categorySocks">White with Gold <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                </div>
                            </div>
                        </div>
                        <!-- End View More - Collapse -->

                        <!-- Link -->
                        <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2" data-toggle="collapse" href="#collapseColor" role="button" aria-expanded="false" aria-controls="collapseColor">
                            <span class="link__icon text-gray-27 bg-white">
                                <span class="link__icon-inner">+</span>
                            </span>
                            <span class="link-collapse__default">Show more</span>
                            <span class="link-collapse__active">Show less</span>
                        </a>
                        <!-- End Link -->
                    </div>
                    <div class="range-slider">
                        <h4 class="font-size-14 mb-3 font-weight-bold">Price</h4>
                        <!-- Range Slider -->
                        <input class="js-range-slider" type="text" data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid" data-type="double" data-grid="false" data-hide-from-to="true" data-prefix="$" data-min="0" data-max="3456" data-from="0" data-to="3456" data-result-min="#rangeSliderExample3MinResult" data-result-max="#rangeSliderExample3MaxResult">
                        <!-- End Range Slider -->
                        <div class="mt-1 text-gray-111 d-flex mb-4">
                            <span class="mr-0dot5">Price: </span>
                            <span>$</span>
                            <span id="rangeSliderExample3MinResult" class=""></span>
                            <span class="mx-0dot5"> — </span>
                            <span>$</span>
                            <span id="rangeSliderExample3MaxResult" class=""></span>
                        </div>
                        <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg">Filter</button>
                    </div>
                </div>

            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!-- Shop-control-bar Title -->
                <div class="d-block d-md-flex flex-center-between mb-3">
                    <h3 class="font-size-25 mb-2 mb-md-0">{{$child->title}}</h3>
                    <!-- <p class="font-size-14 text-gray-90 mb-0">Showing 1–25 of 56 results</p> -->
                </div>
                <!-- Shop-control-bar -->
                @if(count($child->products) > 0)
                <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                    <div class="row d-none d-md-flex w-100">
                        <div class="sorting col-md-5 pl-5">
                            <!-- Select -->
                            <select class="sorting js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0" data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                <option @if($request->sort == 0) selected @endif value="0" selected>Default sorting</option>
                                <option @if($request->sort == 1) selected @endif value="1">Sort by price: low to high</option>
                                <option @if($request->sort == 2) selected @endif value="2">Sort by price: high to low</option>
                            </select>
                            <!-- End Select -->
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5 d-flex align-items-center justify-content-end">
                            <!-- Select -->
                            <select class="products-per-view js-select selectpicker dropdown-select max-width-120" data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                <option @if($request->products == 24) selected @endif value="24">Show 24</option>
                                <option @if($request->products == 48) selected @endif value="48">Show 48</option>
                                <option @if($request->products == "all") selected @endif value="all">Show All</option>
                            </select>
                            <!-- End Select -->
                        </div>
                        </form>
                    </div>

                    <div class="row d-flex d-md-none w-100">
                        <div class="sorting col-6">
                            <!-- Select -->
                            <select class="sorting js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0" data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                <option @if($request->sort == 0) selected @endif value="0" selected>Default sorting</option>
                                <option @if($request->sort == 1) selected @endif value="1">Sort by price: low to high</option>
                                <option @if($request->sort == 2) selected @endif value="2">Sort by price: high to low</option>
                            </select>
                            <!-- End Select -->
                        </div>
                        <div class="col-6 d-flex align-items-center justify-content-end">
                            <!-- Select -->
                            <select class="products-per-view js-select selectpicker dropdown-select max-width-120" data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                <option @if($request->products == 24) selected @endif value="24">Show 24</option>
                                <option @if($request->products == 48) selected @endif value="48">Show 48</option>
                                <option @if($request->products == "all") selected @endif value="all">Show All</option>
                            </select>
                            <!-- End Select -->
                        </div>
                        </form>
                    </div>
                </div>
                @endif
                <!-- End Shop-control-bar -->

                <div class="product-listing col-12">
                    @if(count($child->products) > 0)
                    <div class="row">
                        @if(isset($request->products))
                            @if($request->products == "all")
                                @php $products = $child->products()->get(); @endphp
                            @else
                                @php $products = $child->products()->paginate($request->products); @endphp
                            @endif
                        @else
                            @php $products = $child->products()->paginate(24); @endphp
                        @endif
                        
                        @php $sorting = $products; @endphp

                        @if(isset($request->sort))
                            @if($request->sort == 1)
                                @php $sorting = $products->sortBy('product_detail.price'); @endphp <!-- Sort ascending -->
                            @elseif($request->sort == 2)
                                @php $sorting = $products->sortByDesc('product_detail.price'); @endphp <!-- Sort descending -->
                            @endif
                        @endif

                        @foreach($sorting as $product)
                            @php
                                $routeParameters = [];
                                $slugs=[
                                    $main_cat->slug ?? null,
                                    $parent->slug ?? null,
                                    $child->slug ?? null,
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
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-0 mb-4 mt-4">
                                <div class="alert alert-primary text-white mb-0" role="alert">
                                    No products in this category. Here is a list of other products you might want to have a look.
                                </div>
                            </div>

                            <!-- <p class="notice">
                                No products in this category. Here is a list of other products you might want to have a look.
                            </p> -->
                            <ul class="row list-unstyled products-group no-gutters">
                                @foreach ($products as $product)
                                    @php
                                        $routeParameters = [];
                                        $slugs = [
                                            $product->product_to_category->first()->category_detail->parent_info->grand_parent_info->slug ?? null,
                                            $product->product_to_category->first()->category_detail->parent_info->slug ?? null,
                                            $product->product_to_category->first()->category_detail->slug ?? null,
                                            $product->slug
                                        ];

                                        foreach ($slugs as $slug) {
                                            if ($slug !== null) {
                                                $routeParameters[] = $slug;
                                            }
                                        }
                                    @endphp

                                    <li class="col-md-3 col-sm-6 ">
                                        @include('frontend.inc.product-card')
                                    </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        {{-- @endif --}}
                        @if($request->products != 'all')
                            @if($child->products()->count() > 0)
                            <nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
                                <div class="text-center text-md-left mb-3 mb-md-0">Showing {{ $products->count() }} results out of {{ $child->products()->count() }}</div>
                                <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
                                    @php
                                        $startPage = max(1, $products->currentPage() - 3);
                                        $endPage = min($products->lastPage(), $products->currentPage() + 3);
                                    @endphp
                                    @for ($page = $startPage; $page <= $endPage; $page++)
                                        @if ($page==$products->currentPage())
                                            <li class="page-item"><a class="page-link current" href="javascript:void(0)">{{ $page }}</a></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $products->appends(request()->query())->url($page) }}">{{ $page }}</a></li>
                                        @endif
                                    @endfor
                                    @if ($products->hasMorePages())
                                        <li class="page-item"><a class="page-link" href="{{ $products->appends(request()->query())->nextPageUrl() }}">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a></li>
                                    @endif

                                </ul>
                            </nav>
                            @endif
                        @endif
                    </div>

                    <!-- End Shop Pagination -->
                </div>
            </div>

        </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->


@endsection

@section('js')
<script>
    $(document).ready(function() {
        $(".products-per-view").change(function() {
            var value = $(this).val();

            if (value > 0) {
                var url = new URL(window.location.href);
                if (url.searchParams.has("products")) {
                    url.searchParams.set("products", value);
                } else {
                    url.searchParams.append("products", value);
                }

                window.location.href = url.toString();
            }
            else if (value === "all") {
                var url = new URL(window.location.href);
                if(url.searchParams.has("page")){
                    url.searchParams.delete("page");
                }
                url.searchParams.set("products", "all");
                window.location.href = url.toString();
            }
        });

        $('.sorting').change(function(){
            var value = $(this).val();

            if(value > 0){
                var url = new URL(window.location.href);
                if (url.searchParams.has("sort")) {
                    url.searchParams.set("sort", value);
                } else {
                    url.searchParams.append("sort", value);
                }

                window.location.href = url.toString();
            }
        });

    });
</script>
@endsection
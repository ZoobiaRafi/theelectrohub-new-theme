<!-- ========== HEADER ========== -->
@php use App\ProductToCategory; @endphp
<header id="header" class="u-header u-header-left-aligned-nav u-header--bg-transparent u-header--white-nav-links-md u-header--abs-top">
    <div class="u-header__section">
        <!-- Topbar -->
        <div class="u-header-topbar py-2 d-none d-xl-block border-0">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="topbar-left">
                        <a href="#" class="d-none text-gray-30 font-size-13 hover-on-dark">Welcome to Worldwide Electronics Store</a>
                    </div>
                    <div class="topbar-right ml-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                            <a href="{{route('track_order')}}" class="u-header-topbar__nav-link text-gray-30"><i class="ec ec-transport mr-1"></i> Track Your Order</a>
                            </li>
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border d-none">
                            <a href="#" class="u-header-topbar__nav-link text-gray-30"><i class="ec ec-map-pointer mr-1"></i> Store Locator</a>
                            </li>
                            <li class="d-none list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">
                                <div class="d-flex align-items-center">
                                    <!-- Language -->
                                    <div class="position-relative">
                                        <a id="languageDropdownInvoker" class="dropdown-nav-link dropdown-toggle text-gray-30-imp d-flex align-items-center u-header-topbar__nav-link font-weight-normal" href="javascript:;" role="button" aria-controls="languageDropdown" aria-haspopup="true" aria-expanded="false" data-unfold-event="hover" data-unfold-target="#languageDropdown" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                            <span class="d-inline-block d-sm-none">US</span>
                                            <span class="d-none d-sm-inline-flex align-items-center"><i class="ec ec-dollar mr-1"></i> Dollar (US)</span>
                                        </a>

                                        <div id="languageDropdown" class="dropdown-menu dropdown-unfold" aria-labelledby="languageDropdownInvoker">
                                            <a class="dropdown-item active" href="#">English</a>
                                            <a class="dropdown-item" href="#">Deutsch</a>
                                            <a class="dropdown-item" href="#">Español‎</a>
                                        </div>
                                    </div>
                                    <!-- End Language -->
                                </div>
                            </li>
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <!-- Account Sidebar Toggle Button -->
                                @if(Auth::check())
                                    <a id="sidebarNavToggler" href="{{route('account')}}" role="button" class="u-header-topbar__nav-link text-gray-30">
                                        <i class="ec ec-user mr-1"></i> Welcome! <span class="text-gray-50"> {{ Auth::user()->name }}</span>
                                    </a>
                                    <a href="{{ route('logout') }}" role="button" class="u-header-topbar__nav-link text-gray-30">
                                        <i class="ec ec-logout mr-1"></i> Logout </span>
                                    </a>
                                @else
                                    <a id="sidebarNavToggler" href="javascript:void(0);" role="button" class="u-header-topbar__nav-link text-gray-30" aria-controls="sidebarContent" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent" data-unfold-type="css-animation" data-unfold-animation-in="fadeInRight" data-unfold-animation-out="fadeOutRight" data-unfold-duration="500">
                                        <i class="ec ec-user mr-1"></i> Register <span class="text-gray-50">or</span> Sign in
                                    </a>
                                @endif
                                <!-- End Account Sidebar Toggle Button -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Logo-Search-header-icons -->
        <div class="py-1 mobile-sticky-header">
            <div class="container">
                <div class="row align-items-center my-xl-0 bg-dark-header height-60 rounded-pill mx-0 px-md-3">
                    <!-- Logo-offcanvas-menu -->
                    <div class="col-auto pr-0">
                        <!-- Nav -->
                        <nav class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                            <!-- Logo -->
                            <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center" href="{{route('homePage')}}" aria-label="Electro">
                                <img src="{{url('storage/' . setting('site.logo'))}}" alt="logo">
                            </a>
                            <!-- End Logo -->

                            <!-- Fullscreen Toggle Button -->
                            <button id="sidebarHeaderInvokerMenu" type="button" class="navbar-toggler d-block btn u-hamburger u-hamburger--white mr-2 mr-md-3 mr-xl-0" aria-controls="sidebarHeader" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation" data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft" data-unfold-duration="500">
                                <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                    <span class="u-hamburger__inner"></span>
                                </span>
                            </button>
                            <!-- End Fullscreen Toggle Button -->
                        </nav>
                        <!-- End Nav -->

                        <!-- ========== HEADER SIDEBAR ========== -->
                        <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarHeaderInvoker">
                            <div class="u-sidebar__scroller">
                                <div class="u-sidebar__container">
                                    <div class="u-header-sidebar__footer-offset">
                                        <!-- Toggle Button -->
                                        <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-4 bg-white">
                                            <button type="button" class="close ml-auto" aria-controls="sidebarHeader" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation" data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft" data-unfold-duration="500">
                                                <span aria-hidden="true"><i class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                            </button>
                                        </div>
                                        <!-- End Toggle Button -->

                                        <!-- Content -->
                                        <div class="js-scrollbar u-sidebar__body">
                                            <div id="headerSidebarContent" class="u-sidebar__content u-header-sidebar__content">
                                                <!-- Logo -->
                                                <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center mb-3" href="{{route('homePage')}}" aria-label="Electro">
                                                    <img src="/frontend/logo-black.png" alt="nav-logo">
                                                </a>
                                                <!-- End Logo -->

                                                <!-- List -->
                                                <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                    @php $ccount = 0; @endphp
                                                    @foreach ($menu_categories as $main_category)
                                                        @php $check = 0; @endphp
                                                        @php
                                                            $all_category_ids = [$main_category->id];
                                                    
                                                            foreach ($main_category->sub_categories as $child) {
                                                                $all_category_ids[] = $child->id;
                                                    
                                                                foreach ($child->sub_categories as $sub_child) {
                                                                    $all_category_ids[] = $sub_child->id;
                                                                }
                                                            }
                                                    
                                                            $check = ProductToCategory::whereIn('cat_id', $all_category_ids)->exists() ? 1 : 0;
                                                        @endphp
                                                        @php $ccount+=1; @endphp
                                                        @if($check == 1)
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="{{url($main_category->slug)}}" data-target="#headerSidebarCollapse{{$ccount}}" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarCollapse{{$ccount}}">{{$main_category->title}}
                                                                </a>
                                                                <div id="headerSidebarCollapse{{$ccount}}" class="collapse" data-parent="#headerSidebarContent">
                                                                    <ul class="u-header-collapse__nav-list">
                                                                        @foreach ($main_category->sub_categories as $parent_category)
                                                                            @php
                                                                                $child_category_ids = $parent_category->sub_categories->pluck('id')->toArray();
                                                                                $category_ids = array_merge([$parent_category->id], $child_category_ids);
                                                                                $getcategoryproducts = ProductToCategory::whereIn('cat_id', $category_ids)->get();
                                                                                $temp = $getcategoryproducts->count() > 0 ? 1 : 0;
                                                                            @endphp
                                                                            @if($temp == 1)
                                                                                <li><span class="u-header-sidebar__sub-menu-title" href="{{url('/'.$main_category->slug.'/'.$parent_category->slug)}}">{{$parent_category->title}}</span></li>
                                                                                @foreach ($parent_category->sub_categories as $child_category)
                                                                                    @php 
                                                                                        $flag = 0;
                                                                                        $getcategoryproducts = ProductToCategory::where('cat_id' , $child_category->id)->get();
                                                                                        if(count($getcategoryproducts) > 0){
                                                                                            $flag = 1;    
                                                                                        }
                                                                                    @endphp 
                                                                                    @if($flag == 1)
                                                                                    <li class=""><a class="u-header-collapse__submenu-nav-link" href="{{url('/'.$main_category->slug.'/'.$parent_category->slug.'/'.$child_category->slug)}}">
                                                                                            {{$child_category->title}}
                                                                                        </a></li>
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif

                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                    @php $flagx=10; @endphp
                                                    @foreach ($nav_more_categories as $more_category)
                                                        @php $check = 0; @endphp
                                                        @php
                                                            $all_category_ids = [$more_category->id];
                                                    
                                                            foreach ($more_category->sub_categories as $child) {
                                                                $all_category_ids[] = $child->id;
                                                    
                                                                foreach ($child->sub_categories as $sub_child) {
                                                                    $all_category_ids[] = $sub_child->id;
                                                                }
                                                            }
                                                    
                                                            $check = ProductToCategory::whereIn('cat_id', $all_category_ids)->exists() ? 1 : 0;
                                                        @endphp
                                                        @php $ccount+=1; @endphp
                                                        @if($check == 1)
                                                            @php $flagx+=1; @endphp
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer" href="{{url('/'.$more_category->slug)}}" data-target="#headerSidebarCollapse{{$flagx}}" 
                                                                role="button" data-toggle="collapse" aria-expanded="false" aria-controls="headerSidebarCollapse{{$flagx}}">
                                                                    {{$more_category->title}}
                                                                </a>
                                                                <div id="headerSidebarCollapse{{$flagx}}" class="collapse" data-parent="#headerSidebarContent">
                                                                    <ul class="u-header-collapse__nav-list">
                                                                        @foreach ($more_category->sub_categories as $parent_category)
                                                                            @php
                                                                                $child_category_ids = $parent_category->sub_categories->pluck('id')->toArray();
                                                                                $category_ids = array_merge([$parent_category->id], $child_category_ids);
                                                                                $getcategoryproducts = ProductToCategory::whereIn('cat_id', $category_ids)->get();
                                                                                $temp_one = $getcategoryproducts->count() > 0 ? 1 : 0;
                                                                            @endphp
                                                                            @if($temp_one)
                                                                                <li><span class="u-header-sidebar__sub-menu-title" href="{{url('/'.$main_category->slug.'/'.$parent_category->slug)}}">{{$parent_category->title}}</span></li>
                                                                                @foreach ($parent_category->sub_categories as $child_category)
                                                                                    @php 
                                                                                        $flag_one = 0;
                                                                                        $getcategoryproducts = ProductToCategory::where('cat_id' , $child_category->id)->get();
                                                                                        if(count($getcategoryproducts) > 0){
                                                                                            $flag_one = 1;    
                                                                                        }
                                                                                    @endphp
                                                                                    @if($flag_one == 1)
                                                                                            <li class=""><a class="u-header-collapse__submenu-nav-link" href="{{url('/'.$more_category->slug.'/'.$parent_category->slug.'/'.$child_category->slug)}}">
                                                                                        {{$child_category->title}}
                                                                                    </a></li>
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                <!-- End List -->
                                            </div>
                                        </div>
                                        <!-- End Content -->
                                    </div>
                                    <!-- Footer -->
                                    <footer id="SVGwaveWithDots" class="svg-preloader u-header-sidebar__footer">
                                        <!-- <ul class="list-inline mb-0">
                                            <li class="list-inline-item pr-3">
                                                <a class="u-header-sidebar__footer-link text-gray-90" href="{{route('content',['slug' => 'privacy-policy'])}}">Privacy</a>
                                            </li>
                                            <li class="list-inline-item pr-3">
                                                <a class="u-header-sidebar__footer-link text-gray-90" href="{{route('content',['slug' => 'terms-and-conditions'])}}">Terms</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="u-header-sidebar__footer-link text-gray-90" href="#">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </li>
                                        </ul> -->

                                        <!-- SVG Background Shape -->
                                        <div class="position-absolute right-0 bottom-0 left-0 z-index-n1">
                                            <img class="js-svg-injector" src="/frontend/assets/svg/components/wave-bottom-with-dots.svg" alt="Image Description" data-parent="#SVGwaveWithDots">
                                        </div>
                                        <!-- End SVG Background Shape -->
                                    </footer>
                                    <!-- End Footer -->
                                </div>
                            </div>
                        </aside>
                        <!-- ========== END HEADER SIDEBAR ========== -->
                    </div>
                    <style>
                        #searchproduct-item.opened {
                            border-radius: 20px 0px 0px 0px;
                        }
                        #searchProduct1 {
                            transition-duration: 0s;
                        }
                        #searchProduct1.opened {
                            border-radius: 0px 20px 0px 0px;
                        }
                        #search-mobile.opened {
                            border-radius: 20px 0px 0px 0px;
                        }
                        .input-group-append.opened {
                            border-radius: 0px 20px 0px 0px;
                        }
                        .searched-container {
                            position: absolute;
                            background-color: #4c4c4c;
                            width: 100%;
                            top: 40px;
                            z-index: 99;
                            border-radius: 0px 0px 20px 20px;
                            overflow: hidden;
                            display: none;
                        }
                        .searched-container.mobile {
                            width: 91.5%;
                            border-radius: 0px 0px 20px 20px;
                        }
                        .searched-container.opened {
                            display: block;
                        }
                        .searched-container .to-scroll {
                            max-height: 500px;
                            overflow-x: hidden;
                            overflow-y: auto;
                        }
                        .searched-container .to-scroll::-webkit-scrollbar {
                            width: 9px;
                            border-radius: 50px
                        }
                        .searched-container .to-scroll::-webkit-scrollbar-track {
                            background-color: 4c4c4c;
                        }
                        .searched-container .to-scroll::-webkit-scrollbar-thumb {
                            background-color: rgba(255, 255, 255, 0.8);
                            border-radius: 50px;
                            border: 2px solid #4c4c4c;
                        }
                        .searched-container ul{
                            list-style: none;
                            padding: 0px;
                            margin: 0px;
                        }
                        .searched-container.mobile ul li{
                            padding: 10px;
                        }
                        .searched-container ul li{
                            padding: 10px 10px 10px 30px;
                            color: white;
                            opacity: 0.9;
                        }
                        .searched-container ul li:hover{
                            background-color: #1e2022;
                            opacity: 1;
                            cursor: pointer;
                        }

                        /* .input-group-append .btn */

                        .input-group-append .btn.opened {
                            border-radius: 0px 20px 0px 0px !important;
                        }

                    </style>
                    <!-- End Logo-offcanvas-menu -->
                    <!-- Search Bar -->
                    <div class="col d-none d-xl-block">
                        <form class="js-focus-state">
                            <label class="sr-only" for="searchproduct">Search</label>
                            <div class="input-group">
                                <input type="text" style="color: #fff;" class="form-control py-2 pl-5 font-size-15 border-right-0 bg-search height-40 border-width-2 rounded-left-pill border-0 searchproduct-item" id="searchproduct-item" autocomplete="off" placeholder="Search for Products" aria-label="Search for Products" aria-describedby="searchProduct1" required>
                                <div class="input-group-append">
                                    <!-- Select -->
                                    <!-- <select class="js-select selectpicker dropdown-select custom-search-categories-select" data-style="btn bg-search height-40 text-white font-weight-normal border-top border-bottom border-left-0 rounded-0 border-0 border-width-2 pl-0 pr-5 py-2">
                                        <option value="one" selected>All Categories</option>
                                        <option value="two">Two</option>
                                        <option value="three">Three</option>
                                        <option value="four">Four</option>
                                    </select> -->
                                    <!-- End Select -->
                                    <button class="btn btn-primary height-40 py-2 px-3 rounded-right-pill" type="button" id="searchProduct1">
                                        <span class="ec ec-search text-white font-size-24"></span>
                                    </button>
                                </div>
                                <div class="searched-container">
                                    <div class="to-scroll">
                                        <ul class="suggestions-container"></ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Search Bar -->
                    <!-- Header Icons -->
                    <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                        <div class="d-inline-flex">
                            <ul class="d-flex list-unstyled mb-0 align-items-center">
                                <!-- Search -->
                                <li class="col d-xl-none px-2 px-sm-3 position-static">
                                    <a id="searchClassicInvoker" class="font-size-22 text-white text-lh-1 btn-text-secondary" href="javascript:;" role="button" data-toggle="tooltip" data-placement="top" title="Search" aria-controls="searchClassic" aria-haspopup="true" aria-expanded="false" data-unfold-target="#searchClassic" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                        <span class="ec ec-search "></span>
                                    </a>

                                    <!-- Input -->
                                    <div id="searchClassic" class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2" aria-labelledby="searchClassicInvoker">
                                        <form class="js-focus-state input-group px-3">
                                            <input class="form-control searchproduct-item" type="search" placeholder="Search Product" id="search-mobile">
                                            <div class="input-group-append">
                                                <button id="search-mobile-button" class="btn btn-primary px-3 rounded-right-pill" type="button"><i class="font-size-18 ec ec-search text-white"></i></button>
                                            </div>
                                            <div class="searched-container mobile">
                                                <div class="to-scroll">
                                                    <ul class="suggestions-container"></ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Input -->
                                </li>
                                <!-- End Search -->
                                <li class="col d-none"><a href="#" class="text-white" data-toggle="tooltip" data-placement="top" title="Compare"><i class="font-size-22 ec ec-compare"></i></a></li>
                                <li class="col d-none d-xl-block"><a href="{{route('getWishlist')}}" class="text-white" data-toggle="tooltip" data-placement="top" title="Wishlist"><i class="font-size-22 ec ec-favorites"></i></a></li>
                                <li class="col d-xl-none px-2 px-sm-3">
                                @if(Auth::check())
                                    <a href="{{route('account')}}" class="text-white" data-toggle="tooltip" data-placement="top" title="My Account">
                                        <i class="font-size-22 ec ec-user"></i>
                                    </a>
                                @else 
                                <a id="phone-login-btn" href="javascript:void(0);" role="button" class="text-white" data-toggle="tooltip" data-placement="top" title="My Account">
                                        <i class="font-size-22 ec ec-user"></i>
                                    </a>
                                @endif
                                </li>
                                <li class="col pr-xl-0 px-2 px-sm-3 d-xl-none">
                                    <a href="{{route('my_cart')}}" class="text-white position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart">
                                        <i class="font-size-22 ec ec-shopping-bag"></i>
                                        <span class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 total-qty"></span>
                                        <span class="d-none d-xl-block font-weight-bold font-size-16 text-white ml-3 total-cart-price"></span>
                                    </a>
                                </li>
                                <li class="col pr-xl-0 px-2 px-sm-3 d-none d-xl-block">
                                    <div id="basicDropdownHoverInvoker" class="text-gray-90 position-relative d-flex " data-toggle="tooltip" data-placement="top" title="Cart" aria-controls="basicDropdownHover" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#basicDropdownHover" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                        <i id="cart-btn" class="my-cart font-size-22 ec ec-shopping-bag text-white"></i>
                                        <span class="bg-lg-down-black my-cart width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 total-qty"></span>
                                        <span class="d-none d-xl-block my-cart font-weight-bold font-size-16 text-white ml-3 total-cart-price"></span>
                                    </div>
                                    <div id="basicDropdownHover" class="cart-dropdown dropdown-menu dropdown-unfold border-top border-top-primary mt-3 border-width-2 border-left-0 border-right-0 border-bottom-0 left-auto right-0" aria-labelledby="basicDropdownHoverInvoker">
                                        <ul class="list-unstyled px-3 pt-3 get-cart-list">
                                            
                                            <li class="border-bottom pb-3 mb-3">Your cart is empty</li>
                                        </ul>
                                        <div class="flex-center-between px-4 pt-2">
                                            <a href="{{route('my_cart')}}" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5">My Cart</a>
                                            <a href="{{ route('checkout') }}" class="btn btn-primary-dark twxt-white-w ml-md-2 px-5 px-md-4 px-lg-5">Checkout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Logo-Search-header-icons -->

        <!-- Primary-menu-wide -->
        <div class="d-none d-xl-block">
            <div class="container">
                <div class="min-height-45">
                    <!-- Nav -->
                    <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar  u-header__navbar--no-space">
                        <!-- Navigation -->
                        <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                            <ul class="navbar-nav u-header__navbar-nav">
                                <!-- Home -->
                                @php $count = 0; @endphp
                                @foreach ($menu_categories as $main_categories)
                                    @php $check = 0; @endphp
                                    @php
                                        $all_category_ids = [$main_categories->id];
                                
                                        foreach ($main_categories->sub_categories as $child) {
                                            $all_category_ids[] = $child->id;
                                
                                            foreach ($child->sub_categories as $sub_child) {
                                                $all_category_ids[] = $sub_child->id;
                                            }
                                        }
                                
                                        $check = ProductToCategory::whereIn('cat_id', $all_category_ids)->exists() ? 1 : 0;
                                    @endphp
                                    @php $count+=1; @endphp
                                    @if($check == 1)
                                        <li class="nav-item hs-has-mega-menu u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut" data-position="left">
                                            <a id="homeMegaMenu{{$count}}" class="nav-link u-header__nav-link text-gray-30 u-header__nav-link-toggle" aria-haspopup="true" aria-expanded="false" href="{{url($main_categories->slug)}}">{{$main_categories->title}}</a>
        
                                            <!-- Home - Mega Menu -->
                                            <div class="hs-mega-menu w-100 u-header__sub-menu" aria-labelledby="homeMegaMenu{{$count}}">
                                                <div class="row u-header__mega-menu-wrapper">
                                                    @foreach ($main_categories->sub_categories as $parent_category)
                                                        @php
                                                            $child_category_ids = $parent_category->sub_categories->pluck('id')->toArray();
                                                            $category_ids = array_merge([$parent_category->id], $child_category_ids);
                                                            $getcategoryproducts = ProductToCategory::whereIn('cat_id', $category_ids)->get();
                                                            $temp = $getcategoryproducts->count() > 0 ? 1 : 0;
                                                        @endphp
                                                        @if($temp == 1)
                                                            <div class="col-md-3">
                                                                <span class="u-header__sub-menu-title"><a href="{{url('/'.$main_categories->slug.'/'.$parent_category->slug)}}">{{$parent_category->title}}</a></span>
                                                                <ul class="u-header__sub-menu-nav-group">
                                                                    @foreach ($parent_category->sub_categories as $child_category)
                                                                        @php 
                                                                            $flag = 0;
                                                                            $getcategoryproducts = ProductToCategory::where('cat_id' , $child_category->id)->get();
                                                                            if(count($getcategoryproducts) > 0){
                                                                                $flag = 1;    
                                                                            }
                                                                        @endphp 
                                                                        @if($flag == 1)
                                                                            <li><a class="nav-link u-header__sub-menu-nav-link" href="{{url('/'.$main_categories->slug.'/'.$parent_category->slug.'/'.$child_category->slug)}}">{{$child_category->title}}</a></li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- End Home - Mega Menu -->
                                        </li>
                                    @endif
                                @endforeach
                                <!-- End Home -->
                                <li class="nav-item hs-has-mega-menu u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut" data-position="left">
                                    <a id="homeMegaMenu{{$count}}" class="nav-link u-header__nav-link text-gray-30 u-header__nav-link-toggle" aria-haspopup="true" aria-expanded="false" href="javascript:void(0);"style="width:120px;">More Categories</a>
                                    <div class="hs-mega-menu w-100 u-header__sub-menu" aria-labelledby="homeMegaMenu{{$count}}">
                                        <div class="row u-header__mega-menu-wrapper px-0">
                                            <div class="col-md-3 col-lg-2 col-sm-3 px-0 more-cat-col">
                                                <div class="more-categories">
                                                    <h6>More Categories</h6>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                            @php $nav_count = 0; @endphp
                                                            @foreach ($nav_more_categories as $nav_more_category)
                                                                @php 
                                                                    $check_one = 0; 
                                                                @endphp
                                                                @php
                                                                    $all_category_ids = [$nav_more_category->id];
                                                            
                                                                    foreach ($nav_more_category->sub_categories as $child) {
                                                                        $all_category_ids[] = $child->id;
                                                            
                                                                        foreach ($child->sub_categories as $sub_child) {
                                                                            $all_category_ids[] = $sub_child->id;
                                                                        }
                                                                    }
                                                            
                                                                    $check_one = ProductToCategory::whereIn('cat_id', $all_category_ids)->exists() ? 1 : 0;
                                                                @endphp
                                                                @if($check_one == 1)
                                                                    @php $nav_count++; @endphp
                                                                    <button class="nav-link {{($nav_count == 1) ? ' active' : '' }} w-100" id="v-pills-{{$nav_count}}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{$nav_count}}" type="button" role="tab" aria-controls="v-pills-{{$nav_count}}" aria-selected="{{($nav_count==1) ? 'true' : 'false'}}">{{$nav_more_category->title}}</button>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-lg-9 col-sm-9 ml-5">
                                                <div class="row">
                                                    <div class="tab-content w-100" id="v-pills-tabContent">
                                                        @php
                                                            $content_count = 0;
                                                        @endphp
                                                        @foreach ($nav_more_categories as $nav_more_category)
                                                            @php 
                                                                $check_one = 0; 
                                                            @endphp
                                                            @php
                                                                $all_category_ids = [$nav_more_category->id];
                                                        
                                                                foreach ($nav_more_category->sub_categories as $child) {
                                                                    $all_category_ids[] = $child->id;
                                                        
                                                                    foreach ($child->sub_categories as $sub_child) {
                                                                        $all_category_ids[] = $sub_child->id;
                                                                    }
                                                                }
                                                        
                                                                $check_x = ProductToCategory::whereIn('cat_id', $all_category_ids)->exists() ? 1 : 0;
                                                            @endphp
                                                            @if($check_x == 1)
                                                                @php $content_count++; @endphp
                                                                <div class="tab-pane fade {{($content_count == 1) ? ' show active' : '' }}" id="v-pills-{{$content_count}}" role="tabpanel" aria-labelledby="v-pills-{{$content_count}}-tab">
                                                                    <div class="row">
                                                                        @foreach ($nav_more_category->sub_categories as $more_parent_category)
                                                                            @php
                                                                                $child_category_ids = $more_parent_category->sub_categories->pluck('id')->toArray();
                                                                                $category_ids = array_merge([$more_parent_category->id], $child_category_ids);
                                                                                $getcategoryproducts = ProductToCategory::whereIn('cat_id', $category_ids)->get();
                                                                                $temp_one = $getcategoryproducts->count() > 0 ? 1 : 0;
                                                                            @endphp
                                                                            @if($temp_one)
                                                                                <div class="mega-menu-items col-md-3 col-lg-3 col-sm-3">
                                                                                    <span class="u-header__sub-menu-title"><a href="{{url('/'.$nav_more_category->slug.'/'.$more_parent_category->slug)}}">{{$more_parent_category->title}}</a></span>
                                                                                    <ul class="u-header__sub-menu-nav-group">
                                                                                        @foreach ($more_parent_category->sub_categories as $child_category)
                                                                                            @php 
                                                                                                $flag_one = 0;
                                                                                                $getcategoryproducts = ProductToCategory::where('cat_id' , $child_category->id)->get();
                                                                                                if(count($getcategoryproducts) > 0){
                                                                                                    $flag_one = 1;    
                                                                                                }
                                                                                            @endphp
                                                                                            @if($flag_one == 1)
                                                                                                <li><a class="nav-link u-header__sub-menu-nav-link" href="{{url('/'  .$nav_more_category->slug.'/'.$parent_category->slug.'/'.$child_category->slug)}}"  >{{$child_category->title}}</a></li>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- End Navigation -->
                    </nav>
                    <!-- End Nav -->
                </div>
            </div>
        </div>
        <!-- End Primary-menu-wide -->
    </div>
</header>
<!-- ========== END HEADER ========== -->
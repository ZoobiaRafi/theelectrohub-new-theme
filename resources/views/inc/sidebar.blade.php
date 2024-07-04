@php
$page  = explode("/", $_SERVER['REQUEST_URI'])[2];
@endphp
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('dashboard')}}">
                <span class="brand-logo">
                    <img width="100%" src="{{url('storage')}}/{{setting('site.logo')}}">
                </span>
                {{-- <h2 class="brand-text">{{ucwords(config('app.name'))}}</h2> --}}
                </a></li>
            <li class="nav-item nav-toggle d-none"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item @if($page == "home") active @endif"><a class="d-flex align-items-center" href="{{route('dashboard')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a></li>
            @can('browse' , app('\TCG\Voyager\Models\User'))
                <li class=" nav-item @if($page == "users") active @endif"><a class="d-flex align-items-center" href="{{route('users',$user->ref_key)}}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Users</span></a></li>
            @endcan
            @can('browse' , app('\App\Vendor'))
                <li class=" nav-item @if($page == "vendor") active @endif"><a class="d-flex align-items-center" href="{{route('vendor',$user->ref_key)}}"><i class="fa-light fa-heart"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Vendor</span></a></li>
            @endcan
            @can('browse' , app('\App\Category'))
                <li class=" nav-item @if($page == "category") active @endif"><a class="d-flex align-items-center" href="{{route('category',$user->ref_key)}}"><i class="fa-light fa-list-tree"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Category</span></a></li>
            @endcan
            @can('browse' , app('\App\Product'))
                <li class=" nav-item @if($page == "product") active @endif"><a class="d-flex align-items-center" href="{{route('product',$user->ref_key)}}"><i class="fa-brands fa-product-hunt"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Product</span></a></li>
            @endcan
            @can('browse' , app('\App\CouponCode'))
                <li class=" nav-item @if($page == "coupon-code") active @endif"><a class="d-flex align-items-center" href="{{route('coupon_code',$user->ref_key)}}"><i class="fa-light fa-gift"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Coupon Code</span></a></li>
            @endcan
            @can('browse' , app('\App\Wishlist'))
                <li class=" nav-item @if($page == "wishlist") active @endif"><a class="d-flex align-items-center" href="{{route('wishlist',$user->ref_key)}}"><i class="fa-light fa-heart"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Wishlist</span></a></li>
            @endcan
            @can('browse' , app('\App\Banner'))
                <li class=" nav-item @if($page == "banner") active @endif"><a class="d-flex align-items-center" href="{{route('banner',$user->ref_key)}}"><i class="fa-light fa-image"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Banner</span></a></li>
            @endcan
            @can('browse' , app('\App\ContactusTopic'))
                <li class="nav-item has-sub" style=""><a class="d-flex align-items-center" href="#"><span class="menu-title text-truncate" data-i18n="Invoice"><i class="fa-light fa-headphones"></i> Contact</span></a>
                    <ul class="menu-content">
                        @can('browse' , app('\App\ContactusTopic'))
                            <li class=" nav-item @if($page == "contact-us-topic") active @endif"><a class="d-flex align-items-center" href="{{route('contactustopic',$user->ref_key)}}"><i class="fa-light fa-face-thinking"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Topics</span></a></li>
                        @endcan
                        @can('browse' , app('\App\ContactUsStatus'))
                            <li class=" nav-item @if($page == "contact-us-status") active @endif"><a class="d-flex align-items-center" href="{{route('contactusstatus',$user->ref_key)}}"><i class="fa-light fa-signal-strong"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Status</span></a></li>
                        @endcan
                        @can('browse' , app('\App\ContactU'))
                            <li class=" nav-item @if($page == "contact-us") active @endif"><a class="d-flex align-items-center" href="{{route('contactus',$user->ref_key)}}"><i class="fa-light fa-head-side-headphones"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Requests</span></a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('browse' , app('\App\Faq'))
                <li class=" nav-item @if($page == "faq") active @endif"><a class="d-flex align-items-center" href="{{route('faq',$user->ref_key)}}"><i class="fa-light fa-question"></i><span class="menu-title text-truncate" data-i18n="Dashboards">FAQ's</span></a></li>
            @endcan
            @can('browse' , app('\App\StocksStatus'))
                <li class="nav-item has-sub" style=""><a class="d-flex align-items-center" href="#"><span class="menu-title text-truncate" data-i18n="Invoice"><i class="fa-thin fa-arrow-trend-up"></i> Stocks</span></a>
                    <ul class="menu-content">
                        @can('browse' , app('\App\StocksStatus'))
                            <li class=" nav-item @if($page == "stocks-status") active @endif"><a class="d-flex align-items-center" href="{{route('stocks_statuses',$user->ref_key)}}"><i class="fa-light fa-signal-strong"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Status</span></a></li>
                        @endcan
                        @can('browse' , app('\App\Vendor'))
                            <li class=" nav-item @if($page == "vendors" || $page == "add-vendors" || $page == "edit-vendors") active @endif"><a class="d-flex align-items-center" href="{{route('vendors',$user->ref_key)}}"><i class="fa-light fa-industry"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Vendors</span></a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('browse' , app('\App\Order'))
                <li class="nav-item has-sub" style=""><a class="d-flex align-items-center" href="#"><span class="menu-title text-truncate" data-i18n="Invoice"><i class="fa-light fa-truck-fast"></i> Orders</span></a>
                    <ul class="menu-content">
                        @can('browse' , app('\App\Order'))
                            <li class=" nav-item @if($page == "order") active @endif"><a class="d-flex align-items-center" href="{{route('order',$user->ref_key)}}"><i class="fa-light fa-cart-shopping"></i><span class="menu-title text-truncate" data-i18n="Dashboards">All Orders</span></a></li>
                        @endcan
                        @can('browse' , app('\App\OrderStatus'))
                            <li class=" nav-item @if($page == "order-status") active @endif"><a class="d-flex align-items-center" href="{{route('order_statuses',$user->ref_key)}}"><i class="fa-light fa-signal-strong"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Status</span></a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('browse' , app('\App\ContentPage'))
                <li class=" nav-item @if($page == "content-page") active @endif"><a class="d-flex align-items-center" href="{{route('content_page',$user->ref_key)}}"><i class="fa-light fa-shield-check"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Content Page</span></a></li>
            @endcan
            {{-- @can('browse' , app('\App\Promotion'))
                <li class=" nav-item @if($page == "promotion") active @endif"><a class="d-flex align-items-center" href="{{route('promotion',$user->ref_key)}}"><i class="fa-solid fa-rectangle-ad"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Promotions</span></a></li>
            @endcan--}}
            {{-- @can('browse' , app('\App\Ticker'))
                <li class=" nav-item @if($page == "ticker") active @endif"><a class="d-flex align-items-center" href="{{route('ticker',$user->ref_key)}}"><i class="fa-light fa-ticket"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Ticker</span></a></li>
            @endcan--}}
            {{-- <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li> --}}
            @can('browse' , app('\App\Newsletter'))
                <li class=" nav-item @if($page == "newsletter") active @endif"><a class="d-flex align-items-center" href="{{route('newsletter',$user->ref_key)}}"><i class="fa-light fa-heart"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Newsletter</span></a></li>
            @endcan
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
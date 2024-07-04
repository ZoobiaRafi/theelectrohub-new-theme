<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <link data-n-head="ssr" data-hid="canonical" rel="canonical" href="{{request()->url()}}">

    @yield('title')
    <link rel="apple-touch-icon" href="{{url('backend/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('storage')}}/{{setting('site.favicon')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css" >
    <!-- END: Custom CSS-->

    @yield('css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    @include('inc.header')
    @include('inc.sidebar')

    <!-- BEGIN: Content-->
    <div id="app" class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        @yield('body')
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('inc.footer')


    <!-- BEGIN: Vendor JS-->
    <script src="{{url('backend/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->


    <!-- BEGIN: Theme JS-->
    <script src="{{url('backend/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{url('backend/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    {{-- Vue JS Start --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    {{-- Vue Js End --}}
    <script>
        
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
            var key = localStorage.getItem("darkmode");
            if(key == 'true'){
                setTimeout(() => {
                    $(".modes").trigger('click');
                }, 100);
            }
        });

        $(document).ready(function(){
            $(".modes").click(function(event){
                if(event.originalEvent){
                    var key = localStorage.getItem("darkmode");
                    if(key == 'true'){
                        localStorage.removeItem("darkmode");
                    }
                    else{
                        localStorage.setItem("darkmode", 'true');
                        
                    }
                }
            });
        });
        // var inactivityTimeout = 1000000000000000000;
        // var logoutTimer;

        // function resetLogoutTimer() {
        //     clearTimeout(logoutTimer);
        //     logoutTimer = setTimeout(logoutUser, inactivityTimeout);
        // }
        // function logoutUser() {
        //     window.location.href = '/dashboard/logout';
        // }

        // $(document).ready(function () {
        //     resetLogoutTimer();

        //     $(document).on("mousemove keydown click", function () {
        //         resetLogoutTimer();
        //     });
        // });
    </script>

    @yield('javascript')
</body>
<!-- END: Body-->

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title> @yield('title') </title>
    
   
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="/frontend/fav.png">
    
    @yield('metas')

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
    <link data-n-head="ssr" data-hid="canonical" rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="noindex, nofollow" />
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{url('frontend/assets/vendor/font-awesome/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{url('frontend/assets/css/font-electro.css')}}?ref={{setting('site.cssupdation')}}">

    <link rel="stylesheet" href="{{url('frontend/assets/vendor/animate.css/animate.min.css')}}">
    <link rel="stylesheet" href="{{url('frontend/assets/vendor/hs-megamenu/src/hs.megamenu.css')}}">
    <link rel="stylesheet" href="{{url('frontend/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
    <link rel="stylesheet" href="{{url('frontend/assets/vendor/fancybox/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{url('frontend/assets/vendor/slick-carousel/slick/slick.css')}}">
    <link rel="stylesheet" href="{{url('frontend/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">

    <!-- CSS Electro Template -->
    <link rel="stylesheet" href="{{url('frontend/assets/css/theme.css')}}?ref={{setting('site.cssupdation')}}">

    @yield('css')
    <style>
        .wish-icon{
            font-size: 1.25rem;
        }

        .prodcut-price .nowrap{
            text-wrap: nowrap;
            display: flex;
        }
        .text-ellipsis {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .bg-primary-light{
            background-color: #ff660038;
        }
        .bg-primary-50{
            background-color: #ff6600b3;
        }
        .prodcut-price{
            font-weight: 600;
        }
        .product-wishlist{
            padding: 0.5rem;
            border-radius: 50%;
        }
        .hs-has-mega-menu.nav-item.u-header__nav-item{
            justify-content: center;
            align-items: center;
            display: flex;
            max-width: 150px;
        }

        .u-header--white-nav-links-md:not(.bg-white):not(.js-header-fix-moment) .u-header__nav-link {
            color: #333e48 !important;
        }

        .navbar-expand-md .u-header__mega-menu-wrapper .more-cat-col {
            border-right: 1px solid var(--primary);
        }

        .navbar-expand-md .u-header__mega-menu-wrapper .more-categories {
            padding-right: 10px;
            padding-left: 10px;
            height: auto;
        }

        .navbar-expand-md .u-header__mega-menu-wrapper .more-categories h6 {
            font-weight: 600;
            text-transform: uppercase;
        }

        .navbar-expand-md .u-header__mega-menu-wrapper .more-categories .nav-pills .nav-link {
            color: var(--darkGrey);
            text-align: left;
            background-color: #fff;
            font-weight: 600;
            border: 0;
            border-radius: 0;
        }

        .navbar-expand-md .u-header__mega-menu-wrapper .more-categories .nav-pills .nav-link.active,
        .navbar-expand-md .u-header__mega-menu-wrapper .more-categories .nav-pills .show>.nav-link {
            color: var(--primary);
            /* border: 1px solid var(--primary); */
            background-color: #ff660038;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-expand-md .u-header__mega-menu-wrapper .more-categories .nav-pills .nav-link:hover {
            background-color: #ff660038;
            color: var(--primary);
        }

        .navbar-expand-md .u-header__mega-menu-wrapper .more-categories .nav-pills .nav-link.active:after,
        .navbar-expand-md .u-header__mega-menu-wrapper .more-categories .nav-pills .show>.nav-link:after {
            content: "\2192";
            color: var(--primary);
        }
        #basicDropdownHoverInvoker{
            cursor: pointer;
        }
        #subscribeSrEmail{
            width: 350px;
        }
        .rounded-right-pill {
            border-top-right-radius: 6.1875rem !important;
            border-bottom-right-radius: 6.1875rem !important;
        }
        .breadcrumb-item + .breadcrumb-item {
            padding-left: 0;
        }
        .breadcrumb-item + .breadcrumb-item::before{
            padding-right: 0;
        }
        .breadcrumb-item.active, .breadcrumb-item a{
            padding: 0.438rem 0.875rem;
            background-color: #f5f5f5;
            border-radius: 0.313rem;
        }
        .breadcrumb-item.hover, .breadcrumb-item a:hover{
            background-color: #e8e8e8;
        }
        .last-suggestion{
            background-color: var(--primary);
            color: #fff;
            text-align:center;
        }
        #navBar .navbar-nav.u-header__navbar-nav{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @media only screen and (max-width: 600px) {
        .pt-20{
            padding-top: 4.4rem !important;
            }
            .col-sm-6{
                width: 50% !important;
            }
            .copyrights{
                display:flex;align-items: center;justify-content: center;
            }
            #subscribeSrEmail{
                width: auto;
            }
            #sidebarHeader1{
                width: 100vw;
            }
            .mobile-sticky-header {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 9999;
            }
        }
    </style>

</head>

<body>
    <!-- ========== HEADER ========== -->
    @include('frontend.inc.header')
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    @yield('content')
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- ========== FOOTER ========== -->
    @include('frontend.inc.footer')
    <!-- ========== END FOOTER ========== -->

    <!-- ========== SECONDARY CONTENTS ========== -->
    <!-- Account Sidebar Navigation -->
    @include('frontend.inc.sidebar')
    <!-- End Account Sidebar Navigation -->
    <!-- ========== END SECONDARY CONTENTS ========== -->

    <!-- Go to Top -->
    <a class="js-go-to u-go-to" href="#" data-position='{"bottom": 15, "right": 15 }' data-type="fixed" data-offset-top="400" data-compensation="#header" data-show-effect="slideInUp" data-hide-effect="slideOutDown">
        <span class="fas fa-arrow-up u-go-to__inner"></span>
    </a>
    <!-- End Go to Top -->

    <!-- JS Global Compulsory -->
    <script src="{{url('frontend/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/bootstrap/bootstrap.min.js')}}"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{url('frontend/assets/vendor/appear.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/jquery.countdown.min.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/hs-megamenu/src/hs.megamenu.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/svg-injector/dist/svg-injector.min.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/typed.js/lib/typed.min.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/slick-carousel/slick/slick.js')}}"></script>
    <script src="{{url('frontend/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

    <!-- JS Electro -->
    <script src="{{url('frontend/assets/js/hs.core.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.countdown.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.header.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.hamburgers.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.unfold.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.focus-state.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.malihu-scrollbar.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.validation.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.fancybox.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.onscroll-animation.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.slick-carousel.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.show-animation.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.svg-injector.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.go-to.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/components/hs.selectpicker.js')}}?ref={{setting('site.jsupdation')}}"></script>

    <!-- JS Plugins Init. -->
    <script>
        $(window).on('load', function() {
            // initialization of HSMegaMenu component
            $('.js-mega-menu').HSMegaMenu({
                event: 'hover',
                direction: 'horizontal',
                pageContainer: $('.container'),
                breakpoint: 767.98,
                hideTimeOut: 0
            });

            // initialization of svg injector module
            $.HSCore.components.HSSVGIngector.init('.js-svg-injector');
        });

        $(document).on('ready', function() {
            // initialization of header
            $.HSCore.components.HSHeader.init($('#header'));

            // initialization of animation
            $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                afterOpen: function() {
                    $(this).find('input[type="search"]').focus();
                }
            });

            // initialization of popups
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of countdowns
            var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
                yearsElSelector: '.js-cd-years',
                monthsElSelector: '.js-cd-months',
                daysElSelector: '.js-cd-days',
                hoursElSelector: '.js-cd-hours',
                minutesElSelector: '.js-cd-minutes',
                secondsElSelector: '.js-cd-seconds'
            });

            // initialization of malihu scrollbar
            $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

            // initialization of forms
            $.HSCore.components.HSFocusState.init();

            // initialization of form validation
            $.HSCore.components.HSValidation.init('.js-validate', {
                rules: {
                    confirmPassword: {
                        equalTo: '#signupPassword'
                    }
                }
            });

            // initialization of show animations
            $.HSCore.components.HSShowAnimation.init('.js-animation-link');

            // initialization of fancybox
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of slick carousel
            $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');
           
            // initialization of go to
            $.HSCore.components.HSGoTo.init('.js-go-to');

            // initialization of hamburgers
            $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                beforeClose: function() {
                    $('#hamburgerTrigger').removeClass('is-active');
                },
                afterClose: function() {
                    $('#headerSidebarList .collapse.show').collapse('hide');
                }
            });

            $('#headerSidebarList [data-toggle="collapse"]').on('click', function(e) {
                e.preventDefault();

                var target = $(this).data('target');

                if ($(this).attr('aria-expanded') === "true") {
                    $(target).collapse('hide');
                } else {
                    $(target).collapse('show');
                }
            });

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

            // initialization of select picker
            $.HSCore.components.HSSelectPicker.init('.js-select');
        });
    </script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{url('frontend/assets/js/cart.js')}}?ref={{setting('site.jsupdation')}}"></script>
    <script src="{{url('frontend/assets/js/bootstrap.bundle.js')}}?ref={{setting('site.jsupdation')}}"></script>
    @if(Session::has('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: "warning",
                title: "{{Session::get('error')}}"
            });

        </script>
    @endif
    <script>
        $(document).ready(function(){

            $("#phone-login-btn").on('click',function(event){
                event.stopPropagation(); // Stop propagation to prevent closing of the sidebar
                $('#sidebarNavToggler').trigger('click');
            });

            $(".btn-login").click(function(){
                var email = $("#email").val();
                var password = $("#password").val();

                if(email && password){
                    $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                    $(this).attr('disabled','disabled');
                    $.ajax({
                        url : '/sign-in-submit',
                        type : 'POST',
                        data : {
                            email : email,
                            password : password,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            }
                            else {
                                $(".btn-login").html("Login");
                                $(".btn-login").removeAttr('disabled', 'disabled');
                                $(".alert-text-warning").html(response.message);
                                $(".alert-success").slideUp();
                                $(".alert-warning").slideDown();
                                $(".alert-warning")[0].scrollIntoView();
                            }
                        },
                        
                    });
                }
            });

            $(".btn-register").click(function(){
                var name = $("#signupname").val();
                var email = $("#signupEmail").val();
                var password = $("#signupPassword").val();
                var cpassword = $("#signupConfirmPassword").val();

                if(name){
                    if(email){
                        if(password){
                            if(cpassword){
                                if(password == cpassword){
                                    $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                                    $(this).attr('disabled','disabled');
    
                                    $.ajax({
                                        url : '/sign-up-submit',
                                        type : 'POST',
                                        data : {
                                            name : name,  
                                            email : email,  
                                            password : password,
                                            "_token": "{{ csrf_token() }}",
                                        },
                                        success:function(response){
                                            if(response['status'] == "success"){
                                                $(".alert-text-success").html(response['message']);
                                                $(".alert-success").slideDown();
                                                $(".alert-warning").slideUp();
                                                $(".alert-success")[0].scrollIntoView();
                                                setTimeout(() => {
                                                    location.reload();
                                                },1000);
                                            }
                                            else{
                                                $(".alert-text-warning").html(response['message']);
                                                $(".alert-success").slideUp();
                                                $(".alert-warning").slideDown();
                                                $(".alert-warning")[0].scrollIntoView();
                                                $(".btn-register").removeAttr('disabled');
                                            }
                                        }
                                    })
                                }
                                else{
                                    $(".alert-text-warning").html("Password & Confirm Password does not match");
                                }
                            }
                            else{
                                $(".alert-text-warning").html("Please Enter Confirm Password");
                            }
                        }
                        else{
                            $(".alert-text-warning").html("Please Enter Password");
                        }
                    }
                    else{
                        $(".alert-text-warning").html("Please Enter Email");
                    }
                }
                else{
                    $(".alert-text-warning").html("Please Enter Name");
                }
            });
            
            $("#subscribeButton").click(function(){
                var email = $("#subscribeSrEmail").val();
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                if(email){
                    $.ajax({
                        url : '/newsletter/subscribe',
                        type : 'POST',
                        data : {
                            email : email,  
                            "_token": "{{ csrf_token() }}",
                        },
                        success:function(response){
                            if(response['status'] == "success"){
                                Toast.fire({
                                    icon: "success",
                                    title: response.message
                                });
                                $(".alert-text-success").html(response['message']);
                                $(".alert-success").slideDown();
                                $(".alert-warning").slideUp();
                                $(".alert-success")[0].scrollIntoView();
                                setTimeout(() => {
                                    location.reload();
                                },1000);
                            }
                            else{
                                Toast.fire({
                                    icon: "error",
                                    title: response.message
                                });
                                $(".alert-text-warning").html(response['message']);
                                $(".alert-success").slideUp();
                                $(".alert-warning").slideDown();
                                $(".alert-warning")[0].scrollIntoView();
                                $("#subscribeButton").attr('disabled', 'disabled');
                            }
                        }
                    });
                }
                else{
                    $(".alert-text-warning").html("Please Enter Email");
                }
            });

            $(".btn-recover-password").click(function(){
                var email = $("#recoverEmail").val();

                if(email){
                    $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                    $(this).attr('disabled','disabled');

                    $.ajax({
                        url : '/recover-password-submit',
                        type : 'POST',
                        data : {
                            email : email,
                            "_token": "{{ csrf_token() }}",
                        },
                        success:function(response){
                            if(response['status'] == "success"){
                                $(".alert-text-success").html(response['message']);
                                $(".alert-success").slideDown();
                                $(".alert-warning").slideUp();
                                $(".alert-success")[0].scrollIntoView();
                                setTimeout(() => {
                                    location.reload();
                                },1000);
                            }
                            else{
                                $(".alert-text-warning").html(response['message']);
                                $(".alert-success").slideUp();
                                $(".alert-warning").slideDown();
                                $(".alert-warning")[0].scrollIntoView();
                                $(".btn-recover-password").removeAttr('disabled');
                                $(".btn-recover-password").html('Recover Password');

                            }
                        }
                    })
                }
            });

            $(".searchproduct-item").on('keyup', function () {

                if (event.keyCode === 13) {
                    searchFunction();
                }

                var query = $(this).val();
                var inputElementDesktop = $('#searchproduct-item');
                var inputElementMobile = $('#search-mobile');
                var searchProduct1 = $('#searchProduct1');
                var searchedContainer = $('.searched-container');
                // console.log(query.length);
                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('search.suggestions') }}",
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function (response) {
                            if (response['status'] == 'success') {
                                var data = response['data'];
                                $('.suggestions-container').empty();
                                var html = '';
                                if (data.length > 0) {
                                    for (var i = 0; i < data.length; i++) {
                                        if (i === data.length - 1) {
                                            html += "<a href='" + data[i]['slug'] + "'><li class='last-suggestion'>" + data[i]['title'] + "</li></a>";
                                        } else {
                                            html += "<a href='" + data[i]['slug'] + "'><li>" + data[i]['title'] + "</li></a>";
                                        }
                                        // html += "<a href = " + data[i]['slug'] + " ><li>" + data[i]['title'] + "</li></a>"
                                        $('.suggestions-container').html(html);
                                        inputElementDesktop.addClass('opened');
                                        searchProduct1.addClass('opened');
                                        searchedContainer.addClass('opened');
                                        $('.input-group-append .btn').addClass('opened');
                                        inputElementMobile.addClass('opened');
                                    }
                                } else {
                                    closeSearchContainer();
                                }
                            }
                        }
                    })
                } else if (query.length == 0) {
                    closeSearchContainer();
                } else {
                    closeSearchContainer();
                }
            });

            $('#searchProduct1').on('click', function() {
                searchFunction();
            });

            // $('.searchproduct-item').keydown(function(event) {
            //     if (event.keyCode === 13) {
            //         searchFunction();
            //     }
            // });

            $('#search-mobile-button').on('click', function() {
                searchFunctionMobile();
            });

            $('.searchproduct-item').keydown(function(event) {
                if (event.keyCode === 13) {
                    searchFunctionMobile();
                }
            });

            function searchFunction() {
                var searchInput = $('#searchproduct-item');
                var search = searchInput.val().trim();
                if (search !== '') {
                    window.location.href = "{{ url('search') }}/" + encodeURIComponent(search);
                }
            }

            function searchFunctionMobile() {
                var searchInput = $('#search-mobile');
                var search = searchInput.val().trim();
                if (search !== '') {
                    window.location.href = "{{ url('search') }}/" + encodeURIComponent(search);
                }
            }


            function closeSearchContainer() {
                var clickedSuggestion = false;

                $('.suggestions-container li a').on('click', function(event) {
                    clickedSuggestion = true;
                    event.stopPropagation(); // Stop event propagation to prevent closing the container
                });

                $(document).on('click', function(event) {
                    if (!clickedSuggestion) {
                        $('.suggestions-container').empty();
                        $('#searchproduct-item').removeClass('opened');
                        $('#searchProduct1').removeClass('opened');
                        $('.searched-container').removeClass('opened');
                        $('.input-group-append .btn').removeClass('opened');
                        $('#search-mobile').removeClass('opened');
                    }
                    clickedSuggestion = false; // Reset clickedSuggestion for future clicks
                });
            }

            function showSuggestionsOnFocus() {
                var query = $('.searchproduct-item').val();
                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('search.suggestions') }}",
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function (response) {
                            if (response['status'] == 'success') {
                                var data = response['data'];
                                $('.suggestions-container').empty();
                                if (data.length > 0) {
                                    var html = '';
                                    for (var i = 0; i < data.length; i++) {
                                        if (i === data.length - 1) {
                                            html += "<a href='" + data[i]['slug'] + "'><li class='last-suggestion'>" + data[i]['title'] + "</li></a>";
                                        } else {
                                            html += "<a href='" + data[i]['slug'] + "'><li>" + data[i]['title'] + "</li></a>";
                                        }
                                        // html += "<a href = " + data[i]['slug'] + " ><li>" + data[i]['title'] + "</li></a>"
                                    }
                                    $('.suggestions-container').html(html);
                                    $('.searched-container').addClass('opened');
                                } else {
                                    $('.suggestions-container').html('<a href="javascript:void(0); >"<li>No suggestions found</li></a>');
                                    $('.searched-container').addClass('opened');
                                }
                            }
                        }
                    });
                }
            }

            // Trigger the function when input field gains focus and has a value
            $('.searchproduct-item, #search-mobile').on('focus', function () {
                showSuggestionsOnFocus();
            });


            $('#searchproduct-item, #search-mobile').on('focusout', function () {
                closeSearchContainer();
            });

            $('#searchproduct-item, #search-mobile').on('focusin', function () {
                $('.searched-container').addClass('opened');
            });
              
            $(".add-to-wishlist").click(function(){
                var id = $(this).data('id');
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                if(id){
                    $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");

                    $.ajax({
                        type: 'GET',
                        url: '/add-to-wishlist/' + id,
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                Toast.fire({
                                    icon: "success",
                                    title: response.message
                                });
                                $(".btn-add-to-wishlist-" + id).html('<i class="yith-wcwl-icon fa fa-heart mr-1 font-size-15"></i>Added');
                                $(".btn-add-to-wishlist-" + id).css({
                                                                'pointer-events': 'none',
                                                                'color': '#ff6600'
                                                            });
                            }
                        },
                    });
                }
                else {
                    Toast.fire({
                        icon: "warning",
                        title: "Sorry! we encountered an issue. Please contact our support"
                    });
                }
            });

            $(".add-to-wishlist-phone").click(function(){
                var id = $(this).data('id');
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                if(id){
                    $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");

                    $.ajax({
                        type: 'GET',
                        url: '/add-to-wishlist/' + id,
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                Toast.fire({
                                    icon: "success",
                                    title: response.message
                                });
                                $(".btn-add-to-wishlist-" + id).html('<i class="yith-wcwl-icon fa fa-heart mr-1 font-size-15"></i>');
                                $(".btn-add-to-wishlist-" + id).css({
                                                                'pointer-events': 'none',
                                                                'color': '#ff6600'
                                                            });
                            }
                        },
                    });
                }
                else {
                    Toast.fire({
                        icon: "warning",
                        title: "Sorry! we encountered an issue. Please contact our support"
                    });
                }
            });
        });
    </script>
    @yield('js')
    <!-- <script>
        function stickyHeader(headerId, navId) {
            var header = document.getElementById(headerId);
            var sticky = header.offsetTop;

            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }

        window.onscroll = function() {
            stickyHeader("header-desktop", "nav");
        };
    </script> -->
    <!-- ========== HEADER ========== -->
    @include('frontend.inc.cookie')
    <!-- ========== END HEADER ========== -->

    <!-- ========== WHatsapp ========== -->
    @include('frontend.inc.whatsapp')
    <!-- ========== END WHatsapp ========== -->

    {{-- The Electrohub --}}

</body>

</html>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>Login</title>
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
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/pages/page-auth.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('backend/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div id="app" class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo-->
                        
                        <a href="javascript:void(0);" class="brand-logo">
                            <img src="{{url('storage')}}/{{setting('site.logo')}}">
                            {{-- <h2 class="brand-text text-primary ml-1 mb-2">{{ucwords(config('app.name'))}}</h2> --}}
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{url('backend/app-assets/images/pages/login-v2.svg')}}" alt="Login V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title font-weight-bold mb-1">Welcome to {{ucwords(config('app.name'))}}! 👋</h2>
                                <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
                                <form @keyup.enter="submit"  class="auth-login-form mt-2">
                                    <div class="alert alert-success" v-show = "successAlert" role="alert"><p class="alert-body alert-body-success">@{{ successMessage }} <span v-if="redirecting" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></p></div>
                                    <div class="alert alert-danger alert-dismissible fade show" v-show = "dangerAlert" role="alert"><p class="alert-body alert-body-danger">@{{ dangerMessage }}</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                    <div class="alert alert-warning alert-dismissible fade show" v-show = "warningAlert" role="alert"><p class="alert-body alert-body-warning">@{{ warningMessage }}</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                    <div class="form-group">
                                        <label class="form-label" for="login-email">Email/Password/Contact No</label>
                                        <input v-model = "email" class="form-control" id="login-email" type="text" />
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input v-model = "password" class="form-control form-control-merge" id="login-password" type="password" name="login-password" placeholder="············" aria-describedby="login-password" tabindex="2" />
                                            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                        </div>
                                    </div>
                                    
                                    <button @click = "submit" @keyup.enter="submit" type="button" :disabled="submitting" class="btn btn-primary btn-block btn-submit" tabindex="4"><span v-if="submitting" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>@{{ submitting ? ' Please wait' : 'Sign In' }}</button>
                                </form>
                                
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{url('backend/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{url('backend/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{url('backend/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{url('backend/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{url('backend/app-assets/js/scripts/pages/page-auth-login.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script> -->
    <script src="{{url('backend/app-assets/js/vuejs@2.7.16.js')}}"></script>

    <!-- END: Page JS-->


    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
        document.addEventListener("DOMContentLoaded", function () {
            new Vue({
                el: '#app',
                data: {
                    submitting: false,
                    redirecting: false,
                    successAlert: false,
                    dangerAlert: false,
                    warningAlert: false,
                    successMessage: '',
                    warningMessage: '',
                    dangerMessage: '',
                },

                methods: {
                    submit(){
                        this.submitting = true;
                        const formdata = new FormData();
                        formdata.append("_token", "{{ csrf_token() }}");
                        formdata.append("email", this.email);
                        formdata.append("password", this.password);
                        if(this.email != ""){
                            if(this.password != ""){
                                fetch('/login/submit' , {
                                    method : "POST" , 
                                    body : formdata,
                                })
                                .then((response) => response.json())
                                .then((data) => {
                                    if(data.status == "success"){
                                        this.successMessage = data.message;
                                        this.successAlert = true;
                                        this.warningAlert = false;
                                        this.dangerAlert = false;
                                        setTimeout(() => {
                                            window.location.href = data.redirect;
                                        }, 100);
                                        this.submitting = true;
                                        this.redirecting = true;
                                    }
                                    else if(data.status == "warning"){
                                        this.warningMessage = data.message;
                                        this.successAlert = false;
                                        this.warningAlert = true;
                                        this.dangerAlert = false;
                                    }
                                    else if(data.status == "danger"){
                                        this.dangerMessage = data.message;
                                        this.successAlert = false;
                                        this.warningAlert = false;
                                        this.dangerAlert = true;
                                    }
                                })
                                .catch((error) => {
                                    console.error('Error:', error);
                                })
                                .finally(() => {
                                    this.submitting = false;
                                });
                            }
                            else{
                                this.warningMessage = "Please enter password";
                                this.successAlert = false;
                                this.warningAlert = true;
                                this.submitting = false;
                            }
                        }
                        else{
                            this.warningMessage = "Please enter email";
                            this.successAlert = false;
                            this.warningAlert = true;
                            this.submitting = false;
                        }
                    }
                },
            });
        });
    </script>
</body>
<!-- END: Body-->

</html>
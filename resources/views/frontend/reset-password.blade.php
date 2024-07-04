@extends ('frontend.layout.master')
@section('title')
Home | The Electrohub
@endsection

@section('meta')
@endsection

@section('css')
<style>
    .u-slick__arrow-classic-inner:before {
        color: var(--primary);
    }

    .custom-tbody-scroll {
        display: block;
        width: calc(100% + 65px);
        max-height: 300px;
        overflow: auto;
        padding-right: 20px;
    }

    .custom-tbody-scroll::-webkit-scrollbar {
        width: 5px;
    }

    .custom-tbody-scroll::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.31)
    }

    .custom-tbody-scroll::-webkit-scrollbar-track {
        background-color: rgba(0, 0, 0, 0.114)
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
        
        <div class="my-4 my-xl-12">
            <div class="row">
                <div class="col-md-12 ml-xl-auto mr-md-auto mr-xl-0 mb-8 mb-md-0">
                    <!-- Title -->
                    <div class="border-bottom border-color-1 mb-6">
                        <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Reset Password</h3>
                    </div>
                    <p class="text-gray-90 mb-4">Welcome back! Please reset your password.</p>
                    <!-- End Title -->

                    <div class="alert alert-warning alert-dismissible fade show" style="display: none;" role="alert">
                        <span class="alert-text-warning"><strong>Holy guacamole!</strong> You should check in on some of those fields below.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" style="display: none;" role="alert">
                        <span class="alert-text-success"><strong>Holy guacamole!</strong> You should check in on some of those fields below.</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form class="js-validate" novalidate="novalidate">
                        <!-- Form Group -->
                        <div class="js-form-message form-group">
                            <label class="form-label" for="signinSrPasswordExample2">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-label="Password" required
                            data-msg="Your password is invalid. Please try again."
                            data-error-class="u-has-error"
                            data-success-class="u-has-success">
                        </div>
                        <!-- End Form Group -->
                        <input type="hidden" id="userid" value="{{ $user->id }}">
                        <!-- Form Group -->
                        <div class="js-form-message form-group">
                            <label class="form-label" for="signinSrPasswordExample2">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" id="confirmpassword" placeholder="Password" aria-label="Password" required
                            data-msg="Your confirm password is invalid. Please try again."
                            data-error-class="u-has-error"
                            data-success-class="u-has-success">
                        </div>
                        <!-- End Form Group -->

                        

                        <!-- Button -->
                        <div class="mb-1">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary-dark-w px-5 btn-reset-password">Reset Password</button>
                            </div>
                        </div>
                        <!-- End Button -->
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $(".btn-reset-password").click(function(){
            var password = $("#password").val();
            var cpassword = $("#confirmpassword").val();
            var userid = $("#userid").val();

            if(password){
                if(cpassword){
                    if(password == cpassword){
                        $(".btn-reset-password").attr("disabled", true);
                        $(".btn-reset-password").html("Processing <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");

                        $.ajax({
                            type: "POST",
                            url: "{{route('resetPasswordsubmit')}}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "password": password,
                                "userid": userid
                            },
                            success: function (response) {
                                if(response['status'] == 'success'){
                                    $(".alert-text-success").html(response['message']);
                                    $(".alert-success").slideDown();
                                    $(".alert-warning").slideUp();
                                    $(".alert-success")[0].scrollIntoView();
                                    setTimeout(function(){
                                        window.location.href = '/'
                                    },2000);
                                }
                            }
                        })
                    }
                    else{
                        $(".alert-text-warning").html('<strong>Password!</strong> Password and confirm password does not match.');
                    }
                }
                else{
                    $(".alert-text-warning").html('<strong>Password!</strong> Please enter confirm password.');
                }
            }
            else{
                $(".alert-text-warning").html('<strong>Password!</strong> Please enter password.');
            }
        });
    });
</script>
@endsection
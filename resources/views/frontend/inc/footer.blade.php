<footer>
    <!-- Footer-newsletter -->
    <div class="bg-primary py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-md-3 mb-lg-0 d-flex align-items-center justify-content-center">
                    <div class="row align-items-center">
                        <div class="col-auto flex-horizontal-center">
                            <i class="text-white ec ec-newsletter font-size-40"></i>
                            <h2 class="text-white font-size-20 mb-0 ml-3">Sign up to Newsletter</h2>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-7 d-flex align-items-center justify-content-center">
                    <!-- Subscribe Form -->
                    <form class="js-validate js-form-message">
                        <label class="sr-only" for="subscribeSrEmail">Email address</label>
                        <div class="input-group input-group-pill">
                            <input type="email" class="form-control border-0 height-40" name="email" id="subscribeSrEmail" placeholder="Email address" aria-label="Email address" aria-describedby="subscribeButton" required data-msg="Please enter a valid email address.">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-dark btn-sm-wide height-40 py-2" id="subscribeButton">Sign Up</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-newsletter -->
    <!-- Footer-bottom-widgets -->
    <div class="pt-8 pb-4 bg-gray-13">
        <div class="container mt-1">
            <div class="row">
                <div class="col-lg-5">
                    <div class="mb-6">
                        <a href="#" class="d-inline-block">
                            <img src="/frontend/logo-black.png" alt="logo-footer">
                        </a>
                    </div>
                    <div class="mb-4">
                        <div class="row no-gutters">
                            <div class="col-auto">
                                <i class="ec ec-support text-primary font-size-56"></i>
                            </div>
                            <div class="col pl-3">
                                <div class="font-size-13 font-weight-light">Got questions? Call us on</div>
                                <a href="tel:01582801122" class="font-size-20 text-gray-90">01582 801122</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="mb-4">
                        <h6 class="mb-1 font-weight-bold">Contact info</h6>
                        <address class="">
                            AA Business Centre, 326-340, Dunstable Rd, Luton, LU4 8JS
                        </address>
                    </div> -->
                    <div class="my-4 my-md-4">
                        <ul class="list-inline mb-0 opacity-7">
                            @if(setting('site.facebook'))
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="{{setting('site.facebook')}}">
                                    <span class="fab fa-facebook-f btn-icon__inner"></span>
                                </a>
                            </li>
                            @endif
                            @if(setting('site.instagram'))
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="{{setting('site.instagram')}}">
                                    <span class="fab fa-instagram btn-icon__inner"></span>
                                </a>
                            </li>
                            @endif
                            @if(setting('site.youtube'))
                            <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="{{setting('site.youtube')}}">
                                    <span class="fab fa-youtube btn-icon__inner"></span>
                                </a>
                            </li>
                            @endif
                            <!-- <li class="list-inline-item mr-0">
                                <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="#">
                                    <span class="fab fa-github btn-icon__inner"></span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">Find it Fast</h6>
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                @foreach ($menu_categories as $main_category)
                                <li><a class="list-group-item list-group-item-action" href="{{url($main_category->slug)}}">{{$main_category->title}}</a></li>
                                @endforeach
                            </ul>
                            <!-- End List Group -->
                        </div>

                        <div class="col-md-4 col-sm-6 mb-4 mb-md-0">
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent mt-md-6">
                                @foreach ($nav_more_categories as $more_category)
                                <li><a class="list-group-item list-group-item-action" href="{{url($more_category->slug)}}">{{$more_category->title}}</a></li>
                                @endforeach
                            </ul>
                            <!-- End List Group -->
                        </div>

                        <div class="col-md-4 col-sm-6 mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">Customer Care</h6>
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                            @if(Auth::check())
                                <li><a class="list-group-item list-group-item-action" href="{{route('account')}}">My Account</a></li>
                            @endif
                                <li><a class="list-group-item list-group-item-action" href="{{route('track_order')}}">Order Tracking</a></li>
                                <li><a class="list-group-item list-group-item-action" href="{{route('getWishlist')}}">Wish List</a></li>
                                <li><a class="list-group-item list-group-item-action" href="{{route('content',['slug' => 'privacy-policy'])}}">Privacy Policy</a></li>
                                <li><a class="list-group-item list-group-item-action" href="{{route('content',['slug' => 'terms-and-conditions'])}}">Terms and Conditions</a></li>
                                <li><a class="list-group-item list-group-item-action" href="{{route('faqs')}}">FAQs</a></li>
                                <!-- <li><a class="list-group-item list-group-item-action" href="#">Product Support</a></li> -->
                            </ul>
                            <!-- End List Group -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-bottom-widgets -->
    <!-- Footer-copy-right -->
    <div class="bg-gray-14 py-2">
        <div class="container">
            <div class="flex-center-between d-block d-md-flex copyrights">

                <div class="mb-3 mb-md-0 copyrights">{{ date('Y') }} © Copyright <a href="{{url('/')}}" class="font-weight-bold text-gray-90">&nbsp;{{ ucwords(config('app.name')) }}&nbsp;</a>- All rights Reserved</div>
                <div class="text-md-right">
                    <!-- <span class="d-inline-block bg-white border rounded p-1">
                        <img class="max-width-5" src="/frontend/assets/img/100X60/img1.jpg" alt="Image Description">
                    </span>
                    <span class="d-inline-block bg-white border rounded p-1">
                        <img class="max-width-5" src="/frontend/assets/img/100X60/img2.jpg" alt="Image Description">
                    </span>
                    <span class="d-inline-block bg-white border rounded p-1">
                        <img class="max-width-5" src="/frontend/assets/img/100X60/img3.jpg" alt="Image Description">
                    </span>
                    <span class="d-inline-block bg-white border rounded p-1">
                        <img class="max-width-5" src="/frontend/assets/img/100X60/img4.jpg" alt="Image Description">
                    </span>
                    <span class="d-inline-block bg-white border rounded p-1">
                        <img class="max-width-5" src="/frontend/assets/img/100X60/img5.jpg" alt="Image Description">
                    </span> -->
                    <div class="mb-3 mb-md-0 copyrights">Created with <i class="ec ec-favorites mr-1 font-size-15" style="color: red;"></i> by <a  class="font-weight-bold text-gray-90" href="https://www.optimizedtechandbi.co.uk/">&nbsp;Optimized Tech & Bi&nbsp;</a></div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-copy-right -->
</footer>
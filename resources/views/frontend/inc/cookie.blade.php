<style>
    .modal.show {
        opacity: 1;
        display: flex!important;
        align-items: center;
        justify-content: center;
    }
</style>
<div class="cookie-popup-container" style="display: none;">
    <div class="cookie-popup">
        <div class="cookie-header">
            <img src="{{url('storage/' . setting('site.logo-black'))}}" alt="">
            {{-- <div class="cookie-icon">
                <i class="fa-solid fa-cookie-bite"></i>
            </div>
            <div class="cookie-heading">
                <h3>Cookies Consent</h3>
            </div> --}}
        </div>
        <div class="cookie-para">
            <p>We use cookies to ensure that we give you the best experience on our website and to provide our services.</p>
        </div>
        {{-- <div class="cookie-hr">
            <hr />
        </div> --}}
        <div class="cookie-button-container">
            <div class="nav-buttons">
                <a data-url="" class="accept-btn-desgin btn-customize me-2 mb-2 accept-design">
                    <button class="btn5 accept-cookie">Accept</button>
                </a>
                <a data-url="" class="learn-btn-desgin btn-customize me-2 accept-design">
                    {{-- <button type="button" class="btn5 learn-more">Learn more and customize</button> --}}
                    <button class="learn-desgin" id="learn-more" data-toggle="modal" data-target="#cookieModal">
                        Learn more and customize</button>
                </a>
                {{-- <a  href="{{route('terms_and_conditions')}}"  class="d-flex justify-content-center align-items-center btn-customize">
                    <button class="btn5 transparent">Privacy Policy</button>
                </a> --}}
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="cookieModal" tabindex="-1" role="dialog" aria-labelledby="cookieModalLabel" aria-hidden="true" style="padding-right: 0px;" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-space-between align-items-center">
                <img src="{{url('storage/' . setting('site.logo-black'))}}" alt="">
                <a href="{{route('content',['slug' => 'privacy-policy'])}}" target="_blank" type="button" class="privecy-policy">
                    Privacy Policy
                </a>
            </div>
            <div class="modal-body">
                <div class="body-content">
                    <h1 class="mobal-body-title">Your Privacy Choices</h1>
                    <p class="modal-body-text">
                        You have control over your privacy settings. You can tailor your preferences by toggling specific options on or off. To decline certain data processing activities, simply switch toggles off or select 'Reject all' for a particular category.
                    </p>
                </div>
                <div class="modal-content-btn">
                    <button type="button" class="btn reject-btn"><i class="fa fa-times"></i> Reject all</button>
                    <button type="button" class="btn accept-btn accept"><i class="fa fa-check"></i> Accept all</button>
                </div>
                {{-- <hr> --}}
                {{-- <div class="body-content">
                    <h2 class="mobal-body-title-h6">Your Consent Preferences</h2>
                    <p class="modal-body-text">
                        You have control over your consent preferences for the following tracking technologies:
                    </p>
                </div> --}}
                <hr>
                <div class="purposes-section-body purposes-items">
                    <div class="purposes-item purpose-item-1">
                        <div class="purposes-item-header">
                            <div class="purposes-item-title">
                                <div>
                                    <label for="purpose-1">Necessary</label>
                                </div>
                                <button class="purposes-item-title-btn see-necessary" data-str-off="See description" data-str-on="Hide description">See description</button>
                            </div>
                            {{-- <div class="custom-control custom-switch btn-size">
                                <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                <label class="custom-control-label" for="customSwitch3"></label>
                            </div> --}}
                            <label class="toggle btn-size">
                                <input class="toggle-checkbox" type="checkbox" id="customSwitch3">
                                <div class="toggle-switch"></div>
                                <span class="toggle-label"></span>
                            </label>
                        </div>
                        <div class="purposes-item-body necessary">
                            These cookies are essential for the basic functionality of our website. They enable you to navigate our site and use its features, such as accessing secure areas. Without these cookies, the website cannot function properly.
                        </div>
                    </div>
                    <div class="purposes-item purpose-item-1">
                        <div class="purposes-item-header">
                            <div class="purposes-item-title">
                                <div>
                                    <label for="purpose-1">Performance</label>
                                </div>
                                <button class="purposes-item-title-btn see-marketing" data-str-off="See description" data-str-on=" description">See description</button>
                            </div>
                            <label class="toggle btn-size">
                                <input class="toggle-checkbox accept-all reject-all" type="checkbox" id="customSwitch2">
                                <div class="toggle-switch"></div>
                                <span class="toggle-label"></span>
                            </label>
                        </div>
                        <div class="purposes-item-body marketing">
                            Performance cookies help us understand how visitors interact with our website by collecting information anonymously. This data allows us to analyze and improve the performance of our site, making it easier for users to find what they're looking for.
                        </div>
                    </div>
                    <div class="purposes-item purpose-item-1">
                        <div class="purposes-item-header">
                            <div class="purposes-item-title">
                                <div>
                                    <label for="purpose-1">Functionality</label>
                                </div>
                                <button class="purposes-item-title-btn see-measurement" data-str-off="See description" data-str-on="Hide description">See description</button>
                            </div>
                            <label class="toggle btn-size">
                                <input class="toggle-checkbox accept-all reject-all" type="checkbox" id="customSwitch2">
                                <div class="toggle-switch"></div>
                                <span class="toggle-label"></span>
                            </label>
                        </div>
                        <div class="purposes-item-body measurement">
                            Functionality cookies enable our website to remember choices you make and provide enhanced, more personalized features. For example, these cookies may remember your language preferences or region selection, making your browsing experience smoother and more tailored to your preferences.
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn back-btn" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                <button type="button" class="btn save-btn accept-cookie" data-dismiss="modal">Save and continue</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->


<style>
    /* Custom Html Css Switch Toggle Start*/
    
    .toggle {
    cursor: pointer;
    display: inline-block;
    }
    .toggle-switch {
        display: inline-block;
        background: #e9ecef;
        border-radius: 16px;
        width: 34px;
        height: 17px;
        position: relative;
        vertical-align: middle;
        border: 1px solid #adb5bd;
        transition: background 0.25s;
        &:before,
        &:after {
            content: "";
        }
        &:before {
            display: block;
            /* background: linear-gradient(to bottom, #fff 0%,#eee 100%); */
            border-radius: 50%;
            box-shadow: 0 0 0 1px rgba(0,0,0,0.25);
            width: 12px;
            height: 11px;
            position: absolute;
            top: 2px;
            left: 3px;
            transition: left 0.25s;
            background-color: #bbb9b9;
        }
        .toggle-checkbox:checked + & {
            /* background: $green; */
            background-color: #f26622 ;
            &:before {
                left: 17px;
            }
        }
    }
    .toggle-checkbox {
        position: absolute;
        visibility: hidden;
    }
    .toggle-label {
        position: relative;
        top: 2px;
    }
    /* Custom Html Css Switch Toggle End*/

    .learn-btn-desgin {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .accept-btn-desgin {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom:15px;
    }
    .cookie-blocked {
    width: 100vw !important;
    height: 100vh !important;
    overflow: hidden !important;
    }

    #cookieModal {
    z-index: 99999;
    }
    .cookie-popup-container {
    position: fixed;
    background-color: rgb(12 12 12 / 28%);
    width: 100vw;
    height: 100vh;
    z-index: 99999;
    top: 0;
    overflow: hidden;
    display: none;
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
    }
    .cookie-popup-container .cookie-popup {
    max-width: 480px;
    background-color: #FFFFFF;
    position: absolute;
    bottom: 20px;
    right: 20px;
    /* padding: 10px; */
    border-radius: 5px;
    box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.2);
    }
    .cookie-popup-container .cookie-popup .cookie-header {
    display: flex;
    align-items: center;
    /* padding: 16px; */
    padding: 7px 17px;
    }
    .cookie-popup-container .cookie-popup .cookie-header img {
    height: 50px;
    }
    .cookie-popup-container .cookie-popup .cookie-para {
    /* padding: 16px; */
    padding: 20px 15px 10px 15px;
    background-color: {{setting('site.theme-color')}};
    }
    .cookie-popup-container .cookie-popup .cookie-header .cookie-icon {
    padding-right: 10px;
    }
    .cookie-popup-container .cookie-popup .cookie-header .cookie-icon i {
    font-size: 1.4rem;
    color: {{setting('site.theme-color')}};
    }
    .cookie-popup-container .cookie-popup .cookie-header .cookie-heading h3 {
    color: {{setting('site.theme-color')}};
    font-size: 1.4rem;
    font-weight: bold;
    margin-bottom: 0px;
    }

    .cookie-popup-container .cookie-popup .cookie-hr hr{
    border: 1px solid {{setting('site.theme-color')}};
    }

    .cookie-popup-container .cookie-popup .cookie-button-container .nav-buttons .btn-customize {
    /* margin-right: 20px; */
    padding: 5px 10px;
    border-radius: 19px;
    border: 1px solid transparent;
    }
    .cookie-popup-container .cookie-popup .cookie-button-container .nav-buttons {
    padding: 20px 20px;
    border-radius: 0px 0px 5px 5px;
    background-color: {{setting('site.theme-color')}};
    }

    .cookie-popup-container .cookie-popup .cookie-button-container .nav-buttons .btn-customize.accept-design {
    background-color: #ececec;
    width: 100%;
    }

    .cookie-popup-container .cookie-popup .cookie-button-container .nav-buttons .btn-customize.accept-design button {
    width: 100%;
    font-weight: bold;
    padding: 1px;
    border: transparent;
    color: {{setting('site.theme-color')}};
    }

    .cookie-popup-container .cookie-popup .cookie-button-container .nav-buttons .btn-customize .btn {
        width: 100%;
        font-weight: bold;
        padding: 1px;
        border: transparent;
        color: #000000;
    }

    .cookie-popup-container .cookie-popup .cookie-button-container .nav-buttons .btn-customize button{
    background-color: transparent;
    }

    .cookie-popup-container .cookie-popup .cookie-button-container .nav-buttons .btn-customize:hover button{
    background-color: transparent;
    color: #fff; 
    }

    .cookie-popup-container .cookie-popup .cookie-button-container .nav-buttons .btn-customize:hover {
        border-color: #fff;
        background-color: {{setting('site.theme-color')}};
    }

    .cookie-popup-container .cookie-popup .cookie-para p {
    color: #ececec;
    margin-bottom: 0px;
    }

    .MsoNormal strong span {
    font-family: 'DM Sans', sans-serif!important;
    }

    .MsoNormal span {
    font-family: 'DM Sans', sans-serif!important;
    }


    .modal {
    background-color: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(1px);
    }
    .modal .modal-dialog {
        position: fixed;
        top: 32%;
        left: 30%;
        transform: translate(0px, -120px);
        width: 800px;
    }
    .modal-dialog .modal-content {
    border-radius: 15px;
    height: 100%;
    display: flex;
    flex-direction: column;

    }
    .modal-header {
        display: flex;
        padding: 10px;
        border-bottom: 1px solid #e5e5e5;
        justify-content: space-between;
        align-items: center;
    }
    .modal-header::before,
    .modal-header::after {
        display: none
    }
    .modal-dialog .modal-content .modal-header img {
    height: 40px;
    }
    .modal-dialog .modal-content .modal-header .privecy-policy {
    padding: 8px 10px;
    background-color: #fff;
    border: 1px solid #000;
    border-radius: 10px;  
    color: black;
    }
    .modal-dialog .modal-content .modal-header .privecy-policy:hover {
    background-color: #000;
    color: white;
    transition: all ease 1s;
    }
    .modal .modal-dialog {
    transform: translate(0px, -120px) !important;
    max-width: 800px;
    }
    .modal-body {
    max-height: 400px; /* Set maximum height */
    overflow-y: auto; /* Enable vertical scrollbar */
    }

    /* Example of scrollbar customization */
    .modal-body::-webkit-scrollbar {
    width: 8px; /* Set the width of the scrollbar */
    }

    .modal-body::-webkit-scrollbar-thumb {
    background-color: {{setting('site.theme-color')}}; /* Set the color of the scrollbar thumb */
    border-radius: 4px; /* Set border radius of the thumb */
    }
    .modal .modal-dialog .modal-content .modal-body .modal-content{
    padding: 24px;
    }
    .modal .modal-dialog .modal-content .modal-body .mobal-body-title {
    font-weight: 700;
    font-size: 25px;
    margin-bottom: 8px;
    }
    .modal .modal-dialog .modal-content .modal-body .modal-body-text {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 0px;
    }
    .modal .modal-dialog .modal-content .modal-body .modal-content-btn {
    display: flex;
    justify-content: flex-end;
    padding: 20px;
    gap: 10px;
    }
    .modal .modal-dialog .modal-content .modal-body .modal-content-btn .btn {
    border-radius: 20px;
    padding: 6px 15px;
    font-weight: bold;
    color: #000;
    box-shadow: 0px 0px 4px rgb(0,0,0,0.3);
    text-transform: capitalize;
    margin-bottom: 0px!important;
    }
    .modal .modal-dialog .modal-content .modal-body .modal-content-btn .btn i {
    padding-right: 4px;
    font-size: 13px;
    }
    .modal-dialog .modal-content .modal-body .mobal-body-title-h6 {
    font-weight: 700;
    font-size: 23px;
    margin-bottom: 8px;
    }
    .modal .modal-dialog .modal-content .modal-footer {
    display: flex;
    justify-content: space-between;
    }
    .modal .modal-dialog .modal-content .modal-footer .back-btn {
        border: 1px solid gray;
        font-weight: bold;
        color: #424242;
        margin: 0px!important;
        text-transform: capitalize;
        border-radius: 20px !important;
        padding: 7px 15px 7px 15px !important;
    }
    .modal .modal-dialog .modal-content .modal-footer .back-btn:hover {
        background-color: black;
        color: white;
    }
    .modal .modal-dialog .modal-content .modal-footer .save-btn {
    font-weight: bold;
    border-radius: 20px;
    padding: 9px 20px;
    color: #fff;
    text-transform: capitalize;
    background-color: {{setting('site.theme-color')}};
    }
    .modal .modal-dialog .modal-content .modal-footer .save-btn:hover {
    background-color: #fff;
    transition: all ease 3ms;
    border: 1px solid {{setting('site.theme-color')}};
    color: {{setting('site.theme-color')}};
    }
    .modal-dialog .modal-content .modal-body .purposes-section-body {
    /* padding: 0 0 18px; */
    }
    .modal-dialog .modal-content .modal-body .purposes-item {
    position: relative;
    display: flex;
    flex-direction: column;
    border-bottom: 1px solid rgba(0, 0, 0, .075);
    }
    .modal-dialog .modal-content .modal-body .purposes-item .purposes-item-header {
    background: linear-gradient(0deg, rgba(255, 255, 255, 0) 0, #fff 15%);
    z-index: 1;
    display: flex;
    padding: 24px 0;
    }
    .modal-dialog .modal-content .modal-body .purposes-item .purposes-item-title {
        display: flex;
        flex: 1;
        justify-content: space-between;
    } 
    .modal-dialog .modal-content .modal-body .purposes-item .purposes-item-title label {
    font-weight: 700;
    font-size: 16px;
    }
    .modal-dialog .modal-content .modal-body .purposes-item .purposes-item-title .purposes-item-title-btn {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    font-size: 12px;
    color: rgba(0, 0, 0, .75);
    background-color: transparent;
    font-weight: 300;
    display: flex;
    align-items: center;
    cursor: pointer;
    font-weight: bold;
    border: transparent;
    }
    .modal-dialog .modal-content .modal-body .purposes-item .purposes-item-title .purposes-item-title-btn::after {
    content: "";
    width: 10px;
    height: 10px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='5' viewBox='0 0 10 5'%3E%3Cpath fill='none' fill-rule='evenodd' stroke='%23979797' stroke-linecap='round' stroke-linejoin='round' d='M9.243 0L5 4.243h0L.757 0'/%3E%3C/svg%3E")!important;
    opacity: .5;
    background-position: center;
    background-repeat: no-repeat;
    display: inline-block;
    margin: 8px 6px;
    }
    hr {
    margin: 2px 0px 20px 0px;
    }
    .custom-switch {
    padding-top: 5px;
    padding-left: 2.25rem;
    }
    .btn-size {
    margin-left: 30px;
    transform: scale(1.5);
    }
    .btn:focus {
    box-shadow: none;
    }
    .custom-control-input:checked ~ .custom-control-label::before {
    border-color: #fff !important;
    background-color: {{setting('site.theme-color')}};
    }
    .btn-size input {
    box-sizing: none!important;
    border: 1px solid #000;
    }

    .purposes-items .custom-control-input:focus ~ .custom-control-label::before {
    box-shadow: none;
    border-color: #adb5bd;
    }

    .custom-switch .custom-control-input:disabled:checked ~ .custom-control-label::before {
    opacity: 0.6;
    background-color: {{setting('site.theme-color')}};
    }
    #cookieModal .modal-dialog .modal-content .modal-footer::before,
    #cookieModal .modal-dialog .modal-content .modal-footer::after {
        display: none;
    }


    /* Cookie model Mobile & Tablet Css  */
    @media only screen and (max-width: 510px) { 
        .cookie-popup-container .cookie-popup {
            margin: 5px;
            right: 0px;
            bottom: 0px;
            transform: translate(0%, -50%);
        }
        .modal-dialog .modal-content .modal-header .privecy-policy{
            padding: 10px 8px;
        }
        .modal-header {
            justify-content: space-between;
        }
        .modal {
            padding-right: 0px;
        }
        .modal .modal-dialog .modal-content .modal-body .modal-content-btn .btn {
            padding: 6px 16px;
        }
        .modal .modal-dialog{
            height: 100%!important;
            margin-bottom: 0px;
            width: 96%;
            left: 0%;
            top: 18%;
        }
        .modal-dialog  .modal-content {
            height: 98%;
            overflow: hidden;
        }
        .modal-body {
            max-height: 100%;
            height: 735px;
        }
        .modal .modal-dialog .modal-content .modal-body .mobal-body-title {
            font-size: 23px;
        }
        .modal .modal-dialog .modal-content .modal-body .modal-content-btn {
            padding: 10px 10px 10px 10px;
            justify-content: space-around;
        }
        .modal-dialog .modal-content .modal-body .purposes-section-body {
            padding: 0px;
        }
        .modal-dialog .modal-content .modal-body .purposes-item .purposes-item-body {
            font-size: 15px;
        }
        .modal .modal-dialog .modal-content .modal-footer .back-btn {
            display: none;
        }
        .modal .modal-dialog .modal-content .modal-footer {
            justify-content: center;
            border: 0;
            box-shadow: 0px -30px 70px rgb(255 255 255 / 87%);
            z-index: 1;
        }
    }
    @media screen and (min-width: 390px) and (max-width: 510px) { 
        .cookie-popup-container .cookie-popup {
            transform: translate(0%, -90%) !important;
        }
    }
    @media screen and (min-width: 390px) and (max-width: 510px) { 
        .modal .modal-dialog {
            top: 14%;
        }
    }

    @media only screen and (min-width: 510px) and (max-width: 920px) {
        .modal {
            transform: translate(0px, 200px);
        }
        .modal .modal-dialog {
            top: 20%;
            left: 0%;
            width: 100%;
            padding: 0px 10px;
        }
        .modal .modal-dialog .modal-content .modal-footer {
            flex-direction: column;
            gap: 10px;
        }
        .modal .modal-dialog .modal-content .modal-body .modal-content-btn .btn {
            padding: 0px 100px 5px 100px;
            font-size: 18px;
        }
        .modal .modal-dialog .modal-content .modal-body .modal-content-btn  {
            justify-content: space-between;
        }
        .modal .modal-dialog .modal-content .modal-footer .save-btn {
            order: 1;
            width: 100%;
        }
        .modal .modal-dialog .modal-content .modal-footer .back-btn {
            order: 2;
            width: 100%;
            border: none;
        }
        .modal .modal-dialog .modal-content .modal-body .modal-body-text {
            font-size: 18px;
        }
    }
</style>

<script>
    setTimeout(() => {
        
        var checkbox = document.getElementById("customSwitch3");

        // Trigger a click event on the checkbox
        checkbox.checked = true;
        checkbox.dispatchEvent(new Event('change'));

        // Disable the checkbox
        checkbox.disabled = true;

        $(".necessary").hide();
        $(".measurement").hide();
        $(".marketing").hide();
        $(".see-necessary").click(function(){
            $(".necessary").slideToggle();
        });
        $(".see-measurement").click(function(){
            $(".measurement").slideToggle();
        });
        $(".see-marketing").click(function(){
            $(".marketing").slideToggle();
        });

        $(document).ready(function(){
            $("#learn-more").click(function(){
                // alert('mohsin');
                $('#cookieModal').modal('show');
            });

            var acceptClicked = false;
            var rejectClicked = false;

            $(".accept-btn").click(function(){
                $(this).css('background-color' , '{{setting('site.theme-color')}}');
                $(this).css('color' , '#fff');
                $('.reject-btn').css('background-color' , '#ffffff');
                $('.reject-btn').css('color' , '#000');
                $('.reject-all').removeAttr('disabled' , 'disabled');
                $('.reject-all').attr('disabled' , 'disabled');
                $('.reject-all').prop('checked',true);
                if (!acceptClicked) {
                    $(".accept-all").slideDown();
                    $(".accept-all").trigger("click");
                    acceptClicked = true;
                    rejectClicked = false;

                }
            });

            $(".reject-btn").click(function(){
                $(this).css('background-color' , '{{setting('site.theme-color')}}');
                $(this).css('color' , '#fff');
                $('.accept-btn').css('background-color' , '#ffffff');
                $('.accept-btn').css('color' , '#000');
                $('.reject-all').attr('disabled' , 'disabled');
                $('.reject-all').prop('checked',false);
                if (!rejectClicked) {
                    // $(".reject-all").slideUp();
                    $(".reject-all").trigger("click");
                    rejectClicked = true;
                    acceptClicked = false;
                }
            });
            
            $('#cookieModal').on('hidden.bs.modal', function () {
                $('.modal-backdrop').remove(); // Remove modal-backdrop class
            });

            if (localStorage.getItem('electrohub-cookie') === '1') {
                $('.cookie-popup-container').hide();
                $('html').removeClass('cookie-blocked');
            } else {
                $('.cookie-popup-container').fadeIn(100);
            }
            $('.accept-cookie').click(function () { 
                $('.cookie-popup').slideUp(300);
                $('.cookie-popup-container').fadeOut(300);
                $('html').removeClass('cookie-blocked');
                localStorage.setItem('electrohub-cookie', '1');
            });
        });
    }, 1000);

</script>

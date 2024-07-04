<!--====== WhatsApp Start ======-->

<div class="wa__btn_popup">
    <div class="wa__btn_popup_txt">Need Help? <strong>Chat with us</strong></div>
    <div class="wa__btn_popup_icon"></div>
</div>
<div class="wa__popup_chat_box">
    <div class="wa__popup_heading">
        <div class="wa__popup_title">Start a Conversation</div>
        <div class="wa__popup_intro">Hi! Click one of our member below to chat on <strong>WhatsApp</strong></div>
    </div>
    <div class="wa__popup_content wa__popup_content_left">
        <div class="wa__popup_notice">The team typically replies in a few minutes.</div>
        <div class="wa__popup_content_list">
            <div class="wa__popup_content_item ">
                <a target="_blank" href="https://wa.me/{{setting('site.whatsapp-number')}}" class="wa__stt wa__stt_online">
                    <div class="wa__popup_avatar nta-default-avt">
                        <svg width="48px" height="48px" class="nta-whatsapp-default-avatar" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <path style="fill:#EDEDED;" d="M0,512l35.31-128C12.359,344.276,0,300.138,0,254.234C0,114.759,114.759,0,255.117,0
                                S512,114.759,512,254.234S395.476,512,255.117,512c-44.138,0-86.51-14.124-124.469-35.31L0,512z" />
                                                            <path style="fill:#55CD6C;" d="M137.71,430.786l7.945,4.414c32.662,20.303,70.621,32.662,110.345,32.662
                                c115.641,0,211.862-96.221,211.862-213.628S371.641,44.138,255.117,44.138S44.138,137.71,44.138,254.234
                                c0,40.607,11.476,80.331,32.662,113.876l5.297,7.945l-20.303,74.152L137.71,430.786z" />
                                                            <path style="fill:#FEFEFE;" d="M187.145,135.945l-16.772-0.883c-5.297,0-10.593,1.766-14.124,5.297
                                c-7.945,7.062-21.186,20.303-24.717,37.959c-6.179,26.483,3.531,58.262,26.483,90.041s67.09,82.979,144.772,105.048
                                c24.717,7.062,44.138,2.648,60.028-7.062c12.359-7.945,20.303-20.303,22.952-33.545l2.648-12.359
                                c0.883-3.531-0.883-7.945-4.414-9.71l-55.614-25.6c-3.531-1.766-7.945-0.883-10.593,2.648l-22.069,28.248
                                c-1.766,1.766-4.414,2.648-7.062,1.766c-15.007-5.297-65.324-26.483-92.69-79.448c-0.883-2.648-0.883-5.297,0.883-7.062
                                l21.186-23.834c1.766-2.648,2.648-6.179,1.766-8.828l-25.6-57.379C193.324,138.593,190.676,135.945,187.145,135.945" /> </svg>
                    </div>
                    <div class="wa__popup_txt">
                        <div class="wa__member_name">Customer Support</div>
                        <div class="wa__member_duty"></div>
                    </div>
                </a>
            </div>
            
        </div>
    </div>
</div>

<!--====== WhatsApp End ======-->

<style>
    <!----WhatsApp-Start---->

    .wa__btn_w_img,.wa__button {
        position: relative;
        width: 300px
    }

    .wa__button {
        border-bottom: none!important;
        min-height: 64px;
        display: block;
        font-family: Arial,Helvetica,sans-serif;
        text-decoration: none;
        color: #fff;
        box-shadow: 0 4px 8px 1px rgba(32,32,37,.09);
        -webkit-box-shadow: 0 4px 8px 1px rgba(32,32,37,.09);
        -moz-box-shadow: 0 4px 8px 1px rgba(32,32,37,.09)
    }

    .wa__btn_txt,.wa__cs_info .wa__cs_name,.wa__cs_info .wa__cs_status {
        display: inline-block
    }

    .wa__btn_w_img:hover {
        text-decoration: none
    }

    .wa__btn_popup,.wa__btn_popup *,.wa__btn_popup :after,.wa__btn_popup :before,.wa__button,.wa__button *,.wa__button :after,.wa__button :before,.wa__popup_chat_box,.wa__popup_chat_box *,.wa__popup_chat_box :after,.wa__popup_chat_box :before {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box
    }

    .wa__btn_txt {
        font-size: 12px;
        line-height: 1.33em
    }

    .wa__btn_w_icon .wa__btn_txt {
        padding: 16px 20px 15px 71px
    }

    .wa__button_text_only .wa__btn_txt,.wa__r_button.wa__btn_w_img.wa__button_text_only .wa__btn_txt,.wa__sq_button.wa__btn_w_img.wa__button_text_only .wa__btn_txt {
        padding-top: 25px;
        padding-bottom: 24px
    }

    .wa__btn_w_icon .wa__btn_txt .wa__btn_title {
        font-weight: 600;
        padding-left: 2px;
        font-size: 14px
    }

    .wa__cs_info {
        margin-bottom: 2px
    }

    .wa__btn_status {
        color: #f5a623;
        font-size: 9px;
        padding: 2px 0 0;
        font-weight: 700
    }

    .wa__cs_info .wa__cs_name {
        font-weight: 400;
        font-size: 12px;
        line-height: 1.36em
    }

    .wa__stt_online .wa__cs_info .wa__cs_name {
        color: #d5f0d9
    }

    .wa__stt_offline .wa__cs_info .wa__cs_name {
        color: #76787d
    }

    .wa__cs_info .wa__cs_status {
        width: 36px;
        height: 14px;
        margin-left: 3px;
        padding: 1px;
        font-size: 9px;
        line-height: 1.34em;
        border-radius: 5px;
        color: rgba(255,255,255,.98);
        position: relative;
        top: -1px;
        left: 0;
        text-align: center
    }

    .wa__stt_online .wa__cs_info .wa__cs_status {
        background: #62c971
    }

    .wa__stt_offline .wa__cs_info .wa__cs_status {
        background: #b9bbbe
    }

    .wa__stt_online {
        background: #2db742;
        cursor: pointer;
        transition: .4s;
        -webkit-transition: .4s;
        -moz-transition: .4s;
        backface-visibility: hidden;
        will-change: transform
    }

    .wa__stt_online .wa__btn_txt {
        position: relative;
        z-index: 4
    }

    .wa__r_button.wa__stt_online:before {
        border-radius: 50vh
    }

    .wa__sq_button.wa__stt_online:before {
        border-radius: 5px
    }

    .wa__stt_online:before {
        content: '';
        transition: .4s;
        -webkit-transition: .4s;
        -moz-transition: .4s;
        background: rgba(0,0,0,.2);
        position: absolute;
        left: 0;
        top: 0;
        z-index: -1;
        width: 100%;
        height: 100%;
        opacity: 0;
        will-change: opacity
    }

    .wa__button.wa__stt_online:active,.wa__button.wa__stt_online:focus,.wa__button.wa__stt_online:hover {
        box-shadow: 0 4px 8px 1px rgba(32,32,37,.19);
        transform: translate(0,-3px);
        -webkit-transform: translate(0,-3px);
        -moz-transform: translate(0,-3px);
        -ms-transform: translate(0,-3px)
    }

    .wa__button.wa__stt_online:active:before,.wa__button.wa__stt_online:focus:before,.wa__button.wa__stt_online:hover:before {
        opacity: 1
    }

    .wa__stt_online.wa__btn_w_icon .wa__btn_icon img {
        transform: scale(1);
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        transition: .2s;
        -webkit-transition: .2s;
        -moz-transition: .2s
    }

    .wa__stt_offline {
        background: #ebedf0;
        color: #595b60;
        box-shadow: none;
        cursor: initial
    }

    .wa__stt_offline.wa__btn_w_icon .wa__btn_txt {
        padding: 8px 20px 6px 71px
    }

    .wa__stt_offline.wa__r_button.wa__btn_w_img .wa__btn_txt {
        padding: 8px 20px 8px 100px
    }

    .wa__stt_offline.wa__sq_button.wa__btn_w_img .wa__btn_txt {
        padding: 8px 20px 8px 70px
    }

    .wa__btn_w_icon .wa__btn_icon {
        position: absolute;
        top: 50%;
        left: 16px;
        transform: translate(0,-50%);
        -moz-transform: translate(0,-50%);
        -webkit-transform: translate(0,-50%)
    }

    .wa__btn_w_icon .wa__btn_icon img {
        width: 41px;
        height: 69px
    }

    .wa__btn_w_img {
        margin: 20px 0
    }

    .wa__btn_popup,.wa__popup_chat_box {
        position: fixed;
        font-family: Arial,Helvetica,sans-serif
    }

    .wa__btn_w_img .wa__cs_img {
        position: absolute;
        top: 50%;
        left: 0;
        text-align: center;
        transform: translate(0,-50%);
        -webkit-transform: translate(0,-50%);
        -moz-transform: translate(0,-50%)
    }

    .wa__btn_w_img .wa__cs_img_wrap {
        width: 79px;
        height: 79px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border: 3px solid #fff;
        position: relative;
        overflow: hidden
    }

    .wa__btn_w_img .wa__cs_img img {
        max-width: 100%;
        height: auto;
        transition: transform .2s;
        -webkit-transition: transform .2s;
        -moz-transition: transform .2s
    }

    .wa__btn_w_img .wa__cs_img:after {
        content: '';
        background: url(../assets/images/whatsapp_logo_green.svg) center center/21px no-repeat #fff;
        display: block;
        width: 27px;
        height: 27px;
        position: absolute;
        top: 20px;
        right: -14px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        box-shadow: 0 4px 6px 0 rgba(39,38,38,.3);
        -webkit-box-shadow: 0 4px 6px 0 rgba(39,38,38,.3);
        -moz-box-shadow: 0 4px 6px 0 rgba(39,38,38,.3)
    }

    .wa__stt_offline.wa__btn_w_img .wa__cs_img:after {
        content: '';
        background: url(../assets/images/whatsapp_logo_gray.svg) center center/21px no-repeat #fff;
        display: block;
        width: 27px;
        height: 27px;
        position: absolute;
        top: 20px;
        right: -14px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        box-shadow: 0 4px 6px 0 rgba(39,38,38,.3);
        -webkit-box-shadow: 0 4px 6px 0 rgba(39,38,38,.3);
        -moz-box-shadow: 0 4px 6px 0 rgba(39,38,38,.3)
    }

    .wa__btn_w_img .wa__btn_txt {
        padding: 14px 20px 12px 103px
    }

    .wa__r_button {
        border-radius: 50vh
    }

    .wa__sq_button {
        border-radius: 5px
    }

    .wa__sq_button.wa__btn_w_img {
        width: 270px;
        margin-left: 30px
    }

    .wa__r_button.wa__btn_w_img .wa__cs_img {
        left: -5px
    }

    .wa__sq_button.wa__btn_w_img .wa__cs_img {
        left: -35px
    }

    .wa__sq_button.wa__btn_w_img .wa__btn_txt {
        padding: 10px 20px 10px 70px;
        display: table-cell;
        vertical-align: middle;
        height: 66px
    }

    .wa__btn_txt .wa__btn_title {
        font-weight: 600
    }

    .wa__r_button.wa__btn_w_img .wa__btn_txt {
        padding: 8px 20px 8px 100px;
        display: table-cell;
        vertical-align: middle;
        height: 66px
    }

    .wa__r_button.wa__btn_w_img .wa__cs_info .wa__cs_status {
        margin-left: 3px
    }

    .wa__popup_chat_box {
        width: 351px;
        border-radius: 5px 5px 8px 8px;
        -webkit-border-radius: 5px 5px 8px 8px;
        -moz-border-radius: 5px 5px 8px 8px;
        overflow: hidden;
        box-shadow: 0 10px 10px 4px rgba(0,0,0,.04);
        -webkit-box-shadow: 0 10px 10px 4px rgba(0,0,0,.04);
        -moz-box-shadow: 0 10px 10px 4px rgba(0,0,0,.04);
        bottom: 102px;
        right: 25px;
        z-index: 999999998;
        opacity: 0;
        visibility: hidden;
        -ms-transform: translate(0,50px);
        transform: translate(0,50px);
        -webkit-transform: translate(0,50px);
        -moz-transform: translate(0,50px);
        transition: .4s;
        -webkit-transition: .4s;
        -moz-transition: .4s;
        will-change: transform,visibility,opacity;
        max-width: calc(100% - 50px)
    }

    .wa__popup_chat_box:active,.wa__popup_chat_box:focus,.wa__popup_chat_box:hover {
        box-shadow: 0 10px 10px 4px rgba(32,32,37,.23);
        -webkit-box-shadow: 0 10px 10px 4px rgba(32,32,37,.23);
        -moz-box-shadow: 0 10px 10px 4px rgba(32,32,37,.23)
    }

    .wa__popup_chat_box.wa__active {
        -ms-transform: translate(0,0);
        transform: translate(0,0);
        -webkit-transform: translate(0,0);
        -moz-transform: translate(0,0);
        visibility: visible;
        opacity: 1
    }

    .wa__popup_chat_box .wa__popup_heading {
        position: relative;
        padding: 15px 43px 17px 74px;
        color: #d9ebc6;
        background: #2db742
    }

    .wa__popup_chat_box .wa__popup_heading_sm {
        padding: 12px 15px 17px 74px
    }

    .wa__popup_chat_box .wa__popup_heading:before {
        content: '';
        background: url(../images/whatsapp_logo.svg) center top/33px no-repeat;
        display: block;
        width: 55px;
        height: 33px;
        position: absolute;
        top: 20px;
        left: 12px
    }

    .wa__popup_chat_box .wa__popup_heading_sm:before {
        top: 19px;
        left: 11px
    }

    .wa__popup_chat_box .wa__popup_heading .wa__popup_title {
        padding-top: 2px;
        padding-bottom: 3;
        color: #fff;
        font-size: 18px;
        line-height: 24px
    }

    .wa__popup_chat_box .wa__popup_heading .wa__popup_intro {
        padding-top: 4px;
        font-size: 12px;
        line-height: 20px
    }

    .wa__popup_chat_box .wa__popup_heading_sm .wa__popup_intro {
        padding-top: 0
    }

    .wa__popup_chat_box .wa__popup_heading .wa__popup_intro a {
        display: inline-block;
        color: #fff;
        text-decoration: none
    }

    .wa__popup_chat_box .wa__popup_heading .wa__popup_intro a:active,.wa__popup_chat_box .wa__popup_heading .wa__popup_intro a:focus,.wa__popup_chat_box .wa__popup_heading .wa__popup_intro a:hover {
        text-decoration: underline
    }

    .wa__popup_chat_box .wa__popup_notice {
        font-size: 11px;
        color: #a5abb7;
        font-weight: 500;
        padding: 0 3px
    }

    .wa__popup_chat_box .wa__popup_content {
        background: #fff;
        padding: 13px 20px 21px 19px;
        text-align: center
    }

    .wa__popup_chat_box .wa__popup_content_left {
        text-align: left
    }

    .wa__popup_chat_box .wa__popup_avatar {
        position: absolute;
        overflow: hidden;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        left: 12px;
        top: 12px
    }

    .wa__popup_chat_box .wa__popup_avatar.nta-default-avt {
        border-radius: unset;
        -webkit-border-radius: unset;
        -moz-border-radius: unset
    }

    .wa__popup_chat_box .wa__stt {
        padding: 13px 40px 12px 74px;
        position: relative;
        text-decoration: none;
        display: table;
        width: 100%;
        border-left: 2px solid #2db742;
        background: #f5f7f9;
        border-radius: 2px 4px;
        -webkit-border-radius: 2px 4px;
        -moz-border-radius: 2px 4px
    }

    .wa__popup_chat_box .wa__stt:after {
        content: '';
        background: url(../images/whatsapp_logo_green.svg) 0 0/100% 100% no-repeat;
        position: absolute;
        right: 14px;
        top: 26px;
        width: 20px;
        height: 20px;
        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%
    }

    .wa__popup_chat_box .wa__stt.wa__stt_offline:after {
        background-image: url(../images/whatsapp_logo_gray_sm.svg)
    }

    .wa__popup_chat_box .wa__stt.wa__stt_online {
        transition: .2s;
        -webkit-transition: .2s;
        -moz-transition: .2s
    }

    .wa__popup_chat_box .wa__stt.wa__stt_online:active,.wa__popup_chat_box .wa__stt.wa__stt_online:focus,.wa__popup_chat_box .wa__stt.wa__stt_online:hover {
        background: #fff;
        box-shadow: 0 7px 15px 1px rgba(55,62,70,.07);
        -webkit-box-shadow: 0 7px 15px 1px rgba(55,62,70,.07);
        -moz-box-shadow: 0 7px 15px 1px rgba(55,62,70,.07)
    }

    .wa__popup_content_list .wa__popup_content_item {
        margin: 14px 0 0;
        transform: translate(0,20px);
        -webkit-transform: translate(0,20px);
        -moz-transform: translate(0,20px);
        will-change: opacity,transform;
        opacity: 0
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item {
        transition: .4s 2.1s;
        -webkit-transition: .4s 2.1s;
        -moz-transition: .4s 2.1s
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:first-child {
        transition-delay: .3s;
        -webkit-transition-delay: .3s;
        -moz-transition-delay: .3s
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(2) {
        transition-delay: .5s;
        -webkit-transition-delay: .5s;
        -moz-transition-delay: .5s
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(3) {
        transition-delay: .7s;
        -webkit-transition-delay: .7s;
        -moz-transition-delay: .7s
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(4) {
        transition-delay: .9s;
        -webkit-transition-delay: .9s;
        -moz-transition-delay: .9s
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(5) {
        transition-delay: 1.1s;
        -webkit-transition-delay: 1.1s;
        -moz-transition-delay: 1.1s
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(6) {
        transition-delay: 1.3s;
        -webkit-transition-delay: 1.3s;
        -moz-transition-delay: 1.3s
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(7) {
        transition-delay: 1.5s;
        -webkit-transition-delay: 1.5s;
        -moz-transition-delay: 1.5s
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(8) {
        transition-delay: 1.7s;
        -webkit-transition-delay: 1.7s;
        -moz-transition-delay: 1.7s
    }

    .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(9) {
        transition-delay: 1.9s;
        -webkit-transition-delay: 1.9s;
        -moz-transition-delay: 1.9s
    }

    .wa__popup_chat_box.wa__lauch .wa__popup_content_list .wa__popup_content_item {
        opacity: 1;
        transform: translate(0,0);
        -webkit-transform: translate(0,0);
        -moz-transform: translate(0,0)
    }

    .wa__popup_content_list .wa__popup_content_item .wa__member_name {
        font-size: 14px;
        color: #363c47;
        line-height: 1.188em!important
    }

    .wa__popup_content_list .wa__popup_content_item .wa__member_duty {
        font-size: 11px;
        color: #989b9f;
        padding: 2px 0 0;
        line-height: 1.125em!important
    }

    .wa__popup_content_list .wa__popup_content_item .wa__member_status {
        color: #f5a623;
        font-size: 10px;
        padding: 5px 0 0;
        line-height: 1.125em!important
    }

    .wa__popup_content_list .wa__popup_content_item .wa__popup_txt {
        display: table-cell;
        vertical-align: middle;
        min-height: 48px;
        height: 48px
    }

    .wa__popup_content_list .wa__popup_content_item .wa__stt_offline {
        border-left-color: #c0c5ca
    }

    .wa__popup_avt_list {
        font-size: 0;
        margin: 7px 0 24px
    }

    .wa__popup_avt_list .wa__popup_avt_item {
        display: inline-block;
        position: relative;
        width: 46px
    }

    .wa__popup_avt_list .wa__popup_avt_img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        position: relative;
        overflow: hidden;
        border: 2px solid #fff;
        left: -7px
    }

    .wa__popup_call_btn {
        background: #2db742;
        color: #fff;
        text-decoration: none;
        display: inline-block;
        width: 275px;
        max-width: 100%;
        font-size: 16px;
        padding: 14px 10px;
        border-radius: 24px;
        -webkit-border-radius: 24px;
        -moz-border-radius: 24px;
        margin: 25px 0 15px;
        box-shadow: 0 8px 17px 2px rgba(13,15,18,.2);
        -webkit-box-shadow: 0 8px 17px 2px rgba(13,15,18,.2);
        -moz-box-shadow: 0 8px 17px 2px rgba(13,15,18,.2)
    }

    .wa__popup_call_btn.wa__popup_call_btn_lg:before {
        content: '';
        display: inline-block;
        width: 20px;
        height: 20px;
        position: relative;
        background: url(../images/whatsapp_logo_green_sm.svg) 0 0/100% 100% no-repeat;
        -webkit-background-size: 100% 100%;
        -moz-background-size: 100% 100%;
        vertical-align: top;
        top: 0;
        margin-right: -19px;
        left: -31px;
        transition: background-image .2s;
        -webkit-transition: background-image .2s;
        -moz-transition: background-image .2s
    }

    .wa__popup_call_btn.wa__popup_call_btn_lg:active:before,.wa__popup_call_btn.wa__popup_call_btn_lg:focus:before,.wa__popup_call_btn.wa__popup_call_btn_lg:hover:before {
        background-image: url(../images/whatsapp_logo.svg)
    }

    .wa__popup_chat_box_gray {
        border-radius: 2px 2px 8px 8px
    }

    .wa__popup_chat_box_gray .wa__popup_heading_gray {
        background: #f8f8f8;
        border-top: 3px solid #2db742;
        color: #868c9a;
        font-weight: 500
    }

    .wa__popup_chat_box_gray .wa__popup_heading_gray .wa__popup_intro a,.wa__popup_chat_box_gray .wa__popup_heading_gray .wa__popup_title {
        color: #595b60
    }

    .wa__popup_chat_box_gray .wa__popup_heading_gray:before {
        content: '';
        background: url(../images/whatsapp_logo_green.svg) center top/33px no-repeat;
        display: block;
        width: 55px;
        height: 33px;
        position: absolute;
        top: 20px;
        left: 12px
    }

    .wa__popup_chat_box_ct {
        width: 384px;
        text-align: center
    }

    .wa__popup_chat_box_ct .wa__popup_heading_ct {
        text-align: center;
        padding: 18px 0
    }

    .wa__popup_chat_box_ct .wa__popup_heading_ct:before {
        content: '';
        background: url(../images/whatsapp_logo.svg) center top/30px no-repeat;
        display: block;
        width: 30px;
        height: 31px;
        position: absolute;
        top: 15px;
        left: 72px
    }

    .wa__popup_chat_box_ct .wa__popup_heading_ct .wa__popup_title {
        padding-left: 22px;
        padding-bottom: 14px
    }

    .wa__popup_chat_box_ct .wa__popup_heading_ct .wa__popup_intro {
        margin-top: -5px;
        line-height: 12px
    }

    .wa__popup_chat_box_ct .wa__popup_ct_avt_list:after {
        content: '';
        clear: both;
        display: block
    }

    .wa__popup_chat_box_ct .wa__popup_ct_content {
        background: #fff;
        padding: 0 0 14px
    }

    .wa__popup_chat_box_ct .wa__popup_ct_content .wa__popup_notice {
        padding-top: 18px;
        padding-bottom: 15px
    }

    .wa__popup_chat_box_ct .wa__popup_ct_content_item {
        width: 33%;
        float: left;
        font-size: 10px
    }

    .wa__popup_chat_box_ct .wa__popup_ct_content_item a {
        text-decoration: none;
        color: #989b9f
    }

    .wa__popup_chat_box_ct .wa__popup_ct_content_item .wa__popup_ct_txt {
        padding-top: 8px
    }

    .wa__popup_chat_box_ct .wa__popup_ct_content_item .wa__member_name {
        color: #363c47;
        font-size: 13px
    }

    .wa__popup_chat_box_ct .wa__popup_ct_content_item .wa__member_duty {
        color: #989b9f;
        padding: 3px 0 0
    }

    .wa__popup_chat_box_ct .wa__popup_ct_content_item .wa__member_stt_online {
        color: #2db742;
        font-size: 9px;
        line-height: 12px;
        display: inline-block;
        padding: 3px 0 0 16px;
        background: url(../images/whatsapp_logo_green.svg) 0 3px/12px auto no-repeat;
        -webkit-background-size: 12px auto;
        -moz-background-size: 12px auto
    }

    .wa__popup_chat_box_ct .wa__popup_ct_content_item .wa__member_stt_offline {
        color: #f5a623;
        font-size: 9px;
        line-height: 12px;
        padding: 2px 0 0
    }

    .wa__popup_chat_box_ct .wa__popup_ct_avatar img {
        border-radius: 50%
    }

    .wa__popup_chat_box_ct .wa__popup_ct_call_btn {
        width: 97px;
        font-size: 11px;
        padding: 9px 10px 11px;
        margin: 15px 0
    }

    .wa__btn_popup {
        right: 68px;
        bottom: 10px;
        cursor: pointer;
        z-index: 999
    }

    .wa__btn_popup .wa__btn_popup_icon {
        width: 56px;
        height: 56px;
        background: #2db742;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        box-shadow: 0 6px 8px 2px rgba(0,0,0,.14);
        -webkit-box-shadow: 0 6px 8px 2px rgba(0,0,0,.14);
        -moz-box-shadow: 0 6px 8px 2px rgba(0,0,0,.14)
    }

    .wa__btn_popup .wa__btn_popup_icon:before {
        content: '';
        position: absolute;
        z-index: 1;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: url('/frontend/assets/img/whatsapp_logo.svg') center center/30px auto no-repeat;
        -webkit-background-size: 30px auto;
        -moz-background-size: 30px auto;
        transition: .4s;
        -webkit-transition: .4s;
        -moz-transition: .4s
    }

    .wa__btn_popup .wa__btn_popup_icon:after {
        content: '';
        opacity: 0;
        position: absolute;
        z-index: 2;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: url('./frontend/assets/img/x_icon.svg') center center/14px auto no-repeat;
        -webkit-background-size: 14px auto;
        -moz-background-size: 14px auto;
        transition: .4s;
        -webkit-transition: .4s;
        -moz-transition: .4s;
        -ms-transform: scale(0) rotate(-360deg);
        transform: scale(0) rotate(-360deg);
        -webkit-transform: scale(0) rotate(-360deg);
        -moz-transform: scale(0) rotate(-360deg)
    }

    .wa__btn_popup.wa__active .wa__btn_popup_icon:before {
        opacity: 0;
        -ms-transform: scale(0) rotate(360deg);
        transform: scale(0) rotate(360deg);
        -webkit-transform: scale(0) rotate(360deg);
        -moz-transform: scale(0) rotate(360deg)
    }

    .wa__btn_popup.wa__active .wa__btn_popup_icon:after {
        opacity: 1;
        -ms-transform: scale(1) rotate(0);
        transform: scale(1) rotate(0);
        -webkit-transform: scale(1) rotate(0);
        -moz-transform: scale(1) rotate(0)
    }

    .wa__btn_popup .wa__btn_popup_txt {
        position: absolute;
        width: 156px;
        right: 100%;
        background-color: #f5f7f9;
        font-size: 12px;
        color: #43474e;
        top: 15px;
        padding: 7px 0 7px 12px;
        margin-right: 7px;
        letter-spacing: -.03em;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        transition: .4s;
        -webkit-transition: .4s;
        -moz-transition: .4s
    }

    .wa__btn_popup.wa__active .wa__btn_popup_txt {
        -ms-transform: translate(0,15px);
        transform: translate(0,15px);
        -webkit-transform: translate(0,15px);
        -moz-transform: translate(0,15px);
        opacity: 0;
        visibility: hidden;
    }
</style>

<script type="text/javascript">
    var wa_time_out, wa_time_in;
    $(".wa__btn_popup").on("click", function() {
        if ($(".wa__popup_chat_box").hasClass("wa__active")) {
            $(".wa__popup_chat_box").removeClass("wa__active");
            $(".wa__btn_popup").removeClass("wa__active");
            clearTimeout(wa_time_in);
            if ($(".wa__popup_chat_box").hasClass("wa__lauch")) {
                wa_time_out = setTimeout(function() {
                    $(".wa__popup_chat_box").removeClass("wa__pending");
                    $(".wa__popup_chat_box").removeClass("wa__lauch");
                }, 400);
            }
        } else {
            $(".wa__popup_chat_box").addClass("wa__pending");
            $(".wa__popup_chat_box").addClass("wa__active");
            $(".wa__btn_popup").addClass("wa__active");
            clearTimeout(wa_time_out);
            if (!$(".wa__popup_chat_box").hasClass("wa__lauch")) {
                wa_time_in = setTimeout(function() {
                    $(".wa__popup_chat_box").addClass("wa__lauch");
                }, 100);
            }
        }
    });
</script>
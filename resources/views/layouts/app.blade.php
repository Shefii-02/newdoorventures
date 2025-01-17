<!DOCTYPE html>
@php
    $themeMode = $_COOKIE['theme'] ?? null;

    if (!in_array($themeMode, ['light', 'dark'])) {
        $themeMode = 'light';
    }
@endphp
<html lang="en" @class(['scroll-smooth', $themeMode]) dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1"
        name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords"
        content="{{ 'Real estate in Bangalore, properties in Karnataka, buy property in Bangalore, Karnataka real estate solutions, residential properties for sale in Bangalore, commercial properties for sale in Karnataka, plots for sale in Bangalore, affordable homes for sale in Karnataka, properties for rent in Bangalore, flats for rent in Karnataka, commercial spaces for lease in Bangalore, houses for rent in Karnataka, PG accommodation in Bangalore, paying guests in Karnataka, affordable PGs in Bangalore, residential plots in Bangalore, commercial plots in Karnataka, land for sale in Bangalore, latest real estate projects in Bangalore, top builders in Karnataka, new construction projects in Bangalore, builder properties in Karnataka, buy rent or lease properties in Bangalore, residential and commercial real estate in Karnataka, property listings in Bangalore and Karnataka, ' . $pageKeywords }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">


    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="{{ asset('images/backgrounds/favicon.png') }}" rel="shortcut icon">
    <style>
        /*<!------------------------->*/
        #nta-wa-gdpr {
            vertical-align: text-top !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .nta-wa-gdpr {
            font-size: 11px;
            padding: 5px;
            margin-left: -5px;
            margin-right: -5px;
            border-radius: 4px;
        }

        .nta-wa-gdpr a {
            text-decoration: underline;
            color: inherit;
        }

        .pointer-disable {
            pointer-events: none;
        }

        .nta-woo-products-button:before,
        .nta-woo-products-button:after {
            content: '';
            display: block;
            clear: both;
        }

        .wa__button {
            border-bottom: none !important;
        }

        .wa__btn_w_img:hover {
            text-decoration: none;
        }

        .wa__button,
        .wa__btn_popup,
        .wa__button *,
        .wa__btn_popup *,
        .wa__btn_popup :before,
        .wa__button :before,
        .wa__button :after,
        .wa__btn_popup :after,
        .wa__popup_chat_box,
        .wa__popup_chat_box *,
        .wa__popup_chat_box :before,
        .wa__popup_chat_box :after {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        /* VVV--button--VVV */
        .wa__button {
            position: relative;
            width: 300px;
            min-height: 64px;
            display: block;
            font-family: Arial, Helvetica, sans-serif;
            text-decoration: none;
            color: #fff;
            box-shadow: 0px 4px 8px 1px rgba(32, 32, 37, 0.09);
            -webkit-box-shadow: 0px 4px 8px 1px rgba(32, 32, 37, 0.09);
            -moz-box-shadow: 0px 4px 8px 1px rgba(32, 32, 37, 0.09);
        }

        .wa__btn_txt {
            display: inline-block;
            font-size: 12px;
            line-height: 1.33em;
        }

        .wa__btn_w_icon .wa__btn_txt {
            padding: 16px 20px 15px 71px;
        }

        .wa__button_text_only .wa__btn_txt,
        .wa__r_button.wa__btn_w_img.wa__button_text_only .wa__btn_txt,
        .wa__sq_button.wa__btn_w_img.wa__button_text_only .wa__btn_txt {
            padding-top: 25px;
            padding-bottom: 24px;
        }



        .wa__btn_w_icon .wa__btn_txt .wa__btn_title {
            font-weight: 600;
            padding-left: 2px;
            font-size: 14px;
        }

        .wa__cs_info {
            margin-bottom: 2px
        }

        .wa__btn_status {
            color: #F5A623;
            font-size: 9px;
            padding: 2px 0 0;
            font-weight: 700;
        }

        .wa__cs_info .wa__cs_name,
        .wa__cs_info .wa__cs_status {
            display: inline-block;
        }

        .wa__cs_info .wa__cs_name {
            font-weight: 400;
            font-size: 12px;
            line-height: 1.36em;
        }

        .wa__stt_online .wa__cs_info .wa__cs_name {
            color: #d5f0d9
        }

        .wa__stt_offline .wa__cs_info .wa__cs_name {
            color: #76787d;
        }

        .wa__cs_info .wa__cs_status {
            width: 36px;
            height: 14px;
            margin-left: 3px;
            padding: 1px;
            font-size: 9px;
            line-height: 1.34em;
            border-radius: 5px;
            color: rgba(255, 255, 255, 0.98);
            position: relative;
            top: -1px;
            left: 0px;
            text-align: center;
        }

        .wa__stt_online .wa__cs_info .wa__cs_status {
            background: #62c971;
        }

        .wa__stt_offline .wa__cs_info .wa__cs_status {
            background: #b9bbbe;
        }


        .wa__stt_online {
            background: #2DB742;
            cursor: pointer;
            transition: 0.4s ease all;
            -webkit-transition: 0.4s ease all;
            -moz-transition: 0.4s ease all;
            backface-visibility: hidden;
            will-change: transform;
        }

        .wa__stt_online .wa__btn_txt {
            position: relative;
            z-index: 4;
        }

        .wa__r_button.wa__stt_online:before {
            border-radius: 50vh;
        }

        .wa__sq_button.wa__stt_online:before {
            border-radius: 5px;
        }

        .wa__stt_online:before {
            content: '';
            transition: 0.4s ease all;
            -webkit-transition: 0.4s ease all;
            -moz-transition: 0.4s ease all;
            background: rgba(0, 0, 0, 0.2);
            position: absolute;
            left: 0;
            top: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            opacity: 0;
            will-change: opacity;
        }

        .wa__button.wa__stt_online:focus,
        .wa__button.wa__stt_online:active,
        .wa__button.wa__stt_online:hover {
            box-shadow: 0px 4px 8px 1px rgba(32, 32, 37, 0.19);
            transform: translate(0, -3px);
            -webkit-transform: translate(0, -3px);
            -moz-transform: translate(0, -3px);
            -ms-transform: translate(0, -3px);
        }

        .wa__button.wa__stt_online:focus:before,
        .wa__button.wa__stt_online:active:before,
        .wa__button.wa__stt_online:hover:before {
            opacity: 1;
        }

        .wa__stt_online.wa__btn_w_icon .wa__btn_icon img {
            transform: scale(1);
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            transition: 0.2s ease all;
            -webkit-transition: 0.2s ease all;
            -moz-transition: 0.2s ease all;
        }

        .wa__stt_offline {
            background: #EBEDF0;
            color: #595B60;
            box-shadow: none;
            cursor: initial;
        }

        .wa__stt_offline.wa__btn_w_icon .wa__btn_txt {
            padding: 8px 20px 6px 71px;
        }

        .wa__stt_offline.wa__r_button.wa__btn_w_img .wa__btn_txt {
            padding: 8px 20px 8px 100px
        }

        .wa__stt_offline.wa__sq_button.wa__btn_w_img .wa__btn_txt {
            padding: 8px 20px 8px 70px;
        }

        .wa__btn_w_icon .wa__btn_icon {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translate(0, -50%);
            -moz-transform: translate(0, -50%);
            -webkit-transform: translate(0, -50%);
        }

        .wa__btn_w_icon .wa__btn_icon img {
            width: 41px;
            height: 69px;
        }

        .wa__btn_w_img {
            position: relative;
            width: 300px;
            margin: 20px 0 20px;
        }

        .wa__btn_w_img .wa__cs_img {
            position: absolute;
            top: 50%;
            left: 0px;
            text-align: center;
            transform: translate(0, -50%);
            -webkit-transform: translate(0, -50%);
            -moz-transform: translate(0, -50%);
        }

        .wa__btn_w_img .wa__cs_img_wrap {
            width: 79px;
            height: 79px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border: 3px solid #ffffff;
            position: relative;
            overflow: hidden;
        }

        .wa__btn_w_img .wa__cs_img img {
            max-width: 100%;
            height: auto;
            transition: 0.2s ease transform;
            -webkit-transition: 0.2s ease transform;
            -moz-transition: 0.2s ease transform;
        }

        .wa__btn_w_img .wa__cs_img:after {
            content: '';
            background: #ffffff url('/assets/icons/WhatsApp-Logo.wine.svg') center center no-repeat;
            background-size: 21px;
            display: block;
            width: 27px;
            height: 27px;
            position: absolute;
            top: 20px;
            right: -14px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            box-shadow: 0px 4px 6px 0px rgba(39, 38, 38, 0.3);
            -webkit-box-shadow: 0px 4px 6px 0px rgba(39, 38, 38, 0.3);
            -moz-box-shadow: 0px 4px 6px 0px rgba(39, 38, 38, 0.3);
        }

        .wa__stt_offline.wa__btn_w_img .wa__cs_img:after {
            content: '';
            background: #ffffff url('/assets/icons/whatsapp_logo_gray.svg') center center no-repeat;
            background-size: 21px;
            display: block;
            width: 27px;
            height: 27px;
            position: absolute;
            top: 20px;
            right: -14px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            box-shadow: 0px 4px 6px 0px rgba(39, 38, 38, 0.3);
            -webkit-box-shadow: 0px 4px 6px 0px rgba(39, 38, 38, 0.3);
            -moz-box-shadow: 0px 4px 6px 0px rgba(39, 38, 38, 0.3);
        }


        .wa__btn_w_img .wa__btn_txt {
            padding: 14px 20px 12px 103px;
        }

        .wa__r_button {
            border-radius: 50vh;
        }

        .wa__sq_button {
            border-radius: 5px;
        }

        .wa__sq_button.wa__btn_w_img {
            width: 270px;
            margin-left: 30px;
        }

        .wa__r_button.wa__btn_w_img .wa__cs_img {
            left: -5px;
        }

        .wa__sq_button.wa__btn_w_img .wa__cs_img {
            left: -35px;
        }

        .wa__sq_button.wa__btn_w_img .wa__btn_txt {
            padding: 10px 20px 10px 70px;
            display: table-cell;
            vertical-align: middle;
            height: 66px;
        }

        .wa__btn_txt .wa__btn_title {
            font-weight: 600;
        }

        .wa__r_button.wa__btn_w_img .wa__btn_txt {
            padding: 8px 20px 8px 100px;
            display: table-cell;
            vertical-align: middle;
            height: 66px;
        }

        .wa__r_button.wa__btn_w_img .wa__cs_info .wa__cs_status {
            margin-left: 3px;
        }

        /* ^^^--button--^^^ */

        /* VVV--popup--VVV */

        .wa__popup_chat_box {
            font-family: Arial, Helvetica, sans-serif;
            width: 351px;
            border-radius: 5px 5px 8px 8px;
            -webkit-border-radius: 5px 5px 8px 8px;
            -moz-border-radius: 5px 5px 8px 8px;
            position: fixed;
            overflow: hidden;
            box-shadow: 0px 10px 10px 4px rgba(0, 0, 0, 0.04);
            -webkit-box-shadow: 0px 10px 10px 4px rgba(0, 0, 0, 0.04);
            -moz-box-shadow: 0px 10px 10px 4px rgba(0, 0, 0, 0.04);
            bottom: 102px;
            right: 25px;
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            -ms-transform: translate(0, 50px);
            transform: translate(0, 50px);
            -webkit-transform: translate(0, 50px);
            -moz-transform: translate(0, 50px);
            transition: 0.4s ease all;
            -webkit-transition: 0.4s ease all;
            -moz-transition: 0.4s ease all;
            will-change: transform, visibility, opacity;
            max-width: calc(100% - 50px);
        }

        .wa__popup_chat_box:hover,
        .wa__popup_chat_box:focus,
        .wa__popup_chat_box:active {
            box-shadow: 0px 10px 10px 4px rgba(32, 32, 37, 0.23);
            -webkit-box-shadow: 0px 10px 10px 4px rgba(32, 32, 37, 0.23);
            -moz-box-shadow: 0px 10px 10px 4px rgba(32, 32, 37, 0.23);
        }

        .wa__popup_chat_box.wa__active {
            -ms-transform: translate(0, 0);
            transform: translate(0, 0);
            -webkit-transform: translate(0, 0);
            -moz-transform: translate(0, 0);
            visibility: visible;
            opacity: 1;
        }

        .wa__popup_chat_box .wa__popup_heading {
            position: relative;
            padding: 15px 43px 17px 74px;
            color: #d9ebc6;
            background: #2db742;
        }

        .wa__popup_chat_box .wa__popup_heading_sm {
            padding: 12px 15px 17px 74px;
        }

        .wa__popup_chat_box .wa__popup_heading:before {
            content: '';
            background: url('/assets/icons/WhatsApp-Logo.wine.svg') center top no-repeat;
            background-size: 80px;
            display: block;
            width: 60px;
            height: 60px;
            position: absolute;
            top: 20px;
            left: 12px;
        }

        .wa__popup_chat_box .wa__popup_heading_sm:before {
            top: 19px;
            left: 11px;
        }

        .wa__popup_chat_box .wa__popup_heading .wa__popup_title {
            padding-top: 2px;
            padding-bottom: 3;
            color: #ffffff;
            font-size: 18px;
            line-height: 24px;
        }

        .wa__popup_chat_box .wa__popup_heading .wa__popup_intro {
            padding-top: 4px;
            font-size: 12px;
            line-height: 20px;
        }

        .wa__popup_chat_box .wa__popup_heading_sm .wa__popup_intro {
            padding-top: 0px;
        }

        .wa__popup_chat_box .wa__popup_heading .wa__popup_intro a {
            display: inline-block;
            color: #ffffff;
            text-decoration: none;
        }

        .wa__popup_chat_box .wa__popup_heading .wa__popup_intro a:hover,
        .wa__popup_chat_box .wa__popup_heading .wa__popup_intro a:focus,
        .wa__popup_chat_box .wa__popup_heading .wa__popup_intro a:active {
            text-decoration: underline;
        }

        .wa__popup_chat_box .wa__popup_notice {
            font-size: 11px;
            color: #a5abb7;
            font-weight: 500;
            padding: 0 3px;
        }

        .wa__popup_chat_box .wa__popup_content {
            background: #ffffff;
            padding: 13px 20px 21px 19px;
            text-align: center;
        }

        .wa__popup_chat_box .wa__popup_content_left {
            text-align: left;
        }

        .wa__popup_chat_box .wa__popup_avatar {
            position: absolute;
            overflow: hidden;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            left: 12px;
            top: 12px;
        }

        .wa__popup_chat_box .wa__popup_avatar.nta-default-avt {
            border-radius: unset;
            -webkit-border-radius: unset;
            -moz-border-radius: unset;
        }

        .wa__popup_chat_box .wa__stt {
            padding: 13px 40px 12px 74px;
            position: relative;
            text-decoration: none;
            display: table;
            width: 100%;
            border-left: 2px solid #2db742;
            background: #f5f7f9;
            border-radius: 2px 4px 2px 4px;
            -webkit-border-radius: 2px 4px 2px 4px;
            -moz-border-radius: 2px 4px 2px 4px;
        }

        .wa__popup_chat_box .wa__stt:after {
            content: '';
            background: url('/assets/icons/WhatsApp-Logo.wine.svg') 0 0 no-repeat;
            position: absolute;
            right: 14px;
            top: 26px;
            width: 20px;
            height: 20px;
            background-size: 100% 100%;
            -webkit-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
        }

        .wa__popup_chat_box .wa__stt.wa__stt_offline:after {
            background-image: url('../img/whatsapp_logo_gray_sm.svg');
        }

        .wa__popup_chat_box .wa__stt.wa__stt_online {
            transition: 0.2s ease all;
            -webkit-transition: 0.2s ease all;
            -moz-transition: 0.2s ease all;
        }

        .wa__popup_chat_box .wa__stt.wa__stt_online:hover,
        .wa__popup_chat_box .wa__stt.wa__stt_online:active,
        .wa__popup_chat_box .wa__stt.wa__stt_online:focus {
            background: #ffffff;
            box-shadow: 0px 7px 15px 1px rgba(55, 62, 70, 0.07);
            -webkit-box-shadow: 0px 7px 15px 1px rgba(55, 62, 70, 0.07);
            -moz-box-shadow: 0px 7px 15px 1px rgba(55, 62, 70, 0.07);
        }

        .wa__popup_content_list .wa__popup_content_item {
            margin: 14px 0 0;
            transform: translate(0, 20px);
            -webkit-transform: translate(0, 20px);
            -moz-transform: translate(0, 20px);
            will-change: opacity, transform;
            opacity: 0;
        }

        .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item {
            transition: 0.4s ease all;
            -webkit-transition: 0.4s ease all;
            -moz-transition: 0.4s ease all;
            transition-delay: 2.1s;
            -webkit-transition-delay: 2.1s;
            -moz-transition-delay: 2.1s;
        }

        .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(1) {
            transition-delay: 0.3s;
            -webkit-transition-delay: 0.3s;
            -moz-transition-delay: 0.3s;
        }

        .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(2) {
            transition-delay: 0.5s;
            -webkit-transition-delay: 0.5s;
            -moz-transition-delay: 0.5s;
        }

        .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(3) {
            transition-delay: 0.7s;
            -webkit-transition-delay: 0.7s;
            -moz-transition-delay: 0.7s;
        }

        .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(4) {
            transition-delay: 0.9s;
            -webkit-transition-delay: 0.9s;
            -moz-transition-delay: 0.9s;
        }

        .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(5) {
            transition-delay: 1.1s;
            -webkit-transition-delay: 1.1s;
            -moz-transition-delay: 1.1s;
        }

        .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(6) {
            transition-delay: 1.3s;
            -webkit-transition-delay: 1.3s;
            -moz-transition-delay: 1.3s;
        }

        .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(7) {
            transition-delay: 1.5s;
            -webkit-transition-delay: 1.5s;
            -moz-transition-delay: 1.5s;
        }

        .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(8) {
            transition-delay: 1.7s;
            -webkit-transition-delay: 1.7s;
            -moz-transition-delay: 1.7s;
        }

        .wa__popup_chat_box.wa__pending .wa__popup_content_list .wa__popup_content_item:nth-child(9) {
            transition-delay: 1.9s;
            -webkit-transition-delay: 1.9s;
            -moz-transition-delay: 1.9s;
        }

        .wa__popup_chat_box.wa__lauch .wa__popup_content_list .wa__popup_content_item {
            opacity: 1;
            transform: translate(0, 0);
            -webkit-transform: translate(0, 0);
            -moz-transform: translate(0, 0);
        }

        .wa__popup_content_list .wa__popup_content_item .wa__member_name {
            font-size: 14px;
            color: #363c47;
            line-height: 1.188em !important;
        }

        .wa__popup_content_list .wa__popup_content_item .wa__member_duty {
            font-size: 11px;
            color: #989b9f;
            padding: 2px 0 0;
            line-height: 1.125em !important;
        }

        .wa__popup_content_list .wa__popup_content_item .wa__member_status {
            color: #F5A623;
            font-size: 10px;
            padding: 5px 0 0;
            line-height: 1.125em !important;
        }

        .wa__popup_content_list .wa__popup_content_item .wa__popup_txt {
            display: table-cell;
            vertical-align: middle;
            min-height: 48px;
            height: 48px;
        }

        .wa__popup_content_list .wa__popup_content_item .wa__stt_offline {
            border-left-color: #c0c5ca;
        }

        .wa__popup_avt_list {
            font-size: 0;
            margin: 7px 0 24px;
        }

        .wa__popup_avt_list .wa__popup_avt_item {
            display: inline-block;
            position: relative;
            width: 46px;
        }

        .wa__popup_avt_list .wa__popup_avt_img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            position: relative;
            overflow: hidden;
            border: 2px solid #ffffff;
            left: -7px;
        }

        .wa__popup_call_btn {
            background: #2db742;
            color: #ffffff;
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
            box-shadow: 0px 8px 17px 2px rgba(13, 15, 18, 0.2);
            -webkit-box-shadow: 0px 8px 17px 2px rgba(13, 15, 18, 0.2);
            -moz-box-shadow: 0px 8px 17px 2px rgba(13, 15, 18, 0.2);
        }

        .wa__popup_call_btn.wa__popup_call_btn_lg:before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            position: relative;
            background: url('../img/whatsapp_logo_green_sm.svg') 0 0 no-repeat;
            background-size: 100% 100%;
            -webkit-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
            vertical-align: top;
            top: 0px;
            margin-right: -19px;
            left: -31px;
            transition: 0.2s ease background-image;
            -webkit-transition: 0.2s ease background-image;
            -moz-transition: 0.2s ease background-image;
        }

        .wa__popup_call_btn.wa__popup_call_btn_lg:hover:before,
        .wa__popup_call_btn.wa__popup_call_btn_lg:focus:before,
        .wa__popup_call_btn.wa__popup_call_btn_lg:active:before {
            background-image: url('/assets/icons/WhatsApp-Logo.wine.svg')
        }

        .wa__popup_chat_box_gray {
            border-radius: 2px 2px 8px 8px;
        }

        .wa__popup_chat_box_gray .wa__popup_heading_gray {
            background: #f8f8f8;
            border-top: 3px solid #2db742;
            color: #868c9a;
            font-weight: 500;
        }

        .wa__popup_chat_box_gray .wa__popup_heading_gray .wa__popup_title {
            color: #595b60;
        }

        .wa__popup_chat_box_gray .wa__popup_heading_gray:before {
            content: '';
            background: url('/assets/icons/WhatsApp-Logo.wine.svg') center top no-repeat;
            background-size: 33px;
            display: block;
            width: 55px;
            height: 33px;
            position: absolute;
            top: 20px;
            left: 12px;
        }

        .wa__popup_chat_box_gray .wa__popup_heading_gray .wa__popup_intro a {
            color: #595b60;
        }

        .wa__popup_chat_box_ct {
            width: 384px;
            text-align: center;
        }

        .wa__popup_chat_box_ct .wa__popup_heading_ct {
            text-align: center;
            padding: 18px 0 18px;
        }

        .wa__popup_chat_box_ct .wa__popup_heading_ct:before {
            content: '';
            background: url('/assets/icons/WhatsApp-Logo.wine.svg') center top no-repeat;
            background-size: 30px;
            display: block;
            width: 30px;
            height: 31px;
            position: absolute;
            top: 15px;
            left: 72px;
        }

        .wa__popup_chat_box_ct .wa__popup_heading_ct .wa__popup_title {
            padding-left: 22px;
            padding-bottom: 14px;
        }

        .wa__popup_chat_box_ct .wa__popup_heading_ct .wa__popup_intro {
            margin-top: -5px;
            line-height: 12px;
        }

        .wa__popup_chat_box_ct .wa__popup_ct_avt_list:after {
            content: '';
            clear: both;
            display: block;
        }

        .wa__popup_chat_box_ct .wa__popup_ct_content {
            background: #ffffff;
            padding: 0 0 14px;
        }

        .wa__popup_chat_box_ct .wa__popup_ct_content .wa__popup_notice {
            padding-top: 18px;
            padding-bottom: 15px;
        }

        .wa__popup_chat_box_ct .wa__popup_ct_content_item {
            width: 33%;
            float: left;
            font-size: 10px;
        }

        .wa__popup_chat_box_ct .wa__popup_ct_content_item a {
            text-decoration: none;
            color: #989b9f;
        }

        .wa__popup_chat_box_ct .wa__popup_ct_content_item .wa__popup_ct_txt {
            padding-top: 8px;
        }

        .wa__popup_chat_box_ct .wa__popup_ct_content_item .wa__member_name {
            color: #363c47;
            font-size: 13px;
        }

        .wa__popup_chat_box_ct .wa__popup_ct_content_item .wa__member_duty {
            color: #989b9f;
            padding: 3px 0 0;
        }

        .wa__popup_chat_box_ct .wa__popup_ct_content_item .wa__member_stt_online {
            color: #2db742;
            font-size: 9px;
            line-height: 12px;
            display: inline-block;
            padding: 3px 0 0 16px;
            background: url('/assets/icons/WhatsApp-Logo.wine.svg') 0 3px no-repeat;
            background-size: 12px auto;
            -webkit-background-size: 12px auto;
            -moz-background-size: 12px auto;
        }

        .wa__popup_chat_box_ct .wa__popup_ct_content_item .wa__member_stt_offline {
            color: #f5a623;
            font-size: 9px;
            line-height: 12px;
            padding: 2px 0 0;
        }


        .wa__popup_chat_box_ct .wa__popup_ct_avatar img {
            border-radius: 50%
        }

        .wa__popup_chat_box_ct .wa__popup_ct_call_btn {
            width: 97px;
            font-size: 11px;
            padding: 9px 10px 11px;
            margin: 15px 0 15px;
        }

        /* ^^^--popup--^^^ */

        /* VVV--popup button--VVV */
        .wa__btn_popup {
            position: fixed;
            right: 14px;
            bottom: 70px;
            cursor: pointer;
            font-family: Arial, Helvetica, sans-serif;
            z-index: 999;
        }

        .wa__btn_popup .wa__btn_popup_icon {
            width: 56px;
            height: 56px;
            background: #2db742;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            box-shadow: 0px 6px 8px 2px rgba(0, 0, 0, 0.14);
            -webkit-box-shadow: 0px 6px 8px 2px rgba(0, 0, 0, 0.14);
            -moz-box-shadow: 0px 6px 8px 2px rgba(0, 0, 0, 0.14);
        }

        .wa__btn_popup .wa__btn_popup_icon:before {
            content: '';
            position: absolute;
            z-index: 1;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background: transparent url('/assets/icons/WhatsApp-Logo.wine.svg') center center no-repeat;
            background-size: 80px auto;
            -webkit-background-size: 80px auto;
            -moz-background-size: 80px auto;
            transition: 0.4s ease all;
            -webkit-transition: 0.4s ease all;
            -moz-transition: 0.4s ease all;
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
            background: transparent url('/assets/icons/x_icon.png') center center no-repeat;
            background-size: 14px auto;
            -webkit-background-size: 14px auto;
            -moz-background-size: 14px auto;
            transition: 0.4s ease all;
            -webkit-transition: 0.4s ease all;
            -moz-transition: 0.4s ease all;
            -ms-transform: scale(0) rotate(-360deg);
            transform: scale(0) rotate(-360deg);
            -webkit-transform: scale(0) rotate(-360deg);
            -moz-transform: scale(0) rotate(-360deg);
        }

        .wa__btn_popup.wa__active .wa__btn_popup_icon:before {
            opacity: 0;
            -ms-transform: scale(0) rotate(360deg);
            transform: scale(0) rotate(360deg);
            -webkit-transform: scale(0) rotate(360deg);
            -moz-transform: scale(0) rotate(360deg);
        }

        .wa__btn_popup.wa__active .wa__btn_popup_icon:after {
            opacity: 1;
            -ms-transform: scale(1) rotate(0deg);
            transform: scale(1) rotate(0deg);
            -webkit-transform: scale(1) rotate(0deg);
            -moz-transform: scale(1) rotate(0deg);
        }

        .wa__btn_popup .wa__btn_popup_txt {
            position: absolute;
            width: 100px;
            right: 100%;
            background-color: #f5f7f9;
            font-size: 8px;
            color: #43474e;
            top: -20px;
            padding: 3px 0 0px 12px;
            margin-right: -13px;
            letter-spacing: -0.03em;
            border-radius: 4px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            transition: 0.4s ease all;
            -webkit-transition: 0.4s ease all;
            -moz-transition: 0.4s ease all;
        }
        

        .wa__btn_popup.wa__active .wa__btn_popup_txt {
            -ms-transform: translate(0, 15px);
            transform: translate(0, 15px);
            -webkit-transform: translate(0, 15px);
            -moz-transform: translate(0, 15px);
            opacity: 0;
            visibility: hidden;
        }

        /* ^^^--popup button--^^^ */
    </style>
    <style>
        .slick-prev,
        .slick-next {
            top: 30% !important;
        }

        .slick-prev:before,
        .slick-next:before {
            font-family: 'slick';
            font-size: 40px !important;
            line-height: 1;
            position: relative;
            left: -10px;
            opacity: 2 !important;
            color: #ffbf11 !important;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        window.defaultThemeMode = "light";
        // system
    </script>



    {{-- {!! Theme::header() !!} --}}

    {{-- <link media="all" type="text/css" rel="stylesheet"
        href="{{ asset('vendor/core/plugins/language/css/language-public.css?v=2.2.0') }}">

    <link media="all" type="text/css" rel="stylesheet"
        href="{{ asset('vendor/core/core/base/libraries/ckeditor/content-styles.css') }}"> --}}

    {{-- //needed project/property single pahe --}}

    <link media="all" type="text/css" rel="stylesheet"
        href="{{ asset('themes/hously/plugins/tobii/css/tobii.min.css') }}">
    {{-- //muti selector --}}
    <link media="all" type="text/css" rel="stylesheet"
        href="{{ asset('themes/hously/plugins/choices.js/css/choices.min.css') }}">

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('themes/hously/css/icons.css') }}">

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('themes/hously/css/style.css?v=1.8.7') }}">

    <link media="all" type="text/css" rel="stylesheet"
        href="{{ asset('themes/hously/plugins/leaflet/leaflet.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'">

    @stack('custom-style')
    @stack('header')

    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <style>
        :root {
            --primary-color: 203 166 65;
            --secondary-color: rgb(203, 166, 65);
            --primary-font: 'League Spartan', sans-serif;
            --primary-color-rgb: rgba(203, 166, 65, 0.8);
        }
    </style>
    <style>
        ul.ks-cboxtags {
            list-style: none;
            /*padding: 20px;*/
        }

        ul.ks-cboxtags li {
            display: inline;
        }

        ul.ks-cboxtags li label {
            display: inline-block;
            background-color: rgba(255, 255, 255, .9);
            border: 2px solid rgba(139, 139, 139, .3);
            color: #adadad;
            border-radius: 25px;
            white-space: nowrap;
            margin: 3px 0px;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            transition: all .2s;
        }

        ul.ks-cboxtags li label {
            padding: 2px 10px;
            cursor: pointer;
        }

        ul.ks-cboxtags li label::before {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 12px;
            padding: 2px 6px 2px 2px;
            content: "+";
            transition: transform .3s ease-in-out;
        }

        ul.ks-cboxtags li input[type="checkbox"]:checked+label::before {
            content: "✔";
            transform: rotate(-360deg);
            transition: transform .3s ease-in-out;
        }

        ul.ks-cboxtags li input[type="checkbox"]:checked+label {
            border: 2px solid var(--secondary-color);
            background-color: var(--secondary-color);
            color: #fff;
            transition: all .2s;
        }

        ul.ks-cboxtags li input[type="checkbox"] {
            display: absolute;
        }

        ul.ks-cboxtags li input[type="checkbox"] {
            position: absolute;
            opacity: 0;
        }

        ul.ks-cboxtags li input[type="checkbox"]:focus+label {
            border: 2px solid #e9a1ff;
        }
    </style>
    <style>
        .loading-state {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000000ad;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loading {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 10px solid #ddd;
            border-top-color: orange;
            animation: loading 1s linear infinite;
        }

        @keyframes loading {
            to {
                transform: rotate(360deg);
            }
        }


        a.mt-5.text-white.rounded-md.bg-primary.btn-sm.btn.hover\:bg-secondary.popup-contact-modal-form,
        a.text-white.btn.bg-primary.popup-contact-modal-form,
        a.popup-contact-modal-form.text-white.btn.bg-primary.mt-10,
        a.w-full.py-4.text-white.btn.bg-primary.fs-5.popup-contact-modal-form,
        a.text-theme.btn.btn-sm.bg-trasparent.border-theme.popup-contact-modal-form {
            overflow: hidden;
        }
    </style>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZD5X2WP5QJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-ZD5X2WP5QJ');
    </script>
</head>

<body class="dark:bg-slate-900">
    <div class="js-container ">
        <div class="loading-state">
            <div class="loading"></div>
        </div>
        {{-- {!! apply_filters(THEME_FRONT_BODY, null) !!} --}}

        <div id="alert-container"></div>

        @include('layouts.topnav')

        @yield('content')




        @include('layouts.footer')

        <!-- Modal -->
        <div class="modal fade z-999" id="BookingModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border-3 border-theme modal-body rounded-3xl">
                    <div class="col-lg-12 text-end flex justify-between">
                        <div class=" mb-3">
                            <h4 class="text-theme text-center">Please share your details</h4>
                        </div>
                        <button type="button" class="btn-close border-theme border-3 " data-bs-dismiss="modal"
                            aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path
                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                            </svg>
                        </button>
                    </div>


                    <div class="modal-body">

                        <form class="generic-form" action="{{ route('public.send.consult') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ isset($type) ? $type : '' }}" name="type"
                                id="type">
                            <input type="hidden" value="" name="data_id" id="data_id">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" required
                                    id="floatingInputName" placeholder="">
                                <label for="floatingInputName">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="email" required
                                    id="floatingInputName" placeholder="">
                                <label for="floatingInputName">Email Id</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                    class="form-control" name="phone" maxlength="12" required id="floatingInputNo"
                                    placeholder="+91 Phone">
                                <label for="floatingInputNo">Mobile Number <small class="text-theme">(+91
                                        Phone)</small></label>
                                <p class="text-theme text-start d-none">This number will be verified</p>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12 text-start mb-3">
                                        <h6>Are you a property dealer</h6>
                                    </div>
                                    <div class="col-lg-6 d-flex gap-4  mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" checked type="radio" name="dealer"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="dealer"
                                                id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-check  mb-3 d-none">
                                <input class="form-check-input" required type="checkbox" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label text-start" for="flexCheckDefault">
                                    I consent to New Door Ventures reaching out to me via
                                    WhatsApp, phone (bypassing NDNC registration), SMS, email,
                                    or any other means for similar properties or related services.
                                </label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-theme text-light">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade z-999" id="exampleModalToggle2" aria-hidden="true"
            aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-content border-3 border-theme modal-body rounded-3xl">
                    <div class="col-lg-12 text-end">
                        <button type="button" class="btn-close border-theme border-3 " data-bs-dismiss="modal"
                            aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path
                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body text-center">

                        <h2 class='text-theme  mb-2 fs-2'>Thank You</h2>
                        <p>We will get in touch with you shortly</p>
                    </div>
                </div>
            </div>
        </div>



        <div class="fixed top-1/4 z-999 -start-2">
            <span class="relative inline-block rotate-90">
                <input type="checkbox" class="absolute opacity-0 checkbox" id="chk" />
                <label
                    class="flex items-center justify-between h-8 p-1 rounded-full shadow cursor-pointer label bg-slate-900 dark:bg-white dark:shadow-gray-700 w-14"
                    for="chk">
                    <i class="mt-1 text-lg text-yellow-500 mdi mdi-weather-sunny"></i>
                    <i class="mt-1 text-lg text-yellow-500 mdi mdi-weather-night"></i>
                    <span
                        class="ball bg-white dark:bg-slate-900 rounded-full absolute top-0.5 rtl:start-6 start-0.5 w-7 h-7"></span>
                </label>
            </span>
        </div>


        <button type="button" onclick="topFunction()" id="back-to-top"
            class="fixed z-10 items-center justify-center hidden text-lg text-center text-white rounded-full bg-primary back-to-top bottom-5 end-5 h-9 w-9"
            aria-label="{{ __('Go to top') }}">
            <i class="mdi mdi-arrow-up"></i>
        </button>

        <div class="fixed top-0 start-0 hidden w-full h-full bg-opacity-50 sidebar-backdrop z-9999 bg-dark"></div>
        <!------------>
        <div class="wa__btn_popup">
            <div class="wa__btn_popup_txt">Need Help? <strong>Chat with us</strong></div>
            <div class="wa__btn_popup_icon"></div>
        </div>

        <div class="wa__popup_chat_box">
            <div class="wa__popup_heading">
                <div class="wa__popup_title">Start a Conversation</div>
                <div class="wa__popup_intro">Hi! Click one of our member below to chat on <strong>WhatsApp ;)</strong>
                    <div id="\&quot;eJOY__extension_root\&quot;"></div>
                </div>
            </div>
            <!-- /.wa__popup_heading -->
            <div class="wa__popup_content wa__popup_content_left">
                <div class="wa__popup_notice">The team typically replies in a few minutes.</div>


                <div class="wa__popup_content_list">
                    <div class="wa__popup_content_item ">
                        <a target="_blank"
                            href="https://wa.me/919686607663?text=Hi%2C+I+would+like+to+post+a+property+on+New+door+ventures."
                            class="wa__stt wa__stt_online">
                            <div class="wa__popup_avatar">
                                <div class="wa__cs_img_wrap"
                                    style="width: 60px;height: 60px;background: url(/assets/icons/WhatsApp-Logo.wine.svg) center center no-repeat; background-size: cover;">
                                </div>
                            </div>

                            <div class="wa__popup_txt">
                                <div class="wa__member_name"></div>
                                <!-- /.wa__member_name -->
                                <div class="wa__member_duty">Our Representative</div>
                                <!-- /.wa__member_duty -->
                            </div>
                            <!-- /.wa__popup_txt -->
                        </a>
                    </div>

                </div>

            </div>
            <!-- /.wa__popup_content_list -->
        </div>

        <!------------->
    </div>
    @if (session()->has('status') ||
            session()->has('success_msg') ||
            session()->has('error_msg') ||
            (isset($errors) && $errors->count() > 0) ||
            isset($error_msg))
        <script type="text/javascript">
            'use strict';
            window.onload = function() {
                @if (session()->has('success_msg'))
                    window.showAlert('alert-success', "{!! addslashes(session('success_msg')) !!}");
                @endif
                @if (session()->has('status'))
                    window.showAlert('alert-success', "{!! addslashes(session('status')) !!}");
                @endif
                @if (session()->has('error_msg'))
                    window.showAlert('alert-danger', "{!! addslashes(session('error_msg')) !!}");
                @endif
                @if (isset($error_msg))
                    window.showAlert('alert-danger', "{!! addslashes($error_msg) !!}");
                @endif
                @if (isset($errors))
                    @foreach ($errors->all() as $error)
                        window.showAlert('alert-danger', "{!! addslashes($error) !!}");
                    @endforeach
                @endif
            };
        </script>
    @endif

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="{{ asset('/themes/hously/plugins/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('themes/hously/plugins/tobii/js/tobii.min.js') }}"></script>
    <script src="{{ asset('themes/hously/plugins/choices.js/js/choices.min.js') }}"></script>
    <script src="{{ asset('themes/hously/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('themes/hously/plugins/easy_background.js') }}"></script>

    <script src="{{ asset('themes/hously/js/wishlist.js') }}"></script>


    {{-- <script src="{{ asset('vendor/core/plugins/language/js/language-public.js?v=2.2.0') }}"></script> --}}
    <script src="{{ asset('themes/hously/js/cookie-consent/js/cookie-consent.js') }}"></script>
    <script src="{{ asset('themes/hously/js/app2cb4.js?v=1.0') }}"></script>
    <script src="{{ asset('themes/hously/js/script2cb4.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('body').on('input', '.range-input input', function() {

                var typename = $(this).data('typeval');

                var minVal = $('.range-input-' + typename + ' input.range-min').val();
                var maxVal = $('.range-input-' + typename + ' input.range-max').val();

                var total = parseInt($('.range-input-' + typename + ' input.range-max').attr('max'));

                var percentage = ((maxVal - minVal) / total) * 100;
                var minPercent = (minVal / $('.range-input-' + typename + ' input.range-min').attr('max')) *
                    100;
                var maxPercent = (maxVal / $('.range-input-' + typename + ' input.range-max').attr('max')) *
                    100;

                $('.range-input-' + typename + ' input').attr('title', '₹' + formatNumber(minVal));
                $('.range-input-' + typename + ' input').attr('title', '₹' + formatNumber(maxVal));




                // Update hidden min and max price inputs
                $('.price-input-' + typename + ' input[name="min_price"]').val(minVal);
                $('.price-input-' + typename + ' input[name="max_price"]').val(maxVal);

                // Update displayed range values
                $('.price-input-' + typename + ' .min').text('₹' + formatNumber(minVal));
                $('.price-input-' + typename + ' .max').text('₹' + formatNumber(maxVal));

                // Update range slider color based on percentage
                $('.slider-progress-' + typename + ' .progress').css({
                    'left': minPercent + '%',
                    'right': (100 - maxPercent) + '%'
                });

            });

            function formatNumber(number) {
                if (number >= 10000000) {
                    return (number / 10000000).toFixed(2) + ' Crore';
                } else if (number >= 100000) {
                    return (number / 100000).toFixed(2) + ' Lac';
                } else if (number >= 1000) {
                    return (number / 1000).toFixed(2) + ' K';
                } else {
                    return number;
                }
            }

            $('body').on('change', '#choices-size-plot', function() {
                $('.size-range-input input').trigger('input')
            });

            $('body').on('input', '.size-range-input input', function() {

                var typename = $(this).data('typeval');
                var typ_size = 'sq.ft';

                var minVal = $('.size-input-' + typename + ' input.range-min').val();
                var maxVal = $('.size-input-' + typename + ' input.range-max').val();

                var total = parseInt($('.range-input-' + typename + ' input.range-max').attr('max'));

                var percentage = ((maxVal - minVal) / total) * 100;
                var minPercent = (minVal / $('.size-input-' + typename + ' input.range-min').attr('max')) *
                    100;
                var maxPercent = (maxVal / $('.size-input-' + typename + ' input.range-max').attr('max')) *
                    100;

                $('.size-input-' + typename + ' input').attr('title', minVal + ' ' + typ_size);
                $('.size-input-' + typename + ' input').attr('title', maxVal + ' ' + typ_size);


                $('.sizeType').text(typ_size)

                // Update hidden min and max price inputs
                $('.size-input-' + typename + ' input[name="min_price"]').val(minVal);
                $('.size-input-' + typename + ' input[name="max_price"]').val(maxVal);

                // Update displayed range values
                $('.size-input-' + typename + ' .min').text(minVal + ' ' + typ_size);
                $('.size-input-' + typename + ' .max').text(maxVal + ' ' + typ_size);

                // Update range slider color based on percentage
                $('.size-slider-progress-' + typename + ' .progress').css({
                    'left': minPercent + '%',
                    'right': (100 - maxPercent) + '%'
                });

            });



        });
    </script>
    <script>
        // Get geolocation and set it to input fields
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            const latInput = document.querySelector('.lat');
            const longInput = document.querySelector('.long');

            latInput.value = position.coords.latitude;
            longInput.value = position.coords.longitude;

            $('form.property').submit();
            // console.log(`Latitude: ${position.coords.latitude}, Longitude: ${position.coords.longitude}`);
        }

        function showError(error) {
            const errorElement = document.getElementById('error-message');
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    errorElement.textContent = "User denied the request for Geolocation.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorElement.textContent = "Location information is unavailable.";
                    break;
                case error.TIMEOUT:
                    errorElement.textContent = "The request to get user location timed out.";
                    break;
                case error.UNKNOWN_ERROR:
                    errorElement.textContent = "An unknown error occurred.";
                    break;
            }
        }
    </script>

    <script>
        // Get modal elements
        const modal = document.getElementById("voiceSearchModal");
        const openModalButtons = document.querySelectorAll(".openModal");
        const closeModalButton = document.getElementById("closeModal");
        const actionText = document.getElementById("action");
        const output = document.getElementById("output");
        const startButton = document.getElementById("startButton");
        const microphoneIcon = document.querySelector(".microphone");
        // const outputInput = document.getElementsByClassName('keyword-search')[0];
        const outputInput = document.getElementById('keyword-search');


        actionText.innerHTML = "Click to Speak";

        // Function to open the modal
        function openModal() {
            modal.style.display = "block";
        }

        // Function to close the modal and reset states
        function closeModal() {
            modal.style.display = "none";
            output.classList.add("hide");
            output.innerHTML = ""; // Clear output when closing modal
            microphoneIcon.classList.remove("listening", "pulse-ring"); // Stop animations
        }

        // Attach event listeners to all buttons with the 'openModal' class
        openModalButtons.forEach(button => {
            button.addEventListener('click', openModal);
        });

        // Close modal button event
        closeModalButton.addEventListener('click', closeModal);

        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });

        // Speech Recognition Function
        startButton.addEventListener('click', runSpeechRecog);

        function runSpeechRecog() {
            output.innerHTML = "";
            outputInput.value = "";
            actionText.innerHTML = "Listening...";
            output.classList.add("hide"); // Hide output initially
            microphoneIcon.classList.add("listening", "pulse-ring"); // Start mic animation

            // Create a new instance of webkitSpeechRecognition
            const recognition = new webkitSpeechRecognition();
            recognition.continuous = false; // Stop automatically after recognizing
            recognition.interimResults = false; // No interim results
            recognition.lang = 'en-US'; // Set the language

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript; // Get the speech result
                output.innerHTML = transcript; // Show the result in the modal
                outputInput.value = transcript;
                output.classList.remove("hide"); // Show the output element
                actionText.innerHTML = ""; // Clear the action text
                microphoneIcon.classList.remove("listening", "pulse-ring"); // Stop mic animation
            };

            recognition.onerror = (event) => {
                actionText.innerHTML = "Error occurred in recognition: " + event.error;
                microphoneIcon.classList.remove("listening", "pulse-ring"); // Stop mic animation
            };

            recognition.onend = () => {
                actionText.innerHTML = ""; // Clear the action text
                actionText.innerHTML = "Click to Speak";
                microphoneIcon.classList.remove("listening", "pulse-ring"); // Stop mic animation
            };

            // Start recognition
            recognition.start();
        }
    </script>

    {{-- <script>
        function scrollSpy() {
            return {
                activeSection: null,
                offset: 190,
                activeTab: null,
                init() {
                    this.activeTab = 'Overview';
                    this.detectSectionInView();
                    window.addEventListener('scroll', this.detectSectionInView.bind(this));
                },
                detectSectionInView() {
                    const sections = document.querySelectorAll('.section');
                    const viewportHeight = window.innerHeight;

                    sections.forEach(section => {
                        const rect = section.getBoundingClientRect();
                        const sectionMidpoint = rect.top + (rect.height / 2);

                        // Activate the section when its midpoint is near the middle of the viewport
                        if (sectionMidpoint >= viewportHeight * 0.4 && sectionMidpoint <= viewportHeight * 0.6) {
                            // this.activeSection = section.id;
                        }
                    });
                },
                scrollToSection(sectionId) {
                    const section = document.getElementById(sectionId);
                    const yOffset = -this.offset; // Negative offset to scroll slightly above the section

                    const yPosition = section.getBoundingClientRect().top + window.pageYOffset + yOffset;

                    window.scrollTo({
                        top: yPosition,
                        behavior: 'smooth'
                    });
                    this.activeTab = sectionId;
                    this.activeSection = sectionId;
                }
            };
        }
    </script>  --}}
    <script>
        function scrollSpy() {
            return {
                activeSection: null,
                activeTab: null,
                offset: 190,
                init() {
                    // Set default active tab
                    this.activeTab = 'Overview';
                    this.detectSectionInView();

                    // Add scroll event listener
                    window.addEventListener('scroll', this.detectSectionInView.bind(this));
                },
                detectSectionInView() {
                    const sections = document.querySelectorAll('.section');
                    let viewportTop = window.pageYOffset;

                    sections.forEach(section => {
                        const sectionTop = section.offsetTop - this.offset;
                        const sectionBottom = section.offsetTop + section.offsetHeight - this.offset;

                        // Check if the viewport top is within the section boundaries
                        if (viewportTop >= sectionTop && viewportTop < sectionBottom) {

                            this.activeSection = section.id;
                            this.activeTab = section.id; // Update the active tab based on the section in view
                        }
                    });
                },
                scrollToSection(sectionId) {
                    const section = document.getElementById(sectionId);
                    const yOffset = -this.offset;

                    const yPosition = section.getBoundingClientRect().top + window.pageYOffset + yOffset;

                    window.scrollTo({
                        top: yPosition,
                        behavior: 'smooth'
                    });

                    // Manually set active tab on click
                    this.activeTab = sectionId;
                    this.activeSection = sectionId;
                }
            };
        }
    </script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-slick]').slick();
        });
    </script>
    @stack('footer')
    <script src="/themes/hously/plugins/particles.js/particles.js"></script>
    <script>
        $(window).on('load', function() {
            $(".loading-state").hide();
        });

        try {
            const switcher = document.getElementById('theme-mode')
            switcher?.addEventListener('click', changeTheme)

            const chk = document.getElementById('chk')

            chk.addEventListener('change', changeTheme)

            const defaultTheme = window.defaultThemeMode || 'system'

            if (
                getCookie('theme') === 'dark' ||
                defaultTheme === 'dark' ||
                (window.matchMedia('(prefers-color-scheme: dark)').matches && defaultTheme === 'system')
            ) {
                chk.checked = true
                document.documentElement.classList.add('dark')
            } else {
                chk.checked = false
                document.documentElement.classList.remove('dark')
            }

            function changeTheme(e) {
                e.preventDefault()
                const htmlTag = document.getElementsByTagName('html')[0]

                if (htmlTag.className.includes('dark')) {
                    setCookie('theme', 'light')
                    htmlTag.className = 'light'
                } else {
                    setCookie('theme', 'dark')
                    htmlTag.className = 'dark'
                }
            }
        } catch (err) {}
    </script>

    <script>
        $(document).ready(function() {
            $('body').on('click', '.popup-contact-modal-form', function(event) {
                event.preventDefault();
                const id = $(this).data('id'); // Get the property ID from data-id
                const type = $(this).data('type'); // Get the property name from data-name

                // Set the property ID in the hidden input field
                $('#data_id').val(id);
                $('#type').val(type);

                // Update the modal title dynamically
                // $('#enquiryModalLabel').text(`Enquiry for ${propertyName}`);

                // Show the modal
                $('#BookingModal').modal('show');
            });
        });
    </script>


    <style>
        @keyframes confetti-slow {
            0% {
                transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
            }

            100% {
                transform: translate3d(25px, 105vh, 0) rotateX(360deg) rotateY(180deg);
            }
        }

        @keyframes confetti-medium {
            0% {
                transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
            }

            100% {
                transform: translate3d(100px, 105vh, 0) rotateX(100deg) rotateY(360deg);
            }
        }

        @keyframes confetti-fast {
            0% {
                transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
            }

            100% {
                transform: translate3d(-50px, 105vh, 0) rotateX(10deg) rotateY(250deg);
            }
        }


        .confetti-container {
            perspective: 700px;
            position: fixed;
            /* Ensures it stays in the background */
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 0;
            /* Pushes it behind other elements */
            pointer-events: none;
            /* Allows clicks to pass through */
        }


        .confetti {
            position: absolute;
            z-index: 1;
            top: -10px;
            border-radius: 0%;
        }

        .confetti--animation-slow {
            animation: confetti-slow 2.25s linear 1 forwards;
        }

        .confetti--animation-medium {
            animation: confetti-medium 1.75s linear 1 forwards;
        }

        .confetti--animation-fast {
            animation: confetti-fast 1.25s linear 1 forwards;
        }
    </style>

    <script>
        const Confettiful = function(el) {
            this.el = el;
            this.containerEl = null;

            this.confettiFrequency = 9;
            this.confettiColors = ['#fce18a', '#ff726d', '#b48def', '#f4306d'];
            this.confettiAnimations = ['slow', 'medium', 'fast'];

            this._setupElements();
            this._renderConfetti();
        };

        Confettiful.prototype._setupElements = function() {
            const containerEl = document.createElement('div');
            const elPosition = this.el.style.position;

            if (elPosition !== 'relative' || elPosition !== 'absolute') {
                this.el.style.position = 'relative';
            }

            containerEl.classList.add('confetti-container');

            this.el.appendChild(containerEl);

            this.containerEl = containerEl;
        };

        Confettiful.prototype._renderConfetti = function() {
            this.confettiInterval = setInterval(() => {
                const confettiEl = document.createElement('div');
                const confettiSize = Math.floor(Math.random() * 3) + 7 + 'px';
                const confettiBackground = this.confettiColors[Math.floor(Math.random() * this.confettiColors
                    .length)];
                const confettiLeft = Math.floor(Math.random() * this.el.offsetWidth) + 'px';
                const confettiAnimation = this.confettiAnimations[Math.floor(Math.random() * this
                    .confettiAnimations.length)];

                confettiEl.classList.add('confetti', 'confetti--animation-' + confettiAnimation);
                confettiEl.style.left = confettiLeft;
                confettiEl.style.width = confettiSize;
                confettiEl.style.height = confettiSize;
                confettiEl.style.backgroundColor = confettiBackground;

                confettiEl.removeTimeout = setTimeout(function() {
                    confettiEl.parentNode.removeChild(confettiEl);
                }, 3000);

                this.containerEl.appendChild(confettiEl);
            }, 25);
        };

        window.confettiful = new Confettiful(document.querySelector('.js-container'));
    </script>




    <script>
        (function($) {
            var wa_time_out, wa_time_in;
            $(document).ready(function() {
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

                function setCookie(cname, cvalue, exdays) {
                    var d = new Date();
                    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
                    var expires = "expires=" + d.toUTCString();
                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }

                function getCookie(cname) {
                    var name = cname + "=";
                    var ca = document.cookie.split(";");
                    for (var i = 0; i < ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0) == " ") {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                }

                $("#nta-wa-gdpr").change(function() {
                    if (this.checked) {
                        setCookie("nta-wa-gdpr", "accept", 30);
                        if (getCookie("nta-wa-gdpr") != "") {
                            $('.nta-wa-gdpr').hide(500);
                            $('.wa__popup_content_item').each(function() {
                                $(this).removeClass('pointer-disable');
                                $('.wa__popup_content_list').off('click');
                            })
                        }
                    }
                });

                if (getCookie("nta-wa-gdpr") != "") {
                    $('.wa__popup_content_list').off('click');
                } else {
                    $('.wa__popup_content_list').click(function() {
                        $('.nta-wa-gdpr').delay(500).css({
                            "background": "red",
                            "color": "#fff"
                        });
                    });
                }
            });


        })(jQuery);

        $(document).ready(function() {


        });
    </script>


</body>

</html>

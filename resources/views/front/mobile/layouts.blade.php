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
    <style>
        .body {
            min-height: 100vh;
            background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%) !important;
        }

        .mobile-bottom .nav {
            display: flex;
            justify-content: center;
            flex-direction: row;
            width: 100%;
            height: 50px;
            filter: drop-shadow(0 0 5px rgba(31, 31, 31, 0.1));
            position: fixed;
            bottom: 0;
        }

        .mobile-bottom .nav-slot {
            flex-basis: 18%;
            text-align: center;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile-bottom .nav-link {
            width: 25px;
            gap: 8px;
            text-decoration: none;
            height: 98px;
            line-height: 1.5;
            align-items: center;
            color: #aab2bd;
            padding: 0 !important;
            transition: 0.3s all;
            font-size: 10px;
            margin-top: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            align-content: center;
        }

        .mobile-bottom .active {
            color: #2575fc;
        }

        .mobile-bottom .nav-link:hover {
            transition: 0.3s all;
            background: rgba(31, 31, 31, 0.1);
        }

        .mobile-bottom .curve {
            flex-basis: auto !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff'%3E%3Cpath d='M99,0A36.33,36.33,0,0,0,70,15,25,25,0,0,1,30,15,36.33,36.33,0,0,0,1,0H0V50H100V0Z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: cover;
            background-position-y: center;
            width: 100px;
        }

        .mobile-bottom .bg-white {
            background: white;
        }

        .mobile-bottom .floating-button {
            position: fixed;
            width: 50px;
            height: 50px;
            line-height: 3;
            text-align: center;
            color: #FFCE54;
            border-radius: 50%;
            bottom: 35px;
            background-image: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            box-shadow: 0 10px 6px -6px #777;
            z-index: 1;
            transition: 0.3s all;
        }

        .mobile-bottom .floating-button:hover {
            bottom: 40px;
            transition: 0.3s all;
        }

        .mobile-bottom .round-top-left {
            border-top-left-radius: 15px;
        }

        .mobile-bottom .round-top-right {
            border-top-right-radius: 15px;
        }

        .mobile-bottom svg {
            height: 100%;
        }

        select {
            -moz-appearance: auto !important;
            /* Firefox */
            -webkit-appearance: auto !important;
            /* Safari and Chrome */
            appearance: auto !important;
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-slick]').slick();
        });
    </script>

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
    <div x-data="scrollHandler()" x-ref="header" x-show="show" x-cloak
        x-transition:enter="transform opacity-0 -translate-y-full" x-transition:enter-end="transform-none opacity-100"
        x-transition:leave="transform opacity-100" x-transition:leave-end="transform opacity-0 -translate-y-full"
        class="sticky-search-bar bg-white shadow-sm" style="display: none;">
        <div class="bg-theme pt-1 px-1.5">
            @include('front.mobile.search-bar')
        </div>

    </div>

    <div class="loading-state">
        <div class="loading"></div>
    </div>
    <div id="alert-container"></div>
    @yield('content')
    @include('front.mobile.bottom-tab')
    <!-- Modal -->
    <div class="modal fade z-999" id="BookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title text-theme fw-bolder fs-4" id="offcanvasRightLabel">Explore Our Properties
                Easily</h3>
            <button type="button" class="btn-close me-2" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-x-lg text-dark" viewBox="0 0 16 16">
                    <path
                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                </svg>
            </button>
        </div>
        <div class="offcanvas-body">
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="propertyFilterTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <span class="nav-link active" id="buy-tab" data-bs-toggle="tab" data-bs-target="#buy"
                        type="button" role="tab" aria-controls="buy" aria-selected="true">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                            viewBox="0,0,256,256">
                            <g fill="#cba641" fill-rule="nonzero" stroke="none" stroke-width="1"
                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <g transform="scale(8,8)">
                                    <path
                                        d="M17.99219,3c-0.09603,0.00165 -0.18956,0.0308 -0.26953,0.08398l-7.5,5c-0.14997,0.09853 -0.23564,0.26985 -0.22449,0.44894c0.01115,0.17909 0.1174,0.33847 0.27843,0.41764c0.16102,0.07917 0.35213,0.06598 0.50075,-0.03455l7.22266,-4.81445l7.22266,4.81445c0.22969,0.15091 0.53812,0.08814 0.69057,-0.14053c0.15245,-0.22867 0.09176,-0.53752 -0.13588,-0.6915l-7.5,-5c-0.0844,-0.05612 -0.18381,-0.0854 -0.28516,-0.08398zM12.5,9c-0.27614,0 -0.5,0.22386 -0.5,0.5v6c0.00094,0.82804 0.67196,1.49906 1.5,1.5h9c0.82804,-0.00094 1.49906,-0.67196 1.5,-1.5v-6c0,-0.27614 -0.22386,-0.5 -0.5,-0.5c-0.27614,0 -0.5,0.22386 -0.5,0.5v6c-0.00033,0.27601 -0.22399,0.49967 -0.5,0.5h-2.5v-3c0,-1.10457 -0.89543,-2 -2,-2c-1.10457,0 -2,0.89543 -2,2v3h-2.5c-0.27601,-0.00033 -0.49967,-0.22399 -0.5,-0.5v-6c0,-0.27614 -0.22386,-0.5 -0.5,-0.5zM3.5,10c-0.27614,0 -0.5,0.22386 -0.5,0.5c0,0.27614 0.22386,0.5 0.5,0.5h1.65625l4.87695,12.67969c0.07435,0.19306 0.25992,0.32039 0.4668,0.32031h17c0.27614,0 0.5,-0.22386 0.5,-0.5c0,-0.27614 -0.22386,-0.5 -0.5,-0.5h-16.65625l-0.38477,-1h14.04102c0.19763,0.00006 0.37675,-0.11629 0.45703,-0.29687l4,-9c0.06877,-0.15469 0.0546,-0.33368 -0.03766,-0.47562c-0.09226,-0.14194 -0.25008,-0.22756 -0.41937,-0.22751h-3.5v1h2.73047l-3.55664,8h-14.09961l-3.07617,-8h4.00195v-1h-4.38672l-0.64648,-1.67969c-0.07435,-0.19306 -0.25992,-0.32039 -0.4668,-0.32031zM18.0293,12c0.54081,0.01585 0.97094,0.45896 0.9707,1v3h-2v-3c-0.00012,-0.27037 0.10925,-0.52927 0.30317,-0.71767c0.19392,-0.1884 0.45587,-0.29025 0.72612,-0.28233zM13,25c-1.10457,0 -2,0.89543 -2,2c0,1.10457 0.89543,2 2,2c1.10457,0 2,-0.89543 2,-2c-0.00127,-1.10404 -0.89596,-1.99873 -2,-2zM22,25c-1.10457,0 -2,0.89543 -2,2c0,1.10457 0.89543,2 2,2c1.10457,0 2,-0.89543 2,-2c-0.00127,-1.10404 -0.89596,-1.99873 -2,-2zM12.95898,26c0.27225,-0.01118 0.53727,0.08923 0.73377,0.27799c0.1965,0.18876 0.30747,0.44953 0.30724,0.72201c-0.0005,0.55208 -0.44792,0.9995 -1,1c-0.55228,0.01133 -1.00918,-0.42721 -1.02051,-0.97949c-0.01133,-0.55228 0.42721,-1.00918 0.97949,-1.02051zM21.95898,26c0.27225,-0.01118 0.53727,0.08923 0.73377,0.27799c0.1965,0.18876 0.30747,0.44953 0.30724,0.72201c-0.0005,0.55208 -0.44792,0.9995 -1,1c-0.55228,0.01133 -1.00918,-0.42721 -1.02051,-0.97949c-0.01133,-0.55228 0.42721,-1.00918 0.97949,-1.02051z">
                                    </path>
                                </g>
                            </g>
                        </svg></span>
                    <p>Buy</p>
                </li>
                <li class="nav-item" role="presentation">
                    <span class="nav-link" id="rent-tab" data-bs-toggle="tab" data-bs-target="#rent"
                        type="button" role="tab" aria-controls="rent" aria-selected="false">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                            viewBox="0,0,256,256">
                            <g fill="#cba641" fill-rule="nonzero" stroke="none" stroke-width="1"
                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <g transform="scale(0.5,0.5)">
                                    <path
                                        d="M256.68945,0c-10.86949,0.01133 -19.67812,8.81996 -19.68945,19.68945v121.8711c0.01133,10.86949 8.81996,19.67812 19.68945,19.68945h70.31055v39.36914c0.00406,2.87995 1.6547,5.50393 4.24897,6.75447c2.59427,1.25054 5.6752,0.90737 7.93072,-0.88338l56.70117,-45.24023h96.42969c10.86949,-0.01133 19.67812,-8.81996 19.68945,-19.68945v-121.8711c-0.01133,-10.86949 -8.81996,-19.67813 -19.68945,-19.68945zM256.68945,15h235.6211c2.58979,0.0003 4.68915,2.09967 4.68945,4.68945v121.8711c-0.0003,2.58979 -2.09966,4.68915 -4.68945,4.68945h-99.06055c-1.70066,0.00123 -3.35055,0.57966 -4.67969,1.64062l-46.57031,37.16016v-31.30078c0,-4.14214 -3.35786,-7.5 -7.5,-7.5h-77.81055c-2.58979,-0.0003 -4.68915,-2.09966 -4.68945,-4.68945v-121.8711c0.0003,-2.58979 2.09966,-4.68915 4.68945,-4.68945zM275.74023,45.61914c-4.14214,0 -7.5,3.35786 -7.5,7.5v55c0,4.14214 3.35786,7.5 7.5,7.5c4.14214,0 7.5,-3.35786 7.5,-7.5v-21.34961h6.84961l7.38086,23.59961c0.98181,3.12917 3.88058,5.25936 7.16016,5.26172c0.75982,-0.00031 1.51495,-0.11892 2.23828,-0.35156c1.8987,-0.59335 3.48337,-1.91762 4.40451,-3.68075c0.92114,-1.76313 1.10306,-3.82026 0.50565,-5.71769l-7,-22.36133c5.92508,-3.7682 9.51867,-10.2985 9.53125,-17.32031c-0.01097,-11.35771 -9.21262,-20.56372 -20.57032,-20.58008zM329.11914,45.61914c-4.14214,0 -7.5,3.35786 -7.5,7.5v55c0,4.14214 3.35786,7.5 7.5,7.5h27.73047c4.14214,0 7.5,-3.35786 7.5,-7.5c0,-4.14214 -3.35786,-7.5 -7.5,-7.5h-20.23047v-12.5h19c4.14214,0 7.5,-3.35786 7.5,-7.5c0,-4.14214 -3.35786,-7.5 -7.5,-7.5h-19v-12.5h20.23047c4.14214,0 7.5,-3.35786 7.5,-7.5c0,-4.14214 -3.35786,-7.5 -7.5,-7.5zM418.57031,45.61914c-4.14214,0 -7.5,3.35786 -7.5,7.5v30.14063l-22.75,-34.25977c-1.82816,-2.75605 -5.2458,-3.98931 -8.4126,-3.03567c-3.16679,0.95364 -5.33513,3.86903 -5.3374,7.17629v55c0,4.14214 3.35786,7.5 7.5,7.5c4.14214,0 7.5,-3.35786 7.5,-7.5v-30.14062l22.75,34.2793c1.38541,2.10029 3.73393,3.36336 6.25,3.36132c0.73168,-0.00278 1.45916,-0.11065 2.16016,-0.32031c3.16845,-0.9598 5.3365,-3.87882 5.33984,-7.18945v-55c0.00311,-1.99115 -0.78569,-3.90182 -2.19255,-5.31088c-1.40686,-1.40906 -3.31629,-2.20084 -5.30745,-2.20084zM440.33008,45.61914c-4.14214,0 -7.5,3.35786 -7.5,7.5c0,4.14214 3.35786,7.5 7.5,7.5h14v47.5c0,4.14214 3.35786,7.5 7.5,7.5c4.14214,0 7.5,-3.35786 7.5,-7.5v-47.5h14c4.14214,0 7.5,-3.35786 7.5,-7.5c0,-4.14214 -3.35786,-7.5 -7.5,-7.5h-0.08008zM283.25,60.61914h10.49023c2.98912,0.12413 5.34848,2.5835 5.34848,5.57519c0,2.99169 -2.35936,5.45107 -5.34848,5.5752h-10.49023zM172.21289,157.00781c-1.06465,0.04053 -2.10854,0.30683 -3.0625,0.78125l-150,75c-2.54187,1.27142 -4.14824,3.86883 -4.15039,6.71094v40c-0.00017,2.59853 1.34474,5.01198 3.55467,6.37892c2.20994,1.36694 4.96997,1.49256 7.29494,0.33202l9.15039,-4.57032v185.35938h-12.5c-12.42184,0.01103 -22.48897,10.07816 -22.5,22.5v15c0,4.14214 3.35786,7.5 7.5,7.5h330c4.14214,0 7.5,-3.35786 7.5,-7.5v-15c-0.01103,-12.42184 -10.07816,-22.48897 -22.5,-22.5h-12.5v-185.35938l9.15039,4.57032c1.0394,0.52153 2.18671,0.7918 3.34961,0.78906c4.14214,0 7.5,-3.35786 7.5,-7.5v-40c-0.00215,-2.84211 -1.60852,-5.43952 -4.15039,-6.71094l-150,-75c-1.12769,-0.56085 -2.37818,-0.82948 -3.63672,-0.78125zM172.5,172.89062l142.5,71.25v23.21876l-139.15039,-69.57032c-2.109,-1.05274 -4.59022,-1.05274 -6.69922,0l-139.15039,69.57032v-23.21876zM172.5,212.89062l122.5,61.25v192.85938h-75v-87.5c-0.01103,-12.42184 -10.07816,-22.48897 -22.5,-22.5h-50c-12.42184,0.01103 -22.48897,10.07816 -22.5,22.5v87.5h-75v-192.85938zM174.68359,237.04492c-14.29041,-0.59488 -28.20493,4.6664 -38.52667,14.56749c-10.32173,9.90109 -16.15706,23.5848 -16.15692,37.88759c0.03306,28.98124 23.51876,52.46694 52.5,52.5c28.57416,0.0067 51.9066,-22.84 52.50096,-51.40797c0.59436,-28.56798 -21.76766,-52.36535 -50.31737,-53.54711zM165,252.75v29.25h-29.25c3.03607,-14.71519 14.53481,-26.21393 29.25,-29.25zM180,252.75c14.71519,3.03607 26.21393,14.53481 29.25,29.25h-29.25zM135.75,297h29.25v29.25c-14.71519,-3.03607 -26.21393,-14.53481 -29.25,-29.25zM180,297h29.25c-3.03607,14.71519 -14.53481,26.21393 -29.25,29.25zM147.5,372h50c4.14214,0 7.5,3.35786 7.5,7.5v87.5h-65v-87.5c0,-4.14214 3.35786,-7.5 7.5,-7.5zM187.5,404.5c-4.14214,0 -7.5,3.35786 -7.5,7.5v15c0,4.14214 3.35786,7.5 7.5,7.5c4.14214,0 7.5,-3.35786 7.5,-7.5v-15c0,-4.14214 -3.35786,-7.5 -7.5,-7.5zM22.5,482h300c4.14214,0 7.5,3.35786 7.5,7.5v7.5h-315v-7.5c0,-4.14214 3.35786,-7.5 7.5,-7.5z">
                                    </path>
                                </g>
                            </g>
                        </svg></span>
                    <p>Rent</p>
                </li>
                <li class="nav-item" role="presentation">
                    <span class="nav-link" id="pg-tab" data-bs-toggle="tab" data-bs-target="#pg" type="button"
                        role="tab" aria-controls="pg" aria-selected="false">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                            viewBox="0,0,256,256">
                            <g fill="#cba641" fill-rule="nonzero" stroke="none" stroke-width="1"
                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <g transform="scale(5.12,5.12)">
                                    <path
                                        d="M24.96484,1c-0.21166,0.00754 -0.41546,0.08209 -0.58203,0.21289l-23,18c-0.28131,0.22047 -0.42361,0.57428 -0.37328,0.92813c0.05033,0.35385 0.28565,0.65395 0.61728,0.78722c0.33163,0.13328 0.70917,0.07947 0.99037,-0.14113l1.77148,-1.38672h1.61133v-1.26172l19,-14.86914l19,14.86914v1.26172h1.61133l1.77148,1.38672c0.2812,0.22059 0.65873,0.27439 0.99036,0.14111c0.33162,-0.13328 0.56693,-0.43337 0.61727,-0.78721c0.05034,-0.35384 -0.09195,-0.70765 -0.37325,-0.92812l-23,-18c-0.18554,-0.14568 -0.41659,-0.22108 -0.65234,-0.21289zM11,21v24h-2.10547v2h3.78906v-1h0.31641v-2h24v2h0.31641v1h3.78906v-2h-2.10547v-2v-1v-11v-1v-1v-8h-2v3.54492c-1.06379,-0.95653 -2.4645,-1.54492 -4,-1.54492h-8v6h-3.38867c0.84247,-0.73516 1.38867,-1.80287 1.38867,-3c0,-2.19729 -1.80271,-4 -4,-4c-2.19729,0 -4,1.80271 -4,4c0,1.19713 0.5462,2.26484 1.38867,3h-3.38867v-8zM4,21.29297v3.78516h2v-3.78516zM44,21.29297v3.7832h2v-3.7832zM19,24c1.11641,0 2,0.88359 2,2c0,1.11641 -0.88359,2 -2,2c-1.11641,0 -2,-0.88359 -2,-2c0,-1.11641 0.88359,-2 2,-2zM27,25h6c2.22037,0 4,1.77962 4,4h-10zM4,26.96875v3.78516h2v-3.78516zM44,26.96875v3.78516h2v-3.78516zM13,31h24v6.54492c-1.06379,-0.95654 -2.4645,-1.54492 -4,-1.54492h-8v6h-3.38867c0.84247,-0.73516 1.38867,-1.80287 1.38867,-3c0,-2.19729 -1.80271,-4 -4,-4c-2.19729,0 -4,1.80271 -4,4c0,1.19713 0.5462,2.26484 1.38867,3h-3.38867zM4,32.64648v3.78516h2v-3.78516zM44,32.64648v3.7832h2v-3.7832zM19,37c1.11641,0 2,0.88359 2,2c0,1.11641 -0.88359,2 -2,2c-1.11641,0 -2,-0.88359 -2,-2c0,-1.11641 0.88359,-2 2,-2zM27,38h6c2.22037,0 4,1.77963 4,4h-10zM44,38.32227v3.78516h2v-3.78516zM4,38.32422v3.7832h2v-3.7832zM4,44v2c0.00006,0.55226 0.44774,0.99994 1,1h2v-2h-1v-1zM44,44v1h-1v2h2c0.55226,-0.00006 0.99994,-0.44774 1,-1v-2zM14.57813,45v2h3.79102v-2zM20.26367,45v2h3.78906v-2zM25.94727,45v2h3.78906v-2zM31.63086,45v2h3.78906v-2z">
                                    </path>
                                </g>
                            </g>
                        </svg></span>
                    <p>PG/Co-Living</p>
                </li>
                <li class="nav-item" role="presentation">
                    <span class="nav-link" id="commercial-tab" data-bs-toggle="tab" data-bs-target="#commercial"
                        type="button" role="tab" aria-controls="commercial" aria-selected="false">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                            viewBox="0,0,256,256">
                            <g fill="#cba641" fill-rule="nonzero" stroke="none" stroke-width="1"
                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <g transform="scale(4,4)">
                                    <path
                                        d="M29,0.05859c-0.55078,0 -1,0.44531 -1,0.99609v8.94531h-13c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h1v20h-11c-1.65234,0 -3,1.34766 -3,3c0,1.30078 0.83984,2.40234 2,2.81641v24.18359h-3c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h62c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1h-3v-34h1c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1h-9v-2c0,-1.10156 -0.89844,-2 -2,-2h-4v-10h1c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1h-13v-3.94531c0,-0.55078 -0.44922,-1 -1,-1c-0.55078,0 -1,0.44922 -1,1v3.94531h-2v-8.94531c0,-0.55078 -0.44922,-0.99609 -1,-0.99609zM18,12h26v50h-26zM23,16c-0.55078,0 -1,0.44531 -1,1v6c0,0.55469 0.44922,1 1,1c0.55078,0 1,-0.44531 1,-1v-6c0,-0.55469 -0.44922,-1 -1,-1zM31,16c-0.55078,0 -1,0.44531 -1,1v2c0,0.55469 0.44922,1 1,1c0.55078,0 1,-0.44531 1,-1v-2c0,-0.55469 -0.44922,-1 -1,-1zM39,16c-0.55078,0 -1,0.44531 -1,1v6c0,0.55469 0.44922,1 1,1c0.55078,0 1,-0.44531 1,-1v-6c0,-0.55469 -0.44922,-1 -1,-1zM31,24c-0.55078,0 -1,0.44531 -1,1v1c-2.20703,0 -4,1.79297 -4,4v1c0,2.20703 1.79297,4 4,4h2c1.10156,0 2,0.89844 2,2v1c0,1.10156 -0.89844,2 -2,2v-3c0,-0.55469 -0.44922,-1 -1,-1c-0.55078,0 -1,0.44531 -1,1v3c-1.10156,0 -2,-0.89844 -2,-2c0,-0.55469 -0.44922,-1 -1,-1c-0.55078,0 -1,0.44531 -1,1c0,2.20703 1.79297,4 4,4v1c0,0.55469 0.44922,1 1,1c0.55078,0 1,-0.44531 1,-1v-1c2.20703,0 4,-1.79297 4,-4v-1c0,-2.20703 -1.79297,-4 -4,-4v-3c0,-0.55469 -0.44922,-1 -1,-1c-0.55078,0 -1,0.44531 -1,1v3c-1.10156,0 -2,-0.89844 -2,-2v-1c0,-1.10156 0.89844,-2 2,-2h2c1.10156,0 2,0.89844 2,2c0,0.55469 0.44922,1 1,1c0.55078,0 1,-0.44531 1,-1c0,-2.20703 -1.79297,-4 -4,-4v-1c0,-0.55469 -0.44922,-1 -1,-1zM46,24h4v4h8v12h-10c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h10v20h-12zM51,30c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h2c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1zM5,34h11v2h-11c-0.55078,0 -1,-0.44922 -1,-1c0,-0.55078 0.44922,-1 1,-1zM51,34c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h2c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1zM6,38h10v24h-2v-4.05078c0,-1.10156 -0.89844,-2 -2,-2h-2c-1.10156,0 -2,0.89844 -2,2v4.05078h-2zM10,40c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h2c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1zM10,44c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h2c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1zM23,44c-0.55078,0 -1,0.44531 -1,1v6c0,0.55469 0.44922,1 1,1c0.55078,0 1,-0.44531 1,-1v-6c0,-0.55469 -0.44922,-1 -1,-1zM39,44c-0.55078,0 -1,0.44531 -1,1v12c0,0.55469 0.44922,1 1,1c0.55078,0 1,-0.44531 1,-1v-12c0,-0.55469 -0.44922,-1 -1,-1zM51,44c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h2c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1zM10,48c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h2c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1zM31,48c-0.55078,0 -1,0.44531 -1,1v8c0,0.55469 0.44922,1 1,1c0.55078,0 1,-0.44531 1,-1v-8c0,-0.55469 -0.44922,-1 -1,-1zM51,48c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h2c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1zM10,52c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h2c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1zM51,52c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h2c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1zM23,54c-0.55078,0 -1,0.44531 -1,1v2c0,0.55469 0.44922,1 1,1c0.55078,0 1,-0.44531 1,-1v-2c0,-0.55469 -0.44922,-1 -1,-1zM51,56c-0.55078,0 -1,0.44531 -1,1c0,0.55469 0.44922,1 1,1h2c0.55078,0 1,-0.44531 1,-1c0,-0.55469 -0.44922,-1 -1,-1zM10,57.94922h2v4h-2z">
                                    </path>
                                </g>
                            </g>
                        </svg></span>
                    <p>Commercial</p>
                </li>
                <li class="nav-item" role="presentation">
                    <span class="nav-link" id="newlaunch-tab" data-bs-toggle="tab" data-bs-target="#newlaunch"
                        type="button" role="tab" aria-controls="newlaunch" aria-selected="false">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                            viewBox="0,0,256,256">
                            <g fill="#cba641" fill-rule="nonzero" stroke="none" stroke-width="1"
                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <g transform="scale(3.2,3.2)">
                                    <path
                                        d="M15,9v6h2v56h46v-56h2v-6zM17,11h46v2h-2v56h-15v-11h2v-2h-16v2h2v11h-15v-56h-2zM22,13c-0.55078,0 -1,0.44922 -1,1c0,0.55078 0.44922,1 1,1c0.55078,0 1,-0.44922 1,-1c0,-0.55078 -0.44922,-1 -1,-1zM26,13c-0.55078,0 -1,0.44922 -1,1c0,0.55078 0.44922,1 1,1c0.55078,0 1,-0.44922 1,-1c0,-0.55078 -0.44922,-1 -1,-1zM30,13c-0.55078,0 -1,0.44922 -1,1c0,0.55078 0.44922,1 1,1c0.55078,0 1,-0.44922 1,-1c0,-0.55078 -0.44922,-1 -1,-1zM34,13c-0.55078,0 -1,0.44922 -1,1c0,0.55078 0.44922,1 1,1c0.55078,0 1,-0.44922 1,-1c0,-0.55078 -0.44922,-1 -1,-1zM38,13c-0.55078,0 -1,0.44922 -1,1c0,0.55078 0.44922,1 1,1c0.55078,0 1,-0.44922 1,-1c0,-0.55078 -0.44922,-1 -1,-1zM42,13c-0.55078,0 -1,0.44922 -1,1c0,0.55078 0.44922,1 1,1c0.55078,0 1,-0.44922 1,-1c0,-0.55078 -0.44922,-1 -1,-1zM46,13c-0.55078,0 -1,0.44922 -1,1c0,0.55078 0.44922,1 1,1c0.55078,0 1,-0.44922 1,-1c0,-0.55078 -0.44922,-1 -1,-1zM50,13c-0.55078,0 -1,0.44922 -1,1c0,0.55078 0.44922,1 1,1c0.55078,0 1,-0.44922 1,-1c0,-0.55078 -0.44922,-1 -1,-1zM54,13c-0.55078,0 -1,0.44922 -1,1c0,0.55078 0.44922,1 1,1c0.55078,0 1,-0.44922 1,-1c0,-0.55078 -0.44922,-1 -1,-1zM58,13c-0.55078,0 -1,0.44922 -1,1c0,0.55078 0.44922,1 1,1c0.55078,0 1,-0.44922 1,-1c0,-0.55078 -0.44922,-1 -1,-1zM22,20v8h6v-8zM32,20v8h6v-8zM42,20v8h6v-8zM52,20v8h6v-8zM24,22h2v4h-2zM34,22h2v4h-2zM44,22h2v4h-2zM54,22h2v4h-2zM22,32v8h6v-8zM32,32v8h6v-8zM42,32v8h6v-8zM52,32v8h6v-8zM24,34h2v4h-2zM34,34h2v4h-2zM44,34h2v4h-2zM54,34h2v4h-2zM22,44v8h6v-8zM32,44v8h6v-8zM42,44v8h6v-8zM52,44v8h6v-8zM24,46h2v4h-2zM34,46h2v4h-2zM44,46h2v4h-2zM54,46h2v4h-2zM22,56v8h6v-8zM52,56v8h6v-8zM24,58h2v4h-2zM36,58h8v11h-8zM54,58h2v4h-2z">
                                    </path>
                                </g>
                            </g>
                        </svg></span>
                    <p>New Launch</p>
                </li>
                <li class="nav-item" role="presentation">
                    <span class="nav-link" id="plot-tab" data-bs-toggle="tab" data-bs-target="#plot"
                        type="button" role="tab" aria-controls="plot" aria-selected="false">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                            viewBox="0,0,256,256">
                            <g fill="#cba641" fill-rule="nonzero" stroke="none" stroke-width="1"
                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <g transform="scale(5.12,5.12)">
                                    <path
                                        d="M19.41016,6.2207c-0.28,-0.04 -0.53031,0.13992 -0.57031,0.41992c-0.10442,0.6613 -0.19661,1.30503 -0.2793,1.94922c-1.91683,0.07711 -2.90383,1.71416 -3.02344,2.86328c-0.004,0.04 -0.42453,4.08477 -0.01953,9.00977c0.08854,1.08132 0.99173,2.71001 2.79688,2.91797c0.85583,7.85333 3.12913,13.39439 4.55273,16.22656c-1.67718,-2.79338 -6.55121,-10.08952 -13.1875,-12.57812c-0.22,-0.08 -0.45984,0.00164 -0.58984,0.18164c-0.13,0.19 -0.1207,0.43914 0.0293,0.61914c0.05,0.05 4.16047,4.88 5.48047,9.25c0.31,-0.04 0.64977,-0.07008 1.00977,-0.08008c-0.87,-3.07 -3.01969,-6.28969 -4.42969,-8.17969c4.99,2.7 8.85101,8.14008 10.54102,10.83008c0.55113,0.4724 1.07415,0.87376 1.75781,1.11523c0.0006,0.00106 0.00136,0.00284 0.00195,0.00391c0.00488,0.00157 0.01073,0.00234 0.01563,0.00391c0.00482,0.00167 0.00884,0.0042 0.01367,0.00586l0.00195,-0.00195c0.3336,0.10549 0.70544,0.18956 1.14258,0.20898c0.038,0.002 0.07623,0.00291 0.11523,0.00391c-0.77253,-1.23803 -4.32801,-7.44516 -5.45508,-17.64844c1.59536,-0.30106 2.74894,-1.75306 2.61328,-3.40625c-0.333,-4.037 -0.03309,-7.42936 0.00391,-7.81836c0.16692,-1.60572 -0.87843,-3.04207 -2.38867,-3.43359c0.08253,-0.62032 0.17323,-1.24943 0.27734,-1.88281c0.05,-0.27 -0.14016,-0.53008 -0.41016,-0.58008zM38.44922,8.00195c-0.1275,0.0125 -0.24984,0.07273 -0.33984,0.17773c-0.56829,0.69457 -1.10358,1.37592 -1.62305,2.04687c-1.41332,-0.74175 -3.18466,-0.3461 -4.12109,0.99219c-1.717,2.457 -3.21894,4.95669 -4.46094,7.42969c-0.69041,1.37647 -0.29354,3.01641 0.85938,3.94531c-4.85203,10.3434 -3.71035,16.91041 -3.34375,18.38672c0.022,-0.001 0.04441,-0.00191 0.06641,-0.00391c0.03034,-0.00213 0.05625,-0.00893 0.08594,-0.01172c-0.00039,0.00113 -0.00157,0.00474 -0.00195,0.00586c0.06996,-0.00614 0.09263,-0.01874 0.1543,-0.02734c0.12637,-0.01709 0.25044,-0.03561 0.36719,-0.0625c0.02667,-0.00636 0.08621,-0.01406 0.10742,-0.01953c0.05912,-0.01505 0.11338,-0.03358 0.16992,-0.05078c0.01321,-0.00388 0.02789,-0.00581 0.04102,-0.00977v-0.00195c0.03474,-0.01096 0.07147,-0.01958 0.10547,-0.03125c0.079,-0.027 0.15737,-0.05689 0.23438,-0.08789c0.94,-2.45 4.55086,-10.19969 13.13086,-13.17969c-1.79,2.03 -4.94094,5.97 -5.71094,9.5c0.257,0 0.61153,0.00755 1.01953,0.06055c1.07,-4.56 6.61016,-10.15094 6.66016,-10.21094c0.16,-0.16 0.19984,-0.39961 0.08984,-0.59961c-0.12,-0.19 -0.33859,-0.29047 -0.55859,-0.23047c-9.41184,2.34674 -13.6907,9.99906 -15.18359,13.41016c-0.28691,-2.55057 -0.27943,-8.22381 3.46875,-16.32227c2.085,0.81249 3.59855,-0.79956 3.98633,-1.57227c1.1,-2.194 2.44042,-4.42581 3.98242,-6.63281c0.89902,-1.28571 0.72089,-3.00275 -0.33789,-4.08594c0.51393,-0.65681 1.03894,-1.32496 1.59375,-1.99609c0.17,-0.22 0.13969,-0.53094 -0.07031,-0.71094c-0.11,-0.085 -0.24359,-0.11992 -0.37109,-0.10742zM18.9668,9.57813c1.187,0.124 2.1017,1.18636 1.9707,2.44336c-0.037,0.383 -0.34781,3.86114 -0.00781,7.99414c0.1,1.218 -0.80948,2.29067 -2.02148,2.38867c-1.552,0.121 -2.32158,-1.16839 -2.39258,-2.02539c-0.396,-4.817 0.01162,-8.78122 0.01563,-8.82422c0.089,-0.857 0.88855,-2.13556 2.43555,-1.97656zM35.0332,10.8457c0.42708,0.00572 0.85795,0.13369 1.23633,0.39844c1.001,0.7 1.24688,2.08494 0.54688,3.08594c-1.571,2.248 -2.93564,4.52181 -4.05664,6.75781c-0.274,0.544 -1.42361,1.76238 -2.97461,0.98438c-1.091,-0.549 -1.53433,-1.88261 -0.98633,-2.97461c1.22,-2.43 2.69672,-4.88669 4.38672,-7.30469c0.435,-0.6225 1.13585,-0.9568 1.84766,-0.94727zM15.80273,38c-2.487,0 -3.72869,1.07905 -4.92969,2.12305c-1.11,0.965 -2.15944,1.87695 -4.27344,1.87695c-0.276,0 -0.5,0.224 -0.5,0.5c0,0.276 0.224,0.5 0.5,0.5c2.487,0 3.72969,-1.07905 4.92969,-2.12305c1.11,-0.965 2.15944,-1.87695 4.27344,-1.87695c2.114,0 3.16244,0.91195 4.27344,1.87695c1.2,1.044 2.44269,2.12305 4.92969,2.12305c2.486,0 3.72578,-1.08005 4.92578,-2.12305c1.11,-0.965 2.15753,-1.87695 4.26953,-1.87695c2.112,0 3.16148,0.91195 4.27148,1.87695c1.2,1.044 2.44073,2.12305 4.92773,2.12305c0.276,0 0.5,-0.224 0.5,-0.5c0,-0.276 -0.224,-0.5 -0.5,-0.5c-2.113,0 -3.16148,-0.91195 -4.27148,-1.87695c-1.2,-1.044 -2.44173,-2.12305 -4.92773,-2.12305c-2.486,0 -3.72578,1.08005 -4.92578,2.12305c-1.11,0.965 -2.15753,1.87695 -4.26953,1.87695c-2.114,0 -3.16344,-0.91195 -4.27344,-1.87695c-1.201,-1.044 -2.44169,-2.12305 -4.92969,-2.12305z">
                                    </path>
                                </g>
                            </g>
                        </svg></span>
                    <p>Plot and Lands</p>
                </li>
                <li class="nav-item" role="presentation">
                    <span class="nav-link" id="projects-tab" data-bs-toggle="tab" data-bs-target="#projects"
                        type="button" role="tab" aria-controls="projects" aria-selected="false">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                            viewBox="0,0,256,256">
                            <g fill="#cba641" fill-rule="nonzero" stroke="none" stroke-width="1"
                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <g transform="scale(5.12,5.12)">
                                    <path
                                        d="M9,4v17h9v6h5v-23zM12.85938,8h2.04102v2.01563h-2.04102zM16.90039,8h1.95898v2.01563h-1.95898zM34,8v38h6.03906v-4.00781h1.96094v4.00781h6v-38zM12.85938,11.98438h2.04102v2.01563h-2.04102zM16.90039,11.98438h1.95898v2.01563h-1.95898zM42,11.99219h2v2.01562h-2zM38,12.00781h2v2.01367h-2zM37.96094,16h2.03906v2.01563h-2.03906zM42,16h2v2.01563h-2zM37.96094,19.98438h2.03906v2.01563h-2.03906zM42,19.98438h2v2.01563h-2zM2,22.99219v23.00781h6v-4.00781l2,0.00781v4h6v-23.00781zM37.96094,23.99219h2.03906v2.01562h-2.03906zM42,23.99219h2v2.01562h-2zM6,25.99219h2.03906v2.01562h-2.03906zM10,25.99219h2v2.01562h-2zM37.96094,27.97656h2.03906v2.01563h-2.03906zM42,27.97656h2v2.01563h-2zM18,29v17h6l0.03906,-4.00781h1.96094v4.00781h6v-17zM6,29.97656h2.03906v2.01563h-2.03906zM10,29.97656h2v2.01563h-2zM38,31.98438h2.03906v2.01563h-2.03906zM42,31.98438h2v2.01563h-2zM22,32h2v2.01563h-2zM26.03906,32.00781h1.96094v2.01367h-1.96094zM6,33.99219h2.03906v2.01562h-2.03906zM10,33.99219h2v2.01562h-2zM37.96094,35.98438h2.03906v2.01563h-2.03906zM42,35.98438h2v2.01563h-2zM26.03906,35.99219h1.96094v2.01562h-1.96094zM22,36h2v2.01563h-2z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <p>Projects</p>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-3" id="propertyFilterTabsContent">
                <!-- Buy Tab -->
                <div class="tab-pane fade show active" id="buy" role="tabpanel" aria-labelledby="buy-tab">
                    <p>Content for the "Buy" filter option.</p>
                </div>
                <!-- Rent Tab -->
                <div class="tab-pane fade" id="rent" role="tabpanel" aria-labelledby="rent-tab">
                    <p>Content for the "Rent" filter option.</p>
                </div>
                <!-- PG/Co-Living Tab -->
                <div class="tab-pane fade" id="pg" role="tabpanel" aria-labelledby="pg-tab">
                    <p>Content for the "PG/Co-Living" filter option.</p>
                </div>
                <!-- Commercial Tab -->
                <div class="tab-pane fade" id="commercial" role="tabpanel" aria-labelledby="commercial-tab">
                    <p>Content for the "Commercial" filter option.</p>
                </div>
                <!-- New Launch Tab -->
                <div class="tab-pane fade" id="newlaunch" role="tabpanel" aria-labelledby="newlaunch-tab">
                    <p>Content for the "New Launch" filter option.</p>
                </div>
                <!-- Plot and Lands Tab -->
                <div class="tab-pane fade" id="plot" role="tabpanel" aria-labelledby="plot-tab">
                    <p>Content for the "Plot and Lands" filter option.</p>
                </div>
                <!-- Projects Tab -->
                <div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="projects-tab">
                    <p>Content for the "Projects" filter option.</p>
                </div>
            </div>
        </div>
    </div>



    <button type="button" onclick="topFunction()" id="back-to-top"
        class="fixed z-10 items-center justify-center hidden text-lg text-center text-white rounded-full bg-primary back-to-top bottom-28 end-5 h-9 w-9"
        aria-label="{{ __('Go to top') }}">
        <i class="mdi mdi-arrow-up"></i>
    </button>

    <div class="fixed top-0 start-0 hidden w-full h-full bg-opacity-50 sidebar-backdrop z-9999 bg-dark"></div>



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


    <script src="{{ asset('/themes/hously/plugins/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('themes/hously/plugins/tobii/js/tobii.min.js') }}"></script>
    <script src="{{ asset('themes/hously/plugins/choices.js/js/choices.min.js') }}"></script>
    <script src="{{ asset('themes/hously/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('themes/hously/plugins/easy_background.js') }}"></script>

    {{-- <script src="{{ asset('themes/hously/js/wishlist.js') }}"></script> --}}


    {{-- <script src="{{ asset('vendor/core/plugins/language/js/language-public.js?v=2.2.0') }}"></script> --}}
    {{-- <script src="{{ asset('themes/hously/js/cookie-consent/js/cookie-consent.js') }}"></script> --}}
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
</body>

</html>

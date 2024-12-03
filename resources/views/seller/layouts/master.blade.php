<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Door Ventures</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    @stack('header')


    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('themes/dashboard/core.css')}}">
  
   

    <link href="{{ asset('images/backgrounds/favicon.png') }}" rel="shortcut icon">

    <meta name="csrf-token" content="Bl4Hm9d2qAhOAlT3i5zrySuIkWhu45jOtVScjkb7">

    <title>New Door Ventures</title>
    <meta name="description"
        content="When a real estate company prioritizes the “Feet on Street” experience, you expect a unique combination of knowledge, integrity, attention to detail, and reliable realty service and advice. This is precisely what the team at NEW DOOR VENTURES delivers, and their commitment has propelled them to become the leading real estate company in Bangalore. Whether it’s helping families find th...">
    <meta property="og:site_name" content="New Door Ventures">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('images/new-door-logo.png') }}">

    <style>
        [v-cloak],
        [x-cloak] {
            display: none;
        }
    </style>

    <style>
        :root {
            --primary-font: "Inter";
            --primary-color: #cba641;
            --primary-color-rgb: 203, 166, 65;
            --secondary-color: #6c7a91;
            --secondary-color-rgb: 108, 122, 145;
            --heading-color: inherit;
            --text-color: #206bc4;
            --text-color-rgb: 32, 107, 196;
            --link-color: #206bc4;
            --link-color-rgb: 32, 107, 196;
            --link-hover-color: #cba641;
            --link-hover-color-rgb: 203, 166, 65;
        }
    </style>


    <link media="all" type="text/css" rel="stylesheet"
        href="https://stage.newdoorventures.in/vendor/core/core/base/libraries/toastr/toastr.min.css?v=1.8.6">

    <link media="all" type="text/css" rel="stylesheet"
        href="https://stage.newdoorventures.in/vendor/core/core/base/css/core.css?v=1.8.6">


    <link href="{{ asset('themes/dashboard/style.css') }}"
        rel="stylesheet">

    <style>
        #nprogress {
            pointer-events: none;
        }

        #nprogress .bar {
            background: #007bff;

            position: fixed;
            z-index: 1031;
            top: 0;
            left: 0;

            width: 100%;
            height: 2px;
        }

        #nprogress .peg {
            display: block;
            position: absolute;
            right: 0px;
            width: 100px;
            height: 100%;
            box-shadow: 0 0 10px #007bff, 0 0 5px #007bff;
            opacity: 1.0;

            -webkit-transform: rotate(3deg) translate(0px, -4px);
            -ms-transform: rotate(3deg) translate(0px, -4px);
            transform: rotate(3deg) translate(0px, -4px);
        }

        #nprogress .spinner {
            display: block;
            position: fixed;
            z-index: 1031;
            top: 15px;
            right: 15px;
        }

        #nprogress .spinner-icon {
            width: 18px;
            height: 18px;
            box-sizing: border-box;

            border: solid 2px transparent;
            border-top-color: #007bff;
            border-left-color: #007bff;
            border-radius: 50%;

            -webkit-animation: nprogress-spinner 400ms linear infinite;
            animation: nprogress-spinner 400ms linear infinite;
        }

        .nprogress-custom-parent {
            overflow: hidden;
            position: relative;
        }

        .nprogress-custom-parent #nprogress .spinner,
        .nprogress-custom-parent #nprogress .bar {
            position: absolute;
        }

        @-webkit-keyframes nprogress-spinner {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes nprogress-spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <style>
        .toastify {
            padding: 0.75rem 2rem 0.75rem 0.75rem;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow:
                0 3px 6px -1px rgba(0, 0, 0, 0.12),
                0 10px 36px -4px rgba(77, 96, 232, 0.3);
            background: -webkit-linear-gradient(315deg, #73a5ff, #5477f5);
            background: linear-gradient(135deg, #73a5ff, #5477f5);
            position: fixed;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
            border-radius: 2px;
            cursor: pointer;
            text-decoration: none;
            z-index: 9999;
            width: 25rem;
            max-width: calc(100% - 30px);
        }

        .toastify.on {
            opacity: 1;
        }

        .toastify-icon {
            width: 1.5rem;
            height: 1.5rem;
        }

        .toast-close {
            background: transparent;
            border: 0;
            color: white;
            cursor: pointer;
            font-family: inherit;
            font-size: 1em;
            opacity: 0.4;
            padding: 0 5px;
            position: absolute;
            top: 0.25rem;
            inset-inline-end: 0.25rem;
        }

        .toast-close svg {
            width: 1em;
            height: 1em;
        }

        .toastify-right {
            inset-inline-end: 15px;
        }

        .toastify-left {
            inset-inline-start: 15px;
        }

        .toastify-top {
            top: -150px;
        }

        .toastify-bottom {
            bottom: -150px;
        }

        .toastify-rounded {
            border-radius: 25px;
        }

        .toastify-center {
            margin-inline-start: auto;
            margin-inline-end: auto;
            inset-inline-start: 0;
            inset-inline-end: 0;
            max-width: fit-content;
            max-width: -moz-fit-content;
        }

        @media only screen and (max-width: 360px) {

            .toastify-right,
            .toastify-left {
                margin-inline-start: auto;
                margin-inline-end: auto;
                inset-inline-start: 0;
                inset-inline-end: 0;
                max-width: fit-content;
            }
        }
    </style>

    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

</head>
</head>

<body class="dark:bg-slate-900">
    <main class="ps-main flex-column">
        <div class="ps-main__wrapper dark:bg-slate-900" id="vendor-dashboard">
            <div class="d-none d-lg-block">
                @include('seller.layouts.header')
            </div>
        </div>
        @yield('content')
    </main>


    <!-- Dark Mode Toggle Button -->
    <button id="darkModeToggle"
        class="fixed top-1/2 left-0 transform -translate-y-1/2 p-2 dark:bg-white-900 bg-dark text-white rounded-full">
        🌙
    </button>
    @stack('footer')
    <script>
        const toggleButton = document.getElementById("darkModeToggle");

        // Check for dark mode in localStorage
        if (localStorage.getItem("theme") === "dark") {
            document.documentElement.classList.add("dark");
            document.documentElement.classList.remove("light");
        }

        toggleButton.addEventListener("click", function() {
            // Toggle dark mode on <html> tag
            document.documentElement.classList.toggle("dark");
            document.documentElement.classList.toggle("light");

            // Save the theme preference in localStorage
            if (document.documentElement.classList.contains("dark")) {
                localStorage.setItem("theme", "dark");
            } else {
                localStorage.removeItem("theme");
            }
        });
    </script>

</body>

</html>

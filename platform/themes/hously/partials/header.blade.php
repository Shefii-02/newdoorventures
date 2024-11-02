<!DOCTYPE html>
@php
    $themeMode = $_COOKIE['theme'] ?? null;

    if (! in_array($themeMode, ['light', 'dark'])) {
        $themeMode = theme_option('default_theme_mode', 'system');
    }
@endphp
<html lang="{{ app()->getLocale() }}" @class(['scroll-smooth', $themeMode]) dir="{{ BaseHelper::siteLanguageDirection() === 'rtl' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {!! BaseHelper::googleFonts('https://fonts.googleapis.com/css2?family=' . urlencode(theme_option('primary_font', 'League Spartan')) . ':wght@300;400;500;600;700&display=swap') !!}

        <style>
            :root {
                --primary-color: {{ implode(' ', BaseHelper::hexToRgb(theme_option('primary_color', '#CBA641'))) }};
                --secondary-color: {{ theme_option('secondary_color', '#15803D') }};
                --primary-font: '{{ theme_option('primary_font', 'League Spartan') }}', sans-serif;
                --primary-color-rgb: {{ BaseHelper::hexToRgba(theme_option('primary_color', '#CBA641'), 0.8) }};
            }
            
            .logo img{
                max-height: 104px !important;
            /* position: absolute; */	
                margin: 10px 10px;
            }
            html.light .logo-bg{
                position: absolute;
                background-color: #fff;
                border-radius: 15px;
            }
            html.dark .logo-bg{
                position: absolute;
                background-color: #0f172a;
                border-radius: 15px;
            }
            
            html.light #topnav{
                background-color: #fff !important;
            }    
            html.dark #topnav{
                background-color: #0f172a !important;
            }  

            
               /*<---custome-->*/
               
               
            ul.ks-cboxtags {
                list-style: none;
                /*padding: 20px;*/
            }
            ul.ks-cboxtags li{
              display: inline;
            }
            ul.ks-cboxtags li label{
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
            
            ul.ks-cboxtags li input[type="checkbox"]:checked + label::before {
                content: "✔";
                transform: rotate(-360deg);
                transition: transform .3s ease-in-out;
            }
            
            ul.ks-cboxtags li input[type="checkbox"]:checked + label {
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
            ul.ks-cboxtags li input[type="checkbox"]:focus + label {
              border: 2px solid #e9a1ff;
            }            
            
            /* ranger */
            

            .price-input,.size-input {
              width: 100%;
              display: flex;
            }
            
            input[type="number"]::-webkit-outer-spin-button,
            input[type="number"]::-webkit-inner-spin-button {
              -webkit-appearance: none;
            }
            
            .slider {
              height: 5px;
              position: relative;
              background: #ddd;
              border-radius: 5px;
            }
            .slider .progress {
              height: 100%;
              left: 0%;
              right:0%;
              position: absolute;
              border-radius: 5px;
              background: #cba641;
            }
            .range-input,.size-range-input {
              position: relative;
            }
            .range-input input,.size-range-input input {
              position: absolute;
              width: 100%;
              height: 5px;
              top: -5px;
              background: none;
              pointer-events: none;
              -webkit-appearance: none;
              -moz-appearance: none;
            }
            input[type="range"]::-webkit-slider-thumb {
              height: 17px;
              width: 17px;
              border-radius: 50%;
              background: #cba641;
              pointer-events: auto;
              -webkit-appearance: none;
              box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
            }
            input[type="range"]::-moz-range-thumb {
              height: 17px;
              width: 17px;
              border: none;
              border-radius: 50%;
              background: #cba641;
              pointer-events: auto;
              -moz-appearance: none;
              box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
            }


            .bg-theme{
                background-color:#cba641 !important;
                color:#fff !important;
            }

        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #fff !important;
            background-color: #cba641 !important;
            /* border-color: #dee2e6 #dee2e6 #fff; */
        }
        .nav-tabs {
            border-bottom: 0px solid #dee2e6 !important; 
        }
        .nav-tabs .nav-link{
            color:#000 !important;
            border-radius:25px !important;
        }
        
        body{
            overflow-x:hidden !important;
        }
        
        .text-theme{
            color: rgb(203 166 65 / 1) !important;
        }
        .btn-theme{
            background-color: rgb(203 166 65 / 1) !important;
        }
        .border-theme{
            border:1px solid rgb(203 166 65 / 1) !important;
        }
        

        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            window.defaultThemeMode = @json(theme_option('default_theme_mode', 'system'));
        </script>

        {!! Theme::header() !!}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        @stack('custom-style')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    </head>
 
    <body class="dark:bg-slate-900">

        {!! apply_filters(THEME_FRONT_BODY, null) !!}

        <div id="alert-container"></div>

        @if (empty($withoutNavbar))
            {!! Theme::partial('topnav') !!}
        @endif

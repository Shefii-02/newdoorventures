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


    {{-- {!! BaseHelper::googleFonts(
        'https://fonts.googleapis.com/css2?family=' .
            urlencode(theme_option('primary_font', 'League Spartan')) .
            ':wght@300;400;500;600;700&display=swap',
    ) !!} --}}


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

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('themes/hously/css/style.css?v=1.8.6') }}">

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('themes/hously/plugins/leaflet/leaflet.css') }}">

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
</head>

<body class="dark:bg-slate-900">

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
                        aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>


                <div class="modal-body">

                    <form action="">


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
                            <input type="text" class="form-control" name="mobile" required id="floatingInputNo"
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
                                        <input class="form-check-input" type="radio" name="dealer"
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
                            <button type="submit" class="btn btn-theme text-light"
                                data-bs-target="#exampleModalToggle2" data-bs-dismiss="modal"
                                data-bs-toggle="modal">Submit</button>
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
                        aria-label="Close"><i class="bi bi-x-lg"></i></button>
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
    <script src="{{ asset('vendor/core/plugins/language/js/language-public.js?v=2.2.0') }}"></script>
    <script src="{{ asset('vendor/core/plugins/cookie-consent/js/cookie-consent.js?v=1.0.1') }}"></script>
    <script src="{{ asset('themes/hously/js/app2cb4.js?v=1.8.6') }}"></script>
    <script src="{{ asset('themes/hously/js/script2cb4.js?v=1.8.6') }}"></script>
    
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
                            this.activeSection = section.id;
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
    </script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-slick]').slick();
        });
    </script>
    @stack('footer')
    <script src="https://stage.newdoorventures.in/themes/hously/plugins/particles.js/particles.js"></script>
</body>

</html>

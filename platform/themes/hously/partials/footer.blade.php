    @if (empty($withoutFooter))
        <footer class="relative mt-48 bg-slate-900 dark:bg-slate-800">
            <div class="container">
                <div class="grid grid-cols-1">
                    <div class="relative py-16">
                        <div class="relative w-full">
                            {!! dynamic_sidebar('pre_footer') !!}

                            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] -mt-24">
                                {!! dynamic_sidebar('footer_menu') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-[30px] px-0 border-t border-gray-800 dark:border-gray-700">
                <div class="container text-center">
                    <div class="grid items-center gap-6 md:grid-cols-2">
                        <div class="text-center md:text-start">
                            <p class="mb-0 text-gray-300">
                                {!! BaseHelper::clean(theme_option('copyright')) !!}
                            </p>
                        </div>

                        <ul class="p-0 m-0 space-x-1 text-center list-none md:text-end">
                            {!! Theme::partial('currency-switcher') !!}
                            @if ($socialLinks = json_decode(theme_option('social_links')))
                                @foreach ($socialLinks as $social)
                                    @php($social = collect($social)->pluck('value', 'key'))
                                    <li class="inline">
                                        <a href="{{ $social->get('social-url') }}"
                                            title="{{ $social->get('social-name') }}" target="_blank"
                                            class="text-gray-400 border border-gray-800 rounded-md btn btn-icon btn-sm hover:text-white dark:border-gray-700 hover:border-primary dark:hover:border-primary hover:bg-primary dark:hover:bg-primary">
                                            <i class="{{ $social->get('social-icon') }}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="BookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content border-3 border-theme modal-body rounded-3xl">
                <div class="col-lg-12 text-end">
                    <button type="button" class="btn-close border-theme border-3 " data-bs-dismiss="modal"
                        aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>


                <div class="modal-body">
                    <div class="col-lg-12 mb-3">
                        <h6 class="text-theme text-center">Please share your details</h6>
                    </div>
                    <form action="">

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
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
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" required id="floatingInputName" placeholder="">
                            <label for="floatingInputName">Full Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" required id="floatingInputNo"
                                placeholder="+91 Phone">
                            <label for="floatingInputNo">Mobile Number <small class="text-theme">(+91
                                    Phone)</small></label>
                            <p class="text-theme">This number will be verified</p>
                        </div>

                        <div class="form-check  mb-3">
                            <input class="form-check-input" required type="checkbox" value=""
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
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

    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
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


    @if (theme_option('enabled_toggle_theme_mode', true))
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
    @endif

    <button type="button" onclick="topFunction()" id="back-to-top"
        class="fixed z-10 items-center justify-center hidden text-lg text-center text-white rounded-full bg-primary back-to-top bottom-5 end-5 h-9 w-9"
        aria-label="{{ __('Go to top') }}">
        <i class="mdi mdi-arrow-up"></i>
    </button>

    <div class="fixed top-0 start-0 hidden w-full h-full bg-opacity-50 sidebar-backdrop z-9999 bg-dark"></div>

    {!! Theme::footer() !!}

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
                var typ_size = $('#choices-size-plot').val();

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

    </body>

    </html>

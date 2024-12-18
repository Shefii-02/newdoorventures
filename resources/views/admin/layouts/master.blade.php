<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        NDV Dashboard | New Door Ventures Admin Dashboard
    </title>
    <meta name="csrf-token" content="{csrf_token()}">
    <link rel="icon" href="favicon.ico">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link href="{{ asset('assets/admin/style.css') }}" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    @stack('header')
    <style>
        button.swal2-cancel.swal2-styled {
            background: #ff0000;
        }

        button.swal2-deny.swal2-styled {
            background: #808080;
        }

        button.swal2-confirm.swal2-styled {
            background: #008000;
        }
    </style>
</head>

<body x-data="{ page: 'crm', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">
    <!-- ===== Preloader Start ===== -->
    <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 500) })"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-primary border-t-transparent">
        </div>
    </div>

    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        @include('admin.layouts.sidebar')
        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            @include('admin.layouts.header')
            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>


    <script defer src="{{ asset('assets/admin/bundle.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/{{ env('TinyKey') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    @stack('footer')

    <script>
        tinymce.init({
            selector: '.tinyeditor',
            plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media',
                'searchreplace', 'table', 'visualblocks', 'wordcount',

            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                'See docs to implement AI Assistant')),
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-slick]').slick();
        });
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript">
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "preventDuplicates": false,
            "positionClass": "toast-top-right", // Toast position
            "timeOut": "5000", // Timeout duration
            "extendedTimeOut": "5000",
        };

        @if (session('success_msg'))
            toastr.success("{{ session('success_msg') }}", "Success");
        @elseif (session('failed_msg'))
            toastr.error("{{ session('failed_msg') }}", "Error");
        @elseif (session('info'))
            toastr.info("{{ session('info') }}", "Info");
        @elseif (session('warning'))
            toastr.warning("{{ session('warning') }}", "Warning");
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(Idd) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if confirmed
                    document.getElementById('form_' + Idd).submit();
                }
            });
        }
    </script>

</body>

</html>

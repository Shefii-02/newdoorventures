@extends('admin.layouts.master')
@push('header')
<style>
     input.form-control,
        select.form-control,
        .select2.select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            height: 40px !important;
            /* border: var(--bb-border-width) var(--bb-border-style) var(--bb-border-color) !important; */
        }

        .select2-container--default .select2-selection--single {
            border-radius: 6px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__clear {
            height: 35px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }
</style>
@endpush
@section('content')
    <div class="py-4">
        <div
            class="rounded-md border border-stroke bg-whiter p-4 py-3 dark:border-strokedark dark:bg-meta-4 sm:px-6 sm:py-5.5 xl:px-7.5">
            <nav>
                <ol class="flex flex-wrap items-center gap-2">
                    <li>
                        <a class="flex items-center gap-2 font-medium text-black hover:text-primary dark:text-white dark:hover:text-primary"
                            href="{{ route('admin.dashboard.index') }}">
                            <svg class="fill-current" width="15" height="15" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.3503 14.6504H10.2162C9.51976 14.6504 8.93937 14.0698 8.93937 13.373V10.8183C8.93937 10.5629 8.73043 10.3538 8.47505 10.3538H6.54816C6.29279 10.3538 6.08385 10.5629 6.08385 10.8183V13.3498C6.08385 14.0465 5.50346 14.6272 4.80699 14.6272H1.62646C0.929989 14.6272 0.349599 14.0465 0.349599 13.3498V5.24444C0.349599 4.89607 0.535324 4.57092 0.837127 4.38513L6.96604 0.506623C7.29106 0.297602 7.73216 0.297602 8.05717 0.506623L14.1861 4.38513C14.4879 4.57092 14.6504 4.89607 14.6504 5.24444V13.3266C14.6504 14.0698 14.07 14.6504 13.3503 14.6504ZM6.52495 9.54098H8.45184C9.14831 9.54098 9.7287 10.1216 9.7287 10.8183V13.3498C9.7287 13.6053 9.93764 13.8143 10.193 13.8143H13.3503C13.6057 13.8143 13.8146 13.6053 13.8146 13.3498V5.26766C13.8146 5.19799 13.7682 5.12831 13.7218 5.08186L7.61608 1.20336C7.54643 1.15691 7.45357 1.15691 7.40714 1.20336L1.27822 5.08186C1.20858 5.12831 1.18536 5.19799 1.18536 5.26766V13.373C1.18536 13.6285 1.3943 13.8375 1.64967 13.8375H4.80699C5.06236 13.8375 5.2713 13.6285 5.2713 13.373V10.8183C5.24809 10.1216 5.82848 9.54098 6.52495 9.54098Z"
                                    fill=""></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.51145 1.55118L13.465 5.33306V13.3498C13.465 13.4121 13.4126 13.4646 13.3503 13.4646H10.193C10.1307 13.4646 10.0783 13.4121 10.0783 13.3498V10.8183C10.0783 9.92844 9.34138 9.19125 8.45184 9.19125H6.52495C5.63986 9.19125 4.89529 9.92534 4.9217 10.8238V13.373C4.9217 13.4354 4.86929 13.4878 4.80699 13.4878H1.64967C1.58738 13.4878 1.53496 13.4354 1.53496 13.373V5.33323L7.51145 1.55118ZM1.27822 5.08186L7.40714 1.20336C7.45357 1.15691 7.54643 1.15691 7.61608 1.20336L13.7218 5.08186C13.7682 5.12831 13.8146 5.19799 13.8146 5.26766V13.3498C13.8146 13.6053 13.6057 13.8143 13.3503 13.8143H10.193C9.93764 13.8143 9.7287 13.6053 9.7287 13.3498V10.8183C9.7287 10.1216 9.14831 9.54098 8.45184 9.54098H6.52495C5.82848 9.54098 5.24809 10.1216 5.2713 10.8183V13.373C5.2713 13.6285 5.06236 13.8375 4.80699 13.8375H1.64967C1.3943 13.8375 1.18536 13.6285 1.18536 13.373V5.26766C1.18536 5.19799 1.20858 5.12831 1.27822 5.08186ZM13.3503 15.0001H10.2162C9.32668 15.0001 8.58977 14.2629 8.58977 13.373V10.8183C8.58977 10.756 8.53735 10.7036 8.47505 10.7036H6.54816C6.48587 10.7036 6.43345 10.756 6.43345 10.8183V13.3498C6.43345 14.2397 5.69654 14.9769 4.80699 14.9769H1.62646C0.736911 14.9769 0 14.2397 0 13.3498V5.24444C0 4.77143 0.251303 4.33603 0.651944 4.08848L6.77814 0.211698C7.21781 -0.0704034 7.80541 -0.0704031 8.24508 0.211698C8.24546 0.211943 8.24584 0.212188 8.24622 0.212433L14.3713 4.08851C14.7853 4.34436 15 4.78771 15 5.24444V13.3266C15 14.2589 14.2671 15.0001 13.3503 15.0001ZM14.1861 4.38513L8.05717 0.506623C7.73216 0.297602 7.29106 0.297602 6.96604 0.506623L0.837127 4.38513C0.535324 4.57092 0.349599 4.89607 0.349599 5.24444V13.3498C0.349599 14.0465 0.929989 14.6272 1.62646 14.6272H4.80699C5.50346 14.6272 6.08385 14.0465 6.08385 13.3498V10.8183C6.08385 10.5629 6.29279 10.3538 6.54816 10.3538H8.47505C8.73043 10.3538 8.93937 10.5629 8.93937 10.8183V13.373C8.93937 14.0698 9.51976 14.6504 10.2162 14.6504H13.3503C14.07 14.6504 14.6504 14.0698 14.6504 13.3266V5.24444C14.6504 4.89607 14.4879 4.57092 14.1861 4.38513Z"
                                    fill=""></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <svg class="fill-current" width="18" height="7" viewBox="0 0 18 7" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.5704 2.58734L14.8227 0.510459C14.6708 0.333165 14.3922 0.307837 14.1896 0.459804C14.0123 0.61177 13.9869 0.890376 14.1389 1.093L15.7852 3.04324H1.75361C1.50033 3.04324 1.29771 3.24586 1.29771 3.49914C1.29771 3.75241 1.50033 3.95504 1.75361 3.95504H15.7852L14.1389 5.90528C13.9869 6.08257 14.0123 6.36118 14.1896 6.53847C14.2655 6.61445 14.3668 6.63978 14.4682 6.63978C14.5948 6.63978 14.7214 6.58913 14.7974 6.48782L16.545 4.41094C17.0009 3.85373 17.0009 3.09389 16.5704 2.58734Z"
                                fill=""></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M14.1896 0.459804C14.3922 0.307837 14.6708 0.333165 14.8227 0.510459L16.5704 2.58734C17.0009 3.09389 17.0009 3.85373 16.545 4.41094L14.7974 6.48782C14.7214 6.58913 14.5948 6.63978 14.4682 6.63978C14.3668 6.63978 14.2655 6.61445 14.1896 6.53847C14.0123 6.36118 13.9869 6.08257 14.1389 5.90528L15.7852 3.95504H1.75361C1.50033 3.95504 1.29771 3.75241 1.29771 3.49914C1.29771 3.24586 1.50033 3.04324 1.75361 3.04324H15.7852L14.1389 1.093C13.9869 0.890376 14.0123 0.61177 14.1896 0.459804ZM15.0097 2.68302H1.75362C1.3014 2.68302 0.9375 3.04692 0.9375 3.49914C0.9375 3.95136 1.3014 4.31525 1.75362 4.31525H15.0097L13.8654 5.67085C13.8651 5.67123 13.8648 5.67161 13.8644 5.67199C13.5725 6.01385 13.646 6.50432 13.9348 6.79318C14.1022 6.96055 14.3113 7 14.4682 7C14.6795 7 14.9203 6.91713 15.0784 6.71335L16.8207 4.64286L16.8238 4.63904C17.382 3.95682 17.3958 3.00293 16.8455 2.35478C16.8453 2.35453 16.845 2.35429 16.8448 2.35404L15.0984 0.278534L15.0962 0.276033C14.8097 -0.0583053 14.3139 -0.0837548 13.9734 0.17163L13.964 0.17867L13.9551 0.186306C13.6208 0.472882 13.5953 0.968616 13.8507 1.30913L13.857 1.31743L15.0097 2.68302Z"
                                fill=""></path>
                        </svg>
                        Pending properties list
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div>
        <!-- ===== property List Start ===== -->
        <div class="col-span-12">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex items-start justify-between">
                        <h2 class="text-title-sm2 font-bold text-black dark:text-white">
                            Properties List
                        </h2>
                        <div class="relative">
                            @if (permission_check('Property Add'))
                                <a class="bg-primary bg-warning hover:bg-opacity-90 inline-flex items-center justify-center px-6 py-2 rounded-md text-center text-sm text-white"
                                    href="{{ route('admin.properties.create') }}">
                                    Create
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="conatiner px-2">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('admin.properties.index') }}">Pending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.properties.approved') }}">Approved</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.properties.suspended') }}">Suspended</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.properties.sold-rented') }}">Sold/Rented</a>
                        </li>
                    </ul>

                    <div class="py-3">
                        @include('admin.properties.filter')
                    </div>

                </div>
                <div class="container px-2  overflow-x-auto shadow-md sm:rounded-lg mt-3">
                    <div class="relative">
                        @if (permission_check('Property Delete'))
                            <div class="p-2">
                                <form method="POST" id="muli_form_" action="{{ route('admin.properties.multidestroy') }}">
                                    @csrf @method('DELETE')</form>
                                <button form="muli_form_" onclick="confirmDeleteAll(event,'muli_form_')" type="submit"
                                    role="button" class="btn text-dark btn-sm btn-danger hover:text-light">Delete Selected
                                    items</button>
                            </div>
                        @endif
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="p-4 text-dark fw-bold">

                                    </th>
                                    <th colspan="3" class="p-4 text-dark fw-bold">
                                        Property
                                    </th>
                                    <th class="px-6 py-3 text-dark fw-bold">
                                        Type / Purpose / Category
                                    </th>
                                    <th class="px-6 py-3 text-dark fw-bold">
                                        Location
                                    </th>
                                    <th colspan="2" class="px-6 py-3 text-dark fw-bold">
                                        Price
                                    </th>
                                    <th class="px-6 py-3 text-dark fw-bold">
                                        Added by
                                    </th>
                                    <th class="px-6 py-3 text-dark fw-bold">
                                        Created at
                                    </th>
                                    <th class="px-6 py-3 text-dark fw-bold">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="property-rows">
                                @include('admin.properties.items', compact('properties'))
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div id="pagination-links" class="m-4">
                            {{ $properties->links() }}
                            {{-- @include('admin.properties.pagination', compact('properties')) --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <!-- Modal -->
    <div id="property-modal" class="hidden fixed inset-0 z-999999 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow-lg w-11/12">
            <div id="property-modal-content"></div>
        </div>
    </div>
    <!-- ===== property List End ===== -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('property-modal');
            const modalContent = document.getElementById('property-modal-content');

            document.querySelectorAll('.open-property-modal').forEach(button => {
                button.addEventListener('click', async (e) => {
                    const propertyId = e.target.closest('button').getAttribute('data-id');

                    // Fetch the property details
                    const response = await fetch(`/admin/properties/${propertyId}`);
                    const html = await response.text();

                    modalContent.innerHTML = html;
                    modal.classList.remove('hidden');
                });
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modalContent.innerHTML = '';
                }
            });
        });
    </script>
@endpush


@push('footer')
    <script>
        // function filterProperties(search, page = 1) {
        //     fetch(`{{ route('admin.properties.index') }}?search=${search}&page=${page}`, {
        //             headers: {
        //                 'X-Requested-With': 'XMLHttpRequest'
        //             }
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             document.getElementById('property-rows').innerHTML = data.rows;
        //             document.getElementById('pagination-links').innerHTML = data.pagination;
        //         })
        //         .catch(error => console.error('Error:', error));
        // }

        // document.addEventListener('click', function(e) {
        //     if (e.target.classList.contains('pagination-link')) {
        //         e.preventDefault();
        //         const page = e.target.dataset.page;
        //         const search = document.getElementById('table-search').value;

        //         fetch(`{{ route('admin.properties.index') }}?search=${search}&page=${page}`, {
        //                 headers: {
        //                     'X-Requested-With': 'XMLHttpRequest'
        //                 }
        //             })
        //             .then(response => response.json())
        //             .then(data => {
        //                 document.getElementById('property-rows').innerHTML = data.rows;
        //                 document.getElementById('pagination-links').innerHTML = data.pagination;
        //                 document.body.scrollTo({
        //                     top: 0,
        //                     behavior: "smooth"
        //                 });


        //                 // Update active pagination number
        //                 document.querySelectorAll('.pagination-link').forEach(link => {
        //                     link.classList.remove('bg-blue-600', 'text-white');
        //                     link.classList.add('text-blue-600', 'bg-white');
        //                 });
        //                 e.target.classList.add('bg-blue-600', 'text-white');
        //             })
        //             .catch(error => console.error('Error:', error));
        //     }
        // });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#user').select2({
                placeholder: "Select a user",
                allowClear: true,
                width: 'resolve'
            });
        });
    </script>
@endpush

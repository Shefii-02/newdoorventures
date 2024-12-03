@extends('seller.layouts.master')

@section('content')
<div class="container">


    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('user.dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Properties</span>
                </div>
            </li>
        </ol>
    </nav>
</div>

    <div class="container card overflow-x-auto shadow-md sm:rounded-lg mt-3">
        <div class="relative p-5 ">
            <div class="pb-4 flex justify-between">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-2 h-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search" oninput="filterProperties(this.value)"
                        class="block pt-2 py-3 ps-10 text-sm  border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for properties">

                </div>
                <a class="btn btn-info rounded-2xl px-3 p-0 m-2  bg-theme text-white hover:text-dark"
                    href="{{ route('user.properties.create') }}"><i class="bi"></i> Create</a>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th colspan="3" class="p-4 text-dark fw-bold">
                            Property
                        </th>
                        <th class="px-6 py-3 text-dark fw-bold">
                            Type / Purpose
                        </th>
                        <th class="px-6 py-3 text-dark fw-bold">
                            Location
                        </th>
                        <th colspan="2" class="px-6 py-3 text-dark fw-bold">
                            Price
                        </th>
                        <th class="px-6 py-3 text-dark fw-bold">
                            Leads
                        </th>
                        <th class="px-6 py-3 text-dark fw-bold">
                            Views
                        </th>
                        <th class="px-6 py-3 text-dark fw-bold">
                            Status
                        </th>
                        <th class="px-6 py-3 text-dark fw-bold">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="property-rows">
                    @include('seller.properties.items', compact('properties'))
                </tbody>
            </table>

            <!-- Pagination -->
            <div id="pagination-links" class="mt-4">
                @include('seller.properties.pagination', compact('properties'))
            </div>
        </div>

    </div>
@endsection

@push('footer')
    <script>
        function filterProperties(search, page = 1) {
            fetch(`{{ route('user.properties.index') }}?search=${search}&page=${page}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('property-rows').innerHTML = data.rows;
                    document.getElementById('pagination-links').innerHTML = data.pagination;
                })
                .catch(error => console.error('Error:', error));
        }

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('pagination-link')) {
                e.preventDefault();
                const page = e.target.dataset.page;
                const search = document.getElementById('table-search').value;

                fetch(`{{ route('user.properties.index') }}?search=${search}&page=${page}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('property-rows').innerHTML = data.rows;
                        document.getElementById('pagination-links').innerHTML = data.pagination;

                        // Update active pagination number
                        document.querySelectorAll('.pagination-link').forEach(link => {
                            link.classList.remove('bg-blue-600', 'text-white');
                            link.classList.add('text-blue-600', 'bg-white');
                        });
                        e.target.classList.add('bg-blue-600', 'text-white');
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endpush

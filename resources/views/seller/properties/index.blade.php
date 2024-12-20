@extends('seller.layouts.master')

@section('content')
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('user.dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-3 h-3 me-2.5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500">Properties</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Properties Section -->
        <div class="container card overflow-x-auto shadow-md sm:rounded-lg mt-3">
            <div class="relative p-5" x-data="propertyTabs()">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" @click="fetchTabData('approved')"
                            :class="selectedTab === 'approved' ? 'text-white bg-bitbucket-lt fw-bold' :
                                'bg-gray-200 text-gray-700'"
                            class="nav-link">
                            Approved Properties
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" @click="fetchTabData('pending')"
                            :class="selectedTab === 'pending' ? 'text-white bg-bitbucket-lt fw-bold' :
                                'bg-gray-200 text-gray-700'"
                            class="nav-link">
                            Pending Approval
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" @click="fetchTabData('suspended')"
                            :class="selectedTab === 'suspended' ? 'text-white bg-bitbucket-lt fw-bold' :
                                'bg-gray-200 text-gray-700'"
                            class="nav-link">
                            Suspended Properties
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" @click="fetchTabData('completed')"
                            :class="selectedTab === 'completed' ? 'text-white bg-bitbucket-lt fw-bold' :
                                'bg-gray-200 text-gray-700'"
                            class="nav-link">
                            Sold / Rented Properties
                        </button>
                    </li>
                    <input type="hidden" value="approved" name="status" id="status">
                </ul>

                <div class="">
                    <div class="relative py-5 ">

                        <div class="pb-4 flex justify-between items-center">
                            <div class=" flex gap-4">
                                <div class="relative mt-1">
                                    <div
                                        class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-2 h-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="table-search" oninput="filterProperties(this.value)"
                                        class="block pt-2 py-3 ps-10 text-sm  border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Search for properties">
                                </div>
                                <div class="relative mt-1">
                                    <div
                                        class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-2 h-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <select id="table-search-type" onchange="filterPropertiesByType(this.value)"
                                        class="block pt-2 py-3 ps-10 text-sm  border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="all">All Type Properties</option>
                                        <option value="sell">Sell</option>
                                        <option value="rent">Rent</option>
                                        <option value="pg">PG</option>
                                    </select>
                                </div>
                            </div>
                            <a class="bg-theme btn btn-info hover:text-dark m-2 p-0 px-3 py-2 rounded-2xl text-white"
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
                                        Created at
                                    </th>
                                    {{-- <th class="px-6 py-3 text-dark fw-bold">
                                        Status
                                    </th> --}}
                                    <th class="px-6 py-3 text-dark fw-bold">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody idd="property-rows" id="property-content" x-html="content">
                                @include('seller.properties.items', compact('properties'))
                            </tbody>
                        </table>


                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script>
        function propertyTabs() {
            return {
                selectedTab: 'approved', // Default tab
                content: `@include('seller.properties.items', compact('properties'))`,
                fetchTabData(type, page = 1) {
                    document.getElementById('table-search').value = ''; // Clear search input
                    document.getElementById('status').value = type;
                    document.getElementById('table-search-type').value='all'
                    this.selectedTab = type; // Set active tab
                    const search = document.getElementById('table-search').value; // Get the current search value
                    const url = new URL(`{{ route('user.properties.index') }}`);
                    const params = new URLSearchParams({
                        search,
                        page,
                        status: type
                    });

                    // Fetch properties based on status, search, and page
                    fetch(`${url}?${params.toString()}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(data => {
                            this.content = data; // Update the content of the properties table
                        })
                        .catch(error => console.error('Error fetching tab data:', error));
                },
            };
        }

        function filterProperties(search, page = 1) {
      
            const type = document.getElementById('table-search-type').value; // Get selected type
            const url = new URL(`{{ route('user.properties.index') }}`);
            const status = document.querySelector('input[name="status"]')?.value || 'all';  // Get selected status, default to 'all'

            const params = new URLSearchParams({
                search,
                page,
                type,
                status
            });

            // Fetch properties based on search term, type, and page
            fetch(`${url}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('property-content').innerHTML = data; // Inject content into the table
                })
                .catch(error => console.error('Error:', error));
        }

        function filterPropertiesByType(type = 'all', page = 1) {
            const search = document.getElementById('table-search').value; 
            const url = new URL(`{{ route('user.properties.index') }}`);
            const status = document.querySelector('input[name="status"]')?.value || 'all';  // Get selected status, default to 'all'
            const params = new URLSearchParams({
                search,
                page,
                type,
                status
            });

            // Fetch properties filtered by type and search term
            fetch(`${url}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('property-content').innerHTML = data; // Inject content into the table
                })
                .catch(error => console.error('Error:', error));
        }

        // Attach pagination click event dynamically
        document.addEventListener('click', function(event) {
            if (event.target.matches('.pagination-link')) {
                event.preventDefault();
                const url = new URL(event.target.href);
                const params = new URLSearchParams(url.search);
                const page = params.get('page');
                const status = params.get('status');
                if (page && status) {
                    Alpine.store('propertyTabs').fetchTabData(status, page);
                }
            }
        });
    </script>
@endpush

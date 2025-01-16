@extends('front.mobile.layouts')
@php

    $searchType = 'projects';
    $type = request()->get('type') != '' ? request()->get('type') : 'projects';
@endphp
@section('content')
    <div x-data="scrollHandler()" x-ref="header" x-show="show" x-cloak
        x-transition:enter="transform opacity-0 -translate-y-full" x-transition:enter-end="transform-none opacity-100"
        x-transition:leave="transform opacity-100" x-transition:leave-end="transform opacity-0 -translate-y-full"
        class="sticky-search-bar bg-white shadow-sm" style="display: none;">
        <div class="bg-theme pt-1 px-1.5">
            @include('front.mobile.search-bar', ['div' => 'search2','selected' =>'projects'])
        </div>

    </div>

    <div class="bg-theme">
        <div class="pt-3 px-2">
            @include('front.mobile.search-bar', ['div' => 'search1','selected' =>'projects'])
        </div>
    </div>
    <div class="relative mt-10">
        <div class="relative hidden md:block">
            <div class="overflow-hidden text-white shape z-1 dark:text-slate-900">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>

        <div class="fixed top-0 start-0 w-10/12 h-screen transition-transform duration-300 -translate-x-full md:hidden z-999 dark:bg-gray-800"
            id="filter-drawer">
            <div class="absolute inset-0 w-full h-full p-4 overflow-y-auto bg-white dark:bg-slate-900">
                <button type="button" id="close-filters"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm px-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="text-xl mdi mdi-close"></i>
                </button>

            </div>
        </div>
    </div>

    <section class="relative">
        <div class="container">
            <h3 class="fs-4 pb-5 text-gray fw-bold ">{{ isset($searchByTitle) ? $searchByTitle : '' }}</h3>

            @php
                $filtersApplied =
                    request()->filled('city') ||
                    request()->filled('project') ||
                    is_array(request()->get('categories')) ||
                    is_array(request()->get('bedrooms')) ||
                    is_array(request()->get('ownership')) ||
                    request()->filled('min_price') ||
                    request()->filled('max_price');
            @endphp

            @if ($filtersApplied)
                <span class="font-italic fs-13">Searching for</span>: <br>
                @if (request()->filled('city') && request('city') !== 'null')
                    <span class="text-capitalize fs-6">Locality: <span class="fw-bold">{{ request('city') }}</span></span> |
                @endif
                @if (request()->filled('builder') && request('builder') !== 'null')
                    <span class="text-capitalize fs-6">Builder: <span
                            class="fw-bold">{{ implode(', ', request('builder')) }}</span></span>
                    |
                @endif
                @if (is_array(request()->get('categories')))
                    <span class="text-capitalize fs-6">Categories: <span
                            class="fw-bold">{{ implode(', ', request('categories')) }}</span></span> |
                @endif
                @if (is_array(request()->get('ownership')))
                    <span class="text-capitalize fs-6">Ownership: <span
                            class="fw-bold">{{ implode(', ', request('ownership')) }}</span></span> |
                @endif
                @if (is_array(request()->get('construction')))
                    <span class="text-capitalize fs-6">Construction Status: <span
                            class="fw-bold">{{ str_replace('_', ' ', implode(', ', request('construction'))) }}</span></span>
                    |
                @endif
                @if (is_array(request()->get('occupancy')))
                    <span class="text-capitalize fs-6">Occupancy: <span
                            class="fw-bold">{{ str_replace('_', ' ', implode(', ', request('occupancy'))) }}</span></span> |
                @endif


                @if (request()->filled('min_price') || request()->filled('max_price'))
                    <span class="text-capitalize fs-6">Budget:
                        <span class="fw-bold">
                            Min Price: {{ number_format(request('min_price', 0)) }},
                            Max Price: {{ number_format(request('max_price', 0)) }}
                        </span>
                    </span>
                @endif
                <hr class="my-2">
            @else
                <span class="text-muted">No filters applied</span>
                <hr class="my-2">
            @endif
        </div>
    </section>

    <section class="relative">
        <div class="container">

            <div id="items-map" @class([
                'hidden' => !request()->input('layout') == 'map' || !$showMap,
            ])>
            </div>
            <div data-box-type="property" @class(['hidden' => request()->input('layout') == 'map']) data-layout="grid"
                style="max-height: none; max-width: none">
                <div id="items-list">
                    @include('front.shortcuts.projects.items', compact('projects'))
                </div>
            </div>
        </div>
    </section>
@endsection

@push('footer')
    {{-- <script>
        const selectedItems = {};

        function fetchSuggestions(type) {

            const searchQuery = document.getElementById(`search-box-projects`).value;
            const loadingIcon = document.getElementById(`loading-icon-projects`);
            const suggestionsList = document.getElementById(`suggestions-list-projects`);
            const suggestionsUl = document.getElementById(`suggestions-ul-projects`);

            if (searchQuery.length > 1) {
                loadingIcon.style.display = 'inline-block'; // Show loading icon

                fetch(`/searching-in-keywords?k=${searchQuery}&type=${type}`)
                    .then(response => response.json())
                    .then(data => {
                        loadingIcon.style.display = 'none'; // Hide loading icon
                        suggestionsUl.innerHTML = ''; // Clear previous suggestions

                        if (data && Object.keys(data).length > 0) {
                            Object.keys(data).forEach(category => {
                                if (data[category].length > 0) {
                                    const categoryHeading = document.createElement('li');
                                    categoryHeading.textContent = category.charAt(0).toUpperCase() + category
                                        .slice(1);
                                    categoryHeading.classList.add('px-4', 'py-2', 'font-bold', 'text-gray-800');
                                    suggestionsUl.appendChild(categoryHeading);

                                    data[category].forEach(item => {
                                        const li = document.createElement('li');
                                        li.textContent = item;
                                        li.classList.add('px-4', 'py-2', 'hover:bg-gray-200',
                                            'cursor-pointer');
                                        li.onclick = () => selectItem(type, item);
                                        suggestionsUl.appendChild(li);
                                    });
                                }
                            });
                            suggestionsList.style.display = 'block'; // Show suggestions
                        } else {
                            const noResults = document.createElement('li');
                            noResults.textContent = 'No results found';
                            noResults.classList.add('px-4', 'py-2', 'text-center');
                            suggestionsUl.appendChild(noResults);
                            suggestionsList.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        loadingIcon.style.display = 'none'; // Hide loading icon
                        console.error('Error fetching suggestions:', error);
                    });
            } else {
                suggestionsList.style.display = 'none'; // Hide suggestions if input is too short
            }
        }

        function selectItem(type, item) {
            if (!selectedItems[type]) {
                selectedItems[type] = [];
            }
            if (!selectedItems[type].includes(item)) {
                selectedItems[type].push(item);
                updateSelectedItems(type);
            }
            document.getElementById(`search-box-projects`).value = '';
            document.getElementById(`suggestions-list-projects`).style.display = 'none';
            document.getElementById(`suggestions-ul-projects`).innerHTML = ''
        }

        function removeItem(type, item) {
            if (selectedItems[type]) {
                selectedItems[type] = selectedItems[type].filter(selectedItem => selectedItem !== item);
                updateSelectedItems(type);
            }
        }

        function updateSelectedItems(type) {
            const selectedItemsDisplay = document.getElementById(`selected-items-display-projects`);
            selectedItemsDisplay.innerHTML = ''; // Clear previous items

            selectedItems[type].forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.classList.add('flex', 'items-center', 'bg-gray-200', 'px-2', 'py-1', 'rounded-md');
                itemDiv.textContent = item;

                const removeIcon = document.createElement('span');
                removeIcon.textContent = '×';
                removeIcon.classList.add('ml-2', 'text-red-500', 'cursor-pointer');
                removeIcon.onclick = () => removeItem(type, item);

                itemDiv.appendChild(removeIcon);
                selectedItemsDisplay.appendChild(itemDiv);

                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 's[]';
                hiddenInput.value = item;

                selectedItemsDisplay.appendChild(hiddenInput);
            });

            const showMoreBtn = document.getElementById(`show-more-btn-projects`);
            showMoreBtn.style.display = selectedItems[type].length > 5 ? 'block' : 'none';
        }

        function toggleShowMore(type) {
            const selectedItemsDisplay = document.getElementById(`selected-items-display-projects`);
            const showMoreBtn = document.getElementById(`show-more-btn-projects`);

            if (selectedItemsDisplay.style.maxHeight === '100%') {
                selectedItemsDisplay.style.maxHeight = '30px';
                showMoreBtn.textContent = 'Show More';
            } else {
                selectedItemsDisplay.style.maxHeight = '100%';
                showMoreBtn.textContent = 'Show Less';
            }
        }

        function showSuggestions(type) {
            const suggestionsList = document.getElementById(`suggestions-list-projects`);
            if (suggestionsList.children.length > 0) {
                suggestionsList.style.display = 'block';
            }
        }
    </script> --}}
@endpush

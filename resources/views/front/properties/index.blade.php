@extends('layouts.app')
@php
    $layouts = [
        'grid' => [
            'name' => __('Grid'),
            'icon' => 'mdi mdi-view-grid-outline',
        ],
        'list' => [
            'name' => __('List'),
            'icon' => 'mdi mdi-view-list-outline',
        ],
        'map' => [
            'name' => __('Map'),
            'icon' => 'mdi mdi-map-marker',
        ],
    ];

    $currentLayout = 'grid';

    if (!in_array($currentLayout, array_keys($layouts))) {
        $currentLayout = 'grid';
    }

    $searchType = 'properties';
@endphp
@section('content')
    <div class="relative mt-28">
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
                {{-- <div class="mt-8 mb-12 {{ $searchType === 'projects' ? 'project' : 'property' }}-search item-search">
                    @include('front.shortcuts.properties.search-box-top', [
                        'id' => null,
                        'type' => request()->get('type') ?? $searchType,
                        'mode' => request()->get('m') ?? $searchType,
                        'categories' => $categories,
                        'cities' => $cities,
                        'builders' => $builders,
                    ])
                </div> --}}
            </div>
        </div>
    </div>

    <div class="p-2 bg-white  dark:border-gray-800 mb-0 dark:bg-slate-900 sticky top-0 z-999">
        <div class="container  ">
            <div class=" ">
                @if (isset($type) && $type == 'pg')
                    @include('front.shortcuts.properties.search-box-top-pg', [
                        'id' => null,
                        'type' => request()->get('type') ?? isset($type) ? $type : '',
                        'mode' => request()->get('m') ?? $searchType,
                        'categories' => $categories,
                        'cities' => $cities,
                        'builders' => $builders,
                        'min_price' => request()->get('min_price') ?? '',
                        'max_price' => request()->get('max_price') ?? '',
                        'projects' => $projects,
                    ])
                @elseif(isset($type) && $type == 'commercial')
                    @include('front.shortcuts.properties.search-box-top-commercial', [
                        'id' => null,
                        'type' => request()->get('type') ?? isset($type) ? $type : '',
                        'mode' => request()->get('m') ?? $searchType,
                        'categories' => $categories->where('has_commercial'),
                        'cities' => $cities,
                        'builders' => $builders,
                        'min_price' => request()->get('min_price') ?? '',
                        'max_price' => request()->get('max_price') ?? '',
                        'projects' => $projects,
                    ])
                @elseif(isset($type) && $type == 'plot')
                    @include('front.shortcuts.properties.search-box-top-plot', [
                        'id' => null,
                        'type' => request()->get('type') ?? isset($type) ? $type : '',
                        'mode' => request()->get('m') ?? $searchType,
                        'categories' => $categories,
                        'cities' => $cities,
                        'builders' => $builders,
                        'min_price' => request()->get('min_price') ?? '',
                        'max_price' => request()->get('max_price') ?? '',
                        'projects' => $projects,
                    ])
                @else
                    @include('front.shortcuts.properties.search-box-top', [
                        'id' => null,
                        'type' => request()->get('type') ?? isset($type) ? $type : '',
                        'mode' => request()->get('m') ?? $searchType,
                        'categories' => $categories,
                        'cities' => $cities,
                        'builders' => $builders,
                        'min_price' => request()->get('min_price') ?? '',
                        'max_price' => request()->get('max_price') ?? '',
                        'projects' => $projects,
                    ])
                @endif
            </div>
            <h3 class="fs-4 pb-5 text-gray fw-bold ">{{ isset($searchByTitle) ? $searchByTitle : '' }}</h3>
        </div>
    </div>
    <section class="relative">
        <div class="container">
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
                @if (request()->filled('project') && request('project') !== 'null')
                    <span class="text-capitalize fs-6">Project: <span class="fw-bold">{{ request('project') }}</span></span>
                    |
                @endif
                @if (is_array(request()->get('categories')))
                    <span class="text-capitalize fs-6">Categories: <span
                            class="fw-bold">{{ implode(', ', request('categories')) }}</span></span> |
                @endif
                @if (is_array(request()->get('bedrooms')))
                    <span class="text-capitalize fs-6">Bedrooms: <span
                            class="fw-bold">{{ implode(', ', request('bedrooms')) }}</span></span> |
                @endif
                @if (is_array(request()->get('ownership')))
                    <span class="text-capitalize fs-6">Ownership: <span
                            class="fw-bold">{{ implode(', ', request('ownership')) }}</span></span> |
                @endif
                @if (is_array(request()->get('availability')))
                    <span class="text-capitalize fs-6">Availability: <span
                            class="fw-bold">{{ implode(', ', request('availability')) }}</span></span> |
                @endif
                @if (is_array(request()->get('occupancy')))
                    <span class="text-capitalize fs-6">Occupancy: <span
                            class="fw-bold">{{ implode(', ', request('occupancy')) }}</span></span> |
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
                {{-- {!! Theme::partial('real-estate.properties.items-map', compact('properties')) !!} --}}
            </div>
            <div data-box-type="property" @class(['hidden' => request()->input('layout') == 'map']) data-layout="grid"
                style="max-height: none; max-width: none">
                <div id="items-list">
                    @include(
                        'front.shortcuts.properties.items',
                        compact('properties', 'projectProperties', 'readyToMoveProjects'))
                </div>
            </div>
        </div>
    </section>
@endsection



@push('footer')
    {{-- <script>
    const selectedItems = {};

    function fetchSuggestions(type) {
    
        const searchQuery = document.getElementById(`search-box-${type}`).value;
        const loadingIcon = document.getElementById(`loading-icon-${type}`);
        const suggestionsList = document.getElementById(`suggestions-list-${type}`);
        const suggestionsUl = document.getElementById(`suggestions-ul-${type}`);
     
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
                                categoryHeading.textContent = category.charAt(0).toUpperCase() + category.slice(1);
                                categoryHeading.classList.add('px-4', 'py-2', 'font-bold', 'text-gray-800');
                                suggestionsUl.appendChild(categoryHeading);

                                data[category].forEach(item => {
                                    const li = document.createElement('li');
                                    li.textContent = item;
                                    li.classList.add('px-4', 'py-2', 'hover:bg-gray-200', 'cursor-pointer');
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
        document.getElementById(`search-box-${type}`).value = '';
        document.getElementById(`suggestions-list-${type}`).style.display = 'none';
         document.getElementById(`suggestions-ul-${type}`).innerHTML = ''
    }

    function removeItem(type, item) {
        if (selectedItems[type]) {
            selectedItems[type] = selectedItems[type].filter(selectedItem => selectedItem !== item);
            updateSelectedItems(type);
        }
    }

    function updateSelectedItems(type) {
        const selectedItemsDisplay = document.getElementById(`selected-items-display-${type}`);
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

        const showMoreBtn = document.getElementById(`show-more-btn-${type}`);
        showMoreBtn.style.display = selectedItems[type].length > 5 ? 'block' : 'none';
    }

    function toggleShowMore(type) {
        const selectedItemsDisplay = document.getElementById(`selected-items-display-${type}`);
        const showMoreBtn = document.getElementById(`show-more-btn-${type}`);

        if (selectedItemsDisplay.style.maxHeight === '100%') {
            selectedItemsDisplay.style.maxHeight = '30px';
            showMoreBtn.textContent = 'Show More';
        } else {
            selectedItemsDisplay.style.maxHeight = '100%';
            showMoreBtn.textContent = 'Show Less';
        }
    }

    function showSuggestions(type) {
        const suggestionsList = document.getElementById(`suggestions-list-${type}`);
        if (suggestionsList.children.length > 0) {
            suggestionsList.style.display = 'block';
        }
    }
</script> --}}
    <script>
        const selectedItems = {};

        function fetchSuggestions(type) {
            const searchQuery = document.getElementById(`search-box-${type}`).value.trim();
            const loadingIcon = document.getElementById(`loading-icon-${type}`);
            const suggestionsList = document.getElementById(`suggestions-list-${type}`);
            const suggestionsUl = document.getElementById(`suggestions-ul-${type}`);

            if (searchQuery.length > 1) {
                loadingIcon.style.display = 'inline-block'; // Show loading icon

                fetch(`/searching-in-keywords?k=${encodeURIComponent(searchQuery)}&type=${type}`)
                    .then(response => response.json())
                    .then(data => {
                        loadingIcon.style.display = 'none'; // Hide loading icon
                        renderSuggestions(data, type);
                    })
                    .catch(error => {
                        loadingIcon.style.display = 'none'; // Hide loading icon
                        console.error('Error fetching suggestions:', error);
                    });
            } else {
                hideSuggestions(type);
            }
        }

        function renderSuggestions(data, type) {
            const suggestionsUl = document.getElementById(`suggestions-ul-${type}`);
            suggestionsUl.innerHTML = ''; // Clear previous suggestions

            if (data && Object.keys(data).length > 0) {
                Object.keys(data).forEach(category => {
                    if (data[category].length > 0) {
                        const categoryHeading = createListElement(category, 'px-4 py-2 font-bold text-gray-800');
                        suggestionsUl.appendChild(categoryHeading);

                        data[category].forEach(item => {
                            const li = createListElement(item.display,
                                'px-4 py-2 hover:bg-dark-200 cursor-pointer');
                            li.onclick = () => selectItem(type, item.value);
                            suggestionsUl.appendChild(li);
                        });
                    }
                });
                showSuggestions(type);
            } else {
                const noResults = createListElement('No results found', 'px-4 py-2 text-center');
                suggestionsUl.appendChild(noResults);
                showSuggestions(type);
            }
        }

        function selectItem(type, item) {
            if (!selectedItems[type]) selectedItems[type] = [];
            if (!selectedItems[type].includes(item)) {
                selectedItems[type].push(item);
                updateSelectedItems(type);
            }
            clearSearchBox(type);
            hideSuggestions(type);
        }

        function removeItem(type, item) {
            if (selectedItems[type]) {
                selectedItems[type] = selectedItems[type].filter(selectedItem => selectedItem !== item);
                updateSelectedItems(type);
            }
        }

        function updateSelectedItems(type) {
            const selectedItemsDisplay = document.getElementById(`selected-items-display-${type}`);
            selectedItemsDisplay.innerHTML = ''; // Clear previous items

            selectedItems[type].forEach(item => {
                const itemDiv = createItemDisplay(item, type);
                selectedItemsDisplay.appendChild(itemDiv);

                const hiddenInput = createHiddenInput('s[]', item);
                selectedItemsDisplay.appendChild(hiddenInput);
            });

            toggleShowMoreButton(type);
        }

        function createItemDisplay(item, type) {
            const itemDiv = document.createElement('div');
            itemDiv.classList.add('flex', 'items-center', 'text-dark', 'bg-gray-200', 'px-2', 'py-1', 'rounded-md');
            itemDiv.textContent = item;

            const removeIcon = document.createElement('span');
            removeIcon.textContent = '×';
            removeIcon.classList.add('ml-2', 'text-danger', 'cursor-pointer');
            removeIcon.onclick = () => removeItem(type, item);

            itemDiv.appendChild(removeIcon);
            return itemDiv;
        }

        function createHiddenInput(name, value) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = name;
            hiddenInput.value = value;
            return hiddenInput;
        }

        function createListElement(text, classes) {
            const li = document.createElement('li');
            li.textContent = text;
            li.className = classes;
            return li;
        }

        function toggleShowMoreButton(type) {
            const showMoreBtn = document.getElementById(`show-more-btn-${type}`);
            showMoreBtn.style.display = selectedItems[type].length > 5 ? 'block' : 'none';
        }

        function toggleShowMore(type) {
            const selectedItemsDisplay = document.getElementById(`selected-items-display-${type}`);
            const showMoreBtn = document.getElementById(`show-more-btn-${type}`);

            if (selectedItemsDisplay.style.maxHeight === '100%') {
                selectedItemsDisplay.style.maxHeight = '30px';
                showMoreBtn.textContent = 'Show More';
            } else {
                selectedItemsDisplay.style.maxHeight = '100%';
                showMoreBtn.textContent = 'Show Less';
            }
        }

        function showSuggestions(type) {
            const suggestionsList = document.getElementById(`suggestions-list-${type}`);
            suggestionsList.style.display = suggestionsList.children.length > 0 ? 'block' : 'none';
        }

        function hideSuggestions(type) {
            const suggestionsList = document.getElementById(`suggestions-list-${type}`);
            suggestionsList.style.display = 'none';
        }

        function clearSearchBox(type) {
            const searchBox = document.getElementById(`search-box-${type}`);
            searchBox.value = '';
            document.getElementById(`suggestions-list-${type}`).innerHTML = "";
        }
    </script>
@endpush

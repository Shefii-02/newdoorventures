@push('header')
    <style>
        .home-header-box {
            padding: 5px;
            padding-bottom: 10px;
            border-bottom-right-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        .left-only-rounded {
            border-bottom-left-radius: 33px !important;
            border-top-left-radius: 33px !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .right-only-rounded {
            border-bottom-left-radius: 0 !important;
            border-top-left-radius: 0 !important;
            border-top-right-radius: 33px !important;
            border-bottom-right-radius: 33px !important;
        }

        .offcanvas-end {
            width: 80% !important;
        }

        .offcanvas .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: #000000 !important;
            border: 1px solid #cba641 !important;
            color: #cba641 !important
        }

        .offcanvas li.nav-item span {
            background: transparent;
            border: 1px solid #cba641;
            width: 50px;
            height: 40px;
            border-radius: 50%;
            color: #000000 !important;
        }

        .offcanvas-body #propertyFilterTabs {
            display: flex;
            display: flex;
            flex-wrap: nowrap;
            gap: 10px;
            max-width: 100%;
            overflow-y: hidden;
            overflow-x: auto;
            height: 90px;

        }

        .nav-tabs .nav-link:focus,
        .nav-tabs .nav-link:hover {
            border-color: #cba641 #cba641 #cba641 !important;
            isolation: isolate;
        }

        .offcanvas li.nav-item p {
            font-size: 10px;
            margin-top: 5px;
            font-weight: 700;
        }

        .offcanvas li.nav-item {
            text-align: center;
        }
    </style>
@endpush
@php
    $placeholders = [
        // 'Search: 3 BHK for sale',
        // 'Search: 2 BHK for rent',
        // 'Search: Plot and land',
        // 'Search: PG',
        // 'Search: Farm house',
        // 'Search: Bangalore north',
        // 'Search: Villa',
        'Search: City',
        'Search: Locality',
        'Search: Projects',
    ];

@endphp
<form action="/" id="form-{{ $div }}" >   
<div x-data="{
    placeholders: {{ json_encode($placeholders) }},
    currentIndex: 0,
    init() {
        this.changePlaceholder();
        setInterval(() => {
            this.changePlaceholder();
        }, 2000);
    },
    changePlaceholder() {
        this.$refs.inputElement.placeholder = this.placeholders[this.currentIndex];
        this.currentIndex = (this.currentIndex + 1) % this.placeholders.length;
    }
}">
    
        <div class="d-flex gap-1 items-center">
            <div class="input-group ">
                <span class="input-group-text p-0 m-0 left-only-rounded">
             
                    <select id="typeOption-{{ $div }}" form="form-{{ $div }}"
                        class="form-control left-only-rounded border-1 border-bottom-0 border-top-0 border-left-0"
                        name="type">
                        <option {{ $selected == 'sell' ? 'selected' : '' }} data-action="/sales" value="sale">Buy </option>
                        <option {{ $selected == 'rent' ? 'selected' : ''  }} data-action="/rent" value="rent">Rent </option>
                        <option {{ $selected == 'pg' ? 'selected' : ''  }} data-action="/pg" value="pg">PG</option>
                        <option {{ $selected == 'plot' ? 'selected' : ''  }} data-action="/plot" value="plot">Plot</option>
                        <option {{ $selected == 'projects' ? 'selected' : ''  }} data-action="/projects" value="projects">Projects</option>
                    </select>
                </span>
                <input x-ref="inputElement"  form="form-{{ $div }}" autocomplete="off" type="search" class="form-control  border-0"
                    id="search-box-{{ $div ?? 'default' }}" oninput="fetchSuggestions('{{ $div ?? 'default' }}')"
                    onfocus="showSuggestions('{{ $div ?? 'default' }}')">
                <button data-id="{{ $div }}" class="submit-btn-search input-group-text  border-1 text-white bg-theme right-only-rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
                <i id="loading-icon-{{ $div ?? 'default' }}"
                    class="absolute hidden mdi mdi-loading mdi-spin top-5 right-5"></i>

                <!-- Suggestions List -->
                <div id="suggestions-list-{{ $div ?? 'default' }}"
                    class="absolute z-10 w-full mt-10 bg-dark shadow-md rounded-md dark:bg-slate-900 dark:text-white"
                    style="display:none;">
                    <ul id="suggestions-ul-{{ $div ?? 'default' }}" class="list-none p-0 m-0 max-h-48 overflow-auto">
                    </ul>
                </div>
            </div>
            {{-- <input x-ref="inputElement" style="border-radius: 7px !important;" type="search"
            class="form-control rounded-5" oninput="fetchSuggestions('{{ $div ?? 'default' }}')"
            onfocus="showSuggestions('{{ $div ?? 'default' }}')"> --}}
            <span role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" style="border-radius: 7px !important;"
                class="p-1 text-light border-1 fw-bolder rounded-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-text-center" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                </svg>
            </span>
        </div>
   
</div>
<!-- Display Selected Items -->
<div id="selected-items-container-{{ $div ?? 'default' }}"
    class="relative flex-wrap flex items-center mt-2 gap-2  rounded-md p-2">
    <div id="selected-items-display-{{ $div ?? 'default' }}" class="flex flex-wrap gap-2 overflow-hidden">
        <!-- Dynamically generated selected items will go here -->
    </div>
    <!-- Show More Button -->
    <span role="button" id="show-more-btn-{{ $div ?? 'default' }}" class="text-blue-500 text-sm mt-2 z-9"
        style="display: none" onclick="toggleShowMore('{{ $div ?? 'default' }}')">Show More</span>
</div>
</form>

{{-- @push('header') --}}
{{-- <script>
    var selectedItems = {};

    function fetchSuggestions(type) {
        const searchQuery = document.getElementById(`search-box-${type}`).value;
        const loadingIcon = document.getElementById(`loading-icon-${type}`);
        const suggestionsList = document.getElementById(`suggestions-list-${type}`);
        const suggestionsUl = document.getElementById(`suggestions-ul-${type}`);
        const typeOption = document.getElementById(`typeOption-${type}`).value;
        if (searchQuery.length > 1) {
            loadingIcon.style.display = 'inline-block'; // Show loading icon

            fetch(`/searching-in-keywords?k=${searchQuery}&type=${typeOption}`)
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
                                categoryHeading.classList.add('px-4', 'py-2', 'font-bold', 'text-theme');
                                suggestionsUl.appendChild(categoryHeading);

                                data[category].forEach(item => {
                                    const li = document.createElement('li');
                                    li.textContent = item;
                                    li.classList.add('px-4', 'py-2', 'hover:bg-gray-200',
                                        'text-dark',
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
                        noResults.classList.add('px-4', 'py-2', 'text-center', 'text-dark');
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
        document.getElementById(`suggestions-ul-${type}`).innerHTML = "";
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
            itemDiv.classList.add('flex', 'items-center', 'border-1', 'px-2', 'py-1', 'rounded-md');
            itemDiv.textContent = item;

            const removeIcon = document.createElement('span');
            removeIcon.textContent = '×';
            removeIcon.classList.add('ms-2', 'text-red-500', 'cursor-pointer');
            removeIcon.onclick = () => removeItem(type, item);

            itemDiv.appendChild(removeIcon);
            selectedItemsDisplay.appendChild(itemDiv);

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 's[]';
            hiddenInput.value = item;
            hiddenInput.form  = 'form-'+type;

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
{{-- @endpush --}}

@push('footer')
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
            itemDiv.classList.add('flex', 'items-center','text-dark', 'bg-gray-200', 'px-2', 'py-1', 'rounded-md');
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
            document.getElementById(`suggestions-list-${type}`).innerHTML="";
        }
    </script>
@endpush

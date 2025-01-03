@php
    // $places = $dropDownLocation->pluck('name');
    // $placeholders = [];

    // foreach ($places as $key => $value) {
    //     $placeholders[] = 'Searching Property for "' . $value.'"';
    // }

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
{{-- <div x-data="{
    placeholders: {{ json_encode($placeholders) }},
    currentIndex: 0,
    init() {
        this.changePlaceholder();
        setInterval(() => {
            this.changePlaceholder();
        }, 3000);
    },
    changePlaceholder() {
        this.$refs.inputElement.placeholder = this.placeholders[this.currentIndex];
        this.currentIndex = (this.currentIndex + 1) % this.placeholders.length;
    }
}"> --}}
{{-- <label class="form-label" for="keyword-{{ $type }}" class="font-medium form-label text-slate-900 dark:text-white">{{ __('Keyword:') }}</label> --}}
{{-- <div class="relative mt-2 filter-search-form filter-border">
        <i class="mdi mdi-magnify icons"></i>
        <input name="k" x-ref="inputElement" type="search" id="keyword-{{ $type }}"
            class="border-0 form-input filter-input-box bg-gray-50 dark:bg-slate-800 keyword-search" autocomplete="off"
            placeholder="{{ __('Search your ' . ucfirst('projects') . ' or Area') }}"
            value="{{ stringify(request()->query('k')) }}">
        <i class="absolute hidden mdi mdi-loading mdi-spin top-5 end-5"></i>  

    </div>
  
</div> --}}
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
    <!-- Search Box -->
    <div class="relative mt-2 filter-search-form filter-border">
        <i class="mdi mdi-magnify icons"></i>
        <input x-ref="inputElement"  id="search-box-{{ $type ?? 'default' }}" type="search"
            class="border-0 form-input filter-input-box bg-gray-50 dark:bg-slate-800 pl-10" autocomplete="off"
            placeholder="Search for Projects, Areas, etc." oninput="fetchSuggestions('{{ $type ?? 'default' }}')" onfocus="showSuggestions('{{ $type ?? 'default' }}')">
        <i id="loading-icon-{{ $type ?? 'default' }}" class="absolute hidden mdi mdi-loading mdi-spin top-5 right-5"></i>

        <!-- Suggestions List -->
        <div id="suggestions-list-{{ $type ?? 'default' }}"
            class="absolute z-10 w-full mt-1 bg-white shadow-md rounded-md dark:bg-slate-900 dark:text-white"
            style="display:none;">
            <ul id="suggestions-ul-{{ $type ?? 'default' }}" class="list-none p-0 m-0 max-h-48 overflow-auto"></ul>
        </div>
    </div>

    <!-- Display Selected Items -->
    <div id="selected-items-container-{{ $type ?? 'default' }}"
        class="relative flex-wrap flex items-center mt-2 gap-2 bg-white rounded-md p-2">
        <div id="selected-items-display-{{ $type ?? 'default' }}" class="flex flex-wrap gap-2 overflow-hidden">
            <!-- Dynamically generated selected items will go here -->
        </div>
        <!-- Show More Button -->
        <span role="button" id="show-more-btn-{{ $type ?? 'default' }}" class="text-blue-500 text-sm mt-2 z-9" style="display: none"
            onclick="toggleShowMore('{{ $type ?? 'default' }}')">Show More</span>
    </div>
</div>

@push('footer')
<script>
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
</script>
@endpush


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
            background-color: transparent !important;
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
        .offcanvas-body #propertyFilterTabs{
            display: flex;
            display: flex;
            flex-wrap: nowrap;
            gap: 10px;
            max-width: 100%;
            overflow-y: hidden;
            overflow-x: auto;
            height: 90px;

        }

        .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
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
                <select id="typeOption"
                    class="form-control left-only-rounded border-1 border-bottom-0 border-top-0 border-left-0"
                    name="type">
                    <option data-action="/sales" value="sale">Buy</option>
                    <option data-action="/rent" value="rent">Rent</option>
                    <option data-action="/pg" value="pg">PG</option>
                    <option data-action="/projects" value="">Projects</option>
                </select>
            </span>
            <input x-ref="inputElement" autocomplete="off" type="search" class="form-control  border-0"
                id="search-box-{{ $type ?? 'default' }}" oninput="fetchSuggestions('{{ $type ?? 'default' }}')"
                onfocus="showSuggestions('{{ $type ?? 'default' }}')">
            <span class="input-group-text  border-0 bg-white right-only-rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
            </span>
            <i id="loading-icon-{{ $type ?? 'default' }}"
                class="absolute hidden mdi mdi-loading mdi-spin top-5 right-5"></i>

            <!-- Suggestions List -->
            <div id="suggestions-list-{{ $type ?? 'default' }}"
                class="absolute z-10 w-full mt-10 bg-white shadow-md rounded-md dark:bg-slate-900 dark:text-white"
                style="display:none;">
                <ul id="suggestions-ul-{{ $type ?? 'default' }}" class="list-none p-0 m-0 max-h-48 overflow-auto"></ul>
            </div>
        </div>
        {{-- <input x-ref="inputElement" style="border-radius: 7px !important;" type="search"
            class="form-control rounded-5" oninput="fetchSuggestions('{{ $type ?? 'default' }}')"
            onfocus="showSuggestions('{{ $type ?? 'default' }}')"> --}}
        <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" style="border-radius: 7px !important;"
            class="p-1 text-light border-1 fw-bolder rounded-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                class="bi bi-text-center" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
            </svg>
        </button>
    </div>
</div>
<!-- Display Selected Items -->
<div id="selected-items-container-{{ $type ?? 'default' }}"
    class="relative flex-wrap flex items-center mt-2 gap-2  rounded-md p-2">
    <div id="selected-items-display-{{ $type ?? 'default' }}" class="flex flex-wrap gap-2 overflow-hidden">
        <!-- Dynamically generated selected items will go here -->
    </div>
    <!-- Show More Button -->
    <span role="button" id="show-more-btn-{{ $type ?? 'default' }}" class="text-blue-500 text-sm mt-2 z-9"
        style="display: none" onclick="toggleShowMore('{{ $type ?? 'default' }}')">Show More</span>
</div>

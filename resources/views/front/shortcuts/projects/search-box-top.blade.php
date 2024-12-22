<form x-data="projectFilters()" x-init="initFilters()" class="search-filter">
    <div class="py-lg-5 py-sm-0">
        <div class="row align-items-center">
            <!-- Property Type Dropdown -->
            <div class="col-lg-4 mb-4 px-1">
                <div>
                    <div class="flex items-center space-x-3">
                        {{-- <select x-model="filters.type" @change="updateVisibility(); applyFilters()"
                            class="border-theme px-3 py-2 rounded-s-2xl">
                            <option value="null">Properties</option>
                            <option {{ isset($type) && $type == 'sell' ? 'selected' : '' }} value="sell">Sale</option>
                            <option {{ isset($type) && $type == 'rent' ? 'selected' : '' }} value="rent">Rent</option>
                            <option value="pg">PG</option>
                            <option value="plot">Plot</option>
                            <option value="projects">Projects</option>
                        </select> --}}
                        <select x-model="filters.type" @change="updateVisibility(); applyFilters()"
                            class="border-theme px-3 py-2 rounded-s-2xl text-black">
                            <option value="projects">Projects</option>
                            <optgroup label="Residential" class="text-dark">
                                <option value="null">All Residential</option>
                                <option {{ isset($type) && $type == 'sell' ? 'selected' : '' }} value="sell">Sale
                                </option>
                                <option {{ isset($type) && $type == 'rent' ? 'selected' : '' }} value="rent">Rent
                                </option>
                                <option value="pg">PG</option>
                                <option value="plot">Plot</option>
                            </optgroup>
                            <optgroup label="Commercial" class="text-dark">
                                <option value="all-commercial">All Commercial</option>
                                <option value="commercial-sale">Sale</option>
                                <option value="commercial-rent">Rent</option>
                            </optgroup>
                         
                        </select>
                        <input type="text" x-model="filters.k" @input="applyFilters()"
                            class="border-theme px-3 py-1.5 w-full rounded-e-2xl text-black" placeholder="Search for properties">
                    </div>
                </div>
            </div>

            <!-- City Dropdown -->
            <div class="col-lg-2 mb-4 px-1">
                <select x-model="filters.city" @change="applyFilters()"
                    class="w-full border-theme px-3 py-2 rounded-2xl text-black">
                    <option value="null" selected>Locality</option>
                    <template x-for="city in cities" :key="city">
                        <option :value="city" x-text="city"></option>
                    </template>
                </select>
            </div>

            <!-- Other Filters -->
            <div class="col-lg-6 p-0 mb-3 filter-parent">
                <div class="relative gap-1 flex align-items-center flex-wrap filter-options">
                    <!-- Categories -->
                    <template x-if="showFilters.categories">
                        <div class="relative mb-2">
                            <button type="button" @click="toggleDropdown('categories')"
                                class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                                Categories<i
                                    :class="openDropdown === 'categories' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                            </button>
                            <div x-show="openDropdown === 'categories'" x-transition
                                class="dropdown-box filter-web-dropdown">
                                <div class="option-sections">
                                    <ul class="ks-cboxtags p-0">
                                        <template x-for="category in categories" :key="category.id">
                                            <li>
                                                <input type="checkbox" :id="'category' + category.id"
                                                    :value="category.id"
                                                    @change="toggleArrayFilter('categories', category.id)">
                                                <label :for="'category' + category.id" x-text="category.name"></label>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </template>


                    <!-- Budget -->
                    <template x-if="showFilters.budget">
                        <div class="relative mb-2">
                            <button type="button" @click="toggleDropdown('budget')"
                                class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                                Budget<i
                                    :class="openDropdown === 'budget' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                            </button>
                            <div x-show="openDropdown === 'budget'" x-transition
                                class="dropdown-box filter-web-dropdown">
                                <div class="option-sections">
                                    @include('front.shortcuts.filters.price-range-new', [
                                        'min' => 0,
                                        'max' => 500000000,
                                        'step' => 500000,
                                        'single_page' => true,
                                    ])
                                </div>
                            </div>
                        </div>
                    </template>


                    <!-- Builders Filter -->
                    <div class="relative mb-2">
                        <button type="button" @click="toggleDropdown('builder')"
                            class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                            Builder
                            <i :class="openDropdown === 'builder' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'builder'" x-transition class="dropdown-box filter-web-dropdown">
                            <div class="option-sections">
                                <ul class="ks-cboxtags p-0">
                                    @foreach ($builders as $builder)
                                        <li><input type="checkbox" value="freehold" id="builder_{{ $builder->id }}"
                                                @change="toggleArrayFilter('builder', $builder->name)">
                                            <label for="builder_{{ $builder->id }}"> {{ $builder->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>



                    <!-- Constriction Statis Filter -->
                    <div class="relative mb-2">
                        <button type="button" @click="toggleDropdown('construction')"
                            class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                            Constriction Status
                            <i
                                :class="openDropdown === 'construction' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'construction'" x-transition
                            class="dropdown-box filter-web-dropdown">
                            <div class="option-sections">
                                <ul class="ks-cboxtags p-0">
                                    <li><input type="checkbox" value="freehold" id="new_laucnh"
                                            @change="toggleArrayFilter('construction', 'new_laucnh')">
                                        <label for="new_laucnh"> New Launch
                                        </label>
                                    </li>
                                    <li><input type="checkbox" value="co-operative_society" id="under_construction"
                                            @change="toggleArrayFilter('construction', 'under_construction')">
                                        <label for="under_construction"> Under Construction
                                        </label>
                                    </li>
                                    <li><input type="checkbox" value="power_of_attorney" id="ready_to_move"
                                            @change="toggleArrayFilter('construction', 'ready_to_move')">
                                        <label for="ready_to_move">Ready to move</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</form>


@push('footer')
    <script>
        function projectFilters() {
            return {
                filters: {
                    k: '',
                    city: 'null',
                    categories: [],
                    min_price: null,
                    max_price: null,
                    bedrooms: [],
                    ownership: [],
                    furnishing: [],
                    // builders: [],
                    type: null,
                    purpose: []
                },
                cities: @json($cities),
                categories: @json($categories),
                builders: @json($builders),
                openDropdown: '',
                showFilters: {
                    categories: true,
                    purpose: false,
                    bedrooms: false,
                    budget: true,
                    ownership: true,
                },

                // Initialize filters
                initFilters() {
                    // Parse the URL parameters and update the filters object
                    const urlParams = new URLSearchParams(window.location.search);

                    // Populate the filters from the URL parameters
                    this.filters.k = urlParams.get('k') || '';
                    this.filters.city = urlParams.get('city') || 'null';
                    this.filters.type = `{{ isset($type) ? $type : '' }}`;
                    this.filters.purpose = this.getArrayFromUrlParam(urlParams, 'purpose');
                    this.filters.bedrooms = this.getArrayFromUrlParam(urlParams, 'bedrooms');
                    this.filters.ownership = this.getArrayFromUrlParam(urlParams, 'ownership');
                    this.filters.furnishing = this.getArrayFromUrlParam(urlParams, 'furnishing');
                    this.filters.categories = this.getArrayFromUrlParam(urlParams, 'categories');

                    this.filters.min_price = urlParams.get('min_price') || null;
                    this.filters.max_price = urlParams.get('max_price') || null;
                    this.checkFilterState();
                    this.updateVisibility();
                    this.applyFilters();
                },

                updateVisibility() {
                    const type = this.filters.type;

                    // this.showFilters.categories = ['pg', 'sell', 'rent', 'plot',''].includes(type);
                    this.showFilters.purpose = ['sell', 'rent', 'plot'].includes(type);
                    this.showFilters.bedrooms = ['sell', 'rent'].includes(type);
                    this.showFilters.occupancy = ['pg'].includes(type);
                    this.showFilters.availability = ['pg'].includes(type);
                },

                getArrayFromUrlParam(urlParams, param) {
                    const paramValue = urlParams.get(param);
                    return paramValue ? paramValue.split(',').map(value => value.trim()) : [];
                },

                // Check if filters should be checked based on URL params
                checkFilterState() {
                    // Check Categories

                    this.categories.forEach(category => {

                        if (this.filters.categories.includes(String(category.id))) {
                            this.$nextTick(() => {
                                const categoryCheckbox = document.getElementById('category' + category.id);
                                console.log(categoryCheckbox.checked)
                                if (categoryCheckbox) categoryCheckbox.checked = true;
                            });
                        }
                    });

                    // Check Bedrooms
                    this.filters.bedrooms.forEach(bedroom => {
                        this.$nextTick(() => {
                            const bedroomCheckbox = document.getElementById('bedroom' + bedroom + '_buy');
                            console.log(bedroomCheckbox.checked)
                            if (bedroomCheckbox) bedroomCheckbox.checked = true;
                        });
                    });


                },

                // Toggle dropdown
                toggleDropdown(name) {
                    this.openDropdown = this.openDropdown === name ? '' : name;
                },

                // Toggle array-based filter (e.g., categories, bedrooms, ownership)
                toggleArrayFilter(filterName, value) {
                    const filterArray = this.filters[filterName];
                    if (filterArray.includes(value)) {
                        this.filters[filterName] = filterArray.filter((item) => item !== value);
                    } else {
                        this.filters[filterName].push(value);
                    }
                    this.applyFilters();
                },

                // Apply filters with AJAX
                applyFilters() {
                    if (this.filters.type == 'projects') {

                    } else if (this.filters.type == 'sell' && `{{ isset($type) && $type != 'sell' }}`) {
                        window.location.href = "{{ route('public.properties.sale') }}";
                        return;
                    } else if (this.filters.type == 'rent' && `{{ isset($type) && $type != 'rent' }}`) {
                        window.location.href = "{{ route('public.properties.rent') }}";
                        return;
                    } else if (this.filters.type == 'pg') {
                        window.location.href = "{{ route('public.properties.pg') }}";
                        return;
                    } else if (this.filters.type == 'plot') {
                        window.location.href = "{{ route('public.properties.plot') }}";
                        return;
                    }

                    document.body.scrollTop = 0, document.documentElement.scrollTop = 0
                    const params = new URLSearchParams(this.filters).toString();
                    var url = `{{ route('public.projects') }}?${params}`;
                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            // window.history.pushState({}, '', url);
                            document.getElementById('items-list').innerHTML = data.html;
                        })
                        .catch((error) => console.error('Error:', error));
                },
            };
        }
    </script>
@endpush

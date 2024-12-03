
<form x-data="projectFilters()" x-init="initFilters()" class="search-filter">
    <div class="py-2">
        <div class="row align-items-center">
            <!-- Property Type Dropdown -->
            <div class="col-lg-4 mb-4 px-1">
                <div>
                    <div class="flex items-center space-x-3">
                        <select x-model="filters.type" @change="updateVisibility(); applyFilters()"
                            class="border-theme px-3 py-2 rounded-s-2xl">
                            <option value="null" selected>Projects</option>
                            <option value="sell">Sell</option>
                            <option value="rent">Rent</option>
                            <option value="pg">PG</option>
                            <option value="plot">Plot</option>
                        </select>
                        <input type="text" x-model="filters.k" @input="applyFilters()"
                            class="border-theme px-3 py-1.5 w-full rounded-e-2xl" placeholder="Search for properties">
                    </div>
                </div>
            </div>

            <!-- City Dropdown -->
            <div class="col-lg-2 mb-4 px-1">
                <select x-model="filters.city" @change="applyFilters()"
                    class="w-full border-theme px-3 py-2 rounded-2xl">
                    <option value="null" selected>Locality</option>
                    <template x-for="city in cities" :key="city">
                        <option :value="city" x-text="city"></option>
                    </template>
                </select>
            </div>

            <!-- Other Filters -->
            <div class="col-lg-6 p-0 mb-3">
                <div class="relative gap-1 flex align-items-center">
                    <!-- Categories -->
                    <template>
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

                    <!-- Purpose -->
                    <template>
                        <div class="relative mb-2">
                            <button type="button" @click="toggleDropdown('purpose')"
                                class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                                Purpose<i
                                    :class="openDropdown === 'purpose' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                            </button>
                            <div x-show="openDropdown === 'purpose'" x-transition
                                class="dropdown-box filter-web-dropdown">
                                <div class="option-sections">
                                    <ul class="ks-cboxtags p-0">
                                        <li>
                                            <input type="checkbox" value="residential" id="purpose_residential"
                                                @change="toggleArrayFilter('purpose', 'residential')">
                                            <label for="purpose_residential">Residential</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="commercial" id="purpose_commercial"
                                                @change="toggleArrayFilter('purpose', 'commercial')">
                                            <label for="purpose_commercial">Commercial</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Budget -->

                    <div class="relative mb-2">
                        <button type="button" @click="toggleDropdown('budget')"
                            class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                            Budget<i
                                :class="openDropdown === 'budget' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'budget'" x-transition class="dropdown-box filter-web-dropdown">
                            <div class="option-sections">
                                @include('front.shortcuts.filters.price-range-new', [
                                    'min' => 0,
                                    'max' => 500000000,
                                    'step' => 500000,
                                ])
                            </div>
                        </div>
                    </div>

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

                    <!-- Constriction Statis Filter -->
                    <div class="relative mb-2">
                        <button type="button" @click="toggleDropdown('rera')"
                            class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                            Rera Status
                            <i
                                :class="openDropdown === 'rera' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'rera'" x-transition class="dropdown-box filter-web-dropdown">
                            <div class="option-sections">
                                <ul class="ks-cboxtags p-0">
                                    <li><input type="checkbox" value="registred" id="registered"
                                            @change="toggleArrayFilter('rera', 'registered')">
                                        <label for="registered"> Registered
                                        </label>
                                    </li>
                                    <li><input type="checkbox" value="unregistered" id="unregistered"
                                            @change="toggleArrayFilter('rera', 'unregistered')">
                                        <label for="unregistered"> Non Registered
                                        </label>
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
                    rera: [],
                    furnishing: [],
                    builders: [],
                    type: null,
                    construction: []
                },
                cities: @json($cities),
                categories: @json($categories),
                builders: @json($builders),
                openDropdown: '',


                // Initialize filters
                initFilters() {
                    // Parse the URL parameters and update the filters object
                    const urlParams = new URLSearchParams(window.location.search);

                    // Populate the filters from the URL parameters
                    this.filters.k = urlParams.get('k') || '';
                    this.filters.city = urlParams.get('city') || 'null';
                    this.filters.type = urlParams.get('type') || null;
                    this.filters.purpose = this.getArrayFromUrlParam(urlParams, 'purpose');
                    this.filters.bedrooms = this.getArrayFromUrlParam(urlParams, 'bedrooms');
                    this.filters.builders = this.getArrayFromUrlParam(urlParams, 'builders');
                    this.filters.furnishing = this.getArrayFromUrlParam(urlParams, 'furnishing');
                    this.filters.categories = this.getArrayFromUrlParam(urlParams, 'categories');

                    this.filters.min_price = urlParams.get('min_price') || null;
                    this.filters.max_price = urlParams.get('max_price') || null;
                    this.checkFilterState();

                    this.applyFilters();
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

                                if (categoryCheckbox) categoryCheckbox.checked = true;
                            });
                        }
                    });

                    // Check Bedrooms
                    this.filters.bedrooms.forEach(bedroom => {
                        this.$nextTick(() => {
                            const bedroomCheckbox = document.getElementById('bedroom' + bedroom + '_buy');

                            if (bedroomCheckbox) bedroomCheckbox.checked = true;
                        });
                    });

                    // Check builders
                    this.filters.builders.forEach(builder => {
                        this.$nextTick(() => {
                            const builderCheckbox = document.getElementById('builder_' + builder);
                            if (builderCheckbox) builderCheckbox.checked = true;
                        });
                    });

                    // Check Furnishing
                    this.filters.furnishing.forEach(furnish => {
                        this.$nextTick(() => {
                            const furnishingCheckbox = document.getElementById(furnish.toLowerCase());
                            if (furnishingCheckbox) furnishingCheckbox.checked = true;
                        });
                    });

                    // Check Purpose
                    this.filters.purpose.forEach(purpose => {
                        this.$nextTick(() => {
                            const purposeCheckbox = document.getElementById('purpose_' + purpose);
                            if (purposeCheckbox) purposeCheckbox.checked = true;
                        });
                    });
                },

                // Toggle dropdown
                toggleDropdown(name) {
                    this.openDropdown = this.openDropdown === name ? '' : name;
                },

                // Toggle array-based filter (e.g., categories, bedrooms, builders)
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
                    if (this.filters.type) {
                        window.location.href = `{{ route('public.properties', ['type' => '${this.filters.type}']) }}`;
                        return;
                    }

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

<form x-data="propertyFilters()" x-init="initFilters()" class="search-filter">
    <div class="py-5">
        <div class="row align-items-center">
            <!-- Property Type Dropdown -->
            <div class="col-lg-4 mb-4 px-1">
                <div>
                    <div class="flex items-center space-x-3">
                        <select x-model="filters.type" @change="updateVisibility(); applyFilters()"
                            class="border-theme px-3 py-2 rounded-s-2xl">
                            <option value="null" selected>Properties</option>
                            <option value="sell">Sell</option>
                            <option value="rent">Rent</option>
                            <option value="pg">PG</option>
                            <option value="plot">Plot</option>
                            <option value="projects">Projects</option>
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

                    <!-- Purpose -->
                    <template x-if="showFilters.purpose">
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
                                    ])
                                </div>
                            </div>
                        </div>
                    </template>


                    <!-- Bedrooms -->
                    <template x-if="showFilters.bedrooms">
                        <div class="relative mb-2">
                            <button type="button" @click="toggleDropdown('bedrooms')"
                                class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                                Bedrooms<i
                                    :class="openDropdown === 'bedrooms' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                            </button>
                            <div x-show="openDropdown === 'bedrooms'" x-transition
                                class="dropdown-box filter-web-dropdown">
                                <div class="option-sections">
                                    <ul class="ks-cboxtags p-0">
                                        <li>
                                            <input type="checkbox" value="1" id="bedroom1_buy"
                                                @change="toggleArrayFilter('bedrooms', 1)">
                                            <label for="bedroom1_buy">1 Bedroom</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="2" id="bedroom2_buy"
                                                @change="toggleArrayFilter('bedrooms', 2)">
                                            <label for="bedroom2_buy">2 Bedrooms</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="3" id="bedroom3_buy"
                                                @change="toggleArrayFilter('bedrooms', 3)">
                                            <label for="bedroom3_buy">3 Bedrooms</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="4" id="bedroom4_buy"
                                                @change="toggleArrayFilter('bedrooms', 4)">
                                            <label for="bedroom4_buy">4+ Bedrooms</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template x-if="showFilters.ownership">
                        <!-- Ownership Filter -->
                        <div class="relative mb-2">
                            <button type="button" @click="toggleDropdown('ownership')"
                                class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                                Ownership
                                <i
                                    :class="openDropdown === 'ownership' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                            </button>
                            <div x-show="openDropdown === 'ownership'" x-transition
                                class="dropdown-box filter-web-dropdown">
                                <div class="option-sections">
                                    <ul class="ks-cboxtags p-0">
                                        <li><input type="checkbox" value="freehold" id="ownership_1"
                                                @change="toggleArrayFilter('ownership', 'freehold')">
                                            <label for="ownership_1"> Freehold
                                            </label>
                                        </li>
                                        <li><input type="checkbox" value="co-operative_society" id="ownership_2"
                                                @change="toggleArrayFilter('ownership', 'co-operative_society')">
                                            <label for="ownership_2"> Co-operative Society
                                            </label>
                                        </li>
                                        <li><input type="checkbox" value="power_of_attorney" id="ownership_3"
                                                @change="toggleArrayFilter('ownership', 'power_of_attorney')">
                                            <label for="ownership_3">Power of Attorney</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </template>
                    <template x-if="showFilters.occupancy">
                        <div class="relative mb-2">
                            <button type="button" @click="toggleDropdown('occupancy')"
                                class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                                Occupancy
                                <i
                                    :class="openDropdown === 'occupancy' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                            </button>
                            <div x-show="openDropdown === 'occupancy'" x-transition
                                class="dropdown-box filter-web-dropdown">
                                <div class="option-sections">
                                    <ul class="ks-cboxtags p-0">
                                        <li>
                                            <input type="checkbox" value="Furnished" id="furnished"
                                                @change="toggleArrayFilter('occupancy', 'Furnished')">
                                            <label for="furnished"> Single
                                            </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Semi-Furnished" id="semi_furnished"
                                                @change="toggleArrayFilter('occupancy', 'Semi-Furnished')">
                                            <label for="semi_furnished"> Double
                                            </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Unfurnished" id="unfurnished"
                                                @change="toggleArrayFilter('occupancy', 'Unfurnished')">
                                            <label for="unfurnished"> Other
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template x-if="showFilters.availability">
                        <div class="relative mb-2">
                            <button type="button" @click="toggleDropdown('available_for')"
                                class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                                Availability
                                <i
                                    :class="openDropdown === 'available_for' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                            </button>
                            <div x-show="openDropdown === 'available_for'" x-transition
                                class="dropdown-box filter-web-dropdown">
                                <div class="option-sections">
                                    <ul class="ks-cboxtags p-0">

                                        <li>
                                            <input type="checkbox" value="boys" id="boys"
                                                @change="toggleArrayFilter('availability', 'boys')">
                                            <label for="boys"> Boys
                                            </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="girls" id="girls"
                                                @change="toggleArrayFilter('availability', 'girls')">
                                            <label for="girls"> Girls
                                            </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="boys-girls" id="boys-girls"
                                                @change="toggleArrayFilter('availability', 'boys-girls')">
                                            <label for="boys-girls">Boys and Girls
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </template>
                </div>
            </div>
        </div>
    </div>
</form>


@push('footer')
    <script>
        function propertyFilters() {
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
                    this.filters.type = urlParams.get('type') || null;
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
                        console.log(this.filters.categories, category.id)
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

                    // Check Ownership
                    this.filters.ownership.forEach(ownership => {
                        this.$nextTick(() => {
                            const ownershipCheckbox = document.getElementById('ownership_' + ownership);
                            if (ownershipCheckbox) ownershipCheckbox.checked = true;
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
                        window.location.href = "{{ route('public.projects') }}";
                        return;
                    }
                    const params = new URLSearchParams(this.filters).toString();
                    var url = `{{ route('public.properties') }}?${params}`;
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

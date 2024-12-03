<form action="{{ $actionUrl ?? RealEstateHelper::getPropertiesListPageUrl() }}" class="search-filter"
    data-ajax-url="{{ $ajaxUrl ?? route('public.properties') }}">

    <div class="py-5" x-data="propertyFilters()" x-init="initFilters()" >
        <div class="row align-items-center">
            <div class="col-lg-3 mb-4">
                <input type="text" name="k" x-model="filters.keyword"  @input="applyFilters()"  class="border-theme px-3 py-1.5 w-full rounded-2xl"
                    placeholder="Search for properties">
            </div>
            <div class="col-lg-2 mb-4">
                <select name="city"  x-model="filters.city"  @change="applyFilters()"  class=" w-full border-theme px-3 py-2 rounded-2xl">
                    <option value="null" selected>Choose a city</option>
                    <option value="null" selected>Choose a city</option>
                    <template x-for="city in cities" :key="city">
                        <option :value="city" x-text="city"></option>
                    </template>
                </select>
            </div>

            <div class="col-lg-7 p-0 mb-3">
                <div class="relative gap-1 flex  align-items-center" x-data="{ openDropdown: '' }">

                    <div class="relative mb-2">
                        <button type="button" @click="openDropdown = openDropdown === 'categories' ? '' : 'categories'"
                            :class="{ 'active': openDropdown === 'categories' }"
                            class="flex filter-button border-theme py-1 rounded-2xl px-1.5">
                            Categories
                            <i
                                :class="openDropdown === 'categories' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'categories'" style="display: none" x-transition
                            class="dropdown-box filter-web-dropdown">
                            <div class="option-sections">
                                <ul class="ks-cboxtags p-0">
                                    @foreach ($categories as $category)
                                        <li><input type="checkbox" name="category[]" id="category{{ $category->id }}"
                                                value="{{ $category->name }}">
                                            <label for="category{{ $category->id }}"> {{ $category->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="relative mb-2">
                        <button type="button" @click="openDropdown = openDropdown === 'budget' ? '' : 'budget'"
                            :class="{ 'active': openDropdown === 'budget' }"
                            class="flex filter-button border-theme py-1 rounded-2xl px-1.5">
                            Budget
                            <i :class="openDropdown === 'budget' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'budget'" style="display: none" x-transition
                            class="dropdown-box filter-web-dropdown">
                            <div class="option-sections">
                                {!! Theme::partial('filters.price-range-new', ['min' => 0, 'max' => 500000000, 'step' => 500000]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="relative mb-2">
                        <button type="button" @click="openDropdown = openDropdown === 'unitType' ? '' : 'unitType'"
                            :class="{ 'active': openDropdown === 'unitType' }"
                            class="flex filter-button border-theme py-1 rounded-2xl px-1.5">
                            Unit
                            <i :class="openDropdown === 'unitType' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'unitType'" style="display: none" x-transition
                            class="dropdown-box filter-web-dropdown">
                            <div class="option-sections">
                                <ul class="ks-cboxtags p-0">
                                    <li><input type="checkbox" name="bedrooms[]" id="bedroom1_buy" value="1">
                                        <label for="bedroom1_buy"> 1 bedroom
                                        </label>
                                    </li>
                                    <li><input type="checkbox" name="bedrooms[]" id="bedroom2_buy" value="2">
                                        <label for="bedroom2_buy"> 2 bedrooms
                                        </label>
                                    </li>
                                    <li><input type="checkbox" name="bedrooms[]" id="bedroom3_buy" value="3">
                                        <label for="bedroom3_buy"> 3 bedrooms
                                        </label>
                                    </li>
                                    <li><input type="checkbox" name="bedrooms[]" id="bedroom4_buy" value="4">
                                        <label for="bedroom4_buy"> 4+ bedrooms
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="relative mb-2">
                        <button type="button" @click="openDropdown = openDropdown === 'ownership' ? '' : 'ownership'"
                            :class="{ 'active': openDropdown === 'ownership' }"
                            class="flex filter-button border-theme py-1 rounded-2xl px-1.5">
                            Ownership
                            <i
                                :class="openDropdown === 'ownership' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'ownership'" style="display: none" x-transition
                            class="dropdown-box filter-web-dropdown">
                            <div class="option-sections">
                                <ul class="ks-cboxtags p-0">
                                    <li><input type="checkbox" name="ownership[]" id="ownership_1" value="Freehold">
                                        <label for="ownership_1"> Freehold
                                        </label>
                                    </li>
                                    <li><input type="checkbox" name="ownership[]" id="ownership_2"
                                            value="co-operative_society">
                                        <label for="ownership_2"> Co-operative Society
                                        </label>
                                    </li>
                                    <li><input type="checkbox" name="ownership[]" id="ownership_3"
                                            value="power_of_attorney">
                                        <label for="ownership_3">Power of Attorney
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="relative mb-2">
                        <button type="button"
                            @click="openDropdown = openDropdown === 'furnishing' ? '' : 'furnishing'"
                            :class="{ 'active': openDropdown === 'furnishing' }"
                            class="filter-button border-theme py-1 rounded-2xl px-1.5">
                            Furnishing
                            <i
                                :class="openDropdown === 'furnishing' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'furnishing'" style="display: none" x-transition
                            class="dropdown-box filter-web-dropdown">
                            <div class="option-sections">
                                <ul class="ks-cboxtags p-0">
                                    <li><input type="checkbox" name="ownership[]" id="furnished" value="furnished">
                                        <label for="furnished"> Furnished
                                        </label>
                                    </li>
                                    <li><input type="checkbox" name="ownership[]" id="semi_furnished"
                                            value="semi-furnished">
                                        <label for="semi_furnished"> Semi-Furnished
                                        </label>
                                    </li>
                                    <li><input type="checkbox" name="ownership[]" id="unfurnished"
                                            value="unfurnished">
                                        <label for="unfurnished">Unfurnished
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="relative mb-2">
                        <select name="city" class=" w-3/4 border-theme px-3 py-2 rounded-2xl">
                            <option value="null" selected>Choose a builders</option>
                            @foreach ($builders as $b_itm)
                                <option value="{{ $b_itm->name }}">{{ $b_itm->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
                    keyword: '',
                    city: 'null',
                    categories: [],
                    min_price: null,
                    max_price: null,
                    bedrooms: [],
                },
                cities: @json($cities), // Pass cities from the backend
                categories: @json($categories), // Pass categories from the backend

                // Initialize filters
                initFilters() {
                    this.applyFilters();
                },

                // Add/remove categories from filters
                toggleCategory(categoryId) {
                    if (this.filters.categories.includes(categoryId)) {
                        this.filters.categories = this.filters.categories.filter((id) => id !== categoryId);
                    } else {
                        this.filters.categories.push(categoryId);
                    }
                    this.applyFilters();
                },

                // Add/remove bedrooms from filters
                toggleBedroom(bedroom) {
                    if (this.filters.bedrooms.includes(bedroom)) {
                        this.filters.bedrooms = this.filters.bedrooms.filter((b) => b !== bedroom);
                    } else {
                        this.filters.bedrooms.push(bedroom);
                    }
                    this.applyFilters();
                },

                // Apply filters with AJAX call
                applyFilters() {
                    const params = new URLSearchParams(this.filters).toString();

                    fetch(`{{ route('public.properties') }}?${params}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            document.getElementById('items-list').innerHTML = data.html;
                        })
                        .catch((error) => console.error('Error:', error));
                },
            };
        }
    </script>
@endpush

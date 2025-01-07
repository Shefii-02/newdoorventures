<form x-data="propertyFilters()" x-init="initFilters()" target="_blank" class="search-filter">
    <div class="py-5">


        <div class="row align-items-center">
            <!-- Property Type Dropdown -->
            <div class="col-lg-4 mb-4 px-1">
                <div class="position-relative">
                    <div class="flex items-center space-x-3">
                        <select name="type" id="type" @change="applyFilters()"
                            class="border-theme px-3 py-2 rounded-s-2xl text-black">
                            <optgroup label="Commercial" class="text-dark">
                                <option value="null">All Commercial</option>
                                <option {{ request()->get('tab') == 'sale' ? 'selected' : '' }} value="commercial-sale">
                                    Sale</option>
                                <option {{ request()->get('tab') == 'rent' ? 'selected' : '' }} value="commercial-rent">
                                    Rent</option>
                            </optgroup>
                            <optgroup label="Residential" class="text-dark">

                                <option value="all-residential">All Residential</option>
                                <option value="sell">Sale
                                </option>
                                <option value="rent">Rent
                                </option>
                                <option value="pg">PG</option>
                                <option value="plot">Plot</option>
                            </optgroup>

                            <option value="projects">Projects</option>
                        </select>
                        <input type="text" name="k" id="search-box-{{ $type }}"
                            oninput="fetchSuggestions('{{ $type ?? 'default' }}')"
                            onfocus="showSuggestions('{{ $type ?? 'default' }}')"
                            class="border-theme px-3 py-1.5 w-full  text-black" placeholder="Search for properties">
                        <i id="loading-icon-{{ $type ?? 'default' }}"
                            class="absolute hidden mdi mdi-loading mdi-spin top-5 right-5"></i>
                        <button
                            class="bi bi-search rounded-e-2xl bg-theme-light border-theme  px-3 py-1.5 ">Search</button>
                    </div>
                </div>
                <!-- Suggestions List -->
                <div id="suggestions-list-{{ $type ?? 'default' }}"
                    class="absolute z-10 w-full mt-1 bg-white shadow-md rounded-md dark:bg-slate-900 dark:text-white"
                    style="display:none;">
                    <ul id="suggestions-ul-{{ $type ?? 'default' }}" class="list-none p-0 m-0 max-h-48 overflow-auto">
                    </ul>
                </div>
            </div>

            <!-- City Dropdown -->
            <div class="col-lg-2 mb-4 px-1">
                <select name="city" onchange="this.form.submit()"
                    class="w-full border-theme px-3 py-2 rounded-2xl text-black">
                    <option value="null" selected>Locality</option>
                    @foreach ($cities ?? [] as $city)
                        <option value="{{ $city }}" {{ request()->get('city') == $city ? 'selected' : '' }}>
                            {{ $city }}
                        </option>
                    @endforeach

                </select>
            </div>
            <div class="col-lg-2 mb-4 px-1">
                <select name="project" onchange="this.form.submit()"
                    class="w-full border-theme px-3 py-2 rounded-2xl text-black">
                    <option value="null" {{ request()->get('project') == 'null' ? 'selected' : '' }}>Projects
                    </option>
                    @foreach ($projects ?? [] as $project)
                        <option value="{{ $project }}"
                            {{ request()->get('project') == $project ? 'selected' : '' }}>
                            {{ $project }}
                        </option>
                    @endforeach
                </select>
            </div>


            <!-- Other Filters -->
            <div class="col-lg-4 p-0 mb-3">
                <div class="relative gap-1 flex align-items-center">
                    <!-- Categories -->

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

                                    @foreach ($categories ?? [] as $category)
                                        <li>
                                            <input type="checkbox" value="{{ $category->name }}"
                                                {{ in_array($category->name, (array) request()->get('categories')) ? 'checked' : '' }}
                                                name="categories[]" id="category{{ $category->id }}">
                                            <label for="category{{ $category->id }}">{{ $category->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="text-end">
                                    <input type="submit" value="Search" @click="toggleDropdown('categories')"
                                        class="btn btn-theme text-light" />
                                </div>
                            </div>
                        </div>
                    </div>



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
                                    'single_page' => true,
                                ])
                            </div>
                        </div>
                    </div>



                    <!-- Bedrooms -->
                    <div class="relative mb-2 d-none">
                        <button type="button" @click="toggleDropdown('purpose')"
                            class="flex filter-button border-theme py-1 rounded-2xl px-1.5 top-search-btn">
                            Purpose<i
                                :class="openDropdown === 'purpose' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'purpose'" x-transition class="dropdown-box filter-web-dropdown">
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
                                    <li><input type="checkbox"
                                            {{ in_array('freehold', (array) request()->get('ownership')) ? 'checked' : '' }}
                                            name="ownership[]" value="freehold" id="ownership_1">
                                        <label for="ownership_1"> Freehold </label>
                                    </li>
                                    <li><input type="checkbox"
                                            {{ in_array('co-operative_society', (array) request()->get('ownership')) ? 'checked' : '' }}
                                            name="ownership[]" value="co-operative_society" id="ownership_2">
                                        <label for="ownership_2"> Co-operative Society </label>
                                    </li>
                                    <li><input type="checkbox"
                                            {{ in_array('power_of_attorney', (array) request()->get('ownership')) ? 'checked' : '' }}
                                            name="ownership[]" value="power_of_attorney" id="ownership_3">
                                        <label for="ownership_3">Power of Attorney</label>
                                    </li>
                                </ul>
                                <div class="text-start">
                                    <input type="submit" value="Search" class="btn btn-theme text-light" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               <!-- Display Selected Items -->
               <div id="selected-items-container-{{ $type ?? 'default' }}"
               class="relative flex-wrap flex items-center mt-2 gap-2 bg-white rounded-md p-2">
               <div id="selected-items-display-{{ $type ?? 'default' }}"
                   class="flex flex-wrap gap-2 overflow-hidden">
                   <!-- Dynamically generated selected items will go here -->
               </div>
               <!-- Show More Button -->
               <span role="button" id="show-more-btn-{{ $type ?? 'default' }}"
                   class="text-blue-500 text-sm mt-2 z-9" style="display: none"
                   onclick="toggleShowMore('{{ $type ?? 'default' }}')">Show More</span>
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
                },
                openDropdown: '',

                // Toggle dropdown
                toggleDropdown(name) {
                    this.openDropdown = this.openDropdown === name ? '' : name;
                },
                // Apply filters with AJAX
                applyFilters() {
                    var type = document.getElementById('type').value;
                    if (type == 'projects') {
                        window.location.href = "{{ route('public.projects') }}";
                        return;
                    } else if (type == 'sell') {
                        window.location.href = "{{ route('public.properties.sale') }}";
                        return;
                    } else if (type == 'rent') {
                        window.location.href = "{{ route('public.properties.rent') }}";
                        return;
                    } else if (type == 'all-residential') {
                        window.location.href = "{{ route('public.properties') }}";
                        return;
                    } else if (type == 'commercial-sale' && `{{ request()->get('tab') != 'sale' }}`) {
                        window.location.href = "{{ route('public.properties.commercial', ['tab' => 'sale']) }}";
                        return;
                    } else if (type == 'commercial-rent' && `{{ request()->get('tab') != 'rent' }}`) {
                        window.location.href = "{{ route('public.properties.commercial', ['tab' => 'rent']) }}";
                        return;
                    } else if (type == 'pg') {
                        window.location.href = "{{ route('public.properties.pg') }}";
                        return;
                    } else if (type == 'plot') {
                        window.location.href = "{{ route('public.properties.plot') }}";
                        return;
                    }

                    document.body.scrollTop = 0, document.documentElement.scrollTop = 0
                    const params = new URLSearchParams(this.filters).toString();

                    // Get the current URL and append the parameters
                    const baseUrl = window.location.origin + window.location.pathname;
                    const url = `${baseUrl}?${params}`;
                    window.location = url;
                    // fetch(url, {
                    //         headers: {
                    //             'X-Requested-With': 'XMLHttpRequest'
                    //         },
                    //     })
                    //     .then((response) => response.json())
                    //     .then((data) => {
                    //         // window.history.pushState({}, '', url);
                    //         document.getElementById('items-list').innerHTML = data.html;
                    //     })
                    //     .catch((error) => console.error('Error:', error));
                },
            };
        }
    </script>
@endpush

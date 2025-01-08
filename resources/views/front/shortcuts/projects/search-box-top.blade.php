<form x-data="propertyFilters()" class="search-filter">
    <div class="pt-5">
        <div class="row align-items-center">
            <!-- Property Type Dropdown -->
            <div class="col-lg-5 mb-4 px-1">
                <div class="position-relative">
                    <div class="flex items-center space-x-3">
                        <select name="type" id="type" @change="applyFilters()"
                            class="border-theme px-3 py-2 rounded-s-2xl text-black">
                            <option value="projects">Projects</option>
                            <optgroup label="Residential" class="text-dark">
                                <option value="all-residential">All Residential</option>
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
                        <input type="text" name="k" id="search-box-projects" autocomplete="off"
                            oninput="fetchSuggestions('{{ $type ?? 'default' }}')"
                            onfocus="showSuggestions('{{ $type ?? 'default' }}')"
                            class="border-theme px-3 py-1.5 w-full  text-black"
                            placeholder="Search for locality,builder">
                        <i id="loading-icon-projects"
                            class="absolute hidden mdi mdi-loading mdi-spin top-5 right-5"></i>
                        <button
                            class="bi bi-search rounded-e-2xl bg-theme-light border-theme  px-3 py-1.5 ">Search</button>
                    </div>
                </div>
                <!-- Suggestions List -->
                <div id="suggestions-list-projects"
                    class="absolute z-10 w-full mt-1 bg-white shadow-md rounded-md dark:bg-slate-900 dark:text-white"
                    style="display:none;">
                    <ul id="suggestions-ul-projects" class="list-none p-0 m-0 max-h-48 overflow-auto">
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


            <!-- Other Filters -->
            <div class="col-lg-5 p-0 mb-3">
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
                                    @foreach ($builders ?? [] as $builder)
                                        <li>
                                            <input type="checkbox" value="{{ $builder->name }}"
                                                id="builder_{{ $builder->id }}" name="builder[]"
                                                {{ in_array($builder->name, (array) request()->get('builder')) ? 'checked' : '' }}>
                                            <label for="builder_{{ $builder->id }}"> {{ $builder->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="text-end">
                                    <input type="submit" value="Search" @click="toggleDropdown('builder')"
                                        class="btn btn-theme text-light" />
                                </div>
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
                                    <li><input
                                            {{ in_array('new_launch', (array) request()->get('construction')) ? 'checked' : '' }}
                                            name="construction[]" type="checkbox" value="new_launch"
                                            id="new_launch">
                                        <label for="new_launch"> New Launch </label>
                                    </li>
                                    <li><input
                                            {{ in_array('under_construction', (array) request()->get('construction')) ? 'checked' : '' }}
                                            name="construction[]" type="checkbox" value="under_construction"
                                            id="under_construction">
                                        <label for="under_construction"> Under Construction </label>
                                    </li>
                                    <li><input
                                            {{ in_array('ready_to_move', (array) request()->get('construction')) ? 'checked' : '' }}
                                            name="construction[]" type="checkbox" value="ready_to_move"
                                            id="ready_to_move">
                                        <label for="ready_to_move">Ready to move</label>
                                    </li>
                                </ul>
                                <div class="text-end">
                                    <input type="submit" value="Search" @click="toggleDropdown('construction')"
                                        class="btn btn-theme text-light" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Display Selected Items -->
            <div id="selected-items-container-projects"
                class="relative flex-wrap flex items-center mt-2 gap-2 bg-white rounded-md p-2">
                <div id="selected-items-display-projects"
                    class="flex flex-wrap gap-2 overflow-hidden">
                    <!-- Dynamically generated selected items will go here -->
                </div>
                <!-- Show More Button -->
                <span role="button" id="show-more-btn-projects"
                    class="text-blue-500 text-sm mt-2 z-9" style="display: none"
                    onclick="toggleShowMore('projects')">Show More</span>
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

                    } else if (type == 'sell') {
                        window.location.href = "{{ route('public.properties.sale') }}";
                        return;
                    } else if (type == 'rent') {
                        window.location.href = "{{ route('public.properties.rent') }}";
                        return;
                    } else if (type == 'pg') {
                        window.location.href = "{{ route('public.properties.pg') }}";
                        return;
                    } else if (type == 'plot') {
                        window.location.href = "{{ route('public.properties.plot') }}";
                        return;
                    } else if (type == 'all-commercial') {
                        window.location.href = "{{ route('public.properties.commercial') }}";
                        return;
                    } else if (type == 'commercial-sale') {
                        window.location.href = "{{ route('public.properties.commercial', ['tab' => 'sale']) }}";
                        return;
                    } else if (type == 'commercial-rent') {
                        window.location.href = "{{ route('public.properties.commercial', ['tab' => 'rent']) }}";
                        return;
                    } else if (type == 'all-residential') {

                        window.location.href = "{{ route('public.properties') }}";
                        return;
                    }

                    document.body.scrollTop = 0, document.documentElement.scrollTop = 0
                    const params = new URLSearchParams(this.filters).toString();

                    // Get the current URL and append the parameters
                    const baseUrl = window.location.origin + window.location.pathname;
                    const url = `${baseUrl}?${params}`;
                    window.location = url;

                },
            };
        }
    </script>
@endpush

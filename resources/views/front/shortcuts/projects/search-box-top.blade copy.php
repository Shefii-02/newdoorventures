<form action="{{ $actionUrl ?? RealEstateHelper::getProjectsListPageUrl() }}"
    data-ajax-url="{{ $ajaxUrl ?? route('public.projects') }}" class="search-filter relative">
    <div class="py-5">
        <div class="row align-items-center">
            <div class="col-lg-3 mb-2">
                <input type="text" name="k" class=" mb-0 dark:bg-slate-900 border-theme px-3 py-1.5 w-full rounded-2xl"
                    placeholder="Search for projects">
            </div>
            <div class="col-lg-2 mb-2">
                <select name="city" class="  mb-0 dark:bg-slate-900 w-full border-theme px-3 py-2 rounded-2xl">
                    <option value="null" selected>Choose a city</option>
                    @foreach ($cities as $itm)
                        <option value="{{ $itm }}">{{ $itm }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-7 p-0">
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
                        <button type="button"
                            @click="openDropdown = openDropdown === 'contruction' ? '' : 'contruction'"
                            :class="{ 'active': openDropdown === 'contruction' }"
                            class="filter-button border-theme py-1 rounded-2xl px-1.5">
                            Construction status
                            <i
                                :class="openDropdown === 'contruction' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'contruction'" x-transition style="display: none"
                            class="dropdown-box filter-web-dropdown">
                            <div class="option-sections">
                                <ul class="ks-cboxtags p-0">
                                    <li>
                                        <input type="checkbox" name="rera" id="ready-to-move" value="ready-to-move">
                                        <label for="ready-to-move">Ready to move</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="rera" id="new-launch"
                                            value="new-launch">
                                        <label for="rera_unregistered"> New Launch</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="rera" id="under-construction"
                                            value="under-construction">
                                        <label for="under-construction"> Under Construction</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="relative mb-2">
                        <button type="button" @click="openDropdown = openDropdown === 'unitType' ? '' : 'unitType'"
                            :class="{ 'active': openDropdown === 'unitType' }"
                            class="filter-button border-theme py-1 rounded-2xl px-1.5">
                            RERA Status
                            <i :class="openDropdown === 'unitType' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'unitType'" style="display: none" x-transition
                            class="dropdown-box filter-web-dropdown">
                            <div class="option-sections">
                                <ul class="ks-cboxtags p-0">
                                    <li><input type="checkbox" name="rera" id="rera_registered" value="Registered">
                                        <label for="rera_registered">Registered</label>
                                    </li>
                                    <li><input type="checkbox" name="rera" id="rera_unregistered"
                                            value="Unregistered">
                                        <label for="rera_unregistered"> Unregistered</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="relative mb-2">
                        <select name="city" class="mb-0 dark:bg-slate-900  w-3/4 border-theme px-3 py-2 rounded-2xl">
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

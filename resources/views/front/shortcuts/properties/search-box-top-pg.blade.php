<form action="{{ $actionUrl ?? RealEstateHelper::getPropertiesListPageUrl() }}" class="search-filter" data-ajax-url="{{ $ajaxUrl ?? route('public.properties') }}">

    <div class="py-5">
        <div class="row align-items-center">
            <div class="col-lg-3 mb-4">
                <input type="text" 
                    class=" border-theme px-3 py-1.5 w-full rounded-2xl" 
                    placeholder="Search for pg ....">
            </div>
            <div class="col-lg-2 mb-4">
                <select class=" w-full border-theme text-dark px-3 py-2 rounded-2xl">
                    <option selected>Choose a city</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
         
            <div class="col-lg-7 p-0 mb-3">
                <div class="relative flex flex-wrap justify-between align-items-center" x-data="{ openDropdown: '' }">

                    <div class="relative mb-2">
                        <button type="button" 
                            @click="openDropdown = openDropdown === 'categories' ? '' : 'categories'" 
                            :class="{ 'active': openDropdown === 'categories' }" 
                            class="filter-button border-theme py-1 rounded-2xl px-1.5">
                            Categories
                            <i :class="openDropdown === 'categories' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'categories'" 
                            x-transition 
                            class="dropdown-box filter-web-dropdown">
                            <p>Budget dropdown content goes here.</p>
                        </div>
                    </div>

                    <div class="relative mb-2">
                        <button type="button" 
                            @click="openDropdown = openDropdown === 'budget' ? '' : 'budget'" 
                            :class="{ 'active': openDropdown === 'budget' }" 
                            class="filter-button border-theme py-1 rounded-2xl px-1.5">
                            Budget
                            <i :class="openDropdown === 'budget' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'budget'" 
                            x-transition 
                            class="dropdown-box filter-web-dropdown">
                            <p>Budget dropdown content goes here.</p>
                        </div>
                    </div>

                    <div class="relative mb-2">
                        <button type="button" 
                            @click="openDropdown = openDropdown === 'unitType' ? '' : 'unitType'" 
                            :class="{ 'active': openDropdown === 'unitType' }" 
                            class="filter-button border-theme py-1 rounded-2xl px-1.5">
                            Unit Type
                            <i :class="openDropdown === 'unitType' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'unitType'"  
                            x-transition 
                            class="dropdown-box filter-web-dropdown">
                            <p>Unit Type dropdown content goes here.</p>
                        </div>
                    </div>

                    <div class="relative mb-2">
                        <button type="button" 
                            @click="openDropdown = openDropdown === 'ownership' ? '' : 'ownership'" 
                            :class="{ 'active': openDropdown === 'ownership' }" 
                            class="filter-button border-theme py-1 rounded-2xl px-1.5">
                            Availability for
                            <i :class="openDropdown === 'ownership' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'ownership'"  
                            x-transition 
                            class="dropdown-box filter-web-dropdown">
                            <p>Unit Type dropdown content goes here.</p>
                        </div>
                    </div>

                    <div class="relative mb-2">
                        <button type="button" 
                            @click="openDropdown = openDropdown === 'furnishing' ? '' : 'furnishing'" 
                            :class="{ 'active': openDropdown === 'furnishing' }" 
                            class="filter-button border-theme py-1 rounded-2xl px-1.5">
                            Ameneties
                            <i :class="openDropdown === 'furnishing' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'furnishing'"  
                            x-transition 
                            class="dropdown-box filter-web-dropdown">
                            <p>Unit Type dropdown content goes here.</p>
                        </div>
                    </div>
                   
                    <div class="relative mb-2">
                        <button type="button" 
                            @click="openDropdown = openDropdown === 'builder' ? '' : 'builder'" 
                            :class="{ 'active': openDropdown === 'builder' }" 
                            class="filter-button border-theme py-1 rounded-2xl px-1.5">
                            Food
                            <i :class="openDropdown === 'builder' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </button>
                        <div x-show="openDropdown === 'builder'" 
                            x-transition 
                            class="dropdown-box filter-web-dropdown">
                            <p>Builder dropdown content goes here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

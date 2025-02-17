<form action="{{ route('public.properties.pg') }}"
    data-ajax-url="{{ route('searching-in-keywords') }}">
    <input type="hidden" name="type" value="rent">
    <input type="hidden" name="m" value="{{ 'pg' }}">
    <div class="col-lg-12">
        <div class="row align-items-center">
            <div class="col-md-2 flex justify-end all-residential">
                <button type="button" @click="openPg = !openPg"
                    class="flex items-center gap-2 toggle-advanced-search text-primary hover:text-secondary">
                    {{ __('All Residential') }}
                    <i :class="openPg ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                </button>
            </div>

            <div class="col-md-8 mb-3">
                <div class="row align-items-center">
                    <div class="col-lg-10 col-10">
                        @include("front.shortcuts.filters.keyword", ['type' => $type])
                    </div>
                    <div class="col-lg-2 col-2 flex gap-5">
                        @include("front.shortcuts.filters.tabs.mic-location")
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <button type="submit"
                    class="btn bg-primary hover:bg-secondary border-primary hover:border-secondary text-white submit-btn w-full !h-12 rounded transition-all ease-in-out duration-200">
                    <i class="mdi mdi-magnify me-2"></i>
                    {{ __('Search') }}
                </button>
            </div>
        </div>

        <!-- Pg Tab -->
        <div>

            <div x-show="openPg" x-transition x-cloak>
               
                <div class="container-fluid px-3 mt-3">
                    <div class="flex flex-wrap mb-4 gap-4">
                        <span role="button" @click="activeTab2 = (activeTab2 === 'budget_pg' ? '' : 'budget_pg')"
                            :class="{ 'font-bold tab-active bg-theme-light': activeTab2 === 'budget_pg' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Budget
                            <i :class="activeTab2 === 'budget_pg' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>

                        {{-- <span role="button" @click="activeTab2 = (activeTab2 === 'bedroom_pg' ? '' : 'bedroom_pg')"
                            :class="{ 'font-bold tab-active bg-theme-light': activeTab2 === 'bedroom_pg' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Bedroom
                            <i :class="activeTab2 === 'bedroom_pg' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span> --}}

                        <span role="button" @click="activeTab2 = (activeTab2 === 'sharing_pg' ? '' : 'sharing_pg')"
                            :class="{ 'font-bold tab-active bg-theme-light': activeTab2 === 'sharing_pg' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Sharing
                            <i :class="activeTab2 === 'sharing_pg' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>

                        <span role="button" @click="activeTab2 = (activeTab2 === 'available_for_pg' ? '' : 'available_for_pg')"
                            :class="{ 'font-bold tab-active bg-theme-light': activeTab2 === 'available_for_pg' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Available for
                            <i :class="activeTab2 === 'available_for_pg' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>


                    </div>

                    <div>
                        <div x-show="activeTab2 === 'budget_pg'" class="p-4 rounded-lg" x-cloak>
                            @include('front.shortcuts.filters.price-range', ['type' => $type,'min' => '1000','max'=> '100000','step'=>'500'])
                        </div>
                        {{-- <div x-show="activeTab2 === 'bedroom_pg'" class="p-4 rounded-lg" x-cloak>
                            @include("front.shortcuts.filters.bedroom-section", ['type' => $type])
                        </div> --}}
                        <div x-show="activeTab2 === 'sharing_pg'" class="p-4 rounded-lg" x-cloak>
                            @include("front.shortcuts.filters.sharing", ['type' => $type])
                        </div>
                        <div x-show="activeTab2 === 'available_for_pg'" class="p-4 rounded-lg" x-cloak>
                            @include("front.shortcuts.filters.available-for", ['type' => $type])
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</form>

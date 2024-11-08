<form action="{{ $actionUrl ?? RealEstateHelper::getPropertiesListPageUrl() }}"
    data-ajax-url="{{ $ajaxUrl ?? route('public.properties') }}">
    <input type="hidden" name="type" value="{{ $type }}">
    <div class="col-lg-12">
        <div class="row align-items-center">
            <div class="col-md-2 flex justify-end">
                <button type="button" @click="openPg = !openPg"
                    class="flex items-center gap-2 toggle-advanced-search text-primary hover:text-secondary">
                    {{ __('All Residential') }}
                    <i :class="openPg ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                </button>
            </div>

            <div class="col-md-8">
                <div class="row align-items-center">
                    <div class="col-lg-10">
                        {!! Theme::partial('filters.keyword', compact('type')) !!}
                    </div>
                    <div class="col-lg-2 flex gap-5">
                        {!! Theme::partial('filters.tabs.mic-location') !!}
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
                <div class="col-span-12">
                    {!! Theme::partial('filters.property-type', compact('type', 'categories')) !!}
                </div>

                <div class="mt-3">
                    <div class="flex space-x-4 mb-4 gap-8">
                        <span role="button" @click="activeTab = (activeTab === 'budget_pg' ? '' : 'budget_pg')"
                            :class="{ 'font-bold tab-active': activeTab === 'budget_pg' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Budget
                            <i :class="activeTab === 'budget_pg' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>

                        <span role="button" @click="activeTab = (activeTab === 'bedroom_pg' ? '' : 'bedroom_pg')"
                            :class="{ 'font-bold tab-active': activeTab === 'bedroom_pg' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Bedroom
                            <i :class="activeTab === 'bedroom_pg' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>

                        <span role="button" @click="activeTab = (activeTab === 'sharing_pg' ? '' : 'sharing_pg')"
                            :class="{ 'font-bold tab-active': activeTab === 'sharing_pg' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Sharing
                            <i :class="activeTab === 'sharing_pg' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>

                        <span role="button" @click="activeTab = (activeTab === 'available_for_pg' ? '' : 'available_for_pg')"
                            :class="{ 'font-bold tab-active': activeTab === 'available_for_pg' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Available for
                            <i :class="activeTab === 'available_for_pg' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>


                    </div>

                    <div>
                        <div x-show="activeTab === 'budget_pg'" class="p-4 rounded-lg" x-cloak>
                            {!! Theme::partial('filters.price-range', compact('type')) !!}
                        </div>
                        <div x-show="activeTab === 'bedroom_pg'" class="p-4 rounded-lg" x-cloak>
                            {!! Theme::partial('filters.bedroom-section', compact('type')) !!}
                        </div>
                        <div x-show="activeTab === 'sharing_pg'" class="p-4 rounded-lg" x-cloak>
                            {!! Theme::partial('filters.sharing', compact('type')) !!}
                        </div>
                        <div x-show="activeTab === 'available_for_pg'" class="p-4 rounded-lg" x-cloak>
                            {!! Theme::partial('filters.available-for', compact('type')) !!}
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>


    </div>
</form>

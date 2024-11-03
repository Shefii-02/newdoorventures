<form action="{{ $actionUrl ?? RealEstateHelper::getPropertiesListPageUrl() }}"
    data-ajax-url="{{ $ajaxUrl ?? route('public.properties') }}">
    <input type="hidden" name="type" value="{{ $type }}">
    <div class="col-lg-12">
        <div class="row align-items-center">
            <div class="col-md-2 flex justify-end">
                <button type="button" @click="openPlot = !openPlot"
                    class="flex items-center gap-2 toggle-advanced-search text-primary hover:text-secondary">
                    {{ __('All Residential') }}
                    <i :class="openPlot ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
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

        <!-- Plot Tab -->
        <div>

            <div x-show="openPlot" x-transition x-cloak>
                <div class="col-span-12">
                    {!! Theme::partial('filters.plots-land', compact('type', 'categories')) !!}
                </div>

                <div class="mt-3">
                    <div class="flex space-x-4 mb-4 gap-8">
                        <span role="button" @click="activeTab = (activeTab === 'budget_Plot' ? '' : 'budget_Plot')"
                            :class="{ 'font-bold tab-active': activeTab === 'budget_Plot' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Budget
                            <i :class="activeTab === 'budget_Plot' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>

                        <span role="button" @click="activeTab = (activeTab === 'bedroom_Plot' ? '' : 'bedroom_Plot')"
                            :class="{ 'font-bold tab-active': activeTab === 'bedroom_Plot' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Bedroom
                            <i :class="activeTab === 'bedroom_Plot' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>

                       
                    </div>

                    <div>
                        <div x-show="activeTab === 'budget_Plot'" class="p-4 rounded-lg" x-cloak>
                            {!! Theme::partial('filters.price-range', compact('type')) !!}
                        </div>
                        <div x-show="activeTab === 'bedroom_Plot'" class="p-4 rounded-lg" x-cloak>
                            {!! Theme::partial('filters.bedroom-section', compact('type')) !!}
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>


    </div>
</form>

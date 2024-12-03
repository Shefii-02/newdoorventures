<form action="/"
    data-ajax-url="/">
    <input type="hidden" name="type" value="{{ 'sell' }}">
    <input type="hidden" name="m" value="{{ 'plot' }}">
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
                        @include('front.shortcuts.filters.keyword', ['type' => $type])
                    </div>
                    <div class="col-lg-2 flex gap-5">
                        @include('front.shortcuts.filters.tabs.mic-location')
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
                    <div class="container-fluid px-3">
                        @include('front.shortcuts.filters.plots-land', [
                            'type' => $type,
                            'categories' => [],
                        ])
                    </div>
                </div>

                <div class="container-fluid px-3 mt-3">
                    <div class="flex space-x-4 mb-4 gap-8">
                        <span role="button" @click="activeTab2 = (activeTab2 === 'budget_Plot' ? '' : 'budget_Plot')"
                            :class="{ 'font-bold tab-active bg-theme-light': activeTab2 === 'budget_Plot' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Budget
                            <i :class="activeTab2 === 'budget_Plot' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>
                        <span role="button" @click="activeTab2 = (activeTab2 === 'bedroom_Plot' ? '' : 'bedroom_Plot')"
                            :class="{ 'font-bold tab-active bg-theme-light': activeTab2 === 'bedroom_Plot' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Area
                            <i
                                :class="activeTab2 === 'bedroom_Plot' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>
                    </div>

                    <div>
                        <div x-show="activeTab2 === 'budget_Plot'" class="p-4 rounded-lg" x-cloak>
                            @include("front.shortcuts.filters.price-range", ['type' => $type])
                        </div>
                        <div x-show="activeTab2 === 'bedroom_Plot'" class="p-4 rounded-lg" x-cloak>
                            @include("front.shortcuts.filters.size-section", ['type' => $type])
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</form>

<form action="/" class="property" data-ajax-url="/">
    <input type="hidden" name="type" value="{{ 'sell' }}">
    <div class="col-lg-12">
        <div class="row align-items-center">
            <div class="col-md-2 flex justify-end">
                <button type="button" @click="openBuy = !openBuy"
                    class="flex items-center gap-2 toggle-advanced-search text-primary hover:text-secondary">
                    {{ __('All Residential') }}
                    <i :class="openBuy ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                </button>
            </div>

            <div class="col-md-8">
                <div class="row align-items-center">
                    <div class="col-lg-10">
                        @include("front.shortcuts.filters.keyword", ['type' => $type])
                    </div>
                    <div class="col-lg-2 flex gap-5">
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

        <!-- Buy Tab -->
        <div>
            <div x-show="openBuy" x-transition x-cloak>
                <div class="col-span-12">
                    <div class="container-fluid px-3">
                        @include("front.shortcuts.filters.property-type", ['type' => $type, 'categories' => $categories])
                    </div>
                </div>

                <div class="container-fluid px-3 mt-3">
                    <div class="flex space-x-4 mb-4 gap-8">
                        <span role="button"
                            @click="activeTab2 = (activeTab2 === 'budget_Buy' ? '' : 'budget_Buy')"
                            :class="{ 'font-bold tab-active bg-theme-light': activeTab2 === 'budget_Buy' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Budget
                            <i :class="activeTab2 === 'budget_Buy' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>

                        <span role="button"
                            @click="activeTab2 = (activeTab2 === 'bedroom_Buy' ? '' : 'bedroom_Buy')"
                            :class="{ 'font-bold tab-active bg-theme-light': activeTab2 === 'bedroom_Buy' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Bedroom
                            <i :class="activeTab2 === 'bedroom_Buy' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>

                        <span role="button"
                            @click="activeTab2 = (activeTab2 === 'construction_Buy' ? '' : 'construction_Buy')"
                            :class="{ 'font-bold tab-active bg-theme-light': activeTab2 === 'construction_Buy' }"
                            class="text-dark border rounded-3xl px-4 fs-6">
                            Construction Status
                            <i :class="activeTab2 === 'construction_Buy' ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                        </span>
                    </div>

                    <div>
                        <div x-show="activeTab2 === 'budget_Buy'" class="p-4 rounded-lg" x-cloak>
                            @include("front.shortcuts.filters.price-range", ['type' => $type])
                        </div>
                        <div x-show="activeTab2 === 'bedroom_Buy'" class="p-4 rounded-lg" x-cloak>
                            @include("front.shortcuts.filters.bedroom-section", ['type' => $type])
                        </div>
                        <div x-show="activeTab2 === 'construction_Buy'" class="p-4 rounded-lg" x-cloak>
                            @include("front.shortcuts.filters.construction-status", ['type' => $type])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12" x-data="{ openBuy: false, openRent: false, openPg : false, openCommercial : false, openPlot:false,openProject : false, activeTab: '' }">
            <ul @class([
                'flex-wrap justify-center inline-block w-full p-4 text-center bg-white border-b rounded-t-xl dark:border-gray-800 mb-0',
                'dark:bg-slate-900' => $style === 1,
                'mx-auto mt-10 sm:w-fit bg-white/80 dark:bg-slate-900/80 backdrop-blur-sm' => $style === 2,
                'relative -mt-[6.5rem] z-10' => $shortcode->getName() === 'featured-properties-on-map',
            ]) id="searchTab" data-tabs-toggle="#search-filter" role="tablist">

                @php
                    $searchTabs = [
                        'buy' => 'Buy',
                        'rent' => 'Rent',
                        'new-launch' => 'New Launch',
                        'pg-co-living' => 'PG / Co-living',
                        'commercial' => 'Commercial',
                        'plot' => 'Plots/Land',
                        'projects' => 'Projects',
                    ];
                @endphp

                @foreach ($searchTabs as $key => $value)
                    <li role="presentation" class="inline-block">
                        <button @class([
                            'w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary',
                            'rounded-md' => $style === 1,
                            'rounded-xl' => $style === 2,
                            'rounded-3xl' => $style === 4,
                        ]) id="{{ $key }}-tab"
                            data-tabs-target="#{{ $key }}" type="button" role="tab"
                            aria-controls="{{ $key }}" aria-selected="false">
                            {{ $value }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div @class([
                'p-6 bg-white shadow-md search-filter dark:bg-slate-900 rounded-se-none rounded-xl dark:shadow-gray-700',
                'rounded-ss-none' => $style == 1,
                'border-t -mt-8 z-10' => $shortcode->getName() === 'featured-properties-on-map',
            ])>
                @foreach ($searchTabs as $key => $value)
                    <div @class(['hidden' => !$loop->first]) id="{{ $key }}" role="tabpanel"
                        aria-labelledby="{{ $key }}-tab">
                        @php($type = $key === 'projects' ? 'project' : ($key === 'plot' ? 'plot' : 'property'))
                        {!! Theme::partial("filters.tabs.$key", ['type' => $key, 'categories' => $categories]) !!}
                    </div>
                @endforeach
            </div>
        </div>
  
        
    </div>
</div>

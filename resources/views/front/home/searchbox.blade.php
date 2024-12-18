

<!-- Modal -->
<div id="voiceSearchModal" class="modal">
    <div class="modal-content">
        <form action="/">
            <input type="hidden" name="k" id="keyword-search" autocomplete="off">
            <span role="button"  id="closeModal" class="mt-10"><i class="mdi mdi-close"></i></span>
            {{-- <h2 class="mb-4">Voice Search</h2> --}}
            <p id="action" class="mb-3" style="color: grey; font-weight: 800;"></p>

            <div id="startSpeech">
                <span role="button" id="startButton" class="btn mic-btn type2">
                    <div class="pulse"></div>
                    <i class="mdi mdi-microphone  microphone" aria-hidden="true"></i>
                </span>
                
            </div>
            <h3 id="output" class="hide mt-5"></h3>

            <button  class="mt-3 btn bg-primary hover:bg-secondary border-primary hover:border-secondary text-white submit-btn-voice w-full !h-12 rounded transition-all ease-in-out duration-200">
                <i class="mdi mdi-magnify me-2"></i>
                Search
            </button>

        </form>
      
    </div>
    
</div>

<div class="grid justify-center grid-cols-1">
    <div class="relative -mt-32">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12" x-data="{ openBuy: false, openRent: false, openPg : false, openCommercial : false, openPlot:false, openProject : false, activeTab: 'buy',activeTab2 : '' }">
                    <ul class="flex-wrap justify-center inline-block w-full p-4 text-center bg-white border-b rounded-t-xl dark:border-gray-800 mb-0 dark:bg-slate-900"
                        id="searchTab" data-tabs-toggle="#search-filter" role="tablist">
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
                                <button @click="activeTab = '{{ $key }}'" :class="{ 'font-bold tab-active bg-primary hover:text-white text-white rounded-xl': activeTab === '{{ $key }}' }"
                                    class="w-full px-5 py-1 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary rounded-md"
                                    id="{{ $key }}-tab" type="button" role="tab">
                                    {{ $value }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="p-6 bg-white shadow-md search-filter dark:bg-slate-900 rounded-se-none dark:shadow-gray-700">
                        @foreach ($searchTabs as $key => $value)
                            <div x-show="activeTab === '{{ $key }}'" class="p-4" id="{{ $key }}" role="tabpanel">
                                @php($type = $key === 'projects' ? 'project' : ($key === 'plot' ? 'plot' : 'property'))
                                 @include("front.shortcuts.filters.tabs.$key", ['type' => $key, 'categories' => $categories])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

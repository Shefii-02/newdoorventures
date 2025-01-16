<form action="{{ route('public.projects') }}"
    data-ajax-url="{{ route('searching-in-keywords') }}">
    <input type="hidden" name="type" value="{{ $type }}">
    <div class="col-lg-12">
        <div class="row align-items-center">
            {{-- <div class="col-md-2 flex justify-end all-residential">
                <button type="button" @click="openProject = !openProject"
                    class="flex items-center gap-2 toggle-advanced-search text-primary hover:text-secondary">
                    {{ __('All Residential') }}
                    <i :class="openProject ? 'mdi mdi-chevron-up' : 'mdi mdi-chevron-down'"></i>
                </button>
            </div> --}}

            {{-- <div class="col-md-8 mb-3">
                <div class="row align-items-center">
                    <div class="col-lg-11 col-11">
                        @include('front.shortcuts.filters.mobile-keyword', ['type' => $type])
                    </div>
                    <div class="col-lg-1 col-1 flex gap-5">
                        <i role="button" class="mdi mdi-microphone fs-3 text-primary openModal"></i>
                    </div>
                </div>
            </div> --}}

            <div class="col-md-2">
                <button type="submit"
                    class="btn bg-primary hover:bg-secondary border-primary hover:border-secondary text-white submit-btn w-full !h-12 rounded transition-all ease-in-out duration-200">
                    <i class="mdi mdi-magnify me-2"></i>
                    {{ __('Search') }}
                </button>
            </div>
        </div>

        <!-- Project Tab -->
        <div>

            <div>
                <div class="col-span-12">
                    <div class="container-fluid px-3">
                        @include("front.shortcuts.filters.property-type", ['type' => $type, 'categories' => $categories])
                    </div>
                </div>

                <div class="container-fluid px-3 mt-5">
                  

                    <div>
                        <div  class="p-4 rounded-lg">
                            <label>Budget</label>
                            @include("front.shortcuts.filters.price-range", ['type' => $type])
                        </div>
                        <div  class="p-4 rounded-lg">
                            <label>Bedrooms</label>
                            @include("front.shortcuts.filters.bedroom-section", ['type' => $type])
                        </div>
                        <div  class="p-4 rounded-lg" >
                            <label>Construction Status</label>
                            @include("front.shortcuts.filters.construction-status", ['type' => $type])
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</form>

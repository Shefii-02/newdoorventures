<form action="{{ $actionUrl ?? RealEstateHelper::getPropertiesListPageUrl() }}" data-ajax-url="{{ $ajaxUrl ?? route('public.properties') }}">
    <input type="hidden" name="type" value="plot">
    <div class="space-y-5 registration-form text-dark text-start">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-0">
            {!! Theme::partial('filters.keyword', compact('type')) !!}

            {!! Theme::partial('filters.location', compact('type')) !!}
        </div>

        <button type="button" class="flex items-center gap-2 toggle-advanced-search text-primary hover:text-secondary">
            {{ __('Advanced') }}
            <i class="mdi mdi-chevron-down-circle-outline"></i>
        </button>


        <div class="grid hidden grid-cols-1 gap-6 transition-all duration-200 ease-in-out  lg:gap-0 advanced-search">
            
            <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-bud-tab" data-bs-toggle="tab" data-bs-target="#nav-bud" type="button" role="tab" aria-controls="nav-bud" aria-selected="true">Budget</button>
                    <button class="nav-link" id="nav-size-tab" data-bs-toggle="tab" data-bs-target="#nav-size" type="button" role="tab" aria-controls="nav-size" aria-selected="false">Size</button>
                  </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-bud" role="tabpanel" aria-labelledby="nav-bud-tab">
                        {!! Theme::partial('filters.price-range',compact('type')) !!}
                  </div>
                  <div class="tab-pane fade" id="nav-size" role="tabpanel" aria-labelledby="nav-size-tab">
                        {!! Theme::partial('filters.size-section',compact('type')) !!}

                  </div>
            </div>

            
           
            
           
            
            
        </div>

        <button type="submit" class="btn bg-primary hover:bg-secondary border-primary hover:border-secondary text-white submit-btn w-full md:w-1/4 !h-12 rounded transition-all ease-in-out duration-200">
            <i class="mdi mdi-magnify me-2"></i>
            {{ __('Search') }}
        </button>
    </div>
</form>

<form action="{{ $actionUrl ?? RealEstateHelper::getProjectsListPageUrl() }}" data-ajax-url="{{ $ajaxUrl ?? route('public.projects') }}">
    <input type="hidden" name="type" value="project">
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
            
            
            <div class="lg:grid-cols-3 md:grid-cols-2 grid" style="margin-bottom: 20px;">
                 {!! Theme::partial('filters.category', compact('type', 'categories')) !!}
            
            </div>    
            
            <div >
                
                {!! Theme::partial('filters.property-status') !!}
            </div>
            
            <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Budget</button>
                    <button class="nav-link ms-4" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Bedroom</button>
                  </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        {!! Theme::partial('filters.price-range',compact('type')) !!}
                  </div>
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        {!! Theme::partial('filters.bedroom-section',compact('type')) !!}

                  </div>
            </div>

            
           
            
           
            
            
        </div>

        <button type="submit" class="btn bg-primary hover:bg-secondary border-primary hover:border-secondary text-white submit-btn w-full md:w-1/4 !h-12 rounded transition-all ease-in-out duration-200">
            <i class="mdi mdi-magnify me-2"></i>
            {{ __('Search') }}
        </button>
    </div>
</form>

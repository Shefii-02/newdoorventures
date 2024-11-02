<form action="{{ $actionUrl ?? RealEstateHelper::getPropertiesListPageUrl() }}" data-ajax-url="{{ $ajaxUrl ?? route('public.properties') }}">
    <input type="hidden" name="type" value="{{ $type }}">
    <div class="space-y-5 registration-form text-dark text-start">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-0">
            {!! Theme::partial('filters.keyword', compact('type')) !!}

            {!! Theme::partial('filters.location', compact('type')) !!}

            {{-- Theme::partial('filters.by-project', compact('type')) --}}
        </div>

        <button type="button" class="flex items-center gap-2 toggle-advanced-search text-primary hover:text-secondary">
            {{ __('Advanced') }}
            <i class="mdi mdi-chevron-down-circle-outline"></i>
        </button>

        <div class="advanced-search duration-200 transition-all hidden">
            
            <div class="col-lg-12">
                {!! Theme::partial('filters.property-type', compact('type', 'categories')) !!}
            </div>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-budget-tab-{{$type}}" data-bs-toggle="tab" data-bs-target="#nav-budget-{{$type}}" type="button" role="tab" aria-controls="nav-budget-{{$type}}" aria-selected="true">Budget</button>
                    <button class="nav-link ms-4" id="nav-bedroom-tab-{{$type}}" data-bs-toggle="tab" data-bs-target="#nav-bedroom-{{$type}}" type="button" role="tab" aria-controls="nav-bedroom-{{$type}}" aria-selected="false">Bedroom</button>
                    <button class="nav-link ms-4" id="nav-construction-status-tab-{{$type}}" data-bs-toggle="tab" data-bs-target="#nav-construction-status-{{$type}}" type="button" role="tab" aria-controls="nav-construction-status-{{$type}}" aria-selected="false">Construction Status</button>

                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-budget-{{$type}}" role="tabpanel" aria-labelledby="nav-budget-tab-{{$type}}">
                        {!! Theme::partial('filters.price-range', compact('type')) !!}
                  </div>
                  <div class="tab-pane fade" id="nav-bedroom-{{$type}}" role="tabpanel" aria-labelledby="nav-bedroom-tab-{{$type}}">
                        {!! Theme::partial('filters.bedroom-section', compact('type')) !!}
                  </div>
                  <div class="tab-pane fade" id="nav-construction-status-{{$type}}" role="tabpanel" aria-labelledby="nav-construction-status-tab-{{$type}}">
                        {!! Theme::partial('filters.construction-status', compact('type')) !!}
                  </div>
                  
            </div>

    {{-- 
            {!! Theme::partial('filters.bedroom', compact('type')) !!}

            {!! Theme::partial('filters.bathroom', compact('type')) !!}

            {!! Theme::partial('filters.floor', compact('type')) !!}
    --}}
        </div>

        <button type="submit" class="btn bg-primary hover:bg-secondary border-primary hover:border-secondary text-white submit-btn w-full md:w-1/4 !h-12 rounded transition-all ease-in-out duration-200">
            <i class="mdi mdi-magnify me-2"></i>
            {{ __('Search') }}
        </button>
    </div>
</form>

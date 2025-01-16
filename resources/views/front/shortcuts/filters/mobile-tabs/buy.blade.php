<form action="{{ route('public.properties.sale') }}" class="property" data-ajax-url="{{ route('searching-in-keywords') }}">
    <input type="hidden" name="type" value="{{ 'sale' }}">
    <div class="col-lg-12">
        {{-- <div class="row align-items-center">
            <div class="col-md-12 mb-3">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-12">
                        @include('front.shortcuts.filters.mobile-keyword', ['type' => $type])
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Buy Tab -->
        <div>
            <div>
                <div class="col-span-12">
                    <div class="container-fluid px-1">
                        @include('front.shortcuts.filters.property-type', [
                            'type' => $type,
                            'categories' => $categories,
                        ])
                    </div>
                </div>

                <div class="container-fluid px-1 mt-3">
                    <div>
                        <div class="p-4 rounded-lg">
                            <label>Budget</label>
                            @include('front.shortcuts.filters.price-range-new', [
                                'type' => $type,
                                'min' => '100000',
                                'max' => '1000000000',
                                'step' => '50000',
                            ])
                        </div>
                        <div  class="p-4 rounded-lg">
                            <label>Bedroom</label>
                            @include('front.shortcuts.filters.bedroom-section', ['type' => $type])
                        </div>
                        <div  class="p-4 rounded-lg">
                            <label>Construction Status</label>
                            @include('front.shortcuts.filters.construction-status', ['type' => $type])
                        </div>
                        <div  class="p-4 rounded-lg">
                            <label>Furnishing</label>
                            @include('front.shortcuts.filters.furnishing', ['type' => $type])
                        </div>
                    </div>
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
</form>

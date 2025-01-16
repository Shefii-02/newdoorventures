<form action="{{ route('public.properties.commercial') }}" data-ajax-url="{{ route('searching-in-keywords') }}">
    <input type="hidden" name="type" value="{{ $type }}">
    <input type="hidden" name="m" value="{{ 'commercial' }}">
    <div class="col-lg-12">
        <div class="row align-items-center">
            <div class="col-md-12 mb-3">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-12">
                        @include('front.shortcuts.filters.keyword', ['type' => $type])
                    </div>
                </div>
            </div>


        </div>

        <!-- Commercial Tab -->
        <div>
            <div>
                <div class="col-span-12">
                    @include('front.shortcuts.filters.property-type', [
                        'type' => $type,
                        'categories' => $categories->where('has_commercial', 1),
                    ])
                </div>
                <div class="mt-3">
                    <div>
                        <div class="p-4 rounded-lg">
                            <label>Budget</label>
                            @include('front.shortcuts.filters.price-range', ['type' => $type])
                        </div>
                        <div class="p-4 rounded-lg">
                            <label>Area</label>
                            @include('front.shortcuts.filters.size-section', ['type' => $type])
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <button type="submit"
                class="btn bg-primary hover:bg-secondary border-primary hover:border-secondary text-white submit-btn w-full !h-12 rounded transition-all ease-in-out duration-200">
                <i class="mdi mdi-magnify me-2"></i>
                {{ __('Search') }}
            </button>
        </div>
    </div>
</form>

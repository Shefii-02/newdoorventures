{{-- <form action="{{ route('public.properties.pg') }}" data-ajax-url="{{ route('searching-in-keywords') }}">
    <input type="hidden" name="type" value="rent">
    <input type="hidden" name="m" value="{{ 'pg' }}">
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

        <!-- Pg Tab -->
        <div>
            <div>
                <div class="container-fluid px-11 mt-3">
                    <div>
                        <div class="p-4 rounded-lg" >
                            <label>Budget</label>
                            @include('front.shortcuts.filters.price-range-new', [
                                'type' => $type,
                                'min' => '1000',
                                'max' => '100000',
                                'step' => '500',
                            ])
                        </div>
                        <div class="p-4 rounded-lg" >
                            <label>Sharing</label>
                            @include('front.shortcuts.filters.sharing', ['type' => $type])
                        </div>
                        <div class="p-4 rounded-lg" x-cloak>
                            <label>Available for</label>
                            @include('front.shortcuts.filters.available-for', ['type' => $type])
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
</form> --}}

<form action="{{ route('public.properties.pg') }}" data-ajax-url="{{ route('searching-in-keywords') }}">
    <input type="hidden" name="type" value="rent">
    <input type="hidden" name="m" value="{{ 'pg' }}">
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

        <!-- Pg Tab -->
        <div>
            <div class="col-span-12">
                <div class="container-fluid px-1">
                    @include('front.shortcuts.filters.property-type', [
                        'type' => $type,
                        'categories' => $categories,
                    ])
                </div>
            </div>
            <div class="container-fluid  mt-3">
                <div>
                    <div class="px-2 rounded-lg">
                        <label>Budget</label>
                        @include('front.shortcuts.filters.price-range-new', [
                            'type' => $type,
                            'min' => '1000',
                            'max' => '100000',
                            'step' => '500',
                        ])
                    </div>
                    <div class="px-2 rounded-lg">
                        <label>Sharing</label>
                        @include('front.shortcuts.filters.sharing', ['type' => $type])
                    </div>
                    <div class="px-2 rounded-lg" x-cloak>
                        <label>Available for</label>
                        @include('front.shortcuts.filters.available-for', ['type' => $type])
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

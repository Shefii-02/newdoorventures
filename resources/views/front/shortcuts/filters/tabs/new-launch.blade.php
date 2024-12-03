<form action="/"
    data-ajax-url="/">
    <input type="hidden" name="type" value="{{ $type }}">
    <input type="hidden" name="m" value="new-launch">
    <div class="col-lg-12">
        <div class="row align-items-center">
            <div class="col-md-2 flex justify-end">
                <button type="button"
                    class="flex items-center gap-2 toggle-advanced-search text-primary hover:text-secondary">
                    {{ __('Residential') }}

                    <i class="mdi mdi-chevron-up1"></i>
                </button>
            </div>
            <div class="col-md-8">
                <div class="row align-items-center">
                    <div class="col-lg-10">
                        @include("front.shortcuts.filters.keyword", ['type' => $type])
                    </div>
                    <div class="col-lg-2 flex gap-5 ">
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
       
    </div>
</form>

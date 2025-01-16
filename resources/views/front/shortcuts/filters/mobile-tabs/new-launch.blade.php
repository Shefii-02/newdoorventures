<form action="{{ route('public.projects') }}"
    data-ajax-url="{{ route('searching-in-keywords') }}">
    <input type="hidden" name="type" value="{{ $type }}">
    <input type="hidden" name="m" value="new-launch">
    <div class="col-lg-12">
        <div class="row align-items-center">
            <div class="col-md-12 mb-3">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-12">
                        @include("front.shortcuts.filters.keyword", ['type' => $type])
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

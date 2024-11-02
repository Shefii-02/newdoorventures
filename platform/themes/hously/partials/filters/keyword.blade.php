@php
    $places = $dropDownLocation->pluck('name');
    $placeholders = [];

    foreach ($places as $key => $value) {
        $placeholders[] = 'Searching Property for "' . $value.'"';
    }

    $placeholders[] = 'Search for Property "Keywords"';
    $placeholders[] = 'Searching for "3 BHK for buy"';
    $placeholders[] = 'Searching for "2 BHK for buy"';
    $placeholders[] = 'Searching for "2 BHK for buy"';
@endphp
<div x-data="{
    placeholders: {{ json_encode($placeholders) }},
    currentIndex: 0,
    init() {
        this.changePlaceholder();
        setInterval(() => {
            this.changePlaceholder();
        }, 3000);
    },
    changePlaceholder() {
        this.$refs.inputElement.placeholder = this.placeholders[this.currentIndex];
        this.currentIndex = (this.currentIndex + 1) % this.placeholders.length;
    }
}">
    {{-- <label class="form-label" for="keyword-{{ $type }}" class="font-medium form-label text-slate-900 dark:text-white">{{ __('Keyword:') }}</label> --}}
    <div class="relative mt-2 filter-search-form filter-border">
        <i class="mdi mdi-magnify icons"></i>
        <input name="k" x-ref="inputElement" type="text" id="keyword-{{ $type }}"
            class="border-0 form-input filter-input-box bg-gray-50 dark:bg-slate-800" autocomplete="off"
            placeholder="{{ __('Search your ' . ucfirst('projects') . ' or Area') }}"
            value="{{ BaseHelper::stringify(request()->query('k')) }}">
        <i class="absolute hidden mdi mdi-loading mdi-spin top-5 end-5"></i>
    </div>
</div>

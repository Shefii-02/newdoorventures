
<div>
    <label class="form-label" for="choices-location-{{ $type }}" class="font-medium form-label text-slate-900 dark:text-white">{{ __('Location:') }}</label>
    <div class="relative mt-2 filter-search-form filter-border">
        <i class="mdi mdi-map-marker-outline icons"></i>
        <select class="border-0 form-input filter-input-box bg-gray-50 dark:bg-slate-800" data-trigger name="location" id="choices-loc-{{ $id ?? $type }}" aria-label="{{ __('Select Location') }}">
            <option value="">{{ __('Select Location') }}</option>
            @foreach($dropDownLocation as $location)
                <option value="{{ $location->name }}" @if(request('location') == $location->name) selected @endif>{{ $location->name }}</option>
            @endforeach
        </select>
    </div>
</div>

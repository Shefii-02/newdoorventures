{{-- <div class="d-flex mt-6">
    <label class="form-label mt-4 me-5" for="choices-category-{{ $type }}" class="font-medium form-label text-slate-900 dark:text-white">Select Size</label>
    <div class="relative mt-2 filter-search-form filter-border">
        <select class="form-select z-2" data-trigger name="select-size" id="choices-size-{{ $id ?? $type }}" aria-label="selectSize">
            <option value="sq.ft.">sq.ft.</option>
            <option value="sq.yards">sq.yards</option>
            <option value="sq.m">sq.m</option>
            <option value="acres">acres</option>
            <option value="marla">marla</option>
            <option value="cents">cents</option>
            <option value="bigha">bigha</option>
            <option value="kottah">kottah</option>
            <option value="kanal">kanal</option>
            <option value="grounds">grounds</option>
            <option value="ares">ares</option>
            <option value="biswa">biswa</option>
            <option value="guntha">guntha</option>
            <option value="aankadam">aankadam</option>
            <option value="hectares">hectares</option>
            <option value="rood">rood</option>
            <option value="chataks">chataks</option>
            <option value="perch">perch</option>
           
        </select>
    </div>
</div> --}}

<div class="mt-3">

    <div class="wrapper">
        <div class="price-input size-input-{{ $type }}">

            <span class="price-range-values d-flex gap-2 mb-12">
                <span class="min w-20">0 sq.ft.</span> - <span class="max w-20">4000 sq.ft.</span>
                {{-- <select class="form-select z-2" data-trigger name="select-size" id="choices-size-{{ $id ?? $type }}"
                    aria-label="selectSize">
                    <option value="sq.ft.">sq.ft.</option>
                    <option value="sq.yards">sq.yards</option>
                    <option value="sq.m">sq.m</option>
                    <option value="acres">acres</option>
                    <option value="marla">marla</option>
                    <option value="cents">cents</option>
                    <option value="bigha">bigha</option>
                    <option value="kottah">kottah</option>
                    <option value="kanal">kanal</option>
                    <option value="grounds">grounds</option>
                    <option value="ares">ares</option>
                    <option value="biswa">biswa</option>
                    <option value="guntha">guntha</option>
                    <option value="aankadam">aankadam</option>
                    <option value="hectares">hectares</option>
                    <option value="rood">rood</option>
                    <option value="chataks">chataks</option>
                    <option value="perch">perch</option>

                </select> --}}
            </span>
            <input name="min_square" style="display:none" type="number" id="min-size" value="0"
                class="border-0 form-input filter-input-box bg-gray-50 dark:bg-slate-800"
                placeholder="{{ __('Min size') }}">
            <input name="max_square" style="display:none" type="number" id="max-size" value="0"
                class="border-0 form-input filter-input-box bg-gray-50 dark:bg-slate-800"
                placeholder="{{ __('Max size') }}">

        </div>
        <div class="slider size-slider-progress-{{ $type }} mt-2">
            <div class="col-lg-12 position-absolute" style="top:-35px">
                <div class="row">
                    <div class="col-6">
                        <span class=" badge bg-theme">0 <span class="sizeType">sq.ft.</span></span>
                    </div>
                    <div class="col-6">
                        <span class=" badge bg-theme float-end">4000 <span class="sizeType">sq.ft.</span></span>
                    </div>
                </div>
            </div>
            <div class="progress"></div>
        </div>
        <div class="size-range-input size-input-{{ $type }}">
            <div class="position-relative">
                <input type="range" data-typeval="{{ $type }}" title="0 sq.ft." class="range-min"
                    min="0" max="4000" value="0" step="100">
            </div>
            <div class="position-relative">
                <input type="range" data-typeval="{{ $type }}" title="0 sq.ft." class="range-max"
                    min="0" max="4000" value="4000" step="100">
            </div>
        </div>
    </div>

</div>

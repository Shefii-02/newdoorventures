<div class="mt-2">
    <label class="form-label" for="min-price" class="font-medium form-label text-slate-900 dark:text-white">Property Type</label>
    <div class="relative mt-2 filter-search-form filter-border ">
        <div class="row">
                @foreach($categories ?? [] as $category)
                 <div class="col-lg-3 mb-3">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" checked value="{{ $category->name }}" name="categories[]" id="property{{ $category->id }}_{{ $type }}">
                          <label class="form-check-label ms-2 mt-0.5" for="property{{ $category->id }}_{{ $type }}">
                            {{ $category->name }}
                          </label>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</div>


<div class="mt-10">
    <label class="form-label" for="min-price" class="font-medium form-label text-slate-900 dark:text-white">Plots/Land</label>
    <div class="relative mt-2 filter-search-form filter-border ">
        <div class="row">
                @foreach($categories as $category)
                 <div class="col-lg-3 mb-3">
                        <div class="form-check">
                          <input class="form-check-input" {{ $loop->first ? 'checked' : '' }} type="radio" value="{{ $category->name }}" name="property_type" id="property{{ $category->id }}_{{ $type }}">
                          <label class="form-check-label ms-2 mt-0.5" for="property{{ $category->id }}_{{ $type }}">
                            {{ $category->name }}
                          </label>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</div>


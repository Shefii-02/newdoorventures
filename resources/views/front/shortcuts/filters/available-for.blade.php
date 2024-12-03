<div class="mt-6">
    {{-- <label class="form-label" for="property-status" class=" form-label text-slate-900 dark:text-white">Construction Status</label> --}}
    <div class="relative mt-2 filter-search-form filter-border  gap-8" style="display:flex;" >
        <div class="lg:grid-cols-3 ">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="girls" name="available_for[]" id="girls_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="girls_{{ $type }}">
                Girls
              </label>
            </div>
        </div>
        <div class="lg:grid-cols-3 ">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="boys" name="available_for[]" id="boys_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="boys_{{ $type }}">
                Boys
              </label>
            </div>
        </div>
        <div class="lg:grid-cols-3 ">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="any" name="available_for[]" id="boys_{{ $type }}">
            <label class="form-check-label ms-2 mt-0.5" for="boys_{{ $type }}">
              Girls & Boys
            </label>
          </div>
      </div>
      
        
    </div>
  
</div>
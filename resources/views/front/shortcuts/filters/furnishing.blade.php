<div class="mt-6">
    <div class="relative mt-2 filter-search-form filter-border  gap-8" style="display:flex;" >
        <div class="lg:grid-cols-3 ">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="furnished" name="furnishing[]" id="furnished_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="furnished_{{ $type }}">
                Furnished
              </label>
            </div>
        </div>
        <div class="lg:grid-cols-3 ">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="semi-furnished" name="furnishing[]" id="semi_furnished_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="semi_furnished_{{ $type }}">
                Semi Furnished
              </label>
            </div>
        </div>
        <div class="lg:grid-cols-3 ">
            <div class="form-check"> 
              <input class="form-check-input" type="checkbox" value="unfurnished" name="furnishing[]" id="unfurnished_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="unfurnished_{{ $type }}">
                Unfurnished
              </label>
            </div>
        </div>
        
    </div>
  
</div>
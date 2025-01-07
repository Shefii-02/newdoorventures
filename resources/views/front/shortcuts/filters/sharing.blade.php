<div class="mt-6">
    {{-- <label class="form-label" for="property-status" class=" form-label text-slate-900 dark:text-white">Construction Status</label> --}}
    <div class="relative mt-2 filter-search-form filter-border flex flex-wrap  gap-8"  >
        <div class="lg:grid-cols-3 ">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="single" name="occupancy[]" id="privateRooms_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="privateRooms_{{ $type }}">
                Single
              </label>
            </div>
        </div>
        <div class="lg:grid-cols-3 ">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="double" name="occupancy[]" id="twoRooms_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="twoRooms_{{ $type }}">
                Double
              </label>
            </div>
        </div>
        <div class="lg:grid-cols-3 ">
            <div class="form-check"> 
              <input class="form-check-input" type="checkbox" value="other" name="occupancy[]" id="twoPlusRooms_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="twoPlusRooms_{{ $type }}">
                3+ More
              </label>
            </div>
        </div>
        <div class="lg:grid-cols-3 ">
          <div class="form-check"> 
            <input class="form-check-input" type="checkbox" value="capsule" name="occupancy[]" id="twoPlusRooms_{{ $type }}">
            <label class="form-check-label ms-2 mt-0.5" for="twoPlusRooms_{{ $type }}">
             Capsule
            </label>
          </div>
      </div>
        
    </div>
  
</div>
<div class="mt-6">
    {{-- <label class="form-label" for="property-status" class=" form-label text-slate-900 dark:text-white">Construction Status</label> --}}
    <div class="relative mt-2 filter-search-form filter-border  gap-8" style="display:flex;" >
        <div class="lg:grid-cols-3 ">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="private-rooms" name="sharing[]" id="privateRooms_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="privateRooms_{{ $type }}">
                Private Rooms
              </label>
            </div>
        </div>
        <div class="lg:grid-cols-3 ">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="2-per-rooms" name="sharing[]" id="twoRooms_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="twoRooms_{{ $type }}">
                2 per Rooms
              </label>
            </div>
        </div>
        <div class="lg:grid-cols-3 ">
            <div class="form-check"> 
              <input class="form-check-input" type="checkbox" value="2p-per-rooms" name="sharing[]" id="twoPlusRooms_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="twoPlusRooms_{{ $type }}">
                2+ per Rooms
              </label>
            </div>
        </div>
        
    </div>
  
</div>
<div class="mt-6">
    {{-- <label class="form-label" for="property-status" class=" form-label text-slate-900 dark:text-white">Construction Status</label> --}}
    <div class="relative mt-2 filter-search-form filter-border flex flex-wrap  gap-2"  >
        <div class="lg:grid-cols-3 ">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="newLaunch" name="construction[]" id="consNewLaunch_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="consNewLaunch_{{ $type }}">
                New Launch
              </label>
            </div>
        </div>
        <div class="lg:grid-cols-3 ">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="underConstruction" name="construction[]" id="consUnderConstruction_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="consUnderConstruction_{{ $type }}">
                Under Construction
              </label>
            </div>
        </div>
        <div class="lg:grid-cols-3 ">
            <div class="form-check"> 
              <input class="form-check-input" type="checkbox" value="readyTomove" name="construction[]" id="consReadyTomove_{{ $type }}">
              <label class="form-check-label ms-2 mt-0.5" for="consReadyTomove_{{ $type }}">
                Ready to Move
              </label>
            </div>
        </div>
        
    </div>
  
</div>
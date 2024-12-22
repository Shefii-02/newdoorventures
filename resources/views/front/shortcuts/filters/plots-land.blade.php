<div class="mt-10">
     <label class="form-label" for="min-price"
       class="font-medium form-label text-slate-900 dark:text-white">Plots/Land</label>
    <div class="relative mt-2 filter-search-form filter-border ">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input" checked type="radio"
                                value="residential" name="purpose"
                                id="property_Residential_Plots_Land_{{ $type }}">
                            <label class="form-check-label ms-2 mt-0.5" for="property_Residential_Plots_Land_{{ $type }}">
                              Residential
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-check">
                            <input class="form-check-input" checked type="radio"
                                value="commercial" name="purpose"
                                id="property_Residential_commercial{{ $type }}">
                            <label class="form-check-label ms-2 mt-0.5" for="property_Residential_commercial{{ $type }}">
                            Commercial
                            </label>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>

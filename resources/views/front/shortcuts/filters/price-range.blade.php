
  <div >
          <label class="form-label" for="min-price" class="font-medium form-label text-slate-900 dark:text-white">Select Price Range</label>
          
    
    <div class="wrapper">
      <div class="price-input price-input-{{$type}}">
          
        <span class="price-range-values d-flex gap-2  mb-5">
            <span class="min">₹0.00</span> - <span class="max">₹100+ Crores</span>
        </span>
        <input name="min_price" style="display:none" type="number" id="min-price" value="0" class="border-0 form-input filter-input-box bg-gray-50 dark:bg-slate-800" placeholder="{{ __('Min price') }}">
        <input name="max_price" style="display:none" type="number" id="max-price" value="1000000000" class="border-0 form-input filter-input-box bg-gray-50 dark:bg-slate-800" placeholder="{{ __('Max price') }}">

      </div> 
       <div class="slider slider-progress-{{$type}} position-relative mt-7">
           <div class="col-lg-12 position-absolute" style="top:-35px">
               <div class="row">
                   <div class="col-6">
                    <span class=" badge bg-theme">₹0.00</span>
                   </div>
                   <div class="col-6">
                    <span class=" badge bg-theme float-end">₹100+ Crores</span>
                   </div>
               </div>
           </div>
        <div class="progress" ></div>
        
      </div>
      <div class="range-input range-input-{{$type}}" >
          <div class="position-relative">
            <input type="range" data-typeval="{{$type}}"  title="₹0.00" class="range-min" min="0" max="1000000000" value="0" step="500000">
            <!--<span class="tooltiptext tooltiptextMin">₹0.00</span>-->
          </div>
            <div class="position-relative">
        <input type="range" data-typeval="{{$type}}" title="₹0.00" class="range-max" min="0" max="1000000000" value="1000000000" step="500000">
        <!--<span class="tooltiptext tooltiptextMAx">₹0.00</span>-->
        </div>
      </div> 
    </div>

  </div>
  
 


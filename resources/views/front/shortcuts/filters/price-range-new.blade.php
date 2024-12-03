<div x-data="priceRange(@js($min), @js($max), @js($step))" class="mt-8">
    <label class="form-label font-medium text-slate-900 dark:text-white" for="min-price">Select Price Range</label>

    <div class="wrapper">
        <div class="price-input">
            <!-- Display Min and Max Values -->
            <span class="price-range-values d-flex gap-2 mb-5">
                <span x-text="formattedMinPrice">₹0.00</span> - <span x-text="formattedMaxPrice">₹50+ Crores</span>
            </span>

            <!-- Hidden Inputs for Min and Max Values -->
            <input type="number" name="min_price" x-model="minPrice" style="display: none">
            <input type="number" name="max_price" x-model="maxPrice" style="display: none">
        </div>

        <!-- Slider Progress -->
        <div class="slider position-relative mt-7">
            <div class="col-lg-12 position-absolute" style="top: -35px">
                <div class="row">
                    <div class="col-6">
                        <span class="badge bg-theme">₹0.00</span>
                    </div>
                    <div class="col-6">
                        <span class="badge bg-theme float-end">₹50+ Crores</span>
                    </div>
                </div>
            </div>
            <div class="progress"
                x-bind:style="'left: ' + minPercent + '%; right: ' + Math.max(0, 100 - maxPercent) + '%'">
            </div>
        </div>

        <!-- Range Inputs -->
        <div class="range-input">
            <div class="position-relative">
                <input type="range" x-model="minPrice" x-bind:min="min" x-bind:max="max"
                    x-bind:step="step" x-on:input="updateMin" class="range-min">
            </div>
            <div class="position-relative">
                <input type="range" x-model="maxPrice" x-bind:min="min" x-bind:max="max"
                    x-bind:step="step" x-on:input="updateMax" class="range-max">
            </div>
        </div>

        <!-- Manual Inputs -->
        <div class="manual-input mt-5 flex gap-4 items-center">
            <label for="manual-min" class="font-medium text-sm">Min Price:</label>
            <input type="number" id="manual-min" x-model="minPrice" x-bind:min="min"
                x-bind:max="max" x-on:input="updateMin" class="rounded-md border border-gray-300 p-2 w-32">

            <label for="manual-max" class="font-medium text-sm">Max Price:</label>
            <input type="number" id="manual-max" x-model="maxPrice" x-bind:min="min"
                x-bind:max="max" x-on:input="updateMax" class="rounded-md border border-gray-300 p-2 w-32">
        </div>

        <!-- Submit Button -->
        <div class="submit-button mt-5 text-end">
            <button type="button" x-on:click="submitPrices"
                class="bg-theme text-white px-4 py-2 rounded-md hover:bg-theme-dark">Submit</button>
        </div>
    </div>
</div>

@push('footer')
    <script>
        function priceRange(min, max, step) {
            return {
                min,
                max,
                step,
                minPrice: min,
                maxPrice: max,
                get minPercent() {
                    return (this.minPrice / this.max) * 100;
                },
                get maxPercent() {
                    return (this.maxPrice / this.max) * 100;
                },
                get formattedMinPrice() {
                    return this.formatNumber(this.minPrice);
                },
                get formattedMaxPrice() {
                    return this.formatNumber(this.maxPrice);
                },
                updateMin() {
                    this.minPrice = Math.min(Math.max(this.min, this.minPrice), this.maxPrice - this.step);
                },
                updateMax() {
                    this.maxPrice = Math.max(Math.min(this.max, this.maxPrice), this.minPrice + this.step);
                },
                submitPrices() {
                    // Set the filters for price range
                    const filters = propertyFilters().filters;
                    filters.min_price = this.minPrice;
                    filters.max_price = this.maxPrice;

                    // Trigger the main applyFilters function
                    propertyFilters().applyFilters();
                },
                formatNumber(number) {
                    if (number >= 10000000) {
                        return (number / 10000000).toFixed(2) + ' Crore';
                    } else if (number >= 100000) {
                        return (number / 100000).toFixed(2) + ' Lac';
                    } else if (number >= 1000) {
                        return (number / 1000).toFixed(2) + ' K';
                    } else {
                        return number;
                    }
                }
            };
        }
    </script>
@endpush

<div role="button"
    class="p-2 mb-3  overflow-hidden duration-500 ease-in-out bg-white shadow property-item group rounded-xl dark:bg-slate-800 hover:shadow-lg dark:shadow-gray-700 dark:hover:shadow-gray-700">
    @include('front.shortcuts.properties.item-details',compact('property'))
    <div class="p-1 flex flex-column justify-content-between">
       

        <ul
            class="flex items-center justify-between px-3 border mt-3 bg-gray-200 rounded-2 mb-0 list-none border-b dark:border-gray-800">
           
            <li class="flex items-center me-2">
                <i class="text-lg text-primary mdi mdi-bed-empty me-2"></i>
                <span class="text-sm text-capitalize">
                    {{ $property->occupancy_type }}
                </span>
            </li>

                <li class="flex items-center me-2">
                    <i class="text-lg text-primary mdi mdi-account-check me-2"></i>
                    <span class="text-sm text-capitalize">
                        {{ $property->available_for == 'any' ? 'Coed' : $property->available_for }}
                    </span>
                </li>
           

        </ul>
       
        <ul class="flex flex-wrap gap-3 items-center justify-between pt-4 ps-0 mb-0 list-none">
            <li>
                <span class="text-slate-400 text-sm">{{ __('Price') }}</span>
                <p class="text-lg font-semibold">{{ shorten_price($property->price) }} <span
                        class="text-sm">Onwards</span>
                    {{-- , $property->currency) --}}</p>
            </li>
            <li>
                <a  href="/contact"  data-id="{{ $property->id }}" data-type="property" 
                    class="mt-5 text-white rounded-md bg-primary btn-sm btn hover:bg-secondary popup-contact-modal-form">
                    <i class="align-middle mdi mdi-phone me-2"></i> Contact us
                </a>
            </li>

        </ul>
    </div>
</div>

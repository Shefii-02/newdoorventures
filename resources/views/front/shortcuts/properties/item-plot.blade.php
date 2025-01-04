<div role="button"
    class="p-2 mb-3  overflow-hidden duration-500 ease-in-out bg-white shadow property-item group rounded-xl dark:bg-slate-800 hover:shadow-lg dark:shadow-gray-700 dark:hover:shadow-gray-700">
    @include('front.shortcuts.properties.item-details',compact('property'))

    <div class="p-1 flex flex-column justify-content-between mt-2">
      

        <ul
            class="flex items-center justify-between px-3 border mt-3 bg-gray-200 rounded-2 mb-0 list-none border-b dark:border-gray-800">
            @if ($numberBedrooms = $property->number_bedroom)
                <li class="flex items-center me-2">
                    <i class="text-lg text-primary mdi mdi-account-arrow-right me-2"></i>
                    <span class="text-sm text-capitalize">
                        Ownership : {{ $property->ownership }}
                    </span>
                </li>
            @endif



            <li class="flex items-center me-2">
                <i class="text-lg text-primary mdi mdi-arrow-collapse-all me-2"></i>
                <span class="text-sm">{{ $property->plot_area ?? 0 }} Sq.ft</span>
            </li>

        </ul>

        <ul class="flex flex-wrap gap-3 items-center justify-between pt-4 ps-0 mb-0 list-none">
            <li>
                <span class="text-slate-400">{{ __('Price') }}</span>
                <p class="text-lg font-semibold">{{ shorten_price($property->price) }}
                    {{-- , $property->currency) --}}</p>
            </li>
            <li>
                <a href="/contact" data-id="{{ $property->id }}" data-type="property" 
                    class="mt-5 text-white rounded-md bg-primary btn-sm btn hover:bg-secondary popup-contact-modal-form">
                    <i class="align-middle mdi mdi-phone me-2"></i> Contact us
                </a>
            </li>
        </ul>
    </div>
</div>

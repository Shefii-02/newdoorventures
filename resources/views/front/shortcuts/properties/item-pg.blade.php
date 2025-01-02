<div role="button"
    class="p-2 mb-3  overflow-hidden duration-500 ease-in-out bg-white shadow property-item group rounded-xl dark:bg-slate-800 hover:shadow-lg dark:shadow-gray-700 dark:hover:shadow-gray-700">
    <div class="relative overflow-hidden">
        <a target="_blank" href="{{ route('public.property_single', ['uid' => $property->unique_id, 'slug' => $property->slug]) }}">
            <img src="{{ asset('images/' . $property->image) }}" onerror="this.src='/themes/images/dummy-image.webp'"
                alt="{{ $property->name }}" class="rounded-xl duration-500 h-50 w-100">
        </a>
        {{-- <div class="absolute top-6 end-6">
            <button type="button"
                class="text-lg text-red-600 bg-white rounded-full shadow btn btn-icon dark:bg-slate-900 dark:shadow-gray-700 add-to-wishlist"
                aria-label="{{ __('Add to wishlist') }}" data-box-type="property"
                data-id="{{ $property->id }}">
                <i class="mdi mdi-heart-outline"></i>
            </button>
        </div> --}}
        @if ($property->images && ($imagesCount = count($property->images)))
            <div class="absolute top-6 start-6">
                <div
                    class="flex items-center justify-center content-center p-2 pt-2.5 bg-gray-700 rounded-md bg-opacity-60 text-white text-sm">
                    <i class="leading-none mdi mdi-camera-outline me-1"></i>
                    <span class="leading-none">{{ $imagesCount }}</span>
                </div>
            </div>
        @endif
        {{-- <div class="absolute bottom-0 flex text-sm start-0 item-info-wrap">
            <span class="flex items-center py-1 ps-6 pe-4 text-white">{{ $property->category->name }}</span>
            {!! $property->status !!}
        </div> --}}
        <div class="absolute bottom-0 flex text-sm start-4 item-info-wrap">
            <span class="flex items-center py-1 ps-6 pe-4 text-white">
                {{ $property->category->name }}
            </span>
            <span class="label-success status-label text-uppercase">{!! $property->type_name !!}</span>
        </div>
    </div>

    <div class="p-6 flex flex-column justify-content-between">
        <div class="truncate">
            <a target="_blank" href="{{ route('public.property_single', ['uid' => $property->unique_id, 'slug' => $property->slug]) }}"
                class="text-md font-bold text-capitaize duration-500 ease-in-out hover:text-primary"
                title="{{ $property->name }}">
                {!! $property->name !!}
            </a>
            <p class="truncate text-slate-600 dark:text-slate-300">
                <span class="mdi mdi-map-marker-multiple"></span> <span class="text-sm">{!! $property->location ? $property->location . '<br>' : '' !!}</span>
                <span class="ms-4 text-sm">{{ $property->city }}.</span>
            </p>
        </div>

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

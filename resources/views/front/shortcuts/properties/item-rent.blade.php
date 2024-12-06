<div role="button"
    class="p-2 overflow-hidden duration-500 ease-in-out bg-white shadow property-item group rounded-xl dark:bg-slate-800 hover:shadow-lg dark:shadow-gray-700 dark:hover:shadow-gray-700">
    <div class="relative overflow-hidden">
        <a href="{{ route('public.property_single', ['uid' => $property->unique_id, 'slug' => $property->slug]) }}">
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
            <span class="label-success status-label text-capitalize">{!! $property->type_name !!}</span>
        </div>
    </div>

    <div class="p-1 mt-3 flex flex-column justify-content-between">
        <div class="truncate">
            <a href="{{ route('public.property_single', ['uid' => $property->unique_id, 'slug' => $property->slug ]) }}"
                class="text-md font-bold text-capitaize duration-500 ease-in-out hover:text-primary"
                title="{{ $property->name }}">
                {!! $property->name !!}
            </a>
            <p class="truncate text-slate-600 dark:text-slate-300">
                <span class="mdi mdi-map-marker-multiple"></span> <span class="text-sm">{!! $property->location ? $property->location .'<br>' : ''  !!}</span>
                <span class="ms-4 text-sm">{{ $property->city }}.</span>
            </p>
            @if($property->project->name)
            <p class="truncate text-slate-600 dark:text-slate-300">
                <span class="mdi mdi-bank-check text-medium font-bold"></span>  <span class="text-sm">Project :</span><span class="text-sm font-bold"> {{ $property->project->name }}</span>
            </p>
            @endif
        </div>

        <ul
            class="flex items-center justify-between px-3 border mt-3 bg-gray-200 rounded-2 mb-0 list-none border-b dark:border-gray-800">
            @if ($numberBedrooms = $property->number_bedroom)
                <li class="flex items-center me-2">
                    <i class="text-lg text-primary mdi mdi-bed-empty me-2"></i>
                    <span class="text-sm">
                        {{ $numberBedrooms == 1 ? __('1 Bed') : __(':number Beds', ['number' => $numberBedrooms]) }}
                    </span>
                </li>
            @endif

            @if ($numberBathrooms = $property->number_bathroom)
                <li class="flex items-center me-2">
                    <i class="text-lg text-primary mdi mdi-shower me-2"></i>
                    <span class="text-sm">
                        {{ $numberBathrooms == 1 ? __('1 Bath') : __(':number Baths', ['number' => $numberBathrooms]) }}
                    </span>
                </li>
            @endif


            <li class="flex items-center me-2">
                <i class="text-lg text-primary mdi mdi-bed-king-outline me-2"></i>
                <span class="text-sm text-capitalize">{{ str_replace('-',' ',$property->furnishing_status) ?? 0 }}</span>
            </li>

        </ul>

        <ul class="flex flex-wrap gap-3 items-center justify-between pt-4 px-4 mb-0 list-none">
            <li>
                <span class="text-slate-400 text-sm">{{ __('Price') }}</span>
                <p class="text-lg font-semibold">{{ shorten_price($property->price) }}
                    {{-- , $property->currency) --}}</p>
            </li>
            <li>
                <a href="/contact" data-bs-toggle="modal" data-bs-target="#BookingModal"
                    class="mt-5 text-white rounded-md bg-primary btn-sm btn hover:bg-secondary">
                    <i class="align-middle mdi mdi-phone me-2"></i> Contact us
                </a>
            </li>

        </ul>
    </div>
</div>

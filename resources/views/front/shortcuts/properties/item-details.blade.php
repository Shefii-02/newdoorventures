<div class="relative overflow-hidden">
    <a target="_blank" href="{{ route('public.property_single', ['uid' => $property->unique_id, 'slug' => $property->slug]) }}">
        <img src="{{ asset('images/' . $property->image) }}" onerror="this.src='/themes/images/dummy-image.webp'" loading="lazy"
            alt="{{ $property->name }}" class="rounded-md duration-500 h-50 w-100">
    </a>
    <div class="absolute top-6 end-6">
        <div
            class="flex items-center justify-center content-center p-2 pt-2.5 bg-gray-700 rounded-md bg-opacity-60 text-white text-sm">
            <i class="leading-none mdi mdi-eye me-1"></i>
            <span class="leading-none small">{{ $property->views ?? 0 }}</span>
        </div>
    </div>
    @if ($property->images && ($imagesCount = count($property->images)))
        <div class="absolute top-6 start-6">
            <div
                class="flex items-center justify-center content-center p-2 pt-2.5 bg-gray-700 rounded-md bg-opacity-60 text-white text-sm">
                <i class="leading-none mdi mdi-camera-outline me-1"></i>
                <span class="leading-none">{{ $imagesCount }}</span>
            </div>
        </div>
    @endif
    
    <div class="absolute bottom-0 flex text-sm start-4 item-info-wrap">
        <span class="flex items-center py-1 ps-6 pe-4 text-white">
            {{ $property->category->name }}
        </span>
        <span class="label-success status-label text-capitalize">{!! $property->type_name !!}</span>
    </div>
</div>
<div class="p-2 flex flex-column justify-content-between">
    <div class="truncate">
        <a target="_blank" href="{{ route('public.property_single', ['uid' => $property->unique_id, 'slug' => $property->slug]) }}"
            class="text-md font-bold text-capitaize duration-500 ease-in-out hover:text-primary"
            title="{{ $property->name }}">
            {!! $property->name !!}
        </a>
        @if ($property->project->name)
            <a target="_blank" href="{{ route('public.project_single', ['uid' => $property->project->unique_id, 'slug' => $property->project->slug ]) }}">
                <p class="truncate text-slate-600 dark:text-slate-300 ">
                    <span class="mdi mdi-bank-check text-medium font-bold"></span> <span class="text-sm"></span><span class="text-sm font-bold"> {{ $property->project->name }}</span>
                </p>
            </a>
        @else
        <br><br>
        @endif

        <p class="truncate text-slate-600 dark:text-slate-300">
            <span class="mdi mdi-map-marker-multiple"></span> <span class="text-sm">{!! $property->location ? $property->location . '<br>' : '' !!}</span>
            <span class="ms-4 text-sm">{{ $property->city }}.</span>
            {!! Str::length($property->location) > 2 ? '' : '<br>' !!}
        </p>
        
    </div>
</div>
@php $numbers = $mores ?? false @endphp
<div @class(['group relative overflow-hidden pt-[56.25%] rounded-2xl', 'hidden' => $hidden ?? false])>
    <a href="{{ asset('images/'.$image) }}" class="absolute inset-0 lightbox" data-group="lightbox-pt-images-{{ $property->id }}">
        <img src="{{ asset('images/'.$image) }}" alt="{{ $property->name }}" class="w-full h-100">

        @if ($numbers > 5 || $numbers === 3)
            <div class="absolute inset-0 duration-500 ease-in-out bg-slate-900/70 group-hover:bg-slate-900/70"></div>
            <div class="absolute start-0 visible text-center -translate-y-1/2 bottom-0">
                <span class="text-black bg-white text-sm rounded-full px-2 py-0.75 ms-2">+{{ $numbers > 5 ? $numbers - 5 : $numbers - 2 }} Photos</span>
            </div>
        @else
            <div class="absolute inset-0 duration-500 ease-in-out group-hover:bg-slate-900/70"></div>
            <div class="absolute start-0 end-0 invisible text-center -translate-y-1/2 top-1/2 group-hover:visible">
                <span class="text-white rounded-full btn btn-icon bg-primary hover:bg-secondary">
                    <i class="mdi mdi-camera"></i>
                </span>
            </div>
        @endif
        @if(isset($main) && $main == true)
        <div class="absolute top-6 end-6">
            <button type="button" class="text-lg text-red-600 bg-white rounded-full shadow btn btn-icon dark:bg-slate-900 dark:shadow-gray-700 add-to-wishlist" aria-label="Add to wishlist" data-box-type="{{ $property_type }}" data-id="{{ $property->id }}" tabindex="0">
                <i class="mdi mdi-heart-outline"></i>
            </button>
        </div>
        @endif
    </a>
</div>

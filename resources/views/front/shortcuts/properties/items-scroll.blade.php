@if ($properties->isNotEmpty())

    <div
        data-slick='{
        "autoplay": true,
        "autoplaySpeed": 2000,
        "slidesToShow": 3,
        "slidesToScroll": 1,
        "arrows": true,
        "dots": false,
        "infinite": true,
        "responsive": [
            {"breakpoint": 1024, "settings": {"slidesToShow": 3}},
            {"breakpoint": 768, "settings": {"slidesToShow": 2}},
            {"breakpoint": 480, "settings": {"slidesToShow": 1}}
        ]
    }'>

            @foreach ($properties as $property)
                @if ($property->type == 'pg')
                    @include('front.shortcuts.properties.item-pg', compact('property'))
                @elseif($property->category->name == 'plot and land')
                    @include('front.shortcuts.properties.item-plot', compact('property'))
                @elseif($property->category->name == 'rent')
                    @include('front.shortcuts.properties.item-rent', compact('property'))
                @else
                    @include('front.shortcuts.properties.item-sale', compact('property'))
                @endif
            @endforeach


    </div>
    {{-- </div> --}}
@else
    <div class="my-16 text-center">
        <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
        </svg>
        <p class="mt-3 text-xl text-gray-500 dark:text-gray-300">{{ __('No properties found.') }}</p>
    </div>
@endif

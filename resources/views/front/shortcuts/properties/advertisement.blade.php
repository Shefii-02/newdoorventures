@php
    $count1 = $similarProperties->count();
    $count2 = $properties->count();
    $count = $count1 + $count2;
    $sideShowAdvertisement = ceil($count / 3);  // Correcting the division to ensure proper rounding
    $sideShowAdvertisement = $sideShowAdvertisement <= 0 ? 1 : $sideShowAdvertisement;
    $advertisementList = \App\Models\Advertisement::where('text', 'page_list')->inRandomOrder()->limit($sideShowAdvertisement)->get();  // Using `get()` instead of `limit()` directly
@endphp

@foreach($advertisementList as $adv)
    <div class="py-4">
        <a href="{{ $adv->redirection ?: '#' }}" target="{{ $adv->redirection ? '_blank' : '' }}">
            <img src="{{ asset('images/' . $adv->image) }}" class="w-100">
        </a>
    </div>
@endforeach

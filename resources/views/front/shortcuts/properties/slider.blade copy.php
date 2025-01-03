@php
    $images = $item->images;
    $images = array_values($images);
    $numberImages = count($images);
@endphp

<div class="container-fluid">
    <div class="mt-4 md:flex">
        @if (($firstImage = Arr::first($images)) && $numberImages != 4)
            <div class="@if ($numberImages > 1) lg:w-1/2 md:w-1/2 @else w-full @endif h-100 p-1">
                {!! Theme::partial('real-estate.properties.slider-image', ['property' => $item, 'image' => $firstImage]) !!}
            </div>
        @endif

        @if ($numberImages == 2)
            <div class="p-1 lg:w-1/2 md:w-1/2">
                {!! Theme::partial('real-estate.properties.slider-image', ['property' => $item, 'image' => $images[1]]) !!}
            </div>
        @elseif($numberImages == 3)
            <div class="p-1 lg:w-1/2 md:w-1/2">
                {!! Theme::partial('real-estate.properties.slider-image', [
                    'property' => $item,
                    'image' => $images[1],
                    'mores' => $numberImages,
                ]) !!}
            </div>

            {!! Theme::partial('real-estate.properties.slider-image', [
                'property' => $item,
                'image' => $images[2],
                'hidden' => true,
            ]) !!}
        @elseif ($numberImages == 4)
            <div class="lg:w-full md:w-full">
                @for ($i = 0; $i < 4; $i++)
                    @if ($i % 2 == 0)
                        <div class="flex">
                            <div class="w-1/2 p-1">
                            @else
                            </div>
                            <div class="w-1/2 p-1">
                    @endif
                    {!! Theme::partial('real-estate.properties.slider-image', ['property' => $item, 'image' => $images[$i]]) !!}
                    @if (in_array($i, [1, 3]))
            </div>
    </div>
    @endif
    @endfor
</div>
@elseif ($numberImages > 4)
<div class="p-1 lg:w-1/2 md:w-1/2">
    <div class="grid grid-cols-2 gap-1">
        @foreach (range(1, ($youtube_video != '' ? 2 : 4) ) as $i)
            {!! Theme::partial('real-estate.properties.slider-image', [
                'property' => $item,
                'image' => $images[$i],
                'mores' => $i === ($youtube_video != '' ? 2 : 4) ? $numberImages : 0,
            ]) !!}
        @endforeach

    </div>
    @if($youtube_video != '')
    <div class="w-full h-36 mt-2 rounded-2xl position-relative"
        style="background: url(https://img.youtube.com/vi/{{ $youtube_video }}/0.jpg);
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;">
        <div class="absolute start-0 end-0 visible text-center -translate-y-1/2 top-1/2">

            <a href="#!" data-group="intro-about-us" data-type="youtube" data-id="{{ $youtube_video }}"
                class="  shadow-md lightbox bg-dark btn h-2 p-4 rounded-full text-light w-3" aria-label="Play video"><i
                    class="inline-flex items-center justify-center text-2xl mdi mdi-play"></i></a>
        </div>
        <div class="absolute start-0 visible text-center -translate-y-1/2 bottom-0">
            <span class="text-black bg-white text-sm rounded-full px-2 py-0.75 ms-2">Video</span>
        </div>
    </div>
    @endif

</div>

@foreach ($images as $key => $image)
    @if ($key > 4)
        {!! Theme::partial('real-estate.properties.slider-image', [
            'property' => $item,
            'image' => $image,
            'hidden' => true,
        ]) !!}
    @endif
@endforeach
@endif
</div>
</div>

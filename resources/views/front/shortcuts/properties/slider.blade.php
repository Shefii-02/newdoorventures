@if(isset($item->images) && is_array($item->images))
@php
    $property_type = $property_type ?? 'property';
    $images = $item->images;
    $images = array_values($images);
    $numberImages = count($images);
    $hasYouTube = !empty($youtube_video);
@endphp
@if($numberImages > 0)
<div class="container-fluid">
    <div class="mt-4 md:flex">
        @if ($numberImages === 1)
            <div class="@if($hasYouTube) lg:w-1/2 md:w-1/2 @else w-full @endif h-100 p-1 relative">
                @include('front.shortcuts.properties.slider-image', ['property' => $item, 'image' => $images[0]])
            </div>
            @if($hasYouTube)
                <div class="lg:w-1/2 md:w-1/2 p-1">
                    @include('front.shortcuts.properties.youtube-video', ['youtube_video' => $youtube_video])
                </div>
            @endif
        @elseif ($numberImages === 2)
     
            <div class="lg:w-1/2 md:w-1/2 p-1">
                @include('front.shortcuts.properties.slider-image', ['property' => $item, 'image' => $images[0]])
            </div>
            <div class="lg:w-1/2 md:w-1/2 p-1">
               
                @if($hasYouTube)
                    <div class="flex flex-col">
                        <div class="w-1/2">
                            @include('front.shortcuts.properties.slider-image', ['property' => $item, 'image' => $images[1]])
                        </div>
                        <div class="w-1/2 mt-2">
                            @include('front.shortcuts.properties.youtube-video', ['youtube_video' => $youtube_video])
                        </div>
                    </div>
                @else
                    @include('front.shortcuts.properties.slider-image', ['property' => $item, 'image' => $images[1]])
                @endif
            </div>
        @elseif ($numberImages === 3)
            <div class="lg:w-1/2 md:w-1/2 p-1">
                @include('front.shortcuts.properties.slider-image', ['property' => $item, 'image' => $images[0]])
            </div>
            <div class="lg:w-1/2 md:w-1/2 p-1">
                <div class="flex">
                    <div class="w-1/2 p-1">
                        @include('front.shortcuts.properties.slider-image', ['property' => $item, 'image' => $images[1]])
                    </div>
                    <div class="w-1/2 p-1">
                        @include('front.shortcuts.properties.slider-image', ['property' => $item, 'image' => $images[2]])
                    </div>
                </div>
                @if($hasYouTube)
                    <div class="w-full h-36 mt-2">
                        @include('front.shortcuts.properties.youtube-video', ['youtube_video' => $youtube_video])
                    </div>
                @endif
            </div>
        @else

            <div class="lg:w-1/2 md:w-1/2 p-1">
                
                @include('front.shortcuts.properties.slider-image', ['property' => $item, 'image' => $images[0], 'main' => true,'property_type' => $property_type])
            </div>
            <div class="lg:w-1/2 md:w-1/2 p-1">
                <div class="flex">
                    <div class="w-1/2 p-1">
                        @include('front.shortcuts.properties.slider-image', ['property' => $item, 'image' => $images[1]])
                    </div>
                    <div class="w-1/2 p-1">
                        @include('front.shortcuts.properties.slider-image', [
                            'property' => $item,
                            'image' => $images[2],
                            'mores' => $numberImages > 3 ? $numberImages - 2 : 0,
                        ])
                            
                    </div>
                </div>
                @if($hasYouTube)
                    <div class="w-full h-36 mt-2">
                        @include('front.shortcuts.properties..youtube-video', ['youtube_video' => $youtube_video])
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-1 mt-2">
                        
                        @foreach (array_slice($images, 3, 4) as $keyEx => $image)
                            @if($keyEx < 1)
                                @include('front.shortcuts.properties..slider-image', ['property' => $item, 'image' => $image])
                            @else
                                @include('front.shortcuts.properties..slider-image', [
                                    'property' => $item,
                                    'image' => $image,
                                    'mores' => $numberImages ?? 0,
                                ])
                                @php
                                break;
                                @endphp
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
            @foreach($images as $key => $image)
                @if ($key > 4)
                    @include('front.shortcuts.properties..slider-image', ['property' => $item, 'image' => $image,'hidden' => true])
                @endif
            @endforeach
        @endif
    </div>
</div>
@endif
@endif
<h4 class="mb-2 text-2xl font-bold text-center">Most Desired Locations in <span class="font-italic">Bangalore</span></h4>
<p class="py-2 text-md text-center text-gray-500">Discover the top neighborhoods, hotspots, and sought-after areas in
    Bangalore</p>
<div class="relative flex justify-center my-5 mx-2">
    <div class="relative w-full">
        <!-- Slick Slider Wrapper -->
        <div class="location-slider-item" {{-- data-slick='{
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
                }' --}}>
            <div role="button">
                <div
                    class="overflow-hidden duration-500 ease-in-out bg-white shadow location-item group rounded-xl dark:bg-slate-900 hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 p-2">
                    <div class="relative overflow-hidden rounded-2xl">
                        <a target="_blank" href="{{ url('properties?city=Hebbal') }}">
                            <img loading="lazy" src="{{ asset('images/cities/location-1.jpg') }}" alt="Hebbal">
                            <div class="absolute inset-0 bg-slate-900 bg-opacity-40">
                            </div>
                            <div class="absolute -translate-x-1/2 top-2/3 start-1/2 -translate-y-2/3">
                                <p class="text-xl font-bold text-white">
                                    Hebbal
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div role="button">
                <div
                    class="overflow-hidden duration-500 ease-in-out bg-white shadow location-item group rounded-xl dark:bg-slate-900 hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 p-2">
                    <div class="relative overflow-hidden rounded-2xl">
                        <a target="_blank" href="{{ url('properties?city=Yelahanka') }}">
                            <img loading="lazy" src="{{ asset('images/cities/location-2.jpg') }}" alt="Yelahanka">
                            <div class="absolute inset-0 bg-slate-900 bg-opacity-40">
                            </div>
                            <div class="absolute -translate-x-1/2 top-2/3 start-1/2 -translate-y-2/3">
                                <p class="text-xl font-bold text-white">
                                    Yelahanka</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div role="button">
                <div
                    class="overflow-hidden duration-500 ease-in-out bg-white shadow location-item group rounded-xl dark:bg-slate-900 hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 p-2">
                    <div class="relative overflow-hidden rounded-2xl">
                        <a target="_blank" href="{{ url('properties?city=Thanisandra') }}">
                            <img loading="lazy" src="{{ asset('images/cities/location-3.jpg') }}" alt="Thanisandra">
                            <div class="absolute inset-0 bg-slate-900 bg-opacity-40">
                            </div>
                            <div class="absolute -translate-x-1/2 top-2/3 start-1/2 -translate-y-2/3">
                                <p class="text-xl font-bold text-white">
                                    Thanisandra</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div role="button">
                <div
                    class="overflow-hidden duration-500 ease-in-out bg-white shadow location-item group rounded-xl dark:bg-slate-900 hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 p-2">
                    <div class="relative overflow-hidden rounded-2xl">
                        <a target="_blank" href="{{ url('properties?city=Hennur+Road') }}">
                            <img loading="lazy" src="{{ asset('images/cities/location-4.jpg') }}" alt="Hennur Road">
                            <div class="absolute inset-0 bg-slate-900 bg-opacity-40">
                            </div>
                            <div class="absolute -translate-x-1/2 top-2/3 start-1/2 -translate-y-2/3">
                                <p class="text-xl font-bold text-white">
                                    Hennur
                                    Road</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div role="button">
                <div
                    class="overflow-hidden duration-500 ease-in-out bg-white shadow location-item group rounded-xl dark:bg-slate-900 hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 p-2">
                    <div class="relative overflow-hidden rounded-2xl">
                        <a target="_blank" href="{{ url('properties?city=Devanahalli') }}">
                            <img loading="lazy" src="{{ asset('images/cities/location-5.jpg') }}" alt="Devanahalli">
                            <div class="absolute inset-0 bg-slate-900 bg-opacity-40">
                            </div>
                            <div class="absolute -translate-x-1/2 top-2/3 start-1/2 -translate-y-2/3">
                                <p class="text-xl font-bold text-white">
                                    Devanahalli</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div role="button">
                <div
                    class="overflow-hidden duration-500 ease-in-out bg-white shadow location-item group rounded-xl dark:bg-slate-900 hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 p-2">
                    <div class="relative overflow-hidden rounded-2xl">
                        <a target="_blank" href="{{ url('properties?city=Bagalur') }}">
                            <img loading="lazy" src="{{ asset('images/cities/location-3.jpg') }}" alt="Bagalur">
                            <div class="absolute inset-0 bg-slate-900 bg-opacity-40">
                            </div>
                            <div class="absolute -translate-x-1/2 top-2/3 start-1/2 -translate-y-2/3">
                                <p class="text-xl font-bold text-white">
                                    Bagalur
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('footer')
    <script>
        $('.location-slider-item').slick({
            "autoplay": true,
            "autoplaySpeed": 2000,
            "slidesToScroll": 1,
            "dots": true,
            "infinite": true,
            "slidesToShow": 3,
            "arrows": true,
            "responsive": [{
                    "breakpoint": 1024,
                    "settings": {
                        "slidesToShow": 3
                    }
                },
                {
                    "breakpoint": 768,
                    "settings": {
                        "slidesToShow": 2
                    }
                },
                {
                    "breakpoint": 480,
                    "settings": {
                        "slidesToShow": 1
                    }
                }
            ]
        });
    </script>
@endpush

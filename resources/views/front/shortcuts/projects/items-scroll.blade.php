@if($projects->isNotEmpty())


    <div data-slick='{
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
        @foreach($projects as $project)
            <div role="button" class="p-3 mb-3 mx-3 overflow-hidden duration-500 ease-in-out bg-white shadow property-item group rounded-xl dark:bg-slate-800 hover:shadow-lg dark:shadow-gray-700 dark:hover:shadow-gray-700">
                <div class="relative overflow-hidden">
                    <a target="_blank" href="{{ route('public.project_single', ['uid' => $project->unique_id, 'slug' => $project->slug ]) }}">
                        <img src="{{ asset('images/'.$project->image) }}" alt="{{ $project->name }}" onerror="this.src='/themes/images/dummy-image.webp'" class="h-50 rounded-xl duration-500 ">
                    </a>
                    {{-- <div class="absolute top-6 end-6">
                        <button type="button" class="text-lg text-red-600 bg-white rounded-full shadow btn btn-icon dark:bg-slate-900 dark:shadow-gray-700 add-to-wishlist" aria-label="{{ __('Add to wishlist') }}" data-box-type="project" data-id="{{ $project->id }}">
                            <i class="mdi mdi-heart-outline"></i>
                        </button>
                    </div> --}}
                    @if($project->images && $imagesCount = count($project->images))
                        <div class="absolute top-6 start-6">
                            <div class="flex items-center justify-center p-2 py-1 text-sm text-white bg-gray-700 rounded-lg bg-opacity-30">
                                <i class="mdi mdi-camera-outline me-1"></i>
                                <span>{{ $imagesCount }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="absolute bottom-0 flex text-sm start-4 item-info-wrap">
                        <span class="flex items-center py-1 ps-6 pe-4 text-white">
                            {{ 'Project'}}
                        </span>
                        <span class="label-success status-label text-capitalize">{!! str_replace('_',' ',$project->construction_status) !!}</span>
                    </div>
                </div>
                <div class="p-6">
                    <a target="_blank" href="{{ route('public.project_single', ['uid' => $project->unique_id, 'slug' => $project->slug ]) }}" class="text-md font-bold text-capitalize duration-500 ease-in-out hover:text-primary">
                        {!! $project->name !!}
                    </a>
                    @if($project->city )
                        <p class="truncate text-slate-600 dark:text-slate-300">
                            <i class="mdi mdi-map-marker-outline"></i>
                            {{ $project->location}}{{-- $project->state->name --}}<br>
                            <span class="mdi mdi-map-marker-multiple">{{ $project->city }}.</span>
                        </p>  
                    @endif
                    <div class="flex flex-wrap gap-3 items-center justify-between pt-2 ps-0 mb-0 list-none">
                        @if($project->price_from || $project->price_to)
                            <li>
                                <span class="text-slate-400 d-none">{{ __('Price') }}</span>
                                <p class="text-lg font-semibold">{{ __(':from - :to', ['from' => shorten_price($project->price_from), 'to' => shorten_price($project->price_to)]) }}</p>
                            </li>
                            <li>
                                <a href="/contact" data-id="{{ $project->id }}" data-type="project" class="mt-5 text-white rounded-md bg-primary btn-sm btn hover:bg-secondary popup-contact-modal-form">
                                    <i class="align-middle mdi mdi-phone me-2"></i> Contact us
                                </a>
                            </li>
                        @endif
                       
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="my-16 text-center">
        <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
        </svg>
        <p class="mt-3 text-xl text-gray-500 dark:text-gray-300">{{ __('No projects found.') }}</p>
    </div>
@endif

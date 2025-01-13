@if ($projects->isNotEmpty())
    <div class="row">
        <div class="col-lg-10">
            <div class="row">
                @foreach ($projects as $project)
                    <div class="col-lg-4 mb-3">
                        <div
                            class="overflow-hidden duration-500 ease-in-out bg-white shadow project-item group rounded-xl dark:bg-slate-800 hover:shadow-lg dark:shadow-gray-700 dark:hover:shadow-gray-700">
                            <div class="relative overflow-hidden">
                                <a target="_blank"
                                    href="{{ route('public.project_single', ['uid' => $project->unique_id, 'slug' => $project->slug]) }}">
                                    <img src="{{ asset('images/' . $project->image) }}"
                                        onerror="this.src='/themes/images/dummy-image.webp'" alt="{{ $project->name }}"
                                        class="rounded-md duration-500 h-50 w-100">
                                </a>
                                <div class="absolute top-6 end-6">
                                    <div
                                        class="flex items-center justify-center content-center p-2 pt-2.5 bg-gray-700 rounded-md bg-opacity-60 text-white text-sm">
                                        <i class="leading-none mdi mdi-eye me-1"></i>
                                        <span class="leading-none small">{{ $project->views ?? 0 }}</span>
                                    </div>
                                </div>
                                @if ($project->images && ($imagesCount = count($project->images)))
                                    <div class="absolute top-6 start-6">
                                        <div
                                            class="flex items-center justify-center p-2 py-1 text-sm text-white bg-gray-700 rounded-lg bg-opacity-30">
                                            <i class="mdi mdi-camera-outline me-1"></i>
                                            <span>{{ $imagesCount }}</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="absolute bottom-0 flex text-sm start-4 item-info-wrap">
                                    <span class="flex items-center py-1 ps-6 pe-4 text-white">
                                        {{ 'Project' }}
                                    </span>
                                    <span
                                        class="label-success status-label text-capitalize">{!! str_replace('_', ' ', $project->construction_status) !!}</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <a target="_blank"
                                    href="{{ route('public.project_single', ['uid' => $project->unique_id, 'slug' => $project->slug]) }}"
                                    class="text-md font-bold text-capitaize duration-500 ease-in-out hover:text-primary truncate">
                                    {!! $project->name !!}
                                </a>
                                @if ($project->city)
                                    <p class="truncate text-slate-600 dark:text-slate-300 text-sm">
                                        <i class="mdi mdi-map-marker-outline"></i>
                                        {{ $project->location }}{{-- $project->state->name --}}<br>
                                        <span class="ps-4">{{ $project->city }}.</span>
                                    </p>
                                @endif
                                <div class="flex flex-column flex-wrap gap-3  justify-between pt-4 ps-0 mb-0 list-none">
                                    @if ($project->price_from || $project->price_to)
                                        <li>
                                            <span class="text-slate-400 text-sm">{{ __('Price') }}</span>
                                            <p class="text-lg font-semibold">
                                                {{ __(':from - :to', ['from' => shorten_price($project->price_from), 'to' => shorten_price($project->price_to)]) }}
                                            </p>
                                        </li>
                                        
                                        <li>
                                            <a href="/contact" data-id="{{ $project->id }}" data-type="project"
                                                class="mt-5 text-white rounded-md bg-primary btn-sm btn hover:bg-secondary popup-contact-modal-form">
                                                <i class="align-middle mdi mdi-phone me-2"></i> Contact us
                                            </a>
                                        </li>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('user.properties.create') }}" target="_blank">
                        <div class="box">
                            <div class="px-1.5 bg-gray-300 py-4 rounded">
                                <h1 class="fw-bold  text-center text-dark  ">
                                    Sell/Rent your Property with us for Free
                                </h1>
                            </div>
                            <div class="py-4 ">
                                <button
                                    class="text-white rounded-full btn bg-primary hover:bg-secondary border-primary dark:border-primary post-property fs-6">Post
                                    Property</button>
                            </div>


                            <h6 class=" fw-bold fs-16 ">Here's why Our Portal:</h6>
                            <ul class="py-4">
                                <li class="fs-13 mb-2">
                                    Get Access to 4 Lakh + Buyers
                                </li>
                                <li class="fs-13 mb-2">
                                    Sell Faster with Premium Service
                                </li>
                                <li class="fs-13 mb-2">
                                    Find only Genuine Leads
                                </li>
                                <li class="fs-13 mb-2">
                                    Get Expert advice on Market Trends & insights
                                </li>
                            </ul>

                        </div>
                    </a>


                </div>
            </div>
            {{-- advertisement --}}
            
        

            @include('front.shortcuts.projects.advertisement',compact('projects'))

        </div>
    </div>
@else
    <div class="my-16 text-center">
        <svg class="mx-auto h-24 w-24 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
        </svg>
        <p class="mt-3 text-xl text-gray-500 dark:text-gray-300">{{ __('No projects found.') }}</p>
    </div>
@endif

@extends('layouts.app')

@php
 
    $unit_variation = $project->configration->where('name', 'Unit Variants')->first();
    $towers_and_blocks = $project->configration->where('name', 'Towers and Blocks')->first();
@endphp

@section('content')
    <section class="relative mt-36">
        <div class="container" data-property-id="{{ $project->id }}" x-data="scrollSpy()" x-init="init()">
            @include('front.shortcuts.properties.slider', [
               'item' => $project,'youtube_video' => $project->youtube_video_url,'property_type' => 'project'])
            <div class="container-fluid ">
                <div class="md:flex">
                    <div class="w-full p-1 ">
                        <div class="border-theme rounded-b-xl border-top-0">
                            <div class="px-5 py-5">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="px-3 col-lg-9 ">
                                            <div class=" align-items-top">
                                                <div class="px-3 col-lg-12 mt-3 md:flex flex-column">
                                                    <span class="fw-bold fs-1 text-theme">
                                                        @if ($project->price_from || $project->price_to)
                                                            {{ __(':from - :to', ['from' => shorten_price($project->price_from), 'to' => shorten_price($project->price_to)]) }}
                                                        @endif
                                                    </span>
                                                    <span class="mt-2 fs-6">Developed by
                                                        {{ $project->investor->name }}</span>
                                                </div>
                                                <div class="px-3 col-lg-12 md:flex flex-column">
                                                    <div class="flex flex-column flex-column">

                                                        <div class=" mt-2">
                                                            @if ($project)
                                                                <p class="d-inline fw-bolder me-2  text-base text-theme">
                                                                    {{ $project->name }}
                                                                </p>
                                                            @endif
                                                            @if ($project->city)
                                                                <p
                                                                    class="d-inline fw-bolder me-2 text-base text-theme text-capitalize border-2  border-end-0 border-top-0 border-bottom-0 ps-2">
                                                                    {{ $project->locality . ', ' . $project->city }}
                                                                </p>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="p-3">
                                                        <span
                                                            class="fw-bold">{{ isset($unit_variation) ? $unit_variation->distance : '--' }}</span>
                                                        <span
                                                            class="fw-bold ms-3 text-capitalize">{{ str_replace('_', ' ', $project->construction_status) }}</span>
                                                    </div>
                                                </div>

                                                <div class="px-3  ">
                                                    <div class="border-theme rounded flex " style="width: fit-content;">
                                                        <span
                                                            class="text-light text-sm  bg-theme font-medium  inline  dark:text-white text-uppercase px-2">RERA
                                                            STATUS</span>
                                                        <span
                                                            class="text-theme text-sm   inline  dark:text-white text-uppercase border-2  border-end-0 border-top-0 border-bottom-0 px-2">{{ $project->rera_status }}</span>
                                                        <span
                                                            class="text-theme text-sm font-medium  inline  dark:text-white text-capitalize border-2  border-end-0 border-top-0 border-bottom-0 px-2">Registration
                                                            No: {{ $project->rera_reg_no }}</span>
                                                    </div>
                                                </div>
                                                <div class="px-3 mt-8">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#BookingModal" 
                                                        class=" text-theme btn btn-sm bg-trasparent border-theme">
                                                        <i class="mdi mdi-download me-2"></i>
                                                        {{ __('Download Brochure') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end col-lg-3">
                                            <span class="text-sm">Posted on
                                                {{ date('M d, Y', strtotime($project->created_at)) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jump-header sticky top-0 z-999">
                <ul class="flex-wrap justify-left inline-block w-full p-4 py-10 text-left bg-white border-b rounded-t-xl dark:border-gray-800 mb-0 dark:bg-slate-900 overflow-x-auto whitespace-nowrap cursor-grab"
                    x-data="{ isDragging: false, startX: 0, scrollLeft: 0 }"
                    x-on:mousedown="isDragging = true; startX = $event.pageX - $el.offsetLeft; scrollLeft = $el.scrollLeft;"
                    x-on:mousemove="if (isDragging) { $el.scrollLeft = scrollLeft - ($event.pageX - startX); }"
                    x-on:mouseup="isDragging = false" x-on:mouseleave="isDragging = false" id="searchTab"
                    data-tabs-toggle="#search-filter" role="tablist" id="searchTab" data-tabs-toggle="#search-filter"
                    role="tablist">
                    @if ($project->content)
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('About')" :class="{ 'tab-active': activeTab === 'About' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out rounded-md hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800 tab-active"
                                id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about"
                                aria-selected="false">
                                About
                            </button>
                        </li>
                    @endif
                    @if ($project->configration->count())
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('Configuration')"
                                :class="{ 'tab-active': activeTab === 'Configuration' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out rounded-md hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="configuration-tab" data-tabs-target="#configuration" type="button" role="tab"
                                aria-controls="configuration" aria-selected="true">
                                Configuration
                            </button>
                        </li>
                    @endif
                    @if ($project->priceVariations->count())
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('Price')" :class="{ 'tab-active': activeTab === 'Price' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="price-tab" data-tabs-target="#price" type="button" role="tab" aria-controls="price"
                                aria-selected="false">
                                Price
                            </button>
                        </li>
                    @endif
                    @if ($project->features->count())
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('Ameneties')"
                                :class="{ 'tab-active': activeTab === 'Ameneties' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="ameneties-tab" data-tabs-target="#amenetiesDetails" type="button" role="tab"
                                aria-controls="amenetiesDetails" aria-selected="false">
                                Ameneties
                            </button>
                        </li>
                    @endif
                    @if ($project->master_plan_images)
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('Master_Floor_Plans')"
                                :class="{ 'tab-active': activeTab === 'Master_Floor_Plans' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="master_floor_plans" data-tabs-target="#master_floor_plans" type="button"
                                role="tab" aria-controls="Master_Floor_Plans" aria-selected="false">
                                Master & Floor Plans
                            </button>
                        </li>
                    @endif
                    @if ($project->specifications->count())
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('Specifications')"
                                :class="{ 'tab-active': activeTab === 'Specifications' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="specifications-tab" data-tabs-target="#specificationsDetails" type="button"
                                role="tab" aria-controls="specificationsDetails" aria-selected="false">
                                Specifications
                            </button>
                        </li>
                    @endif
                    @if ($project->latitude && $project->longitude)
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('Location')"
                                :class="{ 'tab-active': activeTab === 'location' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="location-tab" data-tabs-target="#locationDetails" type="button" role="tab"
                                aria-controls="locationDetails" aria-selected="false">
                                Location
                            </button>
                        </li>
                    @endif
                    @if ($project->facilities->count())
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('Landmarks')"
                                :class="{ 'tab-active': activeTab === 'Landmarks' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="landmarks-tab" data-tabs-target="#landmarkssDetails" type="button" role="tab"
                                aria-controls="landmarkssDetails" aria-selected="false">
                                Landmarks
                            </button>
                        </li>
                    @endif
                    @if ($project->investor)
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('AboutDeveloper')"
                                :class="{ 'tab-active': activeTab === 'AboutDeveloper' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="about_developer-tab" data-tabs-target="#about_developer" type="button"
                                role="tab" aria-controls="about_developer" aria-selected="false">
                                About Developer
                            </button>
                        </li>
                    @endif
                </ul>
            </div>




            <div class="">
                <div class=" mt-4">
                    <div class="md:flex">
                        <div class=" lg:w-2/3 md:w-1/2 ">
                            @if ($project->content)
                                <div class="container-fluid mb-5" id="About" class="section"
                                    :class="{ 'active': activeSection === 'About' }">
                                    <div class="">
                                        <div class="w-full p-1 pb-5">
                                            <div class="border-theme rounded-xxl">
                                                <div class="px-5 py-5">
                                                    <h4 class="fs-4 font-bold me-2 text-theme">About {{ $project->name }}
                                                    </h4>
                                                    <div class="md:flex">
                                                        <div class="px-3 col-lg-12 md:p-4">
                                                            <div class="text-slate-600 ck-content dark:text-gray-200 mt-2">
                                                                {!! $project->content !!}
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="px-3 mt-8">
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#BookingModal" 
                                                            class="text-sm text-white btn bg-primary">{{ __('Get Phone Number') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($project->youtube_video_url != null || $project->youtube_video_url != '')
                                            <div class="w-full p-1 mb-5">
                                                <div class="border-theme rounded-xl">
                                                    <div class="px-5 py-5">
                                                        <h4 class="fs-4 font-bold me-2 text-theme mb-3">Project Video</h4>
                                                        <iframe width="100%" height="315"
                                                            src="https://www.youtube.com/embed/{{ $project->youtube_video_url }}"
                                                            title="YouTube video player" frameborder="0"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                            referrerpolicy="strict-origin-when-cross-origin"
                                                            allowfullscreen></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if ($project->configration->count())
                                <div class="container-fluid mb-5" id="Configuration" class="section"
                                    :class="{ 'active': activeSection === 'Configuration' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-5 py-5">
                                                    <h4 class="fs-4 font-bold me-2 text-theme">Configuration</h4>
                                                    <div class="table-responsive mt-4">
                                                        <table class="table table-bordered border-xl border-2">
                                                            @foreach ($configrations as $listingConfig)
                                                                @if ($option = $project->configration->where('name', $listingConfig->name)->first()->pivot)
                                                                    <tr class="border-bottom-none">
                                                                        <td class="text-gray-800 text-center p-3">
                                                                            <div
                                                                                class="w-100 text-center flex justify-center">
                                                                                <img
                                                                                    src="{{ asset('images/'.$listingConfig->image->url) }}">
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-gray-800 text-center">
                                                                            <span
                                                                                class="text-sm dark:text-white">{{ $listingConfig->name }}</span>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <span
                                                                                class="text-sm dark:text-white">{{ $option->distance ?? '--' }}</span>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($project->priceVariations->count())
                                <div class="container-fluid mb-5" id="Price" class="section"
                                    :class="{ 'active': activeSection === 'Price' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-5 py-5">
                                                    <h4 class="fs-4 font-bold me-2 text-theme">Price</h4>
                                                    <div class="table-responsive mt-4">
                                                        <table class="table table-bordered border-4 border-2">
                                                            <thead class="bg-secondary text-white">
                                                                <th class="text-center">
                                                                    Unit Type
                                                                </th>
                                                                <th class="text-center">
                                                                    Size in Sq.ft
                                                                </th>
                                                                <th class="text-center">
                                                                    Approx. Price (all Inclusive)
                                                                </th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($project->priceVariations as $variUnit)
                                                                    <tr class="border-bottom-none">
                                                                        <td class="text-gray-800 text-center">
                                                                            <span
                                                                                class="text-sm dark:text-white">{{ $variUnit->unit_type }}</span>
                                                                        </td>
                                                                        <td class="text-gray-800 text-center">
                                                                            <span
                                                                                class="text-sm dark:text-white">{{ $variUnit->size }}</span>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <span
                                                                                class="text-sm dark:text-white">{{ $variUnit->price }}</span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            @if ($project->features->count())
                                <div class="container-fluid mb-5" id="Ameneties" class="section"
                                    :class="{ 'active': activeSection === 'Ameneties' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-3 py-5">
                                                    <h4 class="fs-5 text-theme font-bold me-2 mb-3">Ameneties </h4>
                                                    <div class="px-3">
                                                        <div class="row align-items-center">
                                                            @foreach ($project->features ?? [] as $featureItem)
                                                                <div class="col-lg-3 d-flex align-items-center">
                                                                    <img class="rounded-xl w-6 w-1/2 h-6"
                                                                        src="{{ $featureItem->image_url }}">
                                                                    <div class="p-3">
                                                                        <span
                                                                            class="text-sm">{{ $featureItem->name }}</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($project->master_plan_images)
                                <div class="container-fluid mb-5" id="Master_Floor_Plans" class="section"
                                    :class="{ 'active': activeSection === 'Master_Floor_Plans' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-3 py-5">
                                                    <h4 class="fs-5 text-theme font-bold me-2 mb-3">Master & Floor Plans
                                                    </h4>
                                                    <div
                                                        data-slick='{
                                            "slidesToShow": 2,
                                            "slidesToScroll": 1,
                                            "arrows": true,
                                            "dots": false,
                                            "loop":true,
                                            "infinite": true,
                                            "responsive": [
                                                {"breakpoint": 1024, "settings": {"slidesToShow": 3}},
                                                {"breakpoint": 768, "settings": {"slidesToShow": 2}},
                                                {"breakpoint": 480, "settings": {"slidesToShow": 1}}
                                            ]
                                        }'>
                                                        @foreach ($project->master_plan_images as $master_image)
                                                            @if ($master_image != null || $master_image != '')
                                                                <div class="p-2" role="button">
                                                                    <img src="{{ asset('images/'.$master_image) }}"
                                                                        class="w-100">
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($project->specifications->count())
                                <div class="container-fluid mb-5" id="Specifications" class="section"
                                    :class="{ 'active': activeSection === 'Specifications' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-5 py-5">
                                                    <h4 class="fs-4 font-bold me-2 text-theme">Specifications</h4>
                                                    <div class="table-responsive mt-4">
                                                        <table class="table table-bordered border-4 border-2">
                                                            @foreach ($project->specifications ?? [] as $spec)
                                                                <tr class="border-bottom-none">
                                                                    <td
                                                                        class="text-gray-800 text-center w-20 flex justify-content-center items-center">
                                                                        <img src="{{ asset('images/'.$spec->image) }}"
                                                                            class="w-48 text-center rounded-2 h-10 mt-2">
                                                                    </td>
                                                                    <td class="text-gray-800 text-left p-2">
                                                                        <span
                                                                            class="text-sm dark:text-white">{{ $spec->description }}</span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($project->construction_status != 'new_launch')
                                <div class="container-fluid mb-5">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-5 py-5">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="card border-0 text-center">
                                                                <div
                                                                    class="flex flex-col justify-center items-center border-3 border-bottom-0 border-top-0 border-start-0">
                                                                    <img class="w-10 mb-2"
                                                                        src="{{ asset('assets/icons/For-Sale.gif') }}"
                                                                        alt="Project Location">
                                                                    <span
                                                                        class="text-medium font-bold ">{{ $project->resale_properties }}
                                                                        Resale</span>
                                                                    <span
                                                                        class="text-sm text-gray-500 text-decoration-underline">
                                                                        Properties in this project</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="card border-0 text-center">
                                                                <div class="flex flex-col justify-center items-center">
                                                                    <img class="w-10 mb-2"
                                                                        src="{{ asset('assets/icons/For-Rent.gif') }}"
                                                                        alt="Project Location">
                                                                    <span
                                                                        class="text-medium font-bold ">{{ $project->rent_properties }}
                                                                        Rental</span>
                                                                    <span
                                                                        class="text-sm text-gray-500 text-decoration-underline">
                                                                        Properties in this project</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($project->latitude && $project->longitude)
                                <div class="container-fluid mb-5" id="Location" class="section"
                                    :class="{ 'active': activeSection === 'Location' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-3 py-5">
                                                    <h4 class="fs-4 font-bold me-2">{{ __('Location') }}
                                                    </h4>
                                                </div>
                                                <div class="box-map property-street-map-container">
                                                    <div class="property-street-map"
                                                        data-popup-id="#street-map-popup-template"
                                                        data-center="{{ json_encode([$project->latitude, $project->longitude]) }}"
                                                        data-map-icon="{{ $project->type }}: {{ __(':from - :to', ['from' => shorten_price($project->price_from), 'to' => shorten_price($project->price_to)]) }}"
                                                        style="height: 300px;">
                                                        <div class="hidden property-template-popup-map">
                                                            <table width="100%">
                                                                <tr class="border-bottom-none">
                                                                    <td width="90">
                                                                        <div class="blii"><img
                                                                                src="{{ $project->image_thumb }}"
                                                                                width="80"
                                                                                alt="{{ $project->name }}">
                                                                            <div class="status">{!! $project->mode !!}
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="infomarker text-start">
                                                                            <h5><a href="{{ $project->url }}"
                                                                                    target="_blank">{!! $project->name !!}</a>
                                                                            </h5>
                                                                            <div class="text-info">
                                                                                <strong>{{ __(':from - :to', ['from' => shorten_price($project->price_from), 'to' => shorten_price($project->price_to)]) }}</strong>
                                                                            </div>
                                                                            <div>{{ $project->location }}</div>
                                                                            <div class="ltr:flex">
                                                                                <span>
                                                                                    {{ $project->square_text }}</span>
                                                                                <span class="px-2">
                                                                                    <i
                                                                                        class="mdi mdi-home-silo-outline"></i>
                                                                                    <i>{{ isset($towers_and_blocks) ? $towers_and_blocks->distance : '--' }}</i>
                                                                                </span>
                                                                                <span>
                                                                                    <i class="mdi mdi-home-switch"></i>
                                                                                    <i>{{ isset($unit_variation) ? $unit_variation->distance : '--' }}</i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($project->facilities->groupBy('name')->count())
                                <div class="container-fluid mb-5" id="Landmarks" class="section"
                                    :class="{ 'active': activeSection === 'Landmarks' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1">
                                            <div class="border-theme rounded-xl px-3 py-5">

                                                <div class="mb-5">
                                                    <h4 class="fs-5 text-dark dark:text-white font-bold me-2">
                                                        {{ __('Landmarks Near ') . $project->name }}
                                                    </h4>
                                                </div>

                                                <div class="grid gap-4 lg:grid-cols-2 sm:grid-cols-1 dark:bg-black-900">
                                                    @foreach ($project->facilities->groupBy('name') ?? [] as $key => $facilities)
                                                        <div class="dark:bg-slate-900 border-theme rounded-lg shadow-lg" role="button"
                                                            x-data="{ expanded: false }" @mouseenter="expanded = true"
                                                            @mouseleave="expanded = false">
                                                            <div class="flex items-start justify-content-between p-3">
                                                                <span class="fw-bold">{{ $key }}</span>
                                                                <span>
                                                                    <img src="{{ $facilities->pluck('image_url')->first() }}"
                                                                        alt="{{ $key }}"
                                                                        style="vertical-align: top; margin-top: 3px;"
                                                                        width="18" height="18">
                                                                </span>
                                                            </div>

                                                            <!-- List of Facilities -->
                                                            <ul class="p-2">
                                                                @foreach ($facilities ?? [] as $index => $facility)
                                                                    <li class="facility_listing"
                                                                        x-show="expanded || {{ $index }} < 2">
                                                                        <p class="text-wrap">
                                                                            {{ $facility->pivot->distance }}
                                                                        </p>
                                                                    </li>
                                                                @endforeach
                                                            </ul>

                                                            <!-- Read More Indicator (Optional) -->
                                                            @if ($facilities->count() > 2)
                                                                <div class="p-2 text-end text-sm text-theme">
                                                                    <span class="text-blue-500">
                                                                        <span x-show="!expanded"
                                                                            x-cloak>{{ '+' . ($facilities->count() - 2) . __('More') }}</span>
                                                                        <span x-show="expanded"
                                                                            x-cloak>{{ __('Hide') }}</span>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($project->content)
                                <div class="container-fluid mb-5" id="AboutDeveloper" class="section"
                                    :class="{ 'active': activeSection === 'AboutDeveloper' }">
                                    <div class="md:flex">

                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="mx-3 mt-10 mb-5">
                                                    <h4 class="fs-4 font-bold me-2 text-theme  ">About the Builder -
                                                        {{ $project->investor->name }}</h4>
                                                    <div class="">
                                                        <div class="px-3 col-lg-12 md:p-4">
                                                            <div class="text-slate-600 ck-content dark:text-gray-200 mt-2">
                                                                {!! $project->investor->content !!}
                                                            </div>
                                                            <div class="row justify-content-center mt-5">
                                                                <div class="col-lg-3">
                                                                    <div
                                                                        class="card rounded-x text-center py-2 border-theme dark:bg-slate-900 rounded-lg shadow-lg">
                                                                        <span class="fw-bold fs-5">Ongoing</span>
                                                                        <span
                                                                            class="mt-1">{{ $project->investor->ongoing > 0 ? $project->investor->ongoing : 0 }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div
                                                                        class="card rounded-x text-center py-2 border-theme dark:bg-slate-900 rounded-lg shadow-lg">
                                                                        <span class="fw-bold fs-5">Completed</span>
                                                                        <span
                                                                            class="mt-1">{{ $project->investor->completed ? $project->investor->completed : 0 }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div
                                                                        class="card rounded-x text-center py-2 border-theme dark:bg-slate-900 rounded-lg shadow-lg">
                                                                        <span class="fw-bold fs-5">Total</span>
                                                                        <span
                                                                            class="mt-1">{{ (int) $project->investor->ongoing + (int) $project->investor->completed }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif

                        </div>
                        <div class=" mt-8 lg:w-1/3 md:w-1/2 md:p-4 md:mt-0">
                            <div class="sticky top-1/4" style="z-index:99">
                                <div class="mb-2 rounded-2xl shadow bg-theme dark:bg-slate-800 dark:shadow-gray-700">
                                    @include('front.shortcuts.consult-form', ['type' => 'project', 'data' => $project])
                                </div>
                                <div class="mt-4">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#BookingModal"  class="w-full py-4 text-white btn bg-primary fs-5"><i
                                            class="mdi mdi-download me-2"></i> {{ __('Download Brochure') }}</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @if ($advertisement && $project->construction_status == 'new_launch')
                    <div x-data="{ showModal: true }" class="z-999" x-init="document.body.style.overflow = 'hidden'">
                        <!-- Modal Background -->
                        <template x-if="showModal">
                            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 z-999">
                                <!-- Modal Content -->
                                <div class="relative bg-white rounded-lg shadow-lg p-0"
                                    style="width: 500px; height: 350px;">
                                    <!-- Advertisement Image -->
                                
                                    <img src="{{ asset('images/'.$advertisement->image) }}" alt="Advertisement" 
                                        class="w-full h-full  rounded-lg"> 
                                    <!-- Close Button -->
                                    <button @click="showModal = false; document.body.style.overflow = 'auto'"
                                        class="absolute top-0 end-0 text-white bg-theme bg-opacity-75 rounded-full p-2 hover:bg-opacity-100 focus:outline-none">
                                        ✕
                                    </button>
                                </div>
                            </div>
                        </template>

                        <!-- Optional Button to Show Modal Again -->
                        <button @click="showModal = true; document.body.style.overflow = 'hidden'"
                            class="fixed top-4 right-4 bg-blue-600 text-white px-4 py-2 rounded shadow">
                            Show Advertisement
                        </button>
                    </div>
                @endif
            </div>
    </section>
@endsection

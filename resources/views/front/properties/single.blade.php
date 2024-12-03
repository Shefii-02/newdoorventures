@extends('layouts.app')

@section('content')

    <section class="relative  content" data-property-id="{{ $property->id }}" x-data="scrollSpy()" x-init="init()">
        <div class="bg-white jump-header sticky z-999 top-0 mt-28 dark:bg-dark dark:text-white">
            <div class="container">
                <div class=" row">
                    <div class="px-3 col-lg-9">
                        <div class="row pt-5 align-items-top">

                            <div class="px-3 col-lg-3 mt-5 md:p-4 md:flex flex-column">
                                <span class="fw-bold fs-2 text-theme">
                                    {{ shorten_price($property->price) }}
                                </span>
                                <span class="mt-2 fs-5">{{ $property->square_text }}</span>
                            </div>
                            <div class="px-3 col-lg-8 md:p-4 md:flex flex-column">
                                <div class="flex flex-column flex-column">
                                    <h4 class="fs-4 d-inline  font-bold me-2">{{ $property->name }}
                                        <span
                                            class="fs-4 d-inline font-bold text-capitalize text-theme border-5 border-gray-300 border-end-0 border-top-0 border-bottom-0 ps-2">
                                            For {{ $property->type }}</span>
                                        <div class=" mt-2">

                                            @if ($property->project)
                                                <p class="d-inline fw-bolder me-2  text-base text-theme">
                                                    {{ $property->project->name }}
                                                </p>
                                            @endif
                                            @if ($property->city || $property->state->name)
                                                <p
                                                    class="d-inline fw-bolder me-2 text-base text-theme text-capitalize border-2  border-end-0 border-top-0 border-bottom-0 ps-2">
                                                    {{ $property->city }}{{ $property->city ? ', ' : '' }}{{ $property->locality }}
                                                </p>
                                            @endif

                                        </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="px-3 mt-8 col-lg-3">
                        <span class="">Posted on {{ date('M d, Y', strtotime($property->created_at)) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-2">

            <div class="px-3  ">
                <div class="border-theme rounded flex  py-1" style="width: fit-content;">
                    <span
                        class="text-dark font-medium text-sm  inline  dark:text-gray-400 text-capitalize px-2">{{ $property->number_bedroom }}
                        Beds</span>
                    <span
                        class="text-dark font-medium  text-sm inline  dark:text-gray-400 text-capitalize border-2  border-end-0 border-top-0 border-bottom-0 px-2">{{ $property->number_bathroom }}
                        Baths</span>
                    <span
                        class="text-dark font-medium  text-sm  inline  dark:text-gray-400 text-capitalize border-2  border-end-0 border-top-0 border-bottom-0 px-2">{{ $property->balconies }}
                        Balconies</span>
                    <span
                        class="text-dark font-medium text-sm  inline  dark:text-gray-400 text-capitalize border-2  border-end-0 border-top-0 border-bottom-0 px-2">{{ $property->covered_parking }}
                        Covered Parking</span>
                </div>
            </div>
            <div class="px-3  mt-4">
                <div class="border-theme rounded flex " style="width: fit-content;">
                    <span
                        class="text-light text-sm  bg-theme font-medium  inline  dark:text-gray-400 text-uppercase px-2">RERA
                        STATUS</span>
                    <span
                        class="text-theme text-sm   inline  dark:text-gray-400 text-uppercase border-2  border-end-0 border-top-0 border-bottom-0 px-2">{{ $property->project->rera_status }}</span>
                    <span
                        class="text-theme text-sm font-medium  inline  dark:text-gray-400 text-capitalize border-2  border-end-0 border-top-0 border-bottom-0 px-2">Registration
                        No: {{ $property->project->rera_reg_no }}</span>
                    <span
                        class="text-theme text-sm   inline  dark:text-gray-400  border-2  border-end-0 border-top-0 border-bottom-0 px-2">Website:
                        <a href="https://rera.karnataka.gov.in/">https://rera.karnataka.gov.in</a></span>
                </div>
            </div>



            <div id="Overview" class="section" :class="{ 'active': activeSection === 'Overview' }">
                @include('front.shortcuts.properties.slider', [
                    'item' => $property,
                    'youtube_video' => '',
                    'property_type' => 'property',
                ])
                <div class="container-fluid ">
                    <div class="md:flex">
                        <div class="w-full p-1 ">
                            <div class="border-theme rounded-b-xl border-top-0">
                                <div class="px-5 py-5">
                                    <div class="md:flex">
                                        <div class="px-3 col-lg-12 md:p-4">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="flex flex-column">
                                                        <h4 class="fw-bold">Carpet Area {{ $property->carpet_area ?? 0 }}
                                                            sqft</h4>
                                                        <span>₹{{ $property->price / ($property->square > 0 ? $property->square : 1) }}/sqft</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="flex flex-column">
                                                        <h4 class="fw-bold">Developer</h4>
                                                        <span>{{ $property->project->investor->name }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="flex flex-column">
                                                        <h4 class="fw-bold">Project</h4>
                                                        <span>{{ $property->project->name }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="flex flex-column">
                                                        <h4 class="fw-bold">Floor</h4>
                                                        <span>{{ $property->available_floor }} (Out of
                                                            {{ $property->number_floor }} Floors)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-8">
                                                <div class="col-lg-3">
                                                    <div class="flex flex-column">
                                                        <h4 class="fw-bold">Transaction Type</h4>
                                                        <span class="text-capitalize">{{ $property->type }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="flex flex-column">
                                                        <h4 class="fw-bold">Status</h4>
                                                        <span
                                                            class="text-capitalize">{{ str_replace('_', ' ', $property->construction_status) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="flex flex-column">
                                                        <h4 class="fw-bold">Open parking</h4>
                                                        <span>{{ $property->open_parking }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="flex flex-column">
                                                        <h4 class="fw-bold">Closed parking</h4>
                                                        <span>{{ $property->covered_parking }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="px-3 mt-8">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#BookingModal"
                                            class=" text-white btn bg-primary">{{ __('Get Phone Number') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="jump-header sticky top-34 z-1">
                <ul class="flex-wrap justify-left inline-block w-full p-4  text-left bg-white border-b rounded-t-xl dark:border-gray-800 mb-0 dark:bg-slate-900 overflow-x-auto whitespace-nowrap cursor-grab"
                    x-data="{ isDragging: false, startX: 0, scrollLeft: 0 }"
                    x-on:mousedown="isDragging = true; startX = $event.pageX - $el.offsetLeft; scrollLeft = $el.scrollLeft;"
                    x-on:mousemove="if (isDragging) { $el.scrollLeft = scrollLeft - ($event.pageX - startX); }"
                    x-on:mouseup="isDragging = false" x-on:mouseleave="isDragging = false" id="searchTab"
                    data-tabs-toggle="#search-filter" role="tablist" id="searchTab" data-tabs-toggle="#search-filter"
                    role="tablist">

                    <li role="presentation" class="inline-block">
                        <button @click="scrollToSection('Overview')" :class="{ 'tab-active': activeTab === 'Overview' }"
                            class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out rounded-md hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800 tab-active"
                            id="overview-tab" data-tabs-target="#overview" type="button" role="tab"
                            aria-controls="overview" aria-selected="false">
                            Overview
                        </button>
                    </li>

                    <li role="presentation" class="inline-block">
                        <button @click="scrollToSection('MoreDetails')"
                            :class="{ 'tab-active': activeTab === 'MoreDetails' }"
                            class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out rounded-md hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                            id="moredetails-tab" data-tabs-target="#moredetails" type="button" role="tab"
                            aria-controls="moredetails" aria-selected="true">
                            More Details
                        </button>
                    </li>
                    @if ($property->project_id && ($project = $property->project))
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('AboutProject')"
                                :class="{ 'tab-active': activeTab === 'AboutProject' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="aboutproject-tab" data-tabs-target="#aboutproject" type="button" role="tab"
                                aria-controls="aboutproject" aria-selected="false">
                                About Project
                            </button>
                        </li>
                    @endif
                    @if ($property->furnishing->count() > 0)
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('FurnishingDetails')"
                                :class="{ 'tab-active': activeTab === 'FurnishingDetails' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="FurnishingDetails-tab" data-tabs-target="#FurnishingDetails" type="button"
                                role="tab" aria-controls="FurnishingDetails" aria-selected="false">
                                Furnishing Details
                            </button>
                        </li>
                    @endif

                    @if ($property->features->count())
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('Ameneties')"
                                :class="{ 'tab-active': activeTab === 'Ameneties' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="Ameneties-tab" data-tabs-target="#Ameneties" type="button" role="tab"
                                aria-controls="Ameneties" aria-selected="false">
                                Ameneties
                            </button>
                        </li>
                    @endif

                    @if ($property->facilities->count())
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

                    @if ($property->latitude && $property->longitude)
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

                </ul>
            </div>
            <div class="">
                <div class=" mt-4">
                    <div class="md:flex">
                        <div class=" lg:w-2/3 md:w-1/2 ">
                            @if ($property->customFields->count())
                                <div class="container-fluid mb-5" id="MoreDetails" class="section"
                                    :class="{ 'active': activeSection === 'MoreDetails' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-5 py-5">
                                                    <h4 class="fs-5 font-bold me-2">More Details</h4>
                                                    <div class="table-responsive mt-4">
                                                        <table class="table ">

                                                            @foreach ($property->customFields as $customValue)
                                                                <tr class="border-bottom-none">
                                                                    <td class="text-gray-800 w-1/2">
                                                                        {{ $customValue->name }}
                                                                    </td>
                                                                    <th>
                                                                        {{ $customValue->value }}
                                                                    </th>
                                                                </tr>
                                                            @endforeach

                                                        </table>
                                                        <div class="px-3 mt-8">
                                                            <span>
                                                                <span class="fw-bold">Description : </span>
                                                                {!! $property->content !!}
                                                            </span>
                                                        </div>
                                                        <a href=""
                                                            class=" text-white btn bg-primary mt-10">{{ __('Get Phone Number') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($property->project_id && ($project = $property->project))
                                <div class="container-fluid mb-5" id="AboutProject" class="section"
                                    :class="{ 'active': activeSection === 'AboutProject' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-3 py-5">
                                                    <h4 class="fs-5 font-bold me-2">About Project </h4>
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-4 d-flex align-items-center">
                                                            <img class="rounded-xl w-30 w-1/2 h-16"
                                                                src="{{ asset('images/' . $property->project->image) }}">
                                                            <div class="p-3 ">
                                                                <span
                                                                    class="fw-bold text-sm">{{ $property->project->name }}</span>
                                                                <span class="text-sm">by
                                                                    {{ $property->project->investor->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class=" flex flex-column">
                                                                <span class="small text-gray-400 fw-bold">Price</span>
                                                                <span
                                                                    class="text-sm">{{ shorten_price($property->project->price_from) }}
                                                                    Onwards</span>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-lg-2 border-2  border-end-0 border-top-0 border-bottom-0 ">
                                                            <div class=" flex flex-column">
                                                                <span class="text-sm text-gray-400 fw-bold">Price per sqft
                                                                </span>
                                                                <span class="text-sm">₹
                                                                    {{ shorten_price($property->project->price_from / ($property->project->square > 0 ? $property->project->square : 1)) }}
                                                                    -
                                                                    {{ shorten_price($property->project->price_to / ($property->project->square > 0 ? $property->project->square : 1)) }}</span>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-lg-2 border-2  border-end-0 border-top-0 border-bottom-0 ">
                                                            <div class=" flex flex-column">
                                                                <span
                                                                    class="text-sm text-gray-400 fw-bold">Configuration</span>
                                                                <span>{{ $property->project->configration_text ?? '--' }}</span>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-lg-2 border-2  border-end-0 border-top-0 border-bottom-0">
                                                            <div class=" flex flex-column">
                                                                <span class="small text-gray-400 fw-bold">Tower & Unit
                                                                </span>
                                                                <span class="text-sm">{{ $property->project->tower }}
                                                                    Towers,
                                                                    {{ $property->project->unit }} Units</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($property->furnishing->count() > 0)
                                <div class="container-fluid mb-5" id="FurnishingDetails" class="section"
                                    :class="{ 'active': activeSection === 'FurnishingDetails' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-3 py-5">
                                                    <h4 class="fs-5  font-bold me-2">Furnishing Details </h4>
                                                    <div class="row align-items-center px-3">
                                                        @foreach ($property->furnishing ?? [] as $furnishingItem)
                                                            <div class="col-lg-3 d-flex align-items-center">
                                                                <img class="rounded-xl w-6 w-1/2 h-6"
                                                                    src="{{ $furnishingItem->image_url }}">
                                                                <div class="p-3">
                                                                    <span
                                                                        class="text-sm">{{ $furnishingItem->name }}</span>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($property->features->count())
                                <div class="container-fluid mb-5" id="Ameneties" class="section"
                                    :class="{ 'active': activeSection === 'Ameneties' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-3 py-5">
                                                    <h4 class="fs-5  font-bold me-2">Ameneties </h4>
                                                    <div class="row align-items-center px-3">
                                                        @foreach ($property->features ?? [] as $featureItem)
                                                            <div class="col-lg-3 d-flex align-items-center">
                                                                <img class="rounded-xl w-6 w-1/2 h-6"
                                                                    src="{{ $featureItem->image_url }}">
                                                                <div class="p-3">
                                                                    <span class="text-sm">{{ $featureItem->name }}</span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ('location' == 'location')
                                <div class="container-fluid mb-5">
                                    <div class="md:flex">
                                        <div class="w-full p-1">
                                            <div class="border-theme rounded-xl ">
                                                <div class="pt-8">
                                                    @include('front.shortcuts.locations')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- @if ($relatedProperties->count())
                                <div class="container-fluid mb-5">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="mx-3 mt-10 mb-5">
                                                    <h5 class="fs-5 text-dark font-bold me-2">
                                                        {{ __('Other Properties in this Project and Nearby') }}</h5>
                                                    {!! Theme::partial('real-estate.properties.items-scroll-single-page', ['properties' => $relatedProperties]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}

                            @if (!empty($recent_properties) && $recent_properties->count())
                                <div class="container-fluid mb-5">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-3 py-5">
                                                    <h4 class="fs-5 text-dark font-bold me-2">People who viewed this
                                                        property
                                                        also liked
                                                    </h4>
                                                </div>
                                                {!! Theme::partial('real-estate.properties.items-scroll-single-page', ['properties' => $recent_properties]) !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($property->facilities->groupBy('name')->count())
                                <div class="container-fluid mb-5" id="Landmarks" class="section"
                                    :class="{ 'active': activeSection === 'Landmarks' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1">
                                            <div class="border-theme rounded-xl px-3 py-5">

                                                <div class="mb-5">
                                                    <h4 class="fs-5 text-dark font-bold me-2">
                                                        {{ __('Landmark Near ') . $property->name }}
                                                    </h4>
                                                </div>

                                                <div class="grid gap-4 lg:grid-cols-2 sm:grid-cols-1">
                                                    @foreach ($property->facilities->groupBy('name') ?? [] as $key => $facilities)
                                                        <div class="flex col-span-1 me-4 lg:me-6 card" role="button"
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
                                                                <div class="p-2 text-end text-sm ">
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

                            @if ($property->latitude && $property->longitude)
                                <div class="container-fluid mb-5" id="Location" class="section"
                                    :class="{ 'active': activeSection === 'Location' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-3 py-3">
                                                    <h4 class="fs-5 font-bold me-2">{{ __('Location') }}
                                                    </h4>
                                                </div>
                                                <div class="box-map property-street-map-container">
                                                    <div class="property-street-map"
                                                        data-popup-id="#street-map-popup-template"
                                                        data-center="{{ json_encode([$property->latitude, $property->longitude]) }}"
                                                        {{-- ->label() --}}
                                                        data-map-icon="{{ $property->type }}: {{ $property->price_html }}"
                                                        style="height: 300px;">
                                                        <div class="hidden property-template-popup-map">
                                                            <table width="100%">
                                                                <tr class="border-bottom-none">
                                                                    <td width="90">
                                                                        <div class="blii"><img
                                                                                src="{{ asset($property->image_thumb) }}"
                                                                                width="80"
                                                                                alt="{{ $property->name }}">
                                                                            <div class="status">{!! $property->mode !!}
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="infomarker text-start">
                                                                            <h5><a href="{{ $property->url }}"
                                                                                    target="_blank">{!! $property->name !!}</a>
                                                                            </h5>
                                                                            <div class="text-info">
                                                                                <strong>{{ $property->price_html }}</strong>
                                                                            </div>
                                                                            <div>
                                                                                {{ $property->locality . ', ' . $property->sub_locality . ', ' . $property->city }}
                                                                            </div>
                                                                            <div class="ltr:flex">
                                                                                <span> {{ $property->square_text }}</span>
                                                                                <span class="px-2">
                                                                                    <i class="mdi mdi-bed-empty"></i>
                                                                                    <i>{{ $property->number_bedroom }}</i>
                                                                                </span>
                                                                                <span>
                                                                                    <i class="mdi mdi-shower"></i>
                                                                                    <i>{{ $property->number_bathroom }}</i>
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
                        </div>
                        <div class=" mt-8 lg:w-1/3 md:w-1/2 md:p-4 md:mt-0">
                            <div class="sticky  " style="top: 11rem;z-index:999">
                                <div class="mb-2 rounded-2xl shadow bg-theme dark:bg-slate-800 dark:shadow-gray-700">
                                    @include('front.shortcuts.consult-form', [
                                        'type' => 'property',
                                        'data' => $property,
                                    ])
                                </div>
                                <div class="mt-4">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#BookingModal"
                                        class="w-full py-4 text-white btn bg-primary fs-5"><i
                                            class="mdi mdi-download me-2"></i> {{ __('Download Brochure') }}</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>


@endsection

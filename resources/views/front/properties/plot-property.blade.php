@extends('layouts.app')

@php
    $project = $property->project->first();
@endphp

@section('content')

    <section class="relative  mt-28 content" >
        <div class="container" data-property-id="{{ $property->id }}" x-data="scrollSpy()"
            x-init="init()">
          
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
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="px-3 col-lg-9 ">
                                                <div class=" align-items-top">
                                                    <div class="px-3 col-lg-12 mt-3 md:flex flex-column">
                                                        <span class="fw-bold fs-1 text-theme">
                                                            @if ($property->price)
                                                                {{ shorten_price($property->price) }}
                                                            @endif
                                                        </span>
                                                        <span class="mt-2 fs-6">Developed by
                                                            {{ $project->investor->name }}</span>
                                                    </div>
                                                    <div class="px-3 col-lg-12 md:flex flex-column">
                                                        <div class="flex flex-column flex-column">

                                                            <div class=" mt-2">
                                                                @if ($project)
                                                                    <p
                                                                        class="d-inline fw-bolder me-2  text-base text-theme">
                                                                        {{ $project->name }}
                                                                    </p>
                                                                @endif

                                                                @if ($property->city)
                                                                    <p
                                                                        class="d-inline fw-bolder me-2 text-base text-theme text-capitalize {{ isset($project) ? 'border-2  border-end-0 border-top-0 border-bottom-0 ps-2' : '' }} ">
                                                                        {{ $property->locality . ',' }}
                                                                        {{ $property->city ? $property->city : 'Banglore' }}

                                                                    </p>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="p-3 flex gap-5">
                                                            <div class="ms-3">
                                                                <span class="">Plot Area<br><span
                                                                        class="fw-bold ">{{ $property->square_text }}</span></span>
                                                            </div>

                                                            <div class=" ms-3">
                                                                <span class="">Transaction Type<br><span
                                                                        class="fw-bold text-capitalize">{{ str_replace('_',' ',$property->construction_status) }}</span></span>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="px-3 mt-3">
                                                        <a href=""  data-bs-toggle="modal" data-bs-target="#BookingModal"
                                                            class=" text-theme btn btn-sm bg-trasparent border-theme">
                                                            <i class="mdi mdi-download me-2"></i>
                                                            {{ __('Download Brochure') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end col-lg-3">
                                                <span class="text-sm">Posted on
                                                    {{ date('M d, Y', strtotime($property->created_at)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="jump-header sticky top-0 z-999">
                <ul class="flex-wrap justify-left inline-block w-full p-4 py-10 text-left bg-white border-b rounded-t-xl dark:border-gray-800 mb-0 dark:bg-slate-900 overflow-x-auto whitespace-nowrap cursor-grab" x-data="{ isDragging: false, startX: 0, scrollLeft: 0 }" x-on:mousedown="isDragging = true; startX = $event.pageX - $el.offsetLeft; scrollLeft = $el.scrollLeft;" x-on:mousemove="if (isDragging) { $el.scrollLeft = scrollLeft - ($event.pageX - startX); }" x-on:mouseup="isDragging = false" x-on:mouseleave="isDragging = false" id="searchTab" data-tabs-toggle="#search-filter" role="tablist"
                    >
                    <li role="presentation" class="inline-block">
                        <button @click="scrollToSection('Overview')" :class="{ 'tab-active': activeTab === 'Overview' }"
                            class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out rounded-md hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800 tab-active"
                            id="overview-tab" data-tabs-target="#overview" type="button" role="tab"
                            aria-controls="overview" aria-selected="false">
                            More Details
                        </button>
                    </li>
                    @if ($project)
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
                    {{-- @if ($relatedProperties->count()) --}}
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('SimilarPlots')"
                                :class="{ 'tab-active': activeTab === 'SimilarPlots' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="SimilarPlots-tab" data-tabs-target="#SimilarPlots" type="button" role="tab"
                                aria-controls="SimilarPlots" aria-selected="false">
                                Similar Plots
                            </button>
                        </li>
                    {{-- @endif --}}
                    @if ($property->facilities->groupBy('name')->count())
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('Landmarks')"
                                :class="{ 'tab-active': activeTab === 'Landmarks' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="Landmarks-tab" data-tabs-target="#Landmarks" type="button" role="tab"
                                aria-controls="Landmarks" aria-selected="false">
                                Landmarks
                            </button>
                        </li>
                    @endif
                    @if ($property->latitude && $property->longitude)
                        <li role="presentation" class="inline-block">
                            <button @click="scrollToSection('Location')" :class="{ 'tab-active': activeTab === 'Location' }"
                                class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                id="Location-tab" data-tabs-target="#Location" type="button" role="tab"
                                aria-controls="Location" aria-selected="false">
                                Location Map
                            </button>
                        </li>
                    @endif

                </ul>
            </div>
            <div class="">
                <div class=" mt-4">
                    <div class="md:flex">
                        <div class=" lg:w-2/3 md:w-1/2 ">
                            <div class="container-fluid mb-5" id="Overview" class="section"
                                :class="{ 'active': activeSection === 'Overview' }">
                                <div class="md:flex">
                                    <div class="w-full p-1 ">
                                        <div class="border-theme rounded-xl">
                                            <div class="px-5 py-5">
                                                <h4 class="fs-5 font-bold me-2 ">More Details</h4>
                                                <div class="table-responsive mt-4">
                                                    <table class="table ">

                                                        <tr class="border-bottom-none">
                                                            <td class="text-gray-800 ">
                                                                Price
                                                            </td>
                                                            <th>
                                                                {{ shorten_price($property->price) }}
                                                            </th>
                                                        </tr>

                                                        <tr class="border-bottom-none">
                                                            <td class="text-gray-800 ">
                                                                Address
                                                            </td>
                                                            <th>
                                                                {{ $property->location }}
                                                            </th>
                                                        </tr>
                                                    </table>
                                                    <div class="px-3 mt-8">
                                                        <span>
                                                            <span class="fw-bold">Description : </span>
                                                            {!! $property->content !!}
                                                        </span>
                                                    </div>
                                                    <a href=""  data-bs-toggle="modal" data-bs-target="#BookingModal"
                                                        class=" text-white btn bg-primary mt-10">{{ __('Get Phone Number') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($project)
                                <div class="container-fluid mb-5" id="AboutProject" class="section"
                                    :class="{ 'active': activeSection === 'AboutProject' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-3 py-5">
                                                    <h4 class="fs-5  font-bold me-2">About Project </h4>
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-4 d-flex align-items-center">
                                                            <div class="p-3">
                                                                <span>{{ $project->name }}</span>
                                                                <span>by {{ $project->investor->name }}</span>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-lg-4 border-2  border-end-0 border-top-0 border-bottom-0 ">
                                                            <div class=" flex flex-column">
                                                                <span class="small text-gray-400 fw-bold">Price per sqft
                                                                </span>
                                                                <span>
                                                                    {{ shorten_price($project->price_from / ($project->square > 0 ? $project->square : 1)) }}
                                                                    - 
                                                                    {{ shorten_price($project->price_to / ($project->square > 0 ? $project->square : 1)) }}</span>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-lg-4 border-2  border-end-0 border-top-0 border-bottom-0">
                                                            <div class=" flex flex-column">
                                                                <span class="small text-gray-400 fw-bold">Units
                                                                </span>
                                                                <span>
                                                                    {{ $project->unit }} Units</span>
                                                            </div>
                                                        </div>
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

                            {{-- @if ($relatedProperties->count())
                                <div class="container-fluid mb-5" id="SimilarPlots" class="section"
                                    :class="{ 'active': activeSection === 'SimilarPlots' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="mx-3 mt-10 mb-5">
                                                    <h5 class="fs-5 text-dark font-bold me-2">
                                                        {{ __('Similar Plots in Nearby Projects') }}</h5>
                                                    {!! Theme::partial('real-estate.properties.items-scroll-single-page', ['properties' => $relatedProperties]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}


                            @if ($property->facilities->groupBy('name')->count())
                                <div class="container-fluid mb-5" id="Landmarks" class="section"
                                    :class="{ 'active': activeSection === 'Landmarks' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1">
                                            <div class="border-theme rounded-xl px-3 py-5">

                                                <div class="mb-5">
                                                    <h4 class="fs-5 text-dark font-bold me-2">
                                                        {{ __('Landmarks ') }}
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


                            @if ($property->latitude && $property->longitude)
                                <div class="container-fluid mb-5" id="Location" class="section"
                                    :class="{ 'active': activeSection === 'Location' }">
                                    <div class="md:flex">
                                        <div class="w-full p-1 ">
                                            <div class="border-theme rounded-xl">
                                                <div class="px-3 py-4">
                                                    <h4 class="fs-5 font-bold me-2">{{ __('Location') }}
                                                    </h4>
                                                </div>
                                                <div class="box-map property-street-map-container">
                                                    <div class="property-street-map"
                                                        data-popup-id="#street-map-popup-template"
                                                        data-center="{{ json_encode([$property->latitude, $property->longitude]) }}"
                                                        data-map-icon="{{ $property->type }}: {{ $property->price_html }}"
                                                        style="height: 300px;">
                                                        <div class="hidden property-template-popup-map">
                                                            <table width="100%">
                                                                <tr class="border-bottom-none">
                                                                    <td width="90">
                                                                        <div class="blii"><img
                                                                                src="{{ $property->image_thumb }}"
                                                                                width="80"
                                                                                alt="{{ $property->name }}">
                                                                            
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
                                                                            <div>{{ $property->city_name }}</div>
                                                                            <div class="ltr:flex">
                                                                                <span> {{ $property->square_text }}</span>
                                                                               
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
                            <div class="sticky  " style="top: 8rem;z-index:999">
                                <div class="mb-2 rounded-2xl shadow bg-theme dark:bg-slate-800 dark:shadow-gray-700">
                                    @include('front.shortcuts.consult-form', [
                                        'type' => 'property',
                                        'data' => $property,
                                    ])
                                </div>
                                <div class="mt-4">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#BookingModal"  class="w-full py-4 text-white btn bg-primary fs-5"><i
                                            class="mdi mdi-download me-2"></i> {{ __('Download Brochure') }}</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>
@endsection

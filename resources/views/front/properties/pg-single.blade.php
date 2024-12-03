@extends('layouts.app')
@php
    
@endphp

@section('content')
    <section class="relative  mt-28  content" data-property-id="{{ $property->id }}" x-data="scrollSpy()"
        x-init="init()">
        <div class="bg-white jump-header sticky z-999 top-0 mt-28 dark:bg-dark dark:text-white">
            <div class="container">
                <div class="px-3 row">
                    <div class="px-6 col-lg-9">
                        <div class="row pt-5 align-items-top">

                            <div class="px-3 col-lg-10 mt-5 md:p-4">
                                <span>
                                    <span class="fw-bold fs-2 text-theme">{{ shorten_price($property->price) }}</span>
                                    <span class="fs-5"> onwards</span>
                                </span>

                                <div class="mt-2 md:flex flex-column">
                                    <div class="flex flex-column flex-column">
                                        <h4 class="fs-4 d-inline  font-bold me-2">{{ $property->name }} </h4>
                                        <div class=" mt-2">
                                            @if ($property->city)
                                                <p class="d-inline fw-bolder me-2 text-base text-theme text-capitalize ">
                                                    <span class="mdi mdi-map-marker-right fs-6 text-theme">
                                                        {{ $property->city }}{{ $property->city ? ', ' : '' }}{{ $property->locality }}
                                                </p>
                                            @endif

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="px-3 mt-8 col-lg-3">
                        <span class="">Posted on {{ date('M d, Y', strtotime($property->created_at)) }}</span>
                    </div>
                </div>


                <div class=" mt-2 px-3">

                    <div class="px-3  ">
                        <span class="text-md">Occupancy Type : <i class="mdi mdi-bed-outline"></i> <span
                                class="text-capitalize text-md"> {{ $property->occupancy_type }}</span></span>
                        <span class="px-2 ms-2 py-0.75 text-sm border-theme rounded">For <i
                                class="mdi mdi-account-supervisor"></i>
                            {{ $property->available_for == 'any' ? 'Boys and Girls' : $property->available_for }}</span>
                        @if ($property->Landmark)
                            <span class="ms-4 text-sm"><span class="mdi mdi-check-circle fs-6 text-theme"></span>
                                {{ $property->Landmark }}
                            </span>
                        @endif
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
                                                                <h4 class="fw-bold">Deposit Amount</h4>
                                                                @php
                                                                    $deposit = $rules->firstWhere(
                                                                        'name',
                                                                        'Deposit Amount',
                                                                    );
                                                                    $depositValue =
                                                                        $property->pg_rules->firstWhere(
                                                                            'rule_id',
                                                                            $deposit->id,
                                                                        )->value ?? '--';
                                                                @endphp
                                                                <span>{{ $depositValue }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="flex flex-column">
                                                                <h4 class="fw-bold">Maintenance</h4>
                                                                @php
                                                                    $maintenance = $rules->firstWhere(
                                                                        'name',
                                                                        'Maintenance',
                                                                    );
                                                                    $maintenanceValue =
                                                                        $property->pg_rules->firstWhere(
                                                                            'rule_id',
                                                                            $maintenance->id,
                                                                        )->value ?? '--';
                                                                @endphp
                                                                <span>{{ $maintenanceValue }}</span>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="flex flex-column">
                                                                <h4 class="fw-bold">Notice Period</h4>
                                                                @php
                                                                    $notice = $rules->firstWhere(
                                                                        'name',
                                                                        'Notice Period',
                                                                    );
                                                                    $noticeValue =
                                                                        $property->pg_rules->firstWhere(
                                                                            'rule_id',
                                                                            $notice->id,
                                                                        )->value ?? '--';
                                                                @endphp
                                                                <span>{{ $noticeValue }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="flex flex-column">
                                                                <h4 class="fw-bold">Electricity Charges</h4>
                                                                @php
                                                                    $electricity = $rules->firstWhere(
                                                                        'name',
                                                                        'Electricity Charges',
                                                                    );
                                                                    $electricityValue =
                                                                        $property->pg_rules->firstWhere(
                                                                            'rule_id',
                                                                            $electricity->id,
                                                                        )->value ?? '--';
                                                                @endphp
                                                                <span>{{ $electricityValue }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-8">
                                                        <div class="col-lg-3">
                                                            <div class="flex flex-column">
                                                                <h4 class="fw-bold">Food Availability</h4>
                                                                @php
                                                                    $food = $rules->firstWhere(
                                                                        'name',
                                                                        'Food Availability',
                                                                    );
                                                                    $foodValue =
                                                                        $property->pg_rules->firstWhere(
                                                                            'rule_id',
                                                                            $food->id,
                                                                        )->value ?? '--';
                                                                @endphp
                                                                <span>{{ $foodValue }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="flex flex-column">
                                                                <h4 class="fw-bold">AC Rooms</h4>
                                                                @php
                                                                    $acRooms = $rules->firstWhere('name', 'AC Rooms');
                                                                    $acRoomsValue =
                                                                        $property->pg_rules->firstWhere(
                                                                            'rule_id',
                                                                            $acRooms->id,
                                                                        )->value ?? '--';
                                                                @endphp
                                                                <span>{{ $acRoomsValue }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="flex flex-column">
                                                                <h4 class="fw-bold">Parking</h4>
                                                                @php
                                                                    $acParking = $rules->firstWhere('name', 'Parking');
                                                                    $acParkingValue =
                                                                        $property->pg_rules->firstWhere(
                                                                            'rule_id',
                                                                            $acParking->id,
                                                                        )->value ?? '--';
                                                                @endphp
                                                                <span>{{ $acParkingValue }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="flex flex-column">
                                                                <h4 class="fw-bold">Power Backup</h4>
                                                                @php
                                                                    $powerBackup = $rules->firstWhere(
                                                                        'name',
                                                                        'Power Backup',
                                                                    );
                                                                    $powerBackupValue =
                                                                        $property->pg_rules->firstWhere(
                                                                            'rule_id',
                                                                            $powerBackup->id,
                                                                        )->value ?? '--';
                                                                @endphp

                                                                <span>{{ $powerBackupValue }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-8">
                                                        <div class="col-lg-3">
                                                            <div class="flex flex-column">
                                                                <h4 class="fw-bold">Available for</h4>
                                                                <span
                                                                    class="text-capitalize">{{ $property->available_for == 'any' ? 'Boys and Girls' : $property->available_for }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="flex flex-column">
                                                                <h4 class="fw-bold">Preferred Tenants</h4>

                                                                @php
                                                                    $preferredTenants = $rules->firstWhere(
                                                                        'name',
                                                                        'Preferred Tenants',
                                                                    );
                                                                    $preferredTenantsValue =
                                                                        $property->pg_rules->firstWhere(
                                                                            'rule_id',
                                                                            $preferredTenants->id,
                                                                        )->value ?? '--';
                                                                @endphp

                                                                <span>{{ $preferredTenantsValue }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="flex flex-column">
                                                                <h4 class="fw-bold">Total Number of Beds</h4>
                                                                @php
                                                                    $TotalBed = $rules->firstWhere(
                                                                        'name',
                                                                        'Total Number of Beds',
                                                                    );
                                                                    $totalBedsValue =
                                                                        $property->pg_rules->firstWhere(
                                                                            'rule_id',
                                                                            $TotalBed->id,
                                                                        )->value ?? '--';
                                                                @endphp

                                                                <span>{{ $totalBedsValue }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="flex flex-column">
                                                                <h4 class="fw-bold">Operating Since</h4>
                                                                @php
                                                                    $operatingSince = $rules->firstWhere(
                                                                        'name',
                                                                        'Operating Since',
                                                                    );
                                                                    $operatingSinceValue =
                                                                        $property->pg_rules->firstWhere(
                                                                            'rule_id',
                                                                            $operatingSince->id,
                                                                        )->value ?? '--';
                                                                @endphp

                                                                <span>{{ $operatingSinceValue }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <span class="px-3 mx-3 border-theme text-sm py-3 rounded">
                                                {!! $property->content !!}
                                            </span>
                                            <div class="px-3 mt-5">
                                                <a href=""
                                                    class="btn-sm text-white btn bg-primary">{{ __('Get Phone Number') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jump-header sticky top-0 z-1">
                        <ul class="flex-wrap justify-left inline-block w-full p-4 text-left bg-white border-b rounded-t-xl dark:border-gray-800 mb-0 dark:bg-slate-900 overflow-x-auto whitespace-nowrap cursor-grab"
                            x-data="{ isDragging: false, startX: 0, scrollLeft: 0 }"
                            x-on:mousedown="isDragging = true; startX = $event.pageX - $el.offsetLeft; scrollLeft = $el.scrollLeft;"
                            x-on:mousemove="if (isDragging) { $el.scrollLeft = scrollLeft - ($event.pageX - startX); }"
                            x-on:mouseup="isDragging = false" x-on:mouseleave="isDragging = false" id="searchTab"
                            data-tabs-toggle="#search-filter" role="tablist" id="searchTab"
                            data-tabs-toggle="#search-filter" role="tablist">

                            <li role="presentation" class="inline-block">
                                <button @click="scrollToSection('Overview')"
                                    :class="{ 'tab-active': activeTab === 'Overview' }"
                                    class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out rounded-md hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800 tab-active"
                                    id="overview-tab" data-tabs-target="#overview" type="button" role="tab"
                                    aria-controls="overview" aria-selected="false">
                                    Property Details
                                </button>
                            </li>
                            @if ($property->features->count())
                                <li role="presentation" class="inline-block">
                                    <button @click="scrollToSection('Ameneties')"
                                        :class="{ 'tab-active': activeTab === 'Ameneties' }"
                                        class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                        id="Ameneties-tab" data-tabs-target="#Ameneties" type="button" role="tab"
                                        aria-controls="Ameneties" aria-selected="false">
                                        Common Amenities
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
                                        Food and Kitchen
                                    </button>
                                </li>
                            @endif

                            @if ($property->pg_rules->count())
                                <li role="presentation" class="inline-block">
                                    <button @click="scrollToSection('Rules')"
                                        :class="{ 'tab-active': activeTab === 'Rules' }"
                                        class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out rounded-md hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                        id="rules-tab" data-tabs-target="#Rules" type="button" role="tab"
                                        aria-controls="rules" aria-selected="true">
                                        Rules
                                    </button>
                                </li>
                            @endif

                            @if ($property->latitude && $property->longitude)
                                <li role="presentation" class="inline-block">
                                    <button @click="scrollToSection('Location')"
                                        :class="{ 'tab-active': activeTab === 'Location' }"
                                        class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out rounded-md hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                        id="location-tab" data-tabs-target="#location" type="button" role="tab"
                                        aria-controls="location" aria-selected="true">
                                        Location Map
                                    </button>
                                </li>
                            @endif

                            {{-- @if ($relatedProperties->count()) --}}
                                <li role="presentation" class="inline-block">
                                    <button @click="scrollToSection('Similar')"
                                        :class="{ 'tab-active': activeTab === 'Similar' }"
                                        class="w-full px-6 py-2 text-base font-medium transition-all duration-500 ease-in-out rounded-md hover:text-primary dark:hover:text-white hover:bg-gray-50 dark:hover:bg-slate-800"
                                        id="similar-tab" data-tabs-target="#similar" type="button" role="tab"
                                        aria-controls="similar" aria-selected="true">
                                        Similar
                                    </button>
                                </li>
                            {{-- @endif --}}




                        </ul>
                    </div>
                    <div class="">
                        <div class=" mt-4">
                            <div class="md:flex">
                                <div class=" lg:w-2/3 md:w-1/2 ">


                                    @if ($property->features->count())
                                        <div class="container-fluid mb-5" id="Ameneties" class="section"
                                            :class="{ 'active': activeSection === 'Ameneties' }">
                                            <div class="md:flex">
                                                <div class="w-full p-1 ">
                                                    <div class="border-theme rounded-xl">
                                                        <div class="px-3 py-5">
                                                            <h4 class="fs-5  font-bold me-2">Amenities and Common
                                                                Area </h4>
                                                            <div class="row align-items-center px-3">
                                                                @foreach ($property->features ?? [] as $featureItem)
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
                                    @endif

                                    @if ($property->furnishing->count() > 0)
                                        <div class="container-fluid mb-5" id="FurnishingDetails" class="section"
                                            :class="{ 'active': activeSection === 'FurnishingDetails' }">
                                            <div class="md:flex">
                                                <div class="w-full p-1 ">
                                                    <div class="border-theme rounded-xl">
                                                        <div class="px-3 py-5">
                                                            <h4 class="fs-5 font-bold me-2">Furnishing Details
                                                            </h4>
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



                                    @if ($property->pg_rules->count())
                                        <div class="container-fluid mb-5" id="Rules" class="section"
                                            :class="{ 'active': activeSection === 'Rules' }">
                                            <div class="md:flex">
                                                <div class="w-full p-1 ">
                                                    <div class="border-theme rounded-xl">
                                                        <div class="px-3 py-5">
                                                            <h4 class="fs-5  font-bold me-2">Rules</h4>
                                                            <div class="row align-items-center">
                                                                @foreach ($property->pg_rules ?? [] as $ruleItem)
                                                                    <div
                                                                        class="col-lg-3 d-flex  flex-column align-items-center">
                                                                        <img class="rounded-xl w-6 w-1/2 h-6"
                                                                            src="{{ $ruleItem->rule->icon }}">
                                                                        <div class="p-3">
                                                                            <span class="text-sm">
                                                                                {!! $ruleItem->value === 'no' || $ruleItem->value === ''
                                                                                    ? '<i class="mdi mdi-alpha-x text-danger fs-2 font-bold"></i>'
                                                                                    : ($ruleItem->value === 'Yes'
                                                                                        ? '<i class="mdi mdi-check text-success fs-3 font-bold"></i>'
                                                                                        : htmlspecialchars($ruleItem->value, ENT_QUOTES, 'UTF-8')) !!}
                                                                            </span>
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
                                                                data-map-icon="{{ strtoupper($property->type) }}: {{ $property->price_html }}"
                                                                style="height: 300px;">
                                                                <div class="hidden property-template-popup-map">
                                                                    <table width="100%">
                                                                        <tr class="border-bottom-none">
                                                                            <td width="90">
                                                                                <div class="blii"><img class="rounded-3"
                                                                                        src="{{ $property->image_thumb }}"
                                                                                        width="80"
                                                                                        alt="{{ $property->name }}">
                                                                                    <div class="status">
                                                                                        {{-- {!! BaseHelper::clean($property->mode) !!} --}}
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
                                                                                        {{ $property->locality, $property->city }}
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


                                    {{-- @if ($relatedProperties->count())
                                        <div class="container-fluid mb-5" id="similar" class="section"
                                            :class="{ 'active': activeSection === 'Similar' }">
                                            <div class="md:flex">
                                                <div class="w-full p-1 ">
                                                    <div class="border-theme rounded-xl">
                                                        <div class="mx-3 mt-10 mb-5">
                                                            <h5 class="fs-5 text-dark font-bold me-2">
                                                                {{ __('Other Properties in this Project and Nearby') }}
                                                            </h5>
                                                            {!! Theme::partial('real-estate.properties.items-scroll-single-page', ['properties' => $relatedProperties]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif --}}
                                </div>
                                <div class=" mt-8 lg:w-1/3 md:w-1/2 md:p-4 md:mt-0">
                                    <div class="sticky  " style="top: 11rem;z-index:999">
                                        <div
                                            class="mb-2 rounded-2xl shadow bg-theme dark:bg-slate-800 dark:shadow-gray-700">
                                            @include('front.shortcuts.consult-form', ['type' => 'property', 'data' => $property])
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
                </div>
            </div>
        </div>
    </section>

@endsection

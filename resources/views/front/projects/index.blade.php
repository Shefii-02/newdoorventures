{{-- @extends('layouts.app')

@php
    $layouts = [
        'grid' => [
            'name' => __('Grid'),
            'icon' => 'mdi mdi-view-grid-outline',
        ],
        'list' => [
            'name' => __('List'),
            'icon' => 'mdi mdi-view-list-outline',
        ],
        'map' => [
            'name' => __('Map'),
            'icon' => 'mdi mdi-map-marker',
        ],
    ];

    $currentLayout = 'grid';

    if (!in_array($currentLayout, array_keys($layouts))) {
        $currentLayout = 'grid';
    }
    $searchType = 'projects';
@endphp

@section('content')
    <div class="relative mt-28">
        <div class="relative hidden md:block">
            <div class="overflow-hidden text-white shape z-1 dark:text-slate-900">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>

        <div class="fixed top-0 start-0 w-10/12 h-screen transition-transform duration-300 -translate-x-full md:hidden z-999 dark:bg-gray-800"
            id="filter-drawer">
            <div class="absolute inset-0 w-full h-full p-4 overflow-y-auto bg-white dark:bg-slate-900">
                <button type="button" id="close-filters"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm px-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="text-xl mdi mdi-close"></i>
                </button>
                <div class="mt-8 mb-12 {{ $searchType === 'projects' ? 'project' : 'property' }}-search item-search">
                    @include('front.shortcuts.projects.search-box-top', [
                        'id' => 'mobile',
                        'type' => 'rent',
                        'categories' => $categories,
                    ])
                </div>
            </div>
        </div>

    </div>
    <div class="p-6 bg-white  dark:border-gray-800 mb-0 dark:bg-slate-900 sticky top-0 z-999">
        <div class="container  ">
            <div class=" ">
                @include('front.shortcuts.projects.search-box-top', [
                    'id' => null,
                    'type' => request()->get('type') ?? $searchType,
                    'mode' => request()->get('m') ?? $searchType,
                    'categories' => $categories,
                    'cities' => $cities,
                    'builders' => $builders,
                ])

            </div>
            <h3 class="fs-4 pb-5 text-gray fw-bold ">{{ isset($searchByTitle) ? $searchByTitle : '' }}</h3>

        </div>
    </div>

    <section class="relative">
        <div class="container">
            @php
                $filtersApplied = request()->filled('city') || request()->filled('project') ||
                    is_array(request()->get('categories')) || is_array(request()->get('bedrooms')) ||
                    is_array(request()->get('ownership')) || request()->filled('min_price') || request()->filled('max_price');
            @endphp
    
            @if ($filtersApplied)
                <span class="font-italic fs-13">Searching for</span>: <br>
                @if (request()->filled('city') && request('city') !== 'null')
                    <span class="text-capitalize fs-6">Locality: <span class="fw-bold">{{ request('city') }}</span></span> |
                @endif
                @if (request()->filled('project') && request('project') !== 'null')
                    <span class="text-capitalize fs-6">Project: <span class="fw-bold">{{ request('project') }}</span></span> |
                @endif
                @if (is_array(request()->get('categories')))
                    <span class="text-capitalize fs-6">Categories: <span class="fw-bold">{{ implode(', ', request('categories')) }}</span></span> |
                @endif
                @if (is_array(request()->get('bedrooms')))
                    <span class="text-capitalize fs-6">Bedrooms: <span class="fw-bold">{{ implode(', ', request('bedrooms')) }}</span></span> |
                @endif
                @if (is_array(request()->get('ownership')))
                    <span class="text-capitalize fs-6">Ownership: <span class="fw-bold">{{ implode(', ', request('ownership')) }}</span></span> |
                @endif
                @if (is_array(request()->get('availability')))
                    <span class="text-capitalize fs-6">Availability: <span class="fw-bold">{{ implode(', ', request('availability')) }}</span></span> |
                @endif
                @if (is_array(request()->get('occupancy')))
                    <span class="text-capitalize fs-6">Occupancy: <span class="fw-bold">{{ implode(', ', request('occupancy')) }}</span></span> |
                @endif
                
                
                @if (request()->filled('min_price') || request()->filled('max_price'))
                    <span class="text-capitalize fs-6">Budget: 
                        <span class="fw-bold">
                            Min Price: {{ number_format(request('min_price', 0)) }},
                            Max Price: {{ number_format(request('max_price', 0)) }}
                        </span>
                    </span>
                @endif
                <hr class="my-2">
            @else
                <span class="text-muted">No filters applied</span>
            @endif
        </div>
    </section>

    <section class="relative ">
        <div class="container">
            <div id="items-map" @class([
                'hidden' => !request()->input('layout') == 'map' || !$showMap,
            ])>
                @include('front.shortcuts.projects.items-map', compact('projects'))
            </div>
            <div id="items-list" data-box-type="project" @class(['hidden' => request()->input('layout') == 'map']) data-layout="grid"
                style="max-height: none; max-width: none">
                @include('front.shortcuts.projects.items', compact('projects'))
            </div>
        </div>
    </section>

   
@endsection --}}

@extends('layouts.app')

@php
    $layouts = [
        'grid' => [
            'name' => __('Grid'),
            'icon' => 'mdi mdi-view-grid-outline',
        ],
        'list' => [
            'name' => __('List'),
            'icon' => 'mdi mdi-view-list-outline',
        ],
        'map' => [
            'name' => __('Map'),
            'icon' => 'mdi mdi-map-marker',
        ],
    ];

    $currentLayout = 'grid';

    if (!in_array($currentLayout, array_keys($layouts))) {
        $currentLayout = 'grid';
    }

    $searchType = 'properties';
@endphp
@section('content')
    <div class="relative mt-28">
        <div class="relative hidden md:block">
            <div class="overflow-hidden text-white shape z-1 dark:text-slate-900">
                <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>

        <div class="fixed top-0 start-0 w-10/12 h-screen transition-transform duration-300 -translate-x-full md:hidden z-999 dark:bg-gray-800"
            id="filter-drawer">
            <div class="absolute inset-0 w-full h-full p-4 overflow-y-auto bg-white dark:bg-slate-900">
                <button type="button" id="close-filters"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm px-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <i class="text-xl mdi mdi-close"></i>
                </button>
                {{-- <div class="mt-8 mb-12 {{ $searchType === 'projects' ? 'project' : 'property' }}-search item-search">
                    @include('front.shortcuts.properties.search-box-top', [
                        'id' => null,
                        'type' => request()->get('type') ?? $searchType,
                        'mode' => request()->get('m') ?? $searchType,
                        'categories' => $categories,
                        'cities' => $cities,
                        'builders' => $builders,
                    ])
                </div> --}}
            </div>
        </div>
    </div>

    <div class="p-2 bg-white  dark:border-gray-800 mb-0 dark:bg-slate-900 sticky top-0 z-999">
        <div class="container  ">
            <div class="p-1 bg-white  dark:border-gray-800 mb-0 dark:bg-slate-900 sticky top-0 z-999">
                <div class="  ">
                    <div class=" ">
                        @include('front.shortcuts.projects.search-box-top', [
                            'id' => null,
                            'type' => request()->get('type') ?? $searchType,
                            'mode' => request()->get('m') ?? $searchType,
                            'categories' => $categories,
                            'cities' => $cities,
                            'builders' => $builders,
                        ])

                    </div>
                    <h3 class="fs-4 pb-5 text-gray fw-bold ">{{ isset($searchByTitle) ? $searchByTitle : '' }}</h3>
                </div>
            </div>
        </div>
    </div>
    <section class="relative">
        <div class="container">
            @php
                $filtersApplied =
                    request()->filled('city') ||
                    request()->filled('project') ||
                    is_array(request()->get('categories')) ||
                    is_array(request()->get('bedrooms')) ||
                    is_array(request()->get('ownership')) ||
                    request()->filled('min_price') ||
                    request()->filled('max_price');
            @endphp

            @if ($filtersApplied)
                <span class="font-italic fs-13">Searching for</span>: <br>
                @if (request()->filled('city') && request('city') !== 'null')
                    <span class="text-capitalize fs-6">Locality: <span class="fw-bold">{{ request('city') }}</span></span> |
                @endif
                @if (request()->filled('builder') && request('builder') !== 'null')
                    <span class="text-capitalize fs-6">Builder: <span class="fw-bold">{{ implode(', ', request('builder')) }}</span></span>
                    |
                @endif
                @if (is_array(request()->get('categories')))
                    <span class="text-capitalize fs-6">Categories: <span
                            class="fw-bold">{{ implode(', ', request('categories')) }}</span></span> |
                @endif
                @if (is_array(request()->get('ownership')))
                    <span class="text-capitalize fs-6">Ownership: <span
                            class="fw-bold">{{ implode(', ', request('ownership')) }}</span></span> |
                @endif
                @if (is_array(request()->get('construction')))
                    <span class="text-capitalize fs-6">Construction Status: <span
                            class="fw-bold">{{ str_replace('_',' ',implode(', ', request('construction'))) }}</span></span> |
                @endif
                @if (is_array(request()->get('occupancy')))
                    <span class="text-capitalize fs-6">Occupancy: <span
                            class="fw-bold">{{ str_replace('_',' ',implode(', ', request('occupancy'))) }}</span></span> |
                @endif


                @if (request()->filled('min_price') || request()->filled('max_price'))
                    <span class="text-capitalize fs-6">Budget:
                        <span class="fw-bold">
                            Min Price: {{ number_format(request('min_price', 0)) }},
                            Max Price: {{ number_format(request('max_price', 0)) }}
                        </span>
                    </span>
                @endif
                <hr class="my-2">
            @else
                <span class="text-muted">No filters applied</span>
                <hr class="my-2">
            @endif
        </div>
    </section>

    <section class="relative">
        <div class="container">

            <div id="items-map" @class([
                'hidden' => !request()->input('layout') == 'map' || !$showMap,
            ])>
            </div>
            <div data-box-type="property" @class(['hidden' => request()->input('layout') == 'map']) data-layout="grid"
                style="max-height: none; max-width: none">
                <div id="items-list">
                    @include('front.shortcuts.projects.items', compact('projects'))
                </div>
            </div>
        </div>
    </section>
@endsection

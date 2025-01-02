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
            <div class=" ">
                @if (isset($type) && $type == 'pg')
                    @include('front.shortcuts.properties.search-box-top-pg', [
                        'id' => null,
                        'type' => request()->get('type') ?? isset($type) ? $type : '',
                        'mode' => request()->get('m') ?? $searchType,
                        'categories' => $categories,
                        'cities' => $cities,
                        'builders' => $builders,
                        'min_price' => request()->get('min_price') ?? '',
                        'max_price' => request()->get('max_price') ?? '',
                        'projects' => $projects,
                    ])
                @elseif(isset($type) && $type == 'commercial')
                    @include('front.shortcuts.properties.search-box-top-commercial', [
                        'id' => null,
                        'type' => request()->get('type') ?? isset($type) ? $type : '',
                        'mode' => request()->get('m') ?? $searchType,
                        'categories' => $categories->where('has_commercial'),
                        'cities' => $cities,
                        'builders' => $builders,
                        'min_price' => request()->get('min_price') ?? '',
                        'max_price' => request()->get('max_price') ?? '',
                        'projects' => $projects
                    ])
                @elseif(isset($type) && $type == 'plot')
                    @include('front.shortcuts.properties.search-box-top-plot', [
                        'id' => null,
                        'type' => request()->get('type') ?? isset($type) ? $type : '',
                        'mode' => request()->get('m') ?? $searchType,
                        'categories' => $categories,
                        'cities' => $cities,
                        'builders' => $builders,
                        'min_price' => request()->get('min_price') ?? '',
                        'max_price' => request()->get('max_price') ?? '',
                        'projects' => $projects
                    ])
                @else
                    @include('front.shortcuts.properties.search-box-top', [
                        'id' => null,
                        'type' => request()->get('type') ?? isset($type) ? $type : '',
                        'mode' => request()->get('m') ?? $searchType,
                        'categories' => $categories,
                        'cities' => $cities,
                        'builders' => $builders,
                        'min_price' => request()->get('min_price') ?? '',
                        'max_price' => request()->get('max_price') ?? '',
                        'projects' => $projects
                    ])
                @endif
            </div>
            <h3 class="fs-4 pb-5 text-gray fw-bold ">{{ isset($searchByTitle) ? $searchByTitle : '' }}</h3>

        </div>
    </div>

    <section class="relative">
        <div class="container">
         
            <div id="items-map" @class([
                'hidden' => !request()->input('layout') == 'map' || !$showMap,
            ])>
                {{-- {!! Theme::partial('real-estate.properties.items-map', compact('properties')) !!} --}}
            </div>
            <div id="items-list" data-box-type="property" @class(['hidden' => request()->input('layout') == 'map']) data-layout="grid"
                style="max-height: none; max-width: none">
                @include('front.shortcuts.properties.items', compact('properties'))
            </div>
        </div>
    </section>
@endsection

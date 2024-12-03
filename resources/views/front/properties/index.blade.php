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
                <div class="mt-8 mb-12 {{ $searchType === 'projects' ? 'project' : 'property' }}-search item-search">
                    @include('front.shortcuts.properties.search-box-top', [
                        'id' => null,
                        'type' => request()->get('type') ?? $searchType,
                        'mode' => request()->get('m') ?? $searchType,
                        'categories' => $categories,
                        'cities' => $cities,
                        'builders' => $builders,
                    ])
                </div>
            </div>
        </div>
    </div>
    <div class="p-2 bg-white  dark:border-gray-800 mb-0 dark:bg-slate-900 sticky top-0 z-999">
        <div class="container  ">
            <div class=" ">
                @include('front.shortcuts.properties.search-box-top', [
                    'id' => null,
                    'type' => request()->get('type') ?? $searchType,
                    'mode' => request()->get('m') ?? $searchType,
                    'categories' => $categories,
                    'cities' => $cities,
                    'builders' => $builders,
                ])
               
            </div>
        </div>

    </div>
    <div class="container mt-16 item-search d-none">
        <div class="flex items-center justify-between" data-ajax-url="{{ route('public.projects') }}">
            <div class="flex gap-2">
                <button class="block px-3 py-2 text-white transition-all bg-primary md:hidden rounded-xl hover:bg-secondary"
                    id="open-filter">
                    <i class="mdi mdi-filter"></i>
                    <span class="hidden md:block">{{ __('Filter') }}</span>
                </button>
                @foreach ($layouts as $key => $layout)
                    <button @disabled($currentLayout === $key) @class([
                        'hidden md:flex items-center pt-1 px-2 rounded-md text-white leading-none hover:bg-primary cursor-pointer toggle-layout',
                        'bg-primary' => $currentLayout === $key,
                        'bg-slate-500' => $currentLayout !== $key,
                    ]) data-type="{{ $key }}"
                        title="{{ $layout['name'] }}">
                        <i class="{{ $layout['icon'] }} text-2xl"></i>
                    </button>
                @endforeach
            </div>
            @include('front.shortcuts.filters.sort-order', ['perPages' => ['12','24','36','48']])
        </div>
    </div>


    <section class="relative">
        <div class="container">
            <div id="items-map" @class([
                'hidden' => !request()->input('layout') == 'map' || !$showMap,
            ])>
                {{-- {!! Theme::partial('real-estate.properties.items-map', compact('properties')) !!} --}}
            </div>
            <div id="items-list" data-box-type="property" @class(['hidden' => request()->input('layout') == 'map'])
                data-layout="grid style="max-height: none; max-width: none">
                @include('front.shortcuts.properties.items', compact('properties'))
            </div>
        </div>
    </section>

    <div class="hidden w-full mx-auto overflow-hidden duration-500 ease-in-out bg-white shadow group rounded-xl dark:bg-slate-900 hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 lg:max-w-2xl"
        id="property-list-skeleton">
        <div class="md:flex">
            <div class="flex items-center justify-center bg-gray-300 rounded-l h-60 dark:bg-gray-700">
                <i class="px-12 py-16 text-gray-200 text-8xl mdi mdi-image-filter-hdr"></i>
            </div>
            <div class="p-6">
                <div class="pb-6 space-y-4">
                    <div class="hidden md:flex items-center -ms-0.5 mb-2">
                        <i class="me-1 text-sm mdi mdi-tag-outline text-slate-200"></i>
                        <div class="w-1/4 h-2 rounded bg-slate-200"></div>
                    </div>
                    <div class="h-2 rounded bg-slate-200"></div>
                    <div class="w-3/5 h-2 rounded bg-slate-200"></div>
                </div>

                <ul class="flex items-center justify-between py-6 ps-0 mb-0 list-none md:py-4">
                    <li class="flex items-center me-4">
                        <i class="text-2xl text-slate-200 mdi mdi-shower me-2"></i>
                        <div class="w-10 h-2 rounded bg-slate-200"></div>
                    </li>

                    <li class="flex items-center me-4">
                        <i class="text-2xl text-slate-200 mdi mdi-bed-empty me-2"></i>
                        <div class="w-10 h-2 rounded bg-slate-200"></div>
                    </li>

                    <li class="flex items-center">
                        <i class="text-2xl text-slate-200 mdi mdi-arrow-collapse-all me-2"></i>
                        <div class="w-10 h-2 rounded bg-slate-200"></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="hidden overflow-hidden duration-500 ease-in-out bg-white shadow group rounded-xl dark:bg-slate-900 hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700"
        id="property-grid-skeleton">
        <div class="relative">
            <div class="flex items-center justify-center w-full bg-gray-300 rounded h-60 dark:bg-gray-700">
                <i class="text-gray-200 text-8xl mdi mdi-image-filter-hdr"></i>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <div class="space-y-4">
                <div class="h-2 rounded bg-slate-200"></div>
                <div class="w-3/5 h-2 rounded bg-slate-200"></div>
            </div>

            <ul class="flex items-center justify-between py-6 ps-0 mb-0 list-none">
                <li class="flex items-center me-4">
                    <i class="text-2xl text-slate-200 mdi mdi-shower me-2"></i>
                    <div class="w-10 h-2 rounded bg-slate-200"></div>
                </li>

                <li class="flex items-center me-4">
                    <i class="text-2xl text-slate-200 mdi mdi-bed-empty me-2"></i>
                    <div class="w-10 h-2 rounded bg-slate-200"></div>
                </li>

                <li class="flex items-center">
                    <i class="text-2xl text-slate-200 mdi mdi-arrow-collapse-all me-2"></i>
                    <div class="w-10 h-2 rounded bg-slate-200"></div>
                </li>
            </ul>
        </div>
    </div>

    <div class="hidden overflow-hidden duration-500 ease-in-out bg-white shadow group rounded-xl dark:bg-slate-900 hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700"
        id="property-map-skeleton">
        <div class="relative">
            <div class="flex items-center justify-center w-full bg-gray-300 rounded h-60 dark:bg-gray-700">
                <i class="text-gray-200 text-8xl mdi mdi-image-filter-hdr"></i>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <div class="space-y-4">
                <div class="h-2 rounded bg-slate-200"></div>
                <div class="w-3/5 h-2 rounded bg-slate-200"></div>
            </div>
        </div>
    </div>
@endsection

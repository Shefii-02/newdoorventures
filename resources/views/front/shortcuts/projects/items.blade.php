@php
    $currentLayout = request()->query('layout') ? request()->query('layout') : 'grid';

    if (! in_array($currentLayout, ['grid', 'list'])) {
        $currentLayout = 'grid';
    }
@endphp

@include("front.shortcuts.projects.items-$currentLayout", compact('projects'))

{{-- @if ($projects instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{ $projects->links(Theme::getThemeNamespace('partials.pagination')) }}
@endif --}}

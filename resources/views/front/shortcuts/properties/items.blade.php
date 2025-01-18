@php
    $currentLayout = request()->query('layout') ? request()->query('layout') : 'grid';

    if (!in_array($currentLayout, ['grid', 'list'])) {
        $currentLayout = 'grid';
    }
@endphp
@include("front.shortcuts.properties.items-$currentLayout", compact('properties','readyToMoveProjects'))


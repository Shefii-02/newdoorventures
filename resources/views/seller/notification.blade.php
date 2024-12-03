@extends('plugins/real-estate::themes.dashboard.layouts.master')



@section('content')
@if (session('notification'))
<div style="height: 70vh" class="flex flex-column justify-content-center mb-4 p-4 rounded-lg items-center text-center text-light-700">
    <div class="mr-4">
        <!-- Notification Image -->
        <img src="{{ asset('storage/general/error.png') }}" alt="Pending Approval" class="w-30 h-30 rounded-full">
    </div>
    <div class="mt-4">
        <!-- Notification Message -->
        <h1 class="font-bold fs-1 mb-4">Pending Approval</h1>
        <p class="text-sm">
            {{ session('notification') }}
        </p>
        <a href="tel:+18001234567" class="mt-2 inline-block text-blue-600 hover:underline">
            Call Support Center
        </a>
    </div>
</div>
@endif


@endsection
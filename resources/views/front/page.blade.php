
@extends('layouts.app')

@section('content')
    <section class="relative table w-full py-32 bg-center bg-no-repeat breadcrumb lg:py-36 page_speed_48133614">
        <div class="absolute inset-0 bg-black opacity-80"></div>
        <div class="container">
            <div class="grid grid-cols-1 mt-10 text-center">
                <h3 class="text-3xl font-medium leading-normal text-white md:text-4xl md:leading-normal">{{ $page->name }}</h3>
                
            </div>
        </div>
    </section>
    <div class="container mt-16 lg:mt-24">
        <div class="grid grid-cols-1 md:grid-cols-6 md:gap-10">
            <div class="col-span-1 mb-16 md:col-span-4 md:mb-0">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection



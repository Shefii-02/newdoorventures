@extends('layouts.app')
@section('content')
    <div class="ck-content">
        @include('front.home.hero-section', ['images' => '', 'title' => '', 'content' => ''])
    </div>

    <div>
        <section class="relative pt-28 lg:pt-32">
            <div class="container">
                @include('front.shortcuts.locations', ['images' => [], 'title' => '', 'content' => ''])
            </div>
        </section>
    </div>

    <div>
        @include('front.home.featured-projects', ['featured_projects' => $featured_project, 'title' => '', 'content' => ''])
    </div>

    <div>
        @include('front.home.featured-properties', ['featured_properties' => $featured_properties, 'title' => '', 'content' => ''])
    </div>

    <div>
        @include('front.home.recent-viewed-properties', ['recent_properties' => $recent_viwed_properties, 'title' => '', 'content' => ''])
    </div>

    <div>
        @include('front.home.latest-news', ['latest_blogs' => $latest_blogs, 'title' => '', 'content' => ''])
    </div>

    <div>
        <div class="container mt-16 lg:mt-24">
            <div class="grid grid-cols-1 text-center">
                <h3 class="mb-6 text-2xl font-medium leading-normal text-black md:text-3xl md:leading-normal dark:text-white">
                    Have questions? Get in touch!
                </h3>
                <p class="max-w-xl mx-auto text-slate-400">
                    A great platform to buy, sell, and rent your properties without any agent or commissions.
                </p>
                <div class="mt-6">
                    <a href="contact.html" class="text-white rounded-md bg-primary btn hover:bg-secondary">
                        <i class="align-middle mdi mdi-phone me-2"></i> Contact us
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

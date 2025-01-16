@extends('front.mobile.layouts')
@push('header')
    <style>
        [x-cloak] {
            display: none !important;
        }

        .mobile-hero-slider .item {
            border-radius: 9px;
            margin: 10px
        }

        .mobile-type-slider .item {
            filter: drop-shadow(0 0 5px rgba(31, 31, 31, 0.1));
            width: 100px;
            height: 100px;
            border-radius: 50px;
            text-align: center;
        }

        .mobile-type-slider .item .box {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            align-items: center;
            margin-top: 16px;

        }

        .mobile-type-slider .item .box span {
            font-size: 12px;
            font-weight: 700;
        }

        .sticky-search-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
    </style>
@endpush

@section('content')
    <div class="home-header-box bg-theme">
        <div class="p-2">
            <h2 class="fw-semibold text-light fs-6 ">Welcome to <span class="text-dark fw-bold ms-2">New Door
                    Ventures,</span>
            </h2>
            <h4 class="fw-bold text-light fs-16 mt-3">Explore Properties to Buy, Rent, or Sell with Ease</h4>
            {{-- <h6 class="text-light fs-6 mt-3">Post Your Properties <span
                    class="ms-1 bg-dark text-white px-2 py-1 rounded fs-6">Free!</span></h6> --}}
        </div>
        <div class="col-lg-12">
            <div class="">
                @include('front.mobile.search-bar',['div'=>'search1'])
            </div>
        </div>
    </div>
    <div class="mobile-hero-slider pt-5">
        <div class="hero-single-item">
            <div class="item">
                <img src="/themes/images/banners/01.jpg" loading="lazzy">
            </div>
            <div class="item">
                <img src="/themes/images/banners/02.jpg" loading="lazzy">
            </div>
            <div class="item">
                <img src="/themes/images/banners/03.jpg" loading="lazzy">
            </div>
            <div class="item">
                <img src="/themes/images/banners/04.jpg" loading="lazzy">
            </div>
        </div>
    </div>
    <div class="mobile-type-slider px-3 pt-5">
        <div class="mobile-type-slider-item">
            <div class="item">
                <div class="box">
                    <a href="{{ route('public.properties.sale') }}">
                        <img src="/assets/icons/buy.png" loading="lazzy" class="w-50 mx-auto">
                        <span class="mt-2">Buy</span>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <a href="{{ route('public.properties.rent') }}">
                        <img src="/assets/icons/rent.png" loading="lazzy"  class="w-50 mx-auto">
                        <span class="mt-2">Rent</span>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <a href="{{ route('public.properties.pg') }}">
                        <img src="/assets/icons/pg.png" loading="lazzy"  class="w-50 mx-auto">
                        <span class="mt-2">PG/Co-Living</span>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <a href="{{ route('public.properties.commercial') }}">
                        <img src="/assets/icons/commercial.png" loading="lazzy"  class="w-50 mx-auto">
                        <span class="mt-2">Commercial</span>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <a href="{{ url('/projects?type=new-launch') }}">
                        <img src="/assets/icons/new-launch.png" loading="lazzy"  class="w-50 mx-auto">
                        <span class="mt-2">New Launch</span>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <a href="{{ route('public.properties.plot') }}">
                        <img src="/assets/icons/plot.png" loading="lazzy"  class="w-50 mx-auto">
                        <span class="mt-2">Plot and Lands</span>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <a href="{{ route('public.projects') }}">
                        <img src="/assets/icons/projects.png" loading="lazzy" class="w-50 mx-auto">
                        <span class="mt-2">Projects</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-locations pt-5">
        <div class="container">
            @include('front.shortcuts.locations', ['images' => [], 'title' => '', 'content' => ''])
        </div>
    </div>
    <div class="mobile-featured-projects pt-5">
        @include('front.home.featured-projects', [
            'featured_projects' => $featured_project,
            'title' => '',
            'content' => '',
        ])
    </div>
    <div class="mobile-featured-properties pt-5">
        @include('front.home.featured-properties', [
            'featured_properties' => $featured_properties,
            'title' => '',
            'content' => '',
        ])
    </div>

    <div class="mobile-featured-properties-rent pt-5">
        @include('front.home.featured-properties-rent', [
            'featured_properties_rent' => $featured_properties_rent,
            'title' => '',
            'content' => '',
        ])
    </div>

    <div class="mobile-latest-news py-5">
        @include('front.home.latest-news', [
            'latest_blogs' => $latest_blogs,
            'title' => '',
            'content' => '',
        ])
    </div>
@endsection


@push('footer')
    <script>
        $('.hero-single-item').slick({
            "autoplay": true,
            "autoplaySpeed": 2000,
            "slidesToShow": 1,
            "slidesToScroll": 1,
            "arrows": false,
            "dots": true,
            "infinite": true,
        });

        $('.mobile-type-slider-item').slick({
            "autoplay": true,
            "autoplaySpeed": 2000,
            "slidesToShow": 4,
            "slidesToScroll": 1,
            "arrows": false,
            "dots": true,
            "infinite": true,
        });


        
    </script>

    <script>
        function scrollHandler() {
            return {
                lastScrollTop: 0, // Start tracking from the top
                show: false,
                init() {
                    window.addEventListener('scroll', () => {
                        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

                        if (currentScroll > 200) {
                            // Show the search bar after scrolling beyond 200px
                            this.show = true;
                        } else {
                            // Hide the search bar when back to or below 200px
                            this.show = false;
                        }

                        this.lastScrollTop = currentScroll <= 0 ? 0 :
                            currentScroll; // Prevent negative scroll values
                    });
                },
            };
        }
    </script>
@endpush

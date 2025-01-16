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
                @include('front.mobile.search-bar')

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
            "slidesToShow": 3,
            "slidesToScroll": 1,
            "arrows": false,
            "dots": true,
            "infinite": true,
            "responsive": [{
                    "breakpoint": 1024,
                    "settings": {
                        "slidesToShow": 4
                    }
                },
                {
                    "breakpoint": 768,
                    "settings": {
                        "slidesToShow": 4
                    }
                },
                {
                    "breakpoint": 480,
                    "settings": {
                        "slidesToShow": 4
                    }
                }
            ]
        });


        const selectedItems = {};

        function fetchSuggestions(type) {
            const searchQuery = document.getElementById(`search-box-${type}`).value;
            const loadingIcon = document.getElementById(`loading-icon-${type}`);
            const suggestionsList = document.getElementById(`suggestions-list-${type}`);
            const suggestionsUl = document.getElementById(`suggestions-ul-${type}`);
            const typeOption = document.getElementById(`typeOption`).value;
            if (searchQuery.length > 1) {
                loadingIcon.style.display = 'inline-block'; // Show loading icon

                fetch(`/searching-in-keywords?k=${searchQuery}&type=${typeOption}`)
                    .then(response => response.json())
                    .then(data => {
                        loadingIcon.style.display = 'none'; // Hide loading icon
                        suggestionsUl.innerHTML = ''; // Clear previous suggestions

                        if (data && Object.keys(data).length > 0) {
                            Object.keys(data).forEach(category => {
                                if (data[category].length > 0) {
                                    const categoryHeading = document.createElement('li');
                                    categoryHeading.textContent = category.charAt(0).toUpperCase() + category
                                        .slice(1);
                                    categoryHeading.classList.add('px-4', 'py-2', 'font-bold', 'text-theme');
                                    suggestionsUl.appendChild(categoryHeading);

                                    data[category].forEach(item => {
                                        const li = document.createElement('li');
                                        li.textContent = item;
                                        li.classList.add('px-4', 'py-2', 'hover:bg-gray-200',
                                            'text-dark',
                                            'cursor-pointer');
                                        li.onclick = () => selectItem(type, item);
                                        suggestionsUl.appendChild(li);
                                    });
                                }
                            });
                            suggestionsList.style.display = 'block'; // Show suggestions
                        } else {
                            const noResults = document.createElement('li');
                            noResults.textContent = 'No results found';
                            noResults.classList.add('px-4', 'py-2', 'text-center', 'text-dark');
                            suggestionsUl.appendChild(noResults);
                            suggestionsList.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        loadingIcon.style.display = 'none'; // Hide loading icon
                        console.error('Error fetching suggestions:', error);
                    });
            } else {
                suggestionsList.style.display = 'none'; // Hide suggestions if input is too short
            }
        }

        function selectItem(type, item) {
            if (!selectedItems[type]) {
                selectedItems[type] = [];
            }
            if (!selectedItems[type].includes(item)) {
                selectedItems[type].push(item);
                updateSelectedItems(type);
            }
            document.getElementById(`search-box-${type}`).value = '';
            document.getElementById(`suggestions-list-${type}`).style.display = 'none';
            document.getElementById(`suggestions-ul-${type}`).innerHTML = "";
        }

        function removeItem(type, item) {
            if (selectedItems[type]) {
                selectedItems[type] = selectedItems[type].filter(selectedItem => selectedItem !== item);
                updateSelectedItems(type);
            }
        }

        function updateSelectedItems(type) {
            const selectedItemsDisplay = document.getElementById(`selected-items-display-${type}`);
            selectedItemsDisplay.innerHTML = ''; // Clear previous items

            selectedItems[type].forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.classList.add('flex', 'items-center', 'border-1', 'px-2', 'py-1', 'rounded-md');
                itemDiv.textContent = item;

                const removeIcon = document.createElement('span');
                removeIcon.textContent = '×';
                removeIcon.classList.add('ms-2', 'text-red-500', 'cursor-pointer');
                removeIcon.onclick = () => removeItem(type, item);

                itemDiv.appendChild(removeIcon);
                selectedItemsDisplay.appendChild(itemDiv);

                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 's[]';
                hiddenInput.value = item;

                selectedItemsDisplay.appendChild(hiddenInput);
            });

            const showMoreBtn = document.getElementById(`show-more-btn-${type}`);
            showMoreBtn.style.display = selectedItems[type].length > 5 ? 'block' : 'none';
        }

        function toggleShowMore(type) {
            const selectedItemsDisplay = document.getElementById(`selected-items-display-${type}`);
            const showMoreBtn = document.getElementById(`show-more-btn-${type}`);

            if (selectedItemsDisplay.style.maxHeight === '100%') {
                selectedItemsDisplay.style.maxHeight = '30px';
                showMoreBtn.textContent = 'Show More';
            } else {
                selectedItemsDisplay.style.maxHeight = '100%';
                showMoreBtn.textContent = 'Show Less';
            }
        }

        function showSuggestions(type) {
            const suggestionsList = document.getElementById(`suggestions-list-${type}`);
            if (suggestionsList.children.length > 0) {
                suggestionsList.style.display = 'block';
            }
        }
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

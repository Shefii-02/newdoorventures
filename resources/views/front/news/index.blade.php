@extends('layouts.app')

@section('content')
    <section class="relative table w-full py-32 bg-center bg-no-repeat breadcrumb lg:py-36 page_speed_48133614">
        <div class="absolute inset-0 bg-black opacity-80"></div>
        <div class="container">
            <div class="grid grid-cols-1 mt-10 text-center">
                <h3 class="text-3xl font-medium leading-normal text-white md:text-4xl md:leading-normal">Our News</h3>
                <p class="max-w-2xl mx-auto mt-5 text-white">Below is the latest real estate news we get regularly
                    updated from reliable sources.</p>
            </div>
        </div>
    </section>
    <div class="container mt-16 lg:mt-24">

        <div class="grid grid-cols-1 md:grid-cols-6 md:gap-10">

            <div class="col-span-1 mb-16 md:col-span-4 md:mb-0">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    @foreach ($blogs ?? [] as $blog)
                        <div
                            class="overflow-hidden transition-all bg-white rounded-lg shadow-lg hover:shadow-2xl duration-400 dark:bg-slate-900 dark:border dark:border-slate-800">
                            <div class="overflow-hidden"><a
                                    href="news/4-expert-tips-on-how-to-choose-the-right-mens-wallet.html">
                                    <img src="{{ asset('images/' . $blog->image) }}" alt="{{ $blog->name }}"
                                        class="w-full transition-all duration-300 hover:scale-110"></a>
                            </div>
                            <div class="p-6"><a href="news/{{ $blog->name }}"
                                    class="text-lg transition-all hover:text-secondary">{{ $blog->name }}</a>
                                <ul class="flex gap-3 ps-0 my-2 text-sm list-none text-slate-500 dark:text-slate-300">
                                    <li><i
                                            class="mdi mdi-calendar-outline"></i><span>{{ date('M d, Y', strtotime($blog->created_at)) }}</span>
                                    </li>
                                    <li><a href="news/travel-tips.html" class="text-sm hover:text-primary"><i
                                                class="mdi mdi-tag-outline"></i><span>{{-- $blog->category->name  --}}</span></a></li>
                                    <li><i class="mdi mdi-eye-outline"></i><span>{{ $blog->views }}</span></li>
                                </ul>
                                <p class="mt-3 leading-6 text-slate-600 dark:text-slate-300"
                                    title="{!! Str::limit($blog->description, '30') !!}">
                                    {!! Str::limit($blog->description, '50') !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="col-span-2 space-y-12">

                {{-- <div class="p-6 bg-white rounded-lg shadow dark:bg-slate-800">
                    <h3 class="text-xl font-medium">Popular Categories</h3>
                    <div class="pt-5 mt-4 border-t">
                        <ul class="space-y-2">
                            <li class="transition-all duration-200 hover:text-primary"><i
                                    class="mdi mdi-chevron-right"></i><a href="travel-tips.html" class="font-medium">Travel
                                    Tips</a></li>
                            <li class="transition-all duration-200 hover:text-primary"><i
                                    class="mdi mdi-chevron-right"></i><a href="nature.html" class="font-medium">Nature</a>
                            </li>
                            <li class="transition-all duration-200 hover:text-primary"><i
                                    class="mdi mdi-chevron-right"></i><a href="travel-tips.html" class="font-medium">Travel
                                    Tips</a></li>
                            <li class="transition-all duration-200 hover:text-primary"><i
                                    class="mdi mdi-chevron-right"></i><a href="hotel.html" class="font-medium">Hotel</a>
                            </li>
                            <li class="transition-all duration-200 hover:text-primary"><i
                                    class="mdi mdi-chevron-right"></i><a href="lifestyle.html"
                                    class="font-medium">Lifestyle</a></li>
                        </ul>
                    </div>
                </div> --}}
                <div class="p-6 bg-white rounded-lg shadow dark:bg-slate-800">
                    <h3 class="text-xl font-medium">Popular Posts</h3>
                    <div class="pt-5 mt-4 space-y-4 border-t">
                        @foreach ($blogs ?? [] as $blog2)
                            <div class="flex flex-start"><a
                                    href="{{ route('public.blog_single',$blog2->name) }}"><img
                                        src="{{ asset('images/' . $blog2->image) }}"
                                        alt="Sexy Clutches: How to Buy &amp; Wear a Designer Clutch Bag"
                                        class="max-w-[90px] rounded"></a>
                                <div class="ms-3"><a href=""
                                        class="transition-all hover:text-primary line-clamp-2">
                                        <h5>{{ Str::limit($blog2->name, 30, '...') }}</h5>
                                    </a>
                                    <div class="text-sm text-slate-500"><i class="mdi mdi-calendar-outline"></i><span>{{ date('M d, Y', strtotime($blog2->created_at)) }}</span></div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="p-6 bg-white rounded-lg shadow dark:bg-slate-800 d-none">
                    <h3 class="text-xl font-medium">Popular Tags</h3>
                    <div class="pt-5 mt-4 border-t">
                        <div class="flex flex-wrap gap-3"><a href="../tag/villa.html"
                                class="bg-primary text-white hover:bg-secondary rounded-lg px-3 py-1.5">Villa</a><a
                                href="../tag/new.html"
                                class="bg-primary text-white hover:bg-secondary rounded-lg px-3 py-1.5">New</a><a
                                href="../tag/condo.html"
                                class="bg-primary text-white hover:bg-secondary rounded-lg px-3 py-1.5">Condo</a><a
                                href="../tag/family-home.html"
                                class="bg-primary text-white hover:bg-secondary rounded-lg px-3 py-1.5">Family
                                home</a><a href="../tag/event.html"
                                class="bg-primary text-white hover:bg-secondary rounded-lg px-3 py-1.5">Event</a><a
                                href="../tag/apartment.html"
                                class="bg-primary text-white hover:bg-secondary rounded-lg px-3 py-1.5">Apartment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

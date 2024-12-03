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
                {!! $blog->content !!}

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

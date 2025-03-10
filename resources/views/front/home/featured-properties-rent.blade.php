<div class="container">
    <div class="grid grid-cols-1 pb-8 text-center">
        <h3 class="mb-4 text-2xl font-semibold leading-normal md:text-3xl md:leading-normal">Featured Properties For Rent</h3>
        <p class="max-w-xl mx-auto text-slate-400">
            Explore Featured Properties for Your Dream Home.
        </p>
    </div>
    <div class="">
        @include('front.shortcuts.properties.items-scroll', ['properties' => $featured_properties_rent])
    </div>
</div>

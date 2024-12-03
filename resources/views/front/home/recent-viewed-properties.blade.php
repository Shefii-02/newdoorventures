<div class="container mt-16 lg:mt-24">
    <div class="grid grid-cols-1 pb-8 text-center">
        <h3 class="mb-4 text-2xl font-semibold leading-normal md:text-3xl md:leading-normal">Recent Viewed Properties</h3>
        <p class="max-w-xl mx-auto text-slate-400">A great platform to buy, sell and rent your properties without any
            agent or commissions.</p>
    </div>
    <div class="">
        @include('front.shortcuts.properties.items-scroll', ['properties' => $recent_viwed_properties])
    </div>
</div>


    <div class="container mt-16 lg:mt-24">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h3 class="mb-4 text-2xl font-semibold leading-normal md:text-3xl md:leading-normal">Featured Projects</h3>
            <p class="max-w-xl mx-auto text-slate-400">Discover Exceptional Properties in Our Featured Projects Showcase.            </p>
        </div>
        <div class="">
            @include('front.shortcuts.projects.items-scroll', ['projects' => $featured_project])
        </div>
    </div>


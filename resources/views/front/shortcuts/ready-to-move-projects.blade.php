<div class="card ">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="py-4">
                    <h3 class="fw-bold fs-4">New Launch and Ready to move projects</h3>
                    <h6 class="font-semibold"> Where you can start living</h6>
                </div>
            </div>
            <div class="col-lg-6 text-end">
                <a href="{{ route('public.projects', ['construction' => ['new_launch', 'ready_to_move']]) }}" target="_blank">View all</a>
            </div>
        </div>

        <div
            data-slick='{
            "slidesToShow": 6,
            "slidesToScroll": 1,
            "arrows": true,
            "dots": false,
            "loop":true,
            "infinite": true,
            "responsive": [
                {"breakpoint": 1024, "settings": {"slidesToShow": 3}},
                {"breakpoint": 768, "settings": {"slidesToShow": 2}},
                {"breakpoint": 480, "settings": {"slidesToShow": 1}}
            ]
        }'>
            @foreach($readyToMoveProjects ?? [] as $project)
                <div class="mx-4 text-center">
                    <a target="_blank" href="{{ route('public.project_single', ['uid' => $project->unique_id, 'slug' => $project->slug ]) }}">
                        <img class="rounded-circle"
                        src="{{ asset('images/'.$project->image) }}" onerror="this.src='/themes/images/dummy-image.webp'" alt="{{ $project->name }}" >
                        <h4 class="small fs-16 fw-bold fs-6 truncate">{{ $project->name }}</h4>
                        <h6 class="fs-13 truncate">{{ $project->locality }}</h6>
                        <h6 class="fs-10 truncate">{{ __(':from - :to', ['from' => shorten_price($project->price_from), 'to' => shorten_price($project->price_to)]) }}</h6>
                    </a>
                </div>
            @endforeach
         
        </div>

    </div>
</div>

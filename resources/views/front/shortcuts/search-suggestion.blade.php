<div class="absolute z-10 hidden w-full" id="keyword-suggestion">
     
    @php
    $path = $items->path(); // Get the base path
    $lastSegment = collect(explode('/', $path))->last();

    if($lastSegment == 'projects'){
        $route_name = 'public.project_single';
    }
    else{
       $route_name = 'public.property_single';
    }
    


    @endphp
    <ul class="p-0 m-0 overflow-auto list-none bg-white rounded-md shadow-md max-h-96 dark:bg-slate-900 dark:text-white">
        @forelse($items as $item)

            <li class="px-5 py-2.5 transition-all hover:bg-gray-100 hover:text-primary cursor-pointer dark:hover:bg-slate-800">
                <a href="{{ route($route_name, ['uid' => $item->unique_id, 'slug' => $item->slug]) }}">{{ $item->name }}
                @if($item->city)
                    <p>{{ $item->locality }},{{ $item->city }} {{--, $item->city->state->name --}}</p>
                @endif </a>
            </li>
        @empty
        <li class="px-5 py-2.5 transition-all hover:bg-gray-100 hover:text-primary cursor-pointer dark:hover:bg-slate-800">
            <div class="text-center">
                <a href="#" class="small">No data found..</a>  
                <p>You can rewrite suitable words to better suggest you</p>
            </div>
            
        </li>
        @endforelse
    </ul>
</div>

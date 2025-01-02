<div class="absolute z-10 hidden w-full" id="keyword-suggestion">
    <ul class="p-0 m-0 overflow-auto list-none bg-white rounded-md shadow-md max-h-96 dark:bg-slate-900 dark:text-white">
        @forelse($items as $key => $arrayItem)
            @php
                // Extract the value you need to display
                $displayValue = is_array($arrayItem) ? ($arrayItem['name'] ?? implode(', ', $arrayItem)) : $arrayItem;
            @endphp
            <li class="px-5 py-2.5 transition-all hover:bg-gray-100 hover:text-primary cursor-pointer dark:hover:bg-slate-800">
                <div class="row align-items-center">
                    <div class="col-lg-10">
                        {{-- Safely display the extracted value --}}
                        <strong>{{ $displayValue }}</strong>
                    </div>
                    <div class="col-lg-2 text-end">
                        {{-- Optional badge or additional info --}}
                        <span class="badge bg-primary text-white">{{ $key }}</span>
                    </div>
                </div>
            </li>
        @empty
            <li class="px-5 py-2.5 transition-all hover:bg-gray-100 hover:text-primary cursor-pointer dark:hover:bg-slate-800">
                <div class="text-center">
                    <strong>No data found..</strong>
                    <p class="text-sm text-gray-500">Try different keywords to see better suggestions.</p>
                </div>
            </li>
        @endforelse
    </ul>
</div>

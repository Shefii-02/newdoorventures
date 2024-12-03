<div class="container mt-16 lg:mt-24">
    <div class="grid grid-cols-1 pb-8 text-center">
        <h3 class="mb-4 text-2xl font-semibold leading-normal md:text-3xl md:leading-normal">Latest News
        </h3>
        <p class="max-w-xl mx-auto text-slate-400">Below is the latest real estate news we get regularly
            updated from reliable sources.</p>
    </div>
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        @foreach ($latest_blogs ?? [] as $blog)
            <div
                class="overflow-hidden transition-all bg-white rounded-lg shadow-lg hover:shadow-2xl duration-400 dark:bg-slate-900 dark:border dark:border-slate-800">
                <div class="overflow-hidden"><a href="news/4-expert-tips-on-how-to-choose-the-right-mens-wallet.html">
                    <img src="{{ asset('images/' . $blog->image) }}" alt="{{ $blog->name }}"
                        class="w-full transition-all duration-300 hover:scale-110"></a>
                </div>
                <div class="p-6"><a href="news/4-expert-tips-on-how-to-choose-the-right-mens-wallet.html"
                        class="text-lg transition-all hover:text-secondary">{{ $blog->name }}</a>
                    <ul class="flex gap-3 ps-0 my-2 text-sm list-none text-slate-500 dark:text-slate-300">
                        <li><i class="mdi mdi-calendar-outline"></i><span>{{ date('M d, Y',strtotime($blog->created_at)) }}</span></li>
                        <li><a href="news/travel-tips.html" class="text-sm hover:text-primary"><i
                                    class="mdi mdi-tag-outline"></i><span>{{-- $blog->category->name  --}}</span></a></li>
                        <li><i class="mdi mdi-eye-outline"></i><span>{{ $blog->views }}</span></li>
                    </ul>
                    <p class="mt-3 leading-6 text-slate-600 dark:text-slate-300"
                        title="{!! Str::limit($blog->description,'30') !!}">
                        {!! Str::limit($blog->description,'50') !!}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>

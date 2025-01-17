<div class="col-lg-12 mt-3 px-2">
    @if($consults->count() > 0)
        <div class="border-b border-stroke px-4 pb-2 dark:border-strokedark md:px-6 xl:px-7.5">
            <div class="flex justify-between items-center gap-x-6">
                <div class="w-2/12 text-left"><span class="font-medium">Name</span></div>
                <div class="w-2/12 text-left"><span class="font-medium">Contact</span></div>
                <div class="w-2/12 text-center"><span class="font-medium">Added by/Owner</span></div>
                <div class="w-2/12 text-center"><span class="font-medium">Enquiry For</span></div>
                <div class="w-2/12 text-center"><span class="font-medium">Created at</span></div>
                <div class="w-2/12 text-center"><span class="font-medium">Actions</span></div>
            </div>
        </div>

        <div class="p-4 md:p-6 xl:p-7.5">
            <div class="flex flex-col gap-y-4">
                @foreach ($consults ?? [] as $consult)
                    <div class="flex justify-between items-center gap-x-6">
                        <div class="w-2/12 text-left">
                            <span class="font-medium">{{ $consult->name }}</span>
                        </div>
                        <div class="w-2/12 text-left">
                            <span class="font-medium">{{ $consult->email }}</span><br>
                            <span class="font-medium">{{ $consult->phone }}</span>
                        </div>
                        <div class="w-2/12 text-center">
                            <span
                                class="font-medium">{{ $consult->property ? $consult->property->author->name ?? 'Admin' : 'Admin' }}</span>
                        </div>
                        <div class="w-2/12 text-center">
                            <span
                                class="font-medium px-2.5 py-0.5 text-sm font-medium  {{ $consult->property ? 'text-primary ' : ($consult->project ? 'text-info ' : 'text-danger') }} inline-block text-capitalize rounded">
                                {{ $consult->property ? 'Property' : ($consult->project ?'Project' : 'Deleted') }}
                            </span>
                        </div>
                    
                        <div class="w-2/12 text-center">
                            <span class="font-medium">{!! dateTimeFormat($consult->created_at) !!}</span>
                        </div>
                        <div class="w-2/12 text-center">
                            <div class="flex justify-center">
                                @if (permission_check('Leads Attend'))
                                    <button data-id="{{ $consult->id }}"
                                        class="open-consult-modal block hover:text-meta-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4">
            {{ $consults->appends(['status' => $activeTab])->links() }}
            {{-- {{ $consults->appends(['status' => $activeTab])->links() }} --}}

        </div>
    @else
        <div class="text-center">
            <p class="py-5">No data found..</p>
        </div>
    @endif
</div>

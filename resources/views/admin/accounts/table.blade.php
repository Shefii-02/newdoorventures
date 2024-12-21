<div class="col-lg-12 mt-3 px-2">
    @if($accounts->count() > 0)
        <div class="border-b border-stroke px-4 pb-2 dark:border-strokedark md:px-6 xl:px-7.5">
            <div class="flex  items-center gap-x-6">
                <div class="w-3/12 text-left"><span class="font-medium">Name</span></div>
                <div class="w-3/12 text-left"><span class="font-medium">Contact</span></div>
                <div class="w-2/12 text-center"><span class="font-medium">No:of Properties</span></div>
                <div class="w-2/12 text-center"><span class="font-medium">Created at</span></div>
                <div class="w-2/12 text-right"><span class="font-medium">Actions</span></div>
            </div>
        </div>

        <div class="p-4 md:p-6 xl:p-7.5">
            <div class="flex flex-col gap-y-4">
                @foreach ($accounts as $account)
                    <div class="flex items-center gap-x-6">
                        <div class="w-3/12 text-left">
                            <span class="font-medium">{{ $account->name }}</span><br>
                            <span
                                class="badge text-capitalize {{ $account->is_staff == 1 ? 'bg-dark text-light' : 'bg-success text-light' }}">{{ $account->is_staff == 1 ? 'Staff' : 'Public' }}</span>
                        </div>
                        <div class="w-3/12 text-left">
                            <span class="font-medium">{{ $account->email }}</span><br>
                            <span class="font-medium">{{ $account->phone }}</span>
                        </div>
                        <div class="w-2/12 text-center">
                            <span class="font-medium">{{ $account->properties->count() ?? '--' }}</span>
                        </div>
                        <div class="w-2/12 text-center">
                            <span
                                class="font-medium px-2.5 py-0.5 text-sm font-medium inline-block text-capitalize rounded">
                                {{ date('M d, Y', strtotime($account->created_at)) }}
                            </span>
                        </div>
                    
                        <div class=" d-flex justify-content-end w-2/12">
                            <div class="flex gap-2 ">
                                @if (permission_check('Account Approvel'))
                                    <button data-id="{{ $account->id }}"
                                        class="open-account-modal block hover:text-meta-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                        </svg>
                                    </button>
                                @endif
                                @if (permission_check('Account Delete'))
                                    <form method="POST" id="form_{{ $account->id }}"
                                        action="{{ route('admin.accounts.destroy', $account->id) }}">@csrf
                                        @method('DELETE')</form>
                                    <button form="form_{{ $account->id }}" type="button"
                                        onclick="confirmDelete({{ $account->id }})"
                                        class="mx-auto block hover:text-meta-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z">
                                            </path>
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z">
                                            </path>
                                        </svg>
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
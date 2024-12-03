@extends('admin.layouts.master')

@section('content')
    <div>
        <!-- ===== builders List Start ===== -->
        <div class="col-span-12">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex items-start justify-between">
                        <h2 class="text-title-sm2 font-bold text-black dark:text-white">
                            Builders List
                        </h2>
                        <div class="relative">
                            <a class="bg-primary bg-warning hover:bg-opacity-90 inline-flex items-center justify-center px-6 py-2 rounded-md text-center text-sm text-white"
                                href="{{ route('admin.builders.create') }}">
                                Create
                            </a>
                        </div>
                    </div>
                    
                </div>

                <div class="border-b border-stroke px-4 pb-2 dark:border-strokedark md:px-6 xl:px-7.5">
                    <div class="flex justify-between items-center gap-x-6">
                        <div class="w-2/12 text-left"><span class="font-medium">Name</span></div>
                        <div class="w-2/12 text-center"><span class="font-medium">Ongoing Projects</span></div>
                        <div class="w-2/12 text-center"><span class="font-medium">completed Projects</span></div>
                        <div class="w-2/12 text-center"><span class="font-medium">Created at</span></div>
                        <div class="w-2/12 text-center"><span class="font-medium">Status</span></div>
                        <div class="w-2/12 text-end"><span class="font-medium">Actions</span></div>
                    </div>
                </div>

                <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex flex-col gap-y-4">
                        @foreach ($builders as $builder)
                            <div class="flex justify-between items-center gap-x-6">
                                <div class="w-2/12 text-left">
                                    <span class="font-medium">{{ $builder->name }}</span>
                                </div>
                                <div class="w-2/12 text-center">
                                    <span class="font-medium">{{ $builder->ongoing }}</span>
                                </div>
                                <div class="w-2/12 text-center">
                                    <span class="font-medium">{{ $builder->completed }}</span>
                                </div>
                                <div class="w-2/12 text-center">
                                    <span
                                        class="font-medium px-2.5 py-0.5 text-sm font-medium inline-block text-capitalize rounded">
                                        {{ date('M d, Y',strtotime($builder->created_at))}}
                                    </span>
                                </div>
                                <div class="w-2/12 text-center">
                                    <span
                                        class="inline-block text-capitalize rounded px-2.5 py-0.5 text-sm font-medium text-white {{ $builder->status === 'unread' ? 'bg-warning' :($builder->status === 'suspended' ? 'bg-red' : 'bg-success')}}">
                                        {{ $builder->status }}
                                    </span>
                                </div>
                                <div class=" w-2/12 text-end">
                                    <div class=" btn-group">
                                        <a href="{{ route('admin.builders.edit',$builder->id) }}" class="mx-auto block hover:text-meta-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325">
                                                </path>
                                            </svg>
                                        </a>
                                        <form method="POST" id="form_{{ $builder->id }}" action="{{ route('admin.builders.destroy',$builder->id) }}">@csrf @method('DELETE')</form>
                                        <button form="form_{{ $builder->id }}" type="submit" class="ms-3 mx-auto block hover:text-meta-1">
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
                                    </div>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div id="builder-modal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded shadow-lg w-1/2">
                <div id="builder-modal-content"></div>
            </div>
        </div>
        <!-- ===== builders List End ===== -->
    </div>
@endsection

@push('footer')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('builder-modal');
            const modalContent = document.getElementById('builder-modal-content');

            document.querySelectorAll('.open-builder-modal').forEach(button => {
                button.addEventListener('click', async (e) => {
                    const builderId = e.target.closest('button').getAttribute('data-id');

                    // Fetch the builder details
                    const response = await fetch(`/admin/builders/${builderId}`);
                    const html = await response.text();

                    modalContent.innerHTML = html;
                    modal.classList.remove('hidden');
                });
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modalContent.innerHTML = '';
                }
            });
        });
    </script>
@endpush

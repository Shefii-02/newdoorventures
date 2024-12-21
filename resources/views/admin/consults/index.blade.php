@extends('admin.layouts.master')

@section('content')
    <div class="py-4">
        <div
            class="rounded-md border border-stroke bg-whiter p-4 py-3 dark:border-strokedark dark:bg-meta-4 sm:px-6 sm:py-5.5 xl:px-7.5">
            <nav>
                <ol class="flex flex-wrap items-center gap-2">
                    <li>
                        <a class="flex items-center gap-2 font-medium text-black hover:text-primary dark:text-white dark:hover:text-primary"
                            href="{{ route('admin.dashboard.index') }}">
                            <svg class="fill-current" width="15" height="15" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.3503 14.6504H10.2162C9.51976 14.6504 8.93937 14.0698 8.93937 13.373V10.8183C8.93937 10.5629 8.73043 10.3538 8.47505 10.3538H6.54816C6.29279 10.3538 6.08385 10.5629 6.08385 10.8183V13.3498C6.08385 14.0465 5.50346 14.6272 4.80699 14.6272H1.62646C0.929989 14.6272 0.349599 14.0465 0.349599 13.3498V5.24444C0.349599 4.89607 0.535324 4.57092 0.837127 4.38513L6.96604 0.506623C7.29106 0.297602 7.73216 0.297602 8.05717 0.506623L14.1861 4.38513C14.4879 4.57092 14.6504 4.89607 14.6504 5.24444V13.3266C14.6504 14.0698 14.07 14.6504 13.3503 14.6504ZM6.52495 9.54098H8.45184C9.14831 9.54098 9.7287 10.1216 9.7287 10.8183V13.3498C9.7287 13.6053 9.93764 13.8143 10.193 13.8143H13.3503C13.6057 13.8143 13.8146 13.6053 13.8146 13.3498V5.26766C13.8146 5.19799 13.7682 5.12831 13.7218 5.08186L7.61608 1.20336C7.54643 1.15691 7.45357 1.15691 7.40714 1.20336L1.27822 5.08186C1.20858 5.12831 1.18536 5.19799 1.18536 5.26766V13.373C1.18536 13.6285 1.3943 13.8375 1.64967 13.8375H4.80699C5.06236 13.8375 5.2713 13.6285 5.2713 13.373V10.8183C5.24809 10.1216 5.82848 9.54098 6.52495 9.54098Z"
                                    fill=""></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="flex items-center gap-2 font-medium">
                        <svg class="fill-current" width="18" height="7" viewBox="0 0 18 7" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.5704 2.58734L14.8227 0.510459C14.6708 0.333165 14.3922 0.307837 14.1896 0.459804C14.0123 0.61177 13.9869 0.890376 14.1389 1.093L15.7852 3.04324H1.75361C1.50033 3.04324 1.29771 3.24586 1.29771 3.49914C1.29771 3.75241 1.50033 3.95504 1.75361 3.95504H15.7852L14.1389 5.90528C13.9869 6.08257 14.0123 6.36118 14.1896 6.53847C14.2655 6.61445 14.3668 6.63978 14.4682 6.63978C14.5948 6.63978 14.7214 6.58913 14.7974 6.48782L16.545 4.41094C17.0009 3.85373 17.0009 3.09389 16.5704 2.58734Z"
                                fill=""></path>
                        </svg>
                        Leads List
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div x-data="{ activeTab: '{{ request()->status ?? 'unread' }}' }">
        <!-- ===== Consults List Start ===== -->
        <div class="col-span-12">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex items-start justify-between">
                        <h2 class="text-title-sm2 font-bold text-black dark:text-white">
                            Leads List
                        </h2>
                    </div>
                </div>
        
                <div class="col-span-12 px-4 mt-3">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button
                                :class="{ 'active': activeTab === 'unread' }"
                                {{-- @click="activeTab = 'unread'" --}}
                                @click="activeTab = 'unread'; window.history.replaceState(null, '', window.location.pathname + '?status=unread')"
                                class="nav-link"
                                type="button"
                                role="tab"
                            >Unread</button>
                            <button
                                :class="{ 'active': activeTab === 'attended' }"
                                {{-- @click="activeTab = 'attended'" --}}
                                @click="activeTab = 'attended'; window.history.replaceState(null, '', window.location.pathname + '?status=attended')"
                                class="nav-link"
                                type="button"
                                role="tab"
                            >Attended</button>
                        </div>
                    </nav>
        
                    <div class="tab-content" id="nav-tabContent">
                        <!-- Unread Tab -->
                        <div x-show="activeTab === 'unread'" class="tab-pane fade show active" id="nav-home"
                            aria-labelledby="nav-home-tab">
                            @include('admin.consults.table', ['consults' => $consults_unreaded,'activeTab' => 'unread'])
                        </div>

                        <!-- Attended Tab -->
                        <div x-show="activeTab === 'attended'" class="tab-pane show active" id="nav-profile"
                            aria-labelledby="nav-profile-tab">
                            @include('admin.consults.table', ['consults' => $consults_attended,'activeTab' => 'attended'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    <!-- Modal -->
    <div id="consult-modal" class="hidden fixed inset-0 z-9999 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow-lg w-1/2">
            <div id="consult-modal-content"></div>
        </div>
    </div>
    <!-- ===== Consults List End ===== -->
@endsection

@push('footer')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('consult-modal');
            const modalContent = document.getElementById('consult-modal-content');

            document.querySelectorAll('.open-consult-modal').forEach(button => {
                button.addEventListener('click', async (e) => {
                    const consultId = e.target.closest('button').getAttribute('data-id');

                    // Fetch the consult details
                    const response = await fetch(`/admin/consults/${consultId}`);
                    const html = await response.text();

                    modalContent.innerHTML = html;
                    modal.classList.remove('hidden');
                });
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
@endpush

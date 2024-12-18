@extends('admin.layouts.master')

@section('content')
    <div>
        <!-- ===== Categories List Start ===== -->
        <div class="col-span-12">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex  items-start justify-between">
                        <div>
                            <h2 class="text-title-sm2 font-bold text-black dark:text-white">
                               Activities
                            </h2>
                        </div>
                        <div class="relative">
                           
                        </div>
                    </div>
                </div>

                <div class="border-b border-stroke px-4 pb-2 dark:border-strokedark md:px-6 xl:px-7.5">

                    <div class="flex items-center gap-3">
                        <div class="w-2/12 xl:w-2/12">
                            <span class="font-medium">Action</span>
                        </div>
                        <div class="w-4/12 xl:w-4/12">
                            <span class="font-medium">Activity</span>
                        </div>
                        <div class="w-2/12 xl:w-2/12">
                            <span class="font-medium">User</span>
                        </div>
                        <div class="w-4/12 2xsm:w-4/12 md:w-4/12 xl:w-4/12">
                            <span class="font-medium">Date & Time</span>
                        </div>
                        
                    </div>
                </div>

                <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex flex-col gap-7">
                        @foreach ($activities as $item)
                            <div class="flex  items-center gap-3">
                                <div class="w-2/12 xl:w-2/12">
                                    <div class="flex items-center gap-4">
                                        <span class="hidden font-medium xl:block text-capitalize">{{ str_replace('_',' ',$item->action )}}</span>
                                    </div>
                                </div>
                                <div class="w-4/12 xl:w-4/12">
                                    <div class="flex items-center gap-4">
                                        <span class="hidden font-medium xl:block">{{ $item->reference_name }}</span>
                                    </div>
                                </div>
                                <div class="w-2/12 xl:w-2/12">
                                    <div class="flex items-center gap-4">
                                      
                                        <span class="hidden font-medium xl:block">{{ $item->account->name }}</span>
                                    </div>
                                </div>
                                
                                <div class="w-4/12 2xsm:w-4/12 md:w-4/12 xl:w-4/12">
                                        {{ date('d M, Y h:i:s a',strtotime($item->created_at)) }}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="py-5">
                    {{ $activities->links() }}
                </div>
              
            </div>
        </div>
        <!-- ===== Categories List End ===== -->
    </div>
@endsection

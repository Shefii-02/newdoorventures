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
                                Newsletter subscription List
                            </h2>
                        </div>
                        <div class="relative">
                           
                        </div>
                    </div>
                </div>

                <div class="border-b border-stroke px-4 pb-2 dark:border-strokedark md:px-6 xl:px-7.5">

                    <div class="flex items-center gap-3">
                        <div class="w-2/12 xl:w-3/12">
                            <span class="font-medium">Email</span>
                        </div>
                        <div class="w-4/12 2xsm:w-3/12 md:w-2/12 xl:w-1/12">
                            <span class="font-medium">Created at</span>
                        </div>
                        
                    </div>
                </div>

                <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex flex-col gap-7">
                        @foreach ($newsletter as $item)
                            <div class="flex  items-center gap-3">
                                <div class="w-2/12 xl:w-3/12">
                                    <div class="flex items-center gap-4">
                                        <span class="hidden font-medium xl:block">{{ $item->email }}</span>
                                    </div>
                                </div>
                                <div class="w-4/12 2xsm:w-3/12 md:w-2/12 xl:w-1/12">
                                        {{ $item->created_at }}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <!-- ===== Categories List End ===== -->
    </div>
@endsection

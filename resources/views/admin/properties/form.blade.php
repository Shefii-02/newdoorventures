@extends('admin.layouts.master')
@push('header')
@endpush
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
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.51145 1.55118L13.465 5.33306V13.3498C13.465 13.4121 13.4126 13.4646 13.3503 13.4646H10.193C10.1307 13.4646 10.0783 13.4121 10.0783 13.3498V10.8183C10.0783 9.92844 9.34138 9.19125 8.45184 9.19125H6.52495C5.63986 9.19125 4.89529 9.92534 4.9217 10.8238V13.373C4.9217 13.4354 4.86929 13.4878 4.80699 13.4878H1.64967C1.58738 13.4878 1.53496 13.4354 1.53496 13.373V5.33323L7.51145 1.55118ZM1.27822 5.08186L7.40714 1.20336C7.45357 1.15691 7.54643 1.15691 7.61608 1.20336L13.7218 5.08186C13.7682 5.12831 13.8146 5.19799 13.8146 5.26766V13.3498C13.8146 13.6053 13.6057 13.8143 13.3503 13.8143H10.193C9.93764 13.8143 9.7287 13.6053 9.7287 13.3498V10.8183C9.7287 10.1216 9.14831 9.54098 8.45184 9.54098H6.52495C5.82848 9.54098 5.24809 10.1216 5.2713 10.8183V13.373C5.2713 13.6285 5.06236 13.8375 4.80699 13.8375H1.64967C1.3943 13.8375 1.18536 13.6285 1.18536 13.373V5.26766C1.18536 5.19799 1.20858 5.12831 1.27822 5.08186ZM13.3503 15.0001H10.2162C9.32668 15.0001 8.58977 14.2629 8.58977 13.373V10.8183C8.58977 10.756 8.53735 10.7036 8.47505 10.7036H6.54816C6.48587 10.7036 6.43345 10.756 6.43345 10.8183V13.3498C6.43345 14.2397 5.69654 14.9769 4.80699 14.9769H1.62646C0.736911 14.9769 0 14.2397 0 13.3498V5.24444C0 4.77143 0.251303 4.33603 0.651944 4.08848L6.77814 0.211698C7.21781 -0.0704034 7.80541 -0.0704031 8.24508 0.211698C8.24546 0.211943 8.24584 0.212188 8.24622 0.212433L14.3713 4.08851C14.7853 4.34436 15 4.78771 15 5.24444V13.3266C15 14.2589 14.2671 15.0001 13.3503 15.0001ZM14.1861 4.38513L8.05717 0.506623C7.73216 0.297602 7.29106 0.297602 6.96604 0.506623L0.837127 4.38513C0.535324 4.57092 0.349599 4.89607 0.349599 5.24444V13.3498C0.349599 14.0465 0.929989 14.6272 1.62646 14.6272H4.80699C5.50346 14.6272 6.08385 14.0465 6.08385 13.3498V10.8183C6.08385 10.5629 6.29279 10.3538 6.54816 10.3538H8.47505C8.73043 10.3538 8.93937 10.5629 8.93937 10.8183V13.373C8.93937 14.0698 9.51976 14.6504 10.2162 14.6504H13.3503C14.07 14.6504 14.6504 14.0698 14.6504 13.3266V5.24444C14.6504 4.89607 14.4879 4.57092 14.1861 4.38513Z"
                                fill=""></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-3 font-medium" href="{{ route('admin.properties.index') }}">
                        <svg class="fill-current" width="18" height="7" viewBox="0 0 18 7" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.5704 2.58734L14.8227 0.510459C14.6708 0.333165 14.3922 0.307837 14.1896 0.459804C14.0123 0.61177 13.9869 0.890376 14.1389 1.093L15.7852 3.04324H1.75361C1.50033 3.04324 1.29771 3.24586 1.29771 3.49914C1.29771 3.75241 1.50033 3.95504 1.75361 3.95504H15.7852L14.1389 5.90528C13.9869 6.08257 14.0123 6.36118 14.1896 6.53847C14.2655 6.61445 14.3668 6.63978 14.4682 6.63978C14.5948 6.63978 14.7214 6.58913 14.7974 6.48782L16.545 4.41094C17.0009 3.85373 17.0009 3.09389 16.5704 2.58734Z"
                                fill=""></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M14.1896 0.459804C14.3922 0.307837 14.6708 0.333165 14.8227 0.510459L16.5704 2.58734C17.0009 3.09389 17.0009 3.85373 16.545 4.41094L14.7974 6.48782C14.7214 6.58913 14.5948 6.63978 14.4682 6.63978C14.3668 6.63978 14.2655 6.61445 14.1896 6.53847C14.0123 6.36118 13.9869 6.08257 14.1389 5.90528L15.7852 3.95504H1.75361C1.50033 3.95504 1.29771 3.75241 1.29771 3.49914C1.29771 3.24586 1.50033 3.04324 1.75361 3.04324H15.7852L14.1389 1.093C13.9869 0.890376 14.0123 0.61177 14.1896 0.459804ZM15.0097 2.68302H1.75362C1.3014 2.68302 0.9375 3.04692 0.9375 3.49914C0.9375 3.95136 1.3014 4.31525 1.75362 4.31525H15.0097L13.8654 5.67085C13.8651 5.67123 13.8648 5.67161 13.8644 5.67199C13.5725 6.01385 13.646 6.50432 13.9348 6.79318C14.1022 6.96055 14.3113 7 14.4682 7C14.6795 7 14.9203 6.91713 15.0784 6.71335L16.8207 4.64286L16.8238 4.63904C17.382 3.95682 17.3958 3.00293 16.8455 2.35478C16.8453 2.35453 16.845 2.35429 16.8448 2.35404L15.0984 0.278534L15.0962 0.276033C14.8097 -0.0583053 14.3139 -0.0837548 13.9734 0.17163L13.964 0.17867L13.9551 0.186306C13.6208 0.472882 13.5953 0.968616 13.8507 1.30913L13.857 1.31743L15.0097 2.68302Z"
                                fill=""></path>
                        </svg>
                        <span class="hover:text-primary">Properties</span>
                    </a>
                </li>
                <li class="flex items-center gap-2 font-medium">
                    <svg class="fill-current" width="18" height="7" viewBox="0 0 18 7" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.5704 2.58734L14.8227 0.510459C14.6708 0.333165 14.3922 0.307837 14.1896 0.459804C14.0123 0.61177 13.9869 0.890376 14.1389 1.093L15.7852 3.04324H1.75361C1.50033 3.04324 1.29771 3.24586 1.29771 3.49914C1.29771 3.75241 1.50033 3.95504 1.75361 3.95504H15.7852L14.1389 5.90528C13.9869 6.08257 14.0123 6.36118 14.1896 6.53847C14.2655 6.61445 14.3668 6.63978 14.4682 6.63978C14.5948 6.63978 14.7214 6.58913 14.7974 6.48782L16.545 4.41094C17.0009 3.85373 17.0009 3.09389 16.5704 2.58734Z"
                            fill=""></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M14.1896 0.459804C14.3922 0.307837 14.6708 0.333165 14.8227 0.510459L16.5704 2.58734C17.0009 3.09389 17.0009 3.85373 16.545 4.41094L14.7974 6.48782C14.7214 6.58913 14.5948 6.63978 14.4682 6.63978C14.3668 6.63978 14.2655 6.61445 14.1896 6.53847C14.0123 6.36118 13.9869 6.08257 14.1389 5.90528L15.7852 3.95504H1.75361C1.50033 3.95504 1.29771 3.75241 1.29771 3.49914C1.29771 3.24586 1.50033 3.04324 1.75361 3.04324H15.7852L14.1389 1.093C13.9869 0.890376 14.0123 0.61177 14.1896 0.459804ZM15.0097 2.68302H1.75362C1.3014 2.68302 0.9375 3.04692 0.9375 3.49914C0.9375 3.95136 1.3014 4.31525 1.75362 4.31525H15.0097L13.8654 5.67085C13.8651 5.67123 13.8648 5.67161 13.8644 5.67199C13.5725 6.01385 13.646 6.50432 13.9348 6.79318C14.1022 6.96055 14.3113 7 14.4682 7C14.6795 7 14.9203 6.91713 15.0784 6.71335L16.8207 4.64286L16.8238 4.63904C17.382 3.95682 17.3958 3.00293 16.8455 2.35478C16.8453 2.35453 16.845 2.35429 16.8448 2.35404L15.0984 0.278534L15.0962 0.276033C14.8097 -0.0583053 14.3139 -0.0837548 13.9734 0.17163L13.964 0.17867L13.9551 0.186306C13.6208 0.472882 13.5953 0.968616 13.8507 1.30913L13.857 1.31743L15.0097 2.68302Z"
                            fill=""></path>
                    </svg>
                    {{ isset($property) ? 'Edit' : 'Create' }}
                </li>
            </ol>
        </nav>
    </div>
</div>
    <div>
        <!-- ===== builders List Start ===== -->
        <div class="col-span-12">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex items-start justify-between">
                        <h2 class="text-title-sm2 font-bold text-black dark:text-white">
                            Properties Create
                        </h2>
                        <div class="relative">
                            <a class="bg-primary bg-warning hover:bg-opacity-90 inline-flex items-center justify-center px-6 py-2 rounded-md text-center text-sm text-white"
                                href="{{ route('admin.properties.index') }}">
                                Back to list
                            </a>
                        </div>
                    </div>

                </div>
                <div x-data="stepper()" class="container bg-white rounded-lg shadow-lg p-6 mt-5">
                    <div class="" x-data="formHandler()">

                        <form method="POST" @submit.prevent="submitForm" id="propertyFrom"
                            action="{{ route('user.properties.store') }}" enctype="multipart/form-data">
                            @csrf
                        </form>


                        <div x-show="showToast" x-transition
                            :class="toastType === 'success' ? 'bg-success text-light' : 'bg-danger text-light'"
                            class="fixed top-5 right-5 text-white p-3 rounded shadow-lg transition">

                            <p x-html="toastMessage"></p>

                        </div>
                    </div>

                    <div class="d-flex flex-column flex-lg-row">
                        <!-- Stepper Navigation -->
                        <div class="col-lg-3 border-end pe-lg-3 mb-4 mb-lg-0 bg-white position-sticky top-0">
                            <ul class="nav flex-row flex-lg-column overflow-auto gap-3 gap-lg-0" style="z-index: 1000;">
                                <template x-for="(step, index) in steps" :key="index">
                                    <li role="button" class="nav-item d-flex align-items-center mb-lg-4 step-items"
                                        @click="jumpToStep(index)">
                                        <!-- Step Circle -->
                                        <div class="d-flex align-items-center justify-content-center border rounded-circle me-3"
                                            :class="{
                                                'active bg-primary text-white border-primary': index <= currentStep,
                                                'bg-light text-muted border-secondary': index > currentStep
                                            }"
                                            style="width: 2rem; height: 2rem;">
                                            <span x-text="index + 1"></span>
                                        </div>

                                        <!-- Step Titles -->
                                        <div>
                                            <p class="mb-0 fw-medium"
                                                :class="{
                                                    'text-primary': index === currentStep,
                                                    'text-secondary': index !==
                                                        currentStep
                                                }"
                                                x-text="step.title"></p>
                                        </div>
                                    </li>
                                </template>

                                <li class="nav-item d-flex align-items-center step-items">
                                    <!-- Step Circle -->
                                    <div class="d-flex align-items-center justify-content-center border rounded-circle me-3 bg-light text-muted"
                                        style="width: 2rem; height: 2rem;">
                                        <i class="bi bi-check-lg fs-5 fw-bold text-dark"></i>
                                    </div>

                                    <!-- Step Titles -->
                                    <div>
                                        <span class="fw-medium">Property Overview</span>
                                    </div>
                                </li>
                            </ul>
                        </div>




                        <!-- Step Content -->
                        <div class="col-lg-9  ps-lg-3">
                            <!-- Progress Bar -->
                            <div class="progress mb-3" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    :style="'width: ' + progressBarWidth + '%'" aria-valuenow="progressBarWidth"
                                    aria-valuemin="0" aria-valuemax="100" x-transition>
                                </div>
                            </div>
                            <div class="space-y-8">
                                <!-- Step 1 -->
                                <div x-show="currentStep === 0" class="mt-2">
                                    <!-- Stepper Navigation -->
                                    <div id="pageTitleDescription">
                                        <h1 class="my-1 fw-bold fs-1">
                                            Welcome back,
                                            @if (auth()->check())
                                                {{ auth()->user()->name }}
                                            @else
                                                ---
                                            @endif
                                        </h1>

                                        <h4 class="fw-bold text-dark fs-3 mt-2">Sell or Rent Customer Property</h4>
                                        <h6 class="text-dark fs-5 mt-2">You are posting this property for
                                            <span
                                                class="ms-1 bg-warning text-light px-2 py-1 rounded-pill fs-5">FREE!</span>
                                        </h6>
                                        <br>
                                    </div>

                                    <div x-data="propertyForm()" x-init="init()" class="p-2 space-y-2">
                                        <!-- Mode Selection -->
                                        <div>
                                            <h6 class="mb-3 mt-3 fw-medium">I'm looking to<sup
                                                    class="text-danger fs-4">*</sup></h6>
                                            <div class="d-flex gap-3">
                                                <div>
                                                    <input form="propertyForm" type="radio" class="btn-check"
                                                        id="sell" name="mode" value="sell"
                                                        @change="updateMode('sell')" checked>
                                                    <label class="btn btn-outline-secondary" for="sell">Sell</label>
                                                </div>
                                                <div>
                                                    <input form="propertyForm" type="radio" class="btn-check"
                                                        id="rent" name="mode" value="rent"
                                                        @change="updateMode('rent')">
                                                    <label class="btn btn-outline-secondary"
                                                        for="rent">Rent/Lease</label>
                                                </div>
                                                <div>
                                                    <input form="propertyForm" type="radio" class="btn-check"
                                                        id="pg" name="mode" value="pg"
                                                        @change="updateMode('pg')">
                                                    <label class="btn btn-outline-secondary" for="pg">PG</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Type Selection -->
                                        <div>
                                            <h6 class="mb-3 mt-3 fw-medium">What kind of property do you have?<sup
                                                    class="text-danger fs-4">*</sup></h6>
                                            <div class="d-flex flex-wrap gap-3">
                                                <template x-for="type in types" :key="type">
                                                    <div class="form-check">
                                                        <input form="propertyForm" type="radio"
                                                            :id="type.toLowerCase() + '-radio'" :value="type"
                                                            name="type" x-model="currentType"
                                                            @change="updateCategories()" class="form-check-input">
                                                        <label :for="type.toLowerCase() + '-radio'" class="form-check-label"
                                                            x-text="type"></label>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- Categories -->
                                        <div>
                                            <h6 class="mb-3 mt-3 fw-medium">Choose a Category<sup
                                                    class="text-danger fs-4">*</sup></h6>
                                            <div class="d-flex flex-wrap gap-3">
                                                <template x-for="category in categories" :key="category.id">
                                                    <div>
                                                        <input form="propertyForm" type="radio" class="btn-check"
                                                            @change="selectedCategory(category.name)"
                                                            :id="'category_' + category.id" :value="category.id"
                                                            name="category" x-model="currentCategory">
                                                        <label :for="'category_' + category.id"
                                                            class="btn btn-outline-secondary"
                                                            x-text="category.name"></label>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Step 2 -->
                                <div x-show="currentStep === 1" class="space-y-4 mt-2">

                                    <div x-data="locationForm()" x-init="init2()" class="mb-5">

                                        <!-- Location form header -->
                                        <div class="col-lg-12 mb-3 mx-2">
                                            <h1 class="my-1 fw-bold fs-1 mt-2">Where is your property located?</h1>
                                            <h4 class="fw-bold text-dark fs-3 mt-2">An accurate location helps you connect
                                                with the
                                                right buyers
                                            </h4>
                                        </div>

                                       
                                        <!-- Form inputs (City, Locality, etc.) - Show only when form is filled -->
                                        <div x-data="{ isModalOpen2: false }" class="section mt-5">
                                            <div class="mx-2 mb-5">
                                                <label for="city-input"
                                                    class="block mb-2 text-sm font-medium text-gray-500">
                                                    Enter Location/Address<sup class="text-danger fs-4">*</sup></label>
                                                <div class="relative z-0 w-full mb-5 group">
                                                    <div class="flex">
                                                        <input type="text" id="location" form="propertyFrom"
                                                            name="location_info" autocomplete="off"
                                                            class="bg-gray-50 text-dark border border-gray-300 text-sm rounded-s-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                        {{-- <span role="button"
                                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-e-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="#cba641" class="bi bi-crosshair">
                                                <path
                                                    d="M8.5.5a.5.5 0 0 0-1 0v.518A7 7 0 0 0 1.018 7.5H.5a.5.5 0 0 0 0 1h.518A7 7 0 0 0 7.5 14.982v.518a.5.5 0 0 0 1 0v-.518A7 7 0 0 0 14.982 8.5h.518a.5.5 0 0 0 0-1h-.518A7 7 0 0 0 8.5 1.018zm-6.48 7A6 6 0 0 1 7.5 2.02v.48a.5.5 0 0 0 1 0v-.48a6 6 0 0 1 5.48 5.48h-.48a.5.5 0 0 0 0 1h.48a6 6 0 0 1-5.48 5.48v-.48a.5.5 0 0 0-1 0v.48A6 6 0 0 1 2.02 8.5h.48a.5.5 0 0 0 0-1zM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                            </svg>
                                        </span> --}}
                                                    </div>

                                                    <div class="w-full mt-4">
                                                        <span>Or</span>
                                                        <div class="text-start mt-2">
                                                            <button @click="isModalOpen2 = true"
                                                                class="text-blue-600 underline" role="button">
                                                                Get Location details from outside <span
                                                                    class="text-theme">How to?</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div x-show="isModalOpen2" tabindex="-1" style="display: none"
                                                    class="fixed top-0 left-0 right-0 z-50 w-full h-full flex justify-center items-center bg-gray-800 bg-opacity-50"
                                                    x-cloak>
                                                    <div class="relative w-full max-w-md">
                                                        <!-- Modal content -->
                                                        <div class="bg-white rounded-lg shadow dark:bg-gray-700">

                                                            <!-- Modal body -->
                                                            <div class="p-4 md:p-5">
                                                                <div class="d-flex justify-between">
                                                                    <div>
                                                                        <h3
                                                                            class="text-xl font-medium text-dark-900 dark:text-white">
                                                                            How to get Address based latitude and longitude
                                                                        </h3>
                                                                        <h6 class="text-sm text-gray-600">A step-by-step
                                                                            guide</h6>
                                                                    </div>
                                                                    <button @click="isModalOpen2 = false"
                                                                        class="text-gray-400 hover:bg-gray-200 rounded-lg text-sm  dark:hover:bg-gray-600">
                                                                        <svg class="w-3 h-3"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                        </svg>
                                                                    </button>
                                                                </div>

                                                                <img src="{{ asset('images/general/address-getting.png') }}"
                                                                    class="w-full rounded-lg mt-5"
                                                                    alt="How To get latitude and longitude ">
                                                                <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                                    target="_new" class="mt-3"><span>Click the
                                                                        link</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="grid md:grid-cols-3 md:gap-6">

                                                <!-- City Input -->
                                                <div class="relative z-0 w-full mb-5 group">
                                                    <input form="propertyFrom" name="city" type="text"
                                                        id="auto_city" autocomplete="off"
                                                        class="block px-2.5  w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 pt-3 pb-2 appearance-none   dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder=" " />
                                                    <label for="auto_city"
                                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                                        City<sup class="text-danger fs-4">*</sup></label>
                                                </div>

                                                <!-- Locality Input -->
                                                <div class="relative z-0 w-full mb-5 group">
                                                    <input form="propertyFrom" name="locality" type="text"
                                                        id="auto_locality" autocomplete="off"
                                                        class="block px-2.5 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 pt-3 pb-2 appearance-none  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder=" " />
                                                    <label for="auto_locality"
                                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                                        Locality<sup class="text-danger fs-4">*</sup>
                                                    </label>
                                                </div>
                                                <!-- Sub Locality Input -->
                                                <div class="relative z-0 w-full mb-5 group">
                                                    <input form="propertyFrom" name="sub_locality" type="text"
                                                        id="auto_subLocality" autocomplete="off"
                                                        class="block px-2.5  w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 pt-3 pb-2 appearance-none   dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder=" " />
                                                    <label for="auto_subLocality"
                                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                                        Sub Locality (Optional)</label>
                                                </div>

                                            </div>

                                            <div class="grid md:grid-cols-2 md:gap-6">

                                                <!-- Landmark Input -->
                                                <div class="relative z-0 w-full mb-5 group">
                                                    <input form="propertyFrom" name="landmark" type="text"
                                                        id="auto_landmark" autocomplete="off"
                                                        class="block px-2.5  w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 pt-3 pb-2 appearance-none   dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder=" " />
                                                    <label for="auto_landmark"
                                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Landmark
                                                        (Optional)</label>
                                                </div>
                                            </div>
                                            <div class="grid md:grid-cols-2 md:gap-6">
                                                <!-- Latitude Input -->
                                                <div class="relative z-0 w-full mb-5 group">
                                                    <input form="propertyFrom" name="latitude" type="text"
                                                        id="auto_latitude" autocomplete="off"
                                                        class="block px-2.5  w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 pt-3 pb-2 appearance-none   dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder=" " />
                                                    <label for="auto_latitude"
                                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Latitude
                                                    </label>
                                                </div>

                                                <!-- longitude Input -->
                                                <div class="relative z-0 w-full mb-5 group">
                                                    <input form="propertyFrom" name="longitude" type="text"
                                                        id="auto_longitude" autocomplete="off"
                                                        class="block px-2.5 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 pt-3 pb-2 appearance-none  dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder=" " />
                                                    <label for="auto_longitude"
                                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Longitude</label>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div x-show="currentStep === 2" class="space-y-4 mt-2">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12 mb-3 mx-2">
                                            <h1 class="my-1 fw-bold fs-1 mt-2">
                                                Tell us about your property
                                            </h1>
                                            <h4 class="fw-bold text-dark fs-3 mt-2">Better your property score, greater
                                                your visibility
                                            </h4>
                                        </div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="mb-5 col-lg-6">
                                                    <div class="mx-2 mb-5 card p-3">
                                                        <!-- Property Name -->
                                                        <h5 class="mt-3 mb-2 font-medium">Property Name<sup
                                                                class="text-danger fs-4">*</sup>
                                                        </h5>
                                                        <div class="relative z-0 w-full mb-3 group">
                                                            <input form="propertyFrom" name="property_name"
                                                                type="text" autocomplete="off" id="name"
                                                                class="block px-2.5 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 pt-3 pb-2 appearance-none dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                placeholder=" " />
                                                            <label for="name"
                                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                                                Name</label>
                                                        </div>
                                                        <div class="relative z-0 w-full mb-3 group">
                                                            <input form="propertyFrom" name="unit_info" type="text"
                                                                autocomplete="off" id="unit-info"
                                                                class="block px-2.5 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 pt-3 pb-2 appearance-none dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                placeholder="Like Example: 2BHK or 3 BHK,...." />
                                                            <label for="unit-info"
                                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                                                Unit info</label>
                                                        </div>
                                                        <div id="room-section"
                                                            class="HideUnwantedSectionsInPlot HideUnwantedSectionsInPg">
                                                            <h5 class="mt-3 font-medium">Add Room Details</h5>
                                                            <!-- Bedrooms Section -->
                                                            <div class="section" x-data="addOtherBedrooms()">

                                                                <h6 class="mt-3">No. of Bedrooms<sup
                                                                        class="text-danger fs-4">*</sup>
                                                                </h6>
                                                                <div class="mt-3">
                                                                    <ul class="flex flex-wrap gap-3">
                                                                        @for ($i = 1; $i < 5; $i++)
                                                                            <li class="relative mb-1">
                                                                                <input form="propertyFrom"
                                                                                    class="sr-only peer"
                                                                                    @if ($i == 1) checked @endif
                                                                                    type="radio"
                                                                                    value="{{ $i }}"
                                                                                    name="room"
                                                                                    id="room_{{ $i }}">
                                                                                <label
                                                                                    class="mx-1 px-3 py-1 bg-white border border-gray-300 rounded-5 cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-green-500 peer-checked:ring-2 peer-checked:border-transparent"
                                                                                    for="room_{{ $i }}">{{ $i }}</label>
                                                                            </li>
                                                                        @endfor
                                                                        <li class="relative mb-1">
                                                                            <template x-if="!showInput && !addedOption">
                                                                                <label @click="showInput = true"
                                                                                    class="mx-1 px-3 flex items-center py-1 bg-white border border-gray-300 rounded-5 cursor-pointer focus:outline-none hover:bg-gray-50">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16" height="16"
                                                                                        fill="currentColor"
                                                                                        class="bi bi-plus"
                                                                                        viewBox="0 0 16 16">
                                                                                        <path
                                                                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                                                                    </svg>
                                                                                    Add Other
                                                                                </label>
                                                                            </template>
                                                                            <template x-if="showInput">
                                                                                <div class="flex items-center gap-2">
                                                                                    <input type="number"
                                                                                        form="propertyFrom"
                                                                                        x-model="newOption"
                                                                                        placeholder="Enter value"
                                                                                        class="border border-gray-300 p-2 rounded-md w-20 text-sm focus:ring-blue-500 focus:border-blue-500">
                                                                                    <button @click="addOption"
                                                                                        class="px-3 py-1 bg-green-500 text-white text-sm rounded-md hover:bg-green-600">Done</button>
                                                                                </div>
                                                                            </template>
                                                                            <template x-if="addedOption">
                                                                                <div
                                                                                    class="flex items-center gap-2 relative mb-1">
                                                                                    <input class="sr-only peer"
                                                                                        form="propertyFrom" type="radio"
                                                                                        x-bind:value="addedOption"
                                                                                        name="room" id="room_other"
                                                                                        checked>
                                                                                    <label x-text="addedOption"
                                                                                        class="mx-1 px-3 py-1 bg-white border border-gray-300 rounded-5 cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-green-500 peer-checked:ring-2 peer-checked:border-transparent"
                                                                                        for="room_other"></label>
                                                                                    <span
                                                                                        class="text-blue-500 cursor-pointer"
                                                                                        @click="editOption"><i
                                                                                            class="fas fa-edit"></i></span>
                                                                                </div>
                                                                            </template>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <!-- Bathrooms Section -->
                                                            <div class="section" x-data="addOtherBathrooms()">
                                                                <h6 class="mt-3">No. of Bathrooms<sup
                                                                        class="text-danger fs-4">*</sup>
                                                                </h6>
                                                                <div class="mt-3">
                                                                    <ul class="flex flex-wrap gap-3">
                                                                        @for ($i = 1; $i < 5; $i++)
                                                                            <li class="relative mb-1">
                                                                                <input form="propertyFrom"
                                                                                    class="sr-only peer"
                                                                                    @if ($i == 1) checked @endif
                                                                                    type="radio"
                                                                                    value="{{ $i }}"
                                                                                    name="bathroom"
                                                                                    id="bathroom_{{ $i }}">
                                                                                <label
                                                                                    class="mx-1 px-3 py-1 bg-white border border-gray-300 rounded-5 cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-green-500 peer-checked:ring-2 peer-checked:border-transparent"
                                                                                    for="bathroom_{{ $i }}">{{ $i }}</label>
                                                                            </li>
                                                                        @endfor
                                                                        <li class="relative mb-1">
                                                                            <template x-if="!showInput && !addedOption">
                                                                                <label @click="showInput = true"
                                                                                    class="mx-1 px-3 flex items-center py-1 bg-white border border-gray-300 rounded-5 cursor-pointer focus:outline-none hover:bg-gray-50">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16" height="16"
                                                                                        fill="currentColor"
                                                                                        class="bi bi-plus"
                                                                                        viewBox="0 0 16 16">
                                                                                        <path
                                                                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                                                                    </svg>
                                                                                    Add Other
                                                                                </label>
                                                                            </template>
                                                                            <template x-if="showInput">
                                                                                <div class="flex items-center gap-2">
                                                                                    <input type="number"
                                                                                        x-model="newOption"
                                                                                        placeholder="Enter value"
                                                                                        class="border border-gray-300 p-2 rounded-md w-20 text-sm focus:ring-blue-500 focus:border-blue-500">
                                                                                    <button @click="addOption"
                                                                                        class="px-3 py-1 bg-green-500 text-white text-sm rounded-md hover:bg-green-600">Done</button>
                                                                                </div>
                                                                            </template>
                                                                            <template x-if="addedOption">
                                                                                <div
                                                                                    class="flex items-center gap-2 relative mb-1">
                                                                                    <input form="propertyFrom"
                                                                                        class="sr-only peer"
                                                                                        type="radio"
                                                                                        x-bind:value="addedOption"
                                                                                        name="bathroom"
                                                                                        id="bathroom_other" checked>
                                                                                    <label x-text="addedOption"
                                                                                        class="mx-1 px-3 py-1 bg-white border border-gray-300 rounded-5 cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-green-500 peer-checked:ring-2 peer-checked:border-transparent"
                                                                                        for="bathroom_other"></label>
                                                                                    <span
                                                                                        class="text-blue-500 cursor-pointer"
                                                                                        @click="editOption"><i
                                                                                            class="fas fa-edit"></i></span>
                                                                                </div>
                                                                            </template>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <!-- Balconies Section -->
                                                            <div class="section" x-data="addOtherBalconies()">
                                                                <h6 class="mt-3">Balconies<sup
                                                                        class="text-danger fs-4">*</sup></h6>
                                                                <div class="mt-3">
                                                                    <ul class="flex flex-wrap gap-3">
                                                                        @for ($i = 0; $i < 4; $i++)
                                                                            <li class="relative mb-1">
                                                                                <input form="propertyFrom"
                                                                                    class="sr-only peer"
                                                                                    @if ($i == 0) checked @endif
                                                                                    type="radio"
                                                                                    value="{{ $i }}"
                                                                                    name="balconie"
                                                                                    id="balconie_{{ $i }}">
                                                                                <label
                                                                                    class="mx-1 px-3 py-1 bg-white border border-gray-300 rounded-5 cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-green-500 peer-checked:ring-2 peer-checked:border-transparent"
                                                                                    for="balconie_{{ $i }}">{{ $i }}</label>
                                                                            </li>
                                                                        @endfor
                                                                        <li class="relative mb-1">
                                                                            <template x-if="!showInput && !addedOption">
                                                                                <label @click="showInput = true"
                                                                                    class="mx-1 px-3 flex items-center py-1 bg-white border border-gray-300 rounded-5 cursor-pointer focus:outline-none hover:bg-gray-50">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16" height="16"
                                                                                        fill="currentColor"
                                                                                        class="bi bi-plus"
                                                                                        viewBox="0 0 16 16">
                                                                                        <path
                                                                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                                                                    </svg>
                                                                                    Add Other
                                                                                </label>
                                                                            </template>
                                                                            <template x-if="showInput">
                                                                                <div class="flex items-center gap-2">
                                                                                    <input type="number"
                                                                                        x-model="newOption"
                                                                                        placeholder="Enter value"
                                                                                        class="border border-gray-300 p-2 rounded-md w-20 text-sm focus:ring-blue-500 focus:border-blue-500">
                                                                                    <button @click="addOption"
                                                                                        class="px-3 py-1 bg-green-500 text-white text-sm rounded-md hover:bg-green-600">Done</button>
                                                                                </div>
                                                                            </template>
                                                                            <template x-if="addedOption">
                                                                                <div
                                                                                    class="flex items-center gap-2 relative mb-1">
                                                                                    <input form="propertyFrom"
                                                                                        class="sr-only peer"
                                                                                        type="radio"
                                                                                        x-bind:value="addedOption"
                                                                                        name="balconie"
                                                                                        id="balconie_other" checked>
                                                                                    <label x-text="addedOption"
                                                                                        class="mx-1 px-3 py-1 bg-white border border-gray-300 rounded-5 cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-green-500 peer-checked:ring-2 peer-checked:border-transparent"
                                                                                        for="balconie_other"></label>
                                                                                    <span
                                                                                        class="text-blue-500 cursor-pointer"
                                                                                        @click="editOption"><i
                                                                                            class="fas fa-edit"></i></span>
                                                                                </div>
                                                                            </template>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="floor-section"
                                                            class="HideUnwantedSectionsInPlot HideUnwantedSectionsInPg ">
                                                            <div class="section">
                                                                <h5 class="mt-3 mb-3 font-medium">Floor Details</h5>
                                                                <h6 class="mb-3 font-medium">Total no of floors and your
                                                                    floor
                                                                    details </h6>

                                                                <div
                                                                    class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-2 gap-2">

                                                                    <!-- Total Floor -->
                                                                    <div class="mb-2">
                                                                        <div class="relative flex">
                                                                            <input form="propertyFrom" name="total_floor"
                                                                                min="0" max="50"
                                                                                type="number" autocomplete="off"
                                                                                id="total_floor"
                                                                                class="bg-gray-50 text-dark border border-gray-300 text-sm rounded-s-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 peer"
                                                                                placeholder=" " />
                                                                            <label for="total_floor"
                                                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Total
                                                                                Floor</label>

                                                                        </div>
                                                                    </div>

                                                                    <!-- Available Floor -->
                                                                    <div class="mb-2 d-none">
                                                                        <div class="relative">
                                                                            <input form="propertyFrom"
                                                                                name="available_floor" min="0"
                                                                                max="50" autocomplete="off"
                                                                                type="number" id="available_floor"
                                                                                class="bg-gray-50 text-dark border border-gray-300 text-sm rounded-s-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 peer"
                                                                                placeholder=" " />
                                                                            <label for="available_floor"
                                                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Available
                                                                                Floor </label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="property-area-section ">
                                                            <div class="section">
                                                                <h5 class="mt-3 font-medium HideUnwantedSectionsInPg">Add
                                                                    Area Details
                                                                </h5>
                                                                <div class="mt-3">
                                                                    <div class="ShowWantedSectionsInPlot HideUnwantedSectionsInPg"
                                                                        style="display: none">
                                                                        <!-- Plot Area Input -->
                                                                        <div class="mb-2 ">
                                                                            <div class="relative">
                                                                                <input form="propertyFrom"
                                                                                    name="plot_area" autocomplete="off"
                                                                                    type="text" id="plot_area"
                                                                                    class="bg-gray-50 text-dark border border-gray-300 text-sm rounded-s-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 peer"
                                                                                    placeholder=" " />
                                                                                <label for="plot_area"
                                                                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Plot
                                                                                    Area</label>
                                                                                <div
                                                                                    class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                                                                    Sq.ft
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-2 gap-2 HideUnwantedSectionsInPlot HideUnwantedSectionsInPg">

                                                                        <!-- Carpet Area Input -->
                                                                        <div class="mb-2">
                                                                            <div class="relative">
                                                                                <input form="propertyFrom"
                                                                                    name="carpet_area" autocomplete="off"
                                                                                    type="text" id="carpet_area"
                                                                                    class="bg-gray-50 text-dark border border-gray-300 text-sm rounded-s-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 peer"
                                                                                    placeholder=" " />
                                                                                <label for="carpet_area"
                                                                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Carpet
                                                                                    Area<sup
                                                                                        class="text-danger fs-4">*</sup></label>
                                                                                <div
                                                                                    class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                                                                    Sq.ft
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Built-up Area Input -->
                                                                        <div class="mb-2 d-none">
                                                                            <div class="relative">
                                                                                <input form="propertyFrom"
                                                                                    name="built_up_area"
                                                                                    autocomplete="off" type="text"
                                                                                    id="built_up_area"
                                                                                    class="bg-gray-50 text-dark border border-gray-300 text-sm rounded-s-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 peer"
                                                                                    placeholder=" " />
                                                                                <label for="built_up_area"
                                                                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                                                                    Built-up Area</label>
                                                                                <div
                                                                                    class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                                                                    Sq.ft
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Super Built-up Area Input -->
                                                                        <div class="mb-2 d-none">
                                                                            <div class="relative">
                                                                                <input form="propertyFrom"
                                                                                    name="super_built_up_area"
                                                                                    autocomplete="off" type="text"
                                                                                    id="super_built_up_area"
                                                                                    class="bg-gray-50 text-dark border border-gray-300 text-sm rounded-s-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 peer"
                                                                                    placeholder=" " />
                                                                                <label for="super_built_up_area"
                                                                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Super
                                                                                    Built-up Area</label>
                                                                                <div
                                                                                    class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                                                                    Sq.ft
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div id="parking"
                                                                    class="mt-3 HideUnwantedSectionsInPlot HideUnwantedSectionsInPg HideUnwantedSectionsInPg">
                                                                    <h5 class="mt-3 font-medium">Reserved Parking</h5>
                                                                    <div class="">

                                                                        <div
                                                                            class="mb-2 flex gap-3 mt-3 justify-content-between">
                                                                            <label for="city"
                                                                                class="block mb-2 text-sm font-medium text-gray-500">Covered
                                                                                Parking</label>
                                                                            <div x-data="{ count: 0 }"
                                                                                class="flex items-center space-x-2">
                                                                                <!-- Minus Button -->
                                                                                <button @click="if (count > 0) count--"
                                                                                    class="border fw-bold px-2 rounded rounded-5 text-theme">
                                                                                    -
                                                                                </button>

                                                                                <!-- Display Counter -->
                                                                                <span class="text-md font-bold"
                                                                                    x-text="count"></span>
                                                                                <input type="hidden" form="propertyFrom"
                                                                                    :value="count"
                                                                                    name="covered_parking">
                                                                                <!-- Plus Button -->
                                                                                <button @click="count++"
                                                                                    class="border fw-bold px-2 rounded rounded-5 text-theme">
                                                                                    +
                                                                                </button>
                                                                            </div>

                                                                        </div>
                                                                        <!-- Parking Area -->
                                                                        <div
                                                                            class="mb-2 flex gap-3 mt-3 justify-content-between">
                                                                            <label for="city"
                                                                                class="block mb-2 text-sm font-medium text-gray-500">Open
                                                                                Parking</label>
                                                                            <div x-data="{ count: 0 }"
                                                                                class="flex items-center space-x-2">
                                                                                <!-- Minus Button -->
                                                                                <button @click="if (count > 0) count--"
                                                                                    class="border fw-bold px-2 rounded rounded-5 text-theme">
                                                                                    -
                                                                                </button>

                                                                                <!-- Display Counter -->
                                                                                <span class="text-md font-bold"
                                                                                    x-text="count"></span>
                                                                                <input type="hidden" form="propertyFrom"
                                                                                    :value="count"
                                                                                    name="open_parking">

                                                                                <!-- Plus Button -->
                                                                                <button @click="count++"
                                                                                    class="border fw-bold px-2 rounded rounded-5 text-theme">
                                                                                    +
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Project  -->
                                                                        <div class="mb-2">
                                                                            <label for="projects"
                                                                                class="mt-3 font-medium ">Choose
                                                                                Project</label>
                                                                            <select form="propertyFrom" name="project"
                                                                                id="projects"
                                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                                                                <option value="" selected>None of the
                                                                                    below
                                                                                </option>
                                                                                @foreach ($projects ?? [] as $project_item)
                                                                                    <option
                                                                                        value="{{ $project_item->id }}">
                                                                                        {{ $project_item->name }}</option>
                                                                                @endforeach

                                                                            </select>
                                                                        </div>


                                                                    </div>
                                                                </div>

                                                                <div id="availabiltyStaus" x-data="{ propertyType: 'ready-to-move', propertyStatus: '0-1', possessionDate: '' }"
                                                                    class="mb-5 mx-2 HideUnwantedSectionsInPlot HideUnwantedSectionsInPg">
                                                                    <!-- Availability Status -->
                                                                    <div class="col-lg-12 mb-3 ">
                                                                        <h5 class="mb-2 mt-3 font-medium">Availability
                                                                            Status<sup class="text-danger fs-4">*</sup>
                                                                        </h5>
                                                                    </div>

                                                                    <div class="">
                                                                        <!-- Radio Buttons for Availability -->
                                                                        <div class="flex flex-wrap mb-4 ">
                                                                            <!-- Ready to Move -->
                                                                            <div class="flex items-center me-4">
                                                                                <input form="propertyFrom" role="button"
                                                                                    id="readyto-radio" type="radio"
                                                                                    value="ready-to-move"
                                                                                    name="available_status"
                                                                                    x-model="propertyType"
                                                                                    class="w-3 h-3 text-green-600 bg-gray-100 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                                <label for="readyto-radio"
                                                                                    class="ms-2 text-sm font-medium text-gray dark:text-gray">
                                                                                    Ready to move
                                                                                </label>
                                                                            </div>

                                                                            <!-- Under Construction -->
                                                                            <div class="flex items-center me-4">
                                                                                <input form="propertyFrom" role="button"
                                                                                    id="under-radio" type="radio"
                                                                                    value="under-construction"
                                                                                    name="available_status"
                                                                                    x-model="propertyType"
                                                                                    class="w-3 h-3 text-green-600 bg-gray-100 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                                <label for="under-radio"
                                                                                    class="ms-2 text-sm font-medium text-gray dark:text-gray">
                                                                                    Under construction</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Conditionally Display Content for 'Ready to Move' -->
                                                                        <div x-show="propertyType === 'ready-to-move'"
                                                                            class="mt-3 ">
                                                                            <!-- Age of Property Options -->
                                                                            <div class="mt-4">
                                                                                <h6 class="font-medium">Age of Property:
                                                                                </h6>
                                                                                <div
                                                                                    class="flex gap-2 justify-content-between flex-wrap  mt-4">
                                                                                    <div class="flex items-center">
                                                                                        <input form="propertyFrom" checked
                                                                                            type="radio" value="0-1"
                                                                                            id="age-0-1"
                                                                                            name="property_age"
                                                                                            x-model="propertyStatus"
                                                                                            class="w-3 h-3 text-green-600 bg-gray-100 focus:ring-green-500 dark:focus:ring-green-600">
                                                                                        <label role="button"
                                                                                            for="age-0-1"
                                                                                            class="ms-2 text-sm font-medium text-gray dark:text-gray">0-1
                                                                                            Year</label>
                                                                                    </div>
                                                                                    <div class="flex items-center">
                                                                                        <input form="propertyFrom"
                                                                                            type="radio" id="age-1-5"
                                                                                            value="1-5"
                                                                                            name="property_age"
                                                                                            x-model="propertyStatus"
                                                                                            class="w-3 h-3 text-green-600 bg-gray-100 focus:ring-green-500 dark:focus:ring-green-600">
                                                                                        <label role="button"
                                                                                            for="age-1-5"
                                                                                            class="ms-2 text-sm font-medium text-gray dark:text-gray">1-5
                                                                                            Years</label>
                                                                                    </div>
                                                                                    <div class="flex items-center">
                                                                                        <input form="propertyFrom"
                                                                                            type="radio" id="age-5-10"
                                                                                            name="property_age"
                                                                                            value="5-10"
                                                                                            x-model="propertyStatus"
                                                                                            class="w-3 h-3 text-green-600 bg-gray-100 focus:ring-green-500 dark:focus:ring-green-600">
                                                                                        <label role="button"
                                                                                            for="age-5-10"
                                                                                            class="ms-2 text-sm font-medium text-gray dark:text-gray">5-10
                                                                                            Years</label>
                                                                                    </div>
                                                                                    <div class="flex items-center">
                                                                                        <input form="propertyFrom"
                                                                                            value="10+" type="radio"
                                                                                            id="age-10-plus"
                                                                                            name="property_age"
                                                                                            x-model="propertyStatus"
                                                                                            class="w-3 h-3 text-green-600 bg-gray-100 focus:ring-green-500 dark:focus:ring-green-600">
                                                                                        <label role="button"
                                                                                            for="age-10-plus"
                                                                                            class="ms-2 text-sm font-medium text-gray dark:text-gray">10+
                                                                                            Years</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Conditionally Display Content for 'Under Construction' -->
                                                                        <div x-show="propertyType === 'under-construction'"
                                                                            class="mt-3 ">

                                                                            <!-- Possession Date Field -->
                                                                            <div class="mt-4">
                                                                                <h6 class="font-medium">Possession By:</h6>
                                                                                <div
                                                                                    class="flex items-center gap-3 mt-4 mb-3">
                                                                                    <input form="propertyFrom"
                                                                                        name="possession" type="month"
                                                                                        x-model="possessionDate"
                                                                                        min="{{ date('Y-m') }}"
                                                                                        max="{{ date('Y-m', strtotime(date('Y-m') . ' + 10 years')) }}"
                                                                                        class="w-40 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500">
                                                                                </div>
                                                                                <span class="text-sm text-gray">Select the
                                                                                    month and
                                                                                    year
                                                                                    when
                                                                                    possession will be available.</span>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div id="pgRules"
                                                            class="ShowWantedSectionInPg HideUnwantedSectionsInPlot"
                                                            style="display: none">

                                                            <!-- Occupancy -->
                                                            <div class="col-lg-12 mb-3">
                                                                <h5 class="mb-2 mt-3 font-medium">Occupancy Type <sup
                                                                        class="text-danger fs-4">*</sup></h5>
                                                                <div class="flex items-center flex-wrap gap-3">
                                                                    <div class="flex items-center">
                                                                        <input type="radio" form="propertyFrom"
                                                                            id="single" name="occupancy_type"
                                                                            value="single" checked
                                                                            class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                                        <label for="single"
                                                                            class="ml-2 text-sm font-medium text-gray-900">Single</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input type="radio" form="propertyFrom"
                                                                            id="double" name="occupancy_type"
                                                                            value="double"
                                                                            class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                                        <label for="double"
                                                                            class="ml-2 text-sm font-medium text-gray-900">Double</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input type="radio" form="propertyFrom"
                                                                            id="triple" name="occupancy_type"
                                                                            value="triple"
                                                                            class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                                        <label for="triple"
                                                                            class="ml-2 text-sm font-medium text-gray-900">3+
                                                                            more</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input type="radio" form="propertyFrom"
                                                                            id="capsule" name="occupancy_type"
                                                                            value="capsule"
                                                                            class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                                        <label for="capsule"
                                                                            class="ml-2 text-sm font-medium text-gray-900">Capsule</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Available For -->
                                                            <div class="col-lg-12 mb-3">
                                                                <h5 class="mb-3 mt-3 font-medium">Available For <sup
                                                                        class="text-danger fs-4">*</sup></h5>
                                                                <div class="flex items-center flex-wrap gap-4">
                                                                    <div class="flex items-center">
                                                                        <input type="radio" form="propertyFrom"
                                                                            id="male" name="available_for"
                                                                            value="male" checked
                                                                            class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                                        <label for="male"
                                                                            class="ml-2 text-sm font-medium text-gray-900">Boys</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input type="radio" form="propertyFrom"
                                                                            id="female" name="available_for"
                                                                            value="female"
                                                                            class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                                        <label for="female"
                                                                            class="ml-2 text-sm font-medium text-gray-900">Girls</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input type="radio" form="propertyFrom"
                                                                            id="any" name="available_for"
                                                                            value="any"
                                                                            class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                                                        <label for="any"
                                                                            class="ml-2 text-sm font-medium text-gray-900">Boys
                                                                            &
                                                                            Girls</label>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <!-- Rules  -->
                                                            <div class="col-lg-12 mb-3 ">
                                                                <h5 class="mb-3 mt-3 font-medium">Rules & Informations<sup
                                                                        class="text-danger fs-4">*</sup></h5>
                                                            </div>
                                                            <div class="relative col-lg-12  card p-3">
                                                                <div class="row">
                                                                    @foreach ($pg_rules as $Rkey => $ruleItem)
                                                                        @if ($ruleItem->type == 'text')
                                                                            <div class="relative z-0  mb-3 group col-lg-6">
                                                                                <!-- Text Input -->
                                                                                <input form="propertyFrom" type="hidden"
                                                                                    name="rule[{{ $ruleItem->id }}][id]"
                                                                                    value="{{ $ruleItem->id }}">
                                                                                <input form="propertyFrom"
                                                                                    name="rule[{{ $ruleItem->id }}][value]"
                                                                                    type="text" autocomplete="off"
                                                                                    id="rule_{{ $ruleItem->id }}"
                                                                                    class="block px-2.5 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 pt-3 pb-2 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                                                    placeholder=" " />
                                                                                <label for="rule_{{ $ruleItem->id }}"
                                                                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                                                                    {{ $ruleItem->name }}
                                                                                </label>
                                                                            </div>
                                                                        @elseif ($ruleItem->type == 'radio')
                                                                            <div class="relative z-0  mb-3 group col-lg-6">
                                                                                <!-- Radio Buttons for Yes/No -->
                                                                                <h5 class="mb-2 mt-3 font-medium">
                                                                                    {{ $ruleItem->name }}</h5>
                                                                                <div class="flex items-center space-x-4">
                                                                                    <!-- Yes Option -->
                                                                                    <div class="flex items-center"
                                                                                        role="button">
                                                                                        <input form="propertyFrom"
                                                                                            type="hidden"
                                                                                            name="rule[{{ $ruleItem->id }}][id]"
                                                                                            value="{{ $ruleItem->id }}">
                                                                                        <input form="propertyFrom"
                                                                                            id="rule_{{ $Rkey }}_yes"
                                                                                            name="rule[{{ $ruleItem->id }}][value]"
                                                                                            type="radio" value="Yes"
                                                                                            class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2" />
                                                                                        <label
                                                                                            for="rule_{{ $Rkey }}_yes"
                                                                                            class="ml-2 text-sm font-medium text-gray-900">
                                                                                            Yes
                                                                                        </label>
                                                                                    </div>
                                                                                    <!-- No Option -->
                                                                                    <div class="flex items-center"
                                                                                        role="button">
                                                                                        <input form="propertyFrom"
                                                                                            id="rule_{{ $Rkey }}_no"
                                                                                            name="rule[{{ $ruleItem->id }}][value]"
                                                                                            type="radio" value="No"
                                                                                            class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2" />
                                                                                        <label
                                                                                            for="rule_{{ $Rkey }}_no"
                                                                                            class="ml-2 text-sm font-medium text-gray-900">
                                                                                            No
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                        @endif
                                                                    @endforeach
                                                                </div>

                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="mb-5 col-lg-6">
                                                    <div class="mx-2 mb-5 card p-3">
                                                        <div x-data="{ furnishingStatus: 'furnished' }" class="mb-5 mx-2">
                                                            <div class="section">
                                                                <div id="furnishing" class="HideUnwantedSectionsInPlot">
                                                                    <h5 class="mt-3 font-medium">Furnishing Details</h5>

                                                                    <div class="mt-3 ">

                                                                        <!-- Radio Buttons for Furnishing Status -->
                                                                        <div class="flex flex-wrap">
                                                                            <div class="flex items-center me-4 mb-2">
                                                                                <input form="propertyFrom" type="radio"
                                                                                    value="furnished"
                                                                                    name="furnishing_status"
                                                                                    x-model="furnishingStatus"
                                                                                    id="furnished-radio"
                                                                                    class="w-3 h-3 text-green-600 bg-gray-100 focus:ring-green-500 dark:focus:ring-green-600">
                                                                                <label for="furnished-radio"
                                                                                    class="ms-2 fs-5 font-medium text-gray dark:text-gray">Furnished</label>
                                                                            </div>
                                                                            <div class="flex items-center me-4 mb-2">
                                                                                <input form="propertyFrom" type="radio"
                                                                                    value="semi-furnished"
                                                                                    name="furnishing_status"
                                                                                    x-model="furnishingStatus"
                                                                                    id="semi-furnished-radio"
                                                                                    class="w-3 h-3 text-green-600 bg-gray-100 focus:ring-green-500 dark:focus:ring-green-600">
                                                                                <label for="semi-furnished-radio"
                                                                                    class="ms-2 fs-5 font-medium text-gray dark:text-gray">Semi-Furnished</label>
                                                                            </div>
                                                                            <div class="flex items-center me-4 mb-2">
                                                                                <input form="propertyFrom" type="radio"
                                                                                    value="unfurnished"
                                                                                    name="furnishing_status"
                                                                                    x-model="furnishingStatus"
                                                                                    id="unfurnished-radio"
                                                                                    class="w-3 h-3 text-green-600 bg-gray-100 focus:ring-green-500 dark:focus:ring-green-600">
                                                                                <label for="unfurnished-radio"
                                                                                    class="ms-2 fs-5 font-medium text-gray dark:text-gray">Unfurnished</label>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Conditionally Display Content for Furnishing Status -->
                                                                        <div x-show="furnishingStatus === 'furnished' || furnishingStatus === 'semi-furnished'"
                                                                            class="mt-2 border-top pb-2">
                                                                            <div class="row mt-3 ">
                                                                                @foreach ($furnishing ?? [] as $key_0 => $furnish_items)
                                                                                    <div class="col-lg-6">
                                                                                        <div
                                                                                            class="flex items-center flex-wrap mb-4">
                                                                                            <input name="furnishing[]"
                                                                                                type="checkbox"
                                                                                                value="{{ $furnish_items->id }}"
                                                                                                id="furnish_checkbox_{{ $key_0 }}"
                                                                                                form="propertyFrom"
                                                                                                class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                                                                            <label
                                                                                                for="furnish_checkbox_{{ $key_0 }}"
                                                                                                class="ms-2 f5 text-capitalize font-medium text-dark d-flex gap-2">
                                                                                                <img src="{{ $furnish_items->image_url }}"
                                                                                                    class="w-4 h-4">
                                                                                                {{ $furnish_items->name }}
                                                                                            </label>
                                                                                        </div>

                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>

                                                                        <div x-show="furnishingStatus === 'unfurnished'"
                                                                            class="mt-3">
                                                                            <!-- Add specific content for unfurnished if needed -->
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="amenities">
                                                                    <h5 class="mt-3 font-medium">Amenities</h5>
                                                                    <div class="mt-3   ">
                                                                        <div class="row mt-3 ">
                                                                            @foreach ($features ?? [] as $feature_item)
                                                                                <div class="col-lg-6">
                                                                                    <div class="flex items-center mb-4">
                                                                                        <input name="amenities[]"
                                                                                            form="propertyFrom"
                                                                                            type="checkbox"
                                                                                            value="{{ $feature_item->id }}"
                                                                                            id="amenity_{{ $feature_item->id }}"
                                                                                            class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                                                                        <label
                                                                                            for="amenity_{{ $feature_item->id }}"
                                                                                            class="ms-2 text-sm font-medium text-dark d-flex gap-2">
                                                                                            <img src="{{ $feature_item->image_url }}"
                                                                                                class="w-4 h-4">
                                                                                            {{ $feature_item->name }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <div id="NearestLandmarks">
                                                                    <h5 class="mt-3 font-medium">Nearest Landmarks</h5>
                                                                    <div class="mt-3  " x-data="{
                                                                        facilities: [{ id: '', distance: '' }],
                                                                        addFacility() {
                                                                            this.facilities.push({ id: '', distance: '' });
                                                                        },
                                                                        removeFacility(index) {
                                                                            if (this.facilities.length > 1) {
                                                                                this.facilities.splice(index, 1);
                                                                            }
                                                                        }
                                                                    }">
                                                                        <!-- Dynamic Facility List -->
                                                                        <template x-for="(facility, index) in facilities"
                                                                            :key="index">
                                                                            <div class="flex items-center space-x-4 mb-4">
                                                                                <!-- Facility Select Box -->
                                                                                <div class="w-1/2">
                                                                                    <select form="propertyFrom"
                                                                                        :name="'facilities[' + index + '][id]'"
                                                                                        x-model="facility.id"
                                                                                        class="w-full p-2 bg-gray-100 border border-gray-300 rounded-md">
                                                                                        <option value="">Select
                                                                                            Landmark</option>
                                                                                        @foreach ($facilities ?? [] as $facility_item)
                                                                                            <option
                                                                                                value="{{ $facility_item->id }}">
                                                                                                {{ $facility_item->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                                <!-- Custom Facility Input Box -->
                                                                                <div class="w-1/2">
                                                                                    <input type="text"
                                                                                        :name="'facilities[' + index +
                                                                                            '][distance]'"
                                                                                        autocomplete="off"
                                                                                        form="propertyFrom"
                                                                                        x-model="facility.distance"
                                                                                        class="w-full p-2 mt-1 border border-gray-300 rounded-md"
                                                                                        placeholder="Enter custom facility distance">
                                                                                </div>

                                                                                <!-- Remove Icon Button -->
                                                                                <div class="position-absolute right-2">
                                                                                    <button @click="removeFacility(index)"
                                                                                        class="text-red-600 font-medium">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            width="16" height="16"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-x-circle"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M11.742 4.742a1 1 0 1 0-1.414-1.414L8 6.586 5.672 4.258a1 1 0 1 0-1.414 1.414L6.586 8l-2.328 2.328a1 1 0 1 0 1.414 1.414L8 9.414l2.328 2.328a1 1 0 1 0 1.414-1.414L9.414 8l2.328-2.328z" />
                                                                                        </svg>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </template>

                                                                        <!-- Add Another Facility Button -->
                                                                        <div class="mt-4 text-end">
                                                                            <button @click="addFacility"
                                                                                class="bg-gray-500 px-2 py-1 rounded-2xl text-dark text-sm">
                                                                                <i class="fa fa-plus me-2"></i>Add Another
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <div id="MoreaboutDetails"
                                                                    class="HideUnwantedSectionsInPlot">
                                                                    <h5 class="mt-3 font-medium">More about Details</h5>
                                                                    <div class="mt-3  ">
                                                                        <div x-data="{
                                                                            customFields: [{ selected: '', value: '' }],
                                                                            addField() {
                                                                                this.customFields.push({ selected: '', value: '' });
                                                                            },
                                                                            removeField(index) {
                                                                                if (this.customFields.length > 1) {
                                                                                    this.customFields.splice(index, 1);
                                                                                } else {
                                                                                    alert('At least one field must remain.');
                                                                                }
                                                                            }
                                                                        }">

                                                                            <!-- Dynamic Custom Fields -->
                                                                            <template
                                                                                x-for="(field, index) in customFields"
                                                                                :key="index">
                                                                                <div class="flex items-center gap-2 mb-3">
                                                                                    <!-- Select Box -->
                                                                                    <div class="w-1/2">
                                                                                        <select form="propertyFrom"
                                                                                            :name="'custom_fields[' + index +
                                                                                                '][name]'"
                                                                                            x-model="field.selected"
                                                                                            class="w-full p-2 border rounded-md">
                                                                                            <option value="">Select
                                                                                                Option
                                                                                            </option>
                                                                                            @foreach ($customFields ?? [] as $option_item)
                                                                                                <option
                                                                                                    value="{{ $option_item->name }}">
                                                                                                    {{ $option_item->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>

                                                                                    <!-- Input Box -->
                                                                                    <div class="w-1/2">
                                                                                        <input type="text"
                                                                                            form="propertyFrom"
                                                                                            autocomplete="off"
                                                                                            :name="'custom_fields[' + index +
                                                                                                '][value]'"
                                                                                            x-model="field.value"
                                                                                            class="w-full p-2 border rounded-md"
                                                                                            placeholder="Enter value">
                                                                                    </div>

                                                                                    <!-- Remove Button -->
                                                                                    <div class="position-absolute right-2">
                                                                                        <button @click="removeField(index)"
                                                                                            class="text-red-500 hover:text-red-700">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                width="20"
                                                                                                height="20"
                                                                                                fill="currentColor"
                                                                                                class="bi bi-x-circle"
                                                                                                viewBox="0 0 16 16">
                                                                                                <path
                                                                                                    d="M11.742 4.742a1 1 0 1 0-1.414-1.414L8 6.586 5.672 4.258a1 1 0 1 0-1.414 1.414L6.586 8l-2.328 2.328a1 1 0 1 0 1.414 1.414L8 9.414l2.328 2.328a1 1 0 1 0 1.414-1.414L9.414 8l2.328-2.328z" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </template>

                                                                            <div class="mt-4 text-end">
                                                                                <!-- Add More Button -->
                                                                                <button @click="addField"
                                                                                    class="bg-gray-500 px-2 py-1 rounded-2xl text-dark text-sm">
                                                                                    <i class="fa fa-plus me-2"></i> Add
                                                                                    More
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4 -->

                                <div x-show="currentStep === 3" class="space-y-4 mt-2">
                                    <div class="mb-5 mx-2">
                                        <div class="section">
                                            <h5 class="mt-3 font-medium">Add photos of your property</h5>
                                            <h6 class="mt-3 font-medium">
                                                A picture is worth a thousand words. 87% of buyers look at photos before
                                                buying
                                            </h6>

                                            <div
                                                class="mt-3 border-dashed border-2 border-gray-300 rounded-lg p-3  bg-gray-100">
                                                <div x-data="imageUploader()"
                                                    class="mx-auto bg-white shadow rounded-lg space-y-6">
                                                    <!-- Image Preview Grid -->
                                                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                                                        <!-- Existing Images -->
                                                        <template x-for="(image, index) in images" :key="index">
                                                            <div class="flex flex-col relative">
                                                                <div
                                                                    class="relative group border rounded-lg overflow-hidden">
                                                                    <!-- Image -->
                                                                    <img :src="image.url" style="height: 100px;"
                                                                        alt="Uploaded Image"
                                                                        class="w-30 h-30 object-cover">

                                                                    <!-- Overlay with Cover Option -->
                                                                    <div
                                                                        class="absolute flex flex-col inset-0 group-hover:opacity-100 space-y-2 transition">
                                                                        <!-- Remove Image -->
                                                                        <button @click="removeImage(index)"
                                                                            class="absolute bg-white p-1 right-0 rounded-full top-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" viewBox="0 0 20 20"
                                                                                fill="red">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                                    clip-rule="evenodd" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <label
                                                                    class="flex items-center space-x-2 text-dark cursor-pointer hidden">
                                                                    <input type="radio" name="coverImage"
                                                                        form="propertyFrom" class="hidden"
                                                                        :value="image.name"
                                                                        @change="setCoverImage(index)"
                                                                        :checked="currentCover === index" />
                                                                    <span>Make Cover Photo</span>
                                                                </label>
                                                                <span x-show="currentCover === index"
                                                                    class="absolute top-0 left-0 p-2 text-white bg-black opacity-50">Cover</span>
                                                            </div>
                                                        </template>

                                                        <!-- Upload New Images -->
                                                        <div class="flex flex-col col-auto text-center">
                                                            <div class="relative group border rounded-lg p-2 overflow-hidden"
                                                                @click="triggerFileInput()"
                                                                x-bind:class="{ 'border-blue-500': isDragging }">
                                                                <input name="images[]" form="propertyFrom" type="file"
                                                                    accept="image/*" id="fileInput" class="hidden"
                                                                    multiple @change="addImages($event)">
                                                                <p class="text-gray-600">
                                                                    click to upload your images here.</p>
                                                                <p class="text-sm text-blue-500 font-medium hidden">Upload
                                                                    up to 30
                                                                    images</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div x-data="{ isModalOpen: false }" class="section mt-5">
                                            <div
                                                class="block w-full md:w-2/3 lg:w-1/2 mx-auto p-6 mt-3 border-dashed border-2 border-gray-300 rounded-lg bg-gray-100 shadow hover:bg-gray-50">
                                                <h5 class="font-medium text-lg text-gray-700 text-center">Add YouTube
                                                    Videos of Your
                                                    Property</h5>
                                                <h6 class="mt-3 font-medium text-sm text-gray-600 text-center">
                                                    A video is worth a thousand pictures. Properties with videos get higher
                                                    page views.
                                                </h6>

                                                <div class="relative z-0 w-full mb-3 mt-5 group">
                                                    <input form="propertyFrom" name="youtube_video" type="text"
                                                        autocomplete="off" id="youtube_video"
                                                        class="block px-3 w-full text-sm text-gray-900 bg-transparent border rounded-lg py-3 appearance-none focus:outline-none focus:ring focus:ring-blue-200 peer"
                                                        placeholder="Paste YouTube link of your video" />
                                                    <label for="youtube_video"
                                                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-1/2  peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4">
                                                        Paste YouTube link of your video
                                                    </label>
                                                </div>
                                                <div class="text-end mt-4">
                                                    <button @click="isModalOpen = true" class="text-blue-600 underline"
                                                        role="button">
                                                        How to?
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div x-show="isModalOpen" tabindex="-1" style="display: none"
                                                class="fixed top-0 left-0 right-0 z-50 w-full h-full flex justify-center items-center bg-gray-800 bg-opacity-50"
                                                x-cloak>
                                                <div class="relative w-full max-w-md">
                                                    <!-- Modal content -->
                                                    <div class="bg-white rounded-lg shadow dark:bg-gray-700">

                                                        <!-- Modal body -->
                                                        <div class="p-4 md:p-5">
                                                            <div class="d-flex justify-between">
                                                                <div>
                                                                    <h3
                                                                        class="text-xl font-medium text-dark-900 dark:text-white">
                                                                        How
                                                                        to Add YouTube Video</h3>
                                                                    <h6 class="text-sm text-gray-600">A step-by-step guide
                                                                    </h6>
                                                                </div>
                                                                <button @click="isModalOpen = false"
                                                                    class="text-gray-400 hover:bg-gray-200 rounded-lg text-sm  dark:hover:bg-gray-600">
                                                                    <svg class="w-3 h-3"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                    </svg>
                                                                </button>
                                                            </div>

                                                            <img src="{{ asset('images/general/howTo_youtube.png') }}"
                                                                class="w-full rounded-lg mt-5"
                                                                alt="How To Add YouTube Video">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="section mt-5 d-none" x-data="videoUploader()">
                                            <h5 class="font-medium">Add one or more videos of your property</h5>
                                            <h6 class="mt-3 font-medium">A video is worth a thousand pictures. Properties
                                                with videos
                                                get higher page views</h6>
                                            <div
                                                class="mt-3 border-dashed border-2 border-gray-300 rounded-lg p-3  bg-gray-100">
                                                <!-- Drag and Drop Area for Video -->
                                                <div class="relative text-center cursor-pointer">
                                                    <div class="flex flex-col">
                                                        <div class="relative group  rounded-lg p-2 overflow-hidden"
                                                            @click="triggerFileInputVideo()"
                                                            x-bind:class="{ 'border-blue-500': isDragging }">
                                                            <input form="propertyFrom" id="fileInputVideo"
                                                                name="videos[]" type="file" accept="video/*"
                                                                class="hidden" multiple @change="addVideos($event)">
                                                            <p class="text-gray-600">Drag & Drop your videos here or click
                                                                to upload.
                                                            </p>
                                                            <p class="text-sm text-blue-500 font-medium ">Upload multiple
                                                                videos</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Error Message Display -->

                                                <!-- Video Preview Grid -->
                                                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
                                                    <template x-for="(video, index) in videos" :key="index">
                                                        <div class="flex flex-col relative">
                                                            <div class="relative group border rounded-lg overflow-hidden">
                                                                <!-- Video Preview -->
                                                                <video :src="video.url" controls
                                                                    class="w-30 h-30 object-cover">
                                                                    Your browser does not support the video tag.
                                                                </video>

                                                                <!-- Overlay with Remove Option -->
                                                                <div
                                                                    class="absolute flex flex-col inset-0 group-hover:opacity-100 space-y-2 transition">
                                                                    <!-- Remove Video -->
                                                                    <button @click="removeVideo(index)"
                                                                        class="absolute bg-white p-1 right-0 rounded-full top-0">
                                                                        <!-- Remove Icon -->
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="h-4 w-4" viewBox="0 0 20 20"
                                                                            fill="red">
                                                                            <path fill-rule="evenodd"
                                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mt-5">
                                            <h6 class="font-medium">Ownership<sup class="text-danger fs-4">*</sup></h6>
                                            <ul class="flex gap-5 mt-3">
                                                <li class="relative">
                                                    <input form="propertyFrom" class="sr-only peer" checked
                                                        type="radio" value="freehold" name="ownership"
                                                        id="freehold">
                                                    <label for="freehold"
                                                        class="mx-1 px-3 py-1 bg-white border rounded-lg cursor-pointer peer-checked:ring-2 peer-checked:ring-green-500">
                                                        Freehold
                                                    </label>
                                                </li>
                                                <li class="relative">
                                                    <input form="propertyFrom" class="sr-only peer" type="radio"
                                                        value="co-operative_society" name="ownership"
                                                        id="co_operative_society">
                                                    <label for="co_operative_society"
                                                        class="mx-1 px-3 py-1 bg-white border rounded-lg cursor-pointer peer-checked:ring-2 peer-checked:ring-green-500">
                                                        Co-operative Society
                                                    </label>
                                                </li>
                                                <li class="relative">
                                                    <input form="propertyFrom" class="sr-only peer" type="radio"
                                                        value="power_of_attorney" name="ownership"
                                                        id="power_of_attorney">
                                                    <label for="power_of_attorney"
                                                        class="mx-1 px-3 py-1 bg-white border rounded-lg cursor-pointer peer-checked:ring-2 peer-checked:ring-green-500">
                                                        Power of Attorney
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-5">
                                            <h6 class="mb-3 fs-3 fw-bold text-thme">Price Details</h6>
                                            <div class="bg-white shadow rounded-lg">
                                                <h5 class="font-medium mb-3">Enter Price<sup
                                                        class="text-danger fs-4">*</sup></h5>
                                                <input form="propertyFrom" max="999999999" type="number"
                                                    id="priceInput" min="0" class="border p-2 rounded w-1/2"
                                                    autocomplete="off" placeholder="Enter price"
                                                    oninput="convertToWords()" name="price" />

                                                <p class="mt-4 text-gray-700">Price in words: <span
                                                        id="priceInWords"></span></p>
                                            </div>
                                            <div class="mt-3 flex gap-3">
                                                <label class="flex items-center">
                                                    <input name="all_include" form="propertyFrom" type="checkbox"
                                                        class="mr-2">
                                                    <span>All inclusive price</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input name="tax_include" form="propertyFrom" type="checkbox"
                                                        class="mr-2">
                                                    <span>Tax and Govt. charges excluded</span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input name="negotiable" form="propertyFrom" type="checkbox"
                                                        class="mr-2">
                                                    <span>Price Negotiable</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mt-5">
                                            <h6 class="font-medium">What makes your property unique?</h6>
                                            <textarea form="propertyFrom" name="unique_info" rows="4" autocomplete="off"
                                                class="block w-full mt-2 p-2 border rounded-lg" placeholder="Write your thoughts here..."></textarea>
                                        </div>


                                        <div class="mt-5">
                                            <h6 class="font-medium">Mark as moderation status <sup
                                                    class="text-danger fs-4">*</sup>
                                            </h6>
                                            <ul class="flex gap-5 mt-3">
                                                <li class="relative">
                                                    <input form="propertyFrom" class="sr-only peer" checked
                                                        type="radio" value="draft" name="moderation_status"
                                                        id="draft">
                                                    <label for="draft"
                                                        class="mx-1 px-3 py-1 bg-white border rounded-lg cursor-pointer peer-checked:ring-2 peer-checked:ring-green-500">
                                                        Draft
                                                    </label>
                                                </li>
                                                <li class="relative">
                                                    <input form="propertyFrom" class="sr-only peer" type="radio"
                                                        value="pending" name="moderation_status" id="pending">
                                                    <label for="pending"
                                                        class="mx-1 px-3 py-1 bg-white border rounded-lg cursor-pointer peer-checked:ring-2 peer-checked:ring-green-500">
                                                        Submit for review
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-end mt-2">
                                <button type="button" @click="prevStep"
                                    class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400"
                                    x-show="currentStep > 0">
                                    Back
                                </button>
                                <button type="button" @click="nextStep"
                                    class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                                    x-show="currentStep < 3">
                                    Next
                                </button>
                                <button type="submit" form="propertyFrom"
                                    class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600"
                                    x-show="currentStep === 3">
                                    Submit
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script>
        function stepper() {
            return {
                currentStep: 0,
                steps: [{
                        title: "Basic Details",
                    },
                    {
                        title: "Location Details",
                    },
                    {
                        title: "Property Profile",
                    },
                    {
                        title: "Media & Pricing",
                    },
                ],
                nextStep() {
                    if (this.currentStep < 3) {
                        this.currentStep++;
                    }
                    if (this.currentStep === 1) {
                        document.getElementById("pageTitleDescription").style.display = 'none';
                    }
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    })
                },
                prevStep() {
                    if (this.currentStep > 0) {
                        this.currentStep--;
                    }
                    if (this.currentStep === 0) {
                        document.getElementById("pageTitleDescription").style.display = 'block';
                    }
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    })
                },
                jumpToStep(index) {
                    this.currentStep = index;
                    if (this.currentStep === 1) {
                        document.getElementById("pageTitleDescription").style.display = 'none';
                    } else {
                        document.getElementById("pageTitleDescription").style.display = 'block';
                    }
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    })
                },
                get progressBarWidth() {
                    return (this.currentStep / 2) * 100; // 2 is the total number of steps - 1
                },

            }
        }
    </script>

    {{-- bedroom number other --}}
    <script>
        function addOtherBedrooms() {
            return {
                showInput: false,
                newOption: null,
                addedOption: null,
                isEditing: false,
                addOption() {
                    if (this.newOption) {
                        this.addedOption = this.newOption;
                        this.newOption = null;
                        this.showInput = false;
                    }
                },
                editOption() {
                    this.showInput = true;
                    this.newOption = this.addedOption;
                    this.addedOption = null;
                },
                saveEdit() {
                    this.isEditing = false;
                }
            };
        }

        function addOtherBathrooms() {
            return {
                showInput: false,
                newOption: null,
                addedOption: null,
                isEditing: false,
                addOption() {
                    if (this.newOption) {
                        this.addedOption = this.newOption;
                        this.newOption = null;
                        this.showInput = false;
                    }
                },
                editOption() {
                    this.showInput = true;
                    this.newOption = this.addedOption;
                    this.addedOption = null;
                },
                saveEdit() {
                    this.isEditing = false;
                }
            };
        }

        function addOtherBalconies() {
            return {
                showInput: false,
                newOption: null,
                addedOption: null,
                isEditing: false,
                addOption() {
                    if (this.newOption) {
                        this.addedOption = this.newOption;
                        this.newOption = null;
                        this.showInput = false;
                    }
                },
                editOption() {
                    this.showInput = true;
                    this.newOption = this.addedOption;
                    this.addedOption = null;
                },
                saveEdit() {
                    this.isEditing = false;
                }
            };
        }
    </script>

    <script>
        function imageUploader() {
            return {
                isDragging: false,
                images: [],
                currentCover: null,
                files: [],

                // Trigger the hidden file input when the user clicks the drop area
                triggerFileInput() {
                    document.getElementById('fileInput').click();
                },

                // Add images when they are selected from the file input or dropped
                addImages(event) {
                    const files = event.target.files || event.dataTransfer.files;
                    Array.from(files).forEach(file => {
                        if (file.size <= 10 * 1024 * 1024 && file.type.startsWith('image/')) {
                            const fileObject = {
                                url: URL.createObjectURL(file), // Blob URL for preview
                                file: file, // The actual file object for uploading
                                name: file.name // Original file name
                            };
                            this.images.push(fileObject);
                            this.files.push(file); // Store the file object for uploading
                        }
                    });
                },

                // Remove an image from the list and reset the cover if needed
                removeImage(index) {
                    // Check if the removed image was the cover photo
                    if (this.currentCover === index) {
                        this.currentCover = null; // Reset the cover image if it was removed
                    }
                    this.images.splice(index, 1);
                    this.files.splice(index, 1); // Remove the file object as well
                },

                // Set the selected image as the cover photo and store the original filename
                setCoverImage(index) {
                    this.currentCover = index;
                    // Access the original file name here
                    const coverImageName = this.images[index].name;
                    console.log('Cover Image Name:', coverImageName); // Use this value to send to your server
                },

                // Handle the drop event for drag-and-drop
                handleDrop(event) {
                    this.isDragging = false;
                    this.addImages(event);
                },

                // Visual feedback for drag-and-drop area
                toggleDragging(state) {
                    this.isDragging = state;
                },
            };
        }


        function videoUploader() {
            return {
                videos: [], // Store videos for preview
                files: [], // Store actual file objects
                isDragging: false, // Track the drag-and-drop state
                errorMessage: '', // Store error message for invalid files

                // Trigger the hidden file input when the user clicks the drop area
                triggerFileInputVideo() {
                    document.getElementById('fileInputVideo').click();
                },

                // Add videos when they are selected from the file input or dropped
                addVideos(event) {
                    const files = event.target.files || event.dataTransfer.files;
                    Array.from(files).forEach(file => {
                        // Check if the file is a valid video type and under 50MB
                        if (file.size <= 50 * 1024 * 1024 && file.type.startsWith('video/')) {
                            const videoObject = {
                                url: URL.createObjectURL(file), // Blob URL for preview
                                file: file, // The actual file object for uploading
                                name: file.name // Original file name
                            };
                            this.videos.push(videoObject);
                            this.files.push(file); // Store the file object for uploading
                        } else {
                            // Show error message if the file is invalid
                            this.errorMessage = 'Invalid file type or file size exceeds 50MB.';
                            setTimeout(() => this.errorMessage = '', 3000); // Clear error after 3 seconds
                        }
                    });
                },

                // Remove a video from the list
                removeVideo(index) {
                    this.videos.splice(index, 1);
                    this.files.splice(index, 1); // Remove the file object as well
                },

                // Handle the drop event for drag-and-drop
                handleDrop(event) {
                    this.isDragging = false;
                    this.addVideos(event);
                },

                // Visual feedback for drag-and-drop area
                toggleDragging(state) {
                    this.isDragging = state;
                }
            };
        }
    </script>


    {{-- property form --}}
    <script>
        function propertyForm() {
            return {
                // Backend data
                modes: {
                    sell: @json($has_sell),
                    rent: @json($has_rent),
                    pg: @json($has_pg),
                },
                types: [], // Available types based on mode
                categories: [], // Available categories based on mode and type
                currentMode: 'sell', // Default mode
                currentType: 'Residential', // Default type
                currentCategory: null, // Default category

                // Initialize on page load
                init() {
                    this.updateMode(this.currentMode); // Initialize with default mode
                },

                // Update mode and filter types & categories
                updateMode(mode) {
                    this.currentMode = mode;
                    this.types = [];
                    this.categories = [];
                    this.currentType = 'Residential';

                    // Set types for Sell and Rent modes
                    if (mode === 'sell' || mode === 'rent') {
                        this.types = ['Residential', 'Commercial'];
                    } else if (mode === 'pg') {
                        this.types = ['Residential'];
                        ShowWantedSectionInPg();
                    }

                    // Set categories based on the default type
                    this.updateCategories();
                },

                // Update categories based on the type
                updateCategories() {
                    const modeData = this.modes[this.currentMode];
                    this.categories = modeData.filter(category =>
                        (this.currentType === 'Residential' && category.has_residential) ||
                        (this.currentType === 'Commercial' && category.has_commercial)
                    );

                    // Set the first category as selected by default
                    if (this.categories.length > 0) {
                        this.currentCategory = this.categories[0].id;
                        this.selectedCategory(this.categories[0].name);
                    } else {
                        this.currentCategory = null;
                    }
                },


                // Handle category selection
                selectedCategory(categoryName) {

                    // Perform actions based on category
                    if (categoryName === 'Plot and Land') {
                        HideUnwantedSectionsInPlot();
                    } else if (this.currentMode === 'pg') {
                        ShowWantedSectionInPg();
                    } else {
                        ShowHiddenSections();
                    }
                },
            };
        }

        // Utility functions to show/hide sections
        function HideUnwantedSectionsInPlot() {
            for (let el of document.querySelectorAll('.HideUnwantedSectionsInPlot')) el.style.display = 'none';
            for (let el2 of document.querySelectorAll('.ShowWantedSectionsInPlot')) el2.style.display = 'block';
        }

        function ShowHiddenSections() {

            for (let el of document.querySelectorAll('.HideUnwantedSectionsInPlot')) el.style.display = 'block';
            for (let el2 of document.querySelectorAll('.ShowWantedSectionsInPlot')) el2.style.display = 'none';
            for (let el2 of document.querySelectorAll('.ShowWantedSectionInPg')) el2.style.display = 'none';
        }

        function ShowWantedSectionInPg() {
            for (let el of document.querySelectorAll('.ShowWantedSectionInPg')) el.style.display = 'block';
            for (let el2 of document.querySelectorAll('.ShowWantedSectionsInPlot')) el2.style.display = 'none';
            for (let el3 of document.querySelectorAll('.HideUnwantedSectionsInPg')) el3.style.display = 'none';
        }
    </script>



    {{-- location form --}}
    <script>
        localStorage.clear();

        function locationForm() {
            return {
                recentLocations: [{
                        id: 1,
                        city: 'New York',
                        locality: 'Manhattan',
                        sub_locality: 'Brooklyn',
                        appartment: '5A',
                        landmark: 'Near Central Park',
                        latitude: '',
                        longitude: ''
                    },
                    {
                        id: 2,
                        city: 'Los Angeles',
                        locality: 'Downtown',
                        sub_locality: 'Hollywood',
                        appartment: '10B',
                        landmark: 'Near Hollywood Sign',
                        latitude: '',
                        longitude: ''
                    },
                ],
                form: {
                    city: '',
                    location_info: '',
                    locality: '',
                    sub_locality: '',
                    appartment: '',
                    landmark: '',
                    latitude: '',
                    longitude: '',
                },
                locationSelected: false,
                formFilled: false,
                fillForm(location) {
                    this.form = {
                        ...location
                    };
                    this.locationSelected = true;
                    this.formFilled = true;
                    // Store selected location in localStorage
                    localStorage.setItem('selectedLocation', JSON.stringify(this.form));
                },
                checkForm() {
                    this.formFilled = this.form.city && this.form.locality && this.form.sub_locality;
                },
                // Retrieve location from localStorage if exists
                init2() {

                    const storedLocation = localStorage.getItem('selectedLocation');
                    if (storedLocation) {
                        this.form = JSON.parse(storedLocation);
                        this.formFilled = true;
                        this.locationSelected = true;
                    }
                }
            };
        }
    </script>

    {{-- convert price to words --}}

    <script>
        // Function to convert number to words
        function convertToWords() {
            const num = document.getElementById('priceInput').value;

            // Ensure the input is within the maximum allowed value (₹100 Crore)
            if (num > 999999999) {
                alert('Price cannot exceed ₹99.9 Crore');
                document.getElementById('priceInput').value = 999999999; // Set to the maximum value
                return;
            }

            // Convert the number to words
            const words = numberToWords(parseInt(num));
            document.getElementById('priceInWords').textContent = '₹ ' + (words || 'Zero');
        }

        function numberToWords(num) {
            if (isNaN(num) || num === 0) return 'Zero';

            const a = [
                '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine',
                'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen',
                'Seventeen', 'Eighteen', 'Nineteen'
            ];
            const b = [
                '', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'
            ];
            const c = ['Crore', 'Lakh', 'Thousand', 'Hundred', ''];

            // Define how to split numbers in the Indian system
            const divisors = [10000000, 100000, 1000, 100, 1];
            let words = [];

            for (let i = 0; i < divisors.length; i++) {
                const divisor = divisors[i];
                const quotient = Math.floor(num / divisor);
                if (quotient > 0) {
                    if (i === 3 && quotient < 10 && words.length > 0) {
                        // Special handling for numbers below 10 in the "Hundred" place
                        words.push('and');
                    }
                    if (quotient < 20) {
                        words.push(a[quotient]);
                    } else {
                        words.push(b[Math.floor(quotient / 10)] + (quotient % 10 > 0 ? ' ' + a[quotient % 10] : ''));
                    }
                    if (c[i]) words.push(c[i]); // Add the place (Crore, Lakh, etc.)
                    num %= divisor; // Update the remainder
                }
            }

            return words.join(' ').trim();
        }
    </script>

    <script>
        function formHandler() {
            return {
                formData: {}, // Object to hold form data
                responseMessage: '', // Success message
                errorMessage: '', // Error message
                validationErrors: [], // Array to store validation errors
                showToast: false, // Controls visibility of the toast
                toastMessage: '', // Message for the toast
                toastType: '', // Type of toast (success/error)

                async submitForm() {
                    // Reset validation errors before submitting
                    this.validationErrors = [];
                    this.errorMessage = '';
                    this.responseMessage = '';

                    // Reference the form element
                    const formElement = document.getElementById('propertyFrom');
                    const formData = new FormData(formElement);

                    try {
                        const response = await fetch(`{{ route('user.properties.store') }}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include Laravel CSRF token
                            },
                            body: formData // Use FormData as request body
                        });

                        // Handle validation errors (422)
                        if (!response.ok) {
                            const errorData = await response.json();
                            this.validationErrors = errorData.errors || [];
                            this.showToastMessage('Validation failed.', 'error');
                            return; // Stop further execution if validation fails
                        }

                        // Handle successful response
                        const data = await response.json();
                        this.responseMessage = data.message || 'Form submitted successfully!';
                        this.validationErrors = []; // Clear validation errors
                        this.showToastMessage(this.responseMessage, 'success');
                        window.location = data.redirect;
                    } catch (error) {
                        // Catch unexpected errors (e.g., network issues)
                        this.errorMessage = error.message || 'An error occurred during form submission';
                        this.responseMessage = ''; // Clear success messages
                        this.showToastMessage(this.errorMessage, 'error');
                    }
                },

                showToastMessage(message, type) {
                    this.toastType = type;

                    if (type === 'error' && this.validationErrors.length > 0) {
                        // Construct an unordered list of errors
                        this.toastMessage = `
                        <strong>${message}</strong>
                        <ul>
                            ${this.validationErrors.map(error => `<li>${error}</li>`).join('')}
                        </ul>
                    `;
                    } else {
                        this.toastMessage = message;
                    }

                    this.showToast = true;
                    setTimeout(() => {
                        this.showToast = false; // Hide toast after 3 seconds
                    }, 3000);
                }
            };
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initAutocomplete&libraries=places,geometry&v=weekly"
        defer loading=async></script>
    <script>
        function initAutocomplete() {
            const input = document.getElementById("location");

            // const options = {
            //     strictBounds: false,
            //     types: ['address'],
            //     componentRestrictions: {
            //         country: 'IN', // Restrict to India
            //     }
            // };

            // Coordinates for Bangalore center
            const center = {
                lat: 12.9716,
                lng: 77.5946
            };

            // Expanded bounding box to cover the full area of Bangalore
            const defaultBounds = {
                north: 13.3000, // Expanded to cover the northernmost part of the city
                south: 12.7000, // Expanded to cover the southernmost part
                east: 77.7500, // Extended to the easternmost part
                west: 77.3500 // Extended to the westernmost part
            };

            const options = {
                bounds: defaultBounds, // Restrict to Bangalore's bounding box
                strictBounds: true, // Enforce the bounding box strictly
                types: ['establishment'],
                componentRestrictions: {
                    country: 'IN', // Restrict to India
                }
            };

            const autocomplete = new google.maps.places.Autocomplete(input, options);

            autocomplete.addListener("place_changed", () => {

                const place = autocomplete.getPlace();

                if (!place.geometry || !place.geometry.location) {

                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }
                // Get city, postal code, and country from the place details
                // Variables to store details
                let city = '';
                let locality = '';
                let subLocality = '';
                let landmark = '';
                let latitude = '';
                let longitude = '';

                // Extract latitude and longitude
                latitude = place.geometry.location.lat();
                longitude = place.geometry.location.lng();

                // Loop through address components
                place.address_components.forEach(component => {
                    const componentType = component.types[0];

                    // Fetch city
                    if (componentType === 'locality') {
                        city = component.long_name;
                    }

                    // Fetch locality (level 2 or 3)
                    if (componentType === 'sublocality_level_1') {
                        locality = component.long_name;
                    }

                    // Fetch sub-locality (level 2 or deeper)
                    if (componentType === 'sublocality_level_2' || componentType === 'sublocality') {
                        subLocality = component.long_name;
                    }

                    // Fetch landmark (route or point of interest)
                    if (componentType === 'route') {
                        landmark = component.long_name;
                    }
                });

                // Log the extracted values
                console.log({
                    city,
                    locality,
                    subLocality,
                    landmark,
                    latitude,
                    longitude
                });

                // Set values in respective fields if needed
                document.getElementById('auto_city').value = city;
                document.getElementById('auto_locality').value = locality;
                document.getElementById('auto_subLocality').value = subLocality;
                document.getElementById('auto_landmark').value = landmark;
                document.getElementById('auto_latitude').value = latitude;
                document.getElementById('auto_longitude').value = longitude;
            });
        }

        // Initialize Google Maps Autocomplete
        document.addEventListener("DOMContentLoaded", () => {
            if (typeof google !== "undefined") {
                initAutocomplete();
            }
        });
    </script>
@endpush

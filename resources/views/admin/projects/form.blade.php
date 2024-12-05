@extends('admin.layouts.master')

@section('content')
    <div class="flex flex-col gap-9">
        <!-- Form Container -->
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-dark">
                    {{ isset($project) ? 'Edit project' : 'Create a project' }}
                </h3>
            </div>
            <div class="" x-data="formHandler()">

                <div x-show="showToast" x-transition
                    :class="toastType === 'success' ? 'bg-success text-light' : 'bg-danger text-light'"
                    class="fixed top-5 right-5 text-white p-3 rounded shadow-lg transition z-99999">

                    <p x-html="toastMessage"></p>

                </div>
                <!-- Form -->
                <form enctype="multipart/form-data" @submit.prevent="submitForm" id="proectForm"
                    action="{{ isset($project) ? route('admin.projects.update', $project->id) : route('admin.projects.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($project))
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="gap-3 col-md-12">
                            <div class="px-3 pt-3">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="" x-data="slugGenerator('{{ old('name', $project->name ?? '') }}', '{{ old('slug', $project->slug ?? '') }}')">
                                                    <div class="mb-3 position-relative">
                                                        <label
                                                            class="mb-3 block text-sm font-medium text-black dark:text-dark"
                                                            for="name">Name</label>
                                                        <input class="form-control" required x-model="name"
                                                            data-counter="250" placeholder="Name" autocomplete="off"
                                                            name="name" type="text" @input="updateSlug"
                                                            value="{{ old('name', $project->name ?? '') }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <div class="slug-field-wrapper" data-field-name="name">
                                                            <div class="mb-3 position-relative">
                                                                <label
                                                                    class="mb-3 block text-sm font-medium text-black dark:text-dark"
                                                                    for="slug">Permalink</label>
                                                                <div class="input-group input-group-flat">
                                                                    <span class="input-group-text">
                                                                        {{ url('projects/') }}
                                                                    </span>
                                                                    <input class="form-control ps-2" @input="stopAutoSlug()"
                                                                        x-model="slug" type="text" name="slug"
                                                                        id="slug" autocomplete="off"
                                                                        value="{{ old('slug', $project->slug ?? '') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 position-relative">
                                                    <label for="content"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Content/Description</label>
                                                    <textarea class="form-control tinyeditor" rows="4" placeholder="Write your content" id="content" name="content"
                                                        cols="50">{{ old('content', $project->content ?? '') }}</textarea>
                                                </div>

                                                <div class="mb-3 position-relative">
                                                    <label for="location"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Location
                                                        Address or City</label>
                                                    <input class="form-control pac-target-input"
                                                        placeholder="Property location/address" id="location"
                                                        autocomplete="off" name="location" type="text"
                                                        value="{{ old('location', $project->location ?? '') }}">
                                                </div>

                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="city"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">City</label>
                                                    <input class="form-control" placeholder="City" id="auto_city"
                                                        name="city" type="text"
                                                        value="{{ old('city', $project->city ?? '') }}">
                                                </div>

                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="locality"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Locality</label>
                                                    <input class="form-control" placeholder="Locality" id="auto_locality"
                                                        name="locality" type="text"
                                                        value="{{ old('locality', $project->locality ?? '') }}">
                                                </div>

                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="sub_locality"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Sub
                                                        Locality</label>
                                                    <input class="form-control" placeholder="Sub Locality"
                                                        id="auto_subLocality" name="sub_locality" type="text"
                                                        value="{{ old('sub_locality', $project->sub_locality ?? '') }}">
                                                </div>

                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="landmark"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Landmark</label>
                                                    <input class="form-control" placeholder="Landmark" id="auto_landmark"
                                                        name="landmark" type="text"
                                                        value="{{ old('landmark', $project->landmark ?? '') }}">
                                                </div>

                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="latitude"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Latitude</label>
                                                    <input class="form-control" placeholder="Ex: 1.462260"
                                                        autocomplete="off" id="auto_latitude" name="latitude"
                                                        type="text"
                                                        value="{{ old('latitude', $project->latitude ?? '') }}">
                                                    <a class="form-hint"
                                                        href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                        target="_blank" rel="nofollow">Go here to get Latitude from
                                                        address.</a>
                                                </div>

                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="longitude"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Longitude</label>
                                                    <input class="form-control" placeholder="Ex: 103.812530"
                                                        autocomplete="off" id="auto_longitude" name="longitude"
                                                        type="text"
                                                        value="{{ old('longitude', $project->longitude ?? '') }}">
                                                    <a class="form-hint"
                                                        href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                        target="_blank" rel="nofollow">Go here to get Longitude from
                                                        address.</a>
                                                </div>
                                                <!-- Normal Images Section -->
                                                <div class="px-3">
                                                    <div class="mb-5 border p-3">
                                                        <label
                                                            class="mb-3 block text-lg font-semibold text-black dark:text-dark">
                                                            Project Images</label>

                                                        <!-- Existing Normal Images -->

                                                        <div x-data="imageUploader()" class="mx-auto  space-y-6">
                                                            <!-- Image Preview Grid -->
                                                            <div class="grid grid-cols-6 md:grid-cols-5 gap-4">
                                                                @foreach ($project->images ?? [] as $key => $image)
                                                                    <div
                                                                        class="relative group border rounded-lg overflow-hidden existing-data-box">
                                                                        <img src="{{ asset('images/' . $image) }}"
                                                                            class="thumbnail" alt="Uploaded Image">
                                                                        <input type="hidden" value="{{ $image }}"
                                                                            name="existingImage[]" />
                                                                        <button type="button"
                                                                            onclick="removeExistingRow(this)"
                                                                            class="absolute bg-white p-1 right-0 top-0 rounded-full">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="red"
                                                                                viewBox="0 0 20 20">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                                    clip-rule="evenodd" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                @endforeach


                                                                <!-- Existing Images -->
                                                                <template x-for="(image, index) in images"
                                                                    :key="index">
                                                                    <div class="flex flex-col relative">
                                                                        <div
                                                                            class="relative group border rounded-lg overflow-hidden">
                                                                            <!-- Image -->
                                                                            <img :src="image.url"
                                                                                style="height: 100px;"
                                                                                alt="Uploaded Image"
                                                                                class="w-30 h-30 object-cover">

                                                                            <!-- Overlay with Cover Option -->
                                                                            <div
                                                                                class="absolute flex flex-col inset-0 group-hover:opacity-100 space-y-2 transition">
                                                                                <!-- Remove Image -->
                                                                                <button @click="removeImage(index)"
                                                                                    class="absolute bg-white p-1 right-0 rounded-full top-0">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        class="h-4 w-4"
                                                                                        viewBox="0 0 20 20"
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
                                                                                class="hidden" :value="image.name"
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
                                                                        <input name="new_normal_images[]" type="file"
                                                                            accept="image/*" id="fileInput"
                                                                            class="hidden" multiple
                                                                            @change="addImages($event)">
                                                                        <p class="text-gray-600 text-sm">
                                                                            click to upload your images here.<br>(Keep image
                                                                            Size 800 × 533 pixels)</p>
                                                                        <p
                                                                            class="text-sm text-blue-500 font-medium hidden">
                                                                            Upload up to 30
                                                                            images</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>


                                                <!-- Master Plan Images Section -->

                                                <div class="px-3">
                                                    <div class="mb-5 border p-3">
                                                        <label
                                                            class="mb-3 block text-lg font-semibold text-black dark:text-dark">
                                                            Master Plan Images</label>

                                                        <!-- Existing Normal Images -->


                                                        <div x-data="imageUploader2()" class="mx-auto space-y-6">
                                                            <!-- Existing Images -->
                                                            <div class="grid grid-cols-6 md:grid-cols-5 gap-4">
                                                                @foreach ($project->master_plan_images ?? [] as $key => $plan_images)
                                                                    <div
                                                                        class="relative group border rounded-lg overflow-hidden existing-data-box">
                                                                        <img src="{{ asset('images/' . $plan_images) }}"
                                                                            class="thumbnail" alt="Uploaded Image">
                                                                        <input type="hidden" value="{{ $plan_images }}"
                                                                            name="existingImageMaster[]" />
                                                                        <button type="button"
                                                                            onclick="removeExistingRow2(this)"
                                                                            class="absolute bg-white p-1 right-0 top-0 rounded-full">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="red"
                                                                                viewBox="0 0 20 20">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                                    clip-rule="evenodd" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                @endforeach

                                                                <!-- Alpine.js Managed Image Previews -->
                                                                <template x-for="(image, index) in images"
                                                                    :key="index">
                                                                    <div
                                                                        class="relative group border rounded-lg overflow-hidden">
                                                                        <!-- Image Preview -->
                                                                        <img :src="image.url" style="height: 100px;"
                                                                            alt="Uploaded Image"
                                                                            class="w-30 h-30 object-cover">

                                                                        <!-- Overlay with Remove and Set Cover Options -->
                                                                        <div
                                                                            class="absolute flex flex-col inset-0 group-hover:opacity-100 space-y-2 transition">
                                                                            <button @click="removeImage2(index)"
                                                                                class="absolute bg-white p-1 right-0 rounded-full top-0">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    class="h-4 w-4" fill="red"
                                                                                    viewBox="0 0 20 20">
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
                                                                            class="hidden" :value="image.name"
                                                                            @change="setCoverImage2(index)"
                                                                            :checked="currentCover === index" />
                                                                        <span>Make Cover Photo</span>
                                                                    </label>
                                                                    <span x-show="currentCover === index"
                                                                        class="absolute top-0 left-0 p-2 text-white bg-black opacity-50">Cover</span>
                                                                </template>

                                                                <!-- Upload New Images -->
                                                                <div class="flex flex-col col-auto text-center">
                                                                    <div class="relative group border rounded-lg p-2 overflow-hidden"
                                                                        @click="triggerFileInput2()"
                                                                        x-bind:class="{ 'border-blue-500': isDragging2 }">
                                                                        <input name="new_master_plan_images[]"
                                                                            type="file" accept="image/*"
                                                                            id="fileInput2" class="hidden" multiple
                                                                            @change="addImages2($event)">
                                                                        <p class="text-gray-600 text-sm">
                                                                            Click to upload your images here.<br>(Keep image
                                                                            size 800 × 533 pixels)
                                                                        </p>
                                                                        <p
                                                                            class="text-sm text-blue-500 font-medium hidden">
                                                                            Upload up to 30 images
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 col-md-12">
                                                    <label for="youtube_video"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Youtube
                                                        video link</label>
                                                    <input class="form-control" placeholder="" autocomplete="off"
                                                        value="{{ old('youtube_video', $project->youtube_video ?? '') }}"
                                                        name="youtube_video" type="url" id="youtube_video">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group mb-3 col-md-3">
                                                    <label for="price_from"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Lowest
                                                        price</label>
                                                    <input class="form-control input-mask-number"
                                                        placeholder="Lowest price"
                                                        value="{{ old('price_from', $project->price_from ?? '') }}"
                                                        name="price_from" type="text" id="price_from">
                                                </div>
                                                <div class="form-group mb-3 col-md-3">
                                                    <label for="price_to"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Max
                                                        price</label>
                                                    <input class="form-control input-mask-number" placeholder="Max price"
                                                        value="{{ old('price_to', $project->price_to ?? '') }}"
                                                        name="price_to" type="text" id="price_to">
                                                </div>
                                                <div class="form-group mb-3 col-md-3">
                                                    <label for="resale_properties"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">
                                                        Resale Properties in this project</label>
                                                    <input class="form-control" placeholder="" name="resale_properties"
                                                        value="{{ old('resale_properties', $project->resale_properties ?? '') }}"
                                                        type="number" id="resale_properties">
                                                </div>
                                                <div class="form-group mb-3 col-md-3">
                                                    <label for="rent_properties"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Rental
                                                        Properties in this project</label>
                                                    <input class="form-control" placeholder="" name="rent_properties"
                                                        value="{{ old('rent_properties', $project->rent_properties ?? '') }}"
                                                        type="number" id="rent_properties">
                                                </div>
                                                <div class="form-group mb-3 col-lg-12">
                                                    <label for="rent_properties"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Categories</label>
                                                    <ul class="list-unstyled  col-lg-12">
                                                        <div class="row">

                                                            @foreach ($categories as $category)
                                                                <li class="col-lg-4">
                                                                    <label class="form-check">
                                                                        <input type="radio" name="categories[]"
                                                                            value="{{ $category->id }}"
                                                                            @if(!isset($project)) @if($loop->first) {{ 'checked' }} @endif @endif
                                                                            @if (isset($project) && $project->category->id == $category->id) checked @endif
                                                                            class="form-check-input">
                                                                        <span class="form-check-label text-capitalize">
                                                                            {{ $category->name }}
                                                                        </span>
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                    </ul>
                                                </div>
                                                <div class="form-group mb-3  ">
                                                    <div class="col-lg-12">
                                                        <label
                                                            class="mb-3 block text-sm font-medium text-black dark:text-dark">Construction
                                                            Status</label>
                                                        <div class="row px-3">
                                                            <div class="form-check col-lg-4">
                                                                <input class="form-check-input" type="radio"
                                                                    name="construction_status" id="new_launch"
                                                                    @if (isset($project) && $project->construction_status == 'new_launch') checked @endif
                                                                    value="new_launch" checked>
                                                                <label class="form-check-label" for="new_launch">
                                                                    New Launch
                                                                </label>
                                                            </div>
                                                            <div class="form-check col-lg-4">
                                                                <input class="form-check-input" type="radio"
                                                                    name="construction_status" id="under_construction"
                                                                    @if (isset($project) && $project->construction_status == 'under_construction') checked @endif
                                                                    value="under_construction">
                                                                <label class="form-check-label" for="under_construction">
                                                                    Under Construction
                                                                </label>
                                                            </div>
                                                            <div class="form-check col-lg-4">
                                                                <input class="form-check-input" type="radio"
                                                                    name="construction_status" id="ready_to_move"
                                                                    @if (isset($project) && $project->construction_status == 'ready_to_move') checked @endif
                                                                    value="ready_to_move">
                                                                <label class="form-check-label" for="ready_to_move">
                                                                    Ready to Move
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-3">
                                                            <label
                                                                class="mb-3 block text-sm font-medium text-black dark:text-dark">Builder</label>

                                                            <select class="form-control form-select" id="builder"
                                                                name="investor_id">
                                                                <option value=""></option>
                                                                @foreach ($builders as $builder)
                                                                    <option value="{{ $builder->id }}"
                                                                        @if (isset($project) && $builder->id == $project->investor_id) selected @endif>
                                                                        {{ $builder->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mb-3">
                                                            <label
                                                                class="mb-3 block text-sm font-medium text-black dark:text-dark">RERA
                                                                Registration Status
                                                            </label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rera_status" id="registered" value="registered"
                                                                    @if (isset($project) && $project->rera_status == 'registered') checked
                                                                    @else
                                                                        checked @endif>
                                                                <label class="form-check-label"
                                                                    for="registered">Registered</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rera_status" id="unregistered"
                                                                    value="unregistered"
                                                                    @if (isset($project) && $project->rera_status == 'unregistered') checked
                                                                    @else @endif>
                                                                <label class="form-check-label"
                                                                    for="unregistered">Unregistered</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">

                                                        <div class="form-group mb-3">
                                                            <label
                                                                class="mb-3 block text-sm font-medium text-black dark:text-dark">RERA
                                                                Registration Number
                                                            </label>
                                                            <input class="form-control"
                                                                value="{{ old('rera_reg_no', $project->rera_reg_no ?? '') }}"
                                                                placeholder="Enter RERA Registration Number"
                                                                data-counter="300" autocomplete="off" name="rera_reg_no"
                                                                type="text" id="rera_reg_no">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="px-3">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title"> Unit Price </h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="unitDetailsForm" x-data="{
                                                            items: @json(old('unitDetails', $selectedUnitDetails ?? [])),
                                                            addRow() {
                                                                this.items.push({ unit_type: '', size: '', price: '' });
                                                            },
                                                            deleteRow(index) {
                                                                this.items.splice(index, 1);
                                                            }
                                                        }">
                                                            @if (isset($project))
                                                                @foreach ($project->priceVariations as $key => $priceVari)
                                                                    <div class="row g-3 mb-2 position-relative">
                                                                        <!-- Unit Type -->
                                                                        <div class="col-md-4">
                                                                            <label class="form-label">Unit Type</label>
                                                                            <input type="text"
                                                                                name="unitDetails[100{{ $key }}][unit_type]"
                                                                                value="{{ $priceVari['unit_type'] }}"
                                                                                class="form-control"
                                                                                placeholder="Enter unit type" />
                                                                        </div>

                                                                        <!-- Size in Sq.ft -->
                                                                        <div class="col-md-4">
                                                                            <label class="form-label">Size in Sq.ft</label>
                                                                            <input type="number"
                                                                                value="{{ $priceVari['size'] }}"
                                                                                name="unitDetails[100{{ $key }}][size]"
                                                                                class="form-control"
                                                                                placeholder="Enter size in sq.ft" />
                                                                        </div>

                                                                        <!-- Approx. Price -->
                                                                        <div class="col-md-4">
                                                                            <label class="form-label">Approx. Price (all
                                                                                Inclusive)</label>
                                                                            <input type="number"
                                                                                value="{{ $priceVari['price'] }}"
                                                                                name="unitDetails[100{{ $key }}][price]"
                                                                                class="form-control"
                                                                                placeholder="Enter price" />
                                                                        </div>

                                                                        <!-- Remove Button -->
                                                                        <div class="position-absolute">
                                                                            <span role="button"
                                                                                class="position-absolute right-4  text-danger"
                                                                                @click="deleteRow(index)">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="16" height="16"
                                                                                    fill="currentColor"
                                                                                    class="bi bi-x-circle"
                                                                                    viewBox="0 0 16 16">
                                                                                    <path
                                                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                                                    <path
                                                                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                            <!-- Loop through Unit Details -->
                                                            <template x-for="(item, index) in items"
                                                                :key="index">
                                                                <div class="row g-3 mb-2 position-relative">
                                                                    <!-- Unit Type -->
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Unit Type</label>
                                                                        <input type="text"
                                                                            :name="`unitDetails[${index}][unit_type]`"
                                                                            class="form-control"
                                                                            placeholder="Enter unit type"
                                                                            x-model="item.unit_type" />
                                                                    </div>

                                                                    <!-- Size in Sq.ft -->
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Size in Sq.ft</label>
                                                                        <input type="number"
                                                                            :name="`unitDetails[${index}][size]`"
                                                                            class="form-control"
                                                                            placeholder="Enter size in sq.ft"
                                                                            x-model="item.size" />
                                                                    </div>

                                                                    <!-- Approx. Price -->
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Approx. Price (all
                                                                            Inclusive)</label>
                                                                        <input type="number"
                                                                            :name="`unitDetails[${index}][price]`"
                                                                            class="form-control" placeholder="Enter price"
                                                                            x-model="item.price" />
                                                                    </div>

                                                                    <!-- Remove Button -->
                                                                    <div class="position-absolute">
                                                                        <span role="button"
                                                                            class="position-absolute right-4  text-danger"
                                                                            @click="deleteRow(index)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor" class="bi bi-x-circle"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                                                <path
                                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </template>

                                                            <!-- Add New Unit Detail Button -->
                                                            <div class="mt-3">
                                                                <button type="button"
                                                                    class="btn bg-dark text-light btn-sm "
                                                                    @click="addRow">
                                                                    Add New Unit Detail
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
                            <div class="px-3">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title">Landmarks </h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div id="facilitiesForm">
                                                                        <div x-data="facilitiesManager">
                                                                            @foreach ($project->facilities ?? [] as $keyf => $facilityItem)
                                                                                <div class="row g-2 mb-2">
                                                                                    <div class="col">
                                                                                        <label
                                                                                            class="form-label">Facility</label>
                                                                                        <select
                                                                                            name="facilities[100{{ $keyf }}][id]"
                                                                                            class="form-control">
                                                                                            <option value="">Select
                                                                                                Facility</option>
                                                                                            @foreach ($facilities as $facilityVal)
                                                                                                <option
                                                                                                    @if ($project && $facilityVal->id == $facilityItem->pivot->facility_id) selected @endif
                                                                                                    value="{{ $facilityVal->id }}">
                                                                                                    {{ $facilityVal->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <label class="form-label">Name with
                                                                                            Distance</label>
                                                                                        <input type="text"
                                                                                            name="facilities[100{{ $keyf }}][distance]"
                                                                                            class="form-control"
                                                                                            placeholder="e.g: HSK... (5km)"
                                                                                            value="{{ $facilityItem->pivot->distance ?? '' }}">
                                                                                    </div>
                                                                                    <div class="col-auto">
                                                                                        <button type="button"
                                                                                            class="bg-danger text-light rounded-circle"
                                                                                            @click="removeFacility(100{{ $keyf }})">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                width="16"
                                                                                                height="16"
                                                                                                fill="currentColor"
                                                                                                class="bi bi-x-circle"
                                                                                                viewBox="0 0 16 16">
                                                                                                <path
                                                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                                                                <path
                                                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                            <!-- Facilities Container -->
                                                                            <template
                                                                                x-for="(facility, index) in selectedFacilities"
                                                                                :key="index">
                                                                                <div class="row g-2 mb-2">
                                                                                    <div class="col">
                                                                                        <label
                                                                                            class="form-label">Facility</label>
                                                                                        <select
                                                                                            :name="`facilities[${index}][id]`"
                                                                                            class="form-control"
                                                                                            x-model="facility.id">
                                                                                            <option value="">Select
                                                                                                Facility</option>
                                                                                            <template
                                                                                                x-for="option in facilities"
                                                                                                :key="option.id">
                                                                                                <option
                                                                                                    :value="option.id"
                                                                                                    x-text="option.name">
                                                                                                </option>
                                                                                            </template>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <label class="form-label">Name with
                                                                                            Distance</label>
                                                                                        <input type="text"
                                                                                            :name="`facilities[${index}][distance]`"
                                                                                            class="form-control"
                                                                                            placeholder="e.g: HSK... (5km)"
                                                                                            x-model="facility.distance">
                                                                                    </div>
                                                                                    <div class="col-auto">
                                                                                        <button type="button"
                                                                                            class="bg-danger text-light rounded-circle"
                                                                                            @click="removeFacility(index)">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                width="16"
                                                                                                height="16"
                                                                                                fill="currentColor"
                                                                                                class="bi bi-x-circle"
                                                                                                viewBox="0 0 16 16">
                                                                                                <path
                                                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                                                                <path
                                                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </template>

                                                                            <!-- Add Facility Button -->
                                                                            <button type="button"
                                                                                class="btn bg-dark text-light btn-sm mt-3"
                                                                                @click="addFacility">Add Facility</button>
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

                            <div class="px-3">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title"> Configration </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="row">
                                                    @foreach ($configration ?? [] as $key => $config)
                                                        @php
                                                            if(isset($project)){
                                                                $existConfg = $project->configration
                                                                    ->where('id', $config->id)
                                                                    ->first();
                                                                if ($existConfg) {
                                                                    $existConfgDisntace = $existConfg->pivot->distance;
                                                                } else {
                                                                    $existConfgDisntace = 0;
                                                                }
                                                            }
                                                        @endphp
                                                        <div class="col-md-6 mb-3">
                                                            <label for="configration[100{{ $key }}]"
                                                                class="form-label">{{ $config['name'] }}</label>
                                                            <input type="text" class="form-control" autocomplete="off"
                                                                id="configration[100{{ $key }}]"
                                                                name="configration[100{{ $key }}][value]"
                                                                @if(isset($project))
                                                                value="{{ old('configration.' . $key . '.value', $existConfgDisntace ?? '') }}"
                                                                @endif
                                                                placeholder="Enter {{ $config['name'] }}" />
                                                            <input type="hidden"
                                                                name="configration[100{{ $key }}][id]"
                                                                value="{{ $config['id'] }}">
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-3">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title"> Specifications </h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="specifications-container">
                                            @if (isset($project))
                                                <!-- Dynamically added specification rows will be appended here -->
                                                @foreach ($project->specifications ?? [] as $index => $specification)
                                                    <div class="col-lg-12 border p-3 rounded-3 specification-box">
                                                        <div class="row position-relative"
                                                            data-index="{{ $index + 1 }}">
                                                            <!-- Image Input (Media Image Field) -->
                                                            <div class="col-md-6">
                                                                <label for="specification-{{ $index + 1 }}-image"
                                                                    class="form-label mb-2">Icon</label>
                                                                <img id="preview-{{ $index + 1 }}"
                                                                    src="{{ asset('images/' . $specification['image']) }}"
                                                                    alt="" class="img-thumbnail mb-2"
                                                                    style="max-width: 150px;">
                                                                <input type="hidden"
                                                                    name="specifications[100{{ $index + 1 }}][eXimagePath]"
                                                                    value="{{ $specification['image'] }}">
                                                                <input type="file"
                                                                    name="specifications[100{{ $index + 1 }}][image]"
                                                                    id="specification-{{ $index + 1 }}-image"
                                                                    class="form-control media-image-picker"
                                                                    onchange="uploadAndPreviewImage(this, {{ $index + 1 }})" />
                                                            </div>

                                                            <!-- Text Input (Description) -->
                                                            <div class="col-md-12 mt-3">
                                                                <label for="specification-{{ $index + 1 }}-description"
                                                                    class="form-label">Content</label>
                                                                <textarea name="specifications[100{{ $index + 1 }}][description]"
                                                                    id="specification-{{ $index + 1 }}-description" class="form-control" rows="4">{{ old('specifications.' . $index + 1 . '.description', $specification['description'] ?? '') }}</textarea>
                                                            </div>

                                                            <!-- Delete Row Button -->
                                                            <div class="position-absolute">
                                                                <button type="button"
                                                                    class="btn btn-theme delete-specification-btn ribbon top-0"
                                                                    onclick="removeSpecificationRow(this)">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            @if (!isset($project))
                                                <div class="col-lg-12 border p-3 rounded-3 specification-box">
                                                    <div class="row position-relative" data-index="0">
                                                        <!-- Image Input (Media Image Field) -->
                                                        <div class="col-md-6">
                                                            <label for="specification-0-image"
                                                                class="form-label mb-2">Icon</label>
                                                            <input type="file" name="specifications[0][image]"
                                                                id="specification-0-image"
                                                                class="form-control media-image-picker"
                                                                value="{{ old('specifications.' . '0' . '.image', $specification['image'] ?? '') }}"
                                                                onchange="uploadAndPreviewImage(this, 0)" />
                                                            <img id="preview-0" src="#" alt="Preview Image"
                                                                style="max-width: 150px; display: none;" />

                                                        </div>

                                                        <!-- Text Input (Description) -->
                                                        <div class="col-md-12 mt-3">
                                                            <label for="specification-0-description"
                                                                class="form-label">Content</label>
                                                            <textarea name="specifications[0][description]" id="specification-0-description" class="form-control"
                                                                rows="4">{{ old('specifications.' . '0' . '.description', $specification['description'] ?? '') }}</textarea>
                                                        </div>

                                                        <!-- Delete Row Button -->
                                                        <div class="position-absolute">
                                                            <span
                                                                class=" text-danger right-0 position-absolute btn-sm delete-specification-btn  top-0"
                                                                onclick="removeSpecificationRow(this)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-x-circle" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                                    <path
                                                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                                </svg>
                                                            </span>
                                                        </div>


                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        <!-- Add New Specification Button -->
                                        <button type="button" class="btn bg-dark btn-sm text-light mt-3"
                                            id="add-specification-btn">
                                            Add New
                                        </button>

                                        @push('footer')
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    let specificationIndex =
                                                        {{ isset($selectedSpecification) ? (count($selectedSpecification) == 0 ? 1 : count($selectedSpecification)) : 0 }};

                                                    // Add specification row
                                                    document.getElementById('add-specification-btn').addEventListener('click', function() {
                                                        const specificationsContainer = document.getElementById('specifications-container');
                                                        const row = document.createElement('div');
                                                        row.classList.add('row1', 'mb-3');
                                                        row.setAttribute('data-index', specificationIndex);

                                                        row.innerHTML = `
                                                            <div class="col-lg-12 border p-3 rounded-3 mt-3 specification-box">
                                                                <div class="row position-relative">
                                                                    <!-- Image Input -->
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="specification-${specificationIndex}-image" class="form-label">
                                                                            Icon
                                                                        </label>
                                                                        <div class="mt-2">
                                                                            <img id="preview-${specificationIndex}" src="#" alt="Preview Image" style="max-width: 150px; display: none;" />
                                                                        </div>
                                                                        <input
                                                                            type="file"
                                                                            name="specifications[${specificationIndex}][image]"
                                                                            id="specification-${specificationIndex}-image"
                                                                            class="form-control media-image-picker"
                                                                            onchange="uploadAndPreviewImage(this, ${specificationIndex})"
                                                                        />
                                                                    </div>
                                        
                                                                    <!-- Text Input -->
                                                                    <div class="col-md-12">
                                                                        <label for="specification-${specificationIndex}-description" class="form-label">
                                                                            Content
                                                                        </label>
                                                                        <textarea
                                                                            name="specifications[${specificationIndex}][description]"
                                                                            id="specification-${specificationIndex}-description"
                                                                            class="form-control"
                                                                            rows="2"></textarea>
                                                                    </div>
                                        
                                                                    <!-- Delete Row Button -->
                                                                    <div class="position-absolute">
                                                                        <button
                                                                            type="button"
                                                                            style="top:0;right:0"
                                                                            class="btn bg-theme delete-specification-btn ribbon top-0"
                                                                            onclick="removeSpecificationRow(this)"
                                                                        >
                                                                            <span class="icon-tabler-wrapper icon-left">
                                                                            <i class="fa fa-times"></i>  
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        `;
                                                        specificationsContainer.appendChild(row);
                                                        specificationIndex++;
                                                    });

                                                    // Remove specification row
                                                    window.removeSpecificationRow = function(button) {
                                                        const row = button.closest('.specification-box');
                                                        if (row) {
                                                            row.remove();
                                                        }
                                                    };

                                                    window.uploadAndPreviewImage = function(input, index) {
                                                        const file = input.files[0];

                                                        if (file) {
                                                            // Check file size (20 KB = 20 * 1024 bytes)
                                                            const maxSize = 20 * 1024; // 20 KB
                                                            if (file.size > maxSize) {
                                                                alert('The image size exceeds 20 KB. Please upload a smaller file.');
                                                                input.value = ''; // Clear the file input
                                                                return;
                                                            }

                                                            // Display the preview using a Blob URL
                                                            const previewElement = document.getElementById(`preview-${index}`);
                                                            previewElement.src = URL.createObjectURL(file);
                                                            previewElement.style.display = 'block';
                                                        } else {
                                                            alert('Please select a valid image file.');
                                                        }
                                                    };
                                                });
                                            </script>
                                        @endpush

                                    </div>
                                </div>
                            </div>
                            <div class="px-3">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title"> Ameneties </h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                @foreach ($features as $feature)
                                                    <div class="col-lg-3">
                                                        <div class="d-flex  align-items-center">
                                                            <label class="form-check form-check-inline mb-3"><input
                                                                    type="checkbox" name="features[]"
                                                                    @if(isset($project)) @if (in_array($feature->id, $project->features->pluck('id')->toArray())) checked @endif @endif
                                                                    class="form-check-input" value="{{ $feature->id }}">
                                                                <span
                                                                    class="form-check-label text-capitalize d-flex gap-2 items-center text-sm"><img
                                                                        src="{{ $feature->image_url }}" class="w-4">
                                                                    {{ $feature->name }} </span>
                                                            </label>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="text-start">
                                    <button class="btn bg-success text-light w-100" type="submit">Save</button>
                                </div>
                            </div>
                        </div>



                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('footer')
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
    </script>
    <script>
        function imageUploader2() {
            return {
                isDragging2: false,
                images: [], // For storing preview URLs and file objects
                files: [], // For uploading files2
                currentCover2: null, // Index of the current cover image

                // Trigger the hidden file input when clicked
                triggerFileInput2() {
                    document.getElementById('fileInput2').click();
                },

                // Add images to the preview and files2 list
                addImages2(event) {
                    const files = event.target.files || event.dataTransfer.files;
                    Array.from(files).forEach(file => {
                        if (file.size <= 10 * 1024 * 1024 && file.type.startsWith('image/')) {
                            const fileObject = {
                                url: URL.createObjectURL(file), // Blob URL for preview
                                file, // Actual file object
                                name: file.name // Original file name
                            };
                            this.images.push(fileObject);
                            this.files.push(file); // Save for upload
                        }
                    });
                    // event.target.value = ''; // Clear input for consecutive uploads
                },

                // Remove an image
                removeImage2(index) {
                    if (this.currentCover2 === index) {
                        this.currentCover2 = null; // Reset cover if it's removed
                    }
                    this.images.splice(index, 1);
                    this.files.splice(index, 1); // Remove from upload list
                },

                // Set an image as the cover
                setCoverImage2(index) {
                    this.currentCover2 = index;
                    console.log('Cover Image:', this.images[index].name);
                },

                // Drag-and-drop handlers
                handleDrop2(event) {
                    event.preventDefault();
                    this.isDragging2 = false;
                    this.addImages2(event);
                },
                toggleDragging2(state) {
                    this.isDragging2 = state;
                },
            };
        }
    </script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('facilitiesManager', () => ({
                facilities: @json($facilities), // Predefined facilities from the server
                selectedFacilities: @json($selectedFacilities ?? []), // Selected facilities (from the server or default)

                // Add a new facility
                addFacility() {
                    this.selectedFacilities.push({
                        id: '',
                        distance: ''
                    });
                },

                // Remove a facility by index
                removeFacility(index) {
                    this.selectedFacilities.splice(index, 1);
                }
            }));
        });

        function slugGenerator(initialName = '', initialSlug = '') {
            return {
                name: initialName, // Initial name value
                slug: initialSlug,
                autoGenerate: true, // Toggle for auto-generating the slug

                // Update slug based on the name if autoGenerate is true
                updateSlug() {
                    this.autoGenerate = true;
                    if (this.autoGenerate) {
                        this.slug = this.name
                            .toLowerCase() // Convert to lowercase
                            .trim() // Remove leading/trailing spaces
                            .replace(/[^a-z0-9\s-]/g, '') // Remove non-alphanumeric characters
                            .replace(/\s+/g, '-') // Replace spaces with dashes
                            .replace(/-+/g, '-'); // Remove duplicate dashes
                    }
                },

                // Stop auto-generating the slug when manually edited
                stopAutoSlug() {
                    this.autoGenerate = false;
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
                    tinymce.triggerSave();
                    // Reference the form element
                    const formElement = document.getElementById('proectForm');
                    const formData = new FormData(formElement);


                    try {
                        const response = await fetch(
                            `{{ isset($project) ? route('admin.projects.update', $project->id) : route('admin.projects.store') }}`, {
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
@endpush

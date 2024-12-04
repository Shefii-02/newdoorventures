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
                <form enctype="multipart/form-data" @submit.prevent="submitForm"  id="proectForm"
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
                                                <div class="mb-3 position-relative">
                                                    <label class="mb-3 block text-sm font-medium text-black dark:text-dark"
                                                        for="name" >Name</label>
                                                    <input class="form-control" data-counter="250" placeholder="Name" 
                                                        autocomplete="off" name="name" type="text"
                                                        value="{{ old('name', $property->name ?? '') }}" >
                                                </div>

                                                <div class="mb-3">
                                                    <div class="slug-field-wrapper" data-field-name="name">
                                                        <div class="mb-3 position-relative">
                                                            <label
                                                                class="mb-3 block text-sm font-medium text-black dark:text-dark"
                                                                for="slug" >Permalink</label>
                                                            <div class="input-group input-group-flat">
                                                                <span class="input-group-text">
                                                                    {{ url('projects/') }}
                                                                </span>
                                                                <input class="form-control ps-0" type="text" name="slug"
                                                                    id="slug"  autocomplete="off"
                                                                    
                                                                    value="{{ old('slug', $property->slug ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <input class="slug-current" name="slug" type="hidden"
                                                            value="{{ old('slug', $property->slug ?? '') }}">
                                                    </div>
                                                </div>

                                                <div class="mb-3 position-relative">
                                                    <label for="content"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Content/Description</label>
                                                    <textarea class="form-control tinyeditor" rows="4" placeholder="Write your content" id="content" name="content"
                                                        cols="50">{{ old('content', $property->content ?? '') }}</textarea>
                                                </div>

                                                <div class="mb-3 position-relative">
                                                    <label for="location"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Location
                                                        Address or City</label>
                                                    <input class="form-control pac-target-input"
                                                        placeholder="Property location/address" id="location"
                                                        autocomplete="off" name="location" type="text"
                                                        value="{{ old('location', $property->location ?? '') }}">
                                                </div>

                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="city"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">City</label>
                                                    <input class="form-control" placeholder="City" id="auto_city" name="city"
                                                        type="text" value="{{ old('city', $property->city ?? '') }}">
                                                </div>

                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="locality"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Locality</label>
                                                    <input class="form-control" placeholder="Locality" id="auto_locality"
                                                        name="locality" type="text"
                                                        value="{{ old('locality', $property->locality ?? '') }}">
                                                </div>

                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="sub_locality"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Sub
                                                        Locality</label>
                                                    <input class="form-control" placeholder="Sub Locality" id="auto_subLocality"
                                                        name="sub_locality" type="text"
                                                        value="{{ old('sub_locality', $property->sub_locality ?? '') }}">
                                                </div>

                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="landmark"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Landmark</label>
                                                    <input class="form-control" placeholder="Landmark" id="auto_landmark"
                                                        name="landmark" type="text"
                                                        value="{{ old('landmark', $property->landmark ?? '') }}">
                                                </div>

                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="latitude"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Latitude</label>
                                                    <input class="form-control" placeholder="Ex: 1.462260" autocomplete="off"
                                                        id="auto_latitude" name="latitude" type="text"
                                                        value="{{ old('latitude', $property->latitude ?? '') }}">
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
                                                        value="{{ old('longitude', $property->longitude ?? '') }}">
                                                    <a class="form-hint"
                                                        href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                        target="_blank" rel="nofollow">Go here to get Longitude from
                                                        address.</a>
                                                </div>
                                                <!-- Normal Images Section -->
                                                <div class="px-3">
                                                    <div class="mb-5 border p-3" x-data="{ normalImages: @json(isset($property) ? $property->normalImages : []), newNormalImages: [], deletedNormalImages: [] }">
                                                        <label
                                                            class="mb-3 block text-lg font-semibold text-black dark:text-dark">
                                                            Project Images</label>

                                                        <!-- Existing Normal Images -->
                                                        <div class="gallery-images-wrapper list-images form-fieldset mb-3">
                                                            <template x-for="(image, index) in normalImages"
                                                                :key="index">
                                                                <div class="image-preview mb-3 inline-block p-3 rounded-2">
                                                                    <img :src="`/storage/${image.path}`" alt="Normal Image"
                                                                        class="img-thumbnail mb-1" style="max-width: 100px;">
                                                                    <span
                                                                        class="btn position-absolute right-0 top-0 position-relative"
                                                                        @click="deletedNormalImages.push(image.id); normalImages.splice(index, 1)">
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
                                                            </template>
                                                        </div>

                                                        <!-- Hidden input for deleted normal images -->
                                                        <input type="hidden" name="deleted_normal_images"
                                                            :value="JSON.stringify(deletedNormalImages)">

                                                        <!-- New Normal Images -->
                                                        <div class="mb-3">
                                                            <button type="button" class="btn bg-dark btn-sm text-white"
                                                                @click="$refs.normalInput.click()">Add Images</button>
                                                            <input type="file" x-ref="normalInput" class="hidden"
                                                                name="new_normal_images[]" multiple accept="image/*"
                                                                @change="Array.from($event.target.files).forEach(file => newNormalImages.push(file))">
                                                        </div>
                                                        <div class="gallery-images-wrapper">
                                                            <template x-for="(file, index) in newNormalImages"
                                                                :key="index">
                                                                <div
                                                                    class="image-preview mb-3 p-3 inline-block position-relative">
                                                                    <img :src="URL.createObjectURL(file)" alt="New Image"
                                                                        class="img-thumbnail mb-1" style="max-width: 100px;">
                                                                    <span class="btn position-absolute right-0 top-0"
                                                                        @click="newNormalImages.splice(index, 1)">
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
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Master Plan Images Section -->
                                                <div class="px-3">
                                                    <div class="mb-5 border p-3" x-data="{ masterPlanImages: @json(isset($property) ? $property->masterPlanImages : []), newMasterPlanImages: [], deletedMasterPlanImages: [] }">
                                                        <label
                                                            class="mb-3 block text-lg font-semibold text-black dark:text-dark">
                                                            Master Plan Images</label>

                                                        <!-- Existing Master Plan Images -->
                                                        <div class="gallery-images-wrapper list-images form-fieldset mb-3">
                                                            <template x-for="(image, index) in masterPlanImages"
                                                                :key="index">
                                                                <div
                                                                    class="image-preview mb-3 inline-block position-relative p-3">
                                                                    <img :src="`/storage/${image.path}`"
                                                                        alt="Master Plan Image" class="img-thumbnail mb-1"
                                                                        style="max-width: 100px;">
                                                                    <span class="btn position-absolute right-0 top-0"
                                                                        @click="deletedMasterPlanImages.push(image.id); masterPlanImages.splice(index, 1)">
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
                                                            </template>
                                                        </div>

                                                        <!-- Hidden input for deleted master plan images -->
                                                        <input type="hidden" name="deleted_master_plan_images"
                                                            :value="JSON.stringify(deletedMasterPlanImages)">

                                                        <!-- New Master Plan Images -->
                                                        <div class="mb-3">
                                                            <button type="button" class="btn bg-dark btn-sm text-white"
                                                                @click="$refs.masterPlanInput.click()">Add Master Plan
                                                                Images</button>
                                                            <input type="file" x-ref="masterPlanInput" class="hidden"
                                                                name="new_master_plan_images[]" multiple accept="image/*"
                                                                @change="Array.from($event.target.files).forEach(file => newMasterPlanImages.push(file))">
                                                        </div>
                                                        <div class="gallery-images-wrapper">
                                                            <template x-for="(file, index) in newMasterPlanImages"
                                                                :key="index">
                                                                <div
                                                                    class="image-preview mb-3 inline-block position-relative p-3">
                                                                    <img :src="URL.createObjectURL(file)"
                                                                        alt="New Master Plan Image" class="img-thumbnail mb-1"
                                                                        style="max-width: 100px;">
                                                                    <span class="btn position-absolute right-0 top-0"
                                                                        @click="newMasterPlanImages.splice(index, 1)">
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
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 col-md-12">
                                                    <label for="youtube_video"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Youtube
                                                        video link</label>
                                                    <input class="form-control" placeholder="" autocomplete="off"
                                                        name="youtube_video" type="text" id="youtube_video">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group mb-3 col-md-3">
                                                    <label for="price_from"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Lowest
                                                        price</label>
                                                    <input class="form-control input-mask-number" placeholder="Lowest price"
                                                        data-thousands-separator="," data-decimal-separator="."
                                                        name="price_from" type="text" id="price_from">
                                                </div>
                                                <div class="form-group mb-3 col-md-3">
                                                    <label for="price_to"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Max
                                                        price</label>
                                                    <input class="form-control input-mask-number" placeholder="Max price"
                                                        data-thousands-separator="," data-decimal-separator="."
                                                        name="price_to" type="text" id="price_to">
                                                </div>
                                                <div class="form-group mb-3 col-md-3">
                                                    <label for="resale_properties"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">
                                                        Resale
                                                        Properties in this project</label>
                                                    <input class="form-control" placeholder="" name="resale_properties"
                                                        type="number" id="resale_properties">
                                                </div>
                                                <div class="form-group mb-3 col-md-3">
                                                    <label for="rent_properties"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Rental
                                                        Properties in this project</label>
                                                    <input class="form-control" placeholder="" name="rent_properties"
                                                        type="number" id="rent_properties">
                                                </div>
                                                <div class="form-group mb-3 col-lg-12">
                                                    <label for="rent_properties"
                                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Categories</label>
                                                    <ul class="list-unstyled  col-lg-12">
                                                        <div class="row">
                                                            @foreach ($categories as $category)
                                                                <li value="1" class="col-lg-4">
                                                                    <label class="form-check">
                                                                        <input type="radio" name="categories[]"
                                                                            class="form-check-input"
                                                                            value="{{ $category->id }}"><span
                                                                            class="form-check-label text-capitalize">
                                                                            {{ $category->name }} </span>
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
                                                                    value="new_launch" checked>
                                                                <label class="form-check-label" for="new_launch">
                                                                    New Launch
                                                                </label>
                                                            </div>
                                                            <div class="form-check col-lg-4">
                                                                <input class="form-check-input" type="radio"
                                                                    name="construction_status" id="under_construction"
                                                                    value="under_construction">
                                                                <label class="form-check-label" for="under_construction">
                                                                    Under Construction
                                                                </label>
                                                            </div>
                                                            <div class="form-check col-lg-4">
                                                                <input class="form-check-input" type="radio"
                                                                    name="construction_status" id="ready_to_move"
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
                                                            <select class="form-control form-select" 
                                                                id="builder" name="builder" >
                                                                <option value=""></option>
                                                                @foreach ($builders as $builder)
                                                                    <option value="{{ $builder->id }}">{{ $builder->name }}
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
                                                                    checked>
                                                                <label class="form-check-label"
                                                                    for="registered">Registered</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rera_status" id="unregistered"
                                                                    value="unregistered">
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

                                                            <!-- Loop through Unit Details -->
                                                            <template x-for="(item, index) in items" :key="index">
                                                                <div class="row g-3 mb-2 position-relative">
                                                                    <!-- Unit Type -->
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Unit Type</label>
                                                                        <input type="text"
                                                                            :name="`unitDetails[${index}][unit_type]`"
                                                                            class="form-control" placeholder="Enter unit type"
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

                                                                    <span role="button"
                                                                        class="position-absolute right-4  text-danger"
                                                                        @click="deleteRow(index)">
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
                                                            </template>

                                                            <!-- Add New Unit Detail Button -->
                                                            <div class="mt-3">
                                                                <button type="button" class="btn bg-dark text-light btn-sm "
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
                                        <h4 class="card-title">landmarks </h4>
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
                                                                        <!-- Dynamic Facilities Rows -->
                                                                        <div id="facilitiesContainer">
                                                                            <!-- This will be populated dynamically -->
                                                                        </div>

                                                                        <!-- Add New Facility Button -->
                                                                        <button type="button"
                                                                            class="btn bg-dark btn-sm text-light"
                                                                            onclick="addRow()">Add New </button>
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
                                                    @foreach ($configration as $key => $config)
                                                        <div class="col-md-6 mb-3">
                                                            <label for="configration[{{ $key }}]"
                                                                class="form-label">{{ $config['name'] }}</label>
                                                            <input type="text" class="form-control"
                                                                id="configration[{{ $key }}]"
                                                                name="configration[{{ $key }}][value]"
                                                                value="{{ old("configration.$key.value", $selectedConfigration[$key]['value'] ?? '') }}"
                                                                placeholder="Enter {{ $config['name'] }}" />
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

                                            <div class="col-lg-12 border p-3 rounded-3 specification-box">
                                                <div class="row position-relative" data-index="0">
                                                    <!-- Image Input (Media Image Field) -->
                                                    <div class="col-md-6">
                                                        <label for="specification-0-image"
                                                            class="form-label mb-2">Icon</label>
                                                        <input type="file" name="specifications[0][image]"
                                                            id="specification-0-image" class="form-control media-image-picker"
                                                            value="{{ old('specifications.' . '0' . '.image', $specification['image'] ?? '') }}"
                                                            onchange="uploadAndPreviewImage(this, 0)" />
                                                        <img id="preview-0" src="#" alt="Preview Image"
                                                            style="max-width: 150px; display: none;" />
                                                        <!-- Hidden field to store the image path -->
                                                        <input type="hidden" name="specifications[0][imagePath]"
                                                            id="specification-0-image-path"
                                                            value="{{ $specification['image'] ?? '' }}">
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
                                                                height="16" fill="currentColor" class="bi bi-x-circle"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                                <path
                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                            </svg>
                                                        </span>
                                                    </div>


                                                </div>
                                            </div>

                                            @if (isset($selectedSpecification))
                                                <!-- Dynamically added specification rows will be appended here -->
                                                @foreach ($selectedSpecification as $index => $specification)
                                                    <div class="col-lg-12 border p-3 rounded-3 specification-box">
                                                        <div class="row position-relative" data-index="{{ $index + 1 }}">
                                                            <!-- Image Input (Media Image Field) -->
                                                            <div class="col-md-6">
                                                                <label for="specification-{{ $index + 1 }}-image"
                                                                    class="form-label mb-2">Icon</label>
                                                                <img id="preview-{{ $index + 1 }}"
                                                                    src="{{ asset('storage/' . $specification['image']) }}"
                                                                    alt="" class="img-thumbnail mb-2"
                                                                    style="max-width: 150px;">
                                                                <input type="hidden"
                                                                    name="specifications[{{ $index + 1 }}][imagePath]"
                                                                    value="{{ $specification['image'] }}">
                                                                <input type="file"
                                                                    name="specifications[{{ $index + 1 }}][image]"
                                                                    id="specification-{{ $index + 1 }}-image"
                                                                    class="form-control media-image-picker"
                                                                    onchange="uploadAndPreviewImage(this, {{ $index + 1 }})" />
                                                                <!-- Hidden field to store the image path -->
                                                                <input type="hidden"
                                                                    name="specifications[{{ $index + 1 }}][imagePath]"
                                                                    id="specification-{{ $index + 1 }}-image-path"
                                                                    value="{{ $specification['image'] }}">
                                                            </div>

                                                            <!-- Text Input (Description) -->
                                                            <div class="col-md-12 mt-3">
                                                                <label for="specification-{{ $index + 1 }}-description"
                                                                    class="form-label">Content</label>
                                                                <textarea name="specifications[{{ $index + 1 }}][description]" id="specification-{{ $index + 1 }}-description"
                                                                    class="form-control" rows="4">{{ old('specifications.' . $index + 1 . '.description', $specification['description'] ?? '') }}</textarea>
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
                                                                        <!-- Hidden field to store the image path -->
                                                                        <input type="hidden" name="specifications[${specificationIndex}][imagePath]" id="specification-${specificationIndex}-image-path" />
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

                                                    // Handle file upload and image preview
                                                    window.uploadAndPreviewImage = function(input, index) {
                                                        const file = input.files[0];
                                                        if (file) {
                                                            const formData = new FormData();
                                                            formData.append('file', file);

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
        // Predefined facilities data (in a real use case, this will come from the server)
        const facilities = @json($facilities); // Assuming $facilities is passed to the view

        // Predefined selected facilities (in a real use case, this will come from the server)
        let selectedFacilities = @json($selectedFacilities ?? []);

        // Function to render the form rows
        function renderRows() {
            const container = document.getElementById('facilitiesContainer');
            container.innerHTML = ''; // Clear the container before re-rendering

            selectedFacilities.forEach((item, index) => {
                const row = document.createElement('div');
                row.classList.add('row', 'g-2', 'mb-2');

                row.innerHTML = `
                <div class="col">
                    <label class="form-label">Facility</label>
                    <select name="facilities[${index}][id]" class="form-control" onchange="removeSelectedItem(${index})">
                        <option value="">Select Facility</option>
                        ${facilities.map(facility => `
                                                                        <option value="${facility.id}" ${facility.id === item.id ? 'selected' : ''}>${facility.name}</option>
                                                                    `).join('')}
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">Distance</label>
                    <input type="text" name="facilities[${index}][distance]" class="form-control" placeholder="Facility name  (Distance)" value="${item.distance || ''}">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn bg-danger p-0 text-light" onclick="deleteRow(${index})"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor"
                            class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path
                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </button>
                </div>
            `;

                container.appendChild(row);
            });
        }

        // Function to add a new row
        function addRow() {
            selectedFacilities.push({
                id: '',
                distance: ''
            });
            renderRows();
        }

        // Function to delete a row
        function deleteRow(index) {
            selectedFacilities.splice(index, 1);
            renderRows();
        }

        // Function to remove selected item (optional logic based on the change event)
        function removeSelectedItem(index) {
            // Logic to remove selected item can be added here if needed
        }

        // Initial render when the page loads
        renderRows();
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

                // Reference the form element
                const formElement = document.getElementById('proectForm');
                const formData = new FormData(formElement);

                try {
                    const response = await fetch(`{{ isset($project) ? route('admin.projects.update', $project->id) : route('admin.projects.store') }}`, {
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

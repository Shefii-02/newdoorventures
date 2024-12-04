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

            <!-- Form -->
            <form enctype="multipart/form-data"
                action="{{ isset($project) ? route('admin.projects.update', $project->id) : route('admin.projects.store') }}"
                method="POST">
                @csrf
                @if (isset($project))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="gap-3 col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="mb-3 position-relative">
                                            <label class="mb-3 block text-sm font-medium text-black dark:text-dark"
                                                for="name" aria-required="true">Name</label>
                                            <input class="form-control" data-counter="250" placeholder="Name" required
                                                autocomplete="off" name="name" type="text"
                                                value="{{ old('name', $property->name ?? '') }}" aria-required="true">
                                        </div>

                                        <div class="mb-3">
                                            <div class="slug-field-wrapper" data-field-name="name">
                                                <div class="mb-3 position-relative">
                                                    <label class="mb-3 block text-sm font-medium text-black dark:text-dark"
                                                        for="slug" aria-required="true">Permalink</label>
                                                    <div class="input-group input-group-flat">
                                                        <span class="input-group-text">
                                                            {{ url('projects/') }}
                                                        </span>
                                                        <input class="form-control ps-0" type="text" name="slug"
                                                            id="slug" required autocomplete="off" aria-required="true"
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
                                                placeholder="Property location/address" id="location" autocomplete="off"
                                                name="location" type="text"
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
                                                target="_blank" rel="nofollow">Go here to get Latitude from address.</a>
                                        </div>

                                        <div class="form-group mb-3 col-md-4">
                                            <label for="longitude"
                                                class="mb-3 block text-sm font-medium text-black dark:text-dark">Longitude</label>
                                            <input class="form-control" placeholder="Ex: 103.812530" autocomplete="off"
                                                id="auto_longitude" name="longitude" type="text"
                                                value="{{ old('longitude', $property->longitude ?? '') }}">
                                            <a class="form-hint"
                                                href="https://www.latlong.net/convert-address-to-lat-long.html"
                                                target="_blank" rel="nofollow">Go here to get Longitude from address.</a>
                                        </div>
                                        <!-- Existing Images -->
                                        <div class="mb-3 position-relative" x-data="{ images: @json(isset($property) ? $property->images : []), deletedImages: [] }">
                                            <label
                                                class="mb-3 block text-sm font-medium text-black dark:text-dark">Uploaded
                                                Images</label>
                                            <div class="gallery-images-wrapper list-images form-fieldset">
                                                <template x-for="(image, index) in images" :key="index">
                                                    <div class="image-preview" class="mb-2">
                                                        <img :src="`/storage/${image.path}`" alt="Image"
                                                            class="img-thumbnail mb-1" style="max-width: 100px;">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            @click="deletedImages.push(image.id); images.splice(index, 1)">
                                                            Remove
                                                        </button>
                                                    </div>
                                                </template>
                                            </div>

                                            <!-- Hidden input for deleted images -->
                                            <input type="hidden" name="deleted_images"
                                                :value="JSON.stringify(deletedImages)">
                                        </div>

                                        <!-- Add New Images -->
                                        <div class="mb-3 position-relative" x-data="{ newImages: [] }">
                                            <label for="images[]"
                                                class="mb-3 block text-sm font-medium text-black dark:text-dark">Add New
                                                Images</label>
                                            <input type="file" name="new_images[]" class="form-control" multiple
                                                accept="image/*"
                                                @change="Array.from($event.target.files).forEach(file => newImages.push(file))">
                                            <div class="gallery-images-wrapper mt-2">
                                                <template x-for="(file, index) in newImages" :key="index">
                                                    <div class="image-preview mb-2">
                                                        <img :src="URL.createObjectURL(file)" alt="Image Preview"
                                                            class="img-thumbnail mb-1" style="max-width: 100px;">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            @click="newImages.splice(index, 1)">
                                                            Remove
                                                        </button>
                                                    </div>
                                                </template>
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
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="price_from"
                                                class="mb-3 block text-sm font-medium text-black dark:text-dark">Lowest
                                                price</label>
                                            <input class="form-control input-mask-number" placeholder="Lowest price"
                                                data-thousands-separator="," data-decimal-separator="." name="price_from"
                                                type="text" id="price_from">
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="price_to"
                                                class="mb-3 block text-sm font-medium text-black dark:text-dark">Max
                                                price</label>
                                            <input class="form-control input-mask-number" placeholder="Max price"
                                                data-thousands-separator="," data-decimal-separator="." name="price_to"
                                                type="text" id="price_to">
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="resale_properties"
                                                class="mb-3 block text-sm font-medium text-black dark:text-dark"> Resale
                                                Properties in this project</label>
                                            <input class="form-control" placeholder="" name="resale_properties"
                                                type="number" id="resale_properties">
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label for="rent_properties"
                                                class="mb-3 block text-sm font-medium text-black dark:text-dark">Rental
                                                Properties in this project</label>
                                            <input class="form-control" placeholder="" name="rent_properties"
                                                type="number" id="rent_properties">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title"> Unit Price </h4>
                            </div>
                            <div class="card-body">
                                <div id="unit-details-container">
                                    <div class="col-lg-12 border p-3 rounded-3 unit-details-box">
                                        <div class="row position-relative" data-index="0">
                                            <!-- Unit Type -->
                                            <div class="col-md-4"><label for="unit-detail-0-unit_type"
                                                    class="form-label mb-2">Unit Type</label><input type="text"
                                                    name="unitDetails[0][unit_type]" id="unit-detail-0-unit_type"
                                                    class="form-control" value=""></div>
                                            <!-- Size in Sq.ft -->
                                            <div class="col-md-4"><label for="unit-detail-0-size"
                                                    class="form-label mb-2">Size in Sq.ft</label><input type="number"
                                                    name="unitDetails[0][size]" id="unit-detail-0-size"
                                                    class="form-control" value=""></div>
                                            <!-- Approx. Price -->
                                            <div class="col-md-4"><label for="unit-detail-0-price"
                                                    class="form-label mb-2">Approx. Price (all Inclusive)</label><input
                                                    type="number" name="unitDetails[0][price]" id="unit-detail-0-price"
                                                    class="form-control" value=""></div>
                                            <!-- Delete Button -->
                                            <div class="position-absolute"><button type="button"
                                                    class="btn btn-theme delete-unit-detail-btn ribbon top-0"
                                                    onclick="removeUnitDetailRow(this)"><i
                                                        class="fa fa-times"></i></button></div>
                                        </div>
                                    </div>
                                    <!-- Existing Unit Details -->
                                </div>
                                <!-- Add New Unit Details Button --><button type="button" class="btn btn-primary mt-3"
                                    id="add-unit-detail-btn"> Add new </button>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title"> Distance key between landmarks </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="row g-2 mb-2">
                                                <div class="col"><select name="facilities[01][id]"
                                                        class="select-search-full ui-select select2-hidden-accessible"
                                                        data-select2-id="select2-data-1-31ii" tabindex="-1"
                                                        aria-hidden="true">
                                                        <option value="" data-select2-id="select2-data-3-y3nx">
                                                            Select facility</option>
                                                        <option value="1">Educational Institute</option>
                                                        <option value="2">Transportation Hub</option>
                                                        <option value="3">Shopping Centre</option>
                                                        <option value="4">Hospital</option>
                                                        <option value="5">Commercial Hub</option>
                                                    </select>
                                                    <span class="select2 select2-container select2-container--default"
                                                        dir="ltr" data-select2-id="select2-data-2-ymnv"
                                                        style="width: 100%;"><span class="selection"><span
                                                                class="select2-selection select2-selection--single"
                                                                role="combobox" aria-haspopup="true"
                                                                aria-expanded="false" tabindex="0"
                                                                aria-disabled="false"
                                                                aria-labelledby="select2-facilities01id-lo-container"
                                                                aria-controls="select2-facilities01id-lo-container"><span
                                                                    class="select2-selection__rendered"
                                                                    id="select2-facilities01id-lo-container"
                                                                    role="textbox" aria-readonly="true"
                                                                    title="Select facility">Select facility</span>
                                                                <span class="select2-selection__arrow"
                                                                    role="presentation"><b role="presentation"></b></span>
                                                            </span>
                                                        </span><span class="dropdown-wrapper"
                                                            aria-hidden="true"></span></span>
                                                </div>
                                                <div class="col"><input type="text" autocomplete="off"
                                                        name="facilities[01][distance]" class="form-control"
                                                        placeholder="Distance (E.g: 200m, 1km...)"></div>
                                                <div class="col-auto"><button class="btn btn-icon" type="button"><span
                                                            class="icon-tabler-wrapper icon-left"><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-trash" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path d="M4 7l16 0"></path>
                                                                <path d="M10 11l0 6"></path>
                                                                <path d="M14 11l0 6"></path>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                </path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg></span></button></div>
                                            </div>
                                        </div><a href="javascript:void(0)" role="button">Add new</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title"> Configration </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <!-- Loop through dynamically added facilities -->
                                            <div class="row g-2 mb-2">
                                                <!-- Facility Selector -->
                                                <div class="col"><select name="configration[0][id]"
                                                        class="form-control select-search-full ui-select select2-hidden-accessible"
                                                        data-select2-id="select2-data-4-18az" tabindex="-1"
                                                        aria-hidden="true">
                                                        <option value="" data-select2-id="select2-data-6-gvd2">
                                                            Select configration</option>
                                                        <option value="8">Total Land Area</option>
                                                        <option value="9">No. of Units</option>
                                                        <option value="10">Towers and Blocks</option>
                                                        <option value="11">Unit Variants</option>
                                                        <option value="12">Possession Time</option>
                                                    </select>
                                                    <span class="select2 select2-container select2-container--default"
                                                        dir="ltr" data-select2-id="select2-data-5-rje5"
                                                        style="width: 100%;"><span class="selection"><span
                                                                class="select2-selection select2-selection--single"
                                                                role="combobox" aria-haspopup="true"
                                                                aria-expanded="false" tabindex="0"
                                                                aria-disabled="false"
                                                                aria-labelledby="select2-configration0id-9i-container"
                                                                aria-controls="select2-configration0id-9i-container"><span
                                                                    class="select2-selection__rendered"
                                                                    id="select2-configration0id-9i-container"
                                                                    role="textbox" aria-readonly="true"
                                                                    title="Select configration">Select configration</span>
                                                                <span class="select2-selection__arrow"
                                                                    role="presentation"><b role="presentation"></b></span>
                                                            </span>
                                                        </span><span class="dropdown-wrapper"
                                                            aria-hidden="true"></span></span>
                                                </div>
                                                <!-- Distance Input -->
                                                <div class="col"><input type="text" autocomplete="off"
                                                        name="configration[0][distance]" class="form-control"
                                                        placeholder=""></div>
                                                <!-- Delete Row Button -->
                                                <div class="col-auto"><button class="btn btn-icon" type="button"><span
                                                            class="icon-tabler-wrapper icon-left"><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-trash" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path d="M4 7l16 0"></path>
                                                                <path d="M10 11l0 6"></path>
                                                                <path d="M14 11l0 6"></path>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                </path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg></span></button></div>
                                            </div>
                                        </div>
                                        <!-- Add New Facility Button --><a href="javascript:void(0)" role="button"
                                            class="btn btn-primary"> Add new </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title"> Specifications </h4>
                            </div>
                            <div class="card-body">
                                <div id="specifications-container">
                                    <div class="col-lg-12 border p-3 rounded-3 specification-box">
                                        <div class="row position-relative" data-index="0">
                                            <!-- Image Input (Media Image Field) -->
                                            <div class="col-md-6"><label for="specification-0-image"
                                                    class="form-label mb-2">Icon</label><input type="file"
                                                    name="specifications[0][image]" id="specification-0-image"
                                                    class="form-control media-image-picker"
                                                    onchange="uploadAndPreviewImage(this, 0)" value=""><img
                                                    id="preview-0" src="#" alt="Preview Image"
                                                    style="max-width: 150px; display: none;">
                                                <!-- Hidden field to store the image path --><input type="hidden"
                                                    name="specifications[0][imagePath]" id="specification-0-image-path"
                                                    value=""></div>
                                            <!-- Text Input (Description) -->
                                            <div class="col-md-12 mt-3"><label for="specification-0-description"
                                                    class="mb-3 block text-sm font-medium text-black dark:text-dark">Content</label>
                                                <textarea name="specifications[0][description]" id="specification-0-description" class="form-control"
                                                    rows="4"></textarea>
                                            </div>
                                            <!-- Delete Row Button -->
                                            <div class="position-absolute"><button type="button"
                                                    class="btn btn-theme delete-specification-btn ribbon top-0"
                                                    onclick="removeSpecificationRow(this)"><i
                                                        class="fa fa-times"></i></button></div>
                                        </div>
                                    </div>
                                    <!-- Dynamically added specification rows will be appended here -->
                                </div>
                                <!-- Add New Specification Button --><button type="button" class="btn btn-primary mt-3"
                                    id="add-specification-btn"> Add new </button>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title"> Ameneties </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="row">
                                        @for ($i = 0; $i < 10; $i++)
                                            <div class="col-lg-3">
                                                <div class="d-flex  align-items-center">
                                                    <label class="form-check form-check-inline mb-3"><input
                                                            type="checkbox" name="features[]" class="form-check-input"
                                                            value="1"><span
                                                            class="form-check-label text-capitalize"><img
                                                                src="http://127.0.0.1:8001/storage/ameneties/power-backup.gif"
                                                                class="w-4">
                                                            Power Backup </span>
                                                    </label>
                                                </div>

                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="advanced-sortables" class="meta-box-sortables">
                            <div class="card meta-boxes mb-3" id="seo_wrap">
                                <div class="card-header">
                                    <h4 class="card-title"> Search Engine Optimize </h4>
                                    <div class="card-actions"><a href="#" class="btn-trigger-show-seo-detail">
                                            Edit SEO meta </a></div>
                                </div>
                                <div class="card-body">
                                    <div class="seo-preview">
                                        <p class="default-seo-description"> Setup meta title &amp; description to make
                                            your site easy to discovered on search engines such as Google </p>
                                        <div class="existed-seo-meta hidden">
                                            <h4 class="page-title-seo text-truncate"></h4>
                                            <div class="page-url-seo">
                                                <p>-</p>
                                            </div>
                                            <div><span style="color: rgb(112, 117, 122);">Dec 04, 2024 - </span><span
                                                    class="page-description-seo"></span></div>
                                        </div>
                                    </div>
                                    <div class="hidden seo-edit-section">
                                        <hr class="my-4">
                                        <div class="mb-3 position-relative"><label
                                                class="mb-3 block text-sm font-medium text-black dark:text-dark"
                                                for="seo_meta[seo_title]"> SEO Title </label><input class="form-control"
                                                data-counter="70" placeholder="SEO Title" data-allow-over-limit=""
                                                v-pre="1" autocomplete="off" name="seo_meta[seo_title]"
                                                type="text"></div>
                                        <div class="mb-3 position-relative"><label for="seo_meta[seo_description]"
                                                class="mb-3 block text-sm font-medium text-black dark:text-dark">SEO
                                                description</label>
                                            <textarea class="form-control" data-counter="160" rows="3" placeholder="SEO description"
                                                data-allow-over-limit="" v-pre="1" name="seo_meta[seo_description]" cols="50"
                                                id="seo_meta[seo_description]"></textarea>
                                        </div>
                                        <div class="mb-3 position-relative"><label for="seo_meta[index]"
                                                class="mb-3 block text-sm font-medium text-black dark:text-dark">Index</label>
                                            <div class="position-relative form-check-group mb-3"><label
                                                    class="form-check form-check-inline"><input class="form-check-input"
                                                        v-pre="1" type="radio" name="seo_meta[index]"
                                                        checked="" value="index"><span
                                                        class="form-check-label">Index</span></label><label
                                                    class="form-check form-check-inline"><input class="form-check-input"
                                                        v-pre="1" type="radio" name="seo_meta[index]"
                                                        value="noindex"><span class="form-check-label">No
                                                        index</span></label></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" gap-3 d-flex flex-column-reverse flex-md-column mb-md-0 mb-5">


                        <div class="card meta-boxes">
                            <div class="card-header">
                                <h4 class="card-title"><label for="status" class="form-label required"
                                        aria-required="true">Status</label></h4>
                            </div>
                            <div class="card-body"><select class="form-control form-select" required=""
                                    data-placeholder="Select an option" id="status" name="status"
                                    aria-required="true">
                                    <option value="not_available">Not available</option>
                                    <option value="pre_sale">Preparing selling</option>
                                    <option value="selling">Selling</option>
                                    <option value="sold">Sold</option>
                                    <option value="building">Building</option>
                                </select></div>
                        </div>
                        <div class="card meta-boxes">
                            <div class="card-header">
                                <h4 class="card-title"><label for="investor_id"
                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Builder</label>
                                </h4>
                            </div>
                            <div class="card-body"><select
                                    class="form-control select-search-full form-select select2-hidden-accessible"
                                    data-placeholder="Select an option" id="investor_id" name="investor_id"
                                    data-select2-id="select2-data-investor_id" tabindex="-1" aria-hidden="true">
                                    <option value="0" data-select2-id="select2-data-8-mprv">Select an builder...
                                    </option>
                                    <option value="1">Puravankara</option>
                                </select>
                                <span class="select2 select2-container select2-container--default" dir="ltr"
                                    data-select2-id="select2-data-7-bukb" style="width: 100%;"><span
                                        class="selection"><span class="select2-selection select2-selection--single"
                                            role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-disabled="false" aria-labelledby="select2-investor_id-container"
                                            aria-controls="select2-investor_id-container"><span
                                                class="select2-selection__rendered" id="select2-investor_id-container"
                                                role="textbox" aria-readonly="true" title="Select an builder...">Select
                                                an builder...</span>
                                            <span class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span>
                                        </span>
                                    </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>
                        <div class="card meta-boxes">
                            <div class="card-header">
                                <h4 class="card-title"><label for="construction_status" class="form-label required"
                                        aria-required="true">Construction status</label></h4>
                            </div>
                            <div class="card-body"><select class="select-full form-select select2-hidden-accessible"
                                    required="" data-placeholder="Select an option" id="construction_status"
                                    name="construction_status" data-select2-id="select2-data-construction_status"
                                    tabindex="-1" aria-hidden="true" aria-required="true">
                                    <option selected="" value="new_launch" data-select2-id="select2-data-10-qgo6">
                                        new_launch</option>
                                    <option value="under_construction">under_construction</option>
                                    <option value="ready_to_move">ready_to_move</option>
                                </select>
                                <span class="select2 select2-container select2-container--default" dir="ltr"
                                    data-select2-id="select2-data-9-7wph" style="width: 100%;"><span
                                        class="selection"><span class="select2-selection select2-selection--single"
                                            role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-disabled="false" aria-labelledby="select2-construction_status-container"
                                            aria-controls="select2-construction_status-container"><span
                                                class="select2-selection__rendered"
                                                id="select2-construction_status-container" role="textbox"
                                                aria-readonly="true" title="new_launch">new_launch</span>
                                            <span class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span>
                                        </span>
                                    </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>
                        <div class="card meta-boxes">
                            <div class="card-header">
                                <h4 class="card-title"><label for="possession"
                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">Possession/Completed
                                        Year&amp;Month</label></h4>
                            </div>
                            <div class="card-body"><input class="form-control" name="possession" type="month"
                                    id="possession"></div>
                        </div>
                        <div class="card meta-boxes">
                            <div class="card-header">
                                <h4 class="card-title"><label for="rera_status" class="form-label required"
                                        aria-required="true">RERA Status</label></h4>
                            </div>
                            <div class="card-body"><select
                                    class="select-full mb-3 col-md-6 form-select select2-hidden-accessible" required=""
                                    data-placeholder="Select an option" id="rera_status" name="rera_status"
                                    data-select2-id="select2-data-rera_status" tabindex="-1" aria-hidden="true"
                                    aria-required="true">
                                    <option selected="" value="registered" data-select2-id="select2-data-12-ty4s">
                                        registered</option>
                                    <option value="unregistered">unregistered</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    data-select2-id="select2-data-11-4xzb" style="width: 100%;"><span
                                        class="selection"><span class="select2-selection select2-selection--single"
                                            role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-disabled="false" aria-labelledby="select2-rera_status-container"
                                            aria-controls="select2-rera_status-container"><span
                                                class="select2-selection__rendered" id="select2-rera_status-container"
                                                role="textbox" aria-readonly="true" title="registered">registered</span>
                                            <span class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span>
                                        </span>
                                    </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>
                        <div class="card meta-boxes">
                            <div class="card-header">
                                <h4 class="card-title"><label for="rera_reg_no"
                                        class="mb-3 block text-sm font-medium text-black dark:text-dark">RERA Reg
                                        No.</label></h4>
                            </div>
                            <div class="card-body"><input class="form-control" placeholder="" data-counter="300"
                                    autocomplete="off" name="rera_reg_no" type="text" id="rera_reg_no"></div>
                        </div>
                        <div class="card meta-boxes">
                            <div class="card-header">
                                <h4 class="card-title"><label for="categories[]" class="form-label required"
                                        aria-required="true">Categories</label></h4>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <div class="multi-choices-widget list-item-checkbox ms-n3"
                                        data-bb-toggle="tree-checkboxes">
                                        <ul class="list-unstyled ms-3">
                                            <li value="1"><label class="form-check"><input type="checkbox"
                                                        name="categories[]" class="form-check-input" value="1"><span
                                                        class="form-check-label text-capitalize">
                                                        Flat/Apartment </span></label></li>
                                            <li value="4"><label class="form-check"><input type="checkbox"
                                                        name="categories[]" class="form-check-input" value="4"><span
                                                        class="form-check-label text-capitalize">
                                                        Independent House </span></label></li>
                                            <li value="2"><label class="form-check"><input type="checkbox"
                                                        name="categories[]" class="form-check-input" value="2"><span
                                                        class="form-check-label text-capitalize">
                                                        Villa </span></label></li>
                                            <li value="8"><label class="form-check"><input type="checkbox"
                                                        name="categories[]" class="form-check-input" value="8"><span
                                                        class="form-check-label text-capitalize">
                                                        Pent House </span></label></li>
                                            <li value="7"><label class="form-check"><input type="checkbox"
                                                        name="categories[]" class="form-check-input" value="7"><span
                                                        class="form-check-label text-capitalize">
                                                        Row houses </span></label></li>
                                            <li value="9"><label class="form-check"><input type="checkbox"
                                                        name="categories[]" class="form-check-input" value="9"><span
                                                        class="form-check-label text-capitalize">
                                                        Plot and Land </span></label></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

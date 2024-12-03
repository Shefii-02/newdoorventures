@extends('admin.layouts.master')

@section('content')
    <div class="flex flex-col gap-9">
        <!-- Form Container -->
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-dark">
                    {{ isset($category) ? 'Edit Category' : 'Create a Category' }}
                </h3>
            </div>

            <!-- Form -->
            <form
                action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}"
                method="POST">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif

                <div class="p-6.5">
                    <!-- Category Name -->
                    <div class="mb-5 flex flex-col gap-6 xl:flex-row">
                        <div class="col-lg-6">
                            <label for="name" class="mb-3 block text-sm font-medium text-black dark:text-dark">
                                Category Name
                            </label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', $category->name ?? '') }}" 
                                class="form-control" required>
                            @error('name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="row ">
                            <div class="form-group mb-3 col-md-4">
                                <label class="form-check form-switch">
                                    <input name="has_sell" type="hidden" value="0">
                                    <input class="form-check-input" name="has_sell" type="checkbox" value="1"
                                        id="has_sell"
                                        {{ old('has_sell', isset($category) && $category->has_sell ? 'checked' : '') }}>
                                    <span class="form-check-label">Available for Sell</span>
                                </label>
                            </div>

                            <div class="form-group mb-3 col-md-4">
                                <label class="form-check form-switch">
                                    <input name="has_rent" type="hidden" value="0">
                                    <input class="form-check-input" name="has_rent" type="checkbox" value="1"
                                        id="has_rent"
                                        {{ old('has_rent', isset($category) && $category->has_rent ? 'checked' : '') }}>
                                    <span class="form-check-label">Available for Rent</span>
                                </label>
                            </div>

                            <div class="form-group mb-3 col-md-4">
                                <label class="form-check form-switch">
                                    <input name="has_pg" type="hidden" value="0">
                                    <input class="form-check-input" name="has_pg" type="checkbox" value="1"
                                        id="has_pg"
                                        {{ old('has_pg', isset($category) && $category->has_pg ? 'checked' : '') }}>
                                    <span class="form-check-label">Available for PG</span>
                                </label>
                            </div>

                            <div class="form-group mb-3 col-md-4">
                                <label class="form-check form-switch">
                                    <input name="has_residential" type="hidden" value="0">
                                    <input class="form-check-input" name="has_residential" type="checkbox" value="1"
                                        id="has_residential"
                                        {{ old('has_residential', isset($category) && $category->has_residential ? 'checked' : '') }}>
                                    <span class="form-check-label">It’s a Residential</span>
                                </label>
                            </div>

                            <div class="form-group mb-3 col-md-4">
                                <label class="form-check form-switch">
                                    <input name="has_commercial" type="hidden" value="0">
                                    <input class="form-check-input" name="has_commercial" type="checkbox" value="1"
                                        id="has_commercial"
                                        {{ old('has_commercial', isset($category) && $category->has_commercial ? 'checked' : '') }}>
                                    <span class="form-check-label">It’s a Commercial</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <button type="submit"
                            class="rounded bg-primary px-6 py-2 text-white transition hover:bg-primary-dark">
                            {{ isset($category) ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

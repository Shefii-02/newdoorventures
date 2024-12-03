@extends('admin.layouts.master')

@section('content')
    <div class="flex flex-col gap-9">
        <!-- Form Container -->
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-dark">
                    {{ isset($customField) ? 'Edit Custom Field' : 'Create a Custom Field' }}
                </h3>
            </div>

            <!-- Form -->
            <form enctype="multipart/form-data"
                action="{{ isset($customField) ? route('admin.custom-fields.update', $customField->id) : route('admin.custom-fields.store') }}"
                method="POST">
                @csrf
                @if (isset($customField))
                    @method('PUT')
                @endif

                <div class="p-6.5">
                    <!-- customField Name -->
                    <div class="mb-5 ">
                        <div class="col-lg-6">
                            <label for="name" class="mb-3 block text-sm font-medium text-black dark:text-dark">
                                Field Name
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $customField->name ?? '') }}"
                                class="form-control" required>
                            @error('name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6  mt-4">

                            <div class="form-group mb-3 col-md-4">
                                <label class="form-check form-switch">
                                    <input name="has_sell" type="hidden" value="0">
                                    <input class="form-check-input" name="has_sell" type="checkbox" value="1"
                                        id="has_sell"
                                        {{ old('has_sell', isset($customField) && $customField->has_sell ? 'checked' : '') }}>
                                    <span class="form-check-label">Available for Sell</span>
                                </label>
                            </div>

                            <div class="form-group mb-3 col-md-4">
                                <label class="form-check form-switch">
                                    <input name="has_rent" type="hidden" value="0">
                                    <input class="form-check-input" name="has_rent" type="checkbox" value="1"
                                        id="has_rent"
                                        {{ old('has_rent', isset($customField) && $customField->has_rent ? 'checked' : '') }}>
                                    <span class="form-check-label">Available for Rent</span>
                                </label>
                            </div>

                            <div class="form-group mb-3 col-md-4">
                                <label class="form-check form-switch">
                                    <input name="has_pg" type="hidden" value="0">
                                    <input class="form-check-input" name="has_pg" type="checkbox" value="1"
                                        id="has_pg"
                                        {{ old('has_pg', isset($customField) && $customField->has_pg ? 'checked' : '') }}>
                                    <span class="form-check-label">Available for PG</span>
                                </label>
                            </div>

                        </div>
                        <div class="col-lg-6  mt-4 d-none">
                            <label for="name" class="mb-1 block text-sm font-medium text-black dark:text-dark">
                                Selecting Option Type
                            </label>
                            <div class="d-flex gap-3 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" value="text"
                                        id="typeText"
                                        {{ old('type', $customField->type ?? '') == 'text' ? 'checked' : 'checked' }}>
                                    <label class="form-check-label" for="typeText">
                                        Text Field
                                    </label>
                                </div>
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit"
                                class="rounded bg-primary px-6 py-2 text-white transition hover:bg-primary-dark">
                                {{ isset($customField) ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection

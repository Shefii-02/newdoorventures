@extends('admin.layouts.master')

@section('content')
    <div class="flex flex-col gap-9">
        <!-- Form Container -->
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-dark">
                    {{ isset($advertisement) ? 'Edit Advertisement' : 'Create a Advertisement' }}
                </h3>
            </div>
            
            <!-- Form -->
            <form enctype="multipart/form-data"
                action="{{ isset($advertisement) ? route('admin.advertisement.update', $advertisement->id) : route('admin.advertisement.store') }}"
                method="POST">
                @csrf
                @if (isset($advertisement))
                    @method('PUT')
                @endif

                <div class="p-6.5">
                    <!-- Category Name -->
                    <div class="mb-5 ">
                        <div class="col-lg-6 mb-3">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-dark">Advertisement Image</label>
                            <div x-data="{
                                    image: null,
                                    imageUrl: '{{ isset($advertisement) && $advertisement->image ? asset('images/'.$advertisement->image) : '' }}',
                                    handleFileUpload(event) {
                                        const file = event.target.files[0];
                                        if (file) {
                                            this.image = file;
                                            this.imageUrl = URL.createObjectURL(file);
                                        }
                                    },
                                    removeImage() {
                                        this.image = null;
                                        this.imageUrl = '';
                                        this.$refs.fileInput.value = ''; // Clear file input
                                    }
                                }" class="w-full flex ">
                        
                                <!-- Image Preview and Remove Option -->
                                <template x-if="imageUrl">
                                    <div class="relative mt-4">
                                        <img :src="imageUrl" class="w-30 h-30 object-cover rounded-lg" />
                                        <button type="button" class="absolute top-0 right-0 text-white bg-red rounded-full p-1" @click="removeImage">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                <path d="M8 6.586L6.586 8 8 9.414l1.414-1.414L8 6.586z" />
                                                <path d="M8 14a6 6 0 1 0 0-12 6 6 0 0 0 0 12zm0 1a7 7 0 1 1 0-14 7 7 0 0 1 0 14z" />
                                            </svg>
                                        </button>
                                        @if(isset($advertisement))
                                        <input type="hidden" value="1" name="exist_image">
                                        @endif
                                    </div>
                                </template>
                        
                                <!-- File Input and Image Upload Area -->
                                <label for="dropzone-file"
                                    class="bg-gray-50 border-2 border-dashed border-gray-300 cursor-pointer dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:bg-gray-800 dark:hover:border-gray-500 flex flex-col h-30 hover:bg-gray-100 items-center justify-center ml-10 mt-4 rounded-lg w-1/4">
                                    <div class="flex flex-col items-center justify-center pt-2 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Click to upload</span>
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            SVG, PNG, JPG or GIF 
                                        </p>
                                    </div>
                                    <input x-ref="fileInput" type="file" id="dropzone-file" class="hidden" name="icon" 
                                        @change="handleFileUpload" />
                                </label>
                            </div>
                        </div>
                        

                       

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit"
                                class="rounded bg-primary px-6 py-2 text-white transition hover:bg-primary-dark">
                                {{ isset($advertisement) ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection

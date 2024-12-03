@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Profile Edit</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="container  sm:rounded-lg">

        <div class="row">
            <div class="col-lg-6 p-5">
                <div class="card p-5 ">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="items-center  text-[#202142]">
                            <div class=" p-2 mb-5">
                                <div class="flex items-center ">

                                    <div class="w-2/4">
                                        <img class="object-cover  w-20 h-20 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                                            src="{{ auth()->user()->avatar_url }}" id="imagePreview" alt="Bordered avatar">
                                    </div>
                                    <div class="w-2/4">
                                        <input type="file" id="avatarInput" accept="image/*" class="hidden"
                                            onchange="previewImage(event)">
                                        <button type="button" onclick="document.getElementById('avatarInput').click()"
                                            class="p-2 text-base font-medium text-indigo-100 focus:outline-none bg-[#202142] rounded-lg border border-indigo-200 hover:bg-indigo-900 focus:z-10 focus:ring-4 focus:ring-indigo-200">
                                            Change picture
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <div
                                class="flex flex-col items-center row mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                                <div class="col-lg-6">
                                    <label for="first_name"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                                        first name</label>
                                    <input type="text" id="first_name" name="first_name"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="Your first name" value="{{ auth()->user()->first_name }}"
                                        >
                                        @error('first_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label for="last_name"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                                        last name</label>
                                    <input type="text" id="last_name" name="last_name"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="Your last name" value="{{ auth()->user()->last_name }}" >
                                        @error('last_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                            </div>
                            <div class="mb-2 sm:mb-6 mt-2">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                                    Designation</label>
                                <input type="text" id="name"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    name="name" value="{{ auth()->user()->name }}" >
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="mb-2 sm:mb-6 mt-2">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                                    email</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="your.email@mail.com" >
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>

                           
                            <div class="flex justify-end mt-4">
                                <button type="submit"
                                    class="text-white bg-info  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 p-5">
                <form action="{{ route('admin.profile.changePassword') }}" method="POST">
                    @csrf
                    <div class="card p-5">
                        <div class="items-center text-[#202142]">
                            <div class="w-full">
                                <!-- New Password Input -->
                                <label for="new_password" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">New Password</label>
                                <input type="password" id="new_password" name="new_password"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                    placeholder="Enter your new password" required>
                                @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
            
                            <div class="w-full mt-3">
                                <!-- Confirm Password Input -->
                                <label for="new_password_confirmation" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Confirm Password</label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                    placeholder="Confirm your new password" required>
                                @error('new_password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
            
                            <div class="flex justify-end mt-5">
                                <button type="submit"
                                    class="text-white bg-info hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            
        </div>
        <div class="flex mt-8">

        </div>
    </div>
@endsection


@push('footer')
    <script>
        function previewImage(event) {

            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const avatarFileInput = document.getElementById('avatarFile');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result; // Update the image preview
                };

                reader.readAsDataURL(file);

                avatarFileInput.value = file.name; // Update the hidden input with file name
            }
        }
    </script>
@endpush

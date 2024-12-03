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

                <div class="p-6.5">
                    <!-- Category Name -->
                    <div class="mb-5 row">
                        

                        <div class="col-lg-12 mb-3">
                            <label for="name" class="mb-3 block text-sm font-medium text-black dark:text-dark">
                                Full Name
                            </label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', $project->name ?? '') }}" 
                                class="form-control" required>
                            @error('name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="ongoing" class="mb-3 block text-sm font-medium text-black dark:text-dark">
                                Ongoing Projects
                            </label>
                            <input type="number" id="ongoing" name="ongoing"
                                value="{{ old('ongoing', $project->ongoing ?? '') }}" 
                                class="form-control" required>
                            @error('ongoing')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="completed" class="mb-3 block text-sm font-medium text-black dark:text-dark">
                                Completed Projects
                            </label>
                            <input type="number" id="completed" name="completed"
                                value="{{ old('completed', $project->completed ?? '') }}" 
                                class="form-control" required>
                            @error('completed')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        


                        <div class="col-lg-12 mb-3">
                            <label for="description" class="mb-3 block text-sm font-medium text-black dark:text-dark">
                               Content
                            </label>
                            <textarea id="description" name="description" class="form-control">{!! old('description', $project->description ?? '') !!}</textarea>
                            @error('description')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                       

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit"
                                class="rounded bg-primary px-6 py-2 text-white transition hover:bg-primary-dark">
                                {{ isset($project) ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection

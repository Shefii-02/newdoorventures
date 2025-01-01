@extends('admin.layouts.master')

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
                        {{ isset($property) ? 'Edit for ' . $property->name : 'Create' }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">

            <div class="col-xl-12 mb-3 mt-4">
                <div class="card bg-primary text-center">
                    <div class="card-body">
                        <h1 class="text-white text-capitalize mb-3">{{ $property->type_name }} Price</h1>
                        <span class="text-white font-w300">{!! shorten_price($property->price) . '<small> (' . indian_number_format($property->price) . ')</small>' !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="text-black fs-20 font-bold mb-3">{{ $property->author->name }}</h4>
                        <span class="mt-2 text-bold mb-3"><a
                                href="mailto:{{ $property->author->email }}">{{ $property->author->email }}</a>
                            <br>
                        </span>
                        <span class="mt-2 text-bold">
                            <a href="tel:{{ $property->author->phone }}">{{ $property->author->phone }}</a></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 mb-3">
                <div class="card rounded-3">

                    <div class="card-body">
                        <iframe width="100%" height="315"
                            src="https://www.youtube.com/embed/{{ $property->youtube_video_url }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <!-- General Location Details -->
            <div class="col-md-12 mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="text-muted font-bold mb-3">Location Details</h5>
                        <p class="mb-2"><strong>Location:</strong><br> {{ $property->location }}</p>
                        <p class="mb-2"><strong>City:</strong> {{ $property->city }}</p>
                        <p class="mb-2"><strong>Locality:</strong> {{ $property->locality }}</p>
                        <p class="mb-2"><strong>Sublocality:</strong> {{ $property->sub_locality }}</p>
                        <p class="mb-2"><strong>Landmark:</strong> {{ $property->landmark }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <p><strong>Current Property Status:</strong>
                            <span
                                class="badge text-capitalize bg-{{ $property->moderation_status == 'approved' ? 'success' : 'warning' }}">
                                {{ $property->moderation_status == 'approved' ? $property->status : $property->moderation_status }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            @if (permission_check('Property Edit'))
                <div class="col-md-12 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('admin.properties.update', $property->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <strong class="mb-3">Status:</strong>
                                    <div class="d-flex gap-4 mt-3 flex-wrap">
                                        <div class="form-check">
                                            <input type="radio" disabled id="statusUnread" name="moderation_status"
                                                value="pending" class="form-check-input"
                                                {{ $property->moderation_status === 'pending' ? 'checked' : '' }}>
                                            <label for="statusUnread" class="form-check-label">Pending</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="statusSuspended" name="moderation_status"
                                                value="suspended" class="form-check-input"
                                                {{ $property->moderation_status === 'suspended' ? 'checked' : '' }}>
                                            <label for="statusSuspended" class="form-check-label">Suspended</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="statusApproved" name="moderation_status"
                                                value="approved" class="form-check-input"
                                                {{ $property->moderation_status === 'approved' ? 'checked' : '' }}>
                                            <label for="statusApproved" class="form-check-label">Approved</label>
                                        </div>
                                        @if ($property->type == 'rent')
                                            <div class="form-check">
                                                <input type="radio" id="statusRenting" name="moderation_status"
                                                    value="renting" class="form-check-input"
                                                    {{ $property->moderation_status === 'renting' ? 'checked' : '' }}>
                                                <label for="statusRenting" class="form-check-label">Renting</label>
                                            </div>

                                            <div class="form-check">
                                                <input type="radio" id="statusRented" name="moderation_status"
                                                    value="rented" class="form-check-input"
                                                    {{ $property->moderation_status === 'rented' ? 'checked' : '' }}>
                                                <label for="statusRented" class="form-check-label">Rented</label>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <input type="radio" id="statusSold" name="moderation_status"
                                                    value="sold" class="form-check-input"
                                                    {{ $property->moderation_status === 'sold' ? 'checked' : '' }}>
                                                <label for="statusSold" class="form-check-label">Sold</label>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="mt-4 col-lg-12">
                                        <button type="submit"
                                            class="bg-success text-white px-4 py-2 rounded btn-block w-full">Save</button>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif


        </div>
        <div class="col-lg-7">
            <div class="col-xl-12 mb-4 mt-4">
                <div class="card bg-white text-center">
                    <div class="card-body">
                        <div
                            data-slick='{
                        "autoplay": true,
                        "autoplaySpeed": 2000,
                        "slidesToShow": 1,
                        "slidesToScroll": 1,
                        "arrows": true,
                        "dots": false,
                        "infinite": true,
                        "responsive": [
                            {"breakpoint": 1024, "settings": {"slidesToShow": 3}},
                            {"breakpoint": 768, "settings": {"slidesToShow": 2}},
                            {"breakpoint": 480, "settings": {"slidesToShow": 1}}
                        ]
                    }'>
                            @foreach ($property->images ?? [] as $image)
                                <div>
                                    <img src="{{ asset('images/' . $image) }}" class="w-100 rounded-3 object-cover" />
                                </div>
                            @endforeach
                        </div>
                        <section class="mt-3">
                            <div class="col-lg-12 text-start">
                                <h2 class="fs-4 font-bold mb-3">{{ $property->name }}</h2>
                                <div class="my-3">
                                    Category : <span class="badge bg-dark"> {{ $property->category->name }}</span><br>
                                    Project : <span class="badge bg-dark"> {{ $property->project->name }}</span><br>
                                    Flat No/Villa No : <span class="badge bg-dark"> {{ $property->unit_info }}</span>
                                    <br><br>
                                    <span class="pt-3">
                                        Created At : <span class="text-dark">
                                            {{ date('d M, Y h:i a'), strtotime($property->created_at) }}</span>
                                    </span>
                                </div>
                                <p>
                                    <span class="font-bold">Description</span>
                                <p>{!! $property->content !!}</p>
                                </p>
                                <div class=" mt-4">
                                    <div class="row">
                                        <!-- Room Details -->
                                        <div class="col-md-12 mb-3">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <h3 class="text-success font-bold mb-4 "><u>Room Details</u>
                                                            </h3>
                                                            <p class="mb-3"><strong>Bedrooms:</strong>
                                                                {{ $property->number_bedroom }}
                                                            </p>
                                                            <p class="mb-3"><strong>Bathrooms:</strong>
                                                                {{ $property->number_bathroom }}
                                                            </p>
                                                            <p class="mb-3"><strong>Balconies:</strong>
                                                                {{ $property->balconies ?? 0 }}
                                                            </p>
                                                            <h3 class="text-success font-bold mb-4"><u>Reserved Parking</u>
                                                            </h3>
                                                            <p class="mb-3"><strong>Covered Parking:</strong>
                                                                {{ $property->covered_parking }}
                                                            </p>
                                                            <p><strong>Open Parking:</strong> {{ $property->open_parking }}
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <h5 class="text-success font-bold mb-4"><u>Floor Details</u>
                                                            </h5>
                                                            <p class="mb-3"><strong>Carpet Area:</strong>
                                                                {{ $property->carpet_area }} Sq.ft</p>
                                                            <p class="mb-3"><strong>Super Built-up Area:</strong>
                                                                {{ $property->square }} Sq.ft</p>
                                                            <!-- Pricing Details -->
                                                            <h5 class="text-success font-bold mb-4"><u>Price Details</u>
                                                            </h5>
                                                            <p class="mb-3">
                                                                <strong>All Inclusive Price:</strong>
                                                                <span
                                                                    class="badge bg-{{ $property->all_include == 1 ? 'success' : 'danger' }}">
                                                                    {{ $property->all_include == 1 ? 'Yes' : 'No' }}
                                                                </span>
                                                            </p>
                                                            <p class="mb-3">
                                                                <strong>Tax and Govt. Charges:</strong>
                                                                <span
                                                                    class="badge bg-{{ $property->tax_include == 1 ? 'success' : 'danger' }}">
                                                                    {{ $property->tax_include == 1 ? 'Yes' : 'No' }}
                                                                </span>
                                                            </p>
                                                            <p class="mb-3">
                                                                <strong>Price Negotiable:</strong>
                                                                <span
                                                                    class="badge bg-{{ $property->negotiable == 1 ? 'success' : 'danger' }}">
                                                                    {{ $property->negotiable == 1 ? 'Yes' : 'No' }}
                                                                </span>
                                                            </p>
                                                            <p class="mb-3">
                                                                <strong>Ownership:</strong> <span
                                                                    class="bg-dark badge text-capitalize">{{ $property->ownership }}</span>
                                                            </p>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <h5 class="text-success font-bold mb-4"><u>Amenities : </u></h5>
                                                        <div class="row">
                                                            @foreach ($property->features ?? [] as $key => $feature)
                                                                <div class="col-lg-3 mb-3">
                                                                    <div class="d-flex  flex-warp items-center">
                                                                        <img src="{{ $feature->image_url }}"
                                                                            class="">
                                                                        <span
                                                                            class="ms-2 text-sm">{{ $feature->name }}</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <h5 class="text-success font-bold mb-4"><u>Furnishing :</u> <span
                                                                class="text-dark text-capitalize">{{ str_replace('-', ' ', $property->furnishing_status) }}</span>
                                                        </h5>
                                                        <div class="row">
                                                            @foreach ($property->furnishing ?? [] as $key => $furnish)
                                                                <div class="col-lg-3 mb-3">
                                                                    <div class="d-flex  flex-warp items-center">
                                                                        <img src="{{ $furnish->image_url }}"
                                                                            class="">
                                                                        <span
                                                                            class="ms-2 text-sm">{{ $furnish->name }}</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <h3 class="text-success font-bold mb-4 "><u>Additional Details</u>
                                                        </h3>
                                                        <div class="">

                                                            <table class="table ">

                                                                @foreach ($property->customFields ?? [] as $customValue)
                                                                    <tr class="border-bottom-none">
                                                                        <td class="text-gray-800 w-1/2">
                                                                            {{ $customValue->name }}
                                                                        </td>
                                                                        <th>
                                                                            {{ $customValue->value }}
                                                                        </th>
                                                                    </tr>
                                                                @endforeach
                                                                <tr class="border-bottom-none">
                                                                    <td class="text-gray-800 w-1/2">
                                                                        {{ $property->construction_status == 'under-construction' ? 'Possession By:' : 'Age of construction' }}
                                                                    </td>
                                                                    <th>
                                                                        {{ $property->construction_status == 'under-construction' ? $property->possession : $property->property_age . ' years' }}
                                                                    </th>
                                                                </tr>
                                                            </table>
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
    </div>
@endsection

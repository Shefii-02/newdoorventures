@extends('admin.layouts.master')

@section('content')
 

    <div class="row">
        <div class="col-lg-3">

            <div class="col-xl-12 mb-3 mt-4">
                <div class="card bg-primary text-center">
                    <div class="card-body">
                        <h1 class="text-white text-capitalize mb-3">{{ $property->type_name }} Price</h1>
                        <span class="text-white font-w300">{!! shorten_price($property->price) . '<small>(' . $property->price . ')</small>' !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="text-black fs-20 font-bold mb-3">{{ $property->author->name }}</h4>
                        <span class="mt-2 text-bold mb-3"><a href="mailto:{{ $property->author->email }}">{{ $property->author->email }}</a></span>
                        <span class="mt-2 text-bold"><a href="tel:{{ $property->author->phone }}">{{ $property->author->phone }}</a></span>
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
                                        <input type="radio" id="statusSuspended" name="moderation_status" value="suspended"
                                            class="form-check-input"
                                            {{ $property->moderation_status === 'suspended' ? 'checked' : '' }}>
                                        <label for="statusSuspended" class="form-check-label">Suspended</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="statusApproved" name="moderation_status" value="approved"
                                            class="form-check-input"
                                            {{ $property->moderation_status === 'approved' ? 'checked' : '' }}>
                                        <label for="statusApproved" class="form-check-label">Approved</label>
                                    </div>
                                </div>
                                <div class="mt-4 col-lg-12">
                                    <button type="submit" class="bg-success text-white px-4 py-2 rounded btn-block w-full">Save</button>
                                </div>        
    
    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            


        </div>
        <div class="col-lg-9">
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
                                    <span class="badge bg-dark">Category : {{ $property->category->name }}</span>
                                    <span class="badge bg-dark">Project : {{ $property->project->name }}</span>
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
                                                        <h5 class="text-success font-bold mb-4"><u>Ameneties : </u></h5>
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
    </div>

    </div>
    </div>
















       {{-- <div class="d-none">
        <!-- ===== property List Start ===== -->
        <div class="col-span-12">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex items-start justify-between">
                        <h2 class="text-title-sm2 font-bold text-black dark:text-white">
                            Details for {{ $property->name }}
                        </h2>

                    </div>

                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Property Details</h3>
                    <form action="{{ route('admin.properties.update', $property->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <strong class="mb-3">Contact Details:</strong><br>
                            <span>{{ $property->name }}</span><br>
                            <span>{{ $property->email }}</span><br>
                            <span>{{ $property->phone }}</span>
                        </div>

                        <div class="mt-4">
                            <strong class="mb-3">Enquired For:</strong><br>
                            <span>{{ $property->property ? 'Property' : 'Project' }}</span>
                        </div>

                        <div class="mt-4">
                            <strong class="mb-3">Status:</strong>
                            <div class="d-flex gap-4 mt-3">
                                <div class="form-check">
                                    <input type="radio" disabled id="statusUnread" name="moderation_status"
                                        value="pending" class="form-check-input"
                                        {{ $property->moderation_status === 'pending' ? 'checked' : '' }}>
                                    <label for="statusUnread" class="form-check-label">Pending</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="statusSuspended" name="moderation_status" value="suspended"
                                        class="form-check-input"
                                        {{ $property->moderation_status === 'suspended' ? 'checked' : '' }}>
                                    <label for="statusSuspended" class="form-check-label">Suspended</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="statusApproved" name="moderation_status" value="approved"
                                        class="form-check-input"
                                        {{ $property->moderation_status === 'approved' ? 'checked' : '' }}>
                                    <label for="statusApproved" class="form-check-label">Approved</label>
                                </div>
                            </div>


                        </div>

                        <div class="mt-4 text-right">
                            <button type="submit" class="bg-success text-white px-4 py-2 rounded">Save</button>
                            <button type="button" class="bg-red text-white px-4 py-2 rounded"
                                onclick="document.getElementById('property-modal').classList.add('hidden')">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div> --}}
    
    
    
@endsection















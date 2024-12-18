@forelse ($properties as $property)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="w-4 p-4 " colspan="3">
            <a href="#" role="button" title="{{ $property->name }}">
                <img src="{{ asset('images/' . $property->image) }}" class="rounded mb-2 text-center" width="50"
                    alt="Image">
                <span
                    class="fw-bold text-left text-dark-emphasis ">{{ Str::limit($property->name, '15', '...') }}</span>
            </a>
        </td>
        <th scope="row" class="px-2 py-1 text-center font-medium text-capitalize">
            <span class="text-sm">{{ $property->type }}<br>{{ $property->mode }}</span>
        </th>
        <td class="px-2 py-1 text-center">
            <span class="text-sm" role="button"
                title="{{ $property->location }}">{{ Str::limit($property->location ?? '---', '15', '....') }}</span>
        </td>
        <td class="px-2 py-1 text-center" colspan="2">
            <span class="text-sm" role="button"
                title="{{ '₹' . $property->price }}">{{ shorten_price($property->price) }}</span>
        </td>
        <td class="px-2 py-1 text-center">
            <span class="text-sm">{{ $property->leads_count ?? 0 }}</span>
        </td>
        <td class="px-2 py-1 text-center">
            <span class="text-sm">{{ $property->views }}</span>
        </td>
        <th scope="row" class="px-2 py-1 text-center font-medium text-capitalize">
            <span class="text-sm">{{ $property->account->name }}</span>
        </th>
        <td class="px-2 py-1 text-center">
            <span
                class="badge badge-pill text-capitalize text-md {{ $property->moderation_status == 'approved' ? 'bg-success' : ($property->moderation_status == 'pending' ? 'bg-warning' : 'bg-danger') }}  text-light ">
                {{ $property->moderation_status }}
            </span>
        </td>
        <td class="px-2 py-1 text-center">
            <div class="btn-group ">
                @if (permission_check('Property Restore'))
                    <form method="POST" id="re_form_{{ $property->id }}"
                        action="{{ route('admin.trash.update', $property->id) }}">@csrf @method('PUT')</form>
                    <button form="re_form_{{ $property->id }}" type="submit" title="Restore Property"
                        class="mx-auto block hover:text-meta-1 ms-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                            <path
                                d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9" />
                            <path fill-rule="evenodd"
                                d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z" />
                        </svg>
                    </button>
                    <input form="re_form_{{ $property->id }}" type="hidden" value="restore" name="property">
                @endif

                @if (permission_check('Property Delete'))
                    <form method="POST" id="form_{{ $property->id }}"
                        action="{{ route('admin.properties.destroy', $property->id) }}">@csrf @method('DELETE')</form>
                    <button form="form_{{ $property->id }}" type="button"
                        onclick="confirmDelete({{ $property->id }})" title="Delete Permanently"
                        class="mx-auto block hover:text-meta-1 ms-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z">
                            </path>
                            <path
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z">
                            </path>
                        </svg>
                    </button>
                    <input form="form_{{ $property->id }}" type="hidden" value="trash" name="from">
                @endif
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center py-5 fw-bold">
            <p> No Data Found..!</p>
        </td>
    </tr>
@endforelse

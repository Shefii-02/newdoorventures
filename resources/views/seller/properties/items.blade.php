@foreach ($properties as $property)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="w-4 p-4 " colspan="3">
            <a href="#" role="button" title="{{ $property->name }}">
                <img src="{{ asset('images/' . $property->image) }}" class="rounded mb-2 text-center" width="50" alt="Image">
                <span class="fw-bold text-left text-dark-emphasis fs-5">{{ Str::limit($property->name, '15', '...') }}</span>
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
            <span class="text-sm" role="button" title="{{ '₹'.$property->price }}">{{ shorten_price($property->price) }}</span>
        </td>
        <td class="px-2 py-1 text-center">
            <span class="text-sm">{{ $property->leads_count ?? 0 }}</span>
        </td>
        <td class="px-2 py-1 text-center">
            <span class="text-sm">{{ $property->views }}</span>
        </td>
        <td class="px-2 py-1 text-center">
            <span class="badge badge-pill text-capitalize fs-6 {{ $property->moderation_status == 'approved' ? 'bg-success' : (($property->moderation_status == 'pending') ? 'bg-warning' :  'bg-primary')  }}  text-light ">
                {{ $property->moderation_status }}
            </span>
        </td>
        <td class="px-2 py-1 text-center">
            <a href="{{ route('user.properties.edit',$property->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
        </td>
    </tr>
@endforeach

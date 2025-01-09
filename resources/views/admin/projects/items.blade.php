@foreach ($projects as $project)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="w-4 p-4 " colspan="3">
            <a href="#" role="button" title="{{ $project->name }}">
                <img src="{{ asset('images/' . $project->image) }}" class="rounded mb-2 text-center" width="50"
                    alt="Image">
                <span class="fw-bold text-left text-dark-emphasis ">{{ Str::limit($project->name, '15', '...') }}</span>
            </a>
        </td>
        <th scope="row" class="px-2 py-1 text-start font-medium text-capitalize">
            <span class="text-sm">{{ isset($project->investor) ? $project->investor->name : '' }}</span>
        </th>
        <td class="px-2 py-1 text-center">
            <span class="text-sm" role="button"
                title="{{ $project->location }}">{{ Str::limit($project->location ?? '---', '15', '....') }}</span>
        </td>
        <td class="px-2 py-1 text-center" colspan="2">
            <span class="text-sm" role="button"
                title="{{ '₹' . $project->price }}"> {{ __(':from - :to', ['from' => shorten_price($project->price_from), 'to' => shorten_price($project->price_to)]) }}</span>
        </td>
        <td class="px-2 py-1 text-center">
            <span class="text-sm">{{ $project->leads_count ?? 0 }}</span>
        </td>
        <td class="px-2 py-1 text-center">
            <span class="text-sm">{{ $project->views }}</span>
        </td>
        <td class="px-2 py-1 text-center">
            <span class="text-sm">{{ $project->created_at }}</span>
        </td>

        <td class="px-2 py-1 text-end">
            <div class="btn-group pe-3">
                @if (permission_check('Project Edit'))
                    <a  class="ms-2" target="_blank" href="{{ route('public.project_single', ['uid' => $project->unique_id, 'slug' => $project->slug ]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-eye" viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                            <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                        </svg>
                    </a>
                @endif
                @if (permission_check('Project Edit'))
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil" viewBox="0 0 16 16">
                            <path
                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                        </svg>
                    </a>
                @endif
                @if (permission_check('Project Delete'))
                    <form method="POST" id="form_{{ $project->id }}"
                        action="{{ route('admin.projects.destroy', $project->id) }}">@csrf @method('DELETE')</form>
                    <button form="form_{{ $project->id }}" type="button"
                        onclick="confirmDelete({{ $project->id }})"
                        class="mx-auto block hover:text-meta-1 ms-3">
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
                @endif
            </div>
        </td>
    </tr>
@endforeach

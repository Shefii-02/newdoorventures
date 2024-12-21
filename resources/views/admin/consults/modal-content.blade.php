<div>
    <h3 class="text-lg font-bold mb-4">Lead Details</h3>
    <form action="{{ route('admin.consults.update', $consult->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <strong class="mb-3">Contact Details:</strong><br>
            <span>{{ $consult->name }}</span><br>
            <span>{{ $consult->email }}</span><br>
            <span>{{ $consult->phone }}</span>
        </div>

        <div class="mt-4">
            <strong class="mb-5"> {{ $consult->property ? 'Property' : 'Project' }} Enqury for:</strong><br>
            <table class="table table-bordered py-3">
                <tr>
                    <th>
                        Name
                    </th>
                    <td>
                        {{ $consult->property ? $consult->property->name : $consult->project->name }}
                    </td>
                </tr>
                @if ($consult->property)
                    <tr>
                        <th>
                            Type
                        </th>
                        <td>
                            {{ $consult->property->type . '/' . $consult->property->mode }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>
                        Category
                    </th>
                    <td>
                        {{ $consult->property ? $consult->property->category->name : $consult->project->category->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Owner/Added by
                    </th>
                    <td>
                        {{ $consult->property ? $consult->property->author->name : 'Admin' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Created at
                    </th>
                    <td>
                        {!! dateTimeFormat($consult->created_at) !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        Deatils view
                    </th>
                    <td>
                        @if ($consult->property)
                            <a href="{{ route('public.property_single',['uid' => $consult->property->unique_id,'slug' => $consult->property->slug]) }}" target="_new">Click here</a>
                        @else
                        <a href="{{ route('public.project_single',['uid' => $consult->project->unique_id,'slug' => $consult->project->slug]) }}" target="_new">Click here</a>

                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="mt-4">
            <strong class="mb-3">Status:</strong>

            <div class="form-check">
                <input type="radio" id="statusUnread" name="status" value="unread" class="form-check-input"
                    {{ $consult->status === 'unread' ? 'checked' : '' }}>
                <label for="statusUnread" class="form-check-label">Unread</label>
            </div>
            <div class="form-check">
                <input type="radio" id="statusAttended" name="status" value="attended" class="form-check-input"
                    {{ $consult->status === 'attended' ? 'checked' : '' }}>
                <label for="statusAttended" class="form-check-label">Attended</label>
            </div>

        </div>

        <div class="mt-4 text-right">
            <button type="submit" class="bg-success text-white px-4 py-2 rounded">Save</button>
            <button type="button" class="bg-red text-white px-4 py-2 rounded"
                onclick="document.getElementById('consult-modal').classList.add('hidden')">Cancel</button>
        </div>
    </form>
</div>

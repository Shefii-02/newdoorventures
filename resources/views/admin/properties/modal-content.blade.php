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
                    <input type="radio" disabled id="statusUnread" name="moderation_status" value="pending" class="form-check-input"
                        {{ $property->moderation_status === 'pending' ? 'checked' : '' }}>
                    <label for="statusUnread" class="form-check-label">Pending</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="statusSuspended" name="moderation_status" value="suspended" class="form-check-input"
                        {{ $property->moderation_status === 'suspended' ? 'checked' : '' }}>
                    <label for="statusSuspended" class="form-check-label">Suspended</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="statusApproved" name="moderation_status" value="approved" class="form-check-input"
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

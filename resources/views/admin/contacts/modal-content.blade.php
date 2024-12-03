<div>
    <h3 class="text-lg font-bold mb-4">Consult Details</h3>
    <form action="{{ route('admin.contact.update', $consult->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <strong class="mb-3">contact Details:</strong><br>
            <span>{{ $consult->name }}</span><br>
            <span>{{ $consult->email }}</span><br>
            <span>{{ $consult->phone }}</span>
        </div>

        <div class="mt-4">
            <strong class="mb-3">Submit For:</strong><br>
            <span>{{ $consult->subject }}</span>
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
                onclick="document.getElementById('contact-modal').classList.add('hidden')">Cancel</button>
        </div>
    </form>
</div>

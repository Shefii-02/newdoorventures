<div>
    <h3 class="text-lg font-bold mb-4">Account Details</h3>
    <form action="{{ route('admin.accounts.update', $account->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <strong class="mb-3">Contact Details:</strong><br>
            <span>{{ $account->name }}</span><br>
            <span>{{ $account->email }}</span><br>
            <span>{{ $account->phone }}</span>
        </div>

        <div class="mt-4">
            <strong class="mb-3">Enquired For:</strong><br>
            <span>{{ $account->property  }}</span>
        </div>

        <div class="mt-4">
            <strong class="mb-3">Status:</strong>
            <div class="form-check">
                <input type="radio" disabled id="statusPending" name="pending" value="pending" class="form-check-input"
                    {{ $account->status === 'pending' ? 'checked' : '' }}>
                <label for="statusPending" class="form-check-label">Pending</label>
            </div>
            
            <div class="form-check">
                <input type="radio" id="statusSuspended" name="status" value="suspended" class="form-check-input"
                    {{ $account->status === 'suspended' ? 'checked' : '' }}>
                <label for="statusSuspended" class="form-check-label">Suspended</label>
            </div>
            <div class="form-check">
                <input type="radio" id="statusApproved" name="status" value="approved" class="form-check-input"
                    {{ $account->status === 'approved' ? 'checked' : '' }}>
                <label for="statusApproved" class="form-check-label">Approved</label>
            </div>

        </div>

        <div class="mt-4 text-right">
            <button type="submit" class="bg-success text-white px-4 py-2 rounded">Save</button>
            <button type="button" class="bg-red text-white px-4 py-2 rounded"
                onclick="document.getElementById('account-modal').classList.add('hidden')">Cancel</button>
        </div>
    </form>
</div>

<div>
    <h3 class="text-lg font-bold mb-4 text-center"><u>Account Details:</u></h3>
    <form action="{{ route('admin.accounts.update', $account->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mt-3">
            <strong class="mb-3 fw-bold"><u>Contact Details:</u></strong><br>
            <div class="mt-2">
                <span>{{ $account->name }}</span><br>
                <span>{{ $account->email }}</span><br>
                <span>{{ $account->phone }}</span>
            </div>
        </div>
        <div class="mt-3">
            <strong class="mb-3 fw-bold"><u>Other Details:</u></strong><br>
            <div class="mt-2">
                <span>Created at : </span><i
                    class="">{{ date('d M, Y h:i:s a', strtotime($account->created_at)) }}</i> <br>
                <span>Last Login at : </span><i
                    class="">{{ date('d M, Y h:i:s a', strtotime($account->last_login)) }}</i><br>
                <span>Total Properties : </span><i class="">{{ $account->properties->count() ?? '--' }}</i>
            </div>
        </div>
        @if (permission_check('Set Staff'))
            <div class="mt-3">
                <strong class="mb-3 fw-bold"><u>Set as Staff:</u></strong><br>
                <div class="flex gap-4 mt-4">
                    <div class="form-check">
                        <input type="radio" id="isNotStaff" name="is_staff" value="0" class="form-check-input"
                            {{ $account->is_staff === 0 ? 'checked' : '' }}>
                        <label for="isNotStaff" class="form-check-label">Not a Staff</label>
                    </div>

                    <div class="form-check">
                        <input type="radio" id="isStaff" name="is_staff" value="1" class="form-check-input"
                            {{ $account->is_staff === 1 ? 'checked' : '' }}>
                        <label for="isStaff" class="form-check-label">It's Staff</label>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="mt-4">
            <strong class="mb-3">Status:</strong>
            <div class="flex gap-4 mt-4">
                <div class="form-check">
                    <input type="radio" disabled id="statusPending" name="pending" value="pending"
                        class="form-check-input" {{ $account->status === 'pending' ? 'checked' : '' }}>
                    <label for="statusPending" class="form-check-label">Pending</label>
                </div>

                <div class="form-check">
                    <input type="radio" {{ !permission_check('Account Approvel') ? 'disabled' : '' }}
                        id="statusSuspended" name="status" value="suspended" class="form-check-input"
                        {{ $account->status === 'suspended' ? 'checked' : '' }}>
                    <label for="statusSuspended" class="form-check-label">Suspended</label>
                </div>
                <div class="form-check">
                    <input type="radio" {{ !permission_check('Account Approvel') ? 'disabled' : '' }}
                        id="statusApproved" name="status" value="approved" class="form-check-input"
                        {{ $account->status === 'approved' ? 'checked' : '' }}>
                    <label for="statusApproved" class="form-check-label">Approved</label>
                </div>
            </div>


        </div>
        @if (permission_check('Account Approvel'))
            <div class="mt-4 text-right">
                <button type="submit" class="bg-success text-white px-4 py-2 rounded">Save</button>
                <button type="button" class="bg-red text-white px-4 py-2 rounded"
                    onclick="document.getElementById('account-modal').classList.add('hidden')">Cancel</button>
            </div>
        @endif
    </form>
</div>

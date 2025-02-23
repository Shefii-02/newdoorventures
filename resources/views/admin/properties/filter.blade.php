<form class="row">
    <div class="col-lg-4">

        <div class="relative mt-1 px-3">
            <label for="table-search" class="small mb-1">Search</label>
            <div
                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center px-4 mt-2.5  pointer-events-none">
                <svg class="w-4 h-4 ms-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            {{-- oninput="filterProperties(this.value)"  --}}
            <input type="text" name="search" id="table-search"
                autocomplete="off" value="{{ request()->get('search') }}"
                class="block pt-2 ps-5 p-2 text-sm  border border-gray-300 rounded-lg w-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search for properties">

        </div>
    </div>
    <div class="col-lg-3">
        <div class="relative mt-1 px-3">
            <label for="table-search" class=" small mb-1">Staffs</label>
            <select class="form-control" id="user" name="staff">
                <option value=""></option>
                @foreach ($staffs ?? [] as $staff)
                    <option {{ request()->get('staff') == $staff->id ? 'selected' :  '' }} value="{{ $staff->id }}">{{ $staff->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="relative mt-1 px-3">
            <label for="table-search" class=" small mb-1">Created At</label>
            <input type="date" value="{{ request()->get('created_at') }}" max="{{ date('Y-m-d') }}" class="form-control" name="created_at">
        </div>
    </div>
    <div class="col-lg-2 mt-1.5 px-3">
        <span class=""><br></span>
        <input type="submit" class="btn btn-info" value="Search">
    </div>
</form>


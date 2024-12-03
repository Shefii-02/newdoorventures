@extends('admin.layouts.master')

@section('content')
    <div>
        <!-- ===== property List Start ===== -->
        <div class="col-span-12">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="p-4 md:p-6 xl:p-7.5">
                    <div class="flex items-start justify-between">
                        <h2 class="text-title-sm2 font-bold text-black dark:text-white">
                            Projects List
                        </h2>
                        <div class="relative">
                            <a class="bg-primary bg-warning hover:bg-opacity-90 inline-flex items-center justify-center px-6 py-2 rounded-md text-center text-sm text-white"
                                href="{{ route('admin.projects.create') }}">
                                Create
                            </a>
                        </div>
                    </div>

                </div>
                {{-- <div class="conatiner">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1 px-3">
                        <div
                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center px-4 mt-3  pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="table-search" oninput="filterprojects(this.value)"
                            class="block pt-2 ps-4 p-2 text-sm  border border-gray-300 rounded-lg w-1/2 bg-gray-50 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for projects">

                    </div>
                </div> --}}
                <div class="container card overflow-x-auto shadow-md sm:rounded-lg mt-3">
                    <div class="relative">

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th colspan="3" class="p-4 text-dark fw-bold">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-dark fw-bold">
                                        Builder
                                    </th>
                                    <th class="px-6 py-3 text-dark fw-bold">
                                        Location
                                    </th>
                                    <th colspan="2" class="px-6 py-3 text-dark fw-bold">
                                        Rera Status
                                    </th>
                                    <th class="px-6 py-3 text-dark fw-bold">
                                        Leads
                                    </th>
                                    <th class="px-6 py-3 text-dark fw-bold">
                                        Views
                                    </th>
                                    <th class="px-6 py-3 text-dark fw-bold">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="property-rows">
                                @include('admin.projects.items', compact('projects'))
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div id="pagination-links" class="m-4">
                            {{ $projects->links() }}
                            {{-- @include('admin.projects.pagination', compact('projects')) --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <!-- Modal -->
    <div id="property-modal" class="hidden fixed inset-0 z-999999 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow-lg w-11/12">
            <div id="property-modal-content"></div>
        </div>
    </div>
    <!-- ===== property List End ===== -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('property-modal');
            const modalContent = document.getElementById('property-modal-content');

            document.querySelectorAll('.open-property-modal').forEach(button => {
                button.addEventListener('click', async (e) => {
                    const propertyId = e.target.closest('button').getAttribute('data-id');

                    // Fetch the property details
                    const response = await fetch(`/admin/projects/${propertyId}`);
                    const html = await response.text();

                    modalContent.innerHTML = html;
                    modal.classList.remove('hidden');
                });
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modalContent.innerHTML = '';
                }
            });
        });
    </script>
@endpush


@push('footer')
    <script>
        function filterprojects(search, page = 1) {
            fetch(`{{ route('admin.projects.index') }}?search=${search}&page=${page}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('property-rows').innerHTML = data.rows;
                    document.getElementById('pagination-links').innerHTML = data.pagination;
                })
                .catch(error => console.error('Error:', error));
        }

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('pagination-link')) {
                e.preventDefault();
                const page = e.target.dataset.page;
                const search = document.getElementById('table-search').value;

                fetch(`{{ route('admin.projects.index') }}?search=${search}&page=${page}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('property-rows').innerHTML = data.rows;
                        document.getElementById('pagination-links').innerHTML = data.pagination;
                        document.body.scrollTo({
                            top: 0,
                            behavior: "smooth"
                        });


                        // Update active pagination number
                        document.querySelectorAll('.pagination-link').forEach(link => {
                            link.classList.remove('bg-blue-600', 'text-white');
                            link.classList.add('text-blue-600', 'bg-white');
                        });
                        e.target.classList.add('bg-blue-600', 'text-white');
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endpush

@if ($properties->hasPages())
    <nav class="flex items-center justify-between mt-4">
        <ul class="inline-flex items-center -space-x-px">
            <!-- Previous Button -->
            @if ($properties->onFirstPage())
                <li>
                    <span
                        class="px-3 py-2 text-sm text-gray-500 bg-gray-100 rounded-l-lg border border-gray-300 cursor-not-allowed">
                        &laquo;
                    </span>
                </li>
            @else
                <li>
                    <a href="#" class="pagination-link px-3 py-2 text-sm text-blue-600 bg-white rounded-l-lg border border-gray-300 hover:bg-blue-100"
                        data-page="{{ $properties->currentPage() - 1 }}">
                        &laquo;
                    </a>
                </li>
            @endif

            <!-- Page Numbers -->
            @foreach ($properties->links()->elements[0] as $page => $url)
                <li>
                    @if ($page == $properties->currentPage())
                        <span class="px-3 py-2 text-sm text-white bg-blue-600 border border-gray-300">{{ $page }}</span>
                    @else
                        <a href="#" class="pagination-link px-3 py-2 text-sm text-blue-600 bg-white border border-gray-300 hover:bg-blue-100"
                            data-page="{{ $page }}">
                            {{ $page }}
                        </a>
                    @endif
                </li>
            @endforeach

            <!-- Next Button -->
            @if ($properties->hasMorePages())
                <li>
                    <a href="#" class="pagination-link px-3 py-2 text-sm text-blue-600 bg-white rounded-r-lg border border-gray-300 hover:bg-blue-100"
                        data-page="{{ $properties->currentPage() + 1 }}">
                        &raquo;
                    </a>
                </li>
            @else
                <li>
                    <span
                        class="px-3 py-2 text-sm text-gray-500 bg-gray-100 rounded-r-lg border border-gray-300 cursor-not-allowed">
                        &raquo;
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

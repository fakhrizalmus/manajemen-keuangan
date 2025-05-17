@if ($paginator->hasPages())
    <div class="d-flex justify-content-between align-items-center">
        {{-- Info Jumlah Data --}}
        <div class="text-muted small me-3">
            {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }}
        </div>

        {{-- Navigasi Panah --}}
        <div>
            <ul class="pagination mb-0">
                {{-- First Page --}}
                @if (!$paginator->onFirstPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url(1) }}" aria-label="First">
                            <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
                        </a>
                    </li>
                @endif

                {{-- Previous Page --}}
                <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                    </a>
                </li>

                {{-- Next Page --}}
                <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                    </a>
                </li>

                {{-- Last Page --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Last">
                            <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif

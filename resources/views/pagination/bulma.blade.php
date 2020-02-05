@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="pagination">
        {{-- Previous Page Link --}}
        <a class="pagination-previous has-background-white card"
           rel="prev"
           @if ($paginator->onFirstPage())
           aria-disabled="true" disabled
           @else
           href="{{ $paginator->previousPageUrl() }}"
           @endif
           aria-label="@lang('pagination.previous')">Previous</a>

        {{-- Next Page Link --}}
        <a class="pagination-previous has-background-white card"
           rel="next"
           @if ($paginator->hasMorePages())
           href="{{ $paginator->nextPageUrl() }}"
           @else
           aria-disabled="true" disabled
           @endif
           aria-label="@lang('pagination.next')">Next</a>

        <div class="pagination-list">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-ellipsis" aria-disabled="true">&hellip;</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="pagination-link is-current card" aria-label="Page {{ $page }}" aria-current="page">{{ $page }}</a>
                        @else
                            <a class="pagination-link card" href="{{ $url }}" aria-label="Goto Page {{ $page }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    </nav>
@endif

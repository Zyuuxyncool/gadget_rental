@php($function = $function ?? 'search_data')
@if ($paginator->hasPages())
    <nav class="pagination-nav">
        <ul class="pagination-list">
            {{-- Tombol Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-disabled" aria-disabled="true">
                    <span>&laquo;</span>
                </li>
            @else
                <li>
                    <a href="javascript:void(0)" onclick="{{ "$function('-1')" }}">&laquo;</a>
                </li>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="pagination-disabled">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="javascript:void(0)" onclick="{{ "$function($page)" }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Selanjutnya --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="javascript:void(0)" onclick="{{ "$function('+1')" }}">&raquo;</a>
                </li>
            @else
                <li class="pagination-disabled">
                    <span>&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

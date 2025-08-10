@if ($paginator->hasPages())
    <ul class="pagination">

        {{-- 前へボタン --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="前へ">
                <span aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="前へ">&lsaquo;</a>
            </li>
        @endif

        {{-- ページ番号 --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" セパレータ --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- 配列のページリンク --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- 次へボタン --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="次へ">&rsaquo;</a>
            </li>
        @else
            <li class="disabled" aria-disabled="true" aria-label="次へ">
                <span aria-hidden="true">&rsaquo;</span>
            </li>
        @endif

    </ul>
@endif

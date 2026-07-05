@if ($paginator->hasPages())

    <nav>

        {{-- 前へ --}}
        @if ($paginator->onFirstPage())
            <span></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">前へ＞</a>
        @endif

        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();

            if ($current <= 2) {
                $start = 1;
            } elseif ($current >= $last - 1) {
                $start = max($last - 2, 1);
            } else {
                $start = $current - 1;
            }

            $end = min($start + 2, $last);
        @endphp

        {{-- ページ番号 --}}
        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $current)
                <span>{{ $page }}</span>
            @else
                <a href="{{ $paginator->url($page) }}">{{ $page }}</a>
            @endif
        @endfor

        {{-- 次へ --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">次へ＞</a>
        @else
            <span></span>
        @endif

    </nav>

@endif
@if ($paginator->hasPages())
<ul class="admin-simple-pagination" role="navigation" aria-label="Pagination Navigation">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
    <li class="disabled"><span aria-disabled="true">＜ 前</span></li>
    @else
    <li>
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">＜ 前</a>
    </li>
    @endif

    {{-- Next --}}
    @if ($paginator->hasMorePages())
    <li>
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">次 ＞</a>
    </li>
    @else
    <li class="disabled"><span aria-disabled="true">次 ＞</span></li>
    @endif

</ul>
@endif
@if ($paginator->hasPages())
  <nav class="users-pagination" aria-label="分页导航">
    <p class="users-pagination-summary">
      第 {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }} 页，
      显示第 {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} 条，共 {{ $paginator->total() }} 条
    </p>

    <div class="users-pagination-controls">
      @if ($paginator->onFirstPage())
        <span class="users-page-link is-disabled" aria-disabled="true">上一页</span>
      @else
        <a class="users-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">上一页</a>
      @endif

      @foreach ($elements as $element)
        @if (is_string($element))
          <span class="users-page-ellipsis" aria-hidden="true">{{ $element }}</span>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <span class="users-page-link is-current" aria-current="page">{{ $page }}</span>
            @else
              <a class="users-page-link" href="{{ $url }}">{{ $page }}</a>
            @endif
          @endforeach
        @endif
      @endforeach

      @if ($paginator->hasMorePages())
        <a class="users-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">下一页</a>
      @else
        <span class="users-page-link is-disabled" aria-disabled="true">下一页</span>
      @endif
    </div>
  </nav>
@endif

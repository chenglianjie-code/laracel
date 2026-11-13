@if ($feed_items->count() > 0)
  <ul class="status-list">
    @foreach ($feed_items as $status)
      @include('weibo._weibo', ['user' => $status->user])
    @endforeach
  </ul>
  <div class="status-pagination">
    {{ $feed_items->onEachSide(1)->links('pagination.users') }}
  </div>
@else
  <div class="status-empty">
    <span class="status-empty-icon" aria-hidden="true">✦</span>
    <h4>还没有微博动态</h4>
    <p>发布第一条动态，开启今天的分享吧。</p>
  </div>
@endif

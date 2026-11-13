<li class="status-item">
  <a class="status-avatar" href="{{ route('users.show', $user) }}" aria-label="查看 {{ $user->name }} 的个人资料">
    <img src="{{ $user->gravatar() }}" alt="" class="gravatar" />
  </a>
  <div class="status-item-body">
    <div class="status-item-meta">
      <a class="status-author" href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
      <time datetime="{{ $status->created_at->toIso8601String() }}">{{ $status->created_at->diffForHumans() }}</time>
    </div>
    {{-- $status 实例代表的是单条微博的数据，$user 实例代表的是该微博发布者的数据 --}}
    <p class="status-item-content">{{ $status->content }}</p>
  </div>
</li>

@can('follow', $user)
  <div class="follow-action-panel">
    @if (Auth::user()->isFollowing($user->id))
      <div class="follow-action-copy">
        <span class="follow-state-indicator" aria-hidden="true"></span>
        <span>已关注 {{ $user->name }}</span>
      </div>
      <form action="{{ route('followers.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="follow-action-button follow-action-button-remove">取消关注</button>
      </form>
    @else
      <p class="follow-action-copy">关注后即可在关注列表中找到 {{ $user->name }}。</p>
      <form action="{{ route('followers.store', $user->id) }}" method="POST">
        @csrf
        <button type="submit" class="follow-action-button">关注</button>
      </form>
    @endif
  </div>
@endcan

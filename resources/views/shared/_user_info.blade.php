<div class="user-info-main">
  <a class="user-avatar-link" href="{{ route('users.show', $user->id) }}" aria-label="{{ $user->name }} 的个人主页">
    <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar">
  </a>
  <div class="user-info-copy">
    <p class="user-info-eyebrow">用户名</p>
    <h1>{{ $user->name }}</h1>
    <span class="user-info-status"><span aria-hidden="true"></span>尊贵用户</span>
  </div>
</div>

<div class="profile-stat">
  <a href="{{ route('users.followings', $user->id) }}">
  <strong id="following" class="profile-stat-value">
    {{ count($user->followings) }}
  </strong>
  <span class="profile-stat-label">关注</span>
  </a>
</div>
<div class="profile-stat">
  <a href="{{ route('users.followers', $user->id) }}">
  <strong id="followers" class="profile-stat-value">
    {{ count($user->followers) }}
  </strong>
  <span class="profile-stat-label">粉丝</span>
    </a>
</div>
<div class="profile-stat">
  <a href="{{ route('users.show', $user->id) }}">
  <strong id="statuses" class="profile-stat-value">
    {{ $user->statuses()->count() }}
  </strong>
  <span class="profile-stat-label">微博</span>
  </a>
</div>

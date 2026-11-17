<div class="profile-stat">
  <strong id="following" class="profile-stat-value">
    {{ count($user->followings) }}
  </strong>
  <span class="profile-stat-label">关注</span>
</div>
<div class="profile-stat">
  <strong id="followers" class="profile-stat-value">
    {{ count($user->followers) }}
  </strong>
  <span class="profile-stat-label">粉丝</span>
</div>
<div class="profile-stat">
  <strong id="statuses" class="profile-stat-value">
    {{ $user->statuses()->count() }}
  </strong>
  <span class="profile-stat-label">微博</span>
</div>

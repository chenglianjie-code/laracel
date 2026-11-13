@extends('layouts.default')
@section('title', $user->name)

@section('content')
<section class="user-profile-page" aria-labelledby="profile-page-title">
  <header class="user-profile-heading">
    <p class="user-profile-kicker">WEIBO APP · MEMBER</p>
    <h2 id="profile-page-title">用户详情页</h2>
    <p>个人资料</p>
  </header>

  <div class="user-profile-card">
    <div class="user-profile-accent" aria-hidden="true"></div>
    <section class="user_info" aria-label="用户信息">
      @include('shared._user_info', ['user' => $user])
    </section>

    <div class="user-profile-meta">
      <span>用户编号</span>
      <strong>#{{ $user->id }}</strong>
    </div>
  </div>
  <section class="user-statuses" aria-labelledby="user-statuses-title">
    <header class="user-statuses-heading">
      <div>
        <p class="user-statuses-kicker">RECENT POSTS</p>
        <h3 id="user-statuses-title">微博动态</h3>
      </div>
      <span class="user-statuses-count">{{ $statuses->total() }} 条动态</span>
    </header>

    @if ($statuses->count() > 0)
      <ul class="status-list">
        @foreach ($statuses as $status)
          @include('weibo._weibo')
        @endforeach
      </ul>

      <div class="status-pagination">
        {{ $statuses->onEachSide(1)->links('pagination.users') }}
      </div>
    @else
      <div class="status-empty">
        <span class="status-empty-icon" aria-hidden="true">✦</span>
        <h4>还没有微博动态</h4>
        <p>这个用户发布的内容会显示在这里。</p>
      </div>
    @endif
  </section>
</section>
@stop

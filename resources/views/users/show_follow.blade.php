@extends('layouts.default')
@section('title', $title)

@section('content')
<section class="follow-page" aria-labelledby="follow-page-title">
  <header class="follow-heading">
    <div>
      <p class="follow-kicker">WEIBO APP · COMMUNITY</p>
      <h1 id="follow-page-title">{{ $title }}</h1>
      <p>认识更多社区成员，看看他们的主页和动态。</p>
    </div>
    <span class="follow-count">{{ $users->total() }} 位用户</span>
  </header>

  <div class="follow-card">
    <div class="users-list-accent" aria-hidden="true"></div>

    @if ($users->count() > 0)
      <ul class="follow-list">
        @foreach ($users as $user)
          <li class="follow-list-item">
            <a class="follow-user-link" href="{{ route('users.show', $user) }}">
              <img class="follow-avatar" src="{{ $user->gravatar('88') }}" alt="">
              <span class="follow-user-copy">
                <strong>{{ $user->name }}</strong>
                <span>查看个人主页</span>
              </span>
              <span class="follow-user-arrow" aria-hidden="true">→</span>
            </a>
          </li>
        @endforeach
      </ul>

      <div class="follow-pagination">
        {{ $users->onEachSide(1)->links('pagination.users') }}
      </div>
    @else
      <div class="follow-empty">
        <span class="follow-empty-icon" aria-hidden="true">✦</span>
        <h2>这里暂时还没有用户</h2>
        <p>有新的关注或粉丝后，会显示在这个列表里。</p>
      </div>
    @endif
  </div>
</section>
@stop

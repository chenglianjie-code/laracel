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
  <section>
      @if($statuses->count()>0)
      <ul>
         @foreach($statuses as $status)
          @include('weibo._weibo')
         @endforeach
      </ul>
      @else 
      <p>没有数据</p>
      @endif
    </section>
</section>
@stop

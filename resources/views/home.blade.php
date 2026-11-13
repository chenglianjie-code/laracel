@extends('layouts.default')
@section('title', '主页')

@section('content')
  <div class="home-page">
    <section class="home-hero" aria-labelledby="home-title">
      <div class="home-hero-copy">
        <p class="home-eyebrow">WEIBO APP <span>·</span> DAILY MOMENTS</p>
        <h1 id="home-title">把每个灵感，写下来。</h1>
        <p class="lead">
          分享此刻，也看看大家正在记录什么。<br>
          继续学习：<a href="https://learnku.com/courses/laravel-essential-training/9.x">Laravel 入门教程</a>
        </p>

        @guest
          <a class="register-button" href="{{ route('signup') }}">开始注册 <span aria-hidden="true">→</span></a>
        @else
          <a class="home-profile-link" href="{{ route('users.show', Auth::user()) }}">查看我的主页 <span aria-hidden="true">→</span></a>
        @endguest
      </div>
      <div class="home-hero-art" aria-hidden="true">
        <span class="home-hero-orbit home-hero-orbit-one"></span>
        <span class="home-hero-orbit home-hero-orbit-two"></span>
        <span class="home-hero-star">✦</span>
      </div>
    </section>

    @auth
      <section class="status_form" aria-labelledby="status-form-title">
        <div class="status-form-heading">
          <span class="status-form-mark" aria-hidden="true">✦</span>
          <div>
            <h2 id="status-form-title">分享新鲜事</h2>
            <p>此刻有什么想说的？</p>
          </div>
        </div>

        @include('shared._weibo_form')

        <div class="home-feed-heading">
          <div>
            <p class="home-feed-kicker">COMMUNITY</p>
            <h2>微博动态</h2>
          </div>
          <span>看看大家的新鲜事</span>
        </div>
        @include('shared._feed')
      </section>
    @endauth
  </div>
@stop

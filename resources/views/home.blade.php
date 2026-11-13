@extends('layouts.default')
@section('title', '主页')
@section('content')
  <section class="home-hero">
    <h1>Hello Laravel</h1>
    <p class="lead">
      你现在所看到的是 <a href="https://learnku.com/courses/laravel-essential-training/9.x">Laravel 入门教程</a> 的示例项目主页。
    </p>
    <p class="tagline">一切，将从这里开始。</p>
     @if (Auth::check())
    @else
      <a class="register-button" href="{{ route('signup') }}" role="button">现在注册</a>
      @endif
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
    </section>
  @endauth
@stop

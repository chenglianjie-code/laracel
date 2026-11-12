@extends('layouts.default')
@section('title', '登录')

@section('content')
<section class="login-page" aria-labelledby="login-title">
  <div class="login-card">
    <header class="login-card-header">
      <h1 id="login-title">登录</h1>
    </header>

    <div class="login-card-body">
      @include('shared._errors')

      <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="signup-field">
          <label for="email">邮箱：</label>
          <input
            id="email"
            class="signup-input"
            type="email"
            name="email"
            value="{{ old('email') }}"
            autocomplete="email"
     
          >
        </div>

        <div class="signup-field">
          <label for="password">密码：</label>
          <input
            id="password"
            class="signup-input"
            type="password"
            name="password"
            autocomplete="current-password"
        
          >
        </div>
        <div class="login-remember">
          <input
            class="login-remember-checkbox"
            type="checkbox"
            name="remember"
            id="remember"
            value="1"
          >
          <label for="remember">记住我</label>
        </div>

        <button class="signup-button" type="submit">登录</button>
      </form>

      <hr class="login-divider">
      <p class="login-signup-prompt">还没账号？<a href="{{ route('signup') }}">现在注册！</a></p>
    </div>
  </div>
</section>
@endsection

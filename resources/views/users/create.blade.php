@extends('layouts.default')
@section('title', '注册')

@section('content')
<section class="signup-page" aria-labelledby="signup-title">
  <div class="signup-card">
    <header class="signup-card-header">
      <h1 id="signup-title">注册</h1>
    </header>

    <div class="signup-card-body">
      @include('shared._errors')
      <form method="POST" action="{{ route('users.store') }}">
        {{-- @csrf 是 Laravel Blade 提供的指令，用来给表单加一个 CSRF 防护令牌。 --}}
        @csrf
        {{-- // Laravel 提供了全局辅助函数 old 来帮助我们在 Blade 模板中显示旧输入数据。这样当我们信息填写错误，页面进行重定向访问时，输入框将自动填写上最后一次输入过的数据。 --}}
        <div class="signup-field">
          <label for="name">名称：</label>
          <input id="name" type="text" name="name" class="signup-input" value="{{ old('name') }}" autocomplete="name" >
    
        </div>

        <div class="signup-field">
          <label for="email">邮箱：</label>
          <input id="email" type="email" name="email" class="signup-input" value="{{ old('email') }}" autocomplete="email" >
       
        </div>

        <div class="signup-field">
          <label for="password">密码：</label>
          <input id="password" type="password" name="password" class="signup-input" autocomplete="new-password" >
         
        </div>

        <div class="signup-field">
          <label for="password_confirmation">确认密码：</label>
          <input id="password_confirmation" type="password" name="password_confirmation" class="signup-input" autocomplete="new-password" >
        </div>

        <button type="submit" class="signup-button">注册</button>
      </form>
    </div>
  </div>
</section>
@stop

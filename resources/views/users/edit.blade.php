@extends('layouts.default')
@section('title', '更新个人资料')

@section('content')
<section class="profile-edit-page" aria-labelledby="profile-edit-title">
  <header class="profile-edit-heading">
    <p class="profile-edit-kicker">WEIBO APP · ACCOUNT</p>
    <h1 id="profile-edit-title">编辑个人资料</h1>
    <p>更新你的名称、邮箱或登录密码。</p>
  </header>
  @include('shared._errors')
  <div class="profile-edit-card">
    <div class="profile-edit-accent" aria-hidden="true"></div>
    <div class="profile-edit-body">
      @include('shared._errors')

      <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PATCH')

        <div class="profile-edit-field">
          <label for="name">名称</label>
          <input
            class="profile-edit-input"
            id="name"
            type="text"
            name="name"
            value="{{ old('name', $user->name) }}"
            autocomplete="name"
            maxlength="50"
          >
        </div>

        <div class="profile-edit-field">
          <label for="email">邮箱</label>
          <input
            class="profile-edit-input"
            id="email"
            type="email"
            name="email"
            value="{{ old('email', $user->email) }}"
            autocomplete="email"
            maxlength="255"
          >
        </div>

        <div class="profile-edit-field">
          <label for="password">新密码 <span class="profile-edit-optional">可选</span></label>
          <input
            class="profile-edit-input"
            id="password"
            type="password"
            name="password"
            autocomplete="new-password"
            minlength="8"
            aria-describedby="password-help"
          >
          <p class="profile-edit-help" id="password-help">如果不修改密码，请留空。</p>
        </div>

        <div class="profile-edit-field">
          <label for="password_confirmation">确认新密码</label>
          <input
            class="profile-edit-input"
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            autocomplete="new-password"
            minlength="8"
          >
        </div>

        <div class="profile-edit-actions">
          <a class="profile-edit-cancel" href="{{ route('users.show', $user) }}">取消</a>
          <button class="profile-edit-submit" type="submit">保存修改</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection

@extends('layouts.default')
@section('title', '用户列表')

@section('content')
<section class="users-index-page" aria-labelledby="users-index-title">
  <header class="users-index-heading">
    <div>
      <p class="users-index-kicker">WEIBO APP · MEMBERS</p>
      <h1 id="users-index-title">用户列表</h1>
      <p>浏览已注册的用户资料。</p>
    </div>
    <span class="users-count">共 {{ $users->total() }} 位用户</span>
  </header>

  <div class="users-list-card">
    <div class="users-list-accent" aria-hidden="true"></div>

    <div class="users-table-scroll">
      <table class="users-table">
        <thead>
          <tr>
            <th scope="col">用户</th>
            <th scope="col">邮箱</th>
            <th scope="col">注册时间</th>
            <th scope="col">操作</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
            <tr>
              <td>
                <div class="users-identity">
                  <img class="users-avatar" src="{{ $user->gravatar('48') }}" alt="{{ $user->name }} 的头像" loading="lazy">
                  <span>{{ $user->name }}</span>
                </div>
              </td>
              <td class="users-email">{{ $user->email }}</td>
              <td class="users-date">{{ $user->created_at->format('Y-m-d H:i') }}</td>
              <td>
                <div class="users-actions">
                  <a class="users-action-link" href="{{ route('users.show', $user) }}">查看</a>
                  <a class="users-action-link" href="{{ route('users.edit', $user) }}">编辑</a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td class="users-empty" colspan="4">目前还没有注册用户。</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    {{-- $users->onEachSide(1);                  // 设置页码显示范围 --}}
    {{-- $users->links('pagination.users');      // 用自定义模板生成分页按钮 --}}
    <div class="users-pagination-container">
      {{ $users->onEachSide(1)->links('pagination.users') }}
    </div>
  </div>
</section>
@endsection

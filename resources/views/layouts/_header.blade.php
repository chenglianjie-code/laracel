<nav class="top-nav" aria-label="主导航">
  <div class="nav-inner">
    <a class="brand" href="{{ route('home') }}">Weibo App</a>

    <div class="nav-links">
      @if (Auth::check())
        <a class="nav-link" href="#">用户列表</a>

        <details class="user-menu">
          <summary class="nav-link user-menu-toggle">{{ Auth::user()->name }}</summary>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">个人中心</a>
            <a class="dropdown-item" href="{{route('users.edit', Auth::user())}}">编辑资料</a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="logout-button" type="submit">退出</button>
            </form>
          </div>
        </details>
      @else
        <a class="nav-link" href="{{ route('help') }}">帮助</a>
        <a class="nav-link" href="{{ route('login') }}">登录</a>
      @endif
    </div>
  </div>
</nav>

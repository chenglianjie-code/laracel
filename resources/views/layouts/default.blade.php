<!doctype html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Weibo App') - Laravel 新手入门教程</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body>
    <nav class="top-nav" aria-label="主导航">
      <div class="nav-inner">
        <a class="brand" href="{{ url('/') }}">Weibo App</a>

        <div class="nav-links">
          <a class="nav-link" href="{{ url('/help') }}">帮助</a>
          <a class="nav-link" href="{{ url('/login') }}" title="登录页面将在后续步骤实现">登录</a>
        </div>
      </div>
    </nav>

    <main class="page-content">
      @yield('content')
    </main>
  </body>
</html>

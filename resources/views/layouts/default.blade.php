<!doctype html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Weibo App') - Laravel 新手入门教程</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body>
    @include('layouts._header')
      @include('shared._messages')
    <main class="page-content">

      @yield('content')
    </main>

    <div class="footer-container">
      @include('layouts._footer')
    </div>
  </body>
</html>

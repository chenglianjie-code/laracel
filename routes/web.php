<?php

// 告诉 PHP：接下来写 StaticPagesController 时，指的是 App\Http\Controllers 目录下的那个控制器类。这个类我们下一步会创建。
use App\Http\Controllers\StaticPagesController;
// 导入 Laravel 提供的 Route 类，这样就能直接写：Route::get(...);

use Illuminate\Support\Facades\Route;

/*
| Web Routes
|您可以在此处为应用程序注册 Web 路由。这些路由由 `RouteServiceProvider` 加载，
并被纳入包含“web”中间件组的路由组中。现在，去创造些精彩的内容吧！
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [StaticPagesController::class, 'home']);
Route::get('/help', [StaticPagesController::class, 'help']);
Route::get('/about', [StaticPagesController::class, 'about']);

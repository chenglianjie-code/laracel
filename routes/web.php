<?php

use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\UsersController;

use Illuminate\Support\Facades\Route;

Route::get('/', [StaticPagesController::class, 'home'])->name('home');
Route::get('/help', [StaticPagesController::class, 'help'])->name('help');
Route::get('/about', [StaticPagesController::class, 'about'])->name('about');
Route::get('/signup', [UsersController::class, 'signup'])->name('signup');
// 新增的 resource 方法将遵从 RESTful 架构为用户资源生成路由。该方法接收两个参数，第一个参数为资源名称，第二个参数为控制器名称。
Route::resource('users', UsersController::class);
// 等同于
// Route::get('/users', 'UsersController@index')->name('users.index');
// Route::get('/users/create', 'UsersController@create')->name('users.create');
// Route::get('/users/{user}', 'UsersController@show')->name('users.show');
// Route::post('/users', 'UsersController@store')->name('users.store');
// Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
// Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
// Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');
// 使用 resource 方法可让我们少写了很多代码，且严格按照了 RESTful 架构对路由进行设计。
// 生成的资源路由列表信息如下所示：
// HTTP 请求	URL	动作	作用
// GET	/users	UsersController@index	显示所有用户列表的页面
// GET	/users/{user}	UsersController@show	显示用户个人信息的页面
// GET	/users/create	UsersController@create	创建用户的页面
// POST	/users	UsersController@store	创建用户
// GET	/users/{user}/edit	UsersController@edit	编辑用户个人资料的页面
// PATCH	/users/{user}	UsersController@update	更新用户
// DELETE	/users/{user}	UsersController@destroy	删除用户

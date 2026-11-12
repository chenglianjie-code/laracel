<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function __construct()
    {
        // 登录页和登录提交只允许访客访问；退出操作必须登录。
        $this->middleware('guest')->only(['create', 'store']);
        $this->middleware('auth')->only('destroy');
    }

   public function create(){ 
        return view('sessions.create');
    }
    public function store(Request $request){
      $validated =$request->validate([
        'email'=>['required','email','max:255'],
        'password'=>['required']
      ]);
      if(Auth::attempt($validated,$request->filled('remember'))){
        // 这句会给当前会话换一个新的 Session ID。登录成功后调用它，是为了避免有人利用旧的 Session ID 冒充用户登录，也就是防范 Session 固定攻击。
        $request->session()->regenerate();
        // 登录成功后的操作
        session()->flash('success','欢迎回来！');
        // Laravel 提供的 Auth::user() 方法来获取 当前登录用户 的信息，并将数据传送给路由。
        $fallback = route('users.show', [Auth::user()]);
        // intended 方法，该方法可将页面重定向到上一次请求尝试访问的页面上
        return redirect()->intended($fallback);

      }else{
        // 登录失败后的操作
        session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
        return redirect()->back()->withInput();
      }

    }
    public function destroy(Request $request){
      Auth::logout();
      // 退出时清理 session 并重新生成 CSRF token
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      session()->flash('success','再见！');
      return redirect()->route('login');
    }
}

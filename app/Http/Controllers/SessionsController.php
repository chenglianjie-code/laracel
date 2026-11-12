<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
   public function create(){ 
        return view('sessions.create');
    }
    public function store(Request $request){
      $validated =$request->validate([
        'email'=>['required','email','max:255'],
        'password'=>['required']
      ]);
      if(Auth::attempt($validated)){
        session()->flash('success','欢迎回来！');
        // Laravel 提供的 Auth::user() 方法来获取 当前登录用户 的信息，并将数据传送给路由。
        return redirect()->route('users.show',[Auth::user()]);
       // 登录成功后的操作
      }else{
        // 登录失败后的操作
        session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
        return redirect()->back()->withInput();
      }

    }
    public function destroy(){
      Auth::logout();
      session()->flash('success','再见！');
      return redirect()->route('login');
    }
}

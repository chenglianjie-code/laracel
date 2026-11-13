<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;

class StatusesController extends Controller
{ 
    // 这两个动作都需要用户登录，因此让我们借助 Auth 中间件来为这两个动作添加过滤请求。
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(Request  $request){
        $this->validate($request,['content'=>['required','max:255']]);
        Auth::user()->statuses()->create(['content'=> $request['content']]);
        session()->flash('success','发布成功');
        return redirect()->back();
    }
    public function delete(){

    }
}

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
    // 删除微博
    public function destroy(Status $status){
      // 做删除授权的检测，不通过会抛出 403 异常。
      $this->authorize('destroy',$status);
      // 调用 Eloquent 模型的 delete 方法对该微博进行删除。
      $status->delete();
      session()->flash('success','微博已成功删除');
      // 删除成功之后，将返回到执行删除微博操作的页面上。
      return redirect()->back();
    }
}

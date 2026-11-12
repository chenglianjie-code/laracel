<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    // __construct 是 PHP 的构造器方法，当一个类对象被创建之前该方法将会被调用。我们在 __construct 方法中调用了 middleware 方法，
    // 该方法接收两个参数，第一个为中间件的名称，第二个为要进行过滤的动作。我们通过 except 方法来设定 指定动作 不使用 Auth 中间件进行过滤，意为 —— 除了此处指定的动作以外，所有其他动作都必须登录用户才能访问，类似于黑名单的过滤机制。相反的还有 only 白名单方法，将只过滤指定动作。我们提倡在控制器 Auth 中间件使用中，
    // 首选 except 方法，这样的话，当你新增一个控制器方法时，默认是安全的，此为最佳实践。
    public function __construct()
    {
        // 意思是：给这个控制器的操作加上 auth 中间件，也就是通常要求用户先登录；但 show、`create` 和 store 这三个操作例外，不经过这项登录检查。
        $this->middleware('auth', [
            // show：查看用户资料
            // create：显示注册表单
            // store：处理注册提交
            'except' => ['show', 'create', 'store'],
        ]);
        // 只让访客访问注册页面和注册提交操作：
        $this->middleware('guest')->only(['create', 'store']);
    }
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {
         $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $info = $request->validate([
            'name' => ['sometimes', 'nullable', 'string', 'max:50'],
            'email' => [
                'sometimes',
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['sometimes', 'nullable', 'string', 'min:8', 'confirmed'],
        ]);
        // 空着的字段不更新
        $info = array_filter($info, function ($value) {
            return $value !== null && $value !== '';
        });

        if ($info === []) {
            session()->flash('info', '没有填写需要修改的内容。');

            return redirect()->route('users.show', $user);
        }

        // 密码不能明文保存
        if (isset($info['password'])) {
            $info['password'] = Hash::make($info['password']);
        }
        $user->update($info);
        session()->flash('success', '修改成功');
        return redirect()->route('users.show', [$user]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        // 现在的注册功能已经可以正常使用，但我们希望在用户注册成功后能够自动登录，这样的应用用户体验会更棒。
        // 在 Laravel 中，如果要让一个已认证通过的用户实例进行登录，可以使用以下方法：Auth::login($user);
        Auth::login($user);
        $request->session()->regenerate();
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
    }
}

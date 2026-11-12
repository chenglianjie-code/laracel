<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function signup()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function update(User $user, Request $request)
    {
  
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
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
    }
}

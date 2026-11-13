<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory; // 是模型工厂相关功能的引用
use Illuminate\Foundation\Auth\User as Authenticatable; // 是授权相关功能的引用
use Illuminate\Notifications\Notifiable; // 是消息通知相关功能引用
use Illuminate\Support\Str; // 字符串处理辅助类
use Laravel\Sanctum\HasApiTokens; //  API 令牌修改功能

// Authenticatable 可验证的
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * 可批量赋值的属性
     *
     * @var array<int, string>
     * 为了提高应用的安全性，Laravel 在用户模型中默认为我们添加了 fillable 在过滤用户提交的字段，
     * 只有包含在该属性中的字段才能够被正常更新：
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * 
     * 在序列化过程中应隐藏的属性。
     *最后，当我们需要对用户密码或其它敏感信息在用户实例通过数组或 JSON 显示时进行隐藏，则可使用 hidden 属性：
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    // boot 方法会在用户模型类完成初始化之后进行加载，因此我们对事件的监听需要放在该方法中。
    public static function boot(){
        parent::boot();
        static::creating(function ($user) {
            $user->activation_token = Str::random(30);
        });
    }

    /**
     * The attributes that should be cast.
     * 应该转换的属性
     *
     * $casts 属性是用来指定数据库字段使用的数据类型，这里指定了 email_verified_at 
     * 的类型为时间类型，这个类型跟默认的 created_at 和 updated_at 一致：
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function gravatar($size = '100')
    {
        return "https://cdn.v2ex.com/gravatar/".md5(strtolower(trim($this->attributes['email'])))."?s=".$size;

    }
}

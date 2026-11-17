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
    // 在用户模型中，指明一个用户拥有多条微博。
    public function statuses(){
        return $this->hasMany(Status::class);
    }
    //     // 加入关注人的微博动态数据
    public function feed(){
    
        // 通过 followings 方法取出所有关注用户的信息，再借助 pluck 方法将 id 进行分离并赋值给 user_ids
         $user_ids = $this->followings->pluck('id')->toArray();
        array_push($user_ids, $this->id);
        // 取出所有用户的微博动态并进行倒序排序；
        return Status::whereIn('user_id', $user_ids)
                              ->with('user')
                              ->orderBy('created_at', 'desc');
        // return $this->statuses()->orderBy('created_at','desc');
    }

    public function followers(){
        // 关联表名改为 followers
        // 除了自定义合并数据表的名称，我们也可以通过传递额外参数至 belongsToMany 方法来自定义数据表里的字段名称。如下：
        // belongsToMany 方法的第三个参数 user_id 是定义在关联中的模型外键名，而第四个参数 follower_id 则是要合并的模型外键名。
        return $this->belongsToMany(User::class,'followers','user_id', 'follower_id');
    }

     public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
    
    // 关注
    public function follow($user_ids){
        // 传入单个用户 ID 时，先转成 ID 列表。
        $user_ids = is_array($user_ids) ? $user_ids : [$user_ids];

        // 保留已有关注，只添加新关注。
        $this->followings()->syncWithoutDetaching($user_ids);
    }

    // 取消关注
    public function unfollow($user_ids){
        // detach 接收要取消关注的用户 ID 列表。
        $user_ids = is_array($user_ids) ? $user_ids : [$user_ids];

        $this->followings()->detach($user_ids);
    }

    // 判断当前登录的用户 A 是否关注了用户 B
    public function isFollowing($user_id){
        return $this->followings()
            ->where('users.id', $user_id)
            ->exists();
    }



}

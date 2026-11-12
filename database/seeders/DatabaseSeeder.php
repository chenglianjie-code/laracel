<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  
        // // 暂时允许模型批量赋值所有字段
        Model::unguard();
        // // 执行用户数据填充器
        $this->call(UsersTableSeeder::class);
        // // 重新开启批量赋值保护
        Model::reguard();
    }
}

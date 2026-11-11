<?php

return [
    'accepted' => ':attribute 必须接受。',
    'confirmed' => ':attribute 与确认内容不一致。',
    'email' => ':attribute 必须是有效的邮箱地址。',
    'max' => [
        'numeric' => ':attribute 不能大于 :max。',
        'string' => ':attribute 不能超过 :max 个字符。',
    ],
    'min' => [
        'numeric' => ':attribute 不能小于 :min。',
        'string' => ':attribute 至少需要 :min 个字符。',
    ],
    'required' => ':attribute 不能为空。',
    'string' => ':attribute 必须是字符串。',
    'unique' => ':attribute 已经被使用。',

    'attributes' => [
        'name' => '名称',
        'email' => '邮箱',
        'password' => '密码',
        'password_confirmation' => '确认密码',
    ],
];

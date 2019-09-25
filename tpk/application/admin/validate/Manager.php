<?php
/**
 * Created by PhpStorm.
 * User: yifeng
 * Date: 2018/9/29
 * Time: 17:33
 */

namespace app\admin\validate;


use think\Validate;

class Manager extends Validate
{
    protected $rule=[
        'id'=>'require',
        'account'=>'require|min:5|unique:manager',
        'passwd'=>'require|min:6',
        'repasswd'=>'require|confirm:passwd',
    ];
    protected $message=[
        'id.require'=>'id输入不正确',
        'account.require'=>'账号不能为空',
        'account.min'=>'账号不能小于5个字符',
        'account.unique'=>'账号已存在',
        'passwd.require'=>'密码不能为空',
        'passwd.min'=>'密码长度不能小于6个字符',
        'repasswd.require'=>'确认密码不能为空',
        'repasswd.confirm'=>'两次密码输入不一致',
    ];
    protected $scene=[
        'add'=>['passwd','repasswd'],
        'edit'=>['id'],
        'login'=>['account'=>"require|min:5","passwd"]
    ];

}
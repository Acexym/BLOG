<?php
namespace app\common\validate;
use think\Validate;
class User extends Validate
{
   protected $rule =   [
    'account'  => 'require|unique:user',
    'passwd'   => 'require|min:6',
    'repasswd' => 'require|confirm:passwd',
    'email'    =>'require|email|unique:user',
     'code'=>'require|captcha',
      'blogtitle.unique' => '博客标题已存在',
       'host.unique' => '域名已存在',
         'nick'  => 'unique:user',
           'oldpasswd'   => 'require|min:6',
      

];
 protected $message  =   [
        'account.require' => '账号不能为空',
        'account.unique' => '账号已被注册',
        'passwd.require'     => '密码不能为空',
        'passwd.min'     => '密码长度不能少于6位',
        'repasswd.require'     => '确认密码不能为空',
        'repasswd.confirm'   => '确认密码输入不正确',
        'email.require'  => '邮箱不能为空',
        'email.email'  => '邮箱格式不正确',
        'email.unique'  => '邮箱已存在',
        'code.require'        => '验证码不能为空',
        'code.captcha'        => '验证码输入不正确',
          'blogtitle.unique' => '博客标题已存在',
        'host.unique' => '域名已存在',
        'nick'=>'昵称已存在',
        'oldpasswd.require'     => '旧密码不能为空',
        'oldpasswd.min'     => '旧密码长度不能少于6位',

    ];
 protected $scene = [ 
       'reg'  =>  ['account','passwd','repasswd','email','code'],  
     'index'  =>  ['account'=>'require','passwd'],
      'code'=>['code'],
      'blogtitle'=>['blogtitle'],
        'host'=>['host'],
         'nick'=>['nick'],
           'passwd'=>['passwd','repasswd','oldpasswd']
  ];    
}
?>
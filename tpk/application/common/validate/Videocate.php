<?php
namespace app\common\validate;
use think\Validate;

class Videocate extends Validate
{
    protected $rule =   [
        'name'  => 'require',   
    ];

    protected $message  =   [
        'name.require' => '分类名称不能为空',      
    ];
    protected $scene = [
        'add'  =>  ['name'],
    ];
}
<?php
/**
 * Created by PhpStorm.
 * User: yifeng
 * Date: 2018/6/7
 * Time: 0:07
 */

namespace app\common\validate;


use think\Validate;

class Blogcate extends Validate
{
    protected $rule =   [
        'name'  => 'require',
        'sort'   => 'number',
    ];

    protected $message  =   [
        'name.require' => '分类名称不能为空',
        'sort.number'     => '排序必须是数字',
    ];
    protected $scene = [
        'add'  =>  ['name','sort'],
    ];
}
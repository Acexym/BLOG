<?php
/**
 * Created by PhpStorm.
 * User: yifeng
 * Date: 2018/6/7
 * Time: 0:07
 */

namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule =   [
        'title'  => 'require',
    ];

    protected $message  =   [
        'title.require' => '标题不能为空',
    ];
    protected $scene = [
        'add'  =>  ['title'],
    ];
}
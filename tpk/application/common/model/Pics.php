<?php
/**
 * Created by PhpStorm.
 * User: yifeng
 * Date: 2018/6/6
 * Time: 22:57
 */

namespace app\common\model;

use think\Model;
class Pics extends Model
{
    public function getAddtimeAttr($value)
    {
        return date("Y/m/d H:i:s",$value);
    }
    public function getCidAttr($value)
    {
        $cate=Picscate::where('cid',$value)->value("name");
        return $cate;
    }
}
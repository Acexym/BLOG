<?php
/**
 * Created by PhpStorm.
 * User: yifeng
 * Date: 2018/6/6
 * Time: 22:57
 */

namespace app\common\model;

use think\Model;
class Article extends Model
{
	 public function getCidAttr($value)
    {
        $cate=Blogcate::where('cid',$value)->value("name");
        return $cate;
    }
	 public static function reports($id)
    {
      $Artice = self::get($id);
      $Artice->ischeck  = '1';
      $res=$Artice->save();
      if($res)
{
	 return ['code'=>1,'msg'=>'举报成功'];
}
    }
	 public static function pass($id)
    {
      $Artice = self::get($id);
      $Artice->ischeck  = '0';
      $res=$Artice->save();
      if($res)
       {
	 return ['code'=>1,'msg'=>'通过审核'];
       }
    }
	
	public static function nopass($id)
    {
      $Artice = self::get($id);
     
      $res=$Artice->delete();
      if($res)
       {
	 return ['code'=>1,'msg'=>'审核不通过，已清除'];
       }
    }
}
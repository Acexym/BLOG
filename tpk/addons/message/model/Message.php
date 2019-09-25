<?php
/**
 * Created by PhpStorm.
 * User: yifeng
 * Date: 2018/10/17
 * Time: 23:51
 */

namespace addons\message\model;


use think\Model;

class Message extends Model
{
    protected $table = 'td_message';
    protected $autoWriteTimestamp = true;
    public static function store($data){
        if(!is_array($data)){
            return false;
        }
        //获取博文发布的id
        $touid=db("blogcate")->where('cid',$data['cid'])->value('uid');
        $data['touid']=$touid;
		unset($data['cid']);
        $result=self::create($data);
        if($result){
            return true;
        }
        return fase;
    }
}
<?php
function returnjson($code=1,$msg=""){
	return json(['code'=>$code,'msg'=>$msg]);
}
function getgrouptitle($uid){
    $res=db("auth_group_access")->where("uid",$uid)->field("group_id")->find();
    if($res){
        $group=db("auth_group")->where("id",$res['group_id'])->field("title")->find();
        if($group){
            return $group['title'];
        }
    }
    return "未知";
}

function format_size($size){
    $arr=['B','KB',"M","G","T"];
    $i=0;
    while ($size>=1024){
        $size=$size/1024;
        $i++;
    }
    return round($size,2).$arr[$i];
}
?>
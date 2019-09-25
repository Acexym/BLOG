<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function encrypt($data, $key)
{
    $key    =    md5($key);
    $x        =    0;
    $len    =    strlen($data);
    $l        =    strlen($key);
    $char = "";
    $str = "";
    for ($i = 0; $i < $len; $i++)
    {
        if ($x == $l)
        {
            $x = 0;
        }
        $char .= $key{$x};
        $x++;
    }
    for ($i = 0; $i < $len; $i++)
    {
        $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
    }
    return base64_encode($str);
}
//解密算法
function decrypt($data, $key)
{
    $key = md5($key);
    $x = 0;
    $data = base64_decode($data);
    $len = strlen($data);
    $l = strlen($key);
    $char = "";
    $str = "";
    for ($i = 0; $i < $len; $i++)
    {
        if ($x == $l)
        {
            $x = 0;
        }
        $char .= substr($key, $x, 1);
        $x++;
    }
    for ($i = 0; $i < $len; $i++)
    {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
        {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        }
        else
        {
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return $str;
}

function getcatename($cid,$type=1){
    if($type==1){
        $cate=db('blogcate')->where("cid",$cid)->field("name")->find();
    }else{
        $cate=db('picscate')->where("cid",$cid)->field("name")->find();
    }
    if($cate){
        return $cate['name'];
    }else{
        return "未知";
    }
}

//获取文分类名称
function getblogcatename($id){
    if(!$id || !is_numeric($id)){
        return "其它";
    }
    $res=db('blogcate')->where('cid',$id)->field("name")->find();
    if($res){
        return $res['name'];
    }
    return "其它";
}
<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Logs as LogsModel;
class Logs extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list=db("logs")->alias('a')
        ->join('Manager b','b.id=a.operator',"LEFT")
        ->order('operate_time Desc')
        ->field('a.*,b.account')
        ->select();
        $this->assign("list",$list);
        return view();
    }

    public function del($id){
       $result=LogsModel::destroy($id);
       if($result){
           config("logs.Logs/del","日志删除成功");
       }
       $this->redirect("admin/Logs/index");
    }
}

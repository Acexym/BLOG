<?php
/**
 * Created by PhpStorm.
 * User: yifeng
 * Date: 2018/11/6
 * Time: 22:39
 */

namespace app\admin\behavior;
use think\Controller;
use app\admin\model\Logs as LogsModel;
class Logs extends Controller
{
    public function appEnd(){
        //记录日志
        //1.获取日志信息
        $data['url']=request()->controller()."/".request()->action();
        $uid=session("uid","","admin");
        $data['operator']=$uid?$uid:0;
        $logs=config("logs");
        if(isset($logs[$data['url']])){
            $description=$logs[$data['url']];
        }else{
            $description=db("auth_rule")->where("name",$data['url'])->value("title");
        }
        $data['description']=$description?$description:"未知";
        $data['operate_time']=time();
        $data['operate_ip']=request()->ip();
        LogsModel::create($data);
    }
//	public function actionBegin(&$params)
//  {
//	$res=$this->ischecklogin();
//		if(!$res)
//		{
//			 $this->redirect('admin/login/index');
//		}      
//  }
//	 public function ischecklogin(){
//      if(session('uid',"","admin") && session('account',"","admin")){
//          return true;
//      }
//      return false;
//  }

}
<?php

namespace app\admin\controller;
use think\auth\Auth;
use think\Controller;
use think\Request;

class Common extends Controller
{
   
     public function _initialize()
    {
        //登录验证
        if(!$this->ischecklogin()){
            $this->redirect("admin/Login/index");
        }
        $uid=session("uid","","admin");
        $controller = request()->controller();
        $action = request()->action();
        $auth = new Auth();
        if($uid!=39){
            if(($controller . '/' . $action)!=="Index/index" && ($controller . '/' . $action)!=="Index/welcome"){
                if(!$auth->check($controller . '/' . $action, $uid)){
                    $this->error('你没有权限访问','admin/Index/welcome');
                }
            }
    }
    }
	 public function ischecklogin(){
        if(session('uid',"","admin") && session('account',"","admin")){
            return true;
        }
        return false;
    }
  
}

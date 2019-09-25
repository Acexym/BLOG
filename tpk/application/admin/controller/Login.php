<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Manager;
class Login extends Controller
{
    //加载登录页面
    public function index(){
    	  config("logs.Login/index",'登陆页面加载');
        return view();
    }

    /**
     * 登录
     */
    public function dologin(){
        $data=input("post.");
        $result=Manager::login($data);
        if($result->getData()['code']==1){
            $msg="登录成功";
        }else{
            $msg="登录失败";
        }
        config("logs.Login/dologin",$msg);
        return $result;
    }

    public function logout(){
        session(null,"admin");
		  config("logs.Login/logout",'退出登录');
        $this->redirect('index');
    }
}

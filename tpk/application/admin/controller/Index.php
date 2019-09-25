<?php
namespace app\admin\controller;
use app\common\Model\Pics;
class Index
{
    public function index()
    {
    	  config("logs.Index/index",'访问主页面');
        return view();
    }
	public function welcome(){
		     //取博文数
        $count_blog=db('article')->count();
        //取相册
        $count_pics=db('pics')->count();
        //取会员
        $count_user=db('user')->count();
        //取管理员
        $count_manager=db('manager')->count();
			  config("logs.Index/welcome",'访问欢迎页面');
//        $this->assing();
        return view('',['blogs'=>$count_blog,'pics'=>$count_pics,'users'=>$count_user,'manager'=>$count_manager]);
	}
	public function cate(){
		
		return view();
	}
}

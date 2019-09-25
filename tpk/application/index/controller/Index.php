<?php
namespace app\index\controller;

class Index extends Common
{
    public function index()
    {
        //获取今日推荐
        $tuijian=$this->gettuijian(1,"aid,title,remark");
        $this->assign("tuijian",$tuijian);
        //取博文分类
        $blogcates=$this->getblogcates();
        $this->assign("blogcates",$blogcates);
        //取最新博文
        $newblogs=$this->getnewblogs(10);
//		return json($newblogs); 
        $this->assign("newblogs",$newblogs);
		
        //取热门博文
        $hotblogs=$this->gethotlogs(2);
        $this->assign("hotblogs",$hotblogs);
        return view();
    }
}

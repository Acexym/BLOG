<?php

namespace app\index\controller;
use app\common\model\Article as Articles;
use think\Controller;
use think\Request;
class Article extends Common
{
    /**
     * 博文列表
     *
     * @return \think\Response
     */
    public function index($cid)
    {
        //
        echo "博文列表{$cid}";
    }

    /**
     * 博文详情
     * @param $id
     */
    public function show($id){
    	  $hotblogs=$this->gethotlogs(2);
        $this->assign("hotblogs",$hotblogs);		
        db('article')->where('aid',$id)->setInc('views');
	  $liuyan=db("article")->where("aid",$id)->find();
        $info=db("article")->where("aid",$id)->select();
		 $classification=db("article")->where("keyword",$liuyan['keyword'])->order('aid', 'desc')->select();
//		 dump($classification);die;
	 $this->assign("fl",$classification);
		     $liuyan=db("article")->where("aid",$id)->find();
//       dump($info);die;
 $this->assign("articles",$info);
        $this->assign("article",$liuyan);
//        echo "博文详情{$id}";
        return view();
    }
	public function report($id){
		$res = Articles::reports($id);
		
	if($res['code']==1)
	{
			$this -> success($res['msg'],'index/Article/show?id='.$id);
	}
	}
}

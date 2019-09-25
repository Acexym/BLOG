<?php

namespace app\index\controller;
use app\common\model\Article as Articles;
use think\Controller;
use think\Request;
class Video extends Common 
{

	public function show($id) 
	{

		$liuyan = db("Video") -> where("vid", $id) -> find();
		$info = db("Video") -> where("vid", $id) -> select();
		$classification = db("Video") -> where("keyword", $liuyan['keyword']) -> order('vid', 'desc') -> select();
		$this -> assign("fl", $classification);
		$liuyan = db("Video") -> where("vid", $id) -> find();
		$this -> assign("video", $info);
		$this -> assign("article", $liuyan);
		return view();
	}

	public function report($id) {
		$res = Articles::reports($id);

		if ($res['code'] == 1) {
			$this -> success($res['msg'], 'index/Article/show?id=' . $id);
		}
	}

}

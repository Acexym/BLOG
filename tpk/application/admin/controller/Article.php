<?php
namespace app\admin\controller;
use think\Controller;
use app\common\Model\Article as Articles;
class Article extends Controller
{
	public function examine(){
		
    $art=db('article')->where('ischeck', '1')->select();
	 $this->assign('art',$art);
	     return view();
	}
	public function pass($id){
$res = Articles::pass($id);
		
	if($res['code']==1)
	{
		return json($res);
	}
 return ['code'=>0,'msg'=>'操作失败'];
	}
	
	public function nopass($id){
$res = Articles::nopass($id);
		
	if($res['code']==1)
	{
		return json($res);
	}
 return ['code'=>0,'msg'=>'操作失败'];
	}
}
?>
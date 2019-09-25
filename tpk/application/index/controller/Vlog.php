<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\controller\Base;
class Vlog extends Common
{
	public function index()
	{
		   $newvlog=$this->getnewvlog(10);
        $this->assign("newbvlog",$newvlog);
		return view();
		
	}   
	
    
			 
	
	
}
?>
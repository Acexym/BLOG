<?php
/**
 * Created by PhpStorm.
 * User: yifeng
 * Date: 2018/9/15
 * Time: 22:05
 */

namespace app\index\controller;


use think\Controller;
use app\common\controller\Base;

class Common extends Controller
{
    /**
     * 获取今日推数据
     * @param int $num
     * @return array
     */
    public function gettuijian($num=1,$fiels="aid,title"){
        $list=db('article')->whereTime('addtime', 'today')->limit($num)->field($fiels)->select();
        return $list;
    }

    /**
     * 获取博文分类
     * @param int $num
     * @return array
     */
    protected function getblogcates(){
    	$name=decrypt(cookie('name'),SALT);

        if(isset($name)&& $name!="")
		{
		$uid=db('user')->where('account',$name)->column('uid');		    
		$list =db('blogcate')->where('uid',$uid[0])->order('sort Asc')->limit(5)->select();
		}
    	else{
    		  $list=db('blogcate')->order('sort Asc')->limit(5)->select();
    	}
          
			
		
        return $list;
    }

    /**
     * 获取最新博文
     * @param int $num
     * @return array
     */
    protected function getnewblogs($num=4){
        $map=[];
        if(Base::isLogin()){
            $cids=Base::getcurusercates();
            $map=['cid'=>array('in',$cids)];
        }
        $list=db('article')->where($map)->order('addtime Desc')->limit($num)->select();
        return $list;
    }
    /**
     * 获取热门文章
     * @param int $num
     * @return array
     */
    protected function gethotlogs($num=4){
        $list=db('article')->where('views',">",config('index.hotnum'))->order('views Desc')->limit($num)->select();
        return $list;
    }
	
	 protected function getnewvlog($num=4){
        $map=[];
        if(Base::isLogin()){
            $cids=Base::getvideocates();
            $map=['cid'=>array('in',$cids)];
        }
        $list=db('video')->where($map)->order('addtime Desc')->limit($num)->select();
        return $list;
    }
}
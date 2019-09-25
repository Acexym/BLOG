<?php
/**
 * Created by PhpStorm.
 * User: yifeng
 * Date: 2018/10/17
 * Time: 23:40
 */

namespace addons\message\controller;


use think\addons\Controller;
use addons\message\model\Message;
use app\common\controller\Base;
class Index extends Controller
{
    public function lst(){
        $this->checklogin();
        $list=(new Message())->paginate(10);
        $this->assign('list',$list);
        $addonmenu=(new Base())->getaddonsmenu();
        $this->assign('addonmenu',$addonmenu);
        return $this->fetch();
    }
    /**
     * 在线留言数据处理
     */
    public function save(){
        $data=input('post.');
        $result=Message::store($data);
        if($result){
            $this->success("留言成功");
        }else{
            $this->error("留言失败");
        }
    }

    /**
     * 删除留言
     */
    public function del(){
        $this->checklogin();
        $id=input('post.id');
        $result=Message::destroy($id);
        if($result>0){
            return json(['code'=>1,'msg'=>'删除成功']);
        }
        return json(['code'=>0,'msg'=>'删除失败']);
    }

    public function checklogin(){
        //判断是否登录
        if(!Base::isLogin()){
            $this->success("无权操作");
        }
    }
}
<?php
namespace app\blog\controller;
use app\common\controller\Base;
use app\common\validate\Videocate as Vlidate;
class Videocate extends Base
{
	 public function add(){
       if(request()->isPost()){
           $data=input('post.');
           $vali=new Vlidate();
           if(!$vali->scene('add')->check($data)){
               $this->error($vali->getError());
           }
            //获取当前用户的id
           $res=db('user')->where('account',session('username'))->find();
           if(!$res){
               $this->error("添加失败",'blog/videovate/index','',1);
           }
           $data['uid']=$res['uid'];        
           $modelBlogcate=model('Videocate');
           $modelBlogcate->data($data);
           $result=$modelBlogcate->allowField(true)->save();
           if($result==1){
               $this->success("添加成功",'blog/videocate/index','',1);
           }
           $this->error("添加失败",'blog/videocate/index','',1);
       }
        return view();
    }
	    public function index(){
        $modelblogcate = model('videocate');
	  $res=db('user')->where('account',session('username'))->find();	    
        // 查询数据集
        $res=$modelblogcate->where('uid',$res['uid'])
            ->paginate(3);
//			dump($res);die;
        //分配单个变量到模板
        $this->assign('list',$res); 
        return view();
    }
}
?>
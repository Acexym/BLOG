<?php
namespace app\blog\controller;
use app\common\controller\Base;
use app\common\validate\Video as VlidateVideo;

class Video extends Base
{
	 public function add(){
        if(request()->isPost()){
           $data=input('post.');
           $vali=new VlidateVideo();
           if(!$vali->scene('add')->check($data)){
               $this->error($vali->getError());
           }
            //获取当前用户的id
           $res=db('user')->where('account',session('username'))->find();
           if(!$res){
               $this->error("添加失败",'blog/Video/lst','',1);
           }
           $data['uid']=$res['uid'];
           $articleModel=model('Video');
           $data['addtime']=time();
           $articleModel->data($data);
           $result=$articleModel->allowfield(true)->save();
           if($result==1){
               $this->success("添加成功",'blog/Video/lst','',1);
           }
           $this->error("添加失败",'blog/Video/lst','',1);
		   
    }
		  $cate=$this->getcates();
       $this->assign("catelist",$cate);
		return view();
	 }
	    public function lst() {
        $articleModel = model('Video');
        // 查询数据集
        $cids=Base::getvideocates();
        $res=$articleModel->where("cid",'in',$cids)->order('addtime', 'desc')
            ->paginate(10);
        //分配单个变量到模板
        $this->assign('list',$res);
        return view();
    }
		 public function upimg()
		 { 
        $file = request()->file('upimg');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){            
                $data=[
                    "code"=>1,
                    "msg"=>"上传成功",
                    "src"=>$info->getSaveName()//这里的路径可以根据己的需求
                ];

            }else{
                $data=[
                    "code"=>0,
                    "msg"=>$file->getError()
            ];
        }

            return json($data);
        }
    }
	public function videoupload($dir='uploads')
	{			
			 $file = request()->file('file');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){            
                $data=[
                    "code"=>1,
                    "msg"=>"上传成功",
                    "src"=>$info->getSaveName()//这里的路径可以根据己的需求
                ];

            }else{
                $data=[
                    "code"=>0,
                    "msg"=>$file->getError()
            ];
        }

            return json($data);
        }
	}
 		 
	
		  //获取当前用户的分类列表
    private function getcates(){
        $user=db('user')->where('account',session("username"))->field("uid")->find();
        if(!$user){
            $this->error("操作异常");
        }
        $cate=db("Videocate")->where('uid',$user['uid'])->select();
        return $cate;
    }
}
?>
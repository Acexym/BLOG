<?php
namespace app\blog\controller;
use think\Controller;
use app\common\controller\Base;
use app\common\Model\User;
use app\common\validate\User as UserValidate;

//个人博客管理页面
class Index extends Base 
{
	public function index() {
		$result = User::where('account', session('username')) -> field('logo,blogtitle,blogname,host,info,content') -> find();
		$result = $result -> toArray();
		  
		if ( request() -> isPost()) {
			$data = input('post.');
			 // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('logo');
			 $fileinfo=Base::upload($file,$result['logo']);
			    if($fileinfo['code']==1){
                $data['logo']=$fileinfo['path'];
            }			
			$userValidate = new UserValidate();
			if ($data['blogtitle'] != '') {
				if (!$userValidate -> scene('blogtitle') -> check($data)) {
					$this -> error($userValidate -> getError(), 'blog/Index/index');
				}
			}
			if ($data['host'] != '') {
				if (!$userValidate -> scene('host') -> check($data)) {
					$this -> error($userValidate -> getError(), 'blog/Index/index');
				}
			}
			$res = User::where('account', session('username')) -> update($data);
			if ($res !== false) {
				$this -> success('修改成功', 'blog/index/index');
			}
		}
		$this -> assign('user', $result);
		return view('index');
	}

	public function person() 
	{
	 $result=User::where('account', session('username'))->field('face,account,nick,email,uid')->find();
        $result = $result->toArray();
        if(request()->isPost()){
            $data=input('post.');

            $file = request()->file('face');
            $fileinfo=Base::upload($file,$result['face']);
            if($fileinfo['code']==1){
                $face=$fileinfo['path'];
            }else{
                $face="";
            }
            $newdata=[
                'nick'=>$data['nick'],
                'face'=>$face
            ];
           $userValidate = new UserValidate();
            if($result['nick']!==$data['nick']){
                if(!$userValidate->scene('nick')->check($data)){
                    $this->error($userValidate->getError(),'blog/Index/personal');
                }
            }
            $res=User::where('uid',$result['uid'])->update($newdata);
            if($res!==false){
                $this->success('修改成功','blog/Index/person');
            }
        }
        $this->assign('personal',$result);
		return view();
	}

	public function setpasswd() {
		 if(request()->isPost()){
            $data=input('post.');
            $result=User::setpasswd($data);
            if($result['code']==1){
                $this->success($result['msg'],'blog/Index/setpasswd');
            }else{
                $this->error($result['msg'],'blog/Index/setpasswd','',2);
            }
        }
		return view();
	}

}
?>
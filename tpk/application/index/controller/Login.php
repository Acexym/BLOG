<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\User;
use app\common\model\Validate as UserValidate;
use app\common\controller\Base;
use think\Request;
class Login extends Base {

	public function index() {
//		$logincount = cookie('codecount');
//		if ($logincount === NULL) {
//			cookie('codecount', 1, 3600);
//		}
//		if ( request() -> isAjax()) {
			$data = input('post.');
			$res = User::login($data);	
			return json($res);
//		}
//		return ['code'=>1];
//		$this -> assign('logincount', cookie('codecount'));
//		return view();

	}

	public function reg() {
		if (Request::instance() -> isAjax()) {
			$data = input('post.');
			$result = User::userreg($data);
			return json($result);
		}
		return view();
	}

	//	   public function register()
	//	   {
	//
	//	   }
	public function bind() {
		return view();
	}

	public function active($token)//邮箱验证 通过邮箱发送的token激活账号
	{
		if (isset($token)) {
			$res = User::active($token);
			if ($res['code'] == 1) {
				$this -> success($res['msg'], 'index/login/index');
			}
			$this -> success($res['msg'], 'index/login/reg');
		}

	}
	 public function goout(){
        cookie('name', null);
        cookie('code', null);
        $this->redirect('index/index/index');
    }

}
?>
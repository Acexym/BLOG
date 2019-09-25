<?php
namespace app\blog\behavior;
use app\common\controller\Base;
class Login extends Base
{
	 public function run(&$params)
    {
        // 行为逻辑  如果没定义 走这里
        echo "1111";
    }
	  public function actionBegin(&$params)
    {
  	$res=Base::isLogin();
		if(!$res)
		{
			 $this->redirect('index/Login/index');
		}

		
       
    }
}
?>
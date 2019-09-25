<?php
namespace app\common\controller;
use think\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use think\Cookie;
class Base extends  Controller{
	public function _initialize(){
		$addonmenu=$this->getaddonsmenu();
    $this->assign('addonmenu',$addonmenu);
	}
	public  function sendTextmail($toemial,$account,$url,$title="账号激活")
	{
		  $mail = new PHPMailer(true);		
	 try {
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.163.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'fjmkxj@163.com';                 // SMTP username
            $mail->Password = 'fjm1004694194';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 994;                                    // TCP port to connect to
            $mail->CharSet = 'UTF-8';//邮件编码的设置
            //Recipients
            $mail->setFrom('fjmkxj@163.com', 'AJson');//发送邮箱
            $mail->addAddress($toemial,'wang');               // Name is optional
            $mail->addReplyTo('fjmkxj@163.com', '明哥在线教学');//激活

            //Content
            $mail->isHTML(true);                              // Set email format to HTML
            $mail->Subject = $title;
            $mail->Body    = "你好!<br>感谢你注册易风博客系统。 <br>你的登录用户名为：{$account}。请点击以下链接激活帐号：
<a href='{$url}' target='_blank'>{$url}</a><br>如果以上链接无法点击，请将上面的地址复制到你的浏览器(如IE)的地址栏进入易风博客系统激活账号。 （该链接在24小时内有效，24小时后需要重新注册）";
         $mail->send();
         }
      catch (Exception $e) {

        }

      
	}
  public static function setLogin($account,$uid){
        cookie('name', encrypt($account,SALT), 3600);
        cookie('code',md5($account.SALT),3600);
        session('uid',$uid);
        return ['code'=>1,'msg'=>"登录成功",'name'=>$account];
    }

    //判断登陆
public static function isLogin(){
	if(!Cookie::has('name') || !Cookie::has('code') )
	{
		return false;
	}
	if(cookie('code')==md5(decrypt(cookie('name'),SALT).SALT))
	{
		session('username',decrypt(cookie('name'),SALT));   
		return true;
	}
	return false;	
}
//文件上传
 public static function upload($file,$oldfile=null,$dir='uploads'){
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . $dir);
            if($info){
                // 成功上传后 获取上传信息
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                //调用"/uploads/20160820/42a79759f284b767dfcb2a0197904287.jpg"
                if($oldfile!==null){
                    //项目根目录/public/$oldfile
                    $path=ROOT_PATH.'public/'.$oldfile;
                    if(is_file($path) && file_exists($path)){
                        @unlink($path);
                    }
                }
                return ['code'=>1,'msg'=>'上传成功','path'=>$dir.DS.$info->getSaveName()];
            }else{
                // 上传失败获取错误信息
                return ['code'=>0,'msg'=>$file->getError()];
            }
        }
    }
  public static function getcurusercates(){
        //1.获取用户id
        $account=decrypt(cookie("name"),SALT);
        //2.通过用户名查询用户id
        $uid=db("user")->where('account',$account)->value('uid');
        //3.通过用户id获取当前用户的所属分类
        $res_cate=db('blogcate')->where('uid',$uid)->column('cid');

        return $res_cate;
    }
   public static function getvideocates(){
        //1.获取用户id
        $account=decrypt(cookie("name"),SALT);
        //2.通过用户名查询用户id
        $uid=db("user")->where('account',$account)->value('uid');
        //3.通过用户id获取当前用户的所属分类
        $res_cate=db('Videocate')->where('uid',$uid)->column('cid');

        return $res_cate;
    }
  
	
  
  /**
     * 获取已安装插件的菜单项
     * @param int $type
     * @return mixed
     */
   public function getaddonsmenu($type=0)
   {
   	$addons=get_addon_list();

	$arr=[];
	foreach($addons as $v)
	{
		if(is_file(ADDON_PATH.$v['name'].DS.'config.php'))
		{
			if(isset($v['menu'])&& !empty($v['menu']))
			{
				if($type==$v['menu']['type'])
				{
					$arr[]=$v['menu'];
				}   
				
			
			}			
		}
	}
            return $arr;
   }
}
?>
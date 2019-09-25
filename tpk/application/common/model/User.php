<?php
namespace app\common\model;
use app\common\validate\User as UserValidate;
use app\common\controller\Base;
use think\Model;
class User extends Model
{
	   //token 令牌  time//有效时间
	protected $auto=['regtime','salt','token','token_exptime'];
//	
//	protected function setPasswdAttr($value)
//	{
//		    return md5($value);
//	}
	  protected function setSaltAttr(){
         return md5(time());
    }
	   protected function setRegtimeAttr(){
        return time();
    }
	    protected function setTokenAttr($value,$data){
	    	$token=md5($data['account'].$data['passwd'].time());
        return $token;
    }
		 protected function setTokenExptimeAttr(){
$token_exptime=time()+24*60*60;
//          $token_exptime=time()+24*60*60;
        return $token_exptime;
    }    
		 //注册写入数据库 写入数据库后执行发送邮件
	     public static function userreg($data)
	     {
	     
	   	 $userValidate=new UserValidate();
		 if(!$userValidate->scene('reg')->check($data))
		 {
		 	return ['code'=>0,'msg'=>$userValidate->getError()];
		 }		
    
		$res=self::create($data,true);
		
		
		 if($res)
		 {
		 	$usersend=new Base();
		$result= $usersend->sendTextmail($res->email,$res->account,url('index/Login/active','','',true)."?token=".$res->token);
		 	return ['code'=>1,'msg'=>'注册成功','result'=>$result];
		 	
          }
            return ['code'=>0,'msg'=>'注册失败'];
		
	           
         }
		 
		 //用户激活	情况 
		 public static function active($token){
        $res = self::field('token,token_exptime,account,passwd,email')->where('token',$token)->find();
        if(!$res){
            return ['code'=>0,'msg'=>'用户不存在，请注册'];
        }
        if(time()<$res['token_exptime'])
        {
            $res->isactive=1;
            $result=$res->save();
            if($result===0){
                return ['code'=>1,'msg'=>'账号已激活，请登录'];
            }
            if($result===1){
                return ['code'=>1,'msg'=>'激活成功，请登录'];
            }
            if($result===false)
            {
                return ['code'=>0,'msg'=>'链接已失效请重新激活'];
            }
        }
        //激活连接有效期已过，时重新给用户发送邮件
        $newstoken=md5($res->account.$res->passwd.time());
        $time=time()+24*60*60;
        db('user')->where('token',$token)->update(['token'=>$newstoken,'token_exptime'=>$time]);
        $result=Base::sendTextmail($res->email,$res->account,url('index/Login/active','','',true)."?token=".$newstoken);
        return ['code'=>0,'msg'=>'连接已失效，新的激活连接已发送到您的邮箱，请重新激活！'];
    }
//用户登录
public static function login($data)
{        
	     $count = cache($data['account'].'retry');        
		 $userValidate=new UserValidate();
		 if(!$userValidate->scene('index')->check($data))
		 {
		 	return ['code'=>0,'msg'=>$userValidate->getError()];
		 }
		 if($count>3)
		 {
		 	if(!$userValidate->scene('code')->check($data))
		   {
		 	return ['code'=>3,'msg'=>$userValidate->getError(),'count'=>$count];
		   }
		 }
		 $res=self::where('account',$data['account'])->field('account,passwd,salt,isactive')->find();
		 if(!$res['account'])
		 {		  
		 	 return ['code'=>0,'msg'=>'用户不存在，请注册'];
		 }
		 if($res['isactive']==0)
		 {
		 	 return ['code'=>0,'msg'=>'用户未激活'];
		 }
		 if(md5($data['passwd']) != md5($res['passwd']))
		 {
		    cache($data['account'].'retry',$count+1,3600);
		     cookie('codecount',$count+1,3600);
		 	 return ['code'=>2,'msg'=>'密码错误啊'];
		 }		 
		 cookie('name',encrypt($data['account'], SALT),3600);
		  cookie('code',md5($data['account'].SALT),3600);
		  cache($data['account'].'retry', NULL);
		 	 return ['code'=>1,'msg'=>'登陆成功','name'=>$data['account']];
		 	 }

//用户修改密码
			 public static function setpasswd($data){
			 	 $uservalidate=new UserValidate();
        if(!$uservalidate->scene('passwd')->check($data)){
            return ['code'=>0,'msg'=>$uservalidate->getError()];
        }
        $user=self::get(['account'=>session('username')]);
        if($data['oldpasswd']!=$user['passwd']){
            return ['code'=>0,'msg'=>'旧密码输入不正确'];
        }
        $user->passwd=$data['passwd'];
        $user->salt="";
        $res=$user->save();
        if($res){
            return ['code'=>1,'msg'=>'密码修改成功'];
        }
				
			 }
		 

}
?>
<?php
namespace addons\message;	// 注意命名空间规范
use think\Db;
use think\Addons;

/**
 * 插件测试
 * @author byron sampson
 */
class Message extends Addons	// 需继承think\addons\Addons类
{
	// 该插件的基础信息
    public $info = [
        'name' => 'message',	// 插件标识
        'title' => '在线留言',	// 插件名称
        'description' => '在线留言插件',	// 插件简介
        'status' => 0,	// 状态
        'author' => 'ming',
        'version' => '1.0',
        'menu'=>[
        'name'=>'查看留言',
        'url'=>'',
        'type'=>0  //0代表个人 1代表后台
        ]
    ];
      
	  public function _initialize()
	  {

		$this->info['menu']['url']=addon_url("Message://Index/lst");
	  }
    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
       
      $config=$this->info;	  
//	  $sql_content=file_get_contents(ADDON_PATH.'message/install.sql');
//	  $arr_sql=array_filter(explode(";",$sql_content));
//	  foreach($arr_sql as $v){
//	  	Db::execute($v);
//	  }
//	  $re=Db::execute($sql_content);
    
	  $result=create_config($config);
	  return $result;
    }

    /**
     * 插件卸载方法
     * @return bool
	 *  
     */
    public function uninstall()
    {
    	 $name=$this->getName();
		 $file=ADDON_PATH.DS.$name.DS.config('addons.fileflag');
		 if(!is_file($file))
		 {
		 	 return true;
		 }
		 $result=@unlink($file);
//		 	$sql="DROP TABLE td_message";
//		    Db::execute($sql);
		 if(!$result)
		{
			return false;
		}
	
        return true;
    }

    /**
     * 实现的testhook钩子方法
     * @return mixed
     */
    public function messagehook($param)
    {
    $this->assign('cid',$param['cid']);
    return $this->fetch('message');
    }

}
?>
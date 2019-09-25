<?php
namespace addons\test;	// 注意命名空间规范

use think\Addons;

/**
 * 插件测试
 * @author byron sampson
 */
class Test extends Addons	// 需继承think\addons\Addons类
{
	// 该插件的基础信息
    public $info = [
        'name' => 'test',	// 插件标识
        'title' => '插件测试',	// 插件名称
        'description' => 'thinkph5插件测试',	// 插件简介
        'status' => 0,	// 状态
        'author' => 'byron sampson',
        'version' => '0.1'
    ];

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
    	$content=$this->info;
		$content['menu']=[];
		$result=create_config($content);	   
        return $result;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
    	$name=$this->getName();  
		$file=ADDON_PATH.$name.DS.config("addons.fileflag");
		if(!is_file($file))
		{
			 return true;
		}
		$result=@unlink($file);
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
    public function testhook($param)
    {

        return $this->fetch('info');
    }

}
?>
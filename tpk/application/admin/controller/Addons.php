<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
class Addons extends Common
{
	 /**
     * 插件列表
     * @return \think\response\View
     */
    public function index(){
        //获取插件列表数据
        $addons=get_addon_list();
        $this->assign('list',$addons);
        return view('index');
    }

    /**
     * 插件的安装
     */
    public function install($name){

        $class=get_addon_class($name);
		
        $result=(new $class)->install();
        if($result===false){
            $this->error("插件安装失败");
        }
  
        //判断是否有静态资源文件
  if(is_dir(ADDON_PATH.$name.DS."static"))
	  {
	       //将静态资源文件移动到public/static/addons
	  	@rename(ADDON_PATH.$name.DS."static".DS.$name, ROOT_PATH."public/static/addons".DS.$name);
	  }
        $this->success("插件安装成功");
    }

    /**
     * 插件的卸载
     */
    public function uninstall($name){
        $class=get_addon_class($name);
        $result=(new $class)->uninstall();
        if($result===false){
            $this->error("插件卸载失败");
        }
        //还原静态资源文件
        if(is_dir(ADDON_PATH .$name.DS."static")){
            //将静态资源文件移动到public/static/addons
            @rename(ROOT_PATH.'public'.DS.'static'.DS.'addons'.DS.$name,ADDON_PATH .$name.DS."static".DS.$name);
        }
        $this->success("插件卸载成功");
    }

    //离线安装
     public function lxinstall(){
        $file = request()->file('addons');
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $fileinfo=$file->getInfo();
            $result=$this->uzip($fileinfo['tmp_name']);
            if($result===false){
                return returnjson(0,'安装失败');
            }	
            $result_install=$this->install($result);
            if($result_install['code']==1){
                return returnjson(1,'安装成功');
            }
            return returnjson(0,'安装失败');
        }
    }

     //文件解压
    protected function uzip($filename){
        //解压缩
        $zip = new \ZipArchive;
        //要解压的文件
        $zipfile = $filename;
	
        $res = $zip->open($zipfile);
	
        if($res!==true){
            return false;
        }
        //要解压到的目录
        $toDir = ADDON_PATH;
        if(!file_exists($toDir)) {
            mkdir($toDir,755);
        }
        //获取压缩包中的文件数（含目录）
        $docnum = $zip->numFiles;
        $addonname="";
        //遍历压缩包中的文件
        for($i = 0; $i < $docnum; $i++) {
            $statInfo = $zip->statIndex($i);
			//判断是否为目录，是为0
            if($statInfo['crc'] == 0) {
//          	dump($toDir.'/'.substr($statInfo['name'], 0,-1));die;
                  mkdir($toDir.'/'.substr($statInfo['name'], 0,-1));     
				   $addonname=substr($statInfo['name'], 0,-1);  
		
         }
        }
		   for($i = 0; $i < $docnum; $i++) {
		   	 $statInfo = $zip->statIndex($i);
			     if($statInfo['crc'] != 0) {
			     	 copy('zip://'.$zipfile.'#'.$statInfo['name'], $toDir.'/'.$statInfo['name']);
			     }
		   }
        return $addonname;
    }
}
?>
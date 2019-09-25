<?php

namespace app\admin\controller;

use \tp5er\Backup;
use think\Db;
class Database extends Common
{
    /**
     * 获取数据库中表的列表信息
     * @return \think\response\View
     */
    public function index(){
        $backup=new Backup();
        $list=$backup->dataList();
        $this->assign('list',$list);
        return view();
    }

    /**
     * 表的修复
     * @return \think\response\Json
     * @throws \Exception
     */
    public function repair(){
       if(request()->isPost()){
           $table=input('post.tablename');
           if(!empty($table)){
               $backup= new Backup();
               $result=$backup->repair($table);
			 
               if($result[0]['Msg_text']=="OK"){
                   return returnjson(1,"修复成功");
               }
               return returnjson(0,"修复失败");
           }
       }else{
           return returnjson(0,"请求异常");
       }
    }
    /**
     * 表的优化
     * @return \think\response\Json
     * @throws \Exception
     */
    public function optimize(){
        if(request()->isPost()){
            $table=input('post.tablename');
            if(!empty($table)){
                $backup= new Backup();
                $result=$backup->optimize($table);
				  dump($result);die;
                if($result[0]['Msg_text']=="OK"){
                    return returnjson(1,"优化成功");
                }
                return returnjson(0,"优化失败");
            }
        }else{
            return returnjson(0,"请求异常");
        }
    }

    /**
     * 批量修复
     * @return \think\response\Json
     * @throws \Exception
     */
    public function repairAll(){
        if(request()->isPost()){
            $tables=input('post.tables');
            $tables=explode(",",$tables);
            if(is_array($tables)){
                $backup= new Backup();
                foreach ($tables as $v){
                   $backup->repair($v);
                }
                return returnjson(1,"修复完成");
            }
            return returnjson(0,"修复失败");
        }
        return returnjson(0,"请求异常");
    }
    //获取备份列表
    public function backuplst(){
        $table=input("t");
        $config=[];
        $config=[
            'path' => '../Data/'.$table.DS,
        ];
		//        $config=指定路径
		
        $db= new Backup($config);
//        halt($db->getFile('',1541398287));
//获取数据库备份列表$db->fileList();
        $list=$db->fileList();

        $data=[];
        foreach ($list as $v){
            $res=$db->getFile('time',$v['time']);
//			dump($res);die;
            $filename="未知";
            if(isset($res[0])){
            	//basename() 函数返回路径中的文件名部分。
                $filename=basename($res[0]);
            }
            $v['filename']=$filename;
            $data[]=$v;
        }

        $this->assign("table",$table);
        $this->assign("list",$data);
        return view();
    }
    //单表备份
    public function dbbackup(){
        if(request()->isPost()){
            $table=input("t");
            $config=[
                'path' => '../Data/'.$table.DS,
                'compress'=>0
            ];
            $db= new Backup($config);
            $file=['name'=>date('Ymd-His'),'part'=>1];
			//$table=="database"批量备份
            if($table=="database"){
                //1.获取数据库中所有表
                $sql="show tables";
                $tables=Db::query($sql);
                foreach ($tables as $v){
                	//设置文件名，备份，按步执行
                    $start= $db->setFile($file)->backup($v['Tables_in_yf_blog'], 0);
                }
            }else{
                $start= $db->setFile($file)->backup($table, 0);
            }
            if($start==0){
               return returnjson(1,"备份成功");
            }else{
                return returnjson(0,"备份失败");
            }
        }
        return returnjson(0,"操作异常");
    }

    /**
     * 数据还原
     * @return \think\response\Json
     * @throws \Exception
     */
    public function restore(){
        $table=input("post.t");
        $time=input("post.time");
        $config=[
            'path' => '../Data/'.$table.DS,
            'compress'=>1
        ];
        $db= new Backup($config);
        $start=0;
        $start= $db->import($start,$time);
        if($start==0){
            return returnjson(1,"导入成功");
        }
        return returnjson(0,"导入失败");
    }

    /**
     * 删除备份
     * @return \think\response\Json
     * @throws \Exception
     */
    public function del(){
        $table=input("post.t");
        $time=input("post.time");
        $config=[
            'path' => '../Data/'.$table.DS,
            'compress'=>1
        ];
        $db= new Backup($config);
        $result=  $db->delFile($time);
        if($result==$time){
            return returnjson(1,"删除成功");
        }
        return returnjson(0,"删除失败");
    }
    /**
     * 备份下载
     * @return \think\response\Json
     * @throws \Exception
     */
    public function download(){
        $table=input("t");
        $time=input("time");
        $config=[
            'path' => '../Data/'.$table.DS,
            'compress'=>1
        ];
        $db= new Backup($config);
        $file = $db->getFile('time', $time);
        $fileName = $file[0];
        $result=false;
        if(file_exists($fileName)){
            $result= $db->downloadFile($time);
        }
        if($result){
            return returnjson(1,"下载成功");
        }
        return returnjson(0,"下载失败");
    }
}
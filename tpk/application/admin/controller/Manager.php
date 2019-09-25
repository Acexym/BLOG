<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use app\admin\validate\Manager as ManagerValidate;
use app\admin\model\Manager as ManagerModel;
use app\admin\model\AuthGroup;

class Manager extends Common
{     //前置行为
      protected $beforeActionList = [
        'checkrequest'  =>  ['only'=>'save,update,delete,setstatus'],
    ];
    public function index()
    {

//      $list=ManagerModel::getlistall();
$list=db('manager')->order('id Desc')->paginate(10);
        $this->assign('list',$list);
        return view();
    }

  
    public function add()
    {
        $authgroup=AuthGroup::all();
        $this->assign('authgroup',$authgroup);
        return view();
    }

    /**
     * 添加管理员
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {      
        //获取POST数据
        $data=$request->post();
        //向模型提交数据
        $result=ManagerModel::store($data);
        return $result;
    }



    public function edit($id)
    {
        $authgroup=AuthGroup::all();
        $this->assign('authgroup',$authgroup);
//        $manager=db('manager')->where('id',$id)->find();
        //获取管理员的角色信息
        $group=db("auth_group_access")->where('uid',$id)->field("group_id")->find();
        $manager=ManagerModel::get($id);
        $this->assign('manager',$manager);
        $this->assign('group_id',$group['group_id']);
        return view();
    }


    public function update(Request $request, $id)
    {
//        if(!request()->isPost()){
////            return json(['code'=>0,'msg'=>"操作异常"]);
//            return returnjson(0,"操作异常");
//        }
        //获取POST数据
        $data=$request->post();
        $result=ManagerModel::store($data);
        return $result;
    }


    public function delete($id)
    {
//        if(!request()->isPost()){
//            return returnjson(0,"操作异常");
//        }
        $result=ManagerModel::del($id);
        return $result;
    }
    //设置管理员状态
    public function setstatus($id){
//        if(!request()->isPost()){
//            return returnjson(0,"操作异常");
//        }
//        return $this->checkrequest();
        $result=ManagerModel::setstatus($id);
        return $result;
    }
	 protected function checkrequest(){
        if(!request()->isPost()){
//            return returnjson(0,"操作异常");die;
            echo json_encode(['code'=>1,'msg'=>'操作异常']);exit;
        }
    }

 
}

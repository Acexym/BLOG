<?php
/**
 * Created by PhpStorm.
 * User: yifeng
 * Date: 2018/6/6
 * Time: 22:59
 */

namespace app\blog\controller;


use app\common\controller\Base;
use app\common\validate\Pics as VlidatePics;
class Pics extends Base
{
    /**
     * 添加博文
     * @return \think\response\View
     */
    public function add(){
       if(request()->isPost()){
           $data=input('post.');
           $vali=new VlidatePics();
           if(!$vali->scene('add')->check($data)){
               $this->error($vali->getError());
           }
            //获取当前用户的id
           $res=db('user')->where('account',session('username'))->find();
           if(!$res){
               $this->error("添加失败",'blog/Pics/lst','',1);
           }
           $data['uid']=$res['uid'];       
           $PicsModel=model('Pics');
           $data['addtime']=time();
           $PicsModel->data($data);
           $result=$PicsModel->allowField(true)->save();
           if($result==1){
               $this->success("添加成功",'blog/Pics/lst','',1);
           }
           $this->error("添加失败",'blog/Pics/lst','',1);
       }
       //查询分类，当前用户的分类信息
      $cate=$this->getcates();
       $this->assign("catelist",$cate);
        return view();
    }
    /**
     * 图片列表
     * @return \think\response\View
     */
    public function lst(){
    	
        return view();
    }
	//获取相册数据1，用laiui表格
    public function getdata($limit=5){
    	$res=db('user')->where('account',session('username'))->find();
		$cid=db('Picscate')->where('uid',$res['uid'])->find();
        $PicsModel = model('Pics');
        // 查询数据集
        $res=$PicsModel->where('cid',$cid['cid'])->order("addtime Desc")
            ->paginate($limit,false);
        $arr=$res->toArray();
//     dump($arr);die;
        $data=[
            "status"=>200,
            "hint"=>"无数据",
            "total"=>$arr['total'],
            "rows"=>$arr['data']
        ];
        if(count($arr['data'])>0){
            $data['status']=200;
        }else{
            $data['status']=0;
        }
        return json($data);
    }
    //数据编辑
    public function savedata(){
        $PicsModel = model('Pics');
        //取要编辑的字段名
        $field=input('post.f');
        //取最新数据
        $data=input('post.d');
        //获取id
        $aid=input('post.aid');
        $result=$PicsModel::where('aid', $aid)
            ->update([$field => $data]);
        if($result===false){
            return json(['code'=>0,'msg'=>"更新失败"]);
        }else{
            return json(['code'=>1,'msg'=>"更新成功"]);
        }
    }
    /**
     * 编辑图片
     * @return \think\response\View
     */
    public function edit($aid=null){
//      $cid=input('cid');
        //当是POST提交来的数据，1：接收 2：更新入库
        $PicsMode=model("Pics");
        if(request()->isPost()){
            $data=input('post.');
//            $cid=$data['cid'];
//            unset($data['cid']);
            //模中更新和新增都有save方法，更新方式如下
            //1. 为save方法新增第二个参数（更新条件），更新数据中，不能含有主键
            //2. 使用isUpdate将当前操作设置为更新操作。
            $result=$PicsMode->isUpdate()->allowField(true)->save($data);
            if($result!==false){
                $this->success("更新成功",'lst');
            }
        }
        if($aid===null){
            $this->error("参数错误");
        }
        $cate=$this->getcates();
        $this->assign("catelist",$cate);
        $result=$PicsMode->where('aid', $aid)
            ->find();
        $this->assign('pics',$result);
        return view();
    }
// 删除博文
    public function del($id){
        if(!isset($id)||!is_numeric($id)){
            return json(['code'=>-1,"msg"=>'操作失败']);
            //$this->error("操作失败");
        }
        $modelPics=model('Pics');
        $result=$modelPics->where('aid',$id)->delete();
        if($result==1){
            return json(['code'=>1,"msg"=>'删除成功']);
            //$this->success("删除成功",'blog/Blogcate/lst','',2);
        }else{
            return json(['code'=>0,"msg"=>'删除失败']);
            //$this->error("删除失败");
        }
    }

    /**
     * 排序
     */
    public function setsort(){
        $cid=input('post.id');
        $sort=input("post.sort");
        $modelblogcate=model("Blogcate");
        $result=$modelblogcate->save([
            'sort'  => $sort,
        ],['cid' => $cid]);
       if($result==1){
           return json(['code'=>1,"msg"=>'更新成功']);
       }else{
           return json(['code'=>0,"msg"=>'更新失败']);
       }
    }

    //图片上传接口
    public function upimg(){
        // 这里要注意，这里需要和文件域的字段名一致
        $file = request()->file('upimg');

        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getSaveName();
                $data=[
                    "code"=>1,
                    "msg"=>"上传成功",
                    "src"=>$info->getSaveName()//这里的路径可以根据己的需求
                ];

            }else{
                // 上传失败获取错误信息
                //echo $file->getError();
                $data=[
                    "code"=>0,
                    "msg"=>$file->getError()
            ];
        }

            return json($data);//返回JSON格式数据
        }
    }
    //获取当前用户的分类列表
    private function getcates(){
        $user=db('user')->where('account',session("username"))->field("uid")->find();
        if(!$user){
            $this->error("操作异常");
        }
        $cate=db("Picscate")->where('uid',$user['uid'])->order("sort desc")->select();
        return $cate;
    }
	public function cate($cids="0"){
		if($cids=="0"){
			$res=db('user')->where('account',session('username'))->find();
		$cid=db('Picscate')->where('uid',$res['uid'])->find();
        $PicsModel = model('Pics');
        $pic=$PicsModel->where('cid',$cid['cid'])->order("addtime Desc")->select();	
		 $this->assign("pic",$pic);
		}else{
		 $PicsModel = model('Pics');
        $pic=$PicsModel->where('cid',$cids)->order("addtime Desc")->select();	
		 $this->assign("pic",$pic);
		}
		return view();
		
	}
}
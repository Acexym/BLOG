<?php
namespace app\blog\controller;
use app\common\controller\Base;
use app\common\validate\Blogcate as VlidateCate;
class Blogcate extends Base
{
    /**
     * 添加分类
     * @return \think\response\View
     */
    public function add(){
       if(request()->isPost()){
           $data=input('post.');
           $vali=new VlidateCate();
           if(!$vali->scene('add')->check($data)){
               $this->error($vali->getError());
           }
            //获取当前用户的id
           $res=db('user')->where('account',session('username'))->find();
           if(!$res){
               $this->error("添加失败",'blog/Blogcate/lst','',1);
           }
           $data['uid']=$res['uid'];        
           $modelBlogcate=model('Blogcate');
           $modelBlogcate->data($data);
           $result=$modelBlogcate->allowField(true)->save();
           if($result==1){
               $this->success("添加成功",'blog/Blogcate/lst','',1);
           }
           $this->error("添加失败",'blog/Blogcate/lst','',1);
       }
        return view();
    }
    /**
     * 分类列表
     * @return \think\response\View
     */
    public function lst(){
        $modelblogcate = model('Blogcate');
	  $res=db('user')->where('account',session('username'))->find();
	    
        // 查询数据集
        $res=$modelblogcate->where('uid',$res['uid'])->order('sort', 'desc')
            ->paginate(3);
//			dump($res);die;
        //分配单个变量到模板
        $this->assign('list',$res);
        return view();
    }
    /**
     * 编辑分类
     * @return \think\response\View
     */
    public function edit($cid=null){
//      $cid=input('cid');
        //当是POST提交来的数据，1：接收 2：更新入库
        $cateMode=model("Blogcate");
        if(request()->isPost()){
            $data=input('post.');
//            $cid=$data['cid'];
//            unset($data['cid']);
            //模中更新和新增都有save方法，更新方式如下
            //1. 为save方法新增第二个参数（更新条件），更新数据中，不能含有主键
            //2. 使用isUpdate将当前操作设置为更新操作。
            $result=$cateMode->isUpdate()->save($data);
            if($result!==false){
//                $this->success("更新成功",'lst');
                return json(["code"=>1,"msg"=>"更新成功"]);
            }
        }
        if($cid===null){
            $this->error("参数错误");
        }

        $result=$cateMode->where('cid', $cid)
            ->find();
        $this->assign('cate',$result);
        return view();
    }

    public function del($id){
        if(!isset($id)||!is_numeric($id)){
            return json(['code'=>-1,"msg"=>'操作失败']);
            //$this->error("操作失败");
        }
        $modelblogcat=model('Blogcate');
        $result=$modelblogcat->where('cid',$id)->delete();
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
	
}
?>
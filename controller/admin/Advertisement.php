<?php
namespace addons\qubit_score_mall\controller\admin;

class advertisement extends Base
{
    public function index()
    {
        if($this->request->isAjax()){
            return $this->model("advertisement")->where("pfid",PLATFORM_ID)->paginate($this->request->param("limit"))->each(function($d){
                $d['img'] = attach2url($d['img']);
                return $d;
            });
        }
        return $this->fetch();
    }
    
    public function form(){
        $model = $this->model("advertisement");
        if($this->request->isAjax()){
            $param = $this->request->param();
            $param['pfid']  = PLATFORM_ID;
            $status = "添加";
            if(!empty($param['id'])){
                $model = $model->isUpdate(true);
                $status = "编辑";
            }
            if($model->save($param)){
                return $this->success($status."成功");
            }else{
                return $this->error($status."失败");
            }
            
        }
        $this->assign("info",$this->model("advertisement")->where("id",$this->request->param("id"))->find());
        return $this->fetch();
    }
    
    public function delete(){
        if($this->model("advertisement")->where("id",$this->request->param("id"))->delete()){
            return $this->success("删除成功","");
        }else{
            return $this->error("删除失败","");
        }
    }
    
    public function chanage_status(){
        $model = $this->model("advertisement")->where("id",$this->request->param("id"));
        $data = $model->find();
        if($this->model("advertisement")->where("id",$this->request->param("id"))->update(['status'=>$data['status'] == 0 ? 1 : 0])){
            return $this->success("数据更新成功","");
        }else{
            return $this->error("数据更新失败","");
        }
    }
}
<?php
namespace addons\qubit_score_mall\controller\admin;

class Config extends Base
{
    public function index(){
        $model = $this->model("config");
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
        $this->assign("info",$this->model("config")->where("pfid",PLATFORM_ID)->find());
        return $this->fetch();
    }
}
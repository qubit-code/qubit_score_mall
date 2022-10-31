<?php
namespace addons\qubit_score_mall\controller\admin;

class User extends Base
{
    public function index()
    {
        if($this->request->isAjax()){
            return $this->model("fans")->with(['user'])->where("pfid",PLATFORM_ID)->paginate($this->request->param("limit"))->each(function($d){
                return $d;
            });
        }
        return $this->fetch();
    }
    
    public function blacklist()
    {
        $status = intval($this->request->param('status'));
        $status_str = $status == 1 ? "黑名单拉入" : "取消黑名单";
        if($this->model("fans")->where("id",$this->request->param("id"))->update(['status'=>$status])){
            return $this->success($status_str . "成功","");
        }else{
            return $this->error($status_str . "失败","");
        }
    }
}
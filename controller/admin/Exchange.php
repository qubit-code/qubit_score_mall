<?php
namespace addons\qubit_score_mall\controller\admin;

class Exchange extends Base
{
    public function index()
    {
        if($this->request->isAjax()){
            return $this->model("exchange")->where("pfid",PLATFORM_ID)->order("id desc")->paginate($this->request->param("limit"))->each(function($d){
                $d['consume_time_true'] = empty($d['consume_time']) ? "" : date("Y-m-d H:m:s",$d['consume_time']);
                return $d;
            });
        }
        return $this->fetch();
    }
    
    public function form(){
        $model = $this->model("exchange");
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
        $this->assign("info",$this->model("exchange")->where("id",$this->request->param("id"))->find());
        return $this->fetch();
    }
    
    public function delete(){
        if($this->request->param("keep") == "yes"){
            $commodity_id = $this->model("exchange")->where("id",$this->request->param("id"))->value("commodity_id");
            $this->model("commodity")->where("id",$commodity_id)->setInc("numbers");
        }
        if($this->model("exchange")->where("id",$this->request->param("id"))->delete()){
            return $this->success("删除成功","");
        }else{
            return $this->error("删除失败","");
        }
    }
    
    public function exchange(){
        // exit(dump($this->request->param("ids")))
        if($this->model("exchange")->where(["id"=>$this->request->param("ids")])->update(["consume_time"=>time()])){
            return $this->success("核销成功","");
        }else{
            return $this->error("核销失败","");
        }
    }
}
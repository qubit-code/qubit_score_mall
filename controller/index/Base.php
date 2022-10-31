<?php
namespace addons\qubit_score_mall\controller\index;

use addons\qubit_score_mall\Main;

class Base extends Main
{
    protected $ESA_TYPE     = "INDEX";
    
    public function __construct()
    {
        parent::__construct();
        if(!is_wechat()){
            $this->error("请用微信打开此链接","","",0);
        }
        $this->checkauth();
        $this->fans = $this->model("fans")->where("user_id",$this->auth->id)->find();
        if(empty($this->fans)){
            $insert = array(
                'pfid'      => PLATFORM_ID,
                'user_id'   => $this->auth->id,
                'nickname'  => $this->auth->nickname,
                'avatar'    => $this->auth->avatar,
                'create_time'   => time(),
            );
            $id = $this->model("fans")->insertGetId($insert);
            $this->fans = $this->model("fans")->where("id",$id)->find();
        }
        $this->assign("controller",$this->controller);
    }
}
<?php
namespace addons\qubit_score_mall\controller\index;

class User extends Base
{
    public function index()
    {
        $config = get_addon_config(".");
        $this->site_title = $config['basics']['title'];
        $fans = $this->model("fans")->where("pfid",PLATFORM_ID)->where("user_id",$this->auth->id)->find();
        $this->assign("fans",$fans);
        $this->assign("config",$config);
        return $this->fetch();
    }
}
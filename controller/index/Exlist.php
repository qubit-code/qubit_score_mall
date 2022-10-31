<?php
namespace addons\qubit_score_mall\controller\index;

class Exlist extends Base
{
    public function index()
    {
        $config = get_addon_config(".");
        $this->site_title = $config['basics']['title'];
        // exit(dump($config));
        $list = $this->model("exchange")->where("pfid",PLATFORM_ID)->where("user_id",$this->auth->id)->order("create_time desc")->select();
        $this->assign("list",$list);
        $this->assign("config",$config);
        return $this->fetch();
    }
}
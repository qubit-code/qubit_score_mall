<?php
namespace addons\qubit_score_mall;

use ESA\Addons;

class Main extends Addons
{
    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        return true;
    }
    
    /**
     * 功能入口方法
     * @return bool
     */
    public function entrance(){
        return [
            [
                "title" => "积分商城首页",
                "url"   => esaurl("index.index/index","",".html",true)
            ],
        ];
    }
    
    public function model($model){
        $models = [
            "advertisement"        => "\addons\qubit_score_mall\model\Advertisement",
            "exchange"     => "\addons\qubit_score_mall\model\Exchange",
            "base"      => "\addons\qubit_score_mall\model\Base",
            "data"      => "\addons\qubit_score_mall\model\Data",
            "fans"      => "\addons\qubit_score_mall\model\Fans",
            "commodity" => "\addons\qubit_score_mall\model\Commodity",
            "config"    => "\addons\qubit_score_mall\model\Config",
        ];
        return model($models[$model]);
    }
}
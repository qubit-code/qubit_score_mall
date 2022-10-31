<?php
namespace addons\qubit_score_mall\model;

use think\Model;

class Data extends Model {
    // 设置数据表（不含前缀）
    protected $name = 'qubit_score_mall_data';

    // 开启时间自动写入
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    // 自动完成
    protected $auto       = [];
    protected $insert     = [];
    protected $update     = [];

}
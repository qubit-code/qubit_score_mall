<?php
namespace addons\qubit_score_mall\controller\admin;

use addons\qubit_score_mall\Main;

class Base extends Main
{
    protected $ESA_TYPE     = "ADMIN";
    
    public function __construct()
    {
        parent::__construct();
        $this->checkauth();
    }
}
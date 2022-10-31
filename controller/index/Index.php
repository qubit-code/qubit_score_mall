<?php
namespace addons\qubit_score_mall\controller\index;

use think\Db;

class Index extends Base
{
    public function index()
    {
        $config = get_addon_config(".");
        $this->site_title = $config['basics']['title'];
        $ecode = $this->request->param("ecode");
        if(!empty($ecode) && ($this->fans['share_count'] < $config['basics']['top'] || empty($config['basics']['top'])) && !empty($config['basics']['num'])){
            $from_user = str_replace("qubit_score_mall_","",base64_decode($ecode));
            $data = $this->model("data")->where("pfid",PLATFORM_ID)->where("from_user",$from_user)->where("to_user",$this->auth->id)->find();
            if(empty($data)){
                $from_user_info = model("user")->where("id",$from_user)->find();
                $insert = [
                    "pfid"          => PLATFORM_ID,
                    "from_user"     => $from_user,
                    "to_user"       => $this->auth->id,
                    "from_avatar"   => $from_user_info['avatar'],
                    "from_nickname" => $from_user_info['nickname'],
                    "share_score_num"   => $config['basics']['num'],
                    "view_num"      => 1,
                    "ip"            => $this->request->ip(),
                    "create_time"   => time(),
                ];
                if($this->model("data")->insert($insert)){
                    user_numeral($this->auth->id, "score", $config['basics']['num'], "积分商城分享: 获得{$config['basics']['num']}积分");
                    $this->model("fans")->where("user_id",$this->auth->id)->setInc("share_count");
                }
            }else{
                $this->model("data")->where("pfid",PLATFORM_ID)->where("from_user",$from_user)->where("to_user",$this->auth->id)->setInc("view_num");
            }
        }
        $list = $this->model("commodity")->where("pfid",PLATFORM_ID)->where("status",1)->select();
        $ad_list = $this->model("advertisement")->where("pfid",PLATFORM_ID)->where("status",1)->select();
        $this->assign("fans",$this->fans);
        $this->assign("list",$list);
        $this->assign("ad_list",$ad_list);
        $this->assign("config",$config);
        return $this->fetch();
    }
    
    public function get(){
        $id = $this->request->param("id");
        $name = $this->request->param("name");
        $tel = $this->request->param("tel");
        $addr = $this->request->param("addr");
        
        $commodity = $this->model("commodity")->where("pfid",PLATFORM_ID)->where("id",$id)->find();
        if(empty($commodity)){
            $this->error("该商品不存在！");
        }
        if($commodity['numbers'] <= 0){
            $this->error("还是完了一步，该商品已全部被兑换！");
        }
        if($this->auth->score == 0){
            $this->error("该用户还未获得积分，分享给好友或者朋友圈可获得积分！");
        }
        if($this->auth->score < $commodity['integrals']){
            $this->error("积分不够，无法兑换！");
        }
        if($this->fans->status){
            $this->error("您已光荣的被拉入黑名单！");
        }
        
        $score = $this->auth->score;
        
        $status = false;
        Db::startTrans();
        try {
            $user_info = [
                "name" => $name,
                "tel" => $tel,
                "addr" => $addr,
            ];
            $status = $this->model("fans")->where('user_id',$this->auth->id)->update($user_info);
            $awarddata = array(
                'pfid'              => PLATFORM_ID,
                'user_id'           => $this->auth->id,
                'name'              => $name,
                'tel'               => $tel,
                'addr'              => $addr,
                'nickname'          => $this->auth->nickname,
                'avatar'            => $this->auth->avatar,
                'commodity_id'      => $commodity['id'],
                'commodity_title'   => $commodity['title'],
                'commodity_integrals' => $commodity['integrals'],
                'commodity_img'     => $commodity['img'],
                'commodity_status'  => $commodity['status'],
                'create_time'       => time(),
            );
            $this->model("exchange")->insert($awarddata);
            $this->model("commodity")->where("id",$commodity['id'])->setDec("numbers");
            user_numeral($this->auth->id, "score", -$commodity['integrals'], "礼品兑换: {$commodity['title']} 消耗{$commodity['integrals']}积分");
            $status = true;
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            
        }
        return $status ? $this->success("兑换成功","") : $this->error("兑换失败","");
        // if(user_numeral($this->auth->id, "score", -$commodity['integrals'], "礼品兑换: {$commodity['title']} 消耗{$commodity['integrals']}积分")){
        //     $user_info = [
        //         "name" => $name,
        //         "tel" => $tel,
        //         "addr" => $addr,
        //     ];
        //     $this->model("fans")->where('user_id',$this->auth->id)->update($user_info);
        //     $awarddata = array(
        //         'pfid'              => PLATFORM_ID,
        //         'user_id'           => $this->auth->id,
        //         'name'              => $name,
        //         'tel'               => $tel,
        //         'addr'              => $addr,
        //         'nickname'          => $this->auth->nickname,
        //         'avatar'            => $this->auth->avatar,
        //         'commodity_id'      => $commodity['id'],
        //         'commodity_title'   => $commodity['title'],
        //         'commodity_integrals' => $commodity['integrals'],
        //         'commodity_img'     => $commodity['img'],
        //         'commodity_status'  => $commodity['status'],
        //         'create_time'       => time(),
        //     );
        //     if($this->model("exchange")->insert($awarddata)){
        //         return $this->success("兑换成功","");
        //     }else{
        //         return $this->error("兑换失败","");
        //     }
        // }
    }
}
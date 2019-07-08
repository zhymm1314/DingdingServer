<?php
/**
 * Created by PhpStorm.
 * User: 'zhping'
 * Date: 2019/6/25 0025
 * Time: 10:03
 */

namespace dingding\server;

use dingding\DingdingApi;

class Department extends DingdingConfig
{

    public $access_token = [] ;

    public function __construct($authCorpid)
    {
        parent::__construct();
        //$authCorpid =  $this->getAuthCorpid();
        $this->access_token = DingdingApi::getCorpTokenByService($authCorpid);
    }

    /**
     * 获取部门信息
     * @param $userid 用户id
     * @return bool|string
     */
    public function getList($fetch_chlid,$id)
    {

        $url = $this->getDingDingUrl()."department/list?";
        $url .= 'access_token='.$this->access_token;
        $url .= '&fetch_chlic='.$fetch_chlid;
        $url .= '&id='.$id;
        $data = curlGet($url);
        if (empty($data)) {
            return $data = '无返回数据';
        }
        return $data;
    }


    /**
     * @获取子部门
     * @param $id 部门id
     */
    public function getListIds($id)
    {
        $url = $this->getDingDingUrl()."department/list_ids?";
        $url .= 'access_token='.$this->access_token;
        $url .= '&id='.$id;
        $data = curlGet($url);
        if (empty($data)) {
            return $data = '无返回数据';
        }
        return $data;
    }

    /**
     * @获取部门详情
     * @param $id 部门id
     * @return bool|string
     */
    public function getInfo($id)
    {
        $url = $this->getDingDingUrl()."department/get?";
        $url .= 'access_token='.$this->access_token;
        $url .= '&id='.$id;
        $data = curlGet($url);
        if (empty($data)) {
            return $data = '无返回数据';
        }
        return $data;
    }



}
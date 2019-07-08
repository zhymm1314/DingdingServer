<?php
/**
 * Created by PhpStorm.
 * User: 'zhping'
 * Date: 2019/6/25 0025
 * Time: 10:03
 */

namespace dingding\server;

use dingding\DingdingApi;

class Auth extends DingdingConfig
{

    public $access_token = [] ;

    public function __construct($authCorpid)
    {
        parent::__construct();
        $authCorpid =  $this->getAuthCorpid();
        $this->access_token = DingdingApi::getCorpTokenByService($authCorpid);
    }


    /**
     * @获取通讯录权限范围
     * @param $id 部门id
     * @return bool|string
     */
    public function getScopes()
    {
        $url = $this->getDingDingUrl()."auth/scopes?";
        $url .= 'access_token='.$this->access_token;
        $data = curlGet($url);
        if (empty($data)) {
            return $data = '无返回数据';
        }
        return $data;
    }



}
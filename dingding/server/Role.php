<?php
/**
 * Created by PhpStorm.
 * User: 'xHai'
 * Date: 2019/6/25 0025
 * Time: 14:37
 */

namespace dingding\server;
use dingding\DingdingApi;


class Role extends DingdingConfig

{
    //企业token值
    private $access_token;

    //获取当前组织的调用凭证
    public function __construct($auth_corpid)
    {
        $this->access_token = DingdingApi::getCorpTokenByService($auth_corpid);
//        p($this->access_token);
    }

    //简单的处理数组
    private function _ok($url)
    {
        $res = curlGet($url);
        $data =json_decode($res,true);
        return $data;
    }

    //获取角色列表
    public function list($limit,$page)
    {
        $url = $this->getdingDingUrl()."topapi/role/list?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&size='.$limit;
        $url.= '&offset='.$page;
        $data = $this->_ok($url);
        return $data;
    }

    //获取角色下的员工列表
    public function simplelist($role_id,$limit,$page)
    {
        $url = $this->getdingDingUrl()."topapi/role/simplelist?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&size='.$limit;
        $url.= '&offset='.$page;
        $url.= '&role_id='.$role_id;
        $data = $this->_ok($url);
        return $data;
    }

    //获取角色组
    public function getrolegroup($group_id)
    {
        $url = $this->getdingDingUrl()."topapi/role/getrolegroup?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&group_id='.$group_id;
        $data = $this->_ok($url);
        return $data;
    }

    //获取角色详情
    public function getrole($roleId)
    {
        $url = $this->getdingDingUrl()."topapi/role/getrole?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&roleId='.$roleId;
        $data = $this->_ok($url);
        return $data;
    }


}
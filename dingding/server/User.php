<?php
/**
 * Created by PhpStorm.
 * User: 'xHai'
 * Date: 2019/6/24 0024
 * Time: 17:36
 */

namespace dingding\server;
use dingding\DingdingApi;

class User extends DingdingConfig
{
    //企业token值
    public $access_token;

    //获取当前组织的调用凭证
    public function __construct($auth_corpid)
    {
        parent::__construct();
        $this->access_token = DingdingApi::getCorpTokenByService($auth_corpid);
        //p($this->access_token);
    }

    //简单的处理数组
    private function _ok($url)
    {
        $res = curlGet($url);
        $data =json_decode($res,true);
        return $data;
    }

    //获取用户详情信息
    public function get($userid)
    {
        $url = $this->getdingDingUrl()."user/get?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&userid='.$userid;
        $data = $this->_ok($url);
        return $data;
    }

    //获取部门用户userid列表
    public function getDeptMember($deptId)
    {
        $url = $this->getdingDingUrl()."user/getDeptMember?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&deptId='.$deptId;
        $data = $this->_ok($url);
        //p($url);
        return $data;
        //return $data['userIds'];
    }

    //获取部门用户
    public function simpleList($deptId,$limit,$page)
    {
        $url = $this->getdingDingUrl()."user/simplelist?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&size='.$limit;
        $url.= '&offset='.$page;
        $url.= '&department_id='.$deptId;
        $data = $this->_ok($url);
        return $data;
        //return $data['userlist'];
    }

    //获取部门用户详情
    public function listbypage($deptId,$limit,$page)
    {
        $url = $this->getdingDingUrl()."user/listbypage?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&size='.$limit;
        $url.= '&offset='.$page;
        $url.= '&department_id='.$deptId;
        $data = $this->_ok($url);
        return $data;
        //return $data['userlist'];
    }

    //获取管理员列表
    public function get_admin()
    {
        $url = $this->getdingDingUrl()."user/get_admin?";
        $url.= 'access_token='.$this->access_token;
        $data = $this->_ok($url);
        return $data;
        //return $data['admin_list'];
    }

    //获取管理员通讯录权限范围
    public function get_admin_scope($userid)
    {
        $url = $this->getdingDingUrl()."topapi/user/get_admin_scope?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&userid='.$userid;
        $data = $this->_ok($url);
        return $data;
        //return $data['dept_ids'];//可管理的部门id列表
    }

    //查询管理员是否具备管理某个应用的权限
    //应用必须是ISV所开发，且管理员所在组织开通了此应用。
    public function can_access_microapp($userid)
    {
        $url = $this->getdingDingUrl()."user/can_access_microapp?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&appId='.$this->appIdTest;
        $url.= '&userId='.$userid;
        $data = $this->_ok($url);
        return $data;
        //return $data['canAccess'];
    }

    //根据unionid获取userid
    public function getUseridByUnionid($unionid)
    {
        $url = $this->getdingDingUrl()."user/getUseridByUnionid?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&unionid='.$unionid;
        $data = $this->_ok($url);
        return $data;
    }

    //根据unionid获取userid
    public function get_org_user_count($onlyActive)
    {
        $url = $this->getdingDingUrl()."user/get_org_user_count?";
        $url.= 'access_token='.$this->access_token;
        $url.= '&onlyActive='.$onlyActive;
        $data = $this->_ok($url);
        return $data;
        //return $data['count'];
    }


}
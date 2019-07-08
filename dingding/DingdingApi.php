<?php
/**
 * Created by PhpStorm.
 * User: 'xHai'
 * Date: 2019/6/24 0024
 * Time: 17:05
 */

namespace dingding;

use dingding\server\Role;
use dingding\server\Auth;
use dingding\server\Service;
use dingding\server\User;
use dingding\server\Department;
use dingding\server\Oauth2;


class DingdingApi
{
    /*
     * 获取企业授权信息
     * $auth_corpid 用户企业唯一corpid
     */
     public static function getAuthInfoByService($auth_corpid)
    {
        return (new Service())->getAuthInfo($auth_corpid);
    }

    /*
     * 获取企业凭证
     * $auth_corpid 用户企业唯一corpid
     */
     public static function getCorpTokenByService($auth_corpid)
    {
        return (new Service())->getCorpToken($auth_corpid);
    }



/***
   |-----------------------------------------------------------
   | 钉钉用户接口begin
   |-----------------------------------------------------------
*/
    /*
     * 获取授权应用信息
     * 参数auth_corpid=>授权企业方corpid
     */
    public static function getAgentService($auth_corpid)
    {
        return (new Service())->getAgent($auth_corpid);
    }

    /**
     * @获取用户详情信息
     * @param $auth_corpid 用户企业唯一corpid（一般在我们数据库中获取）
     * @param $userid   员工id
     * @return array
     */
    public static function getByUser($auth_corpid,$userid)
    {
        return (new User($auth_corpid))->get($userid);
    }


    /**
     * @获取部门用户userid列表
     * @【推荐使用】通过该接口，可以获取当前部门下的userid列表！！！！！！！！！！！！！！！！！！！！！！！！！！！！！
     * @param $auth_corpid 用户企业唯一corpid（一般在我们数据库中获取）
     * @param $deptId   部门id/或者角色id
     * @return array
     */
    public static function getDeptMemberByUser($auth_corpid,$deptId)
    {
        return (new User($auth_corpid))->getDeptMember($deptId);
    }

    /**
     * @获取部门用户(列表排序方式的参数暂时不加，使用默认的按拼音排序)
     * @param $auth_corpid
     * @param $department_id 部门id 注：只能部门id 部门id(1代表根部门)
     * @param int $limit
     * @param int $page
     * @return bool|string
     */
    public static function getSimpleListByUser($auth_corpid,$department_id,$limit=15,$page=1)
    {
        return (new User($auth_corpid))->simpleList($department_id,$limit,$page);
    }

    /**
     * @获取部门用户详情(列表排序方式的参数暂时不加，使用默认的按拼音排序)
     * @param $auth_corpid
     * @param $deptId 部门id 注：只能部门id 部门id(1代表根部门)
     * @param int $limit
     * @param int $page
     * @return mixed
     */

    public static function getListByPageByUser($auth_corpid,$department_id,$limit=15,$page=1)
    {
        return (new User($auth_corpid))->listbypage($department_id,$limit,$page);
    }

    /**
     * @获取管理员列表
     * @param $auth_corpid
     * @return sys_level	管理员角色，1:主管理员，2:子管理员
     * @return userid	员工id
     */
    public static function getAdminByUser($auth_corpid)
    {
        return (new User($auth_corpid))->get_admin();
    }

    /**
     * @获取管理员通讯录权限范围
     * @param $auth_corpid
     * @param $userid 管理员id
     * @return 可管理的部门id列表
     */
    public static function getAdminScopeByUser($auth_corpid,$userid)
    {
        return (new User($auth_corpid))->get_admin_scope($userid);
    }

    /**
     * @查询管理员是否具备管理某个应用的权限
     * @应用必须是ISV所开发，且管理员所在组织开通了此应用。
     * @param $auth_corpid
     * @param $userid
     * @return 返回1或者0
     */
    public static function getCanAccessMicoappByUser($auth_corpid,$userid)
    {
        return (new User($auth_corpid))->can_access_microapp($userid);
    }

    /**
     * @根据unionid获取userid
     * @param $auth_corpid
     * @param $unionid
     * @return $userid
     */
    public static function getUserIdByUnionIdByUser($auth_corpid,$unionid)
    {
        return (new User($auth_corpid))->getUseridByUnionid($unionid);
    }

    /**
     * @获取企业员工人数
     * @param $auth_corpid  企业corpid
     * @param $onlyActive   0：包含未激活钉钉的人员数量
     *                      1：不包含未激活钉钉的人员数量
     * @return number 企业员工人数
     */
    public static function getOrgUserCountByUser($auth_corpid,$onlyActive=1)
    {
        return (new User($auth_corpid))->get_org_user_count($onlyActive);
    }

/*
   |-----------------------------------------------------------
   | 钉钉用户接口end
   |-----------------------------------------------------------
*/


/***
   |-----------------------------------------------------------
   | 钉钉用户接口begin
   |-----------------------------------------------------------
*/
    /**
     * @获取角色列表
     * @param $auth_corpid 企业corpid
     * @param int $limit 分页大小
     * @param int $page 第几页
     * @return /hasMore 是否还有更多数据/name 角色组名称 /groupId 角色组id /id 角色id
     */
    public static function getListByRole($auth_corpid,$limit=15,$page=1)
    {
        return (new Role($auth_corpid))->list($limit,$page);
    }

    /**
     * @获取角色下的员工列表
     * @param $auth_corpid 企业corpid
     * @param $role_id 角色id
     * @param int $limit 分页大小
     * @param int $page 第几页
     * @return array /hasMore 是否还有更多数据/name 角色组名称 /id 角色id/nextCursor 下次拉取数据的游标
     */
    public static function getSimpleListByRole($auth_corpid,$role_id,$limit=15,$page=1)
    {
        return (new Role($auth_corpid))->simplelist($role_id,$limit,$page);
    }

    /**
     * @获取角色组
     * @param $auth_corpid
     * @param $group_id 角色组的Id
     * @return array
     */
    public static function getRoleGroupByRole($auth_corpid,$group_id)
    {
        return (new Role($auth_corpid))->getrolegroup($group_id);
    }

    /**
     * @获取角色详情
     * @param $auth_corpid
     * @param $roleId 角色Id
     * @return mixed
     */
    public static function getRoleByRole($auth_corpid,$roleId)
    {
        return (new Role($auth_corpid))->getrole($roleId);
    }

/*
   |-----------------------------------------------------------
   | 钉钉用户接口end
   |-----------------------------------------------------------
*/


/***
   |-----------------------------------------------------------
   | 钉钉获取部门接口begin
   |-----------------------------------------------------------
*/
    /**
     * @获取部门列表
     * @param $auth_corpid
     * @return mixed 获取企业部门列表
     */
    public static function getListByDepartment($auth_corpid='',$fetch_chlid=false,$id=1)
    {
        return (new Department($auth_corpid))->getList($fetch_chlid,$id);
    }


    /**
     * @获取子部门ID列表
     * @param string $auth_corpid
     * @return mixed
     */
    public static function getListIdsByDepartment($auth_corpid='',$id)
    {
        return (new Department($auth_corpid))->getListIds($id);
    }


    /**
     * @获取部门详情
     * @param string $auth_corpid
     * @param $id 部门id
     */
    public static function getInfoByDepartment($auth_corpid='',$id)
    {
        return (new Department($auth_corpid))->getInfo($id);
    }


/***
|-----------------------------------------------------------
| 获取通讯录权限范围
|-----------------------------------------------------------
 */

    public static function getScopesByAuth($auth_corpid='')
    {
        return (new Auth($auth_corpid))->getScopes();
    }




/***
|-----------------------------------------------------------
| [第三方登录]
|-----------------------------------------------------------
 */
    /**
     * @第三方登录，账号密码登录，构建跳转连接 
     * @return bool|string
     */
    public static function getSnsAuthorizeByOauth2()
    {
        return (new Oauth2())->getSnsAuthorize();
    }


    /**
     * @ 构造扫码登录页面
     * @ 直接使用钉钉提供的扫码登录页面
     * @return bool|string
     */
    public static function getQrconnectByOauth2()
    {
        return (new Oauth2())->getQrconnect();
    }

    /**
     * @ 服务端通过临时授权码获取授权用户的个人信息
     * @param $code 临时授权码
     * @return bool|string
     */
    public function getuserinfoBycodeByOauth2($code)
    {
        return (new Oauth2())->getuserinfoBycode($code);
    }



}
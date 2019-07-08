<?php
namespace dingding\server;
use dingding\YacRedisApi;
use yacredis\YacRedis;


/**
 * 测试
 * Time: 2019.06.14
 * 66
 */
class Service extends DingdingConfig
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
    *  获取企业凭证
    *  参数auth_corpidJSON格式  例如：{"auth_corpid":"auth_corpid_value"}
     * 返回值 access_token 授权方（企业）token ,expires_in 超时时间
     */
    public function getCorpToken($auth_corpid)
    {
        //token值
        $nowToken = YacRedis::getYacRedisByApi($auth_corpid);

        //不存在token,再去请求获取
        if(!$nowToken){
            //获取token
            $sign = ddSign($this->getsuiteTicket(),$this->getSuiteSecret());
            $url = $this->getDingDingUrl()."service/get_corp_token?";
            $url.= 'signature='.$sign['signature'].'&timestamp='.$sign['timestamp'].'&suiteTicket='.$sign['suiteTicket'];
            $url.= '&accessKey='.$this->getAccessKey();
            $now = curlPost($url,["auth_corpid"=>$auth_corpid]);

            //将token存入缓存
            $nows = json_decode($now,true);
            YacReidsApi::setYacRedisByApi($auth_corpid,$nows['access_token'],5400);
            $nowToken = $nows['access_token'];
        }
        return $nowToken;
    }

    /**
     *  获取企业授权信息
     */
    public function getAuthInfo($auth_corpid)
    {
        //$auth_corpid  =$this->authCorpid;
        $sign = ddSign($this->getsuiteTicket(),$this->getsuiteSecret());
        $url = $this->getdingDingUrl()."/service/get_auth_info?";
        $url.= 'signature='.$sign['signature'].'&timestamp='.$sign['timestamp'].'&suiteTicket='.$sign['suiteTicket'];
        $url.= '&accessKey='.$this->getAccessKey();
        $test = curlPost($url,["auth_corpid"=>$auth_corpid]);
        return $test;

    }

    /**
     * 获取授权应用信息
     */
    public function getAgent($auth_corpid)
    {
        $test =  json_decode($this->getAuthInfo($auth_corpid),true);
        $agentid = $test['auth_info']['agent'][0]['agentid'];
        $suite_key = $this->getaccessKey();
        $arr = [
            "auth_corpid"=> $auth_corpid,  //授权企业方corpid
            "suite_key"=>$suite_key,  //应用套件key
            "agentid"=>$agentid   //授权企业方应用id
        ];
        $sign = ddSign($this->getSuiteTicket(),$this->getSuiteSecret());
        $url = "https://oapi.dingtalk.com/service/get_agent?";
        $url.= 'signature='.$sign['signature'].'&timestamp='.$sign['timestamp'].'&suiteTicket='.$sign['suiteTicket'];
        $url.= '&accessKey='.$suite_key;
        $test = curlPost($url,$arr);
        return $test;
    }
}






<?php
/**
 * Created by PhpStorm.
 * User: 'xHai'
 * Date: 2019/6/24 0024
 * Time: 15:22
 */

namespace dingding;

use dingding\config\ConfigTest;
abstract class DingdingConfig
{

    protected $object;

//    public  function  __call($method, $arguments)
//    {
//        $method = "_$method"; // 在要调用的方法名前加‘_’，$method为要调用的方法名
//        $return = call_user_func_array(array($this, $method), $arguments);
//        $data = json_decode($return,true);
//        return $data;
//    }

    public function __construct()
    {
        $url = $_SERVER['HTTP_HOST'];
        $config =  config('dingdingconfig');

        if (empty($config)) {
            return $data = '请在urlconfig添加自适应接口相关参数';
        }

        $redis = YacRedisApi::redisApi();
        $ConfigValue =  $redis->get($url);
        if (!empty($ConfigValue)) {
            $this->object = $ConfigValue;
        } else {
            foreach ($config as $key=>$value) {
                if ('ConfigTest' == $value['dingdingconfig']) {
                    $this->object = (new ConfigTest());
                    $redis->set($url,(new ConfigTest()));
                }

                if ('ConfigTest' == $value['dingdingconfig']) {
                    $this->object = (new ConfigTest());
                    $redis->set($url,(new ConfigTest()));
                }
            }
        }


    }


    /**
     * 钉钉开放的api总地址
     * @return string
     */
    public function getDingDingUrl()
    {
       return $this->object->dingDingUrl;
    }

    /**
     * 钉钉推送的suiteTicket。测试应用可以随意填写
     * @return string
     */
    public function getSuiteTicket()
    {
        return $this->object->suiteTicket;
    }

    /**
     * 签名秘钥
     * @return string
     */
    public function getSuiteSecret()
    {
        return $this->object->suiteSecret;
    }


    /**
     * @return string
     */
    public function getAccessKey()
    {
        return $this->object->accessKey;
    }

    /**
     * 客户组织corpid 测试用！！！
     * @return string
     */
    public function getAuthCorpid()
    {
        return $this->object->authCorpid;
    }


    /**
     * 登录APPID
     * @return string
     */
    public function getAppId()
    {
        return $this->object->appId;
    }


    /**
     * 登录appSecret
     * @return string
     */
    public function getAppSecret()
    {
        return $this->object->appSecret;
    }

    /**
     * @登录跳转地址
     * @return mixed
     */
    public function getRedirectUri()
    {
        return $this->object->redirect_uri;
    }



}
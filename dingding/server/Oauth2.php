<?php
/**
 * Created by PhpStorm.
 * User: 'zhping'
 * Date: 2019/6/25 0025
 * Time: 10:03
 */

namespace dingding\server;

use dingding\DingdingApi;

class Oauth2 extends DingdingConfig
{

    public $access_token = [] ;

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @构造要跳转的链接 & 网站将钉钉登录二维码内嵌到自己页面中
     * @return bool|string
     */
    public function getSnsAuthorize()
    {
        $url = $this->getDingDingUrl();
        $url .='connect/oauth2/sns_authorize?';
        $url .='appid='.$this->getAppId().'&response_type=code&scope=snsapi_login&state=STATE&redirect_uri='.$this->getRedirectUri();
        return $url;
    }

    /**
     * @ 构造扫码登录页面
     * @ 直接使用钉钉提供的扫码登录页面
     * @return bool|string
     */
    public function getQrconnect(){
        $url = $this->getDingDingUrl();
        $url .='/connect/qrconnect?';
        $url .='appid='.$this->getAppId().'&response_type=code&scope=snsapi_login&state=STATE&redirect_uri='.$this->getRedirectUri();
        return $url;
    }

    /**
     * @ 服务端通过临时授权码获取授权用户的个人信息
     * @param  $code 临时授权码
     * @return bool|string
     */
    public function getuserinfoBycode($code)
    {
        // 根据timestamp, appSecret计算签名值
         //毫秒
        list($msec, $sec) = explode(' ', microtime());
        $timestamp = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        $appSecret = $this->getAppSecret();
        $s = hash_hmac('sha256', $timestamp, $appSecret, true);
        $sign = urlencode(base64_encode($s));
        $url = $this->getdingDingUrl().'sns/getuserinfo_bycode';
        $url .= '?accessKey=' . $this->getAppId();
        $url .= '&timestamp=' . $timestamp;
        $url .= '&signature=' . $sign;
        $test = curlPost($url, ['tmp_auth_code' => $code]);
        return $test;
    }



}
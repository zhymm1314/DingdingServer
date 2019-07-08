<?php
/**
 * Created by PhpStorm.
 * User: 'zhping'
 * Date: 2019/6/25 0025
 * Time: 14:37
 */

namespace dingding\config;

class ConfigMaster
{

    //--------------------------------------------------------------------------------------------------------------------------------------------------|
    //---测试参数--------------------------------------------------------------------------------------------------------------------------------------- |
    //--------------------------------------------------------------------------------------------------------------------------------------------------|
    //--------------------------------------------------------------------------------------------------------------------------------------------------|

    //钉钉开放的api总地址
    public $dingDingUrl = 'https://oapi.dingtalk.com/';

    //钉钉推送的suiteTicket。测试应用可以随意填写
    public $suiteTicket = 'cs';

    //签名秘钥
    public $suiteSecret = 'tfgg16i4wCZX0UYeuGLUS9Vu_a79n_A1-clh9Sxah9B0wakDDIlnhJhLOz_rQAjR';


    public $accessKey = 'suite3dfpfklzardtmxmv';

    //客户组织corpid 测试用！！！
    public $authCorpid = 'ding1173100482c0bcc835c2f4657eb6378f';


    //---------------------------------
    //登录相关参数---------------------
    //--------------------------------

    // appId
    public $appId = 'dingoapfn3zfggxhmrkctp';

    // appSecret
    public $appSecret = '3xZOeXCNHKzjI3TTKyORVN0TRkWynth_uUyGLZSzGtGFk9Ti6JKRcDQvPzgFdG5E';

    //回调地址
    //redirect_uri
    public $redirect_uri = 'http://test.zc.halopay.cn/CallbackUrlTest/test';
}
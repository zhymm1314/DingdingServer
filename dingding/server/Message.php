<?php
/**
 * Created by PhpStorm.
 * User: 'zhping'
 * Date: 2019/6/25 0025
 * Time: 10:03
 */

namespace dingding\server;

use dingding\DingdingApi;

class Message extends DingdingConfig
{

    public $access_token = [] ;

    public $content =[];
    public function __construct($authCorpid)
    {
        parent::__construct();
        $authCorpid =  $this->getAuthCorpid();
        $this->access_token = DingdingApi::getCorpTokenByService($authCorpid);
    }


    /**
     * @消息内容，消息类型和样例可参考“消息类型与数据格式”文档。最长不超过2048个字节
     * @return $this
     */
    public function sendMsg($msg)
    {
        $this->content['msg'] = $msg;
        return $this;
    }

    /**
     * @企业内部应用是应用agentId，第三方企业应用是获取授权信息接口中返回的agentId
     * @return $this
     */
    public function sendAgentId($agent_id)
    {
        $this->content['agent_id'] = $agent_id;
        return $this;
    }

    /**
     * @接收者的用户userid列表，最大列表长度：20
     * @return $this
     */
    public function sendUser($userid_list)
    {
        $this->content['userid_list'] = $userid_list;
        return $this;
    }

    /**
     * @接收者的部门id列表，最大列表长度：20,  接收者是部门id下(包括子部门下)的所有用户
     * @return $this
     */
    public function sendDept($dept_id_list)
    {
        $this->content['dept_id_list'] = $dept_id_list;
        return $this;
    }

    /**
     * @return $this
     */
    public function send()
    {
        $url  = $this->getDingDingUrl();
        $url .= '/topapi/message/corpconversation/asyncsend_v2?access_token=';
        $url .= $this->access_token;
        curlPost($url,$this->content);
        return $this;
    }



}
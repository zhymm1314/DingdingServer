<?php
/**
 * Created by PhpStorm.
 * User: 'chensha'
 * Date: 2019/6/14 0014
 * Time: 10:56
 */

namespace dingding;


use dingding\server\Message;

class DingdingChainApi
{

    /***
    |-----------------------------------------------------------
    | 工作通知消息
    |-----------------------------------------------------------
     */

    public $value;
    public $message;


    public function __construct($authCorpid)
    {
        $this->message = (new Message($authCorpid));
    }

    /**
     * @企业内部应用是应用agentId，第三方企业应用是获取授权信息接口中返回的agentId
     * @param $agent_id
     * @return $this
     */
    public function sendAgentIdByMessage($agent_id)
    {
        $this->message->sendAgentId($agent_id);
        return $this;
    }

    /**
     * @消息内容，消息类型和样例可参考“消息类型与数据格式”文档。最长不超过2048个字节
     * @return $this
     */
    public function sendMsgByMessage($msg)
    {

        $this->message->sendMsg($msg);
        return $this;
    }

    /**
     * @接收者的用户userid列表，最大列表长度：20
     * @return $this
     */
    public function sendUserByMessage($userid_list)
    {

        $this->message->sendUser($userid_list);
        return $this;
    }

    /**
     * @接收者的部门id列表，最大列表长度：20,  接收者是部门id下(包括子部门下)的所有用户
     * @return $this
     */
    public function sendDeptByMessage($dept_id_list)
    {
        $this->message->sendDept($dept_id_list);
        return $this;
    }

    /**
     * @执行步骤
     * @return $this
     */
    public function sendByMessage()
    {
        $this->message->send();
        return $this;
    }






}
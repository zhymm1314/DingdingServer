<?php
/**
 * Created by PhpStorm.
 * User: 'xHai'
 * Date: 2019/7/8 0008
 * Time: 9:53
 */

namespace dingding;

use yacredis\YacRedis;
use redis\Redis;

class YacRedisApi
{
    /**
     * 取值(和上面的一样，但是命名更加的简单！)
     * @param $key
     * @param int $select 选择的redis库（注：不填默认是0号库）
     * @return array|mixed
     */
    public static function get($key,$select=0)
    {
        return (new YacRedis())->getYacRedis($key,$select);
    }

    /**
     * 取值(和上面的一样，但是命名更加的简单！)
     * @param $key
     * @param $value
     * @param int $timeout  过期时间
     * @param int $select 选择的redis库（注：不填默认是0号库）
     * @return array|mixed
     */
    public static function set($key,$value,$timeout=0,$select=0)
    {
        return (new YacRedis())->setYacRedis($key,$value,$timeout,$select);
    }

    /**
     * @return Redis
     */
    public static function RedisApi()
    {
        return new Redis();
    }
}
<?php
namespace App\Lib\Redis;

use EasySwoole\Component\Singleton;
use EasySwoole\EasySwoole\Config;

class Redis{
    use Singleton;

    public $redis = "";

    private function __construct(){
        if (!extension_loaded('redis')){
            throw new \Exception('redis.so文件不存在');
        }
        try{
            $redisConfig = Config::getInstance()->getConf('redis');
            $this->redis = new \Redis();
            $result = $this->redis->connect($redisConfig['host'], $redisConfig['port'], $redisConfig['time_out']);
        }catch(\Exception $e){
            throw new \Exception('redis服务异常');
        }

        if ($result === false){
            throw new \Exception('redis链接失败');
        }
    }


    public function get($key)
    {
        if (empty($key)){
            return '';
        }
        return $this->redis->get($key);
    }

    public function lPop($key)
    {
        if (empty($key)){
            return '';
        }
        return $this->redis->lPop($key);
    }

    public function rpush($key,$value)
    {
        if (empty($key)){
            return '';
        }
        return $this->redis->rpush($key,$value);
    }
}

<?php

namespace App\HttpController\Api;

use App\HttpController\Api\Base;
use EasySwoole\EasySwoole\Config;
use EasySwoole\ORM\AbstractModel;
use EasySwoole\Model\UserListModel;
use App\Lib\Redis\Redis;
use EasySwoole\Component\Di;

class Index extends Base
{
    /**
     * 首页方法
     * @author : crx
     */
    public function index()
    {
        $data = [
            'id' => 1,
            'name' => 'crx老是荣获国家奖学金',
            'params' => $this->request()->getRequestParam(),
        ];
        return $this->writeJson(201, 'OK', $data);
    }
    public function video(){

        $config = new \EasySwoole\Mysqli\Config([
            'host'          => '120.25.192.200',
            'port'          => '3306',
            'user'          => 'ew',
            'password'      => '123456',
            'database'      => 'ew',
            'timeout'       => 5,
            'charset'       => 'utf8mb4',
        ]);

        $client = new \EasySwoole\Mysqli\Client($config);

        go(function ()use($client){
            //构建sql
            $client->queryBuilder()->get('user_list');
            //执行sql
            var_dump($client->execBuilder());
        });
    }

    public function sqltest(){
        $testUserModel = new UserListModel();
        return $this->writeJson(201, 'OK', 1111);

//        var_dump($res);
    }

    public function getRedis(){
//        $redis = new \Redis();
//        $redis->connect("127.0.0.1", 6379, 5);
//        $redis->set('crx',900);
//        return $this->writeJson(200,'OK',$redis->get('crx'));

//        $res = Redis::getInstance()->get('crx');
//        var_dump(Config::getInstance()->getConf('redis'));
        $res = DI::getInstance()->get('REDIS')->get('crx');
        return $this->writeJson(200,'OK',$res);
    }

    public function pub(){
        $params = $this->request()->getRequestParam();
        DI::getInstance()->get('REDIS')->rpush('imooc_list_test',$params['f']);
    }


}

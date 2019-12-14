<?php
namespace EasySwoole\EasySwoole;


use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\Component\Di;

//use EasySwoole\ORM\DbManager;
//use EasySwoole\ORM\Db\Connection;
//use EasySwoole\ORM\Db\Config;

use App\Lib\Redis\Redis;
use EasySwoole\Utility\File;
use EasySwoole\EasySwoole\Config;

use EasySwoole\EasySwoole\ServerManager;
use App\Lib\Process\ConsumerTest;

class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
        // 载入项目Conf文件夹中所有的配置文件
        self::loadConf(EASYSWOOLE_ROOT.'/Config');
    }

    public static function mainServerCreate(EventRegister $register)
    {
        // TODO: Implement mainServerCreate() method.
//        $config = new Config();
//        $config->setDatabase('ew');
//        $config->setUser('ew');
//        $config->setPassword('12306');
//        $config->setHost('127.0.0.1');
//        $config->setPort('3306');
//        //连接池配置
//        $config->setGetObjectTimeout(3.0); //设置获取连接池对象超时时间
//        $config->setIntervalCheckTime(30*1000); //设置检测连接存活执行回收和创建的周期
//        $config->setMaxIdleTime(15); //连接池对象最大闲置时间(秒)
//        $config->setMaxObjectNum(20); //设置最大连接池存在连接对象数量
//        $config->setMinObjectNum(5); //设置最小连接池存在连接对象数量
//
//        DbManager::getInstance()->addConnection(new Connection($config));
        DI::getInstance()->set('REDIS', Redis::getInstance());

        $allNum = 3;
        for ($i = 0 ;$i < $allNum;$i++){
            ServerManager::getInstance()->getSwooleServer()->addProcess((new ConsumerTest("consumer_{$i}"))->getProcess());
        }
    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }

    public static function loadConf($ConfPath){
        $Conf = Config::getInstance();
        $files = File::scanDirectory($ConfPath)['files'];
        foreach ($files as $file){
//            Config::loadFile($file);
            $data = require_once $file;
            $Conf->setConf(strtolower(basename($file,'.php')),(array)$data);
//            $Conf->getConf('redis');exit;
        }
    }
}
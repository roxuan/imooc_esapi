<?php

namespace App\HttpController\Api;

use EasySwoole\Http\AbstractInterface\Controller;

/**
 * Api模块下的基础类库
 * Ckass Base
 * @package App\HttpControoler
 */
class Base extends Controller
{

    public function index()
    {

    }

    /**
     * 权限相关
     */
    public function onRequest(?string $action): ?bool{
        return true;
    }
//    public function onException(\Throwable $throwable): void{
//        $this->writeJson(400, '请求不合法');
//    }

}

<?php


namespace App\HttpController;


use EasySwoole\Http\AbstractInterface\Controller;

class Category extends Controller
{
    /**
     * 首页方法
     * @author : crx
     */
    public function index()
    {
        $data = [
            'id' => 1,
            'name' => 'crx老是荣获国家奖学金'
        ];
        $this->writeJson(200, 'OK', $data);
        $this->writeJson(200, 'OK', $data);
    }

}

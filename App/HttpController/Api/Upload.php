<?php

namespace App\HttpController\Api;

use App\HttpController\Api\Base;
use EasySwoole\Http\Message\UploadFile;

class Upload extends Base{
    public function file(){
//        $request = $this->request();
//        var_dump($request);exit;
//        $videos = $request->getUploadedFiles();
//        $videos = $request->getUploadedFile('file');
//        $videos = $request->getSwooleRequest()
//        $videos = $request->getSwooleRequest();
//        $videos = $request->getUploadedFiles();
        $swooleRequest = $this->request()->getSwooleRequest();

        try {
            if ($swooleRequest->files) {
                $name = basename($swooleRequest->files['file']['name']);
                $type = $swooleRequest->files['file']['type'];
                $tmp_name = $swooleRequest->files['file']['tmp_name'];
                $error = $swooleRequest->files['file']['error'];
                $size = $swooleRequest->files['file']['size'];

                $UploadFile = new UploadFile($tmp_name,$size,$error,$name,$type);
//                $UploadFile->moveTo();
                $flag = $UploadFile->moveTo("/www/wwwroot/ew/video/1.mp4");
//                if (move_uploaded_file($tmpname, Config::getInstance()->getConf('video_path') . $filename)) {
//                    $this->writeJson(['status' => 1, 'msg' => 'success']);
//                } else {
//                    $this->writeJson(['status' => 0, 'msg' => 'failure']);
//                }
            } else {
                return $this->writeJson(400, 'OK', $data);
            }
        } catch (\Exception $e) {
            return $this->writeJson(400, 'OK', $data);
        }
//        return $this->writeJson(200, 'OK', $swooleRequest);

//        $flag = $videos->moveTo("/www/wwwroot/ew/video/1.mp4");
        $data = [
            'url' => "1.mp4",
            'flah' => $flag
        ];
        if($flag){
            return $this->writeJson(200, 'OK', $data);
        }else{
            return $this->writeJson(400, 'OK', $data);
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile()
    {
        $upload = new \UploadFile();
        $file_path = dirname(base_path()) . '/';
        $upload->savePath = $file_path;// 设置附件上传目录   默认上传目录为 ./uploads/
        if (!$upload->upload()) {
            // 上传错误提示错误信息
            return ['status' => 'failure', 'msg' => $upload->getErrorMsg()];
        } else {
            // 上传成功 获取上传文件信息
            $fileInfo = $upload->getUploadFileInfo();
            return ['status' => 'success', 'msg' => $upload->getErrorMsg(), 'data' => $fileInfo];
        }
    }
}

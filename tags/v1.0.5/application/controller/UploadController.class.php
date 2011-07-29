<?php

class UploadController extends BaseController {
    
    public static function index () {
        self::$_response->setResponseView('upload');
        return self::upload();
    }
    
    public static function upload () {
        self::$_response->setOutputFormat('json');
        
        $uploader = new qqFileUploader();
        $result = $uploader->handleUpload(dirname(dirname(__FILE__)) . '/webroot/upload/');
        
        return compact('result');
    }
}
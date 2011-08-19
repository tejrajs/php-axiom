<?php

class JsonBridgeController extends BaseController {
    
    public static function _init (Request &$request, Response &$response) {
        parent::_init($request, $response);
        self::$_response->setOutputFormat('json');
    }
    
    public static function index () {
        self::$_response->setResponseView('getlocale');
        return self::getLocale();
    }
    
    public static function getLocale () {
        $locale = Lang::getLocale();
        $locales = Lang::getLocales();
        $date_format = Lang::getDateFormat();
        $translations = Lang::getTranslations();
        $base_url = Lang::getBaseUrl();
        
        return compact('locale', 'locales', 'date_format', 'translations', 'base_url');
    }
}
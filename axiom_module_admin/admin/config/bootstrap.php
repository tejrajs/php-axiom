<?php

try {
    Autoloader::add(dirname(dirname(__FILE__)) . '/controller');
    Autoloader::add(dirname(dirname(__FILE__)) . '/model');
    Autoloader::start();
    ViewManager::setViewPath(dirname(dirname(__FILE__)) . '/view');
    Lang::loadLanguage(dirname(dirname(__FILE__)) . '/locale/langs/' . Lang::getLocale() . '.ini');
}
catch (Exception $e) {
    var_dump($e->getMessage());
    Router::run('error', 'http500');
    die();
}
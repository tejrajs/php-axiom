<?php

try {
    Autoloader::add(dirname(dirname(__FILE__)) . '/controller');
    Autoloader::add(dirname(dirname(__FILE__)) . '/model');
    Autoloader::start();
    ViewManager::setViewPath(dirname(dirname(__FILE__)) . '/view');
    Log::debug("Loading admin lang: " . Lang::getLocale());
    Lang::loadLanguage(dirname(dirname(__FILE__)) . '/locale/langs/' . Lang::getLocale() . '.ini');
}
catch (Exception $e) {
    Router::run('error', 'http500');
    die();
}
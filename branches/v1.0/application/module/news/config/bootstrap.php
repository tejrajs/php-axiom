<?php
/**
 * Axiom: a lightweight PHP framework
 *
 * @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
 * @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
 */

try {
    Autoloader::add(dirname(dirname(__FILE__)) . '/controller');
    Autoloader::add(dirname(dirname(__FILE__)) . '/model');
    Autoloader::start();
    ViewManager::setViewPath(dirname(dirname(__FILE__)) . '/view');
    Lang::loadLanguage(dirname(dirname(__FILE__)) . '/locale/langs/' . Lang::getLocale() . '.ini');
}
catch (Exception $e) {
    Router::run('error', 'http500');
    die();
}
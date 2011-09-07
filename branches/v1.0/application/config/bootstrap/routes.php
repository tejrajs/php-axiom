<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * $Date$
 * $Id$
 */

require_once LIBRARY_PATH . '/Router.class.php';

Router::setConfig();
/*
Router::addRoute('default', array('index'));
Router::addRoute('~^((?<lang>[[:alnum:]]{2})/)?login/?$~', array('admin', 'login'));
Router::addRoute('~^((?<lang>[[:alnum:]]{2})/)?logout/?$~', array('admin', 'logout'));
Router::addRoute('~^((?<lang>[[:alnum:]]{2})/)?admin/(?<admrt>[[:alnum:]]{3,})/?(?<admact>[[:alnum:]]{3,})?/?$~', array('admin','index'));
*/

/**
 * Admin Module Routes
 */
Router::connect('/{:lang}/login', 'AdminController::login', array('module' => 'admin'));
Router::connect('/{:lang}/logout', 'AdminController::logout', array('module' => 'admin'));
Router::connect('/{:lang}/admin/{:controller}/{:action}', array(), array('module' => 'admin'));
Router::connect('/{:lang}/admin/{:controller}', array(), array('module' => 'admin'));
Router::connect('/{:lang}/admin', array(), array('module' => 'admin'));

/**
 * Default Routes
 */

Router::connect('/{:controller}/{:action}');
Router::connect('/{:controller}');
Router::connect('/{:lang}', 'IndexController::index');
Router::connect('/', 'IndexController::index');
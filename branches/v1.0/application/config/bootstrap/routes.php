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

/**
 * Admin Module Routes
 */
Router::connect('/{:lang}/{:action:login|logout}', 'AdminController', array('module' => 'admin'));
Router::connect('/{:lang}/admin/{:controller}/{:action}', array(), array('module' => 'admin'));
Router::connect('/{:lang}/admin/{:controller}', array(), array('module' => 'admin'));
Router::connect('/{:lang}/admin', 'AdminController', array('module' => 'admin'));

/**
 * Default Routes
 */
Router::connect('/{:lang}/{:controller}/{:action}');
Router::connect('/{:lang}/{:controller}');
Router::connect('/{:lang}', 'IndexController::index');
Router::connect('/', 'IndexController::index');
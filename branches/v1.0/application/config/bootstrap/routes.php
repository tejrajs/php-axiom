<?php
/**
 * Axiom: a lightweight PHP framework
 *
 * @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
 * @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
 */

require_once LIBRARY_PATH . '/Router.class.php';

Router::setConfig();

/**
 * Admin Module Routes
 */
Router::connect('/{:lang}/admin/news', 'AdminNewsController', array('module' => array('admin', 'news')));
Router::connect('/{:lang}/admin/{:controller}/{:action}', array(), array('module' => 'admin'));
Router::connect('/{:lang}/admin/{:controller}', array(), array('module' => 'admin'));
Router::connect('/{:lang}/admin', 'AdminController', array('module' => 'admin'));
Router::connect('/{:lang}/{:action:login|logout}', 'AdminController', array('module' => 'admin'));


/**
 * Default Routes
 */
Router::connect('/{:lang}/{:controller}/{:action}');
Router::connect('/{:lang}/{:controller}');
Router::connect('/{:lang}', 'IndexController::index');
Router::connect('/', 'IndexController::index');
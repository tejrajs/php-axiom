<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * @version 1.0.0
 */

require_once LIBRARY_PATH . '/Router.class.php';

Router::setConfig();
Router::addRoute('default', array('summary'));
Router::addRoute('`((?<lang>[[:alnum:]]{2})/)?test/(?<param>[[:alnum:]]+)/?`', array('summary', 'test'));
Router::addRoute('`^((?<lang>[[:alnum:]]{2})/)?admin/(?<admrt>[[:alnum:]]{3,})/?(?<admact>[[:alnum:]]{3,})?/?$`', array('admin','module'));

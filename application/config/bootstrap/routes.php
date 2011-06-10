<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * $Date: 2011-05-20 11:51:17 +0200 (ven., 20 mai 2011) $
 * $Id: routes.php 23045 2011-05-20 09:51:17Z bordas $
 */

require_once LIBRARY_PATH . '/Router.class.php';

Router::setConfig();
Router::addRoute('default', array('summary'));
Router::addRoute('`^((?<lang>[[:alnum:]]{2})/)?admin/(?<admrt>[[:alnum:]]{3,})/?(?<admact>[[:alnum:]]{3,})?/?$`', array('admin','module'));
Router::addRoute('`^((?<lang>[[:alnum:]]{2})/)?test$`', array('summary', 'test'));


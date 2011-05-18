<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: routes.php 162 2011-05-18 13:19:56Z delespierre $
 */

require_once LIBRARY_PATH . '/Router.class.php';

Router::setConfig();
Router::addRoute('default', array('summary'));
Router::addRoute('`((?<lang>[[:alnum:]]{2})/)?test/(?<param>[[:alnum:]]+)/?`', array('summary', 'test'));
Router::addRoute('`^((?<lang>[[:alnum:]]{2})/)?admin/(?<admrt>[[:alnum:]]{3,})/?(?<admact>[[:alnum:]]{3,})?/?$`', array('admin','module'));

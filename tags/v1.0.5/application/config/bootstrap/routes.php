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
Router::addRoute('default', array('index'));
Router::addRoute('~^((?<lang>[[:alnum:]]{2})/)?login/?$~', array('admin', 'login'));
Router::addRoute('~^((?<lang>[[:alnum:]]{2})/)?logout/?$~', array('admin', 'logout'));
Router::addRoute('~^((?<lang>[[:alnum:]]{2})/)?admin/(?<admrt>[[:alnum:]]{3,})/?(?<admact>[[:alnum:]]{3,})?/?$~', array('admin','index'));

<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: views.php 22988 2011-05-18 15:00:36Z delespierre $
 */

require_once LIBRARY_PATH . '/ViewManager.class.php';

ViewManager::setConfig(array(
    'header' => 'html',
    'layout_file' => 'default',
    'layout_content_var' => 'content',
));

ViewManager::addLayoutVars(array(
    'lang' => Lang::getLocale(),
    'description' => 'Sample Description',
    'keywords' => array('foo', 'bar'),
    'title' => 'Default Title',
));
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
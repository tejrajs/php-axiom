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

require_once LIBRARY_PATH . '/feeds/Feed.class.php';

Feed::setConfig(array(
    'type' => 'Rss',
));

Feed::setMetaInf(array(
    'title' => 'Axiom Feed',
    'date' => date('r'),
    'author' => array(
    	'name' => 'Benjamin DELESPIERRE',
    	'mail' => 'benjamin.delespierre@gmail.com'),
    'lang' => Lang::getLocale(),
    'description' => 'Axiom Generic Feed',
));
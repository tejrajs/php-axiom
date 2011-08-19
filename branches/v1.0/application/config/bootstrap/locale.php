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

require_once LIBRARY_PATH . '/Lang.class.php';

Lang::setConfig(array(
    'locale' => 'fr',
    'locales' => array('en', 'fr'),
    'base_url' => '/axiom/',
));

Lang::loadLanguage();

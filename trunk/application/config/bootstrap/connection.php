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

require_once LIBRARY_PATH . "/Database.class.php";

Database::setConfig(array(
    'host' => 'localhost',
    'database' => 'axiom',
    'username' => 'root',
    'password' => '',
    'type' => 'mysql',
));

Database::open();
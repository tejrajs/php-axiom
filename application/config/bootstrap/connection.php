<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * $Date: 2011-05-20 16:32:08 +0200 (ven., 20 mai 2011) $
 * $Id: connection.php 23055 2011-05-20 14:32:08Z delespierre $
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
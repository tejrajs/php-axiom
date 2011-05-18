<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: connection.php 162 2011-05-18 13:19:56Z delespierre $
 */

require_once LIBRARY_PATH . "/Database.class.php";

$db = "backoffice";
$db_type = "mysql";
$db_user = "root";
$db_password = "";
$db_host = "localhost";

Database::instance("$db_type:dbname=$db;host=$db_host", $db_user, $db_password);
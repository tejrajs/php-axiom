<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * @version 1.0.0
 */

require_once LIBRARY_PATH . "/Database.class.php";

$db = "backoffice";
$db_type = "mysql";
$db_user = "root";
$db_password = "";
$db_host = "localhost";

Database::instance("$db_type:dbname=$db;host=$db_host", $db_user, $db_password);
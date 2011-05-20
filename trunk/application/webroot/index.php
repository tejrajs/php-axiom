<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: index.php 22988 2011-05-18 15:00:36Z delespierre $
 */

require_once dirname(dirname(dirname(__FILE__))) . "/application/config/bootstrap.php";

Router::run();
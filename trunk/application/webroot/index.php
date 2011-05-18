<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: index.php 162 2011-05-18 13:19:56Z delespierre $
 */

require_once dirname(dirname(dirname(__FILE__))) . "/application/config/bootstrap.php";

Router::run();
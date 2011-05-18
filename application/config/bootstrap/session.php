<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: session.php 162 2011-05-18 13:19:56Z delespierre $
 */

if (!session_id()) session_start();

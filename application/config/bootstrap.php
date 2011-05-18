<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * $Date: 2011-05-18 15:22:49 +0200 (mer., 18 mai 2011) $
 * $Id: bootstrap.php 163 2011-05-18 13:22:49Z delespierre $
 */

define('AXIOM_VERSION', 'v1.0.1 - Beta');
define('LIBRARY_PATH',     dirname(dirname(dirname(__FILE__))) . '/libraries');
define('APPLICATION_PATH', dirname(dirname(dirname(__FILE__))) . '/application');

require dirname(__FILE__) . '/bootstrap/settings.php';

require dirname(__FILE__) . '/bootstrap/autoload.php';

require dirname(__FILE__) . '/bootstrap/session.php';

require dirname(__FILE__) . '/bootstrap/locale.php';

require dirname(__FILE__) . '/bootstrap/connection.php';

require dirname(__FILE__) . '/bootstrap/routes.php';

require dirname(__FILE__) . '/bootstrap/modules.php';

require dirname(__FILE__) . '/bootstrap/views.php';
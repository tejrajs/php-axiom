<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category Action
 * @package Controller
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: LoginController.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Login Controller
 *
 * @author Delespierre
 * @version $Rev: 162 $
 * @subpackage LoginController
 */
class LoginController extends BaseController {
    
    public static function index () {
        return self::login();
    }
    
    public static function login () {
        if (($username = self::$_request->login) && $password = self::$_request->password) {
            if ($user = User::exists($username, $password)) {
                $user->last_connection = date('Y-m-d H:i:s');
                $_SESSION['user'] = $user;
                redirect(url('admin', 'panel'));
            }
            else
                throw new LoginException("Could not find this user");
        }
        self::$_response->setResponseView("login");
    }
    
    public static function logout () {
        session_destroy();
        header("Location: " . url('summary'));
        self::$_response->setResponseView("login");
    }
}
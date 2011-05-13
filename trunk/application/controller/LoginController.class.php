<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category Action
 * @package Controller
 * @version 1.0.0
 */

/**
 * Login Controller
 *
 * @author Delespierre
 * @version 1.0.0
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
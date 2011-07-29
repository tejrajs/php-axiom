<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category Action
 * @package Controller
 * $Date$
 * $Id$
 */

/**
 * Admin Controller
 *
 * @author Delespierre
 * @version $Rev$
 * @subpackage AdminController
 */
class AdminController extends BaseController {
    
    protected static $_session;
    
    public static function _init (Request &$request, Response &$response) {
        parent::_init($request, $response);
        self::$_session = new Session();
    }
    
    public static function index () {
        if ($admrt = self::$_request->admrt) {
            if (ModuleManager::exists($admrt))
                ModuleManager::load($admrt);
                
            if (!Autoloader::load($controller = ucfirst($admrt).'AdminController'))
                throw new BadMethodCallException("Cannot find $controller");
                
            Router::load($controller, self::$_request->admact);
            exit();
        }
        Router::load('PanelAdminController');
        exit();
    }
    
    public static function login () {
        if (self::$_request->login && self::$_request->password) {
            if ($user = User::exists(self::$_request->login, self::$_request->password)) {
                $user->last_connection = date('Y-m-d H:i:s');
                $user->update();
                self::$_session->user = $user;
                
                redirect(url('admin'));
            }
            else
                throw new LoginException("Could not find this user");
        }
    }
    
    public static function logout () {
        self::$_session->destroy();
        
        redirect(url('index'));
    }
}
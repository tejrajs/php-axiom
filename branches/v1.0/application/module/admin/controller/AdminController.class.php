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
                
            self::forward(ucfirst($admrt).'AdminController', self::$_request->admact);
        }
        
        self::forward('PanelAdminController');
    }
    
    public static function login () {
        if (self::$_request->login && self::$_request->password) {
            if ($user = User::exists(self::$_request->login, self::$_request->password)) {
                $user->last_connection = date('Y-m-d H:i:s');
                $user->update();
                self::$_session->user = $user;
                self::$_response->addMessage(i18n('admin.login.success', $user->name, $user->surname));
                self::redirect(url('admin'));
            }
            throw new LoginException("Could not find this user", 11002);
        }
    }
    
    public static function logout () {
        self::$_session->destroy();
        self::redirect(url('index'), RedirectException::REDIRECT_PERMANENT);
    }
}
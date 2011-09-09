<?php
/**
 * Axiom: a lightweight PHP framework
 *
 * @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
 * @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
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
        self::forward('AdminPanelController');
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
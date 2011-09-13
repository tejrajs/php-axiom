<?php
/**
 * Axiom: a lightweight PHP framework
 *
 * @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
 * @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
 */

class AdminNewsController extends SecuredController {
    
    public static function index () {
        self::$_response->setResponseView('news');
        return self::news();
    }
    
    public static function news () {
        $news = News::getNews();
        return compact('news');
    }
    
    public static function add () {
        self::$_response->setResponseView('edit');
        return self::edit();
    }
    
    public static function edit () {
        if ($id = self::$_request->id) {
            $news = new News($id);
        }
        
        return compact('news');
    }
    
    public static function save () {
        if (self::$_request->cancel) {
            self::redirect(url('admin/news'), RedirectException::REDIRECT_PERMANENT);
        }
        
        $defaults = array(
            'author' => null,
            'date' => null,
            'body' => null,
            'published' => 0,
        );
        
        $inputs = self::$_request->getRequestParameters();
        $inputs = array_merge($defaults, array_intersect_key($inputs, $defaults));
        
        if ($missing = array_keys($inputs, null, true)) {
            self::$_response->addMessage(i18n('admin.news.edit.save.missing', implode(',', $missing)), MESSAGE_ALERT);
            self::$_response->setResponseView('edit');
            return self::edit();
        }
        else {
            if ($id = self::$_request->id) {
                $news = new News($id);
                $method = "update";
            }
            else {
                $news = new News();
                $method = "create";
            }
            
            if ($news->$method($inputs)) {
                self::$_response->addMessage(i18n('admin.news.edit.save.ok'));
                self::redirect(url('admin/news'), RedirectException::REDIRECT_REFRESH);
            }
            else {
                self::$_response->addMessage(i18n('admin.news.edit.save.nok'), MESSAGE_ALERT);
                self::$_response->setResponseView('edit');
                return self::edit();
            }
        }
    }
    
    public static function view () {
        if ($id = self::$_request->id) {
            $news = new News($id);
        }
        else {
            self::$_response->addMessage(i18n('admin.news.view.no_news_selected'), MESSAGE_ALERT);
            return self::index();
        }
        
        return compact('news');
    }
}
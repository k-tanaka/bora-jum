<?php
/**
 * モジュールプラグイン
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class Plugin extends PluginAbstract
{
    // Properties

    /**{{{ preProcess()
     *
     * アクション実行前共通処理
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function preProcess()
    {
        $this->checkAuthSession();

        $this->view->addJs('jquery-1.5.2.min.js');
        $this->view->addJs('hideshow.js');
        $this->view->addJs('jquery.tablesorter.min.js');
        $this->view->addJs('jquery.equalHeight.js');

        $this->view->site_title = 'bora-jum';

        $session = new Session('auth');

        $Users = $this->model('Users');
        $this->view->user_name = $Users->getUserName($session->user_id);

        $this->addBreadcrumb($this->view->site_title, '/');
    }
    //}}}
    /**{{{ postProcess()
     *
     * アクション実行後共通処理
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function postProcess()
    {
        if (!is_null($this->view->page_title)) {
            $this->addBreadcrumb($this->view->page_title, '');
        }
    }
    //}}}

    /**{{{ addBreadcrub()
     *
     * パンくずリスト用配列に要素を追加
     *
     * @access  public
     * @param   string  $title
     * @param   string  $url
     * @return  bool
     * @author  k-tanaka@netcombb.co.jp
     */
    public function addBreadcrumb($title = '', $url = '')
    {
        if (is_null($title) || $title === '') {
            return false;
        }

        $breadcrumbs = (is_null($this->view->breadcrumbs)) ? array() : $this->view->breadcrumbs;

        $breadcrumbs[] = array(
                'title' => $title,
                'url'   => $url,
                );
        $this->view->breadcrumbs = $breadcrumbs;

        return true;
    }
    //}}}
    /**{{{ setAuthSession()
     *
     * セッションにログイン情報をセット
     *
     * @access  public
     * @param   int     $user_id
     * @return  void
     */
    public function setAuthSession($user_id)
    {
        $session = new Session('auth');
        $session->auth = true;
        $session->user_id = $user_id;
        $session->ref = null;
    }
    //}}}
    /**{{{ clearAuthSession()
     *
     * セッションからログイン情報をクリア
     *
     * @access  public
     * @param   (none)
     * @return  void
     */
    public function clearAuthSession()
    {
        $session = new Session('auth');
        $session->auth = false;
        $session->user_id = '';
    }
    //}}}
    /**{{{ checkAuthSession()
     *
     * セッションのログイン情報をチェック
     *
     * @access  public
     * @param   (none)
     * @return  bool
     */
    public function checkAuthSession()
    {
        $session = new Session('auth');

        if ($this->request->getController() === 'auth' && $this->request->getAction() !== 'logout') {
            if ($session->auth && preg_match('/^[1-9]+[0-9]*$/', $session->user_id)) {
                $this->redirect('/');
            }
        }
        else {
            if (!$session->auth || !preg_match('/^[1-9]+[0-9]*$/', $session->user_id)) {
                $this->redirect('/login/');
            }
        }
    }
    //}}}
}
?>

<?php
/**
 * 認証
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class AuthController extends Controller
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
    }
    //}}}

    /**{{{ index()
     *
     * ログインフォーム
     *
     * @access  public
     * @param   (none)
     * @return  void
     */
    public function index()
    {
        $this->view->page_title = 'ログイン';
        $this->view->setLayout('not_auth');

        $session = new Session('auth');

        if (is_null($sesssion->ref)) {
            $session->ref = '/';
        }

        $this->view->form = $this->_getForm();
    }
    //}}}
    /**{{{ login()
     *
     * ログイン認証
     *
     * @access  public
     * @param   (none)
     * @return  void
     */
    public function login()
    {
        $auth = $this->model('Users')->auth($this->post['loginid'], $this->post['password']);

        if ($auth) {
            $referer = $session->ref;
            $this->plugin->setAuthSession($auth);

            $this->redirect($refferer);
        }

        $this->plugin->clearAuthSession();

        $this->view->page_title = 'ログイン';
        $this->view->setLayout('not_auth');
        $this->view->setTemplate('index');

        $this->view->error = true;
        $this->view->form = $this->_getForm($this->post);
    }
    //}}}
    /**{{{ logout()
     *
     * ログアウト
     *
     * @access  public
     * @param   (none)
     * @return  void
     */
    public function logout()
    {
        $this->plugin->clearAuthSession();
        $this->redirect('/login/');
    }
    //}}}

    /**{{{ _getForm()
     *
     * フォーム要素を生成
     *
     * @access  public
     * @param   array   $vals
     * @return  HtmlForm
     * @author  k-tanaka@netcombb.co.jp
     */
    private function _getForm($params = array())
    {
        Loader::load('HtmlForm', 'html');
        Loader::loadLibrary('FormLayoutCustom');
        Loader::loadLibrary('FormLayoutCustomSubmit');

        $loginid = (isset($params['loginid'])) ? $params['loginid'] : '';

        $form = new HtmlForm();
        $form->setAction('/auth/login/');

        $layout1 = $form->addLayout('custom');
        $layout1->addTextBox('loginid')->setCaption('ログインID')->setValue($loginid);
        $layout1->addPassword('password')->setCaption('パスワード');

        $layout2 = $form->addLayout('custom_submit');
        $layout2->addSubmit('login', 'ログイン')->addClass('alt_btn');

        return $form;
    }
    //}}}
}

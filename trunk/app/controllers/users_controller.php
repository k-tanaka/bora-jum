<?php
/**
 * ユーザ管理
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class UsersController extends Controller
{
    // Properties
    // バリデーションルール
    protected $_valid_rules = array(
            'loginid'      => array(
                array('rule' => 'required'),
                array('rule' => 'length', 'max' => 32),
                array('rule' => 'loginid'),
                array('rule' => 'loginid_duplicate'),
                ),
            'name'   => array(
                array('rule' => 'required'),
                ),
            'password'  => array(
                array('rule' => 'required'),
                array('rule' => 'length', 'min' => 8),
                array('rule' => 'password'),
                ),
            );

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
        $this->view->section_title = 'ユーザ管理';

        $this->plugin->addBreadcrumb($this->view->section_title, '/users/');
    }
    //}}}

    /**{{{ index()
     *
     * ユーザ一覧
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function index()
    {
        $this->view->page_title = 'ユーザ一覧';

        $this->view->users = $this->model('Users')->getUsers();
}
    //}}}
    /**{{{ add()
     *
     * ユーザ登録フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function add()
    {
        $this->view->page_title = 'ユーザ登録';

        $this->view->form = $this->_getForm();
    }
    //}}}
    /**{{{ create()
     *
     * ユーザ登録
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function create()
    {
        $this->validator->setRules($this->_valid_rules);

        $valid = $this->validator->validate($this->post);

        if ($valid) {
            $this->model('Users')->addUser($this->post);

            $this->redirect('/' . $this->request->getController() . '/');
        }

        $this->view->setTemplate('add');

        $this->view->page_title = 'ユーザ登録';
        $this->view->errors = $this->validator->getError();
        $this->view->form = $this->_getForm($this->post);
    }
    //}}}
    /**{{{ edit()
     *
     * ユーザ変更フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function edit()
    {
        $this->view->page_title = 'ユーザ変更';

        $user = $this->model('Users')->getUser($this->params['id']);
        $this->view->form = $this->_getForm($user, false);
    }
    //}}}
    /**{{{ update()
     *
     * ユーザ変更
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function update()
    {
        unset($this->_valid_rules['loginid'][3]);
        unset($this->_valid_rules['password']);

        $this->validator->setRules($this->_valid_rules);

        $valid = $this->validator->validate($this->post);

        if ($valid) {
            $this->model('Users')->updateUser($this->post);

            $this->redirect('/' . $this->request->getController() . '/');
        }

        $this->view->setTemplate('edit');

        $this->view->page_title = 'ユーザ変更';
        $this->view->errors = $this->validator->getError();
        $this->view->form = $this->_getForm($this->post, false);
    }
    //}}}
    /**{{{ editPassword()
     *
     * パスワード変更フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function editPassword()
    {
        $this->view->page_title = 'パスワード変更';

        $this->view->user = $this->model('Users')->getUser($this->params['id']);
        $this->view->form = $this->_getPasswordForm($this->view->user);
    }
    //}}}
    /**{{{ updatePassword()
     *
     * パスワード変更
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function updatePassword()
    {
        unset($this->_valid_rules['loginid']);
        unset($this->_valid_rules['name']);

        $this->validator->setRules($this->_valid_rules);

        $valid = $this->validator->validate($this->post);

        if ($valid) {
            $this->model('Users')->updatePassword($this->post);

            $this->redirect('/' . $this->request->getController() . '/');
        }

        $this->view->setTemplate('edit_password');

        $this->view->page_title = 'パスワード変更';
        $this->view->user = $this->model('Users')->getUser($this->params['id']);
        $this->view->errors = $this->validator->getError();
        $this->view->form = $this->_getPasswordForm($this->post, false);
    }
    //}}}
    /**{{{ delete()
     *
     * ユーザ削除
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function delete()
    {
        $this->model('Users')->deleteUser($this->params['id']);
        $this->redirect('/' . $this->request->getController() . '/');
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
    private function _getForm($vals = array(), $is_new = true)
    {
        Loader::load('HtmlForm', 'html');
        Loader::loadLibrary('FormLayoutCustom');
        Loader::loadLibrary('FormLayoutCustomSubmit');

        $loginid = (isset($vals['loginid'])) ? $vals['loginid'] : '';
        $name    = (isset($vals['name'])) ? $vals['name'] : '';

        $form = new HtmlForm();
        if ($is_new) {
            $form->setAction('/users/create/');
        }
        else {
            $form->setAction('/users/update/' . $vals['id']);
            $form->addHidden('id')->setValue($vals['id']);
        }
        $layout1 = $form->addLayout('custom');
        $layout1->addTextBox('loginid')->setCaption('ログインID')->setValue($loginid);
        $layout1->addTextBox('name')->setCaption('ユーザ名')->setValue($name);
        if ($is_new) {
            $layout1->addPassword('password')->setCaption('パスワード');
        }

        $layout2 = $form->addLayout('custom_submit');
        if ($is_new) {
            $layout2->addSubmit('regist', '登録')->addClass('alt_btn');
        }
        else {
            $layout2->addSubmit('regist', '変更')->addClass('alt_btn');
        }
        $layout2->addReset('reset', 'リセット');

        return $form;
    }
    //}}}
    /**{{{ _getPasswordForm()
     *
     * パスワード変更のフォーム要素を生成
     *
     * @access  public
     * @param   array   $vals
     * @return  HtmlForm
     * @author  k-tanaka@netcombb.co.jp
     */
    private function _getPasswordForm($vals)
    {
        Loader::load('HtmlForm', 'html');
        Loader::loadLibrary('FormLayoutCustom');
        Loader::loadLibrary('FormLayoutCustomSubmit');

        $form = new HtmlForm();
        $form->setAction('/users/update_password/' . $vals['id']);
        $form->addHidden('id')->setValue($vals['id']);
        $layout1 = $form->addLayout('custom');
        $layout1->addPassword('password')->setCaption('パスワード');

        $layout2 = $form->addLayout('custom_submit');
        $layout2->addSubmit('regist', '変更')->addClass('alt_btn');
        $layout2->addReset('reset', 'リセット');

        return $form;
    }
    //}}}
}

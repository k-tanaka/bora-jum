<?php
/**
 * システムTOP etc.
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

class IndexController extends Controller
{
    public function index()
    {
    }

    /**{{{ login()
     *
     * ログインフォーム
     *
     * @access  public
     * @param   (none)
     * @return  void
     */
    public function login()
    {
        $this->view->page_title = 'ログイン';
        $this->view->setLayout('not_auth');

        Loader::load('HtmlForm', 'html');
        Loader::loadLibrary('FormLayoutCustom');
        Loader::loadLibrary('FormLayoutCustomSubmit');

        $form = new HtmlForm();
        $form->setAction('/auth/login/');

        $layout1 = $form->addLayout('custom');
        $layout1->addTextBox('loginid')->setCaption('ログインID')->setValue($this->post['loginid']);
        $layout1->addPassword('password')->setCaption('パスワード');

        $layout2 = $form->addLayout('custom_submit');
        $layout2->addSubmit('login', 'ログイン')->addClass('alt_btn');

        $this->view->form = $form;
    }
    //}}}
}

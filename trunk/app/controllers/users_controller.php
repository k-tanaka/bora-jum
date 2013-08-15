<?php

class UsersController extends Controller
{
    public function preProcess()
    {
        $this->view->section_title = 'ユーザ管理';

        $this->plugin->addBreadcrumb($this->view->section_title, '/users/');
    }

    public function postProcess()
    {
        if (!is_null($this->view->page_title)) {
            $this->plugin->addBreadcrumb($this->view->page_title, '');
        }
    }

    public function index()
    {
        $this->view->page_title = 'ユーザ一覧';

        $Users = $this->model('Users');

        $user_list = $Users->getUsers();
        $this->view->users = $user_list;
    }

    public function add()
    {
        $this->view->page_title = 'ユーザ登録';

        Loader::load('HtmlForm', 'html');

        $form = new HtmlForm();
        $form->setAction('/users/create/');
        $layout1 = $form->addLayout('custom');
        $layout1->addTextBox('name')->setCaption('ログインID');
        $layout1->addTextBox('display')->setCaption('表示名');
        $layout1->addTextBox('password')->setCaption('パスワード');

        $layout2 = $form->addLayout('custom_submit');
        $layout2->addSubmit('regist', '登録')->addClass('alt_btn');
        $layout2->addReset('reset', 'リセット');

        $this->view->form = $form;
    }

    public function create()
    {
    }
}

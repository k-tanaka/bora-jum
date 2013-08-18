<?php
/**
 * usersコントローラ ビュースクリプトクラス
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */


Class UsersView extends ViewScript
{
    public function index()
    {
        Loader::load('HtmlElement', 'html');
        Loader::load('HtmlTable', 'html');

        $users = array();
        $controller = $this->request->getController();

        // テーブル用のデータに加工
        foreach ($this->users as $user) {
            $edit_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/edit/' . $user['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_edit.png')
                        ->setTitle('変更')
                    )
                ->getHtml();
            $edit_pw_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/edit_password/' . $user['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_security.png')
                        ->setTitle('パスワード変更')
                    )
                ->getHtml();
            $delete_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/delete/' . $user['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_trash.png')
                        ->setTitle('削除')
                        ->setOnclick("return confirm('" . $user['name'] . "を 削除しますか?');")
                    )
                ->getHtml();

            $users[] = array(
                    'id'            => $user['id'],
                    'loginid'       => $user['loginid'],
                    'name'          => $user['name'],
                    'updated_at'    => $user['updated_at'],
                    'action'        => $edit_html . $edit_pw_html . $delete_html,
                    );
        }

        // テーブルHTML生成
        $table = new HtmlTable();
        $table->setClass('tablesorter');
        $table->setCellspacing(0);
        $table->addHeader(array('ID', 'ログインID', 'ユーザ名', '更新日時', '操作'));
        $table->bindArray($users);

        $this->users_table = $table->getHtml();
    }
}
?>

<?php
/**
 * equipsコントローラ ビュースクリプトクラス
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */


Class EquipsView extends ViewScript
{
    //{{{ index()
    public function index()
    {
        Loader::load('HtmlElement', 'html');
        Loader::load('HtmlTable', 'html');

        $equips = array();
        $controller = $this->request->getController();

        // テーブル用のデータに加工
        foreach ($this->equipments as $equip) {
            $view_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/view/' . $equip['id'] . '/')
                ->addText($equip['name'])
                ->getHtml();
            $edit_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/edit/' . $equip['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_edit.png')
                        ->setTitle('変更')
                    )
                ->getHtml();
            $delete_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/delete/' . $equip['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_trash.png')
                        ->setTitle('削除')
                        ->setOnclick("return confirm('" . $equip['name'] . "を 削除しますか?');")
                    )
                ->getHtml();

            $equips[] = array(
                    'id'            => $equip['id'],
                    'name'          => $view_html,
                    'type'          => $this->type_list[$equip['type']],
                    'quantity'      => $equip['quantity'],
                    'updated_at'    => $equip['updated_at'],
                    'action'        => $edit_html . $delete_html,
                    );
        }

        // テーブルHTML生成
        $table = new HtmlTable();
        $table->setClass('tablesorter');
        $table->setCellspacing(0);
        $table->addHeader(array('ID', '備品名', '種別', '数量', '更新日時', '操作'));
        $table->bindArray($equips);

        $this->equips_table = $table->getHtml();
    }
    //}}}
    //{{{ view()
    public function view()
    {
        Loader::load('HtmlElement', 'html');
        Loader::load('HtmlTable', 'html');

        $usages = array();
        $used   = 0;

        // テーブル用のデータに加工
        foreach ($this->usages as $usage) {
            $edit_html = HtmlElement::create('a')
                ->setHref('/usages/edit/' . $this->equipment['id'] . '/' . $usage['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_edit.png')
                        ->setTitle('変更')
                    )
                ->getHtml();
            $delete_html = HtmlElement::create('a')
                ->setHref('/usages/delete/' . $this->equipment['id'] . '/' . $usage['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_trash.png')
                        ->setTitle('削除')
                        ->setOnclick("return confirm('削除しますか?');")
                    )
                ->getHtml();

            $usages[] = array(
                    'id'            => $usage['id'],
                    'type'          => $this->usage_type_list[$usage['type']],
                    'quantity'      => $usage['quantity'],
                    'updated_at'    => $usage['updated_at'],
                    'action'        => $edit_html . $delete_html,
                    );

            $used += intval($usage['quantity']);
        }

        // テーブルHTML生成
        $table = new HtmlTable();
        $table->setClass('tablesorter');
        $table->setCellspacing(0);
        $table->addHeader(array('ID', '使用用途', '数量', '更新日時', '操作'));
        $table->bindArray($usages);

        $this->usages_table = $table->getHtml();

        // 使用中の個数をセット
        $this->used_quantity = $used;
    }
    //}}}
}
?>

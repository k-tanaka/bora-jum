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
    public function index()
    {
        Loader::load('HtmlElement', 'html');
        Loader::load('HtmlTable', 'html');

        $equips = array();
        $controller = $this->request->getController();

        // テーブル用のデータに加工
        foreach ($this->equipments as $equip) {
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
                    'name'          => $equip['name'],
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
}
?>

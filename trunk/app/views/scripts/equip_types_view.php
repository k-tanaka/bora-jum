<?php
/**
 * EquipTypesコントローラ ビュースクリプトクラス
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */


Class EquipTypesView extends ViewScript
{
    //{{{ index()
    public function index()
    {
        Loader::load('HtmlElement', 'html');
        Loader::load('HtmlTable', 'html');

        $types = array();
        $controller = $this->request->getController();

        // テーブル用のデータに加工
        foreach ($this->types as $type) {
            $view_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/view/' . $type['id'] . '/')
                ->setText($type['name'])
                ->getHtml();
            $edit_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/edit/' . $type['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_edit.png')
                        ->setTitle('変更')
                    )
                ->getHtml();
            $delete_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/delete/' . $type['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_trash.png')
                        ->setTitle('削除')
                        ->setOnclick("return confirm('" . $type['name'] . "を 削除しますか?');")
                    )
                ->getHtml();

            $types[] = array(
                    'id'            => $type['id'],
                    'name'          => $view_html,
                    'updated_at'    => $type['updated_at'],
                    'action'        => $edit_html . $delete_html,
                    );
        }

        // テーブルHTML生成
        $table = new HtmlTable();
        $table->setClass('tablesorter');
        $table->setCellspacing(0);
        $table->addHeader(array('ID', '種別名', '更新日時', '操作'));
        $table->bindArray($types);

        $this->types_table = $table->getHtml();
    }
    //}}}
    //{{{ view()
    public function view()
    {
        Loader::load('HtmlElement', 'html');
        Loader::load('HtmlTable', 'html');
        Loader::loadModel('EquipmentTypes');

        $types = array();
        $options = array();
        $controller = $this->request->getController();
        $EquipmentTypes = new EquipmentTypes;

        // テーブル用のデータに加工
        foreach ($this->child_types as $type) {
            $view_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/view/' . $type['id'] . '/')
                ->setText($type['name'])
                ->getHtml();
            $edit_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/edit/' . $type['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_edit.png')
                        ->setTitle('変更')
                    )
                ->getHtml();
            $delete_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/delete/' . $type['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_trash.png')
                        ->setTitle('削除')
                        ->setOnclick("return confirm('" . $type['name'] . "を 削除しますか?');")
                    )
                ->getHtml();

            $types[] = array(
                    'id'            => $type['id'],
                    'name'          => $view_html,
                    'updated_at'    => $type['updated_at'],
                    'action'        => $edit_html . $delete_html,
                    );
        }

        // テーブルHTML生成
        $table1 = new HtmlTable();
        $table1->setClass('tablesorter');
        $table1->setCellspacing(0);
        $table1->addHeader(array('ID', '種別名', '更新日時', '操作'));
        $table1->bindArray($types);

        // テーブル用のデータに加工
        foreach ($this->options as $option) {
            $edit_html = HtmlElement::create('a')
                ->setHref('/eq_options/edit/' . $option['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_edit.png')
                        ->setTitle('変更')
                    )
                ->getHtml();
            $delete_html = HtmlElement::create('a')
                ->setHref('/eq_options/delete/' . $option['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_trash.png')
                        ->setTitle('削除')
                        ->setOnclick("return confirm('" . $option['caption'] . "を 削除しますか?');")
                    )
                ->getHtml();

            $options[] = array(
                    'id'            => $option['id'],
                    'caption'       => $option['caption'],
                    'updated_at'    => $option['updated_at'],
                    'action'        => $edit_html . $delete_html,
                    );
        }

        // テーブルHTML生成
        $table2 = new HtmlTable();
        $table2->setClass('tablesorter');
        $table2->setCellspacing(0);
        $table2->addHeader(array('ID', 'オプション項目名', '更新日時', '操作'));
        $table2->bindArray($options);

        $this->child_types_table = $table1->getHtml();
        $this->options_table = $table2->getHtml();
    }
    //}}}
}
?>

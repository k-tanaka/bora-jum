<?php
/**
 * usagesコントローラ ビュースクリプトクラス
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */


Class UsagesView extends ViewScript
{
    public function index()
    {
        Loader::load('HtmlElement', 'html');
        Loader::load('HtmlTable', 'html');

        $usages = array();
        $controller = $this->request->getController();

        // テーブル用のデータに加工
        foreach ($this->usages as $usage) {
            $edit_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/edit/' . $usage['id'] . '/')
                ->addElement(
                    HtmlElement::create('input')
                        ->setType('image')
                        ->setSrc('/images/icn_edit.png')
                        ->setTitle('変更')
                    )
                ->getHtml();
            $delete_html = HtmlElement::create('a')
                ->setHref('/' . $controller . '/delete/' . $usage['id'] . '/')
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
                    'equipment_id'  => $this->equipment_list[$usage['equipment_id']],
                    'type'          => $this->type_list[$usage['type']],
                    'quantity'      => $usage['quantity'],
                    'updated_at'    => $usage['updated_at'],
                    'action'        => $edit_html . $delete_html,
                    );
        }

        // テーブルHTML生成
        $table = new HtmlTable();
        $table->setClass('tablesorter');
        $table->setCellspacing(0);
        $table->addHeader(array('ID', '備品名', '使用用途', '数量', '更新日時', '操作'));
        $table->bindArray($usages);

        $this->usages_table = $table->getHtml();
    }
}
?>

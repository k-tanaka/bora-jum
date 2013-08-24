<?php
/**
 * 備品オプション項目管理
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class EqOptionsController extends Controller
{
    // Properties
    // バリデーションルール
    protected $_valid_rules = array(
            'caption' => array(
                array('rule' => 'required'),
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
        $this->view->section_title = '備品オプション項目管理';
        $this->plugin->addBreadcrumb($this->view->section_title, '/eq_options/');
    }
    //}}}

    /**{{{ index()
     *
     * 備品オプション一覧
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function index()
    {
        $this->view->page_title = '備品オプション一覧';

        $this->view->types = $this->model('EquipmentOptions')->getOptions();
    }
    //}}}
    /**{{{ add()
     *
     * 備品オプション登録フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function add()
    {
        $this->_setBreadcrumbs($this->params['equipment_type_id']);
        $this->view->page_title = '備品オプション項目の登録';

        $this->view->form = $this->_getForm(array('equipment_type_id' => $this->params['equipment_type_id']));
    }
    //}}}
    /**{{{ create()
     *
     * 備品オプション登録
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
            $this->model('EquipmentOptions')->addOption($this->post);

            $this->redirect('/equip_types/view/' . $this->post['equipment_type_id'] . '/');
        }

        $this->view->setTemplate('add');

        $this->view->page_title = '備品オプション項目登録';
        $this->view->errors = $this->validator->getError();
        $this->view->form = $this->_getForm($this->post);
    }
    //}}}
    /**{{{ edit()
     *
     * 備品オプション変更フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function edit()
    {
        $this->view->page_title = '備品オプション項目変更';

        $option = $this->model('EquipmentOptions')->getOption($this->params['id']);

        $this->_setBreadcrumbs($option['equipment_type_id']);

        $this->view->form = $this->_getForm($option, false);
    }
    //}}}
    /**{{{ update()
     *
     * 備品オプション変更
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function update()
    {
        $this->validator->setRules($this->_valid_rules);

        $valid = $this->validator->validate($this->post);

        if ($valid) {
            $this->model('EquipmentOptions')->updateOption($this->post);

            $this->redirect('/equip_types/view/' . $this->post['equipment_type_id'] . '/');
        }

        $this->view->setTemplate('edit');

        $this->view->page_title = '備品オプション項目変更';
        $this->view->errors = $this->validator->getError();
        $this->view->form = $this->_getForm($this->post, false);
    }
    //}}}
    /**{{{ delete()
     *
     * 備品オプション削除
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function delete()
    {
        $option = $this->model('EquipmentOptions')->getOption($this->params['id']);
        $this->model('EquipmentOptions')->deleteOption($this->params['id']);

        $this->redirect('/equip_types/view/' . $option['equipment_type_id'] . '/');
    }
    //}}}

    /**{{{ _setBreadcrumbs()
     *
     * パンくずリスト配列をセット
     *
     * @access  private
     * @param   int     $equipment_type_id
     * @return  void
     */
    private function _setBreadcrumbs($equipment_type_id)
    {
        $equipment_type = $this->model('EquipmentTypes')->getType($equipment_type_id);

        $breads = array();
        for ($i = $equipment_type['level']; $i > 0; $i--) {
            $parent_type = $this->model('EquipmentTypes')->getType($equipment_type['parent_id']);
            $breads[$i - 1] = array(
                    'title' => $parent_type['name'],
                    'url'   => '/eq_options/view/' . $parent_type['id'],
                    );
        }
        $breads[$equipment_type['level']] = array(
                'title' => $equipment_type['name'],
                'url'   => '/eq_options/view/' . $equipment_type['id'],
                );
        foreach ($breads as $bread) {
            $this->plugin->addBreadcrumb($bread['title'], $bread['url']);
        }
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

        $caption = (isset($vals['caption'])) ? $vals['caption'] : '';

        $form = new HtmlForm();
        if ($is_new) {
            $form->setAction('/eq_options/create/');
        }
        else {
            $form->setAction('/eq_options/update/' . $vals['id']);
            $form->addHidden('id')->setValue($vals['id']);
        }
        $form->addHidden('equipment_type_id')->setValue($vals['equipment_type_id']);

        $layout1 = $form->addLayout('custom');
        $layout1->addTextBox('caption')->setCaption('オプション項目名')->setValue($caption);

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
}
?>

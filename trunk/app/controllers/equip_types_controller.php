<?php
/**
 * 備品種別管理
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class EquipTypesController extends Controller
{
    // Properties
    // バリデーションルール
    protected $_valid_rules = array(
            'name' => array(
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
        $this->view->section_title = '備品管理';
        $this->plugin->addBreadcrumb($this->view->section_title, '/equips/');
    }
    //}}}

    /**{{{ index()
     *
     * 備品種別一覧
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function index()
    {
        $this->view->page_title = '備品種別一覧';

        $this->view->types = $this->model('EquipmentTypes')->getTypes();
    }
    //}}}
    /**{{{ add()
     *
     * 備品種別登録フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function add()
    {
        $this->view->page_title = '備品種別登録';

        $this->view->form = $this->_getForm();
    }
    //}}}
    /**{{{ create()
     *
     * 備品種別登録
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
            $this->model('EquipmentTypes')->addType($this->post);

            $this->redirect('/' . $this->request->getController() . '/');
        }

        $this->view->setTemplate('add');

        $this->view->page_title = '備品種別登録';
        $this->view->errors = $this->validator->getError();
        $this->view->form = $this->_getForm($this->post);
    }
    //}}}
    /**{{{ edit()
     *
     * 備品種別変更フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function edit()
    {
        $this->view->page_title = '備品種別変更';

        $equipment_type = $this->model('EquipmentTypes')->getType($this->params['id']);
        $this->view->form = $this->_getForm($equipment_type, false);
    }
    //}}}
    /**{{{ update()
     *
     * 備品種別変更
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
            $this->model('EquipmentTypes')->updateType($this->post);

            $this->redirect('/' . $this->request->getController() . '/');
        }

        $this->view->setTemplate('edit');

        $this->view->page_title = '備品種別変更';
        $this->view->errors = $this->validator->getError();
        $this->view->form = $this->_getForm($this->post, false);
    }
    //}}}
    /**{{{ delete()
     *
     * 備品種別削除
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function delete()
    {
        $this->model('EquipmentTypes')->deleteType($this->params['id']);
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

        $name = (isset($vals['name'])) ? $vals['name'] : '';

        $form = new HtmlForm();
        if ($is_new) {
            $form->setAction('/equip_types/create/');
        }
        else {
            $form->setAction('/equip_types/update/' . $vals['id']);
            $form->addHidden('id')->setValue($vals['id']);
        }
        $layout1 = $form->addLayout('custom');
        $layout1->addTextBox('name')->setCaption('種別名')->setValue($name);

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

<?php
/**
 * 備品管理
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class EquipsController extends Controller
{
    // Properties
    // バリデーションルール
    protected $_valid_rules = array(
            'name' => array(
                array('rule' => 'required'),
                ),
            'type' => array(
                array('rule' => 'required'),
                array('rule' => 'number_string'),
                ),
            'quantity' => array(
                array('rule' => 'required'),
                array('rule' => 'number_string'),
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
     * 備品一覧
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function index()
    {
        $this->view->page_title = '備品一覧';
        $this->view->equipments = $this->model('Equipments')->getEquipments();
        $this->view->type_list  = $this->model('EquipmentTypes')->getTypeList();
    }
    //}}}
    /**{{{ view()
     *
     * 備品詳細
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function view()
    {
        $this->view->equipment  = $this->model('Equipments')->getEquipment($this->params['id']);
        $this->view->type       = $this->model('EquipmentTypes')->getType($this->view->equipment['type']);
        $this->view->usages     = $this->model('Usages')->getUsagesByEquipmentId($this->params['id']);
        $this->view->usage_type_list = $this->model('UsageTypes')->getTypeList();
        $this->view->page_title = $this->view->equipment['name'];
    }
    //}}}
    /**{{{ add()
     *
     * 備品登録フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function add()
    {
        $this->view->page_title = '備品登録';

        $this->view->form = $this->_getForm();
    }
    //}}}
    /**{{{ create()
     *
     * 備品登録
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
            $this->model('Equipments')->addEquipment($this->post);

            $this->redirect('/' . $this->request->getController() . '/');
        }

        $this->view->setTemplate('add');

        $this->view->page_title = '備品登録';
        $this->view->errors = $this->validator->getError();
        $this->view->form = $this->_getForm($this->post);
    }
    //}}}
    /**{{{ edit()
     *
     * 備品変更フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function edit()
    {
        $this->view->page_title = '備品変更';

        $equipment_type = $this->model('Equipments')->getEquipment($this->params['id']);
        $this->view->form = $this->_getForm($equipment_type, false);
    }
    //}}}
    /**{{{ update()
     *
     * 備品変更
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
            $this->model('Equipments')->updateEquipment($this->post);

            $this->redirect('/' . $this->request->getController() . '/');
        }

        $this->view->setTemplate('edit');

        $this->view->page_title = '備品変更';
        $this->view->errors = $this->validator->getError();
        $this->view->form = $this->_getForm($this->post, false);
    }
    //}}}
    /**{{{ delete()
     *
     * 備品削除
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function delete()
    {
        $this->model('Equipments')->deleteEquipment($this->params['id']);
        // 使用状況を削除
        $this->model('Usages')->deleteUsagesByEquipmentId($this->params['id']);
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

        $name       = (isset($vals['name'])) ? $vals['name'] : '';
        $type       = (isset($vals['type'])) ? $vals['type'] : 0;
        $quantity   = (isset($vals['quantity'])) ? $vals['quantity'] : 0;

        $types = $this->model('EquipmentTypes')->getTypeList();

        $form = new HtmlForm();
        if ($is_new) {
            $form->setAction('/equips/create/');
        }
        else {
            $form->setAction('/equips/update/' . $vals['id']);
            $form->addHidden('id')->setValue($vals['id']);
        }
        $layout1 = $form->addLayout('custom');
        $layout1->addTextBox('name')->setCaption('備品名')->setValue($name);
        $layout1->addSelect('type', $types)->setCaption('種別')->setValue($type)->setClass('shortbox');
        $layout1->addTextBox('quantity')->setCaption('数量')->setValue($quantity)->setClass('shortbox');

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

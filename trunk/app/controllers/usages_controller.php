<?php
/**
 * 使用状況
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class UsagesController extends Controller
{
    // Properties
    // バリデーションルール
    protected $_valid_rules = array(
            'equipment_id' => array(
                array('rule' => 'required'),
                array('rule' => 'number_string'),
                ),
            'type' => array(
                array('rule' => 'required'),
                array('rule' => 'number_string'),
                ),
            'quantity' => array(
                array('rule' => 'required'),
                array('rule' => 'number_string'),
                array('rule' => 'usage_quantity'),
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

        $this->view->equipment = $this->model('Equipments')->getEquipment($this->params['equipment_id']);
        $this->plugin->addBreadcrumb($this->view->equipment['name'], '/equips/view/' . $this->params['equipment_id']);
    }
    //}}}

    /**{{{ add()
     *
     * 使用状況登録フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function add()
    {
        $this->view->page_title = '使用状況登録';

        $this->view->form = $this->_getForm(array('equipment_id' => $this->view->equipment['id']));
    }
    //}}}
    /**{{{ create()
     *
     * 使用状況登録
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function create()
    {
        $this->_valid_rules['quantity'][2]['all'] = $this->model('Equipments')->getQuantity($this->post['equipment_id']);
        $this->_valid_rules['quantity'][2]['total'] = $this->model('Usages')->getTotalQuantity($this->post['equipment_id']);
        $this->_valid_rules['quantity'][2]['is_new'] = true;

        $this->validator->setRules($this->_valid_rules);

        $valid = $this->validator->validate($this->post);

        if ($valid) {
            $this->model('Usages')->addUsage($this->post);

            $this->redirect('/equips/view/' . $this->post['equipment_id']);
        }

        $this->view->setTemplate('add');

        $this->view->page_title = '使用状況登録';
        $this->view->errors = $this->validator->getError();
        $this->view->form = $this->_getForm($this->post);
    }
    //}}}
    /**{{{ edit()
     *
     * 使用状況変更フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function edit()
    {
        $this->view->page_title = '使用状況変更';

        $equipment_type = $this->model('Usages')->getUsage($this->params['id']);
        $this->view->form = $this->_getForm($equipment_type, false);
    }
    //}}}
    /**{{{ update()
     *
     * 使用状況変更
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function update()
    {
        Loader::loadLibrary('ValidatorEx');

        $this->_valid_rules['quantity'][2]['all'] = $this->model('Equipments')->getQuantity($this->post['equipment_id']);
        $this->_valid_rules['quantity'][2]['total'] = $this->model('Usages')->getTotalQuantity($this->post['equipment_id'], $this->post['id']);
        $this->_valid_rules['quantity'][2]['is_new'] = false;

        $this->validator = new ValidatorEx();
        $this->validator->setRules($this->_valid_rules);

        $valid = $this->validator->validate($this->post);

        if ($valid) {
            $this->model('Usages')->updateUsage($this->post);

            $this->redirect('/equips/view/' . $this->post['equipment_id']);
        }

        $this->view->setTemplate('edit');

        $this->view->page_title = '使用状況変更';
        $this->view->errors = $this->validator->getError();
        $this->view->form = $this->_getForm($this->post, false);
    }
    //}}}
    /**{{{ delete()
     *
     * 使用状況削除
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function delete()
    {
        $this->model('Usages')->deleteUsage($this->params['id']);
        $this->redirect('/equips/view/' . $this->params['equipment_id']);
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

        $equipment_id = (isset($vals['equipment_id'])) ? $vals['equipment_id'] : '';
        $type         = (isset($vals['type'])) ? $vals['type'] : 0;
        $quantity     = (isset($vals['quantity'])) ? $vals['quantity'] : 0;

        $equips = $this->model('Equipments')->getEquipmentList();
        $types  = $this->model('UsageTypes')->getTypeList();

        $form = new HtmlForm();
        if ($is_new) {
            $form->setAction('/' . $this->request->getController() . '/create/' . $equipment_id . '/');
        }
        else {
            $form->setAction('/' . $this->request->getController() . '/update/' . $equipment_id .  '/ ' . $vals['id']);
            $form->addHidden('id')->setValue($vals['id']);
        }
        $form->addHidden('equipment_id')->setValue($equipment_id);
        $layout1 = $form->addLayout('custom');
        $layout1->addSelect('type', $types)->setCaption('使用用途')->setValue($type);
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

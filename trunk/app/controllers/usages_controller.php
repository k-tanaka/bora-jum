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
        $this->view->section_title = '使用状況管理';
        $this->plugin->addBreadcrumb($this->view->section_title, '/usages/');
    }
    //}}}

    /**{{{ index()
     *
     * 使用状況一覧
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function index()
    {
        $this->view->page_title = '使用状況一覧';
        $this->view->usages = $this->model('Usages')->getUsages();
        $this->view->equipment_list = $this->model('Equipments')->getEquipmentList();
        $this->view->type_list  = $this->model('UsageTypes')->getTypeList();
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

        $this->view->form = $this->_getForm();
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
        Loader::loadLibrary('ValidatorEx');

        $validator = new ValidatorEx();
        $validator->setRules($this->_valid_rules);

        $valid = $validator->validate($this->post);

        if ($valid) {
            $this->model('Usages')->addUsage($this->post);

            $this->redirect('/' . $this->request->getController() . '/');
        }

        $this->view->setTemplate('add');

        $this->view->page_title = '使用状況登録';
        $this->view->errors = $validator->getError();
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

        $validator = new ValidatorEx();
        $validator->setRules($this->_valid_rules);

        $valid = $validator->validate($this->post);

        if ($valid) {
            $this->model('Usages')->updateUsage($this->post);

            $this->redirect('/' . $this->request->getController() . '/');
        }

        $this->view->setTemplate('edit');

        $this->view->page_title = '使用状況変更';
        $this->view->errors = $validator->getError();
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

        $equipment_id = (isset($vals['equipment_id'])) ? $vals['equipment_id'] : '';
        $type         = (isset($vals['type'])) ? $vals['type'] : 0;
        $quantity     = (isset($vals['quantity'])) ? $vals['quantity'] : 0;

        $equips = $this->model('Equipments')->getEquipmentList();
        $types  = $this->model('UsageTypes')->getTypeList();

        $form = new HtmlForm();
        if ($is_new) {
            $form->setAction('/' . $this->request->getController() . '/create/');
        }
        else {
            $form->setAction('/' . $this->request->getController() . '/update/' . $vals['id']);
            $form->addHidden('id')->setValue($vals['id']);
        }
        $layout1 = $form->addLayout('custom');
        $layout1->addSelect('equipment_id', $equips)->setCaption('備品名')->setValue($equipment_id);
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

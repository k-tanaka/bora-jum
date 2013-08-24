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
        $this->view->section_title = '備品種別管理';
        $this->plugin->addBreadcrumb($this->view->section_title, '/equip_types/');
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

        $this->view->types = $this->model('EquipmentTypes')->getMainTypes();
    }
    //}}}
    /**{{{ view()
     *
     * 備品種別詳細
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function view()
    {
        $this->view->equipment_type = $this->model('EquipmentTypes')->getType($this->params['id']);

        if ($this->view->equipment_type['parent_id'] != 0) {
            $this->_setBreadcrumbs($this->view->equipment_type['parent_id']);
        }

        $this->view->page_title = $this->view->equipment_type['name'];
        $this->view->child_types = $this->model('EquipmentTypes')->getTypesByParentId($this->params['id']);
        $this->view->options = $this->model('EquipmentOptions')->getOptionsByEquipmentTypeId($this->params['id']);
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
        // parent_id のパラメータチェック
        if (isset($this->params['parent_id']) && preg_match('/^[1-9]+[0-9]*$/', $this->params['parent_id'])) {
            $parent_id = $this->params['parent_id'];
        }
        else {
            $parent_id = 0;
        }

        if ($parent_id !== 0) {
            $this->_setBreadcrumbs($parent_id);
        }
        $this->view->page_title = '備品種別登録';

        $this->view->form = $this->_getForm(array('parent_id' => $parent_id));
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

            $url = '/' . $this->request->getController() . '/';
            $url .= ($this->post['parent_id'] !== 0) ? 'view/' . $this->post['parent_id'] . '/' : '';
            $this->redirect($url);
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

        if ($equipment_type['parent_id'] !== 0) {
            $this->_setBreadcrumbs($equipment_type['parent_id']);
        }

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

            $url = '/' . $this->request->getController() . '/';
            $url .= ($this->post['parent_id'] !== 0) ? 'view/' . $this->post['parent_id'] . '/' : '';
            $this->redirect($url);
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
        $type = $this->model('EquipmentTypes')->getType($this->params['id']);
        $this->model('EquipmentTypes')->deleteType($this->params['id']);

        $url = '/' . $this->request->getController() . '/';
        $url .= ($type['parent_id'] > 0) ? 'view/' . $type['parent_id'] . '/' : '';
        $this->redirect($url);
    }
    //}}}

    /**{{{ _setBreadcrumbs()
     *
     * 階層構造時のパンくずリスト配列をセット
     *
     * @access  private
     * @param   int     $parent_id
     * @return  void
     */
    private function _setBreadcrumbs($parent_id)
    {
        $parent_type = $this->model('EquipmentTypes')->getType($parent_id);

        $breads = array();
        for ($i = $parent_type['level']; $i > 0; $i--) {
            $grand_type = $this->model('EquipmentTypes')->getType($parent_type['parent_id']);
            $breads[$i - 1] = array(
                    'title' => $grand_type['name'],
                    'url'   => '/equip_types/view/' . $grand_type['id'],
                    );
        }
        $breads[$parent_type['level']] = array(
                'title' => $parent_type['name'],
                'url'   => '/equip_types/view/' . $parent_type['id'],
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

        $name = (isset($vals['name'])) ? $vals['name'] : '';

        $form = new HtmlForm();
        if ($is_new) {
            $form->setAction('/equip_types/create/');
        }
        else {
            $form->setAction('/equip_types/update/' . $vals['id']);
            $form->addHidden('id')->setValue($vals['id']);
        }
        $form->addHidden('parent_id')->setValue($vals['parent_id']);

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

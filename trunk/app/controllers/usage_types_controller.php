<?php
/**
 * 使用用途管理
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class UsageTypesController extends Controller
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
        $this->view->section_title = '使用状況管理';
        $this->plugin->addBreadcrumb($this->view->section_title, '/usages/');
    }
    //}}}

    /**{{{ index()
     *
     * 使用用途一覧
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function index()
    {
        $this->view->page_title = '使用用途一覧';

        $this->view->types = $this->model('UsageTypes')->getTypes();
    }
    //}}}
    /**{{{ add()
     *
     * 使用用途登録フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function add()
    {
        $this->view->page_title = '使用用途登録';

        $this->view->form = $this->_getForm();
    }
    //}}}
    /**{{{ create()
     *
     * 使用用途登録
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
            $this->model('UsageTypes')->addType($this->post);

            $this->redirect('/' . $this->request->getController() . '/');
        }

        $this->view->setTemplate('add');

        $this->view->page_title = '使用用途登録';
        $this->view->errors = $validator->getError();
        $this->view->form = $this->_getForm($this->post);
    }
    //}}}
    /**{{{ edit()
     *
     * 使用用途変更フォーム表示
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function edit()
    {
        $this->view->page_title = '使用用途変更';

        $usage_type = $this->model('UsageTypes')->getType($this->params['id']);
        $this->view->form = $this->_getForm($usage_type, false);
    }
    //}}}
    /**{{{ update()
     *
     * 使用用途変更
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
            $this->model('UsageTypes')->updateType($this->post);

            $this->redirect('/' . $this->request->getController() . '/');
        }

        $this->view->setTemplate('edit');

        $this->view->page_title = '使用用途変更';
        $this->view->errors = $validator->getError();
        $this->view->form = $this->_getForm($this->post, false);
    }
    //}}}
    /**{{{ delete()
     *
     * 使用用途削除
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function delete()
    {
        $this->model('UsageTypes')->deleteType($this->params['id']);
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
            $form->setAction('/usage_types/create/');
        }
        else {
            $form->setAction('/usage_types/update/' . $vals['id']);
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

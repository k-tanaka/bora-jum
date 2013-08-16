<?php
/**
 * フォームのカスタムレイアウト
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

/**
 * @see FormLayoutAbstract
 */
require_once 'html/form_layout_abstract.php';

class FormLayoutCustomSubmit extends FormLayoutAbstract
{
    // Properties
    protected $_tagName = 'footer';
    protected $_sub_container;

    public function __construct(HtmlForm $form)
    {
        // サブコンテナを生成
        $this->_sub_container = HtmlElement::create('div')->setClass('submit_link');
        $this->addElement($this->_sub_container);
        parent::__construct($form);
    }

    protected function addFormElementContainer(HtmlElement $inputContainer, HtmlElement $captionContainer)
    {
        $this->_sub_container->addElement($inputContainer);
    }

    protected function _createInputContainer(FormElement $formElement)
    {
        return $formElement;
    }
}

<?php

/**
 * @see FormLayoutAbstract
 */
require_once 'html/form_layout_abstract.php';

/**
 * FormLayoutDiv
 *
 * @category   Curry
 * @package    html
 * @copyright  Copyright (c) 2013 NetComBB
 * @license    MIT License
 */
class FormLayoutCustomSubmit extends FormLayoutAbstract
{
    protected $_tagName = 'footer';

    protected $_sub_container;

    public function __construct(HtmlForm $form)
    {
        // サブコンテナを生成
        $this->_sub_container = HtmlElement::create('div')->setClass('submit_link');
        $this->addElement($this->_sub_container);
        parent::__construct($form);
    }

    /**
     * Add element of container that contains form element and caption
     * 
     * @param HtmlElement $inputContainer
     * @param HtmlElement $captionContainer
     */
    protected function addFormElementContainer(HtmlElement $inputContainer, HtmlElement $captionContainer)
    {
        $this->_sub_container->addElement($inputContainer);
    }

    protected function _createInputContainer(FormElement $formElement)
    {
        return $formElement;
    }
}

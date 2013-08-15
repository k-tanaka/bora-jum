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
class FormLayoutCustom extends FormLayoutAbstract
{    
    protected $_tagName = 'div';

    /**
     * Tag name of container that contains caption
     *
     * @var string 
     */
    protected $_captionContainerTagName = 'label';

    /**
     * Add element of container that contains form element and caption
     * 
     * @param HtmlElement $inputContainer
     * @param HtmlElement $captionContainer
     */
    protected function addFormElementContainer(HtmlElement $inputContainer, HtmlElement $captionContainer)
    {
        $this->setClass('module_content');
        $fieldset = new HtmlElement('fieldset');
        $fieldset->addElement($captionContainer);
        $fieldset->addElement($inputContainer);
        $this->addElement($fieldset);
    }
    
    protected function _createInputContainer(FormElement $formElement)
    {
        return $formElement;
    }
}

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

class FormLayoutCustom extends FormLayoutAbstract
{
    // Properties
    protected $_tagName = 'div';
    protected $_captionContainerTagName = 'label';

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

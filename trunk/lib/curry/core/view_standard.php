<?php

/**
 * @see ViewAbstract
 */
require_once 'core/view_abstract.php';

/**
 * ViewStandard
 *
 * @category   Curry
 * @package    core
 * @copyright  Copyright (c) 2011 www.curryfw.net.
 * @license    MIT License
 */
class ViewStandard extends ViewAbstract
{	
    /**
     * Execute output html without using a layout template
	 *
	 * @return void
     */
	protected function renderTemplate()
	{
		extract($this->_vars);
		
		$dir = PathManager::getViewTemplateDirectory();
		$ext = NameManager::getTemplateExtension();
		$templatePath = sprintf('%s/%s.%s', $dir, $this->_template, $ext);
		if (!file_exists($templatePath)) {
			throw new FileNotExistException($templatePath);
		}
		ob_start();
		require_once $templatePath;
		return ob_get_clean();
	}
	
    /**
     * Execute output html using a layout template
	 *
	 * @return void
     */	
	protected function renderTemplateWithLayout()
	{
		ob_start();
		extract($this->_vars);
		
		$dir = PathManager::getViewTemplateDirectory();
		$ext = NameManager::getTemplateExtension();
		$templatePath = sprintf('%s/%s.%s', $dir, $this->_template, $ext);
		if (!file_exists($templatePath)) {
			throw new FileNotExistException($templatePath);
		}
        require_once $templatePath;
		$inner_contents = ob_get_contents();
		ob_clean();
		
		$dir = PathManager::getViewLayoutDirectory();
		$layoutPath = sprintf('%s/%s.%s', $dir, $this->_layout, $ext);
		if (!file_exists($layoutPath)) {
			throw new FileNotExistException($layoutPath);
		}
		require_once $layoutPath;
		return ob_get_clean();
	}
}
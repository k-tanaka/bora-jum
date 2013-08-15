<?php

/**
 * ViewScript
 *
 * @category   Curry
 * @package    core
 * @copyright  Copyright (c) 2011 www.curryfw.net.
 * @license    MIT License
 */
class ViewScript extends CurryClass
{	
	/**
	 * View instance
	 *
	 * @var ViewAbstract extended instnace
	 */
	protected $view;
			
	/**
	 * Request instance, contains request informations
	 *
	 * @var Request
	 */
	protected $request;
	
	/**
	 * Set view instance
	 *
	 * @param ViewAbstract $view ViewAbstract extended instnace
	 * @return void
	 */
	public function setView(ViewAbstract $view)
	{
		$this->view = $view;
	}
	
	/**
	 * Set the Request instance
	 *
	 * @param Request $request Request instance
	 * @return void
	 */
	public function setRequest(Request $request)
	{
		$this->request = $request;		
	}	
	
	/**
	 * Alias of method "getVar"
	 *
	 * @param string $name
	 * @return mixed 
	 */
	public function __get($name)
	{
		return $this->getVar($name);
	}
	
	/**
	 * Alias of method "setVar"
	 * 
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value)
	{
		$this->setVar($name, $value);
	}
	
	/**
	 * Get view var
	 * 
	 * @param string $name
	 * @return mivxed
	 */
	public function getVar($name = null)
	{
		return $this->view->get($name);
	}
	
	/**
	 * Set view var
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function setVar($name, $value)
	{
		$this->view->set($name, $value);
	}
}

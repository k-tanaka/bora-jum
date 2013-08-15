<?php

/**
 * @see CurryClass
 */
require_once 'core/controller.php';

/**
 * RestController
 *
 * @category   Curry
 * @package    core
 * @copyright  Copyright (c) 2011 www.curryfw.net.
 * @license    MIT License
 */
class RestController extends Controller
{	
	/**
	 * Whether redirect to GET method in case the end of other method
	 *
	 * @var boolean 
	 */
	protected $autoRedirect = false;
	
	/**
	 * Overriding parent
	 *
	 * @return void
	 */
	public function initialize()
	{
		parent::initialize();		
		$this->view->addJs('rest');
		if ($this->request->getMethod() != 'GET') {
			$this->view->enableRendering(false);
		}
	}
	
	/**
	 * Get whether redirect to GET method in case the end of other method
	 * 
	 * @return boolean
	 */
	public function isAutoRedirect()
	{
		return $this->autoRedirect;
	}
	
	/**
	 * Getter magic method.
	 * Get rest parameters.
	 *
	 * @param string $name
	 */
	public function __get($name)
	{
		if ($name == 'restParams') {
			return $this->request->getRestParams();
		}		
		return parent::__get($name);
	}
	
}
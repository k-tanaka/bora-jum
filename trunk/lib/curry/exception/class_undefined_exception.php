<?php

/**
 * ClassUndefinedException
 *
 * @category   Curry
 * @package    exception
 * @copyright  Copyright (c) 2011 www.curryfw.net.
 * @license    MIT License
 */
class ClassUndefinedException extends Exception
{
	/**
	 * Class name
	 *
	 * @var string
	 */	
	protected $_class;
				
	/**
	 * Constructor
	 *
	 * @param string $className Class name 
	 * @return void
	 */
	public function __construct($className)
	{
		$this->_class = $className;
		parent::__construct(sprintf('class "%s" is not defined.', $className));
	}
	
	/**
	 * Get class name
	 *
	 * @return string Class name
	 */	
	public function getClass()
	{
		return $this->_class;
	}
	
}
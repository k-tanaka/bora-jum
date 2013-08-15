<?php

require_once 'core/loader.php';
		
/**
 * CurryClass
 *
 * @category   Curry
 * @package    core
 * @copyright  Copyright (c) 2011 www.curryfw.net.
 * @license    MIT License
 */
class CurryClass
{
	/**
	 * Throw exception that was going to set value to field which cannot be accessed or not difined 
	 * 
	 * @param string $name
	 * @throws MemberInaccessibleException
	 * @throws MemberUndefinedException
	 * @return void
	 */
	public function __get($name)
	{	
		$vars = get_object_vars($this);
		if (array_key_exists($name, $vars)) {
			throw new MemberInaccessibleException(get_class($this), $name);
		} else {
			throw new MemberUndefinedException(get_class($this), $name);
		}
	}

	/**
	 * Throw exception that was going to get value by field which cannot be accessed or not difined 
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @throws MemberInaccessibleException
	 * @throws MemberUndefinedException
	 */
	public function __set($name, $value)
	{	
		$vars = get_object_vars($this);
		
		if (array_key_exists($name, $vars)) {
			throw new MemberInaccessibleException(get_class($this), $name);
		} else {
			throw new MemberUndefinedException(get_class($this), $name);
		}
	}
	
	/**
	 * Throw exception that was going to call method which cannot be accessed or not difined 
	 * 
	 * @param string $name
	 * @param array $args
	 * @throws MemberInaccessibleException
	 * @throws MemberUndefinedException
	 */
	public function __call($name, $args)
	{
		$methods = get_class_methods($this);
		
		if (in_array($name, $methods)) {
			throw new MemberInaccessibleException(get_class($this), $name);
		} else {
			throw new MemberUndefinedException(get_class($this), $name);
		}
	}
	
	/**
	 * Check whether argument type is array or ArrayObject instance
	 * 
	 * @param string $methodName
	 * @param int $argumentNo
	 * @param mixed $argument
	 * @return boolean
	 * @throws ArgumentInvalidException
	 */
	protected function _checkArgumentIsArray($methodName, $argumentNo, $argument)
	{
		if (!is_array($argument) && !($argument instanceof ArrayObject)) {
			throw new ArgumentInvalidException(__METHOD__, $argument, $argumentNo, 'array or ArrayObject');
		}
		return true;
	}
	
}

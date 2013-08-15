<?php

/**
 * FileNotExistException
 *
 * @category   Curry
 * @package    exception
 * @copyright  Copyright (c) 2011 www.curryfw.net.
 * @license    MIT License
 */
class FileNotExistException extends Exception
{
	/**
	 * file name
	 *
	 * @var string
	 */	
	protected $_fileName;
				
	/**
	 * Constructor
	 *
	 * @param string $className Class name 
	 * @return void
	 */
	public function __construct($fileName)
	{
		$this->_fileName = $fileName;
		parent::__construct(sprintf('The file or directory "%s" does not exist.', $fileName));
	}
	
	/**
	 * Get class name
	 *
	 * @return string Class name
	 */	
	public function getFileName()
	{
		return $this->_fileName;
	}
	
}
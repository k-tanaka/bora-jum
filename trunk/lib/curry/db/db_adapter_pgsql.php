<?php

/**
 * @see DbAdapterAbstract
 */
require_once 'db/db_adapter_abstract.php';

/**
 *
 * @category   Curry
 * @package    db
 * @copyright  Copyright (c) 2011 www.curryfw.net.
 * @license    MIT License
*/
class DbAdapterPgsql extends DbAdapterAbstract
{
	/**
	 * Database driver name
	 * 
	 * @var string 
	 */
	protected $_driver = 'pgsql';
	
	/**
	 * Default port when it is not specified
	 * 
	 * @var int 
	 */
	protected $_defaultPort = '5432';
	
	/**
	 * Processing after connection 
	 * 
	 * @return void
	 */
	protected function postConnect()
	{	
		$this->query("SET NAMES '" . $this->_config['charset'] . "'");
	}
}

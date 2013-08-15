<?php

/**
 * @see SqlAbstract
 */
require_once 'db/sql_abstract.php';

/**
 * SqlDelete
 *
 * @category   Curry
 * @package    core
 * @copyright  Copyright (c) 2011 www.curryfw.net.
 * @license    MIT License
 */
class SqlDelete extends SqlAbstract
{		
	/**
	 * Create and return SQL sentence
	 *
	 * @return string SQL sentence
	 */
	public function getSql()
	{
		$tableName = $this->_getTableFullName();
		$sql = sprintf("DELETE FROM %s", $tableName);
		$sql .= $this->_createWhereSentence();
		return $sql;
	}
	
	/**
	 * Execute delete all rows
	 * 
	 * @return boolean
	 */
	public function truncate()
	{
		$tableName = $this->_getTableFullName();
		$sql = $this->_adapter->getTruncateSql($tableName);
		$res = $this->_adapter->query($sql);
		return $res;
	}		

}
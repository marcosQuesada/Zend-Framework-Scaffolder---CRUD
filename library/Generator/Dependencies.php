<?php

class Generator_Dependencies
{
	private static $_instance;
	private $_dependencies = array();
	
	public function getInstance()
	{
		if(!self::$_instance){
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Set current $table as a child for $fTable
	 * 
	 * @param string $table Table
	 * @param string $col Table key
	 * @param string $keyName	Table fkey name
	 * @param string $fTable Parent table
	 * @param string $fkey Parent key
	 */
	public function isChild($table, $col, $key, $fTable, $fkey)
	{
		$this->addParent($table, $col, $key, $fTable, $fkey);
		$this->addChild($fTable, $fkey, $table, $col, $key);
	}
	
	/**
	 * Add child
	 * @param unknown_type $table
	 * @param unknown_type $col
	 * @param unknown_type $childTable
	 * @param unknown_type $childCol
	 * @param unknown_type $childKey
	 */
	protected function addChild($table, $col, $childTable, $childCol, $childKey)
	{
		$this->_dependencies[$table]['children'][$childTable] = array(
			'col' => $col,
			'childKey' => $childKey,
			'childCol' => $childCol,
		);
	}
	
	/**
	 * Add parent
	 * @param unknown_type $table
	 * @param unknown_type $col
	 * @param unknown_type $key
	 * @param unknown_type $parentTable
	 * @param unknown_type $parentKey
	 */
	protected function addParent($table, $col, $key, $parentTable, $parentCol)
	{
		$this->_dependencies[$table]['parents'][$parentTable] = array(
			'parent' => $parentTable,
			'key' => $key,
			'col' => $col,
			'parentCol' => $parentCol
		);
	}
	
	/**
	 * Get table children
	 * @param string $tableName
	 * @return array
	 */
	public function getChildrenOf($tableName)
	{
		if(isset($this->_dependencies[$tableName]['children'])){
			return $this->_dependencies[$tableName]['children'];
		}else{
			return null;
		}
	}
	
	/**
	 * Get table parents
	 * @param string $tableName
	 * @return array
	 */
	public function getParentsOf($tableName)
	{
		if(isset($this->_dependencies[$tableName]['parents'])){
			return $this->_dependencies[$tableName]['parents'];
		}else{
			return null;
		}
	}
	
	/**
	 * Get dependencies for specified table
	 * @param string $tableName
	 * @return array
	 */
	public function getDependenciesFor($tableName)
	{
		if(!empty($this->_dependencies[$tableName])){
			return $this->_dependencies[$tableName];
		}
		return null;
	}
	
	/**
	 * Return dependencies as an array
	 * @return array
	 */
	public function toArray()
	{
		return $this->_dependencies;
	}
}
<?php

class Generator_Analyzer
{
	private $_table = null;
	
	public function __construct(Zend_Db_Table_Abstract $table)
	{
		$this->_table = $table;
	}
	
	/**
	 * @param Zend_Db_Table_Abstract $table
	 * @return Generator_Analyzer
	 */
	public function factory(Zend_Db_Table_Abstract $table)
	{
		return new self($table);
	}
	
	/**
	 * @return Zend_Db_Table
	 */
	protected function getTable()
	{
		return $this->_table;
	}
	
	public function parse()
	{
		$table = $this->getTable();
		
		$info = $table->info();
		$info['uniques'] = array();
		unset(
			$info['sequence'], 
			//$info['cols'], 
			$info['schema'], 
			$info['rowClass'], 
			$info['rowsetClass'],
			$info['dependentTables'],
			$info['referenceMap']
		);
		
		$adapter = $table->getAdapter();
		
		foreach ($info['metadata'] as $property => $details){
			// match php types
			$info['phptypes'][$property] = 
				$this->convertMysqlTypeToPhp($details['DATA_TYPE']);
				
			// find uniques
			$tmp = $adapter->fetchRow('DESCRIBE `'.$info['name'].'` `'.$property.'`;');
			if(!empty($tmp['Key']) && $tmp['Key'] != 'MUL'){
				$info['uniques'][$property] = $property;
			}
		}
		
		// get f-keys
		$result = $adapter->fetchAll('SHOW CREATE TABLE `' . $info['name'].'`');
		$query = $result[0]['Create Table'];
		$lines = explode("\n", $query);
		$tblinfo = array();
		$keys = array();
		foreach ($lines as $line) {
			preg_match('/^\s*CONSTRAINT `(\w+)` FOREIGN KEY \(`(\w+)`\) REFERENCES `(\w+)` \(`(\w+)`\)/',$line, $tblinfo);
			if (sizeof($tblinfo) > 0) {
				$keys[] = $tmp = array(
					'key' 		=> $tblinfo[1], 
					'column' 	=> $tblinfo[2], 
					'fk_table' 	=> $tblinfo[3], 
					'fk_column' => $tblinfo[4]
				);
				
				$this->getDependencyChecker()->isChild(
					$info['name'], 
					$tmp['column'], 
					$tmp['key'], 
					$tmp['fk_table'], 
					$tmp['fk_column']);
			}
		}
		$info['foreign_keys'] = $keys;
		//Zend_Debug::dump($info,'INFO');
		//die();
		return $info;
	}
	
	/**
	 * @return Generator_Dependencies
	 */
	public function getDependencyChecker()
	{
		return Generator_Dependencies::getInstance();
	}
	
	/**
	 * map mysql data types to php data types
	 * @param string $mysqlType
	 * @return string
	 */
	protected function convertMysqlTypeToPhp($mysqlType) {
		
		$type = 'string';
		
		// integers
		if(preg_match('#^(.*)int(.*)$#', $mysqlType)){
			$type = 'int';
		}
		
		if(preg_match('#^(.*)float(.*)$#', $mysqlType)){
			$type = 'float';
		}
		
		return $type;
	}
	
}
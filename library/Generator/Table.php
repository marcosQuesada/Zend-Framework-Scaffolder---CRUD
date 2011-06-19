<?php

/**
 * This is a model
 * 
 * @author Jacek Kobus <jacekkobus.com>
 */
class Generator_Table
{
	private $_table = null;
	private $_options = null;
	private $_analyzer = null;
	private $info = null;
	private $_dependencyChecker = null;
	
	public function __construct($table, $options)
	{
		if(is_string($table)){
			$table = new Zend_Db_Table($table);
		}
		$this->_options = $options;
		$this->_table = $table;
		$this->_analyzer = Generator_Analyzer::factory($table);
		$this->info = $this->getAnalyzer()->parse();
		$this->_dependencyChecker = $this->getAnalyzer()->getDependencyChecker();
	}
	
	public function getOptions()
	{
		return $this->_options;
	}
	
	/**
	 * @return Generator_Analyzer
	 */
	protected function getAnalyzer()
	{
		return $this->_analyzer;
	}
	
	/**
	 * @return Zend_Db_Table
	 */
	protected function getTable()
	{
		return $this->_table;
	}
	
	public function getParents()
	{
		return $this->dependency()->getParentsOf($this->getName());
	}
	
	public function getChildren()
	{
		return $this->dependency()->getChildrenOf($this->getName());
	}
	
	public function getDependentTables()
	{
		return $this->dependency()->getDependenciesFor($this->getName());
	}
	
	/**
	 * Get table name
	 * @return string
	 */
	public function getName()
	{
		return $this->info['name'];
	}
	
	public function getColumnName($column){
	    return $column["COLUMN_NAME"];
	}
	
	public function getTableIndex(){
	    return $this->getColumnName(current($this->getMetadata()));
	}
	public function getFilename()
	{
		return $this->formatFilename($this->getName());
	}

	
	public function getModelName($name = null)
	{
		if(!$name){$name=$this->getName();}
		return $this->formatClassName($name, 'model');
	}
	
	public function getTableName($name = null)
	{
		if(!$name){$name=$this->getName();}
		return $this->formatClassName($name, 'table');
	}	
	
	public function getControllerName($name = null)
	{
		if(!$name){$name=$this->getName();}
		return $this->formatClassName($name, 'controller');
	}	
	
	public function getViewName($name = null)
	{
		if(!$name){$name=$this->getName();}
		return $this->formatClassName($name, 'view');
	}		
	
	public function getBaseExtension()
	{
		return $this->getOptions()->pattern->base->extends;
	}
	
	public function getControllerExtension()
	{
		return $this->getOptions()->pattern->controller->extends;
	}	
	public function getTableExtension()
	{
		return $this->getOptions()->pattern->table->extends;
	}
	
	public function getModelFilePath()
	{
		$dir = $this->getOptions()->dir->models;
		if(!is_dir($dir)){ mkdir($dir, null, true); }
		return $dir.DIRECTORY_SEPARATOR.$this->getFilename();
	}
	
	public function getBaseFilePath()
	{
		$dir = $this->getOptions()->dir->base;
		if(!is_dir($dir)){ mkdir($dir, null, true); }
		return $dir.DIRECTORY_SEPARATOR.$this->getFilename();
	}
	
	public function getTableFilePath()
	{
		$dir = $this->getOptions()->dir->tables;
		if(!is_dir($dir)){ mkdir($dir, null, true); }
		return $dir.DIRECTORY_SEPARATOR.$this->getFilename();
	}
	
	public function getControllersFilePath()
	{
		$dir = $this->getOptions()->dir->controllers;
		if(!is_dir($dir)){ mkdir($dir, null, true); }
		return $dir.DIRECTORY_SEPARATOR.ucfirst($this->formatUnderscoreToCamel($this->getName())).'Controller.php';
	}	
	
	public function getViewsFilePath()
	{
		$dir = $this->getOptions()->dir->views;
		if(!is_dir($dir)){ mkdir($dir, null, true); }
	
		$dirDestino = $dir.DIRECTORY_SEPARATOR.str_replace('_','-',$this->getName());
		if(!is_dir($dirDestino)){ mkdir($dirDestino, null, true); }
		//reemplazar _ por - 
		
		return $dirDestino.'/index.phtml';
	}	
	
	public function getViewsAddFilePath()
	{
	    $dir = $this->getOptions()->dir->views;
		if(!is_dir($dir)){ mkdir($dir, null, true); }	    
	    $dirDestino = $dir.DIRECTORY_SEPARATOR.str_replace('_','-',$this->getName());
		if(!is_dir($dirDestino)){ mkdir($dirDestino, null, true); }
		//reemplazar _ por - 
		
		return $dirDestino.'/edit.phtml';
		
		//$dir = $this->getOptions()->dir->views;
		//if(!is_dir($dir)){ mkdir($dir, null, true); }
		//return $dir.DIRECTORY_SEPARATOR.$this->getName().'/edit.phtml';
	}		
	
	/**
	 * @return array
	 */
	public function getMetadata()
	{

		return $this->info['metadata'];

	}
	
	
	/**
	 * @param array $column
	 */
	public function getColumnMetadata($column)
	{
		return $this->info['metadata'][$column];
	}
	
	
	/**
	 * @return bool
	 */
	public function hasForeignKeys()
	{
		if(!empty($this->info['foreign_keys'])){
			return true;
		}
		return false;
	}
	
	
	/**
	 * @return array
	 */
	public function getForeignKeys()
	{
		if($this->hasForeignKeys()){
			return $this->info['foreign_keys'];
		}
		return null;
	}
	
	
	/**
	 * @return array
	 */
	public function getColumns()
	{
		return $this->info['cols'];
	}
	
	public function getProperties()
	{
		$tmp = array();
		foreach ($this->getColumns() as $id => $name){
			$tmp[$name]['type'] = $this->getTypeFor($name);
			$tmp[$name]['desc'] = $this->getMysqlDatatype($name);
		}
		return $tmp;
	}
	
	public function getMysqlDatatype($key)
	{
		$meta = $this->getMetadata();
		return $meta[$key]['DATA_TYPE'];
	}
	
	/**
	 * @return bool
	 */
	public function hasUniqueKeys()
	{
		if(!empty($this->info['uniques'])){
			return true;
		}
		return false;
	}
	
	
	/**
	 * @return bool
	 */
	public function isUniqueKey($column)
	{
		if(isset($this->info['uniques'][$column])){
			return true;
		}
		return false;
	}
	
	
	/**
	 * @return array|null
	 */
	public function getUniqueKeys()
	{
		if($this->hasUniqueKeys()){
			return $this->info['uniques'];
		}
		return null;
	}
	
	
	/**
	 * @return array
	 */
	public function getPrimary()
	{
		return $this->info['primary'];
	}
	
	/**
	 * @return string
	 */
	public function getPrimaryAsString()
	{
		$primary = $this->getPrimary();
		return 'array(\''.implode('\', \'', $primary).'\')';
	}
	
	public function getDependantTables()
	{
		$tmp = array();
		$tables = $this->dependency()->getChildrenOf($this->getName());
		if(is_array($tables)){
			foreach ($tables as $name => $smth){
				$tmp[] = $this->getTableName($name);
			}
			return $tmp;
		}else{
			return array();
		}
	}
	
	public function getDependantAsString()
	{
		$tables = $this->getDependantTables();
		if(empty($tables)){ return 'array()'; }
		$impl = implode('\', ' . PHP_EOL . '		\'', $tables);
		return 'array('. PHP_EOL .'		\''
			.$impl.'\''.PHP_EOL.'	)';
	}
	
	/**
	 * @return string|null
	 */
	public function getTypeFor($column)
	{
		if(isset($this->info['phptypes'][$column])){
			return $this->info['phptypes'][$column];
		}
		return null;
	}
	
	
	public function custom()
	{
		return $this->getOptions()->custom;
	}
	
	/**
	 * @return Generator_Dependencies
	 */
	public function dependency()
	{
		return $this->_dependencyChecker;
	}
	
	/**
	 * Format class name
	 * @param string $name
	 * @param string $type model, table, base
	 * @return string camel cased underscored class name
	 */
	protected function formatClassName($name, $type)
	{
		switch ($type){
			case 'model':
				$pattern = $this->getOptions()->pattern->model->classname;
				break;
			case 'table':
				$pattern = $this->getOptions()->pattern->table->classname;
				break;
			case 'controller':
				$pattern = $this->getOptions()->pattern->controller->classname;
				break;	
			case 'view':
				$pattern = $this->getOptions()->pattern->view->classname;
				break;							
			default:
				throw new Exception
					('Cannot generate class name. Unkown type given: '.$type);
				break;
		}
		$className = str_ireplace('{table}', $this->formatUnderscoreToCamel($name), $pattern);
		return $className;
	}
	
	/**
	 * Format underscored string to CamelCased string
	 * @param string $string
	 * @return string
	 */
	public static function formatUnderscoreToCamel($string)
	{
		$tmp = explode('_', $string);
		foreach ($tmp as &$id){$id = ucfirst($id);}$string = implode('',$tmp);
		return $string;
	}
	
	public function formatFunctionName($name)
	{
		return ucfirst($this->formatUnderscoreToCamel($name));
	}
	
	protected function formatFilename($name)
	{
		return $this->formatUnderscoreToCamel($name).'.php';
	}
}
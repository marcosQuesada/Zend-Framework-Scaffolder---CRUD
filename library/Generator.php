<?php

class Generator
{
	private $_config = null;
	private $_adapter = null;
	
	private static $_logger;
	
	public function __construct(array $config)
	{
		if(!class_exists('Zend_Loader_Autoloader', false))
			require_once 'Zend/Loader/Autoloader.php';
		Zend_Loader_Autoloader::getInstance()
			->registerNamespace('Generator');
		self::log('Zend_Autoloader started. Starting Generator.');
		$this->_config = new Zend_Config($config);
	}
	
	/**
	 * @return Zend_Config
	 */
	protected function getConfig()
	{
		return $this->_config;
	}
	
	/**
	 * @return Zend_Db_Adapter_Pdo_Mysql
	 */
	protected function getAdapter()
	{
		if(!$this->_adapter){
			self::log('Starting DB adapter ...');
			$this->_adapter = new Zend_Db_Adapter_Pdo_Mysql($this->getConfig()->db);
			Zend_Db_Table::setDefaultAdapter($this->_adapter);
		}
		self::log('DB adapter started.');
		return $this->_adapter;
	}
	
	public function generate(array $tables = null)
	{
		$time = time();
		self::log('Starting generation procedure ...');
		if(!$tables){
			self::log('Tables array was not provided; will read table list from adapter.', Zend_Log::NOTICE);
			$tables = $this->getAdapter()->listTables();
		}else{
			self::log('Using user-defined tables list.');
		}
		
		self::log('Starting renderer ...');
		//Zend_Debug::dump($this->getConfig()->generator->toArray(),'dump from config');
		$view = new Generator_Renderer($this->getConfig()->generator->toArray());
		self::log('All of '.count($tables).' tables will now be analyzed.');
		$tmp = array();
		foreach ($tables as $id => $name){
			Generator::log('Analyzing '.$name.'...');
			$tmp[$name] = new Generator_Table($name, $this->getConfig()->generator);
		}
		
		foreach ($tmp as $name => $model){
			self::log('Rendering '.$name.'.');
			Zend_Debug::dump($model,'MODEL');
			//$view->make($model);
		}

		self::log('Completed in '.(time()-$time).' seconds.');
		self::log('Enjoy!');
	}
	
	/**
	 * @return Zend_Log
	 */
	public static function log($message = null, $priority = Zend_Log::INFO)
	{
		if(!self::$_logger){
			self::$_logger = new Zend_Log(new Zend_Log_Writer_Stream('php://output'));
			self::log('Message logging enabled.');
		}
		if($message){
			self::$_logger->log($message, $priority);
		}
		return self::$_logger;
	}
}








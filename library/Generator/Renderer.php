<?php

class Generator_Renderer 
{
	const TEMPLATE_MODELS 	= './template/model.tpl';
	const TEMPLATE_TABLES 	= './template/table.tpl';
	const TEMPLATE_CONTROLLER = './template/controller.tpl';
	const TEMPLATE_VIEW = "./template/view.tpl";//tabla principal de datos (CRUD)
	const TEMPLATE_VIEW_ADD = "./template/viewadd.tpl";//include edit (form + data)
	
	private $_options = array();
	private $_storage = array();
	
	
	public function __construct(array $options = null)
	{
		$this->_options = $options;
	}
	
	protected function store($tableName, $type, $renderedTemplate)
	{
		$this->_storage[$type][$tableName] = $renderedTemplate;
	}
	
	public function makeDirectory ($dir)
	{
		if (! is_dir($dir)) {
			mkdir($dir, null, true);
		}
	}
	
	protected function getOptions()
	{
		return $this->_options;
	}
	
	public function make(Generator_Table $table)
	{
		// render model
		$result = $this->render($table, 'model', self::TEMPLATE_MODELS);
		$this->save($result, $table->getModelFilePath());
		Generator::log('Saving render model'.$table->getModelFilePath().'...');
		
		// render TEMPLATE TABLES		
		$result = $this->render($table, 'tables', self::TEMPLATE_TABLES);
		Generator::log('Saving '.$table->getTableFilePath().'...');
		$this->save($result, $table->getTableFilePath());
		
		// render TEMPLATE controller		
		$result = $this->render($table, 'controller', self::TEMPLATE_CONTROLLER);
		Generator::log('Saving '.$table->getControllersFilePath().'...');
		$this->save($result, $table->getControllersFilePath());

		// render TEMPLATE VIEW	
		$result = $this->render($table, 'view', self::TEMPLATE_VIEW);
		Generator::log('Saving '.$table->getViewsFilePath().'...');
		$this->save($result, $table->getViewsFilePath());

		// render TEMPLATE VIEW ADD EDIT	
		$result = $this->render($table, 'view', self::TEMPLATE_VIEW_ADD);
		Generator::log('Saving '.$table->getViewsAddFilePath().'...');
		$this->save($result, $table->getViewsAddFilePath());
		
		//
	}
	
	/**
	 * 
	 * @param Generator_Table $table
	 * @param string $type model|base|table
	 * @param string $template file
	 * @param mix $data optional data passed to view
	 */
	public function render($table, $type, $template, $data = null)
	{
		ob_start();
		include $template;
		$result = ob_get_clean();
		return $result;
	}
	
	public function save($data, $directory)
	{
		file_put_contents($directory, $data);
	}

}













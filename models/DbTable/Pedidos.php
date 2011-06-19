<?php

/**
 * Application_Model_DbTable_Pedidos
 * 
 * This class has been generated automatically.
 *
 * 
 * @package   	scaffolder&CRUD
 * @subpackage  Model
 * @author   	Marcos Quesada <marcos.quesadas@gmail.com>
 * @copyright	
 * @license  	Licensed 
 * @version  	SVN: $Id: Pedidos.php 19-06-2011 00:25:15 $
 */
class Application_Model_DbTable_Pedidos extends Zend_Db_Table_Abstract
{
	/**
	 * Table name
	 * @var string
	 */
	protected $_name = 'pedidos';
	
	/**
	*
	* Test de generación Atributos
	*/
		protected $_id;
		protected $_orden;
		protected $_fk_userLogin;
			protected $_fk_userLogin_value;
		/**
	 * Primary key
	 * @var string
	 */
	protected $_primary = array('id');
	
	/**
	 * Row class
	 * @var string
	 */
	//protected $_rowClass = 'Application_Model_Pedidos';//TODO:implement correct class!

	/**
	 * Reference map
	 * @var string
	 */
	protected $_referenceMap = array(
		'symbol' => array(
			'columns' => 'fk_userLogin',
			'refTableClass' => 'Application_Model_DbTable_UserLogin',
			'refColumns' => 'id'
		),
	);

	/**
	 * Dependant tables
	 * @var string
	 */
	protected $_dependentTables = array();
	/**
	* Getters & Setters
	*/

	/**
	 * Getter id
	 *
	 */
	public function getId()
	{
		return $this->_id;
	}	
	/**
	 * Getter orden
	 *
	 */
	public function getOrden()
	{
		return $this->_orden;
	}	
	/**
	 * Getter fk_userLogin
	 *
	 */
	public function getFk_userLogin()
	{
		return $this->_fk_userLogin;
	}	
	/**
	 * Setter id
	 *
	 */
	public function setId($value)
	{
		$this->_id = $value;
	}	
	/**
	 * Setter orden
	 *
	 */
	public function setOrden($value)
	{
		$this->_orden = $value;
	}	
	/**
	 * Setter fk_userLogin
	 *
	 */
	public function setFk_userLogin($value)
	{
		$this->_fk_userLogin = $value;
	}	


		

	/**
	 * Find Application_Model_Pedidos by id
	 * @return Application_Model_Pedidos
	 */
	public function findById($value)
	{
		return $this->findOneBy('id', $value);
	}

	/**
	*
	*Joined fetchAll
	*
	*/
	public function getFkUserLoginValue(){
		return $this->_fk_userLogin_value;
	}	
	
	public function setFkUserLoginValue($value){
		$this->_fk_userLogin_value = $value;
	}	
}

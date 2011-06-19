<?php

/**
 * Application_Model_DbTable_UserLogin
 * 
 * This class has been generated automatically.
 *
 * 
 * @package   	scaffolder&CRUD
 * @subpackage  Model
 * @author   	Marcos Quesada <marcos.quesadas@gmail.com>
 * @copyright	
 * @license  	Licensed 
 * @version  	SVN: $Id: UserLogin.php 19-06-2011 00:25:15 $
 */
class Application_Model_DbTable_UserLogin extends Zend_Db_Table_Abstract
{
	/**
	 * Table name
	 * @var string
	 */
	protected $_name = 'userLogin';
	
	/**
	*
	* Test de generación Atributos
	*/
		protected $_id;
		protected $_username;
		protected $_password;
		protected $_name;
		protected $_email;
			/**
	 * Primary key
	 * @var string
	 */
	protected $_primary = array('id');
	
	/**
	 * Row class
	 * @var string
	 */
	//protected $_rowClass = 'Application_Model_UserLogin';//TODO:implement correct class!

	/**
	 * Dependant tables
	 * @var string
	 */
	protected $_dependentTables = array(
		'Application_Model_DbTable_Pedidos'
	);
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
	 * Getter username
	 *
	 */
	public function getUsername()
	{
		return $this->_username;
	}	
	/**
	 * Getter password
	 *
	 */
	public function getPassword()
	{
		return $this->_password;
	}	
	/**
	 * Getter name
	 *
	 */
	public function getName()
	{
		return $this->_name;
	}	
	/**
	 * Getter email
	 *
	 */
	public function getEmail()
	{
		return $this->_email;
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
	 * Setter username
	 *
	 */
	public function setUsername($value)
	{
		$this->_username = $value;
	}	
	/**
	 * Setter password
	 *
	 */
	public function setPassword($value)
	{
		$this->_password = $value;
	}	
	/**
	 * Setter name
	 *
	 */
	public function setName($value)
	{
		$this->_name = $value;
	}	
	/**
	 * Setter email
	 *
	 */
	public function setEmail($value)
	{
		$this->_email = $value;
	}	


		

	/**
	 * Find Application_Model_UserLogin by id
	 * @return Application_Model_UserLogin
	 */
	public function findById($value)
	{
		return $this->findOneBy('id', $value);
	}

}

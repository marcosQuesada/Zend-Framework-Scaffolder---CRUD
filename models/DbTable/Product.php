<?php

/**
 * Application_Model_DbTable_Product
 * 
 * This class has been generated automatically.
 *
 * 
 * @package   	scaffolder&CRUD
 * @subpackage  Model
 * @author   	Marcos Quesada <marcos.quesadas@gmail.com>
 * @copyright	
 * @license  	Licensed 
 * @version  	SVN: $Id: Product.php 19-06-2011 00:25:15 $
 */
class Application_Model_DbTable_Product extends Zend_Db_Table_Abstract
{
	/**
	 * Table name
	 * @var string
	 */
	protected $_name = 'product';
	
	/**
	*
	* Test de generación Atributos
	*/
		protected $_category;
		protected $_id;
		protected $_price;
			/**
	 * Primary key
	 * @var string
	 */
	protected $_primary = array('category', 'id');
	
	/**
	 * Row class
	 * @var string
	 */
	//protected $_rowClass = 'Application_Model_Product';//TODO:implement correct class!
	/**
	* Getters & Setters
	*/

	/**
	 * Getter category
	 *
	 */
	public function getCategory()
	{
		return $this->_category;
	}	
	/**
	 * Getter id
	 *
	 */
	public function getId()
	{
		return $this->_id;
	}	
	/**
	 * Getter price
	 *
	 */
	public function getPrice()
	{
		return $this->_price;
	}	
	/**
	 * Setter category
	 *
	 */
	public function setCategory($value)
	{
		$this->_category = $value;
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
	 * Setter price
	 *
	 */
	public function setPrice($value)
	{
		$this->_price = $value;
	}	


		

	/**
	 * Find Application_Model_Product by category
	 * @return Application_Model_Product
	 */
	public function findByCategory($value)
	{
		return $this->findOneBy('category', $value);
	}

	/**
	 * Find Application_Model_Product by id
	 * @return Application_Model_Product
	 */
	public function findById($value)
	{
		return $this->findOneBy('id', $value);
	}

}

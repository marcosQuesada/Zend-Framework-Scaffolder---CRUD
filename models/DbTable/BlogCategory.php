<?php

/**
 * Application_Model_DbTable_BlogCategory
 * 
 * This class has been generated automatically.
 *
 * 
 * @package   	scaffolder&CRUD
 * @subpackage  Model
 * @author   	Marcos Quesada <marcos.quesadas@gmail.com>
 * @copyright	
 * @license  	Licensed 
 * @version  	SVN: $Id: BlogCategory.php 15-06-2011 23:24:12 $
 */
class Application_Model_DbTable_BlogCategory extends Zend_Db_Table_Abstract
{
	/**
	 * Table name
	 * @var string
	 */
	protected $_name = 'blog_category';
	
	/**
	*
	* Test de generación Atributos
	*/
		protected $_id;
		protected $_nombre_es;
		protected $_nombre_ca;
		protected $_permalink_es;
		protected $_permalink_ca;
		protected $_fk_blog_category;
		protected $_descripcion_es;
		protected $_descripcion_ca;
		protected $_classname_es;
		protected $_classname_ca;
		protected $_publicada;
		/**
	 * Primary key
	 * @var string
	 */
	protected $_primary = array('id');
	
	/**
	 * Row class
	 * @var string
	 */
	//protected $_rowClass = 'Application_Model_BlogCategory';//TODO:implement correct class!
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
	 * Getter nombre_es
	 *
	 */
	public function getNombre_es()
	{
		return $this->_nombre_es;
	}	
	/**
	 * Getter nombre_ca
	 *
	 */
	public function getNombre_ca()
	{
		return $this->_nombre_ca;
	}	
	/**
	 * Getter permalink_es
	 *
	 */
	public function getPermalink_es()
	{
		return $this->_permalink_es;
	}	
	/**
	 * Getter permalink_ca
	 *
	 */
	public function getPermalink_ca()
	{
		return $this->_permalink_ca;
	}	
	/**
	 * Getter fk_blog_category
	 *
	 */
	public function getFk_blog_category()
	{
		return $this->_fk_blog_category;
	}	
	/**
	 * Getter descripcion_es
	 *
	 */
	public function getDescripcion_es()
	{
		return $this->_descripcion_es;
	}	
	/**
	 * Getter descripcion_ca
	 *
	 */
	public function getDescripcion_ca()
	{
		return $this->_descripcion_ca;
	}	
	/**
	 * Getter classname_es
	 *
	 */
	public function getClassname_es()
	{
		return $this->_classname_es;
	}	
	/**
	 * Getter classname_ca
	 *
	 */
	public function getClassname_ca()
	{
		return $this->_classname_ca;
	}	
	/**
	 * Getter publicada
	 *
	 */
	public function getPublicada()
	{
		return $this->_publicada;
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
	 * Setter nombre_es
	 *
	 */
	public function setNombre_es($value)
	{
		$this->_nombre_es = $value;
	}	
	/**
	 * Setter nombre_ca
	 *
	 */
	public function setNombre_ca($value)
	{
		$this->_nombre_ca = $value;
	}	
	/**
	 * Setter permalink_es
	 *
	 */
	public function setPermalink_es($value)
	{
		$this->_permalink_es = $value;
	}	
	/**
	 * Setter permalink_ca
	 *
	 */
	public function setPermalink_ca($value)
	{
		$this->_permalink_ca = $value;
	}	
	/**
	 * Setter fk_blog_category
	 *
	 */
	public function setFk_blog_category($value)
	{
		$this->_fk_blog_category = $value;
	}	
	/**
	 * Setter descripcion_es
	 *
	 */
	public function setDescripcion_es($value)
	{
		$this->_descripcion_es = $value;
	}	
	/**
	 * Setter descripcion_ca
	 *
	 */
	public function setDescripcion_ca($value)
	{
		$this->_descripcion_ca = $value;
	}	
	/**
	 * Setter classname_es
	 *
	 */
	public function setClassname_es($value)
	{
		$this->_classname_es = $value;
	}	
	/**
	 * Setter classname_ca
	 *
	 */
	public function setClassname_ca($value)
	{
		$this->_classname_ca = $value;
	}	
	/**
	 * Setter publicada
	 *
	 */
	public function setPublicada($value)
	{
		$this->_publicada = $value;
	}	


		

	/**
	 * Find Application_Model_BlogCategory by id
	 * @return Application_Model_BlogCategory
	 */
	public function findById($value)
	{
		return $this->findOneBy('id', $value);
	}
}

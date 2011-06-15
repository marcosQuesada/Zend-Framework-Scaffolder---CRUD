<?php

/**
 * Application_Model_BlogCategory
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
class Application_Model_BlogCategory
{
	protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_BlogCategory');
        }
        return $this->_dbTable;
    }

    public function bindPost($post){
        $blog_category = new Application_Model_DbTable_BlogCategory();
  		  		
  		if (isset($post['id'])){
            $id = $post['id'];
        }else{
            $id=NULL;
	    }
		$blog_category->setId($id);
	      		
  		if (isset($post['nombre_es'])){
            $nombre_es = $post['nombre_es'];
        }else{
            $nombre_es=NULL;
	    }
		$blog_category->setNombre_es($nombre_es);
	      		
  		if (isset($post['nombre_ca'])){
            $nombre_ca = $post['nombre_ca'];
        }else{
            $nombre_ca=NULL;
	    }
		$blog_category->setNombre_ca($nombre_ca);
	      		
  		if (isset($post['permalink_es'])){
            $permalink_es = $post['permalink_es'];
        }else{
            $permalink_es=NULL;
	    }
		$blog_category->setPermalink_es($permalink_es);
	      		
  		if (isset($post['permalink_ca'])){
            $permalink_ca = $post['permalink_ca'];
        }else{
            $permalink_ca=NULL;
	    }
		$blog_category->setPermalink_ca($permalink_ca);
	      		
  		if (isset($post['fk_blog_category'])){
            $fk_blog_category = $post['fk_blog_category'];
        }else{
            $fk_blog_category=NULL;
	    }
		$blog_category->setFk_blog_category($fk_blog_category);
	      		
  		if (isset($post['descripcion_es'])){
            $descripcion_es = $post['descripcion_es'];
        }else{
            $descripcion_es=NULL;
	    }
		$blog_category->setDescripcion_es($descripcion_es);
	      		
  		if (isset($post['descripcion_ca'])){
            $descripcion_ca = $post['descripcion_ca'];
        }else{
            $descripcion_ca=NULL;
	    }
		$blog_category->setDescripcion_ca($descripcion_ca);
	      		
  		if (isset($post['classname_es'])){
            $classname_es = $post['classname_es'];
        }else{
            $classname_es=NULL;
	    }
		$blog_category->setClassname_es($classname_es);
	      		
  		if (isset($post['classname_ca'])){
            $classname_ca = $post['classname_ca'];
        }else{
            $classname_ca=NULL;
	    }
		$blog_category->setClassname_ca($classname_ca);
	      		
  		if (isset($post['publicada'])){
            $publicada = $post['publicada'];
        }else{
            $publicada=NULL;
	    }
		$blog_category->setPublicada($publicada);
	    
        return $blog_category;
    }
    
    public function save(Application_Model_DbTable_BlogCategory $blog_category)
    {
        $data = array(
          
        	'id' => $blog_category->getId(),
          
        	'nombre_es' => $blog_category->getNombre_es(),
          
        	'nombre_ca' => $blog_category->getNombre_ca(),
          
        	'permalink_es' => $blog_category->getPermalink_es(),
          
        	'permalink_ca' => $blog_category->getPermalink_ca(),
          
        	'fk_blog_category' => $blog_category->getFk_blog_category(),
          
        	'descripcion_es' => $blog_category->getDescripcion_es(),
          
        	'descripcion_ca' => $blog_category->getDescripcion_ca(),
          
        	'classname_es' => $blog_category->getClassname_es(),
          
        	'classname_ca' => $blog_category->getClassname_ca(),
          
        	'publicada' => $blog_category->getPublicada(),
        
        );
		
        if (null === ($id = $blog_category->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id)
    {
        $blog_category = new Application_Model_DbTable_BlogCategory();
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
          
        $blog_category->setId($row->id);
          
        $blog_category->setNombre_es($row->nombre_es);
          
        $blog_category->setNombre_ca($row->nombre_ca);
          
        $blog_category->setPermalink_es($row->permalink_es);
          
        $blog_category->setPermalink_ca($row->permalink_ca);
          
        $blog_category->setFk_blog_category($row->fk_blog_category);
          
        $blog_category->setDescripcion_es($row->descripcion_es);
          
        $blog_category->setDescripcion_ca($row->descripcion_ca);
          
        $blog_category->setClassname_es($row->classname_es);
          
        $blog_category->setClassname_ca($row->classname_ca);
          
        $blog_category->setPublicada($row->publicada);
                 
        return $blog_category;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_DbTable_BlogCategory();
              
        	$entry->setId($row->id);
              
        	$entry->setNombre_es($row->nombre_es);
              
        	$entry->setNombre_ca($row->nombre_ca);
              
        	$entry->setPermalink_es($row->permalink_es);
              
        	$entry->setPermalink_ca($row->permalink_ca);
              
        	$entry->setFk_blog_category($row->fk_blog_category);
              
        	$entry->setDescripcion_es($row->descripcion_es);
              
        	$entry->setDescripcion_ca($row->descripcion_ca);
              
        	$entry->setClassname_es($row->classname_es);
              
        	$entry->setClassname_ca($row->classname_ca);
              
        	$entry->setPublicada($row->publicada);
                        

            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function delete($id){
        $this->getDbTable()->delete('id =' . (int)$id);
    }
    
 
}

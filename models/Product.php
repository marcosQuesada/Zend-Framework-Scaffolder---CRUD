<?php

/**
 * Application_Model_Product
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
class Application_Model_Product
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
            $this->setDbTable('Application_Model_DbTable_Product');
        }
        return $this->_dbTable;
    }

    public function bindPost($post){
        $product = new Application_Model_DbTable_Product();
  		  		
  		if (isset($post['category'])){
            $category = $post['category'];
        }else{
            $category=NULL;
	    }
		$product->setCategory($category);
	      		
  		if (isset($post['id'])){
            $id = $post['id'];
        }else{
            $id=NULL;
	    }
		$product->setId($id);
	      		
  		if (isset($post['price'])){
            $price = $post['price'];
        }else{
            $price=NULL;
	    }
		$product->setPrice($price);
	    
        return $product;
    }
    
    public function save(Application_Model_DbTable_Product $product)
    {
        $data = array(
          
        	'category' => $product->getCategory(),
          
        	'id' => $product->getId(),
          
        	'price' => $product->getPrice(),
        
        );
		
        if (null === ($id = $product->getCategory())) {
            unset($data['category']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('category = ?' => $id));
        }
    }

    public function find($id)
    {
        $product = new Application_Model_DbTable_Product();
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
          
        $product->setCategory($row->category);
          
        $product->setId($row->id);
          
        $product->setPrice($row->price);
                 
        return $product;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_DbTable_Product();
              
        	$entry->setCategory($row->category);
              
        	$entry->setId($row->id);
              
        	$entry->setPrice($row->price);
                        

            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function delete($id){
        $this->getDbTable()->delete('category =' . (int)$id);
    }
    
 	}

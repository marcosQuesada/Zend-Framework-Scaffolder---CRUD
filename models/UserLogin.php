<?php

/**
 * Application_Model_UserLogin
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
class Application_Model_UserLogin
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
            $this->setDbTable('Application_Model_DbTable_UserLogin');
        }
        return $this->_dbTable;
    }

    public function bindPost($post){
        $userLogin = new Application_Model_DbTable_UserLogin();
  		  		
  		if (isset($post['id'])){
            $id = $post['id'];
        }else{
            $id=NULL;
	    }
		$userLogin->setId($id);
	      		
  		if (isset($post['username'])){
            $username = $post['username'];
        }else{
            $username=NULL;
	    }
		$userLogin->setUsername($username);
	      		
  		if (isset($post['password'])){
            $password = $post['password'];
        }else{
            $password=NULL;
	    }
		$userLogin->setPassword($password);
	      		
  		if (isset($post['name'])){
            $name = $post['name'];
        }else{
            $name=NULL;
	    }
		$userLogin->setName($name);
	      		
  		if (isset($post['email'])){
            $email = $post['email'];
        }else{
            $email=NULL;
	    }
		$userLogin->setEmail($email);
	    
        return $userLogin;
    }
    
    public function save(Application_Model_DbTable_UserLogin $userLogin)
    {
        $data = array(
          
        	'id' => $userLogin->getId(),
          
        	'username' => $userLogin->getUsername(),
          
        	'password' => $userLogin->getPassword(),
          
        	'name' => $userLogin->getName(),
          
        	'email' => $userLogin->getEmail(),
        
        );
		
        if (null === ($id = $userLogin->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id)
    {
        $userLogin = new Application_Model_DbTable_UserLogin();
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
          
        $userLogin->setId($row->id);
          
        $userLogin->setUsername($row->username);
          
        $userLogin->setPassword($row->password);
          
        $userLogin->setName($row->name);
          
        $userLogin->setEmail($row->email);
                 
        return $userLogin;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_DbTable_UserLogin();
              
        	$entry->setId($row->id);
              
        	$entry->setUsername($row->username);
              
        	$entry->setPassword($row->password);
              
        	$entry->setName($row->name);
              
        	$entry->setEmail($row->email);
                        

            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function delete($id){
        $this->getDbTable()->delete('id =' . (int)$id);
    }
    
 	}

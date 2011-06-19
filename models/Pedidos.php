<?php

/**
 * Application_Model_Pedidos
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
class Application_Model_Pedidos
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
            $this->setDbTable('Application_Model_DbTable_Pedidos');
        }
        return $this->_dbTable;
    }

    public function bindPost($post){
        $pedidos = new Application_Model_DbTable_Pedidos();
  		  		
  		if (isset($post['id'])){
            $id = $post['id'];
        }else{
            $id=NULL;
	    }
		$pedidos->setId($id);
	      		
  		if (isset($post['orden'])){
            $orden = $post['orden'];
        }else{
            $orden=NULL;
	    }
		$pedidos->setOrden($orden);
	      		
  		if (isset($post['fk_userLogin'])){
            $fk_userLogin = $post['fk_userLogin'];
        }else{
            $fk_userLogin=NULL;
	    }
		$pedidos->setFk_userLogin($fk_userLogin);
	    
        return $pedidos;
    }
    
    public function save(Application_Model_DbTable_Pedidos $pedidos)
    {
        $data = array(
          
        	'id' => $pedidos->getId(),
          
        	'orden' => $pedidos->getOrden(),
          
        	'fk_userLogin' => $pedidos->getFk_userLogin(),
        
        );
		
        if (null === ($id = $pedidos->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id)
    {
        $pedidos = new Application_Model_DbTable_Pedidos();
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
          
        $pedidos->setId($row->id);
          
        $pedidos->setOrden($row->orden);
          
        $pedidos->setFk_userLogin($row->fk_userLogin);
                 
        return $pedidos;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_DbTable_Pedidos();
              
        	$entry->setId($row->id);
              
        	$entry->setOrden($row->orden);
              
        	$entry->setFk_userLogin($row->fk_userLogin);
                        

            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function delete($id){
        $this->getDbTable()->delete('id =' . (int)$id);
    }
    
 	 	
 	public function JoinedFetchAll($id){
        $pedidos = new Application_Model_DbTable_Pedidos();
        $select = $pedidos->select();
		$select->setIntegrityCheck(false);

		$select->from('pedidos', 'pedidos.*');		
		$select->joinLeft('userLogin','pedidos.fk_userLogin = userLogin.id', array('nombre' => 'nom_ca'));					
		$select->where("pedidos.fk_dcc_casa = $id");						
		$resultSet = $pedidos->fetchAll($select);
		
	    $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_DbTable_Pedidos();
              
        	$entry->setId($row->id);
              
        	$entry->setOrden($row->orden);
              
        	$entry->setFk_userLogin($row->fk_userLogin);
                        
            //@TODO:RESOLVER EL NOMBRE DE LA COLUMNA REMOTA A TRAER
			$entry->_nombre=$row->nombre;
            
            $entries[] = $entry;
		}
        return $entries;
    }
    }

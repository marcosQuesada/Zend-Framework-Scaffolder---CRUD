<?php

/**
 * PedidosController
 * 
 * This class has been generated automatically.
 * 
 * @property int 	$id 	int
 * @property int 	$orden 	int
 * @property int 	$fk_userLogin 	int
 *
 * @package   	scaffolder&CRUD
 * @subpackage  Model
 * @author   	Marcos Quesada <marcos.quesadas@gmail.com>
 * @copyright	
 * @license  	Licensed 
 * @version  	SVN: $Id: Pedidos.php 19-06-2011 00:25:15 $
 */
class PedidosController extends Zend_Controller_Action
{
	public function init()
    {
       /* Initialize action controller here */
    	/*$this->view->addHelperPath(
    		'ZendX/JQuery/View/Helper',
    		'ZendX_JQuery_View_Helper');*/
    }

	public function preDispatch() {
	}
    public function indexAction()
    {
        $pedidos = new Application_Model_Pedidos();        
        if($this->getRequest()->isPost()){
            $values= $this->getRequest()->getParams();
            $valuesObject = $pedidos->bindPost($values);
            $pedidos->save($valuesObject);
        }
        
        $result = $pedidos->fetchAll();
        $this->view->result = $result;  
 
		// Asignamos a la vista el resultado de consultar por todos los registros
		$this->view->pedidos = $pedidos->fetchAll();
    }


    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $pedidos = new Application_Model_Pedidos();
        $data = $pedidos->find($id);
        $this->view->data = $data;
    }

    public function deleteAction()
    {
        $pedidos = new Application_Model_Pedidos();
        $id = $this->getRequest()->getParam('id');
        $pedidos->delete($id);
        $this->_redirect('pedidos/index');
    }
}

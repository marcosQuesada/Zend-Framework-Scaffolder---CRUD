<?php

/**
 * ProductController
 * 
 * This class has been generated automatically.
 * 
 * @property int 	$category 	int
 * @property int 	$id 	int
 * @property string 	$price 	decimal
 *
 * @package   	scaffolder&CRUD
 * @subpackage  Model
 * @author   	Marcos Quesada <marcos.quesadas@gmail.com>
 * @copyright	
 * @license  	Licensed 
 * @version  	SVN: $Id: Product.php 19-06-2011 00:25:15 $
 */
class ProductController extends Zend_Controller_Action
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
        $product = new Application_Model_Product();        
        if($this->getRequest()->isPost()){
            $values= $this->getRequest()->getParams();
            $valuesObject = $product->bindPost($values);
            $product->save($valuesObject);
        }
        
        $result = $product->fetchAll();
        $this->view->result = $result;  
 
		// Asignamos a la vista el resultado de consultar por todos los registros
		$this->view->product = $product->fetchAll();
    }


    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $product = new Application_Model_Product();
        $data = $product->find($id);
        $this->view->data = $data;
    }

    public function deleteAction()
    {
        $product = new Application_Model_Product();
        $id = $this->getRequest()->getParam('id');
        $product->delete($id);
        $this->_redirect('product/index');
    }
}

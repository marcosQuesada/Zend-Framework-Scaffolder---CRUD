<?php

/**
 * UserLoginController
 * 
 * This class has been generated automatically.
 * 
 * @property int 	$id 	int
 * @property string 	$username 	varchar
 * @property string 	$password 	varchar
 * @property string 	$name 	varchar
 * @property string 	$email 	varchar
 *
 * @package   	scaffolder&CRUD
 * @subpackage  Model
 * @author   	Marcos Quesada <marcos.quesadas@gmail.com>
 * @copyright	
 * @license  	Licensed 
 * @version  	SVN: $Id: UserLogin.php 19-06-2011 00:25:15 $
 */
class UserLoginController extends Zend_Controller_Action
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
        $userLogin = new Application_Model_UserLogin();        
        if($this->getRequest()->isPost()){
            $values= $this->getRequest()->getParams();
            $valuesObject = $userLogin->bindPost($values);
            $userLogin->save($valuesObject);
        }
        
        $result = $userLogin->fetchAll();
        $this->view->result = $result;  
 
		// Asignamos a la vista el resultado de consultar por todos los registros
		$this->view->userLogin = $userLogin->fetchAll();
    }


    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $userLogin = new Application_Model_UserLogin();
        $data = $userLogin->find($id);
        $this->view->data = $data;
    }

    public function deleteAction()
    {
        $userLogin = new Application_Model_UserLogin();
        $id = $this->getRequest()->getParam('id');
        $userLogin->delete($id);
        $this->_redirect('userLogin/index');
    }
}

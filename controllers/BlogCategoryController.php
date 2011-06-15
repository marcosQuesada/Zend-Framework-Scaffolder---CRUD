<?php

/**
 * BlogCategoryController
 * 
 * This class has been generated automatically.
 * 
 * @property int 	$id 	int
 * @property string 	$nombre_es 	varchar
 * @property string 	$nombre_ca 	varchar
 * @property string 	$permalink_es 	varchar
 * @property string 	$permalink_ca 	varchar
 * @property int 	$fk_blog_category 	int
 * @property string 	$descripcion_es 	text
 * @property string 	$descripcion_ca 	text
 * @property string 	$classname_es 	varchar
 * @property string 	$classname_ca 	varchar
 * @property int 	$publicada 	tinyint
 *
 * @package   	scaffolder&CRUD
 * @subpackage  Model
 * @author   	Marcos Quesada <marcos.quesadas@gmail.com>
 * @copyright	
 * @license  	Licensed 
 * @version  	SVN: $Id: BlogCategory.php 15-06-2011 23:24:12 $
 */
class BlogCategoryController extends Zend_Controller_Action
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
        $blog_category = new Application_Model_BlogCategory();        
        if($this->getRequest()->isPost()){
            $values= $this->getRequest()->getParams();
            $valuesObject = $blog_category->bindPost($values);
            $blog_category->save($valuesObject);
        }
        
        $result = $blog_category->fetchAll();
        $this->view->result = $result;  
 
		// Asignamos a la vista el resultado de consultar por todos los registros
		$this->view->blog_category = $blog_category->fetchAll();
    }


    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $blog_category = new Application_Model_BlogCategory();
        $data = $blog_category->find($id);
        $this->view->data = $data;
    }

    public function deleteAction()
    {
        $blog_category = new Application_Model_BlogCategory();
        $id = $this->getRequest()->getParam('id');
        $blog_category->delete($id);
        $this->_redirect('blog-category/index');
    }
}

<?

/**
 * Controller template base
 */

/* @var $table Generator_Table */

?>
<?='<?php' . PHP_EOL?>

/**
 * <?=$table->getControllerName() . PHP_EOL?>
 * 
 * This class has been generated automatically.
 * 
<?foreach($table->getProperties() as $pname => $property):?>
 * @property <?=$property['type']?> 	$<?=$pname?> 	<?=$property['desc'] . PHP_EOL?>
<?endforeach;?>
 *
<?if(!empty($data['methods']['doc'])):?>
<?foreach($data['methods']['doc'] as $mname => $mclass):?>
 * @method <?=$mclass?> <?=$mname?>()
<?endforeach;?>
 * 
<?endif?>
 * @package   	<?=$table->custom()->package . PHP_EOL?>
 * @subpackage  <?=$table->custom()->subPackage . PHP_EOL?>
 * @author   	<?=$table->custom()->author?> <<?=$table->custom()->email?>>
 * @copyright	<?=$table->custom()->copyright . PHP_EOL?>
 * @license  	<?=$table->custom()->license . PHP_EOL?>
 * @version  	SVN: $Id: <?=$table->getFilename()?> <?=date('d-m-Y H:i:s')?> $
 */
class <?=$table->getControllerName()?> extends <?=$table->getControllerExtension(). PHP_EOL?>
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
        $<?=$table->getName();?> = new <?=$table->getModelName()?>();        
        if($this->getRequest()->isPost()){
            $values= $this->getRequest()->getParams();
            $valuesObject = $<?=$table->getName();?>->bindPost($values);
            $<?=$table->getName();?>->save($valuesObject);
        }
        
        $result = $<?=$table->getName();?>->fetchAll();
        $this->view->result = $result;  
 
		// Asignamos a la vista el resultado de consultar por todos los registros
		$this->view-><?=$table->getName();?> = $<?=$table->getName();?>->fetchAll();
    }


    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $<?=$table->getName();?> = new <?=$table->getModelName()?>();
        $data = $<?=$table->getName();?>->find($id);
        $this->view->data = $data;
    }

    public function deleteAction()
    {
        $<?=$table->getName();?> = new <?=$table->getModelName()?>();
        $id = $this->getRequest()->getParam('id');
        $<?=$table->getName();?>->delete($id);
        $this->_redirect('<?=str_replace('_','-',$table->getName());?>/index');
    }
}

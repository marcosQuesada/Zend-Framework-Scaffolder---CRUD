<?

/**
 * Model template base
 */

/* @var $table Generator_Table */

?>
<?='<?php' . PHP_EOL?>

/**
 * <?=$table->getBaseName() . PHP_EOL?>
 * 
 * This class has been generated automatically by Jack's generator.
 * More info can be found at: http://blog.jacekkobus.com
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
class <?=$table->getBaseName()?> extends <?=$table->getBaseExtension() . PHP_EOL?>
{

<?if(!empty($data['methods'])):?>
<?if(isset($data['methods']['children'])):?>
<?foreach($data['methods']['children'] as $id => $function):?>
	/**
	 * Find dependent <?=$function['class'] . PHP_EOL?>
	 * 
	 * @param Zend_Db_Table_Select $select
	 * @return Zend_Db_Table_Rowset_Abstract or NULL
	 */
	public function find<?=$function['function']?>($select = null)
	{
		return $this->findDependentRowset(new <?=$function['table']?>(), null, $select);
	}

	/**
	 * Create new <?=$function['class']?> row for <?=$table->getName() . PHP_EOL?>
	 * 
	 * @param array $data
	 * @return <?=$function['class'] . PHP_EOL?>
	 */
	public function create<?=$function['function']?>(array $data = null)
	{
		$data['<?=$function['childCol']?>'] = $this-><?=$function['col']?>;
		$table = new <?=$function['table']?>();
		$row = $table->createRow()->setFromArray($data);
		return $row;
	}

<?endforeach?>
<?endif?>
<?if(isset($data['methods']['parents'])):?>
<?foreach($data['methods']['parents'] as $id => $function):?>
	/**
	 * Find parent <?=$function['class'] . PHP_EOL?>
	 * 
	 * @param Zend_Db_Table_Select $select
	 * @return <?=$function['class']?> or NULL
	 */
	public function find<?=$function['function']?>($select = null)
	{
		return $this->findParentRow(new <?=$function['table']?>(), null, $select);
	}

<?endforeach?>
<?endif?>
<?endif?>
}

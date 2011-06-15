<?

/**
 * Model Base Table template
 */

/* @var $table Generator_Table */



$parents = $table->getParents();
if(!empty($parents)){
	
	$refMap = '';
	foreach ($parents as $pTable => $refs){
		
		$refMap .= '		\''.$refs['key'].'\' => array(' . PHP_EOL;
		$refMap .= '			\'columns\' => \''.$refs['col'].'\',' . PHP_EOL;
		$refMap .= '			\'refTableClass\' => \''.$table->getTableName($pTable).'\',' . PHP_EOL;
		$refMap .= '			\'refColumns\' => \''.$refs['parentCol'].'\'' . PHP_EOL;
		$refMap .= '		),' . PHP_EOL;
		
	}
	
	//$refMap = 'array('.$refMap.')';
	$parents = $refMap;
}

?>
<?='<?php' . PHP_EOL?>

/**
 * <?=$table->getTableName() . PHP_EOL?>
 * 
 * This class has been generated automatically.
 *
 * 
<?if(!empty($methods)):?>
<?foreach($methods as $mname => $mclass):?>
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
class <?=$table->getTableName()?> extends <?=$table->getTableExtension() . PHP_EOL?>
{
	/**
	 * Table name
	 * @var string
	 */
	protected $_name = '<?=$table->getName()?>';
	
	/**
	*
	* Test de generación Atributos
	*/
	<?php foreach ($table->getMetadata() AS $column):?>
	protected $_<?=$column["COLUMN_NAME"]?>;
	<?endforeach;?>
	/**
	 * Primary key
	 * @var string
	 */
	protected $_primary = <?=$table->getPrimaryAsString()?>;
	
	/**
	 * Row class
	 * @var string
	 */
	//protected $_rowClass = '<?=$table->getModelName()?>';//TODO:implement correct class!
<?if(!empty($parents)):?>

	/**
	 * Reference map
	 * @var string
	 */
	protected $_referenceMap = array(
<?=$parents?>
	);
<?endif?>
<?if($table->getDependentTables()):?>

	/**
	 * Dependant tables
	 * @var string
	 */
	protected $_dependentTables = <?=$table->getDependantAsString()?>;
<?endif?>
	/**
	* Getters & Setters
	*/

<?php foreach ($table->getMetadata() AS $column):?>
	/**
	 * Getter <?=$column["COLUMN_NAME"]. PHP_EOL?>
	 *
	 */
	public function get<?=ucfirst($column["COLUMN_NAME"])?>()
	{
		return $this->_<?=$column["COLUMN_NAME"]?>;
	}	
<?endforeach;?>
<?php foreach ($table->getMetadata() AS $column):?>
	/**
	 * Setter <?=$column["COLUMN_NAME"]. PHP_EOL?>
	 *
	 */
	public function set<?=ucfirst($column["COLUMN_NAME"])?>($value)
	{
		$this->_<?=$column["COLUMN_NAME"]?> = $value;
	}	
<?endforeach;?>


		
<?if($table->getUniqueKeys()):?>
<?foreach ($table->getUniqueKeys() as $id => $key):?>

	/**
	 * Find <?=$table->getModelName()?> by <?=$key . PHP_EOL?>
	 * @return <?=$table->getModelName() . PHP_EOL?>
	 */
	public function findBy<?=$table->formatFunctionName($key)?>($value)
	{
		return $this->findOneBy('<?=$key?>', $value);
	}
<?endforeach;?>
<?endif?>
}

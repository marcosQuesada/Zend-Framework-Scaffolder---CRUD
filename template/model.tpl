<?

/**
 * Model Mapper template
 */

/* @var $table Generator_Table */

?>
<?='<?php' . PHP_EOL?>

/**
 * <?=$table->getModelName() . PHP_EOL?>
 * 
 * This class has been generated automatically.
 *
 * 
 * @package   	<?=$table->custom()->package . PHP_EOL?>
 * @subpackage  <?=$table->custom()->subPackage . PHP_EOL?>
 * @author   	<?=$table->custom()->author?> <<?=$table->custom()->email?>>
 * @copyright	<?=$table->custom()->copyright . PHP_EOL?>
 * @license  	<?=$table->custom()->license . PHP_EOL?>
 * @version  	SVN: $Id: <?=$table->getFilename()?> <?=date('d-m-Y H:i:s')?> $
 */
class <?=$table->getModelName(). PHP_EOL?>
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
            $this->setDbTable('<?=$table->getTableName()?>');
        }
        return $this->_dbTable;
    }

    public function bindPost($post){
        $<?=$table->getName();?> = new <?=$table->getTableName()?>();
  		<?php foreach ($table->getMetadata() AS $column):?>  		
  		if (isset($post['<?=$column["COLUMN_NAME"]?>'])){
            $<?=$table->getColumnName($column)?> = $post['<?=$table->getColumnName($column)?>'];
        }else{
            $<?=$table->getColumnName($column)?>=NULL;
	    }
		$<?=$table->getName();?>->set<?= ucfirst($table->getColumnName($column))?>($<?=$table->getColumnName($column)?>);
	    <?endforeach;?>

        return $<?=$table->getName();?>;
    }
    
    public function save(<?=$table->getTableName()?> $<?=$table->getName();?>)
    {
        $data = array(
        <?php foreach ($table->getMetadata() AS $column):?>  
        	'<?=$table->getColumnName($column)?>' => $<?=$table->getName();?>->get<?=ucfirst($table->getColumnName($column))?>(),
        <?endforeach;?>

        );
		
        if (null === ($id = $<?=$table->getName();?>->get<?=ucfirst($table->getTableIndex())?>())) {
            unset($data['<?php echo $table->getTableIndex()?>']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('<?php echo $table->getTableIndex()?> = ?' => $id));
        }
    }

    public function find($id)
    {
        $<?=$table->getName();?> = new <?=$table->getTableName()?>();
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        <?php foreach ($table->getMetadata() AS $column):?>  
        $<?=$table->getName();?>->set<?=ucfirst($table->getColumnName($column))?>($row-><?=$table->getColumnName($column)?>);
        <?endforeach;?>
         
        return $<?=$table->getName();?>;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new <?=$table->getTableName()?>();
            <?php foreach ($table->getMetadata() AS $column):?>  
        	$entry->set<?=ucfirst($table->getColumnName($column))?>($row-><?=$table->getColumnName($column)?>);
            <?endforeach;?>            

            $entries[] = $entry;
        }
        return $entries;
    }
    
    public function delete($id){
        $this->getDbTable()->delete('<?php echo $table->getTableIndex()?> =' . (int)$id);
    }
    
 
}

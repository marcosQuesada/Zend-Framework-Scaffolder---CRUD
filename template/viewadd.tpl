
<FORM ACTION="/<?=str_replace('_','-',$table->getName());?>/index" METHOD="POST"> 
	 
		<?php foreach ($table->getMetadata() AS $column):?>  
        
        <?='<?php'?> echo $this->formLabel('<?php echo $table->getColumnName($column)?>','<?php echo $table->getColumnName($column)?>');<?='?>'. PHP_EOL?>
        <?='<?php'?> echo $this->formText('<?php echo $table->getColumnName($column)?>',$this->data->get<?php echo ucfirst($table->getColumnName($column))?>(),array('size' => 10)).'<br>';<?='?>'. PHP_EOL?>
        <?endforeach;?>
       
	    <?='<?php'?> echo $this->formSubmit('enviar', 'enviar'); 
	 <?='?>'?>
</FORM> 
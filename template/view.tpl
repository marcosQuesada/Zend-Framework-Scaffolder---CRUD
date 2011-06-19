<table style="width:600px">
<tr>
	<td></td>
	<?php foreach ($table->getMetadata() AS $column):?>  
    <td><?=$table->getColumnName($column)?></td>
        <?endforeach;?>    
</tr>	
<?='<?php'?> foreach($this->result AS $result):<?='?>'. PHP_EOL?>
	<tr>		
		<td>
			<a href="/<?=str_replace('_','-',$table->getName());?>/delete/id/<?='<?php'?> echo str_replace('_','-',$result->get<?=ucfirst($table->getTableIndex()).'());?>'?>">delete</a> 
			-
			<a href="/<?= str_replace('_','-',$table->getName());?>/edit/id/<?='<?php'?> echo $result->get<?=ucfirst($table->getTableIndex()).'();?>'?>">edit</a>
		</td>
		<?php foreach ($table->getMetadata() AS $column):?>  
        <td><?='<?php'?> echo $result->get<?=ucfirst($column["COLUMN_NAME"])?>();<?='?>'?></td>
        <?endforeach;?>
	</tr>
<?='<?php'?> endforeach<?='?>'?>
</table>

<FORM ACTION="/<?=str_replace('_','-',$table->getName());?>/index" METHOD="POST"> 
	 
		<?php foreach ($table->getMetadata() AS $column):?>  
        
        <?='<?php'?> echo $this->formLabel('<?php echo $table->getColumnName($column)?>','<?php echo $table->getColumnName($column)?>');<?='?>'. PHP_EOL?>
        <?='<?php'?> echo $this->formText('<?php echo $table->getColumnName($column)?>',' ',array('size' => 10)).'<br>';<?='?>'. PHP_EOL?>
        <?endforeach;?>
       
	    <?='<?php'?> echo $this->formSubmit('enviar', 'enviar'); 
	 <?='?>'?>
</FORM> 


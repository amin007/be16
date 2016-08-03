Data dari rangka: <pre><?php print_r($this->senarai['data'][0]); ?></pre>
<?php 
foreach ($this->cariApa as $myTable => $row)
{
	if ( count($row)==0 )
		echo '';
	else
	{
?>
<!-- Jadual <?php echo $myTable ?> ########################################### -->	
<?php include 'papar_jadual_tambah.php'; ?>
<!-- Jadual <?php echo $myTable ?> ########################################### -->		
<?php
	} # if ( count($row)==0 )
}
?>	

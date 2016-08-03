<?php 
foreach ($this->cariApa as $myTable => $row)
{
	if ( count($row)==0 )
		echo '';
	else
	{
		?>Data dari rangka: <pre><?php print_r($row[0]); ?></pre><?php
?>
<!-- Jadual <?php echo $myTable ?> ########################################### -->	
<?php include 'papar_jadual_tambah.php'; ?>
<!-- Jadual <?php echo $myTable ?> ########################################### -->		
<?php
	} // if ( count($row)==0 )
}
?>	

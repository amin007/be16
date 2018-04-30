<?php 
//print_r($this->url);
//print_r($this->bilSemua); 
//print_r($this->halaman); 
//print_r($this->cariApa); 
//print_r($this->carian); 

if ($this->carian=='[id:0]')
{
	echo 'data kosong<br>';
}
else
{ // $this->carian=='sidap' - mula
	$cari = $this->carian;
?>

<div class="tabbable tabs-top">
	<ul class="nav nav-tabs putih">
<?php 
foreach ($this->cariApa as $jadual => $baris)
{
	if ( count($baris)==0 )
		echo '';
	else
	{	//$mula = ($jadual=='rangka') ? ' class="active"' : '';
	?>
	<li><a href="#<?php echo $jadual ?>" data-toggle="tab">
		<span class="badge badge-success"><?php echo $jadual ?></span>
		<span class="badge"><?php echo count($baris) ?></span>
		</a></li>
<?php
	}
}
?>	</ul>
<div class="tab-content">
<?php 
foreach ($this->cariApa as $myTable => $row)
{
	if ( count($row)==0 )
		echo '';
	else
	{
		$mula2 = ($jadual=='rangka13') ? ' active' : '';
	?>
	<div class="tab-pane<?php echo $mula2?>" id="<?php echo $myTable ?>">
	<?php //echo $this->halaman[$myTable] ?>
<!-- Jadual <?php echo $myTable ?> ########################################### -->	
<table border="1" class="excel" id="example">
<?php
// mula bina jadual
$printed_headers = false; 
#-----------------------------------------------------------------
for ($kira=0; $kira < count($row); $kira++)
{	//print the headers once: 	
	if ( !$printed_headers ) 
	{
		?><thead><tr><th>#</th><?php
		foreach ( array_keys($row[$kira]) as $tajuk ) 
		{	// anda mempunyai kunci integer serta kunci rentetan
			// kerana cara PHP mengendalikan tatasusunan.
			if ($tajuk=='newss')
			{
				?><th colspan=1><?php echo $tajuk ?></th><?php 
			}
			else
			{
				?><th><?php echo $tajuk ?></th><?php 
			}
			
		}
		?></tr></thead>
<?php
		$printed_headers = true; 
	} 
#-----------------------------------------------------------------		 
	//print the data row 
	?><tbody><tr><td><?php echo $kira+1 ?></td><?php
	foreach ( $row[$kira] as $key=>$data ) 
	{		
		if ($key=='newss')
		{
			$id = $data; 
			$k1 = URL . 'kawalan/ubah/' . $id;
			$p1 = URL . 'prosesan/ubah/' . $id;
			//$p2 = URL . 'pendaftaran/buang/' . $id;
			$k3 = URL . 'kawalan/cetak/' . $id;
			$class = '';
			/*?><td><a target="_blank" href="<?php echo $k1 ?>" class="btn btn-primary btn-mini">Ubah</a></td><?php*/
			?><td><?php echo $data ?></td><?php
		}
		else
		{
			?><td><?php echo $data ?></td><?php
		}
	} 

	//<a href="$p2" class="btn btn-danger btn-mini">
	//<i class="icon-trash icon-white"></i> Buang</a>
	?></tr></tbody>
<?php
}
#-----------------------------------------------------------------
?>
</table>

<!-- Jadual <?php echo $myTable ?> ########################################### -->		
	</div>
<?php
	} // if ( count($row)==0 )
}
?>	
</div><!-- class="tab-content" -->
</div><!-- /tabbable -->
 
<?php //echo $this->halaman['jan13'] ?>

<?php } // $this->carian=='sidap' - tamat ?>
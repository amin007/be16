<pre>
<h1>...</h1>Anda mencari<?php 
//echo '$this->carian:'; print_r($this->carian);
$cari = ' | ';
foreach ($this->carian as $kunci => $nilai)
{
	$cari .= ( count($nilai)==0 ) ? $nilai : $nilai . ' | ';
}
echo "$cari\rJadual\r";
//echo "\r" . '$this->cariNama:'; print_r($this->cariNama);
foreach ($this->cariNama as $key => $value)
{
	echo ( count($value)==0 ) ?
	$key . ' Kosong | ' : $key . ' Ada | ';
}
?>
</pre>

<?php
//$papar = 'bawah';
$papar = 'lintang';

if ($papar=='bawah')
{// if ($papar=='bawah') 
?>

<?php
foreach ($this->cariNama as $myTable => $row)
{// mula ulang $row
/////////////////////////////////////////////////////////////////
$tajuk = (count($row)==0) ? '' : "<caption align=\"left\">$myTable</caption>";
echo $tajuk;
?>
<table  border="1" class="excel" id="example">
<?php $printed_headers = false; // mula bina jadual
#-----------------------------------------------------------------
for ($kira=0; $kira < count($row); $kira++)
{
	if ( !$printed_headers ) # print the headers once: 
	{##=============================================================
		?><thead><tr>
<th>#</th>
<?php
		foreach ( array_keys($row[$kira]) as $tajuk ) 
		{	# anda mempunyai kunci integer serta kunci rentetan
			# kerana cara PHP mengendalikan tatasusunan.
			?><th><?php echo $tajuk ?></th>
<?php	} ?></tr></thead>
<?php
	##=============================================================
		$printed_headers = true; 
	} 
#----//print the data row----------------------------------------------
	?><tbody><tr><td><?php echo $kira+1 ?></td>
<?php foreach ( $row[$kira] as $key=>$data ) :
		pautan($kira, $key, $data, $myTable);
	 endforeach; ?>
</tr></tbody>
<?php
} ?>
</table>

<?php
////////////////////////////////////////////////////////////////////
}// tamat ulang $row
?>

<?php
}// if ($papar=='bawah')
else 
{// if ($papar!='bawah') - mula
?>

<div class="tabbable tabs-top">
	<ul class="nav nav-tabs putih">
<?php 
foreach ($this->cariNama as $jadual => $baris)
{
	if ( count($baris)==0 )
		echo '';
	else
	{	?>
	<li><a href="#<?php echo $jadual ?>" data-toggle="tab">
		<span class="badge badge-success"><?php echo $jadual ?></span></a></li>
<?php
	}
}
?>	</ul>
<div class="tab-content">
<?php 
foreach ($this->cariNama as $myTable => $row)
{
	if ( count($row)==0 )
		echo '';
	else
	{
		$mula2 = '';
	?>
	<div class="tab-pane<?php echo $mula2?>" id="<?php echo $myTable ?>">
	<?php //echo $this->halaman[$myTable] ?>
<!-- Jadual <?php echo $myTable ?> ########################################### -->
<table border="1" class="excel" id="example">
<?php $printed_headers = false; # mula bina jadual
#-----------------------------------------------------------------
for ($kira=0; $kira < count($row); $kira++)
{
	if ( !$printed_headers ) # print the headers once: 
	{
		?><thead><tr><th><?php echo $myTable ?></th><?php
		foreach ( array_keys($row[$kira]) as $tajuk ) 
		{ 
			# anda mempunyai kunci integer serta kunci rentetan
			# kerana cara PHP mengendalikan tatasusunan.
			if ( !is_int($tajuk) ) 
			{ 
				?><th><?php echo $tajuk ?></th><?php
			} 
		}
		?></tr></thead>
<?php	$printed_headers = true; 
	} 
#---//print the data row-------------------------------------------
	?><tbody><tr><td><?php echo $kira+1 ?></td><?php
	foreach ( $row[$kira] as $key=>$data ) 
	{
		pautan($kira, $key, $data, $myTable);
	}
	?></tr></body><?php
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


<?php
}// if ($papar!='bawah') - tamat
?><?php
function pautan($kira, $key, $data, $myTable)
{
	# butang 
	$birutua = 'btn btn-primary btn-mini';
	$birumuda = 'btn btn-info btn-mini';
	$merah = 'btn btn-danger btn-mini';

	if ($key=='newss')
	{
		?><td><?php 
		/*?><a target="_blank" href="#" class="<?=$merah?>"><?=$level?></a><?php*/
		?><a target="_blank" href="<?php echo $k1 ?>" class="<?=$btn?>"><?=$a?></a><?php
		?></td><?php
	}
	else
	{
		?><td><?php echo $data ?></td><?php
	}
}
<h1>Senarai Syarikat | Anda mencari<?php 
//echo '$this->carian:'; print_r($this->carian);
$cari = ' | ';
foreach ($this->carian as $kunci => $nilai)
{
	$cari .= ( count($nilai)==0 ) ? $nilai : $nilai . ' | ';
}
echo "$cari\r</h1>Jadual : ";
//echo "\r" . '$this->cariNama:'; print_r($this->cariNama);
foreach ($this->cariNama as $key => $value)
{
	echo ( count($value)==0 ) ?
	$key . ' Kosong | ' : $key . ' Ada | ';
}
?>

<?php
$papar = 'bawah';
//$papar = 'lintang';

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
<th>Tindakan</th><th>#</th>
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
	?><tbody><tr>
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
		?><thead><tr><th>#</th><?php
		foreach ( array_keys($row[$kira]) as $tajuk ) 
		{ 
			# anda mempunyai kunci integer serta kunci rentetan
			# kerana cara PHP mengendalikan tatasusunan.
			if ( !is_int($tajuk) ) 
			{ 
				?><th><?php echo $tajuk ?></th><?php
			} 
		}
		?><th><?php echo $myTable ?></th></tr></thead>
<?php	$printed_headers = true; 
	} 
#---//print the data row------------------------------------------- 
	?><tbody><tr><?php
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
	# set pembolehubah Sesi
	$pengguna = \Aplikasi\Kitab\Sesi::get('namaPegawai');
	$level = \Aplikasi\Kitab\Sesi::get('levelPegawai');
	//echo "<br> \$pengguna : $pengguna | \$level = $level";

	# butang 
	$birutua = 'btn btn-primary btn-mini';
	$birumuda = 'btn btn-info btn-mini';
	$merah = 'btn btn-danger btn-mini';

	if ($key=='newss')
	{
		//$b1 = URL . 'borang/tambah/' . $data;
		if ($level=='feprosesan'):
			$k1 = URL . 'prosesan/ubah/' . $data;
			$btn =  $birumuda;
			$a = '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Ubah2';
		elseif ($myTable=='be16_rangkabaru'):
			$k1 = URL . 'rangkabaru/masukdatadarirangka/1/' . $key . '/' . $data;
			$btn =  $merah;
			$a = '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Tambah2';
		else:
			$k1 = URL . 'kawalan/ubah/' . $data;
			$btn = $birutua;
			$a = '<i class="fa fa-pencil" aria-hidden="true"></i>Ubah1';
		endif

		?><td><?php 
		/*?><a target="_blank" href="#" class="<?=$merah?>"><?=$level?></a><?php*/
		?><a target="_blank" href="<?php echo $k1 ?>" class="<?=$btn?>"><?=$a?></a><?php
		?></td><?php
		?><td><?php echo $kira+1 ?></td><?php
		?><td><?php echo $data ?></td><?php
	}
	else
	{
		?><td><?php echo $data ?></td><?php
	}
}

	/*
			if ($key=='newss')
				$id = $data; 
			?><td><?php echo $data ?></td><?php
		 

		$k1 = URL . 'kawalan/ubah/' . $id;
		$p1 = URL . 'prosesan/ubah/' . $id;
		//$p2 = URL . 'pendaftaran/buang/' . $id;
		$k3 = URL . 'kawalan/cetak/' . $id;
		//<a href="$p2" class="btn btn-danger btn-mini">
		//<i class="icon-trash icon-white"></i> Buang</a>
		?><td><?php
		?><a href="<?php echo $k1 ?>" class="btn btn-primary btn-mini"><i class="icon-pencil icon-white"></i>Ubah</a><?php
		?><a href="<?php echo $p1 ?>" class="btn btn-primary btn-mini"><i class="icon-pencil icon-white"></i>Proses</a><?php
		?><a href="<?php echo $k3 ?>" class="btn btn-success btn-mini"><i class="icon-print icon-white"></i>Cetak</a><?php
		?></td></tr></tbody>

	*/

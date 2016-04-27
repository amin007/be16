<?php
# set pembolehubah
$senaraiStaf = senarai_kakitangan();
$urlStaf  = null;
$target = null; 
//$target = ' target="_blank"';
//echo '<pre>$senaraiStaf->'; print_r($senaraiStaf) . '</pre>';
foreach ($senaraiStaf as $namaStaf):
	$urlStaf .=  "\r | " . '<a' . $target . ' href="' . URL .'operasi/batch/' . $namaStaf . '">'
			 .  $namaStaf . '</a>';
endforeach;
$paparStaf = $this->namaPegawai . " ada dalam senarai staf";
$paparXStaf = $this->namaPegawai . " tiada dalam senarai staf.<br>"
	. ' klik salah satu pautan staf di bawah ini '
	. $urlStaf 
	. '';
	
if (($this->namaPegawai == null)) :
	# set pembolehubah
	$notaTambahan = 'nama pegawai tidak wujud. klik salah satu pautan staf di bawah ini ' . $urlStaf;
	$mencari = URL . 'operasi/tambahNamaStaf';
	$butangHantar = 'Letak Nama Staf';
elseif (($this->namaPegawai != null) && ($this->noBatch == null)) :
	# set pembolehubah
	$namaPegawai = (!isset($this->namaPegawai)) ? null : $this->namaPegawai;
	$mencari = URL . 'operasi/tambahBatchBaru/' . $namaPegawai;
	$notaTambahan = '<small>' . $mencari . '</small><br>' .
	( (in_array($this->namaPegawai,$senaraiStaf)) ? $paparStaf : $paparXStaf );
	$butangHantar = 'Letak No Batch';
elseif (($this->namaPegawai != null) && ($this->noBatch != null)
	&& ($this->error == 'Kosong') ) : 
	# set pembolehubah
	$namaPegawai = (!isset($this->namaPegawai)) ? null : $this->namaPegawai;
	$cariBatch = (!isset($this->noBatch)) ? null : $this->noBatch;
	$mencari = URL . 'operasi/ubahBatchProses/' . $namaPegawai . '/' . $cariBatch; 
	$notaTambahan = '<small>' . $mencari . '</small><br>' . "\r" .
	'Daftar kes masing-masing<br>';
	$butangHantar = 'Letak No ID';
else : # set pembolehubah
	$namaPegawai = (!isset($this->namaPegawai)) ? null : $this->namaPegawai;
	$cariBatch = (!isset($this->noBatch)) ? null : $this->noBatch;
	$paparError = (!isset($this->error)) ? null : $this->error;
	$mencari = URL . 'operasi/ubahBatchProses/' . $namaPegawai . '/' . $cariBatch;
	$cetakF10 = URL . 'laporan/cetakf10/' . $cariBatch . '/1000';
	$cetakA1 = URL . 'laporan/cetakA1/' . $cariBatch . '/1000';
	$cetak = '<h3><a target="_blank" href="' . $cetakF10 . '"> Cetak F10</a>| ' . "\r" .
	'<a target="_blank" href="' . $cetakA1 . '">Cetak A1</a></h3>';
	$notaTambahan = 'Ubah | Nama Pegawai : ' . $namaPegawai . ' | BatchOperasi : ' . $cariBatch . '<br>' . "\r" .
	'<small>Nota: ' . $paparError . '</small>';
	$butangHantar = 'Kemaskini';
endif; ?>
<div class="container"><?php echo (!isset($cetak)) ? null : "\r$cetak" ?>
	<h1><?=$notaTambahan?></h1>

	<div align="center"><form method="GET" action="<?=$mencari?>" class="form-inline" autocomplete="off">
	<?php echo $mencari . '<br>' ?>
	<div class="form-group"><div class="input-group">
		<input type="text" name="cari" class="form-control" autofocus
		id="inputString" onkeyup="lookup(this.value);" onblur="fill();">
		<span class="input-group-addon">
		<input type="submit" value="<?=$butangHantar?>">
		</span>
	</div></div>
	<div class="suggestionsBox" id="suggestions" style="display: none; " >
		<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
	</div>
	</form></div><br>

</div><!-- / class="container" -->
<!-- mula - baca jadual berulang ///////////////////////////////////////////////////////////////////////// -->
<?php 
if (isset($this->cariApa) )
	include 'papar_jadual_berulang.php'; 
?>
<!-- tamat - baca jadual berulang //////////////////////////////////////////////////////////////////////// -->
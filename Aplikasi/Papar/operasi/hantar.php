<?php
# set pembolehubah
$senaraiStaf = senarai_kakitangan(); //echo '<pre>$senaraiStaf->'; print_r($senaraiStaf) . '</pre>';
$urlStaf  = null;
$target = null; //$target = ' target="_blank"';

foreach ($senaraiStaf as $namaStaf):
	$urlStaf .=  "\r | " . '<a' . $target . ' href="' . URL .'operasi/hantar/' . $namaStaf . '">'
			 .  $namaStaf . '</a>';
endforeach;
$paparStaf = $this->namaPegawai . " ada dalam senarai staf";
$paparXStaf = $this->namaPegawai . " tiada dalam senarai staf.<br>"
	. ' klik salah satu pautan staf di bawah ini ' . $urlStaf . '';
	
if (($this->namaPegawai == null)) :
	# set pembolehubah
	$namaPegawai = (!isset($this->namaPegawai)) ? null : $this->namaPegawai;
	$cariHantar = (!isset($this->tarikhHantar)) ? null : $this->tarikhHantar;	
	$notaTambahan = 'nama pegawai tidak wujud. klik salah satu pautan staf di bawah ini ' . $urlStaf;
	$mencari = URL . 'operasi/hantarNamaStaf';
	$butangHantar = 'Letak Nama Staf';
elseif (($this->namaPegawai != null) && ($this->tarikhHantar == null)) :
	# set pembolehubah
	$namaPegawai = (!isset($this->namaPegawai)) ? null : $this->namaPegawai;
	$cariHantar = (!isset($this->tarikhHantar)) ? null : $this->tarikhHantar;
	$mencari = URL . 'operasi/hantarBatchBaru/' . $namaPegawai;
	$notaTambahan = ( (in_array($this->namaPegawai,$senaraiStaf)) ? $paparStaf : $paparXStaf );
	$butangHantar = 'Letak Tarikh Hantar';
elseif (($this->namaPegawai != null) && ($this->tarikhHantar != null)
	&& ($this->error == 'Kosong') ) : 
	# set pembolehubah
	$namaPegawai = (!isset($this->namaPegawai)) ? null : $this->namaPegawai;
	$cariHantar = (!isset($this->tarikhHantar)) ? null : $this->tarikhHantar;
	$cetakF03 = URL . 'laporan/cetakf3/' . $namaPegawai . '/' . $cariHantar . '/1000';
	//$cetakF10 = URL . 'laporan/cetakf10/' . $namaPegawai . '/' . $cariHantar . '/1000';
	$cetakA1 = URL . 'laporan/cetakA1/' . $namaPegawai . '/' . $cariHantar . '/1000';
	$cetak = '<h3><a target="_blank" href="' . $cetakF03 . '"> Cetak F3</a>| ' . "\r" .
	'<a target="_blank" href="' . $cetakA1 . '">Cetak A1</a></h3>' . "\r";
	$mencari = URL . 'operasi/ubahHantarProses/' . $namaPegawai . '/' . $cariHantar; 
	$notaTambahan = 'Daftar kes masing-masing<br>';
	$butangHantar = 'Letak No ID';
else : # set pembolehubah
	$namaPegawai = (!isset($this->namaPegawai)) ? null : $this->namaPegawai;
	$cariHantar = (!isset($this->tarikhHantar)) ? null : $this->tarikhHantar;
	$paparError = (!isset($this->error)) ? null : $this->error;
	$mencari = URL . 'operasi/ubahHantarProses/' . $namaPegawai . '/' . $cariHantar;
	$cetakF03 = URL . 'laporan/cetakf3/' . $namaPegawai . '/' . $cariHantar . '/1000';
	//$cetakF10 = URL . 'laporan/cetakf10/' . $namaPegawai . '/' . $cariHantar . '/1000';
	$cetakA1 = URL . 'laporan/cetakA1/' . $namaPegawai . '/' . $cariHantar . '/1000';
	$cetak = '<h3><a target="_blank" href="' . $cetakF03 . '"> Cetak F3</a>| ' . "\r" .
	'<a target="_blank" href="' . $cetakA1 . '">Cetak A1</a></h3>' . "\r";
	$notaTambahan = 'Ubah | Nama Pegawai : ' . $namaPegawai . ' | Hantar : ' . $cariHantar . '<br>' . "\r" .
	'<small>Nota: ' . $paparError . '</small>';
	$butangHantar = 'Kemaskini';
endif; ?>
<div class="container"><?php echo (!isset($cetak)) ? null : "\r$cetak" ?>
	<h1>Hantar:<?=$notaTambahan?></h1>

	<div align="center"><form method="GET" action="<?=$mencari?>" class="form-inline" autocomplete="off">
	<?php echo $mencari . '<br>' . "\r" ?>
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
<?php
# set pembolehubah
$senaraiStaf = senarai_kakitangan(2);
$urlStaf  = null;
$target = null; 
//$target = ' target="_blank"';
//echo '<pre>$senaraiStaf->'; print_r($senaraiStaf) . '</pre>';
foreach ($senaraiStaf as $namaStaf):
	$urlStaf .=  "<br>\r" . '<a' . $target . ' href="' . URL .'prosesan/batch/' . $namaStaf . '">'
			 .  $namaStaf . '</a>';
endforeach;
$paparStaf = $this->namaPegawai . " ada dalam senarai staf";
$paparXStaf = $this->namaPegawai . " tiada dalam senarai staf.<br>"
	. ' klik salah satu pautan staf di bawah ini '
	. $urlStaf 
	. '';
?>
<div class="container">
<?php if (($this->namaPegawai == null)) : ?>
nama pegawai tidak wujud.
klik salah satu pautan staf di bawah ini <?=$urlStaf?>

<?php elseif (($this->namaPegawai != null) && ($this->noBatch == null)) : 
echo (in_array($this->namaPegawai,$senaraiStaf)) ? $paparStaf : $paparXStaf; ?>	
<?php # set pembolehubah
	$carian = (!isset($this->namaPegawai)) ? null : $this->namaPegawai;
	$cariBatch = (!isset($this->noBatch)) ? null : $this->noBatch;
	$paparError = (!isset($this->error)) ? null : $this->error;
	$mencari = URL . 'prosesan/ubahBatchAwal/' . $cariBatch;
?>
<h1>Ubah BatchProsesan : <?=$cariBatch?><br>
<small>Nota: <?=$paparError?></small></h1>

<div align="center"><form method="GET" action="<?=$mencari?>" class="form-inline" autocomplete="off">
<div class="form-group"><div class="input-group">
	<input type="text" name="cari" class="form-control" autofocus
	id="inputString" onkeyup="lookup(this.value);" onblur="fill();">
	<span class="input-group-addon">
	<input type="submit" value="Letak No Batch">
	</span>
</div></div>
<div class="suggestionsBox" id="suggestions" style="display: none; " >
	<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
</div>
</form></div><br>

<?php else : ?>
Sudah ada nama pegawai = <?=$this->namaPegawai?> 
<?php # set pembolehubah
	$carian = (!isset($this->namaPegawai)) ? null : $this->namaPegawai;
	$cariBatch = (!isset($this->noBatch)) ? null : $this->noBatch;
	$paparError = (!isset($this->error)) ? null : $this->error;
	$mencari = URL . 'prosesan/ubahBatchProses/' . $cariBatch;
	$cetakF10 = URL . 'laporan/cetakf10/' . $cariBatch . '/1000';
	$cetakA1 = URL . 'laporan/cetakA1/' . $cariBatch . '/1000';
?>
<h3><a target="_blank" href="<?=$cetakF10?>"> Cetak F10</a>|
<a target="_blank" href="<?=$cetakF10?>">Cetak A1</a></h3>
<h1>Ubah BatchProsesan : <?=$cariBatch?><br>
<small>Nota: <?=$paparError?></small></h1>

<div align="center"><form method="GET" action="<?=$mencari?>" class="form-inline" autocomplete="off">
<div class="form-group"><div class="input-group">
	<input type="text" name="cari" class="form-control" autofocus
	id="inputString" onkeyup="lookup(this.value);" onblur="fill();">
	<span class="input-group-addon">
	<input type="submit" value="Kemaskini">
	</span>
</div></div>
<div class="suggestionsBox" id="suggestions" style="display: none; " >
	<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
</div>
</form></div><br>

<?php endif; ?>

</div><!-- / class="container" -->
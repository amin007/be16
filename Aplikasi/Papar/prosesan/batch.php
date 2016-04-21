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
	. '';
?>
<div class="container">
<?php if (($this->namaPegawai == null)) : ?>
nama pegawai tidak wujud.
klik salah satu pautan staf di bawah ini <?=$urlStaf?>

<?php elseif (($this->namaPegawai != null) && ($this->noBatch == null)) : 
echo (in_array($this->namaPegawai,$senaraiStaf)) ? 
	$paparStaf : $paparXStaf;
	?>
<?php else : ?>
Sudah ada nama pegawai = <?=$this->namaPegawai?> 
dan no batch  = <?=$this->noBatch?> 
<?php endif; ?>

</div><!-- / class="container" -->
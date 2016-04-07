<?php
include 'diatas.php';
	$pegawai = senarai_kakitangan(); // kumpul nama fe
	$kp = isset($this->kp) ? $this->kp : null;
	$namaOrg['penyelia'] = 'Abdul Razak';
	$namaOrg['pegawai'] = $this->fe;
	if (count($this->hasil)==0):
		$fields = null; 
		$rows = null; 
		$hasil = null; 
	else:
		$fields = count($this->hasil[0]); 
		$rows = count($this->hasil); 
		$hasil = $this->hasil;
	endif;
	$allRows = isset($this->kiraSemuaBaris) ? $this->kiraSemuaBaris : 1;
	$item = isset($this->item) ? $this->item : 30;
	$baris = isset($this->baris) ? $this->baris : 30;
	$ms = isset($this->ms) ? $this->ms : 1;
	$hasil = $this->hasil;
	$tajukRespon=array();	
	# semak data
	echo '<pre>$hasilLaporan:'; print_r($this->hasil) . '</pre>';
	echo '<br>$baris:' . $rows . '|' . count($this->hasil) . '<br>';
	echo '<br>$lajur:' . $fields . '|' . count($this->hasil[0]) . '<br>';
	//*/
	
if (count($this->hasil) == 0):
	echo 'Tiada data';
else:
	$jadual = new Aplikasi\Kitab\Perangkaan;
?>
	<table border="1" class="excel" width="100%" height="100%">
	<?php
	$jadual->paparJadualF3_Data($kp,$namaOrg,$rows,$fields,$hasil,$item,$ms,$baris);
	$jadual->paparJadualF3_TajukBawah($rows,$fields);
	?>
	</table>
<?php
endif; //*/
echo "\n"; ?>
</body>
</html>
<?php
include 'diatas.php';
	if (count($this->hasil)==0):
		$fields = null; 
		$rows = null; 
		$hasil = null; 
	else:
		$hasil = $this->hasil;
		$rows = count($this->hasil); 
		$fields = count($this->hasil[0]); 
	endif;
	$allRows = $this->kiraSemuaBaris;
	$item = $this->item;
	$baris = $this->baris;
	$ms = $this->ms;
	$tajukLaporan = '<div align="center">'
		. '<font size=7>Penyiasatan/Banci : ' . $this->kp . '<br>'
		. 'Laporan Penerimaan Setakat : ' . $this->tarikh
		. '</font></div>'
		. '';
	//echo '<pre>$hasilLaporan:'; print_r($this->hasil) . '</pre>';
	//echo '<br>$baris:' . $rows . '|' . count($this->hasil) . '<br>';
	//echo '<br>$lajur:' . $fields . '|' . count($this->hasil[0]) . '<br>';
	
if (count($this->baris) == 0):
	echo 'Tiada data';
else:
	$jadual = new Aplikasi\Kitab\Perangkaan;echo "\n";
	?><table border="1" class="excel" width="100%" height="100%">
	<tr><td colspan=20><?php echo $tajukLaporan ?></td></tr>
	<?php echo "\n";
	$jadual->paparJadualProses($allRows,$rows,$fields,$item,$ms,$hasil);
	//paparJadualF3_TajukBawah($rows,$fields);
	?>
	</table>
<?php
endif;
echo "\n"; ?>
</body>
</html>
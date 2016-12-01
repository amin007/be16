<?php
function tajukBesar($kodsv)
{
	## tajuk besar
	switch ($kodsv):
		case 'MDT': $SV='PENYIASATAN PERDAGANGAN EDARAN BULANAN'; break;
		case 'CDT': $SV='BANCI PERDAGANGAN EDARAN'; break;
		case 'MM':  $SV='PENYIASATAN PEMBUATAN BULANAN'; break;
		case 'QSS': $SV='PENYIASATAN PERKHIDMATAN SUKU TAHUNAN'; break;
		case 'MFG':  $SV='PENYIASATAN PEMBUATAN TAHUNAN'; break;
		case 'SERVIS':  $SV='PENYIASATAN PERKHDIMATAN TAHUNAN'; break;
		case 'PPPMAS':  $SV='PENYIASATAN PERBELANJAAN UNTUK PELINDUNGAN ALAM SEKITAR'; break;
		case 'BE':  $SV='BANCI EKONOMI'; break;
		default: $SV=null;
	endswitch;
	
	return $SV; # pulangkan nilai
}
function paparJadualF10_TajukMedan($kodsv,$KP,$nama_penyelia,$nama_pegawai,$rows,$fields,$hasil,$item,$ms)
{
	echo '<tr style="page-break-before:always"><td colspan=' . ($fields+1) . ' valign="top">'
		. '<h2 align="right">Lampiran F : F10 </h2>' 
		. '<h2 align="center">JABATAN PERANGKAAN MALAYSIA NEGERI JOHOR</h2>'
		. '<h2 align="center">PENGHANTARAN BATCH KE PROSESAN : BATCH </h2>'
		. "</td></tr>\r";

	$SV = tajukBesar($kodsv);
	$tr = '<tr>';
	$tr2 = '</td></tr>' . "\r";
	echo '<tr><td colspan=3 valign="middle">'
		. '<h2 align="left">TARIKH:<small>' . date('d-m-Y') . '</small></h2>'
		. '</td><td colspan=3 valign="middle">'
		. '<h2 align="right">KOD PENY:</h2></div></td>' 
		. '<td align="center" valign="middle"><h2><i>' . $KP . '</i></h2>' . $tr2
		. $tr . '<td colspan=' . ($fields+1) . ' align="CENTER"><h2>' 
		. $SV . ' ' . date('Y') . '</h2></div>' . $tr2
		. "\r";
	
	tajukMedan();
}
function tajukMedan()
{
	## tajuk medan - keputusan 
	echo "<tr>\n<th rowspan=2>Bil</th>\n";
	echo '<th rowspan=2>NO SIRI NEWSS</th>' . "\n";
	echo '<th rowspan=2>Nama Syarikat</th>' . "\n";
	echo '<th rowspan=2>Kod Peny.</th>' . "\n";
	echo '<th rowspan=1 colspan=2>RESPON</th>' . "\n";
	echo '<th rowspan=2>Catatan</th>' . "\n";
	echo "</tr>\n<tr>"; 
	//$space = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	//$space2 = '&nbsp;&nbsp;';
	$space = $space2 = null;
	echo "<th>$space A1 $space</th>\n";
	echo "<th>$space2 NON&nbsp;A1 $space2</th>\n";
	echo '</tr>';	
}
function paparJadualF10_TajukBawah($rows,$fields,$nama_penyelia,$nama_pegawai)
{
	## pecah muka surat
	//$cetak=($bil==$rows)?'style="page-break-after:always">':'>';
	//'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
	$cetak='style="page-break-after:always">';
	## tajuk medan - keputusan 
	echo "<tr>\n<td colspan=\"2\"></td>\n"
		. "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>\n"
		. "</tr><tr>\n<th colspan=\"2\">JUMLAH TERKUMPUL</th>\n"
		. "<th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th>\n"
		. "</tr>\n<tr><th colspan=\"2\">JUMLAH KESELURUHAN</th>\n"
		. "<th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th>\n"
		. '</tr>';
	
	$nama = explode('-', $nama_pegawai);
	
	echo '<tr style="page-break-after:always"><td colspan=3>' .
		'<br>Dihantar Oleh Operasi Luar:' .
		'<br><br>Nama Penghantar : <font size=5>' . $nama[0] . '</font>' . 
		'<br><br>T.Tangan:____________________' .
		'<br><br>Tarikh Hantar:___________________' . '</td>' . "\r" .
		'<td colspan=4>' .
		'<br>Diterima Oleh Unit Prosesan:' .
		'<br><br>Nama Penerima:' .
		'<br><br>T.Tangan:____________________' .
		'<br><br>Tarikh Terima:___________________' . '</td>' . "\r" .
		'</tr>' . "\r";
}
function paparJadualF10_Data($rows,$fields,$hasil,$kodsv,$KP,$nama_penyelia,$nama_pegawai,$baris=30)
{	
	# PEMBOLEH UBAH
	$highlight="onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas1';\"";
	$highlight2=" onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas2';\"";
	
	# nilai dari isi
	//echo "<tbody>\n"; # mula tbody
	foreach ($hasil as $kira => $nilai)
	{	//$mula = ($ms==1) ? $ms : ($ms*$item)-$ms;
		// style="page-break-after:always"
		if ($kira%$baris=='0')
		{
			$ms = ($kira/$baris)+1;
			$item = ceil($rows/$baris);
			if ($kira!=0) paparJadualF10_TajukBawah($rows,$fields,$nama_penyelia,$nama_pegawai);
			paparJadualF10_TajukMedan($kodsv,$KP,$nama_penyelia,$nama_pegawai,$rows,$fields,$hasil,$item,$ms);
			echo "<tr><td><a target='_blank' href='" . URL . 'kawalan/ubah/'
			. $nilai['newss']."'>".($kira+1)."</a></td>\n";
		}
		else
		{
			echo "<tr><td><a target='_blank' href='"
			. URL . 'kawalan/ubah/'
			. $nilai['newss']."'>".($kira+1)."</a></td>\n";
		}
		foreach ($nilai as $key => $data)
		{
			echo '<td>' . $data . '</td>';
		}
		echo "</tr>\n";
	}
	
	cukupkan30($rows, $baris, $item);
	//*/
}
function cukupkan30($rows, $baris, $item)
{
	## cukupkan 30 rows
	$mula = $rows+1;
	//$bilAwal = ($item-1)*30;  # dpt bil muka surat akhir
	//$bilAkhir = $rows - $bilAwal; # $rows tolak bil tadi
	//$terakhir = 30 - $bilAkhir; # 30 tolak beza tadi
	$akhir = $rows + ( $baris - ($rows - (($item-1)*$baris) ) );
	//$mula = $rows+1;
	for($i = $mula; $i <= ($akhir); $i++)
	{
		echo '<tr><td>' . $i . '</td>';
		/*echo "<td>&nbsp;</td><td><font color=\"white\">"
			. $rows . '-' .(($item-1)*30)." = ".(30 - ($rows - (($item-1)*30) )).", "
			. " nombor terakhir > $rows + ".(30 - ($rows - (($item-1)*30) ))." => $akhir</td>";//*/
			for($j = 1; $j <= (6); $j++)
			echo '<td>&nbsp;</td>';
		echo '</tr>';
	}
}
?>
<style type="text/css">
table.excel {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:11px;
}
table.excel thead th, table.excel tbody th {
	background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align: top;
}
table.excel tbody th { text-align:center; vertical-align: top; }
table.excel tbody td { vertical-align:bottom; }
table.excel tbody td 
{ 
	padding: 0 3px; border: 1px solid #aaaaaa;
	background:#ffffff;
}
</style>
<?php
	$kodsv = 'BE';
	$nama_penyelia = 'Abdul Razak';
	$nama_pegawai = $this->fe;
	if (count($this->hasil)==0):
		$fields = null; 
		$rows = null; 
		$hasil = null; 
		$KP = null;
	else:
		$fields = count($this->hasil[0]); 
		$rows = count($this->hasil); 
		$hasil = $this->hasil;
		$KP = $this->hasil[0]['kp'];
	endif;
	//echo '<pre>$hasilLaporan:'; print_r($this->hasil) . '</pre>';
	//echo '<br>$baris:' . $rows . '|' . count($this->hasil) . '<br>';
	//echo '<br>$lajur:' . $fields . '|' . count($this->hasil[0]) . '<br>';
/*
            [newss] => 000000021807
            [nama] => KEDAI RUNCIT TALIB
			[kp] =>
            [respon] => 
            [non a1] => 
            [catatan] => 327-SBU
*/
if (count($this->hasil) == 0):
	echo 'Tiada data';
else:
?>
	<table border="1" class="excel" width="100%" height="100%">
	<?php
	paparJadualF10_Data($rows,$fields,$hasil,$kodsv,$KP,$nama_penyelia,$nama_pegawai,$this->baris);
	paparJadualF10_TajukBawah($rows,$fields,$nama_penyelia,$nama_pegawai);
	?>
	</table>
<?php
endif;
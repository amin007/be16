<?php
function tajuk_bancipenyiasatan($kodsv,$fields)
{
	switch ($kodsv):
		case 'MDT': $SV='PENYIASATAN PERDAGANGAN EDARAN BULANAN'; break;
		case 'CDT': $SV='BANCI PERDAGANGAN EDARAN'; break;
		case 'MM':  $SV='PENYIASATAN PEMBUATAN BULANAN'; break;
		case 'QSS': $SV='PENYIASATAN PERKHIDMATAN SUKU TAHUNAN'; break;
		case 'MFG':  $SV='PENYIASATAN PEMBUATAN TAHUNAN'; break;
		case 'SERVIS':  $SV='PENYIASATAN PERKHDIMATAN TAHUNAN'; break;
		case 'PPPMAS':  $SV='PENYIASATAN PERBELANJAAN UNTUK PELINDUNGAN ALAM SEKITAR'; break;
		default: $SV=null;
	endswitch;

	return $SV . ' 2014';

}
function paparJadualF10_TajukMedan($kodsv,$fields)
{
	echo '<td colspan=' . ($fields+1) . ' valign="top">' . "\n\t\t"
		. '<h2 align="right">Lampiran F : F10 </h2>' . "\n\t\t"
		. '<h2 align="center">JABATAN PERANGKAAN MALAYSIA NEGERI JOHOR' . "\n\t\t"
		//. '<h2 align="left">TARIKH:<small>' . date('d-m-Y') . '</small></h2>'
		. '<br>PENGHANTARAN BATCH KE KAWALAN EN RAZAK PADA ' . date('d-m-Y') . "\n\t\t<br>"
		. tajuk_bancipenyiasatan($kodsv,$fields) . ''
		. "</h2>\n\t</td></tr>\n\t";

	## tajuk medan - keputusan 
	$space = $space2 = null;
	echo "<tr>\n\t<th>Bil</th>\n\t\t"
		. '<th>No Siri Newss</th>' . "\n\t\t"
		. '<th>Nama Syarikat</th>' . "\n\t\t"
		. '<th>Kod Peny</th>' . "\n\t\t"
		. "<th>Brg</th>\n\t\t"
		. "<th>NON A1</th>\n\t\t"		
		. '<th>Catatan</th>' . "\n\t\t"
		. "</tr>\n<tr>";
}
function paparJadualF10_TajukBawah($nama_pegawai)
{
	## pecah muka surat
	//$cetak=($bil==$rows)?'style="page-break-after:always">':'>';
	//'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
	$cetak='style="page-break-after:always">';
	//$nama_pegawai = 'amin007';
	## tajuk medan - keputusan 
	echo "<th colspan=\"2\">JUMLAH</th>\n"
		. "<th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th>\n"
		. '</tr>';

	echo '<tr style="page-break-after:always"><td colspan=3>' .
		'Dihantar Oleh Pegawai Kerja Luar(FE):' .
		'<br>Nama Penghantar: <font size="3"><i>(' . $nama_pegawai . ')</i></font>' . 
		'<br><br>T.Tangan:____________________' .
		'<br><br>Tarikh Hantar:' . date('d-m-Y') . '</td>' . "\r" .
		'<td colspan=5>' .
		'Diterima Oleh Operasi Luar:' .
		'<br>Nama Penerima: (En Razak)' .
		'<br><br>T.Tangan:____________________' .
		'|Tarikh Terima:___________' . '</td>' . "\r" .
		'</tr>' . "\r";
}
function paparJadualF10_Data($nama_pegawai,$rows,$fields,$hasil,$kodsv,$fixRow)
{	
	# nak cari $rows
	if ($rows=='0'): echo "\n";
	else: # mula kalau jumpa
		## PEMBOLEH UBAH
		$highlight="onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas1';\"";
		$highlight2=" onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas2';\"";
	
		# nilai dari isi
		//echo "<tbody>\n"; # mula tbody
		foreach ($hasil as $kira => $nilai)
		{	
			echo "<tr>";
			# buat link kawalan
			buat_link_kawalan($nama_pegawai,$kira,$nilai,$rows,$fields,$kodsv,$fixRow);
			
			foreach ($nilai as $key => $data)
			{
				echo '<td>' . $data . '</td>';
			}
			
			echo "</tr>\n";
		}
		
		## cukupkan 30 rows
		cukup_30_rows($rows,$kira,$fixRow);
		
	endif;
	
}
function cukup_30_rows($rows, $kira, $fixRow = 30)
{
	$mula = $rows+1;
	$ms = ($kira/$fixRow)+1;
	$item = ceil($rows/$fixRow);
	//$bilAwal = ($item-1)*$fixRow;  # dpt bil muka surat akhir
	//$bilAkhir = $rows - $bilAwal; # $rows tolak bil tadi
	//$terakhir = $fixRow - $bilAkhir; # $fixRow tolak beza tadi
	$akhir = $rows + ( $fixRow - ($rows - (($item-1)*$fixRow) ) );
	for($i = $mula; $i <= ($akhir); $i++)
	{
		echo '<tr><td><br>' . $i . '</td>';
			for($j = 1; $j <= (6); $j++)
				echo '<td>&nbsp;</td>';
		echo "</tr>\n";
	}
}
function buat_link_kawalan($nama_pegawai,$kira,$nilai,$rows,$fields,$kodsv, $fixRow = 30)
{
	// style="page-break-after:always"
	if ($kira%$fixRow=='0')
	{
		$ms = ($kira/$fixRow)+1;
		$item = ceil($rows/$fixRow);
		if ($kira!=0) paparJadualF10_TajukBawah($nama_pegawai);
			paparJadualF10_TajukMedan($kodsv,$fields);
		echo "<td><a target=\"_blank\" href=\"" . URL . 'kawalan/ubah/'
			. $nilai['newss'] . "\">" . ($kira+1) . "</a></td>\n";
	}
	else
	{
		echo "<td><a target=\"_blank\" href=\""
			. URL . 'kawalan/ubah/'	. $nilai['newss'] 
			. "\">" . ($kira+1) . "</a></td>\n";		
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
	$kodsv = 'CDT';
	$nama_pegawai = $this->fe;
	//echo '<font color="red">$nama_pegawai:' . $nama_pegawai . '</font><br>';
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

if (count($this->hasil) == 0):
	echo 'Tiada data. <a href="' . URL . '">Anjung</a>';
else:?>
	<table border="1" class="excel" width="100%" height="100%">
	<?php
	$fixRow = 30;
	paparJadualF10_Data($nama_pegawai,$rows,$fields,$hasil,$kodsv,$fixRow);
	paparJadualF10_TajukBawah($nama_pegawai);
	?>
	</table>
<?php
endif;
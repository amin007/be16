<?php
namespace Aplikasi\Kitab; //echo __NAMESPACE__; 
class Perangkaan
{
#-------------------------------------------------------------------------------
#-------------------------------------------------------------------------------
	// cetakF3
	function paparJadualF3_TajukBesar($allRows,$fields,$kodsv,$namaOrg,$item,$ms)
	{
		#pecah pembolehubah $nama orang
		$nama_penyelia = $namaOrg['penyelia'];
		$nama_pegawai = $namaOrg['pegawai'];
		## tajuk besar
		switch ($kodsv):
			case 'MDT': $SV='PENYIASATAN PERDAGANGAN EDARAN BULANAN'; break;
			case 'CDT': $SV='BANCI PERDAGANGAN EDARAN'; break;
			case 'MM':  $SV='PENYIASATAN PEMBUATAN BULANAN'; break;
			case 'QSS': $SV='PENYIASATAN PERKHIDMATAN SUKU TAHUNAN'; break;
			case 'SSE':  $SV='PENYIASATAN TAHUNAN'; break;
			case 'MFG':  $SV='PENYIASATAN PEMBUATAN TAHUNAN'; break;
			case 'SERVIS':  $SV='PENYIASATAN PERKHDIMATAN TAHUNAN'; break;
			case 'PPPMAS':  $SV='PENYIASATAN PERBELANJAAN UNTUK PELINDUNGAN ALAM SEKITAR'; break;
			case 'BE':  $SV='BANCI EKONOMI'; break;
			default: $SV=null;
		endswitch;

		echo '<td colspan=' . ($fields+1) . '><font size=2>' .
			//'<div align="right">Lampiran 3<br>F 3 </div>' .
			'<div align="right">Lampiran A : F3 </div>' .
			//'</td><td>' .
			'<div align="center">' .
			'JABATAN PERANGKAAN MALAYSIA NEGERI JOHOR' .
			'<br>SENARAI INDUK AGIHAN KES ANGGOTA ' .
			'<br>' . $SV . ' ' . date('Y') .
			'</div><br>' .
			//'</td><td>' .
			'<div align="left">' .
			"Nama Penyelia : $nama_penyelia" .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			"Nama FE : $nama_pegawai ($allRows kes)" .
			"(muka " . ($ms) . " dari ".($item).")" .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .	
			//'</td><td>' .
			'Tarikh : <u>' . (date('d')) .
			(date('/m/Y')) . '</u> ' .
			'</div>' .
			'</td>' . "\r";

	}

	function paparJadualF3_TajukMedan($sv,$namaOrg,$allRows,$fields,$hasil,$item,$ms)
	{
		## tajuk besar
		echo '<tr style="page-break-before:always">';
		$this->paparJadualF3_TajukBesar($allRows,$fields,$sv,$namaOrg,$item,$ms);
		echo '</tr>';
		
		## tajuk medan - keputusan 
		echo '<tr>';
		echo "\n<th rowspan=\"2\">Bil</th>\n";
		echo '<th rowspan="2">Nama Syarikat (KES ' . $namaOrg['pegawai'] . ')</th>' . "\n";
		echo '<th rowspan="2">Kod Peny.</th>' . "\n";
		echo '<th rowspan="1">BBU</th>' . "\n";
		echo '<th rowspan="2">NO SIRI NEWSS</th>' . "\n";
		echo '<th rowspan="2">NOTA/CATATAN'
			. '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
			. '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
			. '</th>' . "\n";
		echo '<th colspan="22">Diisi oleh Anggota Kerja Luar sahaja</th>' . "\n";
		echo '</tr>';
		
		// bawah 	
		echo '<tr>';
	/*	echo '<th>&nbsp;</th>' . "\n";
		echo '<th>&nbsp;</th>' . "\n";
		echo '<th>&nbsp;</th>' . "\n";*/
		echo '<th>SBU</th>' . "\n";
		foreach ($hasil[0] as $kunci => $dataan)
		{
			echo (in_array($kunci,array('nama','kp','utama','newss','nota')))?  
			'':'<th>'.$kunci.'</th>' . "\n";	
		}
		echo '</tr>';

	}

	function paparJadualF3_TajukMedan1($nama_pegawai=null)
	{
		## tajuk medan - keputusan 
		echo "<tr>\n<th rowspan=2>Bil</th>\n";
		echo '<th rowspan=2>Nama Syarikat</th>' . "\n";
		echo '<th rowspan=2>Kod Peny.</th>' . "\n";
		echo '<th rowspan=1>BBU</th>' . "\n";
		echo '<th rowspan=2>NO SIRI NEWSS</th>' . "\n";
		echo '<th colspan=22>Diisi oleh Anggota Kerja Luar sahaja</th>' . "\n";
		echo "</tr>\n";
		
	}

	function paparJadualF3_TajukBawah($rows,$fields)
	{
		## pecah muka surat
		//$cetak=($bil==$rows)?'style="page-break-after:always">':'>';
		$cetak='style="page-break-after:always">';
		echo '<tr style="page-break-after:always"><td colspan=' . ($fields+1) . '>' .
			'<p align=left><font size=2>' .
			'A) Laporan kawalan harian ini merujuk kepada arahan Pengarah pada mesyuarat Pemantauan' .
			'<br>B) Sila kemaskini laporan ini setiap hari dan failkan mengikut turutan tarikh oleh FE' .
			'<br>C) Tarikh laporan ini bersamaan tarikh kerja luar pada F2 syarikat yang disenaraikan' .
			'<br>D) Laporan ini tidak perlu diisi oleh FE jika tiada kerja luar / telefon dsb' .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			'</font></p></td></tr>' . "\r";
	}

	function paparJadualF3_Data($sv,$namaOrg,
		$allRows,$fields,$hasil,$item,$ms,$baris=30)
	{	
		# nak cari $allRows
		if ($allRows=='0'): echo "\n";
		else: # mula kalau jumpa
			# set pembolehubah untuk highlight
			$highlight=" onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas1';\"";
			$highlight2=" onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas2';\"";
		
			//echo "<tbody>\n"; # mula tbody
			foreach ($hasil as $kira => $nilai)
			{	//$mula = ($ms==1) ? $ms : ($ms*$item)-$ms;
				$h = ($kira%'2'=='0') ? $highlight : $highlight2;
				echo "<tr$h>";
				if ($kira%$baris=='0')
				{			
					$ms = ($kira/$baris)+1;
					$item = ceil($allRows/$baris);
					$this->paparJadualF3_TajukMedan($sv,$namaOrg,$allRows,$fields,$hasil,$item,$ms);
					echo "<td><a target='_blank' href='" . URL . 'kawalan/ubah/'
						. $nilai['newss']."'>".($kira+1)."</a></td>\n";
				}
				else
				{
					echo "<td><a target='_blank' href='" . URL . 'kawalan/ubah/'
					. $nilai['newss']."'>".($kira+1)."</a></td>\n";		
				}
				foreach ($nilai as $key => $data)
				{
					echo '<td>' . $data . '</td>';
				}echo "</tr>\n";
			}
			## cukupkan 30 rows
				$mula = $allRows+1;
				//$bilAwal = ($item-1)*30;  # dpt bil muka surat akhir
				//$bilAkhir = $rows - $bilAwal; # $rows tolak bil tadi
				//$terakhir = 30 - $bilAkhir; # 30 tolak beza tadi
				$akhir = $allRows + ( $baris - ($allRows - (($item-1)*$baris) ) );
				//$mula = $rows+1;
				for($i = $mula; $i <= ($akhir); $i++)
				{
					echo '<tr><td>' . $i . '</td>';
					echo '<td>&nbsp;</td>';
					//echo "<td><font color=\"yellow\">"
					//	. $rows . '-' .(($item-1)*30)." = ".(30 - ($rows - (($item-1)*30) )).", "
					//	. " nombor terakhir > $rows + ".(30 - ($rows - (($item-1)*30) ))." => $akhir</td>";
						for($j = 1; $j <= (24); $j++)
						echo '<td>&nbsp;</td>';
					echo '<tr>';
				}
			
			## tajuk bawah - bil, jumlah besar, utama, newss, A1-B7
				echo "<tr>\n";// dptkan nama medan
				echo '<th>&nbsp;</th>' . "\n";
				echo '<th colspan=2>Jumlah Besar</th>' . "\n";
				echo '<th>&nbsp;</th>' . "\n";
				echo '<th>&nbsp;</th>' . "\n";
				echo '<th>&nbsp;</th>' . "\n";
				foreach ($hasil[0] as $key => $kunci)
				{
					//echo '<th>&nbsp;</th>' . "\n";	
					echo (in_array($key,array('nama','kp','utama','newss','nota')))?  
					'':'<th>' . $kunci . '</th>' . "\n";	
				}
				echo "</tr>\n";
			## tamat tbody
			//echo "</tbody>\n";
		endif;
	}
	# papar data biasa
	function paparJadual_Data($allRows,$rows,$fields,$item,$ms,$hasil)
	{	
		# nak cari $rows
		if ($rows=='0'): echo "\n";
		else: # mula kalau jumpa
			## tajuk atas
				echo "<tr>\n";// dptkan nama medan
				echo '<th colspan=5>RANGKA</th>' . "\n";
				echo '<th colspan=3>KOD 11</th>' . "\n";
				echo '<th colspan=6>PENERIMAAN BORANG</th>' . "\n";
				echo '<th colspan=6>BAKI BORANG</th>' . "\n";
				echo "</tr>\n";
			## tajuk medan
				echo "<tr>\n";// dptkan nama medan
				$senaraiMedan = array('KES','KP','PJB','POK','POM','PJB','POK','POM',
					'PJB','%PJB','POK','%POK','POM','%POM',
					'PJB','%PJB','POK','%POK','POM','%POM'
				);
				foreach ($senaraiMedan as $key)
				{
					echo '<th align="center">' . $key . '</th>';
				}echo "</tr>\n";
		
			# set pembolehubah untuk highlight
			$highlight=" onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas1';\"";
			$highlight2=" onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas2';\"";
		
			//echo "<tbody>\n"; # mula tbody
			foreach ($hasil as $kira => $nilai)
			{	//$mula = ($ms==1) ? $ms : ($ms*$item)-$ms;
				$h = ($kira%'2'=='0') ? $highlight : $highlight2;
				echo "<tr$h>";
				foreach ($nilai as $key => $data)
				{
					echo ($data == null) ? '<td align="center">JUM</td>'
					:'<td align="center">' . $data . '</td>';
				}echo "</tr>\n";
			}
			
			//echo "</tbody>\n";
		endif;
	}
#-------------------------------------------------------------------------------
}
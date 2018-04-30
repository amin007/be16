<?php 
include 'tatarajah.php';// buka pangkalan data 
//echo DB_HOST . "," . DB_USER . "," . DB_PASS . ":" . DB_NAME . "<br>";
$s = @mysql_connect(DB_HOST, DB_USER, DB_PASS) or die (mysql_error()); 
$d = @mysql_select_db(DB_NAME, $s) or die (mysql_error());
$Tajuk_Muka_Surat='MDT 2013';
date_default_timezone_set("Asia/Kuala_Lumpur");
?>
<html>
<head><title>SENARAI F7[<?=$_GET['sv'];?>]</title>
<?php 
include 'css.txt'; 
include 'excel.txt';
?>
</head>
<body><?php
##############################################
//include '../menu_admin.php'; 
//echo '<br><br><br><br><br><br>';

$jadual=$_GET['jadual'];
$respon=$_GET['respon'];

function tegar($respon)
{	if ($respon<>null) 
	{return $respon ="and mdt_rangka.respon <> 'A1' ";}
}
function kiraan($kiraan) 
{
	return number_format($kiraan,0,'.',',');
} 
// nak groupkan respon
	/*$tgk="SELECT $r,kod FROM (mdt_rangka INNER JOIN f2 "."ON $r = f2.kod) GROUP BY 1 ORDER BY no,$r";*/
	$tgk="SELECT kod FROM f2 WHERE kod not in ('X','5P') GROUP BY 1 ORDER BY no";
	
	$hasil = mysql_query($tgk) or die(mysql_error() . "(1)<hr>$tgk<hr>"); 
	while($p=mysql_fetch_array($hasil))
	{
		$kumpul.=($p[0]=='A4') ?
		",\r '' as '" . $p[0] . "<br>a'" .
		",\r '' as '" . $p[0] . "<br>b'" .
		",\r '' as '" . $p[0] . "<br>c'"
		:
		",\r '' as '" . $p[0] . "'";
		//$jumlah_kumpul.="+count(if($r='".$papar[0]."' and b.terima is not null,$r,null))\r";
	}
////////////////////////////////////////////////////////
//$siapa="'amin'";
//$siapa="'semak','semak2'";
$cari="SELECT fe,count(*) as Jum from mdt_rangka13
/*WHERE fe not in($siapa)*/
GROUP BY fe ORDER BY fe";
$lihat = mysql_query($cari) or die(mysql_error()."0)<hr>$cari<hr>"); 
while($lihat2 = mysql_fetch_array($lihat))
{
	$pegawai[]=$lihat2[0];
}

##################################################
// ambil halaman semasa, jika tiada, cipta satu! #
if ( !isset($_REQUEST['page']) ){$page = 1;}
else {$page = $_REQUEST['page'];}                
$msic='if(c.msic08 is null,c.msic,c.msic08)';
##################################################

echo "\n<table border=1 class='excel'>\n";
foreach ($pegawai as $key2 => $nama_pegawai)
{// mula ulang pegawai

	$sql ="SELECT concat_ws('<br>', c.newss, c.ssm) newss $kumpul, 
	concat('label = ',c.label, '<br>', c.nama) catatan, substring(c.poskod, 7, 30) as bandar, c.utama
	FROM mdt_rangka13 c 
	WHERE c.fe = '".$nama_pegawai."' ".tegar($respon)."
	ORDER BY c.label, c.newss ";
	//echo "<pre>$sql</pre>";
	#############--------Mula- query MySQL (LIMIT ".$dari_baris.", ".$baris_max.")--------------#####################
	$baris_max = 300;//$_REQUEST['item']; // berapa item dalam satu halaman
	$dari_baris = (($page * $baris_max) - $baris_max); // Tentukan had query berasaskan nombor halaman semasa.
	$bil = $dari_baris+1; // nak tentukan permulaan bilangan baris dlm satu muka surat

	$query  = $sql." LIMIT ".$dari_baris.", ".$baris_max."  "; 

	$result = mysql_query($query) or die(mysql_error()."<hr><pre>$query</pre><hr>"); 
	$fields = mysql_num_fields($result); 
	$rows = mysql_num_rows($result);

	# PEMBOLEH UBAH
	$highlight="onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas1';\"";
	$highlight2=" onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas2';\"";
	// nak cari $rows
	if ($rows=='0'): echo "\n";
	else: // mula kalau jumpa
		## tajuk besar
		$sv=($_GET['sv']=='MDT')?'PENYIASATAN PERDAGANGAN EDARAN BULANAN':
		(
			($_GET['sv']=='MM')?'PENYIASATAN PEMBUATAN BULANAN':
			'PENYIASATAN PERKHIDMATAN SUKU TAHUNAN'
		)
		;
		echo '<tr><td colspan=' . ($fields+1) . '><font size=4><p align=center>' .
		/*BANCI/PENYIASATAN*/'' . $sv . ' ' . date('Y') .
		'<br>PEMBAHAGIAN KERJA ' . date('Y') .
		'</p>NAMA : ' . $nama_pegawai . ' (' . $rows . ' kes)' .
		'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
		'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
		'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
		'TARIKH KERJA LUAR : <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
		'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
		'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
		'</u></font></td></tr>' . "\r";
	
		## tajuk medan - keputusan 
		echo "<tr>\n<th rowspan=3>BIL</th>\n";
		echo '<th rowspan=3>NEWSS</th>' . "\n";
		echo '<th colspan=22>KEPUTUSAN</th>' . "\n";
		echo '<th rowspan=3>CATATAN</th>' . "\n";
		echo '<th rowspan=3>KAWASAN</th>' . "\n";
		echo '<th rowspan=3>UTAMA</th>' . "\n";
		echo "</tr>\n";
		
		## tajuk medan - A , B
		echo "<tr>\n";
		echo '<th colspan=15>A</th>' . "\n";
		echo '<th colspan=7>B</th>' . "\n";
		echo "</tr>\n";
		
		## tajuk medan - newss A1-B7, catatan, utama
		echo "<tr>\n";// dptkan nama medan
		for ( $f = 0 ; $f < $fields ; $f++ )
		//{	echo '<th>' ."$f-". mysql_field_name($result,$f) . "</th>\n";	}
		{	
			echo (in_array($f,array(0,23,24,25)))?  '' :
			'<th>' . mysql_field_name($result,$f) . "</th>\n";	
		}
		
		echo "</tr>\n";
		
		// data
		#while($row = mysql_fetch_array($result))
		while($row = mysql_fetch_array($result,MYSQL_NUM))
		{// mula papar 
			echo($bil%'2'=='0')?"<tr bgcolor='#ffffe0' $highlight>":
			"<tr bgcolor='#ffe4e1' $highlight2>";
			echo "<td><a target='_blank' href='kawal_edit.php?cari=".$row[0]."'>".$bil++."</a></td>\n";
			
			for ($f=0;$f < $fields;$f++)
			{
				echo (in_array($f,array(0,23,24,25)))? 
				"<td>" . $row[$f] . "</td>\n"
				: "<td>" . $row[$f] . "&nbsp;&nbsp;</td>\n";
			}
			
			echo "</tr>\n";
		}// tutup papar 
	## pecah muka surat
		//$cetak=($bil==$rows)?'style="page-break-after:always">':'>';
		$cetak='style="page-break-after:always">';
		echo '<tr style="page-break-after:always"><td colspan=' . ($fields+1) . '>' .
		'<p align=center><font size=3><br>TANDATANGAN : _____________ ' .
		'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
		'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
		'TARIKH : <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
		'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
		'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
		/*'TARIKH : <u>' . (date('d')-0) . (date('/m/Y')) .	'</u> ' .*/
		'</u></font></p></td></tr>' . "\r";
endif; //tamat jika jumpa
// tamat - cari $rows
#############--------Tamat- query MySQL (LIMIT ".$dari_baris.", ".$baris_max.")--------------#####################
}// tamat ulang pegawai
echo "</table>\n";
//echo "<input type='submit' name='hantar' value='Submit'></form></fieldset>\r";

?>
</body>
</html>
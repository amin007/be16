<?php 
include 'tatarajah.php';// buka pangkalan data 
//echo DB_HOST . "," . DB_USER . "," . DB_PASS . ":" . DB_NAME . "<br>";
$s = @mysql_connect(DB_HOST, DB_USER, DB_PASS) or die (mysql_error()); 
$d = @mysql_select_db(DB_NAME, $s) or die (mysql_error());
$Tajuk_Muka_Surat='MDT 2013';
date_default_timezone_set("Asia/Kuala_Lumpur");
?>
<html>
<head><title>Laporan Bulanan MDT 2013[<?=$_GET['respon'];?>]</title>
<?php 
include 'css.txt'; 
include 'excel.txt';
?>
</head>
<body><?php
##############################################
$jadual=$_GET['jadual'];
$respon=$_GET['respon'];
function tegar($respon)
{	if ($respon<>null) 
	{return $respon ="and mdt_rangka.respon <> 'A1' ";}
}
##############################################
// nak buat tab - mula 
$kes='mdt_';$t='13';
$bulan = array('rangka',
'jan', 'feb', 'mac', 'apr', 
'mei', 'jun', 'jul', 'ogo', 
'sep', 'okt', 'nov', 'dis');
unset($bulan[0]);
## Utk sql
#########################################################
////////////////////////////////////////////////////////
$bil_jadual=count($bulan);
$bil_papar=$bil_jadual-1;
$r='terima';
// ulang medan
for($i=1;$i <= $bil_jadual;$i++)
{
	$kodA .= $kes . $bulan[$i] . $t . '.' . 
	$r . ' as ' . $bulan[$i] . $t;
	//$kodA .= ' ' . $r . ' as ' . $bulan[$i] . '12';
	$kodA .=($i==$bil_jadual) ? "\r" : ",\r"; 
} 
// ulang kurungan
for($i=1;$i <= $bil_papar;$i++)
{
	$kodB .=($i==$bil_papar) ? '' : '(';
} 
// ulang inner join
// ulang inner join
for($i=1;$i <= $bil_papar;$i++)
{
	$kodC .= "INNER JOIN ".$kes.$bulan[$i+1].$t.
	" ON ".$kes.$bulan[$i].$t.".newss = ".$kes.$bulan[$i+1].$t.".newss ";
	$kodC .=($i==$bil_papar) ? "\r" : ")\r";
} 
// ulang medan
////////////////////////////////////////////////////////////////////////
//$siapa="'adam','shukor'";
$siapa="'batal'";
$cari="SELECT fe,count(*) as Jum from mdt_rangka13 
WHERE FE<>$siapa
GROUP BY fe ORDER BY fe";
$lihat = mysql_query($cari) or die(mysql_error()."0)<hr>$cari<hr>"); 
while($lihat2 = mysql_fetch_array($lihat)){$pegawai[]=$lihat2[0];}
//unset($pegawai[0]);
//echo '<pre>', print_r($pegawai) . '</pre>';
////////////////////////////////////////////////////////////////////////
//$msic='if(c.msic08 is null,c.msic,c.msic08)';
$msic='c.msic';
echo "\n<table border=1 class='excel'>\n";
foreach ($pegawai as $key2 => $nama_pegawai)
{// mula ulang pegawai
	/* $kodA FROM $kodB ( mdt_rangka c 
	INNER JOIN mdt_jan12 ON c.newss = mdt_jan12.newss )
	$kodC */

	$sql =($jadual==null) ? 
	'/* semak bulan 1 - 12 */' . "\r\t" .
	'SELECT concat(substring(c.newss,1,3),substring(c.newss,4,3),\'<br>\',' .
	'substring(c.newss,7,3),substring(c.newss,10,3)' . ') as id,' .
	"c.nama, c.utama U,c.respon as R,$msic as msic,
	$kodA FROM $kodB ( mdt_rangka13 c \r" .
	"INNER JOIN mdt_jan13 ON c.newss = mdt_jan13.newss ) \r" .
	"$kodC 
	WHERE c.fe = '".$nama_pegawai."' ".tegar($respon)."
	ORDER BY 3,2 ": "SELECT b.utama U,
	concat(substring(b.newss,1,3),' ',substring(b.newss,4,3),' ',
	substring(b.newss,7,3),' ',substring(b.newss,10,3) ) as id,
	b.nama,$msic as msic,
	b.terima,c.respon R,
	b.hasil,b.dptLain,b.web,b.stok,b.staf,b.gaji,b.outlet,b.sebab,b.newss 
	FROM ( mdt_rangka13 c INNER JOIN mdt_$jadual b ON c.newss = b.newss ) 
	WHERE c.fe = '".$nama_pegawai."' 
	ORDER BY 1,3";
	//echo "<pre>$sql</pre>";

	##################################################
	// ambil halaman semasa, jika tiada, cipta satu! #
	if ( !isset($_REQUEST['page']) ){$page = 1;}
	else {$page = $_REQUEST['page'];}                
	##################################################
	#############--------Mula- query MySQL (LIMIT ".$dari_baris.", ".$baris_max.")--------------#####################
	$baris_max = 300;//$_REQUEST['item']; // berapa item dalam satu halaman
	$dari_baris = (($page * $baris_max) - $baris_max); // Tentukan had query berasaskan nombor halaman semasa.
	$bil = $dari_baris+1; // nak tentukan permulaan bilangan baris dlm satu muka surat

	$query  = $sql." LIMIT ".$dari_baris.", ".$baris_max."  "; 

	$result = mysql_query($query) or die(mysql_error()."<hr><pre>$query</pre><hr>"); 
	$fields = mysql_num_fields($result); $rows = mysql_num_rows($result);

	# PEMBOLEH UBAH
	$highlight="onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas1';\"";
	$highlight2=" onmouseover=\"this.className='tikusatas';\" onmouseout=\"this.className='tikuslepas2';\"";
	// nak cari $rows
	if ($rows=='0'): echo "\n";
	else: // mula kalau jumpa
		## tajuk besar
		echo '<tr><td colspan='.($fields+1).'><font size=5>kes '.$nama_pegawai.' ada '.$rows.'</font></td></tr>';
		
		if ($jadual==null)
		{## tajuk medan
		echo "<tr>\n<td>#</td>";// dptkan nama medan
		for ( $f = 0 ; $f < 5 ; $f++ ) {echo '<td>' . mysql_field_name($result,$f) . "&nbsp;</td>\n"; }
		for ( $f1 = 5 ; $f1 < $fields ; $f1++ )
		//{echo "<td>-$f-".mysql_field_name($result,$f1)."</td>\n";}
		{
			echo '<td>' . mysql_field_name($result,$f1) .
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
			"</td>\n";
		}
		echo "</tr>\n";
		#while($row = mysql_fetch_array($result))
			while($row = mysql_fetch_array($result,MYSQL_NUM))
				{// mula papar 
				$cetak=($bil==$rows)?'style="page-break-after:always">':'>';
				echo($bil%'2'=='0')?"<tr bgcolor='#ffffe0' $highlight $cetak":
				"<tr bgcolor='#ffe4e1' $highlight2 $cetak";
				echo "<td><a target='_blank' href='kawal_edit.php?cari=".
				$row[0]."'>".$bil++."</a></td>\n";
				
				for ($f=0;$f < $fields;$f++)
				{
					echo "<td>" . $row[$f] . "<br></td>\n";
				}
				
				echo "</tr>\n";
				}// tutup papar 
		} else {
		## tajuk medan
		echo "<tr>\n<td>#</td>"; for ( $f = 0 ; $f < $fields-1 ; $f++ )
			{echo "\n<td>$f-".mysql_field_name($result,$f)."</td>"; }
		echo "\n</tr>\n";
		
		while($ke = mysql_fetch_array($result,MYSQL_NUM)) 
			{// mula papar semak
				$cetak=($bil==$rows)?'style="page-break-after:always">':'>';
				echo($bil%'2'=='0')?"<tr bgcolor='#ffffe0' $highlight $cetak":
				"<tr bgcolor='#ffe4e1' $highlight2 $cetak";
				echo "\n<td><a target='_blank' href='kawal_edit.php?cari=".$ke[14]."'>".$bil++."</a></td>";
				for ($f=0; $f < 6 ;$f++){echo "\n<td>".$ke[$f].'</td>';}
				for ($f=6; $f < 13 ;$f++)
				{
					$papar=$ke[$f];//@kira($ke[$f]);

					//if ($papar=='0000-00-00') {$papar='';}
				
					echo "\n<td align=right>".$papar.'</td>';
				}
				echo "\n<td>".$ke[13].'</td>';
				echo "\n</tr>";
			}// tutup papar semak
		}
		## pecah muka surat
		/*
		echo '<tr align=center ';echo ($_GET['pecah']=='1') ? 'bgcolor="#000000">' : 
		'bgcolor="#00ffff" style="page-break-after:always">';
		echo '<td colspan='.($fields+1).'>.</td></tr>';
		*/
	endif; //tamat jika jumpa
	// tamat - cari $rows
	#############--------Tamat- query MySQL (LIMIT ".$dari_baris.", ".$baris_max.")--------------#####################
	
}// tamat ulang pegawai
echo "</table>\n";
//echo "<input type='submit' name='hantar' value='Submit'></form></fieldset>\r";

?>
</body>
</html>
<?php 
include '../mdt2012/db_buka.php';# buka pangkalan data tahun lepas
if (!isset($_POST['semua'])) { ?><?php 
	function papartajuk($fields,$result,$myTable)
{// function papartajuk() - mula
	echo "\n<tr>\n" . '<td>#</td><td>id pertubuhan</td>';
	for ($f=1;$f < $fields;$f++)
		{ echo (mysql_field_name($result,$f)=='nama'
		||mysql_field_name($result,$f)=='nama syarikat') ?
		'<td>nama(Jadual:'.$myTable.')</td>'."\n":
		'<td>'.mysql_field_name($result,$f).',</td>'."\n"; }
	echo '</tr>';
}// function papartajuk() - tamat
	function paparisi($myTable,$row,$result,$fields,$rows,$bil)
{// function paparisi() - mula
	echo($bil%'2'=='0')?"\n<tr bgcolor='#ffffe0'>":"\n<tr bgcolor='#ffe4e1'>";
	
		$p = ($myTable=='mdt_rangka') ?
		'href="kawal_tambah.php?cari='.$row[2].'"':
		'href="kawal_edit.php?cari='.$row[1].'"';
		
	echo "\n<td><a $p>".$bil."</a></td>";
	for($f=0;$f<$fields;$f++)
	{
		echo "\n<td>".$row[$f]."</td>";
	}
	echo "\n</tr>";
}// function paparisi() - tamat
	function paparisi2($myTable,$row,$result,$fields,$rows,$bil)
{// function paparisi2() - mula
	echo($bil%'2'=='0')?"\n\t\t<tr bgcolor='#ffffe0'>":"\n\t\t<tr bgcolor='#ffe4e1'>";
	echo "\n\t\t<td>".$bil."</td>";
	
	for($f=0;$f<$fields;$f++)
	{
		echo "\n\t\t<td>".$row[$f]."</td>";
	}
	echo "\n\t\t</tr>\n";
}// function paparisi2() - tamat
	function msic($industri,$industriB)
{// function msic() - mula	
	echo "\r\t<td>\r".
	'<!-- ################################################################### -->';
	
	$MSIC = array('msic','msic2008','msic_v1','msic_nota_kaki','msic_bandingan');
	foreach ($MSIC as $key2 => $jadual)
	{// $MSIC ulang jadual-mula
	$m=($jadual!='msic2008')?'*':
	"seksyen S,bahagian B,kumpulan Kpl,kelas Kls,msic2000,msic,keterangan,notakaki";
	$sql2="SELECT $m\rFROM $jadual WHERE msic='".$industri."' OR msic='".$industriB."'";

	$result = mysql_query($sql2) or die(mysql_error()."<hr>$sql2<hr>"); 
	$fields = mysql_num_fields ($result); $rows = mysql_num_rows ($result);
	
	// nak papar bil. brg
	if ($rows=='0' or $industri==null): echo "\r\t\t" .
	'<span style="background-color: black; color:yellow">' .
	":( $jadual:MSIC=$industri $industriB</span><br>\r";
	else: // kalau jumpa
		$nama_jadual='<span style="background-color: black; color:yellow">' . $jadual . '</span>';
		echo "\r\t\t<table border=1 class='excel' bgcolor='#ffffff'>" .
		"\n\t\t<tr>"."\n\t\t<td>#</td>";
		
		for ( $f = 0 ; $f < $fields ; $f++ )
		{ 
			echo (mysql_field_name($result,$f)=='keterangan') ?
			"\n\t\t<td>keterangan - $nama_jadual</td>":
			"\n\t\t<td>".mysql_field_name($result,$f).",</td>"; 
		}
		
		echo "\n\t\t</tr>";

		$bil=1;
		while($row = mysql_fetch_array($result,MYSQL_NUM))
		{
			paparisi2($myTable,$row,$result,$fields,$rows,$bil);
			$bil++;
		}

		echo "\t\t</table>\r";
		
	endif; //tamat jika jumpa
	}//$MSIC ulang jadual-tamat
	echo "\t".'</td>
<!-- ################################################################### -->';		
}// function msic() - tamat
function cariMedanInput($ubah,$f,$row,$nama) 
{//function cariMedanInput($f,$nama,$input)  - mula
	/*senarai nama medan
	0-nota,1-respon,2-fe,3-tel,4-fax,		
	5-responden,6-email,7-msic,8-msic08,
	9-`id U M`,10-nama,11-sidap,12-status
	*/// papar medan yang terlibat
	$cariMedan=array(0,1,2,3,4,5);
	$cariText=array(0);// papar jika nota ada
	$cariMsic=array(8); //papar input text msic sahaja 
	$medanR=$ubah.'['.$nama.']';
		
	// tentukan medan yang ada input
	$input=in_array($f,$cariMedan)? 
	(@in_array($f,$cariMsic)? // tentukan medan yang ada msic
		'<input type="text" name="'.$medanR.'" value="'.$row[$f].'" size=6>'
		:(@in_array($f,$cariText)? // tentukan medan yang ada input textarea
			'<textarea name="'.$medanR.'" rows=2 cols=23>'.$row[$f].'</textarea>':
			'<input type="text" name="'.$medanR.'" value="'.$row[$f].'" size=30>')
	):'<label class="papan">'.$row[$f].'</label>';
	
	return $input;

}//function cariMedanInput($f,$nama,$input)  - tamat
function kira($kiraan)
{
	return number_format($kiraan,0,'.',',');
}
//@$kiraan=(($kini-$dulu)/$dulu)*100; 
function kira2($dulu,$kini)
{
	return @number_format((($kini-$dulu)/$dulu)*100,0,'.',',');
}
function kira3($dulu,$kini)
{
	return @number_format((($kini-$dulu)/$dulu)*100,0,'.','');
}
//@$kiraan=(($kini-$dulu)/$dulu)*100;
function diehard4($bil,$sql) 
{
	$w0=' style="background-color: #fffaf0; color:black" ';
	$w1='<span style="background-color: #fffaf0; color:black">';$w2='</span>';
	echo $w1.mysql_error().$w2.'<hr><pre'.$w0.'>'.$bil."->\r".$sql.'</pre><hr>';
}
function bersih($papar) 
{
	# lepas lari aksara khas dalam SQL
	//$papar = mysql_real_escape_string($papar);
	# buang ruang kosong (atau aksara lain) dari mula & akhir 
	$papar = trim($papar);
	
	return $papar;
}
$pilihan='newss';
$carian=bersih($_GET['cari']);
$_GET['cari']=bersih($_GET['cari']);
# semak bulan semasa
$bln = getdate();
$semakBln = $bln['mon'];
$bulanan = array('jan', 'feb', 'mac', 'apr', 
	'mei', 'jun', 'jul', 'ogo', 
	'sep', 'okt', 'nov', 'dis'); 
$semakBulan = $bulanan[$semakBln-1];
$caripapar = //$semakBln . $semakBulan . 
'=' . $_GET['cari'];
?>
<html>
<head><title>Kes MDT 2012:<?=$carian?></title>
<script type="text/javascript" src="../../../js/datepick/jquery.js"></script>
<!-- pilih tarikh - mula -->
<link rel="stylesheet" href="../../../js/datepick/datepick.css" type="text/css" />
<link rel="stylesheet" href="../../../js/datepick/flora.datepick.css" type="text/css" />
<script type="text/javascript" src="../../../js/datepick/datepick.js"></script>
<script type="text/javascript" src="../../../js/datepick/datepick-ms.js"></script>
<!-- pilih tarikh - tamat -->
<!-- mesin kira - mula -->
<link rel="stylesheet" href="../../../js/calc/calc.alt.css" type="text/css" />
<script type="text/javascript" src="../../../js/calc/calc.min.js"></script>
<script type="text/javascript" src="../../../js/calc/calc.my.js"></script>
<!-- mesin kira - tutup -->

<?php 
//include '../css.txt'; 
//include '../gambar_head.txt';
include 'excel.txt';
//include '../autocomplete.txt';
?>
</head>
<body background="../../../bg/bg/<?php //include '../gambar2.php';?>">
<div id="content">
<fieldset><legend>
<span style="background-color: black; color:yellow">
(Cari Kes MDT 2012<?=$caripapar?>)</span></legend>
<?php
$s1='<span style="background-color: black; color:yellow">';
$hr=')<hr>';$s2='</span>';
#------------------------------------------------------------------------------#
//$myJadual=array('mdt_rangka');
$blnlepas='pom_bln11.mdt_' . $semakBulan . '11';
$rgklepas='pom_bln11.mdt_rangka';
$id = 'concat(substring(newss,1,3),\' \',substring(newss,4,3),\' \','.
	'substring(newss,7,3),\' \',substring(newss,10,3)'.
	') as id,';
//$myJadual=array('dtsample3','mdt_johor','dtkawal',
//	$rgklepas,$blnlepas,'mdt_pom','mdt_rangka');
$myJadual=array('mdt_rangka');
// medan dtsample3 $medanSemak[]= $id . 'newss,nama,ng,dp,sv,msic,status,indeks';
/* medan mdt_johor $medanSemak[]= $id . 'newss,concat(nama,\'<br>\',sidap) `nama syarikat`,'.
	'operator,alamat1,alamat2,poskod,ngdbbp,status,sv,msic,label,'.
	'catatan11,catatan12,fe11,fe';
	*/
/* medan dtkawal $medanSemak[]= $id . 'concat(nama,\'<br>\',sidap2009) `nama syarikat`,' .
	'operator,alamat1a,alamat2b,poskod,NGDBBP,utama,' .
	'penyiasatan jenis,kod_sv_baru,msic,bil,fe,cek,cek2 ' .
	'`STATE_NAME_MS`,`EB ID PO_ORGUNIT_NAME`,`DISTRICT_NAME_MS`,' .
	'';*/
/* medan $rgklepas $medanSemak[]= $id . 'concat(nama,\'<br>\',sidap) `nama syarikat`,' .
	'operator,alamat1,alamat2,poskod';*/
/* medan $blnlepad $medanSemak[]= $id . "\r" . 
	'nama,msic08,terima,"bln'.$semakBln.'",hasil,dptLain,web,' .
	'stok,staf,gaji,sebab,outlet,""';*/
/* medan mdt_pom 
$medanSemak[]= $id . 'newss,concat(nama,\'<br>\',sidap) `nama syarikat`,'.
	'operator,concat_ws(\'<br>\',alamat1,alamat2,poskod) alamat,ngdbbp,status,sv,msic,label,'.
	'catatan11,catatan12,fe11,fe';*/
/* medan mdt_rangka */
$medanSemak[]= $id . 'newss,nama,concat(operator,\'<br>\',sidap) `operator`,ssm,' .
	'R.status as U,sv,msic,msic08,concat_ws(\'<br>\',alamat1,alamat2,poskod) alamat,fe,label';
//------------------------------------------------------------------------------
$myJoin='nama_pegawai';
foreach ($myJadual as $key => $myTable)
{// mula ulang table
	$sql="\tSELECT ".$medanSemak[$key]." FROM 
	".$myTable." R /*LEFT JOIN ".$myJoin." J
	ON R.fe = J.namaPegawai */
	WHERE concat(newss,nama) like '%".$carian."%' ";
	//echo $s1.$hr.$sql.$s2;

	$result = mysql_query($sql) or diehard4($myTable,$sql);
	//die($s1.mysql_error().$hr.$sql.$s2);
	$fields = mysql_num_fields($result);
	$baris = mysql_num_rows($result);

	// nak papar bil. brg
	if ($baris=='0' or $_GET['cari']==null): 
		echo '<span style="background-color: black; color:white">'.
		'Maaflah, ' . $_GET['cari'] . ' tak jumpalah pada jadual :' .
		$myTable . '|<font face=Wingdings size=5>L</font></span><br>';

	elseif($baris=='1'): // kalau jumpa
		echo '<table border=0 class="excel" bgcolor="#ffffff">';
		papartajuk($fields,$result,$myTable);
		
		//$bil=1;while($row = mysql_fetch_array($result,MYSQL_NUM))
		$bil=1;while($row = mysql_fetch_array($result))
		{// mula papar 
			paparisi($myTable,$row,$result,$fields,$rows,$bil);
			$bil++;$noID=$row['newss'];
			if ($myTable=='mdt_rangka') 
			{
				$kawan=$row['fe'];
				$telkawan=$row['nohpfe'];
				$survey=$row['sv'];
			}
			elseif ($myTable==$blnlepas) 
			{
				for ( $c = 1 ; $c < $fields ; $c++ )
				{
					$namamedan=mysql_field_name($result,$c);
					$lepas[$namamedan]=$row[$namamedan];
				}
			}
		}// tutup papar
		echo "\n</table>\n";
	else : 
		echo '<span style="background-color: black; color:red">'.
		'banyak pulak datanya. pilih satu sahaja</span>'."\n".
		'<table border=0 class="excel" bgcolor="#ffffff">';
		papartajuk($fields,$result,$myTable);
			
		$bil=1;while($row = mysql_fetch_array($result,MYSQL_NUM))
		{
			paparisi($myTable,$row,$result,$fields,$rows,$bil);
			$bil++;
		}
		echo "\n</table>\n";
	endif; //tamat jika jumpa
}// tamat ulang table
//------------------------------------------------------------------------------
//echo '<pre>$lepas->'; print_r($lepas) . '</pre>';
//style="position: relative; top: -12px; left: 80px;" ?>
</fieldset>
<div align="center"><form method="GET" action="">
<font size="5" color="red"><?=$_GET['ralat']?>&rarr;</font><br>
<input type="text" name="cari" size="40" value="<?=$carian;?>" 
id="inputString" onkeyup="lookup(this.value);" onblur="fill();">
<input type="submit" value="mencari">
<div class="suggestionsBox" id="suggestions" style="display: none; " >
	<img src="../../../js/autocomplete/upArrow.png" alt="upArrow" 
	style="display: block; margin-left: auto; margin-right: auto"	/>
	<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
</div>
</form></div>
<!-- ----------------------------------------------------------------------------------------------------- -->
<form action="kawal_edit.php?cari=<?=$_GET['cari'];?>#bawah" enctype="multipart/form-data" method="POST">
<table class="excel" border="0">
<?php
if ($baris=='1')
{
	$rangkaMDT = array('mdt_rangka');
	$medan='nota,respon,fe,tel,fax,responden,email,msic,msic08,' .
	'concat(substring(newss,1,3),\' \',substring(newss,4,3),\' \',' .
	'substring(newss,7,3),\' \',substring(newss,10,3),\' | \',' .
	'status,\' \',msic) as ' . '`id U M`,nama,sidap,status';
	//--------------------------------------------------------------------------------------
	foreach ($rangkaMDT as $key => $ubah)
	{// mula ulang table
		$query='SELECT ' . $medan . ' FROM ' . $ubah . ' WHERE newss like "' . $noID . '" ';

		$result = mysql_query($query) or diehard4($ubah,$query);
		$fields = mysql_num_fields($result); 
		$rows   = mysql_num_rows($result);

	// nak papar bil. brg
	if ($rows=='0'): echo '<tr><td valign="top" colspan="3">' .
		'<span style="background-color: black; color:yellow">' .
		'Maaflah, ' . $noID . ' tak jumpalah pada jadual:' . $ubah .
		'<font face=Wingdings size=5>L</font></span></td></tr>';

	else: // kalau jumpa
		while($row = mysql_fetch_array($result,MYSQL_NUM))
		{	
			for ( $f = 0; $f < $fields ; $f++ )
			{// masuk - mula
			/*senarai nama medan
			0-nota,1-respon,2-fe,3-tel,4-fax,		
			5-responden,6-email,7-msic,8-msic08,
			9-`id U M`,10-nama,11-sidap,12-status*/
				# mula set pembolehubah
				$p1='<label class="papan">';
				$p2='</label>';
				$industri=$row[7];
				$industriB=$row[8];
				$sidap=$row[11];
				$utama=$row[12];
				
				// nak gabungan 2 msic
				$msic78=$p1 . '7-' . mysql_field_name($result,7) .
				'<br>8-' . mysql_field_name($result,8) . $p2;
							
				// cari input berdasarkan nama
				$nama=mysql_field_name($result,$f);	
				$input=cariMedanInput($ubah,$f,$row,$nama);
				
				# tamat set pembolehubah
				# mula papar output
					//if (($f==7)or($f==10)or($f==11)or($f==12)){ echo '';}	
					if (in_array($f,array(7,10,11,12))) echo '';
					elseif ($f==8)// msic08
					{				
						echo "<tr>\r\t<td>$msic78</td>\r\t" .
						//'<td>' . $p1 . $industri . $p2 . $input . '</td>';
						'<td>' . $p1 . $industri . ' | ' . $industriB . $p2 . '</td>';
						msic($industri,$industriB);	
						echo "\r</tr>";
					}
					else
					{
						echo "<tr>\r\t<td>$p1$f-".$nama."$p2</td>".
						"\r\t<td>".$input."</td>".
						"\r\t<td>$p1".$row[$f]."$p2</td>\r</tr>";
					}
				# tamat papar output
			}// masuk - tamat
		}
	endif; //tamat jika jumpa
	}// tamat ulang table
	//--------------------------------------------------------------------------------------
	//$layout="layout:['BS_7_8_9_+@X','CE_4_5_6_-@U','CA_1_2_3_*@E','oo_0_._=_/']";
	$layout="layout:['@U_7_8_9_+BS','@X_4_5_6_-CE','@E_1_2_3_*CA','  oo_0_._=_/']";
?>
</table>	
<script type="text/javascript">
$(function() {
	$.calculator.addKeyDef('oo', '00', $.calculator.digit, null, '', 'HUNDRED', '{');
<?php foreach ($bulanan as $tarikh2 => $tarikh )
  {// mula ulang tarikh ?>
	$('#mdt_<?=$tarikh?>12').datepick({dateFormat: 'yyyy-mm-dd'});
	$('#mdt_<?=$tarikh?>12-hasil').calculator(	{<?=$layout?>});
	$('#mdt_<?=$tarikh?>12-dptLain').calculator({<?=$layout?>});
	$('#mdt_<?=$tarikh?>12-stok').calculator(	{<?=$layout?>});
	$('#mdt_<?=$tarikh?>12-web').calculator(	{<?=$layout?>});
	$('#mdt_<?=$tarikh?>12-gaji').calculator(	{<?=$layout?>});
	$('#mdt_<?=$tarikh?>12-staf').calculator(	{<?=$layout?>});
<?}// tamat ulang tarikh ?>
});
</script>
<table class="excel" border="0">
<?php
	
	// lepas
	if (is_array($lepas))
	{
		$thnlepas = "\n<tr bgcolor='#e6e6fa'>";#LAVENDAR
		foreach ($lepas as $xx => $tahunan)
		{ 
			$thnlepas .= "\n<td>" . $tahunan . '</td>'; 
		}	
		$thnlepas .= "\n</tr>";

		echo $thnlepas;
	}
	// semasa
	$U='-<font size=5>' . $utama . '</font>';
	$brg='#ffffff';
	$r=array('msic','terima','bulan','hasil','dptLain','web','stok','staf','gaji','sebab','outlet','nota');
	
	$tajuk = "\n<tr bgcolor='$brg'>\n<td>kes $U</td>";
	foreach ($r as $rx => $x)
	//for ($x=0;$x < count($r);$x++)
	{ 
		$tajuk .= "\n<td>" . $x . '</td>'; 
	}	
	$tajuk .= "\n</tr>";

	echo $tajuk;
	
foreach ($bulanan as $kunci => $bln)
{// mula ulang table
	$bulan='mdt_'.$bln.'12';
	
	$medan='concat(substring(newss,1,3),\' \',substring(newss,4,3),\' \',' .
	'substring(newss,7,3),\' \',substring(newss,10,3))' . ' as sidap,' . "\r" .
	'nama,msic08,terima,hasil,dptLain,web,' .
	'stok,staf,gaji,sebab,outlet,\'' . $bln . '\'';

	$sql2[]='SELECT ' . $medan . "\r" . 'FROM ' . $bulan . 
	' WHERE newss="' . $noID . '" ';
}// tamat ulang table
	$query=implode("\rUNION\r",$sql2);
	//echo '<pre>' . $query . '</pre>';
// jalankan sql
	$result = mysql_query($query) or diehard4($bulan,$query);
	$fields = mysql_num_fields($result); 
	$rows   = mysql_num_rows($result);

# papar output - mula
// nak papar bil. brg
if ($rows=='0' or $_GET['cari']==null or $noID==null): 
	echo '<tr><td valign="top" colspan="' . (count($r)+1) . '">' .
	'<span style="background-color: black; color:yellow">
	Maaflah, ' . $noID . ' tak jumpalah pada jadual ' .
	$kira . '->' . $bln . '->' . $bulan . '
	<font face=Wingdings size=5>L</font></span></td></tr>';

else: // kalau jumpa
	//echo '<tr><td colspan='.(count($r)+1).'>'.$kira.'->'.$bln.'->'.$bulan.'</td></tr>'."\r";
	
    while($row = mysql_fetch_array($result,MYSQL_NUM)) 
    {// mula papar result
	## baris input #####################################################################
		$bln=$row[12];
		$bulan='mdt_' . $bln . '12';
		$kira++;
		
		$syarikat=$row[1];// nama syarikat
		$link='target="_blank" href="./cetak-kes.php?cari='.$noID.'&bln='.($kira).'"';
		$link2='target="_blank" href="../../mdt2011/kawal/kawal_edit.php?cari='.$noID.'"';
		
		echo "<tr>\n<td align=center bgcolor='$brg'>$kawan-" . 
		$row[0] . "$U</td>\n";
		//echo "<tr>\n<td align=center>".$kira.'->'.$bln.'->'.$bulan."</td>\n";
		
		for ( $f = 2 ; $f < $fields ; $f++ )	
		{ 	
			$medanB=mysql_field_name($result,$f);
			// istihar nama
			$namainput=" type='text' name='".$bulan."[$medanB]' ".
					   "value='".$row[$f]."' id='$bulan-$medanB'";
			$namainput2=" type='text' name='".$bulan."[$medanB]' ".
					   "value='".$row[$f]."' ";
			$namainput3=" name='".$bulan."[$medanB]' rows='1' cols='18' ";
			// semak nama medan		   
			switch ($f) 
			{// mula - semak nama medan
			case 2:// msic
				$input='<input'.$namainput2.' size=2 maxlength=5 '.
				'style="font-family:sans-serif;font-size:10px;">';
				break;
			case 3:// tarikh terima
				$input='<input'.$namainput2.' id="'.$bulan.'" size=7 readonly '.
				'style="font-family:sans-serif;font-size:9px;">';
				break;
			case 4:// jualan
				$jual[$kira]=$row[4]; $lain[$kira]=$row[5];
				@$hasil=$jual[$kira]+$lain[$kira];// kira hasil
				$input='<input'.$namainput.' size=8>';
				break;
			case 8:case 9:// 8-staf & 9-gaji
				$staf[$kira]=$row[8]; $gaji[$kira]=$row[9];
				$input='<input'.$namainput.' size=5>';
				break;
			case 10://sebab
				$input='<textarea'.$namainput3.'>'.$row[$f].'</textarea>';
				break;
			case 12://nota
				@$sumbang=($jual[$kira]+$lain[$kira])/$staf[$kira];// kira sumbang
				@$hari=($jual[$kira]+$lain[$kira])/30;// kira sehari
				$input='sbg:'.kira($sumbang).'<br>hari:'.kira($hari);
				break;
			default:
				$input='<input'.$namainput.' size=5>';
				break;
			}// tamat - semak nama medan
			
			//'<td>'.($kira+1).')<a '.$link.'>'.$bln.'</a></td>';
			 echo ($f==4) ?
				"\n".'<td bgcolor="' . $brg . '">' . ($kira) .
				')<a ' . $link . '>' . $row[12] . '</a>' .
				'<br><a ' . $link2 . '>lepas</a>' .
				'</td>' . "\n" . '<td align=right>'.$input.'</td>'
				:( ($f==$fields-1) ?
					"\n" . '<td align=right bgcolor="' . $brg . '">' . $input . '</td>' 
					:"\n" . '<td align=right>' . $input . '</td>'
				);
		}
		echo "\n".'</tr>';
	## baris input #####################################################################
	## baris papar #####################################################################
		$key++;
			
		echo "<tr bgcolor='bisque'>\n";
		for ($f=1; $f < 4 ;$f++)
		{	
			echo //($f==1)? "<tr>\n<td align=center>".$key.'->'.$bln.'->'.$bulan."</td>\n":
			"\n<td align=center>".$row[$f].'</td>';	
		}
		for ($f=4; $f < 10 ;$f++)
		{// kira jual
			if ($f==4)
			{
				$dulu=$jual[$key-1]; $kini=($row[4]);
				$papar=@kira($row[4]).'|'.kira2($dulu,$kini).'%';
			}
		// kira lain
			elseif ($f==5)
			{
				$dulu=$lain[$key-1]; $kini=($row[5]);
				$papar=@kira($row[5]).'|'.kira2($dulu,$kini).'%';
			}
		// kira staf
			elseif ($f==8)
			{
				$dulu=$staf[$key-1]; $kini=($row[8]);
				$papar=@kira($row[8]).'|'.kira2($dulu,$kini).'%';
			}
		// kira gaji
			elseif ($f==9)
			{
				$dulu=$gaji[$key-1]; $kini=($row[9]);
				$papar=@kira($row[9]).'|'.kira2($dulu,$kini).'%';
			}
		// kira lain2 data
			else {$papar=@kira($row[$f]);}
		// semak dah kira, baru papar
			$Dahulu=($jual[$key-1]+$lain[$key-1]);
			$Kemudian=($row[4]+$row[5]);
			$beza=kira2($Dahulu,$Kemudian); // ada koma
			$beza3=kira3($Dahulu,$Kemudian);// takde koma
			$sebab=($beza3 <= 30 && $beza3 >= -30)?
			$syarikat: $syarikat . (
				($beza3 > 0) ? ' naik ' :' turun '
			) . $beza3 . '%';
			$link3='target="_blank" href="../forum/sms.php?kawan=' . $kawan .
			//'&cari=' . urlencode($sebab) . '"';
			'&cari=' . ($sebab) . '"';
			$banding='<a ' . $link3 . '>' .
			(
				($beza <= 30 && $beza >= -30)? $beza
				:'<font size=4>' .$beza . '</font>'
			) . '%</a>';
			
			echo "\n".($f==4?'<td>'.$banding.'</td>'."\r":'').
			'<td align=right>'.($papar==0?'':$papar).'</td>';
		//kira purata
		@$purata=kira(($row[9]/$row[8]));// gaji/staf
		}
		echo "\n<td>" . $row[10] . '</td>'.
		"\n<td align=right>" . $row[11] . '</td>'.
		"\n<td align=right>1gaji=" . $purata . '</td>'.
        "\n</tr>";
	## baris papar #####################################################################
	}// tutup papar result
endif; //tamat jika jumpa
# papar output - tamat
?>
<tr><td valign="top" bgcolor="<?php echo $brg?>">
	<a name="bulan"></a>
<?php $ip=$_SERVER['REMOTE_ADDR'];
echo "\t".'<input type="hidden" name="ip" value="'.$ip."\">\n";
$pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
echo "\t".'<input type="hidden" name="pc" value="'.$pc."\">\n";
//echo "<pre>", print_r($syarikat)."</pre>";
//<input type="hidden" name="sidap" value="$sidap">?>
	<font size="5" color="red"><?=$_GET['ralat']?>&rarr;</font>
</td><td valign="top" colspan="<?php echo (count($r)); ?>">
	<label class="papan">
	<a target='_blank' href="../forum/sms.php?kawan=<?=$kawan?>&cari=<?=urlencode($syarikat)?>">Hantar sms</a> |
	<a target='_blank' href="./kawal_banding.php?jadual=<?=$kini?>&item=30">Bandingan Bulanan</a> | 
	<a target='_blank' href="./print-kes.php?cari=<?=$noID?>">Cetak Setahun</a> | 
	</label>
</td></tr>
</table><?php } else {?> 
<span style="background-color: black; color:red">
<font size=5>Tak Jumpa Daa</font></span></table><?php } ?>
</form>
</div>
</body></html><?php
} else {
// Mula Isytihar Fungsi ********************************************************************************** -->
function update_table( $the_table, $data, $pilihMedan ) 
{
	// cek $data dan $the_table
	//echo '<pre>$data['.$the_table.']', print_r($data) . '</pre>';
	
	// set blank values
	$primary_id = null;
	$fields = array();

	// find fields from table
	$sql = "SHOW COLUMNS FROM $the_table";
	$res = mysql_query($sql) or diehard4('papar medan-',$sql);

	while ($field = mysql_fetch_array($res)) 
	{
		if ($field['Key'] == 'PRI')
			$primary_key = $field['Field'];
		else
			$fields[] = $field['Field'];
	}
 
	$fields = array_flip( $fields ); // flip db field array
	$filtered = array_intersect_key( $data, $fields );// remove non exist array on post data
	array_walk($filtered, create_function('&$val', '$val = mysql_real_escape_string(trim($val));') ); // clean up value 
	
	// tentukan pilihan nak buat $papar==null atau tidak
	if ($pilihMedan=='kosong')
	{
		foreach ($filtered as $medan => $papar)
		{
			//$senarai[]=($papar==null || $papar=='0') 
			$senarai[]=($papar==null) ? " $medan=null" : " $medan='$papar'"; 
		}
		
		$statment=implode(",\r",$senarai);
	}
	else
	{
		$satu=implode( "='%s',\r", array_keys( $filtered ) );
		$statment = vsprintf( 
		$satu . "='%s'", array_values( $filtered ) 
		); // create statement update
	}	
	
	// check if primary key exists
	if ($primary_key && $data[$primary_key])
		$where = "$primary_key = '$data[$primary_key]'";
	 
	$full_sql = " UPDATE $the_table SET \r" .
	"$statment \r WHERE $where";
		
	return $full_sql;
}
function bersih($papar) 
{
	# lepas lari aksara khas dalam SQL
	$papar = mysql_real_escape_string($papar);
	# buang ruang kosong (atau aksara lain) dari mula & akhir 
	$papar = trim($papar);

	return $papar;
}
function diehard4($bil,$sql) 
{
	$w0=' style="background-color: #fffaf0; color:black" ';
	$w1='<br><span style="background-color: #fffaf0; color:black">';
	$w2='</span>';
	echo $w1 . mysql_error() . $w2 . '<hr><pre' . $w0 . '>' .
	$bil . "->\r" . $sql . '</pre><hr>';
}
function ubah($ubah,$masalah,$nama_anda) 
{
	$result = mysql_query($ubah) or diehard4($masalah,$ubah);
	//logxtvx($nama_anda,$ubah);
}
function logxtvx($nama_anda,$ubah)
{# nak log aktiviti user=========================
	$_POST['user'] = $nama_anda;
	$_POST['aktiviti'] = 'kemaskini mdt2012';
	$_POST['arahan_sql'] = "<pre>($ubah)</pre>";
	include '../log_xtvt.php';
}#===============================================
function sms_kawan($myTable)
{
	// bersihkan pembolehubah
	$m['kes']    = bersih($_POST['syarikat']);
	$m['kawan']  = bersih($_POST['kawan']);
	// mula parameter sms
	$p['userid'] = 'amin77';
	$p['passwd'] = 'amin@@7';
	$p['message']= $m['kawan'] . ', kes ' . $m['kes'] .
	' sudah sampai pada ' .	date('j \hb M Y, \j\a\m g:i a') .
	' hari ini.'; //Cepat sampai kes??? Harap2 dapat anugerah cemerlang tahun ini. ';
	$p['mobile_no']='6' . bersih($_POST['telkawan']);
	$p['token']='i1d04568126feca38d0d7957abc377f6d';
	//$p['mobile_no']='60122159410';// amin punya hp
	$url='http://202.171.45.205/blast/sms_gwy.php?' . data_get($p);
	
	//echo '<pre>', print_r($p) . '</pre><br>' . $url . '<br>';
	return $papar = file_get_contents($url);
}
function data_get($data)
{
	$dataGet = '';
	foreach($data as $key=>$val)
	{
		if (!empty($dataGet)) $dataGet .='&';
		$dataGet .=$key . '=' . urlencode($val);
	}

	return $dataGet;
}
// Tamat Isytihar Fungsi ********************************************************************************** -->

// Mula Proses Kawalan ****************************************************************************** -->
	//echo '<pre>'; print_r($_POST) . '</pre>';
	# buat peristiharan
	$_POST['mdt_rangka']['respon']=strtoupper($_POST['mdt_rangka']['respon']);
	$_POST['mdt_rangka']['fe']=strtolower($_POST['mdt_rangka']['fe']);
	$_POST['mdt_rangka']['email']=strtolower($_POST['mdt_rangka']['email']);
	$_POST['mdt_rangka']['responden']=mb_convert_case($_POST['mdt_rangka']['responden'], MB_CASE_TITLE);
	$m['pilih'] = bersih($_POST['pilihan']);
	$m['cari']  = bersih($_POST['carian']);

	$bulan = array('rangka',
		'jan', 'feb', 'mac', 'apr', 
		'mei', 'jun', 'jul', 'ogo', 
		'sep', 'okt', 'nov', 'dis');
		
	# if ($m['cari']==null) - mula -----------------------------------------------------------
	if ($m['cari']==null) :
		echo '<br><font color=blue>Maaflah,(newss=' . $m['cari'] . ') tak isi <br>' .
		'<font face=Wingdings size=5>L</font><a href="../">Menu Utama</a></font>';
	else :
	#-- Mula Lihat Dlm Kawalan  
		#ulang jadual
		foreach ($bulan as $key => $bln)
		{// mula ulang jadual -------------------------------------------------------
			#set primary key
			$myTable=($bln=='rangka')?'mdt_' . $bln : 'mdt_' . $bln . '12';
				$data=$_POST[$myTable];
				$data[$m['pilih']] = $m['cari'];
			//echo "<pre>$myTable-", print_r($data) . '</pre>';
			
			$ubah=update_table($myTable, $data, 'kosong');
			//diehard4('$ubah',$ubah); // papar $ubah
			ubah($ubah,'ubah ' . $myTable,$nama_anda);
		}// tamat ulang jadual -------------------------------------------------------
	#-- Tamat Lihat Dlm Kawalan dan pergi ke borang kawal_edit.php
	$ralat='Selesai';#$ralat=sms_kawan($myTable);
	header('Location:./kawal_edit.php?cari=' . $m['cari'] . '&ralat=' . $ralat . '#bulan');
	endif;
	# if ($m['cari']==null) - tamat -----------------------------------------------------------
// Tamat Proses Kawalan ****************************************************************************** -->
}?>
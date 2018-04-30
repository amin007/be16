<?php
/*
6010354703

25/08/2003

ASOI BIN LIM TIAN CHIN
*/
function tandas($papar) 
{
	# lepas lari aksara khas dalam SQL
	$papar = mysql_real_escape_string($papar);
	# buang ruang kosong (atau aksara lain) dari mula & akhir 
	$papar = trim($papar);

	return $papar;
}

###########################################################################
include 'tatarajah.php';// buka pangkalan data 
//echo DB_HOST . "," . DB_USER . "," . DB_PASS . ":" . DB_NAME . "<br>";
$s = @mysql_connect(DB_HOST, DB_USER, DB_PASS) or die (mysql_error()); 
$d = @mysql_select_db(DB_NAME, $s) or die (mysql_error());
$Tajuk_Muka_Surat='MM 2013';
date_default_timezone_set("Asia/Kuala_Lumpur");
############################################################################
if (!isset($_POST['semua'])) { ?><?php
	function papartajuk($fields,$result,$myTable)
{// function papartajuk() - mula
	echo "\n".'<tr>'."\n".'<td colspan=2>(Jadual:'.$myTable.')</td>';
	for ($f=1;$f < $fields;$f++)
		{ echo (mysql_field_name($result,$f)=='nama syarikat') ?
		'<td>nama</td>'."\n":
		'<td>'.mysql_field_name($result,$f).'</td>'."\n"; }
	echo '</tr>';
}// function papartajuk() - tamat
	function paparisi($myTable,$row,$result,$fields,$rows,$bil)
{// function paparisi() - mula
	echo($bil%'2'=='0')?"\n<tr bgcolor='#ffffe0'>":"\n<tr bgcolor='#ffe4e1'>";
	if (($myTable=='dtsample') && ($myTable!='mdt_rangka'))
	{$p='href="kawal_tambah.php?cari='.$row[2].'"';}
	else {$p='href="kawal_edit.php?cari='.$row[1].'"';}
	echo "\n<td><a $p>".$bil."</a></td>";
	for($f=0;$f<$fields;$f++){echo "\n<td>".$row[$f]."</td>";}
	echo "\n</tr>";
}// function paparisi() - tamat
$cari = tandas($_GET['cari']);
?>
<html>
<head><title>Pilih Kes <?=$cari?></title>
<?php 
include 'css.txt'; 
include 'excel.txt';
$fe = ($cari=='semua')? ""
	: "WHERE FE = '" . $cari . "'";
?>
</head>
<body>
<!--<img src="../../../bg/bg/<?php //include '../gambar.php';?>" alt="background image" id="bg">-->
<div id="content">
<form name="yourform" action="laporan_fe.php" enctype="multipart/form-data" method="POST">
<?php
$myJadual=array('mdt_rangka13');
$medanSemak[]=//'concat(substring(newss,1,3),\' \',substring(newss,4,3),\' \','.
//'substring(newss,7,3),\' \',substring(newss,10,3)'.
'newss, newss as id,fe,"" as catatan_panjang,nama,'.
'concat_ws(",", alamat1,alamat2,'.
'poskod) as alamat,label';
//------------------------------------------------------------------------------
foreach ($myJadual as $key => $myTable)
{// mula ulang table
$sql="SELECT ".$medanSemak[$key]." FROM ".$myTable." R
$fe \r ORDER BY fe";

$result = mysql_query($sql) or die(mysql_error()."<hr>$sql<hr>"); 
$fields = mysql_num_fields ($result);
$rows  = mysql_num_rows ($result);

// nak papar bil. brg
if ($rows=='0' or $_GET['cari']==null): echo '<br><font color=red>Maaflah, '.$_GET['cari'].' tak jumpalah pada jadual:'.$myTable.'<font face=Wingdings size=5>L</font></font>';

else: // kalau jumpa
/*
	// papar segera
	echo '<table border=0 class="excel" bgcolor="#ffffff">';
	papartajuk($fields,$result,$myTable);
	
	//$bil=1;while($row = mysql_fetch_array($result,MYSQL_NUM))
	$bil=1;while($row = mysql_fetch_array($result))
	{// mula papar 
		paparisi($myTable,$row,$result,$fields,$rows,$bil);
		$bil++;
	}// tutup papar
	echo "\n</table>\n";
*/

	echo '<table border=0 class="excel" bgcolor="#ffffff">';
	papartajuk($fields,$result,$myTable);
	
	$temp='';$bil=1;while($row = mysql_fetch_array($result)) // isi medan
	{// mula papar 
		echo "\n<tr><td>".$bil++."</td>"; 
		if($row[2]==$temp){$kumpulan++;}else{$kumpulan = 1;}$temp = $row[2];
		        $fid=mysql_field_name($result,0);
		$input="<input type='checkbox' name='".$fid."[$bil]' value='".$row[0]."'>";
		echo "\n<td><label>".$input."".$row[1]."</label></td>";//nama
        echo "\n".'<td>'.$kumpulan.'</td>';
	
		for($f=2;$f<$fields;$f++)
		{
			echo "\n<td>".$row[$f]."</td>";
		}
		
		echo "\n</tr>";
	}// mula papar 
endif; //tamat jika jumpa
}// tamat ulang table
//--------------------------------------------------------------------------------------
$carian=$_GET['cari'];
$r=$fields;
?>
<tr><td valign="top" colspan="<?php echo ($r+1); ?>">
<a name="bulan"></a>
<?php 
echo '<span style="background-color: black; color:yellow">(';
echo 'fe='.$_GET['cari'].")</span>\r";

$ip=$_SERVER["REMOTE_ADDR"];
echo "<input type='hidden' name='ip' size='10' value=$ip>\n";
$pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
echo "<input type='hidden' name='pc' size='10' value=$pc>\n";
?><input type="text" name="<?=$myJadual[0]?>[fe]" size="20" value="<?=$_GET['cari'];?>">
<input type="submit" value="Proses" name="semua" id="semua">
<?php echo "<font size=5 color=red>".$_GET['ralat']."</font> "; ?>
</td></tr>
</table>
<!-- --------------------------------------------------------------------------------------------------------------------- -->

</form></div>
</body></html>
<?php
} else {
// Mula Isytihar Fungsi ********************************************************************************** -->
function update_table( $the_table, $data ) 
{
	// cek $data
	//echo '<pre>$data['.$the_table.']', print_r($data) . '</pre>';
	
	// set blank values
	$primary_id = null;
	$fields = array();

	// find fields from table
	$sql = "show columns from $the_table";
	$res = mysql_query($sql) or diehard4('papar medan-',$sql);//die('query error 1');

	while ($field = mysql_fetch_array($res)) 
	{
	//$fields[] = $field['Field'];if ($field['Key'] == 'PRI') { $primary_id = $field['Field']; }
		if ($field['Key'] == 'PRI')
			$primary_key = $field['Field'];
		else
			$fields[] = $field['Field'];
	}
 
	$fields = array_flip( $fields ); // flip db field array
	$filtered = array_intersect_key( $data, $fields );// remove non exist array on post data
	array_walk($filtered, create_function('&$val', '$val = mysql_real_escape_string(trim($val));') ); // clean up value 
	
	/*
	foreach ($filtered as $medan => $papar)
	{
		$senarai[]=	($medan==$primary_key) ? 
			" $medan=null " : " $medan='$papar'"; 
	}
	
	$statment=implode(",\r",$senarai);
	*/
	
	$satu=implode( "='%s',\r", array_keys( $filtered ) );
	$statment = vsprintf( 
	$satu . "='%s'", array_values( $filtered ) 
	); // create statement update
		
	// check if primary key exists
	if ($primary_key && $data[$primary_key])
		$where = "WHERE $primary_key in $data[$primary_key]";
	 
	$full_sql = " UPDATE $the_table SET \r" .
	" $statment \r $where";
		
	//echo '<pre>' . $full_sql . '</pre>';
	return $full_sql;
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
	$_POST['aktiviti'] = 'kemaskini mdt2011';
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
	## untuk DAFTAR SAMPLE KES fe
	//echo '<pre>', print_r($_POST) . '</pre>';
	# buat peristiharan
	$rangka = 'mm_rangka13';
	//$_POST[$rangka]['respon']=strtoupper($_POST[$rangka]['respon']);
	$_POST[$rangka]['fe']=strtolower($_POST[$rangka]['fe']);
	//$_POST[$rangka]['email']=strtolower($_POST[$rangka]['email']);
	//$_POST[$rangka]['responden']=mb_convert_case($_POST[$rangka]['responden'], MB_CASE_TITLE);
	//$m['pilih'] = bersih($_POST['pilihan']);
	$m['cari']  = bersih($_POST[$rangka]['fe']);
	// cantum newss
		//$m['id'] = bersih("('" . implode("',\r '", $_POST['newss'] ) . "')");
		$m['id'] = "('" . implode("',\r '", $_POST['newss'] ) . "')";
	//echo '<pre>$m-', print_r($m) . '</pre>';
	
	$bulan = array('rangka',/*
		'jan', 'feb', 'mac', 'apr', 
		'mei', 'jun', 'jul', 'ogo', 
		'sep', 'okt', 'nov', 'dis'*/);
		
	# if ($m['cari']==null) - mula -----------------------------------------------------------
	if ($m['cari']==null) :
		echo '<br><font color=blue>Maaflah,(fe=' . $m['cari'] . ') tak isi <br>' .
		'<font face=Wingdings size=5>L</font><a href="../">Menu Utama</a></font>';
	else :
	#-- Mula Lihat Dlm Kawalan  
		#ulang jadual
		foreach ($bulan as $key => $bln)
		{// mula ulang jadual -------------------------------------------------------
			#set primary key
			$myTable = 'mm_' . $bln . '13';
			$data=$_POST[$myTable];
			//$data[$m['pilih']] = $m['cari'];
			$data['newss'] = $m['id'];
			//echo "<pre>$myTable-", print_r($data) . '</pre>';
			
			$ubah=update_table($myTable, $data);
			//diehard4('$ubah',$ubah); // papar $ubah
			ubah($ubah,'ubah ' . $myTable,$nama_anda);
		}// tamat ulang jadual -------------------------------------------------------
	#-- Tamat Lihat Dlm Kawalan dan pergi ke borang kawal_pilihfe.php
	$ralat='Selesai';#$ralat=sms_kawan($myTable);
	header('Location:./laporan_fe.php?cari=' . $m['cari'] . '&ralat=' . $ralat . '#bulan');
	endif;
	# if ($m['cari']==null) - tamat -----------------------------------------------------------
// Tamat Proses Kawalan ****************************************************************************** -->
}// Tamat Proses Batch Baru ?>

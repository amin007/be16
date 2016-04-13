<?php
namespace Aplikasi\Kitab; //echo __NAMESPACE__; 
class Bacafail
{
#==========================================================================================
	public function namafail()
	{ # 
		# baca fail kandungan utama
		$url = 'http://localhost/sumber/startbootstrap-sb-admin-2-1.0.8/pages/s1.html';
		$handle = fopen($url, "rb");
		$fsize = 8192; //$fsize = filesize($url); 
		if (FALSE === $handle) { exit("Failed to open stream to URL");}
		$contents = '';
		while (!feof($handle)) {$contents .= fread($handle, $fsize);}

		# baca fail menu atas
		$menuAtas = 'http://http://localhost/sumber/startbootstrap-sb-admin-2-1.0.8/pages/s1-menu_atas.html';
		$bacaMenuAtas = fopen($menuAtas, "rb");
		if (FALSE === $bacaMenuAtas) { exit("Failed to open stream to URL"); }
		$menuatas = '';
		while (!feof($bacaMenuAtas)) {  $menuatas .= fread($bacaMenuAtas, $fsize);}

		# ubahsuai data
		$kandungan =  str_replace('{{ s1-menu-atas.php }}', $menuatas, $contents);
		$tengah = '<hr><h1>CRUD - Kita Tanya Apa Khabar</h1><hr>';
		$kandungan2 =  str_replace('{{ tengah.php }}', $tengah, $kandungan);

		# pergi papar kandungan
		//echo $contents;
		//echo $kandungan;
		echo $kandungan2;

		# tutup fail
		fclose($handle);
		fclose($bacaMenuAtas);		
	}
#==========================================================================================
#==========================================================================================
}
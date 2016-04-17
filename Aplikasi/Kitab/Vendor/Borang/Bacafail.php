<?php
namespace Aplikasi\Kitab; //echo __NAMESPACE__; 
class Bacafail
{
#==========================================================================================
	public function namafail()
	{
		# baca fail kandungan utama
		$url = 'http://localhost/sumber/startbootstrap-sb-admin-2-1.0.8/pages/s1.html';
		list($membukaFail,$dataFail) = $this->bukafailutama($url);
		
		# baca fail menu atas
		$url2 = 'http://http://localhost/sumber/startbootstrap-sb-admin-2-1.0.8/pages/s1-menu_atas.html';
		list($bacaMenuAtas,$menuAtas) = $this->bukafailmenu($url2);

		# ubahsuai data
		$kandungan =  str_replace('{{ s1-menu-atas.php }}', $menuatas, $contents);
		$tengah = '<hr><h1>CRUD - Kita Tanya Apa Khabar</h1><hr>';
		$kandungan2 =  str_replace('{{ tengah.php }}', $tengah, $kandungan);

		# pergi papar kandungan
		//echo $contents; //echo $kandungan;
		echo $kandungan2;

		# tutup fail
		fclose($dataFail);
		fclose($bacaMenuAtas);		
	}
	
	public function bukafailutama($url)
	{
		$membukaFail = fopen($url, "rb");
		$saizFail = 8192; //$saizFail = filesize($url); 
		if (FALSE === $membukaFail) { exit("Failed to open stream to URL");}
		$dataFail = '';
		while (!feof($membukaFail)) {$dataFail .= fread($membukaFail, $saizFail);}
		
		return array($membukaFail,$dataFail);
	}
	
	public function bukafailmenu($url)
	{
		$bacaMenuAtas = fopen($url, "rb");
		$saizFail = 8192; //$saizFail = filesize($url); 
		if (FALSE === $bacaMenuAtas) { exit("Failed to open stream to URL"); }
		$menuAtas = '';
		while (!feof($bacaMenuAtas)) {  $menuAtas .= fread($bacaMenuAtas, $fsize);}
		
		return array($bacaMenuAtas,$menuAtas);
	}
	
#==========================================================================================
#==========================================================================================
}
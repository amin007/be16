<?php
namespace Aplikasi\Kitab; //echo __NAMESPACE__; 
class Bacafail
{
#==========================================================================================
	public function bukafailutama($url)
	{
		$membukaFail = fopen($url, "rb");
		$saizFail = 8192; //$saizFail = filesize($url); 
		if (FALSE === $membukaFail) { exit("Gagal membuka aliran ke $url");}
		$dataFail = '';
		while (!feof($membukaFail)) {$dataFail .= fread($membukaFail, $saizFail);}
		
		return array($membukaFail,$dataFail);
	}
	
	public function bukafailmenu($url)
	{
		$bacaMenuAtas = fopen($url, "rb");
		$saizFail = 8192; //$saizFail = filesize($url); 
		if (FALSE === $bacaMenuAtas) { exit("Gagal membuka aliran ke $url"); }
		$menuAtas = '';
		while (!feof($bacaMenuAtas)) {  $menuAtas .= fread($bacaMenuAtas, $fsize);}
		
		return array($bacaMenuAtas,$menuAtas);
	}
	
	public function loginTemplate()
	{
		$url[] = URL . 'sumber/rangka-dawai/AdminLTE-2.3.0/pages/examples/login2.html';
		$url[] = URL . 'sumber/rangka-dawai/FlatAdmin-V.2/html/pages/login2.html';
		$url[] = URL . 'sumber/rangka-dawai/miminium/login.html';
		/*$url[] = URL . 'sumber/rangka-dawai/modern_admin_panel/login.html';
		$url[] = URL . 'sumber/rangka-dawai/startbootstrap-sb-admin-2-1.0.8/pages/login.html';
		//*/
		
		$theme = array(0,1); //array(0,1,2,3,4);
		$pilih = $theme[rand(0, count($theme)-1)];

		return $url[$pilih];
	}
	
	public function login()
	{
		$url = $this->loginTemplate(); //echo "\$url = $url <br>";
		# pecah data
		$pecahUrl = explode('/', $url);
		$template = $pecahUrl[8];
		//echo '<pre>$pecahUrl->'; print_r($pecahUrl) . '</pre>';
		//echo "\$template = " . $template;
		list($membukaFail,$dataFail) = $this->bukafailutama($url);
		# ubahsuai data
		$lokasi = 'http://sidapmuar/private_html/tahun/be16/sumber/rangka-dawai/' . $template . '/';
		$kandungan = str_replace('{{url}}', $lokasi, $dataFail);

		# pergi papar kandungan
		//echo $dataFail;
		echo $kandungan;

		# tutup fail
		fclose($membukaFail);
	}
	
	public function namafail()
	{
		# baca fail kandungan utama
		$url = URL . 'sumber/rangka-dawai/startbootstrap-sb-admin-2-1.0.8/pages/s1.html';
		list($membukaFail,$dataFail) = $this->bukafailutama($url);
		
		# baca fail menu atas
		$url2 = URL . 'sumber/rangka-dawai/startbootstrap-sb-admin-2-1.0.8/pages/s1-menu_atas.html';
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
#==========================================================================================
#==========================================================================================
}

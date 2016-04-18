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
	
	public function loginCSS()
	{
		// miminium/asset/css/plugins/simple-line-icons.css
	}
	
	public function loginTemplate()
	{
		$url[] = 'AdminLTE-2.3.0/pages/examples/login2.html';
		$url[] = 'FlatAdmin-V.2/html/pages/login2.html';
		$url[] = 'miminium/login2.html';
		$url[] = 'modern_admin_panel/login2.html';
		$url[] = 'startbootstrap-sb-admin-2-1.0.8/pages/login2.html';
		//*/
		
		$theme = array(0,1,2,3,4);
		$pilih = $theme[rand(0, count($theme)-1)];

		return $url[$pilih];
	}
	
	public function login()
	{
		$url = $this->loginTemplate(); //echo "\$template = $template <br>";
		# pecah data
		$pecahUrl = explode('/', $url);
		$template = $pecahUrl[0];
		$sumber = 'http://sidapmuar/private_html/tahun/be16/sumber/rangka-dawai/';
		$lokasi = $sumber . $template . '/';
		//echo '<pre>$pecahUrl->'; print_r($pecahUrl) . '</pre>';
		//echo "\$template = $template | \$lokasi = $lokasi ";
		
		list($membukaFail,$dataFail) = $this->bukafailutama($sumber . $url);
		$kandungan = str_replace('{{url}}', $lokasi, $dataFail);
		
		if ($template=='miminium') 
		{
			$lokasi2 = $sumber . $template . '/asset/css/plugins/simple-line-icons2.css';
			list($membukaFail2,$dataFail2) = $this->bukafailutama($lokasi2);
			$kandungan2 = str_replace('{{url}}', $lokasi2, $dataFail2);
		}
				
		# pergi papar kandungan
		//echo $dataFail;
		echo $kandungan;

		# tutup fail
		fclose($membukaFail);//*/
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

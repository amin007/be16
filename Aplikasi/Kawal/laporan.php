<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Laporan extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		//echo '<br>class Laporan extends Kawal';
		parent::__construct();
		//\Aplikasi\Kitab\Kebenaran::kawalMasuk();
		$this->_folder = 'laporan';
	}
	
	public function index() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin Laporan';
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/index');
	}
#==========================================================================================
	public function fe($jadual, $cariID, $cariApa)
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat = 'Enjin Laporan FE';
		$this->papar->kp = 'BUTAM';
		$this->papar->fe = $cariApa;
		//$this->papar->kiraSemuaBaris = 
		$this->papar->item = $item = 1000; 
		$this->papar->ms = $ms = 1;
		# kod asas panggil sql
			//$medan = '*'; # papar semua medan
			$cari[] = array('fix'=>'like%','atau'=>'WHERE','medan'=>$cariID,'apa'=>$cariApa);
			$jum2 = pencamSqlLimit(300, $item, $ms); #
			$susun[] = array_merge($jum2, array('kumpul'=>null,'susun'=>null) );
			# tanya Sql
			$this->papar->hasil = $this->tanya->//tatasusunanUbah2A //cariSemuaData //cariSql
				kumpulRespon($item, $ms, $jadual, $cari, $susun = null);

		/*# semak data
		echo '<pre>';
		//echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		//echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '$this->papar->hasil:<br>'; print_r($this->papar->hasil);
 		echo '</pre>'; //*/

		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/f3all');
	}
#==========================================================================================
}
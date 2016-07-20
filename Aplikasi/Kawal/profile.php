<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Profile extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		parent::__construct();
		//\Aplikasi\Kitab\Kebenaran::kawalMasuk();
		\Aplikasi\Kitab\Kebenaran::kawalKeluar();
		$this->_folder = 'profile';
	}
	
	public function index() 
	{	
		# Set pemboleubah utama
		$this->papar->tajuk = 'Profile';
		
		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		$this->papar->bacaTemplate(//$this->papar->paparTemplate(//$this->papar->baca(
		$this->_folder . '/index', $jenis, 0); # $noInclude=0
		//*/
	}
#==========================================================================================
	public function ubah() 
	{	
		$sesi = \Aplikasi\Kitab\Sesi::init();
		# set pembolehubah
		$pengguna = \Aplikasi\Kitab\Sesi::get('namaPegawai');
		$level = \Aplikasi\Kitab\Sesi::get('levelPegawai');	
		//echo '<pre>class Profile::ubah() extends \Aplikasi\Kitab\Kawal :</pre><br>';
		//echo '<pre>$_SESSION:', print_r($_SESSION, 1) . '</pre><br>';
		//echo '$pengguna:' . $pengguna . '<br>';
	
		if (!empty($pengguna)) 
		{
			# senaraikan tatasusunan jadual dan setkan pembolehubah
			$this->papar->_jadual = 'nama_pegawai';
			$this->papar->cariApa = 'namaPegawai';
			$cari[] = array('fix'=>'like','atau'=>'WHERE','medan'=>'namaPegawai','apa'=>$pengguna);
        
			# 1. mula semak dalam profile
			$this->papar->data['profile'] = $this->tanya->cariSemuaData//cariSql
				($this->papar->_jadual, $this->tanya->medanProfile($pengguna), 
				$cari, $susun = null);
				
			if(isset($this->papar->data['profile'][0]['namaPegawai'])):
				# splice in at position 2
				$this->papar->data['profile'][0] = 
					array_slice($this->papar->data['profile'][0], 0, 2, true) 
					+ array('kataLaluan'=>null)
					+ array_slice($this->papar->data['profile'][0], 2, 
						count($this->papar->data['profile'][0]) - 1, true);
				$this->papar->data['profile'][0]['tarikh'] = '1980-05-07';
			endif;//*/
		}
		else
		{
			$this->papar->cariApa = '[tiada id diisi]';
		}
		# isytihar pemboleubah
		$this->papar->cariID = (!isset($this->papar->data['profile'][0]['namaPegawai'])) ? null : $pengguna;
		
		/*echo '<pre>'; # semak data
		echo '$this->papar->data:<br>'; print_r($this->papar->data); 
		echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		echo '</pre>'; //*/	
				
		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		$this->papar->bacaTemplate(//$this->papar->paparTemplate(//$this->papar->baca(
		$this->_folder . '/ubah', $jenis, 0); # $noInclude=0
		//*/
	}
#==========================================================================================
	public function selitTengah()
	{
		$arr = array('profile'=>array(0 => array(
			'zero'  => '0',
			'one'   => '1',
			'two'   => '2',
			'three' => '3'
			)));
		
		echo '<pre>$arr:<br>'; print_r($arr) . '</pre>';

		# cuba ambil alih key=2
		$arr['profile'][0] = 
			array_slice($arr['profile'][0], 0, 2, true) 
			+ array('kataLaluan'=>null)
			+ array_slice($arr['profile'][0], 2, 
				count($arr['profile'][0]) - 1, true);
		
		# paparkan hasil tatasusunan yang baru diselit
		echo '$arr2:<br>'; print_r($arr); 
	}
#==========================================================================================
}
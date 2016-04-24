<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Login extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		//echo '<br>class Index extends Kawal';
		parent::__construct();
        \Aplikasi\Kitab\Kebenaran::kawalMasuk();
		$this->_folder = 'login';
	}
#==========================================================================================
	public function index() 
	{	
		# Set pemboleubah utama
		$this->papar->gambar = gambar_latarbelakang(null);
		$this->papar->menuatas = 'tak';
		$this->papar->TajukBesar = 'Sila Login';
		
		# pergi papar kandungan
		$this->papar->baca('login/index');
	}
	
	public function papar() 
	{	
		# Set pemboleubah utama
		$this->papar->gambar = gambar_latarbelakang(null);
		$this->papar->menuatas = 'ya';
		$this->papar->TajukBesar = 'Halaman/Ruangtamu';

		# pergi papar kandungan
		$this->papar->baca('login/papar');
	}

	public function gambar() 
	{	
		# Set pemboleubah utama
		$this->papar->gambar = gambar_latarbelakang(null);
		$this->papar->menuatas = 'ya';
		$this->papar->TajukBesar = 'Halaman/Gambar';
		
		# pergi papar kandungan
		$this->papar->baca('login/gambar');
	}
#==========================================================================================	
	function semakid()
	{
		# semak data $_POST
		echo '<pre>$_POST->'; print_r($_POST) . '</pre>';
		//$this->tanya->semakid();
	}
	
	function salah()
	{
		$this->papar->mesej = 'Ada masalah pada user dan password';

		# Set pemboleubah utama
		$this->papar->sesat = 'Enjin Carian Ekonomi - Sesat';
		$this->papar->isi = '';

		# pergi papar kandungan
		$this->papar->baca('index/salah');
	}
#==========================================================================================	
}
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
		$jenis = $this->papar->pilihTemplate($template=0);
		//$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
		$this->papar->baca('login/index',$jenis,0); # $noInclude=0
	}
	
	public function papar() 
	{	
		# Set pemboleubah utama
		$this->papar->gambar = gambar_latarbelakang(null);
		$this->papar->menuatas = 'ya';
		$this->papar->TajukBesar = 'Halaman/Ruangtamu';

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		//$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
		$this->papar->baca('login/papar',$jenis,0); # $noInclude=0
	}

	public function gambar() 
	{	
		# Set pemboleubah utama
		$this->papar->gambar = gambar_latarbelakang(null);
		$this->papar->menuatas = 'ya';
		$this->papar->TajukBesar = 'Halaman/Gambar';
		
		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		//$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
		$this->papar->baca('login/gambar',$jenis,0); # $noInclude=0
	}
#==========================================================================================	
	function semakid()
	{
		# semak data $_POST
		//echo '<pre>Test $_POST->'; print_r($_POST) . '</pre>';
		//$this->tanya->dapatid($_POST['password']);
		$this->tanya->semakid();
		//$this->tanya->ujiID();
	}
	
	function salah()
	{
		# debug
		//$this->tanya->dapatid($_POST['password']);
		$this->papar->mesej = 'Ada masalah pada user dan password';

		# Set pemboleubah utama
		$this->papar->sesat = 'Enjin Carian Ekonomi - Sesat';
		$this->papar->isi = '';

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		$this->papar->baca(
		//$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
			'index/salah',$jenis,0); # $noInclude=0
		
	}
#==========================================================================================	
	function semaknama($nama)
	{
		# semak data $_POST
		//echo '<pre>Test $_POST->'; print_r($_POST) . '</pre>';
		$this->tanya->dapatid($nama);
		//$this->tanya->ujiID();
	}
#==========================================================================================	
}
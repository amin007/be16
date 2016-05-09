<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Ruangtamu extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		parent::__construct();
		//\Aplikasi\Kitab\Kebenaran::kawalMasuk();
		\Aplikasi\Kitab\Kebenaran::kawalKeluar();
		$this->_folder = 'ruangtamu';

		/*
		$this->papar->js = array(
			'bootstrap-transition.js',
			'bootstrap-alert.js',
			'bootstrap-modal.js',
			'bootstrap-dropdown.js',
			'bootstrap-scrollspy.js',
			'bootstrap-tab.js',
			'bootstrap-tooltip.js',
			'bootstrap-popover.js',
			'bootstrap-button.js',
			'bootstrap-collapse.js',
			'bootstrap-carousel.js',
			'bootstrap-typeahead.js',
			'bootstrap-affix.js',
			'bootstrap-datepicker.js',
			'bootstrap-datepicker.ms.js');
		$this->papar->css = array(
			'bootstrap-datepicker.css'); //*/

		$this->papar->menuatas = 'ya';
	}
	
	function index() 
	{	
		# Set pemboleubah utama
		$this->papar->pegawai = senarai_kakitangan();
		$this->papar->tajuk = 'Ruangtamu';
		
		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		//$this->papar->baca(
		$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
			$this->_folder . '/index',$jenis,0); # $noInclude=0
			//'mobile/mobile',$jenis,0); # $noInclude=0
	}
#==========================================================================================
	function semaknama($nama)
	{
		# semak data $_POST
		echo '<pre>$_POST->'; print_r($_POST) . '</pre>| ';
		echo '<pre>$nama->'; print_r($nama) . '</pre>| ';
		echo 'Kod:' . \Aplikasi\Kitab\RahsiaHash::rahsia('md5', $nama) . ': ';
		//echo 'Kod:' . RahsiaHash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY) . ': ';
	}

	function menu() 
	{	
		// Set pemboleubah utama
		$this->papar->pegawai = senarai_kakitangan();
		$this->papar->tajuk = 'Menu';
		// pergi papar kandungan
		$this->papar->baca('mobile/mobile');
	}

	function logout()
	{
		//echo '<pre>sebelum:'; print_r($_SESSION) . '</pre>';
		\Aplikasi\Kitab\Sesi::destroy();
		header('location: ' . URL);
		//exit;
	}
#==========================================================================================
}
<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Index extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================	
	function __construct() 
	{
		//echo '<br>class Index extends Kawal';
		parent::__construct();
        \Aplikasi\Kitab\Kebenaran::kawalMasuk();
		$this->_folder = 'index';
	}
	
	function index() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin';
		//$theme = array(0,1,2,3,4);
		//$template = $theme[rand(0, count($theme)-1)];

		# pergi papar kandungan
		$jenis = $this->papar->pilihTemplate($template=0);
		$this->papar->baca(
		//$this->papar->bacaTemplate(
		//$this->papar->paparTemplate(
			$this->_folder . '/login',$jenis,0); # $noInclude=0
		
	}
#==========================================================================================	
	function muar() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin';
		$this->papar->senaraiIP = dpt_ip(); # dapatkan senarai IP yang dibenarkan
		$this->papar->ip = $ip = $_SERVER['REMOTE_ADDR'];
		$this->papar->ip2 = substr($ip,0,10);
		$this->papar->hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$this->papar->server = $_SERVER['SERVER_NAME'];
		$this->papar->tajuk = 'Login Untuk Muar';

		# pergi papar kandungan
		$this->_folder = 'mobile'; # untuk apps mobile
		$this->papar->baca($this->_folder . '/muar');
	}

	function putrajaya() 
	{
		# Set pemboleubah utama
		//$this->papar->IP=dpt_ip(); # dapatkan senarai IP yang dibenarkan
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/daftar');
	}
	
	function login($user) 
	{
		# Set pemboleubah utama
		$this->papar->nama = $user; # dapatkan nama pengguna
		$this->papar->IP = dpt_ip(); # dapatkan senarai IP yang dibenarkan
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/login');
	}

	function login_automatik($user) 
	{
		# Set pemboleubah utama
		$this->papar->nama = $user; # dapatkan nama pengguna
		$this->papar->IP = dpt_ip(); # dapatkan senarai IP yang dibenarkan
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/login_automatik');
	}

	function keluar() 
	{
		# Set pemboleubah utama
		$this->papar->IP=dpt_ip(); # dapatkan senarai IP yang dibenarkan
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/keluar');
	}
	
#==========================================================================================	
}
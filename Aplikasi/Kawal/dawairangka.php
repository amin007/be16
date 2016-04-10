<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Dawairangka extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		//echo '<br>class Dawairangka extends \Aplikasi\Kitab\Kawal';
		parent::__construct();
		//\Aplikasi\Kitab\Kebenaran::kawalMasuk();
		$this->_folder = 'template';
	}
	
	function index($template = null) 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat = 'Enjin Template';
		$jenis = $this->papar->pilihTemplate($template);
		# pergi papar kandungan
		//$this->papar->bacaTemplate($this->_folder . '/index',
		$this->papar->paparTemplate($this->_folder . '/index',
			$jenis,0); # $noInclude=0
	}
#==========================================================================================		
	function pilihTemplate($template)
	{
	#^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#		
		switch ($template)
		{
/*			case 2:
			break;
//*/ 
			default:
			$jenis = 'AdminLTE-2.3.0';
			break;
		}
	#^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#	
		return '/template/' . $jenis;
	}
#==========================================================================================
#==========================================================================================
}
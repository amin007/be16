<?php
namespace Aplikasi\Kitab; //echo __NAMESPACE__; 
class Papar
{
#==========================================================================================
	function __construct() 
	{
		//echo '<br>1. Anda berada di class Papar<br>';
	}
#==========================================================================================	
	public function bacaan($nama, $noInclude = false)
	{
		//echo 'Anda berada di class Papar::' . $nama . '()<br>';

		if ($noInclude == true) 
		{
			require PAPAR . $nama . '.php';	
		}
		else 
		{
			require PAPAR . 'diatas.php';
			require PAPAR . 'menu_atas.php';
			require PAPAR . $nama . '.php';
			require PAPAR . 'dibawah.php';	
		}
	}

	public function baca($nama, $noInclude = false)
	{
		//echo '<br>1.Anda berada di class Papar::' . $nama . '()<br>';
		
		$namafail = explode('/', $nama);
        $failPapar = GetMatchingFiles(
			GetContents(PAPAR . '/' . $namafail[0]),
			$namafail[1] . '.php');
		$paparFail = $failPapar[0];
		/*
        echo '<hr size=2>PAPAR=' . PAPAR . '<br>';
        echo '$namafail=<pre>'; print_r($namafail) . '</pre><br>';
        echo '$failPapar=<pre>'; print_r($failPapar) . '</pre><br>';
		echo '$paparFail->' . $paparFail . '<br>';
		//*/
		
		$cariNama = array ('index/index', 'index/login',
		'index/login_automatik','index/daftar','index/muar');
		$cariJQM = array('mobile/mobile','mobile/iconjqm');

		if ($paparFail == false) 
		{
			\Aplikasi\Kitab\Route::failPaparTidakWujud();
			//echo 'failPaparTidakWujud()';
		}
		//elseif (in_array($nama,$cariJQM)) 
		elseif ( $namafail[0]=='mobile')
		{
			require PAPAR . '/diatas-jqm.php';
			require $paparFail;
			require PAPAR . '/dibawah-jqm.php';
		}
		elseif ($noInclude == true) 
		{
			require $paparFail;
		}
		else 
		{
			if( in_array($nama,$cariNama) )
				require $paparFail;	
			elseif ( $nama == 'semak')
				require $paparFail;	
			else
			{				
				require PAPAR . '/diatas.php';
				require PAPAR . '/menu_atas.php';
				require $paparFail;
				require PAPAR . '/dibawah.php';	
			}
		}
//*/		
	}
#==========================================================================================
#------------------------------------------------------------------------------------------
	public function paparTemplate($nama, $jenis, $noInclude = false)
	{
		echo '<br>require ' . PAPAR . '/template/' . $jenis . '/diatas.php'
			. '<br>require ' . PAPAR . '/template/' .$jenis . '/menu_atas.php'
			. '<br>require ' . PAPAR . '/' . $nama . '.php'
			. '<br>require ' . PAPAR . '/template/' . $jenis . '/dibawah.php'
			. '<hr>';
		echo '<br>require PAPAR . \'/template/\' . $jenis . \'/diatas.php\';'
			. '<br>require PAPAR . \'/template/\' . $jenis . \'/menu_atas.php\';'
			. '<br>require PAPAR . \'/\' . $nama . \'.php\';'
			. '<br>require PAPAR . \'/template/\' . $jenis . \'/dibawah.php\';'
			. '';
	}
#------------------------------------------------------------------------------------------
	public function bacaTemplate($nama, $jenis, $noInclude = false)
	{
		if ($noInclude == true) 
		{
			require PAPAR . $nama . '.php';	
		}
		else 
		{
			require PAPAR . '/template/' . $jenis . '/diatas.php';
			//require PAPAR . '/template/' . $jenis . '/menu_atas.php';
			require PAPAR . '/template/' . $jenis . '/menubar.php';
			require PAPAR . '/' . $nama . '.php';
			require PAPAR . '/template/' . $jenis . '/dibawah.php';			
		}		
	}
#-----------------------------------------------------------------------------------------
#==========================================================================================
}